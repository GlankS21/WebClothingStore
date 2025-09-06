<?php
require_once '../ADMIN/config/config.php';
require_once '../ADMIN/service/productService.php';
$service = new ProductService($conn);
// Take category and brand
$categoryName = '';
$brandName = '';
if (isset($_GET['category'])) {
    $category = $service->get_category_by_id($_GET['category']);
    if ($category) {
        $categoryName = $category['category_name'];
    }
}
if (isset($_GET['brand'])) {
    $brand = $service->get_brand_by_id($_GET['brand']);
    if ($brand) {
        $brandName = $brand['brand_name'];
    }
}
// Take size and color from database
$sizes = $service->show_size();
$color = $service->show_color();
// Take products
$products = $service->show_product_by_brand($_GET['category'], $_GET['brand']);
// FormForm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sizeID = $_POST['size'] ?? null;
    $colorHex = $_POST['color'] ?? null;
    $colorID = $colorHex ? $service->get_color_id_by_hex_code($colorHex) : null;
    if ($sizeID || $colorID) {
        $products = $service->sort_product_by_size_color($sizeID, $colorID, $_GET['category'], $_GET['brand']);
    } else {
        $products = $service->show_product_by_brand($_GET['category'], $_GET['brand']);
    }
    $sort = $_POST['sort_category'] ?? '';
    if ($sort === 'price_asc') {
        usort($products, fn($a, $b) => $a['price'] <=> $b['price']);
    } elseif ($sort === 'price_desc') {
        usort($products, fn($a, $b) => $b['price'] <=> $a['price']);
    }
}
?>
<?php require_once "./components/header.php"; ?>
<div class="category">
    <!-- BreadCrumb -->
    <div class="breadcrumb">
        <ol class="breadcrumb__list">
            <li class="breadcrumb__item"><a class="breadcrumb__link" href="index.php">Главная</a></li>
            <?php if ($categoryName): ?>
                <li class="breadcrumb__item">
                    <a class="breadcrumb__link text-uppercase"><?= htmlspecialchars($categoryName) ?></a>
                </li>
            <?php endif; ?>
            <?php if ($brandName): ?>
                <li class="breadcrumb__item">
                    <a class="breadcrumb__link"><?= htmlspecialchars($brandName) ?></a>
                </li>
            <?php endif; ?>
        </ol>
    </div>
    <div class="container row">
        <!-- Choose size and color -->
        <aside class="category-left">
            <form method="POST" action="category.php?category=<?= $_GET['category'] ?>&brand=<?= $_GET['brand'] ?>">
                <input type="hidden" name="sort_category" value="<?= htmlspecialchars($_POST['sort_category'] ?? '') ?>">
                <ul class="list-side">
                    <!-- Size -->
                    <li class="item-side item-side-size">
                        <div class="item-side-title">Размер<span class="icon-plus"><i class="bi bi-plus-lg"></i></span><span class="icon-minus" style="display: none;"><i class="bi bi-dash-lg"></i></span></div>
                        <div class="sub-list-side" style="display: none;">
                            <input type="hidden" name="list_size" value="">
                            <?php foreach ($sizes as $size): ?>
                                <label class="item-sub-list">
                                    <input class="field-cat" type="radio" name="size" value="<?= htmlspecialchars($size['id']) ?>">
                                    <span class="item-sub-title"><?= htmlspecialchars($size['name']) ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    <!-- Color -->
                    <li class="item-side item-side-color">
                        <div class="item-side-title">Цвет<span class="icon-plus"><i class="bi bi-plus-lg"></i></span><span class="icon-minus" style="display: none;"><i class="bi bi-dash-lg"></i></span></div>
                        <div class="sub-list-side" style="display: none;">
                            <input type="hidden" name="hid_color" value="">
                            <?php foreach ($color as $c): ?>
                                <label class="item-sub-list po-relative">
                                    <input class="field-cat" type="radio" name="color" value="<?= htmlspecialchars($c['hex_code']) ?>">
                                    <span class="item-sub-title" data-toggle="tooltip" data-placement="bottom" title="<?= htmlspecialchars($c['name']) ?>">
                                        <span style="display: inline-block; width: 100%; height: 100%; border-radius: 50%; background-color: <?= htmlspecialchars($c['hex_code']) ?>; border: 1px solid #ccc;"></span>
                                    </span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </li>
                </ul>
                <button type="submit" class="button">ПОСМОТРЕТЬ</button>
            </form>
        </aside>
        <div class="category-right row">
            <div class="category-right-top-item">
                <p><?= htmlspecialchars($brandName) ?></p>
            </div>
            <div class="category-right-top-item">
                <form method="POST" id="sortForm" action="category.php?category=<?= $_GET['category'] ?>&brand=<?= $_GET['brand'] ?>">
                    <input type="hidden" name="size" value="<?= htmlspecialchars($_POST['size'] ?? '') ?>">
                    <input type="hidden" name="color" value="<?= htmlspecialchars($_POST['color'] ?? '') ?>">
                    <select name="sort_category" id="sort" onchange="document.getElementById('sortForm').submit()">
                        <option value="">Популярные</option>
                        <option value="price_asc" <?= (($_POST['sort_category'] ?? '') === 'price_asc') ? 'selected' : '' ?>>Дешевле</option>
                        <option value="price_desc" <?= (($_POST['sort_category'] ?? '') === 'price_desc') ? 'selected' : '' ?>>Дороже</option>
                    </select>
                </form>
                <i class="bi bi-caret-down-fill select-icon"></i>
            </div>
            <ul class="category-right-content row">
                <?php if (empty($products)): ?>
                    <li class="container-item-product" style="width: 50vw; margin:50px; text-align: center; display:block;">Здесь пока нет товаров, зайдите позже!</li>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <li class="container-item-product">
                            <img src="../ADMIN/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['image']) ?>">
                            <div class="product-info">
                                <p class="product-title"><?= htmlspecialchars($product['name']) ?></p>
                                <p class="product-price"><?= htmlspecialchars(number_format($product['price'], 0, '.', ' ')) ?> ₽</p>
                                <div class="add-to-cart">
                                    <a href="product.php?category=<?= htmlspecialchars($product['category_id']) ?>&brand=<?= htmlspecialchars($product['brand_id']) ?>&id=<?= htmlspecialchars($product['product_id']) ?>">
                                        <i class="bi bi-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php require_once "./components/footer.php"; ?>
<?php
session_start(); 
require_once '../ADMIN/config/config.php';
require_once '../ADMIN/service/productService.php';
require_once '../ADMIN/service/cartService.php';
$service = new ProductService($conn);
$categoryName = '';
$brandName = '';
$productName = '';
if (isset($_GET['category'])) {
    $category = $service->get_category_by_id($_GET['category']);
    if ($category) $categoryName = $category['category_name'];
}
if (isset($_GET['brand'])) {
    $brand = $service->get_brand_by_id($_GET['brand']);
    if ($brand) $brandName = $brand['brand_name'];
}
if (isset($_GET['id'])) {
    $product = $service->show_product_by_id($_GET['id']);
    $productName = $product['name'];
    $product_img = $service->show_product_img($_GET['id']);
    $colors = $service->show_product_color($_GET['id']);
    $sizes = $service->show_product_size($_GET['id']);
}
// Add product to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'] ?? null;
    $color = $_POST['color'] ?? null;
    $size = $service->get_size_name_by_id($_POST['size']) ?? null;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    // Если пользователь не найден
    if ($product_id) {
        $products = $service->show_product_by_id($product_id);
        if ($products) {
            if (isset($_SESSION['user_id'])) {
                $cartService = new CartService($conn);
                $cartService->add_product($_SESSION['user_id'], $product_id, $color, $_POST['size'], $quantity);
            }else{
                if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
                $found = false;
                foreach ($_SESSION['cart'] as &$product) {
                    if ($product['product_id'] == $product_id && $product['color'] == $color && $product['size'] == $size) {
                        $product['quantity'] += $quantity;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $_SESSION['cart'][] = [
                        'product_id' => $product_id,
                        'image'      => $products['image'],
                        'name'       => $products['name'],
                        'color'      => $color,
                        'size'       => $size,
                        'price'      => $products['price'],
                        'quantity'   => $quantity
                    ];
                }
            }
        }
    }
    header('Location: cart.php');
    exit;
}
//Product Related
$productRelated = $service->get_random_products();
?>
<?php require_once "./components/header.php"; ?>
<section class="product">
    <!-- Breadcrumb -->
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
                    <a class="breadcrumb__link" href="category.php?category=<?= htmlspecialchars($_GET['category']) ?>&brand=<?= htmlspecialchars($_GET['brand']) ?>">
                        <?= htmlspecialchars($brandName) ?>
                    </a>
                </li>
            <?php endif; ?>
             <?php if ($productName): ?>
                <li class="breadcrumb__item"><a class="breadcrumb__link"><?= htmlspecialchars($productName) ?></a></li>
            <?php endif; ?>
        </ol>
    </div>
    <!-- Product Content -->
    <div class="product-content row">
        <div class="product-content-left row">
            <div class="product-content-left-big-img">
                <img src="../ADMIN/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            </div>
            <div class="product-content-left-small-img">
                <img src="../ADMIN/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <?php foreach ($product_img as $img): ?>
                    <img src="../ADMIN/uploads/<?= htmlspecialchars($img['product_img_desc']) ?>" alt="">
                <?php endforeach; ?>
            </div>
        </div>
        <div class="product-content-right">
            <form method="POST" action="product.php">
                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
                <h2 class="product-name text-uppercase"><?= htmlspecialchars($product['name']) ?></h2>
                <p class="product-msp">MSP: <?= htmlspecialchars($product['product_id']) ?></p>
                <p class="product-price"><?= htmlspecialchars(number_format($product['price'], 0, '.', ' ')) ?> ₽</p>
                <!-- Color -->
                <div class="item-side item-side-color">
                    <p class="item-side-name">Свет:</p>
                    <div class="sub-list-side" style="display: flex;">
                        <?php foreach ($colors as $c): ?>
                            <label class="item-sub-list po-relative">
                                <input class="field-cat" type="radio" name="color" value="<?= htmlspecialchars($c['hex_code']) ?>" required>
                                <span class="item-sub-title" data-toggle="tooltip" data-placement="bottom" title="<?= htmlspecialchars($c['name']) ?>">
                                    <span style="display: inline-block; width: 100%; height: 100%; border-radius: 50%; background-color: <?= htmlspecialchars($c['hex_code']) ?>; border: 1px solid #ccc;"></span>
                                </span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Size -->
                <div class="item-side item-side-size">
                    <p class="item-side-name">Размер</p>
                    <div class="sub-list-side" style="display: flex;">
                        <?php foreach ($sizes as $size): ?>
                        <label class="item-sub-list">
                            <input class="field-cat" type="radio" name="size" value="<?= htmlspecialchars($size['id']) ?>" required>
                            <span class="item-sub-title"><?= htmlspecialchars($size['name']) ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <p class="item-size-title" style="color: #d60f3c; font-size: 1.25rem;">Пожалуйста, выберите размер</p>
                <!-- Quantity -->
                <div class="quantity">
                    <p><strong style="padding-right: 6px;">Количесвто:</strong></p>
                    <input style="width: 50px; text-align: center;" type="number" name="quantity" min="1" value="1" required>
                </div>
                <!-- Button -->
                <div class="product-button">
                    <button class="button" type="submit">
                        <i class="bi bi-cart"></i>
                        <span class="text-uppercase">Купить</span>
                    </button>
                    <button type="button" class="button" onclick="window.location.href='index.php'">Найти в магазине</button>
                </div>
            </form>
            <div class="product-content-right-bottom">
                <img class="product-content-right-bottom-top" src="./images/image-down.webp" alt="Свернуть">
                <div class="product-content-right-bottom-content-big">
                    <div class="product-content-right-bottom-content-title row">
                        <p class="text-uppercase product-content-right-bottom-content-title-item chitiet activeInfBtn">Информация</p>
                        <p class="text-uppercase product-content-right-bottom-content-title-item baoquan">Уход</p>
                    </div>
                    <div class="product-content-right-bottom-content">
                        <div style="font-size: 14px;" class="product-content-right-bottom-content-chitiet">
                            <?= nl2br(htmlspecialchars($product['description'])) ?>
                        </div>
                        <div style="font-size: 14px;" class="product-content-right-bottom-content-baoquan">
                            Инструкции по уходу за изделием: ...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Related Section -->
<div class="product-related">
    <p class="product-related-title text-uppercase">Рекомендуем также</p>
    <ul class="product-content">
        <?php foreach ($productRelated as $product): ?>
        <li class="container-item-product">
            <img src="../ADMIN/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            <div class="product-info">
                <p class="product-title"><?= htmlspecialchars($product['name']) ?></p>
                <p class="product-price"><?= number_format($product['price'], 0, '.', ' ') ?> ₽</p>
                <div class="add-to-cart">
                    <a href="product.php?id=<?= $product['product_id'] ?>"><i class="bi bi-cart"></i></a>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php require_once "./components/footer.php"; ?>
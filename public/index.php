<?php require_once "./components/header.php"; ?>
<?php
require_once '../ADMIN/config/config.php';
require_once '../ADMIN/service/brandService.php';
require_once '../ADMIN/service/productService.php';
$brandService = new BrandService($conn);   
$productService = new ProductService($conn);
$categories = $brandService->show_category();
$brands = $brandService->show_brand();
$products = $productService->show_product();
$grouped_brands = [];
foreach ($brands as $b) {
    $grouped_brands[$b['category_name']][] = $b;
}
?>
<aside id="Slider">
    <div class="aspect-ratio-169">
        <img src="images/banner1.webp" alt="Баннер 1" loading="lazy">
        <img src="images/banner2.webp" alt="Баннер 2" loading="lazy">
        <img src="images/banner3.webp" alt="Баннер 3" loading="lazy">
        <img src="images/banner4.webp" alt="Баннер 4" loading="lazy">
    </div>
    <div class="dot-container">
        <div class="dot active"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
</aside>
<main class="main-container">
    <?php
        $products_by_category = [];
        foreach ($products as $product) {
            $products_by_category[$product['category_id']][] = $product;
        }
        $categoryNames = [];
        foreach ($categories as $cat) {
            $categoryNames[$cat['category_id']] = $cat['category_name'];
        }
    ?>
    <?php foreach ($categories as $cat):?>
        <?php
            $categoryId = $cat['category_id'];
            $categoryName = $cat['category_name'];
            $productList = $products_by_category[$categoryId] ?? [];
            if (empty($productList)) continue;
            $firstProduct = reset($productList);
            $brandId = $firstProduct['brand_id'];
        ?>
        <section class="container-item">
            <h1 class="container-item-header"><?= htmlspecialchars($categoryName)?></h1>
            <ul class="container-items">
                <?php 
                    $count = 0;
                    foreach ($productList as $product): 
                        if ($count >= 5) break;
                        $count++;
                ?>
                <li class="container-item-product">
                    <img src="../ADMIN/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="product-info">
                        <p class="product-title"><?= htmlspecialchars($product['name']) ?></p>
                        <p class="product-price"><?= htmlspecialchars(number_format($product['price'], 0, '.', ' ')) ?> ₽</p>
                        <div class="add-to-cart"><a href="product.php?id=<?= $product['product_id'] ?>"><i class="bi bi-cart"></i></a></div>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
            <div><button class="button" onclick="window.location.href='category.php?category=<?= $categoryId ?>&brand=<?= $brandId ?>'">ПОСМОТРЕТЬ ДАЛЬШЕ</button></div>
        </section>
    <?php endforeach;?>
</main>
<?php require_once "./components/footer.php";?>

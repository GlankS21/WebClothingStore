<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../ADMIN/config/config.php';
require_once __DIR__ . '/../../ADMIN/service/brandService.php';
require_once __DIR__ . '/../../ADMIN/service/cartService.php'; 

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$brand = new BrandService($conn);
$categories = $brand->show_category();
$brands = $brand->show_brand();

$grouped_brands = [];
foreach ($brands as $b) {
    $grouped_brands[$b['category_name']][] = $b;
}

$current_page = basename($_SERVER['REQUEST_URI']);

// --- Cart Quantity Logic ---
$total_cart_quantity = 0;
if (isset($_SESSION['user_id'])) {
    $cartService = new CartService($conn);
    $db_cart_items = $cartService->search_by_id($_SESSION['user_id']);
    if ($db_cart_items) {
        foreach ($db_cart_items as $item) {
            $total_cart_quantity += $item['quantity'];
        }
    }
    $_SESSION['total_cart_quantity'] = $total_cart_quantity;
}
if ($total_cart_quantity == 0 && isset($_SESSION['cart'])) {
    $temp_session_quantity = 0;
    foreach ($_SESSION['cart'] as $item) {
        $temp_session_quantity += $item['quantity'];
    }
    $total_cart_quantity = $temp_session_quantity;
    $_SESSION['total_cart_quantity'] = $total_cart_quantity;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preload" as="image" href="images/banner1.webp">
    <link rel="stylesheet" href="./style/style.css">
    <title>Shop-Project</title>
</head>
<body>
    <header>
        <div class="logo" onclick="window.location.href='index.php'">
            <img src="images/logo.webp" alt="Логотип" loading="lazy">
        </div>
        <nav aria-label="Главное меню">
            <ul class="menu">
                <?php foreach ($categories as $cat): ?>
                    <?php
                    $cat_link = "category.php?category=" . $cat['category_id'];
                    $is_current = strpos($current_page, 'category.php') !== false && isset($_GET['category']) && $_GET['category'] == $cat['category_id'];?>
                    <li class="text-uppercase <?= $is_current ? 'current' : '' ?>">
                        <a style="cursor: default;"><?= htmlspecialchars($cat['category_name']) ?></a>
                        <?php if (isset($grouped_brands[$cat['category_name']])): ?>
                            <ul class="sub-menu">
                                <?php foreach ($grouped_brands[$cat['category_name']] as $brand): ?>
                                    <?php $brand_link = "category.php?category=" . $cat['category_id'] . "&brand=" . $brand['brand_id'];
                                        $is_current_brand = strpos($current_page, 'category.php') !== false &&
                                        isset($_GET['category'], $_GET['brand']) && $_GET['category'] == $cat['category_id'] && $_GET['brand'] == $brand['brand_id'];?>
                                    <li class="<?= $is_current_brand ? 'current' : '' ?>"><a href="<?= $brand_link ?>"><?= htmlspecialchars($brand['brand_name']) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
                <li><a class="<?= strpos($current_page, 'information.php') !== false ? 'current' : '' ?>" href="information.php">ИНФОРМАЦИЯ</a></li>
            </ul>
            <div class="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="sub-mobile-menu">
                <ul class="menu-mb">
                    <li style="text-align: center; width: 100%; padding: 12px;">
                        <img style="width: 100px;" src="images/logo.webp" alt="Logo" loading="lazy">
                    </li>
                    <li class="logo-mb text-uppercase"><a href="index.php">Главная</a></li>
                    <?php foreach ($categories as $cat): ?>
                    <?php $is_current = strpos($current_page, 'category.php') !== false && isset($_GET['category']) && $_GET['category'] == $cat['category_id'];?>
                        <li class="text-uppercase <?= $is_current ? 'current' : '' ?>">
                            <a><?= htmlspecialchars($cat['category_name']) ?></a>
                            <?php if (!empty($grouped_brands[$cat['category_name']])): ?>
                                <ul class="sub-menu-mb">
                                    <?php foreach ($grouped_brands[$cat['category_name']] as $brand): ?>
                                        <?php $is_current_brand = strpos($current_page, 'category.php') !== false && isset($_GET['category'], $_GET['brand']) &&
                                            $_GET['category'] == $cat['category_id'] && $_GET['brand'] == $brand['brand_id'];?>
                                        <li class="<?= $is_current_brand ? 'current' : '' ?>">
                                            <a href="category.php?category=<?= $cat['category_id'] ?>&brand=<?= $brand['brand_id'] ?>"><?= htmlspecialchars($brand['brand_name']) ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                    <li class="<?= strpos($current_page, 'information.php') !== false ? 'current' : '' ?>"> <a href="information.php">ИНФОРМАЦИЯ</a></li>
                </ul>
            </div>
        </nav>
        <ul class="others">
            <li>
                <form action="#" method="get">
                    <input type="text" placeholder="Поиск" name="search">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </li>
            <li>
                <a class="bi bi-cart-fill" href="cart.php" aria-label="Корзина"></a>
                <?php if ($total_cart_quantity > 0): ?>
                    <div id="number-product"><?= htmlspecialchars($total_cart_quantity) ?></div>
                <?php endif; ?>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li>
                    <a class="fa-solid fa-right-from-bracket" href="?logout=1" aria-label="Выход" title="Выход"></a>
                </li>
            <?php else: ?>
                <li><a class="fa fa-user" href="login.php" aria-label="Вход" title="Вход"></a></li>
            <?php endif; ?>
        </ul>
    </header>
    <script src="https://kit.fontawesome.com/72956b8baa.js" crossorigin="anonymous" defer></script>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../ADMIN/config/config.php';
require_once __DIR__ . '/../../ADMIN/service/brandService.php';
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
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
                    <li class="text-uppercase">
                        <?php if ($cat['category_name'] === "Коллекция"): ?>
                            <a href="category.php?category=<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></a>
                        <?php else: ?>
                            <a href="#"><?= htmlspecialchars($cat['category_name']) ?></a>
                        <?php endif; ?>
                        <?php
                        $cat_name = $cat['category_name'];
                        if (isset($grouped_brands[$cat_name])): ?>
                            <ul class="sub-menu">
                                <?php foreach ($grouped_brands[$cat_name] as $brand): ?>
                                    <li><a href="category.php?category=<?= $cat['category_id'] ?>&brand=<?= $brand['brand_id'] ?>"><?= htmlspecialchars($brand['brand_name']) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
                <li><a href="information.php">ИНФОРМАЦИЯ</a></li>
            </ul>
            <div class="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="sub-mobile-menu">
                <ul class="menu-mb">
                    <li class="logo-mb text-uppercase"><a href="index.php">Главная</a></li>
                    <?php foreach ($categories as $cat): ?>
                        <li class="text-uppercase"><a><?= htmlspecialchars($cat['category_name']) ?></a>
                        <?php if (!empty($grouped_brands[$cat['category_name']])): ?>
                        <ul class="sub-menu-mb">
                        <?php foreach ($grouped_brands[$cat['category_name']] as $brand): ?>
                        <li><a href="category.php?category=<?= $cat['category_id'] ?>&brand=<?= $brand['brand_id'] ?>"><?= htmlspecialchars($brand['brand_name']) ?></a></li><?php endforeach; ?></ul><?php endif; ?>
                    </li><?php endforeach; ?>
                    <li><a href="information.php">ИНФОРМАЦИЯ</a></li>
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
            <li><a class="fa fa-shopping-bag" href="cart.php" aria-label="Корзина"></a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a class="fa-solid fa-right-from-bracket" href="?logout=1" aria-label="Выход" title="Выход"></a></li>
            <?php else: ?>
                <li><a class="fa fa-user" href="login.php" aria-label="Вход" title="Вход"></a></li>
            <?php endif; ?>
        </ul>
    </header>
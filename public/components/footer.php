<?php
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
<!-- Footer -->
<footer>
    <div class="footer-left">
            <ul class="icon">
                <li><a href="#"><img src="./images/icon/facebook.svg" alt="Facebook"></a></li>
                <li><a href="#"><img src="./images/icon/google.svg" alt="Google"></a></li>
                <li><a href="#"><img src="./images/icon/instagram.svg" alt="Instagram"></a></li>
                <li><a href="#"><img src="./images/icon/pinteres.svg" alt="Pinterest"></a></li>
                <li><a href="#"><img src="./images/icon/youtube.svg" alt="YouTube"></a></li>
            </ul>
            <button type="button">ТЕЛ: 8 800 770 09 90</button>
    </div>
    <div class="footer-center">
        <ul class="footer-center-header">
            <li><a href="#">ГЛАВНАЯ</a></li>
            <li class="has-subfooter">
                <a>КАТАЛОГ</a>
                <ul class="sub-footer-center">
                <?php foreach ($categories as $category): ?>
                    <?php
                        $category_name = $category['category_name'];
                        $category_id = $category['category_id'];
                        if (isset($grouped_brands[$category_name]) && count($grouped_brands[$category_name]) > 0)
                            $brand_id = $grouped_brands[$category_name][0]['brand_id'];
                        else $brand_id = 0;
                    ?>
                    <li><a href="category.php?category=<?= $category_id ?>&brand=<?= $brand_id ?>"><?= htmlspecialchars($category_name) ?></a></li>
                <?php endforeach; ?>
            </ul>
            </li>
            <li class="has-subfooter"><a>ИНФОРМАЦИЯ</a>
                <ul class="sub-footer-center">
                    <li><a href="information.php#address">Адрес</a></li>
                    <li><a href="information.php#email">Почта</a></li>
                    <li><a href="information.php#phone">Телефон</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="footer-right">
            <p>Скачать приложение</p>
            <a href="#"><img src="./images/appstore.webp" alt="App Store"></a>
            <a href="#"><img src="./images/googleplay.webp" alt="Google Play"></a>
    </div>
</footer>
<script src="./js/script.js" defer></script>
<script src="https://kit.fontawesome.com/72956b8baa.js" crossorigin="anonymous" defer></script>
<script>
document.querySelectorAll('.footer-center-header > li.has-subfooter').forEach(link => {
    link.addEventListener('click', e => {
        const li = link.parentElement;
        li.classList.toggle('open');
    });
});
</script>
</body>
</html>

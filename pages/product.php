<?php
include $_SERVER['DOCUMENT_ROOT'] . "/shop/admin/class/brand_class.php";
include $_SERVER['DOCUMENT_ROOT'] . "/shop/admin/class/category_class.php";
?>

<?php
$category = new category;
$show_category = $category -> show_category();
$brand = new brand;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD:product.html
=======
    <script src="https://kit.fontawesome.com/72956b8baa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo '/shop/css/style.css'; ?>">
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/product.php
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>Shop-Project</title>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
<<<<<<< HEAD:product.html
            <a href="index.html"><img style="width: 6em;" src="images/logo.png" alt="logo" loading="lazy"></a>
=======
            <a href="index.php"><img style="width: 6em;" src="../images/logo.png"></a>
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/product.php
        </div>
        <div class="menu-main">
            <div class="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
        </div>
        <div class="menu">
                <?php
                if ($show_category) {
                    foreach ($show_category as $result) {
                        $category_id = $result['category_id'];     
                        $category_name = $result['category_name']; 
                        if (strtolower($category_name) == "информация") 
                            echo "<li><a class='text-uppercase' href='information.php'>$category_name</a>";
                        else
                            echo "<li><a class='text-uppercase' href='category.php?id=$category_id'>$category_name</a>";
                        $result_brand = $brand->search_by_category_id($category_id); 
                        if ($result_brand && $result_brand->num_rows > 0) {
                            echo "<ul class='sub-menu'>";
                            while ($brand_row = $result_brand->fetch_assoc()) { 
                                $brand_name = $brand_row['brand_name'];
                                echo "<li><a href='#'>$brand_name</a></li>";
                            }
                            echo "</ul>";
                        }
                        echo "</li>";
                    }
                }
                ?>
            </div>
<<<<<<< HEAD:product.html
            <div class="menu">
                <li><a href="cartegory.html">ЖЕНЩИНА</a>
                    <ul class="sub-menu">
                        <li><a href="">Новинки</a></li>
                        <li><a href="">Коллекция</a></li>
                        <li><a href="">Верхняя одежда</a></li>
                        <li><a href="">Джинсы</a></li>
                    </ul>
                </li>
                <li><a href="">МУЖЧИНА</a>
                    <ul class="sub-menu">
                        <li><a href="">Новинки</a></li>
                        <li><a href="">Коллекция</a></li>
                        <li><a href="">Верхняя одежда</a></li>
                        <li><a href="">Джинсы</a></li>
                    </ul>
                </li>
                <li><a href="">ДЕТИ</a></li>
                <li><a href="">КОЛЛЕКЦИЯ</a></li>
                <li><a href="information.html">ИНФОРМАЦИЯ</a></li>
            </div>
            <div class="sub-mobile-menu">
=======
            <!-- Mobile Menu -->
            <div class = "sub-mobile-menu">
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/product.php
                <div class="menu-mb">
                    <?php
                    if ($show_category) {
                        foreach ($show_category as $result) {
                            $category_id = $result['category_id'];     
                            $category_name = $result['category_name']; 
                            if (strtolower($category_name) == "информация") 
                                echo "<li><a class='text-uppercase' href='information.php'>$category_name</a>";
                            else
                                echo "<li><a class='text-uppercase' href='category.php?id=$category_id'>$category_name</a>";
                            $result_brand = $brand->search_by_category_id($category_id); 
                            if ($result_brand && $result_brand->num_rows > 0) {
                                echo "<ul class='sub-menu-mb'>";
                                while ($brand_row = $result_brand->fetch_assoc()) { 
                                    $brand_name = $brand_row['brand_name'];
                                    echo "<li><a href='#'>$brand_name</a></li>";
                                }
                                echo "</ul>";
                            }
                            echo "</li>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="others">
<<<<<<< HEAD:product.html
            <li><input placeholder="Search" type="text"> <i class="fas fa-search"></i></li>
            <li><a class="fa fa-user" href="login.html" aria-hidden="true"></a></li>
            <li><a class="fa fa-shopping-bag" href="cart.html" aria-hidden="true"></a></li>
=======
            <li><input placeholder="Search" type="text"> <i class ="fas fa-search"></i></li>
            <li><a class="fa fa-user" href="login.php" ></a></li>
            <li><a class="fa fa-shopping-bag" href="cart.php"></a></li>
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/product.php
        </div>
    </header>
    <!--------------------------------Product---------------------------------->
    <section class = "product">
        <div class="container">
            <div class="product-top row">
                <a href="index.php"><p>Menu</p></a><span>&#8594;</span><a href="category.php"><p>ЖЕНЩИНА</p></a><span>&#8594;</span><p>Новинки</p><span>&#8594;</span> <p>Название продукта</p>
            </div>
        </div>
        <div class="product-content row">
            <div class="product-content-left row">
                <div class="product-content-left-big-img">
                    <img src="./../images/sp1.webp" alt="">
                </div>  
                <div class="product-content-left-small-img">
                    <img src="./../images/sp1.webp" alt="">
                    <img src="./../images/sp1.2.webp" alt="">
                    <img src="./../images/sp1.3.webp" alt="">
                    <img src="./../images/sp1.4.webp" alt="">
                </div>
            </div>
            <div class="product-content-right">
                <div class="product-content-right-product-name">
                    <h1 class="text-uppercase">Название продкута</h1>
                    <p>MSP: 567E2969</p>
                </div>
                <div class="product-content-right-product-price">
                    <p>1000<sup>rub</sup></p>
                </div>
                <div class="product-content-right-product-color">
                    <p><span style="font-weight: bold;">Свет</span> : Коричневый</p><span style="color: red;"></span>
                    <div class="product-content-right-product-color-img">
<<<<<<< HEAD:product.html
                        <img src="./images/color004.png" alt="logo">
=======
                        <img src="./../images/color004.png" alt="">
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/product.php
                    </div>
                </div>
                <div class="product-content-right-product-size">
                    <p style="font-weight: bold;">Размер: </p>
                    <div class="size">
                        <span>S</span>
                        <span>M</span>
                        <span>L</span>
                        <span>XL</span>
                        <span>XXL</span>
                    </div>
                </div>
                <div class="quantity">
                    <p style="font-weight: bold; padding-right: 6px;">Количесвто : </p>
                    <input style="width: 50px; text-align: center;" type="number" min="0" value="1">
                </div>
                <p style="color: red;">Пожалуйста, выберите размер</p>
                <div class="product-content-right-product-button">
                    <a href="cart.php"><button><i class="fas fa-shopping-cart"></i><p class="text-uppercase">Купить</p></button></a>
                    <button><p class="text-uppercase">Найти в магазине</p></button>
                </div>
                <div class="product-content-right-product-icon">
                    <div class="product-content-right-product-icon-item"><i class="fas fa-phone-alt"></i> <p>Телефон</p></div>
                    <div class="product-content-right-product-icon-item"><i class="far fa-comments"></i> <p>Чат</p></div>
                    <div class="product-content-right-product-icon-item"><i class="far fa-envelope"></i> <p>Почта</p></div>
                </div>
                <div class="product-content-right-product-QR">
                    <img style="width: 100px;" src="./../images/QR_code.svg" alt="">
                </div>
                <div class="product-content-right-bottom">
<<<<<<< HEAD:product.html
                    <img alt="" class="product-content-right-bottom-top" src="./images/image-down.png">
=======
                    <img class="product-content-right-bottom-top" src="./../images/image-down.png">
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/product.php
                    <div class="product-content-right-bottom-content-big">
                        <div class="product-content-right-bottom-content-title row">
                            <div class="product-content-right-bottom-content-title-item chitiet activeInfBtn">
                                <p>Информация</p>
                            </div>
                            <div class="product-content-right-bottom-content-title-item baoquan">
                                <p>Уход</p>
                            </div>
                        </div>
                        <div class="product-content-right-bottom-content">
                            <div style="font-size: 14px;" class="product-content-right-bottom-content-chitiet">
                                Куртка Little Tweed Jacket является наследием утонченности классической твидовой куртки: круглый воротник, отделка из ткани другого цвета, два накладных кармана спереди и ряд перловых пуговиц придают элегантность дамам.<br><br>
                                Классический твид всегда является олицетворением утонченной и сдержанной элегантности. Поверхность ткани твид слегка рифленая и имеет характерный вид, внутри имеется мягкая шелковая подкладка. Высокое качество материала твид обеспечивает легкость, водоотталкивающие и холодоустойчивые свойства. Особое внимание заслуживает способность «восстанавливать форму» волокон ткани при воздействии острых предметов: достаточно слегка провести рукой, и волокна шерсти переплетутся и займут положение, чтобы полностью закрыть отверстие. Поэтому этот материал действительно является «вечным» и является первоочередным выбором модных домов по всему миру.<br><br>
                                Не только красивый в дизайне и материале, этот комплект одежды также обладает высокой практичностью, подходит для девушек как на работу в офисе, так и для участия в мероприятиях.<br><br>
                                Дизайн представлен в двух вариантах: с яркой белой отделкой и с нежной белой отделкой.<br><br>
                            </div>
                            <div style="font-size: 14px;" class="product-content-right-bottom-content-baoquan">
                                Инструкции по уходу за изделием: <br><br>
                                * Продукты премиум-класса (Senora) и куртки (из шерсти, твида, меха, пуховики) следует чистить только сухим способом, абсолютно нельзя стирать в воде.<br><br>
                                * Трикотаж: после стирки изделие должно сушиться в горизонтальном положении, чтобы избежать растяжения. <br><br>
                                * Вуаль, шелк, шифон следует стирать вручную.<br><br>
                                * Ткань из грубой ткани, туфли и кашемир, не имеющие отделки или украшений из бусин, можно стирать в машине.<br><br>
                                * Ткань из грубой ткани, туфли и кашемир с контрастной отделкой или украшениями из вуали, шелка и бусин следует стирать вручную.<br><br>
                                * Джинсы следует ограничить стиркой в машине, так как это может привести к выцветанию. Если стирать, то стоит выворачивать изделие наизнанку, застегивать пуговицы и молнии, не следует стирать вместе со светлыми вещами, чтобы избежать окрашивания других изделий.<br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product related -->
    <section class="product-related">
        <div class="product-related-title">
            <p class="text-uppercase">Рекомендуем также</p>
        </div>
        <div class="product-content" style="display: flex;">
            <div class="product-related-item">
                <a href="product.php">
                    <img src="../images/sp1.webp" alt="">
                    <h1 class="text-uppercase">Продкута</h1>
                    <p>1000 <sup>rub</sup></p>
                </a>  
            </div>
            <div class="product-related-item">
                <a href="product.php">
                    <img src="../images/sp1.webp" alt="">
                    <h1 class="text-uppercase">Продкута</h1>
                    <p>1000 <sup>rub</sup></p>
                </a>  
            </div>
            <div class="product-related-item">
                <a href="product.php">
                    <img src="../images/sp1.webp" alt="">
                    <h1 class="text-uppercase">Продкута</h1>
                    <p>1000 <sup>rub</sup></p>
                </a>  
            </div>
            <div class="product-related-item">
                <a href="product.php">
                    <img src="../images/sp1.webp" alt="">
                    <h1 class="text-uppercase">Продкута</h1>
                    <p>1000 <sup>rub</sup></p>
                </a>  
            </div>
            <div class="product-related-item">
                <a href="product.php">
                    <img src="../images/sp1.webp" alt="">
                    <h1 class="text-uppercase">Продкута</h1>
                    <p>1000 <sup>rub</sup></p>
                </a>  
            </div>
        </div>
    </section>
    <!-- Container -->
    <section class="app-container">
        <p>Скачать приложение</p>
        <div class="app-google">
<<<<<<< HEAD:product.html
            <img src="images/appstore.png" alt="app logo" loading="lazy">
            <img src="images/googleplay.png" alt="app logo" loading="lazy">
=======
            <img src="../images/appstore.png" alt="">
            <img src="../images/googleplay.png" alt="">
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/product.php
        </div>
        <p>Получение сообщений</p>
        <input type="text" placeholder="Вводите вашу электронную почту..."><i class="fa-solid fa-arrow-left"></i>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-top">
            <li><a href="">Хоанг Ван Куан</a></li>
            <li><a href="">Р3366</a></li>
            <li>
                <a href="" class="fab fa-facebook-f" aria-hidden="true"></a>
                <a href="" class="fab fa-twitter" aria-hidden="true"></a>
                <a href="" class="fab fa-youtube" aria-hidden="true"></a>
            </li>
        </div>
    </footer>
    <script src="./js/script.js" defer></script>
    <script src="https://kit.fontawesome.com/72956b8baa.js" crossorigin="anonymous" defer></script>
</body>
<<<<<<< HEAD:product.html
</html>
=======
<script src="<?php echo '/shop/js/script.js'; ?>"></script>
</html>
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/product.php

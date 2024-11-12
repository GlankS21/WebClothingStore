<?php
include $_SERVER['DOCUMENT_ROOT'] . "/shop/admin/class/brand_class.php";
include $_SERVER['DOCUMENT_ROOT'] . "/shop/admin/class/cartegory_class.php";
?>

<?php
$cartegory = new cartegory;
$show_cartegory = $cartegory -> show_cartegory();
$brand = new brand;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/72956b8baa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo '/shop/css/style.css'; ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <!--------------------------------Header-------------------------------->
    <header>
        <div class="logo">
            <a href="index.php"><img style="width: 6em;" src="../images/logo.png"></a>
        </div>
        <div class="menu-main">
            <div class="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="menu">
                <?php
                if ($show_cartegory) {
                    foreach ($show_cartegory as $result) {
                        $cartegory_id = $result['cartegory_id'];     
                        $cartegory_name = $result['cartegory_name']; 
                        if (strtolower($cartegory_name) == "информация") 
                            echo "<li><a class='text-uppercase' href='information.php'>$cartegory_name</a>";
                        else
                            echo "<li><a class='text-uppercase' href='cartegory.php?id=$cartegory_id'>$cartegory_name</a>";
                        $result_brand = $brand->search_by_cartegory_id($cartegory_id); 
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
            <!-- Mobile Menu -->
            <div class = "sub-mobile-menu">
                <div class="menu-mb">
                    <?php
                    if ($show_cartegory) {
                        foreach ($show_cartegory as $result) {
                            $cartegory_id = $result['cartegory_id'];     
                            $cartegory_name = $result['cartegory_name']; 
                            if (strtolower($cartegory_name) == "информация") 
                                echo "<li><a class='text-uppercase' href='information.php'>$cartegory_name</a>";
                            else
                                echo "<li><a class='text-uppercase' href='cartegory.php?id=$cartegory_id'>$cartegory_name</a>";
                            $result_brand = $brand->search_by_cartegory_id($cartegory_id); 
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
            <li><input placeholder="Search" type="text"> <i class ="fas fa-search"></i></li>
            <li><a class="fa fa-user" href="login.php" ></a></li>
            <li><a class="fa fa-shopping-bag" href="cart.php"></a></li>
        </div>
        
    </header>
    <!--------------------------------Product---------------------------------->
    <section class = "product">
        <div class="container">
            <div class="product-top row">
                <a href="index.php"><p>Menu</p></a><span>&#8594;</span><a href="cartegory.php"><p>ЖЕНЩИНА</p></a><span>&#8594;</span><p>Новинки</p><span>&#8594;</span> <p>Название продукта</p>
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
                    <p>1000<sub>rub</sub></p>
                </div>
                <div class="product-content-right-product-color">
                    <p><span style="font-weight: bold;">Свет</span> : Коричневый</p><span style="color: red;"></span>
                    <div class="product-content-right-product-color-img">
                        <img src="./../images/color004.png" alt="">
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
                    <img class="product-content-right-bottom-top" src="./../images/image-down.png">
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
                    <p>1000 <sub>rub</sub></p>
                </a>  
            </div>
            <div class="product-related-item">
                <a href="product.php">
                    <img src="../images/sp1.webp" alt="">
                    <h1 class="text-uppercase">Продкута</h1>
                    <p>1000 <sub>rub</sub></p>
                </a>  
            </div>
            <div class="product-related-item">
                <a href="product.php">
                    <img src="../images/sp1.webp" alt="">
                    <h1 class="text-uppercase">Продкута</h1>
                    <p>1000 <sub>rub</sub></p>
                </a>  
            </div>
            <div class="product-related-item">
                <a href="product.php">
                    <img src="../images/sp1.webp" alt="">
                    <h1 class="text-uppercase">Продкута</h1>
                    <p>1000 <sub>rub</sub></p>
                </a>  
            </div>
            <div class="product-related-item">
                <a href="product.php">
                    <img src="../images/sp1.webp" alt="">
                    <h1 class="text-uppercase">Продкута</h1>
                    <p>1000 <sub>rub</sub></p>
                </a>  
            </div>
        </div>
    </section>
    <!--------------------------------Container-------------------------------->
    <section class="app-container">
        <p>Скачать приложение</p>
        <div class="app-google">
            <img src="../images/appstore.png" alt="">
            <img src="../images/googleplay.png" alt="">
        </div>
        <p>Получение сообщений</p>
        <input type="text" placeholder="Вводите вашу электронную почту...">
    </section>
    <!--------------------------------Footer-------------------------------->
    <footer>
        <div class="footer-top">
            <li><a href="">Хоанг Ван Куан</a></li>
            <li><a href="">Р3366</a></li>
            <li>
                <a href="" class="fab fa-facebook-f"></a>
                <a href="" class="fab fa-twitter"></a>
                <a href="" class="fab fa-youtube"></a>
            </li>
        </div>
    </footer>
</body>
<script src="<?php echo '/shop/js/script.js'; ?>"></script>
</html>
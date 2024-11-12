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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo '/shop/css/style.css'; ?>">
    <title>Shop-Project</title>
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
    <!--------------------------------About---------------------------------->
    <section id="information">
        <div class="information-content-about-title">
            <div class="information-title"><h1 style="font-weight: bold; text-align: center;">О компании</h1></div>
        </div>
        <div class="information-content-contacts-title" style="display: none;">
            <div class="contacts-title"><h1 style="font-weight: bold; text-align: center;">Контакты</h1></div>
        </div>
        <div class="product-content-title row" style="justify-content: center;">
            <div class="product-content-title about active_InfBtn">
                <button>О компании</button>
            </div>
            <div class="product-content-title contacts">
                <button>Контакты</button>
            </div>
        </div> 
        <div class="information-content-about">
            <div style="border: 1px solid #ddd; margin-bottom: 50px;"></div>
            <div class="about-content">
                <p style="font-weight: bold;">О компании</p> <br><br>
                Компания STOCKMANN была основана в 1862 году в Финляндии, в Хельсинки, и с тех пор началось ее успешное развитие. Сегодня компания работает в Европе и в России: Москве и крупнейших городах — Санкт-Петербурге, Екатеринбурге, Мурманске.<br><br>
                СТОКМАНН предлагает покупателям более 300 брендов мужской, женской и детской одежды, обуви, аксессуаров, товаров для дома. В наших универмагах представлены широко известные международные модные марки, такие как Guess, Тommy Hilfiger, Levi's, Furla и др., популярные скандинавские, новые российские бренды и эксклюзивные марки товаров для дома.<br><br>
                В 2018 году в России открылся интернет-магазин СТОКМАНН. Выход в онлайн стал важным шагом в истории развития компании.<br><br>
                <p style="font-weight: bold; display: inline;">СТОКМАНН</p> — это не только огромный выбор, это чудесная атмосфера комфортного европейского шопинга и удовольствие от покупок.<br><br>
                <p style="font-weight: bold; display: inline;">СТОКМАНН</p> — это возможность оперативно узнавать о новых коллекциях и выгодных акциях, приобретать товары мировых брендов он-лайн, следить за жизнью любимого универмага в социальных сетях.<br><br>
                <p style="font-weight: bold; display: inline;">СТОКМАНН</p> — это модная территория на карте Вашего города, которую мы приглашаем Вас открыть для себя, своей семьи и друзей.<br><br>
            </div>
        </div>
        <div class="information-content-contacts">
            <div style="border: 1px solid #ddd; margin-bottom: 50px;"></div>    
            <div class="contacts-content">
                <div class="contacts-content-item">
                    <p style="font-weight: bold;">Юридический адрес:</p>
                    <p>123610, г. Москва, Краснопресненская набережная, д. 12, офис 1001</p> <br>
                </div>
                <div class="contacts-content-item">
                    <p style="font-weight: bold;">Телефон:</p>
                    <p>8 800 770 09 90</p><br>
                </div>
                <div class="contacts-content-item">
                    <p style="font-weight: bold;">E-mail:</p>
                    <p>email@email.ru</p><br>
                </div>
                <div class="contacts-content-item">
                    <p style="font-weight: bold;">Адрес офиса:</p>
                    <p>г. Москва, Краснопресненская набережная, д. 12</p><br>
                </div>
            </div>
        </div>
    </section>    
    
    <!--------------------------------Container----------------------------->
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
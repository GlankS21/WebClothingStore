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
<htm; lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/72956b8baa.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo '/shop/css/style.css'; ?>">
    <link rel="shortcut icon" type="image/png" href="https://static.vecteezy.com/system/resources/previews/029/752/747/non_2x/question-mark-3d-icon-on-black-circle-png.png"/>
    <title></title>
    <meta name="description" content="">
    <meta property="og:type" content="website">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="https://cdn.bg.ru/bg.ru/post_image-image/ZPDA4etVGCOGyKkvB1BX3w-article.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="https://cdn.bg.ru/bg.ru/post_image-image/ZPDA4etVGCOGyKkvB1BX3w-article.jpg">
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
    <!--------------------------------Cartegory-------------------------------->
    <section class="cartegory">
        <div class="container">
            <div class="cartegory-top row">
                <a href="index.php"><p>Menu</p></a><span>&#8594;</span><a href="cartegory.php"><p>ЖЕНЩИНА</p></a><span>&#8594;</span><p>Новинки</p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="cartegory-left">
                    <ul>
                        <li class="cartegory-left-li"><a href="#">ЖЕНЩИНА</a>
                            <ul>
                                <li><a href="">Новинки</a></li>
                                <li><a href="">Коллекция</a></li>
                                <li><a href="">Верхняя одежда</a></li>
                                <li><a href="">Джинсы</a></li>
                            </ul>
                        </li>
                        <li class="cartegory-left-li"><a href="#">МУЖЧИНА</a>
                            <ul>
                                <li><a href="">Новинки</a></li>
                                <li><a href="">Коллекция</a></li>
                                <li><a href="">Верхняя одежда</a></li>
                                <li><a href="">Джинсы</a></li>
                            </ul>
                        </li>
                        <li class="cartegory-left-li"><a href="#">ДЕТИ</a></li>
                        <li class="cartegory-left-li"><a href="#">КОЛЛЕКЦИЯ</a></li>
                    </ul>
                </div>
                <div class="cartegory-right row">
                    <div class="cartegory-right-top-item">
                        <p>Новинки</p>
                    </div>
                    <div class="cartegory-right-top-item">
                        <select name="" id="">
                            <option value="">Популярные</option>
                            <option value="">Дешевле</option>
                            <option value="">Дороже</option>
                        </select>
                    </div>
                    <div class="cartegory-right-content row">
                        <div class="cartegory-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продукта</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="cartegory-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                    </div>

                    <div class="cartegory-right-bottom row">
                        <div class="cartegory-right-bottom-item">
                            <p><span>&#171;<span>1 2 3 4 5</span>&#187;</span> Дальше</p>
                        </div>
                    </div>
                </div>
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
</htm;>
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
    <script src="https://kit.fontawesome.com/72956b8baa.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo '/shop/css/style.css'; ?>">
    <title>Shop-Project</title>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
<<<<<<< HEAD:payment.html
            <a href="index.html"><img style="width: 6em;" src="images/logo.png" alt="logo" loading="lazy"></a>
=======
            <a href="index.php"><img style="width: 6em;" src="../images/logo.png"></a>
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/payment.php
        </div>
        <div class="menu-main">
            <div class="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="menu">
<<<<<<< HEAD:payment.html
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
                <div class="menu-mb">
                    <li><a href="cartegory.html">ЖЕНЩИНА</a>
                        <ul class="sub-menu-mb">
                            <li><a href="">Новинки</a></li>
                            <li><a href="">Коллекция</a></li>
                            <li><a href="">Верхняя одежда</a></li>
                            <li><a href="">Джинсы</a></li>
                        </ul>
                    </li>
                    <li><a href="">МУЖЧИНА</a>
                        <ul class="sub-menu-mb">
                            <li><a href="">Новинки</a></li>
                            <li><a href="">Коллекция</a></li>
                            <li><a href="">Верхняя одежда</a></li>
                            <li><a href="">Джинсы</a></li>
                        </ul>
                    </li>
                    <li><a href="">ДЕТИ</a></li>
                    <li><a href="">КОЛЛЕКЦИЯ</a></li>
                    <li><a href="information.html">ИНФОРМАЦИЯ</a></li>
=======
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
            <!-- Mobile Menu -->
            <div class = "sub-mobile-menu">
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
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/payment.php
                </div>
            </div>
        </div>
        <div class="others">
<<<<<<< HEAD:payment.html
            <li><input placeholder="Search" type="text"> <i class="fas fa-search"></i></li>
            <li><a class="fa fa-user" href="login.html" aria-hidden="true"></a></li>
            <li><a class="fa fa-shopping-bag" href="cart.html" aria-hidden="true"></a></li>
=======
            <li><input placeholder="Search" type="text"> <i class ="fas fa-search"></i></li>
            <li><a class="fa fa-user" href="login.php" ></a></li>
            <li><a class="fa fa-shopping-bag" href="cart.php"></a></li>
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/payment.php
        </div>
        
    </header>
    <!--------------------------------Delivery---------------------------------->
    <section id="payment">
        <div class="container">
            <div class="payment-top-wrap">
                <div class="payment-top">
                    <div class="payment-top-delivery payment-top-item">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="payment-top-address payment-top-item">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="payment-top-payment payment-top-item">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="payment-content row">
                <div class="payment-content-left">
                    <div class="payment-content-left-method-delivery">
                        <p style="font-weight: bold;">Способ доставки</p>
                        <div class="payment-content-left-method-delivery-item">
                            <input type="radio">
                            <label for="">Экспресс-доставка</label>
                        </div>
                        <p style="font-weight: bold;">Способ оплаты</p>
                        <p style="padding-top: 6px;">Каждая транзакция безопасна и зашифрована. Информация о кредитной карте никогда не будет сохранена.</p>
                        <div class="payment-content-left-method-payment-item">
                            <input name="method-payment" type="radio">
                            <label for="">Оплата кредитной картой (OnePay)</label>
                        </div>   
                        <div class="payment-content-left-method-payment-item-img">
                            <img src="./../images/visa.png" alt="">
                        </div>
                        <div class="payment-content-left-method-payment-item">
                            <input name="method-payment" type="radio">
                            <label for="">Оплата банковской картой (OnePay)</label>
                        </div>   
                        <div class="payment-content-left-method-payment-item-img">
                            <img src="./../images/mastercard.png" alt="">
                        </div>
                        <div class="payment-content-left-method-payment-item">
                            <input name="method-payment" type="radio">
                            <label for="">Наличными</label>
                        </div> 
                    </div>
                </div>
                <div class="payment-content-right">
                    <div class="payment-content-right-button">
                        <input type="text" placeholder="Код скидки/подарок">
                        <button><i class="fas fa-check"></i></button>
                    </div>
                    <div class="payment-content-right-button">
                        <input type="text" placeholder="Код соавтора">
                        <button><i class="fas fa-check"></i></button>
                    </div>
                    <div class="payment-content-right-mnv">
                        <select name="" id="">
                            <option value="">Выберите код лояльности сотрудника</option>
                            <option value="">D345</option>
                            <option value="">A345</option>
                            <option value="">E345</option>
                            <option value="">I345</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="payment-content-right-payment">
                <button class="text-uppercase">Продолжить оплату</button>
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
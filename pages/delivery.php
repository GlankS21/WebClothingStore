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
                </div>
            </div>
        </div>
        <div class="others">
            <li><input placeholder="Search" type="text"> <i class ="fas fa-search"></i></li>
            <li><a class="fa fa-user" href="login.php" ></a></li>
            <li><a class="fa fa-shopping-bag" href="cart.php"></a></li>
        </div>
        
    </header>
    <!--------------------------------Delivery---------------------------------->
    <section id="delivery">
        <div class="container">
            <div class="delivery-top-wrap">
                <div class="delivery-top">
                    <div class="delivery-top-delivery delivery-top-item">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="delivery-top-address delivery-top-item">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="delivery-top-payment delivery-top-item">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="delivery-content" style="display: flex;">
                <div class="delivery-content-left">
                    <p>Пожалуйста, выберите адрес доставки</p>
                    <div class="delivery-content-left-login row">
                        <i class="fas fa-sign-in-alt"></i>
                        <p>Войдите (если у вас уже есть учетная запись)</p>
                    </div>
                    <div class="delivery-content-left-retail" style="display: flex;">
                        <input checked name="loaikhach" type="radio">
                        <p><span style="font-weight: bold;">Розничный покупатель</span> (Если вы не хотите сохранять информацию)</p>
                    </div>
                    <div class="delivery-content-left-regis" style="display: flex;">
                        <input checked name="loaikhach" type="radio">
                        <p><span style="font-weight: bold;">Зарегистрация</span> (Создайте новый аккаунт, используя информацию ниже)</p>
                    </div>
                    <div class="delivery-content-left-input-top row" >
                        <div class="delivery-content-left-input-top-item">
                            <label for="">Фамилия <span style="color: red;"></span></label>
                            <input type="text">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label for="">Имя <span style="color: red;"></span></label>
                            <input type="text">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label for="">Почта <span style="color: red;"></span></label>
                            <input type="text">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label for="">Номер телефона <span style="color: red;"></span></label>
                            <input type="text">
                        </div>
                    </div>
                    <div class="delivery-content-left-input-bottom">
                        <label for="">Адрес<span style="color: red;"></span></label>
                        <input type="text">
                    </div>
                    <div class="delivery-content-left-button" style="display: flex;">
                        <a href="cart.php"><span>&#171;</span><p>Вернуться в корзину</p></a>
                        <a href="payment.php"><button class="text-uppercase">Оплата и доставка</button></a>
                    </div>
                </div>
                <div class="delivery-content-right">
                    <table>
                        <tr>
                            <th>Название</th>
                            <th>Скидка</th>
                            <th>Количество</th>
                            <th>Сумма</th>
                        </tr>
                        <tr>
                            <th style="font-weight: 400;">Рубашка-поло в горизонтальную полоску MS 57E2940</th>
                            <th style="font-weight: 400;">-30%</th>
                            <th style="font-weight: 400;">1</th>
                            <th style="font-weight: 400;">1000 <sup>rub</sup></th>
                        </tr>
                        <tr>
                            <th style="font-weight: 400;">Рубашка-поло в горизонтальную полоску MS 57E2940</th>
                            <th style="font-weight: 400;">-30%</th>
                            <th style="font-weight: 400;">1</th>
                            <th style="font-weight: 400;">1000 <sup>rub</sup></th>
                        </tr>
                        <tr>
                            <th style="font-weight: bold;" colspan="3">Итого</th>
                            <th style="font-weight: bold;"><p>2000 <sup>rub</sup></p></th>
                        </tr>
                    </table>
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
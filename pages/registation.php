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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo '/shop/css/style.css'; ?>">
    <title>Shop-Project</title>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
<<<<<<< HEAD:registation.html
            <a href="index.html"><img style="width: 6em;" src="images/logo.png" alt="logo" loading="lazy"></a>
=======
            <a href="index.php"><img style="width: 6em;" src="../images/logo.png"></a>
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/registation.php
        </div>
        <div class="menu-main">
            <div class="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="menu">
<<<<<<< HEAD:registation.html
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
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/registation.php
                </div>
            </div>
        </div>
        <div class="others">
<<<<<<< HEAD:registation.html
            <li><input placeholder="Search" type="text"> <i class="fas fa-search"></i></li>
            <li><a class="fa fa-user" href="login.html" aria-hidden="true"></a></li>
            <li><a class="fa fa-shopping-bag" href="cart.html" aria-hidden="true"></a></li>
=======
            <li><input placeholder="Search" type="text"> <i class ="fas fa-search"></i></li>
            <li><a class="fa fa-user" href="login.php" ></a></li>
            <li><a class="fa fa-shopping-bag" href="cart.php"></a></li>
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/registation.php
        </div>
        
    </header>
    <!--------------------------------Registation---------------------------------->
    <section id="regis">
       <div class="regis-content row">
           <div class="regis-content-left">
                <div class="regis-content-left-title"><h4>Информация о клиенте</h4></div>
                <div class="regis-content-left-block row">
                    <div class="regis-content-left-form">
                        <label>Фамилия:<span style="color: red">*</span></label>
                        <input type="text" class="form-control" value="" name="customer_firstname" placeholder="Фамилия..." style="width: 100%">
                    </div>
                    <div class="regis-content-left-form">
                        <label>Имя:<span style="color: red">*</span></label>
                        <input type="text" class="form-control" value="" name="customer_firstname" placeholder="Имя..." style="width: 100%">
                    </div>
                </div>
                <div class="regis-content-left-block row">
                    <div class="regis-content-left-form">
                        <label>Почта:<span style="color: red">*</span></label>
                        <input type="text" class="form-control" value="" name="customer_firstname" placeholder="Почта..." style="width: 100%">
                    </div>
                    <div class="regis-content-left-form">
                        <label>Телефон:<span style="color: red">*</span></label>
                        <input type="text" class="form-control" value="" name="customer_firstname" placeholder="Телефон..." style="width: 100%">
                    </div>
                </div>
                <div class="regis-content-left-block row">
                    <div class="regis-content-left-form">
                        <label>День рождения:<span style="color: red">*</span></label>
                        <input type="text" class="form-control" value="" name="customer_firstname" placeholder="День рождения..." style="width: 100%">
                    </div>
                    <div class="regis-content-left-form">
                        <label>Пол:<span style="color: red">*</span></label>
                        <select name="customer_sex" style="width: 100%" class="form-control">
                            <option value="0">Женщина</option>
                            <option value="1">Мужчина</option>
                            <option value="2">Другое</option>
                        </select>
                    </div>
                </div>
                <div class="regis-content-left-block row">
                    <div class="regis-content-left-form">
                        <label>Адрес:<span style="color: red">*</span></label>
                        <textarea class="form-control" name="address"></textarea>
                    </div>
                </div>
           </div>
           <div class="regis-content-right">
                <div class="regis-content-right-title"><h4>Информация о пароле</h4></div>
                <div class="regis-content-left-block row">
                    <div class="regis-content-right-form">
                        <label>Пароль:<span style="color: red">*</span></label>
                        <input class="form-control" type="password" value="" name="customer_pass1" placeholder="Пароль...">
                    </div>
                </div>
                <div class="regis-content-left-block row">
                    <div class="regis-content-right-form">
                        <label>Повторите пароль<span style="color: red">*</span></label>
                        <input class="form-control" type="password" value="" name="customer_pass1" placeholder="Повторите пароль...">
                    </div>
                </div>
                <div class="regis-content-left-block row">
                    <div class="regis-content-right-form">
                        <input class="form-check-input checkboxs" type="checkbox" name="customer_agree" value="1" id="defaultCheck1">
                        <label style="margin-top: 4px;margin-left: 3px;" class="form-check-label" for="defaultCheck1">
                            <span> Согласен с <a style="color: #f31f1f" href="">условиями</a> магазина</span>
                        </label>
                    </div>
                </div>
                <div class="regis-content-left-block row">
                    <div class="regis-content-right-button">
                        <button id="bnt_register" class="btn btn--large" type="submit" style="width: 100%;margin-top: 15px">Регистрация</button>
                    </div>
                </div>
           </div>
       </div>
    </section>
    <!-- Container -->
    <section class="app-container">
        <p>Скачать приложение</p>
        <div class="app-google">
<<<<<<< HEAD:registation.html
            <img src="images/appstore.png" alt="app logo" loading="lazy">
            <img src="images/googleplay.png" alt="app logo" loading="lazy">
=======
            <img src="../images/appstore.png" alt="">
            <img src="../images/googleplay.png" alt="">
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/registation.php
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
<<<<<<< HEAD:registation.html
=======
<script src="<?php echo '/shop/js/script.js'; ?>"></script>
>>>>>>> 80e55b1f2531c408a0fe20e86d9df92190fd6339:pages/registation.php
</html>
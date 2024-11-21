<?php
session_start(); 
ob_start();    

include $_SERVER['DOCUMENT_ROOT'] . "/shop/admin/class/brand_class.php";
include $_SERVER['DOCUMENT_ROOT'] . "/shop/admin/class/category_class.php";
include $_SERVER['DOCUMENT_ROOT'] . "/shop/admin/class/user_class.php";

$category = new category();
$show_category = $category->show_category();
$brand = new brand();
$user = new user();

if (isset($_POST['login']) && $_POST['login']) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $user->check_user($username, $password);

    if ($role === '1') { 
        $_SESSION['logged_in'] = true;  
        $_SESSION['role'] = 1;           
        $_SESSION['username'] = $username;  
        header('Location: http://localhost/shop/admin/brandlist.php');
        exit();
    } elseif ($role === '0') { 
        $_SESSION['logged_in'] = true;  
        $_SESSION['role'] = 0;           
        $_SESSION['username'] = $username;  
        header('Location: http://localhost/shop/pages/index.php');
        exit();
    } else { 
        $txt_erro = "Имя пользователя или пароль неверны";
    }
}

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
    <!--------------------------------Login---------------------------------->
    <section id="login">
       <div class="container row">
            <div class="login-container-left">
                <h1>У вас уже есть аккаунт ? </h1> <br>
                <p>Если у вас уже есть аккаунт, войдите в систему, чтобы накапливать баллы за участие и получать более выгодные предложения!</p><br>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="login-form" method="post">
                    <input type="text" class="login-email" name="username" placeholder="Email" required>
                    <input type="password" class="login-email" name="password" placeholder="Password" required>
                    <?php
                        if (isset($txt_erro)) {
                            echo "<p style='color:red;'>$txt_erro</p>";
                        }
                    ?>
                    <div class="login-container-left-remember">
                        <label>
                            <input class="checkboxs" value="1" name="customer_remember" type="checkbox">
                            <span style="margin-left: 5px;">Запомнить меня</span>
                        </label>
                        <a style="text-align: right; text-decoration: underline;" class="auth__form__link" href="registation.php">Забыли пароль?</a>
                    </div>
                    <br>
                    <input style="background-color: #000; color: #fff; cursor: pointer;" type="submit" name="login" class="login-button text-uppercase" value="Логин">
                </form>

            </div>
            <div class="login-container-right">
                <h1>Новый клиент</h1><br>
                <p>Если у вас еще нет аккаунта, используйте этот вариант, чтобы перейти к форме регистрации. Предоставив свои данные, процесс покупки станет более приятным и быстрым!</p> <br>
                <a href="registation.php"><button class="text-uppercase">Регистрация</button></a>
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
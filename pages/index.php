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
    <!--------------------------------Slider-------------------------------->
    <section id="Slider">
        <div class="aspect-ratio-169">
            <img src="../images/banner1.png">
            <img src="../images/banner2.png">
            <img src="../images/banner3.png">
            <img src="../images/banner4.png">
        </div>
        <div class="dot-container">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
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
        <input type="text" placeholder="Вводите вашу электронную почту..."><i class="fa-solid fa-arrow-left"></i>
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
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
    <!--------------------------------Cart---------------------------------->
    <section id="cart">
        <div class="container">
            <div class="cart-top-wrap">
                <div class="cart-top">
                    <div class="cart-top-cart cart-top-item">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="cart-top-address cart-top-item">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="cart-top-payment cart-top-item">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="cart-content" style="display: flex;">
                <div class="cart-content-left">
                    <table>
                        <tr>
                            <th>Продукт</th>
                            <th>Название продукта</th>
                            <th>Свет</th>
                            <th>Размер</th>
                            <th>Количество</th>
                            <th>Цена</th>
                            <th>Удалить</th>
                        </tr>
                        <tr>
                            <td><img src="../images/sp1.webp" alt=""></td>
                            <td class="mobie-desc"><p>Little Tweed Jacket</p></td>
                            <td class="mobie-desc"><p>Color: <img src="../images/color004.png" alt=""></p></td>
                            <td class="mobie-desc"><p style="display: inline;">Size: <p style="display: inline;">L</p></p></td>
                            <td class="mobie-desc"><p>Количество: <input type="number" value="1" min="1"></p></td>
                            <td class="mobie-desc"><p style="display: inline;">Цена: <p style="color:rgb(172, 47, 51); display: inline;">1000 <sub>rub</sub></p></p></td>
                            <td class="mobie-desc" style="text-align: right;"><br><i class="fa-solid fa-trash-can"></i></td>
                            <td class="deskop-desc"><p>Little Tweed Jacket</p></td>
                            <td class="deskop-desc"><img src="../images/color004.png" alt=""></td>
                            <td class="deskop-desc"><p>L</p></td>
                            <td class="deskop-desc"><input type="number" value="1" min="1"></td>
                            <td class="deskop-desc"><p>1000 <sub>rub</sub></p></td>
                            <td class="deskop-desc"><i class="fa-solid fa-trash-can"></i></td>
                        </tr>
                        <tr>
                            <td><img src="./../images/sp1.webp" alt=""></td>
                            <td class="mobie-desc"><p>Little Tweed Jacket</p></td>
                            <td class="mobie-desc"><p>Color: <img src="../images/color004.png" alt=""></p></td>
                            <td class="mobie-desc"><p style="display: inline;">Size: <p style="display: inline;">L</p></p></td>
                            <td class="mobie-desc"><p>Количество: <input type="number" value="1" min="1"></p></td>
                            <td class="mobie-desc"><p style="display: inline;">Цена: <p style="color:rgb(172, 47, 51); display: inline;">1000 <sub>rub</sub></p></p></td>
                            <td class="mobie-desc" style="text-align: right;"><br><i class="fa-solid fa-trash-can"></i></td>
                            <td class="deskop-desc"><p>Little Tweed Jacket</p></td>
                            <td class="deskop-desc"><img src="../images/color004.png" alt=""></td>
                            <td class="deskop-desc"><p>L</p></td>
                            <td class="deskop-desc"><input type="number" value="1" min="1"></td>
                            <td class="deskop-desc"><p>1000 <sub>rub</sub></p></td>
                            <td class="deskop-desc"><i class="fa-solid fa-trash-can"></i></td>
                        </tr>
                    </table>
                </div>
                <div class="cart-content-right">
                    <table>
                        <tr>
                            <th class="text-uppercase" colspan="2">Сумма</th>
                        </tr>
                        <tr>
                            <td class="text-uppercase">Количество товара</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td class="text-uppercase">Общая сумма</td>
                            <td><p>2000 <sub>rub</sub></p></td>
                        </tr>
                        <tr>
                            <td class="text-uppercase">Итого</td>
                            <td><p style="color: #000; font-weight: bold;">2000 <sub>rub</sub></p></td>
                        </tr>
                    </table>
                    <div class="cart-content-right-text">
                        <p>Вы получите бесплатную доставку при общей стоимости заказа более 2500 рублей.</p>
                        <p style="color: red; font-weight: bold;">Купить больше <span style="font-size: 18px;">500 rub</span></p>
                    </div>
                    <div class="cart-content-right-button">
                        <button class="text-uppercase"><a href="cartegory.php">Продолжить покупку</a></button>
                        <a href="delivery.php"><button class="text-uppercase">Платить</button></a>
                    </div>
                    <div class="cart-content-right-login">
                        <p class="text-uppercase">Аккаунт</p><br>
                        <p><a href="">Войдите </a>в свой аккаунт, чтобы заработать членские баллы</p>
                    </div>
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
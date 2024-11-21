<?php
include $_SERVER['DOCUMENT_ROOT'] . "/shop/admin/class/brand_class.php";
include $_SERVER['DOCUMENT_ROOT'] . "/shop/admin/class/category_class.php";
include $_SERVER['DOCUMENT_ROOT'] . "/shop/admin/class/product_class.php";
?>

<?php
$category = new category;
$show_category = $category -> show_category();
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
                if ($show_category) {
                    foreach ($show_category as $result) {
                        $category_id = $result['category_id'];     
                        $category_name = $result['category_name']; 
                        if (strtolower($category_name) == "информация") 
                            echo "<li><a class='text-uppercase' href='information.php'>$category_name</a>";
                        else
                            echo "<li><a class='text-uppercase'>$category_name</a>";
                        $result_brand = $brand->search_by_category_id($category_id); 
                        if ($result_brand && $result_brand->num_rows > 0) {
                            echo "<ul class='sub-menu'>";
                            while ($brand_row = $result_brand->fetch_assoc()) { 
                                $brand_name = $brand_row['brand_name'];
                                $brand_id = $brand_row['brand_id'];
                                echo "<li><a href='category.php?id=$category_id&brand_id=$brand_id'>$brand_name</a></li>";
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
    <!--------------------------------category-------------------------------->
    <section class="category">
        <div class="container">
            <div class="category-top row">
            <?php
                $current_category_id = $_GET['id'] ?? '';
                $current_brand_id = $_GET['brand_id'] ?? '';
                $current_category_name = '';
                $current_brand_name = '';
                if ($show_category) {
                    foreach ($show_category as $category_item) {
                        if ($category_item['category_id'] == $current_category_id) {
                            $current_category_name = $category_item['category_name'];  
                            if ($current_brand_id) {
                                $brand_result = $brand->search_by_category_id($current_category_id);
                                while ($brand_row = $brand_result->fetch_assoc()) {
                                    if ($brand_row['brand_id'] == $current_brand_id) {
                                        $current_brand_name = $brand_row['brand_name'];
                                        break; 
                                    }
                                }
                            }
                            break;  
                        }
                    }
                }
                echo "<a href='index.php'><p>Menu</p></a> <span>&#8594;</span>";
                if ($current_category_id && $current_category_name) {
                    echo "<a href='category.php?id=$current_category_id'><p>$current_category_name</p></a>";
                }
                if ($current_brand_id && $current_brand_name) {
                    echo " <span>&#8594;</span> <a href='category.php?id=$current_category_id&brand_id=$current_brand_id'><p>$current_brand_name</p></a>";
                }
            ?>

            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="category-left">
                    <ul>
                        <?php
                        if ($show_category) {
                            foreach ($show_category as $result) {
                                $category_id = $result['category_id'];     
                                $category_name = $result['category_name']; 
                                if (strtolower($category_name) != "Информация") 
                                    echo "<li class='category-left-li text-uppercase'><a href='#'>$category_name</a>";
                                $result_brand = $brand->search_by_category_id($category_id); 
                                if ($result_brand && $result_brand->num_rows > 0) {
                                    echo "<ul>";
                                    while ($brand_row = $result_brand->fetch_assoc()) { 
                                        $brand_name = $brand_row['brand_name'];
                                        $brand_id = $brand_row['brand_id'];
                                        echo "<li style='text-transform: none;'><a href='category.php?id=$category_id&brand_id=$brand_id'>$brand_name</a></li>";
                                    }
                                    echo "</ul>";
                                }
                                echo "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="category-right row">
                    <div class="category-right-top-item">
                        <?php
                            echo "<p>$current_brand_name</p>";
                        ?>
                    </div>
                    <div class="category-right-top-item">
                        <select name="" id="">
                            <option value="">Популярные</option>
                            <option value="">Дешевле</option>
                            <option value="">Дороже</option>
                        </select>
                    </div>
                    <div class="category-right-content row">
                        <?php
                        $product = new product();
                        $current_product = $product->show_product_by_brand($current_category_id, $current_brand_id);
                        if ($current_product) {
                            foreach ($current_product as $result) {
                                $product_id = htmlspecialchars($result['product_id']);
                                $product_img = htmlspecialchars($result['product_img']);
                                $product_name = htmlspecialchars($result['product_name']);
                                $product_price = htmlspecialchars($result['product_price']);
                                echo "<div class='category-right-content-item'>";
                                echo "<a href='product.php?id=$current_category_id&brand_id=$current_brand_id&product_id=$product_id'>";
                                echo "<img src='../admin/uploads/$product_img' alt='$product_name'>";
                                echo "<h1>$product_name</h1>";
                                echo "</a>";
                                echo "<p>$product_price<sup>rub</sup></p>";
                                echo "</div>";
                            }
                        }
                        ?>
                        <div class="category-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продукта</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="category-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="category-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="category-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="category-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="category-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="category-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                        <div class="category-right-content-item">
                            <a href="product.php">
                                <img src="../images/sp1.webp" alt="">
                                <h1>Название продкута</h1>
                            </a>
                            <p>999<sup>rub</sup></p>
                        </div>
                    </div>

                    <div class="category-right-bottom row">
                        <div class="category-right-bottom-item">
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
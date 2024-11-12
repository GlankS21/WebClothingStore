<?php
include "header.php";
include "slider.php";
include "class/product_class.php";
?>
<?php
$product = new product();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // echo'<pre>';
    // echo print_r($_FILES['product_img_desc']['name']);
    // echo'</pre>';
    $insert_product = $product -> insert_product($_POST, $_FILES);
}
?>

<div class="admin-content-right" style="margin-bottom: 50px;">
            <div class="admin-content-right-product_add">
                <h1>Добавить товар</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Вводите название товара <span style="color: red;">*</span></label>
                    <input name="product_name" required type="text" placeholder="Вводите название товара">
                    <label for="">Выбирать каталог<span style="color: red;">*</span></label>
                    <select name="cartegory_id" id="">
                        <option value="#">--Выбирать--</option>
                        <?php
                        $show_cartegory = $product -> show_cartegory();
                        if($show_cartegory){
                            while($result = $show_cartegory -> fetch_assoc()){                            
                        ?>
                        <option value="<?php echo $result['cartegory_id']?>"><?php echo $result['cartegory_name']?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <label for="">Выбирать тип каталога <span style="color: red;">*</span></label>
                    <select name="brand_id" id="">
                        <option value="#">--Выбирать--</option>
                        <?php
                        $show_brand = $product -> show_brand();
                        if($show_brand){
                            while($result = $show_brand -> fetch_assoc()){                            
                        ?>
                        <option value="<?php echo $result['brand_id']?>"><?php echo $result['brand_name']?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <label for="">Цена товара<span style="color: red;">*</span></label>
                    <input name="product_price" required type="text" placeholder="Цена товара">
                    <label for="">Скидка<span style="color: red;">*</span></label>
                    <input name="product_price_new" required type="text" placeholder="Скидка">
                    <label for="">Описание товара<span style="color: red;">*</span></label>
                    <textarea name="product_desc" id="" cols="30" rows="10" placeholder="Описание товара"></textarea>
                    <label for="">Фото товара<span style="color: red;">*</span></label>
                    <input name="product_img" required type="file">
                    <label for="">Фото описания товара<span style="color: red;">*</span></label>
                    <input name="product_img_desc[]" required multiple type="file">
                    <button type="submit">Добавить</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<style>
    .admin-content-right-product_add h1{
        margin-bottom: 20px;
    }
    .admin-content-right-product_add input, select{
        width: 200px;
        height: 30px;
        display: block;
        margin: 6px 0 12px;
        padding-left: 12px;
    }
    .admin-content-right-product_add textarea{
        display: block;
        height: 200px;
        width: 500px;
        margin: 6px 0 12px;
        padding: 6px 12px;
    }
    .admin-content-right-product_add button{
        display: block;
        margin-top: 10px;
        height: 30px;
        width: 100px;
        cursor: pointer;
        color: var(--while-color);
        background-color: var(--back-color);
        transition: all 0.3s ease;
    }
    .admin-content-right-product_add button:hover{
        color: var(--back-color);
        background-color: var(--while-color);
    }
</style>
<?php
include "header.php";
include "slider.php";
include "class/brand_class.php";
?>
<?php
$brand = new brand;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cartegory_id = $_POST['cartegory_id'];
    $brand_name = $_POST['brand_name'];
    $insert_brand = $brand -> insert_brand($cartegory_id, $brand_name);
}
?>

<div class="admin-content-right">
            <div class="admin-content-right-brand_list">
                <h1>Добавить тип каталога</h1> <br>
                <form action="" method="POST">
                    <select name="cartegory_id" id="">
                        <option value="#">--Добавить тип каталога</option>
                        <?php
                        $show_cartegory = $brand->show_cartegory();
                        if($show_cartegory){
                            while($result = $show_cartegory -> fetch_assoc()){                            
                        ?>
                        <option value="<?php echo $result['cartegory_id']?>"><?php echo $result['cartegory_name']?></option>
                        <?php
                            }
                        }
                        ?>
                    </select> <br>
                    <input require type="text" name="brand_name" id="" placeholder="Вводите тип каталога">
                    <button type="submit">Добавить</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<style>
    .admin-content-right-brand_list select{
        height: 30px;
        width: 250px;
        margin: 0 !important;
    }
    .admin-content-right-brand_list input{
        height: 30px;
        width: 250px;
        padding-left: 12px;
        margin-top: 0 !important;
        margin-bottom: 6px;
    }
    button{
        display: block;
        margin-top: 10px;
        height: 30px;
        width: 100px;
        cursor: pointer;
        color: var(--while-color);
        background-color: var(--back-color);
        transition: all 0.3s ease;
    }
    button:hover{
        color: var(--back-color);
        background-color: var(--while-color);
    }
</style>
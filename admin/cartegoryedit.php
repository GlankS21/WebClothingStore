<?php
include "header.php";
include "slider.php";
include "class/cartegory_class.php";
?>
<?php 
$cartegory = new cartegory();
if(!isset($_GET['cartegory_id']) || $_GET['cartegory_id'] == NULL){
    echo "<script>window.location = 'cartegorylist.php'</script>";
}
else{
    $cartegory_id = $_GET['cartegory_id'];
}
$get_cartegory = $cartegory ->get_cartegory($cartegory_id); 
if($get_cartegory){
    $result = $get_cartegory -> fetch_assoc();
}
?>
<?php
$cartegory = new cartegory;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cartegory_name = $_POST['cartegory_name'];
    $update_cartegory = $cartegory -> update_cartegory($cartegory_name, $cartegory_id);
}
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory_add">
                <h1>Добавить каталог</h1>
                <form action="" method="POST">
                    <input required name="cartegory_name" type="text" placeholder="Вводите название каталога" value="<?php echo $result['cartegory_name']?>">
                    <button type="submit">Исправить</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>


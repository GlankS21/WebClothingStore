<?php
include "header.php";
include "slider.php";
include "class/cartegory_class.php";
?>
<?php
$cartegory = new cartegory
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cartegory_name = $_POST['cartegory_name'];
    $insert_cartegory = $cartegory -> insert_cartegory($cartegory_name);
}
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory_add">
                <h1>Them danh muc</h1>
                <form action="" method="POST">
                    <input name="cartergory_name" type="text" placeholder="Nhap ten danh muc">
                    <button type="submit">Add</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<?php
include "header.php";
include "slider.php";
include "class/cartegory_class.php";
?>
<?php
$cartegory = new cartegory();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cartegory_name = $_POST['cartegory_name'];
    $insert_cartegory = $cartegory -> insert_cartegory($cartegory_name);
}
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory_add">
                <h1>Добавить каталог</h1>
                <form action="" method="POST">
                    <input name="cartegory_name" type="text" placeholder="Вводите название каталога" required>
                    <button type="submit">Добавить</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<style>
    .admin-content-right-cartegory_add input{
    height: 30px;
    width: 250px;
    padding-left: 12px;
    margin-top: 20px;
    }
    .admin-content-right-cartegory_add button{
        display: block;
        margin-top: 10px;
        height: 30px;
        width: 100px;
        cursor: pointer;
        color: var(--while-color);
        background-color: var(--back-color);
        transition: all 0.3s ease;
    }
    .admin-content-right-cartegory_add button:hover{
        color: var(--back-color);
        background-color: var(--while-color);
    }
</style>
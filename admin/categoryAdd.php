<?php
include "header.php";
include "slider.php";
include "class/category_class.php";
?>
<?php
$category = new category();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $category_name = $_POST['category_name'];
    $insert_category = $category -> insert_category($category_name);
}
?>

<div class="admin-content-right">
            <div class="admin-content-right-category_add">
                <h1>Добавить каталог</h1>
                <form action="" method="POST">
                    <input name="category_name" type="text" placeholder="Вводите название каталога" required>
                    <button type="submit">Добавить</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<style>
    .admin-content-right-category_add input{
    height: 30px;
    width: 250px;
    padding-left: 12px;
    margin-top: 20px;
    }
    .admin-content-right-category_add button{
        display: block;
        margin-top: 10px;
        height: 30px;
        width: 100px;
        cursor: pointer;
        color: var(--while-color);
        background-color: var(--back-color);
        transition: all 0.3s ease;
    }
    .admin-content-right-category_add button:hover{
        color: var(--back-color);
        background-color: var(--while-color);
    }
</style>
<?php
include "header.php";
include "slider.php";
include "class/product_class.php";
?>
<?php
$product = new product;
$show_product = $product-> show_product();
?>
<div class="admin-content-right">
    <div class="admin-content-right-category_list">
        <h1>Список тип продукта</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>ID каталога</th>
                <th>ID типа каталога</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Цена - скидка</th>
                <th>Описание</th>
                <th>Операция</th>
            </tr>
            <?php
            if ($show_product) {
                $i = 0;
                while ($result = $show_product->fetch_assoc()) { 
                    $i++;
            ?>
            <tr>
                <td><?php echo $result['product_id']; ?></td>
                <td><?php echo $result['category_name']; ?></td>
                <td><?php echo $result['brand_name']; ?></td>
                <td><?php echo $result['product_name']; ?></td>
                <td><?php echo $result['product_price']; ?></td>
                <td><?php echo $result['product_price_new']; ?></td>
                <td><?php echo $result['product_desc']; ?></td>
                <td>
                    <a href="productdelete.php?product_id=<?php echo $result['product_id']; ?>">Удалить</a>
                </td>
            </tr>
            <?php 
                }
            }
            ?>
        </table>
    </div>
</div>
</section>
</body>
</html>
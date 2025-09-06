<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../service/productService.php';
$service = new ProductService($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $service->insert_product();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $service->delete_product($_POST['delete']);
}
$products = $service->show_product();
$categories = $service->show_category();
$sizes = $service->show_size();
$color = $service->show_color();
$brands = [];
if (isset($_POST['category_id']) && is_numeric($_POST['category_id'])) {
    $brands = $service->show_brand((int)$_POST['category_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
    <div id="header">
        <h1>SHOP MANAGER</h1>
        <a href="../../public/index.php"><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
    <section>
        <ul class="navigation">
            <li onclick="window.location.href='categoryManager.php'">CATEGORY</li>
            <li onclick="window.location.href='brandManager.php'">BRAND</li>
            <li style="background-color: #34495e;">PRODUCT</li>
        </ul>
        <div class="content">
            <h2>ADD PRODUCT</h2>
            <form action="productManager.php" method="post" enctype="multipart/form-data" class="product-form">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" required>
                <!-- Category -->
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" required>
                    <option value="">-- Choose Category --</option>
                    <?php foreach($categories as $category): ?>
                        <option value="<?= $category['category_id'] ?>"><?= htmlspecialchars($category['category_name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <!-- BrandBrand -->
                <label for="brand_id">Brand</label>
                <select name="brand_id" id="brand_id" required>
                </select>
                <!-- Price -->
                <label for="price">Price</label>
                <input type="number" name="price" id="price" required>
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4"></textarea>
                <!-- Image -->
                <label for="product_img">Image</label>
                <input type="file" name="product_img" id="product_img" accept="image/*" required>
                <label for="product_img_desc">Image description (3)</label>
                <input type="file" name="product_img_desc[]" id="product_img_desc" multiple accept="image/*">
                <!-- Size + Color -->
                <label for="size">Size</label>
                <div id="size-options">
                    <?php foreach ($sizes as $size): ?>
                        <label style="display:inline-flex;align-items:center;margin:5px 10px;cursor:pointer;">
                            <input type="checkbox" name="size[]" value="<?= $size['id'] ?>" style="margin-right:6px;">
                            <?= htmlspecialchars($size['name']) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
                <label for="color">Color</label>
                <div id="color-options">
                    <?php foreach ($color as $c): ?>
                        <label style="display:inline-flex;align-items:center;margin:5px 10px;cursor:pointer;">
                            <input type="checkbox" name="color[]" value="<?= $c['id'] ?>" style="margin-right:6px;">
                            <span style="display:inline-block;width:16px;height:16px;background:<?= $c['hex_code'] ?>;border:1px solid #ccc;margin-right:6px;"></span>
                            <?= htmlspecialchars($c['name']) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
                <button type="submit" name="add_product">Добавить</button>
            </form>
            <h2>PRODUCT LIST</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Image</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $row): ?>
                            <tr>
                                <td><?= $row['product_id'] ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= $row['price'] ?></td>
                                <td><?= htmlspecialchars($row['category_name']) ?></td>
                                <td><?= htmlspecialchars($row['brand_name']) ?></td>
                                <td><img src="../uploads/<?= htmlspecialchars($row['image']) ?>" width="60"></td>
                                <td class="actions">
                                    <form method="POST" onsubmit="return confirm('Xác nhận xóa sản phẩm này?')">
                                        <input type="hidden" name="delete" value="<?= $row['product_id'] ?>">
                                        <button type="submit">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7">No products</td></tr>
                    <?php endif; ?>
                </tbody>
            </table> 
        </div>
    </section>
    <script src="https://kit.fontawesome.com/72956b8baa.js" crossorigin="anonymous"></script>
</body>
<script>
document.getElementById('category_id').addEventListener('change', function () {
    const categoryId = this.value;
    const brandSelect = document.getElementById('brand_id');
    brandSelect.innerHTML = '<option>Loading...</option>';
    fetch('get_brands.php?category_id=' + categoryId).then(response => response.text())
    .then(data => {
        brandSelect.innerHTML = data;
    })
    .catch(error => {
        brandSelect.innerHTML = '';
        console.error('ERROR:', error);
    });
});
</script>

</html>

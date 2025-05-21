<?php
require_once '../config/config.php';
require_once '../service/brandService.php';
$brand = new BrandService($conn); 
$categories = $brand->show_category();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $brand->insert_brand($_POST['category_id'], $_POST['brand_name']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } elseif (isset($_POST['update'])) {
        $brand->update_brand($_POST['category_id'], $_POST['brand_name'], $_POST['brand_id']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } elseif (isset($_POST['brand-delete'])) {
        $brand->delete_brand($_POST['brand_id']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
$brands = $brand->show_brand();
$editing = null;
if (isset($_GET['edit'])) {
    $editing = $brand->get_brand($_GET['edit']); 
}
$grouped_brands = [];
foreach ($brands as $b) {
    $grouped_brands[$b['category_name']][] = $b;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Manager</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <h1>SHOP MANAGER</h1>
    <section>
        <ul class="navigation">
            <li onclick="window.location.href='categoryManager.php'">CATEGORY</li>
            <li style="background-color: #34495e;">BRAND</li>
            <li onclick="window.location.href='productManager.php'">PRODUCT</li>
            <li onclick="window.location.href='userManager.php'">USER CART</li>
        </ul>
        <div class="content">
          <h2><?= $editing ? "EDIT BRAND" : "ADD BRAND" ?></h2>
            <form method="POST">
                <input type="hidden" name="brand_id" value="<?= $editing['brand_id'] ?? '' ?>">
                <label>Category</label>
                <select class="select-category" name="category_id" required>
                    <option value="">-- Choose Category --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['category_id'] ?>" 
                            <?= isset($editing) && $editing['category_id'] == $cat['category_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['category_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Brand Name</label>
                <input type="text" name="brand_name" value="<?= $editing['brand_name'] ?? '' ?>" required>
                <button type="submit" name="add" <?= $editing ? 'disabled style="opacity: 0.5; cursor: not-allowed;"' : '' ?>>Добавить</button>
                <button type="submit" name="update" <?= !$editing ? 'disabled style="opacity: 0.5; cursor: not-allowed;"' : '' ?>>Обновить</button>
            </form>

            <h2>BRAND LIST</h2>
            <?php foreach ($grouped_brands as $category_name => $category_brands): ?>
                <h3><?= htmlspecialchars($category_name) ?></h3>
                <table>
                    <thead>
                        <tr>
                            <th>Brand ID</th>
                            <th>Brand Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($category_brands as $b): ?>
                        <tr>
                            <td><?= $b['brand_id'] ?></td>
                            <td><?= htmlspecialchars($b['brand_name']) ?></td>
                            <td class="actions">
                                <form method="GET" style="display:inline;">
                                    <input type="hidden" name="edit" value="<?= $b['brand_id'] ?>">
                                    <button type="submit" name="brand-edit">Изменить</button>
                                </form>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="brand_id" value="<?= $b['brand_id'] ?>">
                                    <button type="submit" name="brand-delete" onclick="return confirm('Delete this brand?')">Удалить</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>

        </div>
    </section>
</body>
</html>

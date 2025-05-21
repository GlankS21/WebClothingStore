<?php
require_once '../config/config.php';
require_once '../service/categoryService.php';
$categoryClass = new CategoryService($conn);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_category'])) {
        $category_name = $_POST['category_name'];
        $categoryClass->categoryAdd($category_name);
    }
    if (isset($_POST['delete_category'])) {
        $category_id = $_POST['category_id'];
        $categoryClass->categoryDelete($category_id);
    }
}
$categories = $categoryClass->getCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <h1>SHOP MANAGER</h1>
    <section>
        <ul class="navigation">
            <li style="background-color: #34495e;">CATEGORY</li>
            <li onclick="window.location.href='brandManager.php'">BRAND</li>
            <li onclick="window.location.href='productManager.php'">PRODUCT</li>
            <li onclick="window.location.href='userManager.php'">USER CART</li>
        </ul>
        <div class="content">
            <h2>ADD CATEGORY</h2>
            <form action="" method="POST">
                <label for="category_name">Category Name</label>
                <input type="text" id="category_name" name="category_name" required>
                <button type="submit" name="add_category">Добавить</button>
            </form>
            <h2>CATEGORIES LIST</h2>
            <table>
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= htmlspecialchars($category['category_id']) ?></td>
                        <td><?= htmlspecialchars($category['category_name']) ?></td>
                        <td class="actions">
                            <!-- Delete Category Form -->
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>">
                                <button type="submit" name="delete_category" onclick="return confirm('Are you sure you want to delete this category?');">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>

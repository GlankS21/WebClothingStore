<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../service/cartService.php';
$service = new CartService($conn);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $users = $service->search_by_id($_POST['user_id']);
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
    <h1>SHOP MANAGER</h1>
    <section>
        <ul class="navigation">
            <li onclick="window.location.href='categoryManager.php'">CATEGORY</li>
            <li onclick="window.location.href='brandManager.php'">BRAND</li>
            <li style="window.location.href='productManager.php'">PRODUCT</li>
            <li onclick="background-color: #34495e;">USER CART</li>
        </ul>
        <div class="content">
            <h2>SEARCH USER</h2>
            <form action="userManager.php" method="post" enctype="multipart/form-data" class="user-form">
                <label for="name">User Name</label>
                <input type="text" name="name" id="name" required>
                <button type="submit" name="add_product">Найти</button>
            </form>
            <h2>PRODUCT LIST</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID user</th>
                        <th>ID product</th>
                        <th>ID color</th>
                        <th>ID size</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['user_id'] ?></td>
                                <td><?= $user['product_id'] ?></td>
                                <td><?= $user['color_id'] ?></td>
                                <td><?= $user['size_id'] ?></td>
                                <td><?= $user['quantity'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5">No products</td></tr>
                    <?php endif; ?>
                </tbody>
            </table> 
        </div>
    </section>
</body>

</html>

<?php
session_start();
require_once '../ADMIN/config/config.php';
require_once '../ADMIN/service/productService.php';
require_once '../ADMIN/service/cartService.php';

$cartItems = [];
$totalQuantity = 0;
$totalPrice = 0;
$freeShippingThreshold = 2500;
$amountToFreeShipping = 0;

if (isset($_SESSION['user_id'])) {
    $cartService = new CartService($conn);
    $productService = new ProductService($conn);
    $cart = $cartService->search_by_id($_SESSION['user_id']);
    foreach ($cart as $item) {
        $product = $productService->show_product_by_id($item['product_id']);
        $cartItems[] = [
            'product_id' => $item['product_id'],
            'name' => $product['name'],
            'image' => $product['image'],
            'price' => $product['price'],
            'color' => $item['hex_code'],
            'size' => $productService->get_size_name_by_id($item['size_id']),
            'quantity' => $item['quantity']
        ];

        $totalQuantity += $item['quantity'];
        $totalPrice += $item['quantity'] * $product['price'];
    }
} 
else {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $cartItems = $_SESSION['cart'];
        foreach ($cartItems as $item) {
            $totalQuantity += $item['quantity'];
            $totalPrice += $item['quantity'] * $item['price'];
        }
    }
}
$_SESSION['total_cart_quantity'] = $totalQuantity;
$amountToFreeShipping = max(0, $freeShippingThreshold - $totalPrice);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $product_id = $_POST['product_id'] ?? null;
    $color = $_POST['color'] ?? null;
    $size = $_POST['size'] ?? null;

    if ($product_id && $color && $size) {
        if (isset($_SESSION['user_id'])) {
            $cartService = new CartService($conn);
            $product = $cartService->get_cart_item($_SESSION['user_id'], $product_id, $color, $size);
            $currentQuantity = $product['quantity'];
        } else {
            $currentQuantity = 0;
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    $productColor = $item['color'] ?? $item['hex_code'] ?? null;
                    if ($item['product_id'] == $product_id && $productColor == $color && $item['size'] == $size) {
                        $currentQuantity = $item['quantity'];
                        break;
                    }
                }
            }
        }

        // Increase/Decrease quantity
        if ($action === 'increase') $newQuantity = $currentQuantity + 1;
        elseif ($action === 'decrease') $newQuantity = $currentQuantity - 1;
        elseif ($action === 'delete') $newQuantity = 0;
        else $newQuantity = $currentQuantity;

        if ($newQuantity <= 0) {
            if (isset($_SESSION['user_id'])) $cartService->delete_product($_SESSION['user_id'], $product_id, $color, $size);
            else {
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $key => $product) {
                        $productColor = $product['color'] ?? $product['hex_code'] ?? null;
                        if ($product['product_id'] == $product_id && $productColor == $color && $product['size'] == $size) {
                            unset($_SESSION['cart'][$key]);
                            break;
                        }
                    }
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                }
            }
        } else {
            if (isset($_SESSION['user_id'])) $cartService->update_quantity($_SESSION['user_id'], $product_id, $color, $size, $newQuantity);
            else {
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as &$product) {
                        $productColor = $product['color'] ?? $product['hex_code'] ?? null;
                        if ($product['product_id'] == $product_id && $productColor == $color && $product['size'] == $size) {
                            $product['quantity'] = $newQuantity;
                            break;
                        }
                    }
                    unset($product);
                }
            }
        }
        header('Location: cart.php');
        exit;
    }
}
?>
<?php require_once "./components/header.php"; ?>
<section id="cart">
    <div class="cart-top-wrap">
        <div class="cart-top">
            <div class="cart-top-cart cart-top-item">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="cart-top-address cart-top-item">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class="cart-top-payment cart-top-item">
                <i class="fas fa-money-check-alt"></i>
            </div>
        </div>
    </div>
    <div class="cart-content" style="display: flex;">
        <h1 class="cart-content-title">КОРЗИНА</h1>
        <table class="cart-content-left">
            <thead>
                <tr class="deskop-desc">
                    <th>Продукт</th>
                    <th>Название</th>
                    <th>Свет</th>
                    <th>Размер</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cartItems)): ?>
                <?php foreach ($cartItems as $product): ?>
                    <tr>
                        <td class="product_img"> <img src="../ADMIN/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>"></td>
                        <td class="product_name"><?= htmlspecialchars($product['name']) ?></td>
                        <td class="product_color">
                            <div style="background-color: <?= htmlspecialchars($product['color'] ?? $product['hex_code']) ?>;
                            display: inline-block; width: 20px; height: 20px; border-radius: 50%; border: 1px solid var(--color-ddd);"></div>
                        </td>
                        <td class="product_size"><?= htmlspecialchars($product['size']) ?></td>
                        <td class="product_quantity"><?= htmlspecialchars($product['quantity']) ?></td>
                        <td class="product_price"><?= number_format($product['price'], 0, '.', ' ') ?> ₽</td>
                        <td class="product_delete">
                            <form method="post" action="cart.php" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
                                <input type="hidden" name="color" value="<?= htmlspecialchars($product['color'] ?? $product['hex_code']) ?>">
                                <input type="hidden" name="size" value="<?= htmlspecialchars($product['size']) ?>">
                                <button type="submit" style="background: none; border: none; cursor: pointer;">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" style="text-align:center;">Корзина пуста</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <table class="cart-content-left-mobile">
            <tbody>
                <?php if (!empty($cartItems)): ?>
                <?php foreach ($cartItems as $product): ?>
                    <tr>
                    <td class="product_img"><img src="../ADMIN/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>"></td>
                    <td class="product_details">
                        <p class="product_name"><?= htmlspecialchars($product['name']) ?></p>
                        <div class="product_color">
                            <p>Цвет: </p>
                            <div style="width: 20px; height: 20px; border-radius: 50%; background-color: <?= htmlspecialchars($product['color']) ?>; border: 1px solid #ccc;"></div>
                        </div>
                        <div class="product_size">
                            <p>Размер: </p>
                            <p><?= htmlspecialchars($product['size']) ?></p>
                        </div>
                        <form class="table_between" method="post" action="cart.php" style="display: flex; align-items: center;">
                            <div class="product_quantity">
                                <button type="submit" name="action" value="decrease" class="product_quantity-decrease">-</button>
                                <input type="number" name="quantity" value="<?= (int)$product['quantity'] ?>" min="0" readonly>
                                <button type="submit" name="action" value="increase" class="product_quantity-increase">+</button>
                            </div>
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
                            <input type="hidden" name="color" value="<?= htmlspecialchars($product['color']) ?>">
                            <input type="hidden" name="size" value="<?= htmlspecialchars($product['size']) ?>">
                            <button type="submit" name="action" value="delete" style="background: none; border: none; cursor: pointer; margin-left: 10px;">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form> 
                    </td>
                    </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="1" style="text-align:center;">Корзина пуста</td></tr>
                <?php endif; ?>
            </tbody>
        </table>   
        <!-- Right Content -->
        <div class="cart-content-right">
            <table>
                <tr><th colspan="2" class="text-uppercase">Сумма</th></tr>
                <tr>
                    <td class="text-uppercase">Количество товара</td>
                    <td><?= htmlspecialchars($totalQuantity) ?></td>
                </tr>
                <tr>
                    <td class="text-uppercase">Общая сумма</td>
                    <td><p><?= number_format($totalPrice, 0, '.', ' ') ?> ₽</p></td>
                </tr>
                <tr>
                    <td class="text-uppercase">Итого</td>
                    <td><p style="color: #000; font-weight: bold;"><?= number_format($totalPrice, 0, '.', ' ') ?> ₽</p></td>
                </tr>
            </table>
            <div class="cart-content-right-text">
                <p>Вы получите бесплатную доставку при общей стоимости заказа более <?= number_format($freeShippingThreshold, 0, '.', ' ') ?> рублей.</p>
                <?php if ($amountToFreeShipping > 0): ?>
                    <p style="color: #dc3545; font-weight: bold;">Купить больше <span style="font-size: 18px;"><?= number_format($amountToFreeShipping, 0, '.', ' ') ?> ₽</span></p>
                <?php else: ?>
                    <p style="color: green; font-weight: bold;">Поздравляем! Вы получили бесплатную доставку.</p>
                <?php endif; ?>
            </div>
            <!-- Button -->
            <div class="cart-content-right-button">
                <button class="button" onclick="window.location.href='index.php'">Продолжить покупку</button>
                <button class="button" onclick="window.location.href='delivery.php'">Платить</button>
            </div>
            <div class="cart-content-right-login">
              <p class="text-uppercase">Аккаунт</p>
              <p><a href="login.php" style="font-weight: bold;">Войдите</a> в свой аккаунт, чтобы заработать членские баллы</p>
            </div>
        </div>
    </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const table = document.querySelector(".cart-content-left");
    const rowCount = table.querySelector("tbody").querySelectorAll("tr").length;
    if (rowCount === 1) table.classList.add("single-row");
    else table.classList.remove("single-row");
});
</script>
<?php require_once "./components/footer.php"; ?>
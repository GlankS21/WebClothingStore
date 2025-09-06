<?php
session_start();
require_once '../ADMIN/config/config.php';
require_once '../ADMIN/service/productService.php';
require_once '../ADMIN/service/cartService.php';
$cartItems = [];
$totalQuantity = 0;
$totalPrice = 0;
if (isset($_SESSION['user_id'])) {
    $cartService = new CartService($conn);
    $productService = new ProductService($conn);
    $cartItems = $cartService->search_by_id($_SESSION['user_id']); 
    $tempItems = [];
    foreach ($cartItems as $item) {
        $product = $productService->show_product_by_id($item['product_id']);
        $tempItems[] = [
            'product_id' => $item['product_id'],
            'name' => $product['name'],
            'price' => $product['price'], 
            'quantity' => $item['quantity']
        ];
        $totalQuantity += $item['quantity'];
        $totalPrice += $item['quantity'] * $product['price'];
    }
    $cartItems = $tempItems;
} else {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $cartItems = $_SESSION['cart'];
        foreach ($cartItems as $item) {
            $totalQuantity += $item['quantity'];
            $totalPrice += $item['quantity'] * $item['price'];
        }
    }
}
?>
<?php require_once "./components/header.php"; ?>
<div id="delivery">
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
    <div class="delivery-content">
        <div class="delivery-content-left">
            <p class="section-title">Пожалуйста, выберите адрес доставки</p>
            <div class="delivery-login row">
                <p onclick="window.location.href='login.php'"><i class="fas fa-sign-in-alt"></i> Войдите (если у вас уже есть аккаунт)</p>
            </div>
            <div class="delivery-user-type">
                <label>
                    <input type="radio" name="loaikhach" checked>
                    <span><strong>Розничный покупатель</strong> (Если вы не хотите сохранять информацию)</span>
                </label>
                <label>
                    <input type="radio" name="loaikhach">
                    <span><strong>Зарегистрация</strong> (Создайте новый аккаунт, используя информацию ниже)</span>
                </label>
            </div>
            <div class="delivery-input-group row">
                <div class="input-item">
                    <label for="first-name">Фамилия <span class="required" style="color: red">*</span></label>
                    <input type="text" id="first-name" name="first-name" required>
                </div>
                <div class="input-item">
                    <label for="last-name">Имя <span class="required" style="color: red">*</span></label>
                    <input type="text" id="last-name" name="last-name" required>
                </div>
                <div class="input-item">
                    <label for="email">Почта <span class="required" style="color: red">*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-item">
                    <label for="telephone">Телефон <span class="required" style="color: red">*</span></label>
                    <input type="tel" id="telephone" name="telephone" required>
                </div>
            </div>
            <div class="delivery-address">
                <label for="address">Адрес <span class="required" style="color: red">*</span></label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="delivery-buttons">
                <a href="cart.php" class="back-button">
                    <span>&#171;</span>
                    <p>Вернуться</p>
                </a>
            </div>
        </div>
        <div class="delivery-content-right">
            <table class="summary-table">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($cartItems)): ?>
                        <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td><?= (int)$item['quantity'] ?></td>
                                <td><?= number_format($item['price'] * $item['quantity'], 0, '', ' ') ?> ₽</td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="summary-total">
                            <td><strong>Итого</strong></td>
                            <td><?= $totalQuantity ?></td>
                            <td><strong><?= number_format($totalPrice, 0, '', ' ') ?> ₽</strong></td>
                        </tr>
                    <?php else: ?>
                        <tr><td colspan="3">Ваша корзина пуста</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <button style="width: 100%; margin-top: 30px;" class="button text-uppercase" onclick="window.location.href='payment.php'">Оплата и доставка</button>
        </div>
        <div class="delivery-mobile-button" style="display: none;">
            <button class="button text-uppercase" onclick="window.location.href='payment.php'">Оплата и доставка</button>
        </div>
    </div>
</div>
<?php require_once "./components/footer.php"; ?>

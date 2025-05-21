<?php require_once "./components/header.php"; ?>
<section id="payment">
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
    <div class="payment-content row">
        <div class="payment-content-left">
            <div class="payment-section">
                <h3>Способ доставки</h3>
                <div class="payment-option">
                    <input type="radio" id="express-delivery" name="delivery-method">
                    <label for="express-delivery">Экспресс-доставка</label>
                </div>
            </div>
      
            <div class="payment-section">
                <h3>Способ оплаты</h3>
                <p>Каждая транзакция безопасна и зашифрована. Информация о кредитной карте никогда не будет сохранена.</p>
                
                <div class="payment-option">
                    <input type="radio" id="credit-card" name="method-payment">
                    <label for="credit-card">Оплата кредитной картой (OnePay)</label>
                    <div class="payment-logo">
                        <img src="./images/visa.webp" alt="Visa">
                    </div>
                </div>
              
                <div class="payment-option">
                    <input type="radio" id="bank-card" name="method-payment">
                    <label for="bank-card">Оплата банковской картой (OnePay)</label>
                    <div class="payment-logo">
                        <img src="./images/mastercard.webp" alt="Mastercard">
                    </div>
                </div>
              
                <div class="payment-option">
                    <input type="radio" id="cash" name="method-payment">
                    <label for="cash">Наличными</label>
                </div>
            </div>
        </div>
        <div class="payment-content-right">
            <p class="payment-content-right-title" style="display: none;">Промокод</p>
            <div class="payment-discount-group">
                <input type="text" placeholder="Код скидки/подарок">
                <button><i class="fas fa-check"></i></button>
            </div>
            <div class="payment-discount-group">
                <input type="text" placeholder="Код соавтора">
                <button><i class="fas fa-check"></i></button>
            </div>
      
            <div class="payment-mnv">
              <select name="payment-discount" id="payment-discount">
                <option value="">Выберите код лояльности сотрудника</option>
                <option value="D345">D345</option>
                <option value="A345">A345</option>
                <option value="E345">E345</option>
                <option value="I345">I345</option>
              </select>
            </div>
        </div>
    </div>
    <div class="payment-button">
        <button class="button text-uppercase" onclick="window.location.href='index.php'">Продолжить оплату</button>
    </div>
</section>
<?php require_once "./components/footer.php"; ?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../ADMIN/config/config.php';
require_once '../ADMIN/service/entryService.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $entryService = new entryService($conn);
    try{
        $user = $entryService->login($username, $password);
        if($user === false){
            $_SESSION['error'] = "Пользователь или пароль не правильный!";
            header("Location: login.php");
            exit;
        }
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['user_name'];
        $_SESSION['role'] = $user['user_role'];
        if ((int)$user['user_role'] === 1) {
            header("Location: ../ADMIN/manager/categoryManager.php");
        } else {
            header("Location: index.php");
        }
        exit;
    }
    catch (PDOException $e) {
        $_SESSION['error'] = "Ошибка при логин!";
        header("Location: login.php");
        exit;
    }
}
?>
<?php require_once "./components/header.php"; ?>
<!-- LOGIN -->
<section id="login">
    <div class="login-container-left">
        <h1>У вас уже есть аккаунт?</h1>
        <p>Если у вас уже есть аккаунт, войдите в систему, чтобы накапливать баллы за участие и получать более выгодные предложения!</p>
        <form id="login-form" action="login.php" method="POST">
            <div class="form-group">
            <input type="email" id="username" name="email" class="login-input" placeholder="Email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" >
            </div>
            <div class="form-group">
            <input type="password" id="password" name="password" class="login-input" placeholder="Password" required>
            </div>
            <?php
                if (isset($_SESSION['error'])) {
                    echo '<p class="error">' . htmlspecialchars($_SESSION['error']) . '</p>';
                    unset($_SESSION['error']);
                }
            ?>
            <div class="login-container-left-remember">
                <label>
                    <input type="checkbox" class="checkboxs" name="customer_remember" value="1">
                    <span>Запомнить меня</span>
                </label>
            </div>
            <button type="submit" class="text-uppercase button">Логин</button>
        </form>
    </div>

    <div class="login-container-right">
        <h1>Новый клиент</h1>
        <p>Если у вас еще нет аккаунта, используйте этот вариант, чтобы перейти к форме регистрации. Предоставив свои данные, процесс покупки станет более приятным и быстрым!</p>
        <button class="text-uppercase button" onclick="window.location.href='registation.php'">Регистрация</button>
    </div>
</section>
<?php require_once "./components/footer.php"; ?>

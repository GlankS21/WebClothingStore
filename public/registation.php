<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../ADMIN/config/config.php';
require_once '../ADMIN/service/entryService.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lastname = trim($_POST['lastname'] ?? '');
    $firstname = trim($_POST['firstname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['email'] ?? '');
    $birthday = $_POST['customer_dob'] ?? null;
    if ($_POST['customer_sex'] === "0") {
        $gender = "Woman";
    } elseif ($_POST['customer_sex'] === "1") {
        $gender = "Man";
    } else{
        $gender = "Other";
    }
    $address = $_POST['address'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    if($password != $confirm_password){
      $_SESSION['error'] = 'Пароли не совпадают';
    }
    else{
      try{
        $entryService = new entryService($conn);
        $register = $entryService->register($lastname, $firstname, $email, $username, $birthday, $gender, $address, $password);
        if($register === false){
          $_SESSION['error'] = 'Пользователь уже существует!';
          header("Location: registation.php");
          exit;
        }
        $_SESSION['success'] = 'Регистрация прошла успешно!';
        header("Location: registation.php");
        exit;
      }catch (PDOException $e) {
        $_SESSION['error'] = "Ошибка при регистрации!";
        header("Location: registation.php");
        exit;
      }
    }
}
?>
<?php require_once "./components/header.php"; ?>
<section id="regis">
  <h1 style="display: none;">Регистрация</h1>
  <form action="registation.php" method="POST">
    <div class="regis-content-left">
        <div class="regis-content-left-title">
          <h4>Информация о клиенте</h4>
        </div>
        <div class="regis-content-left-block row">
          <div class="regis-content-left-form">
              <label for="lastname">Фамилия:<span style="color: red">*</span></label>
              <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Фамилия..." required>
          </div>
          <div class="regis-content-left-form">
              <label for="firstname">Имя:<span style="color: red">*</span></label>
              <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Имя..." required>
          </div>
        </div>
        <div class="regis-content-left-block row">
          <div class="regis-content-left-form">
            <label for="email">Почта:<span style="color: red">*</span></label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Почта..." required>
          </div>
          <div class="regis-content-left-form">
            <label for="phone">Телефон:<span style="color: red">*</span></label>
            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Телефон..." required title="Введите только цифры">
          </div>
        </div>
        <div class="regis-content-left-block row">
          <div class="regis-content-left-form">
            <label for="dob">День рождения:</label>
            <input type="date" id="dob" name="customer_dob" class="form-control">
          </div>
          <div class="regis-content-left-form">
            <label for="sex">Пол:</label>
            <select id="sex" name="customer_sex" class="form-control">
              <option value="0">Женщина</option>
              <option value="1">Мужчина</option>
              <option value="2">Другое</option>
            </select>
          </div>
        </div>
        <div class="regis-content-left-block row">
          <div class="regis-content-left-form">
            <label for="address">Адрес:<span style="color: red">*</span></label>
            <textarea id="address" name="address" class="form-control" required></textarea>
          </div>
        </div>
    </div>
    <div class="regis-content-right">
        <div class="regis-content-right-title">
            <h4>Информация о пароле</h4>
        </div>
        <div class="regis-content-left-block row">
          <div class="regis-content-right-form">
            <label for="password">Пароль:<span style="color: red">*</span></label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Пароль..." required>
          </div>
        </div>
        <div class="regis-content-left-block row">
          <div class="regis-content-right-form">
            <label for="password_repeat">Повторите пароль:<span style="color: red">*</span></label>
            <input type="password" id="password_repeat" name="confirm_password" class="form-control" placeholder="Повторите пароль..." required>
          </div>
        </div>
        <!-- NOTIFICATIONS -->
        <?php
          if (isset($_SESSION['error'])) {
            echo '<p class="error">' . htmlspecialchars($_SESSION['error']) . '</p>';
            unset($_SESSION['error']);
          }
          if (isset($_SESSION['success'])) {
            echo '<p class="success">' . htmlspecialchars($_SESSION['success']) . '</p>';
            unset($_SESSION['success']);
          }
        ?>
        <div class="regis-content-left-block row">
            <input type="checkbox" id="agree" name="customer_agree" class="form-check-input checkboxs" required>
            <label class="form-check-label" for="agree">
                <span>Согласен с <a href="#" style="color: #f31f1f;">условиями</a> магазина</span>
            </label>
        </div>
        <div class="regis-content-left-block">
            <button id="btn_register" class="button" type="submit">Регистрация</button>
        </div>
    </div>
  </form>
</section>
<?php require_once "./components/footer.php"; ?>

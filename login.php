<?php
require_once 'FUNCTIONS/index.php';
AUTH::autentificationCookies();

$results = [];

if (is($_POST, array("email", "password"))) {
    $login = AUTH::login($_POST['email'], $_POST['password']);
    if (isErr($login)) $results = $login;
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Авторизация</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/message.css">
</head>
<body>
<?php if (!AUTH::isAuth()): ?>
  <div class="wrap">
    <div class="login">
      <div class="login-header">
        <h2>Project</h2>
      </div>
      <form method="post">
        <div class="login-main">
          <div class="login-main-header">
            <h3>Авторизация</h3>
          </div>

            <?php if (isErr($results)): ?>
              <div class="error">
                  <?= $results['error']; ?>
              </div>
            <?php endif; ?>

          <div class="login-main-form">
            <div class="input-group">
              <div class="input-group-label">Почта</div>
              <div class="input-group-input"><input type="text" placeholder="Введите почту" class="input" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" name="email"></div>
            </div>
            <div style="clear: both"></div>
            <div class="input-group">
              <div class="input-group-label">Пароль</div>
              <div class="input-group-input"><input type="password" placeholder="Введите пароль" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" class="input" name="password"></div>
            </div>
            <div style="clear: both"></div>
          </div>
        </div>

        <button class="login-footer" type="submit">Войти</button>
      </form>
      <div class="login-help">
        <ul>
          <li>- Для успешной авторизации введите данные</li>
          <li>- Вы не сможете авторизоваться если не зарегистрированны.</li>
          <li>- Для регистрации пройдите по <a href="join.php">ссылке</a>.</li>
          <li>- Внимание! Не доверяйте свой пароль никому!</li>
        </ul>
      </div>

    </div>
  </div>
<?php else: ?>
    <?php header("Location: profile.php"); ?>
<?php endif; ?>
</body>
</html>
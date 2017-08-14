<?php
require_once 'FUNCTIONS/index.php';
AUTH::autentificationCookies();

$results = [];

if (is($_POST, array("user_name", "user_family", "user_email", "user_school", "user_class", "user_letter", "user_pass", "user_r_pass"))) {
    $join = AUTH::join(
        $_POST['user_name'],
        $_POST['user_family'],
        $_POST['user_email'],
        $_POST['user_school'],
        $_POST['user_class'],
        $_POST['user_letter'],
        $_POST['user_pass'],
        $_POST['user_r_pass']
    );
    if (isErr($join)) $results = $join;
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Регистрация</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/join.css">
  <link rel="stylesheet" href="css/message.css">
</head>
<body>
<?php if (!AUTH::isAuth()): ?>
  <div class="wrap">
    <div class="join">
      <div class="join-header">
        <h2>Project</h2>
      </div>

      <div class="join-main">
        <div class="join-main-header">
          <h3>Регистрация</h3>
        </div>

          <?php if (isErr($results)): ?>
            <div class="error">
                <?= $results['error']; ?>
            </div>
          <?php endif; ?>

        <div class="join-main-form">
          <form method="post">
            <div class="input-group">
              <div class="input-group-label">Имя</div>
              <div class="input-group-input"><input type="text" value="<?php if (isset($_POST['user_class'])) echo $_POST['user_name']; ?>" placeholder="Введите Ваше имя" class="input" name="user_name" autocomplete="off"></div>
            </div>
            <div style="clear: both"></div>

            <div class="input-group">
              <div class="input-group-label">Фамилия</div>
              <div class="input-group-input"><input type="text" value="<?php if (isset($_POST['user_family'])) echo $_POST['user_family']; ?>" placeholder="Введите Вашу фамилию" class="input" name="user_family" autocomplete="off"></div>
            </div>
            <div style="clear: both"></div>

            <div class="input-group">
              <div class="input-group-label">Почта</div>
              <div class="input-group-input"><input type="text" value="<?php if (isset($_POST['user_email'])) echo $_POST['user_email']; ?>" placeholder="Введите Вашу почту" class="input" name="user_email" autocomplete="off"></div>
            </div>
            <div style="clear: both"></div>

            <div class="input-group">
              <div class="input-group-label">Школа</div>
              <div class="input-group-input"><input type="text" value="<?php if (isset($_POST['user_school'])) echo $_POST['user_school']; ?>" placeholder="Введите Ваше имя" class="input" name="user_school" autocomplete="off"></div>
            </div>
            <div style="clear: both"></div>

            <div class="input-group">
              <div class="input-group-label">Класс</div>
              <div class="input-group-input"><input type="text" value="<?php if (isset($_POST['user_class'])) echo $_POST['user_class']; ?>" placeholder="Введите Ваш класс" class="input" name="user_class" autocomplete="off"></div>
            </div>
            <div style="clear: both"></div>

            <div class="input-group">
              <div class="input-group-label">Буква</div>
              <div class="input-group-input"><input type="text" value="<?php if (isset($_POST['user_letter'])) echo $_POST['user_letter']; ?>" placeholder="Введите Ваше имя" class="input" name="user_letter" autocomplete="off"></div>
            </div>
            <div style="clear: both"></div>

            <div class="input-group">
              <div class="input-group-label">Пароль</div>
              <div class="input-group-input"><input type="text" value="<?php if (isset($_POST['user_pass'])) echo $_POST['user_pass']; ?>" placeholder="Введите пароль" class="input" name="user_pass" autocomplete="off"></div>
            </div>
            <div style="clear: both"></div>

            <div class="input-group">
              <div class="input-group-label">Пароль</div>
              <div class="input-group-input"><input type="text" value="<?php if (isset($_POST['user_r_pass'])) echo $_POST['user_r_pass']; ?>" placeholder="Повторите" class="input" name="user_r_pass" autocomplete="off"></div>
            </div>
            <div style="clear: both"></div>

            <button class="join-main-form-enter" type="submit">Войти</button>
          </form>
        </div>

      </div>

      <div class="join-help">
        <ul>
          <li>Букву класса необходимо вводить на русской раскладке.</li>
          <li>Для успешной регистрации введите все данные.</li>
          <li>Для перехода на страницу авторизации, кликните по <a href="login.php" title="Авторизация">ссылке</a>.</li>
        </ul>
      </div>
    </div>
  </div>
<?php else: ?>
    <?php header("Location: profile.php"); ?>
<?php endif; ?>
</body>
</html>
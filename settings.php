<?php
require_once 'FUNCTIONS/index.php';
AUTH::autentificationCookies();
if (isset($_GET['logout'])) AUTH::logout();
$results = [];

if(isset($_POST['change_pass'])) {
$results = USER::changeUserPass($_POST['pass1'], $_POST['pass2']);
}

?>

<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/settings.css">
  <link rel="stylesheet" href="css/message.css">
  <title>Настройки</title>
</head>
<body>
<div class="wrap">
  <div class="settings">
    <div class="settings-header">
        <?php include 'block/header.php'; ?>
    </div>

    <div class="settings-body">
      <div class="left"><?php include 'block/menu.php'; ?></div>
      <div class="right">
        <div class="change-password">

            <?php if (isErr($results)): ?>
              <div class="error">
                  <?= $results['error']; ?>
              </div>
            <?php endif; ?>

            <?php if (isset($results['success'])): ?>
              <div class="success">
                  <?= $results['success']; ?>
              </div>
            <?php endif; ?>

          <h3>Изменить пароль</h3>
          <div class="form">
            <form method="post">
              <input type="password" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" name="pass1" placeholder="Старый пароль"  class="input"> <br>
              <input type="password" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" name="pass2" placeholder="Новый пароль" class="input"> <br>
              <input type="submit" value="Изменить" name="change_pass" class="submit">
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</body>
</html>
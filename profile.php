<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.07.2017
 * Time: 20:31
 */


require_once 'FUNCTIONS/index.php';
AUTH::autentificationCookies();
if (isset($_GET['logout'])) AUTH::logout();


$user = USER::getUserInfo();

if (!AUTH::isAuth()) header('Location:login.php');
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="css/message.css">
  <title><?= $_SESSION['user_name'] . " " . $_SESSION['user_family']; ?></title>
</head>
<body>

<div class="wrap">
  <div class="profile">
    <div class="profile-header">
        <?php include 'block/header.php'; ?>
    </div>

    <div class="profile-body">
      <div class="profile-body-menu">
          <?php include 'block/menu.php'; ?>
      </div>
      <div class="profile-body-info">
        <div class="warning">Раздел в разработке</div>
        <div class="user-info">
          
          <table border="1">
            <caption>Данные видны только вам</caption>
            <tr>
              <td>id</td>
              <td><?= $user['user_id'] ?></td>
            </tr>
            <tr>
              <td>Имя</td>
              <td><?= $user['user_name'] ?></td>
            </tr>
            <tr>
              <td>Фамилия</td>
              <td><?= $user['user_family'] ?></td>
            </tr>
            <tr>
              <td>Почта</td>
              <td><?= $user['user_email'] ?></td>
            </tr>
            <tr>
              <td>Школа</td>
              <td><?= $user['user_school'] ?></td>
            </tr>
            <tr>
              <td>Класс</td>
              <td><?= $user['user_class'] ?></td>
            </tr>
            <tr>
              <td>Дата регистрации</td>
              <td><?= $user['user_date_add'] ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="profile-footer">

    </div>
  </div>
</div>

</body>
</html>

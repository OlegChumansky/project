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
if (!AUTH::isAuth()) header('Location:login.php');
$users = USER::getUsersOnClass();
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/class.css">
  <link rel="stylesheet" href="css/message.css">
  <title>Класс</title>
</head>
<body>

<div class="wrap">
  <div class="class">
    <div class="class-header">
        <?php include 'block/header.php'; ?>
    </div>

    <div class="class-body">
      <div class="class-body-menu">
          <?php include 'block/menu.php'; ?>
      </div>
      <div class="class-body-info">
        <table border="1">
          <tr>
            <th>Имя</th>
            <th>Фамилия</th>
          </tr>
            <?php foreach ($users['data'] as $user): ?>
              <tr>
                <td><?= $user['user_name'] ?></td>
                <td><?= $user['user_family'] ?></td>
              </tr>
            <?php endforeach; ?>
        </table>
      </div>
    </div>

    <div class="class-footer">

    </div>
  </div>
</div>

</body>
</html>
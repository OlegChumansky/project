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

?>

<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Page</title>
</head>
<body>

<div class="wrap">

  <div class="header"><?php include 'block/header.php'; ?></div>

  <div class="left-menu">

  </div>

  <div class="main">

    <div class="content"><p>Контент</p></div>
    <div class="footer">Футер</div>

  </div>

<!--  <div class="footer">-->
<!--    <hr>-->
<!--  </div>-->

</div>

</body>
</html>
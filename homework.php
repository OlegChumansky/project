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

if (date("l") == "Saturday" OR date("l") == "Sunday") {
    $d1 = date("d.m.Y", time() - (-7 + date("N") - 1) * 24 * 60 * 60);
    $d2 = date("d.m.Y", time() - (-8 + date("N") - 1) * 24 * 60 * 60);
    $d3 = date("d.m.Y", time() - (-9 + date("N") - 1) * 24 * 60 * 60);
    $d4 = date("d.m.Y", time() - (-10 + date("N") - 1) * 24 * 60 * 60);
    $d5 = date("d.m.Y", time() - (-11 + date("N") - 1) * 24 * 60 * 60);
    $d6 = date("d.m.Y", time() - (-12 + date("N") - 1) * 24 * 60 * 60);
    $d7 = date("d.m.Y", time() - (-13 + date("N") - 1) * 24 * 60 * 60);
} else {
    $d1 = date("d.m.Y", time() - (date("N") - 1) * 24 * 60 * 60);
    $d2 = date("d.m.Y", time() - (-1 + date("N") - 1) * 24 * 60 * 60);
    $d3 = date("d.m.Y", time() - (-2 + date("N") - 1) * 24 * 60 * 60);
    $d4 = date("d.m.Y", time() - (-3 + date("N") - 1) * 24 * 60 * 60);
    $d5 = date("d.m.Y", time() - (-4 + date("N") - 1) * 24 * 60 * 60);
    $d6 = date("d.m.Y", time() - (-5 + date("N") - 1) * 24 * 60 * 60);
    $d7 = date("d.m.Y", time() - (-6 + date("N") - 1) * 24 * 60 * 60);
}

$days = ["Понедельник $d1", "Вторник $d2", "Среда $d3", "Четверг $d4", "Пятница $d5", "Суббота $d6", "Воскресенье $d7"];

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
  <link rel="stylesheet" href="css/homework.css">
  <link rel="stylesheet" href="css/toast.css">
  <link rel="stylesheet" href="css/message.css">
  <script src="jQuery/jquery-3.1.0.js"></script>
  <script src="js/homework.js"></script>
  <script src="js/script_toast.js"></script>
  <title>Домашние задания</title>
</head>
<body>

<div class="wrap">
  <div class="homework">
    <div class="homework-header">
        <?php include 'block/header.php'; ?>
    </div>

    <div class="homework-body">
      <div class="homework-body-menu">
          <?php include 'block/menu.php'; ?>
      </div>

      <div class="homework-body-main">

        <div class="warning">
          Страница функционирует, но все еще в разработке. Дорабатывается дизайн ...
        </div>

        <div class="success">
          
        </div>

        <div class="homework">
          <table class="homework-table">
              <?php for ($d = 0; $d < 6; $d++): // Количество дней  ?>

                <tr>
                  <td colspan="2" class="center"><h3><?= $days[$d]; ?></h3></td>
                </tr>

                <tr>
                  <th>Предмет</th>
                  <th>Домашнее задание</th>
                </tr>

                  <?php for ($l = 0; $l < 7; $l++): //Количество уроков + домашние задания ?>
                  <tr>
                      <?php $lesson = HOMEWORK::getLessons($d, $l); ?>
                    <td>
                      <div class="input-group">
                        <input type="hidden" name="less[day]" value="<?= $d ?>"> <? // Номер дня недели ?>
                          <?= $l + 1 ?>.<input type="hidden" name="less[number]" value="<?= $l ?>"> <? // Номер урока ?>
                        <input type="text" class="input" placeholder="Предмет" name="less[data]" autocomplete="off" value="<?= (isset($lesson['name'])) ? $lesson['name'] : "" ?>">
                        <span class="lesson"><button class="submit">Добавить</button></span>
                      </div>
                    </td>
                      <?php $task = HOMEWORK::getHometask($d, $l); ?>
                    <td>
                      <div class="input-group">
                        <input type="hidden" name="task[day]" value="<?= $d ?>"> <? // Номер дня недели ?>
                        <input type="hidden" name="task[number]" value="<?= $l ?>"> <? // Номер урока ?>
                        <input type="text" class="input" placeholder="Домашнее задание" name="task[data]" autocomplete="off" value="<?= (isset($task['name'])) ? $task['name'] : "" ?>">
                        <span class="task"><button class="submit">Добавить</button></span>
                      </div>
                    </td>
                  </tr>
                  <?php endfor; ?>
              <?php endfor; ?>
          </table>
        </div>
      </div>

    </div>

    <div class=homework-footer">

    </div>
  </div>
</div>

<!-- вывод текста из инпутов -->
<script>
    $(document).ready(function () {
        $('.lesson').click(function () {
            var lesson = $(this).closest('.input-group').children('.input').val();
            var day = $(this).closest('.input-group').children('input').eq(0).attr('value');
            var number = $(this).closest('.input-group').children('input').eq(1).attr('value');
            addLesson(lesson, day, number)
        });

        $('.task').click(function () {
            var lesson = $(this).closest('.input-group').children('.input').val();
            var day = $(this).closest('.input-group').children('input').eq(0).attr('value');
            var number = $(this).closest('.input-group').children('input').eq(1).attr('value');
            addTask(lesson, day, number)
        });
    });
</script>

</body>
</html>

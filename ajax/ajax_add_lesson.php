<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.07.2017
 * Time: 20:45
 */

require_once '../FUNCTIONS/index.php';
AUTH::autentificationCookies();

if (!is($_POST, array("lesson", "day", "number"))) LOG::sendLog("ошибка входящих данных");
else $results = HOMEWORK::addLesson($_POST['lesson'], $_POST['day'], $_POST['number']);
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.07.2017
 * Time: 20:37
 */

class HOMEWORK {
    public static function addLesson($lesson, $day, $number) {
        $connect = DB_CONNECT::getInstance();
        $date = date("YmdHis");

        $user = USER::getUserInfo(AUTH::getUserId());
        $class = $user['user_class'];
        $school = $user['user_school'];

        $column = "name, day, number, user_school, user_class, date";
        $data = "'$lesson', '$day', '$number', '$school', '$class', '$date'";

        $sql2 =
            "DELETE " .
            "FROM lessons WHERE `user_school` = '$school' AND `user_class` = '$class' AND `day` = '$day' AND `number` = '$number'";

        if (!$result = $connect->query($sql2)) {
            LOG::sendLog("Ошибка при добавлении предмета", $connect->err());
        }

        $sql =
            "INSERT " .
            "INTO lessons ($column) VALUES ($data)";

        if (!$result = $connect->query($sql)) {
            LOG::sendLog("Ошибка при добавлении предмета", $connect->err());
        }
    }

    public static function addTask($task, $day, $number) {
        $connect = DB_CONNECT::getInstance();
        $date = date("YmdHis");

        $user = USER::getUserInfo(AUTH::getUserId());
        $class = $user['user_class'];
        $school = $user['user_school'];

        $column = "name, day, number, user_school, user_class, date";
        $data = "'$task', '$day', '$number', '$school', '$class', NOW()";

        $sql2 =
            "DELETE " .
            "FROM task WHERE `user_school` = '$school' AND `user_class` = '$class' AND `day` = '$day' AND `number` = '$number'";

        if (!$result = $connect->query($sql2)) {
            LOG::sendLog("Ошибка при добавлении предмета", $connect->err());
        }

        $sql =
            "INSERT " .
            "INTO task ($column) VALUES ($data)";

        if (!$result = $connect->query($sql)) {
            LOG::sendLog("Ошибка при добавлении предмета", $connect->err());
        }
    }

    public static function getLessons($day, $number) {
        $connect = DB_CONNECT::getInstance();
        $user = USER::getUserInfo(AUTH::getUserId());
        $results = array();

        $class = $user['user_class'];
        $school = $user['user_school'];

        $sql =
            "SELECT * " .
            "FROM lessons " .
            "WHERE `user_school` = '$school' AND `user_class` = '$class' AND `day` = '$day' AND `number` = '$number' " .
            "ORDER BY date ASC";

        if (!$result = $connect->query($sql)) {
            $results['error'] = "Ошибка в запросе.";
            LOG::sendLog("Ошибка в запросе", $connect->err());
        } else {
            if ($result->num_rows == 0) {
                $results['error'] = "Пусто";
            } else {
                while ($row = $result->fetch_assoc()) {
                    $results = $row;
                }
            }
        }
        return $results;
    }

    public static function getHometask($day, $number) {
        $connect = DB_CONNECT::getInstance();
        $user = USER::getUserInfo(AUTH::getUserId());
        $results = array();

        $class = $user['user_class'];
        $school = $user['user_school'];

        $sql =
            "SELECT * " .
            "FROM task " .
            "WHERE `user_school` = '$school' AND `user_class` = '$class' AND `day` = '$day' AND `number` = '$number' AND YEAR(`date`) = YEAR(NOW()) AND WEEK(`date`, 1) = WEEK(NOW(), 1) " .
            "ORDER BY date ASC";

        if (!$result = $connect->query($sql)) {
            $results['error'] = "Ошибка в запросе.";
            LOG::sendLog("Ошибка в запросе", $connect->err());
        } else {
            if ($result->num_rows == 0) {
                $results['error'] = "Пусто";
            } else {
                while ($row = $result->fetch_assoc()) {
                    $results = $row;
                }
            }
        }
        return $results;
    }
}
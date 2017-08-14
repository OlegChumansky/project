<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.07.2017
 * Time: 20:55
 */

class USER {
    public static function getUserInfo($user_id = -1) {
        $connect = DB_CONNECT::getInstance();
        $user_id = intval($user_id);
        $results = [];

        if ($user_id == -1) $user_id = AUTH::getUserId();

        $sql =
            "SELECT * " .
            "FROM user " .
            "WHERE UPPER(user_id) LIKE UPPER('$user_id')";

        if (!$result = $connect->query($sql)) {
            $results['error'] = "Ошибка запроса учетной записи.";
            LOG::sendLog("Ошибка .. getUserInfo .. ($user_id)", $connect->err());
        } else {
            if ($result->num_rows == 0) {
                $results['error'] = "Не найдена учетная запись с таким идентификатором.";
                LOG::sendLog("Ошибка .. Не найдена учетная запись с таким логином .. getUserInfo .. ($user_id)");
            } else {
                $row = $result->fetch_assoc();
                $results = $row;
            }
        }
        return $results;
    }

    public static function changeUserPass($pass_old, $pass_new) {
        $connect = DB_CONNECT::getInstance();
        $results = [];

        $user = USER::getUserInfo();

        $pass_old = $connect->escape($pass_old);
        $pass_new = $connect->escape($pass_new);

        if (!isLen($pass_old, 1, 255)) $results['error'] = "Количество символов старого пароля долждно быть в диапазоне 1-255";
        elseif (!isLen($pass_new, 1, 255)) $results['error'] = "Количество символов нового пароля долждно быть в диапазоне 1-255";
        elseif (md5($pass_old) != $user['user_password']) $results['error'] = "Старый пароль введен неверно!";
        else {
            $user_id = AUTH::getUserId();
            $pass_new = md5($pass_new);
            $sql = "UPDATE user SET user_password = '$pass_new' WHERE user_id = '$user_id'";
            if (!$result = $connect->query($sql)) {
                $results['error'] = "Ошибка при обновлении данных";
                LOG::sendLog('Ошибка при смене пароля (changeUserPass) ', $connect->err());
            } else {
                $results['success'] = "Пароль успешно изменен!";
            }
        }
        return $results;
    }

    public static function getUsersOnClass() {
        $connect = DB_CONNECT::getInstance();
        $user = USER::getUserInfo();

        $user_class = $user['user_class'];
        $user_school = $user['user_school'];

        $results = [];

        $sql = "SELECT * FROM user WHERE user_class = '$user_class' AND user_school = '$user_school' ";

        if (!$result = $connect->query($sql)) LOG::sendLog($connect->err());
        elseif ($result->num_rows == 0) $results['error'] = "Класс пока пуст";
        else {
            while ($row = $result->fetch_assoc()) {
                $results['data'][] = $row;
            }
        }
        return $results;
    }
}
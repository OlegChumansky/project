<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.07.2017
 * Time: 20:37
 */
class AUTH {
    public static function sessionStart($start = false) {
        $lifeTime = 86400;
        if (isset($_COOKIE[session_name()]) || $start) {
            if (!session_id()) session_start();
            if (isset($_SESSION['starttime'])) {
                if (time() - $_SESSION['starttime'] >= $lifeTime) {
                    session_unset();
                    session_regenerate_id(true);
                }
            } else {
                $_SESSION['starttime'] = time();
            }
        }
    }

    public static function autentificationCookies() {
        self::sessionStart();
        if (!self::isAuth()) {
            if (isset($_COOKIE['Id']) && isset($_COOKIE['userHash'])) {
                $user_id = intval($_COOKIE['user_id']);
                $userHash = $_COOKIE['userHash'];
                $checkHash = self::checkHash($user_id, $userHash);
                if ($checkHash !== false) {
                    $user_email = $checkHash['user_email'];
                    $user_pass = $checkHash['user_pass'];
                    self::setCookieUser($user_id, $user_email, $user_pass);
                    self::sessionStart(true);
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $user_email;
                } else {
                    self::logout();
                }
            }
        }
    }

    public static function getUserByLogin($user_email) {
        $connect = DB_CONNECT::getInstance();
        $user_email = $connect->escape(trim($user_email));
        $results = [];
        if (!isLen($user_email, 1, 256)) $return['error'] = "Введите логин от 1 до 256 символов.";
        else {
            $query =
                "SELECT user_id, user_email, user_name, user_family, user_password " .
                "FROM user " .
                "WHERE UPPER(user_email) LIKE UPPER('$user_email')";
            if (!$result = $connect->query($query)) {
                $results['error'] = "Ошибка запроса учетной записи.";
                LOG::sendLog("getUserByLogin($user_email)", $connect->err());
            } else {
                if ($result->num_rows == 0) {
                    $results['error'] = "Не найдена учетная запись с таким логином.";
                } else {
                    $row = $result->fetch_assoc();
                    $results = $row;
                }
            }
        }
        return $results;
    }

    public static function login($user_email, $user_pass) {
        $results = [];
        $connect = DB_CONNECT::getInstance();

        $user_email = $connect->escape(trim(htmlspecialchars($user_email)));
        $user_pass = $connect->escape(trim(htmlspecialchars($user_pass)));

        if (len($user_email) > 0 and len($user_pass) > 0) {
            $user = AUTH::getUserByLogin($user_email);
            if (isErr($user)) return $user;
            else {
                $user_id = $user['user_id'];
                $userPassDB = $user['user_password'];
                if ($userPassDB != md5($user_pass)) {
                    $results['error'] = "Ошибка авторизации. Неверный пароль.";
                    LOG::sendLog("autentification($user_email, $user_pass), неверный пароль");
                } else {
                    self::setCookieUser($user_id, $user_email, $user_pass);
                    self::sessionStart(true);
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $user['user_email'];
                    $_SESSION['user_name'] = $user['user_name'];
                    $_SESSION['user_family'] = $user['user_family'];
                }
            }
        }
        return $results;
    }

    public static function join($user_name, $user_family, $user_email, $user_school, $user_class, $user_letter, $user_pass, $user_r_pass) {
        $results = [];
        $connect = DB_CONNECT::getInstance();

        $user_name = $connect->escape(trim(htmlspecialchars($user_name)));
        $user_family = $connect->escape(trim(htmlspecialchars($user_family)));
        $user_email = $connect->escape(trim(htmlspecialchars($user_email)));
        $user_school = $connect->escape(trim(htmlspecialchars($user_school)));
        $user_class = $connect->escape(trim(htmlspecialchars($user_class)));
        $user_letter = $connect->escape(trim(htmlspecialchars($user_letter)));

        $user_pass = $connect->escape(trim(htmlspecialchars($user_pass)));
        $user_r_pass = $connect->escape(trim(htmlspecialchars($user_r_pass)));


        if (!isLen($user_name, 1, 256)) $results['error'] = "Введите Ваше имя";
        elseif (!isLen($user_family, 1, 256)) $results['error'] = "Введите Вашу фамилию";
        elseif (!isLen($user_school, 1, 5)) $results['error'] = "Введите номер вашей школы";
        elseif (!isLen($user_class, 1, 2)) $results['error'] = "Введите Ваш класс";
        elseif (!isLen($user_letter, 1, 1)) $results['error'] = "Введите букву Вашего класса";
        elseif (!rus($user_letter)) $results['error'] = "Буква класса должна быть на русском языке";
        elseif (!isLen($user_pass, 1, 256)) $results['error'] = "Введите Ваш пароль";
        elseif (!isLen($user_r_pass, 1, 256)) $results['error'] = "Подтвердите Ваш пароль";

        else {

            if ($user_pass != $user_r_pass) $results['error'] = "Ваши пароли не совпадают";
            else {
                $user_pass = md5($user_pass);
                $user_classroom = mb_strtolower($user_class."-".$user_letter);
                $user = AUTH::getUserByLogin($user_email);
                if (!isErr($user)) $results['error'] = "Данный логин занят!";
                else {
                    $fields = "user_name, user_family, user_email, user_school, user_class, user_password, user_date_add";
                    $data = "'$user_name', '$user_family', '$user_email', '$user_school', '$user_classroom', '$user_pass', NOW()";
                    $sql = "INSERT INTO user ($fields) VALUES ($data)";

                    if (!$result = $connect->query($sql)) {
                        $results['error'] = "Ошибка регистрации .. ";
                        LOG::sendLog($connect->err());
                    } else {
                        $user_id = $connect->insertId();
                        self::setCookieUser($user_id, $user_email, $user_pass);
                        self::sessionStart(true);
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_email'] = $user_email;
                        $_SESSION['user_name'] = $user_name;
                        $_SESSION['user_family'] = $user_family;
                    }
                }
            }
        }
        return $results;
    }

    public static function logout() {
        self::clearCookieUser();
        if (self::isAuth()) {
            session_unset();
            $params = session_get_cookie_params();
            setcookie(session_name(), "", time() - 3600 * 24 * 30 * 12, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
            session_destroy();
        }
    }

    private static function setCookieUser($user_id, $user_email, $user_pass) {
        setcookie("user_id", $user_id, time() + 60 * 60 * 24 * 30, "/");
        setcookie("userHash", md5($user_email . $user_pass), time() + 60 * 60 * 24 * 30, "/");
    }

    private static function clearCookieUser() {
        setcookie("user_id", "", time() - 3600 * 24 * 30 * 12, "/");
        setcookie("userHash", "", time() - 3600 * 24 * 30 * 12, "/");
    }

    public static function isAuth() {
        if (session_id()) {
            if (isset($_SESSION['user_id'])) return true;
        }
        return false;
    }

    public static function getUserId() {
        if (self::isAuth()) {
            return $_SESSION['user_id'];
        }
        return -1;
    }

}
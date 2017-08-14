<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.07.2017
 * Time: 20:37
 */

function is($arr, $keys) {
    if (is_array($arr) && is_array($keys)) {
        foreach ($keys as $key) {
            if (!isset($arr[$key])) return false;
        }
        return true;
    }
    return false;
}

function isErr($r) {
    if (is_array($r) && isset($r['error'])) return true;
    else return false;
}

function len($str) {
    return mb_strlen($str, "utf-8");
}

function isLen($str, $min, $max) {
    if (len($str) < $min || len($str) > $max) return false;
    return true;
}

function shortMess($text) {
    if (mb_strlen($text) < 50) {
        return $text;
    } else {
        $result = mb_substr($text, 0, 50, 'UTF-8');
        return $result . "...";
    }

}

function rus($letter) {
    if($letter == "a") return false;
    elseif ($letter == "B") return false;
    elseif ($letter == "C" or $letter == "c") return false;
    else return true;
}

function strToFormatTime($str, $minimun_show = 0) {
    $strtime = "";
    $day = 0;
    $hour = 0;
    $min = $str;
    if ($min >= 60) {
        $hour = floor($min / 60);
        $min -= $hour * 60;
        if ($hour >= 24) {
            $day = floor($hour / 24);
            $hour -= $day * 24;
        }
    }

    $hour = floor($hour);
    $day = floor($day);
    $min = floor($min);

    $setCount = 0;
    if ($minimun_show === 0 || $minimun_show > $setCount) {
        if ($day > 0) {
            $setCount++;
            if ($day < 10 || $day > 20) {
                if (substr($day, -1) == 1) $strtime .= "$day день ";
                elseif (substr($day, -1) < 5 && substr($day, -1) > 0) $strtime .= "$day дня назад ";
                else $strtime .= "$day дней назад ";
            } else $strtime .= "$day дней назад ";
        }
    }
    if ($minimun_show === 0 || $minimun_show > $setCount) {
        if ($hour > 0) {
            $setCount++;
            if ($hour < 10 || $hour > 20) {
                if (substr($hour, -1) == 1) $strtime .= "$hour час назад ";
                elseif (substr($hour, -1) < 5 && substr($hour, -1) > 0) $strtime .= "$hour часа назад ";
                else $strtime .= "$hour часов назад ";
            } else $strtime .= "$hour часов назад ";
        }
    }
    if ($minimun_show === 0 || $minimun_show > $setCount) {
        if ($min > 0) {
            $setCount++;
            if ($min < 10 || $min > 20) {
                if (substr($min, -1) == 1) $strtime .= "$min минута назад ";
                elseif (substr($min, -1) < 5 && substr($min, -1) > 0) $strtime .= "$min минуты назад ";
                else $strtime .= "$min минут назад ";
            } else $strtime .= "$min минут назад ";
        }
    }
    if (strlen($strtime) == 0) {
        $strtime .= "только что";
    }
    return $strtime;
}
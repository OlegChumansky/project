<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.07.2017
 * Time: 20:27
 */

require_once 'FUNCTIONS/index.php';
AUTH::autentificationCookies();
if(!AUTH::isAuth()) header("Location: login.php");
else {
    header("Location: profile.php");
}
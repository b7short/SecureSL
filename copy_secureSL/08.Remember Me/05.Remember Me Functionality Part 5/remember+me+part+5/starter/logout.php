<?php
    require_once("includes/db.php");
    require_once("includes/functions.php");
    ob_start();
    session_start();

    if(isset($_COOKIE['_ucv_'])) {
        setcookie('_ucv_', '', time() - 60 * 60);
    }

    if(isset($_SESSION['login'])) {
        session_destroy();
        unset($_SESSION['login']);
        header("Location: login.php");
    }

    header("Location: login.php");

?>
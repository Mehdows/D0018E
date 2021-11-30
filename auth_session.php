<?php
    session_start();
    if(!isset($_SESSION["customer_ID"])) {
        header("Location: login.php");
        exit();
    }
?>
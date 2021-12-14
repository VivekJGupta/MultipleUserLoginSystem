<?php
    session_start();
    session_destroy();
    unset($_SESSION['counter']);
    session_unset();
    header('Location: login.php');
?>
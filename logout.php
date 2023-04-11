<?php
    require "include/bd.php";

    session_start();
    setConnectionOff($_SESSION['id']);
    session_destroy();
    header('Location: index.php');
?>
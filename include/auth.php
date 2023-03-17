<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

if ( empty($_SESSION['nom']) ) {
  header('Location: login.php');
}

?>
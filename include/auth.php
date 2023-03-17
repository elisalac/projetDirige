<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

if ( empty($_SESSION['id']) ) {
  header('Location: connexion.php');
}

?>
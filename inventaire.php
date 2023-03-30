<?php
    require "include/auth.php";
    require "include/header.php";
    require "include/bd.php";
    $idJoueur=$_SESSION['id'];
?>
<!DOCTYPE html>
<html>
    bruh
    <?php

    $itemInv = AfficherInventaireJoueur($idJoueur);
    while($row = $itemInv->fetch())
    {
        echo '<a href="http://167.114.152.54/~darquest2/detail.php?idItems=' . $row['idItems'] . '">';
        echo "<div>";
        echo " Quantité dans l'inventaire : ". $row['qteInventaire'] . "";
        echo "<br>";
        echo "</div>";
        echo '</a>';
    }
    
    ?>
</html>
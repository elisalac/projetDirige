<?php
    require "include/auth.php";
    require "include/header.php";
    require "include/bd.php";
    $idJoueur=$_SESSION['id'];
?>
<!DOCTYPE html>
<html>
    <?php

    $itemInv = AfficherInventaireJoueur($idJoueur);
    while($row = $itemInv->fetch())
    {
        echo '<a href="http://167.114.152.54/~darquest2/detail.php?idItems=' . $row['idItems'] . '">';
        echo "<div>";
        echo "Nom de l'item : ". $row['nom'] . "";
        echo "<br>";
        echo "<img src='images/Items/". $row['image'] ."' width='200' height='150'>";
        echo "<br>";
        echo " Quantité dans l'inventaire : ". $row['qteInventaire'] . "";
        echo "<br>";
        echo "</div>";
        echo '</a>';
    }
    
    ?>
</html>
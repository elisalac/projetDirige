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
    
    $infoItem = AfficherInfoItem($idItem);
    while($row = $infoItem->fetch())
    {
        echo "<div>";
        echo "Nom de l'item : ". $row['nom'] . "";
        echo "<br>";
        echo "<img src='images/Items/". $row['image'] ."' width='200' height='150'>";
        echo "<br>";
        echo "</div>";
    }
    $itemInv = AfficherInventaireJoueur($idJoueur);
    while($row = $itemInv->fetch())
    {
        echo "<div>";
        echo " Quantité dans l'inventaire : ". $row['qteInventaire'] . "";
        echo "<br>";
        echo "</div>";
    }
    
    ?>
</html>
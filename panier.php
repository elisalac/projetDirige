<?php
    require "include/auth.php";
    require "include/header.php";
    require "include/bd.php";
    $idJoueur=$_SESSION['id'];
    //La procedure pour payer le panier est prete elle prend en paramètre le id du joueur Call PayerPanier(id)
?>
<!DOCTYPE html>
<html>
    <?php
       $panier = GetPanierJoueur($idJoueur);
     echo "<table>";
       foreach($panier as $range)
       {
           echo "<tr>";
               echo "<td>".$range['IdItem']."</td>";
           echo "</tr>";
       }
    echo "</table>";
    ?>
</html>
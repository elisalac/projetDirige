<?php
    require "include/auth.php";
    require "include/header.php";
    require "include/bd.php";
    $idJoueur=$_SESSION['id'];
    //La procedure pour payer le panier est prete elle prend en paramètre le id du joueur Call PayerPanier(id)
  
    $panier = GetPanierJoueur($idJoueur);
?>
<!DOCTYPE html>
<html>
    <?php
     echo "<table>";
       foreach($panier as $range)
       {
           echo "<tr>";
           echo "<td>"."<img src='images/Items/". $range['image'] ."' width='200' height='150'>"."</td><td>".$range['nom']."</td>";
           echo "</tr>";
       }
    echo "</table>";
    ?>
</html>
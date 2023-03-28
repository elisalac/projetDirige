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
<<<<<<< Updated upstream
               echo "<td>".$range['idItem']."</td>";
=======
               echo "<td>".$range['image']."</td><td>".$range['IdItem']."</td>";
>>>>>>> Stashed changes
           echo "</tr>";
       }
    echo "</table>";
    ?>
</html>
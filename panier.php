<?php
    require "include/auth.php";
    require "include/header.php";
    require "include/bd.php";
    $idJoueur=$_SESSION['id'];
    //La procedure pour payer le panier est prete elle prend en paramètre le id du joueur Call PayerPanier(id)

    

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['modifier']))
        {
           $qteItem=$_POST['qteItem'];   
        }
        if(isset($_POST['delete']))
        {
           $idItem= $_POST['delete'];
           RetirerPanier($idJoueur,$idItem);
        }
        if(isset($_POST['modifier']))
        {

        }
        if(isset($_POST['checkout']))
        {
            echo $idJoueur;
            PayerPanier($idJoueur);
        }
    }
    $panier = GetPanierJoueur($idJoueur);
    $solde = AfficherSolde($idJoueur);

?>
<!DOCTYPE html>
<html>
    <?php
       $panier = GetPanierJoueur($idJoueur);
     echo "<table>";
       foreach($panier as $range)
       {
           echo "<tr>";
           echo "<td><img src='images/Items/". $range['image'] ."' width='200' height='150'>"."</td>
           <td>"
           .$range['nom'].'
           <td>
           <form method="post">
           <input type="number" name="qtePanier" value="'.$range['qteItem'].'" required /><button type="submit" name="modifier">Modifier</button></td><td>'.$range['prixUnitaire']*$range['qteItem'].'</td><td><button type="submit" name="delete" value="'.$range['IdItem'].'" >Retirer</button>'.'<input type="hidden" name="idItem" value='.$range['IdItem'].'/>
           </form>';
           echo "</tr>";
       }
       echo "</table>";
       echo "Total : ".$solde['Solde']."";
    ?>
    <form method="post">
        <input type="submit" name="checkout" value="Payer le panier">
    </form>
</html>
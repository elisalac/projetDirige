<?php
    require "include/auth.php";
    require "include/header.php";
    $idJoueur=$_SESSION['id'];
    //La procedure pour payer le panier est prete elle prend en paramètre le id du joueur Call PayerPanier(id)

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['modifier']))
        {
           $qteItem=$_POST['qtePanier'];  
           $idItem = $_POST['idItem'];
           ModifierPanier($idJoueur,$idItem,$qteItem);
        }
        if(isset($_POST['delete']))
        {
           $idItem= $_POST['delete'];
           RetirerPanier($idJoueur,$idItem);
        }
        if(isset($_POST['checkout']))
        {
            PayerPanier($idJoueur);
        }
    }
    $panier = GetPanierJoueur($idJoueur);
    $solde = AfficherSolde($idJoueur);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Panier</title>
        <style>
            body{
                background-color: #3f3e53;
                color: white;
                font-size:20px;
            }

            table{
                width:100%;
                border-collapse:separate; 
                border-spacing: 0 1em;
            }

            table tr{
                outline:white thin solid;
            }

            input[type=number]{
                width:100px;
            }
        </style>
    </head>
    <body>
        <?php
            echo "<table>";
            foreach($panier as $range)
            {
                echo "<tr>";
                echo "<td>
                        <img src='images/Items/". $range['image'] ."' width='200' height='150'>
                    </td>
                    <td>
                        <p><u>Nom de l'item:</u> ".$range['nom'].'</p>
                    <td>
                        <form method="post">
                            <input type="number" name="qtePanier" value="'.$range['qteItem'].'" required />
                            <button type="submit" name="modifier">Modifier</button>
                    </td>
                    <td>
                            <p><u>Prix:</u> '.$range['prixUnitaire']*$range['qteItem'].'</p>
                    </td>
                    <td>
                            <button type="submit" name="delete" value="'.$range['IdItem'].'" >Retirer</button> 
                            <input type="hidden" name="idItem" value='.$range['IdItem'].'/>
                        </form>';
                echo "</tr>";
            }
            echo "</table>";
            echo "<p style='font-size:25px'><u>Total:</u> ".$solde['Solde']."</p>";
        ?>
        <form method="post">
            <input type="submit" name="checkout" value="Payer le panier"/>
        </form>
    </body>
</html>
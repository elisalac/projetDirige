<?php
    require "include/auth.php";
    require "include/header.php";
    require "include/bd.php";
    $idJoueur=$_SESSION['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inventaire</title>
        <style>
            body{
                background-color: #3f3e53;
            }

            .inventaireDiv{
                display: grid;
                width:100%;
                
            }

            a{
                color:white;
                font-size: 25px;
                text-decoration: none;
            }

            a:visited{
                color:white;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
    <?php
    echo "<hr>";
    $itemInv = AfficherInventaireJoueur($idJoueur);
    while($row = $itemInv->fetch())
    {
        echo '<a href="http://167.114.152.54/~darquest2/detail.php?idItems=' . $row['idItems'] . '">';
        echo "<div class='inventaireDiv'>";
        echo "<img src='images/Items/". $row['image'] ."' width='200' height='150'>";
        echo "<p>Nom de l'item : ". $row['nom'] . "</p>";
        echo "<p>Quantité dans l'inventaire : ". $row['qteInventaire'] . "</p>";
        echo "</div>";
        echo '</a>';
    }
    
    ?>
    </body>
</html>
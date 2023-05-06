<?php
    require "include/auth.php";
    require "include/header.php";
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
                margin-top:10px;
                display: grid;
                grid-template-columns: 1fr 2fr 2fr 1fr;
                width:100%;
                border:1px white solid;
                text-align:center;
                box-shadow: black 2px 2px 5px;
            }

            .bodyCSS a{
                color:white;
                font-size: 25px;
                text-decoration: none;
            }

            .bodyCSS a:visited{
                color:white;
                text-decoration: none;
            }

            .inventaireDiv img{
                margin-left:auto;
                max-width: 150px;
                max-height: 150px;
            }

            .inventaireDiv p{
                margin-top:60px;
            }

            .infoJoueur{
                position:absolute; left:60px; top:10px;
            }

            .infoJoueur p{
                color:white;
                margin:20px;
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <div class="bodyCSS">
            <?php
                echo "<hr>";
                $itemInv = AfficherInventaireJoueur($idJoueur);
                while($row = $itemInv->fetch())
                {
                    if(isset($_POST['vendreButton'])){
                        VendreItemInventaire($_SESSION['id'], $row['idItems']);
                    }
                    echo '<a href="http://167.114.152.54/~darquest2/detail.php?idItems=' . $row['idItems'] . '">';
                    echo "<div class='inventaireDiv'>";
                    echo "<img src='images/Items/". $row['image'] ."' width='200' height='150'>";
                    echo "<p><u>Nom de l'item:</u> ". $row['nom'] . "</p>";
                    echo "<p><u>Quantité dans l'inventaire:</u> ". $row['qteInventaire'] . "</p>";
                    echo '<form method="post">';
                    echo '<input type="submit" value="Vendre" name="vendreButton" style="margin-top:55px; width:75px; height:35px; font-size:15px; background-color:#504aa5; border:0px;">';
                    echo '</form>';
                    echo "</div>";
                    echo '</a>';
                }
            ?>
        </div>
    </body>
</html>
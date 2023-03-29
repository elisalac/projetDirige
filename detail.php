<?php
    session_start();
    require "include/header.php";
    require "include/bd.php";

    // faire une verification de c'est quelle item avant de pouvoir essayer c'est quoi mettre la fonctionm qui verifie ele id
    #foreach($item as $range)
    $idItem = $_GET["idItems"];
    $_SESSION['idItems'] = $idItem;
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Détail</title>
        <style>
            body{
                text-align: center;
            }
            img{
                max-width: 200px;
                max-height: 350px;
            }
            p{
                font-size: 25px;
            }
        </style>
    </head>
    <body>
        <?php
            /// Faire comme gestimage pour afficher les info de la table Items pour qu'il fusionne avec les info des items
            // précis faire un inner join

            $typeItem = VerifierIdPourtypeItem($idItem);
            
            $infoItem = AfficherInfoItem($idItem);
            $item = "";
            while($row = $infoItem->fetch())
            {
                echo "<div>";
                echo "<img src='images/Items/". $row['image'] ."'>";
                echo "<br>";
                echo "<p>Nom de l'item : ". $row['nom'] . "</p>";
                echo "<p>Quantité en stock : ". $row['qteStock'] . "</p>";
                echo "<p>Prix : ". $row['prixUnitaire'] . "</p>";
                echo "<p>Poids: ". $row['poids'] . " lbs</p>";
                echo "</div>";
            }

            if($typeItem === 'A')
            {
                $detailArme =  AfficherDetailArme($idItem);
                while($infoArme = $detailArme->fetch())
                {
                        echo "<p>Efficacité de l'arme: ". $infoArme['efficacité'] . "</p>";
                        echo "<p>Description de l'arme: ". $infoArme['description'] . "</p>";
                        echo "<p>Genre de l'arme: ". $infoArme['genre'] . "</p>";
                }
            }

            if($typeItem === 'R')
            {
                $detailArmure =  AfficherDetailArmures($idItem);
                while($infoArmure = $detailArmure->fetch())
                {
                        echo "<p>Taille de l'armure: ". $infoArmure['taille'] . "</p>";
                        echo "<p>Matiere de l'armure: ". $infoArmure['matiere'] . "</p>";
                }
            }

            if($typeItem === 'P')
            {
                $detailPotion = AfficherDetailPotion($idItem);
                while($infoPotion = $detailPotion->fetch())
                {
                        echo "<p>Effet attendu: ". $infoPotion['effetAttendu'] . "</p>";
                        echo "<p>Durée de l'effet: ". $infoPotion['durée'] . "</p>";
                }
            }

            if($typeItem === 'S')
            {
                $detailSort = AfficherDetailSorts($idItem);
                while($infoSort = $detailSort->fetch())
                {
                        echo "<p>est Instantané: ". $infoSort['estInstantané'] . "</p>";
                        echo "<p>Point de dégats: ". $infoSort['nombreDégats'] . "</p>";
                }
            }
        ?>
    </body>
</html>
<?php
    session_start();

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
                background-color: #3f3e53;
                color:white;
            }
            img{
                max-width: 150px;
                max-height: 300px;
            }
            p{
                font-size: 20px;
                margin:15px;
            }
            u{
                font-size: 22px;
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
    <?php
        require "include/header.php";
    ?>
    <body>
        <?php
            /// Faire comme gestimage pour afficher les info de la table Items pour qu'il fusionne avec les info des items
            // précis faire un inner join

            $typeItem = VerifierIdPourtypeItem($idItem);
            
            $infoItem = AfficherInfoItem($idItem);
            $item = "";
            $nbInventaire = 0;
            while($row = $infoItem->fetch())
            {
                echo "<hr>";
                echo "<div style='margin-top:15px'>";
                echo "<img src='images/Items/". $row['image'] ."'>";
                echo "<p style='font-size:23px'>". $row['nom'] . "</p>";
                echo "<p><u>Quantité en stock:</u> ". $row['qteStock'] . "</p>";
                if(isset($_SESSION['id'])){
                    $nbInventaire = AfficherNbInventaire($_SESSION['id'], $row['idItems']);
                    echo '<p><u>Nombre en inventaire:</u> ' . $nbInventaire . '</p>';
                }
                echo "<p><u>Prix:</u> ". $row['prixUnitaire'] . " Or</p>";
                echo "<p><u>Poids:</u> ". $row['poids'] . " lbs</p>";
                
            }

            if($typeItem === 'A')
            {
                $detailArme =  AfficherDetailArme($idItem);
                while($infoArme = $detailArme->fetch())
                {
                        echo "<p><u>Efficacité de l'arme:</u> ". $infoArme['efficacité'] . "</p>";
                        echo "<p><u>Description de l'arme:</u> ". $infoArme['description'] . "</p>";
                        echo "<p><u>Genre de l'arme:</u> ". $infoArme['genre'] . "</p>";
                        echo "</div>";
                }
            }

            if($typeItem === 'R')
            {
                $detailArmure =  AfficherDetailArmures($idItem);
                while($infoArmure = $detailArmure->fetch())
                {
                        echo "<p><u>Taille de l'armure:</u> ". $infoArmure['taille'] . "</p>";
                        echo "<p><u>Matiere de l'armure:</u> ". $infoArmure['matiere'] . "</p>";
                        echo "</div>";
                }
            }

            if($typeItem === 'P')
            {
                $detailPotion = AfficherDetailPotion($idItem);
                while($infoPotion = $detailPotion->fetch())
                {
                        echo "<p><u>Effet attendu:</u> ". $infoPotion['effetAttendu'] . "</p>";
                        echo "<p><u>Durée de l'effet:</u> ". $infoPotion['durée'] . "</p>";
                        echo "</div>";
                }
            }

            if($typeItem === 'S')
            {
                $detailSort = AfficherDetailSorts($idItem);
                while($infoSort = $detailSort->fetch())
                {
                    if($infoSort['estInstantané'] == 'o'){
                        echo "<p><u>Est Instantané:</u> Oui</p>";
                    }
                    if($infoSort['estInstantané'] == 'n'){
                        echo "<p><u>Est Instantané:</u> Non</p>";
                    }
                        echo "<p><u>Point de dégats:</u> ". $infoSort['nombreDégats'] . "</p>";
                        echo "</div>";
                }
            }

            if($nbInventaire != 0 && isset($_SESSION['id'])){
                echo '<div class="vendreContainerButton">';
                echo '<form method="post">';
                echo '<input type="submit" value="Vendre" name="vendreButton" style="width:75px; height:35px; font-size:15px; background-color:#504aa5; border:0px;">';
                echo '</form>';
                echo '</div>';
            }
        ?>
    </body>
</html>
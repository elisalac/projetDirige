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
</head>

<body>


<?php
/// Faire comme gestimage pour afficher les info de la table Items pour qu'il fusionne avec les info des items
// précis faire un inner join

$typeItem = VerifierIdPourtypeItem($idItem);
$type = "";
while($range = $typeItem->fetch())
{
    echo $range['typeItem'] . "<br>";
    $type = $range['typeItem'];
}


$infoItem = AfficherInfoItem($idItem);
$item = "";
while($row = $infoItem->fetch())
{
    echo "<div>";
    echo "Nom de l'item : ". $row['nom'] . "";
    echo "<br>";
    echo " Quantité en stock : ". $row['qteStock'] . "";
    echo "<br>";
    echo " Prix : ". $row['prixUnitaire'] . "";
    echo "<br>";
    echo "<img src='images/Items/". $row['image'] ."' width='200' height='150'>";
    echo "<br>";
    echo " Poids: ". $row['poids'] . " lbs";
    echo "</div>";
}

// echo "".$type."";

if($type === 'A')
{
    
    $detailArme =  AfficherDetailArme($idItem);
    while($infoArme = $detailArme->fetch())
    {
            echo "Efficacité de l'arme: ". $infoArme['efficacité'] . "<br>" ."<br>";
            echo "Description de l'arme: ". $infoArme['description'] . "<br>" ."<br>";
            echo "Genre de l'arme: ". $infoArme['genre'] . "<br>" ."<br>";
    }
    
}
if($type === 'R')
{
    $detailArmure =  AfficherDetailArmures($idItem);
    while($infoArmure = $detailArmure->fetch())
    {
            echo "Taille de l'armure: ". $infoArmure['taille'] . "<br>" ."<br>";
            echo "Matiere de l'armure: ". $infoArmure['matiere'] . "<br>" ."<br>";
    }
    
}
if($type === 'P')
{
    $detailPotion = AfficherDetailPotion($idItem);
    while($infoPotion = $detailPotion->fetch())
    {
            echo "Effet attendu: ". $infoPotion['effetAttendu'] . "<br>" ."<br>";
            echo "Durée de l'effet: ". $infoPotion['durée'] . "<br>" ."<br>";
    }
    
}
if($type === 'S')
{
    $detailSort = AfficherDetailSorts($idItem);
    while($infoSort = $detailSort->fetch())
    {
            echo "est Instantané: ". $infoSort['estInstantané'] . "<br>" ."<br>";
            echo "Point de dégats: ". $infoSort['nombreDégats'] . "<br>" ."<br>";
    }
    
}

?>
</body>
</html>
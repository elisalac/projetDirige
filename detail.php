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
   # echo "<p>ALLO</p>";
}



echo "".$type."";

if($type === 'A')
{
    
    $detailArme =  AfficherDetailArme($idItem);
    while($infoArme = $detailArme->fetch())
    {
        // Quand on va avoir fait un folder_image il faudrat afficher les images 
            // le  nom de l'item
            echo "ALLOOOOOOOO";
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
       // Quand on va avoir fait un folder_image il faudrat afficher les images 
            // le  nom de l'item
            echo "Taille de l'arme: ". $infoArmure['taille'] . "<br>" ."<br>";
            echo "Matiere de l'arme: ". $infoArmure['matiere'] . "<br>" ."<br>";
    }
    
}
if($typeItem === 'P')
{
    $detailPotion = AfficherDetailPotion($idItem);
    while($infoPotion = $detailPotion->fetch())
    {
        // Quand on va avoir fait un folder_image il faudrat afficher les images 
            // le  nom de l'item
            echo "Effet attendu: ". $infoPotion['effetAttenu'] . "<br>" ."<br>";
            echo "Durée de l'effet: ". $infoPotion['durée'] . "<br>" ."<br>";
    }
    
}
if($typeItem === 'S')
{
    $detailSort = AfficherDetailSorts($idItem);
    while($infoSort = $detailSort->fetch())
    {
        // Quand on va avoir fait un folder_image il faudrat afficher les images 
            // le  nom de l'item
            echo "est Instantané: ". $infoSort['estInstantané'] . "<br>" ."<br>";
            echo "Point de dégats: ". $infoSort['nombreDégatss'] . "<br>" ."<br>";
    }
    
}

?>
</body>

</html>
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


$typeItem = VerifierIdPourtypeItem($idItem);
while($range = $typeItem->fetch())
{
    echo $range['typeItem'] . "<br>";
   # echo "<p>ALLO</p>";
}

if($typeItem == 'A')
{
    $detailArme =  AfficherDetailArme($idItem);
    echo "<p>ALLO</p>";
}
if($typeItem == 'R')
{
    $detailArmure =  AfficherDetailArme($idItem);
    AfficherDetailArmures($idItem);
}
if($typeItem == 'P')
{
    AfficherDetailPotion($idItem);
}
if($typeItem == 'S')
{
    AfficherDetailSorts($idItem);
}

?>
</body>

</html>
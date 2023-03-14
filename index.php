<?php
    require "bd.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //Bouton tous items
        if(isset($_POST['tous'])){
            AfficherTousItem();   
        }

        //Liste déroulante filtre
        if(isset($_POST['filtre']) == "PrixAsc"){
            AfficherParPrixAsc();
        }
        if(isset($_POST['filtre']) == "PrixDesc"){
            AfficherParPrixDesc();
        }
        if(isset($_POST['filtre']) == "PoidsAsc"){
            AfficherParPoidsAsc();
        }
        if(isset($_POST['filtre']) == "PoidsDesc"){
            AfficherParPoidsDesc();
        }

        //Checkbox type items
        if(isset($_POST['checkboxArmes'])){
            AfficherParArmes();
        }
        if(isset($_POST['checkboxArmures'])){
            AfficherParArmures();
        }
        if(isset($_POST['checkboxPotions'])){
            AfficherParPotions();
        }
        if(isset($_POST['checkboxSorts'])){
            AfficherParSorts();
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Recherche</title>
</head>
<?php
    require "include/header.php";
?>
<nav style="background-color:aliceblue; width:100%; height:50%;">
    <form method="post">
        <input type="submit" value="Tous" name="tous">
    </form>
    <form method="post">
        <select name="filtre">
            <option value="PrixAsc">Par Prix ↓</option>
            <option value="PrixDesc">Par Prix ↑</option>
            <option value="PoidsAsc">Par Poids ↓</option>
            <option value="PoidsDesc">Par Poids ↑</option>
        </select>
    </form>
    <form method="post">
        <label for="checkboxArmes">Armes</label>
        <input type="checkbox" id="checkboxArmes" name="checkboxArmes">

        <label for="checkboxArmures">Armures</label>
        <input type="checkbox" id="checkboxArmures" name="checkboxArmures">

        <label for="checkboxPotions">Potions</label>
        <input type="checkbox" id="checkboxPotions" name="checkboxPotions">

        <label for="checkboxSorts">Sorts</label>
        <input type="checkbox" id="checkboxSorts" name="checkboxSorts">
    </form>
</nav>
<body>
    
</body>
</html>
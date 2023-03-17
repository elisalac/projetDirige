<?php
    require "include/bd.php";
    //require "include/auth.php";
    
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
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
<nav style="background-color:aliceblue; width:100%; padding:20px">
    <div style="display:inline-block; padding-left:10px; padding-right:10px; position:relative; bottom:40px;">
        <form method="post">
            <input type="submit" value="Tous" name="tous">
        </form>
    </div>
    <div style="display:inline-block; padding-left:10px; padding-right:10px; position:relative; bottom:40px;">
        <form method="post">
            <select name="filtre">
                <option value="PrixAsc">Par Prix ↓</option>
                <option value="PrixDesc">Par Prix ↑</option>
                <option value="PoidsAsc">Par Poids ↓</option>
                <option value="PoidsDesc">Par Poids ↑</option>
            </select>
        </form>
    </div>
    <div style="display:inline-block; padding-left:10px; padding-right:10px;">
        <form method="post">
            <label style="text-decoration:underline; font-size:20px;">Types</label>
            <br>
            <label for="checkboxArmes">Armes</label>
            <input type="checkbox" id="checkboxArmes" name="checkboxArmes">
            <br>
            <label for="checkboxArmures">Armures</label>
            <input type="checkbox" id="checkboxArmures" name="checkboxArmures">
            <br>
            <label for="checkboxPotions">Potions</label>
            <input type="checkbox" id="checkboxPotions" name="checkboxPotions">
            <br>
            <label for="checkboxSorts">Sorts</label>
            <input type="checkbox" id="checkboxSorts" name="checkboxSorts">
        </form>
    </div>
</nav>
<body>
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //Bouton tous items
            if(isset($_POST['tous'])){
                AfficherTousItems();   
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
            //1 type
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

            //2 types
            if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxArmures'])){
                AfficherParArmesArmures();
            }
            if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxPotions'])){
                AfficherParArmesPotions();
            }
            if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxSorts'])){
                AfficherParArmesSorts();
            }
            if(isset($_POST['checkboxArmures']) && isset($_POST['checkboxPotions'])){
                AfficherParArmuresPotions();
            }
            if(isset($_POST['checkboxArmures']) && isset($_POST['checkboxSorts'])){
                AfficherParArmuresSorts();
            }
            if(isset($_POST['checkboxPotions']) && isset($_POST['checkboxSorts'])){
                AfficherParPotionsSorts();
            }

            //3 types
            if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxArmures']) && isset($_POST['checkboxPotions'])){
                AfficherParArmesArmuresPotions();
            }
            if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxArmures']) && isset($_POST['checkboxSorts'])){
                AfficherParArmesArmuresSorts();
            }
            if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxPotions']) && isset($_POST['checkboxSorts'])){
                AfficherParArmesPotionsSorts();
            }
            if(isset($_POST['checkboxArmures']) && isset($_POST['checkboxPotions']) && isset($_POST['checkboxSorts'])){
                AfficherParArmuresPotionsSorts();
            }
        }
    ?>
</body>
</html>
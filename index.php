<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['tous'])){
            
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
<nav style="background-color:aliceblue; width:100%;">
    <form method="post">
        <input type="submit" value="Tous" name="tous">
    </form>
    <form>
        <select name="filtre">
            <option value="PrixAsc">Par Prix ↓</option>
            <option value="PrixDesc">Par Prix ↑</option>
            <option value="PoidsAsc">Par Poids ↓</option>
            <option>Par Poids ↑</option>
        </select>
    </form>
</nav>
<body>
    
</body>
</html>
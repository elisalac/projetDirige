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
<nav>
    <form method="post">
        <input type="submit" value="Tous" name="tous">
    </form>
</nav>
<body>
    
</body>
</html>
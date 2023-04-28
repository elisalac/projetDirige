<?php
session_start();
require "../include/auth.php";
require_once "../include/bd.php";
$idQuestion= "";
if (!empty($_POST['enigme'])) {
    $dropDownVal = $_POST['enigme'];
} else {
    $dropDownVal = "";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir une difficulté</title>
    <style>
         body{
            background-color: #3f3e53;
            color:white;
            text-align:center;
        }
        input[type=submit], button {
            background-color: #3f3e53;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
        }
    </style>
</head>

<body>
    <h1>DARQUEST</h1>
    <fieldset>
        <legend>Veuillez choisir une difficulté</legend>
        <form action="question.php" method="post">
            <select name="enigme" style="margin:20px;">
                <option value="F" <?php  if($dropDownVal == "PrixDesc")echo 'selected="selected"'; ?>>Facile</option>
                <option value="M" <?php  if($dropDownVal == "PrixDesc") echo 'selected="selected"'; ?>>Moyen</option>
                <option value="D" <?php  if($dropDownVal == "PrixDesc")echo 'selected="selected"'; ?>>Difficile</option>
                <option value="A" <?php  if($dropDownVal == "PrixDesc")echo 'selected="selected"'; ?>>Aléatoire</option>
            </select><br>
            <input type="hidden" name = "bruh" value = "<?php if(isset($_POST['Diff'])){echo $_POST['enigme'];} ?>">
            <tr>
                <td colspan="2" style="text-align: center;"><input type="submit" value="Valider" name="Diff"></td>
            </tr>
        </form>
        
    </fieldset>
</body>
<?php

require "../include/footerEnigma.php"

?>
</html>
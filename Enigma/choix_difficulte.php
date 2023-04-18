<?php
session_start();
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
                
            }
    </style>
</head>

<body>
    <h1>DARQUEST</h1>
    <fieldset>
        <legend>Veuillez choisir une difficulté</legend>
        <form action="choix_difficulte.php" method="post">
            <select name="enigme">
                <option value="F" <?php  if($dropDownVal == "PrixDesc")echo 'selected="selected"'; ?>>Facile</option>
                <option value="M" <?php  if($dropDownVal == "PrixDesc") echo 'selected="selected"'; ?>>Moyen</option>
                <option value="D" <?php  if($dropDownVal == "PrixDesc")echo 'selected="selected"'; ?>>Difficile</option>
                <option value="A" <?php  if($dropDownVal == "PrixDesc")echo 'selected="selected"'; ?>>Aléatoire</option>
            </select>
            <tr>
                <td colspan="2" style="text-align: center;"><input type="submit" value="Valider"></td>
            </tr>
        </form>
    </fieldset>
</body>
<?php
if(isset($_POST['enigme'])){
    
    if(!empty($_POST['enigme']))
    {
        if($_POST['enigme'] == "F")
        {
            //function $id = getQuestionFacile

        }
        
    }
}
require "../include/footerEnigma.php"

?>
</html>
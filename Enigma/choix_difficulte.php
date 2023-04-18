<?php
session_start();
require_once "../include/bd.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir une difficulté</title>
</head>

<body>
    <h1>DARQUEST</h1>
    <fieldset>
        <legend>Veuillez choisir une difficulté</legend>
        <form action="choix_difficulte.php" method="post">
            <select name="enigme">
                <option value="F" <?php echo 'selected="selected"'; ?>>Facile</option>
                <option value="M" <?php echo 'selected="selected"'; ?>>Moyen</option>
                <option value="D" <?php echo 'selected="selected"'; ?>>Difficile</option>
                <option value="A" <?php echo 'selected="selected"'; ?>>Aléatoire</option>
            </select>
            <tr>
                <td colspan="2" style="text-align: center;"><input type="submit" value="Valider"></td>
            </tr>
        </form>
    </fieldset>
</body>

</html>
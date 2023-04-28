<?php
session_start();
require "include/header.php";

if (isAdmin($_SESSION['id']) != 1) {
    header('Location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Vérifier si tous les champs sont remplis
    if (!empty($_POST["question"]) && !empty($_POST["reponse1"])
     && !empty($_POST["reponse2"]) && !empty($_POST["reponse3"])
      && !empty($_POST["reponse4"])) {


        $correcte = 1;
        $estFaux = 0;
        // Récupérer les données du formulaire
        $question = $_POST["question"];
        $reponse1 = $_POST["reponse1"];
        $reponse2 = $_POST["reponse2"];
        $reponse3 = $_POST["reponse3"];
        $reponse4 = $_POST["reponse4"];

        
        // Vérifier la réponse correcte
        

       if($_POST['enigme']=='F')
       {
            AjouterQuestion('F',$question);
       }
       if($_POST['enigme']=='M')
       {
            AjouterQuestion('M',$question);
       }
       if($_POST['enigme']=='D')
       {
            AjouterQuestion('D',$question);
       }

        
        if(!isset($_POST["bonneReponse"])){
            echo "Veuillez sélectionner la réponse correcte.";
        }  
        if ($_POST["bonneReponse"] == 1) {
            AjouterRéponse($reponse1,$correcte);
            AjouterRéponse($reponse2,$estFaux);
            AjouterRéponse($reponse3,$estFaux);
            AjouterRéponse($reponse4,$estFaux);
        }
        if ($_POST["bonneReponse"] == 2) {
            AjouterRéponse($reponse1,$estFaux);
            AjouterRéponse($reponse2,$correcte);
            AjouterRéponse($reponse3,$estFaux);
            AjouterRéponse($reponse4,$estFaux);
        } 
        if ($_POST["bonneReponse"] == 3) {
            AjouterRéponse($reponse1,$estFaux);
            AjouterRéponse($reponse2,$estFaux);
            AjouterRéponse($reponse3,$correcte);
            AjouterRéponse($reponse4,$estFaux);
        } 
        if ($_POST["bonneReponse"] == 4) {
            
            AjouterRéponse($reponse1,$estFaux);
            AjouterRéponse($reponse2,$estFaux);
            AjouterRéponse($reponse3,$estFaux);
            AjouterRéponse($reponse4,$correcte);
        }   
    
        // Afficher un message de confirmation
        echo "Merci d'avoir soumis votre question.";
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Formulaire de question</title>
    <style>
        body{
            background-color: #3f3e53;
            text-align: center;
        }
        
        .infoJoueur{
                position:absolute; left:60px; top:10px;
            }

        .infoJoueur p{
            color:white;
            margin:20px;
            font-size: 20px;
        }

        h1, td, label{
            color:white;
        }

        h1{
            margin-top:20vh;
        }
        table{
            margin-left: auto;
            margin-right: auto;
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
    <h1>Création de question pour Enigma</h1>
    <form action="ajouter_question.php" method="post">
        <table>
            <tr>
                <td>Sélectionner la difficulté de la question:</td>
                <td>
                    <?php
                    if (!empty($_POST['enigme'])) {
                        $difficulteEnigme = $_POST['enigme'];
                    } else {
                        $difficulteEnigme = "";
                    }
                    ?>
                    <select name="enigme">
                        <option value="F" <?php if ($difficulteEnigme == "F") echo 'selected="selected"'; ?>>Facile</option>
                        <option value="M" <?php if ($difficulteEnigme == "M") echo 'selected="selected"'; ?>>Moyen</option>
                        <option value="D" <?php if ($difficulteEnigme == "D") echo 'selected="selected"'; ?>>Difficile</option>
                    </select>
                </td>
            </tr>
        </table>
        <br>
        <br>

        <label for="question">Écrivez votre question :</label><br><br>
        <textarea id="question" name="question" rows="4" cols="50"></textarea><br><br>

       

        <label for="reponse1">Réponse A:</label>
        <input type="text" id="reponse1" name="reponse1">
        <input type="radio" id="bonneReponse1" name="bonneReponse" value="1">
        <br><br>
        <label for="reponse2">Réponse B:</label>
        <input type="text" id="reponse2" name="reponse2">
        <input type="radio" id="bonneReponse2" name="bonneReponse" value="2">
        <br><br>
        <label for="reponse3">Réponse C:</label>
        <input type="text" id="reponse3" name="reponse3">
        <input type="radio" id="bonneReponse3" name="bonneReponse" value="3">
        <br><br>
        <label for="reponse4">Réponse D:</label>
        <input type="text" id="reponse4" name="reponse4">
        <input type="radio" id="bonneReponse4" name="bonneReponse" value="4">
        <br><br>
        <input type="submit" value="Envoyer">
    </form>
</body>

</html>
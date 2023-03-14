<?php
require "bd.php";
    function EnvoyerEmail($courriel, $prenom, $nom, $pseudo, $mdp){
        
        $_SESSION['nomEnAttenteConfirmation'] = $nom;
        $_SESSION['prenomEnAttenteConfirmation'] = $prenom;
        $_SESSION['pseudoEnAttenteConfirmation'] = $pseudo;
        $_SESSION['passwordEnAttenteConfirmation'] = $mdp;
        $_SESSION['courrielEnAttenteConfirmation'] = $courriel;

        $sujet        = "Confirmer Email";
        $message      = "Bonjour, ". $_POST['prenom']. ". Veuillez confirmer votre inscription à l'adresse suivante: <a href='http://192.99.154.153/~elisa/Livrable1/confirmer.php'>http://192.99.154.153/~elisa/Livrable1/confirmer.php</a>";
        $entetes      = "From: "     . "www@gmail.com" . "\r\n" .
                        "Reply-To: " . "www@gmail.com" . "\r\n" .
                        "Content-Type: text/html; charset=utf-8\r\n" .
                        "X-Mailer: PHP/'". phpversion();

        $code = mail($courriel, $sujet, $message, $entetes);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Création du compte</title>
        <style>
            body{
                text-align:center;
            }
            
            input[type=text], input[type=password] {
            width: 20%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            }

            input[type=submit] {
            background-color: #006347;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            width: 10%;
            }

            footer{
                text-align: center;
                background-color: #D9F3FF;
            }
        </style>
    </head>
    <body>
        <h1>Inscription</h1>
        <form method="post">
            <input type="text" name="nom" id="nom" placeholder="Nom" required><br>
            <input type="text" name="prenom" id="prenom" placeholder="Prénom" required><br>
            <input type="text" name="pseudo" id="pseudo" placeholder="Pseudonyme" required><br>
            <input type="text" name="mdp" id="mdp" placeholder="Mot de passe" required><br>
            <input type="text" name="courriel" id="courriel" placeholder="Adresse courriel" required><br>
            <input type="submit" id="creationCompte" name="creationCompte" value="Créer le compte">
        </form>
        <form action="login.php">
            <input type="submit" id="retourLogin" name="retourLogin" value="Retour au login">
        </form>

        <?php
            if(isset($_POST['nom']))
                $nom = $_POST['nom'];
            if(isset($_POST['prenom']))
                $prenom = $_POST['prenom'];
            if(isset($_POST['pseudo']))
                $pseudo = $_POST['pseudo'];
            if(isset($_POST['mdp']))
                $mdp = $_POST['mdp'];
            if(isset($_POST['courriel']))
                $courriel = $_POST['courriel'];
            
            if($_SESSION['confirmer'] == true){
                InsertInscription();
                echo '<h3>Votre compte a été validé</h3>';
                $_SESSION['confirmer'] = false;
            }
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                echo "Un courriel a été envoyer à votre adresse courriel pour confirmer votre inscription";
                EnvoyerEmail($courriel, $prenom, $nom, $pseudo, $mdp);
            }
        ?>
    </body>
</html>
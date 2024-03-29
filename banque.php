<?php
    require "include/auth.php";
    require "include/header.php";
    $idJoueur=$_SESSION['id'];
    $message = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if(isset($_POST["demanderPiece"]))
        {
            // Verifier il lui reste combien de demandes(3)
             CheckerDemande($idJoueur);
            // Si c'est égal a 0 envoyer un message d'erreur
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                background-color: #3f3e53;
                text-align:center;
            }
            p{
                text-align: center;
                color:white;
            }
            h1{
                margin-top:25vh;
                text-align: center;
                color:white;
            }
            .infoJoueur{
                position:absolute; left:60px; top:10px;
            }

            .infoJoueur p{
                color:white;
                margin:20px;
                font-size: 20px;
            }
            .legendPiece{
                position:absolute;
                top: 120px;
                right: 30px;
                border:1px solid white;
                padding:10px;
            }
            .legendPiece p{
                color:white;
                font-size: 17px;
            }

            input[type=submit], button {
            background-color: #3f3e53;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
        }
        </style>
    </head>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
    <body>
        <hr>
        <h1>Demande de pièces à l'admin</h1>
        <div class="legendPiece">
            <p>1ère demande = 10 Or</p>
            <p>2ème demande = 10 Argent</p>
            <p>3ème demand = 10 Bronze</p>
        </div>
    <form action="" method="post">
        <div>
            <p>Nombre de demandes restantes :</p><?php ?>
        </div>
        <input type="submit" value="Envoyer une demande" name="demanderPiece">
    </form>

    </body>
</html>
<?php
    require "include/auth.php";
    require "include/header.php";
    $idJoueur=$_SESSION['id'];
    $message = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
        if(isset($_POST["demanderPiece"]))
        {
            // Verifier il lui reste combien de demandes(3)
             CheckerDemande($idJoueur);
=======
>>>>>>> Stashed changes
        $message = "";
        if(isset($_POST["demanderPiece"]))
        {
            // Verifier il lui reste combien de demandes(3)

<<<<<<< Updated upstream
=======
>>>>>>> 58aa0fec1741229cf4f63dbfb52fb72c36ac9446
>>>>>>> Stashed changes
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
            }
            p{
<<<<<<< Updated upstream
                
=======
<<<<<<< HEAD

=======
                
>>>>>>> 58aa0fec1741229cf4f63dbfb52fb72c36ac9446
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
            
=======
<<<<<<< HEAD

=======
            
>>>>>>> 58aa0fec1741229cf4f63dbfb52fb72c36ac9446
>>>>>>> Stashed changes

        </style>
    </head>
    <body>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
        <hr>
        <h1>Demande de pièces à l'admin</h1>
        <div class="legendPiece">
            <p>1ère demande = 10 Or</p>
            <p>2ème demande = 10 Argent</p>
            <p>3ème demand = 10 Bronze</p>
        </div>
<<<<<<< Updated upstream
        <form action="" method="post">
=======
<<<<<<< HEAD
    <form action="banque.php" method="post">
=======
        <form action="" method="post">
>>>>>>> 58aa0fec1741229cf4f63dbfb52fb72c36ac9446
>>>>>>> Stashed changes
        <div>
            <p>Nombre de demandes restantes :</p><?php ?>
        </div>
        <input type="submit" value="Envoyer une demande" name="demanderPiece">
<<<<<<< Updated upstream
        </form>
        
=======
<<<<<<< HEAD
    </form>

=======
        </form>
        
>>>>>>> 58aa0fec1741229cf4f63dbfb52fb72c36ac9446
>>>>>>> Stashed changes
    </body>
</html>
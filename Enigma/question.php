<?php
    require_once "../include/bd.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Question</title>
        <style>
            body{
                background-color: #3f3e53;
                text-align: center;
            }
            p{
                color: white;
                font-size: x-large;
            }
            div{
                margin-top: 30vh;
            }
            #divQuestion{
                margin-top: 30vh;
            }
            .divReponse{
                margin:20px;
                color:white;
                font-size: 20px;
            }
            .divResultat p{
                margin:20px;
            }
            input[type=submit], button {
                background-color: #3f3e53;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
            }
            .infoJoueur{
                position:absolute; left:60px; top:10px;
            }

            .infoJoueur p{
                color:white;
                margin:20px;
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <div id = "divQuestion">
            <?php
            if(!empty($_POST['enigme']))
            {
                if($_POST['enigme'] == "F")
                {
                    $idQuestion = getQuestionFacile();
                    
                }
                if($_POST['enigme'] == "M")
                {
                    $idQuestion = getQuestionMoyen();
                }
                if($_POST['enigme'] == "D")
                {
                    $idQuestion = getQuestionDifficile();
                }
                if($_POST['enigme'] == "A")
                {
                    $idQuestion = getQuestionAleatoire();
                }
                echo '<p>' . $idQuestion[1] . '</p>';
                $_SESSION['idQues'] = $idQuestion[0];

                echo '<form action="question.php" method ="post">';
                echo '<fieldset>';
                AfficherReponses( $idQuestion[0]);
                echo '<input type="submit" name="reponse" value="Soumettre">';
                echo '</fieldset>';
                echo '</form>';
            }
            
            if(isset($_POST['reponse']))
            {
                CheckerReponse($_POST['rep']);
            }
            ?>
        </div>
    </body>
    <div class="infoJoueur" style="position:absolute; left:60px; top:10px;">
            <?php
                if(isset($_SESSION['id'])){
                    $membre = getMembre($_SESSION['id']);
                    echo '<p>' . $membre['alias'] . " | Or: " . $membre['montantOr'] . " | Argent: ".$membre['montantArgent'].  " | Bronze: ".$membre['montantBronze']. '</p>';
                }
            ?>
    </div>
    <?php
        require "../include/footerEnigma.php"
    ?>
</html>
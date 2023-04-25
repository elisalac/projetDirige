<?php
    require_once "../include/bd.php"; 
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
        </style>
    </head>
    <body>
        <div>
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
                echo '<p>' . $idQuestion . '</p>';
            }
            ?>
        </div>
    </body>
    <?php
        require "../include/footerEnigma.php"
    ?>
</html>
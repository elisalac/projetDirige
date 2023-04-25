<?php
    require_once "../include/bd.php"; 
    require_once "../include/bd.php";
    session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
@ -30,28 +31,37 @@
    <body>
        <div id="divQuestion">
            <?php
            if(!empty($_POST['enigme']))
            if(isset($_SESSION['repondu']))
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
                AfficherReponses($_SESSION['idQuestion']);
            }
            else{
                if(!empty($_POST['enigme']))
                {
                    $idQuestion = getQuestionAleatoire();
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
                    $_SESSION['idQuestion'] = $idQuestion[0];
                    echo '<p>' . $idQuestion[1] . '</p>';
                    AfficherReponses( $idQuestion[0]);
                }
                echo '<p>' . $idQuestion[1] . '</p>';
                AfficherReponses( $idQuestion[0]);
            }
           

            
            ?>
        </div>
<?php
    
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
            }
        </style>
    </head>
    <body>
        <?php
            echo $_POST['idQuestion'];
        ?>
    </body>
    <?php
        require "../include/footerEnigma.php"
    ?>
</html>
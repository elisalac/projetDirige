<?php
    require "include/auth.php";
    require "include/header.php";

    if(isAdmin($_SESSION['id']) == 0){
        header('Location: index.php');
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
                font-size: 50px;
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
        </style>
    </head>
    <body>
        <hr>
        <p>Page en développement</p>
    </body>
</html>
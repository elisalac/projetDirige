<?php
    require "include/auth.php";
    require "include/header.php";

    if(isAdmin($_SESSION['id']) != 1){
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
            header p{
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

            .demandeDiv{
                border:1px solid white;
                width: 85vw;
                height: 85vh;
                position:absolute;
                top: 120px;
                overflow: scroll;
                overflow-x:hidden;
                color:white;
            }

            ::-webkit-scrollbar {
                width: 10px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                background: transparent; 
            }
            
            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #888; 
                border-radius: 5px;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #555; 
            }

            .infoJoueur{
                position:absolute; left:60px; top:10px;
            }

            .infoJoueur p{
                color:white;
                margin:20px;
                font-size: 20px;
            }

            @media only screen and (max-width: 1700px) {
                .demandeDiv{
                border:1px solid white;
                width: 80vw;
                height: 80vh;
                position:absolute;
                top: 120px;
                overflow: scroll;
                overflow-x:hidden;
                color:white;
            }
            }
        </style>
    </head>
    <body>
        <hr>
        <div class="legendPiece">
            <p>1ère demande = 10 Or</p>
            <p>2ème demande = 10 Argent</p>
            <p>3ème demand = 10 Bronze</p>
        </div>
        <div class="demandeDiv">
            
        </div>
    </body>
</html>
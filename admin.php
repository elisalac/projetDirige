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

            table{
                width:100%;
            }

            td{
                padding:15px;
                border-bottom:1px white solid;
            }

            input[type=submit], button {
                background-color: #3f3e53;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
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
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <body>
        <hr>
        <div class="legendPiece">
            <p>1ère demande = 10 Or</p>
            <p>2ème demande = 10 Argent</p>
            <p>3ème demand = 10 Bronze</p>
        </div>
        <div class="demandeDiv">
            <table>
                <?php
                
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $idJoueur = $_POST['idJoueur'];
                        $arrayInfo = AfficherAliasEtDemande($_POST['idJoueur']);

                        if(isset($_POST['buttonAccepter'])){
                            $idJoueur = $_POST['idJoueur'];
                            ApprouverDemande($idJoueur);
                        }
                    
                        if(isset($_POST['buttonRefuser'])){
                            $idJoueur = $_POST['idJoueur'];
                            RefuserDemande($idJoueur);
                        }
                    }
                    
                    $dataDemandes = AfficherDemande();
                    while($demande = $dataDemandes->fetch()){
                        
                        $arrayInfo = AfficherAliasEtDemande($demande['idJoueur']);
                        if($arrayInfo[1] <= 0 || $arrayInfo[1] > 3){
                            echo "Erreur de demande";
                        }
                        echo "<tr class='bottom-border'>";
                            echo "<td style='padding-left:40px'>Alias: " . $arrayInfo[0] . "</td>";
                            echo "<td>Numéro de demande: " . $arrayInfo[1] . "</td>";
                            echo "<form method='post'>";
                            echo "<td style='width:5%;'><button type='submit' value='". $demande['idJoueur']."' name='buttonAccepter'>Accepter</button></td>";
                            echo "<td><button type='submit' value='". $demande['idJoueur']."' name='buttonRefuser'>Refuser</button></td>";
                            echo '<input type="hidden" name="idJoueur" value='.$demande['idJoueur'].'/>';
                            echo "</form>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </body>
</html>
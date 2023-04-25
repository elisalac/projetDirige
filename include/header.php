<?php
    require "include/bd.php"
    
?><!DOCTYPE html>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
        <style>
            .dropdown {
                display: inline-block;
                position: relative;
            }

            #buttonProfil{
                height:60px; 
                width:60px; 
                border-radius:50%; 
                border:1px black solid; 
                background: url('images/profil/default_profil.png') 0px 4px no-repeat;
                background-color:#ddd;
            }

            #buttonProfil:hover{
                background: url('images/profil/default_profil.png') 0px 4px no-repeat;
                background-color:#ddd;
            }

            .dropdown-options {
            display: none;
            position: absolute;
            overflow: auto;
            background-color:#fff;
            border-radius:5px;
            z-index: 2;
            box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.4);

            color:black; 
            }

            .dropdown:hover .dropdown-options {
            display: block;
            }

            .dropdown-options a {
            display: block;
            color: #000000;
            padding: 5px;
            text-decoration: none;
            padding:20px 40px;
            font-size:25px;
            }

            .dropdown-options a:hover {
            color: #0a0a23;
            background-color: #ddd;
            border-radius:5px;
            }

            .buttonHeader {
                width:150px;
                height:50px;
                --b: 3px;
                --s: .45em;
                --color: white;
                
                padding: calc(.5em + var(--s)) calc(.9em + var(--s));
                color: var(--color);
                --_p: var(--s);
                background:
                    conic-gradient(from 90deg at var(--b) var(--b),#0000 90deg,var(--color) 0)
                    var(--_p) var(--_p)/calc(100% - var(--b) - 2*var(--_p)) calc(100% - var(--b) - 2*var(--_p));
                transition: .3s linear, color 0s, background-color 0s;
                outline: var(--b) solid #0000;
                outline-offset: .6em;
                font-size: 16px;

                border: 0;

                user-select: none;
                -webkit-user-select: none;
                touch-action: manipulation;
            }

            .buttonHeader:hover,
            .buttonHeader:focus-visible{
                --_p: 0px;
                outline-color: var(--color);
                outline-offset: .05em;
            }

            .buttonHeader:active {
                color: #fff;
            }
            

            @media only screen and (max-width: 900px) {
                input[type=submit]{
                    width:100px;
                }   

                .infoJoueur{
                    display: none;
                }
            }
        </style>
        
    </head>
    <header style="height:75px; width:100%;">
        <div style="position:absolute; left:15px; top:10px;">
            <div class="dropdown">
                <button id="buttonProfil"></button>
                <div class="dropdown-options">
                    <?php
                        if(isset($_SESSION['id'])){
                            echo '<a href="profil.php">Modifier votre profil</a>';
                            echo '<a href="Enigma/choix_difficulte.php">Enigma</a>';
                            //echo '<a href="stats.php">Statistiques</a>';
                            if(isAdmin($_SESSION['id']) == 1){
                                echo '<a href="admin.php">Admin</a>';
                                echo '<a href="ajouter_question.php">Ajouter Question</a>';
                            }
                            echo '<a href="logout.php">Déconnecter</a>';
                        }
                        else{
                            echo '<a href="connexion.php">Connexion</a>';
                        }
                    ?>
                </div>
            </div>
            
        </div>
        <div class="infoJoueur" style="position:absolute; left:60px; top:10px;">
            <?php
                if(isset($_SESSION['id'])){
                    $membre = getMembre($_SESSION['id']);
                    echo '<p>' . $membre['alias'] . " | Or: " . $membre['montantOr'] . " | Argent: ".$membre['montantArgent'].  " | Bronze: ".$membre['montantBronze']. '</p>';
                }
            ?>
        </div>
        <?php
            if(isset($_SESSION['id'])){
                echo '<div id="buttonRecherche" style="position:absolute; left:40vw; top:15px;">
                        <form action="index.php" method="post">
                            <input type="submit" value="Recherche" name="rechercheButton" class="buttonHeader">
                        </form> 
                    </div>
                    <div id="buttonInv" style="position:absolute; left:55vw; top:15px;">
                        <form action="inventaire.php" method="post">
                            <input type="submit" value="Inventaire" name="inventaireButton" class="buttonHeader">
                        </form>
                    </div>
                    <div id="buttonPanier" style="position:absolute; left:70vw; top:15px;">
                        <form action="panier.php" method="post">
                            <input type="submit" value="Panier" name="panierButton" class="buttonHeader">
                        </form>
                    </div>
                    <div id="buttonBanque" style="position:absolute; left:85vw; top:15px;">
                        <form action="banque.php" method="post">
                            <input type="submit" value="Banque" name="BanqueButton" class="buttonHeader">
                        </form>
                    </div>';
            }
            else{
                echo '<div id="buttonRecherche" style="position:absolute; left:85vw; top:15px;">
                        <form action="index.php" method="post">
                            <input type="submit" value="Recherche" name="rechercheButton" class="buttonHeader">
                        </form> 
                    </div>';
            }
        ?>
    </header>
</html>
<!DOCTYPE html>
<html>
    <head>
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
            box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.4);
            z-index: 2;
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
            }

            .dropdown-options a:hover {
            color: #0a0a23;
            background-color: #ddd;
            border-radius:5px;
            }

            .buttonHeader{
                width:150px; height:35px; font-size:15px; background-color:white; border:0px;
            }

            @media only screen and (max-width: 900px) {
                input[type=submit]{
                    width:100px;
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
                            //echo '<a href="profil.php">Modifier votre profil</a>';
                            //echo '<a href="stats.php">Statistiques</a>';
                            echo '<a href="logout.php">Déconnecter</a>';
                        }
                        else{
                            echo '<a href="connexion.php">Connexion</a>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
            if(isset($_SESSION['id'])){
                echo '<div id="buttonRecherche" style="position:absolute; left:40vw; top:25px;">
                        <form action="index.php" method="post">
                            <input type="submit" value="Recherche" name="rechercheButton" class="buttonHeader">
                        </form> 
                    </div>
                    <div id="buttonInv" style="position:absolute; left:55vw; top:25px;">
                        <form action="inventaire.php" method="post">
                            <input type="submit" value="Inventaire" name="inventaireButton" class="buttonHeader">
                        </form>
                    </div>
                    <div id="buttonPanier" style="position:absolute; left:70vw; top:25px;">
                        <form action="panier.php" method="post">
                            <input type="submit" value="Panier" name="panierButton" class="buttonHeader">
                        </form>
                    </div>
                    <div id="buttonBanque" style="position:absolute; left:85vw; top:25px;">
                        <form action="banque.php" method="post">
                            <input type="submit" value="Banque" name="BanqueButton" class="buttonHeader">
                        </form>
                    </div>';
            }
            else{
                echo '<div id="buttonRecherche" style="position:absolute; left:85vw; top:25px;">
                        <form action="index.php" method="post">
                            <input type="submit" value="Recherche" name="rechercheButton" class="buttonHeader">
                        </form> 
                    </div>';
            }
        ?>
    </header>
</html>
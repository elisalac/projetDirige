<!DOCTYPE html>
<html>
    <head>
        <style>
            .dropdown {
            display: inline-block;
            position: relative;
            }

            button{
                height:60px; 
                width:60px; 
                border-radius:50%; 
                border:0px; 
                background-image: url('images/profil/default_profil.png');
            }

            button:hover{
                background-color:#ddd;
                background-image: url('images/profil/default_profil.png');
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
        </style>
    </head>
    <header style="height:75px; width:100%;">
        <div style="position:absolute; left:15px; top:10px;">
            <div class="dropdown">
                <button></button>
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
                echo '<div id="buttonRecherche" style="position:absolute; left:700px; top:25px;">
                        <form action="index.php" method="post">
                            <input type="submit" value="Recherche" name="rechercheButton" style="width:150px; height:35px; font-size:15px; background-color:#504aa5; border:0px;">
                        </form> 
                    </div>
                    <div id="buttonInv" style="position:absolute; left:900px; top:25px;">
                        <form action="inventaire.php" method="post">
                            <input type="submit" value="Inventaire" name="inventaireButton" style="width:150px; height:35px; font-size:15px; background-color:#504aa5; border:0px;">
                        </form>
                    </div>
                    <div id="buttonPanier" style="position:absolute; left:1100px; top:25px;">
                        <form action="panier.php" method="post">
                            <input type="submit" value="Panier" name="panierButton" style="width:150px; height:35px; font-size:15px; background-color:#504aa5; border:0px;">
                        </form>
                    </div>
                    <div id="buttonBanque" style="position:absolute; left:1300px; top:25px;">
                        <form action="banque.php" method="post">
                            <input type="submit" value="Banque" name="BanqueButton" style="width:150px; height:35px; font-size:15px; background-color:#504aa5; border:0px;">
                        </form>
                    </div>';
            }
            else{
                echo '<div id="buttonRecherche" style="position:absolute; left:1300px; top:25px;">
                        <form action="index.php" method="post">
                            <input type="submit" value="Recherche" name="rechercheButton" style="width:150px; height:35px; font-size:15px; background-color:#504aa5; border:0px;">
                        </form> 
                    </div>';
            }
        ?>
    </header>
</html>
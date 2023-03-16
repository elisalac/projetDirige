<!DOCTYPE html>
<html>
    <header style="height:75px; width:100%;">
        <div style="position:absolute; left:15px; top:10px;">
            <form method="post">
                <input type="submit" value=" " name="profilButton" style="height:60px; width:60px; border-radius:50%">
            </form>
            
            <!--https://www.freecodecamp.org/news/html-drop-down-menu-how-to-add-a-drop-down-list-with-the-select-element/-->

            <div class="dropdown">
                <button>Profile</button>
                <div class="dropdown-options">
                    <a href="Modifier Profil">Dashboard</a>
                    <a href="#">Setting</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </div>
        <div style="position:absolute; left:1100px; top:25px;">
            <form action="index.php" method="post">
                <input type="submit" value="Recherche" name="rechercheButton" style="width:100px; height:35px; font-size:15px; background-color:darkseagreen; border:0px;">
            </form> 
        </div>
        <div style="position:absolute; left:1300px; top:25px;">
            <form action="inventaire.php" method="post">
                <input type="submit" value="Inventaire" name="inventaireButton" style="width:100px; height:35px; font-size:15px; background-color:darkseagreen; border:0px;">
            </form>
        </div>
        <div style="position:absolute; left:1500px; top:25px;">
            <form action="panier.php" method="post">
                <input type="submit" value="Panier" name="panierButton" style="width:100px; height:35px; font-size:15px; background-color:darkseagreen; border:0px;">
            </form>
        </div>
        <div style="position:absolute; left:1700px; top:25px;">
            <form action="banque.php" method="post">
                <input type="submit" value="Banque" name="BanqueButton" style="width:100px; height:35px; font-size:15px; background-color:darkseagreen; border:0px;">
            </form>
        </div>
    </header>
</html>
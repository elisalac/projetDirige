<!DOCTYPE html>
<html>
    <header style="height:75px; width:100%;">
        <div style="position:absolute; left:15px; top:10px;">
            <form action="profil.php" method="post">
                <input type="submit" value=" " name="profilButton" style="height:60px; width:60px; border-radius:50%">
            </form>
        </div>
        <div style="position:absolute; left:1000px; top:25px;">
            <form action="index.php" method="post">
                <input type="submit" value="Recherche" name="rechercheButton" style="width:100px; height:35px; font-size:15px; background-color:darkseagreen; border:0px;">
            </form> 
        </div>
        <div style="position:absolute; left:1200px; top:37px;">
            <form action="inventaire.php" method="post">
                <input type="submit" value="Inventaire" name="inventaireButton">
            </form>
        </div>
        <div style="position:absolute; left:1300px; top:37px;">
            <form action="panier.php" method="post">
                <input type="submit" value="Panier" name="panierButton">
            </form>
        </div>
        <div style="position:absolute; left:1400px; top:37px;">
            <form action="banque.php" method="post">
                <input type="submit" value="Banque" name="BanqueButton">
            </form>
        </div>
    </header>
</html>
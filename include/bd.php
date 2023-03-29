<?php
function getPdo()
{
    $host    = '167.114.152.54';
    $db      = 'dbdarquest2';
    $user    = 'equipe2';
    $pass    = '72ae8d4w';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
function InsertInscription($nom, $prenom, $alias, $mdp, $courriel, $class)
{
    $pdo = getPdo();


    try {
        $nul = 'allo';
        $sql = 'CALL ajouterJoueur(?,?,?,?,?,?,?)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $alias, PDO::PARAM_STR);
        $stmt->bindParam(2, $nom, PDO::PARAM_STR);
        $stmt->bindParam(3, $prenom, PDO::PARAM_STR);
        $stmt->bindParam(4, $courriel, PDO::PARAM_STR);
        $stmt->bindParam(5, $nul, PDO::PARAM_STR);
        $stmt->bindParam(6, $mdp, PDO::PARAM_STR);
        $stmt->bindParam(7, $class, PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $e) {
        echo "Le compte n'a pu être créé, veuillez recommencer";
        exit;
    }
}

function AjouterPanier($idItem, $idjoueur){
    $pdo = getPdo();
    $nombre = 1;
    try{
        $nul = 'allo';
        $sql = 'CALL AjouterPanier(?,?,?)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $idItem, PDO::PARAM_INT);
        $stmt->bindParam(2, $idjoueur, PDO::PARAM_INT);
        $stmt->bindParam(3, $nombre, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e){
        echo "";
        exit;
    }
}

function ModifierPanier($idjoueur,$idItem,$nouvelleQte){
    $pdo = getPdo();
    try{
        $sql = 'CALL ModifierPanier(?,?)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $idItem, PDO::PARAM_INT);
        $stmt->bindParam(2, $idjoueur, PDO::PARAM_INT);
        $stmt->bindParam(2, $idjoueur, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e){
        echo "Heyyyyyyy";
        exit;
    }
}

function RetirerPanier($idjoueur,$idItem){
    $pdo = getPdo();
    try{
        $sql = 'CALL RetirerPanier(?,?)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $idjoueur, PDO::PARAM_INT);
        $stmt->bindParam(2, $idItem, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e){
        echo "Heyyyyyyy";
        exit;
    }
}
function AfficherSolde($idjoueur)
{
    $pdo = getPdo();
    $sql = "SELECT AfficherSolde($idjoueur) AS Solde";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function membreValide($pseudo, $mdp)
{
    $pdo = getPdo();
    try {
        $sql = "SELECT alias, Joueurs.idJoueur, typeJoueur, mdp FROM Profil INNER JOIN Joueurs ON Joueurs.idJoueur = Profil.idJoueur WHERE alias = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$pseudo]);
        $membre = $stmt->fetch();
        if (password_verify($mdp, $membre['mdp'])){
            return $membre['idJoueur'];
        } else{
            return false;
        }
    } catch (Exception $e) {
        die("Erreur dans membreValide() - bd.php");
    }
}

function getMembre($id)
{
    if($id == false){
        header('Location: connexion.php');
    }
    $pdo = getPdo();
    $sql = "SELECT * FROM Joueurs WHERE idJoueur=$id";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function MoyenneEtoiles($idItem){

}

//Fonctions afficher items index
function AfficherItems($statement)
{
    
    while ($row = $statement->fetch()){
        if(isset($_POST['acheterButton'])){
            AjouterPanier($row['idItems'], $_SESSION['id']);
        }
        echo '<a href="http://167.114.152.54/~darquest2/detail.php?idItems=' . $row['idItems'] . '">';
        if($row['typeItem'] == 'S'){
            echo '<article style = "border: solid lightgreen 1px;
            padding: 0.5em;
            margin-bottom: 20px;
            text-align: center;
            height:450px;
            width: 250px;">';
        } else{
            echo '<article style="border: solid white 1px;
            padding: 0.5em;
            margin-bottom: 20px;
            text-align: center;
            height:450px;
            width: 250px;">';
        }
        echo '<img src="images/Items/' . $row['image'] . '" style="max-width: 200px; max-height: 150px; border:1px white">';
        echo '<p>' . $row['nom'] . '</p>';
        //$nbEtoile = MoyenneEtoiles();
        //for($i = 0; $i < 4; $i++){
        //    echo '<img src="images/etoiles/" style="">';
        //}
        echo '<p> Nombre en stock: ' . $row['qteStock'] . '</p>';
        if(isset($_SESSION['id'])){
            echo '<p> Nombre en inventaire: ' . $row['qteInventaire'] . '</p>';
        }
        echo '<div class="containerButton">';
        if(isset($_SESSION['id'])){
            if($row['typeItem'] == 'A' || $row['typeItem'] == 'R' || $row['typeItem'] == 'P'){
                echo '<div class="acheterContainerButton">';
                echo '<form method="post">';
                echo '<input type="submit" value="Acheter" name="acheterButton" style="width:75px; height:35px; font-size:15px; background-color:#504aa5; border:0px;">';
                echo '</form>';
                echo '</div>';
            }
            if($row['typeItem'] == 'S' && VerifierTypeJoueur($_SESSION['id']) == 'M'){
                echo '<div class="acheterContainerButton">';
                echo '<form method="post">';
                echo '<input type="submit" value="Acheter" name="acheterButton" style="width:75px; height:35px; font-size:15px; background-color:#504aa5; border:0px;">';
                echo '</form>';
                echo '</div>';
            }
        }
        //if($row['qteInventaire'] != 0 && isset($_SESSION['id'])){
        //    echo '<div class="vendreContainerButton">';
        //    echo '<form method="post">';
        //    echo '<input type="submit" value="Vendre" name="vendreButton" style="width:75px; height:35px; font-size:15px; background-color:#504aa5; border:0px;">';
        //    echo '</form>';
        //    echo '</div>';
        //}
        echo '</div>';
        echo '<p> Prix: ' . $row['prixUnitaire'] . ' Or</p>';
        echo '</article>';
        echo '</a>';
    }
}

function VerifierTypeJoueur($idJoueur){
    $pdo = getPdo();
    $sql = "SELECT typeJoueur FROM Joueurs WHERE idJoueur = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idJoueur]);
    while ($row = $stmt->fetch()){
        return $row['typeJoueur'];
    }
}

function VerifierIdPourtypeItem($idItem)
{
    // Aller chercher à l'aide du ID 
    $pdo = getPdo();
    $sql = "SELECT typeItem from Items WHERE idItems = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idItem]);
    while ($row = $stmt->fetch()){
        return $row['typeItem'];
    }
}

function AfficherDetailArme($idItem)
{
    $pdo = getPdo();
    $sql = "SELECT * FROM Armes WHERE idItem = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idItem]);
    return $stmt;
}

function AfficherDetailArmures($idItem)
{
    $pdo = getPdo();
    $sql = "SELECT * FROM Armures WHERE idItem = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idItem]);
    return $stmt;
}
function AfficherDetailPotion($idItem)
{
    $pdo = getPdo();
    $sql = "SELECT * FROM Potions WHERE idItem = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idItem]);
    return $stmt;
}
function AfficherDetailSorts($idItem)
{
    $pdo = getPdo();
    $sql = "SELECT * FROM Sorts WHERE idItem = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idItem]);
    return $stmt;
}

function GetPanierJoueur($idjoueur)
{
    $pdo = getPdo();
    $sql = "SELECT idItem,IdItem,image,qteItem,idJoueur,nom,prixUnitaire FROM Panier INNER JOIN Items ON Items.idItems = Panier.IdItem where idJoueur=?";

    $stmt= $pdo->prepare($sql);
    $stmt->execute([$idjoueur]);
    return $stmt;
}






function AfficherInfoItem($idItem)
{
    $pdo = getPdo();
    $sql = "SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Inventaire.qteInventaire, Items.prixUnitaire, Items.typeItem, Items.poids FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE Items.idItems = ?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$idItem]);
    return $stmt;
}


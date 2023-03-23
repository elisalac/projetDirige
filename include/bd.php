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
function membreValide($pseudo)
{
    $pdo = getPdo();
    try {
        $sql = "SELECT * FROM Profil INNER JOIN Joueurs ON Joueurs.idJoueur = Profil.idJoueur WHERE alias = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$pseudo]);
        return $stmt;
    } catch (Exception $e) {
        echo '<script type = "text/javascript">toastr.error("Compte invalide!")</script>';
    }
}
function getMembre($id)
{
    $pdo = getPdo();
    $sql = "SELECT * FROM Joueurs WHERE idJoueur='$id'";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

//Fonctions afficher items index
//Bouton tous items
function AfficherTousItems($statement)
{
    //Aller chercher tout les items dans la base de donnée
    //echo $_FILES['imageFichier']['name'];
    while ($row = $statement->fetch()){
        echo '<article>';
        echo '<img src="images/' . $row['image'] . '" style="width: 200px; height: 150px;">';
        echo '<p>' . $row['nom'] . '</p>';
        //$nbEtoile = MoyenneEtoiles();
        //for(int i = 0; i < $nbEtoile; i++){
        //    echo '<img src="images/etoile.png" style="">';
        //}
        echo '<p> Nombre en stock: ' . $row['qteStock'] . '</p>';
        if(isset($_SESSION['id'])){
            echo '<p> Nombre en inventaire: ' . $row['qteInventaire'] . '</p>';
        }
        echo '<div class="containerButton">';
        echo '<div class="acheterContainerButton">';
        echo '<form method="post">';
        echo '<input type="submit" value="Acheter" name="acheterButton" style="width:75px; height:35px; font-size:15px; background-color:#504aa5; border:0px;">';
        echo '</form>';
        echo '</div>';
        if($row['qteInventaire'] != 0){
            echo '<div class="vendreContainerButton">';
            echo '<form method="post">';
            echo '<input type="submit" value="Vendre" name="vendreButton" style="width:75px; height:35px; font-size:15px; background-color:#504aa5; border:0px;">';
            echo '</form>';
            echo '</div>';
        }
        echo '</div>';
        echo '<p> Prix: ' . $row['prixUnitaire'] . '$</p>';
        //echo '<p>Poids: ' .$row['poids'] . '</p>';
        echo '</article>';
        echo '</a>';
    }
}

function AfficherInformationItem($idItem)
{
    //Faire comme gestimages
    $pdo = getPdo();
    $sql = "SELECT * FROM Items WHERE idItem = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idItem]);
    return $stmt;
}

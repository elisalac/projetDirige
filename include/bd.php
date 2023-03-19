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
function AfficherTousItems()
{
    //Aller chercher tout les items dans la base de donnée
    $pdo = getPdo();
    $stmt = $pdo->query('SELECT * FROM Items i INNER JOIN Inventaire  inv ON i.idItem = inv.idItem ORDER BY typeItem');
    echo $_FILES['imageFichier']['name'];
    while ($row = $stmt->fetch()){
        echo '<article>';
        echo '<a href="http://http://167.114.152.54/~darquest2/detail.php?idItem=' . $row['idItem'] . '">';
        echo '<img src="images/' . $row['image'] . '" style="max-width: 200px; max-height: 150px;">';
        echo '<p>' . $row['nom'] . '</p>';
        $nbEtoile = MoyenneEtoiles();
        for(int i = 0; i < $nbEtoile; i++){
            echo '<img src="images/etoile.png" style="">';
        }
        echo '<p> Nombre en stock: ' . $row['qteStock'] . '</p>';
        echo '<p> Nombre en inventaire: ' . $row['qteInventaire'] . '</p>';
        echo '<button>'
        echo '</a>';
    }
}

//Liste déroulante filtre
function AfficherParPrixAsc()
{
    $pdo = getPdo();
}

function AfficherParPrixDesc()
{
    $pdo = getPdo();
}

function AfficherParPoidsAsc()
{
    $pdo = getPdo();
}

function AfficherParPoidsDesc()
{
    $pdo = getPdo();
}

//Checkbox type items
//1 type
function AfficherParArmes()
{
    //Aller chercher tout les items de type armes dans la base de donnée
    $pdo = getPdo();
}

function AfficherParArmures()
{
    //Aller chercher tout les items de type armures dans la base de donnée
    $pdo = getPdo();
}

function AfficherParPotions()
{
    //Aller chercher tout les items de type potions dans la base de donnée
    $pdo = getPdo();
}

function AfficherParSorts()
{
    //Aller chercher tout les items de type sorts dans la base de donnée
    $pdo = getPdo();
}

//2 types
function AfficherParArmesArmures()
{
    //Aller chercher tout les items de types armes et armures dans la base de donnée
    $pdo = getPdo();
}

function AfficherParArmesPotions()
{
    //Aller chercher tout les items de types armes et potions dans la base de donnée
    $pdo = getPdo();
}

function AfficherParArmesSorts()
{
    //Aller chercher tout les items de types armes et sorts dans la base de donnée
    $pdo = getPdo();
}

function AfficherParArmuresPotions()
{
    //Aller chercher tout les items de types armures et potions dans la base de donnée
    $pdo = getPdo();
}

function AfficherParArmuresSorts()
{
    //Aller chercher tout les items de types armures et sorts dans la base de donnée
    $pdo = getPdo();
}

function AfficherParPotionsSorts()
{
    //Aller chercher tout les items de types potions et sorts dans la base de donnée
    $pdo = getPdo();
}

//3 types
function AfficherParArmesArmuresPotions()
{
    //Aller chercher tout les items de types armes, armures et potions dans la base de donnée
    $pdo = getPdo();
}

function AfficherParArmesArmuresSorts()
{
    //Aller chercher tout les items de types armes, armures et sorts dans la base de donnée
    $pdo = getPdo();
}

function AfficherParArmesPotionsSorts()
{
    //Aller chercher tout les items de type armes, potions et sorts dans la base de donnée
    $pdo = getPdo();
}

function AfficherParArmuresPotionsSorts()
{
    //Aller chercher tout les items de type armures, potions et sorts dans la base de donnée
    $pdo = getPdo();
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

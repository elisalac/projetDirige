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
    }
}

function AjouterPanier($idItem, $idjoueur){
    $pdo = getPdo();
    $nombre = 1;
    try{
        $sql = 'SELECT AjouterPanier(?,?,?) as Erreur';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idItem,$idjoueur,$nombre]);

        while($row = $stmt->fetch())
        {
            if($row['Erreur']==1)
            {
                echo '<script type = "text/javascript">toastr.error("Quantité invalide")</script>';
            }
            else if($row['Erreur'] == 2)
            {
                echo '<script type = "text/javascript">toastr.error("Item indisponible!")</script>';
            }
            else if($row['Erreur'] == 3)
            {
                echo '<script type = "text/javascript">toastr.error("Fonds insuffisant!")</script>';
            }
            else
            {
                echo '<script type = "text/javascript">toastr.success("Ajout réussie!")</script>';
            }

        }
    } catch (Exception $e){
        echo "Erreur";
        exit;
    }
}

function ModifierPanier($idjoueur,$idItem,$nouvelleQte){
    $pdo = getPdo();
    try{
        $sql = 'SELECT ModifierPanier(?,?,?) as Erreur';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idjoueur,$idItem,$nouvelleQte]);
        while($row = $stmt->fetch()) 
        {
            if($row['Erreur']==1)
            {
                echo '<script type = "text/javascript">toastr.error("Quantité stock insuffisante!")</script>';
            }
            else if($row['Erreur'] == 2)
            {
                echo '<script type = "text/javascript">toastr.error("Fonds insuffisant!")</script>';
            }
            else if($row['Erreur'] ==3)
            {
                echo '<script type = "text/javascript">toastr.error("Quantité invalide")</script>';
            }
            else
            {
                echo '<script type = "text/javascript">toastr.success("Modification réussie!")</script>';
            }

        }
    } catch (Exception $e){
        echo "Heyyyyyyy";
        exit;
    }
}
function PayerPanier($idJoueur)
{
    $pdo = getPdo();
    try{
        $sql = 'CALL PayerPanier(?)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $idJoueur, PDO::PARAM_INT);
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
            return array($membre['idJoueur'],$mdp);
        } else{
            return array(false);
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
    $sql = "SELECT Joueurs.idJoueur,alias,typeJoueur,montantOr,montantArgent,montantBronze,flagConnect,typeJoueur,nom,prenom,courriel,mdp 
    FROM Joueurs 
    INNER JOIN Profil 
    on Joueurs.idJoueur=Profil.IdJoueur 
    WHERE Joueurs.idJoueur=$id";
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
        if(isset($_POST[$row['idItems'].'Ajouter'])){
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
                echo '<input type="submit" value="Acheter" name="'.$row['idItems'].'Ajouter" style="width:75px; height:35px; font-size:15px; background-color:#504aa5; border:0px;">';
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

function AfficherInventaireJoueur($idJoueur)
{
	$pdo = getPdo();
    $sql = "SELECT Items.nom, Items.image, Inventaire.idItems, Inventaire.qteInventaire FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE idJoueur = ? ORDER BY Items.typeItem";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idJoueur]);
    return $stmt;
}

function getMembreInscription()
{
    $pdo = getPdo();
    $sql = "SELECT Joueurs.alias, Joueurs.typeJoueur, Joueurs.idJoueur, Profil.courriel FROM Joueurs LEFT OUTER JOIN Profil ON Joueurs.idJoueur = Profil.idJoueur"; // faire un leftouterjoin avec profil pour get le css
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function setConnectionOn($idJoueur){
    $pdo = getPdo();
    $sql = 'UPDATE Joueurs SET flagConnect = 1 WHERE idJoueur=' . $idJoueur;
    $stmt = $pdo->query($sql);
}

function setConnectionOff($idJoueur){
    $pdo = getPdo();
    $sql = 'UPDATE Joueurs SET flagConnect = 0 WHERE idJoueur=' . $idJoueur;
    $stmt = $pdo->query($sql);
}

function isAdmin($idJoueur){
    $pdo = getPdo();

    try{
        $sql = 'SELECT flagAdmin FROM Joueurs WHERE idJoueur = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idJoueur]);
        while ($row = $stmt->fetch()){
            return $row['flagAdmin'];
        }
    } catch(Exception $e){
        echo $e->getMessage();
    }
}

function ModifierJoueur($idJoueur,$alias,$nom,$prenom,$courriel,$photo,$mdp,$typeJoueur) 
{
   
        $pdo=getPdo();
        $sql = 'SELECT ModifierJoueur(?,?,?,?,?,?,?,?) as Erreur';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idJoueur,$alias,$nom,$prenom,$courriel,$photo,$mdp,$typeJoueur]);
   try
   {
       $pdo=getPdo();
       $sql='UPDATE Profil P
       JOIN Joueurs J ON P.idJoueur = J.idJoueur
       SET P.nom = ?, P.prenom = ?, P.courriel = ?, P.imageProfil = ?, P.mdp = ?, J.alias = ?, J.typeJoueur = ?
       WHERE P.idJoueur = ?';
       $stmt = $pdo->prepare($sql);
       $stmt->execute([$nom,$prenom,$courriel,$photo,$mdp,$alias,$typeJoueur,$idJoueur]);
       return true;
   }
   catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        $error_message = $e->getMessage();
        if (strpos($error_message, 'alias') !== false|| strpos($error_message, 'courriel') !== false) {
            echo  "t fkin cave";
            return false;
        } 
    } else {
      return false;
    }
}                                               
}
function getQuestionFacile()
{
    $pdo = getPdo();
    $sql = "SELECT idÉnigmes,question,difficulté FROM Énigmes WHERE difficulté = 'F' AND flagFait=0 ORDER BY RAND() LIMIT 1"; 
    $stmt = $pdo->query($sql);
    while($row = $stmt->fetch()) 
    {
        $_SESSION['diff'] = $row['difficulté'];
        return array($row['idÉnigmes'],$row['question']);
    }
}
function getQuestionMoyen()
{
    $pdo = getPdo();
    $sql = "SELECT idÉnigmes,question,difficulté FROM Énigmes WHERE difficulté = 'M' AND flagFait=0 ORDER BY RAND() LIMIT 1"; 
    $stmt = $pdo->query($sql);
    while($row = $stmt->fetch()) 
    {
        $_SESSION['diff'] = $row['difficulté'];
        return array($row['idÉnigmes'],$row['question']);
    }
}

function getQuestionDifficile()
{
    $pdo = getPdo();
    $sql = "SELECT idÉnigmes,question,difficulté FROM Énigmes WHERE difficulté = 'D' AND flagFait=0 ORDER BY RAND() LIMIT 1"; 
    $stmt = $pdo->query($sql);
    while($row = $stmt->fetch()) 
    {
        $_SESSION['diff'] = $row['difficulté'];
        return array($row['idÉnigmes'],$row['question']);
    }
}

function getQuestionAleatoire()
{
    $pdo = getPdo();
    $sql = "SELECT idÉnigmes,question,difficulté FROM Énigmes WHERE flagFait=0 ORDER BY RAND() LIMIT 1"; 
    $stmt = $pdo->query($sql);
    while($row = $stmt->fetch()) 
    {
        $_SESSION['diff'] = $row['difficulté'];
        return array($row['idÉnigmes'],$row['question']);
    }
}

function AfficherReponses($idQuestion)
{
    $pdo = getPdo();
    $sql = "SELECT  idRéponse,laReponse FROM Réponses WHERE idÉnigmes = ".$idQuestion;
    $repondu = false;
    $chek= "";
    $disabled = "";
    if(isset($_POST['reponse'])){
        $repondu = true;
        $_SESSION['repondu'] = $repondu;
    }
    if(isset($_POST["rep"]))
    {
        $chek = "checked='checked'";
    }
    if($repondu) $disabled =  "disabled"; 
    $stmt = $pdo->query($sql);
    while($row = $stmt->fetch()) 
    {
        echo '<div class="divReponse">
            <input type="radio" id='.$row['idRéponse'].' name="rep" value="'.$row['idRéponse'].'"'.$chek . $disabled .'>
            <label for="'.$row['idRéponse'].'">'.$row['laReponse'].'</label>
        </div>';
    }
}

function AjouterQuestion($difficulte,$question)
{
  $pdo = getPdo();
try{
  $sql = "INSERT INTO Énigmes (difficulté, question) VALUES (?, ?)";
  $stmt= $pdo->prepare($sql);
  $stmt->execute([$difficulte,$question]);
  $sql2 = "SELECT LAST_INSERT_ID() as wtv";
  $stmt2 = $pdo->query($sql2);
  while($row = $stmt2->fetch()) 
  {
    $_SESSION['IdQuestCur'] = $row['wtv'];
  }
}catch (Exception $e) {
    die("Erreur dans ajouterQuestion() - bd.php");
  }
}

function AjouterRéponse($reponse,$estBonne)
{
  $pdo = getPdo();
try{
  $sql = "INSERT INTO Réponses (laReponse, estBonne, idÉnigmes) VALUES (?,?,".$_SESSION['IdQuestCur'].")";
  $stmt= $pdo->prepare($sql);
  $stmt->execute([$reponse,$estBonne]);
}catch (Exception $e) {
    echo $e->getMessage();
  }
}
function CheckerReponse($idrep)
{
    $pdo = getPdo();
    $id = $_SESSION['id'];
    $diff =$_SESSION['diff'];
    $quest = $_SESSION['idQues'];
    //try{
      $sql = "SELECT estBonne FROM Réponses WHERE idRéponse = $idrep";
      $stmt2 = $pdo->query($sql);
      while($row = $stmt2->fetch()) 
      {
        $value = $row['estBonne'];
      }
      
      if($value == 1)
      {
        switch ($_SESSION['diff'])
        {
            case 'F':
                $sql2 = "UPDATE Joueurs SET montantBronze = montantBronze +10 where idJoueur = ".$_SESSION['id'];
                $stmt = $pdo->query($sql2);
                break;
            case 'M':
                $sql2 = "UPDATE Joueurs SET montantArgent = montantArgent +10 where idJoueur = ".$_SESSION['id'];
                $stmt = $pdo->query($sql2);
                break;
            case 'D':
                $sql2 = "UPDATE Joueurs SET montantOr = montantOr +10 where idJoueur = ".$_SESSION['id'];
                $stmt = $pdo->query($sql2);
                break;
        }

        $sql3 = "INSERT INTO Statistiques (idJoueur,difficulté,idQuestion,flagRéussi) values (?,?,?,?)";
        $stmt3= $pdo->prepare($sql3);
        $stmt3->execute([$id,$diff,$quest,1]);
        echo "<p>Réussie!!!</p>";
        echo "<img src='../images/Z6d5.gif'>";

        if($diff == 'D' )
        { 
            $sql4 = "UPDATE Joueurs set streak=streak+1 where idJoueur=?";
            $stmt4= $pdo->prepare($sql4);
            $stmt4->execute([$id]);

            $sql1 = "SELECT streak from Joueurs where idJoueur=".$id;
            $stmt28 = $pdo->query($sql1);    
            while($row = $stmt28->fetch())
            {
                if($row['streak']==5)
              {
                  $sql5="UPDATE Joueurs set typeJoueur='M' where idJoueur=?";
                  $stmt3= $pdo->prepare($sql5);
                  $stmt3->execute([$id]);
                  echo "Hey man ur officially a mage";
              }
            }
        }

      }
      else if($value == 0)
      {
        $sql3 = "INSERT INTO Statistiques (idJoueur,difficulté,idQuestion,flagRéussi) values(?,?,?,?)";
        $stmt3= $pdo->prepare($sql3);
        $stmt3->execute([$id,$diff,$quest,0]);
        $sql6="UPDATE Joueurs set streak=0 where idJoueur=?";
        $stmt4= $pdo->prepare($sql6);
        $stmt4->execute([$id]);
            echo"<p>Non Réussie :(</p>";
            echo "<img src='../images/fail.gif'>";
      }
    //}catch (Exception $e) {
       // die("Erreur dans ChecherReponse() - bd.php");
     // }
}


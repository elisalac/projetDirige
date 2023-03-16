<?php
function getPdo(){
    $host    = '167.114.152.54';
    $db      = 'dbdarquest2';
    $user    = 'equipe2';
    $pass    = 'nFCkttCNzekv';
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
    function InsertInscription($nom,$prenom,$alias,$mdp,$courriel,$class){
        $pdo = getPdo();

        $hash = password_hash($mdp, PASSWORD_DEFAULT);

        try {
            $sql = "CALL ajouterJoueur(?,?,?,?,?,?,?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$alias,$nom, $prenom, $courriel,"null", $hash,$class ]);
        } catch (Exception $e) {
            echo "Le compte n'a pu être créé, veuillez recommencer";
            exit;
        }
    }

    //Fonctions afficher items index
    //Bouton tous items
    function AfficherTousItems(){
        //Aller chercher tout les items de la base de donnée
        $pdo = getPdo();
    }

    //Liste déroulante filtre
    function AfficherParPrixAsc(){
        $pdo = getPdo();
    }

    function AfficherParPrixDesc(){
        $pdo = getPdo();
    }

    function AfficherParPoidsAsc(){
        $pdo = getPdo();
    }

    function AfficherParPoidsDesc(){
        $pdo = getPdo();
    }

    //Checkbox type items
    //1 type
    function AfficherParArmes(){
        $pdo = getPdo();
    }

    function AfficherParArmures(){
        $pdo = getPdo();
    }

    function AfficherParPotions(){
        $pdo = getPdo();
    }
    
    function AfficherParSorts(){
        $pdo = getPdo();
    }
    
    //2 types
    function AfficherParArmesArmures(){
        $pdo = getPdo();
    }

    function AfficherParArmesPotions(){
        $pdo = getPdo();
    }

    function AfficherParArmesSorts(){
        $pdo = getPdo();
    }

    function AfficherParArmuresPotions(){
        $pdo = getPdo();
    }

    function AfficherParArmuresSorts(){
        $pdo = getPdo();
    }

    function AfficherParPotionsSorts(){
        $pdo = getPdo();
    }

    //3 types
    function AfficherParArmesArmuresPotions(){
        $pdo = getPdo();
    }

    function AfficherParArmesArmuresSorts(){
        $pdo = getPdo();
    }

    function AfficherParArmesPotionsSorts(){
        $pdo = getPdo();
    }

    function AfficherParArmuresPotionsSorts(){
        $pdo = getPdo();
    }
?>
<?php
function getPdo(){
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
    function InsertInscription($nom,$prenom,$alias,$mdp,$courriel,$class){
        $pdo = getPdo();

        $hash = password_hash($mdp, PASSWORD_DEFAULT);

        try {
            $sql = "CALL ajouterJoueur(?,?,?,?,?,?,?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$alias,$nom, $prenom, $courriel,'null', $hash,$class ]);
        } catch (Exception $e) {
            echo "Le compte n'a pu être créé, veuillez recommencer";
            exit;
        }
    }

    //Fonctions afficher items index
    //Bouton tous items
    function AfficherTousItems(){
        //Aller chercher tout les items dans la base de donnée
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
        //Aller chercher tout les items de type armes dans la base de donnée
        $pdo = getPdo();

    }

    function AfficherParArmures(){
        //Aller chercher tout les items de type armures dans la base de donnée
        $pdo = getPdo();

    }

    function AfficherParPotions(){
        //Aller chercher tout les items de type potions dans la base de donnée
        $pdo = getPdo();

    }
    
    function AfficherParSorts(){
        //Aller chercher tout les items de type sorts dans la base de donnée
        $pdo = getPdo();

    }
    
    //2 types
    function AfficherParArmesArmures(){
        //Aller chercher tout les items de types armes et armures dans la base de donnée
        $pdo = getPdo();

    }

    function AfficherParArmesPotions(){
        //Aller chercher tout les items de types armes et potions dans la base de donnée
        $pdo = getPdo();

    }

    function AfficherParArmesSorts(){
        //Aller chercher tout les items de types armes et sorts dans la base de donnée
        $pdo = getPdo();

    }

    function AfficherParArmuresPotions(){
        //Aller chercher tout les items de types armures et potions dans la base de donnée
        $pdo = getPdo();

    }

    function AfficherParArmuresSorts(){
        //Aller chercher tout les items de types armures et sorts dans la base de donnée
        $pdo = getPdo();
    }

    function AfficherParPotionsSorts(){
        //Aller chercher tout les items de types potions et sorts dans la base de donnée
        $pdo = getPdo();
        
    }

    //3 types
    function AfficherParArmesArmuresPotions(){
        //Aller chercher tout les items de types armes, armures et potions dans la base de donnée
        $pdo = getPdo();

    }

    function AfficherParArmesArmuresSorts(){
        //Aller chercher tout les items de types armes, armures et sorts dans la base de donnée
        $pdo = getPdo();

    }

    function AfficherParArmesPotionsSorts(){
        //Aller chercher tout les items de type armes, potions et sorts dans la base de donnée
        $pdo = getPdo();

    }

    function AfficherParArmuresPotionsSorts(){
        //Aller chercher tout les items de type armures, potions et sorts dans la base de donnée
        $pdo = getPdo();

    }
?>
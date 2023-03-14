<?php
    function getPdo(){
        $host    = '127.0.0.1';
        $db      = 'InscriptionData';
        $user    = 'elisa';
        $pass    = 'maxeli1907';
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
    function InsertInscription(){
        $pdo = getPdo();

        $nom = $_SESSION['nomEnAttenteConfirmation'];
        $prenom = $_SESSION['prenomEnAttenteConfirmation'];
        $pseudo = $_SESSION['pseudoEnAttenteConfirmation'];
        $mdp = $_SESSION['passwordEnAttenteConfirmation'];
        $courriel = $_SESSION['courrielEnAttenteConfirmation'];

        $hash = password_hash($mdp, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO information (nom, prenom, pseudo, motDePasse, courriel) VALUES (?, ?, ?, ?, ?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$nom, $prenom, $pseudo, $mdp, $courriel]);
        } catch (Exception $e) {
            echo "Erreur...";
            exit;
        }
    }

    function AfficherTousItem(){
        
    }

?>

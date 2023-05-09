<?php
    session_start();

    // faire une verification de c'est quelle item avant de pouvoir essayer c'est quoi mettre la fonctionm qui verifie ele id
    #foreach($item as $range)
    $idItem = $_GET["idItems"];
    $_SESSION['idItems'] = $idItem;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Détail</title>
        <style>
            body{
                text-align: center;
                background-color: #3f3e53;
                color:white;
            }
            img{
                max-width: 150px;
                max-height: 300px;
            }
            p{
                font-size: 20px;
                margin:15px;
            }
            u{
                font-size: 22px;
            }
            .infoJoueur{
                position:absolute; left:60px; top:10px;
            }

            .infoJoueur p{
                color:white;
                margin:20px;
                font-size: 20px;
            }
            
            *{
    margin: 0;
    padding: 0;
}
.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}

/* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
        </style>
        <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
    </head>
    <?php
        require "include/header.php";
    ?>
    <body>
        <?php
            /// Faire comme gestimage pour afficher les info de la table Items pour qu'il fusionne avec les info des items
            // précis faire un inner join

            $typeItem = VerifierIdPourtypeItem($idItem);
            
            $infoItem = AfficherInfoItem($idItem);
            $item = "";
            $nbInventaire = 0;
            while($row = $infoItem->fetch())
            {
                if(isset($_POST[$row['idItems'].'Vendre'])){
                    VendreItemInventaire($_SESSION['id'], $row['idItems']);
                }
                echo "<hr>";
                echo "<div style='margin-top:15px'>";
                echo "<img src='images/Items/". $row['image'] ."'>";
                echo "<p style='font-size:23px'>". $row['nom'] . "</p>";
                echo "<p><u>Quantité en stock:</u> ". $row['qteStock'] . "</p>";
                if(isset($_SESSION['id'])){
                    $nbInventaire = AfficherNbInventaire($_SESSION['id'], $row['idItems']);
                    echo '<p><u>Nombre en inventaire:</u> ' . $nbInventaire . '</p>';
                }
                echo "<p><u>Prix:</u> ". $row['prixUnitaire'] . " Or</p>";
                echo "<p><u>Poids:</u> ". $row['poids'] . " lbs</p>";
                
            }

            if($typeItem === 'A')
            {
                $detailArme =  AfficherDetailArme($idItem);
                while($infoArme = $detailArme->fetch())
                {
                        echo "<p><u>Efficacité de l'arme:</u> ". $infoArme['efficacité'] . "</p>";
                        echo "<p><u>Description de l'arme:</u> ". $infoArme['description'] . "</p>";
                        echo "<p><u>Genre de l'arme:</u> ". $infoArme['genre'] . "</p>";
                        echo "</div>";
                }
            }

            if($typeItem === 'R')
            {
                $detailArmure =  AfficherDetailArmures($idItem);
                while($infoArmure = $detailArmure->fetch())
                {
                        echo "<p><u>Taille de l'armure:</u> ". $infoArmure['taille'] . "</p>";
                        echo "<p><u>Matiere de l'armure:</u> ". $infoArmure['matiere'] . "</p>";
                        echo "</div>";
                }
            }

            if($typeItem === 'P')
            {
                $detailPotion = AfficherDetailPotion($idItem);
                while($infoPotion = $detailPotion->fetch())
                {
                        echo "<p><u>Effet attendu:</u> ". $infoPotion['effetAttendu'] . "</p>";
                        echo "<p><u>Durée de l'effet:</u> ". $infoPotion['durée'] . "</p>";
                        echo "</div>";
                }
            }

            if($typeItem === 'S')
            {
                $detailSort = AfficherDetailSorts($idItem);
                while($infoSort = $detailSort->fetch())
                {
                    if($infoSort['estInstantané'] == 'o'){
                        echo "<p><u>Est Instantané:</u> Oui</p>";
                    }
                    if($infoSort['estInstantané'] == 'n'){
                        echo "<p><u>Est Instantané:</u> Non</p>";
                    }
                        echo "<p><u>Point de dégats:</u> ". $infoSort['nombreDégats'] . "</p>";
                        echo "</div>";
        
                    }
            }
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(isset($_POST['commenter']))
                {
                    if(strlen($_POST['commentaire'])>200 || strlen($_POST['commentaire']) ==0)
                    {
                        echo '<script type = "text/javascript">toastr.error("Le commentaire doit être entre 1 et 200 caractères!")</script>';
                    }
                    else{
                        AjouterÉvaluations($_POST['commentaire'],$_SESSION['id'], $idItem, $_POST['rate']);
                    }
                    
                }
                if(isset($_POST['delete'])){
                    $id = $_POST['delete'];
                    DeleteCommentaire($id);
                }
            }
            diagramme($idItem);

            if($nbInventaire != 0 && isset($_SESSION['id'])){
                echo '<div class="vendreContainerButton">';
                echo '<form method="post">';
                echo '<input type="submit" value="Vendre" name="'. $row['idItems'].'Vendre" style="width:75px; height:35px; font-size:15px; background-color:#504aa5; border:0px;"><br><br>';
                echo ' <div class="rate">
                <input type="radio" id="star5" name="rate" value="5" />
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" name="rate" value="4" />
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" name="rate" value="3" />
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" name="rate" value="2" />
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" name="rate" value="1" />
                <label for="star1" title="text">1 star</label>
              </div>';
              echo '<form action="" method="POST">
              <strong><label for="commentaire">Commentaire:</label></strong>
              <br>
              <textarea class="commentBox" placeholder="Partager votre pensée :)" name="commentaire" id="" cols="50" rows="5"></textarea>
              <input type="submit" value="Commentaire" name="commenter" style="width:100px; height:35px; font-size:15px;background-color:#504aa5; border:0px;">
            </form>';
               
                echo '</form>';
                echo '</div>';
            }
            $commentaires= AfficherÉvaluations($idItem);
            foreach($commentaires as $commentaire)
            {
                $idJoueur = $_SESSION['id'];
                echo "<p>Id:".$commentaire['idJoueur']." ".$commentaire['commentaire']." Stars:".$commentaire['nbÉtoiles']."</p><br>";
                if($commentaire['idJoueur'] == $idJoueur || isAdmin($idJoueur)){
                    echo "<form method='POST'>";
                        echo '<button type="submit" id="supprimerComm" name="delete" value="' . $commentaire['idCommentaire'] . '">Supprimer</button>';
                    echo "</form>";
                }
            }
        ?>
    </body>
</html>
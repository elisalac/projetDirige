<?php
    require "include/bd.php";
    
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Recherche</title>
        <style>
            body{
                background-color: #3f3e53;
            }
            article{
                display: inline-block;
                border: solid white 1px;
                padding: 10px;
                padding-top: 20px;
                margin: 10px;
                width: 220px;
                height: 400px;
            }
            a{
                color:white;
                font-size: 25px;
                text-decoration: none;
            }
            a:visited{
                color:white;
                text-decoration: none;
            }
            p{
                color:white;
            }
        </style>
    </head>
    <?php
        require "include/header.php";
    ?>
    <nav style="background-color:#302f3f; width:100%; padding:20px">
        <div style="display:inline-block; padding-left:10px; padding-right:10px; position:relative; bottom:40px; z-index:1;">
            <form method="post">
                <input type="submit" value="Tous" name="tous">
            </form>
        </div>
        <div style="display:inline-block; padding-left:10px; padding-right:10px; position:relative; bottom:40px; z-index:1;">
            <form method="post">
                <select name="filtre" style="margin-bottom:5px">
                    <option value="PrixAsc">Par Prix ↓</option>
                    <option value="PrixDesc">Par Prix ↑</option>
                    <option value="PoidsAsc">Par Poids ↓</option>
                    <option value="PoidsDesc">Par Poids ↑</option>
                </select>
        </div>
        <div style="display:inline-block; padding-left:10px; padding-right:10px; color:white;">
                <label style="text-decoration:underline; font-size:20px;">Types</label>
                <br>
                <label for="checkboxArmes">Armes</label>
                <input type="checkbox" id="checkboxArmes" name="checkboxArmes">
                <br>
                <label for="checkboxArmures">Armures</label>
                <input type="checkbox" id="checkboxArmures" name="checkboxArmures">
                <br>
                <label for="checkboxPotions">Potions</label>
                <input type="checkbox" id="checkboxPotions" name="checkboxPotions">
                <br>
                <label for="checkboxSorts">Sorts</label>
                <input type="checkbox" id="checkboxSorts" name="checkboxSorts">
                <br>
                <input type="submit" value="Appliquer" style="margin-top:5px">
            </form>
        </div>
    </nav>
    <body>
        <?php
            
            $statement= getPdo()->query('SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems ORDER BY typeItem');
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                
                //Bouton tous items
                if(isset($_POST['tous'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems ORDER BY typeItem';
                }

                //Liste déroulante filtre
                if(!empty($_POST['filtre'])){
                    if($_POST['filtre'] == "PrixAsc"){
                        $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems ORDER BY prixUnitaire';
                    }
                    if($_POST['filtre'] == "PrixDesc"){
                        $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems ORDER BY prixUnitaire DESC';
                    }
                    if($_POST['filtre'] == "PoidsAsc"){
                        $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems ORDER BY poids';
                    }
                    if($_POST['filtre'] == "PoidsDesc"){
                        $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems ORDER BY poids DESC';
                    }
                }
                //Checkbox type items
                //1 type
                if(isset($_POST['checkboxArmes'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" ORDER BY poids DESC';
                        }
                    }
                }
                if(isset($_POST['checkboxArmures'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" ORDER BY poids DESC';
                        }
                    }
                }
                if(isset($_POST['checkboxPotions'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="P" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="P" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="P" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="P" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="P" ORDER BY poids DESC';
                        }
                    }
                }
                if(isset($_POST['checkboxSorts'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="S" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="S" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="S" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="S" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="S" ORDER BY poids DESC';
                        }
                    }
                }

                //2 types
                if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxArmures'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" ORDER BY poids DESC';
                        }
                    }
                }
                if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxPotions'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="P" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="P" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="P" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="P" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="P" ORDER BY poids DESC';
                        }
                    }
                }
                if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxSorts'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="S" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="S" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="S" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="S" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="S" ORDER BY poids DESC';
                        }
                    }
                }
                if(isset($_POST['checkboxArmures']) && isset($_POST['checkboxPotions'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="P" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="P" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="P" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="P" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="P" ORDER BY poids DESC';
                        }
                    }
                }
                if(isset($_POST['checkboxArmures']) && isset($_POST['checkboxSorts'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="S" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="S" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="S" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="S" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="S" ORDER BY poids DESC';
                        }
                    }
                }
                if(isset($_POST['checkboxPotions']) && isset($_POST['checkboxSorts'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="P" OR typeItem="S" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="P" OR typeItem="S" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="P" OR typeItem="S" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="P" OR typeItem="S" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="P" OR typeItem="S" ORDER BY poids DESC';
                        }
                    }
                }

                //3 types
                if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxArmures']) && isset($_POST['checkboxPotions'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" OR typeItem="P" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" OR typeItem="P" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" OR typeItem="P" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" OR typeItem="P" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" OR typeItem="P" ORDER BY poids DESC';
                        }
                    }
                }
                if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxArmures']) && isset($_POST['checkboxSorts'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" OR typeItem="S" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" OR typeItem="S" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" OR typeItem="S" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" OR typeItem="S" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" OR typeItem="S" ORDER BY poids DESC';
                        }
                    }
                }
                if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxPotions']) && isset($_POST['checkboxSorts'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="P" OR typeItem="S" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="P" OR typeItem="S" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="P" OR typeItem="S" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="P" OR typeItem="S" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="P" OR typeItem="S" ORDER BY poids DESC';
                        }
                    }
                }
                if(isset($_POST['checkboxArmures']) && isset($_POST['checkboxPotions']) && isset($_POST['checkboxSorts'])){
                    $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY poids, prixUnitaire';
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT * FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY poids DESC';
                        }
                    }
                }
                $statement= getPdo()->query($sql);
            }
            AfficherItems($statement);
        ?>
    </body>
</html>
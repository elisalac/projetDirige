<?php
    
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if(isset($_POST['acheterButton'])){
    }

    
    $whereLoginType1 = "";
    $whereLoginType2 = "";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Recherche</title>
        <style>
            body{
                background-color: #3f3e53;
                margin:0px;
            }

            .listeItemGrid{
                display: inline-grid;
                grid-template-columns: repeat(5, 1fr);
                grid-auto-rows: 1fr;
                grid-column-gap: 15px;
                grid-row-gap: 5px;
                max-width: 500px;
                margin-left:15px;
                margin-top: 15px;
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
                margin:20px;
                font-size: 20px;
            }

            .containerButton{
                display: grid;
            }
            .acheterContainerButton{
                grid-column-start: 1;
                grid-column-end: 2;
            }
            .vendreContainerButton{
                grid-column-start: 3;
                grid-column-end: 4;
            }

            @media only screen and (min-width: 1800px) {
                .listeItemGrid{
                    display: inline-grid;
                    grid-template-columns: repeat(6, 1fr);
                    grid-auto-rows: 1fr;
                    grid-column-gap: 15px;
                    grid-row-gap: 5px;
                    max-width: 500px;
                    margin-left:3vw;
                    margin-top: 15px;
                }
            }
            @media only screen and (max-width: 900px) {
                .listeItemGrid{
                    display: inline-grid;
                    grid-template-columns: repeat(2, 1fr);
                    grid-auto-rows: 1fr;
                    grid-column-gap: 15px;
                    grid-row-gap: 5px;
                    max-width: 500px;
                    margin-left:3vw;
                    margin-top: 15px;
                }   
            }
        </style>
    </head>
    <?php
        require "include/header.php";
        if (!empty($_POST['filtre'])) {
            $dropDownVal = $_POST['filtre'];
        } else {
            $dropDownVal = "";
        }
    ?>
    <nav style="background-color:#302f3f; width:98.6%; padding:20px; padding-right:0px;">
        <div style="display:inline-block; padding-left:10px; padding-right:10px; position:relative; bottom:30px; z-index:1;">
            <form method="post">
                <input type="submit" value="Tous" name="tous" style="width:150px; height:35px; font-size:15px; background-color:white; border:0px;">
            </form>
        </div>
        <div style="display:inline-block; padding-left:10px; padding-right:10px; position:relative; bottom:30px; z-index:1;">
            <form method="post">
                <select name="filtre" style="margin-bottom:5px; width:150px; height:35px; font-size:15px; background-color:white; border:0px;">
                    <option>Aucun filtre</option>
                    <option value="PrixAsc" <?php if($dropDownVal == "PrixAsc") echo 'selected="selected"'; ?>>Par Prix ↓</option>
                    <option value="PrixDesc" <?php if($dropDownVal == "PrixDesc") echo 'selected="selected"'; ?>>Par Prix ↑</option>
                    <option value="PoidsAsc" <?php if($dropDownVal == "PoidsAsc") echo 'selected="selected"'; ?>>Par Poids ↓</option>
                    <option value="PoidsDesc" <?php if($dropDownVal == "PoidsDesc") echo 'selected="selected"'; ?>>Par Poids ↑</option>
                </select>
        </div>
        <div style="display:inline-block; padding-left:10px; padding-right:10px; color:white;">
                <label style="text-decoration:underline; font-size:20px;">Types</label>
                <br>
                <label for="checkboxArmes">Armes</label>
                <input type="checkbox" id="checkboxArmes" name="checkboxArmes" class="checkboxCSS"<?php if(isset($_POST['checkboxArmes'])) echo "checked='checked'"; ?>>
                <br>
                <label for="checkboxArmures">Armures</label>
                <input type="checkbox" id="checkboxArmures" name="checkboxArmures" <?php if(isset($_POST['checkboxArmures'])) echo "checked='checked'"; ?>>
                <br>
                <label for="checkboxPotions">Potions</label>
                <input type="checkbox" id="checkboxPotions" name="checkboxPotions" <?php if(isset($_POST['checkboxPotions'])) echo "checked='checked'"; ?>>
                <br>
                <label for="checkboxSorts">Sorts</label>
                <input type="checkbox" id="checkboxSorts" name="checkboxSorts" <?php if(isset($_POST['checkboxSorts'])) echo "checked='checked'"; ?>>
          </div>
            <div style="display:inline-block; padding-left:10px; padding-right:10px; position:relative; bottom:30px;"> 
                <input type="submit" value="Appliquer" style="margin-top:5px; width:150px; height:35px; font-size:15px; background-color:white; border:0px;">  
            </div>
        </form>
    </nav>
    <body>
        <div class="listeItemGrid">
            <?php

                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items ORDER BY typeItem';
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    
                    //Bouton tous items
                    if(isset($_POST['tous'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items ORDER BY typeItem';
                    }

                    //Liste déroulante filtre
                    if(!empty($_POST['filtre'])){
                        if($_POST['filtre'] == "PrixAsc"){
                            $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items ORDER BY prixUnitaire';
                        }
                        if($_POST['filtre'] == "PrixDesc"){
                            $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items ORDER BY prixUnitaire DESC';
                        }
                        if($_POST['filtre'] == "PoidsAsc"){
                            $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items ORDER BY poids';
                        }
                        if($_POST['filtre'] == "PoidsDesc"){
                            $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items ORDER BY poids DESC';
                        }
                    }

                    //Checkbox type items
                    //1 type
                    if(isset($_POST['checkboxArmes'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" ORDER BY poids DESC';
                            }
                        }
                    }
                    if(isset($_POST['checkboxArmures'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" ORDER BY poids DESC';
                            }
                        }
                    }
                    if(isset($_POST['checkboxPotions'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="P" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="P" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="P" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="P" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="P" ORDER BY poids DESC';
                            }
                        }
                    }
                    if(isset($_POST['checkboxSorts'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="S" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="S" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="S" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="S" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="S" ORDER BY poids DESC';
                            }
                        }
                    }

                    //2 types
                    if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxArmures'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" ORDER BY poids DESC';
                            }
                        }
                    }
                    if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxPotions'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="P" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="P" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="P" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="P" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="P" ORDER BY poids DESC';
                            }
                        }
                    }
                    if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxSorts'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="S" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="S" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="S" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="S" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="S" ORDER BY poids DESC';
                            }
                        }
                    }
                    if(isset($_POST['checkboxArmures']) && isset($_POST['checkboxPotions'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="P" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="P" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="P" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="P" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="P" ORDER BY poids DESC';
                            }
                        }
                    }
                    if(isset($_POST['checkboxArmures']) && isset($_POST['checkboxSorts'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="S" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="S" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="S" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="S" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="S" ORDER BY poids DESC';
                            }
                        }
                    }
                    if(isset($_POST['checkboxPotions']) && isset($_POST['checkboxSorts'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="P" OR typeItem="S" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="P" OR typeItem="S" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="P" OR typeItem="S" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="P" OR typeItem="S" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="P" OR typeItem="S" ORDER BY poids DESC';
                            }
                        }
                    }

                    //3 types
                    if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxArmures']) && isset($_POST['checkboxPotions'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="P" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="P" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Inventaire.qteInventaire, Items.prixUnitaire, Items.typeItem FROM Items LEFT OUTER JOIN Inventaire ON Items.idItems = Inventaire.idItems WHERE typeItem="A" OR typeItem="R" OR typeItem="P" ' . $whereLoginType2 . ' ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="P" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="P" ORDER BY poids DESC';
                            }
                        }
                    }
                    if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxArmures']) && isset($_POST['checkboxSorts'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="S" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="S" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="S" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="S" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="S" ORDER BY poids DESC';
                            }
                        }
                    }
                    if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxPotions']) && isset($_POST['checkboxSorts'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="P" OR typeItem="S" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="P" OR typeItem="S" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="P" OR typeItem="S" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="P" OR typeItem="S" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="P" OR typeItem="S" ORDER BY poids DESC';
                            }
                        }
                    }
                    if(isset($_POST['checkboxArmures']) && isset($_POST['checkboxPotions']) && isset($_POST['checkboxSorts'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY poids DESC';
                            }
                        }
                    }
                    if(isset($_POST['checkboxArmes']) && isset($_POST['checkboxArmures']) && isset($_POST['checkboxPotions']) && isset($_POST['checkboxSorts'])){
                        $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY poids, prixUnitaire';
                        if(!empty($_POST['filtre'])){
                            if($_POST['filtre'] == "PrixAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY prixUnitaire';
                            }
                            if($_POST['filtre'] == "PrixDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY prixUnitaire DESC';
                            }
                            if($_POST['filtre'] == "PoidsAsc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY poids';
                            }
                            if($_POST['filtre'] == "PoidsDesc"){
                                $sql = 'SELECT Items.idItems, Items.image, Items.nom, Items.qteStock, Items.prixUnitaire, Items.typeItem FROM Items WHERE typeItem="A" OR typeItem="R" OR typeItem="P" OR typeItem="S" ORDER BY poids DESC';
                            }
                        }
                    }
                }
                $statement= getPdo()->query($sql);
                AfficherItems($statement);
            ?>
        </div>
    </body>
</html>
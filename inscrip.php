<?php

// formulaire et script d'inscription

session_start();
require_once "include/bd.php";


// affiché au bas du formulaire
$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // si le champ n'est pas vide
  if (( strlen(trim($_POST['pseudo'])) > 0 ) &&
      ( strlen(trim($_POST['mdp'])) > 0 ) &&
      ( strlen(trim($_POST['nom'])) > 0 ) &&
      ( strlen(trim($_POST['prenom'])) > 0 ) &&
      ( strlen(trim($_POST['courriel'])) > 0 )) {
    $pseudo   = $_POST['pseudo'];
    $mdp      = $_POST['mdp'];
    $nom      = $_POST['nom'];
    $prenom   = $_POST['prenom'];
    $courriel = $_POST['courriel'];
    $classe = $_POST['classe'];

    // chiffre le mot de passe
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    $membreIns = getMembreInscription();
    
    
    if($membreIns['courriel'] == $courriel)
    {
      echo "<p>Le courriel est déjà utilisé</p>";
    }
    if($membreIns['alias'] == $pseudo)
    {
        echo "<p>L'alias est déjà utilisé</p>";
    }
    else if($membreIns['alias'] != $pseudo && $membreIns['courriel'] != $courriel)
    {
      InsertInscription($nom,$prenom,$pseudo,$mdp,$courriel,$classe);
      header("Location: connexion.php");
      exit;
    }
    /*
    else
    {
      InsertInscription($nom,$prenom,$pseudo,$mdp,$courriel,$classe);
      header("Location: connexion.php");
      exit;
    }
    */
    
  } else {
    $message = "Les champs doivent tous être remplis";
  }
}

?>
<html>
  <head>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <style>
      body{
        text-align:center;
        padding-bottom: 50%;
      }
      
      input[type=text], input[type=password], input[type=email], select {
        width: 250px;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
      }

      input[type=submit], button {
        background-color: #3f3e53;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
      }
      fieldset{
        padding:20px;
        margin:0;
        display:inline-block;
        zoom:1.0;/* ie6/7 hack for inline block */
        vertical-align:middle;
        width:fit-content;
      }

      header p{
        color:white;
        margin:20px;
        font-size: 20px;
      }
    </style>
  </head>
<body>
<h2>Inscription</h2>

  <fieldset>
    <legend>Veuillez remplir tous les champs!</legend>
    <form action="inscrip.php" method="post">
      <table>
        <tr>
          <td>Pseudonyme</td>
          <td><input type="text" name="pseudo" required value="<?php echo isset($_POST['pseudo']) ? $_POST['pseudo'] : '' ?>"></td>
        </tr>
        <tr>
          <td>Mot de passe</td>
          <td><input type="password" name="mdp" required value="<?php echo isset($_POST['mdp']) ? $_POST['mdp'] : '' ?>"></td>
        </tr>
        <tr>
          <td>Nom</td>
          <td><input type="text" name="nom" required value="<?php echo isset($_POST['nom']) ? $_POST['nom'] : '' ?>"></td>
        </tr>
        <tr>
          <td>Prénom</td>
          <td><input type="text" name="prenom" required value="<?php echo isset($_POST['prenom']) ? $_POST['prenom'] : '' ?>"></td>
        </tr>
        <tr>
          <td>Courriel</td>
          <td><input type="email" name="courriel" required value="<?php echo isset($_POST['courriel']) ? $_POST['courriel'] : '' ?>"></td>
        </tr>
        <tr>
            <td>Classe:</td>
            <td>
              <?php
                if (!empty($_POST['classe'])) {
                  $dropDownVal = $_POST['classe'];
                } else {
                    $dropDownVal = "";
                }
              ?>
            <select name="classe">
                <option value="G" <?php if($dropDownVal == "G") echo 'selected="selected"'; ?>>Guerrier</option>
                <option value="P"<?php if($dropDownVal == "P") echo 'selected="selected"'; ?>>Paladin</option>
                <option value="B"<?php if($dropDownVal == "B") echo 'selected="selected"'; ?>>Bandit</option>
                <option value="M"<?php if($dropDownVal == "M") echo 'selected="selected"'; ?>>Mage</option>
            </select>
            </td>
           
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;"><input type="submit" value="Valider"></td>
        </tr>
        <p class="message">Déjà un compte? <a href="connexion.php">Connectez-vous</a></p>        
      </table>
    </form>
  </fieldset>

  <div>
    <p><span class="erreur"><?= $message ?></span></p>
  </div>
  </main>
</body>
</html>
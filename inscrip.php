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
    InsertInscription($nom,$prenom,$pseudo,$mdp,$courriel,$classe);
    header("Location: connexion.php");
    exit;
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
  </head>
<body>
<h2>Inscription</h2>

  <fieldset>
    <legend>Veuillez remplir tous les champs S.V.P.</legend>
    <form action="inscrip.php" method="post">
      <table>
        <tr>
          <td>Pseudonyme</td>
          <td><input type="text" name="pseudo" required></td>
        </tr>
        <tr>
          <td>Mot de passe</td>
          <td><input type="password" name="mdp" required></td>
        </tr>
        <tr>
          <td>Nom</td>
          <td><input type="text" name="nom" required></td>
        </tr>
        <tr>
          <td>Prénom</td>
          <td><input type="text" name="prenom" required></td>
        </tr>
        <tr>
          <td>Courriel</td>
          <td><input type="email" name="courriel" required></td>
        </tr>
        <tr>
            <td>Classe:</td>
            <td>
            <select name="classe">
                <option value="G">Guerrier</option>
                <option value="P">Paladin</option>
                <option value="B">Bandit</option>
                <option value="M">Mage</option>
            </select>
            </td>
           
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;"><input type="submit" value="Valider"></td>
        </tr>
        <tr>
          <td>
          <p class="message">Déjà un compte? <a href="connexion.php">Connectez-vous</a></p>
          </td>

        </tr>
        
      </table>
    </form>
  </fieldset>

  <div>
    <p><span class="erreur"><?= $message ?></span></p>
  </div>
  </main>
</body>
</html>
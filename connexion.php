<?php
session_start();
require "include/bd.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $id = membreValide($_POST['pseudo'], $_POST['mdp']);
  $pseudo = $_POST['pseudo'];
  // si les données de connexion sont valides
  if ($id !== false) {
    // on récupère les données du membre et on les met dans la session
    $membre = getMembre($id);
    $_SESSION['pseudo'] = $membre['pseudo'];
    $_SESSION['id']     = $membre['id'];
    $_SESSION['nom']    = $membre['nom'];
    $_SESSION['prenom'] = $membre['prenom'];
    header('Location: index.php');
    exit;
  } else {
    $message = "Données de connexion invalides";
  }
}
?>

<h2>Connexion à Darquest</h2>

<fieldset>
  <legend>Veuillez vous identifer</legend>
  <form action="connexion.php" method="post">
    <table>
      <tr>
        <td>Alias</td>
        <td><input type="text" name="alias" required></td>
      </tr>
      <tr>
        <td>Mot de passe</td>
        <td><input type="password" name="mdp" required></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: center;"><input type="submit" value="Valider"></td>
      </tr>
    </table>
  </form>
</fieldset>
<p>
  <a href="inscrip.php">Pas encore inscrit?</a>
  <br>
  <br>
  <a href="index.php"><button>Gestion des items</button></a>
</p>
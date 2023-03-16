<?php
session_start();
require "include/header.php";


?>

<h2>Connexion à Darquest</h2>

<fieldset>
  <legend>Veuillez vous connecter</legend>
  <form action="connexion.php" method="post">
    <table>
      <tr>
        <td>Alias</td>
        <td><input type="text" name="alias" value="<?= $alias ?>" required></td>
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



<p class="erreur">
  <?= $message ?>
</p>
<p>
  <a href="inscrip.php">Pas encore inscrit?</a>
  <br>
  <br>
  <a href="index.php"><button>Galerie des items</button></a>
</p>


<?php
#Rajouter le bas de page ici
?>
<?php




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
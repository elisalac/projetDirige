<?php
session_start();

require "include/bd.php";

$id = "";
$message = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  
  if(isset($_POST["conne"]))
  {
    $mdp = trim($_POST['mdp']);
    $alias =trim($_POST['alias']);
    $id = membreValide($alias, $mdp);
    $membre = getMembre($id);
    if(empty($alias))
        {
          $message="<h4 style='color:red'><b>Le pseudonyme est vide!</b></h4>";
          exit;
        }
        else if(password_verify($mdp,$membre['mdp']))
        {
          $_SESSION['alias']=$membre['alias'];
          $_SESSION['usagerValide']=true;
          $_SESSION['id']=$range['idJoueur'];
          $_SESSION['motDePasse']=$membre['mdp'];
          header('Location:index.php');
          exit;
        }
        else
        {
          $message="<h4 style='color:red'><b>Données de connexion invalides!</b></h4>";
        }
    }
  }
   else {
    $message = "Données de connexion invalides";
  }
?>

<h2>Connexion à Darquest</h2>
<?php
 echo $message; 
?>
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
        <td colspan="2" style="text-align: center;"><input type="submit" value="Valider" name="conne"></td>
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
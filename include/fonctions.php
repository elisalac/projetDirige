<?php 
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// ----------------------------------------------------------------------------
// Envoie le courriel de confirmation.
// ----------------------------------------------------------------------------
function envoyerCourrielConfirmation($nom, $prenom, $courriel, $id_confirmation) {
  $debut_html = '<!DOCTYPE html><html lang="fr"><head><meta charset="UTF-8"><title>Confirmation d\'inscription</title></head><body style="text-align: center;"><p>Bienvenue dans mon site Web, ' . $prenom . ' ' . $nom . '!</p><p>Cliquez sur le bouton pour confirmer votre inscription et vous connecter.</p><a href="http://192.99.154.153/~elisa/SolutionL1/confirm.php?id=';
  $fin_html = '">Confirmer inscription</a></body></html>';

  // crée une instance de PHPMailer et active les exceptions
  $mail = new PHPMailer(true);

  try {
    // paramètres du serveur
    $mail->isSMTP();
    $mail->Host       = "in-v3.mailjet.com";
    $mail->Port       = 587;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // données de connexion fournies par Mailjet
    $mail->Username   = "7f4b3c0e3aa4a30c4279281c512fb633";
    $mail->Password   = "86b870c6f37d1b36cbe4fe73e6da6382";

    $mail->setFrom("202189772@edu.clg.qc.ca", "Elisa Lacombe");
    $mail->addAddress($courriel, "Mon site Web");

    $mail->IsHTML(true);
    $mail->Subject    = "Confirmation d'inscription";

    $mail->Body       = $debut_html . $id_confirmation . $fin_html;
    $mail->AltBody    = "Votre programme de courriel n'affiche pas le HTML";

    // envoi du message
    $mail->send();
    return true;
  } catch (Exception $e) {
    echo "Échec de l'envoi du message. Erreur : {$mail->ErrorInfo}";
    return false;
  }
}
?>
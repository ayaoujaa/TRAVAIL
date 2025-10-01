<?php


use PHPMailer\PHPMailer\PHPMailer;


use PHPMailer\PHPMailer\Exception;

 

require __DIR__ . '/phpmailer/Exception.php';


require __DIR__ . '/phpmailer/PHPMailer.php';


require __DIR__ . '/phpmailer/SMTP.php';

 

$mail = new PHPMailer(true);

 

include '_conf.php';


$bdd = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);

 

if (isset($_POST['email']))


{


    $lemail = $_POST['email'];


    echo "le formulaire a été envoyé avec comme email la valeur :".$lemail;


    try {


        // Config SMTP Hostinger


        $mail->isSMTP();


        $mail->Host       = 'smtp.hostinger.com';


        $mail->SMTPAuth   = true;


        $mail->Username   = 'contact@sioslam.fr';  // ⚠️ remplace par ton email Hostinger


        $mail->Password   = '&5&Y@*QHb';            // ⚠️ remplace par le mot de passe de cette boîte mail


        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 


        $mail->Port       = 587;

 

        // Expéditeur


        $mail->setFrom('contact@sioslam.fr', 'CONTACT SIOSLAM');


        // Destinataire


        $mail->addAddress($lemail);

 

        // Récupérer le mot de passe depuis la base de données


        $requete = "SELECT * FROM utilisateur WHERE email = '$lemail'";


        $resultat = mysqli_query($bdd, $requete);


        $mdp = '';

 

        while($donnees = mysqli_fetch_assoc($resultat))


        {


            $login = $donnees['login'];


            $mdp = $donnees['motdepasse'];


        }

 

        // Contenu


        $mail->isHTML(true);


        $mail->Subject = 'MPD oublié';


        $mail->Body    = "Votre mdp : $mdp" ;

 

        $mail->send();    


        echo "✅ Email envoyé avec succès !";


    } catch (Exception $e) {


        echo "❌ Erreur d'envoi : {$mail->ErrorInfo}";


    }

 

    // Mettre à jour le mot de passe


    $changemdp = "UPDATE utilisateur SET motdepasse='nnnn' WHERE email ='$lemail'";


    if (!mysqli_query($bdd, $changemdp))
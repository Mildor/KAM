<?php
include "connexionbdd.php";

if (isset($_POST['emailname']) && !empty($_POST['emailname'])){
    $email = htmlentities($_POST['emailname']);
    $req_email = 'SELECT * FROM utillisateurs WHERE email = "'.$email.'" ;';
    
    $value_email = $pdo->query($req_email);
    $data_email = $value_email->fetch();
    $value_email->closeCursor();
    
    if($data_email){
        $rand_un = rand(0,9);
        $rand_deux = rand(0,9);
        $rand_trois = rand(0,9);
        $rand_quatre = rand(0,9);
        $rand_cinq = rand(0,9);
        
        $pass = $rand_un.$rand_deux.$rand_trois.$rand_quatre.$rand_cinq;
        //echo $data_email['email'].' '.$pass;
        
        $to      = $email;
        $subject = 'Réinitialisation mot de passe !';
        $message = 'Bonjour, Veuillez inserez la valeurs suivantes comme indiquez sur le site :'. "\r\n";
        $message .= $pass;
        $headers = 'From: Kaminstrumentale' . "\r\n" .
        'Reply-To: artesburger@kaminstrumentale.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
        
        echo '<form style="display: none;" action="confirmation-code" method="POST">';
        echo '<input name="pass" type="hidden" value="'.$pass.'">';
        echo '<input name="iduser" type="hidden" value="'.$data_email['id_utilisateurs'].'">';
        echo '<input id="pass" style="display: none;" type="submit" >';
        echo '</form>';
        
        echo "<script> var submit = document.getElementById('pass'); submit.click(); </script>";
    }else{
        echo "<script type='text/javascript'>document.location.replace('/kam/Mot-de-Passe-Oublier?err=1');</script>";
    }
    
    
    
    
}


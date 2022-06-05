
<?php
include "connexionbdd.php";

if (isset($_POST['mailname']) && isset($_POST['passwordname']) and
    !empty($_POST['mailname']) && !empty($_POST['passwordname'])){
    $email = htmlentities($_POST['mailname']);
    $pass = htmlentities($_POST['passwordname']) ;

    $req =  'SELECT * FROM utillisateurs WHERE email="'.$email.'";';
    
    

    $res = $pdo->query($req);

    $count = $res->rowCount();
    
    if($count != 0 ){
        while ($ligne = $res->fetch()){
            $hashed = $ligne['password'];
            if (password_verify($pass, $hashed)){
                
                if($ligne['admin'] == 1){
                    //Generate a random string.
                    $token = openssl_random_pseudo_bytes(16);
                    
                    //Convert the binary data into hexadecimal representation.
                    $token = bin2hex($token);
                    
                    setcookie('token', $token);
                    setcookie('token', $token, time()+3600);
                    
                    session_start();
                    
                    $_SESSION['token'] = $token;
                    $_SESSION['mail'] = htmlentities($email);
                    $_SESSION['iduser'] = htmlentities($ligne['id_utilisateurs']);
                    $_SESSION['pseudo'] =  htmlentities($ligne['Pseudo']);
                    
                    header('Location: /kam/Admin_kam_maj_onglets');
                }else{
                  session_start();
              
                    $_SESSION['mail'] = htmlentities($email);
                    $_SESSION['iduser'] = htmlentities($ligne['id_utilisateurs']);
        
                    $_SESSION['pseudo'] =  htmlentities($ligne['Pseudo']);
        
                    echo "<script type='text/javascript'>document.location.replace('/kam/');</script>";
                }
                
            }else{
                echo "<script type='text/javascript'>document.location.replace('/kam/Connexion?err=1');</script>";
            }
        }
        
    }else{
        echo "<script type='text/javascript'>document.location.replace('/kam/Connexion?err=2');</script>";
    }
    

}else{
    echo "<script type='text/javascript'>document.location.replace('/kam/Connexion?err=3');</script>";
}

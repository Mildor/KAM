<?php
include "connexionbdd.php";
if (isset($_POST['emailname']) && !empty($_POST['emailname'])){
    $email = htmlentities($_POST['emailname']);
    $reqverifemail =  'SELECT email FROM utillisateurs WHERE email="'.$email.'";';

    
    
    $resemail = $pdo->query($reqverifemail);

    $count = $resemail->rowCount();

        if ($count != 0){
            echo "<script type='text/javascript'>document.location.replace('/kam/Registration.php?err=2');</script>";
        }else{
            if ( isset($_POST['pseudoname']) && isset($_POST['passname']) && !empty($_POST['pseudoname']) && !empty($_POST['passname'])){
                $pseudo = htmlentities($_POST['pseudoname']);
                
                if (isset($_POST['datenaisname']) && !empty($_POST['datenaisname'])){
                    $datenais = htmlentities($_POST['datenaisname']);
                }else{
                    $datenais = '0000-00-00';
                }
                
                $pass =htmlentities($_POST['passname']) ;
            
                $hashed_password = password_hash($pass, PASSWORD_BCRYPT);
            
                $req = 'INSERT INTO `utillisateurs`(`Pseudo`, `email`, `dateNais`, `password`) VALUES (:pseudo, :email, :datenais, :pass);';
            
                $query = $pdo->prepare($req);
                $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
                $query->bindValue(':email',$email, PDO::PARAM_STR);
                $query->bindValue(':datenais',$datenais, PDO::PARAM_STR);
                $query->bindValue(':pass',$hashed_password, PDO::PARAM_STR);
                $query->execute();
                
                $req_select = 'SELECT * FROM utillisateurs WHERE email ="'.$email.'";';
                $res_select = $pdo->prepare($req_select);
                $res_select->execute();
                while($raw = $res_select->fetch()){
                    $iduser = $raw['id_utilisateurs'];
                }
                session_start();
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['mail'] = $email;
                $_SESSION['iduser'] = $iduser;
                echo "<script type='text/javascript'>document.location.replace('/kam/');</script>";
            }
            else{
                echo "<script type='text/javascript'>document.location.replace('/kam/Registration.php?err=1');</script>";
            }
            
        }
}
    

   




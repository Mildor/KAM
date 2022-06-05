<?php
include 'connexionbdd.php';
    
if (isset($_POST['oldmdp']) && !empty($_POST['oldmdp'])){
        
    $id_user = htmlentities($_POST['iduser']);
    $oldmdp = htmlentities($_POST['oldmdp']);
    $req_user = 'SELECT * FROM utillisateurs WHERE id_utilisateurs='.$id_user.' ;';
    $res_user = $pdo->prepare($req_user);
    $res_user->execute();
    $data_user = $res_user->fetch();
    
    $password = htmlentities($data_user['password']);

    
    if(password_verify($oldmdp, $password)){
        if(isset($_POST['mdp']) && isset($_POST['secondmdp']) && !empty($_POST['mdp']) && !empty($_POST['secondmdp'])){
            $mdp = htmlentities($_POST['mdp']);
            $second_mdp = htmlentities($_POST['secondmdp']);
            if ($mdp == $second_mdp){
                $pseudo = htmlentities($_POST['pseudo']);
                $email = htmlentities($_POST['email']);

                $datenais = htmlentities($_POST['dates']);

                $datenais = str_replace('/', '', $datenais);

                $day = substr($datenais, 0, 2);
                $month = substr($datenais, 2, 2);
                $year = substr($datenais, 4);

                $date = $year.'-'.$month.'-'.$day;

                $hashed_password = password_hash($mdp, PASSWORD_BCRYPT);

                $req_upd = 'UPDATE `utillisateurs` SET `Pseudo`="'.$pseudo.'", `email`="'.$email.'", `dateNais`="'.$date.'", `password`="'.$hashed_password.'" WHERE `id_utilisateurs`='.$id_user.' ;';

                $res_upd = $pdo->prepare($req_upd);
                $res_upd->execute();

                session_start();

                $_SESSION['mail'] = htmlentities($email);
                $_SESSION['iduser'] = htmlentities($id_user);
                $_SESSION['pseudo'] =  htmlentities($pseudo);

                echo "<script type='text/javascript'>document.location.replace('/kam/mon_compte.php');</script>";
            }else{
                echo "<script type='text/javascript'>document.location.replace('/kam/mon_compte.php?erreur=2');</script>";
            }
        }else{
            $pseudo = htmlentities($_POST['pseudo']);
            $email = htmlentities($_POST['email']);
            $datenais = htmlentities($_POST['dates']);
            $datenais = str_replace('/', '', $datenais);

            $day = substr($datenais, 0, 2);
            $month = substr($datenais, 2, 2);
            $year = substr($datenais, 4);

            $date = $year.'-'.$month.'-'.$day;

            $req_upd = 'UPDATE `utillisateurs` SET `Pseudo`="'.$pseudo.'", `email`="'.$email.'", `dateNais`="'.$date.'" WHERE `id_utilisateurs`='.$id_user.' ;';

            $res_upd = $pdo->prepare($req_upd);
            $res_upd->execute();

            session_start();

            $_SESSION['mail'] = htmlentities($email);
            $_SESSION['iduser'] = htmlentities($id_user);
            $_SESSION['pseudo'] =  htmlentities($pseudo);

            echo "<script type='text/javascript'>document.location.replace('/kam//Mon-Compte');</script>";
        }

    }else{
        //
        echo "<script type='text/javascript'>document.location.replace('/kam//Mon-Compte?erreur=1');</script>";
    }
    
}
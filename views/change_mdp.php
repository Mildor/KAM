<?php
include "connexionbdd.php";
if(isset($_POST['iduser']) && isset($_POST['passname']) && !empty($_POST['iduser']) && !empty($_POST['passname'])){
    $id_user = htmlentities($_POST['iduser']);
    $password = htmlentities($_POST['passname']);
    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    $req_upd = 'UPDATE `utillisateurs` SET `password`="'.$hashed_password.'" WHERE `id_utilisateurs`='.$id_user.' ;';
    
    echo $req_upd;
    
    $value_upd = $pdo->query($req_upd);
    $value_upd->closeCursor();
    
    echo "<script type='text/javascript'>document.location.replace('/kam/Connexion');</script>";
}
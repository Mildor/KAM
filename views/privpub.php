<?php
include "connexionbdd.php";
include "allvariable.php";
if (isset($_SESSION['iduser'])){
    $publique = $_POST['publique'];
    $idtexte = $_POST['idtexte'];
    $iduser = $_SESSION['iduser'];

    if ($publique==0){
        $req = "UPDATE `texte` SET `publique`=0 WHERE id_utilisateurs=".$iduser." AND id_texte=".$idtexte.";";
    }else{
        $req = "UPDATE `texte` SET `publique`=1 WHERE id_utilisateurs=".$iduser." AND id_texte=".$idtexte.";";
    }

    $res = $pdo->prepare($req);
    $res->execute();
    echo "<script type='text/javascript'>document.location.replace('/kam/Mes-textes');</script>";
}


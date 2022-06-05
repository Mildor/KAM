<?php
include "connexionbdd.php";
include "allvariable.php";
if (isset($_SESSION['iduser'])){
    $idtexte = $_POST['idtexte'];
    if ($_POST['delete']=="Oui"){
        $reqdel = "DELETE FROM `texte` WHERE id_utilisateurs=".$_SESSION['iduser']." AND id_texte=".$idtexte.";";

        $resdel = $pdo->prepare($reqdel);
        $resdel->execute();
    }else if (isset($_POST['texte'])){
        $contenue = $_POST['texte'];
        $parsecont = str_replace("'","|",$contenue);

        $req = "UPDATE `texte` SET `contenu`='".$parsecont."' WHERE id_utilisateurs=".$_SESSION['iduser']." AND id_texte=".$idtexte.";";

        $res = $pdo->prepare($req);
        $res->execute();
    }
    echo "<script type='text/javascript'>document.location.replace('/kam/Mes-textes');</script>";
}
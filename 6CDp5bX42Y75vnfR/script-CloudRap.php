<?php
session_start();

if(isset($_COOKIE['token']) && isset($_SESSION['token'])){
    $token_cookie = $_COOKIE['token'];
    $token_session = $_SESSION['token'];
    
    if($token_cookie == $token_session){
include 'connexionbdd.php';

$Cloud = [];

$lienapiCloud = [];

$reqcloud = "SELECT * FROM `api` WHERE `Titreapi` LIKE '%Cloud Rap%' AND `id_apigenre`=7";

$rescloud = $pdo->query($reqcloud);

while ($ligne = $rescloud->fetch()){
    array_push($Cloud, $ligne['Titreapi']);
    array_push($lienapiCloud, $ligne['lienapi']);
}

$sizecl = sizeof($Cloud);

for ($o = 0 ; $o < $sizecl; $o++){
    $reqcl = "INSERT INTO `videos`(`TitreVideo`, `lienVideo`, `id_genres`) VALUES ('".$Cloud[$o]."','".$lienapiCloud[$o]."',7);";
    $link = mysqli_connect('localhost','kaminstr_Admin','Kam!45instrumentale','kaminstr_prod','3306');
    $req = mysqli_query($link,$reqcl);

    if (mysqli_errno($link) == 1062){
        //echo "error";
        //echo "<br>";
    }else{
        //echo "fonctionne";
        //echo "<br>";
    }
}

unlink('cloudrap.json');

echo "<script type='text/javascript'>document.location.replace('/Admin_kam_maj_onglets/mise-a-jour');</script>";
}else{
        header('Location: /');
    }
}else{
    header('Location: /');
}
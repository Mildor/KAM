<?php
session_start();

if(isset($_COOKIE['token']) && isset($_SESSION['token'])){
    $token_cookie = $_COOKIE['token'];
    $token_session = $_SESSION['token'];
    
    if($token_cookie == $token_session){
include 'connexionbdd.php';

$RnB = [];

$lienapiRnB = [];

$reqrnb = "SELECT * FROM `api` WHERE `Titreapi` LIKE '%R&B%' OR `Titreapi` LIKE '%RnB%' AND `id_apigenre`=5";

$resRnB = $pdo->query($reqrnb);

while ($ligne = $resRnB->fetch()){
    array_push($RnB, $ligne['Titreapi']);
    array_push($lienapiRnB, $ligne['lienapi']);
}

$sizern = sizeof($RnB);

for ($m = 0 ; $m < $sizern; $m++){
    $reqrn = "INSERT INTO `videos`(`TitreVideo`, `lienVideo`, `id_genres`) VALUES ('".$RnB[$m]."','".$lienapiRnB[$m]."',5);";
    $link = mysqli_connect('localhost','kaminstr_Admin','Kam!45instrumentale','kaminstr_prod','3306');
    $req = mysqli_query($link,$reqrn);

    if (mysqli_errno($link) == 1062){
        //echo "error";
        //echo "<br>";
    }else{
        //echo "fonctionne";
        //echo "<br>";
    }
}

unlink('RnB.json');

echo "<script type='text/javascript'>document.location.replace('/Admin_kam_maj_onglets/mise-a-jour');</script>";
}else{
        header('Location: /');
    }
}else{
    header('Location: /');
}
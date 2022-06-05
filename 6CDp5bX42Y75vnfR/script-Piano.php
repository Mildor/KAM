<?php
session_start();

if(isset($_COOKIE['token']) && isset($_SESSION['token'])){
    $token_cookie = $_COOKIE['token'];
    $token_session = $_SESSION['token'];
    
    if($token_cookie == $token_session){
include 'connexionbdd.php';

$Piano = [];

$lienapiRnB = [];

$reqpiano = "SELECT * FROM `api` WHERE `Titreapi` LIKE '%Piano%' AND `id_apigenre`=4";

$resPiano = $pdo->query($reqpiano);

while ($ligne = $resPiano->fetch()){
    array_push($Piano, $ligne['Titreapi']);
    array_push($lienapiPiano, $ligne['lienapi']);
}

$sizepi = sizeof($Piano);

for ($l = 0 ; $l < $sizepi; $l++){
    $reqpi = "INSERT INTO `videos`(`TitreVideo`, `lienVideo`, `id_genres`) VALUES ('".$Piano[$l]."','".$lienapiPiano[$l]."',4);";
    $link = mysqli_connect('localhost','kaminstr_Admin','Kam!45instrumentale','kaminstr_prod','3306');
    $req = mysqli_query($link,$reqpi);

    if (mysqli_errno($link) == 1062){
        //echo "error";
        //echo "<br>";
    }else{
        //echo "fonctionne";
        //echo "<br>";
    }
}

unlink('piano.json');

echo "<script type='text/javascript'>document.location.replace('/Admin_kam_maj_onglets/mise-a-jour');</script>";
}else{
        header('Location: /');
    }
}else{
    header('Location: /');
}
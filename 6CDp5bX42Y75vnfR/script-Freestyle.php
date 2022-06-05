<?php
session_start();

if(isset($_COOKIE['token']) && isset($_SESSION['token'])){
    $token_cookie = $_COOKIE['token'];
    $token_session = $_SESSION['token'];
    
    if($token_cookie == $token_session){
include 'connexionbdd.php';

$Freestyle = [];

$lienapiFreestyle = [];

$reqfreestyle = "SELECT * FROM `api` WHERE `Titreapi` LIKE '%Freestyle%' AND `id_apigenre`=8";

$resFreestyle = $pdo->query($reqfreestyle);

while ($ligne = $resFreestyle->fetch()){
    array_push($Freestyle, $ligne['Titreapi']);
    array_push($lienapiFreestyle, $ligne['lienapi']);
}

$sizefr = sizeof($Freestyle);

for ($p = 0 ; $p < $sizefr; $p++){
    $reqfr = "INSERT INTO `videos`(`TitreVideo`, `lienVideo`, `id_genres`) VALUES ('".$Freestyle[$p]."','".$lienapiFreestyle[$p]."',8);";
    $link = mysqli_connect('localhost','kaminstr_Admin','Kam!45instrumentale','kaminstr_prod','3306');
    $req = mysqli_query($link,$reqfr);

    if (mysqli_errno($link) == 1062){
        //echo "error";
        //echo "<br>";
    }else{
        //echo "fonctionne";
        //echo "<br>";
    }
}

unlink('Freestyle.json');

echo "<script type='text/javascript'>document.location.replace('/Admin_kam_maj_onglets/mise-a-jour');</script>";
}else{
        header('Location: /');
    }
}else{
    header('Location: /');
}
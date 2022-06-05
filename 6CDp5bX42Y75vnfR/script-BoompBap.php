<?php
include 'connexionbdd.php';
session_start();

if(isset($_COOKIE['token']) && isset($_SESSION['token'])){
    $token_cookie = $_COOKIE['token'];
    $token_session = $_SESSION['token'];
    
    if($token_cookie == $token_session){
$BoomBap = [];

$lienapiBoomBap = [];

$reqboombap = "SELECT * FROM `api` WHERE `Titreapi` LIKE '%BoomBap%' OR `Titreapi` LIKE '%Old School%' AND `id_apigenre`=3";

$resBoomBap = $pdo->query($reqboombap);

while ($ligne = $resBoomBap->fetch()){
    array_push($BoomBap, $ligne['Titreapi']);
    array_push($lienapiBoomBap, $ligne['lienapi']);
}

$sizebm = sizeof($BoomBap);

for ($k = 0 ; $k < $sizebm; $k++){
    $reqbm = "INSERT INTO `videos`(`TitreVideo`, `lienVideo`, `id_genres`) VALUES ('".$BoomBap[$k]."','".$lienapiBoomBap[$k]."',3);";
    $link = mysqli_connect('localhost','kaminstr_Admin','Kam!45instrumentale','kaminstr_prod','3306');
    $req = mysqli_query($link,$reqbm);

    if (mysqli_errno($link) == 1062){
        //echo "error";
        //echo "<br>";
    }else{
        //echo "fonctionne";
        //echo "<br>";
    }
}

unlink('BoomBap.json');

echo "<script type='text/javascript'>document.location.replace('/Admin_kam_maj_onglets/mise-a-jour');</script>";
}else{
        header('Location: /');
    }
}else{
    header('Location: /');
}
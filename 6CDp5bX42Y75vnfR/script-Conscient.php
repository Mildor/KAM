<?php
session_start();

if(isset($_COOKIE['token']) && isset($_SESSION['token'])){
    $token_cookie = $_COOKIE['token'];
    $token_session = $_SESSION['token'];
    
    if($token_cookie == $token_session){
include 'connexionbdd.php';

$Conscient = [];

$lienapiConscient = [];

$reqcons = "SELECT * FROM `api` WHERE `Titreapi` LIKE '%Conscient%' AND `id_apigenre`=6";

$resConscient = $pdo->query($reqcons);

while ($ligne = $resConscient->fetch()){
    array_push($Conscient, $ligne['Titreapi']);
    array_push($lienapiConscient, $ligne['lienapi']);
}
$sizeco = sizeof($Conscient);


for ($n = 0 ; $n < $sizeco; $n++){
    $reqco = "INSERT INTO `videos`(`TitreVideo`, `lienVideo`, `id_genres`) VALUES ('".$Conscient[$n]."','".$lienapiConscient[$n]."',6);";
    $link = mysqli_connect('localhost','kaminstr_Admin','Kam!45instrumentale','kaminstr_prod','3306');
    $req = mysqli_query($link,$reqco);

    if (mysqli_errno($link) == 1062){
        //echo "error";
        //echo "<br>";
    }else{
        //echo "fonctionne";
        //echo "<br>";
    }
}

unlink('conscient.json');

echo "<script type='text/javascript'>document.location.replace('/Admin_kam_maj_onglets/mise-a-jour');</script>";
}else{
        header('Location: /');
    }
}else{
    header('Location: /');
}
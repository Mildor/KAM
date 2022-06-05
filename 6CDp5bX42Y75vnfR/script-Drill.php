<?php
session_start();

if(isset($_COOKIE['token']) && isset($_SESSION['token'])){
    $token_cookie = $_COOKIE['token'];
    $token_session = $_SESSION['token'];
    
    if($token_cookie == $token_session){
include 'connexionbdd.php';

$Drill = [];

$lienapiDrill = [];

$reqdrill = "SELECT * FROM `api` WHERE `Titreapi` LIKE '%Drill%' AND `id_apigenre`=1";

$resDrill = $pdo->query($reqdrill);

while ($ligne = $resDrill->fetch()){
    array_push($Drill, $ligne['Titreapi']);
    array_push($lienapiDrill, $ligne['lienapi']);
}

$sizedr = sizeof($Drill);

for ($i = 0 ; $i < $sizedr; $i++){
    $reqdr = "INSERT INTO `videos`(`TitreVideo`, `lienVideo`, `id_genres`) VALUES ('".$Drill[$i]."','".$lienapiDrill[$i]."',1);";
    $link = mysqli_connect('localhost','kaminstr_Admin','Kam!45instrumentale','kaminstr_prod','3306');
    $req = mysqli_query($link,$reqdr);

    if (mysqli_errno($link) == 1062){
        //echo "error";
        //echo "<br>";
    }else{
        //echo "fonctionne";
        //echo "<br>";
    }
}

unlink('drill.json');

echo "<script type='text/javascript'>document.location.replace('/Admin_kam_maj_onglets/mise-a-jour');</script>";
}else{
        header('Location: /');
    }
}else{
    header('Location: /');
}
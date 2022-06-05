<?php
session_start();

if(isset($_COOKIE['token']) && isset($_SESSION['token'])){
    $token_cookie = $_COOKIE['token'];
    $token_session = $_SESSION['token'];
    
    if($token_cookie == $token_session){
include 'connexionbdd.php';

$Trap = [];

$lienapiTrap = [];

$reqtrap = "SELECT * FROM `api` WHERE `Titreapi` LIKE '%Trap%' AND `id_apigenre`=2";

$resTrap = $pdo->query($reqtrap);

while ($ligne = $resTrap->fetch()){
    array_push($Trap, $ligne['Titreapi']);
    array_push($lienapiTrap, $ligne['lienapi']);
}
$sizetr = sizeof($Trap);

for ($j = 0 ; $j < $sizetr; $j++){
    $reqtr = "INSERT INTO `videos`(`TitreVideo`, `lienVideo`, `id_genres`) VALUES ('".$Trap[$j]."','".$lienapiTrap[$j]."',2);";
    $link = mysqli_connect('localhost','kaminstr_Admin','Kam!45instrumentale','kaminstr_prod','3306');
    $req = mysqli_query($link,$reqtr);

    if (mysqli_errno($link) == 1062){
        //echo "error";
        //echo "<br>";
    }else{
        //echo "fonctionne";
        //echo "<br>";
    }
}

unlink('trap.json');

echo "<script type='text/javascript'>document.location.replace('/Admin_kam_maj_onglets/mise-a-jour');</script>";
}else{
        header('Location: /');
    }
}else{
    header('Location: /');
}
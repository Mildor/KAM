<?php
session_start();

if(isset($_COOKIE['token']) && isset($_SESSION['token'])){
    $token_cookie = $_COOKIE['token'];
    $token_session = $_SESSION['token'];
    
    if($token_cookie == $token_session){
include "connexionbdd.php";

$response = file_get_contents('https://www.googleapis.com/youtube/v3/search?key=AIzaSyAteLiuPfb53dKD1lEOWe-cErklyF0v-OU&maxResults=50&part=snippet&q=Type%20Beat%20Freestyle');

$response = json_decode($response);

$pageToken = $response->nextPageToken;

$jsonitems = [];
$pagecours = 0;
$pagemax = 5;

while ($pagecours < $pagemax){
    $json = file_get_contents('https://www.googleapis.com/youtube/v3/search?key=AIzaSyAteLiuPfb53dKD1lEOWe-cErklyF0v-OU&maxResults=50&part=snippet&q=Type%20Beat%20Freestyle&pageToken='.$pageToken);

    $alljson = json_decode($json);

    $pagecours++;
    $pageToken = $alljson->nextPageToken;

    array_push($jsonitems,$alljson->items);

    //echo $pageToken ." ";
}

//echo json_encode($jsonitems);

$stringjson = json_encode($jsonitems);

//var_dump($jsonitems);

$fichier = fopen('Freestyle.json', 'w+b');

fwrite($fichier, $stringjson);
fclose($fichier);

$drilljson = file_get_contents('freestyle.json');

$alldrill = json_decode($drilljson);

$size = sizeof($alldrill);

$arraytest = [];


for($i=0 ; $i <$size; $i++){
    $sizei = sizeof($alldrill[$i]);
    for ($j = 0; $j < $sizei; $j++) {
        array_push($arraytest, $alldrill[$i][$j]);
        $ar = $arraytest[$j];

    }
}

$sizearra = sizeof($arraytest);
$arrayvideoid = [];
$arrayvideoname = [];

for ($x=0 ; $x<$sizearra; $x++){
    array_push($arrayvideoid, $arraytest[$x]->id->videoId);
    array_push($arrayvideoname, $arraytest[$x]->snippet->title);
}

$sizevideoid = sizeof($arrayvideoid);


for ($p=0; $p< $sizevideoid; $p++){
    $videoid = $arrayvideoid[$p];
    $title = $arrayvideoname[$p];
    $req = "INSERT INTO `api`(`Titreapi`, `lienapi`, `id_apigenre`) VALUES ('".$title."','".$videoid."',8);";

    $link = mysqli_connect('localhost','kaminstr_Admin','Kam!45instrumentale','kaminstr_prod','3306');

    $req = mysqli_query($link,$req);

    if (mysqli_errno($link) == 1062){
        //echo "error";
        //echo "<br>";
    }else{
        //echo "fonctionne";
        //echo "<br>";
    }
}

echo "<script type='text/javascript'>document.location.replace('/Admin_kam_maj_onglets/mise-a-jour/script-Freestyle');</script>";
}else{
        header('Location: /');
    }
}else{
    header('Location: /');
}
?>
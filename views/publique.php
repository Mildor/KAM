<?php
session_start();
include "connexionbdd.php";

$req = "SELECT * FROM texte WHERE publique=1";
$res = $pdo->prepare($req);
$res->execute();
$contenue = [];
$iduser = [];
$titre_videos = [];
$id_videos = [];
while($ligne = $res->fetch()){
    array_push($contenue,$ligne['contenu']);
    array_push($iduser,$ligne['id_utilisateurs']);
    if($ligne['id_video'] != NULL){
        $req_videos = 'SELECT * FROM videos WHERE id_videos='.$ligne['id_video'].' ;';
        $res_videos = $pdo->query($req_videos);
        $data = $res_videos->fetch();
        if($data['lienVideo']){
            array_push($id_videos, $data['lienVideo']);
            array_push($titre_videos, $data['TitreVideo']);
        }
    }else{
        array_push($id_videos, NULL);
        array_push($titre_videos, NULL);
    }

}
?>

<!doctype html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/kamlogo0.png" />
    <title>Kaminstrumental</title>
</head>

<body>
<header>
    <?php
    include 'navbar.php';
    ?>
</header>
<main>
    <?php
    $size_iduser = sizeof($iduser);
    if ($size_iduser == 0){
        echo '<h1 style="color: white; margin-left:2%;">Aucun texte n\'est public pour l\'instant revenez plus tard !</h1>';
    }
    for ($i = 0; $i<$size_iduser ;$i++){
        $reqpseudo = "SELECT Pseudo FROM utillisateurs WHERE id_utilisateurs=".$iduser[$i].";";
        $respseudo = $pdo->prepare($reqpseudo);
        $respseudo->execute();
        while ($lignep = $respseudo->fetch()){
            $contenue[$i] = str_replace('|', "'", $contenue[$i]);
            $contenue[$i] = strip_tags($contenue[$i]);
            echo "<div class='texte_publique'>";
            echo "<h4 class='titre_texte'><b>Ce texte a été écrit par : ".$lignep['Pseudo']."</b></h4>";
            echo "<p  class='contenue_texte'>".$contenue[$i]."</p>";
            if($titre_videos[$i] != NULL){
                echo '<a  href="#'.$id_videos[$i].'" id="a">'.$titre_videos[$i].'</a>';
            }
            echo "</div>";
        }
    }
    ?>
</main>
</body>
</html>
<script>
    var a = document.querySelectorAll("#a");
    var url = 'popup-video';

    a.forEach(element => {
        element.addEventListener('click', e=>{
            let value_url = element.getAttribute('href');
            good_url = url+value_url;
            console.log(good_url);
            showAsReservation(good_url);
        })
    })

    function showAsReservation(url) {
        window.open(url, "", "width=315,height=175");
    }
</script>

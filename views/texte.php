<?php
include "connexionbdd.php";
include "allvariable.php";

$publique = [];
$contenue = [];
$idtexte = [];
$titre_videos = [];
$id_videos = [];

$req = "SELECT * FROM texte WHERE id_utilisateurs = " . $_SESSION['iduser'];

$res = $pdo->prepare($req);
$res->execute();

while ($ligne = $res->fetch()) {
    array_push($publique, $ligne['publique']);
    array_push($contenue, $ligne['contenu']);
    array_push($idtexte, $ligne['id_texte']);

    $req_videos = 'SELECT * FROM videos WHERE id_videos='.$ligne['id_video'].' ;';
    $res_videos = $pdo->query($req_videos);
    $data = $res_videos->fetch();
    array_push($id_videos, $data['lienVideo']);  
    array_push($titre_videos, $data['TitreVideo']);
}
$size_publique = sizeof($publique);
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
        <?php include 'navbar.php'; ?>
    </header>
    <main>
        <div class='robine'>

            <?php
            if($size_publique == 0){
                echo '<h1 style="color: white; margin-left:2%;">Enregistrer vos textes puis revenez sur cette page afin de les retrouver !</h1>';
            }
            for ($i = 0; $i < $size_publique ; $i++) {
                echo '<script></script>';
                $realcontenue = str_replace('|', "'", $contenue[$i]);
                echo "<div class='mestextes'>";
                echo "<form action='privpub.php' method='POST'>";
                echo "<input name='idtexte' type='hidden' value='" . $idtexte[$i] . "'>";
                if ($publique[$i] == 0) {
                    echo "<input name='priv' class='public' type='submit' id='pub" . $i . "' value='Rends le public'>";
                    echo "<input name='publique' type='hidden' value='1'>";
                } else {
                    echo "<input name='priv' class='private' type='submit' id='pub" . $i . "' value='Rends le privé'>";
                    echo "<input name='publique' type='hidden' value='0'>";
                }
                echo "</form>";
                echo "<form action='savedel.php' method='POST'>";
                echo "<input name='idtexte' type='hidden' value='" . $idtexte[$i] . "'>";
                echo "<textarea name='texte'>";
                echo "$realcontenue";
                echo "</textarea>";
                echo "<input  class='save' name='savemod' type='submit' id='save" . $i . "' value='&#xf0c7;'>";
                echo "<br>";
                echo "</form>";
                echo "<form action='safedel.php' method='POST'>";
                echo "<input name='idtexte' type='hidden' value='" . $idtexte[$i] . "'>";
                echo "<input class='delete' name='delete' type='submit' id='delete" . $i . "' value='&#xf014;'>";
                echo "</form>";
                if($titre_videos[$i] != NULL){
                    echo '<a href="#'.$id_videos[$i].'" id="a">'.$titre_videos[$i].'</a>';
                }
                echo "</div>";
            }
            ?>
        </div>
    </main>
    <footer><?php include 'footer.php' ?></footer>
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
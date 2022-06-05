<?php
include "connexionbdd.php";
include "allvariable.php";
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
<body onload="">
<header>
    <?php
    include 'navbar.php';
    ?>

</header>
<main>
    <div class="divlike">

        <?php
        $reqlikedvid = "SELECT * FROM aimer WHERE id_utilisateurs=".$iduser.";";
        $reslikedvid = $pdo->prepare($reqlikedvid);
        $reslikedvid->execute();
        $idvid = [];
        $lienvideo = [];

        while ($ligne = $reslikedvid->fetch()){
            array_push($idvid, $ligne['id_videos']);
        }

        $sizeofidvid = sizeof($idvid);

        for ($i = 0 ; $i<$sizeofidvid; $i++){
            $reqlienvid = "SELECT * FROM videos WHERE id_videos='".$idvid[$i]."'";

            $reslienvid = $pdo->prepare($reqlienvid);
            $reslienvid->execute();

            while ($lignelien = $reslienvid->fetch()){
                array_push($lienvideo, $lignelien['lienVideo']);
            }
        }

        $sizeoflienvid = sizeof($lienvideo);
        if($sizeoflienvid == 0){
            echo '<h1 style="color: white; margin-left:13.5%;">Aimer des vidéos puis revenez sur cette page afin de les retrouver !</h1>';
        }
        ?>
        
            <?php
            for ($j=0; $j<$sizeoflienvid; $j++){
                echo '<div class="cartevid">';
                echo '<form name="deleted" target="_blank" action="ajoutlike.php" method="POST">';
                echo "<iframe id='frameliked' class='vidlike' src='https://www.youtube.com/embed/".$lienvideo[$j]."'></iframe>";
                echo "<input type='hidden' id='inputdataremove' name='inputdataremove' value='".$idvid[$j]."'>";
                echo "<input type='submit' id='delike' onclick='refresh()' name='dislike' value='Supprimer'>";
                echo '</form>';
                echo "</div>";
            }
            ?>

        
    </div>

    <script>
        function refresh(){
            setTimeout(waitabit, 75);
        }

        function waitabit(){
            window.location.reload();
        }
    </script>
    
</main>
<footer>
    <?php include 'footer.php' ?>
</footer>
</body>
</html>
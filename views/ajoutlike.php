<?php
include 'connexionbdd.php';
session_start();
$user = $_SESSION['iduser'];
$email = $_SESSION['mail'];

if (isset($_POST['inputdata'])){
    $link = mysqli_connect('localhost','root','','kaminstrumental','3307');


    $data = $_POST['inputdata'];
    $reqvid = "SELECT * FROM videos WHERE lienVideo='".$data."'";
    $requser = "SELECT * FROM utillisateurs WHERE email='".$email."'";

    $resvid = $pdo->prepare($reqvid);
    $resvid->execute();

    while ($lignevid = $resvid->fetch()){
        $idvid = $lignevid['id_videos'];
    }

    $resuser = $pdo->prepare($requser);
    $resuser->execute();

    while ($ligneuser = $resuser->fetch()){
        $iduser = $ligneuser['id_utilisateurs'];
    }

    $reqinsert = "INSERT INTO `aimer`(`id_videos`, `id_utilisateurs`) VALUES ('".$idvid."','".$iduser."');";
    $resinsert = mysqli_query($link,$reqinsert);

    if (mysqli_errno($link) == 1062){
        $lienremove = $_POST['inputdataremove'];

        $reqgetid = "SELECT * FROM videos WHERE lienvideo='".$lienremove."'";

        $resid = $pdo->prepare($reqgetid);
        $resid->execute();

        while ($ligneresid = $resid->fetch()){
            $id = $ligneresid['id_videos'];
        }

        $reqremove = "DELETE FROM `aimer` WHERE id_videos ='".$id."' AND id_utilisateurs='".$user."'";

        $resremove = $pdo->prepare($reqremove);
        $resremove->execute();
    }else{
    }

}elseif (isset($_POST['inputdataremove'])){
    $id_videos = $_POST['inputdataremove'];
    $reqremove = "DELETE FROM `aimer` WHERE id_videos ='".$id_videos."' AND id_utilisateurs='".$user."';";
    
    $resremove = $pdo->prepare($reqremove);
    $resremove->execute();
}



?>

<script>
    window.top.close();
</script>

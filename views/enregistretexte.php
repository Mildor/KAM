<?php
session_start();
include "connexionbdd.php";
if (isset($_SESSION['mail'])&&isset($_SESSION['iduser'])){
    $publique = $_POST['publique'];
    $contenue = $_POST['texterap'];
    $idusername = $_SESSION['iduser'];
    $video = htmlentities($_POST['videotexte']);
    
    $req_videos = 'SELECT * FROM videos WHERE lienVideo="'.$video.'" ;';
    
    $res_videos = $pdo->prepare($req_videos);
    $res_videos->execute();
    
    $data_videos = $res_videos->fetch();
    $res_videos->closeCursor();
    
    $id_videos = $data_videos['id_videos'];

    $contparse = str_replace("'","|",$contenue);

    $reqsave = "INSERT INTO `texte`(`publique`, `contenu`, `id_utilisateurs`, `id_video`) VALUES (".$publique.",'".$contparse."',".$idusername.",".$id_videos.");";
    
    echo $reqsave;

    $resave = $pdo->prepare($reqsave);
    $resave->execute();
}
?>
<script>
window.top.close();
</script>

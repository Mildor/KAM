<?php
session_start();
if (isset($_SESSION['mail'])) {
$email = $_SESSION['mail'];
$iduser = $_SESSION['iduser'];
//echo "<h1>".$email."</h1>";
$reqalllien = "SELECT * FROM aimer WHERE id_utilisateurs='".$iduser."';";
$resalllien = $pdo->prepare($reqalllien);
$resalllien->execute();
$arrayidvid = [];
$arraylienvid = [];
while ($lignealllien = $resalllien->fetch()){
array_push($arrayidvid, $lignealllien['id_videos']);
}

$sizeofarrayvid = sizeof($arrayidvid);
for ($i = 0 ; $i<$sizeofarrayvid; $i++){
$reqlienvid = "SELECT * FROM videos WHERE id_videos='".$arrayidvid[$i]."';";

$reslienvid = $pdo->prepare($reqlienvid);
$reslienvid->execute();

while ($ligneazerty = $reslienvid->fetch()){
array_push($arraylienvid, $ligneazerty['lienVideo']);
}
}
}

$req = "SELECT * FROM videos";

$res = $pdo->query($req);

$videoid = [];

while ($ligne = $res->fetch()){
array_push($videoid, $ligne['lienVideo']);
}

$req = "SELECT * FROM videos WHERE id_genres = 1";

$res = $pdo->query($req);

$iddrill = [];

while ($ligne = $res->fetch()){
array_push($iddrill, $ligne['lienVideo']);
}
$trap = "SELECT * FROM videos WHERE id_genres = 2";

$part = $pdo->query($trap);

$idtrap = [];

while ($ligne = $part->fetch()){
array_push($idtrap, $ligne['lienVideo']);
}

$boombap = "SELECT * FROM videos WHERE id_genres = 3";

$pabmoob = $pdo->query($boombap);

$idboompbap = [];

while ($ligne = $pabmoob->fetch()){
array_push($idboompbap, $ligne['lienVideo']);
}
$piano = "SELECT * FROM videos WHERE id_genres = 4";

$onaip = $pdo->query($piano);

$idpiano = [];

while ($ligne = $onaip->fetch()){
array_push($idpiano, $ligne['lienVideo']);
}
$rnb = "SELECT * FROM videos WHERE id_genres = 5";

$bnr = $pdo->query($rnb);

$idrnb = [];

while ($ligne = $bnr->fetch()){
array_push($idrnb, $ligne['lienVideo']);
}
$conscient = "SELECT * FROM videos WHERE id_genres = 6";

$consc = $pdo->query($conscient);

$idcons = [];

while ($ligne = $consc->fetch()){
array_push($idcons, $ligne['lienVideo']);
}
$cloudrap = "SELECT * FROM videos WHERE id_genres = 7";

$rapcloud = $pdo->query($cloudrap);

$idcloud = [];

while ($ligne = $rapcloud->fetch()){
array_push($idcloud, $ligne['lienVideo']);
}
$free = "SELECT * FROM videos WHERE id_genres = 8";

$style = $pdo->query($free);

$idfreestyle = [];

while ($ligne = $style->fetch()){
array_push($idfreestyle, $ligne['lienVideo']);
}
?>
<script><?php echo "var videoid = '".implode("<>", $videoid)."'.split('<>');"?></script>
<script><?php echo "var iddrill = '".implode("<>", $iddrill)."'.split('<>');"?></script>
<script><?php echo "var idtrap = '".implode("<>", $idtrap)."'.split('<>');"?></script>
<script><?php echo "var idboompbap = '".implode("<>", $idboompbap)."'.split('<>');"?></script>
<script><?php echo "var idpiano = '".implode("<>", $idpiano)."'.split('<>');"?></script>
<script><?php echo "var idrnb = '".implode("<>", $idrnb)."'.split('<>');"?></script>
<script><?php echo "var idcons = '".implode("<>", $idcons)."'.split('<>');"?></script>
<script><?php echo "var idcloud = '".implode("<>", $idcloud)."'.split('<>');"?></script>
<script><?php echo "var idfreestyle = '".implode("<>", $idfreestyle)."'.split('<>');"?></script>

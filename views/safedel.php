<?php
$idtexte = $_POST['idtexte'];
?>
<?php
include "connexionbdd.php";
include "allvariable.php";


$req = "SELECT * FROM texte WHERE id_utilisateurs = " . $_SESSION['iduser'];

$res = $pdo->prepare($req);
$res->execute();

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
    <?php include 'navbar.php'; ?>
</header>
<main>
    <form action="savedel.php" method="POST">
        <label><h1>Es-tu sur de vouloir supprimer ton texte ? (Ce choix est irreversible)</h1></label>
        <input name="delete" type="submit" value="Oui">
        <input name="delete" type="submit" value="non">
        <input type="hidden" name="idtexte" value="<?php echo $idtexte?>">
    </form>
</main>
</body>
</html>
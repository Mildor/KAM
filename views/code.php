<?php
$id_user = $_POST['iduser'];
$pass = $_POST['pass'];
if (isset($_POST['essaie']) && !empty($_POST['essaie'])){
    $essaie = $_POST['essaie'];
}elseif(!isset($essaie)){
    $essaie = 3;
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/signup.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/kamlogo0.png" />
    <title>Crée ton compte</title>
</head>

<body>
    <header>
        <?php
        include 'navbar.php';
        ?>
    </header>
    <main>
        <div id="signup" class="signup">

            <form action="confirmation-reinitialisation-mot-de-passe" method="POST">
                <input type='hidden' name='essaie' value='<?php echo $essaie ?>' />
                <input type='hidden' name='iduser' value='<?php echo $id_user ?>'/>
                <input type='hidden' name='passcode' value='<?php echo $pass ?>'/>
                <h2>Entre le code reçu par mail :</h2>
                <div class="passlab"><label for="pass">Code à 5 chiffres :</label>
                <input class="txtinput" type="number" id="pass" name="passcodeuser" placeholder="12345" />
                <br>
                <input type="submit" class="submitbtn" id="valider"/>
                <?php
                    if($essaie == 3){
                        echo '<h3>Il vous reste : '.$essaie.' chances </h3>';
                    }elseif($essaie == 2){
                        echo '<h3>Il vous reste : '.$essaie.' chances </h3>';
                    }elseif($essaie == 1){
                        echo '<h3>C\'est ta dernière chance !</h3>';
                    }
                ?>
            </form>
        </div>

    </main>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>

</html>
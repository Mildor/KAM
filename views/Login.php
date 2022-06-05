<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <meta name="viewport" content="width=device-width, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/signup.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="img/kamlogo0.png" />
        <title>Connexion</title>
    </head>

    <header>
        <?php
        include 'navbar.php';
        ?>
    </header>

    <div class="signup">
        <form action="connexion.php" method="POST">
            <h2>Connecte-toi</h2>

            <label for="email">Email</label><br>
            <input class="txtinput" type="email" id="mail" name="mailname" placeholder="Email" autofocus />
            <br>
            <label for="password">Mot de passe</label><br>
            <input class="txtinput" type="password" id="password" name="passwordname" placeholder="...." />
            <br>
            <a href="/kam/Mot-de-Passe-Oublier"> Mot de passe oublié ? </a><br>
            <input class="submitbtn" type="submit" value="Connecte toi !" />
            <?php
                if(isset($_GET['err']) && !empty($_GET['err'])){
                    $error = $_GET['err'];
                    if ($error == 1){
                        echo '<h3 style="color: red; text-decoration: none">Votre mot de passe est érroné</h3>';
                    }elseif ($error == 2){
                        echo '<h3 style="color: red; text-decoration: none">Votre email n\'existe pas</h3>';
                    }elseif ($error == 3){
                        echo '<h3 style="color: red; text-decoration: none">Entrez des valeurs dans les champs de textes</h3>';
                    }
                }
            ?>
        </form>
        <footer><?php include 'footer.php' ?></footer>
    </div>
    </body>

</html>
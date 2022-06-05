<?php
$id_user = htmlentities($_POST['iduser']);
$pass_user = htmlentities($_POST['passcodeuser']);
$pass = htmlentities($_POST['passcode']);
$essaie = $_POST['essaie'];


if (isset($pass_user) && !empty($pass_user) && $pass == $pass_user){
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
        <title>Nouveau mot de passe</title>
    </head>
    
    <body>
        <header>
            <?php
            include 'navbar.php';
            ?>
        </header>
        <main>
            <div id="signup" class="signup">
    
                <form action="changement-mot-de-passe" method="POST">
                    <input type='hidden' name='iduser' value='<?php echo $id_user ?>'>
                    <h2>Entre le nouveau mot de passe</h2>
                    <div class="passlab"><label for="pass">Mot de passe *</label><span class="passinfo">Majuscules, Minuscules, Chiffres, Caractères spéciaux</span><br></div>
                    <span class="error" id="errorpass"></span></br>
                    <input oninput="passv(),buttona();" class="txtinput" type="password" id="pass" name="passname" placeholder="........" />
                    <br>
                    <label for="conirfmpass">Confirmation du mot de passe</label><br>
                    <span class="error" id="errorpass2"></span>
                    <input oninput="cpassv(),buttona();" class="txtinput" type="password" id="conirfmpass" name="confirmpassname" placeholder="........" />
                    <br>
                    
                    <input type="submit" class="submitbtn" id="valider" placeholder="SIGN UP" disabled="" ; />
                </form>
            </div>
    
        </main>
        <footer><?php include 'footer.php' ?></footer>
    </body>
    
    </html>
    <script>
    var validationmail = 0;
    var validationpass = 0;
    var validationpass2 = 0;
    
    function passv() {
        var vpass = document.getElementById("pass").value;
        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,14}$/
        if (!vpass.match(regex)) {
            document.getElementById('errorpass').innerHTML = ("Majuscule,Minuscule,Chiffre,Caractère spéciale");
            validationpass = 0;
        } else {
            document.getElementById('errorpass').innerHTML = "";
            validationpass = 1;
        }
    }

    function cpassv() {
        var vpass = document.getElementById("pass").value;
        var vcmpass = document.getElementById("conirfmpass").value;
        if (vpass != vcmpass) {
            document.getElementById('errorpass2').innerHTML = ("Invalide les mots de passes ne correspondent pas");
            validationpass2 = 0;
        } else {
            document.getElementById('errorpass2').innerHTML = "";
            validationpass2 = 1;
        }
    }
    const button = document.getElementById('valider');

    function buttona() {
        if (( validationpass && validationpass2) == 1) {
            
            button.disabled = false;
            console.log( validationpass && validationpass2)
        } else {
            button.disabled = true;
            console.log( validationpass && validationpass2)
        }
    }
    var str = window.location.href;

    var url = new URL(str);

    var err = url.searchParams.get("err");

    console.log(err);
    if (err == 1) {
        var titre = document.createElement("h1");
        titre.setAttribute("style", "color:red");

        var texte = document.createTextNode("Une erreur lors de l'inscription");

        titre.appendChild(texte); //on on accroche texte a <a>


        var node = document.getElementById("signup");
        // pour plus de flexibilité, peut-être remplacé par :
        // var node = document.getElementsByTagName("body")[0];
        node.appendChild(titre);
    }
    if (err == 2) {
        var titre = document.createElement("h1");
        titre.setAttribute("style", "color:red");

        var texte = document.createTextNode("L'email existe déjà");

        titre.appendChild(texte); //on on accroche texte a <a>


        var node = document.getElementById("signup");
        // pour plus de flexibilité, peut-être remplacé par :
        // var node = document.getElementsByTagName("body")[0];
        node.appendChild(titre);
    }
</script>
    <?php
}else{
    if($essaie == 1){
        echo "<script type='text/javascript'>document.location.replace('/kam/Mot-de-Passe-Oublier?err=3');</script>";
    }else{
        $essaie = $essaie - 1;
    echo '<form action="confirmation-code" method="POST">';
    echo '<input type="hidden" value="'.$essaie.'" name="essaie"/>';
    echo '<input type="submit" style="display: none;" id="submitessaie">';
    echo '</form>';
    echo "<script type='text/javascript'>document.getElementById('submitessaie').click();</script>";
    }
}
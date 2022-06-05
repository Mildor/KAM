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
    <title>Inscription</title>
</head>

<body>
    <header>
        <?php
        include 'navbar.php';
        ?>
    </header>
    <main>
        <div id="signup" class="signup">

            <form action="register.php" method="POST">
                <h2>Inscris-toi</h2>
                <label for="pseudo">Comment doit-on t'appeler ? </label><br>
                <input type="text" id="pseudo" name="pseudoname" class="txtinput" placeholder="Entre ton nom" autofocus />
                <br>
                <label for="email">Email</label><br>
                <input oninput="mailv(),buttona();" class="txtinput" type="email" id="email" name="emailname" placeholder="Email" />
                <span class="error" id="errormail"></span></br>


                <label for="datenais">Date de naissance</label><br>
                <input class="txtinput" type="date" is="datenais" name="datenaisname" placeholder="Enter your full name" />
                <br>
                <div class="passlab"><label for="pass">Mot de passe *</label><span class="passinfo">Majuscules, Minuscules, Nombres, Caractères spéciaux</span><br></div>
                <input oninput="passv(),buttona();" class="txtinput" type="password" id="pass" name="passname" placeholder="........" />

                <span class="error" id="errorpass"></span></br>
                <br>
                <label for="conirfmpass">Confirmation du mot de passe</label><br>
                <input oninput="cpassv(),buttona();" class="txtinput" type="password" id="conirfmpass" name="confirmpassname" placeholder="........" />

                <span class="error" id="errorpass2"></span>
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

    function mailv() {
        var vmail = document.getElementById("email").value;
        var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
        if (!vmail.match(regex)) {
            document.getElementById('errormail').innerHTML = ("Veuillez renseigner un mail valide");
            validationmail = 0;
        } else {
            document.getElementById('errormail').innerHTML = "";
            validationmail = 1;
        }
    }

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
        if ((validationmail && validationpass && validationpass2) == 1) {
            
            button.disabled = false;
            console.log(validationmail && validationpass && validationpass2)
        } else {
            button.disabled = true;
            console.log(validationmail && validationpass && validationpass2)
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
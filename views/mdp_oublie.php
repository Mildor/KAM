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

            <form action="envoie-mail" method="POST">
                
                <h2>Rentre ton email</h2>
                <label for="email">Email</label><br>
                <input oninput="mailv(),buttona();" class="txtinput" type="email" id="email" name="emailname" placeholder="Email" />
                <span class="error" id="errormail"></span>
                <br>
                <input type="submit" class="submitbtn" id="valider" placeholder="SIGN UP" disabled="" ; />
                <?php
                    if (isset($_GET['err']) && $_GET['err']==1){
                        echo '<h3>L\'email entré n\'éxiste pas</h3>';
                        echo '<h5>Si vous n\'avez pas encore crée de compte rendez-vous sur cette page afin de vous enregistré : 
                                <br> <a href="/kam/Inscris-toi">Créer ton compte</a></h5>';
                    }elseif(isset($_GET['err']) && $_GET['err']==3){
                        echo '<h3>Tu as entré un code erroné trop de fois</h3>';
                    }
                ?>
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
    const button = document.getElementById('valider');

    function buttona() {
        if ((validationmail) == 1) {
            
            button.disabled = false;
            console.log(validationmail)
        } else {
            button.disabled = true;
            console.log(validationmail)
        }
    }
    var str = window.location.href;

    var url = new URL(str);

    var err = url.searchParams.get("err");

    console.log(err);
    if (err == 1) {
        var titre = document.createElement("h1");
        titre.setAttribute("style", "color:red");

        //var texte = document.createTextNode("Une erreur lors de l'inscription");

        titre.appendChild(texte); //on on accroche texte a <a>


        var node = document.getElementById("signup");
        // pour plus de flexibilité, peut-être remplacé par :
        // var node = document.getElementsByTagName("body")[0];
        node.appendChild(titre);
    }
    if (err == 2) {
        var titre = document.createElement("h1");
        titre.setAttribute("style", "color:red");

        //var texte = document.createTextNode("L'email existe déjà");

        titre.appendChild(texte); //on on accroche texte a <a>


        var node = document.getElementById("signup");
        // pour plus de flexibilité, peut-être remplacé par :
        // var node = document.getElementsByTagName("body")[0];
        node.appendChild(titre);
    }
</script>
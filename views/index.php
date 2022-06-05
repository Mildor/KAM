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

<body onload="url(),getHistorique(),ecritmoica()">
    <header>
        <?php
        include 'navbar.php';
        ?>
    </header>
    <main>
    <div class="background">
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
</div>
        <!-- div qui contient les fleches et la video aligné -->
        <div class="filter">
            <a onclick="url()" href="#accueil" id="random"><button style="background-color: white; border:1px solid black">Random 🎲</button></a>
            <a id="drill" onclick="url()" href="#Drill"><button>Drill 🔪</button></a>
            <a onclick="url()" href="#Trap" id="trap"><button> Trap 🤯</button></a>
            <a onclick="url()" href="#BoomBap" id="boombap"><button>BoomBap 👍</button></a>
            <a onclick="url()" href="#Piano" id="piano"><button>Piano 🎹</button></a>
            <a onclick="url()" href="#R&B" id="rnb"><button>R&B 💞</button></a>
            <a onclick="url()" href="#Conscient" id="conscient"><button>Conscient 🧠</button></a>
            <a onclick="url()" href="#CloudRap" id="cloudrap"><button>CloudRap ☁</button></a>
            <a onclick="url()" href="#Freestyle" id="freestyle"><button>Freestyle 🎤</button></a>
        </div>

        <div class="parent">
            <div class="div1 ">
                <button id="retour"><i class="fas fa-backward"></i></button>

            </div>
            <div id="video" class="div2">
            </div>
            <div class="div3 ">
                <button id="suivant" onclick="changevideo()"><i class="fas fa-forward "></i></button>
            </div>
            <div class="div4">
                <form target="popup" name="form" action="ajoutlike.php" method="POST">
                <?php
                if (isset($_SESSION['mail']) && isset($_SESSION['iduser'])) {
                ?><script>
                        <?php echo "var lienviduser = '" . implode("<>", $arraylienvid) . "'.split('<>');" ?>
                    </script><?php
                                echo '<button id="likela"><input id="likedit" class="radiobtn" onclick="clicklike()" type="radio" value="like !">
                    <label for="likedit"></label></button>';
                                echo '<button id="dislikela" style="display: none"><input id="dislikeit" class="radiobtn" onclick="dislike()" type="hidden" value="like !">
                    <label for="dislikeit"></label></button>';
                            } else {
                                echo '<button><input id="likedit" class="radiobtn" onclick="connectoi()" type="radio" value="like !">
                    <label for="likedit"></label></button>';
                            }
                                ?>
                </form>
            </div>


        </div>
        <h1 class="textefleche"> ⬇ ⬇ Ecris ton texte ci-dessous ⬇  ⬇</h1>
        <form target="popup" action="enregistretexte.php" method="POST" name="texte">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                </div>
                <div class="col-md-6 col-sm-9">
                    <div class="flex-box">
                        <textarea id="textarea1" class="input shadow" name="texterap" rows="25" cols="200" placeholder="Ecris ton texte ici">
                        </textarea>
                    </div>
                    <!-- <section id="oui"><h1>Oui c'est ici</h1></section> -->
                </div>
                <div class="col-md-3">

                </div>
                
            </div>
        <section class="edittext">
            <div class="flex-box">
                <div class="row">
                    <div class="col">
                        <button type="button" onclick="f9()" class="btnediteur btn shadow-sm btn-outline-primary side" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                            Effacer Texte</button>
                    </div>
                </div>
            </div>
            <br>
            
            <div class="savetexte">
            <?php
                if (isset($_SESSION['mail'])&&isset($_SESSION['iduser'])){
                echo '<!--<input value="Enregistrez-votre texte !" type="button" id="save" name="savetexte">-->';
                echo '<label >Veux-tu que ton texte soit public ou privé ?</label>';
                echo '<br>';
                echo ' <input id="publique" class="radiobtn" name="publique" type="radio" value="1"><label for="publique"> Public</label>';
                echo '<input id="nonpublique" class="radiobtn" name="publique" type="radio" value="0"><label for="nonpublique"> Privé</label>';
                echo '<input id="videotexte" name="videotexte" type="hidden" value="">';
                echo '<br>';
                echo '<input class="jsuisabout" type="submit" value="Enregistrer">';
                }else{
                    echo '<input class="jsuisabout" type="button" onclick="connectoi()" value="Enregistrer" id="pasco">';
                }
            ?>
            </form>
        </div>
        </section>
    </main>
        <footer>
            <?php include 'footer.php' ?>
    </footer>
</body>
<script src="js/texte.js"></script>

</html>


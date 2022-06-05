<?php
session_start();
include "connexionbdd.php";

if(isset($_SESSION['mail']) && isset($_SESSION['iduser']) && isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo']) && !empty($_SESSION['mail']) && !empty($_SESSION['iduser']) ){
    $mail = $_SESSION['mail'];
    $pseudo = $_SESSION['pseudo'];
    $id_user = $_SESSION['iduser'];
    $req_datenais = 'SELECT * FROM utillisateurs WHERE id_utilisateurs ='.$id_user.' ;';
    $res_date = $pdo->query($req_datenais);
    $data_date = $res_date->fetch();
    $res_date->closeCursor();
    $date = $data_date['dateNais'];
    $date = str_replace('-', '/', $date);
    $year = substr($date, 0 , 4);
    $month = substr($date, 5, 2);
    $day = substr($date, 8 , 9);
    $date = $day.'/'.$month.'/'.$year;
    
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
        <link href="css/signup.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/png" href="img/kamlogo0.png" />
        <title>Kaminstrumental</title>
    </head>
    
    <body onload=" verif_date(), verif_email(), check_confirm(), url(),getHistorique(), ecritmoica()">
        <header>
            <?php
            include 'navbar.php';
            ?>
        </header>
        <main>
            <div id='caract' class="signup45">
                <h1> Vos informations </h1>
                <h3 >Pseudo : <?php echo $pseudo ?></h3>
                <h3>E-mail : <?php echo $mail ?></h3>
                <h3>Age : <?php echo date("Y")- $year ?></h3>
                <?php  
                    if(isset($_GET['erreur']) && $_GET['erreur']==1){
                        echo "<h3 style='color: red'>Le mot de passe entré est faux !</h3>";
                    }
                ?>
                 <button type="button" class="btn " data-toggle="modal" data-target="#exampleModal">
              Modifier mes informations
            </button>
            </div>
           
            <!-- Modal -->
            <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header popupmodif">
                    <h5 class="modal-title" id="exampleModalLabel">Modifies tes informations de compte !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body ">
                    <form action='changement-compte' method='POST'>
                        <input type='hidden' name='iduser' value='<?php echo $id_user ?>' />

                        <span id="span_pseudo"></span><br>
                        <label for="">Mon pseudo :
                        <input oninput="verif_pseudo(), check_confirm()" id="pseudo" name='pseudo' type='text' value='<?php echo $pseudo ?>'/><br><br>
                        </label><br>

                        <span id="span_email"></span><br>
                        <label for="">Mon email* :
                        <input oninput="verif_email(), check_confirm()" id="email" name='email' type='text' value='<?php echo $mail ?>'/><br><br>
                        </label><br>


                        <span id="span_dates"></span><br>
                        <label for="">Ma date de naissance* :
                        <input oninput="verif_date(), check_confirm()" id="dates" name='dates' type='text' value='<?php echo $date ?>'/><br><br>
                        </label><br>


                        <span id="span_oldmdp"></span><br>
                        <label for="">Ancien mot de passe* :
                        <input oninput="verif_old_pass(), check_confirm()" id="oldmdp" type='password' name='oldmdp' placeholder='...............'/><br><br>
                        </label>
                        <br>

                        <span id="span_mdp"></span><br>
                        <label for="">Confirme ton mot de passe :
                        <input oninput="verif_pass(), check_confirm()" id="mdp" type='password'  name='mdp' placeholder='...............' value=""/><br><br>
                        </label><br>

                        <span id="span_second_pass"></span><br>
                        <label for="">Confirme ton mot de passe :
                        <input oninput="verif_second_pass(), check_confirm()"  id="second_pass" type='password' name="secondmdp" placeholder='...............'/><br><br>
                        </label> <br>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    <input id="save" disabled type="submit" class="btn btn-dark" value ='Enregistre tes modifications'/>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </main>
            <footer><?php include 'footer.php' ?></footer>
    </body>
    <script>
        let pass = document.getElementById('mdp').value;
        let confirm_date = 0;
        let confirm_mail = 0;
        let confirm_old_mdp = 0;
        let confirm_new_mdp = 1;
        let confirm_bis_new_mdp = 1;
        let confirm_pseudo = 1;

        function verif_pseudo(){
            let pseudo = document.getElementById('pseudo').value;
            let length = pseudo.length;
            if (length === 0){
                confirm_pseudo = 0;
            }else{
                confirm_pseudo = 1;
            }
        }

        function verif_old_pass(){
            let old_pass = document.getElementById('oldmdp').value;
            let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,14}$/;
            if(!old_pass.match(regex)){
                document.getElementById('span_oldmdp').innerHTML = 'Majuscule,Minuscule,Chiffre,Caractère spéciale';
                confirm_old_mdp = 0;
            }else{
                document.getElementById('span_oldmdp').innerHTML = '';
                confirm_old_mdp = 1;
            }
        }

        function verif_pass(){
            pass = document.getElementById('mdp').value;
            if(pass !== ''){
                confirm_bis_new_mdp = 0;
                confirm_new_mdp = 0;
                let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,14}$/;
                if(!pass.match(regex)){
                    document.getElementById('span_mdp').innerHTML = 'Majuscule,Minuscule,Chiffre,Caractère spéciale';
                    confirm_new_mdp = 0;
                }else{
                    document.getElementById('span_mdp').innerHTML = "";
                    confirm_new_mdp = 1;
                }
            }else{
                document.getElementById('span_mdp').innerHTML = "";
                confirm_new_mdp = 1;
                confirm_bis_new_mdp = 1;
            }
        }

        function verif_second_pass(){
            let second_pass = document.getElementById('second_pass').value;
            if (second_pass!== ''){
                confirm_bis_new_mdp = 0;
                if (second_pass !== pass){
                    document.getElementById('span_second_pass').innerHTML = 'Les mots de passes ne correspondent pas !';
                    confirm_bis_new_mdp = 0;
                }else{
                    document.getElementById('span_second_pass').innerHTML = '';
                    confirm_bis_new_mdp = 1;
                }
            }else if(pass !== ''){
                confirm_bis_new_mdp = 0;
            }else{
                document.getElementById('span_second_pass').innerHTML = '';
                confirm_bis_new_mdp = 1;
            }

        }

        function verif_email(){
            let email = document.getElementById('email').value;
            const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (!email.match(regex)){
                document.getElementById('span_email').innerHTML = 'L\'email n\'est pas conforme';
                confirm_mail = 0;
            }else{
                document.getElementById('span_email').innerHTML = '';
                confirm_mail = 1;
            }
        }

        function verif_date(){
            let date = document.getElementById('dates').value;
            const regex = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
            if (!date.match(regex)){
                document.getElementById('span_dates').innerHTML = 'La date doit être sous format DD/MM/YYYY';
                confirm_date = 0;
            }else{
                document.getElementById('span_dates').innerHTML = '';
                confirm_date = 1;
            }
        }

        function check_confirm(){
            document.getElementById('save').disabled = !(confirm_date !== 0
                && confirm_mail !== 0
                && confirm_old_mdp !== 0
                && confirm_new_mdp !== 0
                && confirm_bis_new_mdp !== 0
                && confirm_pseudo !== 0
            );
        }


    </script>
    
    </html>
    <?php
}
//Déclaration variable global
var historique = new Array();
var vidliked = new Array();
var compteur = 1;
var tab = new Array();
var lienviduser;
var liked = true;


//test si cookie est vide ou non
showCookie();
var test = tab.length;

if (test !== 1 ){
    historique = tab;
}

/**
 * Fonction qui randomise l'id de la vidéo
 * @param max
 * @returns {number}
 */
function getRandomInt(max) {
    //Retourne une valeur int aléatoire par rapport a la valeur max données
    return Math.floor(Math.random() * max);
}

/**
 * Fonction qui permet de changer de vidéo en appuyant qur le bouton suivant
 */
function changevideo() {
    //Récupère la vidéo iframe
    var vid = document.getElementById('iframevid');

    //condition qui supprime la vidéo en cours
    if (vid === null) {

    } else {
        vid.remove();
    }

    //utilisation de cette fonction pour recharger une nouvelle vidéo
    getVideos(videoid);

    //compteur remis à 1 pour que l'historique redémarre du bonne endroit
    compteur = 1;
}



/**
 * Fonction qui premet de parcourir les anciennes vidéos déjà vu
 */
function getHistorique() {
    var buttonlike = document.getElementById("likela");
    var buttondislike = document.getElementById("dislikela");
    var bouton = document.getElementById("retour");
    var like = document.getElementById("likedit");
    var dislike = document.getElementById("dislikeit");
    if (lienviduser===undefined || lienviduser[0] === '') {
        bouton.addEventListener("click", e=>{
            //on vérifie que le compteur n'ai pas une valeur plus haute que la longueur du tableau Historique
            if (compteur + 1 > historique.length) {
                compteur = 0;
            }
            //modifie la vidéo en cours pour afficher celle qui se trouve dans Historique a la position du compteur
            document.getElementById("iframevid").setAttribute('src', 'https://www.youtube.com/embed/' + historique[compteur]);

            if (vidliked.length !== 0) {
                var ansjs = vidliked.includes(historique[compteur]);
                if (ansjs) {
                    buttonlike.style.display = "none";
                    buttondislike.style.display = "";
                    $("#dislikeit").prop("checked",true);
                    like.setAttribute('type', 'hidden');
                    dislike.setAttribute('type', 'radio');
                    dislike.setAttribute('onclick', "dislike('" + historique[compteur] + "')");
                    liked=false;
                } else {
                    buttonlike.style.display = "";
                    buttondislike.style.display = "none";
                    $("#dislikeit").prop("checked",false);
                    like.setAttribute('type', 'radio');
                    dislike.setAttribute('type', 'hidden');
                    dislike.setAttribute('onclick', '');
                    liked=true;
                }
            }
            compteur++;
        });

    } else {
        for (var i = 0; i < lienviduser.length; i++) {
            vidliked.push(lienviduser[i]);
        }
        bouton.addEventListener("click", e=>{
            //on vérifie que le compteur n'ai pas une valeur plus haute que la longueur du tableau Historique
            if (compteur + 1 > historique.length) {
                compteur = 0;
            }
            //modifie la vidéo en cours pour afficher celle qui se trouve dans Historique a la position du compteur
            document.getElementById("iframevid").setAttribute('src', 'https://www.youtube.com/embed/' + historique[compteur]);

            if (vidliked.length !== 0) {
                //console.log("Cas ou 1er if faux : vidliked pas vide donc on l'utilise")
                var ansjs = vidliked.includes(historique[compteur]);
                if (ansjs) {
                    buttonlike.style.display = "none";
                    buttondislike.style.display = "";
                    $("#dislikeit").prop("checked",true);
                    like.setAttribute('type', 'hidden');
                    dislike.setAttribute('type', 'radio');
                    dislike.setAttribute('onclick', "dislike('" + historique[compteur] + "')");
                    liked=false;
                } else {
                    buttonlike.style.display = "";
                    buttondislike.style.display = "none";
                    $("#dislikeit").prop("checked",false);
                    like.setAttribute('type', 'radio');
                    dislike.setAttribute('type', 'hidden');
                    dislike.setAttribute('onclick', '');
                    liked=true;
                }
            }
            compteur++;
        });

    }
}

/**
 * Fonction qui réucpère les données au format JSON.
 * @param nextPageToken
 * @param vidsDone
 * @param params
 * @param search
 */
function getVideos(genrevid) {
    
    //récupère l'input du texte
    var texte = document.getElementById('videotexte');
    
    //Récupère la vidéo iframe
    var vid = document.getElementById('iframevid');

    //condition qui supprime la vidéo en cours
    if (vid === null) {

    } else {
        vid.remove();
    }

    //variable qui récupère l'id aléatoire générer par la fonction getRandomInt
    var idrandom = getRandomInt(genrevid.length);

    //variable qui récupère l'id de la vidéo
    var randvid = genrevid[idrandom];

    //Remplit le tableau à l'envers
    historique.unshift(randvid);

    //variable qui récupère la div qui contient la vidéo
    var divvideo = document.getElementById("video");

    //variable qui crée l'élément iframe pour afficher la vidéo
    var iframe = document.createElement("iframe");

    //Attributs qui permmette de donner un id et un lien a afficher pour la vidéo
    iframe.setAttribute('id', 'iframevid');
    iframe.setAttribute('src', 'https://www.youtube.com/embed/' + randvid + '?autoplay=1');
    
    //Donne en valeur l'id de la vidéo a l'input du texte
    if(texte){
        texte.setAttribute('value', randvid);
    }
    

    //ajout de l'élément iframe a la div vidéo
    divvideo.appendChild(iframe);
}

/**
 * Fonction qui permet de recuperer les valeur de l'url afin de changer les attribut des boutons de genres et suivant
 */
function wait() {
    //déclaration des variables
    var url = window.location.href;
    var genre;

    //Parcours de l'url pour récuperer la valeur apres le #
    for (var i = 0; i < url.length; i++) {
        var lengthmax = url.length;
        var lengthmot;

        if (url[i] === "#") {
            lengthmot = lengthmax - i - 1;
            genre = url.substr(i + 1, lengthmot + i);
        }
    }

    //Déclaration des variables du bouton suivant et des boutons de genres
    var bouton = document.getElementById("suivant");
    var navrandom = document.getElementById("random");
    var navdrill = document.getElementById("drill");
    var navtrap = document.getElementById("trap");
    var navboombap = document.getElementById("boombap");
    var navpiano = document.getElementById("piano");
    var navrnb = document.getElementById("rnb");
    var navconscient = document.getElementById("conscient");
    var navcloudrap = document.getElementById("cloudrap");
    var navfreestyle = document.getElementById("freestyle");

    //condition qui permet de changer les propriété des boutons de genres afin qu'ils attaquent le bon fichiers
    //mais aussi de changer le style des boutons.
    if (genre === '') {
        bouton.setAttribute('onclick', "changevideo(), createCookie()");
        navrandom.setAttribute('style', "color: black");
        navrandom.firstElementChild.setAttribute('style', "background-color:white;border:1px solid black");
        getVideos(videoid);
    } else if (genre === undefined) {
        bouton.setAttribute('onclick', "changevideo(), createCookie()");
        navrandom.setAttribute('style', "color: black");
        navrandom.firstElementChild.setAttribute('style', "background-color:white;border:1px solid black");
        getVideos(videoid);
    } else if (genre === 'accueil') {
        bouton.setAttribute('onclick', "changevideo(), createCookie()");
        navrandom.setAttribute('style', "color: black");
        navrandom.firstElementChild.setAttribute('style', "background-color:white;border:1px solid black");
        getVideos(videoid);
    } else if (genre === 'Drill') {
        bouton.setAttribute('onclick', "changedrill(), createCookie()");
        navdrill.setAttribute('style', "color: black");
        navdrill.firstElementChild.setAttribute('style', "background-color:white;border:1px solid black");
        getVideos(iddrill);
    } else if (genre === 'Trap') {
        bouton.setAttribute('onclick', "changeTrap(), createCookie()");
        navtrap.setAttribute('style', "color: black");
        navtrap.firstElementChild.setAttribute('style', "background-color:white;border:1px solid black");
        getVideos(idtrap);
    } else if (genre === 'BoomBap') {
        bouton.setAttribute('onclick', "changeBoomBap(), createCookie()");
        navboombap.setAttribute('style', "color: black");
        navboombap.firstElementChild.setAttribute('style', "background-color:white;border:1px solid black");
        getVideos(idboompbap);
    } else if (genre === 'Piano') {
        bouton.setAttribute('onclick', "changePiano(), createCookie()");
        navpiano.setAttribute('style', "color: black");
        navpiano.firstElementChild.setAttribute('style', "background-color:white;border:1px solid black");
        getVideos(idpiano);
    } else if (genre === 'R&B') {
        bouton.setAttribute('onclick', "changeRB(), createCookie()");
        navrnb.setAttribute('style', "color: black");
        navrnb.firstElementChild.setAttribute('style', "background-color:white;border:1px solid black");
        getVideos(idrnb);
    } else if (genre === 'Conscient') {
        bouton.setAttribute('onclick', "changeConscient(), createCookie()");
        navconscient.setAttribute('style', "color: black");
        navconscient.firstElementChild.setAttribute('style', "background-color:white;border:1px solid black");
        getVideos(idcons);
    } else if (genre === 'CloudRap') {
        bouton.setAttribute('onclick', "changeCloudRap(), createCookie()");
        navcloudrap.setAttribute('style', "color: black");
        navcloudrap.firstElementChild.setAttribute('style', "background-color:white;border:1px solid black");
        getVideos(idcloud);
    } else if (genre === 'Freestyle') {
        bouton.setAttribute('onclick', "changeFreestyle(), createCookie()");
        navfreestyle.setAttribute('style', "color: black");
        navfreestyle.firstElementChild.setAttribute('style', "background-color:white;border:1px solid black");
        getVideos(idfreestyle);
    }

    //Conditions qui change le style des boutons en fonction de l'url
    if (genre !== 'accueil' && genre !== undefined && genre !== '') {
        navrandom.setAttribute("style", 'color:');
        navrandom.firstElementChild.setAttribute('style', "color:");
    }
    if (genre !== 'Drill') {
        navdrill.setAttribute("style", 'color:');
        navdrill.firstElementChild.setAttribute('style', "color:");
    }
    if (genre !== 'Trap') {
        navtrap.setAttribute("style", 'color:');
        navtrap.firstElementChild.setAttribute('style', "color:");
    }
    if (genre !== 'BoomBap') {
        navboombap.setAttribute("style", 'color:');
        navboombap.firstElementChild.setAttribute('style', "color:");
    }
    if (genre !== 'Piano') {
        navpiano.setAttribute("style", 'color:');
        navpiano.firstElementChild.setAttribute('style', "color:");
    }
    if (genre !== 'R&B') {
        navrnb.setAttribute("style", 'color:');
        navrnb.firstElementChild.setAttribute('style', "color:");
    }
    if (genre !== 'Conscient') {
        navconscient.setAttribute("style", 'color:');
        navconscient.firstElementChild.setAttribute('style', "color:");
    }
    if (genre !== 'CloudRap') {
        navcloudrap.setAttribute("style", 'color:');
        navcloudrap.firstElementChild.setAttribute('style', "color:");
    }
    if (genre !== 'Freestyle') {
        navfreestyle.setAttribute("style", 'color:');
        navfreestyle.firstElementChild.setAttribute('style', "color:");
    }

    //console.log(genre);
    //console.log(window.location.href);
}

/**
 * Fonction qui appel la fonction wait avec un léger timeout (pour pouvoir récuperer la bonne url)
 */
function url() {
    setTimeout(wait, 1);
    //console.log(historique);
}


/**
 * Fonctions qui change les propriétés du bouton suivant en fonction de l'url
 */
function changedrill() {
    //Récupère la vidéo iframe
    var vid = document.getElementById('iframevid');

    //condition qui supprime la vidéo en cours
    if (vid === null) {

    } else {
        vid.remove();
    }

    //utilisation de cette fonction pour recharger une nouvelle vidéo
    getVideos(iddrill);

    //compteur remis à 1 pour que l'historique redémarre du bonne endroit
    compteur = 1;
}

function changeTrap() {
    //Récupère la vidéo iframe
    var vid = document.getElementById('iframevid');

    //condition qui supprime la vidéo en cours
    if (vid === null) {

    } else {
        vid.remove();
    }

    //utilisation de cette fonction pour recharger une nouvelle vidéo
    getVideos(idtrap);

    //compteur remis à 1 pour que l'historique redémarre du bonne endroit
    compteur = 1;
}

function changeBoomBap() {
    //Récupère la vidéo iframe
    var vid = document.getElementById('iframevid');

    //condition qui supprime la vidéo en cours
    if (vid === null) {

    } else {
        vid.remove();
    }

    //utilisation de cette fonction pour recharger une nouvelle vidéo
    getVideos(idboompbap);

    //compteur remis à 1 pour que l'historique redémarre du bonne endroit
    compteur = 1;
}

function changePiano() {
    //Récupère la vidéo iframe
    var vid = document.getElementById('iframevid');

    //condition qui supprime la vidéo en cours
    if (vid === null) {

    } else {
        vid.remove();
    }

    //utilisation de cette fonction pour recharger une nouvelle vidéo
    getVideos(idpiano);

    //compteur remis à 1 pour que l'historique redémarre du bonne endroit
    compteur = 1;
}

function changeRB() {
    //Récupère la vidéo iframe
    var vid = document.getElementById('iframevid');

    //condition qui supprime la vidéo en cours
    if (vid === null) {

    } else {
        vid.remove();
    }

    //utilisation de cette fonction pour recharger une nouvelle vidéo
    getVideos(idrnb);

    //compteur remis à 1 pour que l'historique redémarre du bonne endroit
    compteur = 1;
}

function changeConscient() {
    //Récupère la vidéo iframe
    var vid = document.getElementById('iframevid');

    //condition qui supprime la vidéo en cours
    if (vid === null) {

    } else {
        vid.remove();
    }

    //utilisation de cette fonction pour recharger une nouvelle vidéo
    getVideos(idcons);

    //compteur remis à 1 pour que l'historique redémarre du bonne endroit
    compteur = 1;
}

function changeCloudRap() {
    //Récupère la vidéo iframe
    var vid = document.getElementById('iframevid');

    //condition qui supprime la vidéo en cours
    if (vid === null) {

    } else {
        vid.remove();
    }

    //utilisation de cette fonction pour recharger une nouvelle vidéo
    getVideos(idcloud);

    //compteur remis à 1 pour que l'historique redémarre du bonne endroit
    compteur = 1;
}

function changeFreestyle() {
    //Récupère la vidéo iframe
    var vid = document.getElementById('iframevid');

    //condition qui supprime la vidéo en cours
    if (vid === null) {

    } else {
        vid.remove();
    }

    //utilisation de cette fonction pour recharger une nouvelle vidéo
    getVideos(idfreestyle);

    //compteur remis à 1 pour que l'historique redémarre du bonne endroit
    compteur = 1;
}
/**
 * Fin des fonctions qui change les propriétés du bouton suivant.
 */

function clicklike(){
    var buttonlike = document.getElementById("likela");
    var buttondislike = document.getElementById("dislikela");
    var dislike = document.getElementById("dislikeit");
    var like = document.getElementById("likedit");
    var iframe = document.getElementById('iframevid');
    var getlien = iframe.getAttribute('src');
    var bonlien = '';
    var indexslash = getlien.lastIndexOf('/')+1;
    var indexintero = getlien.lastIndexOf('?');

    if(indexintero<0){
        bonlien = getlien.substr(indexslash);
    }else{
        bonlien = historique[0];
    }
    console.log(bonlien);

    if (liked){
        buttondislike.style.display = "";
        buttonlike.style.display = "none";
        var form = document.forms['form']
        var input = document.createElement("input");
        vidliked.push(historique[0]);
        input.setAttribute("id","inputdataid");
        input.setAttribute("type","hidden");
        input.setAttribute("value",bonlien);
        input.setAttribute("name","inputdata");

        form.appendChild(input);

        form.submit();
        liked = false;
        $("#dislikeit").prop("checked", true);
        $("#likedit").prop("checked", false);
        dislike.setAttribute('type','radio');
        like.setAttribute('type','hidden');
        dislike.setAttribute("onclick","dislike('"+historique[0]+"')");
    }


}

function connectoi(){
    if (confirm('Connectes-toi pour sauvegardé et enregistré ton texte')){
        window.open('https://www.kaminstrumentale.com/Connexion', '_blank');
    }
    $("#likedit").prop("checked", false);
    $("#pasco").prop("checked", false);
}

function aimer(){
    var buttonlike = document.getElementById("likela");
    var buttondislike = document.getElementById("dislikela");
    var like = document.getElementById("likedit");
    var dislike = document.getElementById("dislikeit");
    if (lienviduser===undefined || lienviduser[0] === '') {
            if (vidliked.length !== 0) {
                var ansjs = vidliked.includes(historique[0]);
                if (ansjs) {
                    buttonlike.style.display = "none";
                    buttondislike.style.display = "";
                    $("#dislikeit").prop("checked",true);
                    like.setAttribute('type', 'hidden');
                    dislike.setAttribute('type', 'radio');
                    dislike.setAttribute('onclick', "dislike('" + historique[0] + "')");
                    liked=false;
                } else {
                    buttonlike.style.display = "";
                    buttondislike.style.display = "none";
                    $("#dislikeit").prop("checked",false);
                    like.setAttribute('type', 'radio');
                    dislike.setAttribute('type', 'hidden');
                    dislike.setAttribute('onclick', '');
                    liked=true;
                }
            }
    } else {
        for (var i = 0; i < lienviduser.length; i++) {
            vidliked.push(lienviduser[i]);
        }
            if (vidliked.length !== 0) {
                //console.log("Cas ou 1er if faux : vidliked pas vide donc on l'utilise")
                var ansjs = vidliked.includes(historique[0]);
                if (ansjs) {
                    buttonlike.style.display = "none";
                    buttondislike.style.display = "";
                    $("#dislikeit").prop("checked",true);
                    like.setAttribute('type', 'hidden');
                    dislike.setAttribute('type', 'radio');
                    dislike.setAttribute('onclick', "dislike('" + historique[0] + "')");
                    liked=false;
                } else {
                    buttonlike.style.display = "";
                    buttondislike.style.display = "none";
                    $("#dislikeit").prop("checked",false);
                    like.setAttribute('type', 'radio');
                    dislike.setAttribute('type', 'hidden');
                    dislike.setAttribute('onclick', '');
                    liked=true;
                }
            }
    }
}

function ecritmoica() {
    var buttonlike = document.getElementById("likela");
    var buttondislike = document.getElementById("dislikela");
    setTimeout(aimer, 3);
    var like = document.getElementById("likedit");
    var dislike = document.getElementById("dislikeit");
    var suivant = document.getElementById("suivant");
    if (lienviduser===undefined || lienviduser[0] === '') {
        suivant.addEventListener("click", e => {
            if (vidliked.length !== 0) {
                var ansjs = vidliked.includes(historique[0]);
                if (ansjs) {
                    buttonlike.style.display = "none";
                    buttondislike.style.display = "";
                    $("#dislikeit").prop("checked",true);
                    like.setAttribute('type', 'hidden');
                    dislike.setAttribute('type', 'radio');
                    dislike.setAttribute('onclick', "dislike('" + historique[0] + "')");
                    liked=false;
                } else {
                    buttonlike.style.display = "";
                    buttondislike.style.display = "none";
                    $("#dislikeit").prop("checked",false);
                    like.setAttribute('type', 'radio');
                    dislike.setAttribute('type', 'hidden');
                    dislike.setAttribute('onclick', '');
                    liked=true;
                }
            }
        });
    } else {
        for (var i = 0; i < lienviduser.length; i++) {
            vidliked.push(lienviduser[i]);
        }
        suivant.addEventListener("click", e => {
            if (vidliked.length !== 0) {
                //console.log("Cas ou 1er if faux : vidliked pas vide donc on l'utilise")
                var ansjs = vidliked.includes(historique[0]);
                if (ansjs) {
                    buttonlike.style.display = "none";
                    buttondislike.style.display = "";
                    $("#dislikeit").prop("checked",true);
                    like.setAttribute('type', 'hidden');
                    dislike.setAttribute('type', 'radio');
                    dislike.setAttribute('onclick', "dislike('" + historique[0] + "')");
                    liked=false;
                } else {
                    buttonlike.style.display = "";
                    buttondislike.style.display = "none";
                    $("#dislikeit").prop("checked",false);
                    like.setAttribute('type', 'radio');
                    dislike.setAttribute('type', 'hidden');
                    dislike.setAttribute('onclick', '');
                    liked=true;
                }
            }

        });
    }
}

function dislike(valeur){
    var like = document.getElementById("likedit");
    var dislike = document.getElementById("dislikeit");
    var form = document.forms['form']
    var input = document.createElement("input");
    var buttonlike = document.getElementById("likela");
    var buttondislike = document.getElementById("dislikela");

    if (!liked){
        input.setAttribute("id","inputdataidremove");
        input.setAttribute("type","hidden");
        input.setAttribute("value",valeur||'');
        input.setAttribute("name","inputdataremove");
        form.appendChild(input);
        form.submit();
        var myIndex = vidliked.indexOf(valeur);
        if (myIndex !== -1) {
            vidliked.splice(myIndex, 1);
        }
        buttonlike.style.display = "";
        buttondislike.style.display = "none";
        like.setAttribute('type','radio');
        dislike.setAttribute('type','hidden');
        dislike.setAttribute('onclick','');
        liked=true;
    }

}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function createCookie(){
    document.cookie='test='+historique+';expires=Wed, 18 Dec 2026 12:00:00 GMT';
}

function deleteCookie(){
    document.cookie='test=;expires=Thu, 01 Jan 1970';
    console.log("cookie deleted");
}

function showCookie(){
    var fname=getCookie("test");
    tab = fname.split(',');
    return tab;
}
function f1() {
    //fonction pour mettre le texte en gras
    document.getElementById("textarea1").style.fontWeight = "bold";
}

function f2() {
    //fonction pour mettre le texte en italique
    document.getElementById("textarea1").style.fontStyle = "italic";
}

function f3() {
    //function pour aligner le texte sur le côté gauche
    document.getElementById("textarea1").style.textAlign = "left";
}

function f4() {
    //function pour centrer le texte
    document.getElementById("textarea1").style.textAlign = "center";
}

function f5() {
    //fonction pour aligner le texte sur le côté droit
    document.getElementById("textarea1").style.textAlign = "right";
}

function f6() {
    //fonction pour mettre le texte en majuscule
    document.getElementById("textarea1").style.textTransform = "uppercase";
}

function f7() {
    //fonction pour mettre le texte en minuscule
    document.getElementById("textarea1").style.textTransform = "lowercase";
}

function f8() {
    //fonction pour mettre la première lettre de chaque phrase en majuscule
    document.getElementById("textarea1").style.textTransform = "capitalize";
}

function f9() {
    //fonction qui permet de supprimer tous les effets appliquer au texte
    document.getElementById("textarea1").style.fontWeight = "normal";
    document.getElementById("textarea1").style.textAlign = "left";
    document.getElementById("textarea1").style.fontStyle = "normal";
    document.getElementById("textarea1").style.textTransform = "capitalize";
    document.getElementById("textarea1").value = " ";
}
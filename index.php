<?php

$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '':
    case '/kam/' :
        require __DIR__ . '/views/index.php';
        break;
    case '/kam/Texte-Public' :

        require __DIR__ . '/views/publique.php';
        break;
    case '/kam/Mes-videos' :

        require __DIR__ . '/views/liked.php';
        break;
    case '/kam/Mes-textes' :

        require __DIR__ . '/views/texte.php';
        break;
    case '/kam/Deconnexion' :

        require __DIR__ . '/views/deconnexion.php';
        break;
    case '/kam/Inscris-toi' :

        require __DIR__ . '/views/Registration.php';
        break;
    case '/kam/register.php' :

        require __DIR__ . '/views/register.php';
        break;
    case '/kam/Connexion' :
    case '/kam/Connexion?err=1' :
    case '/kam/Connexion?err=2' :
    case '/kam/Connexion?err=3' :

        require __DIR__ . '/views/Login.php';
        break;
    case '/kam/connexion.php' :

        require __DIR__ . '/views/connexion.php';
        break;
    case '/kam/ajoutlike.php' :

        require __DIR__ . '/views/ajoutlike.php';
        break;
    case '/kam/enregistretexte.php' :

        require __DIR__ . '/views/enregistretexte.php';
        break;
    case '/kam/privpub.php' :

        require __DIR__ . '/views/privpub.php';
        break;
     case '/kam/About-KAM' :

        require __DIR__ . '/views/about.php';
        break;    
    case '/kam/savedel.php' :

        require __DIR__ . '/views/savedel.php';
        break;
    case '/kam/safedel.php' :

        require __DIR__ . '/views/safedel.php';
        break;
    case '/kam/Admin_kam_maj_onglets' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/index.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/Maj.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/Drill' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/scriptDrill.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/script-Drill' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/script-Drill.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/Trap' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/scriptTrap.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/script-Trap' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/script-Trap.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/BoomBap' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/scriptBoomBap.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/script-BoomBap' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/script-BoomBap.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/Piano' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/scriptPiano.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/script-Piano' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/script-Piano.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/RnB' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/scriptRnB.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/script-RnB' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/script-RnB.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/Conscient' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/scriptConscient.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/script-Conscient' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/script-Conscient.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/CloudRap' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/scriptCloudRap.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/script-CloudRap' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/script-CloudRap.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/Freestyle' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/scriptFreestyle.php';
        break;
    case '/kam/Admin_kam_maj_onglets/mise-a-jour/script-Freestyle' :

        require __DIR__ . '/6CDp5bX42Y75vnfR/script-Freestyle.php';
        break;
    case '/kam/Mot-de-Passe-Oublier' :
    case '/kam/Mot-de-Passe-Oublier?err=1' :
    case '/kam/Mot-de-Passe-Oublier?err=2' :
    case '/kam/Mot-de-Passe-Oublier?err=3' :
    

        require __DIR__ . '/views/mdp_oublie.php';
        break;
    case '/kam/envoie-mail' :

        require __DIR__ . '/views/envoie_mail.php';
        break;
    case '/kam/confirmation-code' :

        require __DIR__ . '/views/code.php';
        break;
    case '/kam/confirmation-reinitialisation-mot-de-passe' :

        require __DIR__ . '/views/reinitialisation_mdp.php';
        break;
    case '/kam/changement-mot-de-passe' :

        require __DIR__ . '/views/change_mdp.php';
        break;
    case '/kam/Mon-Compte' :
    case '/kam/Mon-Compte?erreur=1' :

        require __DIR__ . '/views/mon_compte.php';
        break;
    case '/kam/changement-compte' :

        require __DIR__ . '/views/modification_compte.php';
        break;
    case '/kam/popup-video' :

        require __DIR__ . '/views/popup_video.php';
        break;
    case '/kam/save_sql' :

        require __DIR__ . '/views/sql_backup.php';
        break;
    case '/kam/save_ftp' :

        require __DIR__ . '/views/ftp_backup.php';
        break;
        
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
<?php

require_once('connexionbdd.php');

$fichier_save = fopen('save_bdd.sql', 'c+b');
file_put_contents('save_bdd.sql', '');

$back_up = '-- PHP Script '.PHP_EOL;
$back_up .= '-- Hôte : localhost:3306 '.PHP_EOL;
$back_up .= '-- Généré le : '.date("D. j F Y à H:i").PHP_EOL;
$back_up .= '-- Version de PHP : '.phpversion().PHP_EOL;
$back_up .= 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";'.PHP_EOL;
$back_up .= 'SET AUTOCOMMIT = 0;'.PHP_EOL;
$back_up .= 'SET time_zone = "+00:00";'.PHP_EOL;
$back_up .= '/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */; '.PHP_EOL;
$back_up .= '/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */; '.PHP_EOL;
$back_up .= '/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */; '.PHP_EOL;
$back_up .= '/*!40101 SET NAMES utf8mb4 */; '.PHP_EOL;
$back_up .= '-- '.PHP_EOL;
$back_up .= '-- Base de données : `kaminstr_test` '.PHP_EOL;
$back_up .= '-- '.PHP_EOL;
$req_inser_aimer .= '-- ----------------------------------------------------------------------'.PHP_EOL;
$req_inser_aimer .= '-- '.PHP_EOL;
$req_inser_aimer .= '-- Structure de la table `aimer` '.PHP_EOL;
$req_inser_aimer .= '-- '.PHP_EOL;



$req_aimer = 'SELECT * FROM aimer';
$req_genres = 'SELECT * FROM genres';
$req_texte = 'SELECT * FROM texte';
$req_utillisateurs = 'SELECT * FROM utillisateurs';
$req_videos = 'SELECT * FROM videos';

$req_create_aimer = 'SHOW CREATE TABLE aimer';
$req_create_genres = 'SHOW CREATE TABLE genres';
$req_create_texte = 'SHOW CREATE TABLE texte';
$req_create_utillisateurs = 'SHOW CREATE TABLE utillisateurs';
$req_create_videos = 'SHOW CREATE TABLE videos';

$res_create_aimer = $pdo->prepare($req_create_aimer);
$res_create_genres = $pdo->prepare($req_create_genres);
$res_create_texte = $pdo->prepare($req_create_texte);
$res_create_utillisateurs = $pdo->prepare($req_create_utillisateurs);
$res_create_videos = $pdo->prepare($req_create_videos);

$res_create_aimer->execute();
$res_create_genres->execute();
$res_create_texte->execute();
$res_create_utillisateurs->execute();
$res_create_videos->execute();

$req_create_aimer = $res_create_aimer->fetch();
$req_create_genres = $res_create_genres->fetch();
$req_create_texte = $res_create_texte->fetch();
$req_create_utillisateurs = $res_create_utillisateurs->fetch();
$req_create_videos = $res_create_videos->fetch();

$req_inser_aimer .= $req_create_aimer['Create Table'].';'.PHP_EOL;
$req_inser_aimer .= '--'.PHP_EOL;
$req_inser_aimer .= '-- Déchargement des données de la table `aimer`'.PHP_EOL;
$req_inser_aimer .= '--'.PHP_EOL;

$res_aimer = $pdo->prepare($req_aimer);
$res_aimer->execute();

$req_inser_aimer .= 'INSERT INTO `aimer` (`id_videos`, `id_utilisateurs`) VALUES'.PHP_EOL;

while ($raw_aimer = $res_aimer->fetch()){
    $req_inser_aimer .= '('.htmlentities($raw_aimer['id_videos']).', '.htmlentities($raw_aimer['id_utilisateurs']).'),'.PHP_EOL;
}
$len_aimer = strlen($req_inser_aimer)-2;

$req_inser_aimer[$len_aimer] = ';';

$req_inser_genres .= PHP_EOL.'-- ----------------------------------------------------------------------'.PHP_EOL.PHP_EOL;
$req_inser_genres .= '-- '.PHP_EOL;
$req_inser_genres .= '-- Structure de la table `genres` '.PHP_EOL;
$req_inser_genres .= '-- '.PHP_EOL;


$req_inser_genres .= $req_create_genres['Create Table'].';'.PHP_EOL;

$req_inser_genres .= '--'.PHP_EOL;
$req_inser_genres .= '-- Déchargement des données de la table `genres`'.PHP_EOL;
$req_inser_genres .= '--'.PHP_EOL;

$res_genres = $pdo->prepare($req_genres);
$res_genres->execute();

$req_inser_genres .= 'INSERT INTO `genres`(`id_genres`, `Genre`) VALUES'.PHP_EOL;

while ($raw_genres = $res_genres->fetch()){
    $req_inser_genres .= '('.htmlentities($raw_genres['id_genres']).', "'.htmlentities($raw_genres['Genre']).'"),'.PHP_EOL;
}

$len_genre = strlen($req_inser_genres)-3;

$req_inser_genres[$len_genre] = ';';

$res_texte = $pdo->prepare($req_texte);
$res_texte->execute();

$req_inser_texte = PHP_EOL.'-- ----------------------------------------------------------------------'.PHP_EOL.PHP_EOL;
$req_inser_texte .= '-- '.PHP_EOL;
$req_inser_texte .= '-- Structure de la table `texte` '.PHP_EOL;
$req_inser_texte .= '-- '.PHP_EOL;
$req_inser_texte .= $req_create_texte['Create Table'].';'.PHP_EOL;
$req_inser_texte .= '--'.PHP_EOL;
$req_inser_texte .= '-- Déchargement des données de la table `texte`'.PHP_EOL;
$req_inser_texte .= '--'.PHP_EOL;
$req_inser_texte .= 'INSERT INTO `texte`(`id_texte`, `publique`, `contenu`, `id_utilisateurs`, `id_video`) VALUES'.PHP_EOL;
while ($raw_texte = $res_texte->fetch()){
    $raw_texte['contenu'] = strip_tags($raw_texte['contenu']);
    if (htmlentities($raw_texte['id_video'])== NULL || htmlentities($raw_texte['id_video']) == ''){
        $raw_texte['id_video'] = 0;
    }
    
    $raw_texte['contenu'] = str_replace( array( '<br>', '<br />', "\n", "\r" ), array( '', '', '', '' ), $raw_texte['contenu'] );
        
    $req_inser_texte .= '('.htmlentities($raw_texte['id_texte']).','.htmlentities($raw_texte['publique']).', "'.htmlentities($raw_texte['contenu']).'", '.htmlentities($raw_texte['id_utilisateurs']).', '.htmlentities($raw_texte['id_video']).'),'.PHP_EOL;
}

$len_texte = strlen($req_inser_texte)-2;

$req_inser_texte[$len_texte] = ';';

$res_utillisateurs = $pdo->prepare($req_utillisateurs);
$res_utillisateurs->execute();

$req_inser_utillisateurs = PHP_EOL.'-- ----------------------------------------------------------------------'.PHP_EOL.PHP_EOL;
$req_inser_utillisateurs .= '-- '.PHP_EOL;
$req_inser_utillisateurs .= '-- Structure de la table `utillisateurs` '.PHP_EOL;
$req_inser_utillisateurs .= '-- '.PHP_EOL;
$req_inser_utillisateurs .= $req_create_utillisateurs['Create Table'].';'.PHP_EOL;
$req_inser_utillisateurs .= '--'.PHP_EOL;
$req_inser_utillisateurs .= '-- Déchargement des données de la table `utillisateurs`'.PHP_EOL;
$req_inser_utillisateurs .= '--'.PHP_EOL;
$req_inser_utillisateurs .= 'INSERT INTO `utillisateurs`(`id_utilisateurs`, `Pseudo`, `email`, `dateNais`, `password`) VALUES'.PHP_EOL;

while ($raw_utillisateurs = $res_utillisateurs->fetch()){
    $req_inser_utillisateurs .= '('.htmlentities($raw_utillisateurs['id_utilisateurs']).', "'.htmlentities($raw_utillisateurs['Pseudo']).'", "'.htmlentities($raw_utillisateurs['email']).'", "'.htmlentities($raw_utillisateurs['dateNais']).'", "'.htmlentities($raw_utillisateurs['password']).'"),'.PHP_EOL;
}

$len_utillisateurs = strlen($req_inser_utillisateurs)-2;

$req_inser_utillisateurs[$len_utillisateurs] = ';';

$res_videos = $pdo->prepare($req_videos);
$res_videos->execute();

$req_inser_videos = PHP_EOL.'-- ----------------------------------------------------------------------'.PHP_EOL.PHP_EOL;
$req_inser_videos .= '-- '.PHP_EOL;
$req_inser_videos .= '-- Structure de la table `videos` '.PHP_EOL;
$req_inser_videos .= '-- '.PHP_EOL;
$req_inser_videos .= $req_create_videos['Create Table'].';'.PHP_EOL;
$req_inser_videos .= '--'.PHP_EOL;
$req_inser_videos .= '-- Déchargement des données de la table `videos`'.PHP_EOL;
$req_inser_videos .= '--'.PHP_EOL;
$req_inser_videos .= 'INSERT INTO `videos`(`id_videos`, `TitreVideo`, `lienVideo`, `id_genres`) VALUES'.PHP_EOL;

while ($raw_videos = $res_videos->fetch()){
    $req_inser_videos .= '('.htmlentities($raw_videos['id_videos']).', "'.htmlentities($raw_videos['TitreVideo']).'", "'.htmlentities($raw_videos['lienVideo']).'", '.htmlentities($raw_videos['id_genres']).'),'.PHP_EOL;
}

$len_videos = strlen($req_inser_videos)-2;

$req_inser_videos[$len_videos] = ';';

$back_up .= $req_inser_videos;
$back_up .= $req_inser_utillisateurs;
$back_up .= $req_inser_texte;
$back_up .= $req_inser_genres;
$back_up .= $req_inser_aimer;

fwrite($fichier_save, $back_up);

header('Location: /kam/save_ftp');
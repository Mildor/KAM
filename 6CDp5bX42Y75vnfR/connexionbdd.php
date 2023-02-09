<?php

try
{
    $pdo = new PDO('mysql:host=localhost:3306;dbname=kaminstr_prod', 'kaminstr_Admin', 'mdp');
    $pdo ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>

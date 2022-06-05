<?php

try
{
    $pdo = new PDO('mysql:host=localhost:3307;dbname=kaminstrumental', 'root', '');
    $pdo ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>
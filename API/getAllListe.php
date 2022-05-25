<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try{
    $pdo = new PDO('mysql:dbname=todolist;host=localhost', 'root', '',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    $retour["success"] = true;
    $retour["message"] = "Connexion ok";
}
catch(Exception $e){
    $retour["success"] = false;
    $retour["message"] = "Connexion impossible";
}

$requete = $pdo->prepare("Select * from liste");
$requete->execute();

$retour["success"] = true;
$retour["message"] = "voici toutes les listes";
$retour["results"]{"taches"} = $requete->fetchall(PDO:: FETCH_ASSOC);

echo json_encode($retour);
exit();

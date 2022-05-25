<?php
header('Content-Type: application/json');

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

if (!empty($_GET["idTache"]))
{
    $requete = $pdo->prepare("DELETE FROM `tache` WHERE idTache = ?");
    $requete->bindvalue(1,$_GET["idTache"]);
    $requete->execute();

    $retour["success"] = true;
    $retour["message"] = "la tache a bien été supprimé";
    

} else {
    $retour["success"] = false;
    $retour["message"] = "Problème de supression de la tâche";
}

echo json_encode($retour);

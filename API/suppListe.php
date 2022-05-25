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

if (!empty($_GET["idListe"]))
{
    $requete = $pdo->prepare("DELETE FROM `liste` WHERE idListe = ?");
    $requete->bindvalue(1,$_GET["idListe"]);
    $requete->execute();

    $retour["success"] = true;
    $retour["message"] = "la liste a bien été supprimé";
    

} else {
    $retour["success"] = false;
    $retour["message"] = "Problème de supression de la liste";
}

echo json_encode($retour);

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

if (!empty($_GET["nomListe"]))
{
    $requete = $pdo->prepare("INSERT INTO `liste`( `nomListe') VALUES  (:nomListe )");
    $requete->bindParam(':nomListe',$_GET["nomListe"],PDO::PARAM_STR);
     $requete->execute();

    $retour["success"] = true;
    $retour["message"] = "la liste a été ajouté";
    $retour["results"] = array();

} else {
    $retour["success"] = false;
    $retour["message"] = "information de la liste insuffisante";
}

echo json_encode($retour);

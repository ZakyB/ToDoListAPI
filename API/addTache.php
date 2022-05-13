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

if (!empty($_GET["libelle"]) && !empty($_GET["typetache"]))
{
    $requete = $pdo->prepare("INSERT INTO `tache`(`libelle`, `etat`, `idTypeTache`) VALUES  (:libelle, :etat , :typetache )");
    $requete->bindParam(':libelle',$_GET["libelle"],PDO::PARAM_STR);
    $requete->bindParam(':etat',$_GET["etat"],PDO::PARAM_INT);
    $requete->bindParam(':typetache',$_GET["typetache"],PDO::PARAM_INT);
    $requete->execute();

    $retour["success"] = true;
    $retour["message"] = "la tache a été ajouté";
    $retour["results"] = array();

} else {
    $retour["success"] = false;
    $retour["message"] = "information insuffisante";
}

echo json_encode($retour);

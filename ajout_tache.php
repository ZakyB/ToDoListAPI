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

if (!empty($_POST["libelle"]) && !empty($_POST["typetache"]))
{
    $requete = $pdo->prepare("INSERT INTO `tache` (`idTache`, `libelle`, `etat`, `idTypeTache`) VALUES (':id', ':libelle', ':etat', ':typetache')");
    $requete->bindParam(':id',$_POST["id"]);
    $requete->bindParam(':libelle',$_POST["libelle"]);
    $requete->bindParam(':etat',$_POST["etat"]);
    $requete->bindParam(':typetache',$_POST["typetache"]);
    $requete->execute();

    $retour["success"] = true;
    $retour["message"] = "la tache a été ajouté";
    $retour["results"] = array();

} else {
    $retour["success"] = false;
    $retour["message"] = "information insuffisante";
}

echo json_encode($retour);

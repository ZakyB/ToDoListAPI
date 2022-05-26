<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try{
    $pdo = new PDO('mysql:dbname=todolist;host=localhost', 'root', '',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


}
catch(Exception $e){
    $retour["success"] = false;
    $retour["message"] = "Connexion impossible";
}

$requete = $pdo->prepare("SELECT tache.id , tache.libelle , etat.libelle as etat , liste.libelle as liste , typetache.libelle as typetache , tache.idEtat , tache.idListe, tache.idTypeTache FROM tache , etat , liste , typetache WHERE tache.idEtat = etat.idEtat AND tache.idListe = liste.idListe AND tache.idTypeTache= typetache.idTypeTache");
$requete->execute();


$retour = $requete->fetchall(PDO:: FETCH_ASSOC);

echo json_encode($retour);
exit();

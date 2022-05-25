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
    
        $requete = $pdo->prepare("UPDATE `liste` SET `nomListe`= :nomListe WHERE idListe = :idListe");
        $requete->bindParam(':nomListe',$_GET["nomListe"],PDO::PARAM_STR);
        $requete->bindParam(':idListe',$_GET["idListe"],PDO::PARAM_INT);

        $requete->execute();
        $retour["success"] = true;
        $retour["message"] = "la liste (nomListe) a bien été mise à jour ";

    } else {
    $retour["success"] = false;
    $retour["message"] = "Problème de supression de la tâche";
}

echo json_encode($retour);
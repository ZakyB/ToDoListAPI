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

if (!empty($_GET["idTache"]) && !empty($_GET["type"]))
{
    $type = $_GET["type"];
    if ($type=="libelle"){
        $requete = $pdo->prepare("UPDATE `tache` SET `libelle`= :libelle WHERE idTache = :idTache");
        $requete->bindParam(':libelle',$_GET["libelle"],PDO::PARAM_STR);
        $requete->bindParam(':idTache',$_GET["idTache"],PDO::PARAM_INT);

        $requete->execute();
        $retour["success"] = true;
        $retour["message"] = "la tache (libelle) a bien été mise à jour ";
    }
    if($type=="etat"){
        $requete = $pdo->prepare("UPDATE `tache` SET `etat`= :etat WHERE idTache = :idTache");
        $requete->bindParam(':etat',$_GET["etat"],PDO::PARAM_STR);
        $requete->bindParam(':idTache',$_GET["idTache"],PDO::PARAM_INT);

        $requete->execute();
        $retour["success"] = true;
        $retour["message"] = "la tache (etat) a bien été mise à jour";
    }else{
        $requete = $pdo->prepare("UPDATE `tache` SET `idTypeTache`= :idTypeTache WHERE idTache = :idTache");
        $requete->bindParam(':libelle',$_GET["idTypeTache"],PDO::PARAM_STR);
        $requete->bindParam(':idTache',$_GET["idTache"],PDO::PARAM_INT);
        
        $requete->execute();
        $retour["success"] = true;
        $retour["message"] = "la tache (TypeTache) a bien été mise à jour";
    }
    

    } else {
    $retour["success"] = false;
    $retour["message"] = "Problème de supression de la tâche";
}

echo json_encode($retour);

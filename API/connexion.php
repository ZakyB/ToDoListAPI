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

if (isset($_POST['valider'])){
    $decrypt = sha1($_GET['mdp']);

    $sql = $pdo->prepare("select * from utilisateurs where login=?");
    $sql->bindValue(1,$_GET['login']);
    $sql->execute();
        
    if ($sql-> rowCount() > 0){
        $data = $sql->fetch();
		
        if($data['mdp'] == $decrypt){
			
            $retour["success"] = true;
			$retour["message"] = "Bienvenue !!!!";
			$retour["results"] = array();
			
        } else {
			$retour["success"] = false;
			$retour["message"] = "Mot de passe incorrect";
        }	
    } 
} else {
	$retour["success"] = false;
	$retour["message"] = "Login ou mot de passe incorrect";
}

echo json_encode($retour);

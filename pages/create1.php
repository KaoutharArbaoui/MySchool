<?php

$host = 'localhost';
$dbname = 'ecole';
$username = 'root';
$password = '';

if(isset($_POST['insert'])){

    try {
        // se connecter à mysql
        $pdo = new PDO("mysql:host=$host;dbname=$dbname","$username","$password");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }

    // récupérer les valeurs
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse= $_POST['adresse'];
    $sexe= $_POST['sexe'];
    $datenaiss= $_POST['datenaiss'];
    $lieunaiss= $_POST['lieunaiss'];
    $niveau= $_POST['niveau'];
    $annee= $_POST['annee'];
    $doublant= $_POST['doublant'];
    $prix= $_POST['prix'];
    $pere= $_POST['pere'];
    $metier= $_POST['metier'];
    $mere= $_POST['mere'];
    $tele= $_POST['tele'];
    $mail= $_POST['mail'];

    // Requête mysql pour insérer des données
    $sql = "UPDATE eleves SET nom =:nom ,prenom =:prenom ,  adresse= :adresse ,  sexe=:sexe,  datenaiss= :datenaiss,  lieunaiss= :lieunaiss,  
                  niveau=:niveau ,  annee= :annee,  doublant=:doublant ,
                      prix=:prix ,  pere=:pere ,  metier= :metier,  mere=:mere ,  tele=:tele ,  mail=:mail where id=1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam( ':nom',   $_POST['nom'], PDO::PARAM_STR);
    $stmt->bindParam( ':prenom'   , $_POST['prenom'], PDO::PARAM_STR);
    $stmt->bindParam( ':adresse'  , $_POST['adresse'], PDO::PARAM_STR);
    $stmt->bindParam(':sexe' , $_POST['sexe'], PDO::PARAM_STR);
    $stmt->bindParam(':datenaiss'  , $_POST['datenaiss'], PDO::PARAM_STR);
    $stmt->bindParam(':lieunaiss' , $_POST['lieunaiss'], PDO::PARAM_STR);
    $stmt->bindParam(':niveau'  , $_POST['niveau'], PDO::PARAM_STR);
    $stmt->bindParam(':annee'  , $_POST['annee'], PDO::PARAM_INT);
    $stmt->bindParam(':doublant' , $_POST['doublant'], PDO::PARAM_STR);
    $stmt->bindParam(':prix'  , $_POST['prix'], PDO::PARAM_INT);
    $stmt->bindParam(':pere'  , $_POST['pere'], PDO::PARAM_STR);
    $stmt->bindParam(':metier' , $_POST['metier'], PDO::PARAM_STR);
    $stmt->bindParam(':mere'  , $_POST['mere'], PDO::PARAM_STR);
    $stmt->bindParam(':tele'  , $_POST['tele'], PDO::PARAM_STR);
    $stmt->bindParam(':mail' , $_POST['mail'], PDO::PARAM_STR);
    $stmt->execute();
    // vérifier si la requête d'insertion a réussi
    if($stmt){
        echo 'Données insérées';
    }else{
        echo "Échec de l'opération d'insertion";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Insérer des données dans la table Users</title>
</head>
<body>
<form action="create1.php" method="post">
    <p><input type="text" name="nom"></p>
    <p><input type="text" name="prenom"></p>
    <p><input type="text" name="adresse"></p>
    <select name="sexe">
        <option value="homme">homme</option>
        <option value="femme">femme</option>
    </select>
    <p><input type="date" name="datenaiss"></p>
    <p><input type="text" name="lieunaiss"></p>
    <p><input type="text" name="niveau"></p>
    <p>annee<input type="text" name="annee"></p>
    <p><input type="text" name="doublant"></p>
    <p>prix<input type="text" name="prix"></p>
    <p><input type="text" name="pere"></p>
    <p><input type="text" name="metier"></p>
    <p><input type="text" name="mere"></p>
    <p><input type="text" name="tele"></p>
    <p><input type="text" name="mail"></p>


    <p><input type="submit" name="insert" value="Insérer"></p>
</form>
</body>
</html>
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
    $sexe= $_POST['sexe'];
    $datenaiss= $_POST['datenaiss'];
    $adresse= $_POST['adresse'];
    $langue= $_POST['langue'];
    $Niveau= $_POST['Niveau'];
    $email= $_POST['email'];
    $tele= $_POST['tele'];

    // Requête mysql pour insérer des données
    $sql = "INSERT INTO `enseignants`(`nom`, `prenom`, `sexe`, `datenaiss`, `adresse`, `langue` , `Niveau`, `email`, `tele`) 
                     VALUES (:nom,:prenom,:sexe,:datenaiss,:adresse,:langue,
                             :Niveau,:email,:tele)";
    $res = $pdo->prepare($sql);
    $exec = $res->execute(array(":nom"=>$nom,":prenom"=>$prenom,":sexe"=>$sexe,":datenaiss"=>$datenaiss
    ,":adresse"=>$adresse,":langue"=>$langue,":Niveau"=>$Niveau,":email"=>$email,":tele"=>$tele));

    // vérifier si la requête d'insertion a réussi
    if($exec){
        header("location: Enseignants.php");
    }else{
        echo "Échec de l'opération d'insertion";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer enseignant</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<?php include ('leftbar1.php');?>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <br>
                <b><h4 style="color:#4f5acb;">Informations sur l'enseignant</h4></b>
                <hr>
                <br>
                <form action="createE.php" method="post">
                    <div class="form-group">
                        <label><b>Nom</b></label><span style="color:red">*</span>
                        <input type="text" name="nom" class="form-control" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Prénom</b></label><span style="color:red">*</span>
                        <input type="text" name="prenom" class="form-control "required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><b>Sexe</b></label><span style="color:red">*</span>
                            <select name="sexe" class="form-control" required>
                                <option value="Femme">Femme</option>
                                <option value="Homme">Homme</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label><b>Date de naissance</b></label><span style="color:red">*</span>
                            <input type="date" name="datenaiss" class="form-control"required>
                            <span class="invalid-feedback"></span>
                        </div>
                    <div class="form-group col-md-6">
                        <label><b>Adresse</b></label><span style="color:red">*</span>
                        <input type ="text" name="adresse" class="form-control" required>
                        <span class="invalid-feedback"></span>
                    </div>
                        <div class="form-group col-md-6">
                            <label><b>Langue</b></label><span style="color:red">*</span>
                            <select name="langue" class="form-control" required>
                                <option value="Arabe">Arabe</option>
                                <option value="Français">Français</option>
                                <option value="Englais">Englais</option>
                                <option value="Informatique">Informatique</option>
                                <option value="Sport">Sport</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><b>Niveau</b></label><span style="color:red">*</span>
                        <input type="text" name="Niveau" class="form-control"required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Email</b></label><span style="color:red">*</span>
                        <input type="text" name="email" class="form-control" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Téléphone</b></label><span style="color:red">*</span>
                        <input name="tele" type="text" class="form-control" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <br>
                    <input type="submit" name="insert" class="btn btn-primary" value="Créer">
                    <a href="Enseignants.php" class="btn btn-secondary ml-2">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
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
    $sql = "UPDATE enseignants SET nom =:nom ,prenom =:prenom ,  sexe=:sexe , datenaiss=:datenaiss , adresse=:adresse ,langue=:langue , 
                  Niveau=:Niveau  ,  email=:email,  tele=:tele where id=9";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam( ':nom',   $_POST['nom'], PDO::PARAM_STR);
    $stmt->bindParam( ':prenom'   , $_POST['prenom'], PDO::PARAM_STR);
    $stmt->bindParam(':sexe' , $_POST['sexe'], PDO::PARAM_STR);
    $stmt->bindParam(':datenaiss'  , $_POST['datenaiss'], PDO::PARAM_STR);
    $stmt->bindParam( ':adresse'  , $_POST['adresse'], PDO::PARAM_STR);
    $stmt->bindParam(':langue'  , $_POST['langue'], PDO::PARAM_INT);
    $stmt->bindParam(':Niveau'  , $_POST['Niveau'], PDO::PARAM_STR);
    $stmt->bindParam(':email' , $_POST['email'], PDO::PARAM_STR);
    $stmt->bindParam(':tele'  , $_POST['tele'], PDO::PARAM_INT);
    $stmt->bindParam(':id'  , $_POST['id'], PDO::PARAM_INT);

    $stmt->execute();

    // vérifier si la requête d'insertion a réussi
    if($stmt){
        header("location: updateE.php");
    }else{
        echo "Échec de l'opération d'insertion";
    }
}
?>
<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM enseignants WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $name = $row["nom"];
                $address = $row["prenom"];
                $salary = $row["adresse"];
                $sexe = $row["sexe"];
                $datenaiss = $row["datenaiss"];
                $niveau = $row["Niveau"];
                $langue = $row["langue"];
                $tele = $row["tele"];
                $mail = $row["email"];
            } }}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier</title>
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
                <form action="updateE.php" method="post">
                    <div class="form-group">
                        <label><b>Nom</b></label><span style="color:red">*</span>
                        <input type="text" name="nom" value="<?php echo $row['nom'];?>" class="form-control" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Prénom</b></label><span style="color:red">*</span>
                        <input type="text" name="prenom" value="<?php echo $row['prenom'];?>" class="form-control "required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><b>Sexe</b></label><span style="color:red">*</span>
                            <select name="sexe" class="form-control" value="<?php echo $row['sexe'];?>" required>
                                <option value="Femme">Femme</option>
                                <option value="Homme">Homme</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label><b>Date de naissance</b></label><span style="color:red">*</span>
                            <input type="date" name="datenaiss" value="<?php echo $row['datenaiss'];?>" class="form-control"required>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label><b>Adresse</b></label><span style="color:red">*</span>
                            <input type ="text" name="adresse" value="<?php echo $row['adresse'];?>" class="form-control" required>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label><b>Langue</b></label><span style="color:red">*</span>
                            <select name="langue" class="form-control" value="<?php echo $row['langue'];?>" required>
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
                        <input type="text" name="Niveau" value="<?php echo $row['Niveau'];?>" class="form-control"required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Email</b></label><span style="color:red">*</span>
                        <input type="text" name="email" class="form-control" value="<?php echo $row['email'];?>" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Téléphone</b></label><span style="color:red">*</span>
                        <input name="tele" type="text" class="form-control" value="<?php echo $row['tele'];?>" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <br>
                    <input type="submit" name="insert" class="btn btn-primary" value="Modifier">
                    <a href="Enseignants.php" class="btn btn-secondary ml-2">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

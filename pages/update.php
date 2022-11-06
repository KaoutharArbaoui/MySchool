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
    $sql = "SELECT * FROM eleves WHERE id = ?";

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
                $lieunaiss = $row["lieunaiss"];
                $niveau = $row["niveau"];
                $annee = $row["annee"];
                $doublant = $row["doublant"];
                $prix = $row["prix"];
                $pere = $row["pere"];
                $metier = $row["metier"];
                $mere = $row["mere"];
                $tele = $row["tele"];
                $mail = $row["mail"];
            } }}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier élève</title>
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
                <h1>Modifier élève</h1>
                <b><h4 style="color:#4f5acb;">Informations sur l'élève</h4></b>
                <hr>
                <br>
                <form action="update.php" method="post">
                    <div class="form-group">
                        <label><b>Nom</b></label><span style="color:red">*</span>
                        <input type="text" name="nom" value="<?php echo $row['nom'];?>" class="form-control" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Prénom</b></label><span style="color:red">*</span>
                        <input type="text" name="prenom" class="form-control" value="<?php echo $row['prenom'];?>"required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group">
                        <label><b>Adresse</b></label><span style="color:red">*</span>
                        <input type ="text" name="adresse" class="form-control" value="<?php echo $row['adresse'];?>" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><b>Sexe</b></label><span style="color:red">*</span>
                            <select name="sexe" class="form-control" value="<?php echo $row['sexe'];?>"required>
                                <option value="Fille">Fille</option>
                                <option value="Garçcon">Garçon</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label><b>Date de naissance</b></label><span style="color:red">*</span>
                            <input type="date" name="datenaiss" class="form-control" value="<?php echo $row['datenaiss'];?>"required>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label><b>Lieu de naissance</b></label><span style="color:red">*</span>
                            <select  name="lieunaiss"  value="<?php echo $row['lieunaiss'];?>" class="form-control">
                                <option value="Agadir">Agadir</option>
                                <option value="Ahfir">Ahfir</option>
                                <option value="Al Hoceima">Al Hoceïma</option>
                                <option value="Al jadida">Al Jadida</option>
                                <option value="Al khmisSat">Al Khmissat</option>
                                <option value="Amizmiz">Amizmiz</option>
                                <option value="Ain El Aouda">Aïn El Aouda</option>
                                <option value="Ain Harrouda">Aïn Harrouda</option>
                                <option value="Asfi">Asfi</option>
                                <option value="Assilah">Asilah</option>
                                <option value="Assa">Assa</option>
                                <option value="Ait Mellol">Aït Melloul</option>
                                <option value="Ait Ourir">Aït Ourir</option>
                                <option value="Attaouia">Attaouia</option>
                                <option value="Azemmour">Azemmour</option>
                                <option value="Azilal">Azilal</option>
                                <option value="Azrou">Azrou</option>
                                <option value="Barrechid">Barrechid</option>
                                <option value="Benguerir">Benguerir</option>
                                <option value="Bni Drar">Beni Drar</option>
                                <option value="Beni Mellal">Beni Mellal</option>
                                <option value="Ben Slimane">Ben Slimane</option>
                                <option value="Berkane">Berkane</option>
                                <option value="Berrechid">Berrechid</option>
                                <option value="Bir Jdid">Bir Jdid</option>
                                <option value="Bou Knadel">Bou Knadel</option>
                                <option value="Boulmane">Boulmane</option>
                                <option value="Bouskoura">Bouskoura</option>
                                <option value="Bouznika">Bouznika</option>
                                <option value="Casablanca">Casablanca</option>
                                <option value="Chaouén">Chaouèn</option>
                                <option value="Chefchaouene">Chefchaouene</option>
                                <option value="Chemaïa">Chemaïa</option>
                                <option value="Chichaoua">Chichaoua</option>
                                <option value="Demnat">Demnat</option>
                                <option value="Deroua">Deroua</option>
                                <option value="El Aioun">El Aioun</option>
                                <option value="El Gara">El Gara</option>
                                <option value="El Hajeb">El Hajeb</option>
                                <option value="El Harhoura">El Harhoura</option>
                                <option value="El Jadida">El Jadida</option>
                                <option value="El Kelaa">El Kelaa</option>
                                <option value="El Ksar Kbir">El Ksar El Kbir</option>
                                <option value="El Menzah">El Menzeh</option>
                                <option value="Erfoud">Erfoud</option>
                                <option value="Er Rachidia">Er Rachidia</option>
                                <option value="Essaouira">Essaouira</option>
                                <option value="Fez">Fez</option>
                                <option value="Fkih Ben Salah">Fkih Ben Salah</option>
                                <option value="Fnideq">Fnideq</option>
                                <option value="Fès Jadid">Fès Jdid</option>
                                <option value="Fès">Fès</option>
                                <option value="Guelmim">Guelmim</option>
                                <option value="Guercif">Guercif</option>
                                <option value="Ifrane">Ifrane</option>
                                <option value="Imouzzer du Kandar">Imouzzer Du Kandar</option>
                                <option value="Imouzzer">Imouzzer</option>
                                <option value="Jerada">Jerada</option>
                                <option value="Jorf">Jorf</option>
                                <option value="Kasba Tadla">Kasba Tadla</option>
                                <option value="Kelaa">Kelaa</option>
                                <option value="Kenitra">Kenitra</option>
                                <option value="Khemisset">Khemisset</option>
                                <option value="Khenifra">Khenifra</option>
                                <option value="Khouribga">Khouribga</option>
                                <option value="Ksar El Kbir">Ksar El Kebir</option>
                                <option value="Larache">Larache</option>
                                <option value="Mansouria">Mansouria</option>
                                <option value="Marrakech">Marrakech</option>
                                <option value="Martil">Martil</option>
                                <option value="M'diq">M'diq</option>
                                <option value="Meknès">Meknès</option>
                                <option value="Midar">Midar</option>
                                <option value="Midelt">Midelt</option>
                                <option value="Mighleft">Mighleft</option>
                                <option value="Mohammadia">Mohammadia</option>
                                <option value="Moulay-Bousselham">Moulay-bousselham</option>
                                <option value="Nador">Nador</option>
                                <option value="Nouasser">Nouasser</option>
                                <option value="Oualidia">Oualidia</option>
                                <option value="Ouarzazate">Ouarzazate</option>
                                <option value="Ouazzane">Ouazzane</option>
                                <option value="Oued Zem">Oued Zem</option>
                                <option value="Oujda">Oujda</option>
                                <option value="Oulad Ayad">Oulad Ayad</option>
                                <option value="Oulad Teima">Oulad Teïma</option>
                                <option value="Oulmes">Oulmes</option>
                                <option value="Ourika">Ourika</option>
                                <option value="Rabat">Rabat</option>
                                <option value="Rissani">Rissani</option>
                                <option value="Saidia">Saïdia</option>
                                <option value="Safi">Safi</option>
                                <option value="Salé">Salé</option>
                                <option value="Sefrou">Sefrou</option>
                                <option value="Settat">Settat</option>
                                <option value="Sidi Allal El Bahraoui">Sidi Allal El Bahraoui</option>
                                <option value="Sidi Allal">Sidi Allal</option>
                                <option value="Sidi Bennour">Sidi Bennour</option>
                                <option value="Sidi Ifni">Sidi Ifni</option>
                                <option value="Sidi Kacem">Sidi Kacem</option>
                                <option value="Sidi Rahal">Sidi Rahal</option>
                                <option value="Sidi Slimane">Sidi Slimane</option>
                                <option value="Sidi Yahia Az Za'er">Sidi Yahia Az Za'er</option>
                                <option value="Sidi Yahia El Gharb">Sidi Yahia El Gharb</option>
                                <option value="Skhirate">Skhirate</option>
                                <option value="Smara">Smara</option>
                                <option value="Souk El Arbâa">Souk El Arbâa</option>
                                <option value="Tadla">Tadla</option>
                                <option value="Tamesna">Tamesna</option>
                                <option value="Tanger">Tanger</option>
                                <option value="Tan-Tan">Tan-tan</option>
                                <option value="Taounate">Taounate</option>
                                <option value="Taourirt">Taourirt</option>
                                <option value="Targuist">Targuist</option>
                                <option value="Taroudant">Taroudant</option>
                                <option value="Taza">Tata</option>
                                <option value="Tawnat">Tawnat</option>
                                <option value="Taza">Taza</option>
                                <option value="Temara">Temara</option>
                                <option value="Tiflet">Tiflet</option>
                                <option value="Tinghir">Tinghir</option>
                                <option value="Tiznit">Tiznit</option>
                                <option value="Tétouan">Tétouan</option>
                                <option value="Wazzan">Wazzan</option>
                                <option value="Youssoufia">Youssoufia</option>
                                <option value="Zagora">Zagora</option>
                                <option value="Zaio">Zaïo</option>
                                <option value="Zemamra">Zemamra</option>
                                <option value="Zarhoun">Zerhoun</option>
                                <option value="Boujdour">Boujdour</option>
                                <option value="Imlil">Imlil</option>
                                <option value="Laayoune">Laayoune</option>
                                <option value="Sala Al-Jadida">Sala Al-Jadida</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <br>
                    <b><h4 style="color:#4f5acb;">Informations sur l'inscription</h4></b>
                    <hr>
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><b>Niveau</b></label><span style="color:red">*</span>
                            <select  name="niveau" value="<?php echo $row['niveau'];?>" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label ><b>Année de scolarité </b></label><span style="color:red">*</span>
                            <select  name="annee" value="<?php echo $row['annee'];?>" class="form-control">
                                <option value="2021/2022">2021/2022</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2023/2024">2023/2024</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label><b>Doublant(e)</b></label><span style="color:red">*</span>
                            <select  name="doublant"  value="<?php echo $row['doublant'];?>" class="form-control">
                                <option value="oui">Oui</option>
                                <option value="non">Non</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><b>Prix</b></label><span style="color:red">*</span>
                        <input name="prix" class="form-control" value="<?php echo $row['prix'];?>" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <br>
                    <b><h4 style="color:#4f5acb;">Informations sur les parents</h4></b>
                    <hr>
                    <br>
                    <div class="form-group">
                        <label><b>Nom et prénom père</b></label><span style="color:red">*</span>
                        <input name="pere" class="form-control" value="<?php echo $row['pere'];?>" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Nom et prénom mère</b></label><span style="color:red">*</span>
                        <input name="mere" class="form-control" value="<?php echo $row['mere'];?>" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Métier du père</b></label><span style="color:red">*</span>
                        <input name="metier" class="form-control" value="<?php echo $row['metier'];?>" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Téléphone père ou mère</b></label><span style="color:red">*</span>
                        <input name="tele" class="form-control" value="<?php echo $row['metier'];?>" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Email père ou mère</b></label>
                        <input name="mail" class="form-control" value="<?php echo $row['mail'];?>" required>
                        <span class="invalid-feedback"></span>
                    </div>
                    <br>
                    <input type="submit" name="insert" class="btn btn-primary" value="Modifier">
                    <a href="eleve.php" class="btn btn-secondary ml-2">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
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
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }

        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informations de l'élève</title>
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
                <h1 class="mt-5 mb-3">Informations de l'élève <?php echo $row["nom"]; ?></h1>
                <div class="form-group">
                    <label>Nom</label>
                    <p><b><?php echo $row["nom"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Prénom</label>
                    <p><b><?php echo $row["prenom"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Adresse</label>
                    <p><b><?php echo $row["adresse"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Sexe</label>
                    <p><b><?php echo $row["sexe"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Date de naissance</label>
                    <p><b><?php echo $row["datenaiss"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Lieu de naissance</label>
                    <p><b><?php echo $row["lieunaiss"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Niveau</label>
                    <p><b><?php echo $row["niveau"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Année de scolarité</label>
                    <p><b><?php echo $row["annee"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Doublant(e)</label>
                    <p><b><?php echo $row["doublant"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Prix</label>
                    <p><b><?php echo $row["prix"]." dh"; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Nom et prénom père</label>
                    <p><b><?php echo $row["pere"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Nom et prénom mère</label>
                    <p><b><?php echo $row["mere"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Métier du père</label>
                    <p><b><?php echo $row["metier"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Téléphone père ou mère</label>
                    <p><b><?php echo $row["tele"]; ?></b></p>
                </div>
                <div class="form-group">
                    <label>Email père ou mère</label>
                    <p><b><?php echo $row["mail"]; ?></b></p>
                </div>
                <p><a href="eleve.php" class="btn btn-primary">Retour</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>

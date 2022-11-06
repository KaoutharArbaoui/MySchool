<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
        input[type=text] {
            width: 30%;
            -webkit-transition: width 0.15s ease-in-out;
            transition: width 0.15s ease-in-out;
        }

        /* When the input field gets focus,
             change its width to 100% */
        input[type=text]:focus {
            width: 70%;
        }

        .eleves{
            display:table-cell;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
<?php include ('leftbar1.php');?>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Elèves</h2>
                    <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Ajouter un nouvel élève</a>
                </div>
                <p class="pull-left"><input id="searchbar" onkeyup="search_animal()" type="text"
                                            name="search" > <span class="fa fa-search"></span> </p>

                <?php
                // Include config file
                require_once "config.php";

                // Attempt select query execution
                $sql = "SELECT * FROM eleves";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo '<br>';
                        echo '<table class="table table-striped table-bordered nowrap"  style="width: 100%">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th class='eleves'>#</th>";
                        echo "<th class='eleves'>Nom</th>";
                        echo "<th class='eleves'>Prénom</th>";
                        echo "<th class='eleves'>Niveau</th>";
                        echo "<th class='eleves'>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr >";
                            echo "<td class='eleves'>" . $row['id'] . "</td>";
                            echo "<td class='eleves'>" . $row['nom'] . "</td>";
                            echo "<td class='eleves'>" . $row['prenom'] . "</td>";
                            echo "<td class='eleves'>" . $row['niveau'] . "</td>";
                            echo "<td>";
                            echo '<a  href="read.php?id='. $row['id'] .'" class="mr-3 " title="Voir élève" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                            echo '<a href="update.php?id='. $row['id'] .'" class="mr-3 " title="Modifier élève" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                            echo '<a href="delete.php?id='. $row['id'] .'"  title="Supprimer élève" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else{
                        echo '<div class="alert alert-danger"><em>Aucun élève trouvé.</em></div>';
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close connection
                mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
</div>

<script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<script>
    function search_animal() {
        let input = document.getElementById('searchbar').value
        input=input.toLowerCase();
        let x = document.getElementsByClassName('eleves');

        for (i = 0; i < x.length; i++) {
            if (!x[i].innerHTML.toLowerCase().includes(input)) {
                x[i].style.display="none";
            }
            else {
                x[i].style.display="table-cell";
            }
        }
    }

</script>


</body>
</html>
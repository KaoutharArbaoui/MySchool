<?php
    function connexionBDD() {
        $conn = new mysqli("127.0.0.1","root","","ecole");

        /* Vérification de la connexion */
        if (mysqli_connect_errno()) {
            die("Échec de la connexion : \n". mysqli_connect_error());
        }

        $conn->query("SET NAMES 'utf8'");
        return $conn;
    }
    $conn = connexionBDD();


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <!-- Bootstrap and a little bit of  CSS -->
    <style>
        .bd-placeholder-img
        {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px)
        {
            .bd-placeholder-img-lg
            {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for the dashboard -->
</head>
<body>


                                <?php
                                $aujourdhui = date("Y-m-d");
                                $requete = "SELECT  sexe,count(*) AS frq FROM eleves GROUP BY sexe";
                                $result = $conn->query($requete);
                                $i = 0;
                                if (($result->num_rows) == 0)
                                {
                                    echo ("<p align='center'>Aucun élève :( </p>\n");
                                }
                                else
                                {
                                ?>

                            <?php
                            while (($i < 10) && ($colonne = mysqli_fetch_array($result))) {
                                ?>

                                    <div><?php echo $colonne['sexe']; ?>
                                    <?php echo $colonne['frq']; ?></div>

                                <?php $i++;}}?>


<!-- <script src="test.js"></script> -->
</body>
</html>
<?php
// include 'includes/footer.php'
?>

<?php
include('leftbar1.php');
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

<style>
    body {
        margin: 0;
        padding: 0;
        color: #fff;
        font-family: 'Open Sans', Helvetica, sans-serif;
        box-sizing: border-box;
    }

    /* Assign grid instructions to our parent grid container, mobile-first (hide the sidenav) */
    .grid-container {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 50px 1fr 50px;
        grid-template-areas:
    'header'
    'main'
    'footer';
        height: 100vh;
    }

    .menu-icon {
        position: fixed; /* Needs to stay visible for all mobile scrolling */
        display: flex;
        top: 5px;
        left: 10px;
        align-items: center;
        justify-content: center;
        background-color: #DADAE3;
        border-radius: 50%;
        z-index: 1;
        cursor: pointer;
        padding: 12px;
    }

    /* Give every child element its grid name */
    .header {
        grid-area: header;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 16px;
        background-color: #648ca6;
    }

    /* Make room for the menu icon on mobile */
    .header__search {
        margin-left: 42px;
    }

    .sidenav {
        grid-area: sidenav;
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 240px;
        position: fixed;
        overflow-y: auto;
        transform: translateX(-245px);
        transition: all .6s ease-in-out;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 0 0 1px rgba(0, 0, 0, 0.08);
        z-index: 2; /* Needs to sit above the hamburger menu icon */
        background-color: #394263;
    }

    .sidenav.active {
        transform: translateX(0);
    }

    .sidenav__close-icon {
        position: absolute;
        visibility: visible;
        top: 8px;
        right: 12px;
        cursor: pointer;
        font-size: 20px;
        color: #ddd;
    }

    .sidenav__list {
        padding: 0;
        margin-top: 85px;
        list-style-type: none;
    }

    .sidenav__list-item {
        padding: 20px 20px 20px 40px;
        color: #ddd;
    }

    .sidenav__list-item:hover {
        background-color: rgba(255, 255, 255, 0.2);
        cursor: pointer;
    }

    .main {
        grid-area: main;
        background-color: #ffffff;
    }

    .main-header {
        display: flex;
        justify-content: space-between;
        margin: 40px;
        padding: 20px;
        height: 150px;
        background-color: #e3e4e6;
        color: slategray;
    }

    .main-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
        grid-auto-rows: 94px;
        grid-gap: 20px;
        margin: 40px;
    }

    .overviewcard {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        background-color: #000000;
    }

    .main-cards {
        column-count: 1;
        column-gap: 20px;
        margin: 40px;
    }

    .card {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        background-color: #000000;
        margin-bottom: 40px;
        -webkit-column-break-inside: avoid;
        padding: 24px;
        box-sizing: border-box;
    }

    /* Force varying heights to simulate dynamic content */
    .card:first-child {
        height: 485px;
    }

    .card:nth-child(2) {
        height: 485px;
    }



    .footer {
        grid-area: footer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 16px;
        background-color: #648ca6;
    }

    /* Non-mobile styles, 750px breakpoint */
    @media only screen and (min-width: 46.875em) {
        /* Show the sidenav */
        .grid-container {
            grid-template-columns: 240px 1fr;
            grid-template-areas:
      "sidenav header"
      "sidenav main"
      "sidenav footer";
        }

        .header__search {
            margin-left: 0;
        }

        .sidenav {
            position: relative;
            transform: translateX(0);
        }

        .sidenav__close-icon {
            visibility: hidden;
        }
    }

    /* Medium screens breakpoint (1050px) */
    @media only screen and (min-width: 65.625em) {
        /* Break out main cards into two columns */
        .main-cards {
            column-count: 2;
        }
    }
</style>


<div class="grid-container">

    <main class="main">
        <div class="main-overview">
            <div class="overviewcard">
                <?php
                $requete = "SELECT  sexe,count(*) AS frq FROM eleves GROUP BY sexe";
                $result = $conn->query($requete);
                $i = 0;
                if (($result->num_rows) == 0)
                {
                    echo ("<p align='center'>Aucun élève :( </p>\n");
                }
                else
                {
                    while (($i < 10) && ($colonne = mysqli_fetch_array($result))) {

                ?>
                <div class="overviewcard__icon"><h2>Elève <?php echo $colonne['sexe']; ?></h2></div>
                <div class="overviewcard__info"><h2><?php echo $colonne['frq']; ?></h2></div>
                        <?php $i++;}}?>
            </div>
            <div class="overviewcard">
                <?php
                $requete = "SELECT  sexe,count(*) AS frq FROM enseignants GROUP BY sexe";
                $result = $conn->query($requete);
                $i = 0;
                if (($result->num_rows) == 0)
                {
                    echo ("<p align='center'>Aucun enseignant :( </p>\n");
                }
                else
                {
                while (($i < 10) && ($colonne = mysqli_fetch_array($result))) {

                ?>
                <div class="overviewcard__icon"><h2>Enseignant <?php echo $colonne['sexe']; ?></h2></div>
                <div class="overviewcard__info"><h2><?php echo $colonne['frq']; ?></h2></div>
                    <?php $i++;}}?>
            </div>
        </div>

        <div class="main-cards">
            <div class="card"><?php require_once('graphe.php'); ?></div>
        </div>

    </main>

</div>

<script>



</script>
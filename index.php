<?php
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<style>
    a:link,
    a:visited,
    a:hover,
    a:active {
        text-decoration: none;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prenotazione concerto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container-fluid text-center">
        <div class="row ">
            <div class="col">
                <h1>Prenotazione Concerti</h1>
            </div>
        </div>
        <?php
        $sql = "SELECT * FROM `concerto`;";
        $rec = mysqli_query($db_remoto, $sql) or die($sql . "<br>" . mysqli_error($db_remoto));
        echo "<div class='row mt-4'>";
        while ($array = mysqli_fetch_array($rec)) {
            $id = $array['id'];
            $band = $array['band'];
            $band_desc = $array['band_desc'];
            $data = $array['data'];
            $posti = $array['n_posti_disponibili'];
            $bandimg = $array['band_img'];

            $posti_class = "bg-success";

            if ($posti <= 0) {
                $posti_class = "bg-danger";
            }
            echo "<div class='col mt-4'>";
            echo "<div class='card h-100 mx-auto' style='width: 25rem;'>";

            echo "<img src=" . $bandimg . " class='card-img-top'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $band . "</h5>";
            echo "<h6 class='card-subtitle mb-2 text-muted'>" . $data . "</h6>";
            echo "<p class='card-text'>" . $band_desc . "</p>";
            echo "<a href='prenotazione.php?data=" . $data . "&id_concerto=" . $id . "' class='btn btn-dark'>Prenota</a><br>";
            echo "<span class='badge rounded-pill " . $posti_class . "'>Posti disponibili: " . $posti . "</span>";
            echo "</div>";
            echo "</div>";
            echo "</div>";


        }
        echo "</div>";


        ?>


</body>

</html>
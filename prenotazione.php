<?php
require_once("db.php");
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $id_concerto = $_GET['id_concerto'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome_utente = $_POST['nome_utente'];
    $cognome_utente = $_POST['cognome_utente'];
    $mail_utente = $_POST['mail_utente'];
    $id_concerto = $_POST['id_concerto'];


    $n_posti_disponibili = 0;
    $sql_posti_disponibili = "SELECT n_posti_disponibili FROM concerto WHERE id = $id_concerto";
    $rec = mysqli_query($db_remoto, $sql_posti_disponibili) or die($sql_posti_disponibili . "<br>" . mysqli_error($db_remoto));
    while ($array = mysqli_fetch_array($rec)) {

        $n_posti_disponibili = $array['n_posti_disponibili'];
        
    }

    if ($n_posti_disponibili > 0) {
        $sql_update_posti_disponibili = "UPDATE concerto SET n_posti_disponibili = n_posti_disponibili - 1 WHERE id = $id_concerto;";
        $query_posti_ok = mysqli_query($db_remoto, $sql_update_posti_disponibili); 

        $sql = "INSERT INTO prenotazione (nome_utente, cognome_utente,mail_utente,pagato,id_concerto) VALUES ('$nome_utente','$cognome_utente','$mail_utente','S','$id_concerto')";


        if ($query_posti_ok && mysqli_query($db_remoto, $sql)) {
            echo "Prenotazione effetuata <a  href='creapdf.php'>Scarica Biglietto in PDF</a> <br>";
            echo "Torna alla <a  href='index.php'>Homepage</a> <br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db_remoto);
        }

    } else {
        echo "Non ci sono posti disponibili";
    }







}


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

<body class="h-100">

    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <form class="form-example" action="prenotazione.php" method="post">
                    <h1>Prenotazione Concerto</h1>
                    <input type="hidden" name="id_concerto" value="<?php echo $id_concerto ?>">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control username" placeholder="Nome" name="nome_utente">
                    </div>
                    <div class="form-group">
                        <label for="nome">Cognome</label>
                        <input type="text" class="form-control username" placeholder="Cognome" name="cognome_utente">
                    </div>
                    <div class="form-group">
                        <label for="nome">Mail</label>
                        <input type="mail" class="form-control username" placeholder="Mail" name="mail_utente">
                    </div>
                    <button type="submit" class="btn btn-primary btn-customized mt-4">Prenota</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
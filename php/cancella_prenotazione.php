<!DOCTYPE html>
<html lang="it">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width" >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap"/>
        <link rel="icon" href="../Immagini/favicon.png"/>
        <link href="../css/style.css" rel="stylesheet" type="text/css">

        <title>
            Prenotazione
        </title>
    </head>


    <?php
        session_start();
        require_once('./connection.php');

        if (isset($_SESSION['organizzatore']) || isset($_SESSION['utente'])) {
            printf("<h1> Benvenuto, %s</h1>", $_SESSION['nome_utente']);   
        } else {    
            header('Location: ./login.php');
            exit;
        }  

        $evento_da_cancellare = $_POST['prenotazione_da_cancellare'];
        $evento_da_cancellare = $dbCon->real_escape_string($evento_da_cancellare);
        $nome = $_SESSION['nome_utente'];

        $query = 
                "
                    DELETE 
                    FROM prenotazioni
                    WHERE idprenotazioni = '$evento_da_cancellare'
                ";

        $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");

        print("Prenotazione cancellata con successo! <br>")

    ?>

    <a href="../index.php"> Pagina iniziale</a>
</html>
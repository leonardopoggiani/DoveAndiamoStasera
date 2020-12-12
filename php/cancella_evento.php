<?php
    session_start();
    require_once('./connection.php');

    if (isset($_SESSION['organizzatore'])) {
        printf("<h1> Benvenuto, %s</h1>", $_SESSION['nome_utente']);   
    } else {    
        header('Location: ./login.php');
        exit;
    }  

    $evento_da_cancellare = $_POST['evento_da_cancellare'];
    $evento_da_cancellare = $dbCon->real_escape_string($evento_da_cancellare);
    
    $cancella = 
            "
                SELECT *
                FROM eventi
                WHERE ideventi = '$evento_da_cancellare'
            ";

    $cancellazione = $dbCon->query($cancella ) or trigger_error($dbCon->error."[ $cancella ]");
    $evento = $cancellazione->fetch_object();
    $titolo = $evento->titolo;
    $numeroRisultati = $cancellazione->num_rows;

    $delete = 
            "
                DELETE
                FROM eventi
                WHERE ideventi = '$evento_da_cancellare'
            ";
    
    $cancellazione = $dbCon->query($delete ) or trigger_error($dbCon->error."[ $delete ]");
    
    $cancella_prenotazioni = 
                            "
                                DELETE 
                                FROM prenotazioni
                                WHERE titolo_evento = '$titolo'
                            ";
                            
    $cancellazione = $dbCon->query($cancella_prenotazioni ) or trigger_error($dbCon->error."[ $cancella_prenotazioni ]");

    print("Evento cancellato! <br>");        

    print("<a href='../index.php'> Torna indietro </a>");
?>

<!DOCTYPE html>
<html lang="it">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width" >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap"/>
        <link rel="icon" href="../Immagini/favicon.png"/>
        <link href="../css/style.css" rel="stylesheet" type="text/css">

        <title>
            Cancella evento
        </title>
    </head> 
</html>
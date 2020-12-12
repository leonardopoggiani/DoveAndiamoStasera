<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="icon" href="../immagini/favicon.png">
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <title>
            Contatti
        </title>
    </head>
</html>

<?php
    session_start();
    require_once('./connection.php');

    if (isset($_SESSION['utente'])) {
        print("Accesso non consentito, non sei loggato come organizzatore! <br>");
        printf("%s", '<a href="../index.php"> Pagina iniziale </a>');
    } else if (isset($_SESSION['organizzatore'])){
        header('location: ./home_organizzatore.php');
        exit;
    } else {
        header('location: ./glance.php');
        exit;
    }
?>
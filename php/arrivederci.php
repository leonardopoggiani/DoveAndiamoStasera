<!DOCTYPE html>
<html lang="it">
    <link rel="icon" href="../Immagini/favicon-login.png">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">

    <head>
        <title>
            Arrivederci
        </title>
    </head>
</html>

<?php
    session_start();
    include './connection.php';

    printf("Arriverderci! Torna a trovarci! <br><br><br> <form action='../index.php'> <input class='bottone-ciao' id='bottone-ciao' type='submit' value='Torna alla home'> </form>");
?>
<!DOCTYPE html>
<html lang="it">
    <link rel="icon" href="../Immagini/favicon-login.png">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <script src = "../js/validation.js"></script>

    <head>
        <title>
            Login
        </title>
    </head>
</html>

<?php
    session_start();
    include './connection.php';

    if (isset($_SESSION['organizzatore']) || isset($_SESSION['utente'])) {  
        header('Location: ../index.php');
        exit;
    } else {
        printf("Non sei loggato! <br> <a href='./login.php'> Fai il login! </a> <br> <form action='../index.php'> <input class='torna' type='submit' value='Torna alla home'> </form>");
    }
?>


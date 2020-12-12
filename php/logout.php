<!DOCTYPE html>
<html lang="it">
    <link rel="icon" href="../Immagini/favicon-login.png">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <script src = "../js/validation.js"></script>

    <head>
        <title>
            Logout
        </title>
    </head>
</html>

<?php
    session_start();
    include './connection.php';

    if (isset($_SESSION['organizzatore']) || isset($_SESSION['utente'])) {  
        session_start();
        session_destroy();
        header('Location: ./arrivederci.php');
        exit;
    } else {
        header('Location: ./benvenuto.php');
        exit;
    }
?>
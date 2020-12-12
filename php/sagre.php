<?php
    session_start();
    require_once('./connection.php');

    if (isset($_SESSION['utente']) || isset($_SESSION['organizzatore'])) {
        header('location: ./prenota_sagre.php');
        exit;
    } else {
        header('location: ./glance.php');
        exit;
    }
?>
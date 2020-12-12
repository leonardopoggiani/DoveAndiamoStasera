<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
     
    <title>Home utente</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <link rel="icon" href="../immagini/favicon.png" type="image/png" sizes="32x32" />

    <body>
        <?php
            require_once('./connection.php');
            session_start();

            if (isset($_SESSION['utente'])) {
                printf("<h2> Benvenuto, %s</h2>", $_SESSION['nome_utente']);
            } else {    
                header('Location: ./login.php');
                exit;
            }
                    
        ?>       
    </body>
</head>

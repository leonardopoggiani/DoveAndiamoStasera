<!DOCTYPE html>
<html lang="it">
    <meta charset="utf-8">
    <link rel="icon" href="../Immagini/favicon-login.png">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <script src = "../js/validation.js"></script>

    <head>
        <title>
            Salva messaggio
        </title>
    </head>
</html>

<?php

    session_start();
    include './connection.php';
    
    $nomecognome = $_POST['nomecognome'];
    $email = $_POST['email'];
    $messaggio = $_POST['messaggio'];

    $nomecognome = $dbCon->real_escape_string($nomecognome);
    $email = $dbCon->real_escape_string($email);
    $messaggio = $dbCon->real_escape_string($messaggio);

    print("Nome: " . $nomecognome . ", email: " . $email . ", messaggio " . $messaggio . "<br>");

    $query = 
            "
                INSERT
                INTO messaggi
                VALUES (0, '$messaggio', '$nomecognome', '$email',0);
            ";
    
    $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");        

    header('Location: ./contatti.php');
?>
<!DOCTYPE html>
<html lang="it">
    <link rel="icon" href="../Immagini/favicon-login.png">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <script src = "../js/validation.js"></script>

    <head>
        <title>
            Cambia email
        </title>
    </head>
</html>

<?php
    session_start();
    require_once('./connection.php');

    if (isset($_SESSION['organizzatore']) || isset($_SESSION['utente'])) {
        printf("<h1> Benvenuto, %s</h1>", $_SESSION['nome_utente']);   
    } else {    
        header('Location: ./login.php');
        exit;
    }  

    $nome = $_SESSION['nome_utente'];

    $query = 
            "
                SELECT * 
                FROM utenti
                WHERE username = '$nome' 
            ";

    $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
    $obj = $risultato->fetch_object();

    if( $_POST['email'] == $obj->email) {
        $nuova = $_POST['email-nuova'];
        $nuova = $dbCon->real_escape_string($nuova);

        $aggiorna_email = 
                        "
                            UPDATE utenti 
                            SET email = '$nuova' 
                            WHERE username = '$nome'
                        ";
                        
        $risultato2 = $dbCon->query($aggiorna_email) or trigger_error($dbCon->error."[$aggiorna_email]");
        $_SESSION['email'] = $nuova;
        
        print("Email aggiornata con successo <br>");
  
    } else {
        print("Email non valida! <br>");
    }

    print('<a href="./areapersonale.php">torna indietro</a>');
  
?>  

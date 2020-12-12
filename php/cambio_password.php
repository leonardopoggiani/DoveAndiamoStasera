<?php
    session_start();
    include './connection.php';
?>

<!DOCTYPE html>
<html lang="it">
    <link rel="icon" href="../Immagini/favicon-login.png">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <script src = "../js/validation.js"></script>

    <head>
        <title>
            Cambia password
        </title>
    </head>

    <?php

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

        if( password_verify($_POST['password'],$obj->password) ) {
            $nuova_non_cifrata = $_POST['password-nuova'];
            $nuova_non_cifrata = $dbCon->real_escape_string($nuova_non_cifrata);
            $password_hash = password_hash($nuova_non_cifrata, PASSWORD_BCRYPT);

            $aggiorna_password = 
                            "
                                UPDATE utenti 
                                SET password = '$password_hash' 
                                WHERE username = '$nome'
                            ";
                            
            $risultato2 = $dbCon->query($aggiorna_password) or trigger_error($dbCon->error."[$aggiorna_password]");

            print("Password aggiornata con successo <br>");
    
        } else {
            print("Le password non combaciano!");
        }

        print('<a href="./areapersonale.php">torna indietro</a>');
    ?>
</html>
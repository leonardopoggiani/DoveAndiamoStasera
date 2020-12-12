<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        
        <title>Registrazione</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="icon" href="../Immagini/favicon.png" type="image/png" sizes="32x32" />
    </head>
</html>

<?php
    require_once('./connection.php');

    if (isset($_SESSION['organizzatore']) || isset($_SESSION['utente'])) {
        header('Location: ./areapersonale.php');
        exit;
    }

    if (isset($_POST['register'])) {
        $name = ($_POST['name'] == null) ? '' :  $_POST['name'];
        $surname = ($_POST['surname'] == null) ? '' :  $_POST['surname'];
        $username = ($_POST['username'] == null) ? '' :  $_POST['username'];
        $password = ($_POST['password'] == null) ? '' :  $_POST['password'];
        $email = ($_POST['email'] == null) ? '' :  $_POST['email'];
        $passwordripetuta = ($_POST['ripeti-password'] == null) ? '' :  $_POST['ripeti-password'];
        $datanascita = ($_POST['data_nascita'] == null) ? '' :  $_POST['data_nascita'];

        $name = $dbCon->real_escape_string($name);
        $surname = $dbCon->real_escape_string($surname);
        $username = $dbCon->real_escape_string($username);
        $password = $dbCon->real_escape_string($password);
        $email = $dbCon->real_escape_string($email);
        $passwordripetuta = $dbCon->real_escape_string($passwordripetuta);
        $datanascita = $dbCon->real_escape_string($datanascita);
        

        $organizzatore = 0;
        $errore = 1;

        if (isset($_POST['organizzatore'])) {
            $organizzatore = 1;
        }
        
        echo $username . ', ';

        $isUsernameValid = filter_var(
            $username,
            FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^[a-z\d_]{3,20}$/i"
                ]
            ]
        );

        $isEmailValid = filter_var($email, FILTER_VALIDATE_EMAIL);
        
        $arePasswordEqual = ( $password === $passwordripetuta );

        $pwdLenght = mb_strlen($password);
        $msg = "Inizio registrazione";
        if (empty($username) || empty($password)) {
            $msg = 'Compila tutti i campi';
        } elseif (false === $isUsernameValid) {
            $msg = 'Lo username non è valido. Sono ammessi solamente caratteri 
                    alfanumerici e l\'underscore. Lunghezza minina 3 caratteri.';
        } elseif ($pwdLenght < 8) {
            $msg = 'Lunghezza minima password 8 caratteri.';
        } else if (false === $isEmailValid) {
            $msg = "Indirizzo email non valido.";
        } else if (false === $arePasswordEqual) {
            $msg = "Le due password non corrispondono.";
        } else {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $query = "
                SELECT id
                FROM utenti
                WHERE username = '$username'
                    OR email = '$email'
            ";
            
            $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            $numeroRisultati = $risultato->num_rows;
            
            if ($numeroRisultati > 0) {
                $msg = 'Username o email già in uso ';
            } else {
                $query = "
                    INSERT INTO utenti
                    VALUES (0, '$username' , '$password_hash', '$email', '$organizzatore', '$name', '$surname',0)
                ";
            
                $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
                
                if ($risultato) {
                    if (isset($_POST['organizzatore'])) {
                        $msg = "Registrazione eseguita con successo, organizza subito il tuo evento!";
                    } else {
                        $msg = "Registrazione eseguita con successo, ti aspettano dei meravigliosi eventi a cui partecipare!";
                    }

                    $errore = 0;
                } else {
                    $msg = 'Problemi con l\'inserimento dei dati';
                }
            }

        }
        echo $msg;

    } 

    if($errore === 0) {
        print('<br> <a href="../index.php">Torna indietro</a> <br> <a href="./login.php"> Esegui il login </a>');
    } else {
        print('<br> <a href="./register.php"> Riprova a registrarti!</a>');
    }

?>
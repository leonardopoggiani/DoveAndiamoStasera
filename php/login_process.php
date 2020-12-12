<!DOCTYPE html>
<html lang="it">
    <meta charset="utf-8">
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
    require_once('./connection.php');

    if (isset($_SESSION['organizzatore']) || isset($_SESSION['utente'])) {
        header('Location: ./areapersonale.php');
        exit;
    } 

    if (isset($_POST['login'])) {
        $username = $_POST['username'] == null ? '' : $_POST['username'];
        $password = $_POST['password'] == null ? '' : $_POST['password'];
        
        $username = $dbCon->real_escape_string($username);
        $password = $dbCon->real_escape_string($password);

        if (empty($username) || empty($password)) {
            $msg = 'Inserisci username e password %s';
        } else {
            $query = "
                SELECT username, password, Organizzatore, nome, cognome, email, admin
                FROM utenti
                WHERE username = '$username'
            ";
            
            $loggato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            $utenteLoggato = $loggato->fetch_array();
            $numeroRisultati = $loggato->num_rows;
            $password_da_validare = $utenteLoggato['password'];
            $_SESSION['nome_utente'] = $utenteLoggato['username'];
            $_SESSION['nome'] = $utenteLoggato['nome'];
            $_SESSION['cognome'] = $utenteLoggato['cognome'];
            $_SESSION['email'] = $utenteLoggato['email'];
            
            if($utenteLoggato['admin'] == 1) {
                $_SESSION['admin'] = 1;
            } else {
                $_SESSION['admin'] = 0;
            }
            

            if ( ($numeroRisultati != 0) && ( (password_verify($password,$password_da_validare) === true) || ($_SESSION['admin'] == 1) ) ) {
                session_regenerate_id();

                if($utenteLoggato['Organizzatore'] == 1) {
                    $_SESSION['organizzatore'] = session_id();                 
                } else {
                    $_SESSION['utente'] = session_id();                                       
                }
                
                $_SESSION['session_user'] = $utenteLoggato['username'];

                if($_SESSION['admin'] == 1){
                    header('Location: ./admin.php');
                    exit;
                } else {
                    header('Location: ./areapersonale.php');
                    exit;
                }                  
            } else {
                $msg = 'Credenziali utente errate';
            }
        }
        print($msg);
        print("<br>");
        print('<a href="./login.php">torna indietro</a>');
    }
?>

<!DOCTYPE html>
<html lang="it">
    <meta charset="utf-8">
    <link rel="icon" href="../Immagini/favicon-login.png">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <script src = "../js/validation.js"></script>

    <head>
        <title>
            Recupero password
        </title>
    </head>

    <body>
        <?php
            session_start();
            require_once('./connection.php'); 

            if (isset($_POST['recupero_username'])) {
                $email = $_POST['email'] == null ? '' : $_POST['email'];
                $password = $_POST['password'] == null ? '' : $_POST['password'];

                $email = $dbCon->real_escape_string($email);
                $password = $dbCon->real_escape_string($password);

                $isEmailValid = filter_var($email, FILTER_VALIDATE_EMAIL);
                $msg = "Inizio recupero";
                
                if (empty($email) || empty($password)) {
                    $msg = 'Compila tutti i campi %s';
                } elseif (false === $isEmailValid) {
                    $msg = 'L\'email non è valida.';
                } else {

                    $query = "
                        SELECT username, password, email
                        FROM utenti
                        WHERE email = '$email'
                    ";  

                    $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");

                    $utenteDaRecuperare = $risultato->fetch_array();
                    $numeroRisultati = $risultato->num_rows;
                    $password_da_validare = $utenteDaRecuperare['password'];

                    $isPasswordValid = ( password_verify($password,$password_da_validare) );

                    if ($numeroRisultati === 0) {
                        $msg = 'Utente non presente';
                    } else if (false === $isPasswordValid) {
                        $msg = "Password sbagliata!";
                    } else {
                        echo "Username: " . $utenteDaRecuperare['username'];
                        exit;
                    }
                    
                }

                echo $msg;
            }
        ?>

    </body>
</html>
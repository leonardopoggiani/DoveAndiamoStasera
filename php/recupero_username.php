<!DOCTYPE html>
<html lang="it">

    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="icon" href="../immagini/favicon.png">
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <script src = "../js/validation.js"></script>

        <title>
            Dove vado stasera?
        </title>
    </head>

    <body> 
        <h1>
            Recupera il tuo nome utente
        </h1>

        <form method="POST" action="./recupero_username_process.php" onSubmit="return valida_recupero_utente()">
            <input name="email" type="text" placeholder="Inserisci la tua email" size="40" maxlength="50" required/>
            <input name="password" type="password" placeholder="Inserisci la tua password" size="40" autocomplete="off" required/>
            <input type="submit" name="recupero_username" value="Recupera username">
        </form>
    </body>
</html>
<!DOCTYPE html>
<html lang="it">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width" >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap"/>
        <link rel="icon" href="../Immagini/favicon.png"/>
        <link href="../css/style.css" rel="stylesheet" type="text/css">

        <title>
            Prenotazione
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

    $query = 
            "
                SELECT * 
                FROM eventi
            ";

    $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");

    print("<h1> Prenotazione </h1> <br> <br>"); 
    print("<div class='prenotazione'>");
    print("<p> Inserisci il numero di posti che desideri prenotare!</p> <br> <br>");
    print("
            <form method='POST' action='./inserisci_prenotazione.php'> 
                <fieldset class='colora'>
                    <select name='titolo-evento' class='colora'>
        ");

    while($obj = $risultato->fetch_object()){
        print("<option class='colora'> $obj->titolo </option>");
    }

    print("
                </select>
            </fieldset>

            <input class='inserisci-prenotazione' name='numero-posti' type='number' placeholder='Inserisci i posti da prenotare' required/>
            <input class='inserisci' type='submit' name='inserisci' value='Inserisci'>
        </form>
    ");

    print("</div>");
?>
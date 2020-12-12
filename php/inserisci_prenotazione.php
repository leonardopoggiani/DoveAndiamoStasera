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
        $posti = $_POST['numero-posti'];
        $titolo = $_POST['titolo-evento'];

        $posti = $dbCon->real_escape_string($posti);
        $titolo = $dbCon->real_escape_string($titolo);

        $query = 
                "
                    SELECT *
                    FROM utenti
                    WHERE username = '$nome'
                ";

        $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
        $obj = $risultato->fetch_object();

        $posti_totali = 
                            "
                                SELECT *
                                FROM eventi
                                WHERE titolo = '$titolo'
                            ";
        $risultato_totali = $dbCon->query($posti_totali ) or trigger_error($dbCon->error."[ $posti_totali ]");
        $tot = $risultato_totali->fetch_object();
        $totali = $tot->maxpartecipanti;

        print("{$titolo} partecipanti massimi: {$totali}");
        print("<br> <br>");

        $posti_occupati = 
                            "
                                SELECT SUM(posti) AS posti_occupati
                                FROM prenotazioni
                                WHERE titolo_evento = '$titolo'
                            ";
        $risultato_occupati = $dbCon->query($posti_occupati ) or trigger_error($dbCon->error."[ $posti_occupati ]");
        $occ = $risultato_occupati->fetch_object();
        $occupati = $occ->posti_occupati;
        print("{$titolo} posti occupati: {$occupati}");

        if( $occupati + $posti <= $totali ) {
            $inserimento = 
                        "
                            INSERT
                            INTO prenotazioni
                            VALUES (0, '$obj->nome', '$obj->cognome', '$posti', '$titolo', '$nome')
                        ";

            $risultato2 = $dbCon->query($inserimento) or trigger_error($dbCon->error."[$inserimento]");

            print("
                    <body>
                    <h1>
                        Prenotazione effettuata!
                    </h1>

                    <a href='../index.php'> Pagina iniziale</a>
                </body>
            ");
           
        } else {
            print("<p> Non sono più disponibili posti per l'evento {$titolo}, cerca altri eventi! <br> <a href='../index.php'> Torna alla pagina iniziale</a> </p>");
        }
    ?>  
</html>
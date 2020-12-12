<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        
        <title>Modifica evento</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="icon" href="../Immagini/favicon.png" type="image/png" sizes="32x32" />
    </head>
 
    <body>

        <?php
            require_once('./connection.php');
            session_start();

            if (isset($_SESSION['organizzatore']) || isset($_SESSION['utente'])) {
                printf("<h1> Benvenuto, %s</h1>", $_SESSION['nome_utente']);   
            } else {    
                header('Location: ./login.php');
                exit;
            }  
            
            $new_posti = ($_POST['numero-posti'] == null) ? '' :  $_POST['numero-posti'];
            $idprenotazione = ($_POST['prenotazione_da_modificare'] == null) ? '' :  $_POST['prenotazione_da_modificare'];

            $new_posti = $dbCon->real_escape_string($new_posti);
            $idprenotazione = $dbCon->real_escape_string($idprenotazione);
            

            if($new_posti != null){
                // controllo che il nuovo numero di posti sia disponibile
                $controllo_posti = 
                                    "
                                        SELECT titolo_evento
                                        FROM prenotazioni
                                        WHERE idprenotazioni = '$idprenotazione' 
                                    ";
                $controllo = $dbCon->query($controllo_posti) or trigger_error($dbCon->error."[$controllo_posti]");
                $nome_evento = $controllo->fetch_object();

                $posti_disponibili = 
                                    "
                                        SELECT maxpartecipanti
                                        FROM eventi
                                        WHERE titolo = '$nome_evento->titolo_evento'
                                    ";
                // massimo dei partecipanti
                $maxpartecipanti = $dbCon->query($posti_disponibili) or trigger_error($dbCon->error."[$posti_disponibili]");                    
                $partecipanti = $maxpartecipanti->fetch_object();

                $posti_occupati = 
                                    "
                                        SELECT COUNT(posti) AS posti_occupati
                                        FROM prenotazioni
                                        WHERE titolo_evento = '$nome_evento->titolo_evento'
                                    ";
                $occupati = $dbCon->query($posti_occupati) or trigger_error($dbCon->error."[$posti_occupati]");                    
                $posti = $occupati->fetch_object();

                if( $new_posti > $partecipanti->maxpartecipanti - $posti->posti_occupati){
                    print("Non è possibile modificare la prenotazione, non ci sono sufficienti posti liberi disponibili!");
                } else {
                    $query = 
                    "
                        UPDATE prenotazioni 
                        SET posti = '$new_posti' 
                        WHERE idprenotazioni = '$idprenotazione';
                    ";
                    $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");

                    print("Prenotazione modificata!");
                }

                
            }    
        ?>

        <a href="../index.php" class="allinea-bottone">
            <img id='freccia' src="../Immagini/indietro.png"> Torna alla home
        </a>
    </body>
</html>
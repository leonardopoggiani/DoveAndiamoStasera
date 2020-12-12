    
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        
        <title>Area personale</title>
        
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="icon" href="../Immagini/favicon.png" type="image/png" sizes="32x32" />
    </head>


<?php
    session_start();
    include './connection.php';

    if( (isset($_SESSION['utente'])) || (isset($_SESSION['organizzatore'])) ) {

        $session_user = htmlspecialchars($_SESSION['session_user'], ENT_QUOTES, 'UTF-8');

        if( isset($_SESSION['utente']) ) {
            $session_id = htmlspecialchars($_SESSION['utente']);
        } else {
            $session_id = htmlspecialchars($_SESSION['organizzatore']);
        }

        printf("<p>Benvenuto nella tua area personale %s, email: %s, nome utente: %s </p>", $_SESSION['nome'], $_SESSION['email'], $_SESSION['nome_utente']);
        echo "<br>";
        echo "<br>";
        printf("<p> Puoi visitare il sito tornando alla pagina iniziale, oppure puoi fare il logout! </p><br>");
        printf("%s", '<a class="sopra" href="./logout.php">logout</a> <br> <a class="sopra" href="../index.php"> <img src="../Immagini/home.png" alt="Home"> Pagina iniziale </a> <br> <br>');
    } else {
        printf("Effettua il %s per accedere all'area riservata", '<a href="./login.php">login</a>');
    }
?>

    <body>
        <hr>
        <div class="contenitore">
            <h2>
                Gestione dell'account
            </h2>

            <h3>
                Modifica password
            </h3>

            <form class="areapersonale" method="POST" action="./cambio_password.php">
                <input id="password" name="password" type="password" placeholder="Inserisci la tua password attuale" size="40" autocomplete="off" required/>
                <input id="password-nuova" name="password-nuova" type="password" placeholder="Inserisci la tua nuova password" size="40" autocomplete="off" required/>
                <input type="submit" id="cambio-pass" name="cambio-pass" value="Cambia password">
            </form>
            <br>

            <h3>
                Modifica email
            </h3>

            <form  class="areapersonale" method="POST" action="./cambio_email.php">
                <input id="email" name="email" type="email" placeholder="Inserisci la tua email attuale" size="40" maxlength="50" required/>
                <input id="email-nuova" name="email-nuova" type="email" placeholder="Inserisci la tua nuova email" size="40" maxlength="50" required/>
                <input type="submit" id="cambio-email" name="cambio-email" value="Cambia email">
            </form>

            <hr>

            <?php
                if($_SESSION['admin'] == 1){
                    $tutti_i_messaggi = "
                                            SELECT * 
                                            FROM messaggi
                                        ";
                    $risultato_messaggi = $dbCon->query($tutti_i_messaggi) or trigger_error($dbCon->error."[$tutti_i_messaggi]");
                    
                    print("<h2> Archivio messaggi </h2>");
                    print("<div class='container-messaggi'>");
                    while($obj = $risultato_messaggi->fetch_object()) {
                        print("<div class='messaggio_container'>");
                        print("Id messaggio: " . $obj->idmessaggi . ", contenuto: " . $obj->contenuto . " mandato da " . $obj->mittente);
                        print("</div>");
                    }
                    print("</div>");

                }else {

                    print("<h2> Le mie prenotazioni</h2>");

                    $nome = $_SESSION['nome_utente'];

                    $query = "
                                SELECT *
                                FROM prenotazioni
                                WHERE nome_utente = '$nome'
                            ";
                        
                    $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
                    $numeroRisultati = $risultato->num_rows;

                    if($numeroRisultati != 0){
                        
                        echo "<br>";
                        while ($obj = $risultato->fetch_object()) {
                            echo 'ID :'.$obj->idprenotazioni. ' ,evento: ' .$obj->titolo_evento.' , per '.$obj->posti;
                            print("
                                <div class='bottoni-in-fila-prenotazione'>
                                    <form method='POST' action='./cancella_prenotazione.php'> 
                                        <button class='bottone-cancellazione' name='prenotazione_da_cancellare' value='$obj->idprenotazioni'> Cancella prenotazione </button> 
                                    </form>

                                    <form method='POST' action='./modifica_prenotazione.php'> 
                                        <button class='bottone-modificazione' name='prenotazione_da_modificare' value='$obj->idprenotazioni'> Modifica prenotazione </button>
                                    </form>
                                </div>
                                ");
                            echo "<br>";
                        }
                    } else {
                        print("<p> Non hai nessuna prenotazione attiva! </p>");
                    }
                    
                    if( isset($_SESSION['organizzatore'])) {

                        print("
                            <h2>
                                I miei eventi
                            </h2>
                        ");
                        
                        $query2 = 
                        "
                            SELECT *
                            FROM eventi
                            WHERE nomeutente = '$nome'
                        ";

                        $risultato2 = $dbCon->query($query2) or trigger_error($dbCon->error."[$query2]");
                        $numeroRisultati2 = $risultato2->num_rows;

                        if($numeroRisultati2 != 0){ 
                        
                            echo "Eventi organizzati:";
                            echo "<br>";
                            while ($obj = $risultato2->fetch_object()) {
                                echo 'ID :'.$obj->ideventi. ' ,evento: ' .$obj->titolo.' , a ' . $obj->luogo . " con partecipanti massimi " . $obj->maxpartecipanti;
                                print("
                                    <div class='bottoni-in-fila-evento'>
                                        <form method='POST' action='./cancella_evento.php'> 
                                            <button class='bottone-cancellazione' name='evento_da_cancellare' value='$obj->ideventi'> Cancella evento </button> 
                                        </form>
                                        <form method='POST' action='./modifica_evento.php'> 
                                            <button class='bottone-modificazione' name='evento_da_modificare' value='$obj->ideventi'> Modifica evento </button> 
                                        </form>
                                    </div>
                                    ");
                                echo "<br>";
                            }
                        } else {
                            print("<p> Non hai organizzato nessun evento! </p>");
                        }
                    }
                }
            ?>
        </div>
    </body>
</html>
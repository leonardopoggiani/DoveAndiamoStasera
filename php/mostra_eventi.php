<!DOCTYPE html>
<html lang="it">
    <meta charset="utf-8">
    <link rel="icon" href="../Immagini/favicon-login.png">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <script src = "../js/validation.js"></script>

    <head>
        <title>
            Mostra eventi
        </title>
    </head>

    <header>
        <div class="nav-bar">
            <nav class="menu">
                <a href="../index.php"> <img src="../Immagini/home.png" width="21" height="21" alt="Home"> Home </a>
                <a href="./login.php"> <img src="../Immagini/add.png" width="21" height="21" alt="Login"> Login </a>
                <a href="./register.php"> <img src="../Immagini/register.png" width="21" height="21" alt="Registrazione"> Registrazione </a>
                <a href="./contatti.php"> <img src="../Immagini/mail.png" width="21" height="21" alt="Contatti"> Contatti </a>
                <a href="../html/manuale.html"> <img src="../Immagini/info.png" width="21" height="21" alt="Cosa è"> Cosa è? </a>
                <a href="./logout.php"> <img src="../Immagini/logout.png" width="21" height="21" alt="Logout"> Logout </a>
            </nav>
        </div>
    </header>

    <body>
        <section class="mostra">
            <h2>
                Eventi organizzati
            </h2>
            <?php
                session_start();
                require_once('./connection.php');

                $evento = 
                        "
                            SELECT *
                            FROM eventi
                        ";

                $eventi_elenco = $dbCon->query($evento ) or trigger_error($dbCon->error."[ $evento ]");
                
                while($risultato = $eventi_elenco->fetch_object()) {
                    print("<div class='evento_container'>");
                    print($risultato->titolo . ", a " . $risultato->luogo . " , il " .$risultato->dataevento . " , per un massimo di " . $risultato->maxpartecipanti . " persone. <br> <br>");
                    print("<img src=" . $risultato->image . " alt='Immagine'> <br>");
                    print(" <br> <br> Descrizione evento: " . $risultato->descrizione);
                    print("<br> <br>");

                    if($risultato->tipologia == "sagra"){
                        $vedi_menu = 
                                    "
                                        SELECT * 
                                        FROM menu 
                                        WHERE idsagra = '$risultato->ideventi';
                                    ";
                        $vista_menu =  $dbCon->query($vedi_menu ) or trigger_error($dbCon->error."[ $vedi_menu ]");
                        while($risultato2 = $vista_menu->fetch_object()) {
                            print("Portata: " . $risultato2->tipoportata . " ,nome del piatto: " . $risultato2->nomeportata);
                            print("<br> <br>");
                        }
                    } else if($risultato->tipologia == "concerto"){
                        $vedi_lineup = 
                                    "
                                        SELECT * 
                                        FROM lineup 
                                        WHERE idconcerto = '$risultato->ideventi';
                                    ";
                        $vista_lineup =  $dbCon->query($vedi_lineup ) or trigger_error($dbCon->error."[ $vedi_lineup ]");
                        while($risultato2 = $vista_lineup->fetch_object()) {
                            print("Genere: " . $risultato2->genere . " ,nome del gruppo: " . $risultato2->nomegruppo);
                            print("<br> <br>");
                        }
                    } else if($risultato->tipologia == "eventi"){
                        $vedi_ospiti = 
                                    "
                                        SELECT * 
                                        FROM ospiti 
                                        WHERE idevento = '$risultato->ideventi';
                                    ";
                        $vista_evento =  $dbCon->query($vedi_ospiti ) or trigger_error($dbCon->error."[ $vedi_ospiti ]");
                        while($risultato2 = $vista_evento->fetch_object()) {
                            print("Argomento: " . $risultato2->argomento . " ,nome dell'ospite: " . $risultato2->nome);
                            print("<br> <br>");
                        }
                    }

                    print("</div>");
                }


            ?>
        </section>
    </body>
</html>
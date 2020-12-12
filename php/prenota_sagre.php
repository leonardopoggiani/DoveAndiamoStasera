
<!DOCTYPE html>
<html lang="it">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width" >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap"/>
        <link rel="icon" href="../Immagini/favicon.png"/>
        <link href="../css/style.css" rel="stylesheet" type="text/css">

        <title>
            Dove vado stasera?
        </title>
    </head>

    <body>
        <a href="../index.php" class="allinea-bottone">
            <img id='freccia' src="../Immagini/indietro.png" alt="Torna indietro"> Torna alla home
        </a>
    </body>

    <?php
        session_start();
        require_once('./connection.php');

        print("<h1> Prenota ora il tuo posto alle migliori sagre!</h1>");

        if(isset($_SESSION['organizzatore']) || isset($_SESSION['utente'])) {
            $query = "
                        SELECT *
                        FROM eventi
                        WHERE tipologia = 'sagra'
                    ";
            
            $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            $numeroRisultati = $risultato->num_rows;

            if($numeroRisultati != 0){
                echo "Eventi:";
                echo "<br>";
                while ($obj = $risultato->fetch_object()) {
                    echo $obj->titolo.' ,'.$obj->luogo;
                    print("<br> <br> <img src=" . $obj->image . " alt='Immagine'>");
                    print("
                        <form method='POST' action='./prenota_process.php'> 
                            <button class='bottone-prenotazione'> Prenota </button>  
                        </form>
                        ");
                    echo "<br>";
                }
            } else {
                print("<p> Non sono disponibili eventi di questa tipologia! Riprova più tardi! <br> </p> <a href='../index.php'> Torna indietro</a>");
            }
        } else {
            header("Location: ./login.php");
            exit;
        }
        
    ?>
</html>
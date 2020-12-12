<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        
        <title>Home organizzatore</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="icon" href="../Immagini/favicon.png" type="image/png" sizes="32x32" />
        <script src="../js/validation.js"></script>
    </head>
    
    <script>
    	function valida_modifica_prenotazione() {
	
   		var posti = document.getElementById("nuovi_posti");
  		if(posti.value <= 0){
      		alert("Inserire un numero valido di posti da prenotare");
      		return false;
   		}
	}
    </script>
 
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
        ?>

            
        <a href="../index.php" class="allinea-bottone">
            <img id='freccia' src="../Immagini/indietro.png" alt="Torna indietro"> Torna alla home
        </a>

        <h2>
            Qui puoi modificare le tue prenotazioni!
        </h2>

        <?php
            $nome = $_SESSION['nome_utente'];
            $da_modificare = $_POST['prenotazione_da_modificare'];

            
            $da_modificare = $dbCon->real_escape_string($da_modificare);

            $prenotazione = 
                            "
                                SELECT *
                                FROM prenotazioni
                                WHERE nome_utente = '$nome';
                            ";
            
            $risultato = $dbCon->query($prenotazione) or trigger_error($dbCon->error."[$prenotazione]");
            
            while($obj = $risultato->fetch_object()){
                if($obj->idprenotazioni == $da_modificare){
                    print("Nome evento: " . $obj->titolo_evento. "<br> <br>");
                    print("<form method='POST' action='./modifica_prenotazione_process.php' onSubmit='return valida_modifica_prenotazione()'>");
                    print("Modifica numero posti prenotati: " . "<input id='nuovi_posti' class='inserisci-prenotazione' name='numero-posti' type='number' placeholder='Inserisci i posti da prenotare'/> <br>");
                    print("<button class='bottone-modificazione' name='prenotazione_da_modificare' value='$obj->idprenotazioni'> Modifica prenotazione </button>");
                    print("</form>");
                }
            }
        ?>

    </body>
</html>
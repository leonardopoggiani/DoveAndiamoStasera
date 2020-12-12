<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        
        <title>Home organizzatore</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="icon" href="../Immagini/favicon.png" type="image/png" sizes="32x32" />
        <script src="../js/validation.js"></script>
    </head>
    
    <body>
        <?php
            require_once('./connection.php');
            session_start();

            if (isset($_SESSION['organizzatore']) ) {
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
            Qui puoi modificare gli eventi che hai organizzato!
        </h2>

        <?php
            $nome = $_SESSION['nome_utente'];
            $da_modificare = $_POST['evento_da_modificare'];
            $da_modificare = $dbCon->real_escape_string($da_modificare);

            $organizzatore = 
                            "
                                SELECT *
                                FROM eventi
                                WHERE nomeutente = '$nome';
                            ";
            
            $risultato = $dbCon->query($organizzatore) or trigger_error($dbCon->error."[$organizzatore]");
            
            while($obj = $risultato->fetch_object()){
                if($obj->ideventi == $da_modificare){
                    print("Nome evento: " . $obj->titolo. "<br> <br>");
                    print("<form method='POST' action='./modifica_evento_process.php' onsubmit='return valida_modifica()'>");
                    print("Modifica numero partecipanti: " . "<input id='maxpartecipanti' class='maxpartecipanti' name='partecipanti' type='number' placeholder='Inserisci il numero massimo di partecipanti'/> <br>");
                    print("Modifica data: " . "<input type='date' id='data_evento' name='data_evento' style='color:black'> <br>");
                    print("Modifica immagine evento: " . "<input class ='scegli' type='file' name='image'  accept='image/*'> <br>");
                    print("<button class='bottone-modificazione' name='evento_da_modificare' value='$obj->ideventi'> Modifica evento </button>");
                    print("</form>");
                }
            }
        ?>
    </body>
</html>
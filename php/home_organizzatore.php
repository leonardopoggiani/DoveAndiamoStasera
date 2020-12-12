<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        
        <title>Home organizzatore</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="icon" href="../Immagini/favicon.png" type="image/png" sizes="32x32" />
        <script src="../js/validation.js"></script>
    </head>

<?php
    session_start();
    require_once('./connection.php');
    

    if (isset($_SESSION['organizzatore']) ) {
        printf("<h1> Benvenuto, %s</h1>", $_SESSION['nome_utente']);   
    } else {    
        header('Location: ./login.php');
        exit;
    }             
?>   

    <body>
        
        <a href="../index.php" class="allinea-bottone">
            <img id='freccia' src="../Immagini/indietro.png" alt="Torna indietro"> Torna alla home
        </a>
        
        <div>

            <div class="form-registrazione" id="form-registrazione">
                <h2>
                    Portale per l'inserimento degli eventi
                </h2>
                <form method="POST" action="./aggiungi_evento.php" onSubmit="return valida_aggiungi()" enctype="multipart/form-data">
                    <div class="container-home" id="container-home">
                        <input id="nome" name="nome_organizzatore" type="text" placeholder="Inserisci il tuo nome" size="40" maxlength="50" required/>
                        <input id="cognome" name="cognome_organizzatore" type="text" placeholder="Inserisci il tuo cognome" size="40" maxlength="50" required/>
                        <input id="titolo" name="titolo" type="text" placeholder="Inserisci il nome dell'evento" size="40" maxlength="50" required/>
                        <input id="luogo" name="luogo" type="text" placeholder="Inserisci il luogo dell'evento" size="40" maxlength="50" required/>

                        <br>
                        <label>Che giorno si terrà l'evento?
                            <input type="date" id="data_evento" name="data_evento" required>
                        </label>

                        <input id="maxpartecipanti" class="maxpartecipanti" name="partecipanti" type="number" placeholder="Inserisci il numero massimo di partecipanti" required/>
                        <input name="descrizione" type="text" placeholder="Inserisci una descrizione" size="40" maxlength="200"/>
                        <br> <br>

                        <label>
                            Tipologia di evento: 
                            <select id="tipologia" class="selezione" name="tipologia" onChange="if (typeof(this.selectedIndex) != 'undefined') show(this.selectedIndex)" >
                                <option> Tipologia </option>
                                <option value="sagra"> Sagra </option>
                                <option value="concerto"> Concerto </option>
                                <option value="eventi"> Evento </option>
                            </select>
                        </label>
                        
                        <br> <br>
                        <div id = "show"></div>
                        <br> <br>

                        <label>
                            Immagine: <input class ='scegli' type='file' name='image'  accept='image/*'>
                        </label>
                        
                        <input type="submit" class="aggiungi" id="aggiungi" name="aggiungi" value="Aggiungi">
                        <input type="reset" class="reset-home" id="reset-home" value="Resetta form" onclick="removeMenu()">
                    </div>    
                </form>
            </div>
        </div>
    </body>
</head>

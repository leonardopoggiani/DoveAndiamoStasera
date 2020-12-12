<!DOCTYPE html>
<html lang="it">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width" >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap"/>
        <link rel="icon" href="../Immagini/favicon.png"/>
        <link href="../css/style.css" rel="stylesheet" type="text/css">

        <title>
            Aggiungi evento
        </title>
    </head>

</html>

<?php
    session_start();
    require_once('./connection.php');

    if (!isset($_SESSION['organizzatore'])) {
        header('location: ../index.php');
        exit;
    }

    if (isset($_POST['aggiungi'])) {
        $name = ($_POST['nome_organizzatore'] == null) ? '' :  $_POST['nome_organizzatore'];
        $surname = ($_POST['cognome_organizzatore'] == null) ? '' :  $_POST['cognome_organizzatore'];
        $dataevento = ($_POST['data_evento'] == null) ? '' :  $_POST['data_evento'];
        $partecipanti = ($_POST['partecipanti'] == null) ? '' :  $_POST['partecipanti'];
        $descrizione = ($_POST['descrizione'] == null) ? '' :  $_POST['descrizione'];
        $titolo = ($_POST['titolo'] == null) ? '' :  $_POST['titolo'];
        $luogo = ($_POST['luogo'] == null) ? '' :  $_POST['luogo'];
        $tipologia = ($_POST['tipologia'] == null) ? '' :  $_POST['tipologia'];

        $name = $dbCon->real_escape_string($name);
        $surname = $dbCon->real_escape_string($surname);
        $dataevento = $dbCon->real_escape_string($dataevento);
        $partecipanti = $dbCon->real_escape_string($partecipanti);
        $descrizione = $dbCon->real_escape_string($descrizione);
        $titolo = $dbCon->real_escape_string($titolo);
        $luogo = $dbCon->real_escape_string($luogo);
        $tipologia = $dbCon->real_escape_string($tipologia);

        $nome = $_FILES['image']['name'];
        $nome = str_replace(' ' ,'',$nome);
        $percorso="../Immagini/imgEventi/$nome";
        $nome_utente = $_SESSION['nome_utente'];
        $sagra = 0;
        $evento = 0;
        $concerto = 0;
        $msg = "";
        $today = date ("Y/m/d");  

        $query = "
                    INSERT INTO eventi
                    VALUES (0, '$tipologia' , '$today', '$partecipanti', '$name', '$surname','$descrizione', '$dataevento', '$titolo','$luogo',' ', '$nome_utente')
                ";

        $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
        $query = 
                "
                    SELECT ideventi, tipologia
                    FROM eventi
                    WHERE titolo = '$titolo';
                ";
        $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");    
        $obj = $risultato->fetch_object();
        $_SESSION['ideventi'] = $obj->ideventi;

        if($obj->tipologia == "sagra"){
            for($i = 0; $i < 5; $i++){
                $portata = ($_POST['menuSelect' . $i] == null) ? '' :  $_POST['menuSelect' . $i];
                $pietanza = ($_POST['pietanza' . $i] == null) ? '' :  $_POST['pietanza' . $i];

                if($portata == '' || $pietanza == '')
                    continue;

                $query = "
                            INSERT
                            INTO menu
                            VALUES('$obj->ideventi','$portata','$pietanza');
                        ";

                $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            }
        } else if($obj->tipologia == "concerto"){
            for($i = 0; $i < 5; $i++){
                $genere = ($_POST['lineUp' . $i] == null) ? '' :  $_POST['lineUp' . $i];
                $gruppo = ($_POST['gruppo' . $i] == null) ? '' :  $_POST['gruppo' . $i];

                if($genere == '' || $gruppo == '')
                    continue;

                $query = "
                            INSERT
                            INTO lineup
                            VALUES('$obj->ideventi','$genere','$gruppo');
                        ";

                $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            }
        } else if($obj->tipologia == "eventi"){
            for($i = 0; $i < 5; $i++){
                $argomento = ($_POST['guest' . $i] == null) ? '' :  $_POST['guest' . $i];
                $ospite = ($_POST['ospite' . $i] == null) ? '' :  $_POST['ospite' . $i];


                if($argomento == '' || $ospite == '')
                    continue;

                $query = "
                            INSERT
                            INTO ospiti
                            VALUES('$obj->ideventi','$argomento','$ospite');
                        ";

                $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            }
        }
            

        if((trim($_FILES["image"]["name"]) == "")){
            print("Nessuna immagine caricata! Sei sicuro?");
            print("<br> <a  href='./modifica_evento.php'> Modifica evento </a>");
            print("<br> <a  href='../index.php'> Torna alla home </a>");
        }
        else {
            $query = "UPDATE eventi SET image = '".$percorso."' WHERE titolo = '$titolo' ";
            $result= $dbCon->query($query) or trigger_error($dbCon->error."[$query]");

            if($result)
            {
                copy($_FILES['image']['tmp_name'] , "../immagini/imgEventi/".$nome) or die("impossibile caricare il file");
                echo"
                    <h3 class='esito'>Anteprima immagine caricata</h3>
                    <img class='caricata' alt='Immagine' src='$percorso'>
                ";
                print("<br> <br> <form method='POST' action='./modifica_evento.php'> 
                                    <button class='bottone-modificazione' name='evento_da_modificare' value='$_SESSION[ideventi]'> Modifica evento </button> 
                                </form>");
                print("<br> <a href='../index.php'> Torna indietro</a>");
            }
            die();
        }
    }
?>
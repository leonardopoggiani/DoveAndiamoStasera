<!DOCTYPE html>
<html lang="it">
    <meta charset="utf-8">
    <link rel="icon" href="../Immagini/favicon-login.png">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <script src = "../js/validation.js"></script>

    <head>
        <title>
            Login
        </title>

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
    </head>
</html>

<?php
    session_start();
    require_once('./connection.php');

    if($_SESSION['admin'] == 1){
        print("<div class ='admin'>");
        print("<h1> Benvenuto admin, ecco i messaggi di feedback degli utenti!</h1>");

        $quanti = "SELECT COUNT(idmessaggi) AS quanti FROM messaggi WHERE letto = 0";
        $da_leggere = $dbCon->query($quanti) or trigger_error($dbCon->error."[$quanti]"); 
        $read = $da_leggere->fetch_object();

        $query = "SELECT * FROM messaggi;";
        $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]"); 
       
        print("Hai " . $read->quanti . " messaggi non letti! <br> <br>");

        if($read->quanti != 0){         
            print("<ul>");
            while ($obj = $risultato->fetch_object()) {
                if($obj->letto == 0){
                    print("<div class='evento_container'>");
                    print("<li> Email mittente: " . $obj->emailmittente . ", nome e cognome: " . $obj->mittente . "<br> Feedback: <br> " . $obj->contenuto . " <br> <br> </li>");
                    $query = "UPDATE messaggi SET letto = 1 WHERE idmessaggi = '$obj->idmessaggi'";
                    $risultato2 = $dbCon->query($query) or trigger_error($dbCon->error."[$query]"); 
                    print("</div>");
                }      
            }
            print("</ul>");          
        }   

        print(' <a class="sopra" href="./areapersonale.php"> <img src="../Immagini/home.png" alt="Home"> Area personale </a> <br>');

        print("</div>");
    } else {
        header('Location: ./login.php');
        exit;
    }
?>
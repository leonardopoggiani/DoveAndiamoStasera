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
        <h1 class="titoletto-glance">
            Dai un'occhiata ai nostri eventi!
        </h1>   

        <div class="riquadroacarte">     
            <?php
                session_start();
                require_once('./connection.php');

                $sagra = 
                        "
                            SELECT *
                            FROM eventi
                            WHERE tipologia = 'sagra'
                        ";

                $sagre_elenco = $dbCon->query($sagra ) or trigger_error($dbCon->error."[ $sagra ]");
                
                while($sagre = $sagre_elenco->fetch_object()) {  
                    print("<a href='./mostra_eventi.php'>");               
                    print("<div class ='card'>");
                    print($sagre->titolo . ", luogo " .$sagre->luogo. ", data: ". $sagre->dataevento);
                    print("<img src='" . $sagre->image . "' alt='Sagre' style='width:100%'> ");
                    print("</div>"); 
                    print("</a>");              
                    print("<br>");
                }

                $concerto = 
                        "
                            SELECT *
                            FROM eventi
                            WHERE tipologia = 'concerto'
                        ";

                $concerto_elenco = $dbCon->query($concerto ) or trigger_error($dbCon->error."[ $concerto ]");

                while($concerti = $concerto_elenco->fetch_object()) {
                    print("<a href='./mostra_eventi.php'>");
                    print("<div class='card'>");
                    print($concerti->titolo . ", luogo " .$concerti->luogo. ", data: ". $concerti->dataevento);
                    print("<img src='" . $concerti->image . "' alt='Concerti' style='width:100%'>  ");
                    print("</div>");
                    print("</a>");
                    print("<br>");
                }

                $evento = 
                        "
                            SELECT *
                            FROM eventi
                            WHERE tipologia = 'eventi'
                        ";

                $eventi_elenco = $dbCon->query($evento ) or trigger_error($dbCon->error."[ $evento ]");
               
                while($eventi = $eventi_elenco->fetch_object()) {
                    print("<a href='./mostra_eventi.php'>");
                    print("<div class='card'>");
                    print($eventi->titolo . ", luogo " .$eventi->luogo. ", data: ". $eventi->dataevento);
                    print("<img src='" . $eventi->image . "' alt='Eventi' style='width:100%'> ");
                    print("</div>");
                    print("</a>");
                    print("<br>");
                }

                if( $sagre_elenco->num_rows + $eventi_elenco->num_rows + $concerto_elenco->num_rows == 0){
                    print("<h1> Non sono presenti eventi!</h1> <br> <br>");
                    print('<br> <a href="../index.php">Torna indietro</a> <br>');
                }
            ?>
        </div>
    </body>
</html>
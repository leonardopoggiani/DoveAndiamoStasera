<!DOCTYPE html>
<html lang="it">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width" >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap"/>
        <link rel="icon" href="./Immagini/favicon.png"/>
        <link href="./css/style.css" rel="stylesheet" type="text/css">

        <title>
            Dove vado stasera?
        </title>
    </head>

    <body>

        <header>
            <a href="./index.php" class="logo">
                <img src="./Immagini/ticket.png" alt="Logo"/>
            </a>

            <h1 class="titolo">
                Dove vuoi andare stasera?
            </h1>

            <?php
                session_start();
                require_once('./php/connection.php');

               if(isset($_SESSION['organizzatore']) || isset($_SESSION['utente']))
               {  
                   print("<h1 class='titolo2'>");
                   print($_SESSION['nome']);
                   print(", accedi alla tua <a class='titolo-link' href='./php/areapersonale.php'> area personale </a>");
                   print("</h1>");
               } else {
                   print("<h1 class='titolo2'> Fai il <a class='titolo_ref' href='./php/login.php'> login </a>!</h1>");
               }
            ?>

            <h2 class="titoletto-main"> Registrati e fai il login per vedere i programmi e i menù degli eventi che ti interessano!</h2>

            <div class="nav-bar">
                <nav class="menu">
                    <a href="./index.php"> <img src="./Immagini/home.png" width="21" height="21" alt="Home"> Home </a>
                    <a href="./php/login.php"> <img src="./Immagini/add.png" width="21" height="21" alt="Login"> Login </a>
                    <a href="./php/register.php"> <img src="./Immagini/register.png" width="21" height="21" alt="Registrazione"> Registrazione </a>
                    <a href="./php/contatti.php"> <img src="./Immagini/mail.png" width="21" height="21" alt="Contatti"> Contatti </a>
                    <a href="./html/manuale.html"> <img src="./Immagini/info.png" width="21" height="21" alt="Cosa è"> Cosa è? </a>
                    <a href="./php/logout.php"> <img src="./Immagini/logout.png" width="21" height="21" alt="Logout"> Logout </a>
                </nav>
            </div>
            
        </header>  

        <div class="riquadroacarte"> 

            <a href="./php/sagre.php">
                <div class="card">
                    <img src="./Immagini/sagra.jpg" alt="Sagre" style="width:100%"> 
                    <div class="container">
                        <p> Sagre </p>
                    </div>
                </div> 
            </a>

            <a href="./php/eventi.php">
                <div class="card">
                    <img src="./Immagini/eventi.jpg" alt="Eventi" style="width:100%"> 
                    <div class="container">
                        <p> Eventi </p>
                    </div>
                </div> 
            </a>

            <a href="./php/concerti.php">
                <div class="card">
                    <img src="./Immagini/concerti.jpg" alt="Concerti" style="width:100%">
                    <div class="container">
                        <p> Concerti </p>
                    </div>
                </div> 
            </a>


            <a href="./php/staff.php"> 
                <div class="card">
                    <img src="./Immagini/staff.jpg" alt="Staff" style="width:100%"> 
                    <div class="container">
                        <p> Staff </p>
                    </div>
                </div> 
            </a>
        </div> 
        
    </body>

    <footer>
        <p> Creato e mantenuto da Leonardo Poggiani, realizzato come progetto per l'esame di Progettazione Web</p>
    </footer>
</html>
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
    </head>

    <?php
        session_start();
        include './connection.php';

        if(isset($_SESSION['organizzatore']) || isset($_SESSION['utente']))
        {
            header('location: ./areapersonale.php');
            exit;
        }
    ?>

    <body>
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

        <div class="titolo-login">
            <h1>
                Login 
            </h1>
        </div>
        
        
        <div class="form-login">
            <form method="POST" action="./login_process.php" onSubmit="return valida_login()">
                <div class="fondo"> 
                    <input id='username' name="username" type="text" placeholder="Inserisci il tuo username" size="40" maxlength="50" required/>
                    <input id='password' name="password" type="password" placeholder="Inserisci la tua password" size="40" autocomplete="off" required/>
                    <input type="button" id="show" class="show" onclick="showPassword()" value="Mostra/nascondi password"> <br>
                </div>

                <input type="submit" name="login" value="Login">

                <div class="fondo">
                    <span> <a class="psw" href="javascript:popupCentratoNick()"> Nome utente dimenticato? </a> </span>
                    <span> <a class="psw" href="./register.php" class="link"> Non sei registrato? </a> </span>       
                </div>                 
            </form>  

        </div> 
        
    </body>
</html>


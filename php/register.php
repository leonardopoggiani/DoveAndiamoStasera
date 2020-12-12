<!DOCTYPE html>
<html lang="it">

    <link rel="icon" href="../Immagini/favicon-login.png">
    <link href="../css/style.css" rel="stylesheet" type="text/css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <script src = "../js/validation.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width" >

    <head>
        <title>
            Registrazione
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
        
        <h1 class="titolo-registrazione">
            Registrazione 
        </h1>

        <div class="form-registrazione">
            <form method="POST" action="./register_process.php" onSubmit='return valida_registrazione()'>
                <div class="container-registrazione">
                    <input id="name" name="name" type="text" placeholder="Inserisci il tuo nome" size="40" maxlength="50" required/> <br>
                    <input id="surname" name="surname" type="text" placeholder="Inserisci il tuo cognome" size="40" maxlength="50" required/> <br>
                    <input id="username" name="username" type="text" placeholder="Inserisci il tuo username" size="40" maxlength="50" required/> <br>
                    <input id="email" name="email" type="text" placeholder="Inserisci la tua email" size="40" maxlength="50" required/> <br>

                    <input id="password" name="password" type="password" placeholder="Inserisci la tua password" size="40" autocomplete="off" required/> <br>
                    <input type="button" id="show" class="show" onclick="showPassword()" value="Mostra/nascondi password"> <br>

                    <input id="ripeti_password" name="ripeti-password" type="password" placeholder="Ripeti la tua password" size="40" autocomplete="off" required/> <br>
                    <input type="button" id="show-ripetuta" class="show" onclick="showPasswordRipetuta()" value="Mostra/nascondi password"> <br>
                    
                    <br> <br>
                    <label>Quando sei nato?
                        <input type="date" id="data_nascita" name="data_nascita" required>
                    </label>
                    <br><br>

                    <div class="container-checkbox">
                        <label > 
                            Voglio organizzare un evento! <input type="checkbox"  id="organizzatore" name="organizzatore" value="organizzatore">
                        </label>       
                    
                    </div>
                    <br>
                    <input type="submit" class="regbutton" id="registrazione" name="register" value="Registra">
                    <input type="reset" id="reset2" value="Resetta form">
                </div>
            </form>  
        </div> 
        
    </body>
</html>
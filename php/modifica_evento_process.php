<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        
        <title>Modifica evento</title>
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
            

            $image = $_POST['image'];
            $image = $dbCon->real_escape_string($image);
            $image = str_replace(' ' ,'',$image);
            $new_image ="../Immagini/imgEventi/$image";
            $new_date = ($_POST['data_evento'] == null) ? '' :  $_POST['data_evento'];
            $new_partecipanti = ($_POST['partecipanti'] == null) ? '' :  $_POST['partecipanti'];
            $idevento = ($_POST['evento_da_modificare'] == null) ? '' :  $_POST['evento_da_modificare'];

            $new_date = $dbCon->real_escape_string($new_date);
            $new_partecipanti = $dbCon->real_escape_string($new_partecipanti);
            $idevento = $dbCon->real_escape_string($idevento);

            $update_partecipanti = 
                            "
                                UPDATE eventi 
                                SET maxpartecipanti = '$new_partecipanti' 
                                WHERE ideventi = '$idevento';
                            ";
            $update_date = 
                            "
                                UPDATE eventi 
                                SET dataevento = '$new_date' 
                                WHERE ideventi = '$idevento';
                            ";
            $update_image =  
                            "
                                UPDATE eventi 
                                SET image = '$new_image' 
                                WHERE ideventi = '$idevento';
                            ";
            
            if($image != null) {
                $risultato = $dbCon->query($update_image) or trigger_error($dbCon->error."[$update_image]");
            }
            if($new_date != null) {
                $risultato = $dbCon->query($update_date) or trigger_error($dbCon->error."[$update_date]");
            }
            if($new_partecipanti != null) {
                $risultato = $dbCon->query($update_partecipanti) or trigger_error($dbCon->error."[$update_partecipanti]");
            }

            header('Location: ./areapersonale.php');
            exit;
        ?>
    </body>

</html>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="icon" href="../immagini/favicon.png">
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <title>
            Contatti
        </title>
    </head>
    
    <body>
        <a href="../index.php" class="allinea-bottone">
            <img id='freccia' src="../Immagini/indietro.png" alt="Indietro"> Torna alla home
        </a>

        <h1>
            Come puoi contattarci
        </h1>

        <ul>
            <li> Email: <a href="mailto:organizzazione@email.com"> organizzazione@email.com </a> </li>
            <li> Facebook: <a href="https://it-it.facebook.com/"> org@facebook </a> </li>
            <li> Telefono: +39 347 12 34 567  </li>
        </ul>

        <h1>
            Dove puoi trovarci

            <iframe class="mappa" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1032.4477178635293!2d12.004067210123537!3d42.95292360607806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sit!4v1598372049295!5m2!1sen!2sit"  aria-hidden="false" tabindex="0"></iframe>
        </h1>

        <section class="contatti">
            <h2>
                Form per Contatti
            </h2>

            <script>
                function grazieAPresto() {
                    alert("Grazie ti rincontatteremo presto!");
                }
            </script>

            <form action="./salva_messaggio.php" method="POST" onSubmit="grazieAPresto()">
                <input type=hidden name="recipient" value="XXX">
                <input type=hidden name="subject" value="XXX">
                <table class="tabella-contatti">
                <tr>
                <td><b> Nome e Cognome:</b></td>
                <td><input placeholder="Inserisci il tuo nome e cognome" class="contact-form" type=text name="nomecognome"></td>
                </tr>
                <tr>
                <td><b>Email:</b></td>
                <td><input placeholder="Inserisci la tua email" class="contact-form" type=text name="email"></td>
                </tr>
                <tr>
                <td colspan="2"><b>Messaggio:</b></td>
                </tr>
                <tr>
                <td colspan="2"><textarea placeholder="Inserisci il tuo messaggio" class="contact-form" name="messaggio" cols="40" rows="5"></textarea></td>
                </tr>
                <tr>
                <td colspan="2"><input class="invia-form" type="Submit" value="Invia"></td>
                </tr>
                </table>
                <input type=hidden name="required" value="email,realname,messaggio">
            </form>
        </section>
    </body>
</html>
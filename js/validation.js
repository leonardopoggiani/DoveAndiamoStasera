function valida_registrazione() 
{
   var name = document.getElementById("name");
   var surname = document.getElementById("surname");
   var username = document.getElementById("username");
   var email = document.getElementById("email");
   var password = document.getElementById("password");
   var data = document.getElementById("data_nascita");
   var ripeti_password =document.getElementById("ripeti_password");

         // //check campi vuoti
   if(name.value.trim() == ""){
         alert("Il campo Nome è obbligatorio.");
         document.name.focus();
         return false;
   }

   if(surname.value.trim() == ""){
         alert("Il campo Cognome è obbligatorio.");
         document.surname.focus();
         return false;
   }

   if(username.value.trim() == ""){
         alert("Il campo Username è obbligatorio.");
         documento.username.focus();
         return false;
   }
         
   //controllo che ci siano solo caratteri alfabetici nel nome 
   var username_validation = /^[a-zA-Z]+[' ']?[a-zA-Z]+$/;
   var username_v = document.getElementById("username").value;

   if (!username_validation.test(username_v)) {
         alert("Il campo Username non è valido.");
         document.getElementById("username").focus();
         return false;
   }
   
   if(data.value.trim() == ""){
         alert("Il campo Data non è valido.");
         document.data.focus();
         return false;
   }

   var data_reg_exp = /^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/;
   var data_v= document.getElementById("data_nascita").value;

   if (!data_reg_exp.test(data_v)) {
         alert("Formato data scorretto!");
         data.focus();
         return false;
   }
   
   var today = new Date();
   var anno = data_v.substring(0,4);
         
   if(anno > (today.getFullYear() - 18)){
         data.focus();
         alert("Devi avere almeno 18 anni!");
         console.log(today.getFullYear());
         return false;
   }
   
   if(email.value.trim() == ""){
         alert("Devi inserire l'email!");
         email.focus();
         return false;
   }
         
   //controllare formato email
   var email_reg_exp = /^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,4})$/i;
   if (!email_reg_exp.test(email.value)) {
         email.focus();
         alert("Formato email scorretto!");
         return false;
   }
   
   if(password.value.trim() == ""){
         alert("Formato password scorretto!");
         password.focus();
         return false;
   }
   
   if(ripeti_password.value.trim() == ""){
         alert("Devi reinserire la password!");
         ripeti_password.focus();
         return false;
   }
   
   //corrispondenza password e ripeti_password

   if(ripeti_password.value.trim() != password.value.trim()){
         alert("Le password non coincidono!");
         ripeti_password.focus();
         return false;
   }
   
}

function showPassword() {
   var input = document.getElementById('password');
   if (input.type === "password") {
         input.type = "text";
   } else {
         input.type = "password";
   }
}

function showPasswordRipetuta() {
   var input = document.getElementById('ripeti_password');
   if (input.type === "password") {
         input.type = "text";
   } else {
         input.type = "password";
   }
}

function valida_login(){

   var username = document.getElementById("username");
   var password = document.getElementById("password");

   var username_validation = /^[a-zA-Z]+[' ']?[a-zA-Z]+$/;
   var username_v = document.getElementById("username").value;

   if (!username_validation.test(username_v)) {
       alert("Formato username non valido.");
       document.getElementById("username").focus();
       return false;
   }

   //Check campi vuoti
   if(username.value.trim() == ""){
       alert("Formato username scorretto!");
       document.getElementById("username").focus();
       return false;
   }

   if(password.value.trim() == ""){
       alert("Formato password scorretto!");
       document.getElementById("password").focus();
       return false; 
   }
}

function popupCentratoNick() {
   var w = 450;
   var h = 250;
   var l = Math.floor((screen.width-w)/2);
   var t = Math.floor((screen.height-h)/2);

   window.open("./recupero_username.php","","width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
}

function valida_aggiungi() {

   var data = document.getElementById("data_evento");       
   var today = new Date(); 

   var dataDiOggi = new Date(data.value);

   if (dataDiOggi < today) { 
       alert("Data dell'evento passata!");
       return false;
   } 

   var partecipanti = document.getElementById("maxpartecipanti");
   if( partecipanti.value < 0){
       alert("Inserire un valore valido di partecipanti!");
       return false;
   }
}

function valida_modifica() {
   var data = document.getElementById("data_evento");       
   var today = new Date(); 

   var dataDiOggi = new Date(data.value);

   if (dataDiOggi < today) { 
       alert("Data dell'evento passata!");
       return false;
   } 

   var partecipanti = document.getElementById("maxpartecipanti");
   if( partecipanti.value < 0){
       alert("Inserire un valore valido di partecipanti!");
       return false;
   }
}

function show(index){
      if(index == 1){
            showMenu();
      } else if(index == 2){
            showLineUp();
      } else if(index == 3){
            showGuest();
      }
}


function showMenu() {
      var allunga = document.getElementById("form-registrazione");
      allunga.style.height = "800px";
      var toShow = document.getElementById("show");
      var form = document.getElementById("container-home");

      if(toShow == null){
            toShow = document.createElement("div");
            toShow.id = "show";
            form.appendChild(toShow);
      }   

      var titoletto = document.createElement("h3");
      titoletto.textContent = "Pubblica un estratto del menù";
      toShow.appendChild(titoletto);

      for(var i = 0; i < 5; i++) {
            var menu = document.createElement("select");
            menu.id = "menuSelect" + i;
            menu.name = "menuSelect" + i;
            menu.setAttribute("class","menuSelect");

            var opzione = document.createElement("option");
            opzione.textContent = "Primo";
            opzione.value="primo";
            menu.appendChild(opzione);

            opzione = document.createElement("option");
            opzione.textContent = "Secondo";
            opzione.value="secondo";
            menu.appendChild(opzione);

            opzione = document.createElement("option");
            opzione.textContent = "Dolce";
            opzione.value="dolce";
            menu.appendChild(opzione);

            var pietanza = document.createElement("input");
            pietanza.placeholder = "Nome del piatto";
            pietanza.setAttribute("class","menuSelect");
            pietanza.name = "pietanza" + i;
            toShow.appendChild(pietanza);
            toShow.appendChild(menu);
            var acapo = document.createElement("br");
            toShow.appendChild(acapo);
      }  
}

function showLineUp() {
      var allunga = document.getElementById("form-registrazione");
      allunga.style.height = "800px";
      var toShow = document.getElementById("show");

      var form = document.getElementById("container-home");

      if(toShow == null){
            toShow = document.createElement("div");
            toShow.id = "show";
            form.appendChild(toShow);
      }

      var titoletto = document.createElement("h3");
      titoletto.textContent = "Pubblica i main guest";
      toShow.appendChild(titoletto);

      for(var i = 0; i < 5; i++) {
            var menu = document.createElement("select");
            menu.id = "lineUp" + i;
            menu.name = "lineUp" + i;
            menu.setAttribute("class","menuSelect");

            var opzione = document.createElement("option");
            opzione.textContent = "Rock";
            opzione.value="rock";
            menu.appendChild(opzione);

            opzione = document.createElement("option");
            opzione.textContent = "Folk";
            opzione.value="folk";
            menu.appendChild(opzione);

            opzione = document.createElement("option");
            opzione.textContent = "Rap";
            opzione.value="rap";
            menu.appendChild(opzione);

            opzione = document.createElement("option");
            opzione.textContent = "Jazz";
            opzione.value="jazz";
            menu.appendChild(opzione);

            opzione = document.createElement("option");
            opzione.textContent = "Classico";
            opzione.value="classico";
            menu.appendChild(opzione);

            var gruppo = document.createElement("input");
            gruppo.placeholder = "Nome del gruppo";
            gruppo.setAttribute("class","menuSelect");
            gruppo.name = "gruppo" + i;
            toShow.appendChild(gruppo);
            toShow.appendChild(menu);
            var acapo = document.createElement("br");
            toShow.appendChild(acapo);
      }  
}

function showGuest() {
      var allunga = document.getElementById("form-registrazione");
      allunga.style.height = "800px";

      var form = document.getElementById("container-home");

      var toShow = document.getElementById("show");
      if(toShow == null){
            toShow = document.createElement("div");
            toShow.id = "show";
            form.appendChild(toShow);
      }
      var titoletto = document.createElement("h3");
      titoletto.textContent = "Pubblica gli ospiti dell'evento";
      toShow.appendChild(titoletto);

      for(var i = 0; i < 5; i++) {
            var menu = document.createElement("select");
            menu.id = "guest" + i;
            menu.name = "guest" + i;
            menu.setAttribute("class","menuSelect");

            var opzione = document.createElement("option");
            opzione.textContent = "Cucina";
            opzione.value="cucina";
            menu.appendChild(opzione);

            opzione = document.createElement("option");
            opzione.textContent = "Moda";
            opzione.value="moda";
            menu.appendChild(opzione);

            opzione = document.createElement("option");
            opzione.textContent = "Attualità";
            opzione.value="attualita";
            menu.appendChild(opzione);

            opzione = document.createElement("option");
            opzione.textContent = "Musica";
            opzione.value="musica";
            menu.appendChild(opzione);

            opzione = document.createElement("option");
            opzione.textContent = "Ambiente";
            opzione.value="ambiente";
            menu.appendChild(opzione);

            var ospite = document.createElement("input");
            ospite.placeholder = "Nome dell'ospite";
            ospite.setAttribute("class","menuSelect");
            ospite.name = "ospite" + i;
            toShow.appendChild(ospite);
            toShow.appendChild(menu);
            var acapo = document.createElement("br");
            toShow.appendChild(acapo);
      }  
}

function removeMenu() {
      var menu = document.getElementById("show");
      menu.parentNode.removeChild(menu);
}

    
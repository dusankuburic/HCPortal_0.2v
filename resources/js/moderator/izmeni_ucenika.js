function validacija(ime,prezime,mesto_stanovanja,
    jmbg,ime_staratelja,prezime_staratelja,
    kontakt_telefon,korisnicko_ime){

var rezultat = true;


if(ime === '' ||  ime === null){
alert('Unesite ime');
rezultat = false;
}

else if(prezime === '' ||  prezime === null){
alert('Unesite prezime');
rezultat =  false;
}

else if(mesto_stanovanja === '' ||  mesto_stanovanja === null){
alert('Unesite Mesto stanovanja');
rezultat =  false;
}

else if(jmbg === '' ||  jmbg === null){
alert('Unesite jmbg');
rezultat =  false;
}

else if(ime_staratelja === '' ||  ime_staratelja === null){
alert('Unesite ime staratelja');
rezultat =  false;
}


else if(prezime_staratelja === '' ||  prezime_staratelja === null){
alert('Unesite prezime staratelja');
rezultat =  false;
}


else if(kontakt_telefon === '' ||  kontakt_telefon === null){
alert('Unesite kontakt telefon');
rezultat =  false;
}

else if(korisnicko_ime === '' ||  korisnicko_ime === null){
alert('Unesite korisnicko ime');
rezultat =  false;
}


return rezultat;
}




function izmeni_ucenika(){

    var ime = document.getElementById("ime").value;
    var prezime = document.getElementById("prezime").value;
    var mesto_stanovanja = document.getElementById("mesto_stanovanja").value;
    var jmbg = document.getElementById("jmbg").value;
    var ime_staratelja = document.getElementById("ime_staratelja").value;
    var prezime_staratelja = document.getElementById("prezime_staratelja").value;
    var kontakt_telefon = document.getElementById("kontakt_telefon").value;
    var korisnicko_ime = document.getElementById("kor_ime").value;
    var sifra_odeljenja = document.getElementById("odeljenje").value;
    var sifra_ucenika = document.getElementById("sifra").value;


    var rez = validacija(ime,prezime,mesto_stanovanja,
                        jmbg,ime_staratelja,prezime_staratelja,
                        kontakt_telefon,korisnicko_ime);

    if(rez == true){

   var ucenik = {
       "sifra": sifra_ucenika,
       "ime":ime,
       "prezime":prezime,
       "mesto_stanovanja":mesto_stanovanja,
       "jmbg":jmbg,
       "ime_staratelja":ime_staratelja,
       "prezime_staratelja":prezime_staratelja,
       "kontakt_telefon":kontakt_telefon,
       "sifra_odeljenja":sifra_odeljenja,
       "korisnicko_ime":korisnicko_ime,
   };


   xmlhttp = new XMLHttpRequest();
   ucenik_json = JSON.stringify(ucenik);


   xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
        alert(this.responseText);
    }
};
   
   xmlhttp.open("POST","../../../app/responders/moderator/izmeni_ucenika.php", true);
   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xmlhttp.send("ucen="+ucenik_json);

} 


return false;
    
}


function sva_odeljenja(){

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            var myObj = JSON.parse(this.responseText);

            if(myObj.length !== 0){
                var row = "";
        
            for(var i = 0; i < myObj.length; i++) {

                row += "<option value='"+ myObj[i]['sifra_odeljenja']+"'>" + myObj[i]['naziv'] + " </option>";
            }

            document.getElementById("odeljenje").innerHTML = row;
         } else {

            document.getElementById("greska").innerHTML = 
            `<div class="alert alert-danger text-center" role="alert">
                Trenutno nema unetih odeljenja
            </div>`;
         }
         
        }
    };

    xmlhttp.open("POST", "../../../app/responders/moderator/pregled_odeljenja.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}


function ucitaj_ucenika(){

    var sifra_ucenika = document.getElementById("sifra").value;
    var ucenik = {
        "sifra": sifra_ucenika
    };

    xmlhttp = new XMLHttpRequest();
    ucenik_json = JSON.stringify(ucenik);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            

            var myObj  = JSON.parse(this.responseText);

            document.getElementById("ime").value = myObj['ime'];
            document.getElementById("prezime").value = myObj['prezime'];
            document.getElementById("mesto_stanovanja").value = myObj['mesto_stanovanja'];
            document.getElementById("jmbg").value = myObj['jmbg'];
            document.getElementById("ime_staratelja").value = myObj['ime_staratelja'];
            document.getElementById("prezime_staratelja").value = myObj['prezime_staratelja'];
            document.getElementById("kontakt_telefon").value = myObj['kontakt_telefon'];
            document.getElementById("kor_ime").value = myObj['korisnicko_ime'];
            document.getElementById("odeljenje").value = myObj['sifra_odeljenja'];
            
        }
    };
    xmlhttp.open("POST","../../../app/responders/moderator/vrati_ucenika.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("ucen="+ucenik_json);
}


window.onload = sva_odeljenja();
window.onload = ucitaj_ucenika();

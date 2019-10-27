function resetuj_formu(){

    document.getElementById("ime").value = '';
    document.getElementById("prezime").value = '';
    document.getElementById("mesto_stanovanja").value = '';
    document.getElementById("jmbg").value = '';
    document.getElementById("ime_staratelja").value = '';
    document.getElementById("prezime_staratelja").value = '';
    document.getElementById("kontakt_telefon").value = '';
    document.getElementById("kor_ime").value = '';
    document.getElementById("sifra").value = '';
    document.getElementById("sifra_pot").value = '';


}


function validacija(ime,prezime,mesto_stanovanja,
                    jmbg,ime_staratelja,prezime_staratelja,
                    kontakt_telefon,korisnicko_ime,sifra, sifra_pot){

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
    else if(sifra === '' || sifra === null){
        alert('Unesite sifru');
        rezultat =  false;
    }

    else if(!(sifra === sifra_pot)){
        alert('Sifre se ne poklapaju');
        rezultat =  false;
    }

   return rezultat;


}





function dodaj_ucenika(){

    var ime = document.getElementById("ime").value;
    var prezime = document.getElementById("prezime").value;
    var mesto_stanovanja = document.getElementById("mesto_stanovanja").value;
    var jmbg = document.getElementById("jmbg").value;
    var ime_staratelja = document.getElementById("ime_staratelja").value;
    var prezime_staratelja = document.getElementById("prezime_staratelja").value;
    var kontakt_telefon = document.getElementById("kontakt_telefon").value;
    var korisnicko_ime = document.getElementById("kor_ime").value;
    var sifra = document.getElementById("sifra").value;
    var sifra_pot = document.getElementById("sifra_pot").value;


    var rez = validacija(ime,prezime,mesto_stanovanja,
                        jmbg,ime_staratelja,prezime_staratelja,
                        kontakt_telefon,korisnicko_ime,sifra, sifra_pot);

    if(rez == true){


   var ucenik = {
       "ime":ime,
       "prezime":prezime,
       "mesto_stanovanja":mesto_stanovanja,
       "jmbg":jmbg,
       "ime_staratelja":ime_staratelja,
       "prezime_staratelja":prezime_staratelja,
       "kontakt_telefon":kontakt_telefon,
       "korisnicko_ime":korisnicko_ime,
       "sifra":sifra
   };



   xmlhttp = new XMLHttpRequest();
   ucenik_json = JSON.stringify(ucenik);

   console.log(ucenik_json);

   xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

        console.log(this.responseText);
         if(this.responseText === 'radi') {
             alert('uspesno dodat ucenik');
             resetuj_formu();
         } else {
            alert('vec postoji');
         }

    }
};


   
   xmlhttp.open("POST","../../../app/responders/moderator/dodaj_ucenika.php", true);
   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xmlhttp.send("ucen="+ucenik_json);

} 


return false;

    
}
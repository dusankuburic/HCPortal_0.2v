
function validacija(ime,prezime,korisnicko_ime,sifra, sifra_pot){

    var rezultat = true;


    if(ime === '' ||  ime === null){
        alert('Unesite ime');
        rezultat = false;
    }

    else if(prezime === '' ||  prezime === null){
        alert('Unesite prezime');
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





function dodaj_moderatora(){

    var ime = document.getElementById("ime").value;
    var prezime = document.getElementById("prezime").value;
    var korisnicko_ime = document.getElementById("kor_ime").value;
    var sifra = document.getElementById("sifra").value;
    var sifra_pot = document.getElementById("sifra_pot").value;


    var rez = validacija(ime, prezime, korisnicko_ime, sifra, sifra_pot);

    if(rez == true){


   var moderator = {
       "ime":ime,
       "prezime":prezime,
       "korisnicko_ime":korisnicko_ime,
       "sifra":sifra
   };



   xmlhttp = new XMLHttpRequest();
   moderator_json = JSON.stringify(moderator);

   xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

        console.log(this.responseText);
         if(this.responseText === 'radi') {
             alert('uspesno dodat moderator');
         } else {
            alert('vec postoji');
         }

    }
};


   
   xmlhttp.open("POST","../../../app/responders/moderator/dodaj_moderatora.php", true);
   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xmlhttp.send("moder="+moderator_json);

} 


return false;

    
}
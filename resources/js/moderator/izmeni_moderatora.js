
function validacija(ime,prezime,korisnicko_ime){

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


   return rezultat;

}


function izmeni_moderatora(){

    var ime = document.getElementById("ime").value;
    var prezime = document.getElementById("prezime").value;
    var korisnicko_ime = document.getElementById("kor_ime").value;
    var sifra_moderatora = document.getElementById("sifra").value;



    var rez = validacija(ime, prezime, korisnicko_ime);

    if(rez == true){


   var moderator = {
       "sifra": sifra_moderatora,
       "ime":ime,
       "prezime":prezime,
       "korisnicko_ime":korisnicko_ime
   };


   xmlhttp = new XMLHttpRequest();
   moderator_json = JSON.stringify(moderator);

   xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

        alert(this.responseText);

    }
};

   xmlhttp.open("POST","../../../app/responders/moderator/izmeni_moderatora.php", true);
   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xmlhttp.send("moderat="+moderator_json);

} 

return false;
}


function ucitaj_moderatora(){

    var sifra_moderatora = document.getElementById("sifra").value;

    var moderator = {
        "sifra": sifra_moderatora
    };

    xmlhttp = new XMLHttpRequest();
    moderator_json = JSON.stringify(moderator);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            var myObj  = JSON.parse(this.responseText);

            document.getElementById("ime").value = myObj['ime'];
            document.getElementById("prezime").value = myObj['prezime'];
            document.getElementById("kor_ime").value = myObj['korisnicko_ime'];
        }
        
    };

    xmlhttp.open("POST","../../../app/responders/moderator/vrati_moderatora.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("moderat="+moderator_json);
}

window.onload = ucitaj_moderatora();

function validacija(ime,prezime,mesto_stanovanja,jmbg,korisnicko_ime){

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

    else if(korisnicko_ime === '' ||  korisnicko_ime === null){
        alert('Unesite korisnicko ime');
        rezultat =  false;
    }

   return rezultat;

}

function izmeni_profesora(){

    var ime = document.getElementById("ime").value;
    var prezime = document.getElementById("prezime").value;
    var mesto_stanovanja = document.getElementById("mesto_stanovanja").value;
    var jmbg = document.getElementById("jmbg").value;
    var korisnicko_ime = document.getElementById("kor_ime").value;
    var sifra_profesora = document.getElementById("sifra").value;



    var rez = validacija(ime, prezime, mesto_stanovanja, jmbg, korisnicko_ime);

    if(rez == true){


   var profesor = {
       "sifra": sifra_profesora,
       "ime":ime,
       "prezime":prezime,
       "mesto_stanovanja":mesto_stanovanja,
       "jmbg":jmbg,
       "korisnicko_ime":korisnicko_ime,
   };

   xmlhttp = new XMLHttpRequest();
   profesor_json = JSON.stringify(profesor);


   xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
        alert(this.responseText);
    }
};

   xmlhttp.open("POST","../../../app/responders/moderator/izmeni_profesora.php", true);
   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xmlhttp.send("profa="+profesor_json);
} 

return false;
}


function ucitaj_profesora(){

    var sifra_profesora = document.getElementById("sifra").value;
    var profesor = {
        "sifra": sifra_profesora
    };

    xmlhttp = new XMLHttpRequest();
    profesor_json = JSON.stringify(profesor);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            var myObj  = JSON.parse(this.responseText);

            document.getElementById("ime").value = myObj['ime'];
            document.getElementById("prezime").value = myObj['prezime'];
            document.getElementById("mesto_stanovanja").value = myObj['mesto_stanovanja'];
            document.getElementById("jmbg").value = myObj['jmbg'];
            document.getElementById("kor_ime").value = myObj['korisnicko_ime'];
        }
    };
    xmlhttp.open("POST","../../../app/responders/moderator/vrati_profesora.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("profa="+profesor_json);
}

window.onload = ucitaj_profesora();
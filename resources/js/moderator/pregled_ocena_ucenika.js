function ucitaj_ucenika(){

    var sifra_ucenika = document.getElementById("sifra_ucenika").value;
    var ucenik = {
        "sifra": sifra_ucenika
    };

    xmlhttp = new XMLHttpRequest();
    ucenik_json = JSON.stringify(ucenik);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            var row = '';
            var myObj  = JSON.parse(this.responseText);

    
            row += "<tr>";
            row += "<td>" + myObj['sifra_ucenika'] + "</td>";
            row += "<td>" + myObj['ime'] + "</td>";
            row += "<td>" + myObj['prezime'] + "</td>";
            row += "<td>" + myObj['mesto_stanovanja'] + "</td>";
            row += "<td>" + myObj['jmbg'] + "</td>";
            row += "<td>" + myObj['ime_staratelja'] + "</td>";
            row += "<td>" + myObj['prezime_staratelja'] + "</td>";
            row += "<td>" + myObj['kontakt_telefon'] + "</td>";
            row += "<td>" + myObj['korisnicko_ime'] + "</td>";
            row += "</tr>";

        
        document.getElementById("ucenik").innerHTML = row;
            
        }
    };
    xmlhttp.open("POST","../../../app/responders/moderator/vrati_ucenika.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("ucen="+ucenik_json);
}

function ucitaj_predmet(){

    var sifra_predmeta = document.getElementById("sifra_predmeta").value;
    var predmet = {
        "sifra": sifra_predmeta
    };

    xmlhttp = new XMLHttpRequest();
    predmet_json = JSON.stringify(predmet);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            var myObj  = JSON.parse(this.responseText);
            document.getElementById("naziv_predmeta").innerHTML = myObj['naziv']; 
        }
        
    };

    xmlhttp.open("POST","../../../app/responders/moderator/vrati_predmet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("predmet="+predmet_json);

}


function ucitaj_prvo_polugodiste(){

    var sifra_ucenika = document.getElementById("sifra_ucenika").value;
    var sifra_predmeta = document.getElementById("sifra_predmeta").value;
   
    var ucenik = {
        "sifra_ucenika": sifra_ucenika,
        "sifra_predmeta": sifra_predmeta,
        "polugodiste": 1
    };

    xmlhttp = new XMLHttpRequest();
    ucenik_json = JSON.stringify(ucenik);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            
            var row = '';
            var myObj  = JSON.parse(this.responseText);

            if(myObj.length !== 0){
                var row = "";
        
            for(var i = 0; i < myObj.length; i++) {

                row += "<tr>";
                row += "<td>" + myObj[i]['ocena'] + "</td>";
                row += "<td>" + myObj[i]['opis'] + "</td>";
                row += "<td>" + myObj[i]['datum_izmene'] + "</td>";
                row += "</tr>";

            }
        
            document.getElementById("prvo_polugodiste").innerHTML = row;
         }
        }
        
    };

    xmlhttp.open("POST","../../../app/responders/moderator/vrati_ocene_sa_polugodista.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("polugodiste="+ucenik_json);

}


function ucitaj_drugo_polugodiste(){

    var sifra_ucenika = document.getElementById("sifra_ucenika").value;
    var sifra_predmeta = document.getElementById("sifra_predmeta").value;
   

    var ucenik = {
        "sifra_ucenika": sifra_ucenika,
        "sifra_predmeta": sifra_predmeta,
        "polugodiste": 2
    };

    xmlhttp = new XMLHttpRequest();
    polugodiste_json = JSON.stringify(ucenik);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
                //var row = '';
                var myObj  = JSON.parse(this.responseText);
                

                if(myObj.length !== 0){
                    var row = "";
            
                for(var i = 0; i < myObj.length; i++) {

                    row += "<tr>";
                    row += "<td>" + myObj[i]['ocena'] + "</td>";
                    row += "<td>" + myObj[i]['opis'] + "</td>";
                    row += "<td>" + myObj[i]['datum_izmene'] + "</td>";
                    row += "</tr>";

                }
            
                document.getElementById("drugo_polugodiste").innerHTML = row;
            } 
            
        }
        
    };

    xmlhttp.open("POST","../../../app/responders/moderator/vrati_ocene_sa_polugodista.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("polugodiste="+polugodiste_json);

}



window.onload = ucitaj_ucenika();
window.onload = ucitaj_predmet();
window.onload = ucitaj_prvo_polugodiste();
window.onload = ucitaj_drugo_polugodiste();




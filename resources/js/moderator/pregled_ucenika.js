function svi_ucenici(){

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

           var myObj = JSON.parse(this.responseText);
            
            if(myObj.length !== 0){
                var row = "";
        
            for(var i = 0; i < myObj.length; i++) {

                row += "<tr>";
                row += "<td>" + myObj[i]['sifra_ucenika'] + "</td>";
                row += "<td>" + myObj[i]['ime'] + "</td>";
                row += "<td>" + myObj[i]['prezime'] + "</td>";
                row += "<td>" + myObj[i]['mesto_stanovanja'] + "</td>";
                row += "<td>" + myObj[i]['jmbg'] + "</td>";
                row += "<td>" + myObj[i]['ime_staratelja'] + "</td>";
                row += "<td>" + myObj[i]['prezime_staratelja'] + "</td>";
                row += "<td>" + myObj[i]['kontakt_telefon'] + "</td>";
                row += "<td>" + myObj[i]['korisnicko_ime'] + "</td>";
                row += "<td><input type='submit' value='Izmeni' class='btn btn-primary' onclick='ucitaj_ucenika("+ myObj[i]['sifra_ucenika']  +")'></td>";
                row += "</tr>";

            }

            document.getElementById("ucenici").innerHTML = row;
         } else {

            document.getElementById("greska").innerHTML = 
            `<div class="alert alert-danger text-center" role="alert">
                Trenutno nema unetih ucenika
            </div>`;
 
            
         }
         
        }
    };

    xmlhttp.open("POST", "../../../app/responders/moderator/pregled_ucenika.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}


function ucitaj_ucenika(sifra_ucenika){

    var ucenik = {
        "sifra": sifra_ucenika
    };


    xmlhttp = new XMLHttpRequest();
    ucenik_json = JSON.stringify(ucenik);

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            console.log(this.responseText);
            window.location.href = this.responseText;
        }
    };

    xmlhttp.open("POST","../../../app/responders/moderator/ucitaj_ucenika.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("ucen="+ucenik_json);
}


window.onload = svi_ucenici();
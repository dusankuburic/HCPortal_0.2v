

function svi_moderatori(){

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            var myObj = JSON.parse(this.responseText);
            
            
            if(myObj.length !== 0){
                var row = "";
        
            for(var i = 0; i < myObj.length; i++) {

                row += "<tr>";
                row += "<td>" + myObj[i]['sifra_moderatora'] + "</td>";
                row += "<td>" + myObj[i]['ime'] + "</td>";
                row += "<td>" + myObj[i]['prezime'] + "</td>";
                row += "<td>" + myObj[i]['korisnicko_ime'] + "</td>";
                row += "<td><input type='submit' value='Izmeni' class='btn btn-primary' onclick='ucitaj_moderatora("+ myObj[i]['sifra_moderatora']  +")'></td>";
                row += "</tr>";

            }

            document.getElementById("moderatori").innerHTML = row;
         } else {

            document.getElementById("greska").innerHTML = 
            `<div class="alert alert-danger text-center" role="alert">
                Trenutno nema unetih moderatora
            </div>`;     
         }   
        }
    };

    xmlhttp.open("POST", "../../../app/responders/moderator/pregled_moderatora.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}


function ucitaj_moderatora(sifra_moderatora){

    var moderator = {
        "sifra": sifra_moderatora
    };

    xmlhttp = new XMLHttpRequest();
    moderator_json = JSON.stringify(moderator);

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            console.log(this.responseText);
            window.location.href = this.responseText;
        }
    };

    xmlhttp.open("POST","../../../app/responders/moderator/ucitaj_moderatora.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("moderat="+moderator_json);
}

window.onload = svi_moderatori();
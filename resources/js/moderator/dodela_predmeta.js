

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
            var row = "";
    
            row += "<tr>";
            row += "<td>" + myObj['sifra_profesora'] + "</td>";
            row += "<td>" + myObj['ime'] + "</td>";
            row += "<td>" + myObj['prezime'] + "</td>";
            row += "<td>" + myObj['korisnicko_ime'] + "</td>";
            row += "<td>" + myObj['mesto_stanovanja'] + "</td>";
            row += "<td>" + myObj['jmbg'] + "</td>";
            row += "</tr>";


            document.getElementById("profesor").innerHTML = row;

        }
    };
    xmlhttp.open("POST","../../../app/responders/moderator/vrati_profesora.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("profa="+profesor_json);
}



function svi_predmeti(){

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            var myObj = JSON.parse(this.responseText);

            var novi_red = 0;
            const broj_elemenata_u_redu = 6;
            
            if(myObj.length !== 0){
                var row = "";
        
            for(var i = 0; i < myObj.length; i++) {

                row+=`<div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox"  name="ChPredmeti" id="prvi" value="${myObj[i]['sifra_predmeta']}">
                    <h5 class="form-check-label" for="inlineRadio1">${ myObj[i]['naziv']}</h5>
                    </div>`;

                novi_red++;
                if(novi_red == broj_elemenata_u_redu){
                    row+='<br><br>';
                    novi_red = 0;
                }
            }
            document.getElementById("predmeti").innerHTML = row;
         } else {

            document.getElementById("greska").innerHTML = 
            `<div class="alert alert-danger text-center" role="alert">
                Trenutno nema unetih predmeta
            </div>`;
 
            
         }
         
        }
    };

    xmlhttp.open("POST", "../../../app/responders/moderator/pregled_predmeta.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}




function sva_odeljenja(){

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            var myObj = JSON.parse(this.responseText);
            var novi_red = 0;
            const broj_elemenata_u_redu = 6;
            
            if(myObj.length !== 0){
                var row = "";
        
            for(var i = 0; i < myObj.length; i++) {

                row+=`<div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="ChOdeljenja" id="prvi" value="${myObj[i]['sifra_odeljenja']}">
                    <h5 class="form-check-label" for="inlineRadio1">${ myObj[i]['naziv']}</h5>
                    </div>`;

                novi_red++;
                if(novi_red == broj_elemenata_u_redu){
                    row+='<br><br>';
                    novi_red = 0;
                }
            }
            document.getElementById("odeljenja").innerHTML = row;
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


const pokupi_predmete = function(){
    let odabrani_predmeti = [];

    var predmeti_dom = document.getElementById("predmeti");
    var predmet = predmeti_dom.getElementsByTagName('input');
    for(var i = 0, len = predmet.length; i < len; i++){
        if(predmet[i].type == 'checkbox'){
            if(predmet[i].checked){
                odabrani_predmeti.push(predmet[i].value);
            }
        }
    }

    return odabrani_predmeti;
}

const pokupi_odeljenja = function(){
    let odabrana_odeljenja = [];

    var odeljenja_dom = document.getElementById("odeljenja");
    var odeljenje = odeljenja_dom.getElementsByTagName('input');
    for(var i = 0, len = odeljenje.length; i < len; i++){
        if(odeljenje[i].type == 'checkbox'){
            if(odeljenje[i].checked){
                odabrana_odeljenja.push(odeljenje[i].value);
            }
        }
    }

    return odabrana_odeljenja;
}



function dodeli_predmete(){

    let odabrani_predmeti = pokupi_predmete();
    let odabrana_odeljenja = pokupi_odeljenja();
    let sifra_profesora = document.getElementById("sifra").value;



    if(odabrana_odeljenja.length == 0 || odabrani_predmeti.length == 0){

        alert("Morate odabrati bar jedan predmet i bar jedno odeljenje");

    } else {

        var predmeti_profesora = {
            "sifra_profesora":sifra_profesora,
            "predmeti":odabrani_predmeti,
            "odeljenja":odabrana_odeljenja
        };
        

        xmlhttp = new XMLHttpRequest();
        var predmeti_profesora_json = JSON.stringify(predmeti_profesora);
        
        xmlhttp.onreadystatechange = function(){

            if(this.readyState == 4 && this.status == 200){
            
                alert(this.responseText);
            }
        };
    
        
        xmlhttp.open("POST","../../../app/responders/moderator/dodeli_predmete.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("predmeti_profesora="+predmeti_profesora_json);
        
    }

return false;
}

function ucitaj_dodeljene_predmete(){

    var sifra_profesora = document.getElementById("sifra").value;
    var profesor = {
        "sifra": sifra_profesora
    };

    xmlhttp = new XMLHttpRequest();
    profesor_json = JSON.stringify(profesor);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            var myObj  = JSON.parse(this.responseText);


            var predmeti_dom = document.getElementById("predmeti");
            var predmet_dom = predmeti_dom.getElementsByTagName('input');

            var odeljenja_dom = document.getElementById("odeljenja");
            var odeljenje_dom = odeljenja_dom.getElementsByTagName('input');


            for(var j = 0; j < myObj['predmeti'].length; j++) {
                for(var i = 0, len = predmet_dom.length; i < len; i++){
                    if(predmet_dom[i].type == 'checkbox'){
                        if(predmet_dom[i].value == myObj['predmeti'][j].sifra_predmeta){
                            predmet_dom[i].checked = true;
                        }
                    }
                }
            }
        

                
            for(var j = 0; j < myObj['odeljenja'].length; j++) {
                for(var i = 0, len = odeljenje_dom.length; i < len; i++){
                    if(odeljenje_dom[i].type == 'checkbox'){
                        if(odeljenje_dom[i].value == myObj['odeljenja'][j].sifra_odeljenja){
                            odeljenje_dom[i].checked = true;
                        }
                    }
                }
            }   
        

        }
    };
    xmlhttp.open("POST","../../../app/responders/moderator/vrati_predmete_profesora.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("profa="+profesor_json);

}


window.onload = ucitaj_profesora();
window.onload = svi_predmeti();
window.onload = sva_odeljenja();
window.onload = ucitaj_dodeljene_predmete();
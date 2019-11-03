function svi_predmeti(){

    var sifra = document.getElementById("sifra").value;

    var ucenik = {
        "sifra": sifra
    };

    var xmlhttp = new XMLHttpRequest();
    ucenik_json = JSON.stringify(ucenik);

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            
            var myObj = JSON.parse(this.responseText);
            console.log(myObj);
            
            if(myObj.length !== 0){
                var row = "";
        
            for(var i = 0; i < myObj.length; i++) {

                row += "<tr>";
                row += "<td>" + myObj[i]['sifra_predmeta'] + "</td>";
                row += "<td>" + myObj[i]['naziv'] + "</td>";
                row += "<td><input type='submit' value='Izmeni' class='btn btn-primary' onclick='ucitaj_predmet("+ myObj[i]['sifra_predmeta']  +")'></td>";
                row += "</tr>";

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

    xmlhttp.open("POST", "../../../app/responders/moderator/pregled_predmeta_ucenika.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("ucen="+ucenik_json);
}

function ucitaj_predmet(sifra_predmeta){

    var predmet = {
        "sifra": sifra_predmeta
    };

    xmlhttp = new XMLHttpRequest();
    predmet_json = JSON.stringify(predmet);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
          
            console.log(this.responseText);
            window.location.href = this.responseText;

            
        }
        
    };


    xmlhttp.open("POST","../../../app/responders/moderator/ucitaj_predmet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("predmet="+predmet_json);

}

window.onload = svi_predmeti();
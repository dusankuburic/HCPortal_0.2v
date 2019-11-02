
function sva_odeljenja(){

    var razred = document.getElementById("razred").value;

    var odeljenje = {
        "razred": razred
    };

    var xmlhttp = new XMLHttpRequest();
    odeljenje_json = JSON.stringify(odeljenje);

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            console.log(this.responseText);
            var myObj = JSON.parse(this.responseText);
            
            
            if(myObj.length !== 0){
                var row = "";
        

            for(var i = 0; i < myObj.length; i++) {

                row += "<tr>";
                row += "<td>" + myObj[i]['sifra_odeljenja'] + "</td>";
                row += "<td>" + myObj[i]['naziv'] + "</td>";
                row += "<td><input type='submit' value='Pregledaj' class='btn btn-primary' onclick='ucitaj_odeljenje("+ myObj[i]['sifra_odeljenja']  +")'></td>";
                row += "</tr>";

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

    xmlhttp.open("POST", "../../../app/responders/moderator/pregled_odeljenja_sa_razredom.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("razred="+odeljenje_json);
}


function ucitaj_odeljenje(sifra_odeljenja){

    var odeljenje = {
        "sifra": sifra_odeljenja
    };

    xmlhttp = new XMLHttpRequest();
    odeljenje_json = JSON.stringify(odeljenje);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
          
            console.log(this.responseText);
            window.location.href = this.responseText;

            
        }
        
    };


    xmlhttp.open("POST","../../../app/responders/moderator/ucitaj_odeljenje_sa_ucenicima.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("odeljenje="+odeljenje_json);

}

window.onload = sva_odeljenja();
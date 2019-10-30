function svi_profesori(){

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            var myObj = JSON.parse(this.responseText);
            
            
            if(myObj.length !== 0){
                var row = "";
        
            for(var i = 0; i < myObj.length; i++) {

                row += "<tr>";
                row += "<td>" + myObj[i]['sifra_profesora'] + "</td>";
                row += "<td>" + myObj[i]['ime'] + "</td>";
                row += "<td>" + myObj[i]['prezime'] + "</td>";
                row += "<td>" + myObj[i]['mesto_stanovanja'] + "</td>";
                row += "<td>" + myObj[i]['jmbg'] + "</td>";
                row += "<td>" + myObj[i]['korisnicko_ime'] + "</td>";
                row += "<td><input type='submit' value='Izmeni' class='btn btn-primary' onclick='ucitaj_profesora("+ myObj[i]['sifra_profesora']  +")'></td>";
                row += "</tr>";

            }

            document.getElementById("profesori").innerHTML = row;
         } else {

            document.getElementById("greska").innerHTML = 
            `<div class="alert alert-danger text-center" role="alert">
                Trenutno nema unetih profesora
            </div>`;
 
            
         }
         
        }
    };

    xmlhttp.open("POST", "../../../app/responders/moderator/pregled_profesora.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}


function ucitaj_profesora(sifra_profesora){

    var profesor = {
        "sifra": sifra_profesora
    };


    xmlhttp = new XMLHttpRequest();
    profesor_json = JSON.stringify(profesor);

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            console.log(this.responseText);
            window.location.href = this.responseText;
        }
    };

    xmlhttp.open("POST","../../../app/responders/moderator/ucitaj_profesora.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("profa="+profesor_json);
}


window.onload = svi_profesori();


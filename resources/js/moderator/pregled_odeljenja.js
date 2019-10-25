

function sva_odeljenja(){

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            var myObj = JSON.parse(this.responseText);
            
            
            if(myObj.length !== 0){
                var row = "";
        
            for(var i = 0; i < myObj.length; i++) {

                row += "<tr>";
                row += "<td>" + myObj[i]['sifra_odeljenja'] + "</td>";
                row += "<td>" + myObj[i]['naziv'] + "</td>";
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

    xmlhttp.open("POST", "../../../app/responders/moderator/pregled_odeljenja.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}

window.onload = sva_odeljenja();
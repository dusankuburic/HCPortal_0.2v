
function izmeni_odeljenje(){

    var sifra_odeljenja = document.getElementById("sifra").value;
    var naziv = document.getElementById("naziv").value;

    var odeljenje = {
        "sifra": sifra_odeljenja,
        "naziv": naziv
    };

    xmlhttp = new XMLHttpRequest();
    odeljenje_json = JSON.stringify(odeljenje);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            alert(this.responseText);

            
        }
        
    };


    xmlhttp.open("POST","../../../app/responders/moderator/izmeni_odeljenje.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("odeljenje="+odeljenje_json);
    
}



function ucitaj_odeljenje(){

    var sifra_odeljenja = document.getElementById("naziv").value;

    var odeljenje = {
        "sifra": sifra_odeljenja
    };

    xmlhttp = new XMLHttpRequest();
    odeljenje_json = JSON.stringify(odeljenje);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            console.log(this.responseText);

            var myObj  = JSON.parse(this.responseText);
            document.getElementById("naziv").value = myObj['naziv'];
            document.getElementById("sifra").value = myObj['sifra_odeljenja'];

           
        }
        
    };


    xmlhttp.open("POST","../../../app/responders/moderator/vrati_odeljenje.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("odeljenje="+odeljenje_json);

}

window.onload = ucitaj_odeljenje();


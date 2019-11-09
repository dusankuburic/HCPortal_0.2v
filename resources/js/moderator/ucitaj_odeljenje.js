
function ucitaj_odeljenje(sifra_odeljenja){

    var odeljenje = {
        "sifra": sifra_odeljenja
    };

    xmlhttp = new XMLHttpRequest();
    odeljenje_json = JSON.stringify(odeljenje);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            console.log(this.responseText);      
        }
        
    };


    xmlhttp.open("POST","../../../app/responders/moderator/ucitaj_odeljenje.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("odeljenje="+odeljenje_json);

}

window.onload = ucitaj_odeljenje();
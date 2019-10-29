function izmeni_predmet(){

    var sifra_predmeta = document.getElementById("sifra").value;
    var naziv = document.getElementById("naziv").value;

    var predmet = {
        "sifra": sifra_predmeta,
        "naziv": naziv
    };

    xmlhttp = new XMLHttpRequest();
    predmet_json = JSON.stringify(predmet);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            alert(this.responseText);

            
        }
        
    };


    xmlhttp.open("POST","../../../app/responders/moderator/izmeni_predmet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("predmet="+predmet_json);
    
}



function ucitaj_predmet(){

    var sifra_predmeta = document.getElementById("naziv").value;

    var predmet = {
        "sifra": sifra_predmeta
    };

    xmlhttp = new XMLHttpRequest();
    predmet_json = JSON.stringify(predmet);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            console.log(this.responseText);

            var myObj  = JSON.parse(this.responseText);
            document.getElementById("naziv").value = myObj['naziv'];
            document.getElementById("sifra").value = myObj['sifra_predmeta'];

           
        }
        
    };


    xmlhttp.open("POST","../../../app/responders/moderator/vrati_predmet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("predmet="+predmet_json);

}

window.onload = ucitaj_predmet();


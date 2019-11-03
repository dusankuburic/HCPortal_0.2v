function razredi(){

    var prvi = document.getElementById("prvi");
    var drugi = document.getElementById("drugi");
    var treci = document.getElementById("treci");
    var cetvrti = document.getElementById("cetvrti");

    var rezultat = '';


    if(prvi.checked){
        rezultat = prvi.value;
    }
    if(drugi.checked){
        rezultat =  drugi.value;
    }
    if(treci.checked){
        rezultat =  treci.value;
    }
    if(cetvrti.checked){
        rezultat = cetvrti.value;
    }


    return rezultat;
}



function izmeni_predmet(){

    var sifra_predmeta = document.getElementById("sifra").value;
    var naziv = document.getElementById("naziv").value;
    var razred = razredi();

    var predmet = {
        "sifra": sifra_predmeta,
        "naziv": naziv,
        "razred": razred
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

function postavi_razred_predmeta(razred){

    if(razred == 1){
        document.getElementById("prvi").checked = true;
    } else if(razred == 2) {
        document.getElementById("drugi").checked = true;
    } else if(razred == 3) {
        document.getElementById("treci").checked = true;
    } else if (razred == 4) {
        document.getElementById("cetvrti").checked = true;
    }
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
            postavi_razred_predmeta(myObj['razred']);
           
        }
        
    };


    xmlhttp.open("POST","../../../app/responders/moderator/vrati_predmet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("predmet="+predmet_json);

}

window.onload = ucitaj_predmet();


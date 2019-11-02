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



function izmeni_odeljenje(){

    var sifra_odeljenja = document.getElementById("sifra").value;
    var naziv = document.getElementById("naziv").value;
    var razred = razredi();

    var odeljenje = {
        "sifra": sifra_odeljenja,
        "naziv": naziv,
        "razred": razred
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


function postavi_razred_odljenja(razred){

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


function ucitaj_odeljenje(){

    var sifra_odeljenja = document.getElementById("naziv").value;

    var odeljenje = {
        "sifra": sifra_odeljenja
    };

    xmlhttp = new XMLHttpRequest();
    odeljenje_json = JSON.stringify(odeljenje);
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            var myObj  = JSON.parse(this.responseText);
            document.getElementById("naziv").value = myObj['naziv'];
            document.getElementById("sifra").value = myObj['sifra_odeljenja'];
            postavi_razred_odljenja(myObj['razred']);

           
        }
        
    };


    xmlhttp.open("POST","../../../app/responders/moderator/vrati_odeljenje.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("odeljenje="+odeljenje_json);

}

window.onload = ucitaj_odeljenje();


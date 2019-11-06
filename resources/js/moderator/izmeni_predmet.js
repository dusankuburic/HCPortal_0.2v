function razredi(){

    var prvi = document.getElementById("prvi");
    var drugi = document.getElementById("drugi");
    var treci = document.getElementById("treci");
    var cetvrti = document.getElementById("cetvrti");

    var rezultat = [];


    if(prvi.checked){
        rezultat.push(prvi.value);
    }
    if(drugi.checked){
        rezultat.push(drugi.value);
    }
    if(treci.checked){
        rezultat.push(treci.value);
    }
    if(cetvrti.checked){
        rezultat.push(cetvrti.value);
    }


    return rezultat;
}

function validacija(naziv_predmeta){

    var rezultat = true;

    if(naziv_predmeta === '' || naziv_predmeta === null){
        alert('morate popuniti polje');
        rezultat = false;
    }


    return rezultat;
}



function izmeni_predmet(){

    var sifra_predmeta = document.getElementById("sifra").value;
    var naziv_predmeta = document.getElementById("naziv").value;
    var razred = razredi();
    var rez = validacija(naziv_predmeta);




    if(rez === true){
        if(razred.length != 0){


            var predmet = {
                "sifra": sifra_predmeta,
                "naziv": naziv_predmeta,
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
        else {
            alert('Morate odabrati bar jedan razred');
        }
    }
                
}



function postavi_razred_predmeta(razredi){
    for(i = 0; i < razredi.length; i++){
        if(razredi[i]['razred'] == 1){
            document.getElementById("prvi").checked = true;
        }  
        if(razredi[i]['razred'] == 2) {
            document.getElementById("drugi").checked = true;
        }  
        if(razredi[i]['razred'] == 3) {
            document.getElementById("treci").checked = true;
        }  
        if (razredi[i]['razred'] == 4) {
            document.getElementById("cetvrti").checked = true;
        }
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
            
        
            var myObj  = JSON.parse(this.responseText);
            
            document.getElementById("naziv").value = myObj[0]['naziv'];
            document.getElementById("sifra").value = myObj[0]['sifra_predmeta'];
            postavi_razred_predmeta(myObj[1]);
  
        }
        
    };


    xmlhttp.open("POST","../../../app/responders/moderator/vrati_predmet_razred.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("predmet="+predmet_json);

}

window.onload = ucitaj_predmet();


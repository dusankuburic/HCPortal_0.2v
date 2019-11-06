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







function dodaj_predmet(){

    var naziv_predmeta = document.getElementById("naziv").value;
    var rez = validacija(naziv_predmeta);
    var razred = razredi();


    if(rez === true){
        if(razred.length != 0){

            var predmet = {
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


            xmlhttp.open("POST","../../../app/responders/moderator/dodaj_predmet.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("predmet="+predmet_json);
            
        } else {
            alert('Morate odabrati bar jedan razred');
        }
    } 

 


    return false;
    
}




function validacija(naziv_predmeta){

    var rezultat = true;

    if(naziv_predmeta === '' || naziv_predmeta === null){
        alert('morate popuniti polje');
        rezultat = false;
    }

    return rezultat;
}

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





function dodaj_predmet(){

    var naziv_predmeta = document.getElementById("naziv").value;
    var rez = validacija();
    var razred = razredi();



    if(rez == true){


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

    }

    return false;
    
}



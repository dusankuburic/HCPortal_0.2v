
function validacija(naziv_odeljenja){

    var rezultat = true;

    if(naziv_odeljenja === '' || naziv_odeljenja === null){
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


function dodaj_odeljenje(){

    var naziv_odeljenja = document.getElementById("naziv").value;
    var rez = validacija();
    var razred = razredi();


    if(rez == true){
         
    var odejenje = {
        "naziv": naziv_odeljenja,
        "razred": razred
    };

    xmlhttp = new XMLHttpRequest();
    odeljenje_json = JSON.stringify(odejenje);

    console.log(odeljenje_json);

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

             alert(this.responseText);

        }
    };

    xmlhttp.open("POST","../../../app/responders/moderator/dodaj_odeljenje.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("odeljenje="+odeljenje_json);
    }


    return false;
}



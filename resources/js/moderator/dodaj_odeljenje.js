
function validacija(naziv_odeljenja){

    var rezultat = true;

    if(naziv_odeljenja === '' || naziv_odeljenja === null){
        alert('morate popuniti polje');
        rezultat = false;
    }

    return rezultat;
}


function dodaj_odeljenje(){

    var naziv_odeljenja = document.getElementById("naziv").value;

    var rez = validacija(naziv_odeljenja);

    if(rez == true){
         
    var odejenje = {
        "naziv": naziv_odeljenja
    };

    xmlhttp = new XMLHttpRequest();
    odeljenje_json = JSON.stringify(odejenje);


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



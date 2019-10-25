
function dodaj_odeljenje(){

    var naziv_odeljenja = document.getElementById("naziv").value;

    if(naziv_odeljenja === '' || naziv_odeljenja === null){
    
            alert('morate popuniti polje');
            
    } else {

    var odejenje = {
        "naziv": naziv_odeljenja
    };

    xmlhttp = new XMLHttpRequest();
    odeljenje_json = JSON.stringify(odejenje);


    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            console.log(this.responseText);
             if(this.responseText === 'radi') {
                 alert('uspesno dodato odeljenje');
             } else {
                alert('vec postoji odeljenje sa tim imenom');
             }

        }
    };



    xmlhttp.open("POST","../../../app/responders/moderator/dodaj_odeljenje.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("odeljenje="+odeljenje_json);
    }
}



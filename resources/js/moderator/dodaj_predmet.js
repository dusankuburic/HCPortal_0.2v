
function dodaj_predmet(){

    var naziv_predmeta = document.getElementById("naziv").value;

    if(naziv_predmeta === '' || naziv_predmeta === null){
    
            alert('morate popuniti polje');
            
    } else {

    var predmet = {
        "naziv": naziv_predmeta
    };

    xmlhttp = new XMLHttpRequest();
    predmet_json = JSON.stringify(predmet);


    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            console.log(this.responseText);
             if(this.responseText === 'radi') {
                 alert('uspesno dodat predmet');
             } else {
                alert('vec postoji predmet sa tim imenom');
             }

        }
    };



    xmlhttp.open("POST","../../../app/responders/moderator/dodaj_predmet.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("predmet="+predmet_json);
    }
}



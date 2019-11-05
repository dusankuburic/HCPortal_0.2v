function pokupi_opis(){

    var opis = document.getElementById("opis").value;

    if(opis == 1){
        opis = "Kontrolni zadatak";
    }
    if(opis == 2){
        opis = "Pismeni zadatak";
    }
    if(opis == 3){
        opis = "Usmeno odgovaranje";
    }
    if(opis == 4){
        opis = "Aktivnost na nastavi";
    }

    return opis;

}


function upisi_ocenu(){
    var sifra_predmeta = document.getElementById("sifra_predmeta").value;
    var sifra_ucenika = document.getElementById("sifra_ucenika").value;
    var opis = pokupi_opis();
    var ocena = document.getElementById("ocena").value;
    var polugodiste = document.getElementById("polugodiste").value;


    var za_upis = {
        "sifra_predmeta":sifra_predmeta,
        "sifra_ucenika":sifra_ucenika,
        "ocena":ocena,
        "opis":opis,
        "polugodiste":polugodiste
    };


    xmlhttp = new XMLHttpRequest();
    za_upis_json = JSON.stringify(za_upis);

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            alert(this.responseText);

        }

        
    };

    xmlhttp.open("POST","../../../app/responders/moderator/upisi_ocenu.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("za_upis="+za_upis_json);
}


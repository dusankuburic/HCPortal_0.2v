function login_user(){

    //validacija
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    

    var user_obj = {
        "korisnicko_ime": username,
        "sifra": password
    };

    xmlhttp = new XMLHttpRequest();
    user_obj_json = JSON.stringify(user_obj);

    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
     
            if(this.responseText === 'greska'){
                alert('Nepostoji takav moderator u bazi');
            } else {
                window.location.href = this.responseText;
            }   
        }
    };
    

    xmlhttp.open("POST","../../../app/responders/prijava/prijava_moderator.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("user="+user_obj_json);
}
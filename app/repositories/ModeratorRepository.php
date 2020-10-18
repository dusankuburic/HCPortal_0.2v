<?php 
require_once("interfaces/IModerator.php");
require_once("../../models/Moderator.php");

class ModeratorRepository implements IModerator {

    private $ctx;

    public function __construct($ctx_){
        $this->ctx = $ctx_;
    }

    public function prijava($podaci_korisnika){

        $request = json_decode($podaci_korisnika, false);

        $korisnicko_ime = $request->korisnicko_ime;
        $sifra = $request->sifra;

        $stanje_prijave = false;
        $rezultat_upita = [];

        $upit = $this->ctx->set_query("SELECT * FROM moderator WHERE korisnicko_ime = '{$korisnicko_ime}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if(!empty($rezultat_upita)){

            $tek_korisnicko_ime = $rezultat_upita['korisnicko_ime'];
            $tek_sifra = $rezultat_upita['sifra'];

            if($korisnicko_ime === $tek_korisnicko_ime && password_verify($sifra, $tek_sifra)){
                $stanje_prijave = true;
            }
        }

        $response = array("stanje_prijave" => $stanje_prijave, "korisnicko_ime" => $korisnicko_ime);

        return $response;
    }

    public function svi_moderatori(){
        
        $rezultat_upita = [];
        $upit =  $this->ctx->set_query("SELECT * FROM moderator");
        
        while($red = $upit->fetch_assoc()){
            $moderator = new Moderator();

            $moderator->sifra_moderatora = $red["sifra_moderatora"];
            $moderator->ime = $red["ime"];
            $moderator->prezime = $red["prezime"];
            $moderator->korisnicko_ime = $red["korisnicko_ime"];
            $moderator->sifra = $red["sifra"];
            
            $rezultat_upita[] = $moderator;
        }

        return $rezultat_upita;
    }

    public function dodaj_moderatora($podaci_korisnika){
        
        $rezultat_upita = [];
        $moderator_postoji = true;
        $moderator = new Moderator();
        
        $request = json_decode($podaci_korisnika, false);
        
        $moderator->ime = $request->ime;
        $moderator->prezime = $request->prezime;
        $moderator->korisnicko_ime = $request->korisnicko_ime;
        $moderator->sifra = password_hash($request->sifra, PASSWORD_DEFAULT);

        $upit = $this->ctx->set_query("SELECT * FROM moderator
                WHERE korisnicko_ime = '{$moderator->korisnicko_ime}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if(empty($rezultat_upita)){

            $upit = $this->ctx->prepare_query("INSERT INTO moderator(
                ime,
                prezime,
                korisnicko_ime,
                sifra)
                VALUES(?, ?, ?, ?)");

            $upit->bind_param("ssss",
                $moderator->ime,
                $moderator->prezime,
                $moderator->korisnicko_ime,
                $moderator->sifra);

            $upit->execute();
            $moderator_postoji = false;
        }          
            return $moderator_postoji;   
    }  

    public function izmeni_moderatora($podaci_korisnika){

        $rezultat_upita = [];
        $rezultat = [];
        $poruka = "prazna";
        $moderator = new Moderator();

        $request = json_decode($podaci_korisnika, false);

        $moderator->sifra_moderatora = $request->sifra;
        $moderator->ime = $request->ime;
        $moderator->prezime = $request->prezime;
        $moderator->korisnicko_ime = $request->korisnicko_ime;

        $upit =  $this->ctx->set_query("SELECT * FROM moderator 
                WHERE sifra_moderatora = '{$moderator->sifra_moderatora}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }
 
        if($rezultat_upita){
                if($moderator->korisnicko_ime !==  $rezultat_upita['korisnicko_ime']){

                $upit = $this->ctx->set_query("SELECT * FROM moderator 
                        WHERE korisnicko_ime = '{$moderator->korisnicko_ime}'");
                
                while($red = $upit->fetch_assoc()){
                    $rezultat = $red;
                }
          
                    if($rezultat){
                        $poruka = "Vec postoji moderator sa odabranim korisnickim imenom";    
                    } else {
                        $upit = $this->ctx->prepare_query("UPDATE moderator SET
                            ime = (?),
                            prezime = (?),
                            korisnicko_ime = (?)
                            WHERE sifra_moderatora = {$moderator->sifra_moderatora}");
                
                        $upit->bind_param("sss", 
                            $moderator->ime, 
                            $moderator->prezime,
                            $moderator->korisnicko_ime);
                    
                        $upit->execute();
                        $poruka = "Uspesno izmenjen moderator";
                    }
 
            } else  {
                $upit = $this->ctx->prepare_query("UPDATE moderator SET
                    ime = (?),
                    prezime = (?),
                    korisnicko_ime = (?)
                    WHERE sifra_moderatora = {$moderator->sifra_moderatora}");
            
                $upit->bind_param("sss", 
                    $moderator->ime, 
                    $moderator->prezime,
                    $moderator->korisnicko_ime);
            
                $upit->execute();
                $poruka = "Uspesno izmenjen moderator";
            }
        } else {
            $poruka = "Nema takvog moderatora u bazi";
        }

        return $poruka;
    }

    public function sa_sifrom($podaci_korisnika){

        $request = json_decode($podaci_korisnika, false);
        $podaci = [];
       
        $sifra_moderatora = $request->sifra;

        $upit = "SELECT sifra_moderatora, ime, prezime, korisnicko_ime 
                FROM moderator WHERE 
                sifra_moderatora = '{$sifra_moderatora}'";
        
        $rezultat_upita = mysqli_query($this->ctx->get_connection(), $upit);
        $broj_redova = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $broj_redova; $i++){
            $podaci = mysqli_fetch_assoc($rezultat_upita);
        }

        return $podaci;
    }
}
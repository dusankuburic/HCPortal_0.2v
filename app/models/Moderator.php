<?php
require_once("Database.php");

class Moderator extends Database {

    private $sifra_moderatora;

    private $ime;

    private $prezime;

    public $korisnicko_ime;

    private $sifra;

    private $datum_rodjenja;


    public function __construct(){

        $this->set_parameters(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $this->connect_to_db();

        $this->test_connection();
    }


    public function pripremi_parametre_za_prijavu($podaci_korisnika){

        $korisnik = json_decode($podaci_korisnika, false);

        $this->korisnicko_ime = $korisnik->korisnicko_ime;

        $this->sifra = $korisnik->sifra;
    
    }


    
    public function prijava(){

        $stanje_prijave = false;
        $rezultat_upita = [];

        $upit = $this->set_query("SELECT * FROM moderator WHERE korisnicko_ime = '{$this->korisnicko_ime}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }


        if(!empty($rezultat_upita)){

            $tek_korisnicko_ime = $rezultat_upita['korisnicko_ime'];
            $tek_sifra = $rezultat_upita['sifra'];

            if($tek_korisnicko_ime === $this->korisnicko_ime && password_verify($this->sifra,$tek_sifra)){
                $stanje_prijave = true;
            }
        }

        return $stanje_prijave;
    }


    public function dodaj_moderatora($podaci_korisnika){
        
        $rezultat_upita = [];
        $moderator_postoji = true;
        
        $moderator = json_decode($podaci_korisnika, false);
        
        $this->ime = $moderator->ime;
        $this->prezime = $moderator->prezime;
        $this->korisnicko_ime = $moderator->korisnicko_ime;
        $this->sifra = password_hash($moderator->sifra, PASSWORD_DEFAULT);

        $upit = $this->set_query("SELECT * FROM moderator
                WHERE korisnicko_ime = '{$this->korisnicko_ime}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }


        if(empty($rezultat_upita)){

            $upit = $this->prepare_query("INSERT INTO moderator(
                ime,
                prezime,
                korisnicko_ime,
                sifra)
                VALUES(?, ?, ?, ?)");

            $upit->bind_param("ssss",
                $this->ime,
                $this->prezime,
                $this->korisnicko_ime,
                $this->sifra);

            $upit->execute();

            $moderator_postoji = false;
        }
            
            return $moderator_postoji;
     
    }


    public function izmeni_moderatora($podaci_korisnika){

        $rezultat_upita = [];
        $rezultat = [];
        $poruka = "prazna";

        $moderator = json_decode($podaci_korisnika, false);

        $this->sifra_moderatora = $moderator->sifra;
        $this->ime = $moderator->ime;
        $this->prezime = $moderator->prezime;
        $this->korisnicko_ime = $moderator->korisnicko_ime;


        //DA LI POSTOJI MODERATOR
        $upit =  $this->set_query("SELECT * FROM moderator 
                WHERE sifra_moderatora = '{$this->sifra_moderatora}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }
        //TODO: ...
        //AKO POSTOJI
        if($rezultat_upita){
                //AKO KORISNIK ZELI DA IZMENI KOR_IME PROVERI DA LI VEC NEKO IMA
                //TAKVO KORISNICKO_IME
                if($this->korisnicko_ime !==  $rezultat_upita['korisnicko_ime']){

                $upit = $this->set_query("SELECT * FROM moderator 
                        WHERE korisnicko_ime = '{$this->korisnicko_ime}'");
                
                while($red = $upit->fetch_assoc()){
                    $rezultat = $red;
                }
                //AKO POSTOJI VRATI PORUKU
                    if($rezultat){
                        $poruka = "Vec postoji moderator sa odabranim korisnickim imenom";
                        // U DRUGOM SLUCAJU IZMENI
                    } else {

                        $upit = $this->prepare_query("UPDATE moderator SET
                        ime = (?),
                        prezime = (?),
                        korisnicko_ime = (?)
                        WHERE sifra_moderatora = {$this->sifra_moderatora}");
                
                        $upit->bind_param("sss", 
                                $this->ime, 
                                $this->prezime,
                                $this->korisnicko_ime);
                        
                        $upit->execute();

                        $poruka = "Uspesno izmenjen moderator";
                    }
            //KORISNICKO IME NIJE MENJANO
            } else  {
                $upit = $this->prepare_query("UPDATE moderator SET
                ime = (?),
                prezime = (?),
                korisnicko_ime = (?)
                WHERE sifra_moderatora = {$this->sifra_moderatora}");
        
                $upit->bind_param("sss", 
                        $this->ime, 
                        $this->prezime,
                        $this->korisnicko_ime);
                
                $upit->execute();

                $poruka = "Uspesno izmenjen moderator";
            }
        } else {
            $poruka = "Nema takvog moderatora u bazi";
        }

        return $poruka;
    }





    public function svi_moderatori(){
        
        $rezultat_upita = [];

        $upit =  $this->set_query("SELECT * FROM moderator");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita[] = $red;
        }

        return $rezultat_upita;
    }


    public function sa_sifrom($podaci_korisnika){

        $moderator = json_decode($podaci_korisnika, false);
        $podaci = [];
       
        
        $this->sifra_moderatora = $moderator->sifra;


        $upit = "SELECT sifra_moderatora, ime, prezime, korisnicko_ime 
                FROM moderator WHERE 
                sifra_moderatora = '{$this->sifra_moderatora}'";
        
        $rezultat_upita = mysqli_query($this->connection, $upit);
        $redovi = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $redovi; $i++){
            $podaci = mysqli_fetch_assoc($rezultat_upita);
        }

        return $podaci;

    }






}
<?php
require_once("Database.php");

class Ucenik extends Database {

    private $sifra_ucenika;

    private $ime;

    private $prezime;

    public $korisnicko_ime;

    private $sifra;

    private $datum_rodjenja;

    private $mesto_stanovanja;

    private $jmbg;

    private $pol;

    private $ime_staratelja;

    private $prezime_staratelja;

    private $sifra_odeljenja;

    private $kontakt_telefon;



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


        $upit = $this->set_query("SELECT * FROM ucenik WHERE korisnicko_ime = '{$this->korisnicko_ime}'");

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


    public function dodaj_ucenika($podaci_korisnika){

        $rezultat_upita = [];
        $ucenik_postoji = true;

        $ucenik = json_decode($podaci_korisnika, false);

        $this->ime = $ucenik->ime;
        $this->prezime = $ucenik->prezime;
        $this->mesto_stanovanja = $ucenik->mesto_stanovanja;
        $this->jmbg = $ucenik->jmbg;
        $this->ime_staratelja = $ucenik->ime_staratelja;
        $this->prezime_staratelja = $ucenik->prezime_staratelja;
        $this->kontakt_telefon = $ucenik->kontakt_telefon;
        $this->sifra_odeljenja = $ucenik->sifra_odeljenja;
        $this->korisnicko_ime = $ucenik->korisnicko_ime;
        $this->sifra = password_hash($ucenik->sifra, PASSWORD_DEFAULT);
        //DATUM RODJENJA
        //POL


        $upit = $this->set_query("SELECT * FROM ucenik
                WHERE korisnicko_ime = '{$this->korisnicko_ime}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }


        if(!$rezultat_upita){

            $upit = $this->prepare_query("INSERT INTO ucenik(
                ime,
                prezime,
                korisnicko_ime,
                sifra,
                mesto_stanovanja,
                jmbg,
                ime_staratelja,
                prezime_staratelja,
                kontakt_telefon,
                sifra_odeljenja)
                VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $upit->bind_param("ssssssssss",
                $this->ime,
                $this->prezime,
                $this->korisnicko_ime,
                $this->sifra,
                $this->mesto_stanovanja,
                $this->jmbg,
                $this->ime_staratelja,
                $this->prezime_staratelja,
                $this->kontakt_telefon,
                $this->sifra_odeljenja);

            $upit->execute();

            $ucenik_postoji = false;
        }

        return $ucenik_postoji;
    }


    public function izmeni_ucenika($podaci_korisnika){

        $rezultat_upita = [];
        $rezultat = [];
        $poruka = "prazna";

        $ucenik = json_decode($podaci_korisnika, false);

        $this->sifra_ucenika = $ucenik->sifra;
        $this->ime = $ucenik->ime;
        $this->prezime = $ucenik->prezime;
        $this->mesto_stanovanja = $ucenik->mesto_stanovanja;
        $this->korisnicko_ime = $ucenik->korisnicko_ime;
        $this->jmbg = $ucenik->jmbg;
        $this->ime_staratelja = $ucenik->ime_staratelja;
        $this->prezime_staratelja = $ucenik->prezime_staratelja;
        $this->kontakt_telefon = $ucenik->kontakt_telefon;
        $this->sifra_odeljenja = $ucenik->sifra_odeljenja;

        $upit = $this->set_query("SELECT * FROM ucenik
                WHERE sifra_ucenika = '{$this->sifra_ucenika}'");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }


        if($rezultat_upita){

            if($this->korisnicko_ime !== $rezultat_upita['korisnicko_ime']){

                $upit = $this->set_query("SELECT * FROM ucenik
                        WHERE korisnicko_ime = '{$this->korisnicko_ime}'");

                while($red = $upit->fetch_assoc()){
                    $rezultat = $red;
                }

                if($rezultat){
                    $poruka = "Vec postoji ucenik sa odabranim korisnickim imenom";
                } else {

                    $upit = $this->prepare_query("UPDATE ucenik SET
                            ime = (?),
                            prezime = (?),
                            mesto_stanovanja = (?),
                            korisnicko_ime = (?),
                            jmbg = (?),
                            ime_staratelja = (?),
                            prezime_staratelja = (?),
                            kontakt_telefon = (?),
                            sifra_odeljenja = (?)
                            WHERE sifra_ucenika = {$this->sifra_ucenika}");

                    $upit->bind_param("sssssssss",
                            $this->ime,
                            $this->prezime,
                            $this->mesto_stanovanja,
                            $this->korisnicko_ime,
                            $this->jmbg,
                            $this->ime_staratelja,
                            $this->prezime_staratelja,
                            $this->kontakt_telefon,
                            $this->sifra_odeljenja);

                    $upit->execute();


                    $poruka = "Uspesno izmenjen ucenik";
                }
            }
            else {
                $upit = $this->prepare_query("UPDATE ucenik SET
                        ime = (?),
                        prezime = (?),
                        mesto_stanovanja = (?),
                        korisnicko_ime = (?),
                        jmbg = (?),
                        ime_staratelja = (?),
                        prezime_staratelja = (?),
                        kontakt_telefon = (?),
                        sifra_odeljenja = (?)
                        WHERE sifra_ucenika = {$this->sifra_ucenika}");

                $upit->bind_param("sssssssss",
                        $this->ime,
                        $this->prezime,
                        $this->mesto_stanovanja,
                        $this->korisnicko_ime,
                        $this->jmbg,
                        $this->ime_staratelja,
                        $this->prezime_staratelja,
                        $this->kontakt_telefon,
                        $this->sifra_odeljenja);
                
                $upit->execute();

                $poruka = "Uspesno izmenjen ucenik";
            }
        } else {
            $poruka = "Nema takvog ucenika u bazi";
        }

        return $poruka;
    }


    public function svi_ucenici(){
        
        $rezultat_upita = [];

        $upit =  $this->set_query("SELECT * FROM ucenik");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita[] = $red;
        }

        return $rezultat_upita;
    }


    public function predmeti_koje_uci($podaci_korisnika){

        /**moglo je i bolje al ajde, kasnije...nikad... */
        $rezultat_upita = [];
        $rezultat = [];

        $ucenik = json_decode($podaci_korisnika);
        $this->sifra_ucenika = $ucenik->sifra;

        $upit = $this->set_query("SELECT sifra_odeljenja FROM ucenik
                WHERE sifra_ucenika = {$this->sifra_ucenika}");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        $sifra_odeljenja = $rezultat_upita['sifra_odeljenja'];

        $upit = $this->set_query("SELECT razred FROM odeljenje
                WHERE sifra_odeljenja = '{$sifra_odeljenja}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        $razred = $rezultat_upita['razred'];

        $upit = $this->set_query("SELECT * FROM predmet
                WHERE razred = {$razred}");
        
        while($red = $upit->fetch_assoc()){
            $rezultat[] = $red;
        }


       
        return $rezultat;
        
    }


    public function sa_sifrom($podaci_korisnika){

        $ucenik = json_decode($podaci_korisnika, false);
        $podaci = [];
       
        
        $this->sifra_ucenika = $ucenik->sifra;


        $upit = "SELECT sifra_ucenika, ime, prezime,
                korisnicko_ime, jmbg, ime_staratelja,
                prezime_staratelja, kontakt_telefon,
                mesto_stanovanja, sifra_odeljenja 
                FROM ucenik WHERE 
                sifra_ucenika = '{$this->sifra_ucenika}'";
        
        $rezultat_upita = mysqli_query($this->connection, $upit);
        $redovi = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $redovi; $i++){
            $podaci = mysqli_fetch_assoc($rezultat_upita);
        }

        return $podaci;
    }


    public function sa_sifrom_odeljenja($podaci_korisnika){

        $odeljenje = json_decode($podaci_korisnika, false);
        $podaci = [];
       
        
        $this->sifra_odeljenja = $odeljenje->sifra;


        $upit = "SELECT sifra_ucenika, ime, prezime,
                korisnicko_ime, jmbg,sifra_odeljenja 
                FROM ucenik WHERE 
                sifra_odeljenja = '{$this->sifra_odeljenja}'";
        
        $rezultat_upita = mysqli_query($this->connection, $upit);
        $redovi = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $redovi; $i++){
            $podaci[] = mysqli_fetch_assoc($rezultat_upita);
        }

        return $podaci;
    }


    public function ocene_sa_polugodista($podaci_korisnika){

        $ucenik = json_decode($podaci_korisnika, false);
        $podaci = [];

        $this->sifra_ucenika = $ucenik->sifra_ucenika;
        $sifra_predmeta = $ucenik->sifra_predmeta;
        $polugodiste = $ucenik->polugodiste;

        $upit = "SELECT * FROM ucenik_ima_ocenu 
                WHERE sifra_ucenika = {$this->sifra_ucenika} AND
                sifra_predmeta = {$sifra_predmeta} AND
                polugodiste = {$polugodiste}";

        $rezultat_upita = mysqli_query($this->connection, $upit);
        $redovi = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $redovi; $i++){
            $podaci[] = mysqli_fetch_assoc($rezultat_upita);
        }

        return $podaci;
    }
}
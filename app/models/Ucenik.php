<?php
require_once("Database.php");

class Ucenik extends Database {

    public $sifra_ucenika;

    public $ime;

    public $prezime;

    public $korisnicko_ime;

    public $sifra;

    public $datum_rodjenja;

    public $mesto_stanovanja;

    public $jmbg;

    public $pol;

    public $ime_staratelja;

    public $prezime_staratelja;

    public $sifra_odeljenja;

    public $kontakt_telefon;



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




    public function predmeti_koje_uci($podaci_korisnika){


        $rezultat_upita = [];
        $sifre_predmeta = [];
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

        $upit = $this->set_query("SELECT sifra_predmeta FROM razred_ima_predmet
                WHERE razred = {$razred}");

        
        while($red = $upit->fetch_assoc()){
            $sifre_predmeta[] = $red;
        }

        
        foreach($sifre_predmeta as $tek_sifra){

            $upit = $this->set_query("SELECT * FROM predmet 
                    WHERE sifra_predmeta = {$tek_sifra['sifra_predmeta']}");
            
            $red = $upit->fetch_assoc();

            array_push($rezultat, $red);
        }
       
        return $rezultat;
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
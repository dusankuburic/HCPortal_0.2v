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
        $this->korisnicko_ime = $ucenik->korisnicko_ime;
        $this->sifra = password_hash($ucenik->sifra, PASSWORD_DEFAULT);
        //DATUM RODJENJA
        //POL
        //SIFRA ODELJENJA

        $upit = $this->set_query("SELECT * FROM ucenik
                WHERE korisnicko_ime = '{$this->korisnicko_ime}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }


        if(empty($rezultat_upita)){

            $upit = $this->prepare_query("INSERT INTO ucenik(
                ime,
                prezime,
                korisnicko_ime,
                sifra,
                mesto_stanovanja,
                jmbg,
                ime_staratelja,
                prezime_staratelja,
                kontakt_telefon)
                VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $upit->bind_param("sssssssss",
                $this->ime,
                $this->prezime,
                $this->korisnicko_ime,
                $this->sifra,
                $this->mesto_stanovanja,
                $this->jmbg,
                $this->ime_staratelja,
                $this->prezime_staratelja,
                $this->kontakt_telefon);

            $upit->execute();

            $ucenik_postoji = false;
        }

        return $ucenik_postoji;
    }


    public function svi_ucenici(){
        
        $rezultat_upita = [];

        $upit =  $this->set_query("SELECT * FROM ucenik");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita[] = $red;
        }

        return $rezultat_upita;
    }



}
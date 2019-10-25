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

            if($tek_korisnicko_ime === $this->korisnicko_ime && $tek_sifra === $this->sifra){
                $stanje_prijave = true;
            }
        }

        return $stanje_prijave;
    }


    public function dodaj_moderatora($podaci_korisnika){

        $rezultat_upita = [];
        $moderator_postoji = true;

        $moderator = json_decode($podaci_korisnika, false);

        $this->ime = $podaci_korisnika->ime;
        $this->prezime = $podaci_korisnika->prezime;
        $this->korisnicko_ime = $podaci_korisnika->korisnicko_ime;
        $this->sifra = password_hash($podaci_korisnika->sifra, PASSWORD_DEFAULT);


        $upit = $this->set_query("SELECT * FROM moderator WHERE korisnicko_ime = '{$this->korisnicko_ime}'");

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
        }

        return $rezultat_upita;
    }






}
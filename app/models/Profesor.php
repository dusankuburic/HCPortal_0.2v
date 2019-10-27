<?php

require_once("Database.php");

class Profesor extends Database {

    private $sifra_profesora;

    private $ime;

    private $prezime;

    public $korisnicko_ime;

    private $sifra;

    private $datum_rodjenja;

    private $mesto_stanovanja;

    private $jmbg;

    private $pol;



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


        $upit = $this->set_query("SELECT * FROM profesor WHERE korisnicko_ime = '{$this->korisnicko_ime}'");

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


    public function dodaj_profesora($podaci_korisnika){

        $rezultat_upita = [];
        $profesor_postoji = true;

        $profesor = json_decode($podaci_korisnika, false);

        $this->ime = $profesor->ime;
        $this->prezime = $profesor->prezime;
        $this->mesto_stanovanja = $profesor->mesto_stanovanja;
        $this->jmbg = $profesor->jmbg;
        $this->korisnicko_ime = $profesor->korisnicko_ime;
        $this->sifra = password_hash($profesor->sifra, PASSWORD_DEFAULT);

        $upit = $this->set_query("SELECT * FROM profesor
                WHERE korisnicko_ime = '{$this->korisnicko_ime}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if(empty($rezultat_upita)){

            $upit = $this->prepare_query("INSERT INTO profesor(
                ime,
                prezime,
                mesto_stanovanja,
                jmbg,
                korisnicko_ime,
                sifra)
                VALUE(?, ?, ?, ?, ?, ?)");

            $upit->bind_param("ssssss",
                $this->ime,
                $this->prezime,
                $this->mesto_stanovanja,
                $this->jmbg,
                $this->korisnicko_ime,
                $this->sifra);

            $upit->execute();

            $profesor_postoji = false;
        }

        return $profesor_postoji;
    }


    public function svi_profesori(){
        
        $rezultat_upita = [];

        $upit =  $this->set_query("SELECT * FROM profesor");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita[] = $red;
        }

        return $rezultat_upita;
    }


}
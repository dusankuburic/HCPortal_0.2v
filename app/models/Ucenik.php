<?php
require_once("Database.php");

class Ucenik extends Database {

    private $id;

    public $username;

    public $password;

    private $name;



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


            if($tek_korisnicko_ime === $this->korisnicko_ime && $tek_sifra === $this->sifra){
                $stanje_prijave = true;
            }
        }

        return $stanje_prijave;
    }


}
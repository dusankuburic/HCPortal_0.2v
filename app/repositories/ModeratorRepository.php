<?php 
require_once("interfaces/IModerator.php");
require_once("../../models/Moderator.php");

class ModeratorRepository implements IModerator {

    private $ctx;

    public function __construct($ctx_){
        $this->ctx = $ctx_;
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
}
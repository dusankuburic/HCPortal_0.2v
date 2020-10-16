<?php
require_once("interfaces/IUcenik.php");
require_once("../../models/Ucenik.php");
require_once("../../models/Database.php");

class UcenikRepository implements IUcenik {

    private $ctx;

    public function __construct($ctx_){
        $this->ctx = $ctx_;
    }


    public function svi_ucenici(){
        
        $rezultat_upita  = [];
       
        $upit = $this->ctx->set_query("SELECT * FROM ucenik");
        
        while($red = $upit->fetch_assoc()){
            $ucenik = new Ucenik();

            $ucenik->sifra_ucenika = $red["sifra_ucenika"];
            $ucenik->ime = $red["ime"];
            $ucenik->prezime = $red["prezime"];
            $ucenik->korisnicko_ime = $red["korisnicko_ime"];
            $ucenik->jmbg = $red["jmbg"];
            $ucenik->ime_staratelja = $red["ime_staratelja"];
            $ucenik->mesto_stanovanja = $red["mesto_stanovanja"];
            $ucenik->prezime_staratelja = $red["prezime_staratelja"];
            $ucenik->kontakt_telefon = $red["kontakt_telefon"];

            $rezultat_upita[] = $ucenik;
        }

        return $rezultat_upita;
    }

    public function dodaj_ucenika($podaci_korisnika){

        $rezultat_upita = [];
        $ucenik_postoji = true;
        $ucenik = new Ucenik();

        $request = json_decode($podaci_korisnika, false);

        $ucenik->ime = $request->ime;
        $ucenik->prezime = $request->prezime;
        $ucenik->mesto_stanovanja = $request->mesto_stanovanja;
        $ucenik->jmbg = $request->jmbg;
        $ucenik->ime_staratelja = $request->ime_staratelja;
        $ucenik->prezime_staratelja = $request->prezime_staratelja;
        $ucenik->kontakt_telefon = $request->kontakt_telefon;
        $ucenik->sifra_odeljenja = $request->sifra_odeljenja;
        $ucenik->korisnicko_ime = $request->korisnicko_ime;
        $ucenik->sifra = password_hash($request->sifra, PASSWORD_DEFAULT);
        //DATUM RODJENJA
        //POL


        $upit = $this->ctx->set_query("SELECT * FROM ucenik
                WHERE korisnicko_ime = '{$ucenik->korisnicko_ime}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }


        if(!$rezultat_upita){

            $upit = $this->ctx->prepare_query("INSERT INTO ucenik(
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
                $ucenik->ime,
                $ucenik->prezime,
                $ucenik->korisnicko_ime,
                $ucenik->sifra,
                $ucenik->mesto_stanovanja,
                $ucenik->jmbg,
                $ucenik->ime_staratelja,
                $ucenik->prezime_staratelja,
                $ucenik->kontakt_telefon,
                $ucenik->sifra_odeljenja);

            $upit->execute();

            $ucenik_postoji = false;
        }

        return $ucenik_postoji;
    }

    public function izmeni_ucenika($podaci_korisnika){

        $rezultat_upita = [];
        $rezultat = [];
        $poruka = "prazna";
        $ucenik = new Ucenik();

        $request = json_decode($podaci_korisnika, false);

        $ucenik->sifra_ucenika = $request->sifra;
        $ucenik->ime = $request->ime;
        $ucenik->prezime = $request->prezime;
        $ucenik->mesto_stanovanja = $request->mesto_stanovanja;
        $ucenik->korisnicko_ime = $request->korisnicko_ime;
        $ucenik->jmbg = $request->jmbg;
        $ucenik->ime_staratelja = $request->ime_staratelja;
        $ucenik->prezime_staratelja = $request->prezime_staratelja;
        $ucenik->kontakt_telefon = $request->kontakt_telefon;
        $ucenik->sifra_odeljenja = $request->sifra_odeljenja;

        $upit = $this->ctx->set_query("SELECT * FROM ucenik
                WHERE sifra_ucenika = '{$ucenik->sifra_ucenika}'");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }


        if($rezultat_upita){

            if($ucenik->korisnicko_ime !== $rezultat_upita['korisnicko_ime']){

                $upit = $this->ctx->set_query("SELECT * FROM ucenik
                        WHERE korisnicko_ime = '{$ucenik->korisnicko_ime}'");

                while($red = $upit->fetch_assoc()){
                    $rezultat = $red;
                }

                if($rezultat){
                    $poruka = "Vec postoji ucenik sa odabranim korisnickim imenom";
                } else {

                    $upit = $this->ctx->prepare_query("UPDATE ucenik SET
                            ime = (?),
                            prezime = (?),
                            mesto_stanovanja = (?),
                            korisnicko_ime = (?),
                            jmbg = (?),
                            ime_staratelja = (?),
                            prezime_staratelja = (?),
                            kontakt_telefon = (?),
                            sifra_odeljenja = (?)
                            WHERE sifra_ucenika = {$ucenik->sifra_ucenika}");

                    $upit->bind_param("sssssssss",
                            $ucenik->ime,
                            $ucenik->prezime,
                            $ucenik->mesto_stanovanja,
                            $ucenik->korisnicko_ime,
                            $ucenik->jmbg,
                            $ucenik->ime_staratelja,
                            $ucenik->prezime_staratelja,
                            $ucenik->kontakt_telefon,
                            $ucenik->sifra_odeljenja);

                    $upit->execute();


                    $poruka = "Uspesno izmenjen ucenik";
                }
            }
            else {
                $upit = $this->ctx->prepare_query("UPDATE ucenik SET
                        ime = (?),
                        prezime = (?),
                        mesto_stanovanja = (?),
                        korisnicko_ime = (?),
                        jmbg = (?),
                        ime_staratelja = (?),
                        prezime_staratelja = (?),
                        kontakt_telefon = (?),
                        sifra_odeljenja = (?)
                        WHERE sifra_ucenika = {$ucenik->sifra_ucenika}");

                $upit->bind_param("sssssssss",
                        $ucenik->ime,
                        $ucenik->prezime,
                        $ucenik->mesto_stanovanja,
                        $ucenik->korisnicko_ime,
                        $ucenik->jmbg,
                        $ucenik->ime_staratelja,
                        $ucenik->prezime_staratelja,
                        $ucenik->kontakt_telefon,
                        $ucenik->sifra_odeljenja);
                
                $upit->execute();

                $poruka = "Uspesno izmenjen ucenik";
            }
        } else {
            $poruka = "Nema takvog ucenika u bazi";
        }

        return $poruka;
    }

    public function sa_sifrom($podaci_korisnika){

        $request = json_decode($podaci_korisnika, false);
       
        $upit = $this->ctx->set_query("SELECT * FROM ucenik WHERE sifra_ucenika = '{$request->sifra}'");
        $ucenik = new Ucenik();

        while($red = $upit->fetch_assoc()){        

            $ucenik->sifra_ucenika = $red["sifra_ucenika"];
            $ucenik->ime = $red["ime"];
            $ucenik->prezime = $red["prezime"];
            $ucenik->korisnicko_ime = $red["korisnicko_ime"];
            $ucenik->jmbg = $red["jmbg"];
            $ucenik->ime_staratelja = $red["ime_staratelja"];
            $ucenik->mesto_stanovanja = $red["mesto_stanovanja"];
            $ucenik->prezime_staratelja = $red["prezime_staratelja"];
            $ucenik->kontakt_telefon = $red["kontakt_telefon"];

        }

        return $ucenik;
    }

    public function ocene_sa_polugodista($podaci_korisnika){

        $request = json_decode($podaci_korisnika, false);
        $podaci = [];

        $sifra_ucenika = $request->sifra_ucenika;
        $sifra_predmeta = $request->sifra_predmeta;
        $polugodiste = $request->polugodiste;

        $upit = "SELECT * FROM ucenik_ima_ocenu 
                WHERE sifra_ucenika = {$sifra_ucenika} AND
                sifra_predmeta = {$sifra_predmeta} AND
                polugodiste = {$polugodiste}";

        $rezultat_upita = mysqli_query($this->ctx->get_connection(), $upit);
        $broj_redova = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $broj_redova; $i++){
            $podaci[] = mysqli_fetch_assoc($rezultat_upita);
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
        
        $rezultat_upita = mysqli_query($this->ctx->get_connection(), $upit);
        $redovi = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $redovi; $i++){
            $podaci[] = mysqli_fetch_assoc($rezultat_upita);
        }

        return $podaci;
    }

    public function predmeti_koje_uci($podaci_korisnika){


        $rezultat_upita = [];
        $sifre_predmeta = [];
        $rezultat = [];

        $request = json_decode($podaci_korisnika);
        $sifra_ucenika = $request->sifra;

        $upit = $this->ctx->set_query("SELECT sifra_odeljenja FROM ucenik
                WHERE sifra_ucenika = {$sifra_ucenika}");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        $sifra_odeljenja = $rezultat_upita['sifra_odeljenja'];

        $upit = $this->ctx->set_query("SELECT razred FROM odeljenje
                WHERE sifra_odeljenja = '{$sifra_odeljenja}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        $razred = $rezultat_upita['razred'];

        $upit = $this->ctx->set_query("SELECT sifra_predmeta FROM razred_ima_predmet
                WHERE razred = {$razred}");

        
        while($red = $upit->fetch_assoc()){
            $sifre_predmeta[] = $red;
        }

        
        foreach($sifre_predmeta as $tek_sifra){

            $upit = $this->ctx->set_query("SELECT * FROM predmet 
                    WHERE sifra_predmeta = {$tek_sifra['sifra_predmeta']}");
            
            $red = $upit->fetch_assoc();

            array_push($rezultat, $red);
        }
       
        return $rezultat;
    }

    public function prijava($podaci_korisnika){

        $request = json_decode($podaci_korisnika, false);

        $korisnicko_ime = $request->korisnicko_ime;
        $sifra = $request->sifra;

        $stanje_prijave = false;
        $rezultat_upita = [];


        $upit = $this->ctx->set_query("SELECT * FROM ucenik WHERE korisnicko_ime = '{$korisnicko_ime}'");

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

        $result = array("stanje_prijave" => $stanje_prijave, "korisnicko_ime" => $korisnicko_ime);

        return $result;
    }
}
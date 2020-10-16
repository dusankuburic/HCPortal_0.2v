<?php
require_once("interfaces/IUcenik.php");
require_once("../../models/Ucenik.php");
require_once("../../models/Database.php");

class UcenikRepository implements IUcenik{

    private $ctx;

    public function __construct(){

        $this->ctx = new Database();
        $this->ctx->set_parameters(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->ctx->connect_to_db();
        $this->ctx->test_connection();

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


        $upit = $this->ctx->set_query("SELECT * FROM ucenik
                WHERE korisnicko_ime = '{$this->korisnicko_ime}'");

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

        $upit = $this->ctx->set_query("SELECT * FROM ucenik
                WHERE sifra_ucenika = '{$this->sifra_ucenika}'");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }


        if($rezultat_upita){

            if($this->korisnicko_ime !== $rezultat_upita['korisnicko_ime']){

                $upit = $this->ctx->set_query("SELECT * FROM ucenik
                        WHERE korisnicko_ime = '{$this->korisnicko_ime}'");

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
        
        $rezultat_upita = mysqli_query($this->ctx->get_connection(), $upit);
        $redovi = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $redovi; $i++){
            $podaci = mysqli_fetch_assoc($rezultat_upita);
        }

        return $podaci;
    }


}
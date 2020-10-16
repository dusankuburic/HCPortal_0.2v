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


}
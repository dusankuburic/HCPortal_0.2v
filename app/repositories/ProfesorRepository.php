<?php
require_once("interfaces/IProfesor.php");
require_once("../../models/Profesor.php");

class ProfesorRepository implements IProfesor {

    private $ctx;

    public function __construct($ctx_) {
        $this->ctx = $ctx_;
    }

    public function svi_profesori(){
        
        $rezultat_upita = [];

        $upit =  $this->ctx->set_query("SELECT * FROM profesor");
        
        while($red = $upit->fetch_assoc()){
            $profesor = new Profesor();
            
            $profesor->sifra_profesora = $red["sifra_profesora"];
            $profesor->ime = $red["ime"];
            $profesor->prezime = $red["prezime"];
            $profesor->korisnicko_ime = $red["korisnicko_ime"];
            $profesor->mesto_stanovanja = $red["mesto_stanovanja"];
            $profesor->jmbg = $red["jmbg"];

            $rezultat_upita[] = $profesor;
        }

        return $rezultat_upita;
    }

    public function dodaj_profesora($podaci_korisnika){

        $rezultat_upita = [];
        $profesor_postoji = true;
        $profesor = new Profesor();

        $request = json_decode($podaci_korisnika, false);

        $profesor->ime = $request->ime;
        $profesor->prezime = $request->prezime;
        $profesor->mesto_stanovanja = $request->mesto_stanovanja;
        $profesor->jmbg = $request->jmbg;
        $profesor->korisnicko_ime = $request->korisnicko_ime;
        $profesor->sifra = password_hash($request->sifra, PASSWORD_DEFAULT);

        $upit = $this->ctx->set_query("SELECT * FROM profesor
                WHERE korisnicko_ime = '{$profesor->korisnicko_ime}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if(!$rezultat_upita){

            $upit = $this->ctx->prepare_query("INSERT INTO profesor(
                ime,
                prezime,
                mesto_stanovanja,
                jmbg,
                korisnicko_ime,
                sifra)
                VALUE(?, ?, ?, ?, ?, ?)");

            $upit->bind_param("ssssss",
                $profesor->ime,
                $profesor->prezime,
                $profesor->mesto_stanovanja,
                $profesor->jmbg,
                $profesor->korisnicko_ime,
                $profesor->sifra);

            $upit->execute();

            $profesor_postoji = false;
        }

        return $profesor_postoji;
    }

    public function izmeni_profesora($podaci_korisnika){

        $rezultat_upita = [];
        $rezultat = [];
        $poruka = "prazna";
        $profesor = new Profesor();

        $request = json_decode($podaci_korisnika, false);

        $profesor->sifra_profesora = $request->sifra;
        $profesor->ime = $request->ime;
        $profesor->prezime = $request->prezime;
        $profesor->mesto_stanovanja = $request->mesto_stanovanja;
        $profesor->jmbg = $request->jmbg;
        $profesor->korisnicko_ime = $request->korisnicko_ime;

        $upit = $this->ctx->set_query("SELECT * FROM profesor
                WHERE sifra_profesora = '{$profesor->sifra_profesora}'");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }


        if($rezultat_upita){

            if($profesor->korisnicko_ime !== $rezultat_upita['korisnicko_ime']){

                $upit = $this->ctx->set_query("SELECT * FROM profesor
                        WHERE korisnicko_ime = '{$profesor->korisnicko_ime}'");

                while($red = $upit->fetch_assoc()){
                    $rezultat = $red;
                }


                if($rezultat){
                    $poruka = "Vec postoji profesor sa odabranim korisnickim imenom";
                } else {

                    $upit = $this->ctx->prepare_query("UPDATE profesor SET
                            ime = (?),
                            prezime = (?),
                            mesto_stanovanja = (?),
                            jmbg = (?),
                            korisnicko_ime = (?)
                            WHERE sifra_profesora = {$profesor->sifra_profesora}");
                    
                    $upit->bind_param("sssss",
                            $profesor->ime,
                            $profesor->prezime,
                            $profesor->mesto_stanovanja,
                            $profesor->jmbg,
                            $profesor->korisnicko_ime);
                    
                    $upit->execute();

                    $poruka = "Uspesno izmenjen profesor";
                }
            }
            else {
                $upit = $this->ctx->prepare_query("UPDATE profesor SET
                        ime = (?),
                        prezime = (?),
                        mesto_stanovanja = (?),
                        jmbg = (?),
                        korisnicko_ime = (?)
                        WHERE sifra_profesora = {$profesor->sifra_profesora}");
                
                $upit->bind_param("sssss",
                        $profesor->ime,
                        $profesor->prezime,
                        $profesor->mesto_stanovanja,
                        $profesor->jmbg,
                        $profesor->korisnicko_ime);
                
                $upit->execute();

                $poruka = "Uspesno izmenjen profesor";
            }
        } else {
            $poruka = "Nema takvog profesora u bazi";
        }


        return $poruka;
    }

    public function sa_sifrom($podaci_korisnika){

        $request = json_decode($podaci_korisnika, false);
        $podaci = [];

        $sifra_profesora = $request->sifra;

        $upit = "SELECT sifra_profesora, ime, prezime, korisnicko_ime,
                jmbg, mesto_stanovanja 
                FROM profesor WHERE 
                sifra_profesora = '{$sifra_profesora}'";
        
        $rezultat_upita = mysqli_query($this->ctx->get_connection(), $upit);
        $broj_redova = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $broj_redova; $i++){
            $podaci = mysqli_fetch_assoc($rezultat_upita);
        }

        return $podaci;
    }

    public function prijava($podaci_korisnika){

        $request = json_decode($podaci_korisnika, false);
        $korisnicko_ime = $request->korisnicko_ime;
        $sifra = $request->sifra;

        $stanje_prijave = false;
        $rezultat_upita = [];


        $upit = $this->ctx->set_query("SELECT * FROM profesor WHERE korisnicko_ime = '{$korisnicko_ime}'");

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
        
        $response = array("stanje_prijave" => $stanje_prijave, "korisnicko_ime" => $korisnicko_ime);

        return $response;
    }

    public function upisi_ocenu($podaci_korisnika){

        $poruka = "prazna";
        $request = json_decode($podaci_korisnika);

        $sifra_ucenika = $request->sifra_ucenika;
        $sifra_predmeta = $request->sifra_predmeta;
        $ocena = $request->ocena;
        $polugodiste = $request->polugodiste;
        $opis = $request->opis;
        
        $upit = $this->ctx->prepare_query("INSERT INTO ucenik_ima_ocenu(
                sifra_ucenika, 
                sifra_predmeta, 
                ocena, 
                polugodiste, 
                opis)
                VALUES(?, ?, ?, ?, ?)");

        $upit->bind_param("sssss",
                $sifra_ucenika,
                $sifra_predmeta,
                $ocena,
                $polugodiste,
                $opis);
        
        $rezultat = $upit->execute();

        if($rezultat){
            $poruka = "Uspesno upisana ocena";
        } else {
            $poruka = "OCENA NIJE UPISANA, GRESKA!";
        }

        return $poruka;     
    }

    public function dodeli_predmete($podaci_korisnika){

        $poruka = "prazna";
        $rezultat_upita = [];
        $request = json_decode($podaci_korisnika, false);

        $sifra_profesora = $request->sifra_profesora;
        $predmeti = $request->predmeti;
        $odeljenja = $request->odeljenja;

        $upit = $this->ctx->set_query("SELECT sifra_predmeta FROM profesor_predaje_predmet_odeljenju
            WHERE sifra_profesora = '{$sifra_profesora}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if($rezultat_upita){
            $this->ctx->get_connection()->begin_transaction();

            $upit = $this->ctx->prepare_query("DELETE FROM profesor_predaje_predmet_odeljenju
                WHERE sifra_profesora = (?)");

            $upit->bind_param("s", $sifra_profesora);
            $upit->execute();

            foreach($predmeti as $predmet){
                foreach($odeljenja as $odeljenje){
                    
                    $upit = $this->ctx->prepare_query("INSERT INTO profesor_predaje_predmet_odeljenju(
                        sifra_profesora,
                        sifra_predmeta,
                        sifra_odeljenja)
                        VALUES(?, ?, ?)");
                    
                    $upit->bind_param("sss",
                            $sifra_profesora,
                            $predmet,
                            $odeljenje);
                    
                    if(!$upit->execute()){
                        $poruka = "greska";
                        $this->ctx->get_connection()->rollback();
                    } 
                }
            }
                
            $this->ctx->get_connection()->commit();
            $poruka = "Uspesno dodeljeni predmeti";

        } else {
            foreach($predmeti as $predmet){
                foreach($odeljenja as $odeljenje){
                    
                    $upit = $this->ctx->prepare_query("INSERT INTO profesor_predaje_predmet_odeljenju(
                        sifra_profesora,
                        sifra_predmeta,
                        sifra_odeljenja)
                        VALUES(?, ?, ?)");
                    
                    $upit->bind_param("sss",
                            $sifra_profesora,
                            $predmet,
                            $odeljenje);
                    
                    if(!$upit->execute()){
                        $poruka = "greska";
                    }
                }
            }
        }

        return $poruka;
    }

    public function predmeti_koje_predaje_odeljenjima($podaci_korisnika){

        $rezultat_upita = [];
        $predmeti = [];
        $odeljenja = [];
        $poruka = "Greska";

        $request = json_decode($podaci_korisnika);
        $sifra_profesora = $request->sifra;

        $upit = $this->ctx->set_query("SELECT DISTINCT sifra_predmeta
                FROM profesor_predaje_predmet_odeljenju
                WHERE sifra_profesora = '{$sifra_profesora}'");

        while($red = $upit->fetch_assoc()){
            $predmeti[] = $red;
        }
    
        $upit = $this->ctx->set_query("SELECT DISTINCT sifra_odeljenja
                FROM profesor_predaje_predmet_odeljenju
                WHERE sifra_profesora = '{$sifra_profesora}'");

        while($red = $upit->fetch_assoc()){
            $odeljenja[] = $red;
        }

        $rezultat_upita['predmeti'] = $predmeti;
        $rezultat_upita['odeljenja'] = $odeljenja;

        if(!$rezultat_upita){
           return $poruka;
        }

        return $rezultat_upita;
    }
}

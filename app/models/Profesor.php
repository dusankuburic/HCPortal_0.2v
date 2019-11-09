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

        if(!$rezultat_upita){

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


    public function izmeni_profesora($podaci_korisnika){

        $rezultat_upita = [];
        $rezultat = [];
        $poruka = "prazna";

        $profesor = json_decode($podaci_korisnika, false);

        $this->sifra_profesora = $profesor->sifra;
        $this->ime = $profesor->ime;
        $this->prezime = $profesor->prezime;
        $this->mesto_stanovanja = $profesor->mesto_stanovanja;
        $this->jmbg = $profesor->jmbg;
        $this->korisnicko_ime = $profesor->korisnicko_ime;

        $upit = $this->set_query("SELECT * FROM profesor
                WHERE sifra_profesora = '{$this->sifra_profesora}'");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }


        if($rezultat_upita){

            if($this->korisnicko_ime !== $rezultat_upita['korisnicko_ime']){

                $upit = $this->set_query("SELECT * FROM profesor
                        WHERE korisnicko_ime = '{$this->korisnicko_ime}'");

                while($red = $upit->fetch_assoc()){
                    $rezultat = $red;
                }


                if($rezultat){
                    $poruka = "Vec postoji profesor sa odabranim korisnickim imenom";
                } else {

                    $upit = $this->prepare_query("UPDATE profesor SET
                            ime = (?),
                            prezime = (?),
                            mesto_stanovanja = (?),
                            jmbg = (?),
                            korisnicko_ime = (?)
                            WHERE sifra_profesora = {$this->sifra_profesora}");
                    
                    $upit->bind_param("sssss",
                            $this->ime,
                            $this->prezime,
                            $this->mesto_stanovanja,
                            $this->jmbg,
                            $this->korisnicko_ime);
                    
                    $upit->execute();

                    $poruka = "Uspesno izmenjen profesor";
                }
            }
            else {
                $upit = $this->prepare_query("UPDATE profesor SET
                        ime = (?),
                        prezime = (?),
                        mesto_stanovanja = (?),
                        jmbg = (?),
                        korisnicko_ime = (?)
                        WHERE sifra_profesora = {$this->sifra_profesora}");
                
                $upit->bind_param("sssss",
                        $this->ime,
                        $this->prezime,
                        $this->mesto_stanovanja,
                        $this->jmbg,
                        $this->korisnicko_ime);
                
                $upit->execute();

                $poruka = "Uspesno izmenjen profesor";
            }
        } else {
            $poruka = "Nema takvog profesora u bazi";
        }


        return $poruka;
    }


    public function svi_profesori(){
        
        $rezultat_upita = [];

        $upit =  $this->set_query("SELECT * FROM profesor");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita[] = $red;
        }

        return $rezultat_upita;
    }

    public function sa_sifrom($podaci_korisnika){

        $profesor = json_decode($podaci_korisnika, false);
        $podaci = [];
       
        
        $this->sifra_profesora = $profesor->sifra;


        $upit = "SELECT sifra_profesora, ime, prezime, korisnicko_ime,
                jmbg, mesto_stanovanja 
                FROM profesor WHERE 
                sifra_profesora = '{$this->sifra_profesora}'";
        
        $rezultat_upita = mysqli_query($this->connection, $upit);
        $redovi = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $redovi; $i++){
            $podaci = mysqli_fetch_assoc($rezultat_upita);
        }

        return $podaci;

    }

    public function dodeli_predmete($podaci_korisnika){

        $poruka = "prazna";
        $rezultat_upita = [];
        $predmeti_profesora = json_decode($podaci_korisnika, false);

        $this->sifra_profesora = $predmeti_profesora->sifra_profesora;
        $predmeti = $predmeti_profesora->predmeti;
        $odeljenja = $predmeti_profesora->odeljenja;


        $upit = $this->set_query("SELECT sifra_predmeta FROM profesor_predaje_predmet_odeljenju
        WHERE sifra_profesora = '{$this->sifra_profesora}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if($rezultat_upita){
            $this->connection->begin_transaction();

            $upit = $this->prepare_query("DELETE FROM profesor_predaje_predmet_odeljenju
            WHERE sifra_profesora = (?)");

            $upit->bind_param("s", $this->sifra_profesora);

            $upit->execute();

            foreach($predmeti as $predmet){
                foreach($odeljenja as $odeljenje){
                    
                    $upit = $this->prepare_query("INSERT INTO profesor_predaje_predmet_odeljenju(
                        sifra_profesora,
                        sifra_predmeta,
                        sifra_odeljenja)
                        VALUES(?, ?, ?)");
                    
                    $upit->bind_param("sss",
                            $this->sifra_profesora,
                            $predmet,
                            $odeljenje);
                    
                    if(!$upit->execute()){
                        $poruka = "greska";
                        $this->connection->rollback();
                    } 
                }
            }
                
            $this->connection->commit();

            $poruka = "Uspesno dodeljeni predmeti";
        } else {


            foreach($predmeti as $predmet){
                foreach($odeljenja as $odeljenje){
                    
                    $upit = $this->prepare_query("INSERT INTO profesor_predaje_predmet_odeljenju(
                        sifra_profesora,
                        sifra_predmeta,
                        sifra_odeljenja)
                        VALUES(?, ?, ?)");
                    
                    $upit->bind_param("sss",
                            $this->sifra_profesora,
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

        $profesor = json_decode($podaci_korisnika);
        $this->sifra_profesora = $profesor->sifra;


        $upit = $this->set_query("SELECT DISTINCT sifra_predmeta
                FROM profesor_predaje_predmet_odeljenju
                WHERE sifra_profesora = '{$this->sifra_profesora}'");

        while($red = $upit->fetch_assoc()){
            $predmeti[] = $red;
        }

        
        $upit = $this->set_query("SELECT DISTINCT sifra_odeljenja
                FROM profesor_predaje_predmet_odeljenju
                WHERE sifra_profesora = '{$this->sifra_profesora}'");

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




    public function upisi_ocenu($podaci_korisnika){

        $poruka = "prazna";
        $za_upis = json_decode($podaci_korisnika);

        $sifra_ucenika = $za_upis->sifra_ucenika;
        $sifra_predmeta = $za_upis->sifra_predmeta;
        $ocena = $za_upis->ocena;
        $polugodiste = $za_upis->polugodiste;
        $opis = $za_upis->opis;
        


        $upit = $this->prepare_query("INSERT INTO ucenik_ima_ocenu(
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
        
        $rezultat =  $upit->execute();

        if($rezultat){
            $poruka = "Uspesno upisana ocena";
        } else {
            $poruka = "OCENA NIJE UPISANA, GRESKA!";
        }


        return $poruka;
        

    }

}
<?php
require_once("interfaces/IOdeljenje.php");
require_once("../../models/Odeljenje.php");

class OdeljenjeRepository implements IOdeljenje {

    private $ctx;
    
    public function __construct($ctx_){
        $this->ctx = $ctx_;
    }

    public function dodaj_odeljenje($podaci_korisnika){

        $rezultat_upita = [];
        $poruka = "prazna";

        $odeljenje = json_decode($podaci_korisnika, false);
        $naziv =  $odeljenje->naziv;
        $razred = $odeljenje->razred;


        $upit = "SELECT * FROM odeljenje WHERE naziv = '{$naziv}'";
        $rezultat = mysqli_query($this->ctx->get_connection(), $upit);
   

        $redovi = mysqli_num_rows($rezultat);
        for($i = 0; $i < $redovi; $i++){
            $rezultat_upita[] = mysqli_fetch_assoc($rezultat);
        }


        if(!$rezultat_upita){

            $upit = $this->ctx->prepare_query("INSERT INTO odeljenje(naziv, razred)
                    VALUES(?,?)");

            $upit->bind_param("ss", $naziv, $razred);

            $upit->execute();

            $poruka = "Uspesno dodato odeljenje";
        } else {
            $poruka = "Vec postoji odljenje";
        }

        return $poruka;
    }

    public function izmeni_odeljenje($podaci_korisnika){

        $rezultat_upita = [];
        $rezultat = [];
        $poruka = "prazna";

        $request = json_decode($podaci_korisnika, false);
        $odeljenje = new Odeljenje();

        $odeljenje->sifra_odeljenja = $request->sifra;
        $odeljenje->naziv = $request->naziv;
        $odeljenje->razred = $request->razred;


        $upit = $this->ctx->set_query("SELECT * FROM odeljenje 
                WHERE sifra_odeljenja = '{$odeljenje->sifra_odeljenja}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if($rezultat_upita){

            if($odeljenje->naziv !== $rezultat_upita['naziv']){
                
                $upit = $this->ctx->set_query("SELECT * FROM odeljenje
                        WHERE naziv = '{$odeljenje->naziv}'");
                
                while($red = $upit->fetch_assoc()){
                    $rezultat = $red;
                }

                if($rezultat){
                    $poruka = "Vec postoji odeljenje sa tim nazivom";
                } else {

                    $upit = $this->ctx->prepare_query("UPDATE odeljenje SET
                            naziv = (?),
                            razred = (?)
                            WHERE sifra_odeljenja = {$odeljenje->sifra_odeljenja}");

                    $upit->bind_param("ss", $odeljenje->naziv, $odeljenje->razred);

                    $upit->execute();

                    $poruka = "Uspesno izmenjeno odeljenje";
                }
            } else {
                
                $upit = $this->ctx->prepare_query("UPDATE odeljenje SET
                        naziv = (?),
                        razred = (?)
                        WHERE sifra_odeljenja = {$odeljenje->sifra_odeljenja}");
                
                $upit->bind_param("ss", $odeljenje->naziv, $odeljenje->razred);

                $upit->execute();

                $poruka = "Uspesno izmenjeno odeljenje";
            }
        } else {
            $poruka = "Nema takvog odeljenja u bazi";
        }
        return $poruka;
    }

    public function sva_odeljenja(){

        $rezultat_upita = [];

        $upit =  $this->ctx->set_query("SELECT * FROM odeljenje");
        
        while($red = $upit->fetch_assoc()){
            $odeljenje = new Odeljenje();

            $odeljenje->sifra_odeljenja = $red["sifra_odeljenja"];
            $odeljenje->naziv = $red["naziv"];
            $odeljenje->razred = $red["razred"];

            $rezultat_upita[] = $odeljenje;
        }

        return $rezultat_upita;
    }

    public function sva_odeljenja_sa_razredom($podaci_korisnika){

        $request = json_decode($podaci_korisnika);
        $podaci = [];
        
        $razred = $request->razred;

        
        $upit = "SELECT * FROM odeljenje WHERE 
                razred = '{$razred}'";
        
        $rezultat_upita = mysqli_query($this->ctx->get_connection(), $upit);
        $broj_redova = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $broj_redova; $i++){
            $podaci[] = mysqli_fetch_assoc($rezultat_upita);
        }

        return $podaci;
    }

    public function sa_sifrom($podaci_korisnika){

        $request = json_decode($podaci_korisnika, false);
        $podaci = [];
        $sifra_odeljenja = $request->sifra;


        $upit = "SELECT * FROM odeljenje WHERE 
                sifra_odeljenja = '{$sifra_odeljenja}'";
        
        $rezultat_upita = mysqli_query($this->ctx->get_connection(), $upit);
        $broj_redova = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $broj_redova; $i++){
            $podaci = mysqli_fetch_assoc($rezultat_upita);
        }

        return $podaci;
    }

}
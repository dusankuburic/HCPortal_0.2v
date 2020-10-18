<?php
require_once("interfaces/IPredmet.php");
require_once("../../models/Predmet.php");

class PredmetRepository implements IPredmet {

    private $ctx;

    public function __construct($ctx_){
        $this->ctx = $ctx_;
    }
  
    public function svi_predmeti(){

        $rezultat_upita = [];
        $upit =  $this->ctx->set_query("SELECT * FROM predmet");
        
        while($red = $upit->fetch_assoc()){
            $predmet = new Predmet();

            $predmet->sifra_predmeta = $red["sifra_predmeta"];
            $predmet->naziv = $red["naziv"];

            $rezultat_upita[] = $predmet;
        }

        return $rezultat_upita;
    }

    public function dodaj_predmet($podaci_korisnika){

        $rezultat_upita = [];
        $poruka = "prazna";

        $request = json_decode($podaci_korisnika, false);
        $naziv = $request->naziv;
        $razredi = $request->razred;

        $upit = $this->ctx->set_query("SELECT * FROM predmet WHERE naziv = '{$naziv}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if(!$rezultat_upita){

            $this->ctx->get_connection()->begin_transaction();
            $upit = $this->ctx->prepare_query("INSERT INTO predmet(naziv) VALUES(?)");
    
            $upit->bind_param("s", $naziv);
            $upit->execute();

            $upit = $this->ctx->prepare_query("INSERT INTO razred_ima_predmet(sifra_predmeta, razred)
                VALUES(LAST_INSERT_ID(), ?)");

            $upit->bind_param("s", $razred);

            foreach($razredi as $razred){
                if(!$upit->execute()){
                    $this->ctx->get_connection()->rollback();
                }
            }

            $this->ctx->get_connection()->commit();
            $poruka = "Uspesno dodat predmet";   

        } else {
            $poruka = "Vec postoji predmet";
        }
        return $poruka;
    }

    public function izmeni_predmet($podaci_korisnika){

        $rezultat_upita = [];
        $rezultat = [];
        $poruka = "prazna";
        
        $request = json_decode($podaci_korisnika, false);

        $sifra_predmeta = $request->sifra;
        $naziv = $request->naziv;
        $razredi = $request->razred;

        $upit = $this->ctx->set_query("SELECT * FROM predmet WHERE sifra_predmeta = '{$sifra_predmeta}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if($rezultat_upita){
            if($naziv !== $rezultat_upita['naziv']){

                $upit = $this->ctx->set_query("SELECT * FROM predmet WHERE naziv = '{$naziv}'");
                
                while($red = $upit->fetch_assoc()){
                    $rezultat = $red;
                }

                if($rezultat){
                    $poruka = "Vec postoji predmet sa tim nazivom";
                } else {
                    
                    $this->ctx->get_connection()->begin_transaction();             
                    $upit = $this->ctx->prepare_query("UPDATE predmet SET naziv = (?)
                            WHERE sifra_predmeta = {$sifra_predmeta}");

                    $upit->bind_param("s", $naziv);
                    $upit->execute();

                    $upit = $this->ctx->prepare_query("DELETE FROM razred_ima_predmet
                    WHERE sifra_predmeta = (?)");

                    $upit->bind_param("s", $sifra_predmeta);
                    $upit->execute();

                    $upit = $this->ctx->prepare_query("INSERT INTO razred_ima_predmet(sifra_predmeta, razred)
                            VALUES(?, ?)");

                    $upit->bind_param("ss",$sifra_predmeta, $razred);

                    foreach($razredi as $razred){
                        if(!$upit->execute()){
                            $this->ctx->get_connection()->rollback();
                        }
                    }

                    $this->ctx->get_connection()->commit();
                    $poruka = "Uspesno izmenjen predmet";
                }

            } else {

                $this->ctx->get_connection()->begin_transaction();

                $upit = $this->ctx->prepare_query("UPDATE predmet SET naziv = (?)
                        WHERE sifra_predmeta = {$sifra_predmeta}");

                $upit->bind_param("s", $naziv);
                $upit->execute();


                $upit = $this->ctx->prepare_query("DELETE FROM razred_ima_predmet
                        WHERE sifra_predmeta = (?)");

                $upit->bind_param("s", $sifra_predmeta);
                $upit->execute();


                $upit = $this->ctx->prepare_query("INSERT INTO razred_ima_predmet(sifra_predmeta, razred)
                        VALUES(?, ?)");

                $upit->bind_param("ss",$sifra_predmeta, $razred);

                foreach($razredi as $razred){
                    if(!$upit->execute()){
                        $this->ctx->get_connection()->rollback();
                    }
                }

                $this->ctx->get_connection()->commit();
                $poruka = "Uspesno izmenjen predmet";
            }

        } else {
            $poruka = "Nema takvog predmeta u bazi";
        }

        return $poruka;   
    }

    public function sa_sifrom($podaci_korisnika){

        $request = json_decode($podaci_korisnika, false);
        $podaci = [];   
        $sifra_predmeta = $request->sifra;

        $upit = $this->ctx->set_query("SELECT * FROM predmet
                WHERE sifra_predmeta = '{$sifra_predmeta}'");
        
        while($red = $upit->fetch_assoc()){
            $podaci = $red;
        }

        return $podaci;
    }

    public function sa_sifrom_razredima($podaci_korisnika){

        $request = json_decode($podaci_korisnika, false);
        $podaci = [];
        $rezultat = [];
       
        $sifra_predmeta = $request->sifra;

        $upit = $this->ctx->set_query("SELECT * FROM predmet
                WHERE sifra_predmeta = '{$sifra_predmeta}'");
        
        while($red = $upit->fetch_assoc()){
            $podaci = $red;
        }

        array_push($rezultat, $podaci);

        $upit = $this->ctx->set_query("SELECT * FROM razred_ima_predmet
                WHERE sifra_predmeta = '{$sifra_predmeta}'");

        while($red = $upit->fetch_assoc()){
            $sifre[] = $red;
        }
        array_push($rezultat, $sifre);

        return $rezultat;
    }
}
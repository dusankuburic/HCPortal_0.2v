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

}
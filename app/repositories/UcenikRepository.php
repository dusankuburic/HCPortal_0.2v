<?php
require_once("interfaces/IUcenik.php");
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
        
        $rezultat_upita = [];

        $upit =  $this->ctx->set_query("SELECT * FROM ucenik");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita[] = $red;
        }

        return $rezultat_upita;
    }
}
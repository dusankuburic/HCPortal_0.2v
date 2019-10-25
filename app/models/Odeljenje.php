<?php
require_once("Database.php");

class Odeljenje extends Database {

    private $sifra_odeljenja;

    private $naziv;


    public function __construct(){

        $this->set_parameters(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $this->connect_to_db();

        $this->test_connection();
    }


    public function dodaj_odeljenje($podaci_korisnika){

        $rezultat_upita = [];
        $odeljenje_postoji = true;

        $odeljenje = json_decode($podaci_korisnika, false);

        $this->naziv =  $odeljenje->naziv;

        $upit = $this->set_query("SELECT * FROM odeljenje 
                WHERE naziv = '{$this->naziv}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if(empty($rezultat_upita)){

            $upit = $this->prepare_query("INSERT INTO odeljenje(naziv)
                    VALUES (?)");

            $upit->bind_param("s", $this->naziv);

            $upit->execute();

            $odeljenje_postoji = false;
        }

        return $odeljenje_postoji;
    }


    public function sva_odeljenja(){

        $rezultat_upita = [];

        $upit =  $this->set_query("SELECT * FROM odeljenje");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita[] = $red;
        }

        return $rezultat_upita;
    }
}


?>
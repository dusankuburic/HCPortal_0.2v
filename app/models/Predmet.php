<?php  

require_once("Database.php");


class Predmet extends Database {

    private $id;

    private $naziv;


    public function __construct(){

        $this->set_parameters(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $this->connect_to_db();

        $this->test_connection();
    }





    public function dodaj_predmet($podaci_korisnika){

        $rezultat_upita = [];
        $predmet_postoji = true;

        $predmet = json_decode($podaci_korisnika, false);

        $this->naziv = $predmet->naziv;

        $upit = $this->set_query("SELECT * FROM predmet 
                WHERE naziv = '{$this->naziv}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if(empty($rezultat_upita)){

    
            $upit = $this->prepare_query("INSERT INTO predmet(naziv)
                    VALUES(?)");
    
            $upit->bind_param("s", $this->naziv);

            $upit->execute();

            $predmet_postoji = false;
        }
            
        

        return $predmet_postoji;

    }

    public function svi_predmeti(){


        $rezultat_upita = [];

        $upit =  $this->set_query("SELECT * FROM predmet");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita[] = $red;
        }

        return $rezultat_upita;
    }


}



?>
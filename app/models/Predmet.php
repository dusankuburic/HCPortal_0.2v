<?php  

require_once("Database.php");


class Predmet extends Database {

    public $sifra_predmeta;

    public $naziv;



    public function __construct(){

        $this->set_parameters(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $this->connect_to_db();

        $this->test_connection();
    }


    public function izmeni_predmet($podaci_korisnika){

        $rezultat_upita = [];
        $rezultat = [];
        $poruka = "prazna";

        $predmet = json_decode($podaci_korisnika, false);

        $this->sifra_predmeta = $predmet->sifra;
        $this->naziv = $predmet->naziv;
        $razredi = $predmet->razred;


        $upit = $this->set_query("SELECT * FROM predmet
                WHERE sifra_predmeta = '{$this->sifra_predmeta}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if($rezultat_upita){

            if($this->naziv !== $rezultat_upita['naziv']){

                $upit = $this->set_query("SELECT * FROM predmet
                        WHERE naziv = '{$this->naziv}'");
                
                while($red = $upit->fetch_assoc()){
                    $rezultat = $red;
                }

                if($rezultat){
                    $poruka = "Vec postoji predmet sa tim nazivom";
                } else {

                    $this->connection->begin_transaction();             

                    $upit = $this->prepare_query("UPDATE predmet SET naziv = (?)
                            WHERE sifra_predmeta = {$this->sifra_predmeta}");

                    $upit->bind_param("s", $this->naziv);

                    $upit->execute();


                    $upit = $this->prepare_query("DELETE FROM razred_ima_predmet
                            WHERE sifra_predmeta = {$this->sifra_predmeta}");

                    $upit->bind_param("s", $this->sifra_predmeta);

                    $upit->execute();


                    $upit = $this->prepare_query("INSERT INTO razred_ima_predmet(sifra_predmeta, razred)
                            VALUES(?, ?)");


                    $upit->bind_param("ss",$this->sifra_predmeta, $razred);

                    foreach($razredi as $razred){
                        if(!$upit->execute()){
                            $this->connection->rollback();
                        }
                    }

                    $this->connection->commit();

                    $poruka = "Uspesno izmenjeno odeljenje";
                }
            } else {

                $this->connection->begin_transaction();

                $upit = $this->prepare_query("UPDATE predmet SET naziv = (?)
                        WHERE sifra_predmeta = {$this->sifra_predmeta}");

                $upit->bind_param("s", $this->naziv);

                $upit->execute();


                $upit = $this->prepare_query("DELETE FROM razred_ima_predmet
                        WHERE sifra_predmeta = (?)");

                $upit->bind_param("s", $this->sifra_predmeta);

                $upit->execute();


                $upit = $this->prepare_query("INSERT INTO razred_ima_predmet(sifra_predmeta, razred)
                        VALUES(?, ?)");


                $upit->bind_param("ss",$this->sifra_predmeta, $razred);

                foreach($razredi as $razred){
                    if(!$upit->execute()){
                        $this->connection->rollback();
                    }
                }

                $this->connection->commit();

                $poruka = "Uspesno izmenjen predmet";

            }

        } else {
            $poruka = "Nema takvog predmeta u bazi";
        }

        return $poruka;
    
    }



    public function dodaj_predmet($podaci_korisnika){

        $rezultat_upita = [];
        $poruka = "prazna";


        $predmet = json_decode($podaci_korisnika, false);
        $this->naziv = $predmet->naziv;
        $razredi = $predmet->razred;



        $upit = $this->set_query("SELECT * FROM predmet WHERE naziv = '{$this->naziv}'");


        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if(!$rezultat_upita){

            $this->connection->begin_transaction();
    
            $upit = $this->prepare_query("INSERT INTO predmet(naziv)
                    VALUES(?)");
    
            $upit->bind_param("s", $this->naziv);

            $upit->execute();


            $upit = $this->prepare_query("INSERT INTO razred_ima_predmet(sifra_predmeta, razred)
                VALUES(LAST_INSERT_ID(), ?)");

            $upit->bind_param("s", $razred);

            foreach($razredi as $razred){
                if(!$upit->execute()){
                    $this->connection->rollback();
                }

            }

            $this->connection->commit();

            $poruka = "Uspesno dodat predmet";
            
        } else {
            $poruka = "Vec postoji odeljenje";
        }
            
    

        return $poruka;

    }


    public function sa_sifrom($podaci_korisnika){

        $predmet = json_decode($podaci_korisnika, false);
        $podaci = [];
       
        
        $this->sifra_predmeta = $predmet->sifra;



        $upit = $this->set_query("SELECT * FROM predmet
                WHERE sifra_predmeta = '{$this->sifra_predmeta}'");
        
        while($red = $upit->fetch_assoc()){
            $podaci = $red;
        }

        return $podaci;
    }

    public function sa_sifrom_razredima($podaci_korisnika){

        $predmet = json_decode($podaci_korisnika, false);
        $podaci = [];
        $rezultat = [];
       
        
        $this->sifra_predmeta = $predmet->sifra;

        $upit = $this->set_query("SELECT * FROM predmet
                WHERE sifra_predmeta = '{$this->sifra_predmeta}'");
        
        while($red = $upit->fetch_assoc()){
            $podaci = $red;
        }

       array_push($rezultat, $podaci);


        $upit = $this->set_query("SELECT * FROM razred_ima_predmet
                WHERE sifra_predmeta = '{$this->sifra_predmeta}'");

        while($red = $upit->fetch_assoc()){
            $sifre[] = $red;
        }


        array_push($rezultat, $sifre);


        

        return $rezultat;
    }

}



?>
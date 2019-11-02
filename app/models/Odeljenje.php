<?php
require_once("Database.php");

class Odeljenje extends Database {

    private $sifra_odeljenja;

    private $naziv;

    private $razred;


    public function __construct(){

        $this->set_parameters(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $this->connect_to_db();

        $this->test_connection();
    }


    public function dodaj_odeljenje($podaci_korisnika){

        $rezultat_upita = [];
        $poruka = "";

        $odeljenje = json_decode($podaci_korisnika, false);
        $this->naziv =  $odeljenje->naziv;
        $this->razred = $odeljenje->razred;


        $upit = "SELECT * FROM odeljenje WHERE naziv = '{$this->naziv}'";
        $result = mysqli_query($this->connection, $upit);
   

        $redovi = mysqli_num_rows($result);
        for($i = 0; $i < $redovi; $i++){
            $rezultat_upita[] = mysqli_fetch_assoc($result);
        }


        if(!$rezultat_upita){

            $upit = $this->prepare_query("INSERT INTO odeljenje(naziv, razred)
                    VALUES(?,?)");

            $upit->bind_param("ss", $this->naziv, $this->razred);

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

        $odeljenje = json_decode($podaci_korisnika, false);

        $this->sifra_odeljenja = $odeljenje->sifra;
        $this->naziv = $odeljenje->naziv;
        $this->razred = $odeljenje->razred;


        $upit = $this->set_query("SELECT * FROM odeljenje 
                WHERE sifra_odeljenja = '{$this->sifra_odeljenja}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }


        if($rezultat_upita){

            if($this->naziv !== $rezultat_upita['naziv']){
                
                $upit = $this->set_query("SELECT * FROM odeljenje
                        WHERE naziv = '{$this->naziv}'");
                
                while($red = $upit->fetch_assoc()){
                    $rezultat = $red;
                }

                if($rezultat){
                    $poruka = "Vec postoji odeljenje sa tim nazivom";
                } else {

                    $upit = $this->prepare_query("UPDATE odeljenje SET
                            naziv = (?),
                            razred = (?)
                            WHERE sifra_odeljenja = {$this->sifra_odeljenja}");

                    $upit->bind_param("ss", $this->naziv, $this->razred);

                    $upit->execute();

                    $poruka = "Uspesno izmenjeno odeljenje";
                }
            }
            else {
                
                $upit = $this->prepare_query("UPDATE odeljenje SET
                        naziv = (?),
                        razred = (?)
                        WHERE sifra_odeljenja = {$this->sifra_odeljenja}");
                
                $upit->bind_param("ss", $this->naziv, $this->razred);

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

        $upit =  $this->set_query("SELECT * FROM odeljenje");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita[] = $red;
        }

        return $rezultat_upita;
    }

    public function sa_sifrom($podaci_korisnika){

        $odeljenje = json_decode($podaci_korisnika, false);
        $podaci = [];
       
        
        $this->sifra_odeljenja = $odeljenje->sifra;


        $upit = "SELECT * FROM odeljenje WHERE 
                sifra_odeljenja = '{$this->sifra_odeljenja}'";
        
        $rezultat_upita = mysqli_query($this->connection, $upit);
        $redovi = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $redovi; $i++){
            $podaci = mysqli_fetch_assoc($rezultat_upita);
        }

        return $podaci;

    }
    
}


?>
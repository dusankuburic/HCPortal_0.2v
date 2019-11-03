<?php  

require_once("Database.php");


class Predmet extends Database {

    private $sifra_predmeta;

    private $naziv;

    private $razred;


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
        $this->razred = $predmet->razred;


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
                    
                    $upit = $this->prepare_query("UPDATE predmet SET
                            naziv = (?),
                            razred = (?)
                            WHERE sifra_predmeta = {$this->sifra_predmeta}");
                    
                    $upit->bind_param("ss", $this->naziv, $this->razred);

                    $upit->execute();

                    $poruka = "Uspesno izmenjeno odeljenje";
                }
            } else {

                $upit = $this->prepare_query("UPDATE predmet SET
                        naziv = (?),
                        razred = (?)
                        WHERE sifra_predmeta = {$this->sifra_predmeta}");
                
                $upit->bind_param("ss", $this->naziv, $this->razred);

                $upit->execute();

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
        $this->razred = $predmet->razred;



        $upit = $this->set_query("SELECT * FROM predmet WHERE naziv = '{$this->naziv}'");


        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if(!$rezultat_upita){

    
            $upit = $this->prepare_query("INSERT INTO predmet(naziv, razred)
                    VALUES(?, ?)");
    
            $upit->bind_param("ss", $this->naziv, $this->razred);

            $upit->execute();

            $poruka = "Uspesno dodat predmet";
        } else {
            $poruka = "Vec postoji odeljenje";
        }
            
        

        return $poruka;

    }

    public function svi_predmeti(){


        $rezultat_upita = [];

        $upit =  $this->set_query("SELECT * FROM predmet");
        
        while($red = $upit->fetch_assoc()){
            $rezultat_upita[] = $red;
        }

        return $rezultat_upita;
    }


    public function sa_sifrom($podaci_korisnika){

        $predmet = json_decode($podaci_korisnika, false);
        $podaci = [];
       
        
        $this->sifra_predmeta = $predmet->sifra;


        $upit = "SELECT * FROM predmet WHERE 
                sifra_predmeta = '{$this->sifra_predmeta}'";
        
        $rezultat_upita = mysqli_query($this->connection, $upit);
        $redovi = mysqli_num_rows($rezultat_upita);

        for($i = 0; $i < $redovi; $i++){
            $podaci = mysqli_fetch_assoc($rezultat_upita);
        }

        return $podaci;

    }

}



?>
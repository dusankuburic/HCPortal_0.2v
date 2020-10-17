<?php

require_once("Database.php");

class Profesor extends Database {

    public $sifra_profesora;

    public $ime;

    public $prezime;

    public $korisnicko_ime;

    public $sifra;

    public $datum_rodjenja;

    public $mesto_stanovanja;

    public $jmbg;

    public $pol;



    public function __construct(){

        $this->set_parameters(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $this->connect_to_db();

        $this->test_connection();
    }


}
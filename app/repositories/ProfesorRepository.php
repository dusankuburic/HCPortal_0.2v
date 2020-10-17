<?php
require_once("interfaces/IProfesor.php");
require_once("../../models/Profesor.php");

class ProfesorRepository implements IProfesor {

    private $ctx;

    public function __construct($ctx_) {
        $this->ctx = $ctx_;
    }

    public function svi_profesori(){
        
        $rezultat_upita = [];

        $upit =  $this->ctx->set_query("SELECT * FROM profesor");
        
        while($red = $upit->fetch_assoc()){
            $profesor = new Profesor();
            
            $profesor->sifra_profesora = $red["sifra_profesora"];
            $profesor->ime = $red["ime"];
            $profesor->prezime = $red["prezime"];
            $profesor->korisnicko_ime = $red["korisnicko_ime"];
            $profesor->mesto_stanovanja = $red["mesto_stanovanja"];
            $profesor->jmbg = $red["jmbg"];

            $rezultat_upita[] = $profesor;
        }

        return $rezultat_upita;
    }

    public function dodaj_profesora($podaci_korisnika){

        $rezultat_upita = [];
        $profesor_postoji = true;
        $profesor = new Profesor();

        $request = json_decode($podaci_korisnika, false);

        $profesor->ime = $request->ime;
        $profesor->prezime = $request->prezime;
        $profesor->mesto_stanovanja = $request->mesto_stanovanja;
        $profesor->jmbg = $request->jmbg;
        $profesor->korisnicko_ime = $request->korisnicko_ime;
        $profesor->sifra = password_hash($request->sifra, PASSWORD_DEFAULT);

        $upit = $this->ctx->set_query("SELECT * FROM profesor
                WHERE korisnicko_ime = '{$profesor->korisnicko_ime}'");

        while($red = $upit->fetch_assoc()){
            $rezultat_upita = $red;
        }

        if(!$rezultat_upita){

            $upit = $this->ctx->prepare_query("INSERT INTO profesor(
                ime,
                prezime,
                mesto_stanovanja,
                jmbg,
                korisnicko_ime,
                sifra)
                VALUE(?, ?, ?, ?, ?, ?)");

            $upit->bind_param("ssssss",
                $profesor->ime,
                $profesor->prezime,
                $profesor->mesto_stanovanja,
                $profesor->jmbg,
                $profesor->korisnicko_ime,
                $profesor->sifra);

            $upit->execute();

            $profesor_postoji = false;
        }

        return $profesor_postoji;
    }

}

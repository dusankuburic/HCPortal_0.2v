<?php

interface IProfesor {

    public function svi_profesori();

    public function dodaj_profesora($podaci_korisnika);

    public function izmeni_profesora($podaci_korisnika);

    public function sa_sifrom($podaci_korisnika);

    public function prijava($podaci_korisnika);

    public function upisi_ocenu($podaci_korisnika);

    public function dodeli_predmete($podaci_korisnika);
}
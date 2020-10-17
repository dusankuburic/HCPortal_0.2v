<?php

interface IPredmet {

    public function svi_predmeti();

    public function dodaj_predmet($podaci_korisnika);

    public function izmeni_predmet($podaci_korisnika);

    public function sa_sifrom($podaci_korisnika);

    public function sa_sifrom_razredima($podaci_korisnika);
}
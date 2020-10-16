<?php

interface IOdeljenje {

    public function dodaj_odeljenje($podaci_korisnika);

    public function izmeni_odeljenje($podaci_korisnika);

    public function sva_odeljenja();

    public function sva_odeljenja_sa_razredom($podaci_korisnika);

    public function sa_sifrom($podaci_korisnika);
}
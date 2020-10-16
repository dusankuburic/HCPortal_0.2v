<?php


interface IUcenik {

    public function svi_ucenici();

    public function dodaj_ucenika($podaci_korisnika);

    public function izmeni_ucenika($podaci_korisnika);

    public function sa_sifrom($podaci_korisnika);

    public function ocene_sa_polugodista($podaci_korisnika);

    public function sa_sifrom_odeljenja($podaci_korisnika);

    public function predmeti_koje_uci($podaci_korisnika);

    public function prijava($podaci_korisnika);

}
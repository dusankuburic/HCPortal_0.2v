<?php


interface IUcenik {

    public function svi_ucenici();

    public function dodaj_ucenika($podaci_korisnika);

    public function izmeni_ucenika($podaci_korisnika);

    public function sa_sifrom($podaci_korisnika);

}
<?php
interface IModerator {

    public function prijava($podaci_korisnika);

    public function svi_moderatori();

    public function dodaj_moderatora($podaci_korisnika);

    public function izmeni_moderatora($podaci_korisnika);

    public function sa_sifrom($podaci_korisnika);
}
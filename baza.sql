CREATE TABLE odeljenje(
sifra_odeljenja INTEGER NOT NULL AUTO_INCREMENT,
naziv VARCHAR(60) NOT NULL,
razred INT NOT NULL,
PRIMARY KEY(sifra_odeljenja)
);

CREATE TABLE predmet(
sifra_predmeta INTEGER NOT NULL AUTO_INCREMENT,
naziv VARCHAR(60) NOT NULL,
razred INT NOT NULL,
PRIMARY KEY(sifra_predmeta)
);

/* da lida napravim tabelu razred......
*/

CREATE Table moderator(
sifra_moderatora INTEGER NOT NULL AUTO_INCREMENT,
ime VARCHAR(40) NOT NULL,
prezime VARCHAR(40) NOT NULL,
korisnicko_ime VARCHAR(40) NOT NULL,
sifra VARCHAR(255) NOT NULL,
datum_rodjenja TIMESTAMP NOT NULL,
PRIMARY KEY(sifra_moderatora)
);

CREATE TABLE profesor(
sifra_profesora INTEGER NOT NULL AUTO_INCREMENT,
ime VARCHAR(40) NOT NULL,
prezime VARCHAR(40) NOT NULL,
korisnicko_ime VARCHAR(40) NOT NULL,
sifra VARCHAR(255) NOT NULL,
datum_rodjenja DATE NOT NULL,
mesto_stanovanja VARCHAR(100) NOT NULL,
jmbg VARCHAR(17) NOT NULL,
pol VARCHAR(7) NOT NULL,
PRIMARY KEY(sifra_profesora)
);


CREATE TABLE ucenik(
sifra_ucenika INTEGER NOT NULL AUTO_INCREMENT,
ime VARCHAR(40) NOT NULL,
prezime VARCHAR(40) NOT NULL,
korisnicko_ime VARCHAR(40) NOT NULL,
sifra VARCHAR(255) NOT NULL,
datum_rodjenja DATE NOT NULL,
mesto_stanovanja VARCHAR(100) NOT NULL,
jmbg VARCHAR(17) NOT NULL,
pol VARCHAR(7) NOT NULL,
ime_staratelja VARCHAR(40) NOT NULL,
prezime_staratelja VARCHAR(40) NOT NULL,
kontakt_telefon VARCHAR(40) NOT NULL,
sifra_odeljenja INTEGER,
PRIMARY KEY(sifra_ucenika),
FOREIGN KEY(sifra_odeljenja) REFERENCES odeljenje(sifra_odeljenja)
);



/* ######################################################################### */
CREATE TABLE ucenik_ima_ocenu (
    sifra_ucenika INTEGER,
    sifra_predmeta INTEGER,
    ocena INTEGER NOT NULL,
    polugodiste INTEGER NOT NULL,
    opis VARCHAR(50) NOT NULL,
    datum_izmene TIMESTAMP,
    FOREIGN KEY(sifra_ucenika) REFERENCES ucenik(sifra_ucenika),
    FOREIGN KEY(sifra_predmeta) REFERENCES predmet(sifra_predmeta)
);


CREATE TABLE ucenik_uci_predmet (
    sifra_ucenika INTEGER,
    sifra_predmeta INTEGER,
    FOREIGN KEY(sifra_ucenika) REFERENCES ucenik(sifra_ucenika),
    FOREIGN KEY(sifra_predmeta) REFERENCES predmet(sifra_predmeta)
);


CREATE TABLE razred_ima_predmet(
    sifra_predmeta INTEGER,
    razred INTEGER,
    FOREIGN KEY(sifra_predmeta) REFERENCES predmet(sifra_predmeta)
);


CREATE TABLE odeljenje_ima_razrednog (
    sifra_odeljenja INTEGER NULL,
    sifra_profesora INTEGER NULL,
    FOREIGN KEY(sifra_odeljenja) REFERENCES odeljenje(sifra_odeljenja),
    FOREIGN KEY(sifra_profesora) REFERENCES profesor(sifra_profesora)
);

CREATE TABLE prisustvo_ucenika(
    sifra_ucenika INTEGER NOT NULL AUTO_INCREMENT,
    broj_opravdanih INTEGER NULL,
    broj_neopravdanih INTEGER NULL,
    polugodiste INTEGER NOT NULL,
    datum_izmene TIMESTAMP,
    FOREIGN KEY(sifra_ucenika) REFERENCES ucenik(sifra_ucenika)

);

CREATE TABLE profesor_predaje_predmet_odeljenju(
    sifra_profesora INTEGER,
    sifra_predmeta INTEGER,
    sifra_odeljenja INTEGER,
    FOREIGN KEY(sifra_profesora) REFERENCES profesor(sifra_profesora),
    FOREIGN KEY(sifra_predmeta) REFERENCES predmet(sifra_predmeta),
    FOREIGN KEY(sifra_odeljenja) REFERENCES odeljenje(sifra_odeljenja)
);
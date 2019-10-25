<?php require_once("navbar.php"); ?>

<div class="d-flex" id="wrapper">

    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="list-group">

            <!-- Odeljenja-->
            <div class="dropdown">
            <a class="list-group-item list-group-item-action bg-light "  id="dropdownMenu"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-graduation-cap"></i> Odeljenja
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                <a class="dropdown-item" href="../layouts/moderator.php?route=pregled_odeljenja">Pregled odeljenja</a>
                <a class="dropdown-item" href="../layouts/moderator.php?route=dodaj_odeljenje">Dodaj odeljenje</a>
            </div>
            </div>
            
            
            <!--Predmeti-->
            <div class="dropdown">
            <a class="list-group-item list-group-item-action bg-light "  id="dropdownMenu"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-book-open"></i> Predmeti 
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                <a class="dropdown-item" href="../kategorija/sve_kategorije.php">Pregled predmeta</a>
                <a class="dropdown-item" href="../kategorija/dodaj_kategoriju.php">Dodaj predmet</a>
            </div>
            </div>



        </div>
        <!-- list-group END -->
    </div>
        <!-- side-wrapper END -->
        
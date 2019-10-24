<?php require_once("resources/views/includes/head.php"); ?>

<div class="row justify-content-center"> 
    <div class="col-lg-4">

        <h2>Pocetna</h2>
      <!--   <a class="btn btn-danger" href="resources/views/layouts/student.php?route=svi_predmeti">Studenti</a> -->
        <br><br>
        <a class="btn btn-success"  href="resources/views/layouts/pages.php?route=prijava_ucenik">Ucenik login</a>
        <br><br>
        <a class="btn btn-primary"  href="resources/views/layouts/pages.php?route=prijava_profesor">Profesor login</a>
        <br><br>
        <a class="btn btn-info"  href="resources/views/layouts/pages.php?route=prijava_moderator">Moderator login</a>
        <br><br>

        <?php
            if(isset($_SESSION['ucenik'])){
               echo "<a href='resources/views/layouts/ucenik.php'>Profil</a>";
            }

            if(isset($_SESSION['profesor'])){
                echo "<a href='resources/views/layouts/profesor.php'>Profil</a>";
            }

            if(isset($_SESSION['moderator'])){
                echo "<a href='resources/views/layouts/moderator.php'>Profil</a>";
            }
        ?>

    </div>
</div>



<?php require_once("resources/views/includes/footer.php"); ?>







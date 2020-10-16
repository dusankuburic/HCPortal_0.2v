
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="resources/views/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="resources/views/includes/css/all.min.css" rel="stylesheet">
    <title>Hello, world!</title>
  </head>

<body>

    <div class="row justify-content-center"> 
        <div class="col-lg-4">

            <h2>Pocetna</h2>
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


 


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="resources/views/bootstrap/jquery-3.3.1.slim.min.js"></script>
        <script src="resources/views/bootstrap/popper.min.js" ></script>
        <script src="resources/views/bootstrap/js/bootstrap.min.js"></script>



        <!-- open menu  on resize-->
        <script>
            $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
            });
        </script>
    </body>

</html>







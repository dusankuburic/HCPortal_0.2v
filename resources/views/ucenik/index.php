<?php if(!isset($_SESSION['ucenik'])){  header("Location: ../../../index.php");} ?>
<?php require_once("../includes/sidebar.php"); ?>
    
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <?php
                echo "<h4> Pocetna strana</h4><br><br>";
                echo "Ucenik: ".$_SESSION['ucenik']. " je ulogovan";
                ?>

                <form method="post"> 
                    <input type="submit" name="odjava" value="Odjavi se">
                </form>

                <?php
                if(isset($_POST['odjava'])){
                    session_unset($_SESSION['ucenik']);
                    session_destroy();

                    header("Location: ../layouts/ucenik.php");
                }
                ?>

            </div>
        </div>
    </div>
    <!-- page-content-wrapper END -->  
</div>
    <!-- d-flex wrapper END -->
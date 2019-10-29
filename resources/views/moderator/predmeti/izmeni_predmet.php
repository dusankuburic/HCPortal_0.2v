
<?php require_once("../includes/sidebar.php"); ?>
    
    <div id="page-content-wrapper">
        <div class="container-fluid">
        <p id="poruka"></p>
        <h1 class="text-center">Izmeni predmet</h1>
        <br>
            <div class="row justify-content-center">
                <div class="col-lg-7 forma">
                    <form method="post" onsubmit="izmeni_predmet()">
                        <div class="form-group">
                            <h4>Naziv predmeta</h4>
                            <input type="hidden" value="" id="sifra">
                            <input type="text" id="naziv" class="form-control" value="<?php if(isset($_GET['sifra'])){ echo $_GET['sifra'];} ?>">
                        </div>


                        <input type="submit" class="btn btn-primary float-right" onclick="" value="Sacuvaj">
                        <br><br>
                    </form>

                </div>


            
            </div>
        </div>

    </div>
    <!-- page-content-wrapper END -->

    
</div>
    <!-- d-flex wrapper END -->

    <script src="../../js/moderator/izmeni_predmet.js"></script>
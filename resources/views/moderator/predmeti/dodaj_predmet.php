

<?php require_once("../includes/sidebar.php"); ?>
    
    <div id="page-content-wrapper">
        <div class="container-fluid">
        <h1 class="text-center">Dodaj predmet</h1>
        <br>
            <div class="row justify-content-center">
                <div class="col-lg-7 forma">
                    <form method="post">
                        <div class="form-group">
                            <h4>Naziv predmeta</h4>
                            <input type="text" id="naziv" class="form-control">
                        </div>

                        <input type="submit" class="btn btn-primary float-right" onclick="dodaj_predmet()" value="Dodaj">
                        <br><br>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- page-content-wrapper END -->

    
</div>
    <!-- d-flex wrapper END -->

    <script src="../../js/moderator/dodaj_predmet.js"></script>


<?php require_once("../includes/sidebar.php"); ?>
    
    <div id="page-content-wrapper">
        <div class="container-fluid">
        <p id="poruka"></p>
        <h1 class="text-center">Dodaj odeljenje</h1>
        <br>
            <div class="row justify-content-center">
                <div class="col-lg-7 forma">
                    <form method="post" onsubmit="return dodaj_odeljenje()">
                        <div class="form-group">
                            <h4>Naziv odeljenja</h4>
                            <input type="text" id="naziv" class="form-control">
                        </div>

                        <input type="submit" class="btn btn-primary float-right" onclick="" value="Dodaj">
                        <br><br>
                    </form>

                </div>


            
            </div>
        </div>

    </div>
    <!-- page-content-wrapper END -->

    
</div>
    <!-- d-flex wrapper END -->

    <script src="../../js/moderator/dodaj_odeljenje.js"></script>
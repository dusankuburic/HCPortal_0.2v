
<?php require_once("../includes/sidebar.php"); ?>
    
    <div id="page-content-wrapper">
        <div class="container-fluid">
        <p id="poruka"></p>
        <h1 class="text-center">Izmeni odeljenje</h1>
        <br>
            <div class="row justify-content-center">
                <div class="col-lg-7 forma">
                    <form method="post" onsubmit="return izmeni_odeljenje()">
                        <div class="form-group">
                            <h4>Naziv odeljenja</h4>
                            <input type="hidden" value="" id="sifra">
                            <input type="text" id="naziv" class="form-control" value="<?php if(isset($_GET['sifra'])){ echo $_GET['sifra'];} ?>">
                        </div>

                        <div class="form-group">
                            <h4>Razred</h4>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="prvi" value="1" checked="checked">
                                <label class="form-check-label" for="inlineRadio1">Prvi</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="drugi" value="2">
                                <label class="form-check-label" for="inlineRadio1">Drugi</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="treci" value="3">
                                <label class="form-check-label" for="inlineRadio1">Treci</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="cetvrti" value="4">
                                <label class="form-check-label" for="inlineRadio1">Cetvrti</label>
                            </div>
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

    <script src="../../js/moderator/izmeni_odeljenje.js"></script>
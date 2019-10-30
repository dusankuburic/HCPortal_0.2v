
<?php require_once("../includes/sidebar.php"); ?>
    
    <div id="page-content-wrapper">
        <div class="container-fluid">
        <p id="poruka"></p>
        <h1 class="text-center">Izmeni profesora</h1>
        <br>
            <div class="row justify-content-center">
                <div class="col-lg-5 forma">
                    <form method="POST" onsubmit="return izmeni_profesora()">
                    <input type="hidden" id="sifra" class="form-control" value="<?php if(isset($_GET['sifra'])){ echo $_GET['sifra'];} ?>">
                        <div class="form-group">
                            <h4>Ime</h4>
                            <input type="text" id="ime" class="form-control">
                        </div>

                        <div class="form-group">
                            <h4>Prezime</h4>
                            <input type="text" id="prezime" class="form-control">
                        </div>

                        <div class="form-group">
                            <h4>Mesto stanovanja</h4>
                            <input type="text" id="mesto_stanovanja" class="form-control">
                        </div>

                        <div class="form-group">
                            <h4>Jmbg</h4>
                            <input type="text" id="jmbg" class="form-control">
                        </div>

                        <div class="form-group">
                            <h4>Korisnicko ime</h4>
                            <input type="text" id="kor_ime" class="form-control">
                        </div>
                        <br>

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

    <script src="../../js/moderator/izmeni_profesora.js"></script>
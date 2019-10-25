

<?php require_once("../includes/sidebar.php"); ?>
    
    <div id="page-content-wrapper">
        <div class="container-fluid">
        <p id="poruka"></p>
        <h1 class="text-center">Dodaj moderatora</h1>
        <br>
            <div class="row justify-content-center">
                <div class="col-lg-5 forma">
                    <form method="POST" onsubmit="return validacija()">
                        <div class="form-group">
                            <h4>Ime</h4>
                            <input type="text" id="ime" class="form-control">
                        </div>

                        <div class="form-group">
                            <h4>Prezime</h4>
                            <input type="text" id="prezime" class="form-control">
                        </div>

                        <div class="form-group">
                            <h4>Korisnicko ime</h4>
                            <input type="text" id="kor_ime" class="form-control">
                        </div>

                        <div class="form-group">
                            <h4>Sifra</h4>
                            <input type="text" id="sifra" class="form-control">
                        </div>

                        <div class="from-group">
                            <h4>Potvrdi sifru</h4>
                            <input type="text" id="sifra_pot" class="form-control">
                        </div>
                        <br>

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

    <script src="../../js/moderator/dodaj_moderatora.js"></script>
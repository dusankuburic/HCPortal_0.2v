<?php require_once("../includes/sidebar.php"); ?>
  
  <div id="page-content-wrapper" >
  <div id="greska"></div>

    <div class="container-fluid">
      <h1 class="text-center pt-5">Dodela predmeta</h1>
    
          <div class="row justify-content-center pt-3">
          <input type="hidden" id="sifra" class="form-control" value="<?php if(isset($_GET['sifra'])){ echo $_GET['sifra'];} ?>">
          <table class="table table-striped">
            <thead>
                <tr>
                <th>Šifra</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Korisničko ime</th>
                <th>Mesto stanovanja</th>
                <th>Jmbg</th>    
                </tr>
            <thead>
            <tbody id="profesor">
            </tbody>
        </table>
        <br><br>
        </div>
        <hr>
        <form method="POST" onsubmit="return dodeli_predmete()">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-6 forma1">
                        <h3 class="text-center">Predmeti</h3>
                        <br>
                        <div class="text-center" id="predmeti"></div>
                        <br>
                    </div>

                    <div class="col-lg-6 forma1">
                        <h3 class="text-center">Odeljenja</h3>
                        <br>
                        <div class="text-center" id="odeljenja"></div>
                        <br>
                    </div>
                </div> <!-- row end -->

            </div> <!-- container-fluid end -->
            <br>
            <div class="text-center">
            <input type="submit" class="btn btn-primary btn-lg" value="Dodeli">
            </div>
        </form>
    </div>

  </div>
  <!-- page-content-wrapper END -->

  
</div>
  <!-- d-flex wrapper END -->


  <script src="../../js/moderator/dodela_predmeta.js"></script>


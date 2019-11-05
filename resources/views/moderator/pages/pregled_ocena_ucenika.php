<?php require_once("../includes/sidebar.php"); ?>
  
  <div id="page-content-wrapper" >
  <div id="greska"></div>
      <div class="container-fluid">
      <h1 class="text-center pt-5">Pregled ocena</h1>
      <input type="hidden" id="sifra_ucenika" class="form-control" value="<?php if(isset($_GET['sifra_ucenika'])){ echo $_GET['sifra_ucenika'];} ?>">
      <input type="hidden" id="sifra_predmeta" class="form-control" value="<?php if(isset($_GET['sifra_predmeta'])){ echo $_GET['sifra_predmeta'];} ?>">
      <table class="table table-striped">
      <thead>
        <tr>
          <th>Šifra</th>
          <th>Ime</th>
          <th>Prezime</th>
          <th>Mesto stanovanja</th>
          <th>Jmbg</th>
          <th>Ime staratelja</th>
          <th>Prezime staratelja</th>
          <th>Kontakt telefon</th>
          <th>Korisničko ime</th>
        </tr>
      <thead>
      <tbody id="ucenik">
      
      </tbody>
      </table>
      <br></br>

      <div class="container-fluid">
          <h1 class='text-center' id="naziv_predmeta"></h1>
          <hr>
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <table class="table table-striped">
              <thead>
                <tr>
                  <h2 class="text-center">Prvo polugodište</h2>
                </tr>
                <tr>
                  <th>Ocena</th>
                  <th>Opis</th>
                  <th>Vreme upisa</th>
                </tr>
              </thead>
              <tbody id="prvo_polugodiste">
              
              </tbody>
            </table>
          </div>
          <div class="col-lg-6">
            <table class="table table-striped">
              <thead>
                <tr>
                  <h2 class="text-center">Drugo polugodište</h2>
                </tr>
                <tr>
                  <th>Ocena</th>
                  <th>Opis</th>
                  <th>Vreme upisa</th>
                </tr>
              </thead>
              <tbody id="drugo_polugodiste">
              </tbody>
            </table>
          </div>
        </div>
      </div>

    <hr>
    <br><br>
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-lg-4 forma">
                <h3 class='text-center'>Odabir ocene</h3>
                <br>
                <form method="POST" onsubmit="upisi_ocenu()">

                  <div class="form-group">
                  <h4>Opis</h4>
                      <select class="form-control" id="opis">
                        <option value="1">Kontrolni zadatak</option>
                        <option value="2">Pismeni zadatak</option>
                        <option value="3">Usmeno odgovaranje</option>
                        <option value="4">Aktivnost na nastavi</option>
                      </select>
                  </div>
                    
                  <h4>Ocena</h4>
                  <div class="form-group">
                  <select class="form-control" id="ocena">
                        <option value="1">1 (Nedovoljan)</option>
                        <option value="2">2 (Dovoljan)</option>
                        <option value="3">3 (Dobar)</option>
                        <option value="4">4 (Vrlo dobar)</option>
                        <option value="5">5 (Odličan)</option>
                  </select>
                  </div>

                  <h4>Polugodište</h4>
                  <div class="form-group">
                  <select class="form-control" id="polugodiste">
                        <option value="1">Prvo</option>
                        <option value="2">Drugo</option>
                  </select>
                    </div>
                    <input type="submit" class="btn btn-primary float-right" id="test" value="Upiši" > 
                    <br><br>
                </form>
                
          </div>
        </div>
      </div>
      <br>
     



  </div>
  <!-- page-content-wrapper END -->

  
</div>
  <!-- d-flex wrapper END -->
  <script src="../../js/moderator/pregled_ocena_ucenika.js"></script>
  <script src="../../js/moderator/upisi_ocenu.js"></script>
  

  

  
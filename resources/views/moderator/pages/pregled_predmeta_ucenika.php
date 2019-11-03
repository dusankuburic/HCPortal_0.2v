
<?php require_once("../includes/sidebar.php"); ?>

  <div id="page-content-wrapper" >
  <div id="greska"></div>
      <div class="container-fluid">
      <h1 class="text-center pt-5">Pregled predmeta</h1>
      <input type="hidden" id="sifra" class="form-control" value="<?php if(isset($_GET['sifra'])){ echo $_GET['sifra'];} ?>">
          <div class="row justify-content-center">

          <div class="col-lg-7" >
              <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th>Sifra</th>
                        <th>Naziv</th>
                        <th>Ocene</th>
                      </tr>
                    </thead>
                    <tbody id="predmeti">
                    
                    </tbody>
                  </table>            

          </div>


          
          </div>
      </div>

  </div>
  <!-- page-content-wrapper END -->

  
</div>
  <!-- d-flex wrapper END -->

  <script src="../../js/moderator/pregled_predmeta_ucenika.js"></script>
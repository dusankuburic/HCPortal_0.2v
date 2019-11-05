
<?php require_once("../includes/sidebar.php"); ?>
  
  <div id="page-content-wrapper" >
  <div id="greska"></div>
      <div class="container-fluid">
      <h1 class="text-center pt-5">Pregled učenika</h1>
      <h4 class="text-center" id="naziv_odeljenja"></h4>
      <h4 class="text-center" id="razred"></h4>
      
          <div class="row justify-content-center">
          <input type="hidden" id="sifra" class="form-control" value="<?php if(isset($_GET['sifra'])){ echo $_GET['sifra'];} ?>">
          <div class="col-lg-8">
              <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th>Sifra</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Jmbg</th>
                        <th>Korisnicko ime</th>
                        <th>Pregled predmeta</th>
                      </tr>
                    </thead>
                    <tbody id="ucenici">
                    
                    </tbody>
                  </table>            

          </div>


          
          </div>
      </div>

  </div>
  <!-- page-content-wrapper END -->

  
</div>
  <!-- d-flex wrapper END -->


  <script src="../../js/moderator/pregled_ucenika_iz_odeljenja.js"></script>

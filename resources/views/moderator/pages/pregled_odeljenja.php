<?php require_once("../includes/sidebar.php"); ?>
  
  <div id="page-content-wrapper" >
  <div id="greska"></div>
      <div class="container-fluid">
      <h1 class="text-center pt-5">Pregled odeljenja</h1>
     
          <div class="row justify-content-center pt-3">
          <input type="hidden" id="razred" class="form-control" value="<?php if(isset($_GET['razred'])){ echo $_GET['razred'];} ?>">
          <div class='col-7'>
          <table class="table table-hover text-center">
                      <thead>
                        <tr>
                          <th>Sifra</th>
                          <th>Naziv</th>
                          <th>Pregledaj učenike</th>
                        </tr>
                      </thead>
                      <tbody id="odeljenja">
                      
                      </tbody>
                    </table>            

          </div>

          
          </div>
      </div>

  </div>
  <!-- page-content-wrapper END -->

  
</div>
  <!-- d-flex wrapper END -->

  <script src="../../js/moderator/pregled_odeljenja_sa_razredom.js"></script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand"  id="menu-toggle"  href="#">Portal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
            <?php
            if(isset($_SESSION['moderator'])){
                echo '<a class="nav-item nav-link" href="../layouts/moderator.php">Glavna <i class="fas fa-tachometer-alt"></i></a>';

            }

            if(isset($_SESSION['profesor'])){
                echo '<a class="nav-item nav-link" href="../layouts/profesor.php">Glavna <i class="fas fa-tachometer-alt"></i></a>';

            }

            if(isset($_SESSION['ucenik'])){
                echo '<a class="nav-item nav-link" href="../layouts/ucenik.php">Glavna <i class="fas fa-tachometer-alt"></i></a>';

            } 
        
            ?>

            <a class="nav-item nav-link" href="../../../index.php">Pocetna <i class="fas fa-home"></i></a>
            <?php
            if(isset($_SESSION['moderator'])){
                echo "<a class='nav-item nav-link' href='#'>{$_SESSION['moderator']} <i class='fas fa-user-circle'></i></a>";

            }

            if(isset($_SESSION['profesor'])){
                echo "<a class='nav-item nav-link' href='#'>{$_SESSION['profesor']} <i class='fas fa-user-circle'></i></a>";

            }

            if(isset($_SESSION['ucenik'])){
                echo "<a class='nav-item nav-link' href='#'>{$_SESSION['ucenik']} <i class='fas fa-user-circle'></i></a>";

            } 
        
            ?>
            <a class="nav-item nav-link" href="../../src/includes/odjavi_korisnika.php">Odjavi se <i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </nav>
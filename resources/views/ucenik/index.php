<?php
echo "<h4> Pocetna strana</h4><br><br>";
echo "Ucenik: ".$_SESSION['ucenik']. " je ulogovan";
?>

<form method="post"> 
    <input type="submit" name="odjava" value="Odjavi se">
</form>

<?php
if(isset($_POST['odjava'])){
    session_unset($_SESSION['ucenik']);
    session_destroy();

    header("Location: ../layouts/ucenik.php");
}
?>
<?php  

require_once("Database.php");


class Predmet extends Database {

    private $id;

    private $naziv;


    public function __construct(){

        $this->set_parameters(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $this->connect_to_db();

        $this->test_connection();
    }


    public function svi_predmeti(){

        $arr = [];

        //$query = $this->set_query("SELECT * FROM predmeti");

        $query = "SELECT * FROM predmet";

        $result = mysqli_query($this->get_connection(), $query);

        if(!$result) {
            die("cannot fetch data".mysqli_error($this->get_connection()));
        }

        /*
        while($row = $query->fetch_assoc()){
            $result[] = $row;
        }*/


        $rows = mysqli_num_rows($result);

        for($i = 0; $i < $rows; $i++){
            $arr[] = mysqli_fetch_assoc($result);
        }

        return $arr;
    }


}



?>
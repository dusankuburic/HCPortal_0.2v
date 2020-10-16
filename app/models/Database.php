<?php 

require_once("IConnection.php"); 
require_once("../../config/config.php"); 


class Database implements IConnection {
    /**
     * string
    */
    private $db_host;
    /**
     * string
    */
    private $db_user;
    /**
     * string
    */
    private $db_password;
    /**
     * string
    */
    private $db_name;
    /**
     * mixed
    */
    protected $connection;


    public function __construct() {
        $this->set_parameters(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->connect_to_db();
        $this->test_connection();
    }

    function __desturct(){
        if($connection){
            mysqli_colse($connection);
        }
    }

    public function connect_to_db(){
        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_name);
    }

    public function set_parameters($host, $user, $password, $name){
        
        $this->db_host = $host;
        $this->db_user = $user;
        $this->db_password = $password;
        $this->db_name = $name;
    }

    public function test_connection(){
        
        if($this->connection->connect_errno){
            echo "DB CONNECT ERROR". $connection->connect_error;
        }
    }

    public function get_connection(){
        if(!isset($this->connection)){
            echo "EMPTY CONNECTION";
        } 
        return $this->connection;
    }

    public function prepare_query($query){
        return $this->get_connection()->prepare($query);
    }

    public function set_query($query){
    
        return $this->get_connection()->query($query);
    }
 }
 
?>
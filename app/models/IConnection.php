<?php



interface IConnection {
    public function set_parameters($host, $user, $password, $name);
    public function connect_to_db();
    public function test_connection();
    public function get_connection();
}

?>
<?php
require_once("interfaces/IOdeljenje.php");
require_once("../../models/Odeljenje.php");

class OdeljenjeRepository implements IOdeljenje {

    private $ctx;
    
    public function __construct($ctx_){
        $this->ctx = $ctx_;
    }
}
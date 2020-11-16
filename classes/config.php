<?php

class Database{

    public $hostname="localhost";
    private $username="root";
    private $password="";
    private $db_name="multimedia_ta2";

    function connect(){
        $cnx = new PDO("mysql:host=$this->hostname;dbname=$this->db_name", $this->username,$this->password);
        return $cnx;
    }

    function read($query){
        $connection=$this->connect();
        if($connection){
            $ret = $connection->query($query);
            while($col = $ret->fetch()){
                $data[]= $col;
            }
            if(empty($data))
                return "Database is empty";
            return $data;
        }else 
            return "Error in connecting to database";
    }

    function save($query){
        $connection=$this->connect();
        if($connection){
            $ret = $connection->query($query);
            return $ret;
            }else 
                return "Error in connecting to database";
    }
}


?>
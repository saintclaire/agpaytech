<?php
class Database {
//Data base parameters

private $host='localhost';
private $db_name='db_csv';
private $user_name='root';
private $passwd='';
private $conn;

// Connection Method 

public function connect(){
    $this->conn=null;
    
    try {
        $this->conn= new PDO('mysql:host='. $this->host .';dbname='.$this->db_name,$this->user_name,$this->passwd);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $th) {
        //throw $th;
        echo 'connection error' . $th->getMessage();
    }
    return $this->conn;
}
}
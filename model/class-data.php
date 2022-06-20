<?php 

Class Countries{

    private $conn;

    // Countries csv headers
    public $continent_code;
    public $currency_code ;
    public $iso2_code ;
    public $iso3_code ;
    public $iso_numeric_code; 
    public $fips_code ;
    public $calling_code;
    public $common_name ;
    public $official_name ;
    public $endonym ;
    public $demonym ; 

    public function __construct($db){
        $this->conn=$db;
    }

    public function read(){
        if (empty($_GET['page']) && empty($_GET['row_per_page']) && empty($_GET['search'])) {
            $page=1;
            $row_per_page=10;
            $search='';

        }else{
        $page=$_GET['page'];
        $row_per_page=$_GET['row_per_page'];
        $search=$_GET['search'];
        }
          
          $begin=($page * $row_per_page) - $row_per_page;
          $query= "SELECT * FROM 
          countries LEFT JOIN 
          currencies ON
          countries.currency_code = currencies.iso_code 
          UNION ALL SELECT * FROM
          currencies RIGHT JOIN countries ON 
          currencies.iso_code=countries.currency_code 
          WHERE countries.currency_code 
          LIKE '%{$search}%' LIMIT {$begin},{$row_per_page}";
          $stmt=$this->conn->prepare($query);
          $stmt->execute();
          return $stmt;
    }
    
}
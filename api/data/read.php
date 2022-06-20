<?php 
header('Access-control-Allow-Origin: *');
header('Content-Type:application/json');

include_once '../../config/database.php';
include_once '../../model/class-data.php';

$database= new Database();
$db=$database->connect();
$countries=new Countries($db);
$result= $countries->read();
$num=$result->rowCount();

// check if any data
if($num > 0){
    $countries_arr=array();
    $countries_arr['data']=array();
    while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
     extract($row);
     $countries_item=array(
        'continent_code'=>$continent_code,
        'currency_code'=> $currency_code,
        'iso2_code'=> $iso2_code,
        'iso3_code'=> $iso3_code,
        'iso_numeric_code'=> $iso_numeric_code,  
        'fips_code'=> $fips_code,
        'calling_code'=> $calling_code,
        'common_name'=> $common_name,
        'official_name'=> $official_name,
        'endonym '=> $endonym,
        'demonym '=> $demonym,
        'iso_code'=> $iso_code,
        'iso_numeric_code'=> $iso_numeric_code,
        'common_name'=> $common_name,
        'official_name'=> $official_name,
        'symbol'=> $symbol
     );
// push to data

array_push($countries_arr['data'],$countries_item);


    }
    echo json_encode($countries_arr);
}else{
;
}
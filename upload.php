<?php
require 'vendor/autoload.php';
require 'config/database.php';
use League\Csv\Reader;

$database= new Database();
$db=$database->connect();
//inserting data of countries.csv to table 

$sth = $db->prepare(
    "INSERT INTO `countries` (continent_code,currency_code,iso2_code,iso3_code,iso_numeric_code,fips_code,calling_code,common_name,official_name,endonym,demonym) VALUES (:continent_code,:currency_code,:iso2_code,:iso3_code,:iso_numeric_code,:fips_code,:calling_code,:common_name,:official_name,:endonym,:demonym)"
);

$query = $db->prepare(
    "INSERT INTO `currencies` (iso_code,iso_numeric_code,common_name,official_name,symbol) VALUES (:iso_code,:iso_numeric_code,:common_name,:official_name,:symbol)"
);



if(ISSET($_POST['upload'])){
	if($_FILES['file']['name']){
		
		$filename = explode(".", $_FILES['file']['name']);
		$ext=end($filename);
		
		if($ext=="csv"){
$csv = Reader::createFromPath($_FILES['file']['tmp_name'],'r');
$csv->setHeaderOffset(0); //because we don't want to insert the header
foreach ($csv as $record) {
    //validating data before inserting it in the database
	$sth->bindValue(':continent_code', $record['continent_code'], PDO::PARAM_STR);
	$sth->bindValue(':currency_code', $record['currency_code'], PDO::PARAM_STR);
	$sth->bindValue(':iso2_code', $record['iso2_code'], PDO::PARAM_STR);
	$sth->bindValue(':iso3_code', $record['iso3_code'], PDO::PARAM_STR);
	$sth->bindValue(':iso_numeric_code', $record['iso_numeric_code'], PDO::PARAM_STR);
	$sth->bindValue(':fips_code', $record['fips_code'], PDO::PARAM_STR);
	$sth->bindValue(':calling_code', $record['calling_code'], PDO::PARAM_STR);
	$sth->bindValue(':common_name', $record['common_name'], PDO::PARAM_STR);
	$sth->bindValue(':official_name', $record['official_name'], PDO::PARAM_STR);
	$sth->bindValue(':endonym', $record['endonym'], PDO::PARAM_STR);
	$sth->bindValue(':demonym', $record['demonym'], PDO::PARAM_STR);

    $sth->execute();
	 //if the function return false then the iteration will stop

	header('location: index.php?page=1&row_per_page=10');
};
		}else{
			echo"<script>alert('Only csv file is allowed to be upload!')</script>";
			echo"<script>window.location='index.php'</script>";
		}
	}
}


if(ISSET($_POST['upload_currencies'])){
	
	if($_FILES['currencies_file']['name']){
		
		$filename = explode(".", $_FILES['currencies_file']['name']);
		$ext=end($filename);
		
		if($ext=="csv"){
$csv = Reader::createFromPath($_FILES['currencies_file']['tmp_name'],'r');
$csv->setHeaderOffset(0); //because we don't want to insert the header

foreach ($csv as $record) {
    //validating data before inserting it in the database
	$query->bindValue(':iso_code', $record['iso_code'], PDO::PARAM_STR);
	$query->bindValue(':iso_numeric_code', $record['iso_numeric_code'], PDO::PARAM_STR);
	$query->bindValue(':common_name', $record['common_name'], PDO::PARAM_STR);
	$query->bindValue(':official_name', $record['official_name'], PDO::PARAM_STR);
	$query->bindValue(':symbol', $record['symbol'], PDO::PARAM_STR);
   $query->execute();
	 //if the function return false then the iteration will stop

	header('location: index.php');
};
		}else{
			echo"<script>alert('Only csv file is allowed to be upload!')</script>";
			echo"<script>window.location='index.php'</script>";
		}
	}
}

?>
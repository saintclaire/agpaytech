<!DOCTYPE HTML>

<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		
<div class="container">
	</head>
	
<body>
	
	
	


    </div>
		</div>
	</div>
	
		<hr style = "border-top:1px dotted #ccc;"/>
		
		<div class="col-md-6" style='overflow:hidden;'>
			<form action="upload.php" class="form-inline" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label>Upload Countries CSV file here:</label>
					<br />
					<input type="file" name="file"/>
					<br />
					<center><button name="upload" class="btn btn-primary"><span class="glyphicon glyphicon-upload"></span> Upload</button></center>
				</div>
			</form>
		</div>
		<div class="col-md-6" style='overflow:hidden;'>
			<form action="upload.php" class="form-inline" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label>Upload Currencies CSV file here:</label>
					<br />
					<input type="file" name="currencies_file"/>
					<br />
					<center><button name="upload_currencies" class="btn btn-primary"><span class="glyphicon glyphicon-upload"></span> Upload</button></center>
				</div>
			</form>
		</div>
		<div class="col-md-12">
		<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
             	
						<th>continent_code</th>
						<th>currency_code </th>
						<th>iso2_code </th>
						<th>iso3_code </th>
						<th>iso_numeric_code</th> 
						<th>fips_code </th>
						<th>calling_code</th>
						<th>common_name </th>
						<th>official_name </th>
						<th>endonym </th>
						<th>demonym </th>
						<th>iso_code</th>
						<th>iso_numeric_code</th>
						<th>common_name</th>
						<th>official_name</th>
						<th>symbo</th>
					
       
      
       
            </tr>
        </thead>
        <tbody>
		<?php
		require 'config/database.php';
		require 'model/class-data.php';
		$database= new Database();
		$db=$database->connect();
		$countries=new Countries($db);
        $result= $countries->read();
        $num=$result->rowCount();

		


       
        if($num > 0){
		while($fetch=$result->fetch(PDO::FETCH_ASSOC)){
					?>
            <tr>
			<td><?php echo $fetch['continent_code']?></td>
							<td><?php echo $fetch['currency_code']?></td>
							<td><?php echo $fetch['iso2_code']?></td>
							<td><?php echo $fetch['iso3_code']?></td>
							<td><?php echo $fetch['iso_numeric_code']?></td>
							<td><?php echo $fetch['fips_code']?></td>
							<td><?php echo $fetch['calling_code']?></td>
							<td><?php echo $fetch['common_name']?></td>
							<td><?php echo $fetch['official_name']?></td>
							<td><?php echo $fetch['iso_code']?></td>
							<td><?php echo $fetch['iso_numeric_code']?></td>
							<td><?php echo $fetch['common_name']?></td>
							<td><?php echo $fetch['official_name']?></td>
							<td><?php echo $fetch['symbol']?></td>
						
            </tr>
           <?php
		   }
		}
		?>
        </tbody>
        <tfoot>
            <tr>
			<th>continent_code</th>
			<th>continent_code</th>
						<th>currency_code </th>
						<th>iso2_code </th>
						<th>iso3_code </th>
						<th>iso_numeric_code</th> 
						<th>fips_code </th>
						<th>calling_code</th>
						<th>common_name </th>
						<th>official_name </th>
						<th>endonym </th>
						<th>demonym </th>
						<th>iso_code</th>
						<th>iso_numeric_code</th>
						<th>common_name</th>
						<th>official_name</th>
						<th>symbo</th>
            </tr>
        </tfoot>
    </table>



			
	<script>
		jQuery(document).ready(function() {
    $('#example').DataTable();
} );
	</script>
</body>
</html>
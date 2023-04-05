<?php 

$db_host = 'localhost'; // localhost
$db_user = 'root'; // mysql username
$db_password = ''; // mysql password
$db_name = 'classes'; // mysql database name

date_default_timezone_set('EST');

$conn1 = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn1->connect_error) {
	die("Connection failed: " . $conn1->connect_error);
}

function validate_csv($csvname){
	$ret = array();

	if(($csv_file = fopen($csvname, "r")) != FALSE){
		$i = 0;
		while(($row = fgetcsv($csv_file, 1000, ",")) != FALSE){
			if($i != 0) {
					$row['2'] =  trim($row['2']);
					// Validate email address
												
					if(filter_var($row[2], FILTER_VALIDATE_EMAIL)){

						echo("Wrong email format: " . $row[2] . "\n");
						echo "Not inserted\n";
						exit();
					}
			} $i++;
		}
		echo "Total " . ($i-1). " records\n";
	}
	else{
		echo "Unable to open csv\n";
	}

}

function update_db($csvname){
		
	global $conn1;

	if(($csv_file = fopen($csvname, "r")) != FALSE){
		$i = 0;
		while(($row = fgetcsv($csv_file, 1000, ",")) != FALSE){
			if($i != 0) {

				$query = $conn1->prepare("INSERT INTO users (name, surname, email) VALUES (?,?,?)");
				
				$query->bind_param('sss', $row['0'], $row['1'], $row['2']);

				$query->execute();

			} $i++;
        	
		}

	}
	
	$conn1->close();
}

function _main() {
	
	$csv_file = users.csv;

	validate_csv($csv_file);

	update_db($csv_file);		

}

_main();

?>

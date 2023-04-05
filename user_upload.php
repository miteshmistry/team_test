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

	update_db($csv_file);		

}

_main();

?>

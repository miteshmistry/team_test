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
					$email_validation_regex = "/^[a-zA-Z0-9!#$%&'*+\\/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/"; 
							
					if(!preg_match($email_validation_regex, $row[2])){

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

function update_db($csvname,  $exec=true){
		
	global $conn1;

	if(($csv_file = fopen($csvname, "r")) != FALSE){
		$i = 0;
		while(($row = fgetcsv($csv_file, 1000, ",")) != FALSE){
			if($i != 0) {

				$row['0'] =  ucfirst(strtolower(trim($row['0'])));
				$row['1'] =  ucfirst(strtolower(trim($row['1'])));
				$row['2'] =  strtolower(trim($row['2']));

				$query = $conn1->prepare("INSERT INTO users (name, surname, email) VALUES (?,?,?)");
				
				$query->bind_param('sss', $row['0'], $row['1'], $row['2']);

				if($exec){
					$res = $query->execute();
				}

			} $i++;
        	
		}

	}
	if($exec){
		// echo ("adding records" . "\n");
	} else {
		// echo ("not adding records" . "\n");
	}	
	$conn1->close();
}

function usage(){
	echo("\nUsage: php user_upload.php\n\ncommand line options (directives):\n\n");
	echo("  --file [csv file name] - this is the name of the CSV to be parsed\n\n");
}

function _main() {
	
	$inp = getopt("u:p:h:", array("file:", "dry-run", "help") );
	// var_dump($inp);
	if($inp == 0) {
		// echo "No argument:";		
		usage();
		exit();
	} else if(!$inp["u"] && !$inp["p"] && !$inp["h"] && $inp["help"] == NULL && !$inp["file"] && !$inp["dry-run"]) {
		// echo "With arguments";
		usage();
		exit();
	}

	$csv_file = $inp["file"];

	validate_csv($csv_file);

	update_db($csv_file, !isset($inp["dry-run"]));		

}

_main();

?>

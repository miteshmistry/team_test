<?php 

date_default_timezone_set('EST');

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

function update_db($csvname, $exec=true, $db_host, $db_user, $db_password, $db_name){
		
	$conn1 = new mysqli($db_host, $db_user, $db_password, $db_name);

	if ($conn1->connect_error) {
		die("Connection failed: " . $conn1->connect_error);
	}

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
	echo("  --dry_run - this will be used with the --file directive in case we want to run the script but not insert into the DB. All other functions will be executed, but the database won't be altered\n\n");
	echo("  -u - MySQL username\n\n");
	echo("  -p - MySQL password\n\n");
	echo("  -h - MySQL host\n\n");
	echo("  --help - which will output the above list of directives with details\n\n");	
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

	$db_user = ($inp["u"]) ? $inp["u"] : 'root';
	$db_password = ($inp["p"]) ? $inp["p"] : '';
	$db_host = ($inp["h"]) ? $inp["h"] : 'localhost';
	$db_name = 'classes';
	$csv_file = $inp["file"];

	validate_csv($csv_file);

	update_db($csv_file, !isset($inp["dry-run"]), $db_host, $db_user, $db_password, $db_name);		

}

_main();

?>

<?php


for ($i=1; $i<=100; $i++) {
	if ($i % 3 != 0 && $i % 5 != 0){
        echo $i;          
	}		
	if ($i % 3 == 0) {			
		echo "foo";        
	}
	if ($i % 5 == 0) {		
    	echo "bar";     
	}
	if($i < 100) {
		echo ",";
	}
}

echo "\n";
echo "\n";

for ($i=1; $i<=100; $i++) {

	echo ($i % 3 != 0 ? ($i % 5 != 0 ? $i : "bar") : ($i % 5 == 0 ? "foobar" : "bar"));
	echo $i < 100 ? "," : "";
  
}

echo "\n";

?>
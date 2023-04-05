<?php


for ($i=1; $i<=100; $i++){
	//For multiples of three, print "foo"
	if ($i % 3 == 0){
		if ($i % 5 != 0){
            echo "foo,";          
		}
		//For numbers which are multiples of both three and five, print "foobar"
		else {			
          if($i == 100) {
              echo "foobar";
          }
          else {
              echo "foobar,";
          }          
		}
	}
	//For multiples of five, print "bar"
	else if ($i % 5 == 0)
	{		
          if($i == 100) {
              echo "bar";
          }
          else {
              echo "bar,";
          }      
	}
	else {
      	if($i == 100) {
        	echo $i;
        }
      	else {
        	echo $i . ",";
        }
	}	
}
echo "\n";

?>
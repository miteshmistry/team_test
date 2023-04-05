<?php


for ($i=1; $i<=100; $i++){
	//For multiples of three, print "Fizz"
	if ($i % 3 == 0){
		if ($i % 5 != 0){
            echo "foo,";          
		}
		//For numbers which are multiples of both three and five, print "FizzBuzz"
		else {			
            echo "foobar,";         
		}
	}
	//For multiples of five, print "Buzz"
	elseif ($i % 5 == 0)
	{
		
        echo "bar,";    
	}
	else {
        echo $i . ",";
	}	
}
echo "\n";

?>
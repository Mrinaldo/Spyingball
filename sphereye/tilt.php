<?php
//TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/
//This page is requested by the JavaScript, it updates the pin's status and then print it
//Getting and using values

if (isset ( $_GET["pic"] )) {
	$pic = strip_tags ($_GET["pic"]);
	//test if value is a number

	if ( (is_numeric($pic)) && ($pic ==0)){
		system("gpio mode 0 out");
		system("gpio write 0 1");
		sleep(0.3);
		system("gpio write 0 0");
		echo("-1");
	}
	else if ( (is_numeric($pic)) && ($pic ==3)){
		system("gpio mode 3 out");
		system("gpio write 3 1");
		sleep(0.3);
		system("gpio write 3 0");
		echo("1");
	}
	else if((is_numeric($pic))&&($pic==6)){
	system("gpio pwm 1 0");
	system("gpio write 2 0");
	echo("hello");
	}
	else { echo ("fail"); }
}

else { echo ("fail"); 
}
?>
<?php
//TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/
//This page is requested by the JavaScript, it updates the pin's status and then print it
//Getting and using values
$pwm=1;
if (isset ( $_GET["pic"] )) {
	$pic = strip_tags ($_GET["pic"]);
	//test if value is a number
	if($pic>0)
	{
	$pwm=$pic;
	$pic=1;
	}
	else
	{
	$pwm=-$pic/2;
	$pic=2;
	}
	if ( (is_numeric($pic)) && ($pic <= 2) && ($pic >= 1) ) {
		if($pic==2){
		//reading pin's status
		exec ("gpio read ".$pic, $status, $return );
		//set the gpio to high/low
		if ($status[0] == "0" ) { $status[0] = "1"; system("gpio pwm ".(3-$pic)." ".(1023-$pwm) );}
		else if ($status[0] == "1") { $status[0] = "0"; system("gpio pwm ".(3-$pic)." ".($pwm) );}
		system("gpio write ".$pic." ".$status[0] );
		//reading pin's status
		exec ("gpio read ".$pic, $status, $return );
		//print it to the client on the response
		echo($status[0]);
		}
		else if($pic==1){
				system("gpio pwm ".($pic)." ".($pwm));
				system("gpio write 2 0");
				echo("1");
		}		
	}
	else { echo ("fail"); }
}

else { echo ("fail"); 
}
?>
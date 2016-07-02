
﻿<?php
//TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/
//This page is requested by the JavaScript, it updates the pin's status and then print it
//Getting and using values
if (isset ( $_GET["pwm"] )) {
	$pwm = strip_tags ($_GET["pwm"]);
	//test if value is a number
	system("gpio read 2",$status,$return);
	if(!$status[0])
	system("gpio pwm 1 ".$pwm);
	else if($status[0])
	system("gpio pwm 1 ".(1024-$pwm));
	echo($pwm);		
} //print fail if cannot use values
else { echo ("fail"); 
}
?>
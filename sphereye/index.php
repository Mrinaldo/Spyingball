<!DOCTYPE html>
<!--TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/ -->

<html>
    <head>
        <meta charset="utf-8" />
        <title>SpyingBall</title>
        <link rel="icon" href="data/spyingBall.ico"><link>
        <style type="text/css">
			#left {
				position:absolute;					
				top:360px;
				left:30px;
			}
			#pause{
				position:absolute;					
				top:365px;
				left:95px;
				}
        
			#right {	
				position:absolute;					
				top:360px;
				left:205px;		
		    	}
		   	#forward {
				position:absolute;					
				top:300px;
				left:90px;
			}
			#back {
				position:absolute;					
				top:475px;
				left:90px;
			}
			#accelarate {
				position:absolute;					
				top:310px;
				left:750px;
			}
			#decelarate {
				position:absolute;					
				top:420px;
				left:750px;
			}
			#pwm {
				position:absolute;					
				top:25px;
				left:20px;
			}
			#tilt {
				position:absolute;					
				top:50px;
				left:20px;
			}
			#stream{
				position:absolute;					
				top:0px;
				left:0px;
			}
	</style>
    </head>
 
    <body style="background-color: gray;">
    <!-- On/Off button's picture -->

	<iframe id="stream" scrolling="no" width="1080" height="720" src="http://192.168.0.100:8080/stream_simple.html">...</iframe>


	<?php
	$val_array = array(0,0,0,0,0,0);
	//this php script generate the first page in function of the file
	for ( $i= 0; $i<=3; $i++) {
		//set the pin's mode to output and read them
		if($i==1)
		{
		system("gpio mode ".$i." pwm");
		system("gpio pwmr 1024");
		system("gpio pwm ".$i." 0");
		}
		else{
		system("gpio mode ".$i." out");
		system("gpio write ".$i." 0");
		exec ("gpio read ".$i, $val_array[$i], $return );
		}
	}
	//if off
	if ($val_array[0][0] == 0 ) {
	echo ("<div id='left'><img id='button_0' onclick='change_fast (0);' src='data/left_0.png'/></div>");
	}
	//if on
	if ($val_array[0][0] == 1 ) {
	echo ("<div id='left'><img onclick='change_fast (0);' id='button_0' src='data/left_1.png'/></div>");
	}
		 
	
	echo ("<div id='forward'><img id='button_1' onclick='change_pin (1);' src='data/forward_1.png'/></div>");
	echo ("<div id='pause'><img id='button_6' onclick='pause(6);' src='data/pause.png'/></div>");
	
	
	//if off
	if ($val_array[2][0]== 0 ) {
	echo ("<div id='back'><img id='button_2' onclick='change_pin (2);' src='data/back_0.png'/></div>");
	}
	//if on
	if ($val_array[2][0]== 1 ) {
	echo ("<div id='back'><img id='button_2' onclick='change_pin (2);' src='data/back_1.png'/></div>");
	}
	
	//if off
	if ($val_array[3][0]== 0 ) {
	echo ("<div id='right'><img id='button_3' onclick='change_fast (3);' src='data/right_0.png'/></div>");
	}
	//if on
	if ($val_array[3][0]== 1 ) {
	echo ("<div id='right'><img id='button_3' onclick='change_fast (3);' src='data/right_1.png'/></div>");
	}
	
	echo("<textarea id='pwm' rows='1'>PWM:</textarea>");
	echo("<textarea id='tilt' rows='1'>TILT:</textarea>");
	echo("<div id='decelarate'><img onclick='decrease()' id='button_5' src='data/decelaration.png'/></div>");
	echo("<div id='accelarate'><img onclick='increase()' id='button_4 'src='data/accelaration.png'/></div>");
	
	?>
    	<!-- javascript -->
	<script src="script.js"></script>
    </body>
</html>

//JavaScript, uses pictures as buttons, sends and receives values to/from the Rpi
//These are all the buttons
var button_0 = document.getElementById("button_0");
var button_1 = document.getElementById("button_1");
var button_2 = document.getElementById("button_2");
var button_3 = document.getElementById("button_3");
var button_4 = document.getElementById("button_4");
var button_5 = document.getElementById("button_5");
var PWM=document.getElementById("pwm");
var TILT=document.getElementById("tilt");
var tilt=0;
var state=0,pwm=1;
//Create an array for easy access later
var Buttons = [ button_0, button_1, button_2, button_3, button_4, button_5];

//This function is asking for gpio.php, receiving datas and updating the index.php pictures
function change_pin ( pic ) {
var data = 0;
//send the pic number to gpio.php for changes
//this is the http request
	var request = new XMLHttpRequest();
	if(pic==1)
	pic=pic*pwm;
	else
	pic=-pic*pwm;
	request.open( "GET" , "gpio.php?pic=" + pic, true);
	request.send(null);
	if(pic>0)
	pic=1;
	else
	pic=2;
	//receiving informations
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			data = request.responseText;
			//update the index pic
			if (!(data.localeCompare("0"))){
				switch(pic)
				{
				case 1:
				{
				Buttons[1].src = "data/forward_0.png";
				Buttons[2].src = "data/back_1.png";
				}
				break;
				case 2:
				{
				Buttons[2].src = "data/back_0.png";
				Buttons[1].src = "data/forward_1.png";
				}
				break;
				}
			}
			else if (!(data.localeCompare("1"))){
				switch(pic)
				{
				case 1:
				{
				Buttons[1].src = "data/forward_1.png";
				Buttons[2].src="data/back_0.png";
				}
				break;
				case 2:
				{
				Buttons[2].src = "data/back_1.png";
				Buttons[1].src="data/forward_0.png";
				}
				break;
				}	
			}
			else if ( !(data.localeCompare("fail"))) {
				alert ("Something went wrong!" );
				return ("fail");			
			}
			else {
				alert ("Something went wrong!" );
				return ("fail"); 
			}
		}
		//test if fail
		else if (request.readyState == 4 && request.status == 500) {
			alert ("server error");
			return ("fail");
		}
		//else 
		else if (request.readyState == 4 && request.status != 200 && request.status != 500 ) { 
			alert ("Something went wrong!");
			return ("fail"); }
	}	
	
return 0;
}
function change_fast ( pic ) {
	var x;				
	var request = new XMLHttpRequest();
	request.open( "GET" , "tilt.php?pic=" + pic, true);
	request.send(null);
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			x = request.responseText;
			if(x=="-1")
			tilt--;
			else if (x=="1")
			tilt++;
			TILT.value="TILT: "+tilt;
				
		}
		//test if fail
		else if (request.readyState == 4 && request.status == 500) {
			alert ("server error");
			return ("fail");
		}
		//else 
		else if (request.readyState == 4 && request.status != 200 && request.status != 500 ) { 
			alert ("Something went wrong!");
			return ("fail"); }
	}	
		
return 0;
}
function pause(pic){
var data;
//send the pic number to gpio.php for changes
//this is the http request
	var request = new XMLHttpRequest();
	request.open( "GET" , "tilt.php?pic=" + pic, true);
	request.send(null);
	//receiving informations
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			data = request.responseText;
			Buttons[1].src="data/forward_1.png";
			Buttons[2].src="data/back_0.png";
			PWM.value="PWM: 0";
			pwm=1;			
		}
		//test if fail
		else if (request.readyState == 4 && request.status == 500) {
			alert ("server error");
			return ("fail");
		}
		//else 
		else if (request.readyState == 4 && request.status != 200 && request.status != 500 ) { 
			alert ("Something went wrong!");
			return ("fail"); }
	}	
	
return 0;
}
function increase(){
var data;
//send the pic number to gpio.php for changes
//this is the http request
	if(pwm<1023)
	pwm+=50;
	var request = new XMLHttpRequest();
	request.open( "GET" , "pwm.php?pwm=" + pwm, true);
	request.send(null);
	//receiving informations
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			data = request.responseText;
			//update the TEXT area
			PWM.value="PWM: "+(pwm-1);			
		}
		//test if fail
		else if (request.readyState == 4 && request.status == 500) {
			alert ("server error");
			return ("fail");
		}
		//else 
		else if (request.readyState == 4 && request.status != 200 && request.status != 500 ) { 
			alert ("Something went wrong!");
			return ("fail"); }
	}	
	
return 0;
}
function decrease(){
var data;
//send the pic number to pwm.php for changes
//this is the http request
	var request = new XMLHttpRequest();
	if(pwm>1)
	pwm-=50;
	request.open( "GET" , "pwm.php?pwm=" + pwm, true);
	request.send(null);
	//receiving informations
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			data = request.responseText;
			//update the TEXT area
			PWM.value="PWM: "+(pwm-1);
			
		}
		//test if fail
		else if (request.readyState == 4 && request.status == 500) {
			alert ("server error");
			return ("fail");
		}
		//else 
		else if (request.readyState == 4 && request.status != 200 && request.status != 500 ) { 
			alert ("Something went wrong!");
			return ("fail"); }
	}	
	
return 0;
}

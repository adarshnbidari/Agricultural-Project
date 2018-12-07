window.onload=function(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(getPosition);
		$.getJSON("https://api.darksky.net/forecast/e771b1ffcbf3f00268aa1394ddc5c63a/12.9728512,77.6093696?callback=?",show,"jsonp");
}
}


var temp=document.getElementById("temperature");
var summ=document.getElementById("summary");
var disp=document.getElementById("position");

function getPosition(position){
	var latitude=position.coords.latitude;
	var longitude=position.coords.longitude;
	disp.innerHTML="latitude "+latitude+"<br>"+"&nbsp; &nbsp; longitude"+longitude;
	
}

function show(data){
	temp.innerHTML=data.currently.apparentTemperature+" F";
	summ.innerHTML=data.currently.summary;
}

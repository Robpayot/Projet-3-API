/*var planningForm=document.forms["planPlace"];
//console.log(planningForm);
if (planningForm.addEventListener) {
  planningForm.addEventListener("submit", verif, false);
} else if (planningForm.attachEvent) {
  planningForm.attachEvent("onsubmit", verif(this)) ;
}*/
$("#geocoder").submit(function(e){
    e.preventDefault(); 
    var address=$("#address").val();
    mapObj.find(address);
});

$("#planPlace").submit(function(e){
    e.preventDefault(); 
    var errors="";
	var date = planningForm.elements["day"].value;
	var time = planningForm.elements["time"].value;
	var comment = planningForm.elements["comment"].value;
	var regTime =new RegExp("([1-9]|1[012]):[0-5][0-9]","g");
	//var regDate=new RegExp("^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$","g"da);

	if (time=="") {
		errors = errors+"Veuillez entrer une heure <br>";
	} else if(regTime.test(time)==false) {
		console.log("FAUX "+time);
		errors = errors+"Heure invalide <br>";
	} 
	if (date=="") {
		errors = errors+"Veuillez entrer un jour <br>";
	} 
	if (place=="") {
		errors = errors+"Veuillez entrer un lieu <br>";
	}
	document.getElementById("errors").innerHTML=errors;


	if(errors=="") {
		mapObj.planCheckin(time,date,comment);
	} else {
		///SINON QUOI?
	}
});

/*$(document).click(function(e){
	
	if(e.target.id=='day')
		e.datepicker({ dateFormat: 'dd/mm/yy' });
});*/


/*function verif (e) {
	console.log(e);
	var errors="";
	e.preventDefault();
	var date = planningForm.elements["day"].value;
	var time = planningForm.elements["time"].value;
	var comment = planningForm.elements["comment"].value;
	var regTime =new RegExp("([1-9]|1[012]):[0-5][0-9]","g");
	//var regDate=new RegExp("^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$","g"da);

	if (time=="") {
		errors = errors+"Veuillez entrer une heure <br>";
	} else if(regTime.test(time)==false) {
		console.log("FAUX "+time);
		errors = errors+"Heure invalide <br>";
	} 
	if (date=="") {
		errors = errors+"Veuillez entrer un jour <br>";
	} 
	if (place=="") {
		errors = errors+"Veuillez entrer un lieu <br>";
	}
	document.getElementById("errors").innerHTML=errors;


	if(errors=="") {
		mapObj.planCheckin(time,date,comment);
	} else {
		///SINON QUOI?
	}

}*/

/*function planCheckin(time,date,place,comment) {
	var d=date.split("/");
	var nd=new Date(d[2], d[1] - 1, d[0]);
	var dd = nd.getDate();
	var mm = nd.getMonth() + 1; 
	var yyyy = nd.getFullYear();
	var dateFormated = yyyy + "-" + mm + "-" + dd;

	var url = "plan_checkin.php?place=" + place + "&day=" + dateFormated + "&time=" + time+ "&c=" + comment;
    var request = $.ajax({
      url: url,
      //type: "POST",
    });
     
    request.done(function(  ) {
      $( "#plan_checkin" ).html( "Evenement planifié !" );
    });
     
    request.fail(function( jqXHR, textStatus ) {
      console.log( "Request failed: " + textStatus );
      $( "#plan_checkin" ).append( "oops! il y a eu une erreur" );
    });
}*/




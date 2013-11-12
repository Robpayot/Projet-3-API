// JavaScript Document

$(document).ready(function(e) {
    
	$("#dmdAmi").click(function(e) {
		
        $.ajax({
				type : "GET",
				url : "dmdAmi.php",
				success: function(server_response){
					$('#dmdAmi').attr("value","demande envoyée").attr('disabled',true);
					//$("#ami").html(server_response).show();
				}
			});
    });
	
	
});
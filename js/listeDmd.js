// JavaScript Document

$(document).ready(function(e) {
    var datas;
	var url;
	
		function listeDesDemandes(){
			 url="listeDmd.php";
					$.ajax({
				type : "GET",
				url : url,
				success: function(server_response){
					
					$("#dmd").html(server_response).show();
				}
			});
			
		};
		
		
		
		
		$('.demandesAmi').click(function(e) {
			console.log(e);
			var classe=e.toElement.className;
			
			
			datas='accepte='+$("."+classe).attr('data-accepte')+'&ami='+$("."+classe).attr('data-ami');
			
			url="acceptationAmitie.php";
			
			$.ajax({
				type : "GET",
				url : url,
				data: datas,
				success: function(server_response){
					
					listeDesDemandes();
					alert('Vous êtes maintenant amis');
					
				}
			});
			
		
			
		});
		
listeDesDemandes();
console.log(("#amitie").value);


	
});


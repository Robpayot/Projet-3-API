// JavaScript Document
var tab_jour=new Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
var tab_mois=new Array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

var profil = {
    defaults: {
        boutonDemandeAmitie: '#dmdAmi',
        champStatut: '#newStatut',
        divDemandesAmi: '#dmd',
        divAmis: '#dmd',
        statutDone: function () {},
        boutonAmitieDone: function () {},
        reponseAmitieDone: function () {},
    },

    init: function (options) {
        this.params = $.extend(this.defaults, options);
    },

    afficherlisteDesAmis: function (datas) {
        url = "ListeAmis.php";


        $.ajax({
            type: "GET",
            url: url,
            data: "demandeA=" + datas,
            success: function (server_response) {
                //console.log(server_response);
                if (datas == 2) {
                    var amisId = JSON.parse(server_response);
                    //console.log(amisId.ami2);
                    $(profil.params.divAmis).html(amisId.ami0).show();
                } else {
                    $(profil.params.divAmis).html(server_response).show();
                }
            },
            error: function (e) {
                console.log(e);
                console.log("erreur");
            }
        });

    },

    afficherlisteDesDemandes: function () {
        url = "listeDmd.php";

        $.ajax({
            type: "GET",
            url: url,
            success: function (server_response) {
                //console.log("server_response "+server_response);
                if (server_response != "Aucune demande") {
					 if($("#notif-number").hasClass("dspln")){
						$("#notif-number").removeClass();
					 }
                    $(profil.params.divDemandesAmi).html(server_response).show();
                    var length = $('#ul_dmd > *').length;
                    //console.log("taille" + length);
                    $('.notif-number').html(length).show();
                } else {
                    $(profil.params.divDemandesAmi).html(server_response).show();
					if(!$("#notif-number").hasClass("dspln")){
						$("#notif-number").addClass();
					 }
                }




            }
        });

    },

    ChangementEtatBoutonAmitie: function (URL,demandeAbonnement) {
        $.ajax({
            type: "GET",
            url: URL,
            data: "demandeAbonnement="+demandeAbonnement,
            success: function (server_response) {
				//console.log("reponse"+server_response);
				//console.log("demande"+demandeAbonnement);
                profil.params.boutonAmitieDone.call(this, server_response);

            }
        });

    },
    reponseAmitie: function (e) {

        var classe = e.toElement.className;
        datas = 'accepte=' + $("." + classe).attr('data-accepte') + '&ami=' + $("." + classe).attr('data-ami');
        console.log(datas);

        url = "acceptationAmitie.php";

        $.ajax({
            type: "GET",
            url: url,
            data: datas,
            success: function (choix) {
                //console.log(choix);
                profil.params.reponseAmitieDone.call(this, choix);
            }
        });

    },
    nouveauStatut: function () {
        var statut = $(profil.params.champStatut).val();
        var data = 'statut=' + statut;

        if (statut.length > 0) {

            $.ajax({
                type: "POST",
                url: "statut.php",
                data: data,
                success: function (server_response) {
                    $(profil.params.champStatut).val('');
                    //console.log(server_response);
                    profil.params.statutDone.call(this, server_response);

                }
            });
        }
    },

    evenement: function () {
	//console.log("loool");
        url = "checkInAvenir.php";

        $.ajax({
                type: "GET",
                url: url,
                success: function (server_response) {
					if(server_response=="Aucun checkin à venir"){
						$("#list-checkins").fadeIn(500).append(server_response);}
					else{
						var ev = JSON.parse(server_response);
						var count=Object.keys(ev).length;
						//console.log(count);
						var affichageEvenement;
						var i=0;
						var j=0;
						var divEvt="";
						var dateEvString;
						var dateEv=new Array();
						var hourEv=new Array();
						
						$("#list-checkins").append("<ul>");
						
						for (var p = 0; p < count; p++) {
							var checkinDatasID = ev["evenement"+p].id_check;
							$("#list-checkins ul").append("<li id='ev"+p+"' value='"+checkinDatasID+"'>");}
							
						for (var passage = 0; passage < count; passage++) {
							var checkinDatas = ev["evenement"+passage];
							//console.log(ev["evenement"+passage]);
							var commCheckin =ev["evenement"+passage].comment;
							
							var a=checkinDatas.date.split(" ");
							var d=a[0].split("-");
							var t=a[1].split(":");
							dateEv[i] = new Date(d[0],(d[1]-1),d[2],t[0],t[1],t[2]);
							var month = dateEv[i].getMonth();
							var minutes=dateEv[i].getMinutes();
							hourEv[i] = dateEv[i].getHours() + ":" + (minutes < 10 ? '0' + minutes : minutes );
									
									if(dateEv[i]<$.now()){
										dateEvString ="En ce moment ";
										hourEv[i] = "(depuis "+dateEv[i].getHours() + ":" + (minutes < 10 ? '0' + minutes : minutes )+")";
									}
									else{
										dateEvString = tab_jour[dateEv[i].getDay()]+" "+dateEv[i].getDate() + " " + tab_mois[month] + " " + dateEv[i].getFullYear() ;
										hourEv[i] = "à "+dateEv[i].getHours() + ":" + (minutes < 10 ? '0' + minutes : minutes );
										}
									console.log($.now());

									
									
							var suppr=checkinDatas.supp
							var latlng = new google.maps.LatLng(checkinDatas.lat, checkinDatas.lng);
							
							geocoder.geocode({
								'latLng': latlng
							}, function (results, status) {
								if (status == google.maps.GeocoderStatus.OK) {
									//console.log(results[1].formatted_address);
									//console.log(dateEvString);
									if(suppr==1){
										affichageEvenement="<span> à "+results[1].formatted_address+"</span></br> <span class='suppr'>[annuler ce checkin]</span></li>";}
									else{
										affichageEvenement="<span> à "+results[1].formatted_address+"</span></br></li>";}
									
									//console.log(i);
									//console.log(affichageEvenement);
									divEvt="#ev"+i;
									$(divEvt).append(affichageEvenement);
									i++;
									
									
								} else {
									console.log('Geocoder failed due to: ' + status);
								}
							});
							
							divEvt="#ev"+j;
							$(divEvt).append("<p>''"+commCheckin+"''</p><span> "+dateEvString+" "+hourEv[i]+"</span>");
							j++;	
							}
						
						}
					}
                });

        },
		
		supprCheck: function(idCheck){
			        url = "checkInAvenir.php";

				$.ajax({
					type: "GET",
					url: url,
					data: "supprimer=1 &idCheck="+idCheck,
					success: function (choix) {
						console.log(choix);
						//profil.params.supprCheckDone.call(this, choix);
						$("#list-checkins").empty().fadeIn(1000);
						profil.evenement();
					}
				});
			
			
		}

    }
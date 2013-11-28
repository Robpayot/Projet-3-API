// JavaScript Document
var tab_jour=new Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
var tab_mois=new Array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

var profil = {
    defaults: {
        boutonDemandeAmitie: '#dmdAmi',
        champStatut: '#newStatut',
        divDemandesAmi: '#dmd',
        divAmis: '#dmd',
		divResultRecherche:'#resultat',
		divClassement:'#classement-dropdown ul',
        statutDone: function () {},
        boutonAmitieDone: function () {},
        reponseAmitieDone: function () {},
		supprCheckDone: function(){}
    },

    init: function (options) {
        this.params = $.extend(this.defaults, options);
    },
	//rechercher un utilisateur
    rechercheUser: function (recherche) {
		var data='motclef='+recherche;
		console.log("ouii");
		if(recherche.length>1){
			
			$.ajax({
				type : "GET",
				url : "chercher.php",
				data : data,
				success: function(server_response){
					//affichage résultat
					$(profil.params.divResultRecherche).html(server_response).show();
				}
			});
		}
		
		else if(recherche.length<2){
			$(profil.params.divResultRecherche).hide();
		}
		
	},
	//Voir le classement des riders
	classement: function () {
		
		     $.ajax({
            type: "GET",
            url: "classement.php",
            success: function (server_response) {
				//affichage résultat
                $(profil.params.divClassement).append(server_response);

            }
        });
		
	},	
//afficher la liste des amis
    afficherlisteDesAmis: function (datas) {
        url = "ListeAmis.php";


        $.ajax({
            type: "GET",
            url: url,
            data: "demandeA=" + datas,
            success: function (server_response) {
				//datas=2 si on veut un tableau json avec les amis
                if (datas == 2) {
                    var amisId = JSON.parse(server_response);
                    $(profil.params.divAmis).html(amisId.ami0).show();
                } else {
				//Voir liste des amis
                    $(profil.params.divAmis).html(server_response).show();
                }
            },
            error: function (e) {
                console.log(e);
                console.log("erreur");
            }
        });

    },
//liste des demandes
    afficherlisteDesDemandes: function () {
        url = "listeDmd.php";

        $.ajax({
            type: "GET",
            url: url,
            success: function (server_response) {

                if (server_response != "Aucune demande") {
					//affichage notification
					 if($("#notif-number").hasClass("dspln")){
						$("#notif-number").removeClass();
					 }
                    $(profil.params.divDemandesAmi).html(server_response).show();
                    var length = $('#ul_dmd > *').length;
                    $('#notif-number').html(length);
                } else {
					//pas de notification donc pas de div notification
                    $(profil.params.divDemandesAmi).html(server_response).show();
					if(!$("#notif-number").hasClass("dspln")){
						$("#notif-number").addClass("dspln");
					 }
                }

            }
        });

    },
// Changement de bouton abonné/demande envoyée/suivre
    ChangementEtatBoutonAmitie: function (URL,demandeAbonnement) {
        $.ajax({
            type: "GET",
            url: URL,
            data: "demandeAbonnement="+demandeAbonnement,
            success: function (server_response) {
                profil.params.boutonAmitieDone.call(this, server_response);

            }
        });

    },
//Acceptation ou refus d'un abonnement
    reponseAmitie: function (e) {

        var classe = e.className;
        datas = 'accepte=' + $("." + classe).attr('data-accepte') + '&ami=' + $("." + classe).attr('data-ami');

        url = "acceptationAmitie.php";

        $.ajax({
            type: "GET",
            url: url,
            data: datas,
            success: function (choix) {
                profil.params.reponseAmitieDone.call(this, choix);
            }
        });

    },
//Changer de statut
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

//Liste des checkins
    evenement: function () {
        url = "checkInAvenir.php";

        $.ajax({
                type: "GET",
                url: url,
                success: function (server_response) {
					if(server_response=="Aucun checkin à venir"){
						$("#list-checkins").fadeIn(500).append(server_response);}
					else{
						//Recup liste des checkins
						var ev = JSON.parse(server_response);
						var count=Object.keys(ev).length;
						var affichageEvenement;
						var i=0;
						var j=0;
						var divEvt="";
						var dateEvString;
						var dateEv=new Array();
						var hourEv=new Array();
						var moment=false;
						
						$("#list-checkins").append("<ul>");
						//Gestion affichage des checkins
						for (var p = 0; p < count; p++) {
							var checkinDatasID = ev["evenement"+p].id_check;
							$("#list-checkins ul").append("<li id='ev"+p+"' value='"+checkinDatasID+"'>");}
							
						for (var passage = 0; passage < count; passage++) {
							var checkinDatas = ev["evenement"+passage];
							var commCheckin =ev["evenement"+passage].comment;
							
							var a=checkinDatas.date.split(" ");
							var d=a[0].split("-");
							var t=a[1].split(":");
							dateEv[i] = new Date(d[0],(d[1]-1),d[2],t[0],t[1],t[2]);
							var month = dateEv[i].getMonth();
							var minutes=dateEv[i].getMinutes();
							hourEv[i] = dateEv[i].getHours() + ":" + (minutes < 10 ? '0' + minutes : minutes );
									
									if(dateEv[i]<$.now() && moment==false){
										dateEvString ="En ce moment ";
										hourEv[i] = "(depuis "+dateEv[i].getHours() + ":" + (minutes < 10 ? '0' + minutes : minutes )+")";
										moment=true;
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
									//Supprimer uniquement quand ce sont nos checkins
									if(suppr==1){
										affichageEvenement="<span> à "+results[1].formatted_address+"</span></br> <span class='suppr pointer'>[annuler ce checkin]</span></li>";}
									else{
										affichageEvenement="<span> à "+results[1].formatted_address+"</span></br></li>";}
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
//Annuler un checkin		
		supprCheck: function(idCheck){
			   url = "checkInAvenir.php";

				$.ajax({
					type: "GET",
					url: url,
					data: "supprimer=1 &idCheck="+idCheck,
					success: function (choix) {
						profil.params.supprCheckDone.call(this, choix);
					}
				});
			
			
		}

    }
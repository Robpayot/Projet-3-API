// JavaScript Document

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
                console.log(server_response);
                if (datas == 2) {
                    var amisId = JSON.parse(server_response);
                    console.log(amisId.ami2);
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
					if($('.notif-number').css('opacity')==0)
						$('.notif-number').fadeTo( 0.1, 1);
                    $(profil.params.divDemandesAmi).html(server_response).show();
                    var length = $('#ul_dmd > *').length;
                    console.log("taille" + length);
                    $('.notif-number').html(length).show();
                } else {
                    $(profil.params.divDemandesAmi).html(server_response).show();
					$( ".notif-number" ).hide();
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
				console.log("reponse"+server_response);
				console.log("demande"+demandeAbonnement);
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
                console.log(choix);
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
                    console.log(server_response);
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
					if(server_response=="Aucun ckeckin à venir"){
						$("#list-checkins").html(server_response);}
					else{
						var ev = JSON.parse(server_response);
						var count=Object.keys(ev).length;
						//console.log(count);
						var affichageEvenement=new Array();
						var i=0;
						var j=count-1;
						var dateEvString=new Array();
						var dateEv=new Array();
						$("#list-checkins").append("<ul>");
						for (var passage = 0; passage < count; passage++) {
							
							var checkinDatas = ev["evenement"+passage];
							//console.log(ev["evenement"+passage]);
							var tab_jour=new Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
							var tab_mois=new Array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
								
									dateEv[i] = new Date(checkinDatas.date);
									var month = dateNow.getMonth();
									dateEvString[i] = tab_jour[dateEv[i].getDay()]+" "+dateEv[i].getDate() + " " + tab_mois[month] + " " + dateEv[i].getFullYear() ;
									console.log(dateEvString);
									var minutes=dateEv[i].getMinutes();
									var hourEv = dateEv[i].getHours() + ":" + (minutes < 10 ? '0' + minutes : minutes );
									
									$("#list-checkins").append(dateEvString[i]);
									
							var latlng = new google.maps.LatLng(checkinDatas.lat, checkinDatas.lng);
							
							geocoder.geocode({
								'latLng': latlng
							}, function (results, status) {
								if (status == google.maps.GeocoderStatus.OK) {
									//console.log(results[1].formatted_address);
									console.log(dateEvString);
									affichageEvenement="<li>"+dateEvString[j]+" à "+hourEv+" à "+results[1].formatted_address+"</li>";
									console.log(i);
									//console.log(affichageEvenement);
									$("#list-checkins ul").append(affichageEvenement);
									i++;
									j-=1;
									
								} else {
									console.log('Geocoder failed due to: ' + status);
								}
							});
							}
						$("#list-checkins").append("</ul>");
					}
					}
                });

        },

    }
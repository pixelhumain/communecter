<div class="box-communecter box">
	
	<section>
		<?php /* ?>
		<br/><u><a href="#" class="text-white" onclick="showVideo('133636468')">En image <i class="fa fa-2x fa-youtube-play"></i></a> </u>
		php*/?>
		<style type="text/css">
		#communectMe{
			line-height: 35px;
			height : 60px;
			opacity : 0.6;
			border:none;
			width: 450px;
			font-weight: bold;
			font-size: 1.5em;
			border-radius: 10px;
			border-bottom : 1px solid #666;
		}
		</style>
		
		<div class="partition-white padding-20 radius-10">
			<br/><input type="text" class="center" name="communectMe" id="communectMe" placeholder="Your city or postal code"/>
			<div class="space20"></div>
			<span class="homestead text-red" >Communect</span> is part of <a href="#" class="text-red">the commons</a>
			<br/> Get together to build 
			<br/> <a href="#" class="text-red">smart, democratic and connected territories</a>
			<br/> Organize, develop and innovate 
			<br/> Localy, socialy and massively.

			<?php if( false && !isset( Yii::app()->session['userId']) ){?>
			<div class="space10"></div>
			<div class="row radius-10 padding-20" style="background-color: black">
				<iframe class=" col-sm-6" src="https://player.vimeo.com/video/133636468" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				<iframe class="col-sm-6" src="https://player.vimeo.com/video/74212373" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
			<?php } ?>

			<div class="space20"></div>
			<div class="col-sm-6">
				Connected Cities
				<br/>
				<a href="#todo" class="text-red btn btn-xs btn-default">St Pierre</a> 
				<a href="#todo" class="text-red btn btn-xs btn-default">St Denis</a> 
				<a href="#todo" class="text-red btn btn-xs btn-default">Lille</a> 
				<a href="#todo" class="text-red btn btn-xs btn-default">Toulouse</a> 
				<a href="#todo" class="text-red btn btn-xs btn-default">Paris</a>
				<a href="#todo" class="text-red btn btn-xs btn-default">Montpellier</a>
				<a href="#todo" class="text-red btn btn-xs btn-default">Nouméa</a>
				<a href="#todo" class="text-red btn btn-xs btn-default">Perpignan</a>
			</div>
			<div class="col-sm-6">
				Connected People
				<br/>
				<a href="#todo" class="text-red btn btn-xs btn-default">Tango</a> 
				<a href="#todo" class="text-red btn btn-xs btn-default">Maroual</a> 
				<a href="#todo" class="text-red btn btn-xs btn-default">Mr Green</a> 
				<a href="#todo" class="text-red btn btn-xs btn-default">Oceatoon</a> 
				<a href="#todo" class="text-red btn btn-xs btn-default">Jeronimo</a> 
				<a href="#todo" class="text-red btn btn-xs btn-default">Dori</a>
				<a href="#todo" class="text-red btn btn-xs btn-default">Rap pha</a>
				<a href="#todo" class="text-red btn btn-xs btn-default">Xabi</a>
				<a href="#todo" class="text-red btn btn-xs btn-default">Pierrot</a>
				<a href="#todo" class="text-red btn btn-xs btn-default">Pif</a>     
				<a href="#todo" class="text-red btn btn-xs btn-default">Chlorofib</a>    
				<a href="#todo" class="text-red btn btn-xs btn-default">JR</a>   
				<a href="#todo" class="text-red btn btn-xs btn-default">Costa</a>   
				<a href="#todo" class="text-red btn btn-xs btn-default">Ontologist</a>   
			</div>
		</div>
		
	</section>
	<div class="space20"></div>
	<hl/>
	<a href="#"  onclick="startIntro()" class="homestead nextBtns pull-left"><i class="fa fa-arrow-circle-o-left"></i> GUIDED TOUR  </a>
	<a href="#" onclick="showPanel('box-why','bggreen')" class="homestead nextBtns pull-right">WHY <i class="fa fa-arrow-circle-o-right"></i> </a>
</div>

<script type="text/javascript">

	jQuery(document).ready(function()
	{
		<?php if( !isset( Yii::app()->session['userId']) ) { ?>
		initHTML5Localisation();
		<?php } ?>
	});
	function initHTML5Localisation(){
		if (navigator.geolocation)
		{
		  navigator.geolocation.getCurrentPosition(
			function(position){ //success
			    mapBg.panTo([position.coords.latitude, position.coords.longitude], {animate:false});
			    mapBg.setZoom(13, {animate:false});
			    toastr.success("Votre position géographique a été trouvée");
			    toastr.info("<i class='fa fa-circle-o-notch fa-spin'></i> Chargement des données de votre commune");
			    getCityInseeByGeoPos(position.coords);
			},
			function (error){	//error
				var info = "Erreur lors de la géolocalisation : ";
			    switch(error.code) {
				    case error.TIMEOUT:
				    	info += "Timeout !";
				    break;
				    case error.PERMISSION_DENIED:
				    info += "Vous n’avez pas donné la permission";
				    break;
				    case error.POSITION_UNAVAILABLE:
				    	info += "La position n’a pu être déterminée";
				    break;
				    case error.UNKNOWN_ERROR:
				    	info += "Erreur inconnue";
				    break;
				}
				toastr.error(info);
			});
		}
		else{
		  toastr.error("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
		}
	}


	function getCityInseeByGeoPos(coords){
		$.ajax({
			url: baseUrl + "/" + moduleId+"/sig/getinseebylatlng",
			type: 'POST',
    		dataType: 'json',
    		data:{"latitude" : coords.latitude, "longitude" : coords.longitude },
    		complete: function () {},
			success: function (obj) {
				if (obj != null && obj.length > 0) {
					if(typeof obj.address.postalCode != "undefined"){
						toastr.info("Vous allez être redirigé vers la page de votre ville");
						showAjaxPanel("/city/detail/insee/" + obj.address.codeInsee + "?isNotSV=1", 'Details', 'university');
					}
				}else{
					toastr.info("<i class='fa fa-circle-o-notch fa-spin'></i> Recherche approfondie");
					getCityByLatLngNominatim(coords.latitude, coords.longitude);
				}
			},
			error: function (error) {
				console.dir(error);
				toastr.error(error.responseText);
			}
		});
	}

	//reverse geocoding
	function getCityByLatLngNominatim(latitude, longitude){
		console.log(latitude, longitude);
		$.ajax({
			url: "//nominatim.openstreetmap.org/reverse?lat=" + latitude + "&lon=" + longitude + "&format=json&addressdetails=1",
			type: 'POST',
    		dataType: 'json',
    		complete: function () { },
			success: function (obj)
			{
				if(typeof obj.address.city != "undefined")		{ getInseeByCityName(obj.address.city);
				}else if(typeof obj.address.town != "undefined"){ getInseeByCityName(obj.address.town);
				}else{ toastr.error("Impossible de trouver le nom de votre commune"); }
			},
			error: function(error){
				console.dir("error", error);
			}
		});
	}

	function getInseeByCityName(cityName){
		toastr.info("<i class='fa fa-circle-o-notch fa-spin'></i> Merci de patienter ...");
		$.ajax({
			url: baseUrl + "/" + moduleId+"/sig/getcodeinseebycityname",
			type: 'POST',
    		dataType: 'json',
    		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    		data:{ "cityName" : cityName },
    		complete: function () { },
			success: function (obj)
			{
				console.log("getInseeByCityName ok");
				console.dir(obj);

				if (typeof obj != "undefined" && typeof obj.insee != "undefined") {
					toastr.success("<i class='fa fa-circle-o-notch fa-spin'></i> Identification de votre commune ... ");
					showAjaxPanel("/city/detail/insee/" + obj.insee + "?isNotSV=1", 'Details', 'university');
				}else{
					toastr.error("Impossible d'identifier votre commune ... ");
				}
			},
			error: function(error){
				toastr.error("Erreur : Impossible d'identifier votre commune ... ");
			}
		});
	}
</script>
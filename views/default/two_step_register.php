<?php 
	if(!isset(Yii::app()->session['userId'])) return "oups";
	
	$userConnected = Person::getById(Yii::app()->session['userId']);

	$inseeCommunexion 	 = isset( Yii::app()->request->cookies['inseeCommunexion'] ) ? 
	   			    			  Yii::app()->request->cookies['inseeCommunexion'] : "";
	
	$cpCommunexion 		 = isset( Yii::app()->request->cookies['cpCommunexion'] ) ? 
	   			    			  Yii::app()->request->cookies['cpCommunexion'] : "";
	
	$cityNameCommunexion = isset( Yii::app()->request->cookies['cityNameCommunexion'] ) ? 
	   			    			  Yii::app()->request->cookies['cityNameCommunexion'] : "";
?>

<style>
	.main-col-search{
		padding-left:0px;
		padding-right:0px;
		padding-top:50px;
		background-color: rgba(43, 176, 198, 0.3) !important;
	}
	.menu-button, .menu-info-profil, .globale-announce {
		display:none !important;
	}
	#TSR-conf-communected, #step2{
		display:none;
	}
	.btn-menu0{
		display: inline !important;
	}

	.section-tsr{ /*tsr = two step register*/
		 width:100%;
		 padding:1px 0px 1px 0%; 
		 padding-bottom:15px;
	}
	.bg-azure-light-1{
		background-color: rgba(43, 176, 198, 0.3) !important;
	}
	.bg-azure-light-2{
		background-color: rgba(43, 176, 198, 0.7) !important;
	}
	.bg-azure-light-3{
		background-color: rgba(42, 135, 155, 0.8) !important;
	}
	.menu-step-tsr div{
		margin-left: 20px;
	    font-size: 18px;
	    width: 25%;
	    text-align: center;
	    display: inline-block;
	    margin-top:15px;
	}
	.menu-step-tsr div.homestead{
		font-size:22px;
	}
	.menu-step-tsr div.selected {
	    border-bottom: 7px solid white;
	}
	input.input-communexion-twostep, input.input-street-twostep{
		border-radius: 30px !important;
		width: 50%;
		min-width: 300px;
		padding: 15px;
		font-size: 20px;
		text-align: center;
	}
	input.input-street-twostep{
		margin-left: 50px;
	}
	
	#TSR-communexion, #TSR-street{
		display: none;
	}
	#fileuploadContainer {
	    width: 66% !important;
	    margin-left: 16% !important;
	}
	.btn-scope{
		display: none;
	}
	.btn-start-street-search{
		margin-top: -6px;
		border-radius: 50px;
		font-size: 16px;
		margin-left: 5px;
		width: 40px;
	}
</style>
<div class="col-md-12 no-padding" id="whySection" style="max-width:100%;">

	<div class="col-md-12 center bg-dark section-tsr" id="congrats">
		<h1 class="homestead" style="color:#7ACF5B;">
			<i class="fa fa-thumbs-up fa-2x"></i>
			 Félicitation <span class="text-yellow"><?php echo $userConnected["name"]; ?></span>
		</h1>

		<span class="text-center text-white" style="font-size:15px; font-weight:300;">
			Votre compte personnel sera bientôt activé !
			<!-- <br>Merci de suivre les dernières étapes d'inscription ... -->
		</span>
	</div>

	<div class="col-md-12 center bg-azure-light-3 menu-step-tsr section-tsr center">
		<div class="homestead text-white selected" id="menu-step-1">
			<i class="fa fa-2x fa-circle"></i> Étape 1
		</div>
		<div class="homestead text-white" id="menu-step-2">
			<i class="fa fa-2x fa-circle-o"></i> Étape 2
		</div>
		<div class="homestead"  style="color:#7ACF5B;">
			<i class="fa fa-2x fa-sign-in"></i> GO !
		</div>
	</div>

	<div class="col-md-12 center bg-azure-light-2 section-tsr" id="step1">
		<h1 class="homestead text-white">
			<i class="fa fa-circle"></i>
			 Étape 1 : Votre addresse
		</h1>
		<div class="col-md-8 col-md-offset-2">
		<span class="text-center text-white" style="font-size:15px; font-weight:300;">
			Afin d'utiliser tout le potentiel du réseau <strong>Communecter</strong>, <br>
			nous aurions besoin de quelques informations sur votre position géographique ...
			<!-- <br><br>
			Rassurez-vous ! Ces informations ne seront jamais utilisées à d'autres fins que le bon fonctionnement du réseau <strong>Communecter</strong>.
			 -->
			 <br><a href="javascript:" class="text-dark strong">En savoir + sur l'utilisation de vos données</a>
			<!-- <br><br>
			Ces informations serviront à vous positionner plus précisément sur notre carte partagée, <br>
			et ainsi donner à chacun la possibilité de visualiser son réseau local.
 -->
			<!-- <br><br>Votre position finale sur la carte reste libre, 
			<br>vous pourrez (à tout moment) déplacer votre icône sur la position de votre choix.

			<br><br>Merci de rester fidèle (autant que possible) à la réalité ! -->

		</span>
		</div>
	</div>


	<div class="col-md-12 center section-tsr bg-azure-light-1" id="TSR-begin-zone">
			<h1 class="homestead text-dark">Pour commencer :</h1>
			<h3 class=" text-dark">
				Dans quelle zone vous situez-vous ? 
			</h3>

			<div class="col-md-6 col-md-offset-3">
				<select class="form-control" id="addressCountry">
				  <option value="FR">France</option>
				  <option value="GP">Gouadeloupe</option>
				  <option value="GF">Guyanne Française</option>
				  <option value="MQ">Martinique</option>
				  <option value="YT">Mayotte</option>
				  <option value="NC">Nouvelle-Calédonie</option>
				  <option value="RE">Réunion</option>
				  <option value="PM">St Pierre et Miquelon</option>
				</select>
			</div>
			<div class="col-md-12">
				<button class="btn btn-success margin-top-15" onclick="validateZone()">Continuer <i class="fa fa-angle-right"></i></button>
			</div>
	</div>

	<?php if(!isset($inseeCommunexion)){ ?>
		<!-- <div class="col-md-12 center section-tsr bg-azure-light-1" id="TSR-begin-zone">
			<h1 class="homestead text-dark">Pour commencer :</h1>
			<h2 class="homestead text-dark">Dans quelle zone vous situez-vous ?</h2>
		</div> -->
	<?php }else{ ?>
		<div class="col-md-12 center section-tsr bg-azure-light-1" id="TSR-begin-communexion">
			<h1 class="homestead text-dark">Continuons :</h1>
			<h3 class=" text-dark">
				Vous êtes actuellement communecté à <span class="text-red"><?php echo $cityNameCommunexion.", ".$cpCommunexion; ?></span>
			</h3>
			<h3 class=" text-dark">
				Souhaitez-vous conserver cette commune dans votre addresse ?<br><br>
				<button class="btn btn-success" onclick="showTwoStep('conf-communected'); showTwoStep('street');">Oui, j'habite ici</button>
				<button class="btn btn-danger" onclick="showTwoStep('communexion');">Non, j'habite ailleurs</button>
			</h3>
		</div>	
	<?php } ?>
		<div class="col-md-12 center section-tsr bg-azure-light-1" id="TSR-communexion">
			<h1 class="homestead text-dark">Où habitez-vous ?</h1>
			<button class="btn btn-danger" onclick="geolocAutoTSR();"><i class="fa fa-crosshairs"></i> Localisation automatique</button>
			<h3 class=" text-dark">
				Saisissez le nom de votre commune, ou votre code postal ...
			</h3>
			<input type="text" class="input-communexion-twostep" placeholder="commune / code postal"/><br>
		</div>	
		<div class="col-md-12 center section-tsr bg-azure-light-1 padding-15" id="TSR-conf-communected">
			<h1 class="no-margin text-dark">
				<i class="fa fa-thumbs-up fa-2x"></i> 
				<span class="homestead">Commune identifiée : <span id="tsr-commune-name-cp" class="text-red"><?php echo $cityNameCommunexion.", ".$cpCommunexion; ?></span> </span>
				<button class="btn btn-sm bg-dark tooltips" onclick="showTwoStep('communexion'); $('#TSR-conf-communected').hide(300);" data-toggle="tooltip" data-placement="right" title="Modifier"><i class="fa fa-pencil"></i></button>
			</h1>
		</div>
		<div class="col-md-12 center section-tsr bg-azure-light-2" style="padding:0px;" id="TSR-street">
			<div class="col-md-8 col-md-offset-2" style="padding:30px;">
				<span class="text-center text-white" style="font-size:15px; font-weight:300;">
					Tout l'intéret du réseau Communecter réside dans les liens proximité qui existent entre les acteurs d'une même commune. 
					C'est pourquoi nous vous conseillons de vous géolocaliser le plus précisément possible.
				</span><br>
				<h3 class=" text-dark">
					Saisissez le nom de votre rue ...
				</h3>
				<input type="text" class="input-street-twostep" placeholder="ex : 11, rue des peupliers"/>
				<button class="btn bg-dark btn-start-street-search tooltips" onclick="startStreetSearch();" data-toggle="tooltip" data-placement="right" title="Positionnement manuel">
					<i class="fa fa-map-marker"></i>
				</button>
				<h4 class="center text-red" id="error_street"></h4>
				<!-- <br> -->
				<button class="btn btn-success" onclick="startStreetSearch();" style="margin-bottom:15px;">
					<i class="fa fa-search"></i> Rechercher ma rue
				</button> <br>
				<button class="btn btn-success homestead"  style="padding:15px; font-size:22px;" style="margin-top:15px;" onclick="achiveTSRAddress();">
					<i class="fa fa-chevron-right"></i> Étape 2
				</button>	
			</div>	
		</div>	
	
		
		<div class="col-md-12 center bg-azure-light-2 section-tsr" id="step2">
			<h1 class="homestead text-white">
				<i class="fa fa-circle"></i>
				 Étape 2 : Photo de profil
			</h1>
			<div class="col-md-8 col-md-offset-2">
			<span class="text-center text-white" style="font-size:15px; font-weight:300;">
				<div class="margin-bottom-15">Sélectionnez votre première photo de profil.</div>
				<button class="btn bg-dark margin-bottom-15" onclick="$('#profil_avatar').click();">
					<i class="fa fa-download"></i> Choisir une image
				</button>
				<?php $this->renderPartial('../pod/fileupload', array("itemId" => (string) Yii::app()->session['userId'],
																	  "type" => Person::COLLECTION,
																	  "resize" => false,
																	  "contentId" => Document::IMG_PROFIL,
																	  "show" => true,
																	  "editMode" => true,
																	  "image" => null )); 
				?>
				<button class="btn btn-success" onclick="loadByHash('#person.detail.id.<?php echo Yii::app()->session['userId']; ?>')">
					<i class="fa fa-sign-in"></i> Go ! Entrer dans mon espace personnel
				</button>
			</span>
			</div>
		</div>

</div>



<!-- <div class="col-md-12 bg-black" style="background-color:black; color:white; font-size:20px; padding-top:40px; height:140px; text-align:center;">
<span class="homestead">Je suis</span><br>
<span class="homestead text-red">commune</span><span class="homestead">cté</span><br>
</div> -->



<script type="text/javascript">


	userConnected = <?php echo isset($userConnected) ? json_encode($userConnected) : "null"; ?>;
	inseeCommunexion 	= "<?php echo $inseeCommunexion; ?>";
	cpCommunexion 		= "<?php echo $cpCommunexion; ?>";
	cityNameCommunexion = "<?php echo $cityNameCommunexion; ?>";

	jQuery(document).ready(function() {
		console.log("userConnected");
		console.dir(userConnected);
	
		Sig.clearMap();
		$('.tooltips').tooltip();

		if(userConnected != null && 
			typeof userConnected["two_steps_register"] != "undefined" && 
			userConnected["two_steps_register"] == "false"){
			loadByHash("#person.detail.id.<?php echo Yii::app()->session['userId']; ?>");
			return;
		}
		

		location.hash = "#default.twostepregister";
		//$('.btn-menu0').off().click( function(e){ loadByHash("#default.twostepregister")} );

		$(".moduleLabel").html("<i class='fa fa-user'></i> <span id='main-title-menu'>Bienvenue sur</span> <span class='text-red'>COMMUNE</span>CTER");
  		
		//$(".menu-button").hide();

  		<?php if(!isset($inseeCommunexion)){ ?>
  			//showTwoStep("begin-zone");
  		<?php }else{ ?>
  			//showTwoStep("begin-communexion");
  		<?php } ?>
  		
  		showTwoStep("begin-zone");

  		var timeoutSearch = setTimeout(function(){}, 0);
  		$(".input-communexion-twostep").keyup(function(e){
  			$("#searchBarPostalCode").val($(".input-communexion-twostep").val());
  			clearTimeout(timeoutSearch);
      		timeoutSearch = setTimeout(function(){ 
      			showMapLegende("info-circle", "Sélectionnez la commune où vous vivez actuellement,<br><strong>en cliquant sur \"communecter\"</strong> ...")
      			startNewCommunexion(); 
      		}, 1200);
  		});
  	});


  	function showTwoStep(id){
  		console.log("showTwoStep(#TSR-"+id+")");
  		$("#TSR-begin-zone,#TSR-begin-communexion,#TSR-communexion,#TSR-street").hide();
  		$("#TSR-"+id).show(400);
  		setTimeout(function(){ 
  			$("#TSR-"+id).show(400); 
  			//$(".my-main-container").scrollTop(2000); 
  		}, 300);

  	}

  	function startStreetSearch(){

  		$("#btn-start-street-search").html('<i class="fa fa-spin fa-circle-o-notch"></i> Recherche en cours');

  		if($(".input-street-twostep").val().length < 2){
  			
  			$.ajax({
				url: baseUrl+"/"+moduleId+"/sig/getlatlngbyinsee",
				type: 'POST',
				data: "insee="+inseeCommunexion,
	    		success: function (obj){

	    			//toastr.success("Votre addresse a été mise à jour avec succès");
	    			console.log("res getlatlngbyinsee");
	    			console.dir(obj);

	    			$("#btn-start-street-search").html('<i class="fa fa-search"></i> Rechercher');
	    			showMapLegende("info-circle", "Déplacer l'icône sur la position de votre choix,<br><strong>puis cliquez sur \"Valider\"</strong> ...")
      			
					//var obj = null;
					if(typeof obj["geo"] != "undefined"){ 
						$("#error_street").html("");
						//var obj = obj[0];
						var coords = Sig.getCoordinates(obj, "markerSingle");
						//si on a une geoShape on l'affiche
						if(typeof obj.geoShape != "undefined") Sig.showPolygon(obj.geoShape);
						var coords = L.latLng(obj.lat, obj.lon);
						userConnected["geo"] = obj["geo"]; //{ latitude : obj.lat, longitude : obj.lon };
						showGeoposFound(coords, Sig.getObjectId(userConnected), "person", userConnected);
					}else{
						$("#error_street").html("<i class='fa fa-times'></i> Nous n'avons pas trouvé la position de votre commune. Recherche google");
					
					}
				},
				error: function(error){
					console.log("Une erreur est survenue pendant la recherche de la geopos city");
					//console.log("entityType="+entityType+"&entityId="+entityId+"&latitude="+latitude+"&longitude="+longitude);
				}
			});
		
  		}else{
			
			var requestPart = $(".input-street-twostep").val() + ", " + $("#tsr-commune-name-cp").html();
	  		console.log("requestPart", requestPart);
	  		$.ajax({
				url: "//nominatim.openstreetmap.org/search?q=" + requestPart + "&format=json&polygon=0&addressdetails=1",
				type: 'POST',
				dataType: 'json',
				async:false,
				crossDomain:true,
				complete: function () {},
				success: function (result){
					console.log("nominatim success", result.length);
					console.dir(obj);
					$("#btn-start-street-search").html('<i class="fa fa-search"></i> Rechercher');

					//var obj = null;
					if(result.length > 0){ 
						$("#error_street").html("<i class='fa fa-check'></i> Nous avons trouvé votre rue");
						var obj = result[0];
						var coords = Sig.getCoordinates(obj, "markerSingle");
						//si on a une geoShape on l'affiche
						if(typeof obj.geoShape != "undefined") Sig.showPolygon(obj.geoShape);
						var coords = L.latLng(obj.lat, obj.lon);
						userConnected["geo"] = { latitude : obj.lat, longitude : obj.lon };
						showGeoposFound(coords, Sig.getObjectId(userConnected), "person", userConnected);
					}else{
						$("#error_street").html("<i class='fa fa-times'></i> Nous n'avons pas trouvé votre rue. Recherche google");
					
					}
				},
				error: function (error) {
					console.log("nominatim error");
					console.dir(obj);
					$("#error_street").html("Aucun résultat");
					$("#btn-start-street-search").html('<i class="fa fa-search"></i> Rechercher');
				}
			});

		}
  	}


  	function achiveTSRAddress(){ 
  		console.log("achiveTSR", "<?php echo Yii::app()->session['userId']; ?>");
  		showMap(false);
  		var streetAddress = $(".input-street-twostep").val();
  		var addressCountry = $("#addressCountry").val();
  		
  		//if(streetAddress == "" || streetAddress.length <= 2){
  		//	Sig.saveNewGeoposition("<?php echo Yii::app()->session['userId']; ?>", "person", latCommunexion, lngCommunexion);
  		//}
		//showStep2(); return;
  		$.ajax({
			url: baseUrl+"/"+moduleId+"/person/update",
			type: 'POST',
			data: "personId=<?php echo Yii::app()->session['userId']; ?>"+
				  "&streetAddress="+streetAddress+
				  "&postalCode="+cpCommunexion+
				  "&addressLocality="+cityNameCommunexion+
				  "&addressCountry="+addressCountry+
				  "&codeInsee="+inseeCommunexion+
				  "&two_steps_register=false",
    		success: function (obj){
    			showStep2();
    			toastr.success("Votre addresse a été mise à jour avec succès");
    			//console.dir(obj);
			},
			error: function(error){
				console.log("Une erreur est survenue pendant l'enregistrement de la nouvelle addresse");
				//console.log("entityType="+entityType+"&entityId="+entityId+"&latitude="+latitude+"&longitude="+longitude);
			}
		});
  		//showTwoStep("last-step-communexion");
  	}


  	function geolocAutoTSR(){
  		initHTML5Localisation('communexion_tsr'); 
  		showMap(true);
  	}

  	function validateZone(){
  		$("#congrats").hide(300);
  		
  		if(inseeCommunexion != ""){
  			showTwoStep("begin-communexion");
  		}else{
  			showTwoStep("communexion");
  		}
  	}

  	function showStep2(){
  		showTwoStep("");
  		$('#menu-step-2 i.fa').removeClass("fa-circle-o").addClass("fa-circle");
  		$('#menu-step-1 i.fa').removeClass("fa-circle").addClass("fa-circle-o");
  		$('#menu-step-1').removeClass("selected");
  		$('#menu-step-2').addClass("selected");
  		$("#step1").hide(400);
  		$("#step2").show(400);
  	}
</script>
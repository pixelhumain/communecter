<?php 
	if(!isset(Yii::app()->session['userId'])) return "oups";
	
	$userConnected = Person::getById(Yii::app()->session['userId']);

	$inseeCommunexion 	 = isset( Yii::app()->request->cookies['inseeCommunexion'] ) ? 
	   			    			  Yii::app()->request->cookies['inseeCommunexion'] : "";
	
	$cpCommunexion 		 = isset( Yii::app()->request->cookies['cpCommunexion'] ) ? 
	   			    			  Yii::app()->request->cookies['cpCommunexion'] : "";
	
	$cityNameCommunexion = isset( Yii::app()->request->cookies['cityNameCommunexion'] ) ? 
	   			    			  Yii::app()->request->cookies['cityNameCommunexion'] : "";

	$regionNameCommunexion = isset( Yii::app()->request->cookies['regionNameCommunexion'] ) ? 
		   			    			  Yii::app()->request->cookies['regionNameCommunexion'] : "";

	$countryCommunexion = isset( Yii::app()->request->cookies['countryCommunexion'] ) ? 
	   			    			  Yii::app()->request->cookies['countryCommunexion'] : "";
?>

<style>
	.main-col-search{
		width:100%!important;
		margin-left:0px !important;
		padding-left:0px;
		padding-right:0px;
		padding-top:0px;
		background-color: rgba(43, 176, 198, 0.3) !important;
	}
	/*.menu-button-left,  .menu-button, .menu-info-profil, 
	.globale-announce, .menu-left-container hr,
	.footer-menu-left {*/
	.menu-button-left,  .menu-button, 
	.group-globalsearch, .topMenuButtons, #btn-show-floopdrawer, .helloasso,
	.globale-announce, .menu-left-container hr,
	.footer-menu-left {
		display:none;
	}

	#TSR-conf-communected, #step2, #step3{
		display:none;
	}
	.btn-menu2, .btn-menu3, .btn-menu4{
		display:none !important;
	}
	.btn-menu0{
		display: inline !important;
	}

	.section-tsr{ /*tsr = two step register*/
		 width:100%;
		 padding:1px 0px 1px 0%; 
		 padding-bottom:15px;
		 float:left;
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

	#menu-step-addr-1, #menu-step-addr-2, #menu-step-addr-3{
		height: 35px;
		padding: 10px;
		font-weight: 200;
		color: white;
		font-size: 17px;
		float: left;
		width: 29%;
		margin-left: 3%;
		margin-bottom: 0px;
		margin-top: 10px;
	    background-color: rgba(0, 0, 0, 0);
	}
	#menu-step-addr-1.checked, #menu-step-addr-2.checked, #menu-step-addr-3.checked{
		background-color: rgba(44, 162, 42, 0.58);
	}

	#menu-step-addr-1.current, #menu-step-addr-2.current, #menu-step-addr-3.current{
		background-color: rgba(42, 149, 162, 0.6);
	}

	#conf-country, #conf-commune, #conf-street{
		color: rgba(255, 255, 255, 0.7);
	}

	#btn-go-photo:hover{
		background-color: #5cb85c !important;
		color:white !important;
	}
	#btn-go-photo {
	    width: 100%;
	    padding: 15px;
	    border-radius: 0px;
	}

	#menu-step-addr-1, #menu-step-addr-2, #menu-step-addr-3 {
		white-space:nowrap;
		overflow:hidden; 
		text-overflow:ellipsis;
	}
	#step3 .btn{
		margin-bottom:4px;
	}
	
	@media screen and (max-width: 767px) {
		.menu-step-tsr div.homestead {
		    font-size: 14px;
		}
		#menu-step-addr-1, #menu-step-addr-2, #menu-step-addr-3 {
		    height: 23px;
			padding: 6px;
			font-weight: 300;
			color: white;
			font-size: 11px;
			float: left;
			width: 30%;
			margin-left: 3%;
			margin-bottom: 0px;
			margin-top: 10px;
		}
		input.input-communexion-twostep, input.input-street-twostep {
		    border-radius: 30px !important;
		    width: 50%;
		    min-width: 200px;
		    padding: 15px;
		    font-size: 14px;
		    text-align: center;
		    margin-left: 0px !important;
		}
		#btn-go-photo {
		    width: 100%;
		    padding: 15px;
		    font-size: 17px !important;
		    border-radius: 0px;
		}
		.lbl-btn-menu-name, .lbl-btn-menu-name-add, .lbl-btn-menu-name-city {
		    font-size: 15px;
		}
		#congrats span.text-white{
			font-size: 12px !important;
		}
		#menu-bottom{
			display:none!important;
		}		
		.menuSmallMenu .item{
			display: none !important;
		}
		.menuSmallMenu .item#btn-small-home{
			display: inline-block !important;
		}
	}

	.visible-empty{
		display: inline-block !important;
	}
	.visible-empty blockquote{
		/*color:grey;*/
		font-size:16px;
		border-left: 5px solid #a7c9c4;
	}
	.menu-left-container{
		display: none !important;
	}

  
  
  #div-discover .btn-discover{
    border-radius: 60px;
    font-size: 50px;
    font-weight: 200;
    border: 1px solid transparent;
    width: 90px;
    height: 90px;
  }
  #div-discover .btn-discover.bg-red{
    font-size: 43px;
    padding-top: 12px;
  }
  #div-discover .btn-discover.bg-azure:hover{
    background-color: white !important;
    border-color: #2BB0C6 !important;
    color: #2BB0C6 !important;
  }
  #div-discover .btn-discover.bg-red:hover{
    background-color: white !important;
    border-color: #E33551 !important;
    color: #E33551 !important;
  }

</style>

<div class="col-md-12 no-padding" id="whySection" style="max-width:100%;">

	<div class="col-md-12 center bg-dark section-tsr" id="congrats">
		<h1 class="homestead" style="color:#7ACF5B;">
			<i class="fa fa-thumbs-up fa-2x"></i>
			 Félicitation <span class="text-yellow"><?php echo $userConnected["name"]; ?></span>
		</h1>

		<span class="text-center text-white" style="font-size:15px; font-weight:300;">
			Votre compte personnel est sur le point d'être activé !
			<!-- <br>Merci de suivre les dernières étapes d'inscription ... -->
		</span>
	</div>

	
</div>

<div class="col-md-12 no-padding " id="whySection" style="max-width:100%;">

	<div class="col-md-12 center bg-azure-light-3 menu-step-tsr hidden section-tsr center hidden">
		<div class="homestead text-white" id="menu-step-1">
			<i class="fa fa-2x fa-check-circle"></i><br>Inscription
		</div>
		<div class="homestead text-white selected" id="menu-step-2">
			<i class="fa fa-2x fa-circle"></i><br>Addresse<br>
			<span id="conf-address"></span>
		</div>
		<div class="homestead text-white" id="menu-step-3">
			<i class="fa fa-2x fa-circle-o"></i><br>Photo
		</div>
		<!-- <div class="homestead"  style="color:#7ACF5B;">
			<i class="fa fa-2x fa-sign-in"></i> GO !
		</div> -->
	</div>

	<div class="col-md-12 center bg-azure-light-3 menu-step-tsr section-tsr center padding-15" id="TSR-tag-scope">
		<span class="text-center text-white" style="font-size:15px; font-weight:300;">
			<!-- <i class="fa fa-cogs fa-2x text-white"></i><br> -->
			<h1 class="homestead text-white">
				<i class="fa fa-circle"></i>
				 Paramètres optionnel
			</h1>

			Pour mieux profiter de la plateforme  :<br><br>
			Ajouter une image 
			Trier par tags : <button class="btn bg-azure"><i class="fa fa-tags"></i> Mes tags favoris</button><br/><br/>
			Définir plusieur lieux d'interet : <button class="btn bg-azure" id="open-multi-scope"><i class="fa fa-bullseye"></i> Mes lieux favoris</button>
			<span class="hidden"><br/><br/>
			Définir ma Localité pour agir localement  
			</span>

			<button class="btn btn-success" onclick="showTwoStep('begin-zone')"><i class="fa fa-angle-right"></i> continuer</button>

			<!-- <br>Merci de suivre les dernières étapes d'inscription ... -->
		</span>
	</div>

	<div id="div-discover" class="center col-xs-12">
        <div class="panel panel-white padding-10">
            <div id="local-actors-popup-sig">
              
              <div class="panel-body no-padding ">

                <div class="col-md-12 no-padding" style="margin-top:20px">

                    <div class="col-xs-3 center text-azure" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                        <a href="javascript:;" id="open-multi-tag" class="lbh btn btn-discover bg-azure">

                          <i class="fa fa-camera"></i>
                        </a><br/><br/><span class="text-red discover-subtitle">Avatar / Image</span>
                    </div>
                    
                    <div class="col-xs-3 center text-red " style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                        <a href="#rooms.index.type.cities.id." class="lbh btn btn-discover bg-red">
                          <i class="fa fa-map-marker"></i>
                        </a>
                        <br/><br/><span class="text-red discover-subtitle">Ma commune</span>
                    </div>

                    <div class="col-xs-3 center text-azure" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                        <a href="javascript:;" id="open-multi-tag" class="lbh btn btn-discover bg-azure">
                          <i class="fa fa-tags"></i>
                        </a><br/><br/><span class="text-red discover-subtitle">Mes tags préférés</span>
                    </div>
                    
                    <div class="col-xs-3 center text-red " style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                        <a href="javascript:;" id="open-multi-scope" class="lbh btn btn-discover bg-red">
                          <i class="fa fa-bullseye"></i>
                        </a><br/><br/><span class="text-red discover-subtitle">Mes lieux préférés</span>
                    </div>

                </div>

              </div>
            </div>
           
        </div>
    </div>


	<?php if(!isset($inseeCommunexion)){ ?>
		<div class="col-md-12 center section-tsr bg-azure-light-1" id="TSR-begin-zone">
			<h1 class="homestead text-dark">Pour commencer :</h1>
			<h2 class="homestead text-dark">Dans quelle zone vous situez-vous ?</h2>
		</div>
	<?php }else{ ?>
		<div class="col-md-12 center section-tsr bg-azure-light-1" id="TSR-begin-communexion">
			<!-- <h1 class="homestead text-dark">Continuons :</h1> -->
			<h3 class=" text-dark">
				Vous êtes actuellement communecté à <span class="text-red"><?php echo $cityNameCommunexion.", ".$cpCommunexion; ?></span>
			</h3>
			<h3 class=" text-dark">
				Souhaitez-vous conserver cette commune dans votre addresse ?<br><br>
				<button class="btn btn-success" onclick="achiveTSRAddress();">Oui, j'habite ici</button>
				<button class="btn btn-danger" onclick="showTwoStep('communexion');">Non, j'habite ailleurs</button>
			</h3>
		</div>	
	<?php } ?>
		<div class="col-md-12 center section-tsr bg-azure-light-1" id="TSR-communexion">
			<h1 class="homestead text-dark">Ma commune</h1>
			<button class="btn btn-danger" onclick="geolocAutoTSR();"><i class="fa fa-crosshairs"></i> Localisation automatique</button>
			<h3 class=" text-dark">
				Saisissez le nom de votre commune, ou votre code postal ...
			</h3>
			<input type="text" class="input-communexion-twostep" placeholder="commune / code postal"/><br>
			<button class="btn btn-danger btn-start-tsr-communexion margin-top-5"><i class="fa fa-search"></i> Rechercher</button>
			<h3 class="text-dark search-loader"></h3><br>
			<h4 class="text-dark" id="menu-step-addr-active"></h4>
		</div>	
		<div class="col-md-12 center section-tsr bg-azure-light-1" id="TSR-load-conf-communexion">
		</div>
		<div class="col-md-12 center section-tsr bg-azure-light-1 padding-15" id="TSR-conf-communected">
			<h1 class="no-margin text-dark">
				<i class="fa fa-thumbs-up fa-2x"></i> 
				<span class="homestead">Commune identifiée : <span id="tsr-commune-name-cp" class="text-red"><?php echo $cityNameCommunexion.", ".$cpCommunexion; ?></span> </span>
				<button class="btn btn-sm bg-dark tooltips" onclick="backToSetCity();" data-toggle="tooltip" data-placement="right" title="Modifier"><i class="fa fa-pencil"></i></button>
			</h1>
		</div>
		<div class="col-md-12 center section-tsr bg-azure-light-1 " style="padding:0px;" id="TSR-street">
			<div class="col-md-8 col-md-offset-2 hidden" style="padding:30px;padding-top:0px;">
				<h3 class=" text-dark">
					Saisissez le nom de votre rue ...
				</h3>
				<input type="text" class="input-street-twostep" placeholder="ex : 11, rue des peupliers"/>
				<button class="btn bg-dark btn-start-street-search tooltips" onclick="startMarkerPosManuel();" data-toggle="tooltip" data-placement="right" title="Positionnement manuel">
					<i class="fa fa-map-marker"></i>
				</button>
				<h4 class="center text-red" id="error_street"></h4>
				<!-- <br> -->
				<button class="btn btn-success" onclick="startStreetSearch();" style="margin-bottom:15px;">
					<i class="fa fa-search"></i> Rechercher ma rue
				</button> <br>
				
				
					
			</div>	
			<button class="btn bg-white text-dark homestead" id="btn-go-photo" style="width:100%; padding:15px; font-size:22px; border-radius: 0px;" style="margin-top:15px;" onclick="achiveTSRAddress();">
				<i class="fa fa-chevron-right"></i> Étape suivante : Ma Photo
			</button>
		</div>	
	
	


		

		<div class="col-md-12 center bg-dark section-tsr" id="step3">
			<h1 class="homestead text-white">
				<i class="fa fa-plus-circle" style="margin-left: 6px;"></i> ajouter
			</h1>
			<a class="btn bg-yellow lbh" href="#person.invite">
				<i class="fa fa-user"></i>
				<span class="lbl-btn-menu-name-add">quelqu'un</span>
			</a>
			<a class="btn bg-green lbh" href="#organization.addorganizationform">
				<i class="fa fa-group"></i>
				<span class="lbl-btn-menu-name-add">une organisation</span>
			</a>
			<a class="btn bg-purple lbh" href="#project.projectsv">
				<i class="fa fa-lightbulb-o"></i>
				<span class="lbl-btn-menu-name-add">un projet</span>
			</a>
			<a class="btn bg-orange lbh" href="#event.eventsv">
				<i class="fa fa-calendar"></i>
				<span class="lbl-btn-menu-name-add">un événement</span>
			</a>
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
	countryCommunexion = "<?php echo $countryCommunexion; ?>";

	var actionBtnCo = "";

	jQuery(document).ready(function() {
		console.log("userConnected", countryCommunexion);
		console.dir(userConnected);
	
		$("#open-multi-tag").click(function(){
			setTimeout(function(){
				$("#dropdown-content-multi-tag").addClass("open");
			}, 200);
		})

		$("#open-multi-scope").click(function(){ 
			setTimeout(function(){
				$("#dropdown-content-multi-scope").addClass("open");
			}, 200);
		})
		bindLBHLinks();
		/***************************/
		if(countryCommunexion != ""){
			$('#addressCountry option[value="'+countryCommunexion+'"]').prop('selected', true);
		}

		Sig.clearMap();
		$('.tooltips').tooltip();

		if(userConnected != null && 
			typeof userConnected["two_steps_register"] != "undefined" && 
			userConnected["two_steps_register"] == "false"){
			loadByHash("#person.detail.id.<?php echo Yii::app()->session['userId']; ?>");
			return;
		}
		
		$(".explainLink").click(function() {
			showDefinition( $(this).data("id") );
			return false;
		});

		location.hash = "#default.twostepregister";
		
  		setTitle("<span id='main-title-menu'>Bienvenue sur</span> <span class='text-red'>COMMUNE</span>CTER","user","Bienvenue sur COMMUNECTER");
  		actionBtnCo = $("#main-btn-co").attr("href");
  		$("#main-btn-co").attr("href", "javascript:");
		
		$("#btn-menu-launch").hide();
  		$("#logo-main-menu").hide();
  		
  		//showTwoStep("tag-scope");

  		var timeoutSearch = setTimeout(function(){}, 0);
  		$(".btn-start-tsr-communexion").click(function(e){
  			$("#searchBarPostalCode").val($(".input-communexion-twostep").val());
  			clearTimeout(timeoutSearch);
      		timeoutSearch = setTimeout(function(){ 
      			showMapLegende("info-circle", "Sélectionnez la commune où vous vivez actuellement,<br><strong>en cliquant sur \"communecter\"</strong> ...");
      			startNewCommunexion($("#addressCountry").val()); 
      		}, 1200);
  		});
  	});


  	function showTwoStep(id){
  		console.log("showTwoStep(#TSR-"+id+")");
  		$("#TSR-begin-zone,#TSR-begin-communexion,#TSR-communexion, #TSR-load-conf-communexion,#TSR-street,#TSR-tag-scope").hide();
  		$("#TSR-"+id).show(400);
  		$("#my-main-container").scrollTop(0);
  		setTimeout(function(){ 
  			$("#TSR-"+id).show(400); 
  			//$(".my-main-container").scrollTop(2000); 
  		}, 300);

  		if(id == "street"){
  			$("#menu-step-addr-2").html($("#conf-commune").html());
  			$("#conf-commune").html("");
  			$("#menu-step-addr-2").removeClass("current");
	  		$("#menu-step-addr-2").addClass("checked");
	  		$("#menu-step-addr-3").addClass("current");
	  		$("#conf-commune").append(' <a href="javascript:" class="text-dark tooltips" onclick="backToSetCity();" data-toggle="tooltip" data-placement="right" title="Modifier"><i class="fa fa-pencil"></i></a>');
  		}

  	}

  	function startStreetSearch(){

  		$("#btn-start-street-search").html('<i class="fa fa-spin fa-circle-o-notch"></i> Recherche en cours');

  		if($(".input-street-twostep").val().length < 2){
  			$.blockUI({
				message : "<h1 class='homestead text-dark'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche de votre position ...</span></h1>"
			});
			
  			$.ajax({
				url: baseUrl+"/"+moduleId+"/sig/getlatlngbyinsee",
				type: 'POST',
				data: "insee="+inseeCommunexion+"&postalCode="+cpCommunexion,
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
						//$("#error_street").html("<i class='fa fa-times'></i> Nous n'avons pas trouvé la position de votre commune. Recherche google");
						
					}

					$.unblockUI();
				},
				error: function(error){
					console.log("Une erreur est survenue pendant la recherche de la geopos city");
					$.unblockUI();
					//console.log("entityType="+entityType+"&entityId="+entityId+"&latitude="+latitude+"&longitude="+longitude);
				}
			});
		
  		}else{
			
			var requestPart = $(".input-street-twostep").val() + ", " + $("#tsr-commune-name-cp").html() + ", " + $("#addressCountry option:selected" ).text(); // + ", " + $("#addressCountry").val();
			requestPart = transformNominatimUrl(requestPart);
			//findGeoposByGoogleMaps(requestPart, "<?php echo Yii::app()->params['google']['keyAPP']; ?>");
			//return;

	  		console.log("requestPart", requestPart);
	  		$.blockUI({
				message : "<h1 class='homestead text-dark'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche de votre position ...</span></h1>"
			});
			
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
						//$("#error_street").html("<i class='fa fa-times'></i> Nous n'avons pas trouvé votre rue. Recherche google");
						findGeoposByGoogleMaps(requestPart, "<?php echo Yii::app()->params['google']['keyAPP']; ?>");
					}
					$.unblockUI();
				},
				error: function (error) {
					console.log("nominatim error");
					console.dir(obj);
					$("#error_street").html("Aucun résultat"+$("#addressCountry option:selected" ).text());
					$("#btn-start-street-search").html('<i class="fa fa-search"></i> Rechercher');
					$.unblockUI();
				}
			});

		}
  	}


  	function achiveTSRAddress(){ 
  		//return;
  		console.log("achiveTSR", "<?php echo Yii::app()->session['userId']; ?>");
  		showMap(false);
  		var streetAddress = $(".input-street-twostep").val();
  		var addressCountry = countryCommunexion; //$("#addressCountry").val();
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
    			//$('.btn-menu0').off().click( function(e){ loadByHash("#default.home")} );
    			console.log("SUCCESS UPDATE ADDRESS");
    			$("#btn-menu-launch").show();
		  		$("#logo-main-menu").show();
		  		$(".menu-button-left, .menu-button, .menu-left-container hr, .menu-left-container .visible-communected, .menuSmall .visible-communected").show(400);
  				$(".menu-left-container .hide-communected, .menuSmall .hide-communected").hide(400);
  		
		  		showStep2();
    			toastr.success("Votre addresse a été mise à jour avec succès");
    			$("#main-btn-co").attr("href", actionBtnCo);
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
  		$("#btn-toogle-map").show();
  		showMap(true);
  	}

  	function validateZone(){
  		//$("#congrats").hide(300);
  		$("#menu-step-addr-1").html($("#addressCountry option:selected" ).text());
  		$("#menu-step-addr-1").removeClass("current");
  		$("#menu-step-addr-1").addClass("checked");
  		$("#menu-step-addr-2").addClass("current");
  		$("#menu-step-addr-active").html(
  			"Pays : " + 
  			$("#addressCountry option:selected" ).text() + 
  			"<br><a class='text-white' href='javascript:showTwoStep(\"begin-zone\")'><i class=\"fa fa-pencil\"></i> Modifier</a>");
  		
  		if(inseeCommunexion != ""){
  			showTwoStep("begin-communexion");
  		}else{
  			showTwoStep("communexion");
  		}
  	}

  	function showStep2(){
  		showTwoStep("");
  		$("#txt-info-geopos").hide(200);
  		$('#menu-step-3 i.fa').removeClass("fa-circle-o").addClass("fa-circle");
  		$('#menu-step-2 i.fa').removeClass("fa-circle").addClass("fa-check-circle");
  		$('#menu-step-2').removeClass("selected");
  		$('#menu-step-3').addClass("selected");
  		$("#menu-step-addr").hide(400);
  		$("#step1").hide(400);
  		$("#step2").show(400);
  		$("#step3").show(400);
  	}

  	function backToSetCity(){
  		showTwoStep('communexion'); 
  		//$('#TSR-conf-communected').hide(300); 
  		$('#step2').hide(300); 
  	}

  	function startMarkerPosManuel(){
  		$(".input-street-twostep").val("");
  		startStreetSearch();
  	}

  	function callbackGoogleMapsSuccess(result){
  		console.log("callbackGoogleMapsSuccess");
  		console.dir(result);

  		if(result.status == "OK"){
  			//showMap(true);
  			$("#btn-start-street-search").html('<i class="fa fa-search"></i> Rechercher');

			//var obj = null;
			$("#error_street").html("<i class='fa fa-check'></i> Nous avons trouvé votre rue");
			var obj = result.results[0];
			var coords = Sig.getCoordinates(obj, "markerSingle");
			//si on a une geoShape on l'affiche
			if(typeof obj.geoShape != "undefined") Sig.showPolygon(obj.geoShape);
			var coords = L.latLng(obj.geometry.location.lat, obj.geometry.location.lng);
			userConnected["geo"] = { latitude : obj.geometry.location.lat, longitude : obj.geometry.location.lng };
			showGeoposFound(coords, Sig.getObjectId(userConnected), "person", userConnected);
			
  		}else{
  			$("#error_street").html("<i class='fa fa-times'></i> Nous n'avons pas trouvé votre rue.");
  		}

		$.unblockUI();
  	}
</script>
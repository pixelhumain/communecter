<?php 
$cssAnsScriptFilesModule = array(
	'/plugins/x-editable/css/bootstrap-editable.css',
	'/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.css',
	'/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5-editor.css',
	'/plugins/x-editable/js/bootstrap-editable.js',
	'/plugins/wysihtml5/bootstrap3-wysihtml5/wysihtml5x-toolbar.min.js',
	'/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.js',
	'/plugins/wysihtml5/wysihtml5.js'
);

HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");

$cssAnsScriptFilesModule = array(
	'/js/dataHelpers.js',
	'/js/postalCode.js'
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule , $this->module->assetsUrl);
?>
<style>
	.fileupload, .fileupload-preview.thumbnail, 
	.fileupload-new .thumbnail, 
	.fileupload-new .thumbnail img, 
	.fileupload-preview.thumbnail img {
	    width: 100%;
	}
	.panelDetails .row{
		margin:0px !important;
	}
	
	.info-shortDescription a{
		font-size:14px;
		font-weight: 300;
	}
	a#shortDescription{
		font-size: 15px !important;
		font-weight: 200;
		/*color: white;*/
	}
	#profil_imgPreview{
      max-height:400px;
      width:100%;
      border-radius: 5px;
      /*border:3px solid #93C020;*/
      /*border-radius:  4px 4px 0px 0px;*/
      margin-bottom:0px;
     

    }
	.entityTitle{
      background-color: #FFF; /*#EFEFEF; /*#2A3A45;*/
      margin-bottom: 10px;
      border-radius: 0px 0px 4px 4px;
      margin-top: -10px;
      font-weight: 200;
    }
    .entityTitle h2{
    	font-size: 30px;
    	font-weight: 200;
      	margin:0px !important;
      	text-align: left;
    }
    .entityDetails span{
      font-weight: 300;
      font-size:15px;

    }
    .entityDetails{
      padding-bottom:10px;
      margin-bottom:10px;
      border-bottom:0px solid #DDD;
      font-size: 15px;
	  font-weight: 300;
    }
    .entityDetails.bottom{
      /*border-top:1px solid #DDD;*/
      border-bottom:0px solid #DDD;
      padding: 5px;
      margin-top: 10px;
      margin-bottom: -13px;
    }
    .entityDetails i.fa-tag{
      margin-left:10px;
    }
    .entityDetails i.fa{
      margin-right:7px;
      font-size: 17px;
		margin-top: 5px;
    }

    #fileuploadContainer{
    	z-index:0 !important;
    }
    .tag_group{
    	font-size:14px;
    	font-weight: 300;
    }
    .info-coordonnees{
    	/*background-color: rgb(239, 239, 239);*/
    }
    .lbl-info-details{
    	font-weight: 600;
	    border-bottom: 1px solid lightgray;
	    padding-bottom: 7px;
	    margin-bottom: 5px;
	    width:100%;
	    float:left;
	}

</style>

<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title text-dark"> 
			<i class="fa fa-info-circle"></i> <?php echo Yii::t("common","Account info") ?>
		</h4>
	</div>
	<div class="panel-tools">
		<?php if (isset($organization["_id"]) && isset(Yii::app()->session["userId"])
			 && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $organization["_id"])) { 
				if(!isset($organization["disabled"])){
			 	?>
				<a href="javascript:" id="editFicheInfo" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Editer les informations" alt=""><i class="fa fa-pencil"></i> <span class="hidden-xs"> Editer les informations</span></a>
				<a href="javascript:" id="editGeoPosition" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Modifier la position géographique" alt=""><i class="fa fa-map-marker"></i><span class="hidden-xs"> Modifier la position géographique</span></a>
				<a href="javascript:" id="disableOrganization" class="btn btn-sm btn-red tooltips" data-id="<?php echo $organization["_id"] ?>" data-toggle="tooltip" data-placement="bottom" title="Disable this organization" alt=""><i class="fa fa-times"></i> <span class="hidden-xs"> Supprimer</span></a>
		<?php } else {?>
				<span class="label label-danger">DISABLED</span>
		<?php }} ?>
	</div>
	<div class="panel-body border-light panelDetails" id="organizationDetail">
		<div class="row">

			<div class="col-sm-6 col-md-6">
				<?php 
					$this->renderPartial('../pod/fileupload', array("itemId" => $organization["_id"],
																	  "type" => Organization::COLLECTION,
																	  "resize" => false,
																	  "contentId" => Document::IMG_PROFIL,
																	  "editMode" => Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], (String) $organization["_id"]),
																	  "image" => $images)); 
				?>
			</div>
			<div class="col-sm-6 col-md-6 pull-right margin-bottom-15">
				<div class="row text-dark" style="margin-top:10px !important;">
					<div class="entityTitle">
						<h2  style="font-weight:100; font-size:19px;">
							<i class="fa fa-angle-right"></i> 
							<a href="#" id="type" data-type="select" data-title="Type" data-emptytext="Type" class="editable editable-click required">
							</a>
						</h2>
						<h2><!-- <span> - </span> -->
							<a href="#" id="name" data-type="text" data-title="<?php echo Yii::t("common","Name") ?>" data-emptytext="<?php echo Yii::t("common","Name") ?>" 
								class="editable-context editable editable-click required">
								<?php echo (isset($organization)) ? $organization["name"] : null; ?>
							</a>
						</h2>						
					</div>
					<div class="row info-shortDescription" style="word-wrap:break-word;">
						<a href="#" id="shortDescription" data-placement="bottom" data-type="wysihtml5" data-showbuttons="true" data-title="<?php echo Yii::t("common","Short Description") ?>" 
							data-emptytext="<?php echo Yii::t("common","Short Description") ?>" class="editable editable-click">
							<?php echo (isset($organization["shortDescription"])) ? $organization["shortDescription"] : null; ?>
						</a>
					</div>
				</div>
			</div>
			
			<div class="col-md-12">	
				<div class="text-dark lbl-info-details"><i class="fa fa-angle-down"></i> Coordonnées</div>
				<div class="row info-coordonnees entityDetails text-dark" style="margin-top: 10px !important;">
					<div class="col-md-6 col-sm-6">	
						<i class="fa fa-road fa_streetAddress hidden"></i> 
						<a href="#" id="streetAddress" data-type="text" data-title="<?php echo Yii::t("common","Street Address") ?>" data-emptytext="<?php echo Yii::t("common","Street Address") ?>" class="editable-context editable editable-click">
							<?php echo (isset( $organization["address"]["streetAddress"])) ? $organization["address"]["streetAddress"] : null; ?>
						</a>
						<br>
					
						<i class="fa fa-bullseye fa_postalCode  hidden"></i> 
						<a href="#" id="address" data-type="postalCode" data-title="<?php echo Yii::t("common","Postal code") ?>" 
							data-emptytext="<?php echo Yii::t("common","Postal code") ?>" class="editable editable-click" data-placement="bottom">	
						</a>
						<br>
						
						<i class="fa fa-globe fa_addressCountry  hidden"></i> 
						<a href="#" id="addressCountry" data-type="select" data-title="<?php echo Yii::t("common","Country") ?>" 
							data-emptytext="<?php echo Yii::t("common","Country") ?>" data-original-title="" class="editable editable-click">
						</a>
						<br>

						<a href="javascript:" id="btn-update-geopos" class="btn btn-primary btn-sm hidden" style="margin: 10px 0px;">
							<i class="fa fa-map-marker" style="margin:0px !important;"></i> Repositionner
						</a>
						<?php 
							$roles = Role::getRolesUserId(Yii::app()->session["userId"]);
							if($roles["superAdmin"] == true){
								?>
									<a href="javascript:" id="btn-update-geopos-admin" class="btn btn-danger btn-sm" style="margin: 10px 0px;">
										<i class="fa fa-map-marker" style="margin:0px !important;"></i> Repositionner Admin
									</a>
								<?php
							}
						?>

						
						


						<br>
						<!-- <hr style="margin:10px 0px;"> -->
					</div>
					<div class="col-md-6 col-sm-6">
						<?php
							$nbFixe = 0 ;
							$nbMobile = 0 ; 

							if(isset($organization["telephone"]))
							{
								$telephone = "" ;

								if(is_array($organization["telephone"]))
								{

									if(@$organization["telephone"]["fixe"])
									{
										//.fixe.'.$nbFixe.'
										foreach ($organization["telephone"]["fixe"] as $key => $value) {
											if(!empty($telephone))
												$telephone .= ", ";
											$telephone .= $value ;
										}
									}

									if(@$organization["telephone"]["mobile"])
									{
										//telephone.mobile.'.$nbMobile.'
										foreach ($organization["telephone"]["mobile"] as $key => $value) {
											if(!empty($telephone))
												$telephone .= ", ";
											$telephone .= $value ;
										}
									}
								}
								else
								{
									if(@$organization["telephone"])
									{
										if(!empty($telephone))
												$telephone .= ", ";
											$telephone .= $organization["telephone"] ;
									}
								}
								
								echo '<i class="fa fa-phone fa_telephone  hidden"></i>
														<a href="#" id="telephone" data-type="select2" data-type="text" data-title="'. Yii::t("common","Phone number").'" 
							data-emptytext="'. Yii::t("common","Phone number") .'" class="tel editable editable-click">'.$telephone . "</a><br>" ;

								
							}



						?>


						<i class="fa fa-envelope fa_email  hidden"></i> 
						<a href="#" id="email" data-type="text" data-title="Email" data-emptytext="Email" class="editable-context editable editable-click required">
							<?php echo (isset($organization["email"])) ? $organization["email"] : null; ?>
						</a>
						<br>
					
						<?php //If there is no http:// in the url
						$scheme = "";
						if(isset($organization["url"])){
							if (!preg_match("~^(?:f|ht)tps?://~i", $organization["url"])) $scheme = 'http://';
						}?>

						<i class="fa fa-desktop fa_url hidden"></i> 
						<a href="<?php echo (isset($organization["url"])) ? $scheme.$organization['url'] : '#'; ?>" target="_blank" id="url" data-type="text" data-title="<?php echo Yii::t("common","Website URL") ?>" 
							data-emptytext="<?php echo Yii::t("common","Website URL") ?>" style="cursor:pointer;" class="editable-context editable editable-click">
							<?php echo (isset($organization["url"])) ? $organization["url"] : null; ?>
						</a>

						<div class="hidden" id="entity-insee-value" 
							 insee-val="<?php echo (isset( $organization["address"]["codeInsee"])) ? $organization["address"]["codeInsee"] : ""; ?>">
						</div>
					</div>			
				</div>			
			</div>
			
		</div>
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="text-dark lbl-info-details"><i class="fa fa-angle-down"></i> Description</div>
				<a href="#" id="description" data-title="Description" data-type="wysihtml5" data-emptytext="Description" class="editable editable-click">
				</a>
			</div>
		</div>
		<div class="row tag_group">
			<!-- <div class="col-sm-6 col-xs-6 padding-20 text-dark">
				<h3><i class="fa fa-angle-down"></i> Activités</h3>
				<a href="#" id="category" data-title="Categories" data-type="checklist" data-emptytext="Catégories" class="editable editable-click"></a>
			</div> -->
			<div class="col-md-12 padding-20 text-red text-right pull-right">
				<!-- <h3><i class="fa fa-angle-down"></i> Thématiques</h3> -->
				<i class="fa fa-tags"></i> Tags : 
				<a href="#" id="tags" data-type="select2" data-type="Tags" data-emptytext="Tags" class="text-red editable editable-click">
				</a>
			</div>
		</div>
		
	</div>
</div>

<script type="text/javascript"> 

	var contextData = <?php echo json_encode($organization)?>;
	var contextId = "<?php echo isset($organization["_id"]) ? $organization["_id"] : ""; ?>";
	var contextMap = <?php echo json_encode($contextMap)?>;
	var contentKeyBase = "<?php echo isset($contentKeyBase) ? $contentKeyBase : ""; ?>";
	//By default : view mode
	var mode = "view";
	var images = <?php echo json_encode($images) ?>;
	var types = <?php echo json_encode($organizationTypes) ?>;
	var countries = <?php echo json_encode($countries) ?>;

	var publics = <?php echo json_encode($publics) ?>;
	var NGOCategoriesList = <?php echo json_encode($NGOCategories) ?>;
	var localBusinessCategoriesList = <?php echo json_encode($localBusinessCategories) ?>;
	
	jQuery(document).ready(function() {
		$("#editFicheInfo").on("click", function(){
			switchMode();
		});
		// activateEditableContext();
		manageModeContext();
		debugMap.push(contextData);
		
		//Sig.contextData = contextData;
		Sig.restartMap();
		Sig.showMapElements(Sig.map, contextMap);
		console.log("contextMap");
		console.dir(contextMap);
		$('#avatar').change(function() {
		  $('#photoAddEdit').submit();
		});

		$("#editGeoPosition").click(function(){
			Sig.startModifyGeoposition(contextId, "organizations", contextData);
			showMap(true);
		});

		$("#photoAddEdit").on('submit',(function(e) {
			e.preventDefault();
			$.ajax({
				url: baseUrl+"/"+moduleId+"/api/saveUserImages/type/organizations/id/"+contextId,
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false, 
				processData: false,
				success: function(data){
					if(data.result){
						toastr.success(data.msg);
						if('undefined' != typeof data.imagePath){
							$("#imgView").attr("src", data.imagePath);
						}
					}else{
						toastr.error(data.msg);
					}
			  },
			});
		}));

		$("#btn-update-geopos").click(function(){
			findGeoPosByAddress();
		});

		$("#btn-update-geopos-admin").click(function(){
			findGeoPosByAddress();
		});

	});


	function manageModeContext() {
		if (mode == "view") {
			$('.editable-context').editable('toggleDisabled');
			$('#type').editable('toggleDisabled');
			$('#shortDescription').editable('toggleDisabled');
			$('#description').editable('toggleDisabled');
			$('#tags').editable('toggleDisabled');
			$('#addressCountry').editable('toggleDisabled');
			$('#address').editable('toggleDisabled');
			$('#category').editable('toggleDisabled');
			$('#typeOfPublic').editable('toggleDisabled');
			$('#telephone').editable('toggleDisabled');

			$("#btn-update-geopos").addClass("hidden");
			$("#add-phone").addClass("hidden");
			$("#url").css('cursor', 'pointer');
		
		} else if (mode == "update") {
			// Add a pk to make the update process available on X-Editable
			$('.editable-context').editable('option', 'pk', contextId);
			$('#shortDescription').editable('option', 'pk', contextId);
			$('#description').editable('option', 'pk', contextId);
			$('#type').editable('option', 'pk', contextId);
			$('#address').editable('option', 'pk', contextId);
			$('#addressCountry').editable('option', 'pk', contextId);
			$('#tags').editable('option', 'pk', contextId);
			$('#category').editable('option', 'pk', contextId);
			$('#typeOfPublic').editable('option', 'pk', contextId);
			$('#telephone').editable('option', 'pk', contextId);
			
			$('.editable-context').editable('toggleDisabled');
			$('#type').editable('toggleDisabled');
			$('#shortDescription').editable('toggleDisabled');
			$('#description').editable('toggleDisabled');
			$('#address').editable('toggleDisabled');
			$('#addressCountry').editable('toggleDisabled');
			$('#tags').editable('toggleDisabled');
			$('#category').editable('toggleDisabled');
			$('#telephone').editable('toggleDisabled');

			$("#btn-update-geopos").removeClass("hidden");
			$("#add-phone").removeClass("hidden");
			$("#url").css('cursor', 'default');
		}
		//alert($('#url').html() );
		if($('#name').html() != "")				{ $(".fa_name").removeClass("hidden"); } else { $(".fa_name").addClass("hidden"); }
		if($('#url').html() != "")				{ $(".fa_url").removeClass("hidden"); } else { $(".fa_url").addClass("hidden"); }
		if($('#email').html() != "")			{ $(".fa_email").removeClass("hidden"); } else { $(".fa_email").addClass("hidden"); }
		if($('#streetAddress').html() != "")	{ $(".fa_streetAddress").removeClass("hidden"); } else { $(".fa_streetAddress").addClass("hidden"); }
		if($('#postalCode').html() != "")		{ $(".fa_postalCode").removeClass("hidden"); } else { $(".fa_postalCode").addClass("hidden"); }
		if($('#addressCountry').html() != "")	{ $(".fa_addressCountry").removeClass("hidden"); } else { $(".fa_addressCountry").addClass("hidden"); }
		if($('#telephone').html() != "")		{ $(".fa_telephone").removeClass("hidden"); } else { $(".fa_telephone").addClass("hidden"); }
		
	}

	function activateEditableContext() {

		
		$.fn.editable.defaults.mode = 'popup';
		$('.editable-context').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield",
			title : $(this).data("title"),
			onblur: 'submit',
			success: function(response, newValue) {
				console.log("yo");
        		if(! response.result) return response.msg; //msg will be shown in editable form
    		}
		});
		
		//Type Organization
		// $('#type').editable({
		// 	url: baseUrl+"/"+moduleId+"/organization/updatefield", 
		// 	value: '<?php echo (isset($organization)) ? $organization["type"] : ""; ?>',
		// 	source: function() {
		// 		return types;
		// 	},
		// });

		$('#shortDescription').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield",
			wysihtml5: {
				color: false,
				html: false,
				video: false,
				image: false,
				table : false
			},
			validate: function(value) {
			    console.log(value);
			    if($.trim(value).length > 140) {
			        return 'La description courte ne doit pas dépasser 140 caractères.';
			    }
			}
		});

		//Select2 tags
		$('#tags').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			mode: 'popup',
			value: returnttag(),
			select2: {
				tags: <?php if(isset($tags)) echo json_encode($tags); else echo json_encode(array())?>,
				tokenSeparators: [","],
				width: 200
			}
		});


		$('#telephone').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			mode: 'popup',
			value: returntel(),
			select2: {
				tags:  <?php if(isset($telephone)) echo json_encode($telephone); else echo json_encode(array())?>,
				tokenSeparators: [",", "/", " "],
				width: 200,
			}
		});

		

		$('#category').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			mode: 'popup',
			value: <?php echo (isset($organization["category"])) ? json_encode(implode(",", $organization["category"])) : "''"; ?>,
			source: function() {
				var result = new Array();
				var categorySource = null;

				console.log("contextData.type",contextData.type);
				if (contextData.type == "<?php echo Organization::TYPE_NGO ?>") categorySource = NGOCategoriesList;
				if (contextData.type == "<?php echo Organization::TYPE_BUSINESS ?>") categorySource = localBusinessCategoriesList;
				
				if(categorySource != null)
				$.each(categorySource, function(i,value) {
					result.push({"value" : value, "text" : value}) ;
				});
				return result;
			},
		});

		$('#addressCountry').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			value: '<?php echo (isset( $organization["address"]["addressCountry"])) ? $organization["address"]["addressCountry"] : ""; ?>',
			source: function() {
				return countries;
			},
		});

		$('#address').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield",
			mode: 'popup',
			success: function(response, newValue) {
				console.log("success update postal Code : "+newValue);
				console.dir(newValue);
				$("#entity-insee-value").attr("insee-val", newValue.codeInsee);
				//updateGeoPosEntity("CP", newValue);
			},
			value : {
            	postalCode: '<?php echo (isset( $organization["address"]["postalCode"])) ? $organization["address"]["postalCode"] : null; ?>',
            	codeInsee: '<?php echo (isset( $organization["address"]["codeInsee"])) ? $organization["address"]["codeInsee"] : ""; ?>',
            	addressLocality : '<?php echo (isset( $organization["address"]["addressLocality"])) ? $organization["address"]["addressLocality"] : ""; ?>'
            }
		});

		

		$('#description').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			value: <?php echo (isset($organization["description"])) ? json_encode($organization["description"]) : "''"; ?>,
			placement: 'top',
			wysihtml5: {
				html: true,
				video: false
			}
		});

		//Validation Rules
		//Mandotory field
		$('.required').editable('option', 'validate', function(v) {
			var intRegex = /^\d+$/;
			if (!v)
				return 'Field is required !';
		});
	
		
	} 

	function switchMode() {
		if(mode == "view"){
			mode = "update";
			manageModeContext();
		}else{
			mode ="view";
			manageModeContext();
		}
	}

	function returnttag() {
		var tel = <?php echo (isset($organization["tags"])) ? json_encode(implode(",", $organization["tags"])) : "''"; ?>;
		

	    console.log("trefreevfre", tel);
		return tel ;
	}

	function returntel() {
		var tel = "";
		$(".tel").each(function(){
			
			if($(this).text().trim() != "")
	        {
	        	if(tel != "")
	        		tel += ", ";

	        	tel += $(this).text().trim();
	        }	
	        	
	    });

	    console.log(tel);
		return tel ;
	}
	//modification de la position geographique	

	function findGeoPosByAddress(){
		//si la streetAdress n'est pas renseignée
		if($("#streetAddress").html() == $("#streetAddress").attr("data-emptytext")){
			//on récupère la valeur du code insee s'il existe
			var insee = ($("#entity-insee-value").attr("insee-val") != "") ? 
						 $("#entity-insee-value").attr("insee-val") : "";
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee);
		//si on a une streetAddress
		}else{
			var request = "";

			//recuperation des données de l'addresse
			var street 			= ($("#streetAddress").html()  != $("#streetAddress").attr("data-emptytext"))  ? $("#streetAddress").html() : "";
			var address 		= ($("#address").html() 	   != $("#address").attr("data-emptytext")) 	   ? $("#address").html() : "";
			var addressCountry 	= ($("#addressCountry").html() != $("#addressCountry").attr("data-emptytext")) ? $("#addressCountry").html() : "";
			
			//construction de la requete
			request = addToRequest(request, street);
			request = addToRequest(request, address);
			request = addToRequest(request, addressCountry);

			request = transformNominatimUrl(request);
			request = "?q=" + request;
			console.log(request);
			findGeoposByNominatim(request);
		}
	
	}

	//quand la recherche nominatim a fonctionné
	function callbackNominatimSuccess(obj){
		console.log("callbackNominatimSuccess");
		//si nominatim a trouvé un/des resultats
		if (obj.length > 0) {
			//on utilise les coordonnées du premier resultat
			var coords = L.latLng(obj[0].lat, obj[0].lon);
			//et on affiche le marker sur la carte à cette position
			console.log("showGeoposFound coords", coords);
			console.dir("showGeoposFound obj", obj);

			//si la donné n'est pas geolocalisé
			//on lui rajoute les coordonées trouvés
			//if(typeof contextData["geo"] == "undefined")
			contextData["geo"] = { "latitude" : obj[0].lat, "longitude" : obj[0].lon };

			showGeoposFound(coords, contextId, "organizations", contextData);
		}
		//si nominatim n'a pas trouvé de résultat
		else {
			//on récupère la valeur du code insee s'il existe
			var insee = ($("#entity-insee-value").attr("insee-val") != "") ? 
						 $("#entity-insee-value").attr("insee-val") : "";
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee);
		}
	}

	//quand la recherche par code insee a fonctionné
	function callbackFindByInseeSuccess(obj){
		console.log("callbackFindByInseeSuccess");
		//si on a bien un résultat
		if (typeof obj != "undefined" && obj != "") {
			//récupère les coordonnées
			var coords = Sig.getCoordinates(obj, "markerSingle");
			//si on a une geoShape on l'affiche
			if(typeof obj.geoShape != "undefined") Sig.showPolygon(obj.geoShape);
			
			contextData["geo"] = { "latitude" : obj.geo.latitude, "longitude" : obj.geo.longitude };
			//on affiche le marker sur la carte
			showGeoposFound(coords, contextId, "organizations", contextData);
		}
		else {
			console.log("Erreur getlatlngbyinsee vide");
		}
	}


	//en cas d'erreur nominatim
	function callbackNominatimError(error){
		console.log("callbackNominatimError", error);
	}

	//quand la recherche par code insee n'a pas fonctionné
	function callbackFindByInseeError(){
		console.log("erreur getlatlngbyinsee", error);
	}
	

</script>
<?php 
$cssAnsScriptFilesTheme = array(
	//Select2
	'/assets/plugins/select2/select2.css',
	'/assets/plugins/select2/select2.min.js',
	//autosize
	'/assets/plugins/autosize/jquery.autosize.min.js',

);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<style>
	#dropdown_search{
		padding: 0px 15px; 
		margin-left:2%; 
		width:96%;
	};
	.select2-input {
		width:100%;
	}
	#addOrganization{
		float: left;
		padding: 10px;
		background-color: rgba(242, 242, 242, 0.6);
		width: 100%;
		-moz-box-shadow: 0px 0px 3px -1px #747474;
		-webkit-box-shadow: 0px 0px 3px -1px #747474;
		-o-box-shadow: 0px 0px 3px -1px #747474;
		box-shadow: 0px 0px 3px -1px #747474;
		filter:progid:DXImageTransform.Microsoft.Shadow(color=#cfcfcf, Direction=134, Strength=5);
	}
	#iconeChargement{
		display: none;
		float: right;
		margin-top: -23px;
		margin-right: 10px;
	}

#addOrganization input, #addOrganization button.dropdown-toogle, #addOrganization textarea{
	border: 1px solid #CCC !important;
}
#addOrganization .select2-input{
	border:none !important;
}


/* design alpha tango*/
.main-col-search{
	background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/tango-circle-bg-green.png");
	background-size:100%;
	background-repeat: no-repeat;
	background-color: #daffc6 !important;
}

.noteWrap .panel-white{
	background-color: rgba(0, 0, 0, 0);
	color: white;
	font-size: 15px;
	font-weight: 300;
}
.noteWrap .control-label{
	font-size:15px;
	font-weight:600;
}

.main-top-menu{
	background-color: rgba(255, 255, 255, 0.82) !important;
}
.select2-container .select2-choice .select2-arrow b::before{
	content:"";
}

.btn-select-type-orga {
	font-size: 14px;
}

.noteWrap input {
	text-align:left !important;
}
.noteWrap #description{
	word-wrap: break-word;
	resize: horizontal;
	max-height: 460px;
	overflow: scroll;
	max-width: 100%;
	width: 924px;
	min-height: 250px !important;
}

</style>
<?php 
$this->renderPartial('../default/panels/toolbar');  
?>
<div id="addOrganization" >
	
	
	<div class="col-md-12 form-add-data" >  
	<div class="noteWrap">
	    
		<div class="panel-body" style="background-color:transparent !important;">
			<form id="organizationForm" role="form">
				<div class="row">
					<div class="col-md-12">
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-times-sign"></i> <?php echo Yii::t("common","You have some form errors. Please check below.") ?>
						</div>
						<div class="successHandler alert alert-success no-display">
							<i class="fa fa-ok"></i> <?php echo Yii::t("common","The form has been validated.") ?>
						</div>
					</div>
					<div id="formNewOrganization">
						<div class="col-md-12" style="margin-bottom: 50px; border-bottom: 1px solid rgba(0, 0, 0, 0.13); padding-bottom: 25px;">
							<div class="form-group center">
								<h1 class="homestead text-dark center"><i class="fa fa-angle-right"></i> Quel type d'organisation souhaitez-vous référencer ?</h1>
								
									<label class="control-label text-dark">
									<!-- <i class="fa fa-angle-down"></i> <?php //echo Yii::t("common","Type") ?> :  -->
									<!--<div class="btn btn-select-type-orga btn-default text-dark bg-white" val="association"><i class="fa fa-group"></i> Une association</div>
									<div class="btn btn-select-type-orga btn-default text-dark bg-white" val="entreprise"><i class="fa fa-industry"></i> Une entreprise</div> 
									<div class="btn btn-select-type-orga btn-default text-dark bg-white" val="group"><i class="fa fa-circle"></i> Un groupe</div> 
									<div class="btn btn-select-type-orga btn-default text-dark bg-white" val="gouv"><i class="fa fa-lightbulb-o"></i> Une organisation gourvernemantal</div>-->
									<?php
										foreach ($types as $key=>$value) {
											$icon = "" ;
											if($key=="NGO")
												$icon = '<i class="fa fa-group"></i>' ;
											if($key=="LocalBusiness")
												$icon = '<i class="fa fa-industry"></i>' ;
											if($key=="Group")
												$icon = '<i class="fa fa-circle"></i>' ;
											if($key=="GovernmentOrganization")
												$icon = '<i class="fa fa-lightbulb-o"></i>' ;
									?>
										<div class="btn btn-select-type-orga btn-default text-dark bg-white" val="<?php echo $key?>"><?php echo $icon ." ".$value ; ?></div>
										
									<?php 
									}
									?>

									<input type="hidden" name="type" id="type" value=""/>
										<span class="symbol required"></span>
									</label>
									
								</div>
								
							</div>
						</div>
						
						<div class="col-md-6 col-sd-6" >


							<input id="organizationId" type="hidden" name="organizationId">
							<div class="form-group">
								<label class="control-label text-dark">
								<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Name")?> (<?php echo Yii::t("organisation","Corporate Name",null,Yii::app()->controller->module->id)?>) <span class="symbol required"></span>
								</label>
								<span id="organizationNameInput">
									<input id="organizationName" class="form-control" name="organizationName" value="<?php if($organization && isset($organization['name']) ) echo $organization['name']; else $organization["name"]; ?>">
									<a style="display:none" id="similarOrganizationLink" href="#">Similar organization(s) already exist(s) (click for detail)</a>
								</span>
							</div>

							
							<div class="form-group organizationCategory categoryNGO">
								<label class="control-label">
									<?php echo Yii::t("common","Category") ?>
								</label>
			        		    <input id="categoryNGO" type="hidden" name="category" style="width:100%; height:35px;">
							</div>
							<div class="form-group organizationCategory categoryLocalBusiness">
								<label class="control-label">
									<?php echo Yii::t("common","Category") ?>
								</label>
			        		    <input id="categoryLocalBusiness" type="hidden" name="category" style="width:100%; height:35px;">
							</div>
							<div class="form-group">
								<label class="control-label text-dark">
								<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Email") ?>
								</label>
								<input id="organizationEmail" class="form-control" name="organizationEmail" value="<?php if($organization && isset($organization['email']) ) echo $organization['email']; else echo Yii::app()->session['userEmail']; ?>"/>
							</div>
							<div class="form-group">
								<label class="control-label text-dark">
									<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Key Words") ?>
								</label>
			        		    <input id="tagsOrganization" type="hidden" name="tagsOrganization" value="<?php echo ($organization && isset($organization['tags']) ) ? implode(",", $organization['tags']) : ""?>" style="width:100%; height:35px;">		        		    
							</div>
							<div class="form-group pull-left">
								<div class="form-group">
									<label class="control-label text-dark">
										<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","What's your role inside this new organization ?") ?> <span class="symbol required"></span>
									</label>
									<select name="role" id="role" class="form-control" >
										<option value="admin"><?php echo Yii::t("common","Administrator") ?></option>
										<option value="member"><?php echo Yii::t("common","Member") ?></option>
										<option value="creator"><?php echo Yii::t("common","Just a citizen wanting to give visibility to it :)") ?></option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12 ">
							<div class="form-group">
								<label class="control-label text-dark">
									<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Country") ?> <span class="symbol required"></span>
								</label>
								<input type="hidden" name="organizationCountry" id="organizationCountry" style="width: 100%; height:35px;">								
							</div>
							<div class="form-group">
								<label for="address" class="control-label text-dark">
									<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Address") ?></span>
								</label>
								<input type="text" class="form-control" name="streetAddress" id="fullStreet" value="<?php if(isset($organization["address"])) echo $organization["address"]["streetAddress"]?>" >
							</div>
							<div class="row">
								<div class="col-md-4 form-group">
									<label for="postalCode" class="control-label text-dark">
										<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Postal Code")?> <span class="symbol required"></span>
									</label>
									<input type="text" class="form-control" name="postalCode" id="postalCode" value="<?php if(isset($organization["address"]))echo $organization["address"]["postalCode"]?>" >
									<i class="fa fa-spin fa-refresh" id="iconeChargement"></i>
								</div>
								<div class="col-md-8 form-group" id="cityDiv" style="display:none;">
									<label for="city" class="text-dark">
										<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","City") ?> <span class="symbol required"></span>
									</label>
									<select class="selectpicker form-control" id="city" name="city" title='<?php echo Yii::t("common","Select your City") ?>...'>
									</select>
								</div>
								<input type="hidden" name="cityName" id="cityName" value=""/>
							</div>
							<div class="alert alert-success pull-left col-md-12 hidden" id="alert-city-found" style="font-family:inherit;">
								<span class="pull-left" style="padding:6px;">Position géographique trouvée <i class="fa fa-smile-o"></i></span>
								<div class="btn btn-success pull-right" id="btn-show-city"><i class="fa fa-map-marker"></i> Personnaliser</div>
							</div>

							<input type="hidden" name="geoPosLatitude" id="geoPosLatitude" style="width: 100%; height:35px;">
							<input type="hidden" name="geoPosLongitude" id="geoPosLongitude" style="width: 100%; height:35px;">


							
						</div>

							
						<div class="col-md-12">
							<div class="form-group">
								<div>
									<label for="form-field-24" class="control-label text-dark">
										<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Description") ?>
									</label>
									<textarea  class="form-control" name="description" id="description" class="autosize form-control"><?php if($organization && isset($organization['description']) ) echo $organization['description']; else $organization["description"]; ?></textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div>
									<span class="symbol required"></span><?php echo Yii::t("common","Required Fields") ?>
									<hr>
								</div>
							</div>
						</div>
						<button class="btn btn-success pull-right" style="" id="btnSaveNewOrganization"><i class="fa fa-save"></i> Enregistrer<?php //echo Yii::t("common","SAVE")?></button>
					</div>
					<div id="infoOrgaSameName" style='display:none'>
						<a class="pull-right btn-close-panel" onclick="$.unblockUI();" href="#">
							<i class="fa fa-times "> </i>
						</a>
						<h1>Warning</h1>
						<p>Organizations with (almost) the same name already exist.</p>
						<p>Please check bellow if you are not creating the same organization.</p>
						<div id="listOrgaSameName" class="text-left padding-10">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

jQuery(document).ready(function() {
	$(".btn-select-type-orga").click(function(){
		var val = $(this).attr("val");
		$(".btn-select-type-orga").removeClass("bg-green");
		$(this).addClass("bg-green");
		$("#type").val(val);
		console.log("TYPE : ", val);
		//$('#type option[value="'+val+'"]').prop('selected', true);
	});

});


var formValidator = function() {
	addCustomValidators();
	var form = $('#organizationForm');
	var errorHandler = $('.errorHandler');
	form.validate({
		rules : {
			organizationCountry : {
				required : true
			},
			organizationName : {
				required : true
			},
			type : {
				required : true
			},
			postalCode : {
				rangelength : [5, 5],
				required : true,
				validPostalCode : true
			}
		},
		submitHandler : function(form) {
			$.blockUI({
				message : '<span class="homestead"><i class="fa fa-spinner fa-circle-o-noch"></i> Enregistrement en cours ...</span>'
			});
	        $.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/organization/save",
		    	  data: $("#organizationForm").serialize(),
		    	  success: function(data){
		    			if(!data.result){
	                        toastr.error(data.msg);
	                   		$.unblockUI();
	                   	}
	                    else { 
	                        toastr.success(data.msg);
                        	addFloopEntity(data.id, "organizations", data.newOrganization);
							loadByHash('#organization.detail.id.'+data.id);
							//$.hideSubview();
							$.unblockUI();
	                    }
		    	  },
		    	  dataType: "json"
		    });
	       	return false; // required to block normal submit since you used ajax
		},
		invalidHandler : function(event, validator) {//display error alert on form submit
			errorHandler.show();
		}
	});
}

var timeout;

var mapIconTop = {
	"citoyen":"fa-user", 
	"NGO":"fa-users",
	"LocalBusiness" :"fa-industry",
	"Group" : "fa-circle-o",
	"GovernmentOrganization" : "fa-university",
	"event":"fa-calendar",
	"project":"fa-lightbulb-o"
};

var geoPositionCity = null;
var citiesByPostalCode = null;

jQuery(document).ready(function() {
	var countries = getCountries("select2");
	var NGOcategories = formatDataForSelect(<?php echo empty($NGOCategories) ? "[]" : json_encode($NGOCategories); ?>, "select2");
	var localBusinessCategories = formatDataForSelect(<?php echo empty($localBusinessCategories) ? "[]" : json_encode($localBusinessCategories); ?>, "select2");
	console.log(countries, NGOcategories);
	$('#tagsOrganization').select2({ tags: <?php echo empty($tags) ? "''" : $tags; ?> });
	
	$('#categoryNGO').select2({ 
		data : NGOcategories,
		multiple: true,
		maximumSelectionSize: 2
	});

	$('#categoryLocalBusiness').select2({ 
		data : localBusinessCategories,
		multiple: true,
		maximumSelectionSize: 2
	});
	
	$('#organizationCountry').select2({
		data : countries,
	});


	Sig.clearMap();
	

	$("textarea.autosize").autosize();
	
	formValidator();
	initForm();
	bindPostalCodeAction();
	$(".moduleLabel").html("<i class='fa fa-plus'></i> <i class='fa fa-group'></i> Référencer votre organisation");
 }); 

	function initForm() {
		$("#information-icon").hide();
		manageOrganizationCategory("");
		$('#organizationName').off().on("blur", function(){
	    	var search = $('#organizationName').val();
	    	if (search.length > 3) {
	    		autoCompleteOrganizationName(encodeURI(search));
	    	}
		});
		$('#addOrganization #type').off().on("change", function() {
			manageOrganizationCategory($(this).val());
		})
		$("#similarOrganizationLink").off().on("click", function() {
            $.blockUI({ message: $('#infoOrgaSameName'), css: { width: '400px', top: '20%' } }); 
		});
	}	
	
	function autoCompleteOrganizationName(searchValue){
		var data = { 
			"search" : searchValue,
			"searchMode" : "organizationOnly"
		};
		
		$.ajax({
			type: "POST",
	        url: baseUrl+"/communecter/search/searchmemberautocomplete",
	        data: data,
	        dataType: "json",
	        success: function(data){
	 			var str = "";
	 			var compt = 0;

	 			$.each(data.organizations, function(idOrga, orga) {
	  				console.log(orga);
	  				city = "";
					postalCode = "";
					var htmlIco ="<i class='fa fa-users fa-2x'></i>";
					if(orga.type){
						typeIco = orga.type;
						htmlIco ="<i class='fa "+mapIconTop[orga.type] +" fa-2x'></i>";
 					}
 					if (orga.address != null) {
						city = orga.address.addressLocality;
						postalCode = orga.address.postalCode;
					}
 					if("undefined" != typeof orga.profilImageUrl && orga.profilImageUrl != ""){
 						var htmlIco= "<img width='50' height='50' alt='image' class='img-circle' src='"+baseUrl+orga.profilImageUrl+"'/>";
 					}
 					str += 	"<div class='padding-10'>"+
 							"<a href='#' data-id='"+ orga.id +"' data-type='"+ typeIco +"'>"+
 							"<span>"+ htmlIco +"</span>  " + orga.name +
 							"<span class='city-search'> "+postalCode+" "+city+"</span>"+
 							"</a></div>";
 					compt++;
	  				//str += "<li class='li-dropdown-scope'><a href='javascript:initAddMeAsMemberOrganizationForm(\""+key+"\")'><i class='fa "+mapIconTop[value.type]+"'></i> " + value.name + "</a></li>";
	  			});
				
				if (compt > 0) {
					$("#similarOrganizationLink").show();
				} else {
					$("#similarOrganizationLink").hide();
				}

				$("#addOrganization #listOrgaSameName").html(str);
			}	
		})
	}

	function showNewOrganizationForm(){
		//Manage Button
		$("#addOrganization #btnSaveNewOrganization").css("display", "block");
		$("#addOrganization #formNewOrganization").css("display", "block");
		initNewOrganizationForm();
	}

	function initNewOrganizationForm() {
		$('#formNewOrganization input, #formNewOrganization select, #formNewOrganization select2, #formNewOrganization textarea').each(
		    function(){
		        $(this).val("");
		        $(this).removeAttr("disabled");
		    }
		);
		//cas particulier du select2
		$("#addOrganization #tagsOrganization").select2('val', "");
		$("#addOrganization #organizationCountry").select2('val', "");
		$("#addOrganization #categoryNGO").select2('val', "");
	}

	function runShowCity(searchValue) {
		
		citiesByPostalCode = getCitiesByPostalCode(searchValue);
		console.log(citiesByPostalCode);
		citiesByPostalCode;
		Sig.citiesByPostalCode = citiesByPostalCode;
		
		var oneValue = "";
		$.each(citiesByPostalCode,function(i, value) {
	    	$("#city").append('<option value=' + value.value + ' data-city="'+ value.text +'">' + value.text + '</option>');
	    	oneValue = value.value;
	    	oneName = value.text;
		});
		
		$("#city").val(oneValue);
		$("#cityName").val(oneName);
		
		
		if (citiesByPostalCode.length >0) {
	        $("#cityDiv").slideDown("medium");
	      } else {
	        $("#cityDiv").slideUp("medium");
	      }

	    searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
		
	}

	var timeoutGeopos;
	function bindPostalCodeAction() {
		$('#organizationForm #postalCode').keyup(function(e){
			clearTimeout(timeoutGeopos);
			timeoutGeopos = setTimeout(function() {
				searchCity();
			}, 1500);
		});

		$('#organizationForm #fullStreet').keyup(function(e){
			if($('#postalCode').val() != "" && $('#postalCode').val() != null){
				//setTimeout($("#iconeChargement").css("visibility", "visible"), 100);
				clearTimeout(timeoutGeopos);
				timeoutGeopos = setTimeout(function() {
					searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
				}, 1500);
			}
		});

		$('#city').change(function(e){ //toastr.info("city change");
			clearTimeout(timeoutGeopos);
			timeoutGeopos = setTimeout(function() {
				$("#cityName").val($('#city option:selected').text());
				searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
			}, 1500);
		});
		$('#organizationCountry').change(function(e){ //toastr.info("city change");
			if($('#organizationForm #postalCode').val() != "" && $('#organizationForm #postalCode').val() != null)
				searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
		});
	}

	function searchCity() { console.log("searchCity");
		
		$("#alert-city-found").addClass("hidden");
		
		$("#btn-show-city").click(function(){
			showMap(true);
			Sig.hideTools();
		});

		var searchValue = $('#organizationForm #postalCode').val();
		if(searchValue.length == 5) {
			$("#city").empty();

			clearTimeout(timeout);
			timeout = setTimeout($("#iconeChargement").show(200));
			clearTimeout(timeout);
			timeout = setTimeout('runShowCity("'+searchValue+'")', 100); 
			$("#iconeChargement").css("display", "inline-block");
		} else {
			$("#cityDiv").slideUp("medium");
			$("#city").empty();
			$("#iconeChargement").hide();
		}
	}

	var currentCityByInsee = null;
	function callBackFullSearch(resultNominatim){
		console.log("callback ok");
		var show = Sig.showCityOnMap(resultNominatim, true, "organization");
		if(!show && currentCityByInsee != null) {
			Sig.showCityOnMap(currentCityByInsee, true, "organization");	
		}
	}

	function searchAddressInGeoShape(){
		if($('#postalCode').val() != "" && $('#postalCode').val() != null){
			$("#iconeChargement").css("display", "inline-block");
			insee=$('#city').val();
			postalCode=$('#postalCode').val();
			streetAddress=$('#organizationForm #fullStreet').val();
			if(streetAddress.length < 2){
	  			$.ajax({
					url: baseUrl+"/"+moduleId+"/sig/getlatlngbyinsee",
					type: 'POST',
					data: "insee="+insee+"&postalCode="+postalCode,
		    		success: function (obj){
		    			//toastr.success("Votre addresse a été mise à jour avec succès");
		    			console.log("res getlatlngbyinsee");
		    			console.dir(obj);
		  				if(typeof obj["geo"] != "undefined"){ 
							if(typeof obj.geoShape != "undefined") {
								//on recherche avec une limit bounds
								var polygon = L.polygon(obj.geoShape.coordinates);
								var bounds = polygon.getBounds();
								Sig.execFullSearchNominatim(0, bounds);
							}
							else{
								//on recherche partout
								Sig.execFullSearchNominatim(0);
							}					
						
						}else{
							//$("#error_street").html("<i class='fa fa-times'></i> Nous n'avons pas trouvé la position de votre commune. Recherche google");	
						}
	
					},
					error: function(error){
						console.log("Une erreur est survenue pendant la recherche de la geopos city");
					}
				});
			
	  		} else{
				
				var requestPart = streetAddress + ", " + postalCode; // + ", " + $("#addressCountry").val();
				requestPart = transformNominatimUrl(requestPart);
	
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
						console.dir(result);
						if(result.length > 0){ 
							var result = result[0];
							var coords = Sig.getCoordinates(result, "markerSingle");
							//si on a une geoShape on l'affiche
							if(typeof result.geoShape != "undefined") Sig.showPolygon(result.geoShape);
							var coords = L.latLng(result.lat, result.lon);
							Sig.showCityOnMap(result, true, "organization");
	
						}else{
							findGeoposByGoogleMaps(requestPart, "<?php echo Yii::app()->params['google']['keyAPP']; ?>");
						}
					},
					error: function (error) {
						console.log("nominatim error");
						console.dir(obj);
						$("#error_street").html("Aucun résultat");
						$("#btn-start-street-search").html('<i class="fa fa-search"></i> Rechercher');
						$.unblockUI();
					}
				});
	
			}
		}
	}

	function callbackFindByInseeSuccessAdd(obj){
		console.log("callbackFindByInseeSuccessAdd");
		console.dir(obj);
		//si on a bien un résultat
		if (typeof obj != "undefined" && obj != "") {
			currentCityByInsee = obj;
			//récupère les coordonnées
			var coords = Sig.getCoordinates(obj, "markerSingle");
			//si on a une street dans le form
			if($('#fullStreet').val() != "" && $('#fullStreet').val() != null){
				//si on a une geoShape dans la reponse obj
				if(typeof obj.geoShape != "undefined") {
					//on recherche avec une limit bounds
					var polygon = L.polygon(obj.geoShape.coordinates);
					var bounds = polygon.getBounds();
					Sig.execFullSearchNominatim(0, bounds);
				}
				else{
					//on recherche partout
					Sig.execFullSearchNominatim(0);
				}
			}
			else{
				Sig.showCityOnMap(obj, true, "organization");
			}
		}
		else {
			console.log("Erreur getlatlngbyinsee vide");
		}
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
			obj["geo"] = { latitude : obj.geometry.location.lat, longitude : obj.geometry.location.lng };
			Sig.showCityOnMap(obj, true, "organization");
			//showGeoposFound(coords, Sig.getObjectId(userConnected), "person", userConnected);
			
  		}else{
  			$("#error_street").html("<i class='fa fa-times'></i> Nous n'avons pas trouvé votre rue.");
  		}
	}

	function manageOrganizationCategory(type) {
		$(".organizationCategory").hide();
		$(".category"+type).show();
	}

</script>	


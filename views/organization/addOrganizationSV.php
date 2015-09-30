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
	#addOrganization{
	<?php if( @$isNotSV ){ ?>
	display: none;
	<?php } ?>
}
	#dropdown_search{
		padding: 0px 15px; 
		margin-left:2%; 
		width:96%;
	};
	.select2-input {
		width:100%;
	}
</style>
<?php 
if( isset($_GET["isNotSV"])) 
	$this->renderPartial('../default/panels/toolbar'); 
?>
<div id="addOrganization" >
	<h2 class='radius-10 padding-10 partition-blue text-bold'> Add an Organization</h2>
	<?php 
	$size = ( !@$isNotSV ) ? " col-md-8 col-md-offset-2" : "col-md-12"
	?>
	<div class="<?php echo $size ?>" >  
	<div class="noteWrap">
	    <div class="panel panel-white">
        	<div class="panel-heading border-light">
				<?php if( !@$isNotSV ){ ?>
					<h1><?php echo Yii::t("organisation","Reference your organization",null,Yii::app()->controller->module->id); ?></h1>
			    <?php } ?>
			    <p><?php echo Yii::t("organisation","If you manage one or several organizations or you're simply part of an organization as member:<br/>You are at the best place to emphasize, to promote, to help your organization in order make it alive.<br/>Verify if the organization already exists with its name or its email in search field.",null,Yii::app()->controller->module->id); ?></p>

			</div>
		</div>
		<div class="panel-body">
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
						<div class="col-md-6 col-sd-6" >
							<input id="organizationId" type="hidden" name="organizationId">
							<div class="form-group">
								<label class="control-label">
									<?php echo Yii::t("common","Name")?> (<?php echo Yii::t("organisation","Corporate Name",null,Yii::app()->controller->module->id)?>) <span class="symbol required"></span>
								</label>
								<span id="organizationNameInput" class="input-icon">
									<input id="organizationName" class="form-control" name="organizationName" value="<?php if($organization && isset($organization['name']) ) echo $organization['name']; else $organization["name"]; ?>">
									<i id="information-icon" class="fa fa-info"></i>
								</span>
							</div>

							<div class="form-group">
								<label class="control-label">
									Type <span class="symbol required"></span>
								</label>
								<select name="type" id="type" class="form-control" >
									<option value=""></option>
									<?php
									foreach ($types as $key=>$value) 
									{
									?>
									<option value="<?php echo $key?>" <?php if(($organization && isset($organization['type']) && $key == $organization['type']) ) echo "selected"; ?> ><?php echo $value?></option>
									<?php 
									}
									?>
								</select>
							</div>
							
							<div class="form-group">
								<label class="control-label">
									Email
								</label>
								<input id="organizationEmail" class="form-control" name="organizationEmail" value="<?php if($organization && isset($organization['email']) ) echo $organization['email']; else echo Yii::app()->session['userEmail']; ?>"/>
							</div>
						</div>
						<div class="col-md-6 col-sd-6 ">
							<div class="form-group">
								<label class="control-label">
									<?php echo Yii::t("common","Interests") ?>
								</label>
			        		    <input id="tagsOrganization" type="hidden" name="tagsOrganization" value="<?php echo ($organization && isset($organization['tags']) ) ? implode(",", $organization['tags']) : ""?>" style="display: none;width:100%; height:35px;">		        		    
							</div>

							<div class="form-group">
								<label class="control-label">
									<?php echo Yii::t("common","Country") ?> <span class="symbol required"></span>
								</label>
								<input type="hidden" name="organizationCountry" id="organizationCountry" style="width: 100%; height:35px;">								
							</div>
								
							<div class="form-group">
								<label for="address">
									<?php echo Yii::t("common","Address") ?> <span class="symbol required"></span>
								</label>
								<input type="text" class="form-control" name="address" id="fullStreet" value="<?php if(isset($organization["address"])) echo $organization["address"]["streetAddress"]?>" >
							</div>
							<div class="row">
								<div class="col-md-4 form-group">
									<label for="postalCode">
										<?php echo Yii::t("common","Postal Code")?> <span class="symbol required"></span>
									</label>
									<input type="text" class="form-control" name="postalCode" id="postalCode" value="<?php if(isset($organization["address"]))echo $organization["address"]["postalCode"]?>" >
									
								</div>
								<div class="col-md-8 form-group" id="cityDiv" style="display:none;">
									<label for="city">
										<?php echo Yii::t("common","City") ?> <span class="symbol required"></span>
									</label>
									<select class="selectpicker form-control" id="city" name="city" title='<?php echo Yii::t("common","Select your City") ?>...'>
									</select>
								</div>
								<div class="alert alert-success pull-left col-md-12 hidden" id="alert-city-found" style="font-family:inherit;">
									<span class="pull-left" style="padding:6px;">Position géographique trouvée <i class="fa fa-smile-o"></i></span>
									<div class="btn btn-success pull-right" id="btn-show-city"><i class="fa fa-map-marker"></i> Personnaliser</div>
								</div>

								<input type="hidden" name="geoPosLatitude" id="geoPosLatitude" style="width: 100%; height:35px;">
								<input type="hidden" name="geoPosLongitude" id="geoPosLongitude" style="width: 100%; height:35px;">
							</div>
						</div>

							
						<div class="col-md-12">
							<div class="form-group">
								<div>
									<label for="form-field-24" class="control-label"> Description <span class="symbol required"></span> </label>
									<textarea  class="form-control" name="description" id="description" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 60px;overflow:scroll;"><?php if($organization && isset($organization['description']) ) echo $organization['description']; else $organization["description"]; ?></textarea>
								</div>
							</div>
						</div>
							
							<div class="form-group hidden" id="sig_position">
							
								<?php 
									//modifier l'url relative si besoin pour trouver communecter/view/sig/
									$relativePath = "../sig/";
									
								   	//modifier les parametre en fonction des besoins de la carte
									$sigParams = array(
								        "sigKey" => "CityOrga",

								        /* MAP */
								        "mapHeight" => 235,
								        "mapTop" => 0,
								        "mapColor" => '',  //ex : '#456074', //'#5F8295', //'#955F5F', rgba(69, 116, 88, 0.49)
								        "mapOpacity" => 0.6, //ex : 0.4

								        /* MAP LAYERS (FOND DE CARTE) */
								        "mapTileLayer" 	  => 'http://{s}.tile.thunderforest.com/landscape/{z}/{x}/{y}.png', //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png'
								        "mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

								        /* MAP BUTTONS */
								        //"mapBtnBgColor" => '#E6D414',
								        //"mapBtnColor" => '#213042',
								        //"mapBtnBgColor_hover" => '#5896AB',

								        /* USE */
								        "titlePanel" 		 => '',
								        "usePanel" 			 => false,
								        "useFilterType" 	 => false,
								        "useRightList" 		 => false,
								        "useZoomButton" 	 => true,
								        "useHomeButton" 	 => false,
								        "useHelpCoordinates" => false,
								        "useFullScreen" 	 => false,
								        "useResearchTools" 	 => false,
								        "useChartsMarkers" 	 => false,

								        "notClusteredTag" 	 => array(),
								        "firstView"		  	 => array(  "coordinates" => array(-21.137453135590444, 55.54962158203125),
	        														 	"zoom"		  => 14),
								    );
								 
									/* ***********************************************************************************/
									//chargement de toutes les librairies css et js indispensable pour la carto
							    	$this->renderPartial($relativePath.'generic/mapLibs', array("sigParams" => $sigParams)); 
							    	//$moduleName = "sigModule".$sigParams['sigKey'];

									/* ***************** modifier l'url si besoin pour trouver ce fichier *******************/
								   	//chargement de toutes les librairies css et js indispensable pour la carto
								  	//$this->renderPartial($relativePath.'generic/mapCss', array("sigParams" => $sigParams));
								?>
								<style>
								.leaflet-map-pane{
									top:0 !important;
								}
								</style>
								<?php //$this->renderPartial($relativePath.'generic/mapView', array( "sigParams" => $sigParams)); ?>
								<div class="alert alert-info hidden">
									Pour un placement plus précis, déplacez votre icône sur la carte.
								</div>	
								<div id="mapCanvasCityOrga" class="mapCanvas" style="height:235px; width:100%;"></div>		
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
						<button class="btn btn-primary" id="btnSaveNewOrganization"><?php echo Yii::t("common","SAVE")?></button>
					</div>
					<div id="infoOrgaSameName" style='display:none'>
						<h1>Similar organization already exists : please check below</h1>
						<div id="listOrgaSameName">
						</div>
						<input type="button" id="ok" value="ok" /> 
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

var formValidator = function() {
	addCustomValidators();
	var form = $('#organizationForm');
	var errorHandler = $('.errorHandler');
	form.validate({
		rules : {
			organizationCountry : {
				required : true
			},
			description : {
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
				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
	            '<blockquote>'+
	              "<p>C'est le devoir de chaque homme de rendre au monde au moins autant qu'il en a reçu..</p>"+
	              '<cite title="Einstein">Einstein</cite>'+
	            '</blockquote> '
			});

	        $.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/organization/savenew",
		    	  data: $("#organizationForm").serialize(),
		    	  success: function(data){
		    			if(!data.result){
	                        toastr.error(data.msg);
	                   		$.unblockUI();
	                   	}
	                    else { 
	                        toastr.success(data.msg);
	                        if( "undefined" != typeof updateMyOrganization )
		        				updateMyOrganization(data.newOrganization, data.id);
							$.hideSubview();
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
	//very strange BUg this only works when declaring it twice, no idea and no time to loose
	$('#tagsOrganization').select2({ tags: <?php echo $tags?> });
	$('#tagsOrganization').select2({ tags: <?php echo $tags?> });
	$('#organizationCountry').select2({
		data : countries
	});

	$('#btn-show-city').click(function(){
		$("#ajaxSV").hide(400);
		//showCityOnMap();
	});

	$("textarea.autosize").autosize();
	
	

	formValidator();
	initForm();
	bindPostalCodeAction();
 }); 

	function initForm() {
		$("#information-icon").hide();
		$('#organizationName').off().on("blur", function(){
	    	var search = $('#organizationName').val();
	    	if (search.length > 3) {
	    		autoCompleteOrganizationName(encodeURI(search));
	    	}
		});

		$("#information-icon").off().on("click", function() {
            $.blockUI({ message: $('#infoOrgaSameName'), css: { width: '400px' } }); 
		});

		$('#infoOrgaSameName #ok').click(function() { 
            $.unblockUI(); 
            return false; 
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
					var htmlIco ="<i class='fa fa-users fa-2x'></i>"
					if(orga.type){
						typeIco = orga.type;
						htmlIco ="<i class='fa "+mapIconTop[orga.type] +" fa-2x'></i>"
 					}
 					if (orga.address != null) {
						city = orga.address.addressLocality;
						postalCode = orga.address.postalCode;
					}
 					if("undefined" != typeof orga.profilImageUrl && orga.profilImageUrl != ""){
 						var htmlIco= "<img width='50' height='50' alt='image' class='img-circle' src='"+baseUrl+orga.profilImageUrl+"'/>"
 					}
 					str += 	"<div><ol>"+
 							"<a href='#' data-id='"+ orga._id["$id"] +"' data-type='"+ typeIco +"'>"+
 							"<span>"+ htmlIco +"</span>  " + orga.name +
 							"<span class='city-search'> "+postalCode+" "+city+"</span>"+
 							"</a></ol></div>";
 					compt++;
	  				//str += "<li class='li-dropdown-scope'><a href='javascript:initAddMeAsMemberOrganizationForm(\""+key+"\")'><i class='fa "+mapIconTop[value.type]+"'></i> " + value.name + "</a></li>";
	  			});
				
				if (compt > 0) {
					$("#information-icon").show();
				} else {
					$("#information-icon").hide();
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
	}

	function runShowCity(searchValue) {
		
		citiesByPostalCode = getCitiesByPostalCode(searchValue);

		Sig.execFullSearchNominatim(0);
		
		var oneValue = "";
		console.table(citiesByPostalCode);
		$.each(citiesByPostalCode,function(i, value) {
	    	$("#city").append('<option value=' + value.value + '>' + value.text + '</option>');
	    	oneValue = value.value;
		});
		
		if (citiesByPostalCode.length == 1) {
			$("#city").val(oneValue);
		}

		if (citiesByPostalCode.length >0) {
	        $("#cityDiv").slideDown("medium");
	      } else {
	        $("#cityDiv").slideUp("medium");
	      }

	    $("#alert-city-found").removeClass("hidden");
	}

	function bindPostalCodeAction() {
		$('#organizationForm #postalCode').keyup(function(e){
			searchCity();
		});

		$('#organizationForm #postalCode').change(function(e){
			searchCity();
		});
	}

	function searchCity() {
		var searchValue = $('#organizationForm #postalCode').val();

		$("#sig_position").addClass("hidden");

		if(searchValue.length == 5) {
			$("#city").empty();
			clearTimeout(timeout);
			timeout = setTimeout($("#iconeChargement").css("visibility", "visible"), 100);
			clearTimeout(timeout);
			timeout = setTimeout('runShowCity("'+searchValue+'")', 100); 
		} else {
			$("#cityDiv").slideUp("medium");
			$("#city").empty();
		}
	}

	//var Sig = null;

	/**************************** DONNER UN NOM DIFFERENT A LA MAP POUR CHAQUE CARTE ******************************/
	//le nom de cette variable doit changer dans chaque vue pour éviter les conflits (+ vérifier dans la suite du script)
	var mapCityOrga = null;
	var marker = null;

	/**************************************************************************************************************/
	//mémorise l'url des assets (si besoin)
	var assetPath 	= "<?php echo $this->module->assetsUrl; ?>";

	function callBackFullSearch(resultNominatim){
		//console.log("callback ok");
		showCityOnMap(resultNominatim);
	}

	function showCityOnMap(geoPosition){ 

		//var geoPosition = geoPositionCity;
		
		Sig.clearMap();
		console.log("geoPosition");
		console.dir(geoPosition);

		var cp = $("#postalCode").val();

		var position = null;
		$.each(geoPosition, function (key, value){
			//console.log((citiesByPostalCode));
			$.each(citiesByPostalCode, function (key2, value2){

				var addressCp = value.address.postcode ? value.address.postcode : "";
				var city = value.address.city != null ? value.address.city : 
							value.address.village ? value.address.village : "";

				if(city != "" && value2.text != null){
					
					console.log(value2.text); console.log(value.address.city);
					if(Sig.clearStr(value2.text) == Sig.clearStr(city) 
						&& cp == addressCp
						&& position == null) 
						position = value;
				}
			});
		});

		if(position == null) position = geoPosition[0];
		//console.log("position"); console.dir(position);
		 
		var latlng = [position["lat"], position["lon"]];
		//Sig.map.setView(latlng, 15);

		Sig.centerSimple(latlng, 15);
		//console.log("center ok");

		var content = Sig.getPopupNewData();
		var properties = { 	id : "0",
							icon : Sig.getIcoMarkerMap({"type" : "organization"}),
							content: content };

		var markerNewData = Sig.getMarkerSingle(Sig.map, properties, latlng);
		markerNewData.dragging.enable();
		markerNewData.openPopup();
		$("#btn-validate-geopos").click(function(){
			btnValidateClick();
		});

		markerNewData.on('dragend', function(e){
			//console.log("dragend");
			markerNewData.openPopup();	
		});

		markerNewData.on('popupopen', function(e){
			//console.log("popupopen");
			$("#btn-validate-geopos").click(function(){
				btnValidateClick();
			});
		});
		
		markerNewData.on('dragstart', function(e){
			//console.log("dragstart");
			$("#ajaxSV").hide(400);
		});

		$('#btn-show-city').click(function(){
			$("#ajaxSV").hide(400);
			Sig.map.panTo(markerNewData.getLatLng(), {animate:true});
		});

		function btnValidateClick(){ //alert("yepaé");
			//console.log("btnValidateClick");
			markerNewData.closePopup();
			Sig.centerSimple(markerNewData.getLatLng(), 15);
			$("#ajaxSV").show(400);
			$("#geoPosLongitude").attr("value", markerNewData.getLatLng().lng);
			$("#geoPosLatitude").attr("value", markerNewData.getLatLng().lat);
			Sig.map.invalidateSize(false);
			markerNewData.openPopup();
		}
		
		
	}

</script>	


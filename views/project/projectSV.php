<?php 
	$cssAnsScriptFilesModule = array(
		//Data helper
		'/js/dataHelpers.js'
		);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
	$cssAnsScriptFilesModule = array(
	'/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
	'/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js' , 

	'/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css',
	'/plugins/bootstrap-daterangepicker/daterangepicker.js' , 
	//'/plugins/bootstrap-select/bootstrap-select.min.css',
	//'/plugins/bootstrap-select/bootstrap-select.min.js'
	'/plugins/autosize/jquery.autosize.min.js',

    //'/plugins/toopay-bootstrap-markdown/css/bootstrap-markdown.min.css',
    //'/plugins/toopay-bootstrap-markdown/js/bootstrap-markdown.js',
);

HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->request->baseUrl);
?>
<style>
#newProject{
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
#newProject input, #newProject button.dropdown-toogle, #newProject textarea{
	border: 1px solid #CCC !important;
}
#newProject .select2-input{
	border:none !important;
}
#iconeChargement{
		display: none;
	}

/* design alpha tango*/
.main-col-search{
	background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/tango-circle-bg-purple.png");
	background-size:100%;
	background-repeat: no-repeat;
	background-color: #d4cdf0 !important;
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

/*.main-top-menu{
	background-color: rgba(255, 255, 255, 0.82) !important;
}*/
.select2-container .select2-choice .select2-arrow b::before{
	/*content:"";*/
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
.input-icon > input {
    padding-left: 25px;
    padding-right: 6px;
}
.noteWrap .note-editor .note-editable{
	background-color: white;
    border: 1px solid #aaa;
    padding: 5px;
}
</style>


<!-- *** NEW PROJECT *** -->
<?php 
	$this->renderPartial('../default/panels/toolbar'); 
?>
<div id="newProject">

	<?php $this->renderPartial('../pod/helpPostalCode', array("idCountryInput"=>"projectCountry"));  ?>

	<div class="noteWrap col-md-12 form-add-data" >  
		 <div class="panel panel-white">
        	<div class="panel-heading border-light text-dark">
			    <p><i class='fa fa-info-circle'></i> <?php echo Yii::t("project","If you want to create a new project in order to make it more visible : it's the best place<br/>You can as well organize your project team, plan tasks, discuss, take decisions...<br/>Depending on the project visibility, contributors can join the project and help<br>to make it happen ! ",null,Yii::app()->controller->module->id) ?></p>

			</div>
		</div>
		<form class="form-project">
			<div class="row">
				<div class="col-md-12">
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-times-sign"></i> <?php echo Yii::t("common","You have some form errors. Please check below.") ?>
					</div>
					<div class="successHandler alert alert-success no-display">
						<i class="fa fa-ok"></i> <?php echo Yii::t("common","Your form validation is successful") ?>!
					</div>
				</div>
				<div class="col-md-12">
					<input class="project-id hide" type="text">
					<div class="col-md-6 col-sd-6" >
						<input class="project-id hide" type="text">
						<div class="form-group">
							<label class="control-label text-purple">
								<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Name") ?><span class="symbol required"></span>
							</label>
							<input class="project-name form-control" name="projectName" value=""/>
						</div>
						<div class="form-group">
							<label for="projectRangeDate" class="control-label text-purple">
								<i class="fa fa-angle-down"></i> <span><?php echo Yii::t("project","Project duration",null,Yii::app()->controller->module->id) ?></span>
							</label>
							<span class="input-icon">
								<input type="text" class="project-range-date form-control" name="ad_projectRangeDate" placeholder="Range date"/>
								<i class="fa fa-calendar"></i> 
							</span>
							<div class="hide">
								<input type="text" class="project-start-date" value="" name="projectStartDate"/>
								<input type="text" class="project-end-date" value="" name="projectEndDate"/>
							</div>
						</div>
						<div class="form-group">
								<label class="control-label text-purple">
									<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Tags") ?>
								</label>
			        		    <input id="tagsProject" type="" data-type="select2" name="tagsProject" value="" style="display: none;width:100%; height:auto;">		        		    
						</div>
						
						<!--<div class="form-group">
							<label class="control-label">
								Url
							</label>
							<input class="project-url form-control" name="projectUrl" value=""/>
						</div>
						<div class="form-group">
							<label class="control-label">
								Licence
							</label>
							<input class="project-licence form-control" name="projectLicence" value=""/>
						</div>-->
					</div>

					<div class="col-md-6 col-sd-6 ">
						<div class="form-group">
							<label class="control-label text-purple">
								<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Country") ?> 
							</label>
							<input type="hidden" name="projectCountry" id="projectCountry" style="width: 100%; height:35px;"/>								
						</div>
						<div class="form-group">
							<label class="control-label text-purple">
								<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Adresse") ?> 
							</label>
							<span class="input-icon text-purple">
								<input type="text" class="form-control" name="streetAddress" id="fullStreet" >
								<i class="fa fa-road"></i>
							</span>
						</div>
						<div class="row">
							<div class="col-md-4 form-group">
								<label for="postalCode" class="control-label text-purple">
								<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Postal Code") ?> <span class="symbol required"></span>
								<i class="fa fa-spin fa-refresh" id="iconeChargement"></i>
								</label>
								<input type="text" class="form-control" name="postalCode" id="postalCode" value="" ><br>
								<a href="javascript:" class="btn btn-primary btn-xs" onclick="openModalHelpCP()"><i class="fa fa-info-circle"></i> Trouver un code postal</a>
							</div>
							<div class="col-md-8 form-group" id="cityDiv" style="display:none;">
								<label class="control-label text-purple" for="city">
									<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","City") ?>
								</label>
								<select class="selectpicker2 form-control" id="city" name="city" title='Select your City...'>
								</select>
							</div>
							<input type="hidden" name="cityName" id="cityName" value=""/>

						</div>
						
						<div class="alert alert-success pull-left col-md-12 hidden" id="alert-city-found" style="font-family:inherit;">
							<span class="pull-left" style="padding:6px;">Position géographique trouvée <i class="fa fa-smile-o"></i></span>
							<div class="btn btn-success pull-right" id="btn-show-city"><i class="fa fa-map-marker"></i> Personnaliser</div>
						</div>

						<input type="hidden" name="geoPosLatitude" id="geoPosLatitude">
						<input type="hidden" name="geoPosLongitude" id="geoPosLongitude">
					
					</div>
					<div class="form-group col-md-12">
							<div>
								<h3 class="text-dark">
									<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Description") ?>
								</h3>
								<textarea  class=" wysiwygInput project-description form-control" name="description" id="description" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 120px;"></textarea>

							</div>
					</div>
						
				</div>
				
				<?php 
				if( Yii::app()->session['userId'] ){ ?>
				<div class= "row col-xs-12">
					<button class="pull-right btn bg-purple" onclick="$('.form-event').submit();"><i class="fa fa-save"></i> Enregistrer</button>
				</div>
				<?php } else { ?>
					<div class= "row  col-xs-12">
						<button class="pull-right btn btn-primary" onclick="showPanel('box-login')">Please Login First</button>
					</div>
				<?php } ?>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">

var citiesByPostalCode;
var parentType = "<?php echo $parentType ?>";
var parentId = "<?php echo $parentId ?>";
jQuery(document).ready(function() {
	$('#tagsProject').select2({tags:<?php echo $tags ?>});
	$('#tagsProject').select2({tags:<?php echo $tags ?>});
	addCustomValidators();
	initProjectForm();
 	bindPostalCodeAction();
 	runProjectFormValidation();
 	Sig.clearMap();
		
	//var countries = <?php echo json_encode($countries) ?>;
	var countries = getCountries("select2");

	$('#projectCountry').select2({
		data : countries
	});
	var userCountry = "<?php echo @Yii::app()->session['user']['addressCountry']; ?>";
	$("#projectCountry").select2('val', userCountry);

	$("textarea.autosize").autosize();

    $(".daterangepicker").on("hide.daterangepicker", function(){
 		console.log("ok");
 	});

 	setTitle("Créer un projet","<i class='fa fa-plus'></i> <i class='fa fa-lightbulb-o'></i>");

 	$(".wysiwygInput").off().on("focus", function(){
	 	activateSummernote('#description');
	 });
});


//var dateToShow, calendar;
// creates an array of projects to display in the calendar
//validate new project form
function runProjectFormValidation(el) {
	var formProject = $('.form-project');
	var errorHandler2 = $('.errorHandler', formProject);
	var successHandler2 = $('.successHandler', formProject);
	formProject.validate({
		errorElement : "span", // contain the error msg in a span tag
		errorClass : 'help-block',
		errorPlacement : function(error, element) {// render error placement for each input type
			if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
				error.insertAfter($(element).closest('.form-group').children('div').children().last());
			} else if (element.parent().hasClass("input-icon")) {
				error.insertAfter($(element).parent());
			} else {
				error.insertAfter(element);
				// for other inputs, just perform default behavior
			}
		},
		ignore : "",
		rules : {
			projectName : {
				minlength : 2,
				required : true
			},
			projectStartDate : {
				required : true,
				date : true
			},
			projectEndDate : {
				required : true,
				date : true
			},
			postalCode : {
				rangelength : [4, 5],
				required : true,
				validPostalCode : true
			}
		},
		messages : {
			projectName : "* <?php echo Yii::t("common","Please specify the name") ?>"

		},
		invalidHandler : function(project, validator) {//display error alert on form submit
			successHandler2.hide();
			errorHandler2.show();
		},
		highlight : function(element) {
			$(element).closest('.help-block').removeClass('valid');
			// display OK icon
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
			// add the Bootstrap error class to the control group
		},
		unhighlight : function(element) {// revert the change done by hightlight
			$(element).closest('.form-group').removeClass('has-error');
			// set error class to the control group
		},
		success : function(label, element) {
			label.addClass('help-block valid');
			// mark the current input as valid and display OK icon
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
		},
		submitHandler : function(form) {
			successHandler2.show();
			errorHandler2.hide();
			
			startDateSubmitProj = moment($(".form-project .project-start-date").val()).format('YYYY/MM/DD HH:mm');
			endDateSubmitProj = moment($(".form-project .project-end-date").val()).format('YYYY/MM/DD HH:mm');
			
			newProject = new Object;
			newProject.name = $(".form-project .project-name ").val(),
			newProject.parentType=parentType,
			newProject.parentId=parentId
			newProject.startDate=startDateSubmitProj,
			newProject.endDate=endDateSubmitProj,
			newProject.city=$(".form-project #city").val(),
			newProject.cityName=$(".form-project #cityName").val(),
			newProject.streetAddress=$(".form-project #fullStreet").val(),
			newProject.postalCode=$(".form-project #postalCode").val(),
			//newProject.description=$(".form-project .note-editable").text(),
			newProject.geoPosLatitude = $(".form-project #geoPosLatitude").val(),			
			newProject.geoPosLongitude = $(".form-project #geoPosLongitude").val(),				
			newProject.tags = $(".form-project #tagsProject").val();

			if ($(".form-project .note-editor").length != 0)
				newProject.description=$(".form-project #description").code();
			else
				newProject.description="";

			console.log(newProject);
			$.blockUI({
				message : '<span class="homestead"><i class="fa fa-spinner fa-circle-o-noch"></i> <?php echo Yii::t("common","Save Processing") ?> ...</span>'
			});
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+'/project/save',
		        dataType: "json",
		        data: newProject,
				type: "POST",
		    })
		    .done(function (data) {
		        if (data &&  data.result) {               
		        	toastr.success("<?php echo Yii::t("common",'Project created successfully') ?>");
		        	$.unblockUI();
		        	//console.dir(data);
	        		addFloopEntity(data.id.$id, "projects", newProject);
	        		loadByHash("#project.detail.id."+data.id.$id);
	      	} else {
		           $.unblockUI();
		           toastr.error(data.msg);
		        }
		    });
		}
	});
};

// enables the edit form 
function initProjectForm(el) {
	$(".close-new-project").off().on("click", function() {
		$(".back-subviews").trigger("click");
	});
	$(".form-project .help-block").remove();
	$(".form-project .form-group").removeClass("has-error").removeClass("has-success");
	
	$(".form-project .project-id").val("");
	$(".form-project .project-name").val("");
	$(".form-project #tagsProject").select2('val', "");
	//$("#addOrganization #organizationCountry").select2('val', "");
	$('.form-project .all-day-range').hide();
	$(".form-project .project-start-date").val(moment());
	$(".form-project .project-end-date").val(moment().add('days', 1));
	
	$('.form-project .project-range-date').val(moment().format('DD/MM/YYYY') + ' - ' + moment().add('days', 1).format('DD/MM/YYYY'))
			.daterangepicker({  
				startDate: moment(),
				endDate: moment().add('days', 1),
				format: 'DD/MM/YYYY'
			},
			function(start, end, label) {
    			$(".form-project .project-start-date").val(start);
				$(".form-project .project-end-date").val(end);
			}
		);
	
	$('.form-project .all-day').bootstrapSwitch();

	$('.form-project .project-range-date').on('apply.daterangepicker', function(ev, picker) {
		$(".form-project .project-start-date").val(picker.startDate);
		$(".form-project .project-end-date").val(picker.endDate);
	});

	var startDate = moment($(".form-project").find("project-start-date").val());
	var endDate = moment($(".form-project").find("project-end-date").val());

	$('.form-project .project-range-date').data('daterangepicker').setStartDate(startDate);
	$('.form-project .project-range-date').data('daterangepicker').setEndDate(endDate);
	//alert();
	
	//$(".mdInput").markdown({autofocus:false,savable:false})
};


//*************** Postal Code Management ****************************/
function runShowCity(searchValue) {
	citiesByPostalCode = getCitiesByPostalCode(searchValue);
	

	var oneValue = "";  var oneName = "";
	$.each(citiesByPostalCode,function(i, value) {
    	$("#city").append('<option value=' + value.value + '>' + value.text + '</option>');
    	oneValue = value.value;
    	oneName = value.text;

	});
	
	//if (citiesByPostalCode.length == 1) {
	$("#city").val(oneValue);
	$("#cityName").val(oneName);

	//}

	if (citiesByPostalCode.length >0) {
	    $("#cityDiv").slideDown("medium");
	} else {
	    $("#cityDiv").slideUp("medium");
	}

	searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);

}

var timeoutGeopos;
function bindPostalCodeAction() {

	$('.form-project #postalCode').keyup(function(e){
		clearTimeout(timeoutGeopos);
		timeoutGeopos = setTimeout(function() {
			searchCity();
		}, 1500);
	});

	$('.form-project  #fullStreet').keyup(function(e){
		if($('#postalCode').val() != "" && $('#postalCode').val() != null){
			//setTimeout($("#iconeChargement").css("visibility", "visible"), 100);
			clearTimeout(timeoutGeopos);
			timeoutGeopos = setTimeout(function() {
				searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
			}, 1500);
		}
	});

	$('.form-project #city').change(function(e){ //toastr.info("city change");
		clearTimeout(timeoutGeopos);
		timeoutGeopos = setTimeout(function() {
			$("#cityName").val($('#city option:selected').text());
			searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
		}, 1500);
	});
	$('.form-project  #projectCountry').change(function(e){ //toastr.info("city change");
		if($('.form-project#postalCode').val() != "" && $('.form-project #postalCode').val() != null)
			searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
	});
}

function searchCity() {
	$("#alert-city-found").addClass("hidden");
	
	$("#btn-show-city").click(function(){
		showMap(true);
		Sig.hideTools();
	});

	var searchValue = $('.form-project #postalCode').val();
	if(searchValue.length <= 5) {
		$("#city").empty();
		setTimeout(function(){
			$("#iconeChargement").css("display", "inline-block");
			runShowCity(searchValue);
		}, 100); 
	} else {
		$("#cityDiv").slideUp("medium");
		$("#city").empty();
		$("#iconeChargement").hide();
	}
}

function convertDate2(date, num){
	var dateTab = date.split("-");
	//console.log(dateTab, dateTab[num]);
	var hour = dateTab[num].split(" ")[1+num];
	var hourRes ="";
	var hourUnit = dateTab[num].split(" ")[2+num];
	//console.log(hourUnit);
	if(hourUnit = "PM"){
		hours = hour.split(":");
		var newhour = parseInt(hours[0])+12;
		if(newhour==24){
			newhour = 00;
		}
		hourRes = newhour+":"+hours[1];
	}else{
		hourRes = hour;
	}
	//console.log(hourRes);
	return dateTab[num].split(" ")[0+num]+" "+hourRes;
}

	var currentCityByInsee = null;
	function callBackFullSearch(resultNominatim){
		console.log("callback ok");
		console.dir(resultNominatim);
		var show = Sig.showCityOnMap(resultNominatim, true, "project");
		if(!show && currentCityByInsee != null) {
			Sig.showCityOnMap(currentCityByInsee, true, "project");
		}
	}

	function searchAddressInGeoShape(){
		if($('#postalCode').val() != "" && $('#postalCode').val() != null){
			$("#iconeChargement").css("display", "inline-block");
			insee=$('#city').val();
			postalCode=$('#postalCode').val();
			streetAddress=$('.form-project #fullStreet').val();
			country = $('.form-project  #projectCountry').val();
			country = getFullTextCountry(country);
			
			if(streetAddress.length < 2){
	  			$.ajax({
					url: baseUrl+"/"+moduleId+"/sig/getlatlngbyinsee",
					type: 'POST',
					data: "insee="+insee+"&postalCode="+postalCode,
		    		success: function (obj){
		    			//toastr.success("Votre addresse a été mise à jour avec succès");
		    			console.log("res getlatlngbyinsee");
		    			console.dir(obj);
		  				if(typeof obj["geo"] != "undefined"){ console.log("FULL SEARCH ???? ", $("#fullStreet").val());
		  				console.dir(obj);
		  					if($("#fullStreet") && $("#fullStreet").val() != ""){ 
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
								obj["address"] = {"postalCode" : $('#postalCode').val(), "city" : obj["name"] };
								callBackFullSearch(obj);
							}
						}
	
					},
					error: function(error){
						$("#iconeChargement").hide();
						console.log("Une erreur est survenue pendant la recherche de la geopos city");
					}
				});
			
	  		} else{
				
				var requestPart = streetAddress + ", " + country + ", " + postalCode; // + ", " + $("#addressCountry").val();
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
		/*if($('#postalCode').val() != "" && $('#postalCode').val() != null){
			$("#iconeChargement").css("display", "inline-block");
			findGeoposByInsee($('#city').val(), callbackFindByInseeSuccessAdd);
		}*/
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
				Sig.showCityOnMap(obj, true, "project");
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
  			$("#iconeChargement").hide();
  			$("#error_street").html("<i class='fa fa-times'></i> Nous n'avons pas trouvé votre rue.");
  		}
	}
	
</script>
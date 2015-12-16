<?php 
	$cssAnsScriptFilesModule = array(
		//Data helper
		'/js/dataHelpers.js'
		);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
	$cssAnsScriptFilesModule = array(
	'/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
	'/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js' , 
	'/plugins/moment/min/moment.min.js' , 
	'/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css',
	'/plugins/bootstrap-daterangepicker/daterangepicker.js' , 
	'/plugins/select2/select2.css',
	'/plugins/select2/select2.min.js',
	//'/plugins/bootstrap-select/bootstrap-select.min.css',
	//'/plugins/bootstrap-select/bootstrap-select.min.js'
	'/plugins/autosize/jquery.autosize.min.js'
);

HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");
?>
<style>
#newProject{
	float: left;
	padding: 10px;
	background-color: rgba(242, 242, 242, 0.9);
	width: 100%;
	-moz-box-shadow: 1px 1px 5px 3px #cfcfcf;
	-webkit-box-shadow: 1px 1px 5px 3px #cfcfcf;
	-o-box-shadow: 1px 1px 5px 3px #cfcfcf;
	box-shadow: 1px 1px 5px 3px #cfcfcf;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#cfcfcf, Direction=134, Strength=5);
}
#newProject input, #newProject button.dropdown-toogle, #newProject textarea{
	border: 1px solid #CCC !important;
}
#newProject .select2-input{
	border:none !important;
}
</style>


<!-- *** NEW PROJECT *** -->
<?php if( @$isNotSV ){ 
	$this->renderPartial('../default/panels/toolbar'); 
}

if( !isset($_GET["isNotSV"])) 
	$this->renderPartial('../default/mapFormSV'); 

?>
<div id="newProject">
<?php if( @$isNotSV ){ ?>
<h2 class='radius-10 padding-10 text-purple text-bold'><i class="fa fa-plus"></i> <i class="fa fa-lightbulb-o fa-2x"></i> <?php echo Yii::t("project","Add a new project",null,Yii::app()->controller->module->id) ?></h2>
<?php } ?>
<?php 
	$size = ( !@$isNotSV ) ? " col-md-8 col-md-offset-2" : "col-md-12"
	?>
	<div class="noteWrap <?php echo $size ?>  form-add-data" >  
		 <div class="panel panel-white">
        	<div class="panel-heading border-light">
				<?php if( !@$isNotSV ){ ?>
				<h1><?php echo Yii::t("project","Add a new project",null,Yii::app()->controller->module->id) ?></h1>
			    <?php } ?>
			    <p><?php echo Yii::t("project","If you want to create a new project in order to make it more visible : it's the best place<br/>You can as well organize your project team, plan tasks, discuss, take decisions...<br/>Depending on the project visibility, contributors can join the project and help<br>to make it happen ! ",null,Yii::app()->controller->module->id) ?></p>

			</div>
		</div>
		<form class="form-project">
			<div class="row">
				<div class="col-md-12">
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
					</div>
					<div class="successHandler alert alert-success no-display">
						<i class="fa fa-ok"></i> Your form validation is successful!
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
							<label for="projectRangeDate" class="text-purple">
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
			        		    <input id="tagsProject" type="" data-type="select2" name="tagsProject" value="" style="display: none;width:100%; height:35px;">		        		    
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
								<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Country") ?> <span class="symbol required"></span>
							</label>
							<input type="hidden" name="projectCountry" id="projectCountry" style="width: 100%; height:35px;"/>								
						</div>
						<div class="form-group">
							<label class="control-label text-purple">
								<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Adresse") ?> <span class="symbol required"></span>
							</label>
							<span class="input-icon text-purple">
								<i class="fa fa-angle-down"></i> <input type="text" class="form-control" name="streetAddress" id="fullStreet" >
								<i class="fa fa-road"></i>
							</span>
						</div>
						<div class="row">
							<div class="col-md-4 form-group">
								<label for="postalCode" class="text-purple">
								<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Postal Code") ?> <span class="symbol required"></span>
								</label>
								<input type="text" class="form-control" name="postalCode" id="postalCode" value="" >	
							</div>
							<div class="col-md-8 form-group" id="cityDiv" style="display:none;">
								<label for="city">
									Ville
								</label>
								<select class="selectpicker2 form-control" id="city" name="city" title='Select your City...'>
								</select>
							</div>
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
								<label for="form-field-24" class="control-label text-purple">
								<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Description") ?></label>
								<textarea  class="project-description form-control" name="description" id="description" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 120px;"></textarea>
							</div>
					</div>
						
				</div>
				<?php if(!isset(Yii::app()->session["userEmail"])){?>
				<div class="col-md-12">
					<div class="form-group">
						<input class="project-name form-control" name="projectName" type="text" placeholder="Project Name...">
					</div>
				</div>
				<?php } ?>	
				<?php if( @$isNotSV ){ ?>
					<?php if( Yii::app()->session['userId'] ){ ?>
					<div class= "row col-xs-12">
						<button class="pull-right btn btn-primary" onclick="$('.form-event').submit();">Enregistrer</button>
					</div>
					<?php } else { ?>
						<div class= "row  col-xs-12">
							<button class="pull-right btn btn-primary" onclick="showPanel('box-login')">Please Login First</button>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">

var citiesByPostalCode;

jQuery(document).ready(function() {

	$('#tagsProject').select2({tags:<?php echo $tags ?>});
	$('#tagsProject').select2({tags:<?php echo $tags ?>});
	addCustomValidators();
	initProjectForm();
	bindProjectSubViewProjects();
 	bindPostalCodeAction();
 	runProjectFormValidation();
 	Sig.clearMap();
		
	//var countries = <?php echo json_encode($countries) ?>;
	var countries = getCountries("select2");

	$('#projectCountry').select2({
		data : countries
	});
	$("textarea.autosize").autosize();

    $(".daterangepicker").on("hide.daterangepicker", function(){
 		console.log("ok");
 	});
});

function bindProjectSubViewProjects() {
	$(".close-subview-button").off().on("click", function(e) {
		$(".close-subviews").trigger("click");
		e.prprojectDefault();
	});
};

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
				rangelength : [5, 5],
				required : true,
				validPostalCode : true
			}
		},
		messages : {
			projectName : "* Please specify the project name"

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
			endDateSubmitProj = moment($(".form-project .project-start-date").val()).format('YYYY/MM/DD HH:mm');
			
			//alert(startDateSubmitProj);
			newProject = new Object;
			newProject.name = $(".form-project .project-name ").val(), 
			//newProject.url = $('.form-project .project-url').val(), 
			//newProject.version = $(".form-project .project-version").val(), 
			//newProject.licence = $(".form-project .project-licence").val(),
			newProject.startDate=startDateSubmitProj,
			newProject.endDate=endDateSubmitProj,
			newProject.city=$(".form-project #city").val(),
			newProject.postalCode=$(".form-project #postalCode").val(),
			newProject.description=$(".form-project .project-description").val(),
			newProject.geoPosLatitude = $(".form-project #geoPosLatitude").val(),			
			newProject.geoPosLongitude = $(".form-project #geoPosLongitude").val(),				
			newProject.tags = $(".form-project #tagsProject").val();
			console.log(newProject);
			$.blockUI({
				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
	            '<blockquote>'+
	              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
	              '<cite title="Hegel">Hegel</cite>'+
	            '</blockquote> '
			});
			<?php $typeId = ( isset($_GET["id"]) ) ? '/id/'.$_GET["id"].'/type/'.$_GET["type"] : ""; ?>
			var typeId = "<?php echo $typeId; ?>";
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+'/project/save'+typeId,
		        dataType: "json",
		        data: newProject,
				type: "POST",
		    })
		    .done(function (data) {
		        if (data &&  data.result) {               
		        	toastr.success('Project Created success');
		        	$.unblockUI();
		        	if( isNotSV )	{
		        		addFloopEntity(data.id, "projects", newProject);
						showAjaxPanel( '/person/directory?isNotSV=1&tpl=directory2&type=<?php echo Project::COLLECTION ?>', 'MY PROJECTS','lightbulb-o' );
		        	}
		        	else if( 'undefined' != typeof updateProject && typeof updateProject == "function" )
		        		updateProject( newProject, data.id );
						
					
					if( !isNotSV )	
						$.hideSubview();
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
};


//*************** Postal Code Management ****************************/
function runShowCity(searchValue) {
	citiesByPostalCode = getCitiesByPostalCode(searchValue);
	

	var oneValue = "";
	$.each(citiesByPostalCode,function(i, value) {
    	$("#city").append('<option value=' + value.value + '>' + value.text + '</option>');
    	oneValue = value.value;
	});
	
	//if (citiesByPostalCode.length == 1) {
	$("#city").val(oneValue);
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
		
	var searchValue = $('.form-project #postalCode').val();
	if(searchValue.length == 5) {
		$("#city").empty();
		setTimeout(function(){
			$("#iconeChargement").css("visibility", "visible");
			runShowCity(searchValue);
		}, 100); 
	} else {
		$("#cityDiv").slideUp("medium");
		$("#city").empty();
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
		var show = Sig.showCityOnMap(resultNominatim, <?php echo isset($_GET["isNotSV"]) ? "true":"false" ; ?>, "project");
		if(!show && currentCityByInsee != null) 
			Sig.showCityOnMap(currentCityByInsee, <?php echo isset($_GET["isNotSV"]) ? "true":"false" ; ?>, "project");
	}

	function searchAddressInGeoShape(){
		if($('#postalCode').val() != "" && $('#postalCode').val() != null){
			findGeoposByInsee($('#city').val(), callbackFindByInseeSuccessAdd);
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
				Sig.showCityOnMap(obj, <?php echo isset($_GET["isNotSV"]) ? "true":"false" ; ?>, "project");
			}
		}
		else {
			console.log("Erreur getlatlngbyinsee vide");
		}
	}

	
</script>
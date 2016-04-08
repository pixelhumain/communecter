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
	'/plugins/bootstrap-select/bootstrap-select.min.css',
	'/plugins/bootstrap-select/bootstrap-select.min.js'
);

HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");
?>

<style>

#orgaDrop a, #orgaDrop ul{
	width: 100%;
}

#newEvent{
	display: block;
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

.no-padding-left {
	padding-left: 0;
}

.no-padding-right {
	padding-right: 0;
}
.dropOrgaEvent{
	padding-left: inherit;	
}
.dropOrgaEvent li{
	list-style: none;
	margin-left: 15px;
}
.categoryTitle{
    border-bottom: 1px solid #8b91a0;
    font-variant: small-caps;
    font-style: italic;
    font-size: 17px;
}
.scrollable-menu {
    height: auto;
    max-height: 250px;
    overflow-x: hidden;
}
#newEvent input, #newEvent button.dropdown-toogle, #newEvent textarea{
	border: 1px solid #CCC !important;
}
#newEvent .bootstrap-switch{
	width: 100%;
}

#newEvent h3{
	font-weight: 300;
}
#iconeChargement{
	display: none;
	float: right;
	margin-top: -35px;
	margin-right: 10px;
	position: relative;
}



/* design alpha tango*/
.main-col-search{
	background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/tango-circle-bg-orange.png");
	background-size:100%;
	background-repeat: no-repeat;
	background-color: #ffc694 !important;
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
</style>

<!-- *** NEW EVENT *** -->
<?php 
	if(@$project)
		Menu::project($project);			
	else if (@$organization){
		Menu::organization($organization);	
	}else {
		//Menu::person($person);		
	}
	$this->renderPartial('../default/panels/toolbar'); 
?>


<div id="newEvent">
	
	<div class="noteWrap col-md-12 form-add-data">
		
		<div class="row">
		<div class="col-md-12">
			<form class="form-event">
			<?php $myOrganizationAdmin = Authorisation::listUserOrganizationAdmin(Yii::app() ->session["userId"]);
				$myProjectAdmin = Authorisation::listProjectsIamAdminOf(Yii::app() ->session["userId"]);
				function mySort($a, $b){
			  		if(isset($a['name']) && isset($b['name'])){
				    	return ( strtolower($b['name']) < strtolower($a['name']) );
					}else{
						return false;
					}
				}
				usort($myOrganizationAdmin,"mySort");
				usort($myProjectAdmin,"mySort");
				?>
			<div class="col-md-6">
				<div class="selectpicker">
					<div class="form-group" id="orgaDrop" name="orgaDrop">
						<h3 class="text-dark"><i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Organisateur") ?></h3>
                        <a class="form-control dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
                          	<span id="labelOrga"><?php echo Yii::t("event","Choose an organizer",null,Yii::app()->controller->module->id); ?></span><span class="caret"></span>
                        </a>
                        <!--<div class="panel-scroll height-230 ps-container">-->
                        <ul role="menu" class="dropdown-menu scrollable-menu">
	                        <li class="categoryOrgaEvent col-md-12">
		                        <ul class="dropOrgaEvent" id="citoyen">	                    
			                        <li class="categoryTitle" style="margin-left:inherit;"><i class='fa fa-user'></i> <?php echo Yii::t("common","Person") ?></li>
			                        <li><a href="javascript:;" class="btn-drop dropOrg" id="<?php echo Yii::app() -> session["userId"]?>" data-id="<?php echo Yii::app() -> session["userId"]?>" data-name="Moi"><?php echo Yii::t("common","Me") ?></a></li>
		                        </ul>
	                        </li>
	                        <?php if(!empty($myOrganizationAdmin)) { ?>
	                        <li class="categoryOrgaEvent col-md-12">
		                        <ul class="dropOrgaEvent" id="organization">
			                        <li class="categoryTitle" style="margin-left:inherit;"><i class='fa fa-group'></i> <?php echo Yii::t("common","Organizations") ?></li>
		                        	<?php foreach ($myOrganizationAdmin as $e) { ?>
			                        	<li><a href="javascript:;" class="btn-drop dropOrg" id="<?php echo $e['_id']?>" data-id="<?php echo $e['_id']?>" data-name="<?php echo $e['name']?>"><?php echo $e['name']?></a></li>
			                       	<?php } ?>
		                        </ul>
	                        </li>
	                        <?php } ?>
	                        <?php	if(!empty($myProjectAdmin)) { ?>
	                        <li class="categoryOrgaEvent col-md-12">
		                         <ul class="dropOrgaEvent" id="project">
			                        <li class="categoryTitle" style="margin-left:inherit;"><i class='fa fa-lightbulb-o'></i> <?php echo Yii::t("common","Projects") ?></li>
			                        <?php foreach ($myProjectAdmin as $p) { ?>
			                        	<li><a href="javascript:;" class="btn-drop dropOrg" id="<?php echo $p['_id']?>" data-id="<?php echo $p['_id']?>" data-name="<?php echo $p['name']?>"><?php echo $p['name']?></a></li>
			                       	<?php } ?>

		                        </ul>
	                        </li>
	                        <?php } ?>

                        </ul>
                       <!-- </div>-->
                    </div>
                    
                    <input type="hidden" id="newEventOrgaId" name="newEventOrgaId" value="<?php if (@$_GET["contextId"]) echo  $_GET["contextId"] ?>">
                    <input type="hidden" id="newEventOrgaType" name="newEventOrgaType" value="<?php if (@$_GET["contextType"]) echo $_GET["contextType"]."s"; ?>">

				</div>
				
				<h3 class="text-dark"><i class="fa fa-angle-down"></i> <?php echo Yii::t("event","Event Name",null,Yii::app()->controller->module->id) ?></h3>                       
				<div class="form-group">
					<input class="event-id hide" type="text" id="newEventId" name="newEventId">
					<input class="event-name form-control" name="eventName" type="text" placeholder="<?php echo Yii::t("event","Event Name",null,Yii::app()->controller->module->id); ?>...">
				</div>

				<h3 class="text-dark"><i class="fa fa-angle-down"></i> <?php echo Yii::t("event", "Event Categories") ?></h3>
                <div class="form-group">
					<select class="form-control selectpicker event-categories">
						<?php if(isset($lists) && isset($lists["eventTypes"])) {
							foreach ($lists["eventTypes"] as $key => $value) { ?>
								<option data-content="<span class='event-category event-home'><?php echo $value ?></span>" value="<?php echo $key; ?>"><?php echo $value ?></option>
						<?php }
							}
						?>
					</select>
				</div>

				<h3 class="text-dark"><i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Duration") ?> ?</h3>
                <div class="form-group">
					<input type="checkbox" class="all-day" data-label-text="<?php echo Yii::t("common","All-Day")?>" data-on-text="<?php echo Yii::t("common","True") ?>" data-off-text="<?php echo Yii::t("common","False")?>">				
				</div>
				<div class="form-group">
					<div class="no-all-day-range">
							<span class="input-icon">
								<input type="text" class="event-range-date form-control" name="eventRangeDate" placeholder="Range date"/>
								<i class="fa fa-clock-o"></i> 
							</span>
						
					</div>
					<div class="all-day-range">
							<span class="input-icon">
								<input type="text" class="event-range-date form-control" name="ad_eventRangeDate" placeholder="Range date"/>
								<i class="fa fa-calendar"></i> 
							</span>
						
					</div>
					<div class="hide">
						<input type="text" class="event-start-date" name="eventStartDate"/>
						<input type="text" class="event-end-date" name="eventEndDate"/>
					</div>
				</div>
					
			</div>

			<div class="col-md-6">
					<div class="form-group">
						<h3 class="text-dark">
							<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Country") ?> <span class="symbol required"></span>
						</h3>
						<input type="hidden" name="eventCountry" id="eventCountry" style="width: 100%; height:35px;">								
					</div>

					<h3 class="text-dark"><i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Address") ?> ?</h3>
                        
					<div class="form-group">
						<span class="input-icon">
							<input type="text" class="form-control" name="streetAddress" id="fullStreet"  placeholder="<?php echo Yii::t("common","Adresse") ?>" >
							<i class="fa fa-road"></i>
						</span>
					</div>
					
					<div class="form-group col-md-6 no-padding">
						<span class="input-icon">
							<input type="text" class="form-control" id="postalCode" name="postalCode" autocomplete="off" placeholder="<?php echo Yii::t("common","Postal Code") ?>">
							<i class="fa fa-home"></i>
							<i class="fa fa-spin fa-refresh" id="iconeChargement"></i>
						</span>
					</div>
				
					
					<div class="col-md-6">
						<div class="form-group" id="cityDiv" style="display: none;">
							<span class="input-icon">
								<select class="selectpicker form-control" id="city" name="city" title='<?php echo Yii::t("common","Select your City") ?>...'>
								</select>
							</span>		
						</div>
						<input type="hidden" name="cityName" id="cityName" value=""/>

					</div>
					<div class="col-md-12">
						<div class="alert alert-success inline-block hidden" id="alert-city-found" style="font-family:inherit;">
							<span class="pull-left" style="padding:6px;">Position géographique trouvée <i class="fa fa-smile-o"></i></span>
							<div class="btn btn-success pull-right" id="btn-show-city"><i class="fa fa-map-marker"></i> Personnaliser</div>
						</div>
					</div>

					<input type="hidden" name="geoPosLatitude" id="geoPosLatitude">
					<input type="hidden" name="geoPosLongitude" id="geoPosLongitude">
						
			<!-- </div>
			
			<div class="col-md-6 row pull-left">			 -->
				
				<!-- </div> -->
			</div>
			

			<div class="col-md-12">
				
				<h3 class="text-dark"><i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Description") ?></h3>
                        
					<div class="form-group">
						<textarea name="eventDetail" id="eventDetail" class="eventDetail height-250" style="width: 100%;"  placeholder="<?php echo Yii::t("common","Write note here") ?>..."></textarea>
					</div>
				
					<?php if( Yii::app()->session['userId'] ){ ?>
					<div class= "row  col-xs-12">
						<button class="pull-right btn bg-orange" onclick=""><i class="fa fa-save"></i> Enregistrer</button>
					</div>
					<?php } else {  ?>
						<div class= "row  col-xs-12">
							<button class="pull-right btn btn-primary" onclick="showPanel('box-login')">Please Login First</button>
						</div>
					<?php } ?>
			</div>
		</form>
	</div>
	</div>
	</div>
</div>


<script type="text/javascript">

	var organizationId = "<?php if(isset($organizationId)) echo $organizationId ?>";
	var listOrgaAdmin = <?php echo json_encode($myOrganizationAdmin); ?>;
	console.log(listOrgaAdmin);
	var listProjectAdmin = <?php echo json_encode($myProjectAdmin); ?>;
	var countries = getCountries("select2");
	var parentOrga = [];
	var defaultHours;
	var citiesByPostalCode;
	var organizerParentType = "<?php if (@$_GET["contextType"]) echo $_GET["contextType"]; ?>";
	var organizerParentId = "<?php if (@$_GET["contextId"]) echo $_GET["contextId"]; ?>";
	//var organizerParentName = "<?php if (@$_GET["organizerParentName"]) echo $_GET["organizerParentName"]; ?>"; 
	if("undefined" != typeof organizationId && organizationId != ""){
		parentOrga = organizationId;
	}

	$(".daterangepicker").on("hide.daterangepicker", function(){
	 	console.log("ok");
	})

	$(".daterangepicker").on("apply.daterangepicker", function(ev, picker){
 		console.log("ok");
 	})

	jQuery(document).ready(function() {
	 	bindEventSubViewEvents();
	 	bindPostalCodeAction();
	 	editEvent();
		initMyOrganization();
	 	runEventFormValidation();
	 	$(".moduleLabel").html("<i class='fa fa-plus'></i> <i class='fa fa-calendar'></i> Créer un événement");
	});

	function runShowCity(searchValue) {
		citiesByPostalCode = getCitiesByPostalCode(searchValue);
		
		var oneValue = "";
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
		$('.form-event #postalCode').on("keyup blur", function(e){
			if($('#postalCode').val() != "" && $('#postalCode').val() != null){
				clearTimeout(timeoutGeopos);
				timeoutGeopos = setTimeout(function() {
					searchCity();
				}, 1500);
			}
		});
		$('.form-event #city').change(function(e){ //toastr.info("city change");
			clearTimeout(timeoutGeopos);
			timeoutGeopos = setTimeout(function() {
				$("#cityName").val($('#city option:selected').text());
				searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
			}, 1500);
		});
		$('.form-event #eventCountry').change(function(e){ 
			if($('#postalCode').val() != "" && $('#postalCode').val() != null){
				searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);	
			}
		});
		
		$('.form-event #fullStreet').keyup(function(e){ //toastr.info("city change");
			if($('#postalCode').val() != "" && $('#postalCode').val() != null){
				clearTimeout(timeoutGeopos);
				timeoutGeopos = setTimeout(function() {
					searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
				}, 1500);
			}
		});

	}

	function searchCity() {
		$("#alert-city-found").addClass("hidden");
		
		$("#btn-show-city").click(function(){
			showMap(true);
			Sig.hideTools();
		});
			
		var searchValue = $('.form-event #postalCode').val();
		if(searchValue.length == 5) {
			$("#city").empty();
			setTimeout(function(){
				$("#iconeChargement").css("display", "inline-block");
	   			runShowCity(searchValue);
	   		}, 100);
		} else {
			$("#cityDiv").slideUp("medium");
			$("#city").val("");
			$("#city").empty();
			$("#iconeChargement").hide();
		}
	}

	function bindEventSubViewEvents() {
			
		$(".close-subview-button").off().on("click", function(e) {
			$(".close-subviews").trigger("click");
			e.preventDefault();
		});

		$('#eventCountry').select2({
			data : countries,
		});
	};

	//validate new event form
	function runEventFormValidation(el) {
		console.log("runEventFormValidation");
		var formEvent = $('.form-event');
		var errorHandler2 = $('.errorHandler', formEvent);
		var successHandler2 = $('.successHandler', formEvent);

		formEvent.validate({
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
				eventCountry : {
					required : true
				},
				eventName : {
					minlength : 2,
					required : true
				},
				postalCode : {
					rangelength : [5, 5],
					required : true
				},
				city : {
					required : true
				},
				eventStartDate : {
					required : true
				},
				eventEndDate : {
					required : true
				},
			},
			messages : {
				eventName : "* Please specify the name of the event",
				postalCode : "* Please specify the postal code",
				city : "* Please specify the city",
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
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
				console.log("success");
				label.addClass('help-block valid');
				// mark the current input as valid and display OK icon
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
			},
			submitHandler : function(form) {
				console.log("submitHandler");
				successHandler2.show();
				errorHandler2.hide();

				var startDateSubmit = moment($(".form-event .event-start-date").val()).format('YYYY/MM/DD HH:mm');
				var endDateSubmit = moment($(".form-event .event-end-date").val()).format('YYYY/MM/DD HH:mm');

				newEvent = new Object;
				newEvent.allDay = $(".form-event .all-day").bootstrapSwitch('state');
				newEvent.name = $(".form-event .event-name ").val();
				newEvent.type = $(".form-event .event-categories option:checked").val();
				newEvent.startDate = startDateSubmit; 
				newEvent.endDate = endDateSubmit;
				newEvent.description = $(".form-event .eventDetail ").val();
				//newEvent.userId = "<?php echo Yii::app() ->session['userId'] ?>";
				newEvent.postalCode = $(".form-event #postalCode ").val();
				newEvent.streetAddress = $(".form-event #fullStreet ").val();
				newEvent.city = $(".form-event #city ").val();
				newEvent.cityName = $(".form-event #cityName").val();
				newEvent.country = $(".form-event #eventCountry ").val();
				newEvent.organizerId = $(".form-event #newEventOrgaId").val();
				newEvent.organizerType = $(".form-event #newEventOrgaType").val();				
				newEvent.geoPosLatitude = $(".form-event #geoPosLatitude").val();				
				newEvent.geoPosLongitude = $(".form-event #geoPosLongitude").val();	
				console.log("newEvent");		
				console.dir(newEvent);			
					$.blockUI({
					message : '<span class="homestead"><i class="fa fa-spinner fa-circle-o-noch"></i> Enregistrement en cours ...</span>'
				});

				if($(".form-event #newEventOrga").val() !==""){

				}
				
				$.ajax({
				        type: "POST",
				        url: baseUrl+"/"+moduleId+'/event/save',
				        dataType : "json",
				        data:newEvent,
						type:"POST",
				    })
				    .done(function (data) 
				    {
				    	$.unblockUI();
				        if (data &&  data.result) {
				        	toastr.success('<?php echo Yii::t("common","Event Created success") ?>');
				        	$("#newEventId").val(data.id["$id"]);
				        	//$.hideSubview();
				        	console.log(data);
				        		addFloopEntity(data.id["$id"], "events", data.event);
				        		loadByHash("#event.detail.id."+data.id["$id"]);
								
						} else {
				           toastr.error(data.msg);
				        }
				    });
			}
		});
	};

	// on hide event's form destroy summernote and bootstrapSwitch plugins
	function hideEditEvent() {
		//$.hideSubview();
		$(".form-event .all-day").bootstrapSwitch('destroy');
	};

	// enables the edit form 
	function editEvent() {
		console.log("editEvent");
		$(".close-new-event").off().on("click", function() {
			$(".back-subviews").trigger("click");
		});
		$(".form-event .help-block").remove();
		$(".form-event .form-group").removeClass("has-error").removeClass("has-success");
		$eventDetail = $('.form-event .eventDetail');
		
		$(".form-event .event-id").val("");
		$(".form-event .eventDetail").val("");
		$(".form-event .event-name").val("");
		$(".form-event .all-day").bootstrapSwitch('state', false);
		$('.form-event .all-day-range').hide();
		$(".form-event .event-start-date").val(roundMoment());
		$(".form-event .event-end-date").val(roundMoment().add('days', 1));

		defaultHours = new Date(roundMoment()).getHours()+ ":" +new Date(roundMoment()).getMinutes();
		
		$('.form-event .no-all-day-range .event-range-date').val(roundMoment().format('DD/MM/YYYY HH:mm') + ' - ' + roundMoment().add('days', 1).format('DD/MM/YYYY HH:mm'))
			.daterangepicker({  
				startDate: roundMoment(),
				endDate: roundMoment().add('days', 1),
				timePicker: true, 
				timePickerIncrement: 30,
				timePicker12Hour:false,
				todayHighlight: true,
				format: 'DD/MM/YYYY HH:mm'
			},
			function(start, end, label) {
    			$(".form-event .event-start-date").val(start);
				$(".form-event .event-end-date").val(end);
			}
		);
		
		$('.form-event .all-day-range .event-range-date').val(roundMoment().format('DD/MM/YYYY') + ' - ' + roundMoment().add('days', 1).format('DD/MM/YYYY'))
			.daterangepicker({  
				startDate: roundMoment(),
				endDate: roundMoment().add('days', 1),
				format: 'DD/MM/YYYY'
			},
			function(start, end, label) {
    			$(".form-event .event-start-date").val(start);
				$(".form-event .event-end-date").val(end);
			}
		);
		
		$('.form-event .event-categories option').filter(function() {
			return ($(this).text() == "Generic");
		}).prop('selected', true);
		

		$('.form-event .event-categories').selectpicker('render');

		$('.form-event .all-day').bootstrapSwitch();


		$('.form-event .all-day').on('switchChange.bootstrapSwitch', function(event, state) {
			$(".daterangepicker").hide();
			var startDate = moment($("#newEvent").find(".event-start-date").val());
			var endDate = moment($("#newEvent").find(".event-end-date").val());
			console.log(startDate, endDate);
			if (state) {
				$("#newEvent").find(".no-all-day-range").hide();
				$("#newEvent").find(".all-day-range").show();
				$("#newEvent").find('.all-day-range .event-range-date').val(startDate.format('DD/MM/YYYY') + ' - ' + endDate.format('DD/MM/YYYY'));
				$("#newEvent").find('.all-day-range .event-range-date').data('daterangepicker').setStartDate(startDate);
				$("#newEvent").find('.all-day-range .event-range-date').data('daterangepicker').setEndDate(endDate);
			} else {
				$("#newEvent").find(".no-all-day-range").show();
				$("#newEvent").find(".all-day-range").hide();
				$("#newEvent").find('.no-all-day-range .event-range-date').val(startDate.format('DD/MM/YYYY HH:mm') + ' - ' + endDate.format('DD/MM/YYYY HH:mm'));
				$("#newEvent").find('.no-all-day-range .event-range-date').data('daterangepicker').setStartDate(startDate);			
				$("#newEvent").find('.no-all-day-range .event-range-date').data('daterangepicker').setEndDate(endDate);	
			}

		});
	};


	//----------------------------Function for event SV--------------------

	function initMyOrganization(){

		$("#eventCountry").select2('val', "");

		if (listOrgaAdmin.length != 0 && listProjectAdmin.length != 0){
			//$(".selectpicker").addClass("col-md-12");
			//$(".categoryOrgaEvent").addClass("col-md-4");
		}
		else if (listOrgaAdmin.length != 0 || listProjectAdmin.length != 0){
			//$(".selectpicker").addClass("col-md-6");
			//$(".categoryOrgaEvent").addClass("col-md-6");
		}
		else {
			//$(".selectpicker").addClass("col-md-6");
			//$(".categoryOrgaEvent").addClass("col-md-12");
		}
		if(organizerParentType.length > 0){
			if (organizerParentType=="organization"){
				titleName="<?php echo Yii::t("common","Organization") ?>";
				console.log(listOrgaAdmin);
				contextName="<?php if (@$organization) echo addslashes($organization["name"]) ?>";//listOrgaAdmin[organizerParentId]["name"];
			}	
			else{
				titleName="<?php echo Yii::t("common","Project") ?>";
				contextName="<?php if (@$project) echo addslashes($project["name"]) ?>";//listProjectAdmin[organizerParentId]["name"];
			}
			$("#labelOrga").text(titleName+" : "+contextName);
		}
		$(".dropOrg").click(function() {
			console.log(this);
			if ($(this).parents().eq(1).attr("id")=="organization"){
				$("#labelOrga").text("<?php echo Yii::t("common","Organization") ?> : "+$(this).data("name"));
				$("#newEventOrgaId").val($(this).data("id"));
				$("#newEventOrgaType").val("organizations");
			}
			else if ($(this).parents().eq(1).attr("id")=="project"){
				$("#labelOrga").text("<?php echo Yii::t("common","Project"); ?> : "+$(this).data("name"));
				$("#newEventOrgaId").val($(this).data("id"));
				$("#newEventOrgaType").val("projects");
			}
			else {
				$("#labelOrga").text("<?php echo Yii::t("common","Person"); ?> : "+$(this).data("name"));
				$("#newEventOrgaId").val($(this).data("id"));
				$("#newEventOrgaType").val("citoyens");
			}


		})

		if("undefined" != typeof(parentOrga)){
			$("#"+parentOrga).trigger("click");
		}
	}

	

	function roundMoment(){
		var roundMoment = moment();
		var min = moment().minutes();
		if(min<30)
			roundMoment.minutes(30);
		else if(min>30){
			roundMoment.add(1, "hours")
			roundMoment.minutes(0);
		}
		return roundMoment;
	}


	var currentCityByInsee = null;
	function callBackFullSearch(resultNominatim){
		console.log("callback ok");
		var show = Sig.showCityOnMap(resultNominatim, true, "event");
		if(!show && currentCityByInsee != null) {
			Sig.showCityOnMap(currentCityByInsee, true, "event");
		}
	}

	function searchAddressInGeoShape(){
		if($('#postalCode').val() != "" && $('#postalCode').val() != null){
			$("#iconeChargement").css("display", "inline-block");
			insee=$('#city').val();
			postalCode=$('#postalCode').val();
			streetAddress=$('#fullStreet').val();
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
							if(typeof result.geoShape != "undefined"){
								 console.log(result.geoShape);
								 Sig.showPolygon(result.geoShape);
								}
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
				Sig.showCityOnMap(obj, true, "event");
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

</script>
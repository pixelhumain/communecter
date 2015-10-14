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
</style>

<!-- *** NEW EVENT *** -->
<?php /*if( @$isNotSV ){ ?>
<a class="text-red pull-right" href="#" onclick="showPanel('box-login')"><i class="fa fa-times"></i></a>
<?php }*/ 

if( !isset($_GET["isNotSV"])) 
	$this->renderPartial('../default/mapFormSV'); 

?>


<div id="newEvent">
	<?php if( @$isNotSV ){ ?>
	<h2 class='radius-10 padding-10 partition-blue text-bold'> Add an Event</h2>
	<?php } ?>
	<?php 
	$size = ( !@$isNotSV ) ? "col-md-8 col-md-offset-2" : "col-md-12"
	?>
	<div class="noteWrap <?php echo $size ?> form-add-data">
		<?php if( !@$isNotSV ){ ?>
			<h1><?php echo Yii::t("event","Add new event",null,Yii::app()->controller->module->id); ?></h1>
		<?php } ?>
		<div class="row">
		<div class="col-md-11">
			<form class="form-event">
			<?php $myOrganizationAdmin = Authorisation::listUserOrganizationAdmin(Yii::app() ->session["userId"]);
				$myProjectAdmin = Authorisation::listProjectsIamAdminOf(Yii::app() ->session["userId"]);
				?>
			<div class="col-md-6">
				<div class="selectpicker">
					<div class="form-group" id="orgaDrop" name="orgaDrop">
						
                        <a class="form-control dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
                          	<span id="labelOrga"><?php echo Yii::t("event","Choose an organizer",null,Yii::app()->controller->module->id); ?></span><span class="caret"></span>
                        </a>
                        <!--<div class="panel-scroll height-230 ps-container">-->
                        <ul role="menu" class="dropdown-menu scrollable-menu">
	                        <li class="categoryOrgaEvent col-md-12">
		                        <ul class="dropOrgaEvent" id="citoyen">	                    
			                        <li class="categoryTitle" style="margin-left:inherit;"><i class='fa fa-user'></i> <?php echo Yii::t("common","Person") ?></li>
			                        <li><a href="#" class="btn-drop dropOrg" id="<?php echo Yii::app() -> session["userId"]?>" data-id="<?php echo Yii::app() -> session["userId"]?>" data-name="Moi"><?php echo Yii::t("common","Me") ?></a></li>
		                        </ul>
	                        </li>
	                        <?php if(!empty($myOrganizationAdmin)) { ?>
	                        <li class="categoryOrgaEvent col-md-12">
		                        <ul class="dropOrgaEvent" id="organization">
			                        <li class="categoryTitle" style="margin-left:inherit;"><i class='fa fa-group'></i> <?php echo Yii::t("common","Organizations") ?></li>
		                        	<?php foreach ($myOrganizationAdmin as $e) { ?>
			                        	<li><a href="#" class="btn-drop dropOrg" id="<?php echo $e['_id']?>" data-id="<?php echo $e['_id']?>" data-name="<?php echo $e['name']?>"><?php echo $e['name']?></a></li>
			                       	<?php } ?>
		                        </ul>
	                        </li>
	                        <?php } ?>
	                        <?php	if(!empty($myProjectAdmin)) { ?>
	                        <li class="categoryOrgaEvent col-md-12">
		                         <ul class="dropOrgaEvent" id="project">
			                        <li class="categoryTitle" style="margin-left:inherit;"><i class='fa fa-lightbulb-o'></i> <?php echo Yii::t("common","Projects") ?></li>
			                        <?php foreach ($myProjectAdmin as $p) { ?>
			                        	<li><a href="#" class="btn-drop dropOrg" id="<?php echo $p['_id']?>" data-id="<?php echo $p['_id']?>" data-name="<?php echo $p['name']?>"><?php echo $p['name']?></a></li>
			                       	<?php } ?>

		                        </ul>
	                        </li>
	                        <?php } ?>

                        </ul>
                       <!-- </div>-->
                    </div>
                    
                    <input class="hide" type="text" id="newEventOrgaId" name="newEventOrgaId">
                    <input class="hide" type="text" id="newEventOrgaType" name="newEventOrgaType">

				</div>
				<div class="form-group">
					<input class="event-id hide" type="text" id="newEventId" name="newEventId">
					<input class="event-name form-control" name="eventName" type="text" placeholder="<?php echo Yii::t("event","Event Name",null,Yii::app()->controller->module->id); ?>...">
				</div>
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
			</div>

			<div class="col-md-6">
					
					<div class="col-md-12">
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="streetAddress" id="fullStreet"  placeholder="<?php echo Yii::t("common","Adresse") ?>" >
								<i class="fa fa-road"></i>
							</span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" id="postalCode" name="postalCode" autocomplete="off" placeholder="<?php echo Yii::t("common","Postal Code") ?>">
								<i class="fa fa-home"></i>
							</span>
						</div>
					</div>

					
					<div class="col-md-6">
						<div class="form-group" id="cityDiv" style="display: none;">
							<span class="input-icon">
								<select class="selectpicker form-control" id="city" name="city" title='<?php echo Yii::t("common","Select your City") ?>...'>
								</select>
							</span>		
						</div>
					</div>

					<div class="alert alert-success pull-left col-md-12 hidden" id="alert-city-found" style="font-family:inherit;">
						<span class="pull-left" style="padding:6px;">Position géographique trouvée <i class="fa fa-smile-o"></i></span>
						<div class="btn btn-success pull-right" id="btn-show-city"><i class="fa fa-map-marker"></i> Personnaliser</div>
					</div>

					<input type="hidden" name="geoPosLatitude" id="geoPosLatitude">
					<input type="hidden" name="geoPosLongitude" id="geoPosLongitude">
						
			</div>
			
			<div class="col-md-12">				
				<div class="col-sm-3">
					<div class="form-group">
						<input type="checkbox" class="all-day" data-label-text="<?php echo Yii::t("common","All-Day")?>" data-on-text="<?php echo Yii::t("common","True") ?>" data-off-text="<?php echo Yii::t("common","False")?>">
					</div>
				</div>
				<div class="no-all-day-range">
					<div class="col-sm-9">
						<div class="form-group">
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="event-range-date form-control" name="eventRangeDate" placeholder="Range date"/>
									<i class="fa fa-clock-o"></i> </span>
							</div>
						</div>
					</div>
				</div>
				<div class="all-day-range ">
					<div class="col-md-9">
						<div class="form-group">
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="event-range-date form-control" name="ad_eventRangeDate" placeholder="Range date"/>
									<i class="fa fa-calendar"></i> </span>
							</div>
						</div>
					</div>
				</div>
				<div class="hide">
					<input type="text" class="event-start-date" name="eventStartDate"/>
					<input type="text" class="event-end-date" name="eventEndDate"/>
				</div>
			</div>
			

			<div class="row col-md-12">
				
				<div class="col-md-12">
					
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<textarea name="eventDetail" id="eventDetail" class="eventDetail height-250" style="width: 100%;"  placeholder="<?php echo Yii::t("common","Write note here") ?>..."></textarea>
					</div>
				</div>
				<?php if( @$isNotSV ){ ?>
					<?php if( Yii::app()->session['userId'] ){ ?>
					<div class= "row  col-xs-12">
						<button class="pull-right btn btn-primary" onclick="$('.form-event').submit();">Enregistrer</button>
					</div>
					<?php } else {  ?>
						<div class= "row  col-xs-12">
							<button class="pull-right btn btn-primary" onclick="showPanel('box-login')">Please Login First</button>
						</div>
					<?php } ?>
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
	var listProjectAdmin = <?php echo json_encode($myProjectAdmin); ?>;
	var parentOrga = [];
	var defaultHours;
	var citiesByPostalCode;

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

	});

	function runShowCity(searchValue) {
		citiesByPostalCode = getCitiesByPostalCode(searchValue);
		Sig.execFullSearchNominatim(0);

		var oneValue = "";
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

	    
	}

	function bindPostalCodeAction() {
		$('.form-event #postalCode').change(function(e){
			searchCity();
		});
		$('.form-event #postalCode').keyup(function(e){
			searchCity();
		});
	}

	function searchCity() {
		var searchValue = $('.form-event #postalCode').val();
		if(searchValue.length == 5) {
			$("#city").empty();
			setTimeout(function(){
	   			$("#iconeChargement").css("visibility", "visible");
	   			runShowCity(searchValue);
	   		}, 100);
		} else {
			$("#cityDiv").slideUp("medium");
			$("#city").val("");
			$("#city").empty();
		}
	}

	function bindEventSubViewEvents() {
			
		$(".close-subview-button").off().on("click", function(e) {
			$(".close-subviews").trigger("click");
			e.preventDefault();
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
				eventName : {
					minlength : 2,
					required : true
				},
				postalCode : {
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
				newEvent.userId = "<?php echo Yii::app() ->session['userId'] ?>";
				newEvent.postalCode = $(".form-event #postalCode ").val();
				newEvent.city = $(".form-event #city ").val();
				newEvent.organizerId = $(".form-event #newEventOrgaId").val();
				newEvent.organizerType = $(".form-event #newEventOrgaType").val();				
				newEvent.geoPosLatitude = $(".form-event #geoPosLatitude").val();				
				newEvent.geoPosLongitude = $(".form-event #geoPosLongitude").val();	
				console.log(newEvent)			
				$.blockUI({
					message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
		            '<blockquote>'+
		              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
		              '<cite title="Hegel">Hegel</cite>'+
		            '</blockquote> '
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
				        	toastr.success('Event Created success');
				        	$("#newEventId").val(data.id["$id"]);
				        	//$.hideSubview();
				        	if( isNotSV )	
				        		showAjaxPanel( '/person/directory?isNotSV=1&tpl=directory2&type=<?php echo Event::COLLECTION ?>', 'MY EVENTS','calendar' );
				        	else 
				        		document.location.href=baseUrl+"/"+moduleId+"/event/dashboard/id/"+data.id["$id"];
				        } else {
				           toastr.error(data.msg);
				        }
				    });
			}
		});
	};

	// on hide event's form destroy summernote and bootstrapSwitch plugins
	function hideEditEvent() {
		$.hideSubview();
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

		$(".dropOrg").click(function() {
			console.log(this);
			if ($(this).parents().eq(1).attr("id")=="organization"){
				$("#labelOrga").text("Organisation : "+$(this).data("name"));
				$("#newEventOrgaId").val($(this).data("id"));
				$("#newEventOrgaType").val("organizations");
			}
			else if ($(this).parents().eq(1).attr("id")=="project"){
				$("#labelOrga").text("Project : "+$(this).data("name"));
				$("#newEventOrgaId").val($(this).data("id"));
				$("#newEventOrgaType").val("projects");
			}
			else {
				$("#labelOrga").text("Person : "+$(this).data("name"));
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


	function callBackFullSearch(resultNominatim){
		//console.log("callback ok");
		Sig.showCityOnMap(resultNominatim, <?php echo isset($_GET["isNotSV"]) ? "true":"false" ; ?>, "event");
	}

</script>
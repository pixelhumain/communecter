<?php
	$cssAnsScriptFilesModule = array(
		//Data helper
		'/js/dataHelpers.js'
		);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
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

</style>

<!-- *** NEW EVENT *** -->
<div id="newEvent">
	<div class="noteWrap col-md-10 col-md-offset-2">
		<h3>Add new event</h3>
		<div class="row">
		<div class="col-md-11">
			<form class="form-event">
			<?php $myOrganizationAdmin = Authorisation::listUserOrganizationAdmin(Yii::app() ->session["userId"]);
					if(!empty($myOrganizationAdmin)) {
				?>
			<div class="row">
				<div class="col-md-6 selectpicker">
					<div class="form-group" id="orgaDrop" name="orgaDrop">
						
                        <a class="form-control dropdown-toggle " data-toggle="dropdown" href="#" aria-expanded="true">
                          	<span id="labelOrga">Organisation</span><span class="caret"></span>
                        </a>
                        <ul role="menu" class="dropdown-menu" id="dropOrgaEvent">
                        	<?php foreach ($myOrganizationAdmin as $e) { ?>
	                        	<li><a href="#" class="btn-drop dropOrg" id="<?php echo $e['_id']?>" data-id="<?php echo $e['_id']?>" data-name="<?php echo $e['name']?>"><?php echo $e['name']?></a></li>
	                       	<?php } ?>
                        </ul>
                    </div>
                    
                    <input class="hide" type="text" id="newEventOrga" name="newEventOrga">

				</div>
				<div class="col-md-6">
					<div class="col-md-6 no-padding-left">
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" id="postalCode" name="postalCode" autocomplete="off" placeholder="Postal Code">
								<i class="fa fa-home"></i></span>
						</div>
					</div>
					<div class="col-md-6 no-padding-right">
						<div class="form-group" id="cityDiv" style="display: none;">
							<span class="input-icon">
								<select class="selectpicker form-control" id="city" name="city" title='Select your City...'>
								</select>
							</span>		
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input class="event-id hide" type="text" id="newEventId" name="newEventId">
						<input class="event-name form-control" name="eventName" type="text" placeholder="Event Name...">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<select class="form-control selectpicker event-categories">
							<option data-content="<span class='event-category event-home'>Discussion</span>" value="discussion">Discussion</option>
							<option data-content="<span class='event-category event-overtime'>Meeting</span>" value="meeting">Meeting</option>
							<option data-content="<span class='event-category event-generic'>Event</span>" value="event" selected="selected">Event</option>
							<option data-content="<span class='event-category event-job'>Cultural</span>" value="cultural">Cultural</option>
						</select>
					</div>
				</div>
			</div>
		
			<div class= "row">
				<div class="col-md-3">
					<div class="form-group">
						<input type="checkbox" class="all-day" data-label-text="All-Day" data-on-text="True" data-off-text="False">
					</div>
				</div>
				<div class="no-all-day-range">
					<div class="col-md-9">
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
				<div class="col-md-12">
					
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<textarea name="eventDetail" id="eventDetail" class="eventDetail height-250" style="width: 100%;"  placeholder="Write note here..."></textarea>
					</div>
				</div>
			</div>
		</form>
	</div>
	</div>
	</div>
</div>


<script type="text/javascript">

	var organizationId = "<?php if(isset($organizationId)) echo $organizationId ?>";
	var listOrgaAdmin = <?php echo json_encode(Authorisation::listUserOrganizationAdmin(Yii::app() ->session["userId"])); ?>;
	var parentOrga = [];
	var defaultHours;


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
		var citiesByPostalCode = getCitiesByPostalCode(searchValue);
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
	   		
			/*clearTimeout(timeout);
			timeout = setTimeout($("#iconeChargement").css("visibility", "visible"), 100);
			clearTimeout(timeout);
			timeout = setTimeout('runShowCity("'+searchValue+'")', 100); */
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

				var startDateSubmit = new Date($(".form-event .event-start-date").val()).toLocaleFormat('%Y/%m/%d %H:%M');
				var endDateSubmit = new Date($(".form-event .event-end-date").val()).toLocaleFormat('%Y/%m/%d %H:%M');

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
				
				$.blockUI({
					message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
		            '<blockquote>'+
		              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
		              '<cite title="Hegel">Hegel</cite>'+
		            '</blockquote> '
				});

				if($(".form-event #newEventOrga").val() !==""){
					newEvent.organization = $(".form-event #newEventOrga").val();
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
    			alert("A new date range was chosen: " + start.toString() + ' to ' + end.toString());
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
    			alert("A new date range was chosen: " + start.toString() + ' to ' + end.toString());
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
			var startDate = new Date($("#newEvent").find(".event-start-date").val());
			var endDate = new Date($("#newEvent").find(".event-end-date").val());
			console.log(startDate, endDate);
			if (state) {
				console.log("ici");
				$("#newEvent").find(".no-all-day-range").hide();
				$("#newEvent").find(".all-day-range").show();
				$("#newEvent").find('.all-day-range .event-range-date').val(startDate.toLocaleFormat('%d/%m/%Y') + ' - ' + endDate.toLocaleFormat('%d/%m/%Y'));
				$("#newEvent").find('.all-day-range .event-range-date').data('daterangepicker').setStartDate(startDate);
				$("#newEvent").find('.all-day-range .event-range-date').data('daterangepicker').setEndDate(endDate);
			} else {
				console.log("la");
				$("#newEvent").find(".no-all-day-range").show();
				$("#newEvent").find(".all-day-range").hide();
				$("#newEvent").find('.no-all-day-range .event-range-date').val(startDate.toLocaleFormat('%d/%m/%Y %H:%M') + ' - ' + endDate.toLocaleFormat('%d/%m/%Y %H:%M'));
				$("#newEvent").find('.no-all-day-range .event-range-date').data('daterangepicker').setStartDate(startDate);			
				$("#newEvent").find('.no-all-day-range .event-range-date').data('daterangepicker').setEndDate(endDate);	
			}

		});
	};


	//----------------------------Function for event SV--------------------

	function initMyOrganization(){
		

		$(".dropOrg").click(function() {
			console.log(this);
			$("#labelOrga").text("Organisation : "+$(this).data("name"));
			$("#newEventOrga").val($(this).data("id"));
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

</script>
<style>

#calendar{
	width:60%;
	margin-left: 20%;
}
#lastEvent{
	width:100%;
}
.lastEventPadding{
	float: left;
	margin-left: 10px;
	margin-right: 10px;
	width: 30%;
}
.imgEvent img{
	width: 100%;
	height: 200px;
}
#dropBtn{
	display: none;
}

</style>


<!-- *** SHOW CALENDAR *** -->


<div id="showCalendar" class="col-md-10 col-md-offset-1">
	<div class="barTopSubview">
		<a href="#newEvent" class="new-task new-event button-sv" ><i class="fa fa-plus"></i> Add new Event</a>
	</div>
	<div class="row">
    	<div class="panel panel-white">
      		<div class="panel-heading border-light">
      			<h4>PROCHAINS EVENEMENTS</h4>
      		</div>
			<div class='panel-body panel-transparent boder-light' id="lastEvent"></div>
		</div>
	</div>
	<div class="row">
    	<div class="panel panel-white">
      		<div class="panel-heading border-light">
        		<h4 class="panel-title">TOUS LES EVENEMENTS</h4>
        	</div>
        	<div class="panel-body boder-light">
        		<div id="calendar"></div>
        	</div>
        </div>
    </div>	
</div>

<!-- *** NEW EVENT *** -->
<div id="newEvent">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h3>Add new event</h3>
		<div class="row">
		<div class="col-md-10">
			<form class="form-event">
			<?php $myOrganizationAdmin = Authorisation::listUserOrganizationAdmin(Yii::app() ->session["userId"]);
					if(!empty($myOrganizationAdmin)) {
				?>
			<div class="row">
				
				<div class="col-md-5">
					
					<div class="btn-group">
                        <a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
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
				<?php if(!isset(Yii::app()->session["userEmail"])){?>
				<div class="col-md-12">
					<div class="form-group">
						<input class="event-name form-control" name="eventName" type="text" placeholder="Event Name...">
					</div>
				</div>
				<?php } ?>
				<div class="col-md-4">
					<div class="form-group">
						<input type="checkbox" class="all-day" data-label-text="All-Day" data-on-text="True" data-off-text="False">
					</div>
				</div>
				<div class="no-all-day-range">
					<div class="col-md-8">
						<div class="form-group">
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="event-range-date form-control" name="eventRangeDate" placeholder="Range date"/>
									<i class="fa fa-clock-o"></i> </span>
							</div>
						</div>
					</div>
				</div>
				<div class="all-day-range">
					<div class="col-md-8">
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
<!-- *** READ EVENT *** -->
<div id="readEvent">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<div class="row">
			<div class="col-md-12">
				<h2 class="event-title">Event Title</h2>
				<div class="btn-group options-toggle pull-right">
					<button class="btn dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
						<i class="fa fa-cog"></i>
						<span class="caret"></span>
					</button>
					<ul role="menu" class="dropdown-menu dropdown-light pull-right">
						<li>
							<a href="#newEvent" class="edit-event">
								<i class="fa fa-pencil"></i> Edit
							</a>
						</li>
						<li>
							<a href="#" class="delete-event">
								<i class="fa fa-times"></i> Delete
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<span class="event-category event-cancelled">Cancelled</span>
				<span class="event-allday"><i class='fa fa-check'></i> All-Day</span>
			</div>
			<div class="col-md-12">
				<div class="event-start">
					<div class="event-day"></div>
					<div class="event-date"></div>
					<div class="event-time"></div>
				</div>
				<div class="event-end"></div>
			</div>
			<div class="col-md-12">
				<div class="event-content"></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var DEFAULT_IMAGE_EVENT = "http://placehold.it/350x180";

var listOrgaAdmin = <?php echo json_encode(Authorisation::listUserOrganizationAdmin(Yii::app() ->session["userId"])); ?>;
var parentOrga = [];
var newEventData;
if("undefined" != typeof organization){
	parentOrga = organization;
}

$(".daterangepicker").on("hide.daterangepicker", function(){
 		console.log("ok");
 	})
jQuery(document).ready(function() {
 	bindEventSubViewEvents();
 	runEventFormValidation();
 	if("undefined" != typeof contextMap )
 		initLastsEvents();

 	
});
function initAddEventBtn () { 
	$(".new-event").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		$.subview({
			content : subViewContent,
			onShow : function() {
				editEvent();
				initMyOrganization();
			},
			onHide : function() {
				hideEditEvent();
			},
			onSave: function() {
				$('.form-event').submit();
			}
		});
	});
 }
function bindEventSubViewEvents() {
		
	initAddEventBtn ();
	
	$(".show-calendar").off().on("click", function() {
		$.subview({
			content : "#showCalendar",
			startFrom : "right",
			onShow : function() {
				showCalendar();
			},
			onHide : function() {
				destroyCalendar();
			}
		});
	});

	$(".close-subview-button").off().on("click", function(e) {
		$(".close-subviews").trigger("click");
		e.preventDefault();
	});

	$(".show-calendar").on("blur", function(e) {
		e.preventDefault();
		$(".applyBtn ").trigger("click");
	})
};

var dateToShow, calendar, $eventDetail, eventClass, eventCategory;
var widgetNotes = $('#notes .e-slider'), sliderNotes = $('#readNote .e-slider'), $note;
var oTable, contributors;
var subViewElement, subViewContent, subViewIndex;

// creates an array of events to display in the calendar
var setCalendarEvents = function() {
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	calendar = [
    {
			title : 'Networking',
			start : new Date(y, m, d, 20, 0),
			end : new Date(y, m, d, 21, 0),
			className: 'event-job',
            category: 'Job',
			allDay : false,
			content : 'Out to design conference'
		}, 
    {
        title: 'Bootstrap Seminar',
        start: new Date(y, m, d - 5),
        end: new Date(y, m, d - 2),
        className: 'event-offsite',
        category: 'Off-site work',
        allDay: true
    }, 
    {
        title: 'Lunch with Nicole',
        start: new Date(y, m, d - 3, 12, 0),
        end: new Date(y, m, d - 3, 12, 30),
        className: 'event-generic',
        category: 'Generic',
        allDay: false
    }, 
    {
        title: 'Corporate Website Redesign',
        start: new Date(y, m, d + 5),
        end: new Date(y, m, d + 10),
        className: 'event-todo',
        category: 'To Do',
        allDay: true
    }];

};
//creates fullCalendar
function buildCalObj(eventObj)
{
	//console.log("addTasks2CAlendar","task",taskId,eventObj);
	//entries for the calendar
	var taskCal = null;
	var prioClass = 'event-job';
	switch( eventObj.priority ){
		case "urgent" : prioClass = 'event-todo'; break;
		case "high" : prioClass = 'event-offsite'; break;
		case "normal" : prioClass = ''; break;
		case "low" : prioClass = 'event-generic'; break;
		default : prioClass = 'event-job'; 
	}
	if(eventObj.startDate && eventObj.startDate != "")
	{
		//console.log("eventObj", eventObj, eventObj.startDate);
		var sd = eventObj.startDate.split(" ")[0];
		var sh = eventObj.startDate.split(" ")[1];
		var sdv = sd.split("/");
		var shv = sh.split(":");
	 	var startDate = new Date(sdv[2],parseInt(sdv[1])-1,sdv[0], shv[0], shv[1]);
	 	var endDate = null;
	 	if(eventObj.endDate && eventObj.endDate != "" )
	 	{
		 	var ed = eventObj.endDate.split(" ")[0];
		 	var eh = eventObj.endDate.split(" ")[1];
		 	var edv = ed.split("/");
		 	var ehv = eh.split(":");
		 	endDate = new Date(edv[2],parseInt(edv[1])-1,edv[0], ehv[0], ehv[1]);
		 }
		 //console.log("taskCalObj",eventObj['_id']['$id']);
		taskCal = {
			"title" : eventObj.name,
			"id" : eventObj['_id']['$id'],
			"content" : (eventObj.description && eventObj.description != "" ) ? new Date(eventObj.description) : "",
				"start" : startDate,
				"end" : ( endDate ) ? endDate : startDate,
				"startDate" : eventObj.startDate,
				"endDate" : eventObj.endDate,
				"className": prioClass,
	        "category": eventObj.type,
				"allDay" : false,
		}
		//console.log(taskCal);
	}
	return taskCal;
}

function showCalendar() {

	console.info("addTasks2Calendar",contextMap.events);//,taskCalendar);
	
	calendar = [];
	if(contextMap.events){
		$.each(contextMap.events,function(eventId,eventObj)
		{
			eventCal = buildCalObj(eventObj);
			if(eventCal)
				calendar.push( eventCal );
		});
	}
	if(contextMap.projects){
		$.each(contextMap.projects, function(taskId, taskObj){
			taskCal = buildCalObj(taskObj);
			if(taskCal)
				calendar.push( taskCal );
		})
	}
	

	dateToShow = new Date();
	$('#calendar').fullCalendar({
		header : {
			left : 'prev,next today',
			center : 'title',
			right : 'month,agendaWeek,agendaDay'
		},
		year : dateToShow.getFullYear(),
		month : dateToShow.getMonth(),
		date : dateToShow.getDate(),
		editable : true,
		events : calendar,

		eventClick : function(calEvent, jsEvent, view) {
			//show event in subview
			dateToShow = calEvent.start;
			$.subview({
				content : "#readEvent",
				startFrom : "right",
				onShow : function() {
					readEvent(calEvent._id);
				}
			});
		}
	});
	dateToShow = new Date();
};
//destroy fullCalendar
function destroyCalendar() {
	$('#calendar').fullCalendar('destroy');
};
//validate new event form
function runEventFormValidation(el) {
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
		eventStartDate : {
			required : true,
			date : true
		},
		eventEndDate : {
			required : true,
			date : true
		},
	},
	messages : {
		eventName : "* Please specify your first name"

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
		label.addClass('help-block valid');
		// mark the current input as valid and display OK icon
		$(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
	},
	submitHandler : function(form) {
		successHandler2.show();
		errorHandler2.hide();
		var startDateSubmit = convertDate($('.form-event .event-range-date').val(), 0);
		var endDateSubmit = convertDate($('.form-event .event-range-date').val(), 1);
		newEvent = new Object;
		newEvent.userId = "<?php echo Yii::app() ->session['userId'] ?>",
		newEvent.title = $(".form-event .event-name ").val(), 
		newEvent.start = startDateSubmit, 
		newEvent.end = endDateSubmit,
		newEvent.allDay = $(".form-event .all-day").bootstrapSwitch('state'), 
		newEvent.type = $(".form-event .event-categories option:checked").val(), 
		newEvent.category = $(".form-event .event-categories option:checked").text(), 
		newEvent.content = $(".form-event .eventDetail ").val();
		
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
		if ($(".form-event .event-id").val() !== "") {
			el = $(".form-event .event-id").val();

			for ( var i = 0; i < calendar.length; i++) {

				if (calendar[i]._id == el) {
					newEvent._id = el;
					var eventIndex = i;
				}

			}
			//mockjax simulates an ajax call
			$.mockjax({
			url : '/event/edit/webservice',
			dataType : 'json',
			responseTime : 1000,
			responseText : {
				say : 'ok'
			}
		});

		$.ajax({
			url : '/event/edit/webservice',
			dataType : 'json',
			success : function(json) {
				$.unblockUI();
				if (json.say == "ok") {
					calendar[eventIndex] = newEvent;
					$.hideSubview();
					toastr.success('The event has been successfully modified!');
				}
			}
		});

		} else {

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
		        	newEventData = data.event;
		        	updateAll(newEventData);
		        	$.hideSubview();
		        } else {
		           toastr.error('Something Went Wrong');
		        }
		    });

		}
	}
});
};

// on hide event's form destroy summernote and bootstrapSwitch plugins
function hideEditEvent() {
	$.hideSubview();
	//$('.form-event .summernote').destroy();
	$(".form-event .all-day").bootstrapSwitch('destroy');
};
// enables the edit form 
function editEvent(el) {
	$(".close-new-event").off().on("click", function() {
		$(".back-subviews").trigger("click");
	});
	$(".form-event .help-block").remove();
	$(".form-event .form-group").removeClass("has-error").removeClass("has-success");
	$eventDetail = $('.form-event .eventDetail');
	
	if ( typeof el == "undefined") {
		//clearEventForm fields 
		$(".form-event .event-id").val("");
		$(".form-event .eventDetail").val("");
		$(".form-event .event-name").val("");
		$(".form-event .all-day").bootstrapSwitch('state', false);
		$('.form-event .all-day-range').hide();
		$(".form-event .event-start-date").val(moment());
		$(".form-event .event-end-date").val(moment().add('days', 1));
		
		$('.form-event .no-all-day-range .event-range-date').val(moment().format('DD/MM/YYYY h:mm A') + ' - ' + moment().add('days', 1).format('DD/MM/YYYY h:mm A'))
		.daterangepicker({  
			startDate: moment(),
			endDate: moment().add('days', 1),
			timePicker: true, 
			timePickerIncrement: 30, 
			format: 'DD/MM/YYYY h:mm A' 
		});
		
		$('.form-event .all-day-range .event-range-date').val(moment().format('DD/MM/YYYY  h:mm A') + ' - ' + moment().add('days', 1).format('DD/MM/YYYY  h:mm A'))
		.daterangepicker({  
			startDate: moment(),
			endDate: moment().add('days', 1)
		});
		
		$('.form-event .event-categories option').filter(function() {
			return ($(this).text() == "Generic");
		}).prop('selected', true);
		$('.form-event .event-categories').selectpicker('render');

	} else {
		
		$(".form-event .event-id").val(el);

		for ( var i = 0; i < calendar.length; i++) {

			if (calendar[i]._id == el) {
				$(".form-event .event-name").val(calendar[i].title);
				$(".form-event .all-day").bootstrapSwitch('state', calendar[i].allDay);
				$(".form-event .event-start-date").val(moment(calendar[i].start));
				$(".form-event .event-end-date").val(moment(calendar[i].end));
						if("undefined" == typeof $('.form-event .no-all-day-range .event-range-date').data('daterangepicker')){
			$('.form-event .no-all-day-range .event-range-date').val(moment(calendar[i].start).format('DD/MM/YYYY h:mm A') + ' - ' + moment(calendar[i].end).format('DD/MM/YYYY h:mm A'))
				.daterangepicker({  
					startDate:moment(moment(calendar[i].start)),
					endDate: moment(moment(calendar[i].end)),
					timePicker: true, 
					timePickerIncrement: 10, 
					format: 'DD/MM/YYYY h:mm A' 
				});			
				
				$('.form-event .all-day-range .event-range-date').val(moment(calendar[i].start).format('DD/MM/YYYY') + ' - ' + moment(calendar[i].end).format('DD/MM/YYYY'))
				.daterangepicker({  
					startDate:moment(calendar[i].start),
					endDate: moment(calendar[i].end)
				});
		} else {
			$('.form-event .no-all-day-range .event-range-date').val(moment(calendar[i].start).format('DD/MM/YYYY h:mm A') + ' - ' + moment(calendar[i].end).format('DD/MM/YYYY h:mm A'))
			.data('daterangepicker').setStartDate(moment(moment(calendar[i].start)));
			$('.form-event .no-all-day-range .event-range-date').data('daterangepicker').setEndDate(moment(moment(calendar[i].end)));
			$('.form-event .all-day-range .event-range-date').val(moment(calendar[i].start).format('DD/MM/YYYY') + ' - ' + moment(calendar[i].end).format('DD/MM/YYYY'))
			.data('daterangepicker').setStartDate(calendar[i].start);
			$('.form-event .all-day-range .event-range-date').data('daterangepicker').setEndDate(calendar[i].end);
		}
				
				if ("undefined" == typeof calendar[i].category || calendar[i].category == "") {
					eventCategory = "Generic";
				} else {
					eventCategory = calendar[i].category;
				}
				$('.form-event .event-categories option').filter(function() {
					return ($(this).text() == eventCategory);
				}).prop('selected', true);
				$('.form-event .event-categories').selectpicker('render');
				if ("undefined" !== typeof calendar[i].content && calendar[i].content !== "") {
					$(".form-event .eventDetail ").val(calendar[i].content);
				} else {
					$(".form-event .eventDetail ").val( $eventDetail.attr("placeholder") );
				}
			}

		}
	}
	$('.form-event .all-day').bootstrapSwitch();

	$('.form-event .all-day').on('switchChange.bootstrapSwitch', function(event, state) {
		$(".daterangepicker").hide();
		var startDate = moment($("#newEvent").find(".event-start-date").val());
		var endDate = moment($("#newEvent").find(".event-end-date").val());
		if (state) {
			$("#newEvent").find(".no-all-day-range").hide();
			$("#newEvent").find(".all-day-range").show();
			$("#newEvent").find('.all-day-range .event-range-date').val(startDate.format('DD/MM/YYYY') + ' - ' + endDate.format('DD/MM/YYYY')).data('daterangepicker').setStartDate(startDate);
			$("#newEvent").find('.all-day-range .event-range-date').data('daterangepicker').setEndDate(endDate);
		} else {
			$("#newEvent").find(".no-all-day-range").show();
			$("#newEvent").find(".all-day-range").hide();
			$("#newEvent").find('.no-all-day-range .event-range-date').val(startDate.format('DD/MM/YYYY h:mm A') + ' - ' + endDate.format('DD/MM/YYYY h:mm A')).data('daterangepicker').setStartDate(startDate);
			$("#newEvent").find('.no-all-day-range .event-range-date').data('daterangepicker').setEndDate(endDate);			
		}

	});
	$('.form-event .event-range-date').on('apply.daterangepicker', function(ev, picker) {
		$(".form-event .event-start-date").val(picker.startDate);
		$(".form-event .event-end-date").val(picker.endDate);
	});
};

// read Event
function readEvent(el) 
{
	$(".edit-event").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		$.subview({
			content : subViewContent,
			onShow : function() {
				editEvent(el);
			},
			onHide : function() {
				hideEditEvent();
			}
		});
	});

	$(".delete-event").data("event-id", el);

	$("#readEvent").find(".delete-event").off().on("click", function() {
		el = $(this).data("event-id");
		bootbox.confirm("Are you sure to cancel?", function(result) {
			if (result) {
				for ( i = 0; i < calendar.length; i++) {
					if (calendar[i]._id == el) {
						calendar.splice(i, 1);
					}
				}
				$(".back-subviews").trigger("click");
			}
		});
	});
	for ( var i = 0; i < calendar.length; i++) {

		if (calendar[i]._id == el) {

			$("#readEvent .event-allday").hide();
			$("#readEvent .event-end").empty().hide();

			$("#readEvent .event-title").empty().text(calendar[i].title);
			if ("undefined" == typeof calendar[i].className || calendar[i].className == ""  ) {
				eventClass = "event";
			} else {
				eventClass = calendar[i].className;
			}
			if ("undefined" == typeof calendar[i].category || calendar[i].category == "") {
				eventCategory = "Event";
			} else {
				eventCategory = calendar[i].category;
			}

			$("#readEvent .event-category")
			.empty()
			.removeAttr("class")
			.addClass("event-category " + eventClass)
			.text(eventCategory);
			if (calendar[i].allDay) {
				$("#readEvent .event-allday").show();
				$("#readEvent .event-start").empty().html("<p>Start:</p> <div class='event-day'><h2>" + moment(calendar[i].start).format('DD') + "</h2></div><div class='event-date'><h3>" + moment(calendar[i].start).format('dddd') + "</h3><h4>" + moment(calendar[i].start).format('MMMM YYYY') + "</h4></div>");
				if (calendar[i].end !== null) {
					if (moment(calendar[i].end).isValid()) {
						$("#readEvent .event-end").show().html("<p>End:</p> <div class='event-day'><h2>" + moment(calendar[i].end).format('DD') + "</h2></div><div class='event-date'><h3>" + moment(calendar[i].end).format('dddd') + "</h3><h4>" + moment(calendar[i].end).format('MMMM YYYY') + " </h4></div>");
					}
				}
			} else {

				$("#readEvent .event-start").empty().html("<p>Start:</p> <div class='event-day'><h2>" + moment(calendar[i].start).format('DD') + "</h2></div><div class='event-date'><h3>" + moment(calendar[i].start).format('dddd') + "</h3><h4>" + moment(calendar[i].start).format('MMMM YYYY') + "</h4></div> <div class='event-time'><h3><i class='fa fa-clock-o'></i> " + moment(calendar[i].start).format('h:mm A') + "</h3></div>");
				if (calendar[i].end !== null) {
					if (moment(calendar[i].end).isValid()) {
						$("#readEvent .event-end").show().html("<p>End:</p> <div class='event-day'><h2>" + moment(calendar[i].end).format('DD') + "</h2></div><div class='event-date'><h3>" + moment(calendar[i].end).format('dddd') + "</h3><h4>" + moment(calendar[i].end).format('MMMM YYYY') + "</h4></div> <div class='event-time'><h3><i class='fa fa-clock-o'></i> " + moment(calendar[i].end).format('h:mm A') + "</h3></div>");
					}
				}
			}

			$("#readEvent .event-content").empty().html(calendar[i].content);

			break;
		}

	}

};
	
	
	function convertDate(date, num){
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

	function getLastsEvent(events){
		var today = new Date();
		var eventsSelected = [];
		$.each(events, function(k,v){
			console.log("eventsSelected", eventsSelected, "v", v);
			
			var date = null;
			if("undefined" != typeof v.endDate && v.endDate.split("/")[2]){
				var endSplit = v.endDate.split("/");
				date = new Date( endSplit[2].split(" ")[0], parseInt(endSplit[1])-1, endSplit[0]);
			}
			if(today<=date)
			{
				var startSplit = v.startDate.split("/");
				var date = new Date(startSplit[2].split(" ")[0], parseInt(startSplit[1])-1, startSplit[0]);
				if(eventsSelected.length>=3){
					for(var i = 0; i<eventsSelected.length;i++){
						console.log("for", eventsSelected);
						var date2 = new Date(eventsSelected[i].startDate.split("/")[2].split(" ")[0], parseInt(eventsSelected[i].startDate.split("/")[1])-1, eventsSelected[i].startDate.split("/")[0]);
						//console.log(date, date2);
						if(date2>=date){
							eventsSelected.splice(i, 0, v);
							eventsSelected.pop();
							i=eventsSelected.length;
						}
					}
				}else if(eventsSelected.length<1){
					eventsSelected.push(v);
				}else if(eventsSelected.length==1){
					var date2 = new Date(eventsSelected[0].startDate.split("/")[2].split(" ")[0], parseInt(eventsSelected[0].startDate.split("/")[1])-1, eventsSelected[0].startDate.split("/")[0]);
					if(date2>date){
						eventsSelected.splice(0,0, v);
					}else{
						eventsSelected.push(v);
					}
				}else if(eventsSelected.length==2){
					
					var date2 = new Date(eventsSelected[0].startDate.split("/")[2].split(" ")[0], parseInt(eventsSelected[0].startDate.split("/")[1])-1, eventsSelected[0].startDate.split("/")[0]);
					var date3 = new Date(eventsSelected[1].startDate.split("/")[2].split(" ")[0], parseInt(eventsSelected[1].startDate.split("/")[1])-1, eventsSelected[1].startDate.split("/")[0]);
					if(date2>date){
						eventsSelected.splice(0,0, v);
					}else if(date3>date){
						eventsSelected.splice(1,0,v);
					}else{
						eventsSelected.push(v);
					}
				}
			}
		})
		return eventsSelected;
	}

	function initLastsEvents(){
		if("undefined" != typeof contextMap.events ){
			console.log("OK initLastsEvents");
			var tabEvents = getLastsEvent(contextMap.events);
			var htmlRes = "";

			for(var i=0; i<tabEvents.length; i++ ){
				var currentEvent = tabEvents[i];
				var imagePath = "";
				var period = getStringPeriodValue(currentEvent.startDate, currentEvent.endDate);
				if ("undefined" == typeof currentEvent.imagePath) {
					imagePath = DEFAULT_IMAGE_EVENT;
				} else {
					imagePath = baseUrl+currentEvent.imagePath;
				}
				htmlRes +='<div class="panel panel-white lastEventPadding">'+
	       						'<div class="panel-body no-padding center">'+
	       							'<div class="imgEvent"><img src="'+imagePath+'"></img></div>'+
									'<div class="nextEventInfo"><h1>'+period+'</h1><br>'+currentEvent.name+'</div>'+
								'</div>'+
								'<div class="panel-footer">'+
									'<div><p>En savoir + ></p></div>'+
								'</div>'+
							'</div>';

			}
		}else{
			htlmRes = "<h1>Aucun evenement à venir</h1>";
		}
		$("#lastEvent").html(htmlRes);
	}
	

	function getStringPeriodValue(d, f){
		var mapMonth = {"01":"JANV.", "02": "FEVR.", "03":"MARS", "04":"AVRIL", "05":"MARS", "06":"JUIN", "07":"JUIL.", "08":"AOUT", "09":"SEPT.", "10":"OCTO.", "11":"NOVE.", "12":"DECE."};
		var strPeriod = "";
		var dTab = [];
		var fTab = [];
		var dHour = d.split(" ")[1];
		var dDay = d.split(" ")[0].split("/");
		
		for(var i=0; i<dDay.length; i++){
			dTab.push(dDay[i]);
		}

		var fHour = f.split(" ")[1];
		var fDay = f.split(" ")[0].split("/");
		for(var i=0; i<fDay.length; i++){
			fTab.push(fDay[i]);
		}
		
		if(dTab[2] == fTab[2]){
			if(dTab[1] == fTab[1]){
				if(dTab[0]== fTab[0]){
					strPeriod += parseInt(fTab[0])+" "+mapMonth[fTab[1]]+" "+fTab[2]+" de "+dHour+" à "+fHour;
				}else{
					strPeriod += parseInt(dTab[0])+" au "+ parseInt(fTab[0])+" "+mapMonth[fTab[1]]+" "+fTab[2];
				}
			}else{
				strPeriod += parseInt(dTab[0])+" "+mapMonth[dTab[1]]+" au "+ parseInt(fTab[0])+" "+mapMonth[fTab[1]]+" "+fTab[2];
			}
		}else{
			strPeriod += parseInt(dTab[0])+" "+mapMonth[dTab[1]]+" "+dTab[2]+" au "+ parseInt(fTab[0])+" "+mapMonth[fTab[1]]+" "+fTab[2];
		}
		return strPeriod;
	}

	function initMyOrganization(){
		

		$(".dropOrg").click(function() {
			console.log(this);
			$("#labelOrga").text($(this).data("name"));
			$("#newEventOrga").val($(this).data("id"));
		})

		if("undefined" != typeof(parentOrga["_id"])){
			$("#"+parentOrga["_id"]["$id"]).trigger("click");
		}
	}

	function updateAll(data){
		if("undefined" != typeof updateSliderAgenda  && typeof updateSliderAgenda == "function")
    			updateSliderAgenda( data); 
    	if("undefined" != typeof updateMyEvents && typeof updateMyEvents == "function")
    			updateMyEvents( data); 
	}
</script>
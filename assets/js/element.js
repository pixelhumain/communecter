/* *********************************
			EVENTS
********************************** */
function runEventFormValidation(el) {
	mylog.log("runEventFormValidation");
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
			}
		},
		messages : {
			eventName : "* Please specify the name of the event",
			postalCode : "* Please specify the postal code",
			eventCountry : "* Please specify the country",
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
			mylog.log("success");
			label.addClass('help-block valid');
			// mark the current input as valid and display OK icon
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
		},
		submitHandler : function(form) {
			mylog.log("submitHandler");
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
			newEvent.tags = $(".form-event #tagsEvent").val();
			if( $("#newEventParentId").val() )
				newEvent.parentId = $("#newEventParentId").val();
			
			mylog.log("newEvent");
			mylog.dir(newEvent);
			$.blockUI( { message : '<span class="homestead"><i class="fa fa-spinner fa-circle-o-noch"></i> Save Processing ...</span>' });
			
			$.ajax(
			{
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
		        	toastr.success("Event Created success");
		        	$("#newEventId").val(data.id["$id"]);
		        	mylog.log(data);
	        		addFloopEntity(data.id["$id"], "events", data.event);
	        		loadByHash("#event.detail.id."+data.id["$id"]);
						
				} else {
		           toastr.error(data.msg);
		        }
		    });
		}
	});
};

/* *********************************
			PROJECTS
********************************** */

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
			projectName : "Please specify the name"

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
			newProject.description=$(".form-project .project-description").val(),
			newProject.geoPosLatitude = $(".form-project #geoPosLatitude").val(),			
			newProject.geoPosLongitude = $(".form-project #geoPosLongitude").val(),				
			newProject.tags = $(".form-project #tagsProject").val();
			mylog.log(newProject);
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
		        	toastr.success("Project created successfully");
		        	$.unblockUI();
		        	//mylog.dir(data);
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

Element 
	type : poi
	$res = Element::insert($_POST, $id,$type);
Projects
	$res = Project::insert($_POST, $id,$type);
		self::getAndCheckProject($params, Yii::app() -> session["userId"]);
		PHDB::insert(self::COLLECTION,$newProject);
Orga 
	//POST to element
	$newOrganization = Organization::newOrganizationFromPost($_POST);
	Rest::json(Organization::insert($newOrganization, Yii::app()->session["userId"]));
		$newOrganization = Organization::getAndCheckOrganization($organization);
Event
	$res = Event::saveEvent($_POST);
	$newEvent = self::getAndCheckEvent($params);
Person 

<?php 
	//valeur correspondant 

//$cs = Yii::app()->getClientScript();
//$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.css');
//$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/slider/css/slider.css');
//$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/jQRangeSlider/css/classic-min.css');

	$cssAnsScriptFilesTheme = array(
	//Select2
//	'/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js',
//	'/assets/plugins/jQRangeSlider/jQAllRangeSliders-min.js',
//	'/assets/plugins/modernizr/modernizr.js',
//	'/assets/plugins/slider/js/bootstrap-slider.js',
	//autosize
	//Select2
	'/assets/plugins/select2/select2.css',
	'/assets/plugins/select2/select2.min.js',
	//autosize
	'/assets/plugins/autosize/jquery.autosize.min.js',

	'/assets/plugins/jQuery-Knob/js/jquery.knob.js',
	//'/assets/js/ui-sliders.js',
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);

$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js'
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>
<style>

#newProject{
	display: none;
}

</style>


<!-- *** NEW EVENT *** -->
<div id="newProject">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h3>Add new project</h3>
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
						<!--<input class="project-name form-control" name="projectName" type="text" placeholder="Project Name...">
						<input class="project-creator form-control" name="projectCreator" type="text" placeholder="Project creator...">
						<input class="project-url form-control" name="projectUrl" type="text" placeholder="Project url...">
						<input class="project-licence form-control" name="projectLicence" type="text" placeholder="Project licence...">
						-->
				

						<div class="col-md-6 col-sd-6" >
							<input class="project-id hide" type="text">
							<div class="form-group">
								<label class="control-label">
									Nom <span class="symbol required"></span>
								</label>
								<input class="project-name form-control" name="projectName" value=""/>
							</div>
							<div class="form-group">
								<label class="control-label">
									Url <span class="symbol required"></span>
								</label>
								<input class="project-url form-control" name="projectUrl" value=""/>
							</div>
							<div class="form-group">
								<label class="control-label">
									Licence <span class="symbol required"></span>
								</label>
								<input class="project-licence form-control" name="projectLicence" value=""/>
							</div>
						</div>
						<div class="col-md-6 col-sd-6 ">
							<div class="form-group">
								<label class="control-label">
									Pays <span class="symbol required"></span>
								</label>
								<input type="hidden" name="projectCountry" id="projectCountry" style="width: 100%; height:35px;"/>								
							</div>
							<div class="row">
								<div class="col-md-4 form-group">
									<label for="postalCode">
										Code postal <span class="symbol required"></span>
									</label>
									<input type="text" class="form-control" placeholder="974xx" name="postalCode" id="postalCode" value="" >	
								</div>
								<div class="col-md-8 form-group" id="cityDiv" style="display:none;">
									<label for="city">
										Ville
									</label>
									<select class="selectpicker2 form-control" id="city" name="city" title='Select your City...'>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-4 text-center">
									<label for="postalCode">
										Durée du projet</span>
									</label>
									<div class="form-group">
										<input type="checkbox" class="all-day" data-label-text="All-Day" data-on-text="True" data-off-text="False">
									</div>
								</div>
								<div class="no-all-day-range">
									<div class="col-md-8">
										<div class="form-group">
											<div class="form-group">
												<span class="input-icon">
													<input type="text" class="project-range-date form-control" name="projectRangeDate" placeholder="Range date"/>
													<i class="fa fa-clock-o"></i> 
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="all-day-range">
									<div class="col-md-8">
										<div class="form-group">
											<div class="form-group">
												<span class="input-icon">
													<input type="text" class="project-range-date form-control" name="ad_projectRangeDate" placeholder="Range date"/>
													<i class="fa fa-calendar"></i> </span>
											</div>
										</div>
									</div>
								</div>
								<div class="hide">
									<input type="text" class="project-start-date" value="" name="projectStartDate"/>
									<input type="text" class="project-end-date" value="" name="projectEndDate"/>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div>
									<label for="form-field-24" class="control-label"> Description <span class="symbol required"></span> </label>
									<textarea  class="project-description form-control" name="description" id="description" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 60px;"></textarea>
								</div>
							</div>
						</div>		
						<div class="col-md-12">
							<label for="properties">
								Degré d'ouverture du projet (0% = très fermé, 100% = très ouvert)			
							</label>
							<div class="col-md-12">
								<div class="col-md-4">
										<h4 style="text-align:center;width:200px;">Gouvernance</h4>
										<input class="knob project-gouvernance" name="gouvernancePropertiesProject" value="35" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
								</div>
								<div class="col-md-4">
									<h4 style="text-align:center;width:200px;">Partage</h4>
									<input class="knob project-partage" value="35" name="partagePropertiesProject" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
								</div>
								<div class="col-md-4">
									<h4 style="text-align:center;width:200px;">Solidaire</h4>
									<input class="knob project-solidaire" value="35" name="solidairePropertiesProject" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
								</div>
								<div class="col-md-4">
									<h4 style="text-align:center;width:200px;">Local</h4>
									<input class="knob project-local" value="35" name="localPropertiesProject" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
								</div>
								<div class="col-md-4">
									<h4 style="text-align:center;width:200px;">Avancement</h4>
									<input class="knob project-avancement" value="35" name="avancementPropertiesProject" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
								</div>
								<div class="col-md-4">
									<h4 style="text-align:center;width:200px;">Partenaire</h4>
									<input class="knob project-partenaire" value="35" name="partenairePropertiesProject" data-fgcolor="#66EE66" data-anglearc="250" data-angleoffset="-125" style="height: 66px; position: absolute; vertical-align: middle; margin-top: 66px; margin-left: -152px; border: 0px none; background: transparent none repeat scroll 0% 0%; font: bold 40px Arial; text-align: center; color: rgb(102, 238, 102); padding: 0px;">			
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<label for="properties">
								Briques du projet			
							</label>
							<div class="col-md-12">
								<textarea class="project-modules form-control" name="modules[]"></textarea>
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
				<div class="pull-right">
					<div class="btn-group">
						<a href="#" class="btn btn-info close-subview-button">
							Close
						</a>
					</div>
					<div class="btn-group">
						<button class="btn btn-info save-new-project" type="submit">
							Save
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	bindProjectSubViewProjects();
 	bindPostalCodeAction();
 	runProjectFormValidationTest();
	var timeout;
	var countries = getCountries("select2");
	$('#projectCountry').select2({
		data : countries
	});
	$("textarea.autosize").autosize();
 	 	//initialisation des sliders 
 	$(".knob").knob({
            draw: function () {
                // "tron" case
                if (this.$.data('skin') == 'tron') {
                    var a = this.angle(this.cv) // Angle
                        ,
                        sa = this.startAngle // Previous start angle
                        ,
                        sat = this.startAngle // Start angle
                        ,
                        ea // Previous end angle
                        , eat = sat + a // End angle
                        ,
                        r = true;
                    this.g.lineWidth = this.lineWidth;
                    this.o.cursor && (sat = eat - 0.3) && (eat = eat + 0.3);
                    if (this.o.displayPrevious) {
                        ea = this.startAngle + this.angle(this.value);
                        this.o.cursor && (sa = ea - 0.3) && (ea = ea + 0.3);
                        this.g.beginPath();
                        this.g.strokeStyle = this.previousColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                        this.g.stroke();
                    }
                    this.g.beginPath();
                    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                    this.g.stroke();
                    this.g.lineWidth = 2;
                    this.g.beginPath();
                    this.g.strokeStyle = this.o.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                    this.g.stroke();
                    return false;
                }
            }
     });
     $(".daterangepicker").on("hide.daterangepicker", function(){
 		console.log("ok");
 	});
});
function initAddProjectBtn(){
	$(".new-project").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		$.subview({
			content : subViewContent,
			onShow : function() {
				editProjectForm();
			},
			onHide : function() {
				//alert();
				hideEditProject();
			},
			onSave: function() {
				hideEditProject();
			}
		});
	});
}
function bindProjectSubViewProjects() {
	
	initAddProjectBtn ();
	
	/*$(".show-calendar").off().on("click", function() {
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
	});*/
	$(".close-subview-button").off().on("click", function(e) {
		$(".close-subviews").trigger("click");
		e.prprojectDefault();
	});
	/*$(".show-calendar").on("blur", function(e) {
		e.preventDefault();
		$(".applyBtn ").trigger("click");
	})*/
};


var subViewElement, subViewContent, subViewIndex;
//var dateToShow, calendar;
// creates an array of projects to display in the calendar

//creates fullCalendar
/*function buildCalObj(eventObj)
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
}*/

/*function showCalendar() {

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
};*/
//validate new project form
function runProjectFormValidationTest(el) {
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
		}
	},
	messages : {
		projectName : "* Please specify your first name"

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
		startDateSubmitProj = convertDate2($('.form-project .project-range-date').val(), 0);
		endDateSubmitProj = convertDate2($('.form-project .project-range-date').val(), 1);
		//alert(startDateSubmitProj);
		newProject = new Object;
		newProject.title = $(".form-project .project-name ").val(), 
		newProject.url = $('.form-project .project-url').val(), 
		//newProject.version = $(".form-project .project-version").val(), 
		newProject.licence = $(".form-project .project-licence").val(),
		newProject.start=startDateSubmitProj,
		newProject.end=endDateSubmitProj,
		newProject.description=$(".form-project .project-description").val(),
		newProject.avancement=$(".form-project .project-avancement").val(),
		newProject.gouvernance=$(".form-project .project-gouvernance").val(),
		newProject.local=$(".form-project .project-local").val(),
		newProject.partenaire=$(".form-project .project-partenaire").val(),
		newProject.solidaire=$(".form-project .project-solidaire").val(),
		newProject.partage=$(".form-project .project-partage").val();
		console.log(newProject);
		$.blockUI({
			message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
            '<blockquote>'+
              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
              '<cite title="Hegel">Hegel</cite>'+
            '</blockquote> '
		});
		
		if ($(".form-project .project-id").val() !== "") {
			el = $(".form-project .project-id").val();

			for ( var i = 0; i < calendar.length; i++) {

				if (calendar[i]._id == el) {
					newProject._id = el;
					var projectIndex = i;
				}

			}
			//mockjax simulates an ajax call
			$.mockjax({
			url : '/project/edit/webservice',
			dataType : 'json',
			responseTime : 1000,
			responseText : {
				say : 'ok'
			}
		});

		$.ajax({
			url : '/project/edit/webservice',
			dataType : 'json',
			success : function(json) {
				$.unblockUI();
				if (json.say == "ok") {
					calendar[projectIndex] = newProject;
					$.hideSubview();
					toastr.success('The project has been successfully modified!');
				}
			}
		});

		} else {
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+'/project/save',
		        dataType : "json",
		        data:newProject,
				type:"POST",
		    })
		    .done(function (data) 
		    {
			alert (newProject.description);
		        if (data &&  data.result) {               
		        	toastr.success('Project Created success');
		        	if( 'undefined' != typeof updateProject && typeof updateProject == "function" ){
		        		updateProject( newProject, data.id );
						$.unblockUI();
						$.hideSubview();
		        	}	
		        } else {
		           toastr.error('Something Went Wrong');
		        }
		    });

		}
	}
});
};

// on hide project's form destroy summernote and bootstrapSwitch plugins
function hideEditProject() {
	$.hideSubview();
};
// enables the edit form 
function editProjectForm(el) {
	$(".close-new-project").off().on("click", function() {
		$(".back-subviews").trigger("click");
	});
	$(".form-project .help-block").remove();
	$(".form-project .form-group").removeClass("has-error").removeClass("has-success");
	if ( "undefined" == typeof el) {
		$(".form-project .project-id").val("");
		$(".form-project .project-name").val("");
		$(".form-project .project-url").val("");
		$(".form-project .project-licence").val("");
		//A supprimer
		$(".form-project .all-day").bootstrapSwitch('state', false);
		$('.form-project .all-day-range').hide();
		$(".form-project .project-start-date").val(moment());
		$(".form-project .project-end-date").val(moment().add('days', 1));
		
		$('.form-project .no-all-day-range .project-range-date').val(moment().format('DD/MM/YYYY h:mm A') + ' - ' + moment().add('days', 1).format('DD/MM/YYYY h:mm A'))
		.daterangepicker({  
			startDate: moment(),
			endDate: moment().add('days', 1),
			timePicker: true, 
			timePickerIncrement: 30, 
			format: 'DD/MM/YYYY h:mm A' 
		});
		
		$('.form-project .all-day-range .project-range-date').val(moment().format('DD/MM/YYYY h:mm A') + ' - ' + moment().add('days', 1).format('DD/MM/YYYY h:mm A'))
		.daterangepicker({  
			startDate: moment(),
			endDate: moment().add('days', 1)
		});
		//Fin de suppresion
	} else {
		$(".form-project .project-id").val(el);
	}
	$('.form-project .all-day').bootstrapSwitch();
	$('.form-project .all-day').on('switchChange.bootstrapSwitch', function(event, state) {
		$(".daterangepicker").hide();
		var startDate = moment($("#newProject").find(".project-start-date").val());
		var endDate = moment($("#newProject").find(".project-end-date").val());
		if (state) {
			$("#newProject").find(".no-all-day-range").hide();
			$("#newProject").find(".all-day-range").show();
			$("#newProject").find('.all-day-range .project-range-date').val(startDate.format('DD/MM/YYYY') + ' - ' + endDate.format('DD/MM/YYYY')).data('daterangepicker').setStartDate(startDate);
			$("#newProject").find('.all-day-range .project-range-date').data('daterangepicker').setEndDate(endDate);
		} else {
			$("#newProject").find(".no-all-day-range").show();
			$("#newProject").find(".all-day-range").hide();
			$("#newProject").find('.no-all-day-range .project-range-date').val(startDate.format('DD/MM/YYYY h:mm A') + ' - ' + endDate.format('DD/MM/YYYY h:mm A')).data('daterangepicker').setStartDate(startDate);
			$("#newProject").find('.no-all-day-range .project-range-date').data('daterangepicker').setEndDate(endDate);			
		}

	});
	$('.form-project .project-range-date').on('apply.daterangepicker', function(ev, picker) {
		$(".form-project .project-start-date").val(picker.startDate);
		$(".form-project .project-end-date").val(picker.endDate);
	});
	//alert();
};

// enable city research
function runShowCity(searchValue) {
	var citiesByPostalCode = getCitiesByPostalCode(searchValue);
	var oneValue = "";
	console.table(citiesByPostalCode);
	//alert();
	$.each(citiesByPostalCode,function(i, value) {
    	$("#city").append('<option value=' + value.value + '>' + value.text + '</option>');
    	oneValue = value.value;
	});
	
	if (citiesByPostalCode.length == 1) {
		$("#city").val(oneValue).show();
		//alert(oneValue);
	}

	if (citiesByPostalCode.length >0) {
        $("#cityDiv").show().slideDown("medium");
      } else {
        $("#cityDiv").slideUp("medium");
      }
}

function bindPostalCodeAction() {
	$('.form-project #postalCode').keyup(function(e){
		searchCity();
	});

	$('.form-project #postalCode').change(function(e){
		searchCity();
	});
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
function searchCity() {
	var searchValue = $('.form-project #postalCode').val();
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
	
</script>
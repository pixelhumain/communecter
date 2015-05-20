
<?php 
	//valeur correspondant 

$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/slider/css/slider.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/jQRangeSlider/css/classic-min.css');
//$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js');
//$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/jQRangeSlider/jQAllRangeSliders-min.js');
//$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/modernizr/modernizr.js');
////$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/slider/js/bootstrap-slider.js');
//$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/jQuery-Knob/js/jquery.knob.js');
//$cs->registerJsFile(Yii::app()->theme->baseUrl. 'assets/js/ui-sliders.js' , CClientScript::POS_END);
	$cssAnsScriptFilesTheme = array(
	//Select2
	//'/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.css',
	//'/assets/plugins/slider/css/slider.css',
	//'/assets/plugins/jQRangeSlider/css/classic-min.css',
	'/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js',

	'/assets/plugins/jQRangeSlider/jQAllRangeSliders-min.js',
	'/assets/plugins/modernizr/modernizr.js',
	'/assets/plugins/slider/js/bootstrap-slider.js',
	//autosize
	'/assets/plugins/jQuery-Knob/js/jquery.knob.js',
	'/assets/js/ui-sliders.js',
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
//<script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
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
					<div class="form-group">
						<input class="project-id hide" type="text">
						<input class="project-name form-control" name="projectName" type="text" placeholder="Project Name...">
						<input class="project-creator form-control" name="projectCreator" type="text" placeholder="Project creator...">
						<input class="project-url form-control" name="projectUrl" type="text" placeholder="Project url...">
						<input class="project-version form-control" name="projectVersion" type="text" placeholder="Project version...">
						<input class="project-licence form-control" name="projectLicence" type="text" placeholder="Project licence...">
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<!-- start: CIRCLE DIALS PANEL -->
					<div class="panel panel-white">
						<div class="panel-heading">
							<h4 class="panel-title">Circle <span class="text-bold">Dials</span></h4>
							<div class="panel-tools">
								<div class="dropdown">
									<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
										<i class="fa fa-cog"></i>
									</a>
									<ul class="dropdown-menu dropdown-light pull-right" role="menu">
										<li>
											<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
										</li>
										<li>
											<a class="panel-refresh" href="#">
												<i class="fa fa-refresh"></i> <span>Refresh</span>
											</a>
										</li>
										<li>
											<a class="panel-config" href="#panel-config" data-toggle="modal">
												<i class="fa fa-wrench"></i> <span>Configurations</span>
											</a>
										</li>
										<li>
											<a class="panel-expand" href="#">
												<i class="fa fa-expand"></i> <span>Fullscreen</span>
											</a>
										</li>
									</ul>
								</div>
								<a class="btn btn-xs btn-link panel-close" href="#">
									<i class="fa fa-times"></i>
								</a>
							</div>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<p>
										Nice, downward compatible, touchable, jQuery dial
									</p>
								</div>
								<div class="col-md-4 text-center">
									<h4>&#215; Disable display input</h4>
									<input class="knob" data-width="100" data-displayInput=false value="35">
								</div>
								<div class="col-md-4 text-center">
									<h4>&#215; 'cursor' mode</h4>
									<input class="knob" data-width="150" data-cursor=true data-fgColor="#222222" data-thickness=.3 value="29">
								</div>
								<div class="col-md-4 text-center">
									<h4>&#215; Display previous value</h4>
									<input class="knob" data-width="200" data-min="-100" data-displayPrevious=true value="44">
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 text-center">
									<h4>&#215; Angle offset</h4>
									<input class="knob" data-angleOffset=90 data-linecap=round value="35">
								</div>
								<div class="col-md-4 text-center">
									<h4>&#215; Angle offset and arc</h4>
									<input class="knob" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
								</div>
								<div class="col-md-4 text-center">
									<h4>&#215; 5-digit values, step 1000</h4>
									<input class="knob" data-min="-15000" data-displayPrevious=true data-max="15000" data-step="1000" value="-11000">
								</div>
							</div>
						</div>
					</div>
					<!-- end: CIRCLE DIALS PANEL -->
				</div>
			</div>
			<div class="row">
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
		</form>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
 	bindProjectSubViewProjects();
 	runProjectFormValidation();
 	//initialisation des sliders 
 	Main.init();
	SVExamples.init();
	UISliders.init();
});

function bindProjectSubViewProjects() {
		
	$(".new-project").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		$.subview({
			content : subViewContent,
			onShow : function() {
				editProject();
			},
			onHide : function() {
				hideEditProject();
			},
			onSave: function() {
				hideEditProject();
			}
		});
	});

	$(".close-subview-button").off().on("click", function(e) {
		$(".close-subviews").trigger("click");
		e.prprojectDefault();
	});
};


var subViewElement, subViewContent, subViewIndex;

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
		newProject = new Object;
		newProject.title = $(".form-project .project-name ").val(), 
		newProject.url = $('.form-project .project-url').val(), 
		newProject.version = $(".form-project .project-version").val(), 
		newProject.licence = $(".form-project .project-licence").val();
		
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
function editProject(el) {
	$(".close-new-project").off().on("click", function() {
		$(".back-subviews").trigger("click");
	});
	$(".form-project .help-block").remove();
	$(".form-project .form-group").removeClass("has-error").removeClass("has-success");

	if ( "undefined" == typeof el) {
		$(".form-project .project-id").val("");
		$(".form-project .project-name").val("");
		$(".form-project .project-url").val("");
		$(".form-project .project-version").val("");
		$(".form-project .project-licence").val("");

	} else {
		
		$(".form-project .project-id").val(el);
	}
};


	
</script>
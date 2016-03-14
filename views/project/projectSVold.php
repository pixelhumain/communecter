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
 	runProjectFormValidation()
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
					//$.hideSubview();
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
		        	//console.log("updateProject");
		        	if( 'undefined' != typeof updateProject && typeof updateProject == "function" ){
			        	alert("dedans");
		        		updateProject( newProject, data.id );
						$.unblockUI();
						//$.hideSubview();
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
	//$.hideSubview();
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
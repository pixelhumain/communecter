
<?php 
	$cssAnsScriptFilesModule = array(
		//Data helper
		'/js/dataHelpers.js'
		);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>
<style>

</style>


<!-- *** NEW PROJECT *** -->
<div id="newProject">
	<div class="noteWrap col-md-8 col-md-offset-2">
		 <div class="panel panel-white">
        	<div class="panel-heading border-light">
				<h1>Add a new project</h1>
			    
			    <p>If you want to create a new project in order to make it more visible : it's the best place
			    <br/>You can as well organize your project team, plan tasks, discuss, take decisions...
			    <br/>Depending on the project visibility, contributors can join the project and help
			    <br>to make it happen ! </p>

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
							<label class="control-label">
								Nom <span class="symbol required"></span>
							</label>
							<input class="project-name form-control" name="projectName" value=""/>
						</div>
						<div class="form-group">
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
				</div>
				<?php if(!isset(Yii::app()->session["userEmail"])){?>
				<div class="col-md-12">
					<div class="form-group">
						<input class="project-name form-control" name="projectName" type="text" placeholder="Project Name...">
					</div>
				</div>
				<?php } ?>	
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	bindProjectSubViewEvents();
 	bindPostalCodeAction();
 	runProjectFormValidationTest();
	var countries = <?php echo json_encode($countries) ?>;
	$('#projectCountry').select2({
		data : countries
	});
	$("textarea.autosize").autosize();

    $(".daterangepicker").on("hide.daterangepicker", function(){
 		console.log("ok");
 	});
});

function bindProjectSubViewEvents() {
	
	$(".close-subview-button").off().on("click", function(e) {
		$(".close-subviews").trigger("click");
		e.prprojectDefault();
	});
};

//var dateToShow, calendar;
// creates an array of projects to display in the calendar
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
			newProject.city=$(".form-project #city").val(),
			newProject.postalCode=$(".form-project #postalCode").val(),
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
					//alert (newProject.description);
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

	function runShowCity(searchValue) {
		var citiesByPostalCode = getCitiesByPostalCode(searchValue);
		var oneValue = "";
//		if(debug)console.table(citiesByPostalCode);
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
		$('.form-project #postalCode').keyup(function(e){
			searchCity();
		});

		$('.form-project #postalCode').change(function(e){
			searchCity();
		});
	}

	function searchCity() {
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
	
</script>
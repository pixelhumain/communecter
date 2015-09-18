
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
	//'/plugins/bootstrap-select/bootstrap-select.min.css',
	//'/plugins/bootstrap-select/bootstrap-select.min.js'
	'/plugins/autosize/jquery.autosize.min.js'
);

HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");
?>
<style>

</style>


<!-- *** NEW PROJECT *** -->
<?php if( @$isNotSV ){ ?>
<a class="text-red pull-right" href="#" onclick="showPanel('box-login')"><i class="fa fa-times"></i></a>
<?php } ?>
<div id="newProject">
<?php 
	$size = ( !@$isNotSV ) ? " col-md-8 col-md-offset-2" : "col-md-12"
	?>
	<div class="<?php echo $size ?>" >  
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
							<label class="control-label">
								<?php echo Yii::t("common","Name") ?><span class="symbol required"></span>
							</label>
							<input class="project-name form-control" name="projectName" value=""/>
						</div>
						<div class="form-group">
							<label for="projectRangeDate">
								<span><?php echo Yii::t("project","Project duration",null,Yii::app()->controller->module->id) ?></span>
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
							<label class="control-label">
								<?php echo Yii::t("common","Country") ?> <span class="symbol required"></span>
							</label>
							<input type="hidden" name="projectCountry" id="projectCountry" style="width: 100%; height:35px;"/>								
						</div>
						<div class="row">
							<div class="col-md-4 form-group">
								<label for="postalCode">
									<?php echo Yii::t("common","Postal Code") ?> <span class="symbol required"></span>
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
						
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<div>
								<label for="form-field-24" class="control-label"> Description </label>
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
jQuery(document).ready(function() {
	addCustomValidators();
	initProjectForm();
	bindProjectSubViewProjects();
 	bindPostalCodeAction();
 	runProjectFormValidation();
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
			
			console.log(newProject);
			$.blockUI({
				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
	            '<blockquote>'+
	              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
	              '<cite title="Hegel">Hegel</cite>'+
	            '</blockquote> '
			});

			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+'/project/save/id/<?php echo $_GET["id"]; ?>/type/<?php echo $_GET["type"];?>',
		        dataType: "json",
		        data: newProject,
				type: "POST",
		    })
		    .done(function (data) {
		        if (data &&  data.result) {               
		        	toastr.success('Project Created success');
		        	if( 'undefined' != typeof updateProject && typeof updateProject == "function" ){
		        		updateProject( newProject, data.id );
						$.unblockUI();
						$.hideSubview();
		        	}	
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
	$(".form-project .project-url").val("");
	$(".form-project .project-licence").val("");

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
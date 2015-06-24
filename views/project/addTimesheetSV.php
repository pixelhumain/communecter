<?php
$cssAnsScriptFilesTheme = array(
//Select2

	//autosize
	//Select2
	'/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css',
	'/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js',
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
#editProjectTimesheet{
	display: none;
}
</style>
<div id="editProjectTimesheet">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-white">
	    	<div class="panel-heading border-light">
	    		<h1>Add a Member ( Person, Organization )</h1>
	    		<p>An Organization can have People as members or Organizations</p>
	    	</div>
	    	<div class="panel-body">
				<form class="form-timesheet">
					<input type="hidden" value="<?php echo $itemId; ?>" class="projectId"/>
					<div class="row">
						<div class="col-md-12 projectTask">
							<div class="">
								<label class="control-label">
									Nom de la tâche <span class="symbol required"></span>
								</label>
								<input type="text" class="task-name form-control" name="" value=""/>
							</div>
							<div>
								<label class="control-label">
									Durée de la tâche <span class="symbol required"></span>
								</label>
								<div class="all-day-range">
									<div class="">
										<div class="">
											<div class="">
												<span class="input-icon">
													<input type="text" class="task-range-date form-control" name="" placeholder="Range date"/>
													<i class="fa fa-calendar"></i> </span>
											</div>
										</div>
									</div>
								</div>
								<div class="hide">
									<input type="text" class="task-start-date" value="" name="taskStartDate"/>
									<input type="text" class="task-end-date" value="" name="taskEndDate"/>
								</div>
							</div>
							<div>
								<label class="control-label">
									Couleur de la tâche <span class="symbol required"></span>
								</label>
								<select name="colorpicker">
								  <option value="#9ACA27">Vert</option>
								  <option value="#3CB6E3">Bleu</option>
								  <option value="#FC464A">Rouge</option>
								  <option value="#F4CF30">Jaune</option>
								  <option value="lorem">Jaune</option>
								</select>
							</div>
						</div>
						<div>
							<div class="row center">
				    	        <button class="btn btn-primary" >Enregistrer</button>
							</div>
						</div>
					</div>
				</form>
	    	</div>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	bindprojectSubViewTimesheet();
	//runChartFormValidation();
	
	initFormAddTask();
	$('select[name="colorpicker"]').simplecolorpicker().on('change', function() {
		alert($('select[name="colorpicker"]').val());
	});;
	
});
function initFormAddTask(){
	$(".task-start-date").val(moment());
	$(".task-end-date").val(moment().add('days', 1));
	
	$('.task-range-date').val(moment().format('DD/MM/YYYY') + ' - ' + moment().add('days', 1).format('DD/MM/YYYY'))
			.daterangepicker({  
				startDate: moment(),
				endDate: moment().add('days', 1),
				format: 'DD/MM/YYYY'
			},
			function(start, end, label) {
    			$(".task-start-date").val(start);
				$(".task-end-date").val(end);
			}
		);

	$('.task-range-date').on('apply.daterangepicker', function(ev, picker) {
		$(".task-start-date").val(picker.startDate);
		$(".task-end-date").val(picker.endDate);
	});

	var startDate = moment($("task-start-date").val());
	var endDate = moment($("task-end-date").val());

	$('.task-range-date').data('daterangepicker').setStartDate(startDate);
	$('.task-range-date').data('daterangepicker').setEndDate(endDate);
	$(".form-timesheet").off().on("submit",function(){
		
	    	//event.preventDefault();
	    	startDateSubmitTask = moment($(".task-start-date").val()).format('MM/YYYY');
			endDateSubmitTask = moment($(".task-end-date").val()).format('MM/YYYY');
	    	var params = { 
	    		//"projectId" : $("#editProjectTimesheet #").val(),
				"taskName" : $("#editProjectTimesheet .task-name").val(),
				"taskColor" : $("#editProjectTimesheet select[name='colorpicker']").val(),
				"taskStart" : startDateSubmitTask,
				"taskEnd" : endDateSubmitTask,
			};
			console.log(params);
			alert();
	    	/*$.ajax({
	            type: "POST",
	            url: baseUrl+"/communecter/link/savemember",
	            data: params,
	            dataType: "json",
	            success: function(data){
	            	if(!data.result){
	            		toastr.error(data.msg);
	            	}else{
	            		toastr.success("Member added successfully ");
	            		if(typeof updateOrganisation != "undefined" && typeof updateOrganisation == "function")
		        			updateOrganisation( data.member,  $("#addMembers #memberType").val());
		               	setValidationTable();
		               if($("#addMembers #memberRole").val() != ""){
			               	if(typeof(organization["roles"])!="undefined"){
			               		var tabStrRole = $("#addMembers #memberRole").val().split(",");
			               		for(var i = 0; i<tabStrRole.length; i++){
			               			if($.inArray(tabStrRole[i], organization["roles"])==-1){
			               				organization["roles"].push(tabStrRole[i]);
			               			}
			               		}
			               		
								$('#memberRole').select2({ tags: organization["roles"]});
								//$('#memberRole').select2({ tags: organization["roles"]});
							}else{
								var tabStrRole = $("#addMembers #memberRole").val().split(",");
								$('#memberRole').select2({ tags: tabStrRole});
							}
		               }
		               
		                $("#addMembers #memberType").val("");
		                $("#addMembers #memberName").val("");
		                $("#addMembers #memberEmail").val("");
		                $("#addMembers #memberIsAdmin").val("");
		                $("#addMembers #memberRole").val("");
		                $('#addMembers #organizationType').val("");
						$("#addMembers #memberIsAdmin").val("false");
						$("#memberRole").select2("val", "");
						$("[name='my-checkbox']").bootstrapSwitch('state', false);
		                showSearch();
	            	}
	            	console.log(data.result);   
	            },
	            error:function (xhr, ajaxOptions, thrownError){
	              toastr.error( thrownError );
	            } 
	    	});*/
	    });
}
/*function runChartFormValidation() {
	var formProject = $('.form-chart');
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
			newChart = new Object;
			newChart.projectID=$(".form-chart .projectId").val(),
			newChart.avancement=$(".form-chart .project-avancement").val(),
			newChart.gouvernance=$(".form-chart .project-gouvernance").val(),
			newChart.local=$(".form-chart .project-local").val(),
			newChart.partenaire=$(".form-chart .project-partenaire").val(),
			newChart.solidaire=$(".form-chart .project-solidaire").val(),
			newChart.partage=$(".form-chart .project-partage").val();
			$.blockUI({
				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
	            '<blockquote>'+
	              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
	              '<cite title="Hegel">Hegel</cite>'+
	            '</blockquote> '
			});
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
		        type: "POST",
		        url: baseUrl+"/"+moduleId+'/project/editchart',
		        dataType : "json",
		        data:newChart,
				type:"POST",
		    })
		    .done(function (data,myNewChart) 
		    {
			   if (data.result==true) {               
		        	toastr.success('Project properties succesfully update');
		        		updateChart(data.properties);
						$.unblockUI();
						$.hideSubview(); 	
		        } else {
		           toastr.error('Something Went Wrong');
		        }
		   	});	
		}
	});
};*/

function bindprojectSubViewTimesheet() {	
	$(".edit-timesheet").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		$.subview({
			content : subViewContent,
			onShow : function() {
				editTimesheet();
			},
			/*onHide : function() {
				//hideEditTimesheet();
			},
			onSave: function() {
				//hideEditTimesheet();
			}*/
		});
	});
	/*$(".close-subview-button").off().on("click", function(e) {
		$(".close-subviews").trigger("click");
		e.prinviteDefault();
	});*/
};

var subViewElement, subViewContent, subViewIndex;
function hideEditTimesheet() {
//	$.hideEditTimesheet();
};
// enables the edit form 
function editTimesheet() {
	/*$(".close-timesheet-edit").off().on("click", function() {
		$(".back-subviews").trigger("click");
	});*/
};
</script>
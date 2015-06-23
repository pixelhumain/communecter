<style>
#editProjectTimesheet{
	display: none;
}
</style>
<div id="editProjectTimesheet">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h3>Add project's task</h3>
		<form class="form-chart">
			<input type="hidden" value="<?php echo $itemId; ?>" class="projectId"/>
			<div class="row">
				<div class="col-md-12 projectTask">
					<div class="form-group">
						<label class="control-label">
							Nom de la tâche <span class="symbol required"></span>
						</label>
						<input type="text" class="project-name form-control" name="" value=""/>
					</div>
					<div class="form-group">
						<label class="control-label">
							Durée de la tâche <span class="symbol required"></span>
						</label>
						<div class="all-day-range">
							<div class="">
								<div class="form-group">
									<div class="form-group">
										<span class="input-icon">
											<input type="text" class="project-range-date form-control" name="" placeholder="Range date"/>
											<i class="fa fa-calendar"></i> </span>
									</div>
								</div>
							</div>
						</div>
						<div class="hide">
							<input type="text" class="project-start-date" value="" name="taskStartDate"/>
							<input type="text" class="project-end-date" value="" name="taskEndDate"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
		    	        <button class="btn btn-primary" >Enregistrer</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	bindprojectSubViewTimesheet();
	//runChartFormValidation();
	$(".daterangepicker").on("hide.daterangepicker", function(){
 		console.log("ok");
 	});

});
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
			onHide : function() {
				//hideEditTimesheet();
			},
			onSave: function() {
				//hideEditTimesheet();
			}
		});
	});
	$(".close-subview-button").off().on("click", function(e) {
		$(".close-subviews").trigger("click");
		e.prinviteDefault();
	});
};

var subViewElement, subViewContent, subViewIndex;
function hideEditTimesheet() {
	$.hideEditTimesheet();
};
// enables the edit form 
function editTimesheet() {
	$(".close-timesheet-edit").off().on("click", function() {
		$(".back-subviews").trigger("click");
	});
};
</script>
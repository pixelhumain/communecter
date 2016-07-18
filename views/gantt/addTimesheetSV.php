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

$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<?php

	if(@$project)
		Menu::project($project);
	$this->renderPartial('../default/panels/toolbar'); 

?>
<div id="editTimesheet" class="col-md-12 col-xs-12">

<h2 class='radius-10 padding-10 partition-blue text-bold'> <?php echo Yii::t("gantt","Add a Task",null,Yii::app()->controller->module->id) ?></h2>

	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-white">
	    	<div class="panel-heading border-light">
	    		<p><?php echo Yii::t("gantt","Tasks show what's next in the project",null,Yii::app()->controller->module->id) ?></p>
	    	</div>
	    	<div class="panel-body">
				<form class="form-timesheet" submit="false">
					<input type="hidden" value="<?php echo $_GET["id"] ?>" class="parentId"/>
					<input type="hidden" value="<?php echo $_GET["type"] ?>" class="parentType"/>
					<div class="row">
						<div class="col-md-12">
							<div class="">
								<label class="control-label">
									<?php echo Yii::t("gantt","Task's name",null,Yii::app()->controller->module->id) ?> <span class="symbol required"></span>
								</label>
								<input type="text" class="task-name form-control" name="taskName" value=""/>
							</div>
							<div>
								<label class="control-label">
									<?php echo Yii::t("gantt","Task's duration",null,Yii::app()->controller->module->id) ?><span class="symbol required"></span>
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
									<?php echo Yii::t("gantt","Task's color",null,Yii::app()->controller->module->id) ?> <span class="symbol required"></span>
								</label>
								<select name="colorpicker">
								  <option value="#9ACA27"><?php echo Yii::t("common","Green") ?></option>
								  <option value="#3CB6E3"><?php echo Yii::t("common","Blue") ?></option>
								  <option value="#FC464A"><?php echo Yii::t("common","Red") ?></option>
								  <option value="#F4CF30"><?php echo Yii::t("common","Yellow") ?></option>
								  <option value="#A969CA"><?php echo Yii::t("common","Purple") ?></option>
								</select>
							</div>
						</div>
						<div>
							<div class="row center">
				    	        <button class="btn btn-primary" ><?php echo Yii::t("common","SAVE") ?></button>
							</div>
						</div>
					</div>
				</form>
	    	</div>
		</div>
	</div>
	<div class="row ">
	 	<div class="col-md-8 col-md-offset-2">
	        <table class="table table-striped table-bordered table-hover newTasksAddedTable hide">
	            <thead>
	                <tr>
	                    <th><?php echo Yii::t("common","Name") ?></th>
	                    <th><?php echo Yii::t("common","Start") ?></th>
	                    <th><?php echo Yii::t("common","End") ?></th>
	                    <th><?php echo Yii::t("common","Color") ?></th>
	                    <th><?php echo Yii::t("common","Status") ?></th>
	                </tr>
	            </thead>
	            <tbody class="newTaskAdded"></tbody>
	        </table>
	    </div>
	</div>
</div>

<script type="text/javascript">
var parentId = $('.parentId').val();
jQuery(document).ready(function() {
	$(".moduleLabel").html("<i class='fa fa-tasks'></i> Editer la timeline</a>");
	bindSubViewTimesheet();
	initValidationTaskTable();
	bindBtnRemoveTask();
	resetGenericFilesTable() ;
	initFormAddTask();
	$('select[name="colorpicker"]').simplecolorpicker();
});
function bindBtnRemoveTask(){
	$(".removeTask").off().on("click",function () {
			$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
			
			var idTask = $(this).data("id");
			var parentType=$("#editTimesheet .parentType").val();
			var parentId=$("#editTimesheet .parentId").val();
			bootbox.confirm("<?php echo Yii::t("common","Are you sure you want to delete") ?> <?php echo Yii::t("gantt","the task",null,Yii::app()->controller->module->id)?> \"<span class='text-red'>"+$(this).data("name")+"</span>\" ?", 
				function(result) {
					if (!result) {
					$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
					return;
				}

				console.log(idTask);
				$.ajax({
					type: "POST",
					//url: baseUrl+"/"+moduleId+"/gantt/removeTask/projectId/"+projectId+"/taskId/"+idTask+"",
					url: baseUrl+"/"+moduleId+"/gantt/removeTask/taskId/"+idTask+"/parentType/"+parentType+"/parentId/"+parentId+"",
					dataType: "json",
					success: function(data){
						if ( data && data.result ) {               
							toastr.success("<?php echo Yii::t("common","TASK REMOVED SUCCESFULLY!!") ?>");
							$(".task"+idTask).remove();
							if ($(".newTaskAdded tr").length == 1) {
								$(".newTasksAddedTable").addClass("hide");
							}
						} else {
						   toastr.error(data.msg);
						}
					},
					error: function(data) {
						toastr.error("<?php Yii::t("common","Something went wrong!")?>" );
					}
				});
			});

			$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
	});
}
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
	
		var formTimesheet = $('.form-timesheet');
		var errorHandler2 = $('.errorHandler', formTimesheet);
		var successHandler2 = $('.successHandler', formTimesheet);

		formTimesheet.validate({
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
	//$(".form-timesheet").off().on("submit",function(task){
			rules : {
				taskName : {
					minlength : 2,
					required : true
				},
			},
			messages : {
				taskName : "* Please specify the name of the task",
			},
	    	submitHandler : function(form) {
		    	//task.preventDefault();
		    	startDateSubmitTask = moment($(".task-start-date").val()).format('YYYY-MM-DD');
				endDateSubmitTask = moment($(".task-end-date").val()).format('YYYY-MM-DD');
				colorClass=nameTimesheetClass($("#editTimesheet select[name='colorpicker']").val());
		    	var params = { 
		    		"parentId" : $("#editTimesheet .parentId").val(),
		    		"parentType" : $("#editTimesheet .parentType").val(),
					"taskName" : $("#editTimesheet .task-name").val(),
					"taskColor" : colorClass,
					"taskStart" : startDateSubmitTask,
					"taskEnd" : endDateSubmitTask,
				};
				//console.log(params);
		    	$.ajax({
		            type: "POST",
		            url: baseUrl+"/communecter/gantt/savetask",
		            data: params,
		            dataType: "json",
		            success: function(data){
		            	if(!data.result){
		            		toastr.error(data.msg);
		            	}else{
		            		toastr.success("<?php echo Yii::t("common","Task added successfully")?>");
							setValidationTaskTable(data.idTask);
							bindBtnRemoveTask();
							$("#editTimesheet .task-name").val("");
							$(".task-start-date").val(moment());
							$(".task-end-date").val(moment().add('days', 1));
		            	}
		            	console.log(data.result);   
		            },
		            error:function (xhr, ajaxOptions, thrownError){
		              toastr.error( thrownError );
		            } 
	    		});
	    	}
	    });
}

function bindSubViewTimesheet() {	
	$(".edit-timesheet").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		$.subview({
			content : subViewContent,
			onShow : function() {
				initFormAddTask();
			},
			onHide : function() {
				hideEditTimesheet();
			}
			/*onSave: function() {
				//hideEditTimesheet();
			}*/
		});
	});
};

//var subViewElement, subViewContent, subViewIndex;
function hideEditTimesheet() {
	getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/"+$("#editTimesheet .parentType").val()+"/id/"+$("#editTimesheet .parentId").val()+"",null,"html");

//	$.hideEditTimesheet();
};
// enables the edit form 
function editTimesheet() {
	/*$(".close-timesheet-edit").off().on("click", function() {
		$(".back-subviews").trigger("click");
	});*/
};
function initValidationTaskTable(){
	strHTML="";
	<?php if (isset($tasks) && !empty($tasks)) {
		foreach ($tasks as $key => $val){ 
			if (!is_array($val["key"])){
		?>
			color=nameTimesheetClass("<?php echo $val["color"];?>");
			strHTML += "<tr class='task<?php echo $val["key"];?>'>"
				+"<td><?php echo $val["name"];?></td>"
				+"<td><?php echo $val["startDate"];?></td>"
				+"<td><?php echo $val["endDate"];?></td>"
				+"<td style='background-color:"+color+";'>"
				+"</td><td>"+
				"<span class='label label-info'><?php echo Yii::t("common","already") ?></span>"
				+"<div class='label'>"
					+"<a href='javascript:;' class='removeTask btn btn-xs btn-red tooltips delBtn' data-id='<?php echo $val["key"] ?>' data-name='<?php echo $val["name"];?>' data-placement='left' data-original-title='Remove'>"
						+"<i class='fa fa-times fa fa-white'></i>"
					+"</a>"
				+"</div></td><tr>";
		<?php } }?>
		$(".newTaskAdded").append(strHTML);
		if($(".newTasksAddedTable").hasClass("hide"))
        	$(".newTasksAddedTable").removeClass('hide').addClass('animated bounceIn');
	<?php  } ?>
	//}
}
function setValidationTaskTable(id){	
	strHTML = "<tr class='task"+id.$id+"'><td>"
        +$("#editTimesheet .task-name").val()+"</td><td>"
        +startDateSubmitTask+"</td><td>"
		+endDateSubmitTask+"</td><td style='background-color:"+$("#editTimesheet select[name='colorpicker']").val()+";'>"
		+"</td><td>"+
		"<span class='label label-info'><?php echo Yii::t("common","added") ?></span>"+
		"<div class='label'>"
					+"<a href='#' class='removeTask btn btn-xs btn-red tooltips delBtn' data-id='"+id.$id+"' data-name='"+$("#editTimesheet .task-name").val()+"' data-placement='left' data-original-title='Remove'>"
						+"<i class='fa fa-times fa fa-white'></i>"
					+"</a>"
				+"</div></td></td> <tr>";
    $(".newTaskAdded").append(strHTML);
    if($(".newTasksAddedTable").hasClass("hide"))
        $(".newTasksAddedTable").removeClass('hide').addClass('animated bounceIn');
}
function nameTimesheetClass(color){
	if (color=="#9ACA27")
		timeSheetClass="lorem";
	else if (color == "#3CB6E3")
		timeSheetClass="ipsum";
	else if (color == "#FC464A")
		timeSheetClass = "default";
	else if (color == "#F4CF30")
		timeSheetClass="dolor";
	else if (color == "#A969CA")
		timeSheetClass="sit";
	else if (color == "lorem"){
		timeSheetClass="#9ACA27";
	}
	else if (color == "ipsum"){
		timeSheetClass="#3CB6E3";
	}
	else if (color == "default"){
		timeSheetClass="#FC464A";
	}
	else if (color == "sit")
		timeSheetClass="#A969CA";
	else{
		timeSheetClass="#F4CF30";
	}
	return timeSheetClass;
}
function resetGenericFilesTable() {}
</script>
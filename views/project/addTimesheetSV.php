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
	    		<h1>Add a Task </h1>
	    		<p>Task will show what's next in the project</p>
	    	</div>
	    	<div class="panel-body">
				<form class="form-timesheet" submit="false">
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
	<div class="row ">
	 	<div class="col-md-8 col-md-offset-2">
	        <table class="table table-striped table-bordered table-hover newTasksAddedTable hide">
	            <thead>
	                <tr>
	                    <th>Name</th>
	                    <th>Start</th>
	                    <th>End</th>
	                    <th>Color</th>
	                    <th>Status</th>
	                </tr>
	            </thead>
	            <tbody class="newTaskAdded"></tbody>
	        </table>
	    </div>
	</div>
</div>

<script type="text/javascript">
var projectId = $('.projectId').val();; 
jQuery(document).ready(function() {
	bindprojectSubViewTimesheet();
	//runChartFormValidation();
	initValidationTaskTable();
	bindBtnRemoveTask();
	resetGenericFilesTable() ;
	//initFormAddTask();
	$('select[name="colorpicker"]').simplecolorpicker();
});
function bindBtnRemoveTask(){
	$(".removeTask").off().on("click",function () {
			$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
			
			var idTask = $(this).data("id");
			bootbox.confirm("Are you sure you want to delete <span class='text-red'>"+$(this).data("name")+"</span> project ?", 
				function(result) {
					if (!result) {
					$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
					return;
				}

				console.log(idTask);
				$.ajax({
					type: "POST",
					url: baseUrl+"/"+moduleId+"/project/removeTask/projectId/"+projectId+"/taskId/"+idTask+"",
					dataType: "json",
					success: function(data){
						if ( data && data.result ) {               
							toastr.info("TASK REMOVED SUCCESFULLY!!");
							$(".task"+idTask).remove();
							if ($(".newTaskAdded tr").length == 0) {
								$(".newTasksAddedTable").addClass("hide");
							}
						} else {
						   toastr.error(data.msg);
						}
					},
					error: function(data) {
						toastr.error("Something went wrong!! Contact your administrator");
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
	$(".form-timesheet").off().on("submit",function(task){
	    	task.preventDefault();
	    	startDateSubmitTask = moment($(".task-start-date").val()).format('YYYY-MM-DD');
			endDateSubmitTask = moment($(".task-end-date").val()).format('YYYY-MM-DD');
			colorClass=nameTimesheetClass($("#editProjectTimesheet select[name='colorpicker']").val());
	    	var params = { 
	    		"projectId" : $("#editProjectTimesheet .projectId").val(),
				"taskName" : $("#editProjectTimesheet .task-name").val(),
				"taskColor" : colorClass,
				"taskStart" : startDateSubmitTask,
				"taskEnd" : endDateSubmitTask,
			};
			//console.log(params);
	    	$.ajax({
	            type: "POST",
	            url: baseUrl+"/communecter/project/savetask",
	            data: params,
	            dataType: "json",
	            success: function(data){
	            	if(!data.result){
	            		toastr.error(data.msg);
	            	}else{
	            		toastr.success("Project's task added successfully ");
	            		console.log(data);
	            		//if(typeof updateOrganisation != "undefined" && typeof updateOrganisation == "function")
		        			//updateOrganisation( data.member,  $("#addMembers #memberType").val());
		               setValidationTaskTable(data.idTask);
		               bindBtnRemoveTask();
		               $("#editProjectTimesheet .task-name").val("");
		               $(".task-start-date").val(moment());
					   $(".task-end-date").val(moment().add('days', 1));
	            	}
	            	console.log(data.result);   
	            },
	            error:function (xhr, ajaxOptions, thrownError){
	              toastr.error( thrownError );
	            } 
	    	});
	    });
}

function bindprojectSubViewTimesheet() {	
	$(".edit-timesheet").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		$.subview({
			content : subViewContent,
			onShow : function() {
				initFormAddTask();
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

//var subViewElement, subViewContent, subViewIndex;
function hideEditTimesheet() {
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
	<?php if (!empty($tasks)) {
		foreach ($tasks as $key => $val){ 
		?>
			color=nameTimesheetClass("<?php echo $val["color"];?>");
			strHTML += "<tr class='task<?php echo $key;?>'>"
				+"<td><?php echo $val["name"];?></td>"
				+"<td><?php echo $val["startDate"];?></td>"
				+"<td><?php echo $val["endDate"];?></td>"
				+"<td style='background-color:"+color+";'>"
				+"</td><td>"+
				"<span class='label label-info'>already</span>"
				+"<div class='label'>"
					+"<a href='#' class='removeTask btn btn-xs btn-red tooltips delBtn' data-id='<?php echo $key ?>' data-name='<?php echo $val["name"];?>' data-placement='left' data-original-title='Remove'>"
						+"<i class='fa fa-times fa fa-white'></i>"
					+"</a>"
				+"</div></td><tr>";
		<?php }?>
		$(".newTaskAdded").append(strHTML);
		if($(".newTasksAddedTable").hasClass("hide"))
        	$(".newTasksAddedTable").removeClass('hide').addClass('animated bounceIn');
	<?php } ?>
	
}
function setValidationTaskTable(id){	
	strHTML = "<tr class='task"+id.$id+"'><td>"
        +$("#editProjectTimesheet .task-name").val()+"</td><td>"
        +startDateSubmitTask.format('DD/MM/YYYY')+"</td><td>"
		+endDateSubmitTask.format('DD/MM/YYYY')+"</td><td style='background-color:"+$("#editProjectTimesheet select[name='colorpicker']").val()+";'>"
		+"</td><td>"+
		"<span class='label label-info'>added</span>"+
		"<div class='label'>"
					+"<a href='#' class='removeTask btn btn-xs btn-red tooltips delBtn' data-id='"+id.$id+"' data-name='"+$("#editProjectTimesheet .task-name").val()+"' data-placement='left' data-original-title='Remove'>"
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
	else if (color == "lorem"){
		timeSheetClass="#9ACA27";
	}
	else if (color == "ipsum"){
		timeSheetClass="#3CB6E3";
	}
	else if (color == "default"){
		timeSheetClass="#FC464A";
	}
	else{
		timeSheetClass="#F4CF30";
	}
	return timeSheetClass;
}
function resetGenericFilesTable() 
{
	/*console.log("resetGenericFilesTable");
	if( !$('.newTasksAddedTable').hasClass("dataTable") ){
		genericFilesTable = $('.newTasksAddedTable').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "Show _MENU_ Rows",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[1, 'asc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] ],
			"iDisplayLength" : 10,
			"destroy": true
		});
	} else {
		if( $(".newTaskAdded").children('tr').length > 0 )
		{
			$(".newTaskAdded").dataTable().fnDestroy();
			$(".newTaskAdded").dataTable().fnDraw();
		} else {
			console.log(" projectFilesTable fnClearTable");
			$(".newTaskAdded").dataTable().fnClearTable();
		}
	}*/
}
</script>
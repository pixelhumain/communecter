<?php 
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/x-editable/css/bootstrap-editable.css');
	//X-editable...
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js' , CClientScript::POS_END, array(), 2);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/x-editable/js/bootstrap-editable.js' , CClientScript::POS_END, array(), 2);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , CClientScript::POS_END, array(), 2);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , CClientScript::POS_END, array(), 2);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/wysihtml5.js' , CClientScript::POS_END, array(), 2);
?>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><span><i class="fa fa-info fa-2x text-blue"></i>   Informations</span></h4>
		<div class="panel-tools">
			<div class="dropdown">
				<a class="btn btn-xs dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
					<i class="fa fa-cog"></i>
				</a>
				<ul role="menu" class="dropdown-menu dropdown-light pull-right">
					<li>
						<a href="#" class="panel-collapse collapses"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
					</li>
					<li>
						<a href="#" class="panel-refresh">
							<i class="fa fa-refresh"></i> <span>Refresh</span>
						</a>
					</li>
					<li>
						<a data-toggle="modal" href="#panel-config" class="panel-config">
							<i class="fa fa-wrench"></i> <span>Configurations</span>
						</a>
					</li>
					<li>
						<a href="#" class="panel-expand">
							<i class="fa fa-expand"></i> <span>Fullscreen</span>
						</a>
					</li>
				</ul>
			</div>
			<a href="#" class="btn btn-xs btn-link panel-close">
				<i class="fa fa-times"></i>
			</a>
		</div>
	</div>
	<div class="panel-body no-padding">
			<table class="table table-condensed table-hover" >
				<tbody>
					<tr>
						<td>Intitulé</td>
						<td><a href="#" id="name" data-type="text" data-original-title="Enter the project's name" class="editable-project editable editable-click"><?php if(isset($project["name"]))echo $project["name"];?></a></td>
					</tr>
					<tr>
						<td>Début</td>
						<td><a href="#" id="startDate" data-type="datetime" data-original-title="Enter the project's start" class="editable editable-click"><?php if(isset($project["startDate"]))echo $project["startDate"]; ?></a></td>
					</tr>
					<tr>
						<td>Fin</td>
						<td><a href="#" id="endDate" data-type="datetime" data-original-title="Enter the project's end" class="editable editable-click"><?php if(isset($project["endDate"]))echo $project["endDate"]; ?></a></td>
					</tr>
					<tr>
						<td>Licence</td>
						<td><a href="#" id="licence" data-type="text" data-original-title="Enter the project's licence" class="editable-project editable editable-click"><?php if(isset($project["licence"])) echo $project["licence"];?></a></td>
					</tr>
					<tr>
						<td>URL</td>
						<td><a href="<?php if(isset($project["url"])) echo $project["url"]; else echo "#"; ?>" id="url" data-type="text" data-original-title="Enter the project's url" class="editable-project editable editable-click"><?php if(isset($project["url"])) echo $project["url"];?></a></td>
					</tr>
					<tr>
						<td>Description</td>
						<td><a href="#" id="description" data-type="text" data-original-title="Enter the project's description" class="editable-project editable editable-click"><?php if(isset($project["description"])) echo $project["description"];?></a></td>
					</tr>
				</tbody>
			</table>
	</div>
</div>
<script type="text/javascript">
var projectData = <?php echo json_encode($project)?>;
var mode = "update";
var projectId= "<?php echo (string)$project["_id"]; ?>";
jQuery(document).ready(function() 
{
    bindAboutPodProjects();
	//manageModeProject();
	debugMap.push(projectData);
});
/*function manageModeProject() 
{
	if (mode == "view") {
		$('.editable-project').editable('toggleDisabled');
	} else if (mode == "update") {
		// Add a pk to make the update process available on X-Editable
		//$('.editable-project').editable('option', 'pk', projectId);

	}
}*/


function bindAboutPodProjects() {
	$.fn.editable.defaults.mode = 'inline';
	$('.editable-project').editable({
    	url: baseUrl+"/"+moduleId+"/project/updatefield", //this url will not be used for creating new job, it is only for update
    	onblur: 'submit',
    	showbuttons: false,
	});
    //make jobTitle required
	$('#name').editable('option', 'validate', function(v) {
    	if(!v) return 'Required field!';
	});
	$('#startDate').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", //this url will not be used for creating new user, it is only for update
		mode: "popup",
		placement: "bottom",
		format: 'dd/mm/yyyy',    
		viewformat: 'dd/mm/yyyy',
		showbuttons: false,    
		datepicker: {
			weekStart: 1,
			format: 'yyyy-mm-dd'
		   }
		}
	);

	$('#endDate').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", //this url will not be used for creating new user, it is only for update
		mode: "popup",
		placement: "bottom",
		format: 'dd/mm/yyyy',    
		viewformat: 'dd/mm/yyyy',
		showbuttons: false,    
		datetimepicker: {
			weekStart: 1,
			format: 'dd/mm/yyyy',
		   }
		}
	);
	$('.editable-project').editable('option', 'pk', projectId);
	$('#startDate').editable('option', 'pk', projectId);
	$('#endDate').editable('option', 'pk', projectId);
}
</script>
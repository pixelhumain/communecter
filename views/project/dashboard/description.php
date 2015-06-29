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

	//Data helper
	$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END, array(), 2);
	//X-Editable postal Code
	$cs->registerScriptFile($this->module->assetsUrl. '/js/postalCode.js' , CClientScript::POS_END, array(), 2);
?>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><span><i class="fa fa-info fa-2x text-blue"></i>   Informations</span></h4>
		<div class="navigator padding-0 text-right">
			<div class="panel-tools">
				<?php 
					$edit = false;
					if(isset(Yii::app()->session["userId"]) && isset($project["_id"]))
						$edit = Authorisation::canEditItem(Yii::app()->session["userId"], Project::COLLECTION, (string)$project["_id"]);
					if($edit){
				?>
				<a href="#" id="editProjectDetail" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Editer le projet" alt=""><i class="fa fa-pencil"></i></a>
        		<?php } ?>
			</div>
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
						<td>Description</td>
						<td><a href="#" id="description" data-type="wysihtml5" data-original-title="Enter the project's description" class="editable editable-click"></a></td>
					</tr>
					<tr>
						<td>Début</td>
						<td><a href="#" id="startDate" data-type="date" data-original-title="Enter the project's start" class="editable editable-click"></a></td>
					</tr>
					<tr>
						<td>Fin</td>
						<td><a href="#" id="endDate" data-type="date" data-original-title="Enter the project's end" class="editable editable-click"></a></td>
					</tr>
					<tr>
						<td>Tags</td>
						<td><a href="#" id="tags" data-type="select2" data-type="Tags" data-emptytext="Tags" class="editable editable-click"></td>
					</tr>
					<tr>
						<td>Code Postal</td>
						<td><a href="#" id="address" data-type="postalCode" data-title="Postal Code" data-emptytext="Postal Code" class="editable editable-click" data-placement="bottom"></a></td>
					</tr>
					<tr>
						<td>Pays</td>
						<td><a href="#" id="addressCountry" data-type="select" data-title="Country" data-emptytext="Country" data-original-title="" class="editable editable-click"></a></td>
					</tr>
					<tr>
						<td>Licence</td>
						<td><a href="#" id="licence" data-type="text" data-original-title="Enter the project's licence" class="editable-project editable editable-click"><?php if(isset($project["licence"])) echo $project["licence"];?></a></td>
					</tr>
					<tr>
						<td>URL</td>
						<td><a href="#" id="url" data-type="text" data-original-title="Enter the project's url" class="editable-project editable editable-click"><?php if(isset($project["url"])) echo $project["url"];?></a></td>
					</tr>
					
				</tbody>
			</table>
	</div>
</div>
<script type="text/javascript">
var projectData = <?php echo json_encode($project)?>;
var mode = "update";
var projectId= "<?php echo (string) $project["_id"]; ?>";
var countries = <?php echo json_encode($countries) ?>;
//var startDate = '<?php ?>';
//var endDate = '<?php ?>';


jQuery(document).ready(function() 
{
    bindAboutPodProjects();
	initXEditable();
	manageModeContext();
	debugMap.push(projectData);
});



function bindAboutPodProjects() {
	$("#editProjectDetail").on("click", function(){
		switchMode();
	})
}

function initXEditable() {
	$.fn.editable.defaults.mode = 'inline';
	$('.editable-project').editable({
    	url: baseUrl+"/"+moduleId+"/project/updatefield", //this url will not be used for creating new job, it is only for update
    	onblur: 'submit',
    	showbuttons: false,
    	success : function(data) {
	        if(data.result) 
	        	toastr.success(data.msg);
	        else
	        	toastr.error(data.msg);  
	    }
	});
    //make jobTitle required
	$('#name').editable('option', 'validate', function(v) {
    	if(!v) return 'Required field!';
	});

	$('#description').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		value: <?php echo (isset($project["description"])) ? json_encode($project["description"]) : "''"; ?>,
		placement: 'right',
		mode: 'popup',
		wysihtml5: {
			html: true,
			video: false,
			image: false
		},
		success : function(data) {
	        if(data.result) 
	        	toastr.success(data.msg);
	        else
	        	toastr.error(data.msg);  
	    },
	});

	$('#startDate').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		type: "date",
		mode: "popup",
		placement: "bottom",
		format: 'yyyy-mm-dd',
		viewformat: 'dd/mm/yyyy',
		datepicker: {
			weekStart: 1,
		},
		success : function(data) {
			if(data.result) 
				toastr.success(data.msg);
			else 
				return data.msg;
	    }
	});

	$('#endDate').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		type: "date",
		mode: "popup",
		placement: "bottom",
		format: 'yyyy-mm-dd',   
    	viewformat: 'dd/mm/yyyy',
    	datepicker: {
            weekStart: 1,
       },
       success : function(data) {
	        if(data.result) 
	        	toastr.success(data.msg);
	        else 
				return data.msg;
	    }
    });
    var formatDate = "YYYY-MM-DD";
    $('#startDate').editable('setValue', moment(startDate, "YYYY-MM-DD HH:mm").format(formatDate), true);
	$('#endDate').editable('setValue', moment(endDate, "YYYY-MM-DD HH:mm").format(formatDate), true);


    //Select2 tags
	$('#tags').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		mode: 'popup',
		value: <?php echo (isset($project["tags"])) ? json_encode(implode(",", $project["tags"])) : "''"; ?>,
		select2: {
			width: 200,
			tags: <?php if(isset($tags)) echo json_encode($tags); else echo json_encode(array())?>,
			tokenSeparators: [","]
		}
	});

	$('#address').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield",
		mode: 'popup',
		success: function(response, newValue) {
			console.log("success update postal Code : "+newValue);
		},
		value : {
        	postalCode: '<?php echo (isset( $project["address"]["postalCode"])) ? $project["address"]["postalCode"] : null; ?>',
        	codeInsee: '<?php echo (isset( $project["address"]["codeInsee"])) ? $project["address"]["codeInsee"] : ""; ?>',
        	addressLocality : '<?php echo (isset( $project["address"]["addressLocality"])) ? $project["address"]["addressLocality"] : ""; ?>'
    	}
	});

	$('#addressCountry').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		value: '<?php echo (isset( $project["address"]["addressCountry"])) ? $project["address"]["addressCountry"] : ""; ?>',
		source: function() {
			return countries;
		},
	});

}

function switchMode() {
	if(mode == "view"){
		mode = "update";
		manageModeContext();
	} else {
		mode ="view";
		manageModeContext();
	}
}

function manageModeContext() {
	listXeditables = ['#description', '#startDate', '#endDate', '#tags', '#address', '#addressCountry'];
	if (mode == "view") {
		$('.editable-project').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			$(value).editable('toggleDisabled');
		})
	} else if (mode == "update") {
		// Add a pk to make the update process available on X-Editable
		$('.editable-project').editable('option', 'pk', projectId);
		$('.editable-project').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			//add primary key to the x-editable field
			$(value).editable('option', 'pk', projectId);
			$(value).editable('toggleDisabled');
		})
	}
}

</script>
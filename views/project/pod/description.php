<?php 
$cssAnsScriptFilesTheme = array(
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css',
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css',
	'/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css',
	'/assets/plugins/x-editable/css/bootstrap-editable.css',
	//X-editable...
	'/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js' , 
	'/assets/plugins/x-editable/js/bootstrap-editable.js' , 
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , 
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , 
	'/assets/plugins/wysihtml5/wysihtml5.js',
	'/assets/plugins/moment/min/moment.min.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js',
	'/js/postalCode.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<style>
progress[value] {
    /* Get rid of the default appearance */
    appearance: none;   
    /* This unfortunately leaves a trail of border behind in Firefox and Opera. We can remove that by setting the border to none. */
    border: none;
    /* Add dimensions */
	width: 100%; height: 20px;
    /* Although firefox doesn't provide any additional pseudo class to style the progress element container, any style applied here works on the container. */
    background-color: whiteSmoke;
    border-radius: 3px;
    box-shadow: 0 2px 3px rgba(0,0,0,.5) inset;
    /* Of all IE, only IE10 supports progress element that too partially. It only allows to change the background-color of the progress value using the 'color' attribute. */
    color: royalblue;
    position: relative;
}
/*
Webkit browsers provide two pseudo classes that can be use to style HTML5 progress element.
-webkit-progress-bar -> To style the progress element container
-webkit-progress-value -> To style the progress element value.
*/

progress[value]::-webkit-progress-bar {
    background-color: whiteSmoke;
    border-radius: 3px;
    box-shadow: 0 2px 3px rgba(0,0,0,.5) inset;
}

progress[value]::-webkit-progress-value {
    position: relative;
    
    background-size: 35px 20px, 100% 100%, 100% 100%;
    border-radius:3px;
    
    /* Let's animate this */
    animation: animate-stripes 5s linear infinite;
}

@keyframes animate-stripes { 100% { background-position: -100px 0; } }

/* Firefox provides a single pseudo class to style the progress element value and not for container. -moz-progress-bar */
progress[value]::-moz-progress-bar {
    /* Gradient background with Stripes */
    background-image:
    -moz-linear-gradient( 135deg,
	    transparent,
	    transparent 33%,
	    rgba(0,0,0,.1) 33%,
	    rgba(0,0,0,.1) 66%,
	    transparent 66%),
    -moz-linear-gradient( top,
        rgba(255, 255, 255, .25),
        rgba(0,0,0,.2)),
    -moz-linear-gradient( left, #09c, #f44);    
    background-size: 35px 20px, 100% 100%, 100% 100%;
    border-radius:3px;
    /* Firefox doesn't support CSS3 keyframe animations on progress element. Hence, we did not include animate-stripes in this code block */
}

.progressStyle::-webkit-progress-value
{
    /* Gradient background with Stripes */
    background-image:
    -webkit-linear-gradient( 135deg,
        transparent,
	    transparent 33%,
	    rgba(0,0,0,.1) 33%,
	    rgba(0,0,0,.1) 66%,
	    transparent 66%),
    -webkit-linear-gradient( top,
        rgba(255, 255, 255, .25),
        rgba(0,0,0,.2)),
    -webkit-linear-gradient( left, #09c, #ff0);
}
</style>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><span><i class="fa fa-info fa-2x text-blue"></i> <?php echo Yii::t("project","PROJECT INFORMATIONS",null,Yii::app()->controller->module->id) ?></span></h4>
	</div>
	<div class="panel-tools">
		<?php 
			if ($isAdmin){ ?>
		<a href="#" id="editProjectDetail" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Editer le projet" alt=""><i class="fa fa-pencil"></i></a>
		<?php } ?>
	</div>
	<div class="panel-body no-padding">
			<table class="table table-condensed table-hover" >
				<tbody>
					<tr>
						<td><?php echo Yii::t("common","Name") ?></td>
						<td><a href="#" id="name" data-type="text" data-original-title="<?php echo Yii::t("project","Enter the project's name",null,Yii::app()->controller->module->id) ?>" class="editable-project editable editable-click"><?php if(isset($project["name"]))echo $project["name"];?></a></td>
					</tr>
					<tr>
						<td>Description</td>
						<td><a href="#" id="description" data-type="wysihtml5" data-original-title="<?php echo Yii::t("project","Enter the project's description",null,Yii::app()->controller->module->id) ?>" class="editable editable-click"></a></td>
					</tr>
					<tr>
						<td><?php echo Yii::t("project","Maturity",null,Yii::app()->controller->module->id) ?></td>
						<td>
							<a href="#" id="avancement" data-type="select" data-title="avancement" data-original-title="<?php echo Yii::t("project","Enter the project's maturity",null,Yii::app()->controller->module->id) ?>" class="editable editable-click">
							<?php if(isset($project["properties"]["avancement"])){ 
								//idea => concept => Started => development => testing => mature
									if($project["properties"]["avancement"]=="idea")
										$val=5;
									else if($project["properties"]["avancement"]=="concept")
										$val=20;
									else if ($project["properties"]["avancement"]== "started")
										$val=40;
									else if ($project["properties"]["avancement"] == "development")
										$val=60;
									else if ($project["properties"]["avancement"] == "testing")
										$val=80;
									else 
										$val=100;
									echo Yii::t("project",$project["properties"]["avancement"],null,Yii::app()->controller->module->id);
							} ?>
							</a>
							<?php if(isset($project["properties"]["avancement"])){ ?>
							<progress max="100" value="<?php echo $val;?>" class="progressStyle">
							</progress>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td><?php echo Yii::t("common","Start") ?></td>
						<td><a href="#" id="startDate" data-type="date" data-original-title="<?php echo Yii::t("project","Enter the project's start",null,Yii::app()->controller->module->id) ?>" class="editable editable-click"></a></td>
					</tr>
					<tr>
						<td><?php echo Yii::t("common","End") ?></td>
						<td><a href="#" id="endDate" data-type="date" data-original-title="<?php echo Yii::t("project","Enter the project's end",null,Yii::app()->controller->module->id) ?>" class="editable editable-click"></a></td>
					</tr>
					<tr>
						<td>Tags</td>
						<td><a href="#" id="tags" data-type="select2" data-type="Tags" data-emptytext="Tags" class="editable editable-click"></td>
					</tr>
					<tr>
						<td><?php echo Yii::t("common","Postal Code") ?></td>
						<td><a href="#" id="address" data-type="postalCode" data-title="Postal Code" data-emptytext="Postal Code" class="editable editable-click" data-placement="bottom"></a></td>
					</tr>
					<tr>
						<td><?php echo Yii::t("common","Country") ?></td>
						<td><a href="#" id="addressCountry" data-type="select" data-title="Country" data-emptytext="Country" data-original-title="" class="editable editable-click"></a></td>
					</tr>
					<tr>
						<td>Licence</td>
						<td><a href="#" id="licence" data-type="text" data-original-title="<?php echo Yii::t("project","Enter the project's licence",null,Yii::app()->controller->module->id) ?>" class="editable-project editable editable-click"><?php if(isset($project["licence"])) echo $project["licence"];?></a></td>
					</tr>
					<tr>
						<td>URL</td>
						<td><a href="#" id="url" data-type="text" data-original-title="<?php echo Yii::t("project","Enter the project's url",null,Yii::app()->controller->module->id) ?>" class="editable-project editable editable-click"><?php if(isset($project["url"])) echo $project["url"];?></a></td>
					</tr>
					
				</tbody>
			</table>
	</div>
</div>
<script type="text/javascript">
var projectData = <?php echo json_encode($project)?>;
var mode = "update";
var projectId= "<?php echo (string) $project["_id"]; ?>";
var countries = <?php echo json_encode($countries); ?>;
var startDate = '<?php if(isset($project["startDate"])) echo $project["startDate"]; else echo ""; ?>';
var endDate = '<?php if(isset($project["endDate"])) echo $project["endDate"]; else echo "" ?>';


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
	$.fn.editable.defaults.mode = 'popup';
	$('.editable-project').editable({
    	url: baseUrl+"/"+moduleId+"/project/updatefield", //this url will not be used for creating new job, it is only for update
    	//value : <?php echo (isset($project["name"]))?json_encode($project["name"]) : "''";?> ,
    	//onblur: 'submit',
    	showbuttons: false,
    	success : function(data) {
	        if(data.result) {
	        	toastr.success(data.msg);
				console.log(data);
	        }
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
		},
		success : function(data) {
			if(data.result) 
				toastr.success(data.msg);
			else 
				return data.msg;
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
    	},
    	success : function(data) {
			if(data.result) 
				toastr.success(data.msg);
			else 
				return data.msg;
	    }
	});

	$('#addressCountry').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		value: '<?php echo (isset( $project["address"]["addressCountry"])) ? $project["address"]["addressCountry"] : ""; ?>',
		source: function() {
			return countries;
		},
		success : function(data) {
			if(data.result) 
				toastr.success(data.msg);
			else 
				return data.msg;
	    }
	});
	$('#avancement').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		source: function() {
			//idea => concept => Started => development => testing => mature
			avancement=["idea","concept","started","development","testing","mature"];
			return avancement;
		},
		success : function(data) {
			if(data.result) {
				toastr.success(data.msg);
				if(data.avancement=="idea")
					val=5;
				else if(data.avancement=="concept")
					val=20;
				else if (data.avancement== "started")
					val=40;
				else if (data.avancement == "development")
					val=60;
				else if(data.avancement == "testing")
					val=80;
				else
					val=100;
				$('.progressStyle').val(val);
			}
			else 
				return data.msg;
	    }
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
	listXeditables = ['#description', '#startDate', '#endDate', '#tags', '#address', '#addressCountry','#avancement'];
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
			//alert(listXeditables[i]);
			$(value).editable('option', 'pk', projectId);
			$(value).editable('toggleDisabled');
		})
	}
}

</script>
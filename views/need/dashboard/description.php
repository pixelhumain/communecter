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
		<h4 class="panel-title"><span><i class="fa fa-info fa-2x text-blue"></i> <?php echo Yii::t("need","NEED DESCRIPTION",null,Yii::app()->controller->module->id); ?></span></h4>
		<div class="navigator padding-0 text-right">
			<div class="panel-tools">
				<?php 
					$edit = false;
					if(isset(Yii::app()->session["userId"]) && isset($_GET["id"]))
						$edit = Authorisation::canEditItem(Yii::app()->session["userId"], $_GET["type"], (string)$_GET["id"]);
					if($edit){
				?>
				<a href="#" id="editNeedDescription" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Editer la description" alt=""><i class="fa fa-pencil"></i></a>
        		<?php } ?>
			</div>
		</div>
	</div>
	<div class="panel-body padding">
		<a href="#" id="description" data-type="wysihtml5" data-original-title="Enter the need's description" class="editable editable-click"></a>
	</div>
</div>
<script>
	var modeDescription = "update";
	var	needID="<?php echo (string) $id; ?>";
jQuery(document).ready(function() 
{
    bindDescriptionPodneeds();
	initNeedDescriptionXEditable();
	manageNeedDescriptionModeContext();
});



function bindDescriptionPodneeds() {
	$("#editNeedDescription").on("click", function(){
		switchNeedDescriptionMode();
	})
}
function initNeedDescriptionXEditable() {
$('#description').editable({
		url: baseUrl+"/"+moduleId+"/needs/updatefield", 
		value: <?php echo (isset($description) && $description) ? json_encode($description) : "'Courte description du besoin...<br/>Pour qui? quel profil?<br/>Quelles sont les conditions? temps, retribution, etc.?'"; ?>,
		placement: 'hover',
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
}
function switchNeedDescriptionMode() {
	if(modeDescription == "view"){
		modeDescription = "update";
		manageNeedDescriptionModeContext();
	} else {
		modeDescription ="view";
		manageNeedDescriptionModeContext();
	}
}

function manageNeedDescriptionModeContext() {
	listDescriptionXeditables = ['#description',''];
	if (modeDescription == "view") {
//		$('.editable-need').editable('toggleDisabled');
		$.each(listDescriptionXeditables, function(i,value) {
			$(value).editable('toggleDisabled');
		})
	} else if (modeDescription == "update") {
		// Add a pk to make the update process available on X-Editable
//		$('.editable-need').editable('option', 'pk', needId);
//		$('.editable-need').editable('toggleDisabled');
		$.each(listDescriptionXeditables, function(i,value) {
			//add primary key to the x-editable field
			$(value).editable('option', 'pk', needID);
			$(value).editable('toggleDisabled');
		})
	}
}

</script>
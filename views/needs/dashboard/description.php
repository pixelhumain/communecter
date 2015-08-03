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
		<h4 class="panel-title"><span><i class="fa fa-info fa-2x text-blue"></i> NEED Description</span></h4>
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
		<a href="#" id="description" data-type="wysihtml5" data-original-title="Enter the need's description" class="editable editable-click">Sed cautela nimia in peiores haeserat plagas, ut narrabimus postea, aemulis consarcinantibus insidias graves apud Constantium, cetera medium principem sed siquid auribus eius huius modi quivis infudisset ignotus, acerbum et inplacabilem et in hoc causarum titulo dissimilem sui.

Vbi curarum abiectis ponderibus aliis tamquam nodum et codicem difficillimum Caesarem convellere nisu valido cogitabat, eique deliberanti cum proximis clandestinis conloquiis et nocturnis qua vi, quibusve commentis id fieret, antequam effundendis rebus pertinacius incumberet confidentia, acciri mollioribus scriptis per simulationem tractatus publici nimis urgentis eundem placuerat Gallum, ut auxilio destitutus sine ullo interiret obstaculo.</a>
	</div>
</div>
<script>
	var mode = "update";
	var	needId="";
jQuery(document).ready(function() 
{
    bindDescriptionPodneeds();
	initDescriptionXEditable();
	manageDescriptionModeContext();
});



function bindDescriptionPodneeds() {
	$("#editNeedDescription").on("click", function(){
		switchDescrMode();
	})
}
function initDescriptionXEditable() {
$('#description').editable({
		url: baseUrl+"/"+moduleId+"/needs/updatefield", 
		value: <?php echo (isset($need["description"])) ? json_encode($need["description"]) : "''"; ?>,
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
function switchDescrMode() {
	if(mode == "view"){
		mode = "update";
		manageDescriptionModeContext();
	} else {
		mode ="view";
		manageDescriptionModeContext();
	}
}

function manageDescriptionModeContext() {
	listXeditables = ['#description'];
	if (mode == "view") {
//		$('.editable-need').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			$(value).editable('toggleDisabled');
		})
	} else if (mode == "update") {
		// Add a pk to make the update process available on X-Editable
//		$('.editable-need').editable('option', 'pk', needId);
//		$('.editable-need').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			//add primary key to the x-editable field
			$(value).editable('option', 'pk', needId);
			$(value).editable('toggleDisabled');
		})
	}
}

</script>
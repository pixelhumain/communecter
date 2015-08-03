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
		<h4 class="panel-title"><span><i class="fa fa-info fa-2x text-blue"></i> NEED INFORMATION</span></h4>
		<div class="navigator padding-0 text-right">
			<div class="panel-tools">
				<?php 
					$edit = false;
					if(isset(Yii::app()->session["userId"]) && isset($_GET["id"]))
						$edit = Authorisation::canEditItem(Yii::app()->session["userId"], $_GET["type"], (string)$_GET["id"]);
					if($edit){
				?>
				<a href="#" id="editNeedDetail" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Editer le besoin" alt=""><i class="fa fa-pencil"></i></a>
        		<?php } ?>
			</div>
		</div>
	</div>
	<div class="panel-body no-padding">
			<table class="table table-condensed table-hover" >
				<tbody>
					<tr>
						<td>Name</td>
						<td><a href="#" id="name" data-type="text" data-original-title="Enter the need's name" class="editable-need editable editable-click"></a><?php if(isset($need["name"]))echo $need["name"];?></td>
					</tr>
					<tr>
						<td>Type</td>
						<td><a href="#" id="type" data-type="text" data-original-title="Enter the need's name" class="editable-need editable editable-click"></a><?php if(isset($need["type"]))echo $need["type"];?></td>
					</tr>
					<tr>
						<td>Duration</td>
						<td><a href="#" id="category" data-type="text" data-original-title="Enter the need's name" class="editable-need editable editable-click"></a><?php if(isset($need["duration"]))echo $need["duration"];?></td>
					</tr>
					<!--<tr>
						<td>Description</td>
						<td><a href="#" id="description" data-type="wysihtml5" data-original-title="Enter the need's description" class="editable editable-click"></a></td>
					</tr>-->
					<?php if ($need["duration"]== "ponctuel"){ ?>
					<tr>
						<td>Début</td>
						<td><a href="#" id="startDate" data-type="date" data-original-title="Enter the need's start" class="editable editable-click"></a><?php if(isset($need["startDate"]))echo $need["startDate"];?></td>
					</tr>
					<tr>
						<td>Fin</td>
						<td><a href="#" id="endDate" data-type="date" data-original-title="Enter the need's end" class="editable editable-click"></a><?php if(isset($need["endDate"]))echo $need["endDate"];?></td>
					</tr>
					<?php } ?>
					<tr>
						<td>Quantité</td>
						<td><a href="#" id="quantity" data-type="text" data-original-title="Enter the need's name" class="editable-need editable editable-click"></a><?php if(isset($need["quantity"]))echo $need["quantity"];?></td>
					</tr>
					
					
					<tr>
						<td>Benefits</td>
						<td><a href="#" id="benefits" data-type="text" data-original-title="Enter the need's name" class="editable-need editable editable-click"></a><?php if(isset($need["benefits"]))echo $need["benefits"];?></td>
					</tr>
				</tbody>
			</table>
	</div>
</div>
<script type="text/javascript">
/*var needData = ;*/
var needId="";
var mode = "update";
//var startDate = '<?php ?>';
//var endDate = '<?php ?>';


jQuery(document).ready(function() 
{
    bindAboutPodneeds();
	initXEditable();
	manageModeContext();
});



function bindAboutPodneeds() {
	$("#editNeedDetail").on("click", function(){
		switchMode();
	})
}

function initXEditable() {
	$.fn.editable.defaults.mode = 'inline';
	$('.editable-need').editable({
    	url: baseUrl+"/"+moduleId+"/needs/updatefield", //this url will not be used for creating new job, it is only for update
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

	/*$('#description').editable({
		url: baseUrl+"/"+moduleId+"/needs/updatefield", 
		value: <?php echo (isset($need["description"])) ? json_encode($need["description"]) : "''"; ?>,
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
	});*/

	$('#startDate').editable({
		url: baseUrl+"/"+moduleId+"/needs/updatefield", 
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
		url: baseUrl+"/"+moduleId+"/needs/updatefield", 
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
	listXeditables = ['#startDate', '#endDate',"#quantity","#type","#category","#benefits"];
	if (mode == "view") {
		$('.editable-need').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			$(value).editable('toggleDisabled');
		})
	} else if (mode == "update") {
		// Add a pk to make the update process available on X-Editable
		$('.editable-need').editable('option', 'pk', needId);
		$('.editable-need').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			//add primary key to the x-editable field
			$(value).editable('option', 'pk', needId);
			$(value).editable('toggleDisabled');
		})
	}
}

</script>
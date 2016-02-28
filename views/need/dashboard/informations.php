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
		<h4 class="panel-title"><span><i class="fa fa-info fa-2x text-blue"></i> <?php echo Yii::t("need","NEED INFORMATIONS",null,Yii::app()->controller->module->id); ?></span></h4>
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
						<td><?php echo Yii::t("common","Name") ?></td>
						<td><a href="#" id="name" data-type="text" data-original-title="Enter the need's name" class="editable-need editable editable-click"><?php if(isset($need["name"]))echo $need["name"];?></a></td>
					</tr>
					<tr>
						<td>Type</td>
						<td><a href="#" id="type" data-type="select" data-original-title="Enter the need's name" class="editable editable-click"><?php if(isset($need["type"]))echo $need["type"];?></a></td>
					</tr>
					<tr>
						<td><?php echo Yii::t("common","Duration") ?></td>
						<td><a href="#" id="duration" data-type="select" data-original-title="Enter the need's name" class="editable editable-click"><?php if(isset($need["duration"]))echo $need["duration"];?></a></td>
					</tr>
					<!--<tr>
						<td>Description</td>
						<td><a href="#" id="description" data-type="wysihtml5" data-original-title="Enter the need's description" class="editable editable-click"></a></td>
					</tr>-->
					
					<tr class="durationDate <?php if ($need["duration"]== "Permanent") echo "hide"; ?>">
						<td><?php echo Yii::t("common","Start") ?></td>
						<td><a href="#" id="startDate" data-type="date" data-original-title="Enter the need's start" class="editable editable-click"></a></td>
					</tr>
					<tr class="durationDate <?php if ($need["duration"]== "Permanent") echo "hide"; ?>">
						<td><?php echo Yii::t("common","End") ?></td>
						<td><a href="#" id="endDate" data-type="date" data-original-title="Enter the need's end" class="editable editable-click"></a></td>
					</tr>
					<tr>
						<td><?php echo Yii::t("need","Quantity",null,Yii::app()->controller->module->id); ?></td>
						<td><a href="#" id="quantity" data-type="number" data-original-title="Enter the need's name" class="editable-need editable editable-click"><?php if(isset($need["quantity"]))echo $need["quantity"];?></a></td>
					</tr>
					
					
					<tr>
						<td><?php echo Yii::t("need","Benefits",null,Yii::app()->controller->module->id); ?></td>
						<td><a href="#" id="benefits" data-type="select" data-original-title="Enter the need's name" class="editable editable-click"><?php if(isset($need["benefits"]))echo $need["benefits"];?></a></td>
					</tr>
				</tbody>
			</table>
	</div>
</div>
<script type="text/javascript">
/*var needData = ;*/
var needID="<?php echo $_GET["idNeed"]; ?>";
var mode = "update";
var startDate = '<?php if(isset($need["startDate"])) echo $need["startDate"]; else echo ""; ?>';
var endDate = '<?php if(isset($need["endDate"])) echo $need["endDate"]; else echo ""; ?>';
console.log(startDate+" / "+endDate);
jQuery(document).ready(function() 
{
    bindAboutPodneeds();
	initNeedXEditable();
	manageNeedModeContext();
});



function bindAboutPodneeds() {
	$("#editNeedDetail").on("click", function(){
		switchNeedMode();
	})
}

function initNeedXEditable() {
	$.fn.editable.defaults.mode = 'popup';
	$('.editable-need').editable({
    	url: baseUrl+"/"+moduleId+"/needs/updatefield", //this url will not be used for creating new job, it is only for update
    	onblur: 'submit',
    	showbuttons: false,
    	success : function(data) {
	        if(data.result) 
	        	toastr.success(data.msg);
	        else
	        	toastr.error(data.msg);  
	     console.log(data);
	    }
	});
    //make jobTitle required
	$('#name').editable('option', 'validate', function(v) {
    	if(!v) return 'Required field!';
	});
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
				toastr.error(data.msg);
	    }
    });
    var formatDate = "YYYY-MM-DD";
    $('#startDate').editable('setValue', moment(startDate, "YYYY-MM-DD HH:mm").format(formatDate), true);
	$('#endDate').editable('setValue', moment(endDate, "YYYY-MM-DD HH:mm").format(formatDate), true);

	$('#type').editable({
			url: baseUrl+"/"+moduleId+"/needs/updatefield", 
			//mode: 'popup',
			source:function() {
				listType=["Materials","Competences","Services"];
				return listType;
			},
			success : function(data) {
	        if(data.result) 
	        	toastr.success(data.msg);
	        else 
				return data.msg;
	    }
	});
	$('#benefits').editable({
			url: baseUrl+"/"+moduleId+"/needs/updatefield", 
			//mode: 'popup',
			source:function() {
				listBenefits=["Remunéré","Volontaire"];
				return listBenefits;
			},
			success : function(data) {
	        if(data.result) 
	        	toastr.success(data.msg);
	        else 
				return data.msg;
	    }
	});
	$('#duration').editable({
			url: baseUrl+"/"+moduleId+"/needs/updatefield", 
			//mode: 'popup',
			source:function() {
				listBenefits=["Ponctuel","Permanent"];
				return listBenefits;
			},
			success : function(data) {
		        if(data.result) {
		        	toastr.success(data.msg);
		        	if(data.duration=="Permanent"){
			        	$(".durationDate").addClass("hide");
		        	}
		        	else{
			        	$(".durationDate").removeClass("hide");
		        	}
		        } else { 
					return data.msg;
				}
				console.log(data);
	    	}
	});

    //Select2 tags
}

function switchNeedMode() {
	if(mode == "view"){
		mode = "update";
		manageNeedModeContext();
	} else {
		mode ="view";
		manageNeedModeContext();
	}
}

function manageNeedModeContext() {
	listNeedInfoXeditables = ['#startDate','#endDate',"#type","#duration","#benefits"];
	if (mode == "view") {
		$('.editable-need').editable('toggleDisabled');
		$.each(listNeedInfoXeditables, function(i,value) {
			$(value).editable('toggleDisabled');
		})
	} else if (mode == "update") {
		console.log(needID);
		// Add a pk to make the update process available on X-Editable
		$('.editable-need').editable('option', 'pk', needID);
		$('.editable-need').editable('toggleDisabled');
		$.each(listNeedInfoXeditables, function(i,value) {
			//add primary key to the x-editable field
			$(value).editable('option', 'pk', needID);
			$(value).editable('toggleDisabled');
		})
	}
}

</script>
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
	'/assets/plugins/moment/min/moment.min.js',
	'/assets/plugins/Chart.js/Chart.min.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js',
	'/js/postalCode.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
$cssAnsScriptFilesModuleSS = array(
	'/plugins/Chart.js/Chart.min.js',
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModuleSS,Yii::app()->theme->baseUrl."/assets");
?>

<style>
	.panel-title{
	font-weight: 200;
	font-size: 21px;
	font-family: "homestead";
}
.entityTitle{
      background-color: #FFF; /*#EFEFEF; /*#2A3A45;*/
      margin-bottom: 10px;
      border-radius: 0px 0px 4px 4px;
      margin-top: -10px;
      font-weight: 200;
    }
    .entityTitle h2{
    	font-size: 30px;
    	font-weight: 200;
      	margin:0px !important;
      	text-align: left;
    }
    .entityDetails span{
      font-weight: 300;
      font-size:15px;

    }
    .entityDetails{
      padding-bottom:10px;
      margin-bottom:10px;
      border-bottom:0px solid #DDD;
      font-size: 15px;
	  font-weight: 300;
    }
    .entityDetails.bottom{
      /*border-top:1px solid #DDD;*/
      border-bottom:0px solid #DDD;
      padding: 5px;
      margin-top: 10px;
      margin-bottom: -13px;
    }
    .entityDetails i.fa-tag{
      margin-left:10px;
    }
    .entityDetails i.fa{
      margin-right:7px;
      font-size: 17px;
		margin-top: 5px;
    }
    .panel-title{
    	font-weight: 200;
    	font-size: 21px;
    	font-family: "homestead";
    }
    #fileuploadContainer{
    	z-index:0 !important;
    }
    .tag_group{
    	font-size:14px;
    	font-weight: 300;
    }
    .info-coordonnees{
    	/*background-color: rgb(239, 239, 239);*/
    }
    .lbl-info-details{
    	font-weight: 600;
	    border-bottom: 1px solid lightgray;
	    padding-bottom: 7px;
	    margin-bottom: 5px;
	    width:100%;
	    float:left;
	}
	#fileuploadContainer{
		margin:inherit !important;
	}
</style>
<div class="panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title text-dark"> 
			<i class="fa fa-info-circle"></i> Infos générales		</h4>
	</div>
	<div class="panel-tools" style="">
				<?php if ($isAdmin){ ?>
					<a href="javascript:;" id="editNeedDetail" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Editer le besoin" alt=""><i class="fa fa-pencil"></i> Éditer le besoin</a>
        		<?php } ?>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6 col-xs-12">
				
				<?php
					if($parentType=="projects"){ 
						$icon="fa-lightbulb-o";
						$urlType = "project";
					} else if($parentType=="organizations"){
						$icon="fa-users";
						$urlType = "organization";
					} else {
						 	$icon="fa-user";
					}
					$color = "";
					if($icon == "fa-users") $color = "green";
					if($icon == "fa-user") $color = "yellow";
					if($icon == "fa-lightbulb-o") $color = "purple";
				?> 
				<div class="text-dark" style="margin-top:10px !important;">
					<div class="entityTitle">
						<h2 style="font-weight:100; font-size:19px;">
							<i class="fa fa-angle-right"></i> 
							<?php echo Yii::t("common","Émis par ") ?> 
							<span><?php if (@$parentType=="organizations") 
											echo Yii::t("common", "the ".$parent["type"]); 
										else
											echo Yii::t("common", "the ".$urlType);
								?>
							<a href="javascript:;" onclick="loadByHash('#<?php echo $urlType ?>.detail.id.<?php echo $parentId; ?>')" class="text-<?php echo $color ?>"><?php echo $parent["name"]; ?></a> 
						</h2>					
					</div>
				</div>
				<?php
				$this->renderPartial('../pod/fileupload', 
						array("itemId" => $parentId,
							  "type" => $parentType,
							  "resize" => false,
							  "contentId" => Document::IMG_PROFIL,
							  "editMode" => false,
							  "image" => $imagesD)); 
				?>
			</div>
			<div class="col-md-6">
				<div class="text-dark" style="margin-top:10px !important;">
					<div class="entityTitle">
							<h2 style="font-weight:100; font-size:19px;">
								<i class="fa fa-angle-right"></i> 
								<a href="javascript:;" id="type" data-type="select" data-original-title="Enter the need's name" class="editable editable-click"><?php if(isset($need["type"]))echo $need["type"];?></a> , <a href="javascript:;" id="duration" data-type="select" data-original-title="Choose duration of need" class="editable editable-click"><?php if(isset($need["duration"]))echo $need["duration"];?></a>
							</h2>
							<h2><!-- <span> - </span> -->
								<a href="javascript:;" id="name" data-type="text" data-original-title="Enter the need's name" class="editable-need editable editable-click"><?php if(isset($need["name"]))echo $need["name"];?></a>
							</h2>						
					</div>
					<div class="durationDate <?php if ($need["duration"]== "Permanent") echo "hide"; ?>">
						<i class="fa fa-calendar"></i> 
							De <a href="#" id="startDate" data-type="date" data-original-title="Enter the need's start" class="editable editable-click"></a>
						<label id="labelTo">Au</label> <a href="#" id="endDate" data-type="date" data-original-title="Enter the need's end" class="editable editable-click"></a>
					</div>
					<div class="col-md-6 no-padding">
						<label class="control-label text-dark">
	    	        		<i class="fa fa-angle-down"></i> <?php echo Yii::t("need","Quantity",null,Yii::app()->controller->module->id); ?>
						</label><br>
						<a href="#" id="quantity" data-type="number" data-original-title="Enter the need's name" class="editable-need editable editable-click"><?php if(isset($need["quantity"]))echo $need["quantity"];?></a>
					</div>
					<div class="col-md-6 no-padding">
						<label class="control-label text-dark">
	    	        		<i class="fa fa-angle-down"></i> <?php echo Yii::t("need","Benefits",null,Yii::app()->controller->module->id); ?>
						</label><br>
						<a href="#" id="benefits" data-type="select" data-original-title="Enter the need's name" class="editable editable-click"><?php if(isset($need["benefits"]))echo $need["benefits"];?></a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 padding-10">
			<div class="text-dark lbl-info-details"><i class="fa fa-angle-down"></i> Description</div>
			<a href="#" id="description" data-type="wysihtml5" data-original-title="<?php echo Yii::t("need","Enter the need's description",null,Yii::app()->controller->module->id) ?>" class="editable editable-click"></a>	
		</div>
	</div>
	
<script type="text/javascript">
var needID="<?php echo $need["_id"]; ?>";
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
    	url: baseUrl+"/"+moduleId+"/need/updatefield", //this url will not be used for creating new job, it is only for update
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
		url: baseUrl+"/"+moduleId+"/need/updatefield", 
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
		url: baseUrl+"/"+moduleId+"/need/updatefield", 
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
			url: baseUrl+"/"+moduleId+"/need/updatefield", 
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
			url: baseUrl+"/"+moduleId+"/need/updatefield", 
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
			url: baseUrl+"/"+moduleId+"/need/updatefield", 
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
	$('#description').editable({
		url: baseUrl+"/"+moduleId+"/need/updatefield", 
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
	listNeedInfoXeditables = ['#startDate','#endDate',"#type","#duration","#benefits","#description"];
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
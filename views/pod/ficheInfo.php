<?php 
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/x-editable/css/bootstrap-editable.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '//assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '//assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css');

	//X-editable...
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/x-editable/js/bootstrap-editable.js' , CClientScript::POS_END, array(), 2);

	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , CClientScript::POS_END, array(), 2);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , CClientScript::POS_END, array(), 2);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/wysihtml5.js' , CClientScript::POS_END, array(), 2);

	//Data helper
	$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END, array(), 2);
?>
<style>
#divImgEdit{
	display: none;
}

</style>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"> <?php echo (isset($context)) ? $context["name"] : null; ?></h4>
		<div class="panel-tools">
			<?php if (isset($context["_id"]) && isset(Yii::app()->session["userId"])
				 && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $context["_id"])) { ?>
					<a href="#" id="editFicheInfo" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Editer vos informations" alt=""><i class="fa fa-pencil"></i></a>
			<?php } ?>
			<div class="dropdown">
				<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
					<i class="fa fa-cog"></i>
				</a>
				<ul class="dropdown-menu dropdown-light pull-right" role="menu">
					<li>
						<a class="panel-refresh" href="#">
							<i class="fa fa-refresh"></i> <span>Refresh</span>
						</a>
					</li>
					<li>
						<a class="panel-expand" href="#">
							<i class="fa fa-expand"></i> <span>Fullscreen</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="panel-body border-light">
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<?php 
					if(!isset($images["banniere"])){
						$images["banniere"] = "";
					}
					$this->renderPartial('../pod/fileupload', array("itemId" => (string)$context["_id"],
																	  "type" => Organization::COLLECTION,
																	  "contentKey" => Organization::COLLECTION.".dashboard.banniere",
																	  "contentId" =>"banniere",
																	  "imagePath" => $images["banniere"],
																	  "editMode" => Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], (String) $context["_id"]))); ?>

			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row height-155 padding-20">
					<a href="#" id="streetAddress" data-type="text" data-title="Street Address" data-original-title="" class="editable-context editable editable-click">
						<?php echo (isset( $context["address"]["streetAddress"])) ? $context["address"]["streetAddress"] : null; ?>
					</a>
					<br>
					<a href="#" id="postalCode" data-type="text" data-title="Postal Code" data-original-title="" class=" editable editable-click">
						 <?php echo (isset( $context["address"]["postalCode"])) ? $context["address"]["postalCode"] : null; ?>
					</a>
					<a href="#" id="addressLocality" data-type="select" data-title="Locality" data-original-title="" class="editable editable-click">
					</a>
					<br>
					<a href="#" id="addressCountry" data-type="select" data-title="Country" data-original-title="" class="editable editable-click">					
					</a>
					<br>
					<a href="#" id="tel" data-type="text" data-title="Phone" data-original-title="" class="editable-context editable editable-click">
						<?php echo (isset($context["tel"])) ? $context["tel"] : null; ?>
					</a>
					<br>
					<a href="#" id="email" data-type="text" data-title="Email" data-original-title="" class="editable-context editable editable-click">
						<?php echo (isset($context["email"])) ? $context["email"] : null; ?>
					</a>
					<br>
					<a href="#" id="url" data-type="text" data-title="Web Site URL" data-original-title="" class="editable-context editable editable-click">
						<?php echo (isset($context["url"])) ? $context["url"] : null; ?>
					</a>
				</div>
				<div class="row height-155 padding-20" style="background-color:#E6E6E6">
					<a href="#" id="shortDescription" data-type="wysihtml5" data-title="Short Description" data-original-title="" class="editable-context editable editable-click">
						<?php echo (isset($context["shortDescription"])) ? $context["shortDescription"] : null; ?>
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-xs-12 padding-20">
				<a href="#" id="description" data-title="Description" data-type="wysihtml5" data-original-title="" class="editable-context editable editable-click">
					<?php echo (isset($context["description"])) ? $context["description"] : null; ?>
				</a>
			</div>
		</div>
		<div class="row" style="background-color:#E6E6E6">
			<div class="col-sm-6 col-xs-6">
				<h1> Activités</h1>
			</div>
			<div class="col-sm-6 col-xs-6">
				<h1> Thématiques</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<a href="#" id="typeIntervention" data-title="Types d'intervention" data-type="checklist" data-original-title="" class="editable editable-click">
				</a>
			</div>
			<div class="col-sm-6 col-xs-6">
				<a href="#" id="tags" data-type="select2" data-type="Tags" data-original-title="" class="editable editable-click">
					
				</a>
			</div>
		</div>
		<div class="row" style="background-color:#E6E6E6">
			<div class="col-sm-6 col-xs-6">
				<h1> Public</h1>
			</div>
			<div class="col-sm-6 col-xs-6">
				<h1> Telechargement</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<a href="#" id="typeOfPublic" data-title="Public" data-type="checklist" data-original-title="" class="editable editable-click">
				</a>
			</div>
			<div class="col-sm-6 col-xs-6">
				<a href="#">Plaquette de presentation</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var contextData = <?php echo json_encode($context)?>;
	var contextId = "<?php echo isset($context["_id"]) ? $context["_id"] : ""; ?>";
	//By default : view mode
	//TODO SBAR - Get the mode from the request ?
	var mode = "view";
	var newPostalCode = (contextData.address && contextData.address.postalCode) ? contextData.address.postalCode : "";
	
	var countries;
	var cities;
	var publics;

	jQuery(document).ready(function() {
		//Select ajax loading
		countries = getCountries("select");
		cities = getCitiesByPostalCode(newPostalCode, "select");
		publics = getPublics("select");

		$("#editFicheInfo").on("click", function(){
			switchMode();
		})
		activateEditableContext();
		manageModeContext();
		debugMap.push(contextData);

		$('#avatar').change(function() {
		  $('#photoAddEdit').submit();
		});

		$("#photoAddEdit").on('submit',(function(e) {
			e.preventDefault();
			$.ajax({
				url: baseUrl+"/"+moduleId+"/api/saveUserImages/type/organizations/id/"+contextId,
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false, 
				processData: false,
				success: function(data){
					if(data.result)
						toastr.success(data.msg);
						if(typeof(data.imagePath)!="undefined"){
							$("#imgView").attr("src", data.imagePath);
						}
					else
						toastr.error(data.msg);
			  },
			});
		}));
	});

	function manageModeContext() {
		if (mode == "view") {
			$('.editable-context').editable('toggleDisabled');
			$('#tags').editable('toggleDisabled');
			$('#addressCountry').editable('toggleDisabled');
			$('#addressLocality').editable('toggleDisabled');
			$('#postalCode').editable('toggleDisabled');
			$('#typeIntervention').editable('toggleDisabled');
			$('#typeOfPublic').editable('toggleDisabled');
			$("#editFicheInfo").removeClass("fa-search").addClass("fa-pencil");
		} else if (mode == "update") {
			// Add a pk to make the update process available on X-Editable
			$('.editable-context').editable('option', 'pk', contextId);
			$('#postalCode').editable('option', 'pk', contextId);
			$('#addressLocality').editable('option', 'pk', contextId);
			$('#addressCountry').editable('option', 'pk', contextId);
			$('#tags').editable('option', 'pk', contextId);
			$('#typeIntervention').editable('option', 'pk', contextId);
			$('#typeOfPublic').editable('option', 'pk', contextId);
			
			$('.editable-context').editable('toggleDisabled');
			$('#postalCode').editable('toggleDisabled');
			$('#addressLocality').editable('toggleDisabled');
			$('#addressCountry').editable('toggleDisabled');
			$('#tags').editable('toggleDisabled');
			$('#typeIntervention').editable('toggleDisabled');
			$('#typeOfPublic').editable('toggleDisabled');
			$("#editFicheInfo").removeClass("fa-pencil").addClass("fa-search");
		}
	}

	function activateEditableContext() {
		var emptytext = "Editez";
		$.fn.editable.defaults.mode = 'popup';

		$('.editable-context').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield",
			emptytext : emptytext,
			title : $(this).data("title"),
			onblur: 'submit',
			showbuttons: false
		});
		
		//Select2 tags
		$('#tags').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			mode: 'popup',
			showbuttons: false,
			emptytext: emptytext,
			value: <?php echo (isset($context["tags"])) ? json_encode(implode(",", $context["tags"])) : "''"; ?>,
			select2: {
				width: 200,
				tags: <?php if(isset($tags)) echo json_encode($tags); else echo json_encode(array())?>,
				tokenSeparators: [",", " "]
			}
		});

		$('#typeIntervention').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			mode: 'popup',
			//showbuttons: false,
			emptytext: emptytext,
			value: <?php echo (isset($context["typeIntervention"])) ? json_encode(implode(",", $context["typeIntervention"])) : "''"; ?>,
			source: function() {
				var result = new Array();
				$.ajax({
					url: baseUrl+'/'+moduleId+"/datalist/getlistbyname/name/typeIntervention",
					type: 'post',
					global: false,
					async: false,
					dataType: 'json',
					success: function(data) {
						console.log("Data list :"+data.list)
						$.each(data.list, function(i,value) {
							result.push({"value" : value, "text" : value}) ;
						})
					}
				});
				return result;
			},
		});

		$('#addressCountry').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			value: '<?php echo (isset( $context["address"]["addressCountry"])) ? $context["address"]["addressCountry"] : ""; ?>',
			source: function() {
				return getCountries("select");
			},
			emptytext: emptytext,
			showbuttons: false,
		});

		$('#addressLocality').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			value: '<?php echo (isset( $context["address"]["addressLocality"])) ? $context["address"]["addressLocality"] : ""; ?>',
			source: function() {
				return getCitiesByPostalCode(newPostalCode, "select");
			},
			emptytext: emptytext,
			showbuttons: false,
		});

		$('#postalCode').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			mode: 'popup',
			showbuttons: false,
			emptytext: emptytext,
			success: function(response, newValue) {
				console.log("success update postal Code : "+newValue);
				newPostalCode = newValue;
			}
		});

		$('#typeOfPublic').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			value: <?php echo (isset($context["typeOfPublic"])) ? json_encode(implode(",", $context["typeOfPublic"])) : "''"; ?>,
			source: publics,
			emptytext: emptytext,
			showbuttons: true,
			placement: 'right'
		});

		//Validation Rules
		//Mandotory field
		$('#streetAddress #addressCountry #addressLocality').editable('option', 'validate', function(v) {
			var intRegex = /^\d+$/;
			if (!v)
				return 'Field is required !';
		});
		//Postal Code must filled, be numeric and 5 characters length 
		$('#postalCode').editable('option', 'validate', function(v) {
			var intRegex = /^\d+$/;
			if (!v)
				return 'Postal code is required !';
			if (!intRegex.test(v) || v.length != 5) 
				return 'Postal code must be numeric!';
			if (v.length != 5) 
				return 'Postal code must be 5c length!';
		});

	} 

	function switchMode() {
		if(mode == "view"){
			mode = "update";
			manageModeContext();
			$("#divImgView").css("display", "none");
			$("#divImgEdit").css("display", "block");
		}else{
			mode ="view";
			manageModeContext();
			$("#divImgView").css("display", "block");
			$("#divImgEdit").css("display", "none");
		}
	}

</script>
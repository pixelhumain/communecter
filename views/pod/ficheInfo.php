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
?>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"> <?php echo (isset($context)) ? $context["name"] : null; ?></h4>
		 <ul class="panel-heading-tabs border-light">
        	<li>
        		<?php if((isset($context["_id"]) && isset(Yii::app()->session["userId"]) && (string)$context["_id"] == Yii::app()->session["userId"])  || (isset($context["_id"]) && isset(Yii::app()->session["userId"]) && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $context["_id"]))) { ?>
					<a href="#" id="editFicheInfo" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Editer vos informations" alt=""><i class="fa fa-pencil fa-2x"></i></a>
				<?php } ?>
        	</li>
	        <li class="panel-tools">
	        </li>
	    </ul>
	</div>
	<div class="panel-body border-light">
		<div class="row">
			<div class="col-sm-6 col-xs-6">
					<img id="check" width="100%" src="<?php echo (isset($context["imagePath"])) ? $context["imagePath"] : null; ?>" />
			</div>
			<div class="col-sm-6 col-xs-6">
				<a href="#" id="street" data-type="text" data-original-title="" class="editable-context editable editable-click">
					<span><i class="fa fa-home"></i> <?php echo (isset( $context["address"]["streetAddress"])) ? $context["address"]["streetAddress"] : null; ?></span>
				</a>
				<br>
				<a href="#" id="postalCode" data-type="text" data-original-title="" class="editable-context editable editable-click">
					<span><i class="fa fa-home"></i> <?php echo (isset( $context["address"]["postalCode"])) ? $context["address"]["postalCode"] : null; ?>  <?php echo (isset( $context["address"]["addressCountry"])) ? $context["address"]["addressCountry"] : null; ?></span>
				</a>
				<br>
				<a href="#" id="tel" data-type="text" data-original-title="" class="editable-context editable editable-click">
					<span>Tél : </span>
				</a>
				<br>
				<a href="#" id="mail" data-type="text" data-original-title="" class="editable-context editable editable-click">
					<span><?php echo (isset($context["email"])) ? $context["email"] : null; ?></span>
				</a>
				<br>
				<a href="#" id="url" data-type="text" data-original-title="" class="editable-context editable editable-click">
					<span> <?php echo (isset($context["url"])) ? $context["url"] : null; ?></span>
				</a>
			</div>
		</div>
		<div class="row">
			<a href="#" id="description" data-type="textarea" data-original-title="" class="editable-context editable editable-click">
				<span> <?php echo (isset($context["description"])) ? $context["description"] : null; ?></span>
			</a>
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
				<a href="#" id="typeIntervention" data-type="select2" data-original-title="" class="editable editable-click">
					<span> <?php echo (isset($context["typeIntervention"])) ? implode(",", $context["typeIntervention"]) : null; ?></span>
				</a>
			</div>
			<div class="col-sm-6 col-xs-6">
				<a href="#" id="tags" data-type="select2" data-original-title="" class="editable editable-click">
					<span> <?php echo (isset($context["tags"])) ? implode(",", $context["tags"]) : null; ?></span>
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
				<span>Tous public</span>
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

	jQuery(document).ready(function() {
		$("#editFicheInfo").on("click", function(){
			switchMode();
		})
		activateEditableContext();
		manageModeContext();
		debugMap.push(contextData);
	});

	function manageModeContext() {
		if (mode == "view") {
			$('.editable-context').editable('toggleDisabled');
			$('#tags').editable('toggleDisabled');
			$('#typeIntervention').editable('toggleDisabled');
		} else if (mode == "update") {
			// Add a pk to make the update process available on X-Editable
			$('.editable-context').editable('option', 'pk', contextId);
			$('#tags').editable('option', 'pk', contextId);
			$('#typeIntervention').editable('option', 'pk', contextId);
		}
	}

	function activateEditableContext() {
		$.fn.editable.defaults.mode = 'inline';
		$('.editable-context').editable({
	    	url: baseUrl+"/"+moduleId+"/organization/updatefield", //this url will not be used for creating new job, it is only for update
	    	onblur: 'submit',
	    	showbuttons: false
		});
	    //make jobTitle required
		$('#name').editable('option', 'validate', function(v) {
	    	if(!v) return 'Required field!';
		});

		//Select2 tags
	    $('#tags').editable({
	        url: baseUrl+"/"+moduleId+"/organization/updatefield", //this url will not be used for creating new user, it is only for update
	        mode: 'inline',
	        showbuttons: false,
	        select2: {
	            tags: <?php if(isset($context["tags"])) echo json_encode($context["tags"]); else echo json_encode(array())?>,
	            tokenSeparators: [",", " "]
	        }
    	});
    	$('#typeIntervention').editable({
	        url: baseUrl+"/"+moduleId+"/organization/updatefield", //this url will not be used for creating new user, it is only for update
	        mode: 'inline',
	        showbuttons: false,
	        select2: {
	            typeIntervention: <?php if(isset($context["typeIntervention"])) echo json_encode($context["typeIntervention"]); else echo json_encode(array())?>,
	            tokenSeparators: [",", " "]
	        }
    	});
    } 

    function switchMode() {
    	if(mode == "view"){
    		mode = "update";
    	}else{
    		mode ="view";
    	}
    	manageModeContext();
    }

</script>
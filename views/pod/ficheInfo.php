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
<style>
#divImgEdit{
	display: none;
}
</style>
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
				<div id="divImgView">
					<img id="imgView" width="100%" src="<?php echo (isset($context["imagePath"])) ? $context["imagePath"] : 'http://placehold.it/450x300'; ?>" />
				</div>
				<div id="divImgEdit">
					<form  method="post" id="photoAddEdit" enctype="multipart/form-data">
						<div class="fileupload fileupload-new" data-provides="fileupload">
							<div class="fileupload-new thumbnail">
								<img src="<?php //if ($person && isset($person["imagePath"])) echo $person["imagePath"]; else echo Yii::app()->theme->baseUrl.'/assets/images/avatar-1-xl.jpg'; ?>" alt="">	
							</div>
							<div class="fileupload-preview fileupload-exists thumbnail"></div><br>
							<div class="user-edit-image-buttons">
								<span class="btn btn-azure btn-file"><span class="fileupload-new"><i class="fa fa-picture"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture"></i> Change</span>
									<input type="file" accept=".gif, .jpg, .png" name="avatar" id="avatar">
								</span>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-sm-6 col-xs-6">
				<a href="#" id="address.streetAddress" data-type="text" data-title="streetAddress" data-original-title="" class="editable-context editable editable-click">
					<?php echo (isset( $context["address"]["streetAddress"])) ? $context["address"]["streetAddress"] : null; ?>
				</a>
				<br>
				<a href="#" id="address.postalCode" data-type="text" data-title="codePostal" data-original-title="" class="editable-context editable editable-click">
					 <?php echo (isset( $context["address"]["postalCode"])) ? $context["address"]["postalCode"] : null; ?>
				</a>
				<a href="#" id="address.addressCountry" data-type="text" data-title="Localité" data-original-title="" class="editable-context editable editable-click">
				 	<?php echo (isset( $context["address"]["addressCountry"])) ? $context["address"]["addressCountry"] : null; ?>
				 </a>
				<br>
				<a href="#" id="tel" data-type="text" data-title="Télephone" data-original-title="" class="editable-context editable editable-click">
					<?php echo (isset($context["tel"])) ? $context["tel"] : null; ?>
				</a>
				<br>
				<a href="#" id="email" data-type="text" data-title="Email" data-original-title="" class="editable-context editable editable-click">
					<?php echo (isset($context["email"])) ? $context["email"] : null; ?>
				</a>
				<br>
				<a href="#" id="url" data-type="text" data-title="Url" data-original-title="" class="editable-context editable editable-click">
					<?php echo (isset($context["url"])) ? $context["url"] : null; ?>
				</a>
			</div>
		</div>
		<div class="row">
			<a href="#" id="description" data-title="Description" data-type="wysihtml5" data-original-title="" class="editable-context editable editable-click">
				<?php echo (isset($context["description"])) ? $context["description"] : null; ?>
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
				<a href="#" id="typeIntervention" data-title="Types d'intervention" data-type="select2" data-original-title="" class="editable editable-click">
					<?php echo (isset($context["typeIntervention"])) ? implode("\r\n", $context["typeIntervention"]) : null; ?>
				</a>
			</div>
			<div class="col-sm-6 col-xs-6">
				<a href="#" id="tags" data-type="select2" data-type="Tags" data-original-title="" class="editable editable-click">
					<?php echo (isset($context["tags"])) ? implode("\r\n", $context["tags"]) : null; ?>
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
			$('#typeIntervention').editable('toggleDisabled');
		} else if (mode == "update") {
			// Add a pk to make the update process available on X-Editable
			$('.editable-context').editable('option', 'pk', contextId);
			$('#tags').editable('option', 'pk', contextId);
			$('#typeIntervention').editable('option', 'pk', contextId);
		}
	}

	function activateEditableContext() {
		$.fn.editable.defaults.mode = 'popup';
		$('.editable-context').editable({
	    	url: baseUrl+"/"+moduleId+"/organization/updatefield", //this url will not be used for creating new job, it is only for update
	    	emptytext : "Editez",
	    	title : $(this).data("title"),
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
	        mode: 'popup',
	        showbuttons: false,
	        emptytext: "Editez",
	        select2: {
	            tags: <?php if(isset($context["tags"])) echo json_encode($context["tags"]); else echo json_encode(array())?>,
	            tokenSeparators: [",", " "]
	        }
    	});
    	$('#typeIntervention').editable({
	        url: baseUrl+"/"+moduleId+"/organization/updatefield", //this url will not be used for creating new user, it is only for update
	        mode: 'popup',
	        showbuttons: false,
	        emptytext: "Editez",
	        select2: {
	            typeIntervention: <?php if(isset($context["typeIntervention"])) echo json_encode($context["typeIntervention"]); else echo json_encode(array())?>,
	            tokenSeparators: [",", " "]
	        }
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
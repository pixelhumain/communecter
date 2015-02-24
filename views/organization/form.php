<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.css');
//$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/bootstrap/bootstrap-typeahead.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/autosize/jquery.autosize.min.js' , CClientScript::POS_END);
?>
<!-- start: PAGE CONTENT -->
<div class="noteWrap col-md-8 col-md-offset-2">
	<h1>Référencer votre organization</h1>
	<h3>Merci de compléter vos données. </h3>
    
    <p> si vous gérer une ou plusieurs organizations ou etes simplement membre
    <br/>Vous etes au bon endroit pour la valorisé, la diffuser, l'aider à la faire vivre</p>
	
	<form id="organizationForm"  role="form" id="form">
		<div class="row">
			<div class="col-md-12">
				<div class="errorHandler alert alert-danger no-display">
					<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
				</div>
				<div class="successHandler alert alert-success no-display">
					<i class="fa fa-ok"></i> Your form validation is successful!
				</div>
			</div>

			<div class="col-md-6 col-sd-6 ">
				<input id="assoId" type="hidden" name="assoId" value="<?php if($organization)echo (string)$organization['_id']; ?>"/>
				<div class="form-group">
					<label class="control-label">
						Nom (Raison Sociale) <span class="symbol required"></span>
					</label>
					<input id="assoName" class="form-control" name="assoName" value="<?php if($organization && isset($organization['name']) ) echo $organization['name']; else $organization["name"]; ?>"/>
				</div>

				<div class="form-group">
					<label class="control-label">
						Type <span class="symbol required"></span>
					</label>
					<select name="type" id="type" class="form-control" >
						<option value=""></option>
						<?php
						foreach ($types as $key=>$value) 
						{
						?>
						<option value="<?php echo $key?>" <?php if(($organization && isset($organization['type']) && $key == $organization['type']) ) echo "selected"; ?> ><?php echo $key?></option>
						<?php 
						}
						?>
					</select>
				</div>
				
				<div class="form-group">
					<label class="control-label">
						Email <span class="symbol required"></span>
					</label>
					<input id="assoEmail" class="form-control" name="assoEmail" value="<?php if($organization && isset($organization['email']) ) echo $organization['email']; else echo Yii::app()->session['userEmail']; ?>"/>
				</div>

				
				
			</div>
			<div class="col-md-6 col-sd-6 ">
				
				<div class="form-group">
					<label class="control-label">
						Pays <span class="symbol required"></span>
					</label>
					<select name="countryAsso" id="countryAsso" class="form-control">
						<option></option>
						<?php 
						foreach (OpenData::$phCountries as $key => $value) 
						{
						?>
						<option value="<?php echo $key?>" <?php if(($organization && isset($organization['countryAsso']) && $key == $organization['countryAsso']) ) echo "selected"; else if ($key == "Réunion") echo "selected"; ?> ><?php echo $key?></option>
						<?php 
						}
						?>
					</select>
					
				</div>

				<div class="form-group">
					<label class="control-label">
						Code postal <span class="symbol required"></span>
					</label>
					<input id="assoCP" name="assoCP" class="form-control span2" value="<?php if($organization && isset($organization['cp']) )echo $organization['cp'] ?>">
				</div>

				<?php /*?>
				<div class="form-group">
					<label class="control-label">
						Position
					</label>
					<select name="assoPosition" id="assoPosition" class="form-control">
						<?php 
						foreach (Association::$position as $key => $value) 
						{
						?>
						<option value="<?php echo $key?>" <?php if($organization && isset($organization['assoPosition']) && $key == $organization['assoPosition']) echo "selected"; else if ($key == "membre") echo "selected"; ?> ><?php echo $value?></option>
						<?php 
						}
						?>
					</select>
				</div>
				*/?>

				<div class="form-group">
					<label class="control-label">
						Centres d'interet 
					</label>
					
        		    <input id="tagsAsso" type="hidden" value="<?php echo ($organization && isset($organization['tags']) ) ? implode(",", $organization['tags']) : ""?>" style="display: none;">
        		    
				</div>

			</div>
			<div class="col-md-12">
			<div class="form-group">
					<div>
						<label for="form-field-24" class="control-label"> Description <span class="symbol required"></span> </label>
						<textarea  class="form-control" name="description" id="form-field-24" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 60px;"><?php if($organization && isset($organization['description']) ) echo $organization['description']; else $organization["description"]; ?></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			

			<div class="col-md-12">
				<div class="form-group">
					Todo 2 3 etape : file:///X:/X_Dev/playground/bootstrap/templates/rapido_v1.1/rapido/form_wizard.html
					<br/>connect a sub / linked / partner organization
					<br/>invite & connect members
					<br/>check existence 
				</div>
				<hr>
				<div>
					<span class="symbol required"></span>Required Fields
					<hr>
				</div>
			</div>
		</div>
		<button class="btn btn-primary" id="organizationFormSubmit">Enregistrer</button>
	</form>
</div>

<script type="text/javascript">
//very strange BUg this only works when declaring it twice, no idea and no time to loose
$('#tagsAsso').select2({ tags: <?php echo $tags?> });
$('#tagsAsso').select2({ tags: <?php echo $tags?> });

$("textarea.autosize").autosize();

//$('#tagsAsso').tagsInput();
$("#organizationForm").submit( function(event){
	if($('.error').length){
		alert('Veuillez remplir les champs obligatoires.');
	}else{
    	event.preventDefault();
    	$("#organizationForm").modal('hide');
    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/<?php echo $this->module->id?>/organization/save",
    	  data: $("#organizationForm").serialize(),
    	  success: function(data){
    			  $("#flashInfo .modal-body").html(data.msg);
    			  $("#flashInfo").modal('show');
    			  window.location.href = baseUrl+"/<?php echo $this->module->id?>/person?tabId=panel_organisations";
    	  },
    	  dataType: "json"
    	});
	}
});
    
</script>	


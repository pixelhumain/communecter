<?php 
$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css');
//$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/bootstrap/bootstrap-typeahead.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js' , CClientScript::POS_END);
?>
<!-- start: PAGE CONTENT -->
<div class="noteWrap col-md-8 col-md-offset-2">
	<h1>Référencer votre organization</h1>
	<h3> Merci de compléter vos données. </h3>
    
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
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">
						Type <span class="symbol required"></span>
					</label>
					<select name="type" id="type" class="form-control" >
						<option value=""></option>
						<?php
						foreach ($types as $k=>$v) {
							echo '<option value="'.$k.'">'.$v.'</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">
						Nom(Raison Sociale) <span class="symbol required"></span>
					</label>
					<input id="assoName" class="form-control" name="assoName" value="<?php if($asso && isset($asso['name']) ) echo $asso['name']; else $asso["name"]; ?>"/>
				</div>
				<div class="form-group">
					<label class="control-label">
						Email <span class="symbol required"></span>
					</label>
					<input id="assoEmail" class="form-control" name="assoEmail" value="<?php if($asso && isset($asso['email']) ) echo $asso['email']; else $asso["email"]; ?>"/>
				</div>
				<div class="form-group">
					<div>
						<label for="form-field-24" class="control-label"> Description <span class="symbol required"></span> </label>
						<textarea  class="form-control" name="description" id="form-field-24" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 60px;">
							<?php if($asso && isset($asso['description']) ) echo $asso['description']; else $asso["description"]; ?>
						</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">
						Country <span class="symbol required"></span>
					</label>
					<?php 
                     /*$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                        'data' => OpenData::$phCountries, 
                        'name' => 'countryAsso',
                      	'id' => 'countryAsso',
                        'value'=>($asso && isset($asso['country']) ) ? $asso['country'] : "Réunion",
                        'pluginOptions' => array('width' => '150px')
                      ));*/
        		    ?>
				</div>
				<div class="form-group">
					<label class="control-label">
						au code postal <span class="symbol required"></span>
					</label>
					<input id="assoCP" name="assoCP" class="form-control span2" value="<?php if($asso && isset($asso['cp']) )echo $asso['cp'] ?>">
				</div>
			</div>
			<div class="col-md-6">
				
				<div class="form-group">
					<label class="control-label">
						Position
					</label>
					<?php 
                		/*$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                                'data' => Association::$position, 
                                'name' => 'assoPosition',
                              	'id' => 'assoPosition',
                                'value'=>($asso && isset($asso['position']) ) ? $asso['position'] : "membre",
                                'pluginOptions' => array('width' => '150px')
                              ));*/
                		?>
				</div>

				<div class="form-group">
					<label class="control-label">
						Centre d'interet 
					</label>
					
        		    <input id="tagsAsso" class="tags" type="text" value="<?php echo ($asso && isset($asso['tags']) ) ? implode(",", $asso['tags']) : ""?>" style="display: none;">
        		    <div class="tagsinput" id="tagsAsso_tagsinput" style="width: auto; min-height: 100px; height: 100%;">
        		    	<span class="tag"><span>foo&nbsp;&nbsp;</span><a href="#" title="Removing tag">x</a></span>
        		    	<span class="tag"><span>bar&nbsp;&nbsp;</span><a href="#" title="Removing tag">x</a></span>
        		    	<span class="tag"><span>baz&nbsp;&nbsp;</span><a href="#" title="Removing tag">x</a></span>
        		    	<span class="tag"><span>roffle&nbsp;&nbsp;</span><a href="#" title="Removing tag">x</a></span>
        		    	<div id="tagsAsso_addTag"><input data-default="add a tag" value="" id="tagsAsso_tag" style="color: rgb(102, 102, 102); width: 78px;"></div>
        		    	<div class="tags_clear"></div>
        		    </div>
				</div>

				<div class="form-group">
					Todo : 
					<br/>connect a sub organization
					<br/>invite & connect members
				</div>

			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				<div>
					<span class="symbol required"></span>Required Fields
					<hr>
				</div>
			</div>
		</div>
		<button class="btn btn-primary" id="organizationFormSubmit" onclick="$('#organizationForm').submit();">Enregistrer</button>
	</form>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	/*$('#assoName').typeahead({
		  source: {
		    url: baseUrl+'/<?php echo $this->module->id?>/organization/getNames',
		    type: 'get'
		  }
		});*/
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
        			  window.location.href = baseUrl+"/<?php echo $this->module->id?>/organization";
        	  },
        	  dataType: "json"
        	});
    	}
    });
    
});
</script>	



<?php  HtmlHelper::registerCssAndScriptsFiles(array('/js/menus/multitags.js'), $this->module->assetsUrl); ?>

<div class="dropdown pull-left" id="dropdown-content-multi-tag">

  <button class="pull-left"  data-toggle="dropdown"  id="btn-modal-multi-tag"
	data-toggle="tooltip" data-placement="right" 
	title="Mes tags favoris">
	<i class="fa fa-tags text-dark" style="font-size:19px;"></i>
	<span class="tags-count topbar-badge badge animated bounceIn bg-red">0</span>
  </button>
  <ul class="dropdown-menu" id="dropdown-multi-tag">
      <div class="panel-body text-dark padding-bottom-10">
      		<div class="col-md-12 no-padding">
	      		<div class="col-md-12">
	      			<h3 class="no-margin" style="margin-top: 13px ! important;">
	      				<i class="fa fa-angle-down"></i> <i class="fa fa-tag"></i> Mes <strong>#tags</strong> favoris
	      			</h3>
	      			<hr style="margin-top: 10px; margin-bottom: 10px;">
	      			<div class="col-md-9 no-padding">
		      			<div class="input-group margin-bottom-10">
					      <span class="input-group-btn">
					        <div class="input-group-addon" type="button">
					        	<i class="fa fa-plus"></i> <i class="fa fa-tag"></i>
					        </div>
					      </span>
					      <input id="input-add-multi-tag" type="text" class="form-control" placeholder="Ajouter un tag ...">
					      <span class="input-group-btn">
					        <button class="btn btn-success btn-add-tag" type="button"><i class="fa fa-check"></i></button>
					      </span>
					    </div>
				    </div>
				    <div class="col-md-3">
	      				<button class="btnShowAllTag btn btn-default tooltips" onclick="javascript:selectAllTags(true)"
	      						data-toggle="tooltip" data-placement="bottom" 
								title="Sélectionner tout les tags">
		      			<i class="fa fa-check-circle"></i>
			      		</button>
			      		<button class="btnHideAllTag btn btn-default tooltips" onclick="javascript:selectAllTags(false)"
	      						data-toggle="tooltip" data-placement="bottom" 
								title="Sélectionner aucun tag">
			      			<i class="fa fa-circle-o"></i>
			      		</button>
	      			</div>
	      		</div>
	      		<div id="multi-tag-list" class="col-md-12 margin-top-15"></div>
	      		<div class="col-md-12">
		      		<hr style="margin-top: 10px; margin-bottom: 10px;">
		      		<div class="label label-info label-sm block text-left" id="lbl-info-select-multi-tag"></div>
		      		<input id="searchTags" type="hidden" />
	      		</div>	      			
      		</div>    		
      	</div>
   		<div class="panel-body padding-10 visible-empty text-dark">
   			<blockquote>
   				Vos #tags favoris permettent au système de trouver le contenu qui vous intéresse, 
   				<strong>en fonction de vos envies</strong>.
   			</blockquote>
   			<blockquote><strong>Ajoutez, supprimez, activez, désactivez</strong> vos #tag à volonté.</blockquote>
   			<blockquote><strong>Exemple :</strong> #biodiversite #nature #laVieEstBelle #sauverLeMonde</blockquote>
   		</div>
   </ul>
</div>

<?php 
	$multitags = ( empty($me) && isset( Yii::app()->request->cookies['multitags'] ) ) ? 
		   			    	Yii::app()->request->cookies['multitags'] : "{}";	
?>
<script type="text/javascript"> 

var myMultiTags = <?php echo isset($me) && isset($me["multitags"]) ? 
						json_encode($me["multitags"]) : 
						$multitags; 
				    ?>;

if(myMultiTags.length == 0) myMultiTags = {};

var searchTags = "";

jQuery(document).ready(function() {
	$('ul.dropdown-menu').click(function(){ return false });

	$(".btn-add-tag").click(function(){ //console.log("btn-add-tag click()");
		addTagToMultitag( $("#input-add-multi-tag").val() );
	});

	$('#input-add-multi-tag').filter_input({regex:'[^@#\'\"\`\\\\]'}); //[a-zA-Z0-9_]

	loadMultiTags();
	rebuildSearchTagInput();
});

/* SEE MORE IN js/menus/multitags.js */

</script>
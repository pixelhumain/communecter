

<?php  
HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/multiscopes.css') );
HtmlHelper::registerCssAndScriptsFiles(array( '/js/menus/multiscopes.js'), $this->module->assetsUrl);
?>

<div class="dropdown pull-left" id="dropdown-content-multi-scope">
  <button class="pull-left"  data-toggle="dropdown"  id="btn-modal-multi-scope"
	data-toggle="tooltip" data-placement="right" 
	title="Mes lieux favoris">
	<i class="fa fa-bullseye text-dark" style="font-size:19px;"></i>
	<span class="scope-count topbar-badge badge animated bounceIn bg-red">0</span>
  </button>
  <ul class="dropdown-menu" id="dropdown-multi-scope">
      <div class="panel-body text-dark padding-bottom-10">
      		<div class="col-md-12 no-padding">
	      		<div class="col-md-12">
	      			<h3 class="no-margin" style="margin-top: 13px ! important;">
	      				<i class="fa fa-angle-down"></i> <i class="fa fa-bullseye"></i> Mes <strong>lieux</strong> favoris
	      			</h3>
	      			<hr style="margin-top: 10px; margin-bottom: 10px;">
	      			<div class="btn-group  btn-group-justified margin-bottom-10 hidden-xs btn-group-scope-type" role="group">
						<div class="btn-group btn-group-justified">
						  <button type="button" class="btn btn-default tooltips active" data-scope-type="city"
	      						  data-toggle="tooltip" data-placement="top" 
								  title="Ajouter une commune">
						  	<strong><i class="fa fa-bullseye"></i></strong>Commune
						  </button>
						</div>
						<div class="btn-group btn-group-justified">
						  <button type="button" class="btn btn-default tooltips" data-scope-type="cp"
	      						  data-toggle="tooltip" data-placement="top" 
								  title="Ajouter un code postal">
						  	<strong><i class="fa fa-bullseye"></i></strong>Code postal
						  </button>
						</div>
						<div class="btn-group btn-group-justified">
						  <button type="button" class="btn btn-default tooltips" data-scope-type="dep"
	      						  data-toggle="tooltip" data-placement="top" 
								  title="Ajouter un département">
						  	<strong><i class="fa fa-bullseye"></i></strong>Département
						  </button>
						</div>
						<div class="btn-group btn-group-justified">
						  <button type="button" class="btn btn-default tooltips" data-scope-type="region"
	      						  data-toggle="tooltip" data-placement="top" 
								  title="Ajouter une région">
						  	<strong><i class="fa fa-bullseye"></i></strong>Région
						  </button>
						</div>
					</div>
	      			<div class="btn-group  btn-group-justified margin-bottom-10 visible-xs btn-group-scope-type" role="group">
						<div class="btn-group btn-group-justified">
						  <button type="button" class="btn btn-default tooltips active" data-scope-type="city"
	      						  data-toggle="tooltip" data-placement="top" 
								  title="Ajouter une commune">
						  	<strong><i class="fa fa-bullseye"></i></strong>Commune
						  </button>
						</div>
						<div class="btn-group btn-group-justified">
						  <button type="button" class="btn btn-default tooltips" data-scope-type="cp"
	      						  data-toggle="tooltip" data-placement="top" 
								  title="Ajouter un code postal">
						  	<strong><i class="fa fa-bullseye"></i></strong>Code postal
						  </button>
						</div>
					</div>
					<div class="btn-group  btn-group-justified margin-bottom-10 visible-xs btn-group-scope-type" role="group">
						<div class="btn-group btn-group-justified">
						  <button type="button" class="btn btn-default tooltips" data-scope-type="dep"
	      						  data-toggle="tooltip" data-placement="top" 
								  title="Ajouter un département">
						  	<strong><i class="fa fa-bullseye"></i></strong>Département
						  </button>
						</div>
						<div class="btn-group btn-group-justified">
						  <button type="button" class="btn btn-default tooltips" data-scope-type="region"
	      						  data-toggle="tooltip" data-placement="top" 
								  title="Ajouter une région">
						  	<strong><i class="fa fa-bullseye"></i></strong>Région
						  </button>
						</div>
					</div>
	      			<div class="col-md-9 no-padding">
			      		<div class="input-group margin-bottom-10">
					      <span class="input-group-btn">
					        <div class="input-group-addon" type="button">
					        	<i class="fa fa-plus"></i> <i class="fa fa-bullseye"></i>
					        </div>
					      </span>
					      <input id="input-add-multi-scope" type="text" class="form-control" placeholder="Ajouter une commune ...">
					      <div class="dropdown">
							  <ul class="dropdown-menu" id="dropdown-multi-scope-found">
							  </ul>
						  </div>
					     
					    </div>
					</div>
					<div class="col-md-3">
	      				<button class="btnShowAllScope btn btn-default tooltips" onclick="javascript:selectAllScopes(true)"
	      						data-toggle="tooltip" data-placement="bottom" 
								title="Sélectionner tout les lieux">
		      			<i class="fa fa-check-circle"></i>
			      		</button>
			      		<button class="btnHideAllScope btn btn-default tooltips" onclick="javascript:selectAllScopes(false)"
	      						data-toggle="tooltip" data-placement="bottom" 
								title="Sélectionner aucun lieu">
			      			<i class="fa fa-circle-o"></i>
			      		</button>
	      			</div>
				</div>
	      		<div id="multi-scope-list-city" class="col-md-12 margin-top-15">
	      			<h4><i class="fa fa-angle-down"></i> Communes</h4>
	      			<hr style="margin-top: 10px; margin-bottom: 10px;">
	      		</div>
	      		<div id="multi-scope-list-cp" class="col-md-12 margin-top-15">
	      			<h4><i class="fa fa-angle-down"></i> Codes postaux</h4>
	      			<hr style="margin-top: 10px; margin-bottom: 10px;">
	      		</div>
	      		<div id="multi-scope-list-dep" class="col-md-12 margin-top-15">
	      			<h4><i class="fa fa-angle-down"></i> Départements</h4>
	      			<hr style="margin-top: 10px; margin-bottom: 10px;">
	      		</div>
	      		<div id="multi-scope-list-region" class="col-md-12 margin-top-15">
	      			<h4><i class="fa fa-angle-down"></i> Régions</h4>
	      			<hr style="margin-top: 10px; margin-bottom: 10px;">
	      		</div>
	      		<div class="col-md-12">
		      		<hr style="margin-top: 10px; margin-bottom: 10px;">
		      		<div class="label label-info label-sm block text-left" id="lbl-info-select-multi-scope"></div>
	      		</div>
			</div>   		
      	</div>

   		<div class="panel-body padding-10 visible-empty text-dark">
   			<blockquote>
   				Pour rester en contact permanent avec les zones géographiques qui vous intéressent le plus, définissez votre liste de lieux favoris, en sélectionnant <strong>des communes, des codes postaux, des départements, ou des régions</strong>.
   			</blockquote>
   			<blockquote> <strong>Ajoutez, supprimez, activez, désactivez </strong> vos <i>lieux favoris</i> à volonté.</blockquote>
   			
   			<blockquote>
   				 <strong>Exemple : </strong>Paris, Bordeaux, Toulouse, 17000, 97421, Charente-maritime, Auvergne, etc
   			</blockquote>
   		</div>
   		<div class="panel-body padding-10 text-dark">
   			<?php if(!empty($me) && (!isset($me["address"]["postalCode"]) || $me["address"]["postalCode"] == "" )) { ?>
	   			<blockquote class="text-red msg-scope-co">
   					<strong><i class='fa fa-home'></i> <?php echo Yii::t("common","You are not connected to your city") ; ?> : </strong> <?php echo Yii::t("common","To get quick access to information in your city, to filter and map view local content, please fill your postal code on your profile page.") ; ?><br>
	   				<a href="#person.detail.id.<?php echo Yii::app()->session['userId']; ?>" class="lbh btn btn-sm btn-default margin-top-10"><i class="fa fa-cogs"></i> Paramétrer mon code postal</a>
   				</blockquote>
   			<?php }else if(isset($me["address"]["addressLocality"])){ ?>
   				<blockquote class="text-red msg-scope-co">
   					<a href="#person.detail.id.<?php echo Yii::app()->session['userId']; ?>" 
   					  class="lbh btn btn-sm btn-default"><i class="fa fa-cogs"></i></a> 
   					 <span><i class='fa fa-home'></i> Vous êtes communecté à <?php echo $me["address"]["addressLocality"]; ?></span>
   				</blockquote>
   			<?php } ?>
   			
   		</div>
   		
   </ul>
</div>
<input id="searchLocalityCITYKEY" type="hidden" />
<input id="searchLocalityCODE_POSTAL" type="hidden" />
<input id="searchLocalityDEPARTEMENT" type="hidden" />
<input id="searchLocalityREGION" type="hidden" />

<?php 
	$multiscopes = (empty($me) && isset( Yii::app()->request->cookies['multiscopes'] )) ? 
		   			    	Yii::app()->request->cookies['multiscopes']->value : "{}";	

	//var_dump($multiscopes); echo " cookie : ".Yii::app()->request->cookies['multiscopes'];//return;
?>
<script type="text/javascript"> 

var myMultiScopes = <?php echo isset($me) && isset($me["multiscopes"]) ? 
								json_encode($me["multiscopes"]) :  
								$multiscopes; 
					?>;

if(myMultiScopes.length == 0) myMultiScopes = {};

var currentScopeType = "city";
var timeoutAddScope;

jQuery(document).ready(function() {

	$("#dropdown-multi-scope-found").hide();

	$('ul.dropdown-menu').click(function(){ return false });

	// $(".btn-add-scope").click(function(){
	// 	addScopeToMultiscope($("#input-add-multi-scope").val());
	// });


	$('#dropdown-multi-scope').click(function(){ //console.log("$('#dropdown-multi-scope').click");
		$("#dropdown-multi-scope-found").hide();
	});
	$('#input-add-multi-scope').filter_input({regex:'[^@#\'\"\`\\\\]'}); //[a-zA-Z0-9_] 
	$('#input-add-multi-scope').keyup(function(){ 
		$("#dropdown-multi-scope-found").show();
		if($('#input-add-multi-scope').val()!=""){
			if(typeof timeoutAddScope != "undefined") clearTimeout(timeoutAddScope);
			timeoutAddScope = setTimeout(function(){ autocompleteMultiScope(); }, 500);
		}
	});
	$('#input-add-multi-scope').click(function(){ //console.log("$('#input-add-multi-scope').click");
		if($('#input-add-multi-scope').val()!="")
			setTimeout(function(){$("#dropdown-multi-scope-found").show();}, 500);
	});

	$(".btn-group-scope-type .btn-default").click(function(){
		currentScopeType = $(this).data("scope-type");
		$(".btn-group-scope-type .btn-default").removeClass("active");
		$(this).addClass("active");
		//console.log("change scope type :", currentScopeType);
		if(currentScopeType == "city") $('#input-add-multi-scope').attr("placeholder", "Ajouter une commune ...");
		if(currentScopeType == "cp") $('#input-add-multi-scope').attr("placeholder", "Ajouter un code postal ...");
		if(currentScopeType == "dep") $('#input-add-multi-scope').attr("placeholder", "Ajouter un département ...");
		if(currentScopeType == "region") $('#input-add-multi-scope').attr("placeholder", "Ajouter une région ...");
	});

	$(".toggle-scope-dropdown").click(function(){ //console.log("toogle");
		if(!$("#dropdown-content-multi-scope").hasClass('open'))
		setTimeout(function(){ $("#dropdown-content-multi-scope").addClass('open'); }, 300);
	});

	loadMultiScopes();
	rebuildSearchScopeInput();
});

/* SEE MORE IN js/menus/multiscope.js */

</script>
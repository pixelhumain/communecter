

<style type="text/css">

.btn-group-scope-type .btn-secondary{
	font-size:12px;
	/*border-right: 2px solid rgb(191, 191, 191);*/
}
.btn-group-scope-type .btn-group > .btn:last-child:not(:first-child), 
.btn-group-scope-type .btn-group > .dropdown-toggle:not(:first-child){
	border-right: 0px solid transparent !important;
}
.btn-group-scope-type .btn-secondary:focus{
	background-color: #E33551;
	color:white;
}	
.btn-group-scope-type .btn-secondary.active{
	background-color: #E33551;
	color:white;
}
.scope-count{
	right: 8px;
    position: absolute;
    top: -1px;
}	
#dropdown-multi-scope-found {
	display: block;
	margin-top: 33px;
	width: 100%;
	border-radius: 0px;
	padding: 3px;
}
#dropdown-multi-scope-found.dropdown-menu > li > a {
	padding: 3px 5px;
}
#dropdown-multi-scope-found.dropdown-menu > li > a:hover {
	background-color: #f2d2d2;
}
.city-name-locked{
	font-size:19px;
	margin-top:10px;
}
</style>


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
	      				<button class="btn btn-default tooltips" onclick="javascript:selectAllScopes(true)"
	      						data-toggle="tooltip" data-placement="bottom" 
								title="Sélectionner tout les lieux">
		      			<i class="fa fa-check-circle"></i>
			      		</button>
			      		<button class="btn btn-default tooltips" onclick="javascript:selectAllScopes(false)"
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

var currentScopeType = "city";
var timeoutAddScope;

jQuery(document).ready(function() {

	$("#dropdown-multi-scope-found").hide();

	$('ul.dropdown-menu').click(function(){ return false });

	// $(".btn-add-scope").click(function(){
	// 	addScopeToMultiscope($("#input-add-multi-scope").val());
	// });


	$('#dropdown-multi-scope').click(function(){ console.log("$('#dropdown-multi-scope').click");
		$("#dropdown-multi-scope-found").hide();
	});
	//$('#input-add-multi-scope').filter_input({regex:'[a-zA-Z0-9_]'}); 
	$('#input-add-multi-scope').keyup(function(){ 
		$("#dropdown-multi-scope-found").show();
		if($('#input-add-multi-scope').val()!=""){
			if(typeof timeoutAddScope != "undefined") clearTimeout(timeoutAddScope);
			timeoutAddScope = setTimeout(function(){ autocompleteMultiScope(); }, 500);
		}
	});
	$('#input-add-multi-scope').click(function(){ console.log("$('#input-add-multi-scope').click");
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

	loadMultiScopes();
	rebuildSearchScopeInput();
});


function scopeExists(scopeValue){
	return typeof myMultiScopes[scopeValue] != "undefined";
}

function saveMultiScope(){ //console.log("saveMultiScope() try - userId = ",userId); //console.dir(myMultiScopes);
	
	hideSearchResults();
	if(userId != null && userId != ""){
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/person/updatemultiscope",
	        data: {multiscopes : myMultiScopes},
	       	dataType: "json",
	    	success: function(data){
	    		//console.log("saveMultiScope() success");
	    		
		    },
			error: function(error){
				console.log("Une erreur est survenue pendant l'enregistrement des scopes");
			}
		});
	}else{
		
	}
	showCountScope();
	rebuildSearchScopeInput();
	saveCookieMultiscope();
}
function saveCookieMultiscope(){  console.log("saveCookieMultiscope", myMultiScopes);
	$.cookie('multiscopes',   	JSON.stringify(myMultiScopes),  	{ expires: 365, path: "/" });
	if(location.hash.indexOf("#city.detail")==0)
		loadByHash("#default.live");
}

function autocompleteMultiScope(){
	var scopeValue = $('#input-add-multi-scope').val();
	$("#dropdown-multi-scope-found").html("<li><i class='fa fa-refresh fa-spin'></i></li>");
	$.ajax({
        type: "POST",
        url: baseUrl+"/"+moduleId+"/city/autocompletemultiscope",
        data: {
        		type: currentScopeType, 
        		scopeValue: scopeValue
        },
       	dataType: "json",
    	success: function(data){
    		//console.log("autocompleteMultiScope() success");
    		//console.dir(data);
    		$("#dropdown-multi-scope-found").html("ok");
    		html="";
    		$.each(data.cities, function(key, value){
    			if(currentScopeType == "city") { console.log("in scope city");
    				val = value.country + "_" + value.insee + "-" + value.postalCodes[0].postalCode; 
    				lbl = value.name;
    				lblList = value.name + ", " +value.postalCodes[0].postalCode ;
    			}; 
    			if(currentScopeType == "cp") { 
    				val = value.postalCodes[0].postalCode; 
    				lbl = value.postalCodes[0].postalCode ;
    				lblList = value.name + ", " +value.postalCodes[0].postalCode ;
    			}; 
    			if(currentScopeType == "dep") 	{ val = value; lbl = value; lblList = value; }; 
    			if(currentScopeType == "region"){ val = value; lbl = value; lblList = value; }; 

    			html += "<li><a href='javascript:' onclick='addScopeToMultiscope(\""+val+"\",\""+lbl+"\" )'>"+lblList+"</a></li>";
    		});
    		$("#dropdown-multi-scope-found").html(html);
    		
	    },
		error: function(error){
    		$("#dropdown-multi-scope-found").html("error");
			console.log("Une erreur est survenue pendant autocompleteMultiScope");
		}
	});
}
/**********************************************/
function loadMultiScopes(){
	$.each(myMultiScopes, function(key, value){
		showScopeInMultiscope(key);
	});
	showCountScope();
	saveCookieMultiscope()
}
function showCountScope(){
	var count = 0; 
	var types = new Array("city", "cp", "dep", "region");
	$.each(myMultiScopes, function(key, value){
		if(value.active==true) count++;
		console.log(types.indexOf(value.type), value.type);
		if(types.indexOf(value.type)>-1)
			types.splice(types.indexOf(value.type), 1);
	});
	$.each(types, function(key, value){
		$("#multi-scope-list-"+value).hide();
	});
	$(".scope-count").html(count);
	showTagsScopesMin(".list_tags_scopes");
	showEmptyMsg();
}
function selectAllScopes(select){
	$.each(myMultiScopes, function(key, value){
		 toogleScopeMultiscope(key, select);
	});
	saveMultiScope();
}
function showScopeInMultiscope(scopeValue){ console.log("showScopeInMultiscope()", scopeValue);
	var html = "";
	if(scopeExists(scopeValue)){
		var scope = myMultiScopes[scopeValue];
		if(typeof scope.name == "undefined") scope.name = scopeValue;
		var faActive = (myMultiScopes[scopeValue].active == true) ? "check-circle" : "circle-o";
		var classDisable = (myMultiScopes[scopeValue].active == false) ? "disabled" : "";
		html = 
		'<span class="item-scope-input bg-red item-scope-'+scope.type+' '+classDisable+'" data-scope-value="'+scopeValue+'">' +
				'<a  href="javascript:" class="item-scope-checker tooltips"' +
					'data-toggle="tooltip" data-placement="bottom" ' +
					'title="Activer/Désactiver" data-scope-value="'+scopeValue+'">' +
					'<i class="fa fa-'+faActive+'"></i>' +
				'</a>' +
				'<span class="item-scope-name" >'+scope.name+'</span>' +
				'<a href="javascript:" class="item-scope-deleter tooltips"' +
					'data-toggle="tooltip" data-placement="bottom" ' +
					'title="Supprimer" data-scope-value="'+scopeValue+'">' +
					'<i class="fa fa-times"></i>' +
			'</a>' +
		'</span>';
		$("#multi-scope-list-"+scope.type).append(html);
		$("#multi-scope-list-"+scope.type).show();
		$(".item-scope-checker").off().click(function(){ toogleScopeMultiscope( $(this).data("scope-value")) });
		$(".item-scope-deleter").off().click(function(){ deleteScopeInMultiscope( $(this).data("scope-value")); });
		//showMsgInfoMultiScope("Le scope a bien été ajouté", "success");
	}else{
		html = "";
		//showMsgInfoMultiScope("showScopeInMultiscope error : ce lieu n'existe pas - " + scopeValue, "error");
	}
	
	$(".tooltips").tooltip();
}

//scopeValue est la valeur utilisée pour la recherche
//scopeName est la valeur affichée
function addScopeToMultiscope(scopeValue, scopeName){  
	if(scopeValue == "") return;
	if(!scopeExists(scopeValue)){ console.log("adding", scopeValue);
		myMultiScopes[scopeValue] = { name: scopeName, active: true, type: currentScopeType };
		showScopeInMultiscope(scopeValue);
		$("#input-add-multi-scope").val("");
		saveMultiScope();
	}else{
		showMsgInfoMultiScope("Ce lieu est déjà dans votre liste", "info");
	}
	$("#dropdown-multi-scope-found").hide();
}

function deleteScopeInMultiscope(scopeValue){ //console.log("deleteScopeInMultiscope(scopeValue)", scopeValue);
	if(scopeExists(scopeValue)){
		delete myMultiScopes[scopeValue];
		$("[data-scope-value="+scopeValue+"]").remove();
		saveMultiScope();
	}
	//console.dir(myMultiScopes);
}

function toogleScopeMultiscope(scopeValue, selected){ //console.log("toogleScopeMultiscope(scopeValue)", scopeValue);
	if(scopeExists(scopeValue)){
		myMultiScopes[scopeValue].active = !myMultiScopes[scopeValue].active;
		
		if(typeof selected == "undefined") saveMultiScope();
		else myMultiScopes[scopeValue].active = selected;
		
		if(myMultiScopes[scopeValue].active){
			$("[data-scope-value="+scopeValue+"] .item-scope-checker i.fa").removeClass("fa-circle-o");
			$("[data-scope-value="+scopeValue+"] .item-scope-checker i.fa").addClass("fa-check-circle");
			$("[data-scope-value="+scopeValue+"].item-scope-input").removeClass("disabled");
		}else{
			$("[data-scope-value="+scopeValue+"] .item-scope-checker i.fa").addClass("fa-circle-o");
			$("[data-scope-value="+scopeValue+"] .item-scope-checker i.fa").removeClass("fa-check-circle");
			$("[data-scope-value="+scopeValue+"].item-scope-input").addClass("disabled");
		}
		rebuildSearchScopeInput();
	}else{
		//showMsgInfoMultiScope("Ce scope n'existe pas", "danger");
	}
}

function getMultiScopeList(){ return myMultiScopes; }

var timerMsgMultiscope;
function showMsgInfoMultiScope(msg, type){
	if(type == "success") msg = "<i class='fa fa-check'></i> " + msg;
	if(type == "danger") msg = "<i class='fa fa-times'></i> " + msg;
	if(type == "info") msg = "<i class='fa fa-info-circle'></i> " + msg;
	
	var id = "#lbl-info-select-multi-scope";
	$(id).html(msg);
	if(type == "success") $(id).addClass("label-success"); else $(id).removeClass("label-success");
	if(type == "danger") $(id).addClass("label-danger"); else $(id).removeClass("label-danger");
	if(type == "info") $(id).addClass("label-info"); else $(id).removeClass("label-info");

	$(id).off().hide();
	$(id).show(200);

	if(typeof timerMsgMultiscope != "undefined") clearTimeout(timerMsgMultiscope);
	timerMsgMultiscope = setTimeout(function(){ $(id).off().hide(500)}, 3000);
}

/**********************************************/

function rebuildSearchScopeInput()
{
	/*****************************************************************************************/
	searchLocalityCITYKEYs = "";
	$.each($('.item-scope-city'), function(key, value){
		if(!$(value).hasClass('disabled')){
			key = $(value).data("scope-value");
			searchLocalityCITYKEYs += (searchLocalityCITYKEYs == "") ? key :   ","+key;
		}
	});
	console.log("searchLocalityCITYKEYs",searchLocalityCITYKEYs);
	if( $("#searchLocalityCITYKEY") )
		$("#searchLocalityCITYKEY").val(searchLocalityCITYKEYs);

	/*****************************************************************************************/
	searchLocalityCODE_POSTALs = "";
	$.each($('.item-scope-cp'), function(key, value){
		if(!$(value).hasClass('disabled')){
			key = $(value).data("scope-value");
			searchLocalityCODE_POSTALs += (searchLocalityCODE_POSTALs == "") ? key :   ","+key;
		}
	});
	console.log("searchLocalityCODE_POSTALs",searchLocalityCODE_POSTALs);
	if( $("#searchLocalityCODE_POSTAL") )
		$("#searchLocalityCODE_POSTAL").val(searchLocalityCODE_POSTALs);

	/*****************************************************************************************/
	searchLocalityDEPARTEMENTs = "";
	$.each($('.item-scope-dep'), function(key, value){
		if(!$(value).hasClass('disabled')){
			key = $(value).data("scope-value");
			searchLocalityDEPARTEMENTs += (searchLocalityDEPARTEMENTs == "") ? key :   ","+key;
		}
	});
	console.log("searchLocalityDEPARTEMENTs",searchLocalityDEPARTEMENTs);
	if( $("#searchLocalityDEPARTEMENT") )
		$("#searchLocalityDEPARTEMENT").val(searchLocalityDEPARTEMENTs);

	/*****************************************************************************************/
	searchLocalityREGIONs = "";
	$.each($('.item-scope-region'), function(key, value){
		if(!$(value).hasClass('disabled')){
			key = $(value).data("scope-value");
			searchLocalityREGIONs += (searchLocalityREGIONs == "") ? key :   ","+key;
		}
	});
	console.log("searchLocalityREGIONs",searchLocalityREGIONs);
	if( $("#searchLocalityREGION") )
		$("#searchLocalityREGION").val(searchLocalityREGIONs);

	
	$(".list_tags_scopes").removeClass("tagOnly");
	$(".city-name-locked").html("");
	//if( typeof searchCallback == "function" )
		//searchCallback();
}


function lockScopeOnCityKey(cityKey, cityName){ console.log("lockScopeOnCityKey", cityKey);
	$("#searchLocalityCITYKEY").val(cityKey);
	$("#searchLocalityCODE_POSTAL").val("");
	$("#searchLocalityDEPARTEMENT").val("");
	$("#searchLocalityREGION").val("");
	$(".list_tags_scopes").addClass("tagOnly");

	$(".city-name-locked").html("<i class='fa fa-lock'></i> "+ cityName);
}

</script>
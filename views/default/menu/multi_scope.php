

<style type="text/css">

#btn-group-scope-type .btn-secondary{
	font-size:12px;
	/*border-right: 2px solid rgb(191, 191, 191);*/
}
#btn-group-scope-type .btn-group > .btn:last-child:not(:first-child), 
#btn-group-scope-type .btn-group > .dropdown-toggle:not(:first-child){
	border-right: 0px solid transparent !important;
}
#btn-group-scope-type .btn-secondary:focus{
	background-color: #E33551;
	color:white;
}	
#btn-group-scope-type .btn-secondary.active{
	background-color: #E33551;
	color:white;
}
.scope-count{
	left: 15px;
    position: absolute;
    top: 4px;
}	
</style>


<div class="dropdown pull-left">
  <button class="pull-left tooltips"  data-toggle="dropdown"  id="btn-modal-multi-scope"
	data-toggle="tooltip" data-placement="bottom" 
	title="Mes lieux favoris">
	<i class="fa fa-bullseye" style=""></i>
	<span class="scope-count topbar-badge badge animated bounceIn badge-default">0</span>
  </button>
  <ul class="dropdown-menu" id="dropdown-multi-scope">
      <div class="panel-body text-dark padding-bottom-10">
      		<div class="col-md-12 no-padding">
	      		<div class="col-md-12">
	      			<h3 class="no-margin" style="margin-top: 13px ! important;">
	      				<i class="fa fa-angle-down"></i> <i class="fa fa-bullseye"></i> Mes <strong>lieux</strong> favoris
	      			</h3>
	      			<hr style="margin-top: 10px; margin-bottom: 10px;">
	      			<div class="btn-group  btn-group-justified margin-bottom-10" role="group" id="btn-group-scope-type">
						<div class="btn-group btn-group-justified">
						  <button type="button" class="btn btn-default active" data-scope-type="city">
						  	<strong><i class="fa fa-bullseye"></i></strong>Commune
						  </button>
						</div>
						<div class="btn-group btn-group-justified">
						  <button type="button" class="btn btn-default" data-scope-type="cp">
						  	<strong><i class="fa fa-bullseye"></i></strong>Code postal
						  </button>
						</div>
						<div class="btn-group btn-group-justified">
						  <button type="button" class="btn btn-default" data-scope-type="dep">
						  	<strong><i class="fa fa-bullseye"></i></strong>Département
						  </button>
						</div>
						<div class="btn-group btn-group-justified">
						  <button type="button" class="btn btn-default" data-scope-type="region">
						  	<strong><i class="fa fa-bullseye"></i></strong>Région
						  </button>
						</div>
					</div>
	      			<div class="input-group margin-bottom-10">
				      <span class="input-group-btn">
				        <div class="input-group-addon" type="button">
				        	<i class="fa fa-plus"></i> <i class="fa fa-bullseye"></i>
				        </div>
				      </span>
				      <input id="input-add-multi-scope" type="text" class="form-control" placeholder="Ajouter une commune ...">
				      <span class="input-group-btn">
				        <button class="btn btn-success btn-add-scope" type="button"><i class="fa fa-check"></i></button>
				      </span>
				    </div>
				    <div class="label label-info label-sm block text-left" id="lbl-info-select-multi-scope"></div>
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
      		</div>
      		
      	</div>
   </ul>
</div>


<script type="text/javascript"> 

var myMultiScopes = new Array();
var currentScopeType = "city";

jQuery(document).ready(function() {
	$('ul.dropdown-menu').click(function(){ return false });

	$(".btn-add-scope").click(function(){ console.log("btn-add-scope click()");
		addScopeToMultiscope($("#input-add-multi-scope").val())
	});

	$('#input-add-multi-scope').filter_input({regex:'[a-zA-Z0-9_]'}); 

	$("#btn-group-scope-type .btn-default").click(function(){
		currentScopeType = $(this).data("scope-type");
		$("#btn-group-scope-type .btn-default").removeClass("active");
		$(this).addClass("active");
		console.log("change scope type :", currentScopeType);
		if(currentScopeType == "city") $('#input-add-multi-scope').attr("placeholder", "Ajouter une commune ...");
		if(currentScopeType == "cp") $('#input-add-multi-scope').attr("placeholder", "Ajouter un code postal ...");
		if(currentScopeType == "dep") $('#input-add-multi-scope').attr("placeholder", "Ajouter un département ...");
		if(currentScopeType == "region") $('#input-add-multi-scope').attr("placeholder", "Ajouter une région ...");
	});

	loadMultiScopes();
});

function loadMultiScopes(){
	$.each(myMultiScopes, function(key, value){
		showScopeInMultiscope(key);
	});
}

function showScopeInMultiscope(scopeValue){ console.log("showScopeInMultiscope()", scopeValue);
	var html = "";
	if(myMultiScopes.indexOf(scopeValue) < 0){
		var scope = myMultiScopes[scopeValue];
		html = 
		'<span class="item-scope-input bg-red" data-scope-value="'+scopeValue+'">' +
				'<a  href="javascript:" class="item-scope-checker tooltips"' +
					'data-toggle="tooltip" data-placement="bottom" ' +
					'title="Activer/Désactiver" data-scope-value="'+scopeValue+'">' +
					'<i class="fa fa-check-circle"></i>' +
				'</a>' +
				'<span class="item-scope-name">'+scopeValue+'</span>' +
				'<a href="javascript:" class="item-scope-deleter tooltips"' +
					'data-toggle="tooltip" data-placement="bottom" ' +
					'title="Supprimer" data-scope-value="'+scopeValue+'">' +
					'<i class="fa fa-times"></i>' +
			'</a>' +
		'</span>';
		$("#multi-scope-list-"+scope.type).append(html);
		showMsgInfoMultiScope("Le scope a bien été ajouté", "success");
		$(".item-scope-checker").off().click(function(){ toogleScopeMultiscope( $(this).data("scope-value")) });
		$(".item-scope-deleter").off().click(function(){ deleteScopeInMultiscope( $(this).data("scope-value")); });
	}else{
		html = "";
		showMsgInfoMultiScope("showScopeInMultiscope error : ce lieu n'existe pas - " + scopeValue, "error");
	}
	
	$(".tooltips").tooltip();
	
}


function addScopeToMultiscope(scopeValue){  
	if(scopeValue == "") return;
	if(typeof myMultiScopes[scopeValue] == "undefined"){
		console.log("adding", scopeValue);
		myMultiScopes[scopeValue] = { active: true, type: currentScopeType };
		showScopeInMultiscope(scopeValue);
		$("#input-add-multi-scope").val("");
	}else{
		showMsgInfoMultiScope("Ce lieu est déjà dans votre liste", "info");
	}
}

function deleteScopeInMultiscope(scopeValue){ //console.log("deleteScopeInMultiscope(scopeValue)", scopeValue);
	if(typeof myMultiScopes[scopeValue] != "undefined"){
		delete myMultiScopes[scopeValue];
		$("[data-scope-value="+scopeValue+"]").remove();
	}
	console.dir(myMultiScopes);
}

function toogleScopeMultiscope(scopeValue){ console.log("toogleScopeMultiscope(scopeValue)", scopeValue);
	if(typeof myMultiScopes[scopeValue] != "undefined"){
		myMultiScopes[scopeValue].active = !myMultiScopes[scopeValue].active;
		
		if(myMultiScopes[scopeValue].active){
			$("[data-scope-value="+scopeValue+"] .item-scope-checker i.fa").removeClass("fa-circle-o");
			$("[data-scope-value="+scopeValue+"] .item-scope-checker i.fa").addClass("fa-ckeck-circle");
		}else{
			$("[data-scope-value="+scopeValue+"] .item-scope-checker i.fa").addClass("fa-circle-o");
			$("[data-scope-value="+scopeValue+"] .item-scope-checker i.fa").removeClass("fa-ckeck-circle");
		}
	}else{
		showMsgInfoMultiScope("Ce lieu n'existe pas", "danger");
	}
	console.dir(myMultiScopes);
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
/*function openCommonModal(hash){ console.log("search for modal key :", hash);
	var urls = {
		"organization.addorganizationform": { 
			what: { 
				title: 	"Créer une organisation",
				icon: 	"users",
				desc: 	""
			},
			//url:"organization/addorganizationform",
			id: ""
		},
		"project.projectsv": { 
			what: { 
				title: 	"Créer un projet",
				icon: 	"lightbulb-o",
				desc: 	""
			},
			//url:"project/projectsv",
			id: ""
		},
	};

	if(typeof urls[hash] != "undefined"){ console.log("modal key found");
		var slashHash = hash.replace( /\./g,"/" );
		var url = "/" + moduleId + "/" + slashHash; //urls[hash]["url"];
		getModal(urls[hash]["what"], url); //, urls[hash]["id"])
	}else{
		console.log("modal key not found");
	}
}*/
</script>
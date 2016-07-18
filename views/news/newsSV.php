
<?php
$cssAnsScriptFilesModule = array(
	'/css/news/newsSV.css'	
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>	

<?php
	//var_dump($_GET); 
	//préchargement des contacts pour la modal Scope
	$myContacts = array();
	if(isset(Yii::app()->session['userId']))
		$myContacts = Person::getPersonLinksByPersonId(Yii::app()->session['userId']);
	$getType = (isset($_GET["type"]) && $_GET["type"] != "citoyens") ? $_GET["type"] : "citoyens";
?>
<script type="text/javascript">
var myContacts = <?php echo json_encode($myContacts) ?>;

// console.log("myContacts"); 
// console.dir(myContacts); 
var contactTypes = [	{ name : "people",  		color: "yellow"	, icon:"user"			},
						{ name : "organizations", 	color: "green" 	, icon:"group"			},
						{ name : "projects", 		color: "purple"	, icon:"lightbulb-o"	},
						{ name : "events", 			color: "orange"	, icon:"calendar"		}];

var formDefinition = {
    "jsonSchema" : {
        "title" : "News Form",
        "type" : "object",
        "properties" : {
        	"id" :{
            	"inputType" : "hidden",
            	"value" : "<?php echo (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : Yii::app()->session['userId']; ?>"
            },
            "type" :{
            	"inputType" : "hidden",
            	"value" : "<?php echo (isset($_GET['type'])) ? $getType : 'people'; ?>"
            },
            "name" :{
            	"inputType" : "text",
            	"placeholder" : "<?php echo Yii::t('news','In a few words',null,Yii::app()->controller->module->id) ?> ... ",
            	"rules" : {
						"required" : true
					}
            },
            
            "text" :{
            	"inputType" : "textarea",
            	"placeholder" : "<?php echo Yii::t('news','Details') ?> ",
            	"rules" : {
						"required" : true,
						"maxlength" : 1000
					}
            },
            "tags" :{
	            	"inputType" : "tags",
	            	"placeholder" : "#tags",
	            	"values" : [
	            		"Sport",
                    	"Agricutlture",
                    	"Culture",
                    	"Urbanisme",
	            	]
	            },
	        "date" :{
	        	"icon" : "fa fa-calendar",
            	"inputType" : "date",
            	"placeholder" : "<?php echo Yii::t('common','When') ?> ?",
            },
	        "scope" :{
	            	"inputType" : "scope",
	            	"values" : myContacts,
	            	"contactTypes" : contactTypes
	            },
	        "privateScope" :{
	            	"inputType" : "hidden",
	            	"value" : "true"
	            },
	        /*"latitude" :{
            	"inputType" : "hidden",
            	"value" : "<?php echo (isset($_GET['lat'])) ? $_GET['lat'] : '' ?>"
            },
            "longitude" :{
            	"inputType" : "hidden",
            	"value" : "<?php echo (isset($_GET['lon'])) ? $_GET['lon'] : '' ?>"
            },*/
        }
    },
    "collection" : "organization",
    "key" : "ajaxForm",
};

var dataBind = {
   "#ajaxForm #text" : "text",
   "#ajaxForm #name" : "name",
   "#ajaxForm #tags" : "tags",
   "#ajaxForm #id" 	 : "typeId",
   "#ajaxForm #type" : "type",
   "#ajaxForm #date" : "date",

   "#modal_scope_extern .chk-scope-people" 		: "scope.citoyens",
   "#modal_scope_extern .chk-scope-organizations" : "scope.organizations",
   "#modal_scope_extern .chk-scope-projects" 		: "scope.projects",
   "#modal_scope_extern .chk-scope-events" 		: "scope.events", 
   "#modal_scope_extern #scope-postal-code" 		: "scope.cities",
  /* "#latitude" : "from.latitude",
   "#longitude" : "from.longitude"*/
};
var contextId = "";
var contextType = "";
var contextName = "";
var notSubview = null;
jQuery(document).ready(function() {
	
	//$(".new-news").off().on("click",function() { 
		notSubview = ( $(this).data("notsubview")) ? $(this).data("notsubview") : null ;
		console.log("add news on ",$(this).data('id'),$(this).data('type'),notSubview);
		if( $(this).data('id') )
			contextId = $(this).data('id') ;
		if( $(this).data('type') )
			contextType = $(this).data('type');
		if( $(this).data('name') )
			contextName = " : inform "+contextType+" "+$(this).data('name');
			if( notSubview ) {
				//$(".box-ajaxTitle").html("Share a thought, an idea "+contextName);
				buildDynForm();
				
			} else {
				// $("#ajaxSV").html("<div class='col-sm-8 col-sm-offset-2'>"+
				// 			"<div class='space20'></div>"+
				// 			"<h2 class='radius-10 padding-10 partition-blue text-bold'>Share a thought, an idea "+contextName+" </h2>"+
				// 			"<form id='ajaxForm'></form>"+
				// 			//"<div id='newsFeed'></div>"+
				// 		  "</div>");
		
				// $.subview({
				// 	content : "#ajaxSV",
				// 	onShow : function() 
				// 	{
				// 		buildDynForm();
				// 		console.dir(form);
				// 	},
				// 	onHide : function() {
				// 		$("#ajaxSV").html('');
				// 		$.hideSubview();
				// 	},
				// 	onSave: function() {
				// 		$("#ajaxForm").submit();
				// 	}
				// });
			}

			//$("#formCreateNewsTemp button#btn-submit-form").html("Publier <i class='fa fa-arrow-circle-right'></i>");
		//});
});

function openSubview () { 
	$.subview({
		content : "#formCreateNewsTemp",
		onShow : function() 
		{
			buildDynForm();
			console.dir(form);
		},
		onHide : function() {
			$("#formCreateNewsTemp").html('');
			//$.hideSubview();
		},
		onSave: function() {
			$("#ajaxForm").submit();
		}
	});
}

function buildDynForm(){ 
	var form = $.dynForm({
		formId : "#ajaxForm",
		formObj : formDefinition,
		onLoad : function  () {
			if( contextId )
				$("#ajaxForm #id").val( contextId );
			if( contextType )
				$("#ajaxForm #type").val( contextType );

			bindEventScopeModal();
			
			//hide form partially
			//Fetch and show latest msgs
			/*if( contextType && contextId )
				getAjax(".newsFeed", baseUrl+"/"+moduleId+"/news/latest/type/"+contextType+"/id/<?php if(isset($_GET["id"]))echo $_GET["id"];?>/count/15", function(){}, "html");*/
		},
		onSave : function(){
			console.log("saving News!!");
			var params = {};
			$.each(dataBind,function(field,dest){
				console.log("dataBind 1 ",field,$(field).val());
				if(field != "" )
				{
					console.log("dataBind 2",field);
					var value = "";

					/*TAGS*/
					if(dest == "tags"){
						value = $(field).val().split(",");
					}
					/*SCOPE*/
					else if(dest.search(new RegExp("scope", "i")) >= 0){
						if(dest == "scope.cities"){
							value = $(field).val().split(" ");
							if(typeof value[0] != "undefined" && value[0] == "") 
								value = new Array();
							if($("#ajaxForm #chk-my-city").prop("checked")){ 
								var myCp = "98800";
								value.push(myCp);
							}
						}else{
							value = new Array();
							$.each($(field),function(key,element){
								if($(element).prop("checked")){
									value.push($(element).val());
								}
							});
							//si le scope est privé (my wall) 
							if($("#privateScope").val() == "true"){
								console.log("scopePrivate", $(".typehidden input#type").val(), dest);
								//et qu'on est sur le même type que le type du receveur (people, orga, project, ou event)
								if(dest == "scope."+$("input[name='type']").val() ||
									(dest == "scope.citoyens" && $("input[name='type']").val() == "people")){
									//on ajoute la valeur a la liste
									value.push($(".idhidden input#id").val());
								}
							}
						}
					} 
					/*OTHERS*/
					else if( $(field) && $(field).val() && $(field).val() != "" ){
						value = $(field).val();
					}

					if( value != "" ){
						console.log("dataBind 3 ",field,dest,value);
						jsonHelper.setValueByPath( params, dest, value );
					} 
				}
				else
					console.log("save Error",field);
			});
			params.id = '<?php echo Yii::app()->session['userId']; ?>';
			//console.dir(params);
			$.ajax({
	    	  type: "POST",
	    	  url: baseUrl+"/<?php echo $this->module->id?>/news/save",
	    	  data: params,
	    	  dataType: "json"
	    	}).done( function(data){
					console.log(data);
	    		if(data.result)
	    		{
	    			if(countEntries == 0){
	    				showAjaxPanel( '/news/index/type/<?php echo (isset($_GET['type'])) ? $_GET['type'] : 'citoyens' ?>/id/<?php echo (isset($_GET['id'])) ? $_GET['id'] : Yii::app()->session['userId'] ?>', 'KESS KISS PASS ','rss' )
					}
					else {
		    			if( 'undefined' != typeof updateNews && typeof updateNews == "function" ){	
		            		updateNews(data.object);
		            	}else {
		            		showAjaxPanel( '/news/index/type/<?php echo (isset($_GET['type'])) ? $_GET['type'] : 'citoyens' ?>/id/<?php echo (isset($_GET['id'])) ? $_GET['id'] : Yii::app()->session['userId'] ?>/streamType/news', 'KESS KISS PASS ','rss' )
		            	}
					}
					//console.dir(data);
					$.unblockUI();
					//$("#ajaxSV").html('');
					//$.hideSubview();
					toastr.success('Saved successfully!');
					//$("#ajaxForm").reset();
	    		}
	    		else 
	    		{
	    			$.unblockUI();
					toastr.error('Something went wrong!');
	    		}
	    	} );

			return false;
		}
	});
}

function showScope(){ 
	if( $("input#public").prop('checked') != true )
	$(".form-create-news-container #s2id_scope.select2ScopeInput").show("fast");
	else $(".form-create-news-container #s2id_scope.select2ScopeInput").hide("fast");
}

function bindEventScopeModal(){
	/* initialisation des fonctionnalités de la modale SCOPE */
	//parcourt tous les types de contacts
	$.each(contactTypes, function(key, type){ //console.log("BINDEVENT CONTACTTYPES : " + type.name);
		//initialise le scoll automatique de la liste de contact
		$("#btn-scroll-type-"+type.name).click(function(){
			//console.log("click btn scroll type : "+type.name+ " " + $("#scroll-type-"+type.name).position().top);
			$('#list-scroll-type').animate({
	         scrollTop: $('#list-scroll-type').scrollTop() + $("#scroll-type-"+type.name).position().top 
	         }, 400);
		});
		//initialisation des boutons pour selectionner toutes les checkbox d'un type de contact
		$("#chk-all-type"+type.name).click(function(){
			$(".chk-scope-"+type.name).prop("checked", $(this).prop('checked'));
		});
	});
	//initialise la selection d'une checkbox contact au click sur le bouton qui lui correspond
	$(".btn-chk-contact").click(function(){
		var id = $(this).attr("idcontact");
		$("#chk-scope-"+id).prop("checked", !$("#chk-scope-"+id).prop('checked'));
	});


	//initialise l'affichage du champ "code postal" de l'item "OTHER CITIES"
	$("#btn-scroll-type-my-city").click(function(){
		$("#chk-my-city").prop("checked", !$("#chk-my-city").prop('checked'));
	});
	
	//initialise l'affichage du champ "code postal" de l'item "OTHER CITIES"
	$("#btn-show-other-cities").mouseover(function(){
		$("#scope-postal-code").show();
	});
	//initialise l'affichage du champ "code postal" de l'item "OTHER CITIES"
	$("#btn-show-other-cities").click(function(){
		$("#scope-postal-code").show();
		$("#chk-cities").prop("checked", !$("#chk-cities").prop('checked'));
	});
	//initialise l'affichage du champ "code postal" de l'item "OTHER CITIES"
	$("#btn-show-other-cities").mouseout(function(){
		$("#scope-postal-code").hide();
	});

	//initialise la selection de la checkbox "other cities"
	$("#btn-scroll-type-cities").click(function(){
		$("#chk-cities").prop("checked", !$("#chk-cities").prop('checked'));
	});
	//initialise la selection de la checkbox "other cities" quand le champs text "other cities" n'est pas vide 
	$("#scope-postal-code").keyup(function(){
		$("#chk-cities").prop("checked", ($("#scope-postal-code").val() != ""));
	});
	//par defaut, marsque le champ txt "other cities"
	$("#scope-postal-code").hide();

	$("#search-contact").keyup(function(){
		filterContact($(this).val());
	});

	$("#btn-cancel").click(function(){
		showStateScope("cancel");
	});
	$("#btn-save").click(function(){
		showStateScope("save");
	});
	$("#btn-reset-scope").click(function(){
		$.each($('.modal input:checkbox'), function(){
			$(this).prop("checked", false);
		});
		$("#scope-postal-code").val("");
	});
	$("#scope-my-wall").click(function(){
		showStateScope("cancel");
	});
	$("#scope-select").click(function(){
		showStateScope("save");
	});

}

function filterContact(searchVal){
	//masque/affiche tous les contacts présents dans la liste
	if(searchVal != "")	$(".btn-select-contact").hide();
	else				$(".btn-select-contact").show();
	//recherche la valeur recherché dans les 3 champs "name", "cp", et "city"
	$.each($(".scope-name-contact"), function() { checkSearch($(this), searchVal); });
	$.each($(".scope-cp-contact"), 	 function()	{ checkSearch($(this), searchVal); });
	$.each($(".scope-city-contact"), function() { checkSearch($(this), searchVal); });
}

//si l'élément contient la searchVal, on l'affiche
function checkSearch(thisElement, searchVal, type){
	var content = thisElement.html();
	var found = content.search(new RegExp(searchVal, "i"));
	if(found >= 0){
		var id = thisElement.attr("idcontact");
		$("#contact"+id).show();
	}
}

//modifie le contenu du bouton "Send To >"
function showStateScope(action){ //action == "cancel" || "save"
	if(action == "save"){
		//verifie qu'au moins une checkbox est selectionné
		var empty = true;
		$.each($('.modal #list-scroll-type input:checkbox'), function(){
			if($(this).prop("checked") == true) empty = false;
		});
		$.each($('.modal .select-population input:checkbox'), function(){
			if($(this).prop("checked") == true) empty = false;
		});
		//si aucune checkbox n'est selectionné, on simule l'action "cancel"
		if(empty) { showStateScope("cancel"); return; }

		$("#privateScope").val("false");
		var btnSelected = $("#scope-select").html() + " <i class='fa fa-caret-down'></i>";
		$("#btn-toogle-dropdown-scope").html(btnSelected);
	}else
	if(action == "cancel"){
		$("#privateScope").val("true");
		var btnSelected = $("#scope-my-wall").html() + " <i class='fa fa-caret-down'></i>";
		$("#btn-toogle-dropdown-scope").html(btnSelected);
	}
}


var getType = "<?php echo $getType ?>";
var getId 	= "<?php echo (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : Yii::app()->session['userId']; ?>";
var myId 	= "<?php echo Yii::app()->session['userId']; ?>";
var myWall 	= false;
if((getType == "citoyens" || getType == "citoyen") && myId == getId) myWall = true;

//affiche le contenu du formulaire
//masqué par defaut
function showFormBlock(bool){ 
	console.log("my wall ?", myWall);
	console.log("myId", myId, "getType", getType, "getId", getId);
	if(bool){
		$(".form-create-news-container #text").show("fast");
		$(".form-create-news-container .tagstags").show("fast");
		$(".form-create-news-container .datedate").show("fast");
		$(".form-create-news-container .form-actions").show("fast");
		$(".form-create-news-container .publiccheckbox").show("fast");
		if(myWall){ //on ne montre le btn scope que si on est sur my wall
			$(".form-create-news-container .scopescope").show("fast");
		}
	}else{
		$(".form-create-news-container #text").hide();
		$(".form-create-news-container .tagstags").hide();
		$(".form-create-news-container .datedate").hide();
		$(".form-create-news-container .form-actions").hide();
		$(".form-create-news-container #s2id_scope.select2ScopeInput").hide();
		$(".form-create-news-container .publiccheckbox").hide();
		$(".form-create-news-container .scopescope").hide();
	}
}
</script>

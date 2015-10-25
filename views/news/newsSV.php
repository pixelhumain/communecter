

<style type="text/css">
#ajaxForm .form-group{
	margin-bottom: 0px !important;
}
.form-create-news-container{
	background-color:#F2F2F2;
	padding-bottom: 1px !important;
	/*background-image: url("<?php echo $this->module->assetsUrl.'/images/small-crackle-bright.png';?>");*/
	-moz-box-shadow: 0px 0px 5px 1px rgba(200, 200, 200, 0.4);
	-webkit-box-shadow: 0px 0px 5px 1px rgba(200, 200, 200, 0.4);
	-o-box-shadow: 0px 0px 5px 1px rgba(200, 200, 200, 0.4);
	box-shadow: 0px 0px 5px 1px rgba(200, 200, 200, 0.4);
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#C8C8C8, Direction=NaN, Strength=5);
}

#formCreateNewsTemp .form-create-news-container{
	-moz-box-shadow: 0px 0px 5px 1px rgba(200, 200, 200, 0.8);
	-webkit-box-shadow: 0px 0px 5px 1px rgba(200, 200, 200, 0.8);
	-o-box-shadow: 0px 0px 5px 1px rgba(200, 200, 200, 0.8);
	box-shadow: 0px 0px 5px 1px rgba(200, 200, 200, 0.8);
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#C8C8C8, Direction=NaN, Strength=5);
}
.form-create-news-container .form-actions{
	margin:0px !important;
	padding:10px !important;
	height: 55px;
}
.form-create-news-container .alert{
	margin:10px !important;
	padding:5px !important;
}
.form-create-news-container .form-group label.error{
	padding:0px 10px;
}
.header-form-create-news{
	background-color:transparent;
	padding-bottom: 50px !important;
	margin-bottom: -50px !important;
	color:rgba(22, 53, 66, 0.7) !important;
}
.form-create-news-container .select2-input{
	margin:0px !important;
}
.form-group #name{
	margin:3%;
	width:94%;
	border: 1px solid #CBCBCB !important;
	border-radius: 3px !important;
	padding-left: 12px;
	color:#555965;
	/*background-color:rgba(249, 249, 249, 0.8) !important;*/
}
.form-group #text{
	min-width:100%;
	max-width:100%;
	resize: none;
	min-height:150px;
	max-height: 250px;
	border-width: 1px 0px 0px 0px !important;
	border-top-color:#DADADA;
	/*background-color:rgba(249, 249, 249, 0.8) !important;*/
}
.tagstags ul.select2-choices{
	border-radius: 0px;
	border-width: 1px 0px 1px 0px;
	border-style:solid;
	border-bottom-color:#DADADA;
	border-top-color:#DADADA;
	background-color:rgba(249, 249, 249, 0.8) !important;
}
.tagstags .select2-search-field{
	background-color:white;
}
.form-group #date{
	margin-top: 0px;
	width:100%;
	border-width: 0px 0px 1px 0px !important;
	border-color:#DADADA !important;
	font-size: 13px;
}
.datepicker .day{
	cursor: pointer;
}
.datepicker .day.active{
	color:white;
}
.select2-search-field, .select2-input{
	width:100% !important;
	font-size: 14px !important;
}
.select2-search-choice{
	font-size:14px !important;
}
.form-create-news-container #s2id_scope.select2ScopeInput{
	width: 94%;
	display: inline-block;
	margin-left: 3%;
	margin-top: 10px;
	display:none;
}
.select2ScopeInput .select2-container-multi .select2-choices {
    border: 0px !important;
}
.form-create-news-container .publiccheckbox{
	padding: 10px;
	margin-top: 7px;
	width: 60%;
}

.form-create-news-container .scopescope{
	margin-top: 10px;
}
.form-create-news-container .form-actions{
	margin-top: -45px !important;
	
}
.form-create-news-container .dropdown{
	display: inline;
}
.form-create-news-container .dropdown-menu{
	margin-top: 13px;
	margin-left: 5px;
}
.form-create-news-container .dropdown-menu > li > a:hover, 
.form-create-news-container .dropdown-menu > li > a:focus {
    color: #FFF;
    text-decoration: none;
    background-color: rgba(49, 92, 110, 0.83);
}
.form-create-news-container #lbl-send-to{
	margin-left: 15px;
	font-size:13px !important;
}
.form-create-news-container #btn-toogle-dropdown-scope{
	margin-left:5px;
}
/* MODAL */
.form-create-news-container  .modal-header, 
.form-create-news-container  .modal-footer{
	background-color: #EAEAEA;
	color: #2D6569;
}

.form-create-news-container  .modal-header button.close{
	color: 2D6569 !important;
	opacity: 0.6 !important;
}
.form-create-news-container  #list-scroll-type{
	max-height:400px;
	overflow-y:auto; 
	overflow-x:hidden; 
	padding-top:15px;
	border-left: 1px solid rgba(128, 128, 128, 0.26);
}
.form-create-news-container  #list-scroll-type .panel-default,
.form-create-news-container  #list-scroll-type .panel-heading,
.form-create-news-container  #list-scroll-type .panel-body{
	margin-bottom: 0px;
}
.form-create-news-container .modal .panel-heading{
	padding: 0px;
	min-height: auto;
	background-color: transparent;
	border: none;
}
.form-create-news-container .modal input#search-contact{
	width: 299px;
	margin-top: -15px;
	margin-right: -15px;
	padding-left: 10px;
	padding-right: 10px;
	height: 52px;
	background-color: rgba(255, 255, 255, 0.54);
}

.form-create-news-container .modal .panel-heading h4{
	margin:0px;
	font-size: 18px !important;
	background-color: rgba(114, 114, 114, 0.1);
	padding: 10px;
	border-radius: 0px;
}
.form-create-news-container .modal-body{
	padding: 0px 15px;
}

.form-create-news-container .panel-body{
	background-color: transparent !important;
}
.form-create-news-container .modal .panel{
	padding: 0px;
	background-color: transparent;
	border: none;
	box-shadow: none;
}
.form-create-news-container .modal ul{
	list-style: none !important;
	padding-left: 0px;
	margin-bottom:20px;
}

.form-create-news-container .modal .list-group{
	margin-bottom:0px !important;
}
.form-create-news-container .modal #list-scroll-type ul{
	margin-bottom:0px !important;
}
.form-create-news-container .modal #menu-type ul li{
	font-size:16px;
}
.form-create-news-container .modal #menu-type ul li i{
	width:20px;
	text-align: center;
}
.form-create-news-container .modal #menu-type ul li a:hover{
	color:inherit !important;	
	text-decoration: underline;
}
.form-create-news-container .modal .btn-scroll-type{
	border:none!important;
    padding: 3px;
    text-align: left;
}
.form-create-news-container .modal .btn-select-contact{
	min-width:70% !important;
}

.form-create-news-container .modal #menu-type .btn-scroll-type{
	border:none!important;
    padding: 2px;
	text-align: left;
	width: 92%;
	margin-left: 4%;
	padding: 6px 4px 4px 8px;
	margin-bottom: 3px;
	background:transparent !important;
}
.form-create-news-container .modal #menu-type .btn-scroll-type:hover{
	background-color:rgba(0, 0, 0, 0.04) !important;
}
.form-create-news-container .modal #scope-postal-code{
	width: 99%;
	display: none;
	margin-left: -1% !important;
}
.form-create-news-container .modal .info-contact{
	display: inline-block;
	vertical-align: middle;
}
.form-create-news-container .modal .scope-city-contact{
	text-overflow: ellipsis;
	white-space: nowrap;
	overflow: hidden;
	max-width: 160px;
	display: inline-block;
	height: 15px;
 } 
.form-create-news-container .modal .scope-name-contact{
	display: inline-block;
    vertical-align: middle;
    text-align: left;
    max-width: 200px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    font-size: 12px;
}
.form-create-news-container .modal .thumb-send-to {
    width: 35px;
    height: 35px;
    background-color: #DADADA;
    border-radius: 4px;
    margin:5px;
}
.form-create-news-container .modal .text-light{
	font-weight:500;
}
.form-create-news-container .modal #menu-type h4 {
    background-color: rgba(35, 83, 96, 0.15);
	color: #2D6569;
	width: 100%;
	float: left;
	padding: 10px 10px 10px 20px;
	margin: 0;
	margin-bottom: 10px;
}
/* MODAL */
</style>

<?php
	//var_dump($_GET); 
	$myContacts = Person::getPersonLinksByPersonId(Yii::app()->session['userId']);
	$myFormContact = $myContacts; 
	$getType = (isset($_GET["type"]) && $_GET["type"] != "citoyens") ? $_GET["type"] : "people";
?>
<script type="text/javascript">
var myContacts = <?php echo json_encode($myFormContact) ?>;
// console.log("myContacts"); 
// console.dir(myContacts); 
var contactTypes = [	{ name : "people",  		color: "yellow"	, icon:"user"			},
						{ name : "organizations", 	color: "green" 	, icon:"group"			},
						{ name : "projects", 		color: "purple"	, icon:"lightbulb-o"	},
						{ name : "events", 			color: "orange"	, icon:"calendar"		}];

<?php  ?>

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
            	"placeholder" : "In a few words ... ",
            	"rules" : {
						"required" : true
					}
            },
            
            "text" :{
            	"inputType" : "textarea",
            	"placeholder" : "Details ",
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
            	"placeholder" : "When ?",
            },
	        "scope" :{
	            	"inputType" : "scope",
	            	"placeholder" : "Scope : select your contacts",
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

   "#ajaxForm .chk-scope-people" 		: "scope.people",
   "#ajaxForm .chk-scope-organizations" : "scope.organizations",
   "#ajaxForm .chk-scope-projects" 		: "scope.projects",
   "#ajaxForm .chk-scope-events" 		: "scope.events", 
   "#ajaxForm #scope-postal-code" 		: "scope.cities",
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
			$.hideSubview();
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
					value = "";

					/*TAGS*/
					if(dest == "tags"){
						value = $(field).val().split(",");
					}
					/*SCOPE*/
					else if(dest.search(new RegExp("scope", "i")) >= 0){
						if(dest == "scope.cities"){
							value = $(field).val().split(" ");
							if(value[0] == "") value = new Array();
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
								console.log("scopePrivate", $(".typehidden input#type").val());
								//et qu'on est sur le même type que le type du receveur (people, orga, project, ou event)
								if(dest == "scope."+$("input[name='type']").val()){
									//on ajoute la valeur a la liste
									console.log("insert id wall");
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
			console.dir(params);
			$.ajax({
	    	  type: "POST",
	    	  url: baseUrl+"/<?php echo $this->module->id?>/news/save",
	    	  data: params,
	    	  dataType: "json"
	    	}).done( function(data){
	    		if(data.result)
	    		{
	    			if(countEntries == 0)
	    				showAjaxPanel( '/news/index/type/<?php echo (isset($_GET['type'])) ? $_GET['type'] : 'citoyens' ?>/id/<?php echo (isset($_GET['id'])) ? $_GET['id'] : Yii::app()->session['userId'] ?>', 'KESS KISS PASS ','rss' )
					
	    			if( 'undefined' != typeof updateNews && typeof updateNews == "function" )
	            		updateNews(data.object);
	            	else if( notSubview )
	            		showAjaxPanel( '/news/index/type/<?php echo (isset($_GET['type'])) ? $_GET['type'] : 'citoyens' ?>/id/<?php echo (isset($_GET['id'])) ? $_GET['id'] : Yii::app()->session['userId'] ?>', 'KESS KISS PASS ','rss' )
					
	            	
					//console.dir(data);
					$.unblockUI();
					//$("#ajaxSV").html('');
					$.hideSubview();
					toastr.success('Saved successfully!');
					$("#ajaxForm")[0].reset();
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

//affiche le contenu du formulaire
//masqué par defaut
function showFormBlock(bool){
	if(bool){
		$(".form-create-news-container #text").show("fast");
		$(".form-create-news-container .tagstags").show("fast");
		$(".form-create-news-container .datedate").show("fast");
		$(".form-create-news-container .form-actions").show("fast");
		$(".form-create-news-container .publiccheckbox").show("fast");
		$(".form-create-news-container .scopescope").show("fast");
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

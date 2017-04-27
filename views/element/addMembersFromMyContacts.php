<style>
	
	/* MODAL */

	@media screen and (min-width: 768px) {
		#modalDirectoryForm #modal-scope .modal-dialog{
			width:760px
		}
	}
	#modalDirectoryForm  .modal-header, 
	#modalDirectoryForm  .modal-footer{
		background-color: #EAEAEA !important;
		color: #2D6569 !important;
		display: block !important;
	}

	#modalDirectoryForm  .modal-header button.close{
		color: 2D6569 !important;
		opacity: 0.6 !important;
	}
	#modalDirectoryForm  #list-scroll-type{
		max-height:400px;
		min-height:250px;
		overflow-y:auto; 
		overflow-x:hidden; 
		padding-top:15px;
		border-left: 1px solid rgba(128, 128, 128, 0.26);
	}
	#modalDirectoryForm  #list-scroll-type .panel-default,
	#modalDirectoryForm  #list-scroll-type .panel-heading,
	#modalDirectoryForm  #list-scroll-type .panel-body{
		margin-bottom: 0px;
	}

	#modalDirectoryForm  #list-scroll-type .input-group{
		margin-bottom:10px;
	}
	#modalDirectoryForm  #list-scroll-type input.form-control{
		border-radius: 0px 4px 4px 0px !important;
		text-align: left!important;
	}

	#modalDirectoryForm .modal .panel-heading{
		padding: 0px;
		min-height: auto;
		background-color: transparent;
		border: none;
	}

	#modalDirectoryForm .form-control{
		/*width:unset;*/
		padding: 0px 5px;
	}
	#modalDirectoryForm .modal input#search-contact{
		width: 66.66666667%;
		margin-top: -8px;
		margin-right: 0px;
		padding-left: 10px;
		padding-right: 10px;
		height: 52px;
		border-radius: 0px;
		text-align:left;
		background-color: rgba(255, 255, 255, 0.54);
	}

	#modalDirectoryForm .modal .panel-heading h4{
		margin:0px;
		font-size: 18px !important;
		background-color: rgba(114, 114, 114, 0.1);
		padding: 10px;
		border-radius: 0px;
	}
	#modalDirectoryForm .modal-body{
		padding: 0px 15px;
	}

	#modalDirectoryForm .panel-body{
		background-color: transparent !important;
	}
	#modalDirectoryForm .modal .panel{
		padding: 0px;
		background-color: transparent;
		border: none;
		box-shadow: none;
	}
	#modalDirectoryForm .modal ul{
		list-style: none !important;
		padding-left: 0px;
		margin-bottom:20px;
	}

	#modalDirectoryForm .modal .list-group{
		margin-bottom:0px !important;
	}
	#modalDirectoryForm .modal #list-scroll-type ul{
		margin-bottom:0px !important;
	}
	#modalDirectoryForm .modal #menu-type ul li{
		font-size:16px;
	}
	#modalDirectoryForm .modal #menu-type ul li i{
		width:20px;
		text-align: center;
	}
	#modalDirectoryForm .modal #menu-type ul li a:hover{
		color:inherit !important;	
		text-decoration: underline;
	}
	#modalDirectoryForm .modal .btn-scroll-type{
		border:none!important;
	    padding: 3px;
	    text-align: left;
	    /*width: 100%;*/
	}
	#modalDirectoryForm .modal .btn-select-contact{
		min-width:70% !important;
	}

	#modalDirectoryForm .modal #menu-type .btn-scroll-type{
		border:none!important;
	    padding: 2px;
		text-align: left;
		width: 92%;
		margin-left: 4%;
		padding: 6px 4px 4px 8px;
		margin-bottom: 3px;
		background:transparent !important;
	}
	#modalDirectoryForm .modal #menu-type .btn-scroll-type:hover{
		background-color:rgba(0, 0, 0, 0.04) !important;
	}
	#modalDirectoryForm .modal #scope-postal-code{
		width: 99%;
		display: none;
		margin-left: -1% !important;
	}
	#modalDirectoryForm .modal .info-contact{
		display: inline-block !important;
		vertical-align: middle;
	}
	#modalDirectoryForm .modal .scope-city-contact{
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
		max-width: 160px;
		display: inline-block;
		height: 15px;
	 } 
	#modalDirectoryForm .modal .scope-name-contact{
		display: inline-block;
	    vertical-align: middle;
	    text-align: left;
	    max-width: 200px;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	    overflow: hidden;
	    font-size: 12px;
	}
	#modalDirectoryForm .modal .thumb-send-to {
	    width: 35px;
	    height: 35px;
	    background-color: #DADADA;
	    border-radius: 4px;
	    margin:5px;
	}
	#modalDirectoryForm .modal .text-light{
		font-weight:500;
		color:#8C8C8C !important;
	}
	#modalDirectoryForm .modal #menu-type h4 {
	    background-color: rgba(35, 83, 96, 0.15);
		color: #2D6569;
		width: 100%;
		float: left;
		padding: 10px 10px 10px 20px;
		margin: 0;
		margin-bottom: 10px;
	}
	.btn-is-admin{
		text-decoration: line-through;
		display:none;
	}
	.btn-is-admin.selected{
		display:inline;
	}
	.btn-is-admin.selected.isAdmin {
		text-decoration: none;
	}
	.btn-is-admin.selected.isAdmin a{
		color:#5cb85c!important;
	}
</style>

<div id="addMembers">
	<input type="hidden" id="parentOrganisation" name="parentOrganisation" value="<?php echo $parentId; ?>"/>
</div>

<div id="formSendMailInvite" class="hidden">
	<div class="text-red"><i class="fa fa-ban"></i> Aucun résultat ne correspond à votre recherche</div>
	<hr>
	<h3 class='text-dark'><i class="fa fa-angle-down"></i> Inviter par mail</h3>
	<div id="addMembers" style="line-height:40px; padding:0px;" autocomplete="off" submit='false'>
		<input type="hidden" id="parentOrganisation" name="parentOrganisation" value="<?php echo (string)$parentId; ?>"/>
	    <input type="hidden" id="memberId" name="memberId" value=""/>
        <div class="form-group" id="addMemberSection">

        	<input type="radio" value="citoyens" name="memberType" data-fa="user" checked> <i class="fa fa-user"></i> un citoyen
        	<?php //if($type != "events"){ ?>
        		<!--<input type="radio" value="organizations" name="memberType" data-fa="group" style="margin-left:25px;"> <i class="fa fa-group"></i> une organisation -->
        	<?php //} ?>
			<div class="input-group">
		      <span class="input-group-addon" id="basic-addon1">
		        <i class="fa fa-user text-dark searchIcon tooltips" id="fa-type-contact-mail"></i>
		      </span>
		      <input class="form-control" placeholder="Son nom" id="memberName" name="memberName" value=""/>
		    </div>
		    <div class="input-group">
		      <span class="input-group-addon" id="basic-addon1">
		        <i class="fa fa-envelope-o text-dark searchIcon tooltips"></i>
		      </span>
		      <input class="member-email form-control text-left" placeholder="Son address@email.xxx" 
		      		 autocomplete="off" id="memberEmail" name="memberEmail" value=""/>
		    </div>
		    <div class="input-group organization-type">
		      <span class="input-group-addon" id="basic-addon1">
		        <i class="fa fa-users text-dark searchIcon tooltips"></i>
		      </span>
		      <select class="member-organization-type form-control text-left" autocomplete="off" id="organizationType" name="organizationType" value=""/>
		    </div>
		    <div class="col-md-12 no-padding">
		    	<span id='isAdminDiv' ><input type="checkbox" id="memberIsAdmin" value="true"> <i class="fa fa-user-secret"></i> Ajouter en tant qu'admin</span>
		    	<button class="btn btn-primary pull-right" onclick="sendInvitationMailAddMember()">
		    		<i class="fa fa-send"></i> Envoyer l'invitation
		    	</button>
        	</div>
        	<div class="col-md-12 padding-15 text-right" id="loader-send-mail-invite" style="margin-bottom:10px;">
		    </div>
		</div>
    </div>       		
</div>


<script type="text/javascript">
var elementType = "<?php echo $type; ?>";
var elementId = "<?php echo $parentId; ?>"
var myContactsMembers = getFloopContacts(); //""; <?php //echo json_encode($myContacts) ?>
var listContact = new Array();
var newMemberInCommunity = false;
var reloadOnClose=false;
var contactTypes = [{ name : "people", color: "yellow", icon:"user", label:"Citoyens" }];

//if(elementType != "<?php echo Event::COLLECTION ?>")
//	contactTypes.push({ name : "organizations", color: "green", icon:"group", label:"Organisations" });


var users = <?php echo json_encode(@$users) ?>;

var addLinkDynForm = {
		"inputType" : "scope",
  		"title1" : "Ajouter des membres ...",
  		"title2" : "Parmis mes contacts ...",
  		"title3" : "Autres ...",
  		"btnCancelTitle" : "Fermer",
  		"btnSaveTitle" : "Ajouter ces contacts",
  		"btnResetTitle" : "Annuler tout",

        "values" : myContactsMembers,
        "mainTitle" : "Inviter vos contacts",
        "labelBtnOpenModal" : "<span class='text-dark'><i class='fa fa-group'></i> Sélectionner parmis mes contacts</span>",
        "contactTypes" : contactTypes
};

var addLinkSearchMode = "contacts";
jQuery(document).ready(function() {
	
	buildModal(addLinkDynForm, "modalDirectoryForm");

	$("#select-type-search-contacts, #a-select-type-search-contacts").click(function(){
		switchContact();
	});

	$("#select-type-search-all, #a-select-type-search-all").click(function(){
		$("#select-type-search-all").prop("checked", true);
		$("#btn-save").removeClass("hidden");
		$("#list-scroll-type").html('<i class="fa fa-search fa-4x padding-15 center-block text-grey"></i>');
		$("#search-contact").attr("placeholder", "Recherchez un nom ou une addresse e-mail...");
		addLinkSearchMode = "all";
		filterContact($("#search-contact").val());
	});

	$.each(organizationTypes, function(k, v) {
   		$(".member-organization-type").append($("<option />").val(k).text(v));
	});
});

function excludeMembers(contacts, users){

	//delete mes contacts qui sont déjà membre
	if(users != null){
		$.each(users, function(idUser, value){
			if(typeof value != "undefined"){
				var type = notEmpty(value["typeSig"]) ? value["typeSig"] : notEmpty(value["type"]) ? value["type"] : null;
				if(type != null){
					var found = false; var parentFound = false;
					if(notEmpty(contacts[type]))
					$.each(contacts[type], function(key, contact){ 
						if(notEmpty(contact)){
							var contactId = notEmpty(contact["_id"]) ? contact["_id"]["$id"] : notEmpty(contact["id"]) ? contact["id"] : null;
							if(idUser == contactId){
								found = key;
							}
						}
					});
					if(notEmpty(contacts[type])){ //console.log("typeof", typeof contacts[type]);
						if(typeof contacts[type] == "array"){
							if(found!==false) contacts[type].splice(found,1);
						}else if(typeof contacts[type] == "object"){ 
							if(found!==false) delete contacts[type][found];
						}
					}
				}
			}
		});
	}
	//delete le parent qui se trouve aussi dans la liste des contact du floop
	if(elementType != "<?php echo Event::COLLECTION ?>" && elementType != "<?php echo Project::COLLECTION ?>"){
		typeElt = elementType ;
		if(elementType == "citoyens") typeElt = "people" ;
		$.each(contacts[typeElt], function(key, contact){ 
			if(typeof contact != "undefined"){
				if(notEmpty(contact)){
					var contactId = notEmpty(contact["_id"]) ? contact["_id"]["$id"] : notEmpty(contact["id"]) ? contact["id"] : null;
					if(contactId == elementId){
						delete contacts[typeElt][key];
						return;
					}
				}
			}
		});
	}
}

function switchContact(){
	$("#select-type-search-contacts").prop("checked", true);
	$("#btn-save").removeClass("hidden");
	$("#search-contact").attr("placeholder", "Recherchez parmis vos contacts...");
	showMyContactInModalAddMembers(addLinkDynForm, "#list-scroll-type");
	addLinkSearchMode = "contacts";
	filterContact($("#search-contact").val());
}
	
function bindEventScopeModal(){
	/* initialisation des fonctionnalités de la modale SCOPE */
	//parcourt tous les types de contacts
	$.each(contactTypes, function(key, type){ //mylog.log("BINDEVENT CONTACTTYPES : " + type.name);
		//initialise le scoll automatique de la liste de contact
		$("#btn-scroll-type-"+type.name).click(function(){

			//console.log("click btn scroll type : "+type.name+ " " + $("#scroll-type-"+type.name).position().top);
			if($("#select-type-search-contacts").prop("checked")==false){
				$("#select-type-search-contacts").prop("checked", true);
				switchContact();
				console.log("end reload");
			}
			//mylog.log("click btn scroll type : "+type.name+ " " + $("#scroll-type-"+type.name).position().top);
			$('#list-scroll-type').animate({
	         scrollTop: $('#list-scroll-type').scrollTop() + $("#scroll-type-"+type.name).position().top 
	         }, 400);
		});
		//initialisation des boutons pour selectionner toutes les checkbox d'un type de contact
		$("#chk-all-type"+type.name).click(function(){
			$(".chk-scope-"+type.name).prop("checked", $(this).prop('checked'));
		});
	});
	
	$("#search-contact").keyup(function(){
		filterContact($(this).val());
	});

	$("#btn-cancel").click(function(){
		if(reloadOnClose) 
			loadByHash(location.hash);
	});
	$("#btn-save").click(function(){
		sendInvitation();
	});
	$("#btn-reset-scope").click(function(){
		$.each($('.modal input:checkbox'), function(){
			$(this).prop("checked", false);
		});
		$("#scope-postal-code").val("");
	});

	// $("#a-select-type-search-contacts").click(function(){
	// 	$("#select-type-search-contacts").prop("checked", true);
	// });

	// $("#a-select-type-search-all").click(function(){
	// 	$("#select-type-search-all").prop("checked", true);
	// });

	
}


function bindEventScopeContactsModal(){
	//initialise la selection d'une checkbox contact au click sur le bouton qui lui correspond

	$(".btn-chk-contact").click(function(){ 
		var id = $(this).attr("idcontact"); 
		var type = $(this).attr("typecontact");
		//console.log(".btn-chk-contact click", type);

		var check = !$("#chk-scope-"+id).prop('checked');
		$("#chk-scope-"+id).prop("checked", check);
		
		if(check && type != "organizations")
		$("[data-id='"+id+"'].btn-is-admin").addClass("selected");
		else
		$("[data-id='"+id+"'].btn-is-admin").removeClass("selected");
	});

	$(".chk-contact").click(function(){ 
		var id = $(this).attr("idcontact"); 
		var type = $(this).attr("typecontact");
		//console.log(".btn-chk-contact click", id);

		var check = $(this).prop('checked');
		//$("#chk-scope-"+id).prop("checked", check);
		
		if(check && type != "organizations")
		$("[data-id='"+id+"'].btn-is-admin").addClass("selected");
		else
		$("[data-id='"+id+"'].btn-is-admin").removeClass("selected");
	});

	$(".btn-is-admin").click(function(){
		if($(this).hasClass("isAdmin"))
			$(this).removeClass("isAdmin");
		else
			$(this).addClass("isAdmin");
	});
}

function buildModal(fieldObj, idUi){
	//var fieldClass = " select2TagsInput select2ScopeInput";
    var fieldHTML = "";    		
	fieldHTML += '<div class="modal fade" id="modal-scope" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
				  '<div class="modal-dialog">'+
				    '<div class="modal-content">'+
				      '<div class="modal-header">'+
				        //'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
				        '<input type="text" id="search-contact" class="form-control pull-right" placeholder="Recherchez parmis vos contacts...">' +
						'<h4 class="modal-title" id="myModalLabel"><i class="fa fa-search"></i> '+fieldObj.title1+'</h4>'+
				      '</div>'+
				      '<div class="modal-body">'+
					      '<div class="row no-padding bg-light">'+
					      	'<div class="col-md-4 col-sm-4 no-padding">'+
						        '<div class="panel panel-default">  '+	
									'<div class="panel-body no-padding">'+
										'<div class="list-group" id="menu-type">'+
											'<ul class="col-xs-12 col-sm-12 col-md-12 no-padding">';
	fieldHTML += 							'<h4 class="text-dark"> '+
												'<input type="radio" name="select-type-search" id="select-type-search-contacts" value="contacts" checked> '+
												'<a href="javascript:" id="a-select-type-search-contacts" class="text-dark">'+fieldObj.title2+'</a>'+
											'</h4>';
											$.each(fieldObj.contactTypes, function(key, type){
	fieldHTML += 								'<li>'+
													'<div id="btn-scroll-type-'+type.name+'" class="btn btn-default btn-scroll-type text-'+type.color+'">' +
														//'<input type="checkbox" name="chk-all-type'+type.name+'" id="chk-all-type'+type.name+'" value="'+type.name+'"> '+
														'<span style="font-size:16px;"><i class="fa fa-'+type.icon+'"></i> ' + type.label + "</span>" +
													'</div>'+
												'</li>';
											});									
	fieldHTML += 							'</ul>';
	fieldHTML += 							'<ul class="col-xs-6 col-sm-12 col-md-12 no-margin no-padding select-population">' + 
												'<h4 class="text-dark"> '+	
													'<input type="radio" name="select-type-search" id="select-type-search-all" value="contacts"> '+
													'<a href="javascript:" id="a-select-type-search-all" class="text-dark">'+fieldObj.title3+'</a>'+
												'</h4>';
	/*											$.each(fieldObj.contactTypes, function(key, type){
	fieldHTML += 								'<li>'+
													'<div id="btn-scroll-type-'+type.name+'" class="btn btn-default btn-scroll-type text-'+type.color+'">' +
														'<input type="checkbox" name="chk-all-type'+type.name+'" id="chk-all-type'+type.name+'" value="'+type.name+'"> '+
														'<span style="font-size:16px;"><i class="fa fa-'+type.icon+'"></i> ' + type.label + "</span>" +
													'</div>'+
												'</li>';
											});	*/
	fieldHTML +=							'</ul>' +
										'</div>'+
									'</div>'+
								'</div>' +
					      	'</div>'+
					      	'<div class="no-padding pull-right col-md-8 col-sm-8 col-xs-12 bg-white" id="list-scroll-type">';
	fieldHTML += 			'</div>' +
						'</div>'+
					  '</div>'+
				      '<div class="modal-footer">'+
				      	'<button id="btn-reset-scope" type="button" class="btn btn-default btn-sm pull-left"><i class="fa fa-repeat"></i> '+fieldObj.btnResetTitle+'</button>'+
				      	'<button id="btn-cancel" type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '+fieldObj.btnCancelTitle+'</button>'+
				      	'<button id="btn-save" type="button" class="btn btn-success btn-sm" data-dismiss="modal"><i class="fa fa-check"></i> '+fieldObj.btnSaveTitle+'</button>'+
				      '</div>'+
				    '</div><!-- /.modal-content -->'+
				  '</div><!-- /.modal-dialog -->';

	if($("body #"+idUi).length > 0) $("body #"+idUi).html(fieldHTML);
	else $('body').prepend("<div id='"+idUi+"'>"+fieldHTML+"</div>");

	showMyContactInModalAddMembers(fieldObj, "#list-scroll-type");
	bindEventScopeModal();
}

function showMyContactInModalAddMembers(fieldObj, jqElement){
	mylog.log("showMyContactInModalAddMembers1", fieldObj);
    
	var contacts = fieldObj.values;
	excludeMembers(contacts, users);
	fieldObj.values = contacts;

    var fieldHTML = "";
   
	$.each(fieldObj.contactTypes, function(key, type){
	fieldHTML += 			'<div class="panel panel-default" id="scroll-type-'+type.name+'">  '+	
								'<div class="panel-heading">'+
									'<h4 class="text-'+type.color+'"><i class="fa fa-'+type.icon+'"></i> '+type.label+'</h4>'+			
								'</div>'+
								'<div class="panel-body no-padding">'+
									'<div class="list-group padding-5">'+
										'<ul>';
										if(typeof fieldObj.values[type.name] != "undefined")
										$.each(fieldObj.values[type.name], function(key2, value){ 
										if(typeof value != "undefined"){
											var cp = (typeof value.address != "undefined" && typeof value.address.postalCode != "undefined") ? value.address.postalCode : typeof value.cp != "undefined" ? value.cp : "";
											var city = (typeof value.address != "undefined" && typeof value.address.addressLocality != "undefined") ? value.address.addressLocality : "";
											var profilThumbImageUrl = (typeof value.profilThumbImageUrl != "undefined" && value.profilThumbImageUrl != "") ? baseUrl + value.profilThumbImageUrl : assetPath + "/images/news/profile_default_l.png";
											var name =  typeof value.name != "undefined" ? value.name : 
														typeof value.username != "undefined" ? value.username : "";
											//mylog.log("data contact +++++++++++ "); mylog.dir(value);
											var thisKey = key+''+key2;
											//var thisValue = notEmpty(value["_id"]['$id']) ? value["_id"]['$id'] : "";
											var thisValue = getObjectId(value);
											if(name != "") {
	fieldHTML += 							'<li>';
												if (type.name == "people") {
	fieldHTML +=									'<small id="isAdmin'+getObjectId(value)+'" class="btn-is-admin 													pull-right text-grey margin-top-10" data-id="'+thisKey+'">'+
													'<a href="javascript:">admin <i class="fa fa-user-secret"></i></a>'+
													'</small>';
												}
	fieldHTML +=								'<div class="btn btn-default btn-scroll-type btn-select-contact"  												id="contact'+thisKey+'">' +
													'<div class="col-md-1 no-padding"><input type="checkbox" name="scope-'+type.name+'" class="chk-scope-'+type.name+' chk-contact" id="chk-scope-'+thisKey+'" idcontact="'+thisKey+'" value="'+thisValue+'" data-type="'+type.name+'"></div> '+
													'<div class="btn-chk-contact col-md-11 no-padding" idcontact="'+thisKey+'" typecontact="'+type.name+'">' +
														'<img src="'+ profilThumbImageUrl+'" class="thumb-send-to" height="35" width="35">'+
														'<span class="info-contact">' +
															'<span class="scope-name-contact text-dark text-bold" idcontact="'+thisKey+'">' + value.name + '</span>'+
															'<br/>'+
															'<span class="scope-cp-contact text-light" idcontact="'+thisKey+'">' + cp + ' </span>'+
															'<span class="scope-city-contact text-light" idcontact="'+thisKey+'">' + city + '</span>'+
														'</span>' +
													'</div>' +
												'</div>' +
											'</li>';
											}
										}
										});									
	fieldHTML += 						'</ul>' +	
									'</div>'+
								'</div>'+
							'</div>';
	});
	$(jqElement).html(fieldHTML);
	bindEventScopeContactsModal();
}

//var searchValLast = "";
function filterContact(searchVal){
	//mylog.log(searchVal, "==", searchValLast);
	//if(searchVal == searchValLast) return;
	//searchValLast = searchVal;

	if(addLinkSearchMode == "contacts"){
		$("#btn-save").removeClass("hidden");
		//masque/affiche tous les contacts présents dans la liste
		if(searchVal != "")	$(".btn-select-contact").hide();
		else				$(".btn-select-contact").show();
		//recherche la valeur recherché dans les 3 champs "name", "cp", et "city"
		$.each($(".scope-name-contact"), function() { checkSearch($(this), searchVal); });
		$.each($(".scope-cp-contact"), 	 function()	{ checkSearch($(this), searchVal); });
		$.each($(".scope-city-contact"), function() { checkSearch($(this), searchVal); });
	}else if(addLinkSearchMode == "all"){
		if(searchVal.length>2){
	    	clearTimeout(timeout);
		    timeout = setTimeout(function(){
		    	$("#iconeChargement").css("visibility", "visible");
		    	autoCompleteEmailAddMember(searchVal);
		    }, 500);

	    }else{
	    	//$("#addMembers #dropdown_search").css({"display" : "none" });
	    	//$("#iconeChargement").css("visibility", "hidden")
	    }
	}
}

function autoCompleteEmailAddMember(searchValue){
	mylog.log("autoCompleteEmailAddMember");
	$("#btn-save").removeClass("hidden");
	var data = {
		"search" : searchValue,
		"elementId" : elementId
	};
	if (elementType == "<?php echo Event::COLLECTION ?>")
		data.searchMode = "personOnly";

	$("#list-scroll-type").html("<div class='padding-10'><i class='fa fa-spin fa-refresh'></i> Recherche en cours</div>");
	$.ajax({
		type: "POST",
        url: baseUrl+"/communecter/search/searchmemberautocomplete",
        data: data,
        dataType: "json",
        success: function(data){
        	if(!data){
        		toastr.error(data.content);
        	}else{
        		if(!notEmpty(data.citoyens) && !notEmpty(data.organizations)){
        			$("#list-scroll-type").html("");
        			var formInvite = $("#formSendMailInvite").html();
        			formInvite = "<div class='padding-10'>"+formInvite+"</div>";
        			$("#list-scroll-type").html(formInvite);
        			$("#memberName").val($("#search-contact").val());
        			$("#btn-save").addClass("hidden");
        			$(".organization-type").hide();
        			$("input[name='memberType']").click(function(){
        				$("#fa-type-contact-mail").removeClass("fa-user").removeClass("fa-group").addClass("fa-"+$(this).data("fa"));
        				if ($(this).data('fa') == 'group') {
        					$("#isAdminDiv").hide();
        					$(".organization-type").show();
        				} else {
        					$("#isAdminDiv").show();
        					$(".organization-type").hide();
        				}
        			});
        			//$("#formSendMailInvite").removeClass("hidden");
        			
        		}else{
	        		listContact = {"people" : data.citoyens, "organizations" : data.organizations};
	        		var addLinkDynForm = {
						"values" : listContact,
				        "contactTypes" : contactTypes
					};
	        		showMyContactInModalAddMembers(addLinkDynForm, "#list-scroll-type");
        		}
  			}
		}	
	})
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

function sendInvitation(){
	var connectType = "member";
	//if ($("#addMembers #memberIsAdmin").val() == true) connectType = "admin";
	var params = {
		"childs" : new Array(),
		//"organizationType" : $("#addMembers #organizationType").val(),
		"parentType" : elementType,
		"parentId" : $("#addMembers #parentOrganisation").val(),
		"connectType" : connectType
	};

	$.each($("#list-scroll-type input:checkbox"), function(key, val){
		if($(this).prop("checked") == true){
			var id = $(this).val();
			var type = $(this).data("type");// == "people" ? "citoyens" : $(this).data("type"); 
			var name = "";
			var contactPublicFound = new Array();
			var connectType = "";

			if(addLinkSearchMode == "all") { contactPublicFound = listContact;
			}else if(addLinkSearchMode=="contacts"){ contactPublicFound = myContactsMembers; }

			$.each(contactPublicFound[type], function(k, contact){
				if (typeof contact != undefined && contact != null) {
					var idObj = getObjectId(contact);mylog.log("azioueaoziueiazue : ", idObj, id);
					if(idObj == id){mylog.log("azioueaoziueiazue XXX : ", idObj);
						name = notEmpty(contact['name']) ? contact['name'] : "";
						email = notEmpty(contact['email']) ? contact['email'] : "";
					}
				}
			});
			
			if ($("#isAdmin"+id).hasClass("isAdmin")) {
				connectType = "admin";
			}

			mylog.log("add this element ?", email, type, id, name);
			if(type != "" && id != "" && name != "")
				params["childs"].push({
					"childId" : id,
					"childName" : name,
					"childEmail" : email,
					"childType" : type, 
					"connectType" : connectType
				})
		}
	});
	mylog.log("params constructed");
	mylog.dir(params);
	//mylog.dir(myContacts);
	//return;

	
	//mylog.log(params);
	mylog.log("send ajax invite");
	$.blockUI({
		message : "<h4 style='font-weight:300' class='text-dark padding-10'><i class='fa fa-spin fa-circle-o-notch'></i><br>Processing<br><blockquote><p>la Liberté est la reconnaissance de la nécessité.</p><cite title='Hegel'>Hegel</cite></blockquote></h4>"
	});
	$.ajax({
        type: "POST",
        url: baseUrl+"/communecter/link/multiconnect",
        data: params,
        dataType: "json",
        success: function(data){
        	if(!data.result){
        		toastr.error(data.msg);
        		$.unblockUI();
        		//checkIsLoggued();
        	}
        	else {
        		toastr.success(data.msg);
        		mylog.log(data);
        		/*$.each(data.newMembers, function(k, newMember){
	        		mylog.log("neewsMens >>>>");
	        		mylog.log(newMember);
	        		//setValidationTable(newMember,newMember.childType, true);
			        mapType = newMember.childType;
			        if(newMember.childType=="<?php echo Person::COLLECTION ?>")
			            mapType="people";
			        contextMap[mapType].push(newMember);
				});
				if(typeof(mapUrl) != "undefined"){
					if(typeof(mapUrl.detail.load) != "undefined" && mapUrl.detail.load)
						mapUrl.detail.load = false;
					if(typeof(mapUrl.directory.load) != "undefined" && mapUrl.directory.load)
						mapUrl.directory.load = false;
				}
				if(currentView=="detail" || currentView=="directory"){*/
					loadByHash(location.hash);
				//}
				$.unblockUI();
        	}
        	mylog.log(data.result);   
        },
        error:function (xhr, ajaxOptions, thrownError){
          toastr.error( thrownError );
          $.unblockUI();
        } 
	});
}

function sendInvitationMailAddMember(){ mylog.log("sendInvitationMailAddMember");
	$("#loader-send-mail-invite").html('<i class="fa fa-spinner fa-spin fa-refresh"></i> Envoi en cours...');
	var connectType = "member";
	if ($("#addMembers #memberIsAdmin").is(':checked')) connectType = "admin";
	var params = {
		"childId" : $("#addMembers #memberId").val(),
		"childName" : $("#addMembers #memberName").val(),
		"childEmail" : $("#addMembers #memberEmail").val(),
		"childType" : $("#addMembers [name='memberType']:checked").val(), 
		"organizationType" : $("#addMembers #organizationType").val(),
		"parentType" : "<?php echo $type;?>",
		"parentId" : $("#addMembers #parentOrganisation").val(),
		"connectType" : connectType
	};

	//mylog.log(params);
	if($("#addMembers #memberName").val() == "") { $("#loader-send-mail-invite").html('Merci d\'indiquer une nom'); return; }
	if($("#addMembers #memberEmail").val() == "") { $("#loader-send-mail-invite").html('Merci d\'indiquer une addresse e-mail'); return; }

	$.ajax({
        type: "POST",
        url: baseUrl+"/communecter/link/connect",
        data: params,
        dataType: "json",
        success: function(data){
        	if(!data.result){
        		toastr.error(data.msg);
        		$("#loader-send-mail-invite").html('');
        		//checkIsLoggued();
        	}
        	else {
        		toastr.success(data.msg);
        		mylog.log(data);
        		//if(typeof updateOrganisation != "undefined" && typeof updateOrganisation == "function")
        		//	updateOrganisation( data.member,  $("#addMembers #memberType").val());
               	//setValidationTable(data.newElement,data.newElementType, false);
               	mapType = data.newElementType;
               	if(data.newElementType=="<?php echo Person::COLLECTION ?>")
               		mapType="people";
               //	contextMap[mapType].push(data.newElement);
               	//Minus 1 on number of invit
               	if ($("#addMembers #memberId").val().length==0){
	               	var count = parseInt($("#numberOfInvit").data("count")) - 1;
					$("#numberOfInvit").html(count + ' invitation(s)');
					$("#numberOfInvit").data("count", count);
				}
				$("#addMembers #memberId").val("");
                $("#addMembers #memberType").val("");
                $("#addMembers #memberName").val("");
                $("#addMembers #memberEmail").val("");
                $("#addMembers #memberIsAdmin").val("");
                $('#addMembers #organizationType').val("");
				$("#addMembers #memberIsAdmin").val("false");
				$('#addMembers #memberEmail').parents().eq(1).show();
				$//("[name='my-checkbox']").bootstrapSwitch('state', false);
				$("#loader-send-mail-invite").html('');
				//showSearch();
				reloadOnClose=true;
				if(typeof(mapUrl) != "undefined"){
					if(typeof(mapUrl.detail.load) != "undefined" && mapUrl.detail.load)
						mapUrl.detail.load = false;
					if(typeof(mapUrl.directory.load) != "undefined" && mapUrl.directory.load)
						mapUrl.directory.load = false;
				}
				newMemberInCommunity = true;
        	}
        	mylog.log(data.result);   
        },
        error:function (xhr, ajaxOptions, thrownError){
          toastr.error( thrownError );
          $("#loader-send-mail-invite").html('');
        } 
	});
}

</script>
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
	#modalDirectoryForm .modal .panel-heading{
		padding: 0px;
		min-height: auto;
		background-color: transparent;
		border: none;
	}

	#modalDirectoryForm .form-control{
		width:unset;
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
	    width: 100%;
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

</style>

<div id="modalDirectoryForm" class="pull-left margin-15"></div>
<input type="hidden" id="parentOrganisation" name="parentOrganisation" value="<?php echo $parentId; ?>"/>
		    	    
<script type="text/javascript">
var elementType = "<?php echo $type ?>";
var myContacts = getFloopContacts(); //""; <?php //echo json_encode($myContacts) ?>


var contactTypes = [	{ name : "people",  		color: "yellow"	, icon:"user", label:"Citoyens" }
						//{ name : "projects", 		color: "purple"	, icon:"lightbulb-o"	},
						//{ name : "events", 			color: "orange"	, icon:"calendar"		}
						];

if(elementType != "<?php echo Event::COLLECTION ?>")
	contactTypes.push({ name : "organizations", 	color: "green" 	, icon:"group", label:"Organisations" });

var addLinkDynForm = {
		"inputType" : "scope",
  		"title1" : "Ajouter des membres ...",
  		"title2" : "Parmis mes contacts ...",
  		"title3" : "Autres ...",
  		"btnCancelTitle" : "Annuler",
  		"btnSaveTitle" : "Ajouter ces contacts",
  		"btnResetTitle" : "Annuler tout",

        "values" : myContacts,
        "mainTitle" : "Inviter vos contacts",
        "labelBtnOpenModal" : "<span class='text-dark'><i class='fa fa-group'></i> Sélectionner parmis mes contacts</span>",
        "contactTypes" : contactTypes
};

jQuery(document).ready(function() {
	console.log("MES CONTACTS");
	console.dir(myContacts);

	buildModal(addLinkDynForm, "modalDirectoryForm");
	bindEventScopeModal();
});

	
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
	$(".btn-chk-contact").click(function(){ console.log(".btn-chk-contact click", id);
		var id = $(this).attr("idcontact"); 
		console.log(".btn-chk-contact click", $("#chk-scope-"+id).prop('checked'));
		$("#chk-scope-"+id).prop("checked", !$("#chk-scope-"+id).prop('checked'));
		console.log(".btn-chk-contact click", $("#chk-scope-"+id).prop('checked'));
	});

	$("#search-contact").keyup(function(){
		filterContact($(this).val());
	});

	$("#btn-cancel").click(function(){
		//showStateScope("cancel");
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

}

function buildModal(fieldObj, idUi){
	//var fieldClass = " select2TagsInput select2ScopeInput";
    var fieldHTML = "";    		
	fieldHTML += '<div id="'+idUi+'">'+
				 '<div class="modal fade" id="modal-scope" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
				  '<div class="modal-dialog">'+
				    '<div class="modal-content">'+
				      '<div class="modal-header">'+
				        //'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
				        '<input type="text" id="search-contact" class="form-control pull-right" placeholder="rechercher ...">' +
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
												'<a href="javascript:" class="text-dark">'+fieldObj.title2+'</a>'+
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
													'<input type="radio" name="select-type-search" id="select-type-search-contacts" value="contacts"> '+
													'<a href="javascript:" class="text-dark">'+fieldObj.title3+'</a>'+
												'</h4>';
												$.each(fieldObj.contactTypes, function(key, type){
	fieldHTML += 								'<li>'+
													'<div id="btn-scroll-type-'+type.name+'" class="btn btn-default btn-scroll-type text-'+type.color+'">' +
														'<input type="checkbox" name="chk-all-type'+type.name+'" id="chk-all-type'+type.name+'" value="'+type.name+'"> '+
														'<span style="font-size:16px;"><i class="fa fa-'+type.icon+'"></i> ' + type.label + "</span>" +
													'</div>'+
												'</li>';
											});	
	fieldHTML +=							'</ul>' +
										'</div>'+
									'</div>'+
								'</div>' +
					      	'</div>'+
					      	'<div class="no-padding pull-right col-md-8 col-sm-8 col-xs-12 bg-white" id="list-scroll-type">';
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
											var cp = (typeof value.address != "undefined" && typeof value.address.postalCode != "undefined") ? value.address.postalCode : typeof value.cp != "undefined" ? value.cp : "";
											var city = (typeof value.address != "undefined" && typeof value.address.addressLocality != "undefined") ? value.address.addressLocality : "";
											var profilThumbImageUrl = (typeof value.profilThumbImageUrl != "undefined" && value.profilThumbImageUrl != "") ? baseUrl + value.profilThumbImageUrl : assetPath + "/images/news/profile_default_l.png";
											var name =  typeof value.name != "undefined" ? value.name : 
														typeof value.username != "undefined" ? value.username : "";
											//console.log("data contact +++++++++++ "); console.dir(value);
											var thisKey = key+''+key2;
											var thisValue = notEmpty(value["_id"]['$id']) ? value["_id"]['$id'] : "";
											if(name != "")
	fieldHTML += 							'<li>' +
												'<div class="btn btn-default btn-scroll-type btn-select-contact"  id="contact'+thisKey+'">' +
													'<div class="col-md-1 no-padding"><input type="checkbox" name="scope-'+type.name+'" class="chk-scope-'+type.name+'" id="chk-scope-'+thisKey+'" value="'+thisValue+'" data-type="'+type.name+'"></div> '+
													'<div class="btn-chk-contact col-md-11 no-padding" idcontact="'+thisKey+'">' +
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
										});									
	fieldHTML += 						'</ul>' +	
									'</div>'+
								'</div>'+
							'</div>';
							});									
	fieldHTML += 			'</div>' +
						'</div>'+
					  '</div>'+
				      '<div class="modal-footer">'+
				      	'<button id="btn-reset-scope" type="button" class="btn btn-default btn-sm pull-left"><i class="fa fa-repeat"></i> '+fieldObj.btnResetTitle+'</button>'+
				      	'<button id="btn-cancel" type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '+fieldObj.btnCancelTitle+'</button>'+
				      	'<button id="btn-save" type="button" class="btn btn-success btn-sm" data-dismiss="modal"><i class="fa fa-check"></i> '+fieldObj.btnSaveTitle+'</button>'+
				      '</div>'+
				    '</div><!-- /.modal-content -->'+
				  '</div><!-- /.modal-dialog -->'+
				'</div><!-- /.modal -->'+
				'</div><!-- /# var idUi -->';

	$('body').prepend(fieldHTML);
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
			$.each(myContacts[type], function(k, contact){
				if(contact['_id']['$id'] == id){
					name = notEmpty(contact['name']) ? contact['name'] : "";
					email = notEmpty(contact['email']) ? contact['email'] : "";
				}
			});
			console.log("add this element ?", email, type, id, name);
			if(type != "" && id != "" && name != "")
			params["childs"].push({
				"childId" : id,
				"childName" : name,
				"childEmail" : email,
				"childType" : type, 
			})

			

		}
	});
	console.log("params constructed");
	console.dir(params);
	//console.dir(myContacts);
	//return;

	
	//console.log(params);
	console.log("send ajax invite");
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
        	else
        	{
        		toastr.success(data.msg);
        		console.log(data);
        		$.each(data.newMembers, function(k, newMember){
	        		console.log("neewsMens >>>>");
	        		console.log(newMember);
	        		setValidationTable(newMember,newMember.childType, true);
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
				$.unblockUI();
        	/*	if(typeof updateOrganisation != "undefined" && typeof updateOrganisation == "function")
        			updateOrganisation( data.member,  $("#addMembers #memberType").val());
               	setValidationTable();*/
               	//Minus 1 on number of invit
              /* 	if ($("#addMembers #memberId").val().length==0){
	               	var count = parseInt($("#numberOfInvit").data("count")) - 1;
					$("#numberOfInvit").html(count + ' invitation(s)');
					$("#numberOfInvit").data("count", count);
				}*/
				/*$("#addMembers #memberId").val("");
                $("#addMembers #memberType").val("");
                $("#addMembers #memberName").val("");
                $("#addMembers #memberEmail").val("");
                $("#addMembers #memberIsAdmin").val("");
                $('#addMembers #organizationType').val("");
				$("#addMembers #memberIsAdmin").val("false");
				$('#addMembers #memberEmail').parents().eq(1).show();
				$("[name='my-checkbox']").bootstrapSwitch('state', false);*/
				
				//showSearch();
        	}
        	console.log(data.result);   
        },
        error:function (xhr, ajaxOptions, thrownError){
          toastr.error( thrownError );
          $.unblockUI();
        } 
	});
}

</script>
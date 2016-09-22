<div id="modalDirectoryForm" class="pull-left margin-15"></div>

<script type="text/javascript">

var myContacts = getFloopContacts(); //""; <?php //echo json_encode($myContacts) ?>


var contactTypes = [	{ name : "people",  		color: "yellow"	, icon:"user", label:"Mes contacts" },
						{ name : "organizations", 	color: "green" 	, icon:"group", label:"Mes organisations" },
						//{ name : "projects", 		color: "purple"	, icon:"lightbulb-o"	},
						//{ name : "events", 			color: "orange"	, icon:"calendar"		}
						];

var importMembreDynForm = {
	    "jsonSchema" : {
	        "title" : "News Form",
	        "type" : "object",
	        "properties" : {
	        	"scope" : {
	          		"inputType" : "scope",
	          		"title1" : "Ajouter des membres ...",
	          		"title2" : "Sélectionner des contacts",
	          		"btnCancelTitle" : "Annuler",
	          		"btnSaveTitle" : "Ajouter ces contacts",
	          		"btnResetTitle" : "Annuler tout",

		            "values" : myContacts,
		            "mainTitle" : "Inviter vos contacts",
		            "labelBtnOpenModal" : "<span class='text-dark'><i class='fa fa-group'></i> Sélectionner parmis mes contacts</span>",
		            "contactTypes" : contactTypes
		        }
	        }
	    }
	};

jQuery(document).ready(function() {
	console.log("MES CONTACTS");
console.dir(myContacts);
	buildDynForm();
});

function buildDynForm(){ 
	var form = $.dynForm({
		formId : "#modalDirectoryForm",
		formObj : importMembreDynForm,
		onLoad : function  () {
			bindEventScopeModal();
		},
		onSave : function(){
			console.log("onSave import contact !!");
			
			return false;
		}
	});
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

/*
	//initialise l'affichage du champ "code postal" de l'item "OTHER CITIES"
	// $("#btn-scroll-type-my-city").click(function(){
	// 	$("#chk-my-city").prop("checked", !$("#chk-my-city").prop('checked'));
	// });
	
	// //initialise l'affichage du champ "code postal" de l'item "OTHER CITIES"
	// $("#btn-show-other-cities").mouseover(function(){
	// 	$("#scope-postal-code").show();
	// });
	// //initialise l'affichage du champ "code postal" de l'item "OTHER CITIES"
	// $("#btn-show-other-cities").click(function(){
	// 	$("#scope-postal-code").show();
	// 	$("#chk-cities").prop("checked", !$("#chk-cities").prop('checked'));
	// });
	// //initialise l'affichage du champ "code postal" de l'item "OTHER CITIES"
	// $("#btn-show-other-cities").mouseout(function(){
	// 	$("#scope-postal-code").hide();
	// });

	// //initialise la selection de la checkbox "other cities"
	// $("#btn-scroll-type-cities").click(function(){
	// 	$("#chk-cities").prop("checked", !$("#chk-cities").prop('checked'));
	// });
	// //initialise la selection de la checkbox "other cities" quand le champs text "other cities" n'est pas vide 
	// $("#scope-postal-code").keyup(function(){
	// 	$("#chk-cities").prop("checked", ($("#scope-postal-code").val() != ""));
	// });
	// //par defaut, marsque le champ txt "other cities"
	// $("#scope-postal-code").hide();

	
	// $("#scope-my-wall").click(function(){
	// 	//showStateScope("cancel");
	// });
	// $("#scope-select").click(function(){
	// 	//showStateScope("save");
	// });
*/

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
		"parentType" : "<?php echo Organization::COLLECTION;?>",
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
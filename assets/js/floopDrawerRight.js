/*
	Pour info, depuis qu'on utilise le nouveau design Tango
	on utilise aussi le floopDrawerRight.js
	floopDrawer.js n'est plus utilisé
*/

//liste des types à afficher avec leurs icons
var floopContactTypes = [	{ name : "projects", 		color: "purple"	, icon:"lightbulb-o"	},
							{ name : "events", 			color: "orange"	, icon:"calendar"		},
							{ name : "people",  		color: "yellow"	, icon:"user"			},
							{ name : "organizations", 	color: "green" 	, icon:"group"			}];
							
var openPanelType = { 	"people" 		 : "person",
						"organizations"  : "organization",
						"projects" 	 	 : "project",
						"events" 		 : "event",
					};

var tooltips_lbl = { 	"people" 		 : "Ajouter quelqu'un à votre répertoire.",
						"organizations"  : "Créer une nouvelle organisation",
						"projects" 	 	 : "Créer un nouveau projet",
						"events" 		 : "Créer un nouvel événement",
					};

var floopTypeUsed = new Array();
var floopShowLock = false;
var timeoutShowFloopDrawer = false;

function buildListContactHtml(contacts, myId){

	
	var HTML = 			'<div class="floopHeader bg-dark">'+
							'<i class="fa fa-bookmark fa-rotate-270" style="margin-right:5px;"></i> '+t("My directory")+
							'<button id="btnFloopClose"><i class="fa fa-times"></i></button>' +
							'<div id="floopScrollByType" class="pull-right"></div>' +
						'</div>';
		HTML += 		'<div class="floopScroll">' ;
							
							$.each(floopContactTypes, function(key, type){

							var n=0;
							//compte le nombre d'élément à afficher
							$.each(contacts[type.name], function(key2, value){ n++; });
							//si aucun élément, on affiche pas cette section
							//if(n > 0){
							var urlBtnAdd = "";
							if(type.name == "people") 		 urlBtnAdd = "loadByHash( '#person.invite')";
							if(type.name == "organizations") urlBtnAdd = "loadByHash( '#organization.addorganizationform')";
							if(type.name == "events") 		 urlBtnAdd = "loadByHash( '#event.eventsv')";
							if(type.name == "projects") 	 urlBtnAdd = "loadByHash( '#project.projectsv.id."+myId+".type.citoyen')";

							floopTypeUsed.push(type);

		HTML += 			'<div class="panel panel-default" id="scroll-type-'+type.name+'">  '+	
								'<div class="panel-heading">';
		HTML += 					'<h4 class="text-'+type.color+'">'+
										//'<button onclick="'+urlBtnAdd+'" class="tooltips btn btn-default btn-sm pull-right btn_shortcut_add bg-'+type.color+'" data-placement="left" data-original-title="'+tooltips_lbl[type.name]+'">'+
										//	'<i class="fa fa-search"></i>'+
										//'</button>' +		
										'<i class="fa fa-'+type.icon+'"></i> <span class="">'+t('My '+type.name)+"</span>";
										if(myId != ""){
		HTML += 						'<button onclick="'+urlBtnAdd+'" class="tooltips btn btn-default btn-sm pull-right btn_shortcut_add text-'+type.color+'" data-placement="left" data-original-title="'+tooltips_lbl[type.name]+'">'+
											'<i class="fa fa-plus"></i>'+
										'</button>';		
										}
		HTML += 					'</h4>'+
								'</div>'+
								'<div class="panel-body no-padding">'+
									'<div class="list-group no-padding">'+
										'<ul id="floopType-'+type.name+'">';
										if($(contacts[type.name]).size() == 0){
		HTML += 							'<label class="no-element"><i class="fa fa-angle-right"></i> Aucun élément</label>';									
										}
										$.each(contacts[type.name], function(key2, value){ 
		HTML += 							getFloopItem(key2, type, value);
										});									
		HTML += 						'</ul>' +	
									'</div>'+	
								'</div>'+
							'</div>';
							});									
		HTML += 		'</div>' +
						'</div>'+
					  '</div>' +
					  '</div>';
		HTML += '<i class="fa fa-search" style="padding:15px 0px 15px 11px;"></i><input type="text" id="search-contact" class="form-control" placeholder="'+t('Search name, postal code, city ...')+'">';
				

		return HTML;
}


//création HTML d'un élément
function getFloopItem(id, type, value){
	var cp = (typeof value.address != "undefined" && typeof value.address.postalCode != "undefined") ? value.address.postalCode : typeof value.cp != "undefined" ? value.cp : "";
	var city = (typeof value.address != "undefined" && typeof value.address.addressLocality != "undefined") ? value.address.addressLocality : "";
	var profilImageUrl = (typeof value.profilImageUrl != "undefined" && value.profilImageUrl != "") ? baseUrl + value.profilImageUrl : assetPath + "/images/news/profile_default_l.png";
	var id = (typeof value._id != "undefined" && typeof value._id.$id != "undefined") ? value._id.$id : "";
	var path = "loadByHash( '#"+openPanelType[type.name]+".detail.id."+id+"')";
	var HTML = '<li id="floopItem-'+type.name+'-'+id+'">' +
					'<div onclick="'+path+'" class="btn btn-default btn-scroll-type btn-select-contact"  id="contact'+id+'">' +
						'<div class="btn-chk-contact inline" idcontact="'+id+'">' +
							'<img src="'+ profilImageUrl+'" class="thumb-send-to bg-'+type.color+'" height="35" width="35">'+
							'<span class="info-contact">' +
								'<span class="name-contact text-dark text-bold" idcontact="'+id+'">' + value.name + '</span>'+
								'<br/>'+
								'<span class="cp-contact text-light" idcontact="'+id+'">' + cp + ' </span>'+
								'<span class="city-contact text-light" idcontact="'+id+'">' + city + '</span>'+
							'</span>' +
						'</div>' +
					'</div>' +
				'</li>';
	return HTML;
}

var translation = {
		"My people" 		: "Mes contacts",
		"My organizations" 	: "Mes organisations",
		"My projects" 		: "Mes projets",
		"My events" 		: "Mes événements",
		"My directory" 		: "Mon répertoire",
		"Search name, postal code, city ..." : "nom, code postal, ville ..."
}

function t(string){
	if(typeof translation[string] != "undefined"){
		return translation[string];
	}else { return string; }
}
function showFloopDrawer(show){ 
	if(show){
		if($(".floopDrawer" ).css("display") == "none"){
			$(".floopDrawer").stop().show();
			$(".floopDrawer" ).css("width", 0);
			$(".floopDrawer" ).animate( { width: 300 }, 300 );
		}
	}else{
		$(".floopDrawer").hide("fast");
	}
}
function getFloopContactTypes(type){
	var goodType = null;
	$.each(floopContactTypes, function(key, value){
		if(value.name == type) {
			goodType = value;
		}
	});
	return goodType;
}


function bindEventFloopDrawer(){
	
	$(".floopDrawer #search-contact").keyup(function(){
		filterFloopDrawer($(this).val());
	});

	//parcourt tous les types de contacts
	$.each(floopContactTypes, function(key, type){ 
		//initialise le scoll automatique de la liste de contact
		$(".floopHeader #btn-scroll-type-"+type.name).mouseover(function(){

			//var width = $(this).width();
	        //$("#floopDrawerDirectory").css({left:width});
	        //showFloopDrawer(true);
	        var scrollTOP = $('.floopScroll').scrollTop() - $('.floopScroll').position().top +
							$(".floopScroll #scroll-type-"+type.name).position().top;
			$('.floopScroll').scrollTop(scrollTOP);
		});
	});


    $("#ajaxSV,#menu-top-container").mouseenter(function() { 
      if(!floopShowLock)
			showFloopDrawer(false);
    });
    $(".floopDrawer, .floopDrawer #search-contact").mouseover(function() {
      showFloopDrawer(true);
    });
    $(".menuIcon.no-floop-item, .box-add, .blockUI, .mapCanvas").mouseover(function() {
      	if(!floopShowLock)
			showFloopDrawer(false);
    });

}

function initFloopScrollByType(){
	var HTML = "";
	$.each(floopTypeUsed, function(key, value){ 
		var type = value.name; //openPanelType[value.name];
		HTML += "<a href='javascript:' id='btn-scroll-type-"+type+"' class='bg-"+value.color+" btn-scroll-type'><i class='fa fa-"+value.icon+"'></i></button>";
	});
	$("#floopScrollByType").html(HTML);
}


//recherche text par nom, cp et city
function filterFloopDrawer(searchVal){
	//masque/affiche tous les contacts présents dans la liste
	if(searchVal != "")	$(".floopDrawer .btn-select-contact").hide();
	else				$(".floopDrawer .btn-select-contact").show();
	//recherche la valeur recherché dans les 3 champs "name", "cp", et "city"
	$.each($(".floopDrawer .name-contact"), function() { checkFloopSearch($(this), searchVal); });
	$.each($(".floopDrawer .cp-contact"),   function() { checkFloopSearch($(this), searchVal); });
	$.each($(".floopDrawer .city-contact"), function() { checkFloopSearch($(this), searchVal); });
}

//si l'élément contient la searchVal, on l'affiche
function checkFloopSearch(thisElement, searchVal, type){
	var content = thisElement.html();
	var found = content.search(new RegExp(searchVal, "i"));
	if(found >= 0){
		var id = thisElement.attr("idcontact");
		$(".floopDrawer #contact"+id).show();
	}
}

//ajout d'un élément dans la liste
function addFloopEntity(entityId, entityType, entityValue){
	
	//Exception with citoyens collection which is managed like people in display
	if(entityType == "citoyens") entityType = "people";

	var type = getFloopContactTypes(entityType);
	//console.log("getFloopContactTypes", entityType, type);

	//We check if the element is already displayed
	if($('#floopItem-'+type.name+'-'+entityId).length < 1){
		var html = getFloopItem(entityId, type, entityValue);
		$("ul#floopType-"+entityType).prepend(html);
	}
	
	$("ul#floopType-"+entityType+" .no-element").hide();
	floopShowLock = true;
    showFloopDrawer(true);

    setTimeout(function(){
    	if ($('.floopScroll').position().top != null ) {
			var scrollTOP = $('.floopScroll').scrollTop() - $('.floopScroll').position().top +
							$(".floopScroll #scroll-type-"+entityType).position().top;
			$('.floopScroll').scrollTop(scrollTOP);
		}
	}, 1000);

	timeoutShowFloopDrawer = setTimeout(function(){
		floopShowLock = false;
		showFloopDrawer(false);
		clearTimeout(timeoutShowFloopDrawer);
	}, 4000);
	//toastr.success("ajout de l'element floop ok");
}

//ajout d'un élément dans la liste
function removeFloopEntity(entityId, entityType){
	$('#floopItem-'+entityType+'-'+entityId).remove();
}

//liste des types à afficher avec leurs icons
var floopContactTypes = [	{ name : "people",  		color: "yellow"	, icon:"user"			},
							{ name : "organizations", 	color: "green" 	, icon:"group"			},
							{ name : "projects", 		color: "purple"	, icon:"lightbulb-o"	},
							{ name : "events", 			color: "orange"	, icon:"calendar"		}];

var openPanelType = { 	"people" 		 : "person",
						"organizations"  : "organization",
						"projects" 	 	 : "project",
						"events" 		 : "event",
					};
/*
	contactsObj ~= {
	            	"inputType" : "scope",
	            	"values" : myContacts,
	            	"contactTypes" : contactTypes
	              };
*/
function buildListContactHtml(contacts){
	/*HTML += 	'<span id="lbl-send-to">Send to <i class="fa fa-caret-right"></i>'+ 
					'<div class="dropdown">' +
					  '<a data-toggle="dropdown" class="btn btn-sm btn-default" id="btn-toogle-dropdown-scope" href="#"><i class="fa fa-group"></i> My wall <i class="fa fa-caret-down"></i></a>' +
					  '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">' +
					   '<li><a href="#" id="scope-my-wall"><i class="fa fa-group"></i> My wall</a></li>' +
					   '<li><a href="#" id="scope-select" data-toggle="modal" data-target="#modal-scope"><i class="fa fa-plus"></i> Select</a></li>' +
					  '</ul>' +
					'</div></span>' ;*/

	var HTML = 		'<input type="text" id="search-contact" class="form-control" placeholder="search">';
							
								$.each(floopContactTypes, function(key, type){
		HTML += 				'<div class="panel panel-default" id="scroll-type-'+type.name+'">  '+	
									'<div class="panel-heading">'+
										'<h4 class="homestead text-'+type.color+'"><i class="fa fa-'+type.icon+'"></i> My '+type.name+'</h4>'+			
									'</div>'+
									'<div class="panel-body no-padding">'+
										'<div class="list-group no-padding">'+
											'<ul>';
											$.each(contacts[type.name], function(key2, value){ 
												var cp = (typeof value.address != "undefined" && typeof value.address.postalCode != "undefined") ? value.address.postalCode : typeof value.cp != "undefined" ? value.cp : "";
												var city = (typeof value.address != "undefined" && typeof value.address.addressLocality != "undefined") ? value.address.addressLocality : "";
												var profilImageUrl = (typeof value.profilImageUrl != "undefined" && value.profilImageUrl != "") ? baseUrl + value.profilImageUrl : assetPath + "/images/news/profile_default_l.png";
												var path = "openMainPanelFromPanel( '/"+openPanelType[type.name]+"/detail/id/"+value._id.$id+"', '" + openPanelType[type.name] + " : " + value.name+"', 'fa-"+ type.icon + "', '"+value._id.$id+"' )";
												//console.log("data contact +++++++++++ "); console.dir(value);
		HTML += 							'<li>' +
													'<div onclick="'+path+'" class="btn btn-default btn-scroll-type btn-select-contact"  id="contact'+key2+'">' +
														'<div class="btn-chk-contact inline" idcontact="'+key2+'">' +
															'<img src="'+ profilImageUrl+'" class="thumb-send-to" height="35" width="35">'+
															'<span class="info-contact">' +
																'<span class="scope-name-contact text-dark text-bold" idcontact="'+key2+'">' + value.name + '</span>'+
																'<br/>'+
																'<span class="scope-cp-contact text-light" idcontact="'+key2+'">' + cp + ' </span>'+
																'<span class="scope-city-contact text-light" idcontact="'+key2+'">' + city + '</span>'+
															'</span>' +
														'</div>' +
													'</div>' +
												'</li>';
											});									
		HTML += 						'</ul>' +	
										'</div>'+
									'</div>'+
								'</div>';
								});									
		HTML += 			'</div>' +
							'</div>'+
						  '</div><!-- /.modal-body -->';

		return HTML;
}

function showFloopDrawer(show){ 
	if(show){
		$("#floopDrawerDirectory").stop().show();
	}else{
		$("#floopDrawerDirectory").stop().hide();
	}
}



function bindEventFloopDrawer(){
	
	$(".floopDrawer #search-contact").keyup(function(){
		filterFloopDrawer($(this).val());
	});

	//parcourt tous les types de contacts
	$.each(floopContactTypes, function(key, type){ //console.log("BINDEVENT CONTACTTYPES : " + type.name);
		//initialise le scoll automatique de la liste de contact
		$(".menuContainer #btn-scroll-type-"+type.name).mouseover(function(){

			var width = $(this).width();
	        $("#floopDrawerDirectory").css({left:width});
	        showFloopDrawer(true);

			var scrollTOP = $('.floopDrawer').scrollTop()+ $(".floopDrawer #scroll-type-"+type.name).position().top;
			//console.log("click btn scroll type : "+type.name, scrollTOP);
			//console.log($('.floopDrawer').scrollTop());
			$('#floopDrawerDirectory').scrollTop(scrollTOP);
		});
	});


    $(".floopDrawer,.floopDrawer#search-contact").mouseout(function() { 
      showFloopDrawer(false);
    });
    $(".floopDrawer,.floopDrawer#search-contact").mouseover(function() {
      showFloopDrawer(true);
    });
    $(".menuIcon.no-floop-item").mouseover(function() {
      	showFloopDrawer(false);
    });

}

function filterFloopDrawer(searchVal){
	//masque/affiche tous les contacts présents dans la liste
	if(searchVal != "")	$(".floopDrawer .btn-select-contact").hide();
	else				$(".floopDrawer .btn-select-contact").show();
	//recherche la valeur recherché dans les 3 champs "name", "cp", et "city"
	$.each($(".floopDrawer .scope-name-contact"), function() { checkFloopSearch($(this), searchVal); });
	$.each($(".floopDrawer .scope-cp-contact"),   function() { checkFloopSearch($(this), searchVal); });
	$.each($(".floopDrawer .scope-city-contact"), function() { checkFloopSearch($(this), searchVal); });
}

//si l'élément contient la searchVal, on l'affiche
function checkFloopSearch(thisElement, searchVal, type){
	var content = thisElement.html();
	console.log("searchVal", searchVal);
	var found = content.search(new RegExp(searchVal, "i"));
	if(found >= 0){
		var id = thisElement.attr("idcontact");
		console.log(id);
		$(".floopDrawer #contact"+id).show();
	}
}

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

function buildListContactHtml(contacts){

	var HTML = 		'<input type="text" id="search-contact" class="form-control" placeholder="Search name, postal code, city ...">';
		HTML += 		'<div class="floopScroll">' ;
							
							$.each(floopContactTypes, function(key, type){
		HTML += 			'<div class="panel panel-default" id="scroll-type-'+type.name+'">  '+	
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
		HTML += 							'<li>' +
												'<div onclick="'+path+'" class="btn btn-default btn-scroll-type btn-select-contact"  id="contact'+key2+'">' +
												'<div class="btn-chk-contact inline" idcontact="'+key2+'">' +
													'<img src="'+ profilImageUrl+'" class="thumb-send-to" height="35" width="35">'+
													'<span class="info-contact">' +
														'<span class="name-contact text-dark text-bold" idcontact="'+key2+'">' + value.name + '</span>'+
														'<br/>'+
														'<span class="cp-contact text-light" idcontact="'+key2+'">' + cp + ' </span>'+
														'<span class="city-contact text-light" idcontact="'+key2+'">' + city + '</span>'+
													'</span>' +
												'</div>' +
											'</div>' +
										'</li>';
										});									
		HTML += 					'</ul>' +	
									'</div>'+
								'</div>'+
							'</div>';
							});									
		HTML += 		'</div>' +
						'</div>'+
					  '</div>' +
					  '</div>';

		return HTML;
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



function bindEventFloopDrawer(){
	
	$(".floopDrawer #search-contact").keyup(function(){
		filterFloopDrawer($(this).val());
	});

	//parcourt tous les types de contacts
	$.each(floopContactTypes, function(key, type){ 
		//initialise le scoll automatique de la liste de contact
		$(".menuContainer #btn-scroll-type-"+type.name).mouseover(function(){

			var width = $(this).width();
	        $("#floopDrawerDirectory").css({left:width});
	        showFloopDrawer(true);

			var scrollTOP = $('.floopScroll').scrollTop() - $('.floopScroll').position().top +
							$(".floopScroll #scroll-type-"+type.name).position().top;
			$('.floopScroll').scrollTop(scrollTOP);
		});
	});


    $("#ajaxSV,#menu-top-container").mouseenter(function() { 
      showFloopDrawer(false);
    });
    $(".floopDrawer,.floopDrawer #search-contact").mouseover(function() {
      showFloopDrawer(true);
    });
    $(".menuIcon.no-floop-item, .box-add, .blockUI").mouseover(function() {
      	showFloopDrawer(false);
    });

}

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

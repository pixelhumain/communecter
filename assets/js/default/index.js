
function startNewCommunexion(country){ 

	clearTimeout(timeoutSearch);

	var locality = $('#searchBarPostalCode').val();
	locality = locality.replace(/[^\w\s-']/gi, '');

	$(".search-loader").html("<i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...");

	var data = {"name" : name, "locality" : locality, "country" : country, "searchType" : [ "cities" ], "searchBy" : "ALL"  };
    var countData = 0;
    var oneElement = null;
	mylog.log(data);
    $.blockUI({
		message : "<h1 class='homestead text-dark'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</span></h1>"
	});

    $.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
          data: data,
          dataType: "json",
          error: function (data){
            mylog.log("error");
          	mylog.dir(data);
            $(".search-loader").html("<i class='fa fa-ban'></i> Aucun résultat");
          },
          success: function(data){
          	mylog.log("success, try to load sig");
          	mylog.dir(data);
            if(!data){
              toastr.error(data.content);
            }else{


            $.each(data, function(i, v) {
	            if(v.length!=0){
	              $.each(v, function(k, o){ countData++; });
	            }
	        });

	        if(countData == 0){
	        	$(".search-loader").html("<i class='fa fa-ban'></i> Aucun résultat");
	        }else{
	        	$(".search-loader").html("<i class='fa fa-crosshairs'></i> Sélectionnez une commune ...");
	        	showMap(true);
	        	Sig.showMapElements(Sig.map, data);
	        	
	        }

	        $.unblockUI();

          }
          
      }
    });
}

function resizeInterface()
{
  //mylog.log("resize");
  var height = $("#mapCanvasBg").height() - 55;
  $("#ajaxSV").css({"minHeight" : height});
  //$("#menu-container").css({"minHeight" : height});
  var heightDif = $("#search-contact").height() + $("#floopHeader").height() + 60 /* top */ + 0 /* bottom */;
  var menuTopHeight = $(".main-top-menu").height();// - $(".toolbar").height();
  
  //mylog.log("heightDif", heightDif);
  $(".floopScroll").css({"minHeight" : height-heightDif});
  $(".floopScroll").css({"maxHeight" : height-heightDif});
  $(".my-main-container").css("min-height", $(".sigModuleBg").height()-menuTopHeight);
  $(".my-main-container").css("max-height", $(".sigModuleBg").height()-menuTopHeight);
  $(".my-main-container").css("height", $(".sigModuleBg").height()-menuTopHeight);
  $(".main-col-search").css("min-height", $(".sigModuleBg").height());
  //$("ul.notifList").css({"maxHeight" : height-heightDif});

}

function initNotifications(){
	
	$('.main-top-menu .btn-menu-notif').off().click(function(){
	  mylog.log("click notification main-top-menu");
      showNotif();
    });
    $('.my-main-container .btn-menu-notif').off().click(function(){
	  mylog.log("click notification my-main-container");
      showNotif();
    });
}
function showNotif(show){
	if(typeof show == "undefined"){
		if($("#notificationPanelSearch").css("display") == "none") show = true; 
    	else show = false;
    }

    if(show){ 
    	refreshNotifications(userId,"citoyens","");
    	$('#notificationPanelSearch').show("fast");
    	markAllAsSeen(false,"");
	}
	else 	 $('#notificationPanelSearch').hide("fast");
}

function checkScroll(){
	$(".main-top-menu").animate({
 							top: 0,
 							opacity:1
					      }, 500 );
		
}

function showMap(show)
{
	//if(typeof Sig == "undefined") { alert("Pas de SIG"); return; } 
	mylog.log("typeof SIG : ", typeof Sig);
	if(typeof Sig == "undefined") show = false;

	mylog.log("showMap");
	mylog.warn("showMap");
	if(show === undefined) show = !isMapEnd;
	if(show){
		isMapEnd =true;
		showNotif(false);

		$("#mapLegende").html("");
		$("#mapLegende").hide();

		showTopMenu(true);
		if(Sig.currentMarkerPopupOpen != null){
			Sig.currentMarkerPopupOpen.fire('click');
		}
		
		$(".btn-group-map").show( 700 );
		$("#right_tool_map").show(700);
		$(".btn-menu5, .btn-menu6, .btn-menu7, .btn-menu8, .btn-menu9, .btn-menu10, .btn-menu-add").hide();
		$("#btn-toogle-map").html("<i class='fa fa-th-large'></i>");
		$("#btn-toogle-map").attr("data-original-title", "Tableau de bord");
		$("#btn-toogle-map").css("display","inline !important");
		$("#btn-toogle-map").show();
		//$(".lbl-btn-menu").hide(400);
		//$(".fa-angle-right").hide(400);
		//$(".menu-left-container hr").css({opacity:0});
		$(".main-menu-left").addClass("inSig");
		$("body").addClass("inSig");

		$(".my-main-container").animate({
     							//top: -1000,
     							opacity:0,
						      }, 'slow' );

		setTimeout(function(){ $(".my-main-container").hide(); }, 100);
		var timer = setTimeout("Sig.constructUI()", 1000);
		
	}else{
		isMapEnd =false;
		hideMapLegende();

		var iconMap = "map-marker";
		if(typeof ICON_MAP_MENU_TOP != "undefined") iconMap = ICON_MAP_MENU_TOP;
		//mylog.log(ICON_MAP_MENU_TOP);
		$(".btn-group-map").hide( 700 );
		$("#right_tool_map").hide(700);
		$(".btn-menu5, .btn-menu6, .btn-menu7, .btn-menu8, .btn-menu9, .btn-menu10, .btn-menu-add").show();
		$(".panel_map").hide(1);
		$("#btn-toogle-map").html("<i class='fa fa-"+iconMap+"'></i>");
		$("#btn-toogle-map").attr("data-original-title", "Carte");
		$(".main-col-search").animate({ top: 0, opacity:1 }, 800 );
		//$(".lbl-btn-menu").show(400);
		//$(".fa-angle-right").show(400);		
		//$(".menu-left-container hr").css({opacity:1} );
		$(".main-menu-left").removeClass("inSig");
		$("body").removeClass("inSig");
		$(".my-main-container").animate({
     							//top: 50,
     							opacity:1
						      }, 'slow' );
		setTimeout(function(){ $(".my-main-container").show(); }, 100);

		//hideFormInMap();

		if(typeof Sig != "undefined")
		if(Sig.currentMarkerPopupOpen != null){
			Sig.currentMarkerPopupOpen.closePopup();
		}

		//if($(".box-add").css("display") == "none" && notEmpty(userId))
		//	$("#ajaxSV").show( 700 );

		showTopMenu(true);	
		checkScroll();
	}
		
}
/*
function showFormInMap(){
	$("#form-in-map #form-in-map-content").html($("#ajaxFormModal").html());
	$("#form-in-map").show(200);
	$("#right_tool_map").hide();
	Sig.showMyPosition();
}
function hideFormInMap(){
	$("#form-in-map").hide(200);
	$("#ajax-modal-modal-body").append($("#ajaxFormModal"));
}
*/
function setScopeValue(btn){ mylog.log("setScopeValue");
	if( typeof btn === "object" ){
		//récupère les valeurs
		inseeCommunexion = btn.attr("insee-com");
		cityNameCommunexion = btn.attr("name-com");
		cpCommunexion = btn.attr("cp-com");
		regionNameCommunexion = btn.attr("reg-com");
		countryCommunexion = btn.attr("ctry-com");
		latCommunexion = btn.attr("lat-com");
		lngCommunexion = btn.attr("lng-com");
		if(typeof(btn.attr("nbCpByInsee-com")) != "undefined"){
			nbCpbyInseeCommunexion = btn.attr("nbCpByInsee-com");
			cityInseeCommunexion = btn.attr("cityInsee-com");
		} else {
			nbCpbyInseeCommunexion = undefined;
			cityInseeCommunexion = undefined;

		}
		//var path = location.pathname;
		//setCookies();
		//definit le path du cookie selon si on est en local, ou en prod
		
		setCookies(location.pathname);
		
		$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté à " + cityNameCommunexion + ', ' + cpCommunexion);
		$(".lbl-btn-menu-name-city .lbl-btn-menu").html(cityNameCommunexion);// + ", " + cpCommunexion);
		
		$("#btn-geoloc-auto-menu .fa-crosshairs").attr("data-original-title", cityNameCommunexion);
		$("#btn-geoloc-auto-menu .fa-crosshairs").attr("title", cityNameCommunexion);
		$("#btn-geoloc-auto-menu").off(); //click(function(){ loadByHash("#city.detail.insee." + inseeCommunexion+"."+"postalCode."+cpCommunexion) });
		$("#btn-geoloc-auto-menu").attr("href", '#city.detail.insee.' + inseeCommunexion+'.'+'postalCode.'+cpCommunexion);
		$("#btn-geoloc-auto-menu").data("hash", "#city.detail.insee." + inseeCommunexion+"."+"postalCode."+cpCommunexion);
		//mylog.log("HASHHHHHHHHHHHHHHHHHHHH", $("#btn-geoloc-auto-menu").data("hash"));
		$("#btn-menuSmall-mycity").attr("href", '#city.detail.insee.' + inseeCommunexion+"."+"postalCode."+cpCommunexion);
				
		$("#btn-citizen-council-commun").attr("href", '#rooms.index.type.cities.id.' + countryCommunexion+'_' + inseeCommunexion+'-'+cpCommunexion);

		$("#btn-citizen-council-commun").data("hash", "#rooms.index.type.cities.id." + countryCommunexion+"_" + inseeCommunexion+"-"+cpCommunexion);
				
		$("#btn-menuSmall-citizenCouncil").attr("href", '#rooms.index.type.cities.id.' + countryCommunexion+'_' + inseeCommunexion+'-'+cpCommunexion);
				
		
		if(location.hash.indexOf("#default.twostepregister") == -1)
		$("#searchBarPostalCode").val(cityNameCommunexion);

		selectScopeLevelCommunexion(levelCommunexion);

  		$(".menu-left-container .visible-communected, .menuSmall .visible-communected").show(400);
  		$(".menu-left-container .hide-communected, .menuSmall .hide-communected").hide(400);
  		
  		if(!userId)
  		$(".btn-geoloc-auto").attr("onclick", 
  			"loadByHash('#rooms.index.type.cities.id.' + countryCommunexion + '_'+ inseeCommunexion + '-'+ cpCommunexion)");

  		
		Sig.clearMap();
		mylog.log("hash city ? ", location.hash.indexOf("#default.city"));
		if(location.hash == "#default.home"){
			//showLocalActorsCityCommunexion();
			loadByHash("#city.detail.insee."+inseeCommunexion+".postalCode."+cpCommunexion);
		}else
		if(location.hash == "#default.directory"){
			startSearch();
		}else
		if(location.hash == "#default.agenda"){
			startSearch();
		}else
		if(location.hash == "#default.news"){
			startSearch();
			showMap(false);
		}else
		if(location.hash.indexOf("#city.detail") >= 0) {
			//showLocalActorsCityCommunexion();
			if(location.hash != "#city.detail.insee." + inseeCommunexion+"."+"postalCode."+cpCommunexion){
				loadByHash("#city.detail.insee."+inseeCommunexion+".postalCode."+cpCommunexion);
			}else{
				$("#btn-communecter").html("<i class='fa fa-check'></i> COMMUNECTÉ");
	    		$("#btn-communecter").attr("onclick", "");
	    		toastr.success('Vous êtes communecté à ' + cityNameCommunexion);
    		}
			//showMap(false);
		}else
		if(location.hash.indexOf("#default.twostepregister") >= 0) {
			
			showMap(false);
			$("#tsr-commune-name-cp").html(cityNameCommunexion + ", " + cpCommunexion);

			$("#conf-commune").html(cityNameCommunexion + ", " + cpCommunexion);

			$("#TSR-load-conf-communexion").html("<h1><i class='fa fa-spin fa-circle-o-notch text-white'></i></h1>");
			showTwoStep("load-conf-communexion");
			setCookies();
			$(".btn-param-postal-code").attr("data-original-title", cityNameCommunexion + " en détail");
			//$(".btn-param-postal-code").attr("onclick", "loadByHash('#city.detail.insee."+inseeCommunexion+"')");
			$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté : " + cityNameCommunexion + ', ' + cpCommunexion);
			$(".lbl-btn-menu-name-city .lbl-btn-menu").html(cityNameCommunexion);
			setTimeout(function(){ achiveTSRAddress(); /*showTwoStep("street");*/  }, 2000);
			//showMap(false);
		}else{
			//showLocalActorsCityCommunexion();
			loadByHash("#city.detail.insee."+inseeCommunexion+".postalCode."+cpCommunexion);
		}
	}
	
  	mylog.log("setScopeValue", inseeCommunexion, cityNameCommunexion, cpCommunexion);
}

function showLocalActorsCityCommunexion(){

	loadByHash("#city.detail.insee."+inseeCommunexion+".postalCode."+cpCommunexion);
	return;

	mylog.log("showLocalActorsCityCommunexion");
	var data = { "name" : "", 
 			 "locality" : inseeCommunexion,
 			 "searchType" : [ "persons", "organizations", "projects", "events", "cities" ], 
 			 "searchBy" : "INSEE",
    		 "indexMin" : 0, 
    		 "indexMax" : 500  
    		};

	setTitle("Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>","spin fa-circle-o-notch","Les acteurs locaux : " + cityNameCommunexion + ", " + cpCommunexion);

	$.blockUI({
		message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i> " + cpCommunexion + " : Commune<span class='text-dark'>xion en cours ...</span></h1>"
	});

	showMap(true);
	
	$.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
          data: data,
          dataType: "json",
          error: function (data){
             mylog.log("error"); mylog.dir(data);          
          },
          success: function(data){
            if(!data){ toastr.error(data.content); }
            else{
            	//mylog.dir(data);
            	Sig.showMapElements(Sig.map, data);
				setTitle("Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>","connect-develop","Les acteurs locaux : " + cityNameCommunexion + ", " + cpCommunexion );
				$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté à " + cityNameCommunexion + ', ' + cpCommunexion);
				
				toastr.success('Vous êtes communecté !<br/>' + cityNameCommunexion + ', ' + cpCommunexion);
				$.unblockUI();
            }
          }
 	});

}


var topMenuActivated = true;
function showTopMenu(show){ 

	if(typeof show == "undefined") 
		show = $("#main-top-menu").css("opacity") == 1;
	
	if(show){
		$(".main-top-menu").animate({ top: 0, opacity:1 }, 500 );
	}
	else{
		$(".main-top-menu").animate({ top: -60, opacity:0 }, 500 );
	}
}


function initFloopDrawer(){
	mylog.log("initFloopDrawer");
	//mylog.dir(myContacts);
	if(myContacts != null){
      var floopDrawerHtml = buildListContactHtml(myContacts, userId);
      $("#floopDrawerDirectory").html(floopDrawerHtml);
      initFloopScrollByType();

      //$("#floopDrawerDirectory").hide();
      if($(".tooltips").length) {
        $('.tooltips').tooltip();
      }
      $("#btnFloopClose").click(function(){
      	showFloopDrawer(false);
      });
      $(".main-col-search").mouseenter(function(){
      	showFloopDrawer(false);
      });

      bindEventFloopDrawer();
    }
}

// function initBtnScopeList(){
// 	$(".btn-scope-list").click(function(){
// 		setInputPlaceValue(this);
// 	});
// }

function setInputPlaceValue(thisBtn){
	//if(location.hash == "#default.home"){
		//$("#autoGeoPostalCode").val($(thisBtn).attr("val"));
	//}else{
		$("#searchBarPostalCode").val($(thisBtn).attr("val"));
		
		mylog.log("setInputPlaceValue")
		$("#input-communexion").show();
		//$("#searchBarPostalCode").animate({"width" : "350px !important", "padding-left" : "70px !important;"}, 200);
		setTimeout(function(){ $("#input-communexion").hide(300); }, 300);
	  	
	//}
	//$.cookie("HTML5CityName", 	 $(thisBtn).attr("val"), 	   { path : '/ph/' });
	startNewCommunexion();
}

var communexionActivated = false;
function toogleCommunexion(init){ //this = jQuery Element
  
  if(init != true)
  communexionActivated = !communexionActivated;
	
  mylog.log("communexionActivated", communexionActivated);
  if(communexionActivated){
    //btn.removeClass("text-red");
    //btn.addClass("bg-red");
    $(".btn-activate-communexion, .btn-param-postal-code").removeClass("text-red");
    $(".btn-activate-communexion, .btn-param-postal-code").addClass("bg-red");
    $("#searchBarPostalCode").val(cityNameCommunexion);

    if(inseeCommunexion != "")
    $(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté à " + cityNameCommunexion + ', ' + cpCommunexion);
				
   // $("#searchBarPostalCode").animate({"width" : "0px !important", "padding-left" : "51px !important;"}, 200);
    //$(".lbl-scope-list").html("<i class='fa fa-check'></i> " + cityNameCommunexion.toLowerCase() + ", " + cpCommunexion);
    selectScopeLevelCommunexion(levelCommunexion);
    $(".lbl-scope-list").show(400);
    mylog.log("inseeCommunexion", inseeCommunexion);
    //setScopeValue(inseeCommunexion);
    //showInputCommunexion();
  }else{
    $(".btn-activate-communexion, .btn-param-postal-code").addClass("text-red");
    $(".btn-activate-communexion, .btn-param-postal-code").removeClass("bg-red");
    //$("#searchBarPostalCode").animate({"width" : "350px !important", "padding-left" : "70px !important;"}, 200);
    
    $(".search-loader").html("<i class='fa fa-times'></i> Communection désactivée (" + cityNameCommunexion + ', ' + cpCommunexion + ")");
				
    $(".lbl-scope-list").hide(400);
    $("#searchBarPostalCode").val("");
  }
}

function initBtnToogleCommunexion(){
	toogleCommunexion(true);
}

function showInputCommunexion(){
	clearTimeout(timeoutCommunexion);
	mylog.log("showCommunexion");
	$("#searchBarPostalCode").css({"width" : "0px !important", "padding-left" : "51px !important;"}, 200);

	if(communexionActivated)
	$("#searchBarPostalCode").animate({"width" : "350px !important", "padding-left" : "70px !important;"}, 200 );
	
	$("#input-communexion").show(300);
	//$(".main-col-search").animate({ opacity:0.3 }, 200 );
	$(".hover-info,.hover-info2").hide();
}

//niv 1 : city
//niv 2 : CP
//niv 3 : department
//niv 4 : region
//niv 4 : pays / global / tout
var levelCommunexion = 1;
function selectScopeLevelCommunexion(level){

	//var department = "";
	var department = inseeCommunexion;
	mylog.log("selectScopeLevelCommunexion", countryCommunexion, $.inArray(countryCommunexion, ["RE", "NC","GP","GF","MQ","YT","PM"]));

	if($.inArray(countryCommunexion, ["RE", "NC","GP","GF","MQ","YT","PM"]) >= 0){
		department = cpCommunexion.substr(0, 3);
	}else{
		department = cpCommunexion.substr(0, 2);
	}

	var change = (level != levelCommunexion);

	$(".btn-scope").removeClass("selected");
	$(".btn-scope-niv-"+level).addClass("selected");
	levelCommunexion = level;

	if(level == 1) endMsg = "à " + cityNameCommunexion + ", " + cpCommunexion;
	if(level == 2) {
		if(typeof(cityInseeCommunexion)!="undefined")
			endMsg = "à la ville de " + cityInseeCommunexion;
		else
			endMsg = "au code postal " + cpCommunexion;
	}
	if(level == 3) endMsg = "au département " + department;
	//if(level == 3) endMsg = "au département ";
	if(level == 4) endMsg = "à votre région " + regionNameCommunexion;
	if(level == 5) endMsg = "à l'ensemble du réseau";

	if(change){
		toastr.success('Les données sont maintenant filtrées par rapport ' + endMsg);
		$('.search-loader').html("<i class='fa fa-check'></i> Vous êtes connecté " + endMsg)
	}

	
	if(level == 1) endMsg = cityNameCommunexion + ", " + cpCommunexion;
	if(level == 2){ 
		if(typeof(cityInseeCommunexion)!="undefined")
			endMsg = cityInseeCommunexion;
		else
			endMsg = cpCommunexion;
	}
	//if(level == 3) endMsg = "Département " + department;
	if(level == 3) endMsg = "Département " + department;
	if(level == 4) endMsg = "Votre région " + regionNameCommunexion;
	if(level == 5) endMsg = "Tout le réseau";
	
	if(!communexionActivated)
    toogleCommunexion();

	$(".lbl-scope-list").html("<i class='fa fa-check'></i> " + endMsg);

	$(".btn-scope-niv-5").attr("data-original-title", "Niveau 5 - Tout le réseau");
	$(".btn-scope-niv-4").attr("data-original-title", "Niveau 4 - Région " + regionNameCommunexion);
	$(".btn-scope-niv-3").attr("data-original-title", "Niveau 3 - Département " + department);
	//$(".btn-scope-niv-3").attr("data-original-title", "Niveau 3 - Département ");
	if(typeof(cityInseeCommunexion)!="undefined"){
		$(".btn-scope-niv-2").attr("data-original-title", "Niveau 2 - Ville entière : " + cityInseeCommunexion);
	}
	else{
		$(".btn-scope-niv-2").attr("data-original-title", "Niveau 2 - Code postal : " + cpCommunexion);
	}
	$(".btn-scope-niv-1").attr("data-original-title", "Niveau 1 - " + cityNameCommunexion + ", " + cpCommunexion);
	$('.tooltips').tooltip();

	if(typeof startSearch == "function")
	startSearch();
}
function setCookies(path){
	//if(false){
		$.cookie('inseeCommunexion',   	inseeCommunexion,  	{ expires: 365, path: path });
		$.cookie('cityNameCommunexion', cityNameCommunexion,{ expires: 365, path: path });
		$.cookie('cpCommunexion',   	cpCommunexion,  	{ expires: 365, path: path });		
		$.cookie('regionNameCommunexion',   regionNameCommunexion,  { expires: 365, path: path });
		$.cookie('countryCommunexion',   	countryCommunexion,  	{ expires: 365, path: path });
		if(typeof(nbCpbyInseeCommunexion) != "undefined"){
			$.cookie('nbCpbyInseeCommunexion',   	nbCpbyInseeCommunexion,  	{ expires: 365, path: path });
			$.cookie('cityInseeCommunexion',   	cityInseeCommunexion,  	{ expires: 365, path: path });
		}
	//}
}
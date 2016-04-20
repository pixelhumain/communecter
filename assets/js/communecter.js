debug = true;

$(document).ready(function() { 
	
	initSequence();
	
});

function toggleSpinner(){
	if($("#logoLink").length){
		$("#logo").html('');
		var spinner = new Spinner(spinner_opts).spin($("#logo")[0]);
		NProgress.start();
	} else {
		$("#logo").html('<a id="logoLink" class="ml10 " href="/ph">PH</a>');
		NProgress.done();
	}
}

var spinner_opts = {
  lines: 9, // The number of lines to draw
  length: 6, // The length of each line
  width: 5, // The line thickness
  radius: 8, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 47, // The rotation offset
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#F7E400', // #rgb or #rrggbb
  speed: 0.7, // Rounds per second
  trail: 32, // Afterglow percentage
  shadow: false, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: '-7px', // Top position relative to parent in px
  left: 'auto' // Left position relative to parent in px
};
/* *************************** */
/* instance du menu questionnaire*/
/* *************************** */
function DropDown(el) {
	this.dd = el;
	this.placeholder = this.dd.children('span');
	this.opts = this.dd.find('ul.dropdown > li');
	this.val = '';
	this.index = -1;
	this.initEvents();
}
DropDown.prototype = {
	initEvents : function() {
		var obj = this;

		obj.dd.on('click', function(event){
			$(this).toggleClass('active');
			return false;
		});

		obj.opts.on('click',function(){
			var opt = $(this);
			obj.val = opt.text();
			obj.index = opt.index();
			obj.placeholder.text(obj.val);
			window.open($(this).find('a').slice(0,1).attr('href'));
		});
	},
	getValue : function() {
		return this.val;
	},
	getIndex : function() {
		return this.index;
	}
}

function openModal(key,collection,id,tpl,savePath,isSub){
    	$("#loginForm").modal('hide');
    	toggleSpinner();
    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/common/GetMicroformat/key/"+key,
    	  data: { "key" : key, 
    	  		  "template" : tpl, 
    	  		  "collection" : collection, 
    	  		  "id" : id,
    	  		  "savePath" : savePath,
    	  		  "isSub" : isSub },
    	  success: function(data){
    			  $("#flashInfoLabel").html(data.title);
    			  $("#flashInfoContent").html(data.content);
    			  $("#flashInfoSaveBtn").html('<a class="btn btn-warning " href="javascript:;" onclick="$(\'#flashForm\').submit(); return false;"  >Enregistrer</a>');
    		  toggleSpinner();
    	  },
    	  dataType: "json"
    	});
    
	
	$("#flashInfo").modal('show');
}

/* *************************** */
/* global JS tools */
/* *************************** */
function log(msg,type){
	if(debug){
	   try {
	    if(type){
	      switch(type){
	        case 'info': console.info(msg); break;
	        case 'warn': console.warn(msg); break;
	        case 'debug': console.debug(msg); break;
	        case 'error': console.error(msg); break;
	        case 'dir': console.dir(msg); break;
	        default : console.log(msg);
	      }
	    } else
	          console.log(msg);
	  } catch (e) { 
	     //alert(msg);
	  }
	}
}
/* ------------------------------- */

function initSequence(){
    $.each(initT, function(k,v){
        log(k,'info');
        v();
    });
    initT = null;
}

function showEvent(id){
	$("#"+id).click(function(){
    	if($("#"+id).prop("checked"))
    		$("#"+id+"What").removeClass("hidden");
    	else
    		$("#"+id+"What").addClass("hidden");
    });
}

//In this javascript file you can find a bunk of functional functions
//Calling Actions in ajax. Can be used easily on views
function connectPerson(connectUserId, callback) 
{
	console.log("connect Person");
	$.ajax({
		type: "POST",
		url: baseUrl+"/"+moduleId+'/person/follows',
		dataType : "json",
		data : {
			connectUserId : connectUserId,
		}
	})
	.done(function (data) {
		$.unblockUI();
		if (data &&  data.result) {
			var name = $("#newInvite #ficheName").text();
			toastr.success('You are now following '+name);
			if (typeof callback == "function") callback(data.invitedUser);
		} else {
			$.unblockUI();
			toastr.error('Something Went Wrong !');
		}
		
	});
	
}


/*function disconnectPerson(idToDisconnect, typeToDisconnect, nameToDisconnect, callback) 
{

	bootbox.confirm(trad.areyousure+" <span class='text-red'>"+nameToDisconnect+"</span> "+trad.connection+" ?", 
		function(result) {
			if (!result) {
				return;
			}
			var urlToSend = baseUrl+"/"+moduleId+"/person/disconnect/id/"+idToDisconnect+"/type/"+typeToDisconnect+"/ownerLink/knows";
			$.ajax({
				type: "POST",
				url: urlToSend,
				dataType: "json",
				success: function(data){
					if ( data && data.result ) {               
						toastr.info("You are not following this person anymore.");
						if (typeof callback == "function") callback(idToDisconnect, typeToDisconnect, nameToDisconnect);
					} else {
						toastr.error(data.msg);
					}
				},
				error: function(data) {
					toastr.error("Something went really bad !");
				}
			});
		}
	);
}*/

function disconnectTo(parentType,parentId,childId,childType,connectType, callback){
	$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
	var formData = {
		"childId" : childId,
		"childType" : childType, 
		"parentType" : parentType,
		"parentId" : parentId,
		"connectType" : connectType,
	};
	bootbox.confirm(trad["removeconnection"], 
		function(result) {
			if (!result) {
			$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
			return;
		}
		console.log(formData);
		$.ajax({
			type: "POST",
			url: baseUrl+"/"+moduleId+"/link/disconnect",
			data : formData,
			dataType: "json",
			success: function(data){
				if ( data && data.result ) {
					type=formData.parentType;
					if(formData.parentType==  "citoyens")
						type="people";
					removeFloopEntity(data.parentId, type);
					toastr.success("Le lien a été supprimé avec succès");
					if (typeof callback == "function") 
						callback();
					else
						loadByHash(location.hash);
				} else {
				   toastr.error("You leave succesfully");
				}
			}
		});
	});
}

// Javascript function used to validate a link between parent and child (ex : member, admin...)
function validateConnection(parentType, parentId, childId, childType, linkOption, callback) {
	var formData = {
		"childId" : childId,
		"childType" : childType, 
		"parentType" : parentType,
		"parentId" : parentId,
		"linkOption" : linkOption,
	};

	$.ajax({
		type: "POST",
		url: baseUrl+"/"+moduleId+"/link/validate",
		data: formData,
		dataType: "json",
		success: function(data) {
			if (data.result) {
				if (typeof callback == "function") callback(parentType, parentId, childId, childType, linkOption);
			} else {
				toastr.error(data.msg);
			}
		},
	});  
}
function follow(parentType, parentId, childId, childType, callback){
	$(".followBtn").removeClass("fa-link").addClass("fa-spinner fa-spin");
	var formData = {
		"childId" : childId,
		"childType" : childType, 
		"parentType" : parentType,
		"parentId" : parentId,
	};
	$.ajax({
		type: "POST",
		url: baseUrl+"/"+moduleId+"/link/follow",
		data: formData,
		dataType: "json",
		success: function(data) {
			if(data.result){
				if (formData.parentType)
					addFloopEntity(formData.parentId, formData.parentType, data.parentEntity);
				toastr.success(data.msg);	
				if (typeof callback == "function") 
					callback();
				else
					loadByHash(location.hash);
			}
			else
				toastr.error(data.msg);
		},
	});
}
function connectTo(parentType, parentId, childId, childType, connectType, parentName, actionAdmin) {
	$(".becomeAdminBtn").removeClass("fa-user-plus").addClass("fa-spinner fa-spin");
	var formData = {
		"childId" : childId,
		"childType" : childType, 
		"parentType" : parentType,
		"parentId" : parentId,
		"connectType" : connectType,
	};
	console.log(formData);
	
	if(connectType!="admin" && connectType !="attendee"){
		bootbox.dialog({
                title: trad["suretojoin"+parentType]+" "+trad["as"+connectType]+" ?",
                onEscape: function() {
	                $(".becomeAdminBtn").removeClass("fa-spinner fa-spin").addClass("fa-user-plus");
                },
                message: '<div class="row">  ' +
                    '<div class="col-md-12"> ' +
                    '<form class="form-horizontal"> ' +
                    '<label class="col-md-4 control-label" for="awesomeness">'+trad["areyouadmin"]+'?</label> ' +
                    '<div class="col-md-4"> <div class="radio"> <label for="awesomeness-0"> ' +
                    '<input type="radio" name="awesomeness" id="awesomeness-0" value="admin"> ' +
                    trad["yes"]+' </label> ' +
                    '</div><div class="radio"> <label for="awesomeness-1"> ' +
                    '<input type="radio" name="awesomeness" id="awesomeness-1" value="'+connectType+'" checked="checked"> '+trad["no"]+' </label> ' +
                    '</div> ' +
                    '</div> </div>' +
                    '</form></div></div>',
                buttons: {
                    success: {
                        label: "Ok",
                        className: "btn-primary",
                        callback: function () {
                            var role = $('#role').val();
                            var answer = $("input[name='awesomeness']:checked").val();
                            if(role!=""){
	                            formData.roles=role;
                            }
                            formData.connectType=answer;
                            console.log(formData);
                            $.ajax({
								type: "POST",
								url: baseUrl+"/"+moduleId+"/link/connect",
								data: formData,
								dataType: "json",
								success: function(data) {
									if(data.result){
										addFloopEntity(data.parent["_id"]["$id"], data.parentType, data.parent);
										toastr.success(data.msg);	
										loadByHash(location.hash);
									}
									else
										toastr.error(data.msg);
								},
							});  
                        }
                    }
                }
            }
        );
    }
	else{
		messageBox=trad["suretojoin"+parentType];
		if (connectType=="admin")
			messageBox += trad["as"+connectType];
		bootbox.confirm( messageBox+" ?", 
		function(result) {
			if (!result) {
				$(".becomeAdminBtn").removeClass("fa-spinner fa-spin").addClass("fa-user-plus");
				return;
			}
			console.log(formData);
			$.ajax({
				type: "POST",
				url: baseUrl+"/"+moduleId+"/link/connect",
				data: formData,
				dataType: "json",
				success: function(data) {
					if(data.result){
						addFloopEntity(data.parent["_id"]["$id"], data.parentType, data.parent);
						toastr.success(data.msg);	
						loadByHash(location.hash);
					}
					else
						toastr.error(data.msg);
				},
			});  
		});             
	}
}		
var loadableUrls = {
	"#organization.addorganizationform" : {title:"ADD AN ORGANIZATION ", icon : "users","login":true},
	"#person.invite": {title:'INVITE SOMEONE', icon : "share-alt","login":true},
	"#event.eventsv": {title:'ADD AN EVENT', icon : "calendar","login":true},
	"#project.projectsv": {title:'ADD A PROJECT', icon : 'lightbulb-o','urlExtra':'/id/'+userId+'/type/citoyen',"login":true},
	"#person.directory" : {title:"PERSON DIRECTORY ", icon : "share-alt"},
	"#organization.directory" : {title:"ORGANIZATION MEMBERS ", icon : "users"},
	"#project.directory" : {title:"PROJECT CONTRIBUTORS ", icon : "users"},
	"#project.simply" : {title:"PROJECT CONTRIBUTORS ", icon : "users"},
	//"#city.directory" : {title:"CITY DIRECTORY ", icon : "bookmark fa-rotate-270","urlExtraParam":"tpl=directory2"},
	"#city.opendata" : {title:'STATISTICS ', icon : 'line-chart' },
    "#person.detail" : {title:'PERSON DETAIL ', icon : 'user' },
    "#person.invite" : {title:'PERSON INVITE ', icon : 'user' },
    "#person.changepassword" : {title:'Change your password ', icon : 'fa-lock' },
    "#event.detail" : {title:'EVENT DETAIL ', icon : 'calendar' },
    "#project.detail" : {title:'PROJECT DETAIL ', icon : 'lightbulb-o' },
    "#project.addchartsv" : {title:'EDIT CHART ', icon : 'puzzle-piece' },
    "#gantt.addtimesheetsv" : {title:'EDIT TIMELINE ', icon : 'tasks' },
    "#news.detail" : {title:'NEWS DETAIL ', icon : 'rss' },
    "#organization.detail" : {title:'ORGANIZATION DETAIL ', icon : 'users' },
    "#organization.simply" : {title:'ORGANIZATION DETAIL ', icon : 'users' },
    "#need.detail" : {title:'NEED DETAIL ', icon : 'cubes' },
    "#city.detail" : {title:'CITY ', icon : 'university' },
    "#survey.entry.id" : {title:'VOTE LOCAL ', icon : 'legal'},
    "#rooms" : {title:'ACTION ROOMS ', icon : 'cubes'},
    "#admin.checkgeocodage" : {title:'CHECKGEOCODAGE ', icon : 'download'},
    "#admin.openagenda" : {title:'OPENAGENDA ', icon : 'download'},
    "#admin.adddata" : {title:'ADDDATA ', icon : 'download'},
    "#admin.importdata" : {title:'IMPORT DATA ', icon : 'download'},
    "#admin.index" : {title:'IMPORT DATA ', icon : 'download'},
    "#admin.sourceadmin" : {title:'SOURCE ADMIN', icon : 'download'},
    "#admin.checkcities" : {title:'SOURCE ADMIN', icon : 'download'},
    "#admin.directory" : {title:'IMPORT DATA ', icon : 'download'},
	"#log.monitoring" : {title:'LOG MONITORING ', icon : 'plus'},
    "#adminpublic.index" : {title:'SOURCE ADMIN', icon : 'download'},
    "#default.directory" : {title:'COMMUNECTED DIRECTORY', icon : 'connectdevelop',"urlExtraParam":"isSearchDesign=1"},
    "#default.simplydirectory" : {title:'COMMUNECTED NEWS ', icon : 'rss' },
    "#default.simplydirectory2" : {title:'COMMUNECTED NEWS ', icon : 'rss' },
    "#default.news" : {title:'COMMUNECTED NEWS ', icon : 'rss' },
    "#default.agenda" : {title:'COMMUNECTED AGENDA ', icon : 'calendar'},
	"#default.home" : {title:'COMMUNECTED HOME ', icon : 'home',"menu":"homeShortcuts"},
	"#default.twostepregister" : {title:'TWO STEP REGISTER', icon : 'home', "menu":"homeShortcuts"},
	"#default.view.page" : {title:'FINANCEMENT PARTICIPATIF ', icon : 'euro'},
	//"#home" : {"alias":"#default.home"},
	"#default.login" : {title:'COMMUNECTED AGENDA ', icon : 'calendar'},
	"#project.addcontributorsv" : {title:'Add contributors', icon : 'plus'},
	"#organization.addmember" : {title:'Add Members ', icon : 'plus'},
	"#event.addattendeesv" : {title:'ADD ATTENDEES ', icon : 'plus'},
	"#project.addcontributorsv" : {title:'COMMUNECTED AGENDA ', icon : 'calendar'},
	"#showTagOnMap.tag" : {title:'TAG MAP ', icon : 'map-marker', action:function( hash ){ showTagOnMap(hash.split('.')[2])	} },
	"#define." : {title:'TAG MAP ', icon : 'map-marker', action:function( hash ){ showDefinition("explain"+hash.split('.')[1])	} },
	"#data.index" : {title:'OPEN DATA FOR ALL', icon : 'fa-folder-open-o'},
	"#opendata" : {"alias":"#data.index"},
};
function jsController(hash){
	console.log("jsController",hash);
	res = false;
	$(".menuShortcuts").addClass("hide");
	$.each( loadableUrls, function(urlIndex,urlObj)
	{
		//console.log("replaceAndShow2",urlIndex);
		if( hash.indexOf(urlIndex) >= 0 )
		{
			endPoint = loadableUrls[urlIndex];
			//console.log("jsController 2",endPoint,"login",endPoint.login );
			if( typeof endPoint.login == undefined || !endPoint.login || ( endPoint.login && userId ) ){
				//alises are renaming of urls example default.home could be #home
				if( endPoint.alias ){
					endPoint = jsController(endPoint.alias);
					return false;
				} 
				// an action can be connected to a url, and executed
				if( endPoint.action && typeof endPoint.action == "function"){
					endPoint.action(hash);
				} else {
					//classic url management : converts urls by replacing dots to slashes and ajax retreiving and showing the content 
					extraParams = (endPoint.urlExtraParam) ? "?"+endPoint.urlExtraParam : "";
					urlExtra = (endPoint.urlExtra) ? endPoint.urlExtra : "";

					showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+urlExtra+extraParams, endPoint.title,endPoint.icon );

					if(endPoint.menu)
						$("."+endPoint.menu).removeClass("hide");
				}
				res = true;
				return false;
			} else {
				console.warn("PRIVATE SECTION LOGIN FIRST",hash);
				showPanel( "box-login" );
				resetUnlogguedTopBar();
				res = true;
			}
		}
	});
	return res;
}

//back sert juste a differencier un load avec le back btn
//ne sert plus, juste a savoir d'ou vient drait l'appel
function loadByHash( hash , back ) { 
	allReadyLoad = true;
	
	//alert("loadByHash");
    console.warn("loadByHash",hash,back);
    if( jsController(hash) ){
    	console.log("loadByHash >>> jsController",hash);
    }
    else if( hash.indexOf("#panel") >= 0 ){
    	panelName = hash.substr(7);
    	if( (panelName == "box-login" || panelName == "box-register") && userId != "" && userId != null ){
    		loadByHash("#default.home");
    		return false;
    	} else if(panelName == "box-add")
            title = 'ADD SOMETHING TO MY NETWORK';
        else
            title = "WELCOM MUNECT HEY !!!";
        showPanel(panelName,null,title);
    } 
    else if( hash.indexOf("#rooms.index.type") >= 0 ){
        hashT = hash.split(".");
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'ACTIONS in this '+typesLabels[hashT[3]],'rss' );
    }
    else if( hash.indexOf("#news.index.type") >= 0 ){
        hashT = hash.split(".");
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?isFirst=1', 'KESS KISS PASS in this '+typesLabels[hashT[3]],'rss' );

    } 
    else if( hash.indexOf("#city.directory") >= 0 ){
        hashT = hash.split(".");
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" ), 'KESS KISS PASS in this '+typesLabels[hashT[3]],'rss' );
    } 
	else if( hash.indexOf("#need.addneedsv") >= 0 ){
	        hashT = hash.split(".");
	        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" ), 'ADD NEED '+typesLabels[hashT[3]],'cubes' );
	} 
    else 
        showAjaxPanel( '/default/home', 'Home Communecter ','home' );

    location.hash = hash;

    /*if(!back){
    	history.replaceState( { "hash" :location.hash} , null, location.hash ); //changes the history.state
	    console.warn("replaceState history.state",history.state);
	}*/
}

function checkIsLoggued(){
	
}
function resetUnlogguedTopBar() { 
	//replace the loggued toolBar nav by log buttons
	$('.topMenuButtons').html('<button class="btn-top btn btn-success  hidden-xs" onclick="showPanel(\'box-register\');"><i class="fa fa-plus-circle"></i> <span class="hidden-sm hidden-md hidden-xs">Sinscrire</span></button>'+
									' <button class="btn-top btn bg-red  hidden-xs" style="margin-right:10px;" onclick="showPanel(\'box-login\');"><i class="fa fa-sign-in"></i> <span class="hidden-sm hidden-md hidden-xs">Se connecter</span></button>');
}

/* ****************
Generic non-ajax panel loading process 
**************/
function showPanel(box,callback){ 

	$(".my-main-container").scrollTop(0);

  	$(".box").hide(200);
  	showNotif(false);
  	
  	if(isMapEnd) showMap(false);
			
	console.log("showPanel");
	//showTopMenu(false);
	$(".main-col-search").animate({ top: -1500, opacity:0 }, 500 );

	$("."+box).show(500);

	if (typeof callback == "function") {
		callback();
	}
}

/* ****************
Generic ajax panel loading process 
loads any REST Url endpoint returning HTML into the content section
also switches the global Title and Icon
**************/
function showAjaxPanel (url,title,icon) { 
	//$(".main-col-search").css("opacity", 0);
	console.log("showAjaxPanel",url,"TITLE",title);
	hideScrollTop = false;

	var rand = Math.floor((Math.random() * 7) + 1); 
	var urlImgRand = proverbs[rand];
	
	showNotif(false);
			
	$(".main-col-search").animate({ top: -1500, opacity:0 }, 800 );

	setTimeout(function(){
		$(".main-col-search").html("");
		$(".hover-info").hide();
		 $.blockUI({
		 	message : '<h2 class="homestead text-dark padding-10"><i class="fa fa-spin fa-circle-o-notch"></i> Chargement en cours...</h2>' +
		 	//"<h2 class='text-red homestead'>Lancement du crowdfouding : lundi 22 février</h2>" +
		 	"<img style='max-width:60%; margin-bottom:20px;' src='"+urlImgRand+"'>"
		 	//"<img src='<?php echo $this->module->assetsUrl?>/images/crowdfoundez.png'/>"
		 	//"<h2 class='text-red homestead'>ouverture du site : lundi 29 février</h2>"
		 });
		$(".moduleLabel").html("<i class='fa fa-spin fa-circle-o-notch'></i>"); //" Chargement en cours ...");
		//$(".main-col-search").show();
		showMap(false);
	}, 800);

	$(".box").hide(200);
	//showPanel('box-ajax');
	icon = (icon) ? " <i class='fa fa-"+icon+"'></i> " : "";
	$(".panelTitle").html(icon+title).fadeIn();
	console.log("GETAJAX",icon+title);
	
	showTopMenu(true);
	userIdBefore = userId;
	setTimeout(function(){
		getAjax('.main-col-search',baseUrl+'/'+moduleId+url,function(data){ 
			/*if(!userId && userIdBefore != userId )
				window.location.reload();*/


			$(".main-col-search").slideDown(); 
			initNotifications(); 
			
			$(".explainLink").click(function() {  
			    showDefinition( $(this).data("id") );
			    return false;
			 });

			$.unblockUI();

			// setTimeout(function(){
			// 	console.log("call timeout MAP MAP");
			// 	getAjax('#mainMap',baseUrl+'/'+moduleId+"/search/mainmap",function(){ 
			// 		toastr.info('<i class="fa fa-check"></i> Cartographie activée');
			// 		showMap(false); 
			// 		$("#btn-toogle-map").show(400);
			// 		//console.log("getAJAX OK timeout MAIN MAP");
					
			// 	},"html");
			// }, 2000);

		},"html");
	}, 800);
}
/* ****************
visualize all tagged elements on a map
**************/
function showTagOnMap (tag) { 

	console.log("showTagOnMap",tag);

	var data = { 	 "name" : tag, 
		 			 "locality" : "",
		 			 "searchType" : [ "persons" ], 
		 			 //"searchBy" : "INSEE",
            		 "indexMin" : 0, 
            		 "indexMax" : 500  
            		};

        //$(".moduleLabel").html("<i class='fa fa-spin fa-circle-o-notch'></i> Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>");
		
		$.blockUI({
			message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i> Recherches des collaborateurs ...</h1>"
		});

		showMap(true);
		
		$.ajax({
	      type: "POST",
	          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
	          data: data,
	          dataType: "json",
	          error: function (data){
	             console.log("error"); console.dir(data);          
	          },
	          success: function(data){
	            if(!data){ toastr.error(data.content); }
	            else{
	            	console.dir(data);
	            	Sig.showMapElements(Sig.map, data);
	            	//$(".moduleLabel").html("<i class='fa fa-connect-develop'></i> Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>");
					//$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté : " + cityNameCommunexion + ', ' + cpCommunexion);
					//toastr.success('Vous êtes communecté !<br/>' + cityNameCommunexion + ', ' + cpCommunexion);
					$.unblockUI();
	            }
	          }
	 	});

	//loadByHash('#project.detail.id.56c1a474f6ca47a8378b45ef',null,true);
	//Sig.showFilterOnMap(tag);
}

/* ****************
show a definition in the focus menu panel
**************/
function showDefinition( id ){
	console.log("showDefinition",id);
	$(".main-col-search").animate({ opacity:0.3 }, 400 );
	$(".hover-info").css("display" , "inline");
	toggle( "."+id , ".explain" );
	$("."+id+" .explainDesc").removeClass("hide");
	return false;
}

var timeoutHover = setTimeout(function(){}, 0);
var hoverPersist = false;
var positionMouseMenu = "out";

function activateHoverMenu () { 
	//console.log("enter all");
	positionMouseMenu = "in";
	$(".main-col-search").animate({ opacity:0.3 }, 400 );
	$(".lbl-btn-menu-name").show(200);
	$(".lbl-btn-menu-name").css("display", "inline");
	$(".menu-button-title").addClass("large");

	showInputCommunexion();

	hoverPersist = false;
	clearTimeout(timeoutHover);
	timeoutHover = setTimeout(function(){
		hoverPersist = true;
	}, 1000);
}

function openMenuSmall () { 
	menuContent = $(".menuSmall").html();
	$.blockUI({ 
		title:    'Welcome to your page', 
		message : menuContent,
		onOverlayClick: $.unblockUI,
        css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: 'rgba(0,0,0,0.7)', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            color: '#fff' ,
        	"cursor": "pointer"
        },
		overlayCSS: { backgroundColor: '#000'}
	});
	$(".blockPage").addClass("menuSmallBlockUI");
}


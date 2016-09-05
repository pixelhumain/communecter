var debug = true;
var countPoll = 0;
$(document).ready(function() { 
	initSequence();
	setTimeout( function () { checkPoll() }, 10000);

});

function checkPoll(){
	countPoll++;
	console.log("countPoll",countPoll,"currentUrl",currentUrl);
	//refactor check Log to use only one call with pollParams 
	//returning multple server checks in a unique ajax call
	if(userId){
		_checkLoggued();
		refreshNotifications();
	}
	
	//according to the loaded page 
	//certain checks can be made  
	if(currentUrl.indexOf( "#comment.index.type.actionRooms.id" ) >= 0 )
		checkCommentCount();

	if(countPoll < 100){
		setTimeout( function () { checkPoll() }, 300000); //every5min
		countPoll++;
	}
}
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
		
	  },
	  dataType: "json"
	});
}

function updateField(type,id,name,value,reload){ 
    	
	$.ajax({
	  type: "POST",
	  url: baseUrl+"/"+moduleId+"/"+type+"/updatefield", 
	  data: { "pk" : id ,"name" : name, "value" : value },
	  success: function(data){
		if(data.result) {
        	toastr.success(data.msg);
        	if(reload)
        		loadByHash(location.hash);
		}
        else
        	toastr.error(data.msg);  
	  },
	  dataType: "json"
	});
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

function disconnectTo(parentType,parentId,childId,childType,connectType, callback) {
	var messageBox = trad["removeconnection"];
	$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
	var formData = {
		"childId" : childId,
		"childType" : childType, 
		"parentType" : parentType,
		"parentId" : parentId,
		"connectType" : connectType,
	};
	bootbox.dialog({
        onEscape: function() {
            $(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
        },
        message: '<div class="row">  ' +
            '<div class="col-md-12"> ' +
            '<span>'+messageBox+' ?</span> ' +
            '</div></div>',
        buttons: {
            success: {
                label: "Ok",
                className: "btn-primary",
                callback: function () {
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
                }
            },
            cancel: {
            	label: trad["cancel"],
            	className: "btn-secondary",
            	callback: function() {
            		$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
            	}
            }
        }
    });      
};

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
	if(parentType=="events" && connectType=="attendee")
		$(".connectBtn").removeClass("fa-link").addClass("fa-spinner fa-spin");
	else
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
									else{
										if(typeof(data.type)!="undefined" && data.type=="info")
											toastr.info(data.msg);
										else
											toastr.error(data.msg);
									}
								},
							});  
                        }
                    },
                    cancel: {
                    	label: trad["cancel"],
                    	className: "btn-secondary",
                    	callback: function() {
                    		$(".becomeAdminBtn").removeClass("fa-spinner fa-spin").addClass("fa-user-plus");
                    	}
                    }
                }
            }
        );
    }
	else{
		messageBox=trad["suretojoin"+parentType];;
		if (connectType=="admin")
			messageBox += " " + trad["as"+connectType];
		bootbox.dialog({
                onEscape: function() {
	                $(".becomeAdminBtn").removeClass("fa-spinner fa-spin").addClass("fa-user-plus");
                },
                message: '<div class="row">  ' +
                    '<div class="col-md-12"> ' +
                    '<span>'+messageBox+' ?</span> ' +
                    '</div></div>',
                buttons: {
                    success: {
                        label: "Ok",
                        className: "btn-primary",
                        callback: function () {
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
									else{
										if(typeof(data.type)!="undefined" && data.type=="info")
											toastr.info(data.msg);
										else
											toastr.error(data.msg);
									}
								},
							});   
                        }
                    },
                    cancel: {
                    	label: trad["cancel"],
                    	className: "btn-secondary",
                    	callback: function() {
                    		$(".becomeAdminBtn").removeClass("fa-spinner fa-spin").addClass("fa-user-plus");
                    	}
                    }
                }
            }
        );      
	}
}		

var loadableUrls = {
	"#organization.addorganizationform" : {title:"ADD AN ORGANIZATION ", icon : "users","login":true},
	"#person.invite": {title:'INVITE SOMEONE', icon : "share-alt","login":true},
	"#event.eventsv": {title:'ADD AN EVENT', icon : "calendar","login":true},
	"#project.projectsv": {title:'ADD A PROJECT', icon : 'lightbulb-o',"login":true},
	"#person.directory" : {title:"PERSON DIRECTORY ", icon : "share-alt"},
	"#organization.directory" : {title:"ORGANIZATION MEMBERS ", icon : "users"},
	"#project.directory" : {title:"PROJECT CONTRIBUTORS ", icon : "users"},
	"#event.directory" : {title:"EVENT VISUALISATION ", icon : "calendar"},
	"#event.calendarview" : {title:"EVENT CALENDAR ", icon : "calendar"},
	//"#city.directory" : {title:"CITY DIRECTORY ", icon : "bookmark fa-rotate-270","urlExtraParam":"tpl=directory2"},
	"#city.opendata" : {title:'STATISTICS ', icon : 'line-chart' },
    "#person.detail" : {title:'PERSON DETAIL ', icon : 'user' },
    "#person.invite" : {title:'PERSON INVITE ', icon : 'user' },
    "#person.changepassword" : {title:'Change your password ', icon : 'fa-lock' },
    "#person.updateprofil" : {title:'Update profil', icon : 'fa-lock' },
    "#person.telegram" : {title:'CONTACT PERSON VIA TELEGRAM ', icon : 'send' },
    "#event.detail" : {title:'EVENT DETAIL ', icon : 'calendar' },
    "#project.detail" : {title:'PROJECT DETAIL ', icon : 'lightbulb-o' },
    "#project.addchartsv" : {title:'EDIT CHART ', icon : 'puzzle-piece' },
    "#gantt.addtimesheetsv" : {title:'EDIT TIMELINE ', icon : 'tasks' },
    "#news.detail" : {title:'NEWS DETAIL ', icon : 'rss' },
    "#news.index.type" : {title:'NEWS INDEX ', icon : 'rss', menuId:"menu-btn-news-network","urlExtraParam":"isFirst=1" },
    "#organization.detail" : {title:'ORGANIZATION DETAIL ', icon : 'users' },
    "#need.detail" : {title:'NEED DETAIL ', icon : 'cubes' },
    "#city.detail" : {title:'CITY ', icon : 'university', menuId:"btn-geoloc-auto-menu" },
    "#city.statisticPopulation" : {title:'CITY ', icon : 'university' },
    "#news" : {title:'NEWS ', icon : 'rss'},
    "#survey" : {title:'VOTE LOCAL ', icon : 'legal'},
    "#rooms.index.type.cities" : {title:'ACTION ROOMS ', icon : 'cubes', menuId:"btn-citizen-council-commun"},
    "#rooms" : {title:'ACTION ROOMS ', icon : 'cubes'},
    "#rooms.editroom" : {title:'ADD A ROOM ', icon : 'plus', action:function(){ editRoomSV ();	}},

    "#comment" : {title:'DISCUSSION ROOMS ', icon : 'comments'},
    "#admin.checkgeocodage" : {title:'CHECKGEOCODAGE ', icon : 'download'},
    "#admin.openagenda" : {title:'OPENAGENDA ', icon : 'download'},
    "#admin.adddata" : {title:'ADDDATA ', icon : 'download'},
    "#admin.importdata" : {title:'IMPORT DATA ', icon : 'download'},
    "#admin.index" : {title:'IMPORT DATA ', icon : 'download'},
    "#admin.sourceadmin" : {title:'SOURCE ADMIN', icon : 'download'},
    "#admin.checkcities" : {title:'SOURCE ADMIN', icon : 'download'},
    "#admin.directory" : {title:'IMPORT DATA ', icon : 'download'},
    "#admin.moderate" : {title:'MODERATE ', icon : 'download'},
	"#log.monitoring" : {title:'LOG MONITORING ', icon : 'plus'},
    "#adminpublic.index" : {title:'SOURCE ADMIN', icon : 'download'},
    "#default.directory" : {title:'COMMUNECTED DIRECTORY', icon : 'connectdevelop', menuId:"menu-btn-directory"},
    "#default.news" : {title:'COMMUNECTED NEWS ', icon : 'rss', menuId:"menu-btn-news" },
    "#default.agenda" : {title:'COMMUNECTED AGENDA ', icon : 'calendar', menuId:"menu-btn-agenda"},
	"#default.home" : {title:'COMMUNECTED HOME ', icon : 'home',"menu":"homeShortcuts"},
	"#default.twostepregister" : {title:'TWO STEP REGISTER', icon : 'home', "menu":"homeShortcuts"},
	"#default.view.page" : {title:'FINANCEMENT PARTICIPATIF ', icon : 'euro'},
	
	//"#home" : {"alias":"#default.home"},
    "#stat.chartglobal" : {title:'STATISTICS ', icon : 'bar-chart'},
    "#stat.chartlogs" : {title:'STATISTICS ', icon : 'bar-chart'},

    "#default.live" : {title:"FLUX'Direct" , icon : 'heartbeat'},
	"#default.login" : {title:'COMMUNECTED AGENDA ', icon : 'calendar'},
	"#project.addcontributorsv" : {title:'Add contributors', icon : 'plus'},
	"#organization.addmember" : {title:'Add Members ', icon : 'plus'},
	"#event.addattendeesv" : {title:'ADD ATTENDEES ', icon : 'plus'},
	"#project.addcontributorsv" : {title:'COMMUNECTED AGENDA ', icon : 'calendar'},
	"#showTagOnMap.tag" : {title:'TAG MAP ', icon : 'map-marker', action:function( hash ){ showTagOnMap(hash.split('.')[2])	} },
	"#define." : {title:'TAG MAP ', icon : 'map-marker', action:function( hash ){ showDefinition("explain"+hash.split('.')[1])	} },
	"#data.index" : {title:'OPEN DATA FOR ALL', icon : 'fa-folder-open-o'},
	"#opendata" : {"alias":"#data.index"},
	"#search" : { "title":'SEARCH AND FIND', "icon" : 'map-search', "hash" : "#default.directory", "preaction":function( hash ){ return searchByHash(hash);} },
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
			checkMenu(urlObj, hash);
		
			endPoint = loadableUrls[urlIndex];
			console.log("jsController 2",endPoint,"login",endPoint.login,endPoint.hash );
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
					//execute actions before teh ajax request
					res = false;
					if( endPoint.preaction && typeof endPoint.preaction == "function")
						res = endPoint.preaction(hash);
					//hash can be iliased
					if (endPoint.hash) 
						hash = endPoint.hash;
					path = hash.replace( "#","" ).replace( /\./g,"/" );
					showAjaxPanel( '/'+path+urlExtra+extraParams, endPoint.title,endPoint.icon, res );
					
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
	currentUrl = hash;
	allReadyLoad = true;
	$(".my-main-container").off(); 
	$(".searchIcon").removeClass("fa-file-text-o").addClass("fa-search");
	searchPage = false;
	
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
    }  else if( hash.indexOf("#gallery.index.id") >= 0 ){
        hashT = hash.split(".");
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" ), 'ACTIONS in this '+typesLabels[hashT[3]],'rss' );
    }
    /*else if( hash.indexOf("#news.index.type") >= 0 ){
        hashT = hash.split(".");
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?isFirst=1', 'KESS KISS PASS in this '+typesLabels[hashT[3]],'rss' );

    } */
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

function setTitle(str, icon, topTitle) { 
	if(icon != "")
		icon = ( icon.indexOf("<i") >= 0 ) ? icon : "<i class='fa fa-"+icon+"'></i> ";
	$(".moduleLabel").html( icon +" "+ str);
	if(topTitle)
		str = topTitle;
	$(document).prop('title', ( str != "" ) ? str : "Communecter, se connecter à sa commune" );
}

//ex : #search:bretagneTelecom:all
//#search:#fablab
//#search:#fablab:all:map
function searchByHash (hash) 
{ 
	var mapEnd = false;
	var searchT = hash.split(':');
	// 1 : is the search term
	var search = searchT[1]; 
	scopeBtn = null;
	// 2 : is the scope
	if( searchT.length > 2 )
	{
		if( searchT[2] == "all" )
			scopeBtn = ".btn-scope-niv-5" ;
		else if( searchT[2] == "region" )
			scopeBtn = ".btn-scope-niv-4" ;
		else if( searchT[2] == "dep" )
			scopeBtn = ".btn-scope-niv-3" ;
		else if( searchT[2] == "quartier" )
			scopeBtn = ".btn-scope-niv-2" ;
	}
	console.log("search : "+search,searchT, scopeBtn);
	$(".input-global-search").val(search);
	//startGlobalSearch();
	if( scopeBtn )
		$(scopeBtn).trigger("click"); 

	if( searchT.length > 3 && searchT[3] == "map" )
		mapEnd = true;
	return mapEnd;
}

function checkMenu(urlObj, hash){
	console.log("checkMenu *******************", hash);
	console.dir(urlObj);
	$(".menu-button-left").removeClass("selected");
	if(typeof urlObj.menuId != "undefined"){ console.log($("#"+urlObj.menuId).data("hash"));
		if($("#"+urlObj.menuId).data("hash") == hash)
			$("#"+urlObj.menuId).addClass("selected");
	}
}

var backUrl = null;
function checkIsLoggued(uId){
	if( uId == "" ||  typeof uId == "undefined" ){
		console.warn("");
		toastr.error("<h1>Section Sécuriser, Merci de vous connecter!</h1>");
		
		setTitle("Section Sécuriser", "user-secret");

		backUrl = location.hash;
		showPanel( "box-login" );
    	
    	resetUnlogguedTopBar();
	}else 
		return true;
}
function resetUnlogguedTopBar() { 
	//put anything that needs to be reset 
	//replace the loggued toolBar nav by log buttons
	$('.topMenuButtons').html('<button class="btn-top btn btn-success  hidden-xs" onclick="showPanel(\'box-register\');"><i class="fa fa-plus-circle"></i> <span class="hidden-sm hidden-md hidden-xs">Sinscrire</span></button>'+
							  ' <button class="btn-top btn bg-red  hidden-xs" style="margin-right:10px;" onclick="showPanel(\'box-login\');"><i class="fa fa-sign-in"></i> <span class="hidden-sm hidden-md hidden-xs">Se connecter</span></button>');
}

function _checkLoggued() { 
	$.ajax({
	  type: "POST",
	  url: baseUrl+"/"+moduleId+"/person/logged",
	  success: function(data){
		if( !data.userId || data.userId == "" ||  typeof data.userId == "undefined" ){
			/*userId = data.userId;
			resetUnlogguedTopBar();*/
			window.location.reload();
		}
	  },
	  dataType: "json"
	});
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
var rand = Math.floor((Math.random() * 7) + 1); 
var urlImgRand = proverbs[rand];
function  processingBlockUi() { 
	$.blockUI({
	 	message : '<h4 style="font-weight:300" class=" text-dark padding-10"><i class="fa fa-spin fa-circle-o-notch"></i><br>Chargement en cours...</h4>' //+
	    //"<img style='max-width:60%; margin-bottom:20px;' src='"+urlImgRand+"'>"
	 });
}
function showAjaxPanel (url,title,icon, mapEnd) { 
	//$(".main-col-search").css("opacity", 0);
	console.log("showAjaxPanel",url,"TITLE",title);
	hideScrollTop = false;

	showNotif(false);
			
	//$(".main-col-search").animate({ top: -1500, opacity:0 }, 800 );

	setTimeout(function(){
		$(".main-col-search").html("");
		$(".hover-info,.hover-info2").hide();
		processingBlockUi();
		setTitle("Chargement en cours ...", "spin fa-circle-o-notch");
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
		getAjax('.main-col-search', baseUrl+'/'+moduleId+url, function(data){ 
			/*if(!userId && userIdBefore != userId )
				window.location.reload();*/


			//$(".main-col-search").slideDown(); 
			initNotifications(); 
			
			bindExplainLinks();
			bindTags();
			bindLBHLinks();

			$.unblockUI();

			if(mapEnd)
				showMap(true);
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

        //setTitle("", "");$(".moduleLabel").html("<i class='fa fa-spin fa-circle-o-notch'></i> Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>");
		
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
	            	//setTitle("", "");$(".moduleLabel").html("<i class='fa fa-connect-develop'></i> Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>");
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
function showDefinition( id,copySection ){ 

	setTimeout(function(){
		console.log("showDefinition",id,copySection);
		$(".hover-info,.hover-info2").hide();
		$(".main-col-search").animate({ opacity:0.3 }, 400 );
		
		if(copySection){
			contentHTML = $("."+id).html();
			if(copySection != true)
				contentHTML = copySection;
			$(".hover-info2").css("display" , "inline").html( contentHTML );
			bindExplainLinks()	
		}
		else {
			$(".hover-info").css("display" , "inline");
			toggle( "."+id , ".explain" );
			$("."+id+" .explainDesc").removeClass("hide");
		}
		return false;
	}, 500);
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
         //    border: 'none', 
         //    padding: '15px', 
         //    backgroundColor: 'rgba(0,0,0,0.7)', 
         //    '-webkit-border-radius': '10px', 
         //    '-moz-border-radius': '10px', 
         //    color: '#fff' ,
        	// "cursor": "pointer"
        },
		overlayCSS: { backgroundColor: '#000'}
	});
	$(".blockPage").addClass("menuSmallBlockUI");
}

var selection;
function  bindHighlighter() { 
	//console.clear();  
	console.log("bindHighlighter");
  	console.dir(window.getSelection());
	$(".my-main-container").bind('mouseup', function(e){
		if (window.getSelection) {
	      selection = window.getSelection();
	    } else if (document.selection) {
	      selection = document.selection.createRange();
	    }
	    selTxt = selection.toString();
	    if( selTxt){
	    	//alert(selTxt);
	    	/*
	    	if($(".selBtn").length)
	    		$(".selBtn").remove();
	    	links = "<a href='javascript:;' onclick='fastAdd(\"/rooms/fastaddaction\")' class='selBtn text-bold btn btn-purple btn-xs'><i class='fa fa-cogs'></i> créer en action <i class='fa fa-plus'></i></a>"+
	    			" <a href='javascript:;'  onclick='fastAdd(\"/survey/fastaddentry\")' class='selBtn text-bold btn btn-purple btn-xs'><i class='fa fa-archive'></i> créer en proposition <i class='fa fa-plus'></i></a>";

	    	$(this).parent().find("div.bar_tools_post").append(links);
	    	*/
	    }
	});
}

function  bindTags() { 
	console.log("bindTags");
	//var tagClasses = ".tag,.label tag_item_map_list"
	$(".tag,.label tag_item_map_list").off().on('click', function(e){
		//if(userId){
			var tag = ($(this).data("val")) ? $(this).data("val") : $(this).html();
			//alert(tag);
			//showTagInMultitag(tag);
			//$('#btn-modal-multi-tag').trigger("click");
			//$('.tags-count').html( $(".item-tag-name").length );
			if(addTagToMultitag(tag))
				toastr.success("Le tag \""+tag+"\" ajouté à vos favoris");
			else
				toastr.info("Le tag \""+tag+"\" est déjà dans vos tags favoris");
			
		//} else {
		//	toastr.error("must be loggued");
		//}
	});
}

function  bindExplainLinks() { 
	$(".explainLink").click(function() {  
	    showDefinition( $(this).data("id") );
	    return false;
	 });
}

function  bindLBHLinks() { 
	$("a.lbh").off().on("click",function() {  
		console.warn("***************************************");
		console.warn("bindLBHLinks",$(this).attr("href"));
		console.warn("***************************************");
		var h = ($(this).data("hash")) ? $(this).data("hash") : $(this).attr("href");
	    loadByHash( h );
	});
}

function bindRefreshBtns() { console.log("bindRefreshBtns");
	if( $("#dropdown_search").length || $(".newsTL").length)
	{
		var searchFeed = "#dropdown_search";
		var method = "startSearch(0, indexStepInit);"
		if( $(".newsTL").length){
			searchFeed = ".newsTL";
			method = "reloadNewsSearch();"
		}
	    $('#scopeListContainer .item-scope-checker, #scopeListContainer .item-tag-checker, .btn-filter-type').click(function(e){
	          //console.warn( ">>>>>>>",$(this).data("scope-value"), $(this).data("tag-value"), $(this).attr("type"));
	          str = '<div class="center" id="footerDropdown">';
	          str += "<hr style='float:left; width:100%;'/><label style='margin-bottom:10px; margin-left:15px;' class='text-dark'>Relancer la Recherche, les critères ont changés</label><br/>";
	          str += '<button class="btn btn-default" onclick="'+method+'"><i class="fa fa-refresh"></i> Relancer la Recherche</div></center>';
	          str += "</div>";
	          if(location.hash.indexOf("#news.index")==0 || location.hash.indexOf("#city.detail")==0){  console.log("vide news stream perso");
		          $(".newsFeedNews, #backToTop, #footerDropdown").remove();
		          $(searchFeed).append( str );
		      }else { console.log("vide autre news stream perso", searchFeed);
		          $(searchFeed).html( str );
		      }
		      $(".search-loader").html("<i class='fa fa-ban'></i>");
	    });
	}
}
function hideSearchResults(){
	var searchFeed = "#dropdown_search";
		var method = "startSearch(0, indexStepInit);"
		if( $(".newsTL").length){
			searchFeed = ".newsTL";
			method = "reloadNewsSearch();"
		}
      //console.warn( ">>>>>>>",$(this).data("scope-value"), $(this).data("tag-value"), $(this).attr("type"));
      str = '<div class="center" id="footerDropdown">';
      str += "<hr style='float:left; width:100%;'/><label style='margin-bottom:10px; margin-left:15px;' class='text-dark'>Relancer la Recherche, les critères ont changés</label><br/>";
      str += '<button class="btn btn-default" onclick="'+method+'"><i class="fa fa-refresh"></i> Relancer la Recherche</div></center>';
      str += "</div>";
      if(location.hash.indexOf("#news.index")==0 || location.hash.indexOf("#city.detail")==0){  console.log("vide news stream perso");
          $(".newsFeedNews, #backToTop, #footerDropdown").remove();
          $(searchFeed).append( str );
      }else { console.log("vide autre news stream perso", searchFeed);
          $(searchFeed).html( str );
      }
      $(".search-loader").html("<i class='fa fa-ban'></i>");
	    
}
function reloadNewsSearch(){
	if(location.hash.indexOf("#default.live")==0)
    	startSearch(false);
	else{
		dateLimit = 0;
		loadStream(0, 5);
	}
}
/* **************************************
maybe movebale into Element.js
***************************************** */

var typeObj = {
	"person" : {col:"citoyens",ctrl:"person"},
	"persons" : {col:"citoyens",ctrl:"person"},
	"citoyen" : {col:"citoyens",ctrl:"person"},
	"citoyens" : {col:"citoyens",ctrl:"person"},
	"organization" : {col:"organizations",ctrl:"organization"},
	"organizations" : {col:"organizations",ctrl:"organization"},
	"event" : {col:"events",ctrl:"event"},
	"events" : {col:"events",ctrl:"event"},
	"projects" : {col:"projects",ctrl:"project"},
	"project" : {col:"projects",ctrl:"project"},
	"city" : {col:"cities",ctrl:"city"},
	"cities" : {col:"cities",ctrl:"city"},
	"entry" : {col:"surveys",ctrl:"survey"},
	"vote" : {col:"actionRooms",ctrl:"survey"},
	"action" : {col:"actions",ctrl:"room"},
	"actions" : {col:"actions",ctrl:"room"},
	"discuss" : {col:"actionRooms",ctrl:"room"},
}

function  buildQRCode(type,id) { 
		
	$(".qrCode").qrcode({
	    text: baseUrl+"/"+moduleId+"#"+type+".detail.id"+id,//'{type:"'+type+'",_id:"'+id+'"}',
	    render: 'image',
		minVersion: 8,
	    maxVersion: 40,
	    ecLevel: 'L',
	    size: 150,
	    radius: 0,
	    quiet: 2,
	    /*mode: 2,
	    mSize: 0.1,
	    mPosX: 0.5,
	    mPosY: 0.5,

	    label: name,
	    fontname: 'Ubuntu',
	    fontcolor: '#E33551',*/
	});
}

function activateSummernote(elem) { 
		
	if( !$('script[src="'+baseUrl+'/themes/ph-dori/assets/plugins/summernote/dist/summernote.min.js"]').length )
	{
		$("<link/>", {
		   rel: "stylesheet",
		   type: "text/css",
		   href: baseUrl+"/themes/ph-dori/assets/plugins/summernote/dist/summernote.css"
		}).appendTo("head");
		$.getScript( baseUrl+"/themes/ph-dori/assets/plugins/summernote/dist/summernote.min.js", function( data, textStatus, jqxhr ) {
		  //console.log( data ); // Data returned
		  //console.log( textStatus ); // Success
		  //console.log( jqxhr.status ); // 200
		  //console.log( "Load was performed." );
		  
		  $(".btnEditAdv").hide();
		  $(elem).summernote({
				toolbar: [
					['style', ['bold', 'italic', 'underline', 'clear']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
				]
			});
		});
	} else {
		$(".btnEditAdv").hide();
		$(elem).summernote({
				toolbar: [
					['style', ['bold', 'italic', 'underline', 'clear']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
				]
		});
	}
}

function exists(val){
	return typeof val != "undefined";
}
function notNull(val){
	return typeof val != "undefined"
			&& val != null;
}
function notEmpty(val){
	return typeof val != "undefined"
			&& val != null
			&& val != "";
}
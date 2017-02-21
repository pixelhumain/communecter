var countPoll = 0;
$(document).ready(function() { 
	initSequence();
	setTimeout( function () { checkPoll() }, 10000);
	document.onkeyup = checkKeycode;
});

var prevStep = 0;
var steps = ["explain1","live","explain2","event","explain3","orga","explain4","project","explain5","person"];
var slides = {
	explain1 : function() { showDefinition("explainCommunectMe")},
	live : function() { loadByHash("#default.live")},
	explain2 : function() { showDefinition("explainCartographiedeReseau")},
	event : function() { loadByHash("#event.detail.id.57bb4078f6ca47cb6c8b457d")}, 
	explain3 : function() { showDefinition("explainDemoPart")},
	orga : function() { loadByHash("#organization.detail.id.57553776f6ca47b37da93c2d")}, 
	explain4 : function() { showDefinition("explainCommunecter")},
	project : function() { loadByHash("#project.detail.id.56c1a474f6ca47a8378b45ef")},
	explain5 : function() { showDefinition("explainProxicity")},
	person : function() { loadByHash("#person.detail.id.54eda798f6b95cb404000903")} 
};
function runslide(cmd)
{
	if(cmd == 0){
		prevStep = null;
		loadByHash("#default.live");
	}

	if( prevStep != null ){
		slides[ steps[prevStep] ]();
		prevStep = ( prevStep < steps.length - 1 ) ? prevStep+1  : 0;
		setTimeout( function () { 
			runslide();
		 }, 8000);
	}
}

function checkPoll(){
	countPoll++;
	mylog.log("countPoll",countPoll,"currentUrl",currentUrl);
	//refactor check Log to use only one call with pollParams 
	//returning multple server checks in a unique ajax call
	if(userId){
		_checkLoggued();
		if(typeof refreshNotifications != "undefined")
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
var mylog = (function () {
    
    return {
        log: function() {
          if(debug){
          	var args = Array.prototype.slice.call(arguments);
            console.log.apply(console, args);
        	}
        },
        warn: function() {
            if( debug){
	          	var args = Array.prototype.slice.call(arguments);
	            console.warn.apply(console, args);
	        }
        },
        debug: function() {
            if(debug){
	          	var args = Array.prototype.slice.call(arguments);
	            console.debug.apply(console, args);
	        }
        },
        info: function() {
            if(debug){
	          	var args = Array.prototype.slice.call(arguments);
	            console.info.apply(console, args);
	        }
        },
        dir: function() {
            if(debug){
	          	var args = Array.prototype.slice.call(arguments);
	            console.warn.apply(console, args);
	        }
        },
        error: function() {
            if(debug){
		      	var args = Array.prototype.slice.call(arguments);
		        console.error.apply(console, args);
		    }
        }
    }
}());
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
	mylog.log("connect Person");
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
	mylog.log(formData);
	
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
                            mylog.log(formData);
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
	//directory
	"#person.directory" : {aliasParam: "#element.directory.type.citoyens.id.$id", params: ["id"], title:"PERSON DIRECTORY ", icon : "share-alt"},
	"#organization.directory" : {aliasParam: "#element.directory.type.organizations.id.$id", params: ["id"], title:"ORGANIZATION MEMBERS ", icon : "users"},
	"#project.directory" : {aliasParam: "#element.directory.type.projects.id.$id", params: ["id"], title:"PROJECT CONTRIBUTORS ", icon : "users"},
	"#event.directory" : {aliasParam: "#element.directory.type.events.id.$id", params: ["id"], title:"EVENT VISUALISATION ", icon : "calendar"},
	"#event.calendarview" : {title:"EVENT CALENDAR ", icon : "calendar"},
	//"#city.directory" : {title:"CITY DIRECTORY ", icon : "bookmark fa-rotate-270","urlExtraParam":"tpl=directory2"},
	"#city.opendata" : {title:'STATISTICS ', icon : 'line-chart' },
    "#person.detail" : {aliasParam: "#element.detail.type.citoyens.id.$id", params: ["id"], title:'PERSON DETAIL ', icon : 'user' },
    "#person.invite" : {title:'PERSON INVITE ', icon : 'user' },
    "#person.changepassword" : {title:'Change your password ', icon : 'fa-lock' },
    "#person.updateprofil" : {title:'Update profil', icon : 'fa-lock' },
    "#person.telegram" : {title:'CONTACT PERSON VIA TELEGRAM ', icon : 'send' },
    "#event.detail" : {aliasParam: "#element.detail.type.events.id.$id", params: ["id"],title:'EVENT DETAIL ', icon : 'calendar' },
    "#poi.detail" : {aliasParam: "#element.detail.type.poi.id.$id", params: ["id"],title:'EVENT DETAIL ', icon : 'calendar' },
    "#project.detail" : {aliasParam: "#element.detail.type.projects.id.$id", params: ["id"], title:'PROJECT DETAIL ', icon : 'lightbulb-o' },
    "#project.addchartsv" : {title:'EDIT CHART ', icon : 'puzzle-piece' },
    "#gantt.addtimesheetsv" : {title:'EDIT TIMELINE ', icon : 'tasks' },
    "#news.detail" : {title:'NEWS DETAIL ', icon : 'rss' },
    "#news.index.type" : {title:'NEWS INDEX ', icon : 'rss', menuId:"menu-btn-news-network","urlExtraParam":"isFirst=1" },
    "#organization.detail" : {aliasParam: "#element.detail.type.organizations.id.$id", params: ["id"], title:'ORGANIZATION DETAIL ', icon : 'users' },
    "#need.detail" : {title:'NEED DETAIL ', icon : 'cubes' },
    "#need.addneedsv" : {title:'NEED DETAIL ', icon : 'cubes' },
    "#city.detail" : {title:'CITY ', icon : 'university', menuId:"btn-geoloc-auto-menu" },
    "#city.statisticPopulation" : {title:'CITY ', icon : 'university' },
    "#news" : {title:'NEWS ', icon : 'rss'},
    "#survey" : {title:'VOTE LOCAL ', icon : 'legal'},
    "#rooms.index.type.cities" : {title:'ACTION ROOMS ', icon : 'cubes', menuId:"btn-citizen-council-commun"},
    "#rooms.editroom" : {title:'ADD A ROOM ', icon : 'plus', action:function(){ editRoomSV ();	}},
	"#rooms" : {title:'ACTION ROOMS ', icon : 'cubes'},
    "#element.aroundme" : {title:"Around me" , icon : 'crosshairs', menuId:"menu-btn-around-me"},
	"#element" : {title:'DETAIL ENTITY', icon : 'legal'},
    "#gallery" : {title:'ACTION ROOMS ', icon : 'photo'},
    "#comment" : {title:'DISCUSSION ROOMS ', icon : 'comments'},
    "#admin.checkgeocodage" : {title:'CHECKGEOCODAGE ', icon : 'download'},
    "#admin.openagenda" : {title:'OPENAGENDA ', icon : 'download'},
    "#admin.adddata" : {title:'ADDDATA ', icon : 'download'},
    "#admin.importdata" : {title:'IMPORT DATA ', icon : 'download'},
    "#admin.index" : {title:'IMPORT DATA ', icon : 'download'},
    "#admin.sourceadmin" : {title:'SOURCE ADMIN', icon : 'download'},
    "#admin.checkcities" : {title:'SOURCE ADMIN', icon : 'download'},
    "#admin.directory" : {title:'IMPORT DATA ', icon : 'download'},
    "#admin.mailerrordashboard" : {title:'MAIL ERROR ', icon : 'download'},
    "#admin.moderate" : {title:'MODERATE ', icon : 'download'},
    "#admin.createfile" : {title:'IMPORT DATA', icon : 'download'},
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
    "#network.savoir" : {title:"En savoir plus" , icon : 'plus'},
    "#default.live" : {title:"FLUX'Direct" , icon : 'heartbeat', menuId:"menu-btn-live"},
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
	mylog.log("jsController",hash);
	res = false;
	$(".menuShortcuts").addClass("hide");
	$.each( loadableUrls, function(urlIndex,urlObj)
	{
		//mylog.log("replaceAndShow2",urlIndex);
		if( hash.indexOf(urlIndex) >= 0 )
		{
			checkMenu(urlObj, hash);
		
			endPoint = loadableUrls[urlIndex];
			mylog.log("jsController 2",endPoint,"login",endPoint.login,endPoint.hash );
			if( typeof endPoint.login == undefined || !endPoint.login || ( endPoint.login && userId ) ){
				//alises are renaming of urls example default.home could be #home
				if( endPoint.alias ){
					endPoint = jsController(endPoint.alias);
					return false;
				} 
				if( endPoint.aliasParam ){
					hashT=hash.split(".");
					alias=endPoint.aliasParam;
					$.each(endPoint.params, function(i, v){
						$.each(hashT, function(ui, e){
							if (v == e){
								paramId=hashT[ui+1];
								alias = alias.replace("$"+v, paramId);
							}
						});
					});		
					endPoint = jsController(alias);	
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
					if(hash.indexOf("?") >= 0){
						hashT=hash.split("?");
						mylog.log(hashT);
						hash=hashT[0];
						extraParams = "?"+hashT[1];
					}
					if(extraParams.indexOf("#") >= 0){
						extraParams=extraParams.replace( "#","%hash%" );
					}
					path = hash.replace( "#","" ).replace( /\./g,"/" );
					showAjaxPanel( '/'+path+urlExtra+extraParams, endPoint.title,endPoint.icon, res );
					
					if(endPoint.menu)
						$("."+endPoint.menu).removeClass("hide");
				}
				res = true;
				return false;
			} else {
				mylog.warn("PRIVATE SECTION LOGIN FIRST",hash);
				showPanel( "box-login" );
				resetUnlogguedTopBar();
				res = true;
			}
		}
	});
	return res;
}

 var CoAllReadyLoad = false;
//back sert juste a differencier un load avec le back btn
//ne sert plus, juste a savoir d'ou vient drait l'appel
function loadByHash( hash , back ) {
	/* court circuit du lbh pour changer le type du directory si on est déjà sur une page directory */
	// mylog.log("IS DIRECTORY ? ", 
	// 			hash.indexOf("#default.directory"), 
	// 			location.hash.indexOf("#default.directory"), CoAllReadyLoad);
	if(typeof globalTheme != "undefined" && globalTheme=="network"){
		if( hash.indexOf("#network") >= 0 &&
			location.hash.indexOf("#network") >= 0 || hash=="#" || hash==""){ 
		}
		else{
			count=$(".breadcrumAnchor").length;
			//case on reload view
			if(count==0)
				count=1;
			breadcrumGuide(count, hash);
		}
		
		return ;
	}

	if( hash.indexOf("#default.directory") >= 0 &&
		location.hash.indexOf("#default.directory") >= 0 && CoAllReadyLoad==true){ 
		var n = hash.indexOf("type=")+5;
		var type = hash.substr(n);
		mylog.log("CHANGE directory", type);
		searchType = [type];
		setHeaderDirectory(type);
		loadingData = false;
		startSearch(0, indexStepInit);
		location.hash = hash;
		return;
	}

	currentUrl = hash;
	allReadyLoad = true;
	CoAllReadyLoad = true;
	contextData = null;

	$(".my-main-container").off()
						   .bind("scroll", function () {shadowOnHeader()})
						   .scrollTop(0);

	$(".searchIcon").removeClass("fa-file-text-o").addClass("fa-search");
	searchPage = false;
	

	//alert("loadByHash"+hash);
    mylog.warn("loadByHash",hash,back);
    if( jsController(hash) ){
    	mylog.log("loadByHash >>> jsController",hash);
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
	/*else if( hash.indexOf("#need.addneedsv") >= 0 ){
	        hashT = hash.split(".");
	        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" ), 'ADD NEED '+typesLabels[hashT[3]],'cubes' );
	} 
	else if( hash.indexOf("#need.addneedsv") >= 0 ){
	        hashT = hash.split(".");
	        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" ), 'ADD NEED '+typesLabels[hashT[3]],'cubes' );
	} */

    else 
        showAjaxPanel( '/default/home', 'Home Communecter ','home' );

    location.hash = hash;

    /*if(!back){
    	history.replaceState( { "hash" :location.hash} , null, location.hash ); //changes the history.state
	    mylog.warn("replaceState history.state",history.state);
	}*/
}

function decodeHtml(str) {
	mylog.log("decodeHtml", str);
    var txt = document.createElement("textarea");
    txt.innerHTML = str;
    mylog.log("decodeHtml",  txt.value);
    return txt.value;
}

function setTitle(str, icon, topTitle,keywords,shortDesc) { 
	if(icon != "")
		icon = ( icon.indexOf("<i") >= 0 ) ? icon : "<i class='fa fa-"+icon+"'></i> ";
	$(".moduleLabel").html( icon +" "+ str);
	if(topTitle)
		str = topTitle;
	$(document).prop('title', ( str != "" ) ? str : "Communecter, se connecter à sa commune" );
	if(notNull(keywords))
		$('meta[name="keywords"]').attr("content",keywords);
	else
		$('meta[name="keywords"]').attr("content","communecter,connecter, commun,commune, réseau, sociétal, citoyen, société, territoire, participatif, social, smarterre");
	
	if(notNull(shortDesc))
		$('meta[name="description"]').attr("content",shortDesc);
	else
		$('meta[name="description"]').attr("content","Communecter : Connecter à sa commune, inter connecter les communs, un réseau sociétal pour un citoyen connecté et acteur au centre de sa société.");
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
	mylog.log("search : "+search,searchT, scopeBtn);
	$(".input-global-search").val(search);
	//startGlobalSearch();
	if( scopeBtn )
		$(scopeBtn).trigger("click"); 

	if( searchT.length > 3 && searchT[3] == "map" )
		mapEnd = true;
	return mapEnd;
}

function markdownToHtml (str) { 
	var converter = new showdown.Converter(),
	res = converter.makeHtml(str);
	return res;
}

function checkMenu(urlObj, hash){
	mylog.log("checkMenu *******************", hash);
	mylog.dir(urlObj);
	$(".menu-button-left").removeClass("selected");
	if(typeof urlObj.menuId != "undefined"){ mylog.log($("#"+urlObj.menuId).data("hash"));
		if($("#"+urlObj.menuId).attr("href") == hash)
			$("#"+urlObj.menuId).addClass("selected");
	}
}

var backUrl = null;
function checkIsLoggued(uId){
	if( uId == "" ||  typeof uId == "undefined" ){
		mylog.warn("");
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
			
	mylog.log("showPanel");
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
	mylog.log("showAjaxPanel",url,"TITLE",title);
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
	mylog.log("GETAJAX",icon+title);
	
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
			// 	mylog.log("call timeout MAP MAP");
			// 	getAjax('#mainMap',baseUrl+'/'+moduleId+"/search/mainmap",function(){ 
			// 		toastr.info('<i class="fa fa-check"></i> Cartographie activée');
			// 		showMap(false); 
			// 		$("#btn-toogle-map").show(400);
			// 		//mylog.log("getAJAX OK timeout MAIN MAP");
					
			// 	},"html");
			// }, 2000);

		},"html");
	}, 800);
}
/* ****************
visualize all tagged elements on a map
**************/
function showTagOnMap (tag) { 

	mylog.log("showTagOnMap",tag);

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
	             mylog.log("error"); mylog.dir(data);          
	          },
	          success: function(data){
	            if(!data){ toastr.error(data.content); }
	            else{
	            	mylog.dir(data);
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
		mylog.log("showDefinition",id,copySection);
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
	//mylog.log("enter all");
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
	// If network, check width of menu small
	if(typeof globalTheme != "undefined" && globalTheme == "network"){
		if($("#ficheInfoDetail").is(":visible"))
			$(".menuSmallBlockUI").css("cssText", "width: 100% !important;left: 0% !important;");
		else
			$(".menuSmallBlockUI").css("cssText", "width: 83.5% !important;left: 16.5% !important;");
	}
	bindLBHLinks();
}

var selection;
function  bindHighlighter() { 
	//mylog.clear();  
	mylog.log("bindHighlighter");
  	mylog.dir(window.getSelection());
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
	mylog.log("bindTags");
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
	$(".lbh").off().on("click",function(e) {  		
		e.preventDefault();
		mylog.warn("***************************************");
		mylog.warn("bindLBHLinks",$(this).attr("href"));
		mylog.warn("***************************************");
		var h = ($(this).data("hash")) ? $(this).data("hash") : $(this).attr("href");
	    loadByHash( h );
	});
}

function bindRefreshBtns() { mylog.log("bindRefreshBtns");
	if( $("#dropdown_search").length || $(".newsTL").length)
	{
		var searchFeed = "#dropdown_search";
		var method = "startSearch(0, indexStepInit);"
		if( $(".newsTL").length){
			searchFeed = ".newsTL";
			method = "reloadNewsSearch();"
		}
	    $('#scopeListContainer .item-scope-checker, #scopeListContainer .item-tag-checker, .btn-filter-type').click(function(e){
	          //mylog.warn( ">>>>>>>",$(this).data("scope-value"), $(this).data("tag-value"), $(this).attr("type"));
	          var str = getFooterScopeChanged(method);
	          if(location.hash.indexOf("#news.index")==0 || location.hash.indexOf("#city.detail")==0){  mylog.log("vide news stream perso");
		          $(".newsFeedNews, #backToTop, #footerDropdown").remove();
		          $(searchFeed).append( str );
		      }else { mylog.log("vide autre news stream perso", searchFeed);
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
      //mylog.warn( ">>>>>>>",$(this).data("scope-value"), $(this).data("tag-value"), $(this).attr("type"));
      str = getFooterScopeChanged(method);
      if(location.hash.indexOf("#news.index")==0 || location.hash.indexOf("#city.detail")==0){  mylog.log("vide news stream perso");
          $(".newsFeedNews, #backToTop, #footerDropdown").remove();
          $(searchFeed).append( str );
      }else { mylog.log("vide autre news stream perso", searchFeed);
          $(searchFeed).html( str );
      }
      $(".search-loader").html("<i class='fa fa-ban'></i>");
	    
}
function getFooterScopeChanged(method){
	var str = 	'<div class="padding-15" id="footerDropdown">';
	    str += 		"<hr style='float:left; width:100%;'/>"
	    str += 		'<button class="btn btn-default" onclick="'+method+'"><i class="fa fa-refresh"></i> Relancer la recherche</button>'+
	    	   		"<span style='' class='text-dark padding-10'><i class='fa fa-angle-right'></i> Les critères ont changés</span><br/>";
	    str +=  "</div>";
	return str;  
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




function  buildQRCode(type,id) { 
		
	$(".qrCode").qrcode({
	    text: baseUrl+"/#"+typeObj[type].ctrl+".detail.id."+id,//'{type:"'+type+'",_id:"'+id+'"}',
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
		
	if( !$('script[src="'+baseUrl+'/plugins/summernote/dist/summernote.min.js"]').length )
	{
		$("<link/>", {
		   rel: "stylesheet",
		   type: "text/css",
		   href: baseUrl+"/plugins/summernote/dist/summernote.css"
		}).appendTo("head");
		$.getScript( baseUrl+"/plugins/summernote/dist/summernote.min.js", function( data, textStatus, jqxhr ) {
		  //mylog.log( data ); // Data returned
		  //mylog.log( textStatus ); // Success
		  //mylog.log( jqxhr.status ); // 200
		  //mylog.log( "Load was performed." );
		  
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


/* *********************************
			ELEMENTS
********************************** */


function formatData(formData, collection,ctrl) { 
	mylog.warn("formatData");
	formData.collection = collection;
	formData.key = ctrl;
	
	if(elementLocation){
		//formData.multiscopes = elementLocation;
		formData.address = centerLocation.address;
		formData.geo = centerLocation.geo;
		formData.geoPosition = centerLocation.geoPosition;
		if( elementLocations.length ){
			$.each( elementLocations,function (i,v) { 
				if( notNull(v) && notNull(v.center) )
					elementLocations.splice(i, 1);
			});
			formData.addresses = elementLocations;
		}
	}
	
	formData.medias = [];
	$(".resultGetUrl").each(function(){
		if($(this).html() != ""){
			mediaObject=new Object;	
			if($(this).find(".type").val()=="url_content"){
				mediaObject.type=$(this).find(".type").val();
				if($(this).find(".name").length)
					mediaObject.name=$(this).find(".name").val();
				if($(this).find(".description").length)
					mediaObject.description=$(this).find(".description").val();
				mediaObject.content=new Object;
				mediaObject.content.type=$(this).find(".media_type").val(),
				mediaObject.content.url=$(this).find(".url").val(),
				mediaObject.content.image=$(this).find(".img_link").val();
				if($(this).find(".size_img").length)
					mediaObject.content.imageSize=$(this).find(".size_img").val();
				if($("#form-news #results .video_link_value").length)
					mediaObject.content.videoLink=$(this).find(".video_link_value").val();
			}
			else{
				mediaObject.type=$(this).find(".type").val(),
				mediaObject.countImages=$(this).find(".count_images").val(),
				mediaObject.images=[];
				$(".imagesNews").each(function(){
					mediaObject.images.push($(this).val());	
				});
			}
			formData.medias.push(mediaObject);
		}
	});
	if( typeof formData.source != "undefined" && formData.source != "" ){
		formData.source = { insertOrign : "network",
							keys : [ 
								formData.source
							],
							key : formData.source
						}
	}
									
	if( typeof formData.tags != "undefined" && formData.tags != "" )
		formData.tags = formData.tags.split(",");
	removeEmptyAttr(formData);

	mylog.dir(formData);
	return formData;
}

function saveElement ( formId,collection,ctrl,saveUrl ) 
{ 
	mylog.warn("saveElement",formId,collection);
	formData = $(formId).serializeFormJSON();
	mylog.log("before",formData);
	formData = formatData(formData,collection,ctrl);
	formData.medias = [];
	$(".resultGetUrl").each(function(){
		if($(this).html() != ""){
			mediaObject=new Object;	
			if($(this).find(".type").val()=="url_content"){
				mediaObject.type=$(this).find(".type").val();
				if($(this).find(".name").length)
					mediaObject.name=$(this).find(".name").val();
				if($(this).find(".description").length)
					mediaObject.description=$(this).find(".description").val();
				mediaObject.content=new Object;
				mediaObject.content.type=$(this).find(".media_type").val(),
				mediaObject.content.url=$(this).find(".url").val(),
				mediaObject.content.image=$(this).find(".img_link").val();
				if($(this).find(".size_img").length)
					mediaObject.content.imageSize=$(this).find(".size_img").val();
				if($(this).find(".video_link_value").length)
					mediaObject.content.videoLink=$(this).find(".video_link_value").val();
			}
			else{
				mediaObject.type=$(this).find(".type").val(),
				mediaObject.countImages=$(this).find(".count_images").val(),
				mediaObject.images=[];
				$(".imagesNews").each(function(){
					mediaObject.images.push($(this).val());	
				});
			}
			formData.medias.push(mediaObject);
		}
	});
	$.ajax( {
    	type: "POST",
    	url: (saveUrl) ? saveUrl : baseUrl+"/"+moduleId+"/element/save",
    	data: formData,
    	dataType: "json",
    	success: function(data){
    		mylog.warn("saveElement ajax result");
    		mylog.dir(data);
			if(data.result == false){
                toastr.error(data.msg);
                //reset save btn 
                $("#btn-submit-form").html('Valider <i class="fa fa-arrow-circle-right"></i>').prop("disabled",false).one(function() { 
					$( settings.formId ).submit();	        	
		        });
           	}
            else { 
                toastr.success(data.msg);
                $('#ajax-modal').modal("hide");
                //clear the unecessary DOM 
                $("#ajaxFormModal").html('');
                if(data.url)
                	loadByHash( data.url );
                else if(data.id)
	        		loadByHash( '#'+ctrl+'.detail.id.'+data.id )
	        	if(data.map && $.inArray(collection, ["events","organizations","projects","citoyens"] ) !== -1)
	        		addFloopEntity(data.id, collection, data.map);
            }
    	}
    });
}

function editElement(type,id){
	mylog.warn("--------------- editElement "+type+" ---------------------",id);
	//get ajax of the elemetn content
	$.ajax({
        type: "GET",
        url: baseUrl+"/"+moduleId+"/element/get/type/"+type+"/id/"+id,
        dataType : "json"
    })
    .done(function (data) {
        if ( data && data.result ) {
        	//toastr.info(type+" found");
        	
			//onLoad fill inputs
			//will be sued in the dynform  as update 
			data.map.id = data.map["_id"]["$id"];
			delete data.map["_id"];
			//mylog.dir(data);
			openForm(type,null, data.map);
        } else {
           toastr.error("something went wrong!! please try again.");
        }
    });
}

function openForm (type, afterLoad,data) { 
    //mylog.clear();
    $.unblockUI();
    mylog.warn("--------------- Open Form "+type+" ---------------------",data);
    mylog.dir(data);
    elementLocation = null;
    elementLocations = [];
    centerLocation = null;
    updateLocality = false;
    formType = type;
    specs = typeObj[type];
    if(userId)
	{
		mylog.dir(specs);
		$("#ajax-modal").removeClass("bgEvent bgOrga bgProject bgPerson bgDDA").addClass(specs.bgClass);
		$("#ajax-modal-modal-title").html("<i class='fa fa-refresh fa-spin'></i> Chargement en cours. Merci de patienter.");
		$(".modal-header").removeClass("bg-purple bg-green bg-orange bg-yellow bg-lightblue ").addClass(specs.titleClass);
	  	$("#ajax-modal-modal-body").html( "<div class='row bg-white'>"+
	  										"<div class='col-sm-10 col-sm-offset-1'>"+
							              	"<div class='space20'></div>"+
							              	//"<h1 id='proposerloiFormLabel' >Faire une proposition</h1>"+
							              	"<form id='ajaxFormModal' enctype='multipart/form-data'></form>"+
							              	"</div>"+
							              "</div>");
	  	$('.modal-footer').hide();
	  	$('#ajax-modal').modal("show");
	  	afterLoad = ( notNull(afterLoad) ) ? afterLoad : null;
	  	data = ( notNull(data) ) ? data : {};
	  	buildDynForm(specs, afterLoad, data);
	} else 
		toastr.error("Ce type ou ce formulaire n'est pas déclaré");
}

function buildDynForm(elementObj, afterLoad,data) { 
	mylog.warn("--------------- buildDynForm", elementObj, afterLoad,data);
	if(userId)
	{
		var form = $.dynForm({
		      formId : "#ajax-modal-modal-body #ajaxFormModal",
		      formObj : elementObj.dynForm,
		      formValues : data,
		      onLoad : function  () {
		        $("#ajax-modal-modal-title").html("<i class='fa fa-"+elementObj.dynForm.jsonSchema.icon+"'></i> "+elementObj.dynForm.jsonSchema.title);
		        $("#ajax-modal-modal-body").append("<div class='space20'></div>");
		        //alert(afterLoad+"|"+typeof elementObj.dynForm.jsonSchema.onLoads[afterLoad]);
		        if( notNull(afterLoad) && elementObj.dynForm.jsonSchema.onLoads 
		        	&& elementObj.dynForm.jsonSchema.onLoads[afterLoad] 
		        	&& typeof elementObj.dynForm.jsonSchema.onLoads[afterLoad] == "function" )
		        	elementObj.dynForm.jsonSchema.onLoads[ afterLoad](data);
		        //incase we need a second global post process
		        if( notNull(afterLoad) && elementObj.dynForm.jsonSchema.onLoads 
		        	&& elementObj.dynForm.jsonSchema.onLoads[afterLoad] 
		        	&& typeof elementObj.dynForm.jsonSchema.onLoads.onload == "function" )
		        	elementObj.dynForm.jsonSchema.onLoads.onload();
		        bindLBHLinks();
		      },
		      onSave : function(){

		      	if( elementObj.dynForm.jsonSchema.beforeSave && typeof elementObj.dynForm.jsonSchema.beforeSave == "function")
		        	elementObj.dynForm.jsonSchema.beforeSave();

		        if( elementObj.save )
		        	elementObj.save("#ajaxFormModal");
		        else if(elementObj.saveUrl)
		        	saveElement("#ajaxFormModal",elementObj.col,elementObj.ctrl,elementObj.saveUrl);
		        else
		        	saveElement("#ajaxFormModal",elementObj.col,elementObj.ctrl);

		        return false;
		    }
		});
		mylog.dir(form);
	} else 
		alert('Vous devez etre loggué');
};

var contextData = null;
var uploadObj = {
	type : null,
	id : null,
	set : function(type,id){
		uploadObj.type = type;
		uploadObj.id = id;
	}
};


function  firstOptions() { 
	var res = {
		"dontKnow":"Je ne sais pas",
	};
	res[userId] = "Moi";
	return res;
 }

function myAdminList (ctypes) { 
	var myList = {};
	if(userId){
		//types in MyContacts
		var connectionTypes = {
			organizations : "members",
			projects : "contributors",
			events : "attendees"
		};
		$.each( ctypes, function(i,ctype) {
			var connectionType = connectionTypes[ctype];
			myList[ ctype ] = { label: ctype, options:{} };
			if(typeof myContacts != "undefined" && myContacts != null)
			$.each( myContacts[ ctype ],function(id,elemObj){
				//mylog.log(ctype+"-"+id+"-"+elemObj.name);
				if( elemObj.links && elemObj.links[connectionType] && elemObj.links[connectionType][userId] && elemObj.links[connectionType][userId].isAdmin) {
					//mylog.warn(ctype+"-"+id+"-"+elemObj.name);
					myList[ ctype ]["options"][ elemObj["_id"]["$id"] ] = elemObj.name;
				}
			});
		});
		mylog.dir(myList);
	}
	return myList;
}

function globalSearch(searchValue,types){
	
	searchType = (types) ? types : ["organizations", "projects", "events", "needs"];

	var data = { 	 
		"name" : searchValue,
		// "locality" : "", a otpimiser en utilisant la localité 
		"searchType" : searchType,
		"indexMin" : 0,
		"indexMax" : 50
	};
	$("#listSameName").html("<i class='fa fa-spin fa-circle-o-notch'></i> Vérification d'existence");
	$("#similarLink").show();
	$("#btn-submit-form").html('<i class="fa  fa-spinner fa-spin"></i>').prop("disabled",true);
	$.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
          data: data,
          dataType: "json",
          error: function (data){
             mylog.log("error"); mylog.dir(data);
             $("#btn-submit-form").html('Valider <i class="fa fa-arrow-circle-right"></i>').prop("disabled",false);
          },
          success: function(data){
            var str = "";
 			var compt = 0;
 			$("#btn-submit-form").html('Valider <i class="fa fa-arrow-circle-right"></i>').prop("disabled",false);
 			$.each(data, function(id, elem) {
  				mylog.log(elem);
  				city = "";
				postalCode = "";
				var htmlIco ="<i class='fa fa-users'></i>";
				if(elem.type){
					typeIco = elem.type;
					htmlIco ="<i class='fa "+mapIconTop[elem.type] +"'></i>";
				}
				where = "";
				if (elem.address != null) {
					city = (elem.address.addressLocality) ? elem.address.addressLocality : "";
					postalCode = (elem.address.postalCode) ? elem.address.postalCode : "";
					if( notEmpty( city ) && notEmpty( postalCode ) )
					where = ' ('+postalCode+" "+city+")";
				}
				if("undefined" != typeof elem.profilImageUrl && elem.profilImageUrl != ""){
					var htmlIco= "<img width='30' height='30' alt='image' class='img-circle' src='"+baseUrl+elem.profilThumbImageUrl+"'/>";
				}
				str += 	"<a target='_blank' href='#"+ elem.type +".detail.id."+ elem.id +"' class='btn btn-xs btn-default w50p text-left padding-5 text-blue' >"+
							"<span>"+ htmlIco +"</span> <span> " + elem.name+"</br>"+where+ "</span>"
						"</a>";
				compt++;
  				//str += "<li class='li-dropdown-scope'><a href='javascript:initAddMeAsMemberOrganizationForm(\""+key+"\")'><i class='fa "+mapIconTop[value.type]+"'></i> " + value.name + "</a></li>";
  			});
			
			if (compt > 0) {
				$("#listSameName").html("<div class='col-sm-12 light-border text-red'> <i class='fa fa-eye'></i> Verifiez si cet élément n'existe pas déjà : </div>"+str);
				//bindLBHLinks();
			} else {
				$("#listSameName").html("<span class='txt-green'><i class='fa fa-thumbs-up text-green'></i> Aucun élément avec ce nom.</span>");
			}

			
          }
 	});

	
}
var elementLocation = null;
var centerLocation = null;
var elementLocations = [];
var countLocation = 0;
function copyMapForm2Dynform(locationObj) { 
	//if(!elementLocation)
	//	elementLocation = [];
	mylog.log("locationObj", locationObj);
	elementLocation = locationObj;
	mylog.log("elementLocation", elementLocation);
	elementLocations.push(elementLocation);
	mylog.log("elementLocations", elementLocations);
	if(!centerLocation || locationObj.center == true){
		centerLocation = elementLocation;
		elementLocation.center = true;
	}
	mylog.dir(elementLocations);
	//elementLocation.push(positionObj);
}

function addLocationToForm(locationObj)
{
	mylog.warn("---------------addLocationToForm----------------");
	mylog.dir(locationObj);
	var strHTML = "";
	if( locationObj.address.addressCountry)
		strHTML += locationObj.address.addressCountry;
	if( locationObj.address.postalCode)
		strHTML += " ,"+locationObj.address.postalCode;
	if( locationObj.address.addressLocality)
		strHTML += " ,"+locationObj.address.addressLocality;
	if( locationObj.address.streetAddress)
		strHTML += " ,"+locationObj.address.streetAddress;
	var btnSuccess = "";
	var locCenter = "";
	if( countLocation == 0){
		btnSuccess = "btn-success";
		locCenter = "<span class='lblcentre'>(localité centrale)</span>";
	}
	
	strHTML = "<a href='javascript:removeLocation("+countLocation+")' class=' locationEl"+countLocation+" btn'> <i class='text-red fa fa-times'></i></a>"+
			  "<span class='locationEl"+countLocation+" locel text-azure'>"+strHTML+"</span> "+
			  "<a href='javascript:setAsCenter("+countLocation+")' class='centers center"+countLocation+" locationEl"+countLocation+" btn btn-xs "+btnSuccess+"'> <i class='fa fa-map-marker'></i>"+locCenter+"</a> <br/>";
	$(".locationlocation").prepend(strHTML);
	countLocation++;
}


function removeLocation(ix){
	mylog.log("removeLocation", ix, elementLocations);
	elementLocation = null;
	elementLocations.splice(ix,1);
	//TODO check if this center then apply on first
	//$(".locationEl"+countLocation).remove();
	$(".locationEl"+ix).remove();
}

function setAsCenter(ix){

	$(".centers").removeClass('btn-success');
	$(".lblcentre").remove();
	$.each(elementLocations,function(i, v) { 
		if( v.center)
			delete v.center;
	})
	$(".centers").removeClass('btn-success');
	$(".center"+ix).addClass('btn-success').append(" <span class='lblcentre'>(localité centrale)</span>");
	centerLocation = elementLocations[ix];
	elementLocations[ix].center = true;
}

function notEmpty(val){
	return typeof val != "undefined"
			&& val != null
			&& val != "";
}

function activeMenuElement(page) {
	mylog.log("-----------------activeMenuElement----------------------");
	listBtnMenu = [	'detail', 'news', 'directory', 'gallery', 'addmembers', 'calendar'];
	$.each(listBtnMenu, function(i,value) {
		$(".btn-menu-element-"+value).removeClass("active");
	});
	$(".btn-menu-element-"+page).addClass("active");
}

function shadowOnHeader() {
	var y = $(".my-main-container").scrollTop(); 
    if (y > 0) {  $('.main-top-menu').addClass('shadow'); }
    else { $('.main-top-menu').removeClass('shadow'); }
}
function getMediaFromUrlContent(className, appendClassName,nbParent){
    //user clicks previous thumbail
    lastUrl = "";
    $("body").on("click","#thumb_prev", function(e){        
        if(img_arr_pos>0) 
        {
            img_arr_pos--; //thmubnail array position decrement
            
            //replace with new thumbnail
            $("#extracted_thumb").html('<img src="'+extracted_images[img_arr_pos]+'" width="100" height="100">'+selectThumb);
            
            //replace thmubnail position text
            $("#total_imgs").html((img_arr_pos) +' of '+ total_images);
        }
    });
    
    //user clicks next thumbail
    $("body").on("click","#thumb_next", function(e){        
        if(img_arr_pos<total_images)
        {
            img_arr_pos++; //thmubnail array position increment
            
            //replace with new thumbnail
            $("#extracted_thumb").html('<img src="'+extracted_images[img_arr_pos]+'" width="100" height="100">'+selectThumb);
            
            //replace thmubnail position text
            $("#total_imgs").html((img_arr_pos) +' of '+ total_images);
        }
    });
    var getUrl  = $(className); //url to extract from text field
    var appendClassName = appendClassName;
    getUrl.bind("input keyup",function(e) { //user types url in text field        
        //url to match in the text field
        var $this = $(this);
        if($this.parents().eq(nbParent).find(appendClassName).html()=="" || (e.which==32 || e.which==13)){

	        var match_url = new RegExp("(http[s]?:\\/\\/(www\\.)?|ftp:\\/\\/(www\\.)?|www\\.){1}([0-9A-Za-z-\\.@:%_\+~#=]+)+((\\.[a-zA-Z]{2,3})+)(/(.)*)?(\\?(.)*)?");
	        if (match_url.test(getUrl.val())) 
	        {
		        mylog.log(getUrl.val().match(match_url));
		        if(lastUrl != getUrl.val().match(match_url)[0]){
			       // alert(lastUrl+"///"+getUrl.val().match(match_url)[0]);
		        	var extracted_url = getUrl.val().match(match_url)[0]; //extracted first url from text filed
	                //$this.parent().find(appendClassName).html("<i class='fa fa-spin fa-spinner text-red fa-2x'></i>");//hide();
	                $this.parents().eq(nbParent).find(".loading_indicator").show(); //show loading indicator image

	                //ajax request to be sent to extract-process.php
	                //alert(extracted_url);
	                lastUrl=extracted_url;
	                extracted_url_send=extracted_url;
	                if(extracted_url_send.indexOf("http")<0)
	                	extracted_url_send = "http://"+extracted_url;
	               // $(appendClassName).html("<i class='fa fa-spin fa-reload'></i>");
	                $.ajax({
						url: baseUrl+'/'+moduleId+"/news/extractprocess",
						data: {'url': extracted_url_send},
						type: 'post',
						dataType: 'json',
						success: function(data){        
			                mylog.log(data); 
		                    content = getMediaCommonHtml(data,"save");
		                    //load results in the element
		                    //return content;
		                   //$("#results").html(content); 
		                    $this.parents().eq(nbParent).find(appendClassName).html(content).slideDown();
		                    //$this.parents().eq(nbParent).slideDown();
		                    if($this.parent().find(".dynFormUrlsWarning").length > 0)
			                   $this.parent().find(".dynFormUrlsWarning").remove(); 
		                    
		                    $(".removeMediaUrl").click(function(){
			                    $trigger=$(this).parents().eq(1).find(className);
							    $this.parents().eq(nbParent).find(appendClassName).empty().hide();
							    $trigger.trigger("input");
							});
							//append received data into the element
		                    //$("#results").slideDown(); //show results with slide down effect
		                    $this.parents().eq(nbParent).find(".loading_indicator").hide(); //hide loading indicator image
	                	},
						error : function(){
							$.unblockUI();
							//toastr.error(trad["wrongwithurl"] + " !");

							//content to be loaded in #results element
							var content = '<a href="javascript:;" class="removeMediaUrl"><i class="fa fa-refresh"></i></a><h4><a href="'+extracted_url+'" target="_blank" class="lastUrl wrongUrl">'+extracted_url+'</a></h4>';
		                    //load results in the element
		                    $this.parents().eq(nbParent).find(appendClassName).hide();
		                    $this.parents().eq(nbParent).find(appendClassName).html(content);
		                    $this.parents().eq(nbParent).find(appendClassName).slideDown();
		                    toastr.warning("L'url "+extracted_url+" ne pointe vers aucun site ou un problème est survenu à son extraction");
		                    if ($("#ajaxFormModal").is(":visible") && $this.parent().find(".dynFormUrlsWarning").length <= 0)
								$this.parent().append( "<span class='text-red dynFormUrlsWarning'>* Ceci n'est pas un url valide.</span>" );         	
		                    $(".removeMediaUrl").click(function(){
			                    $trigger=$(this).parents().eq(1).find(className);
							    $this.parents().eq(nbParent).find(appendClassName).empty().hide();
							    $trigger.trigger("input");
							});

		                    //$("#results").html(content); //append received data into the element
		                    //$("#results").slideDown(); //show results with slide down effect
		                    $this.parents().eq(nbParent).find(".loading_indicator").hide(); //hide loading indicator image
						}	
	                });
				}
        	} else if ($("#ajaxFormModal").is(":visible") && $this.parent().find(".dynFormUrlsWarning").length <= 0){
				$this.parent().append( "<span class='text-red dynFormUrlsWarning'>* Ceci n'est pas un url valide.</span>" );         	
        	}
        }
    }); 
}
function getMediaCommonHtml(data,action,id){
	if(typeof(data.images)!="undefined"){
		extracted_images = data.images;
		total_images = parseInt(data.images.length);
		img_arr_pos=1;
    }
    inputToSave="";
    if(typeof(data.content) !="undefined" && typeof(data.content.imageSize) != "undefined"){
        if (data.content.videoLink){
            extractClass="extracted_thumb";
            width="100%";
            height="100%";

            aVideo='<a href="#" class="videoSignal text-white center"><i class="fa fa-3x fa-play-circle-o"></i><input type="hidden" class="videoLink" value="'+data.content.videoLink+'"/></a>';
            inputToSave+="<input type='hidden' class='video_link_value' value='"+data.content.videoLink+"'/>"+
            "<input type='hidden' class='media_type' value='video_link' />";   
		}
        else{
            aVideo="";
            endAVideo="";
            if(data.content.imageSize =="large"){
                extractClass="extracted_thumb_large";
                width="100%";
                height="";
            }
            else{
                extractClass="extracted_thumb";
                width="100";
                height="100";
            }
            inputToSave+="<input type='hidden' class='media_type' value='img_link' />";
		}
		inputToSave+="<input type='hidden' class='size_img' value='"+data.content.imageSize+"'/>"
    }
    if (typeof(data.content) !="undefined" && typeof(data.content.image)!="undefined"){
        inc_image = '<div class="'+extractClass+'  col-xs-4 no-padding" id="extracted_thumb">'+aVideo;
        if(data.content.type=="img_link"){
	        if(typeof(data.content.imageId) != "undefined"){
		       inc_image += "<input type='hidden' id='deleteImageCommunevent"+id+"' value='"+data.content.imageId+"'/>";
		       titleImg = "De l&apos;application communevent"; 
		    }else
		    	titleImg = "Image partagée"; 
	        inc_image += "<a class='thumb-info' href='"+data.content.image+"' data-title='"+titleImg+"'  data-lightbox='allimgcontent'>";
	    }
        inc_image +='<img src="'+data.content.image+'" width="'+width+'" height="'+height+'">';
        if(data.content.type=="img_link")
        	inc_image += '</a>';
        inc_image += '</div>';
        countThumbail="";
        inputToSave+="<input type='hidden' class='img_link' value='"+data.content.image+"'/>";
    }
    else {
        if(typeof(total_images)!="undefined" && total_images > 0){
            if(total_images > 1){
                selectThumb='<div class="thumb_sel"><span class="prev_thumb" id="thumb_prev">&nbsp;</span><span class="next_thumb" id="thumb_next">&nbsp;</span> </div>';
                countThumbail='<span class="small_text" id="total_imgs">'+img_arr_pos+' of '+total_images+'</span><span class="small_text">&nbsp;&nbsp;Choose a Thumbnail</span>';
            }
            else{
                selectThumb="";
                countThumbail="";
            }
            inc_image = '<div class="'+extractClass+'  col-xs-4" id="extracted_thumb">'+aVideo+'<img src="'+data.images[0]+'" width="'+width+'" height="'+height+'">'+selectThumb+'</div>';
      		inputToSave+="<input type='hidden' class='img_link' value='"+data.images[0]+"'/>";      
        }else{
            inc_image ='';
            countThumbail='';
        }
    }
    
    //content to be loaded in #results element
	if(data.content==null)
		data.content="";
	if(typeof(data.url)!="undefined")
		mediaUrl=data.url;
	else if (typeof(data.content.url) !="undefined")
		mediaUrl=data.content.url;
	else
		mediaUrl="";
	if(typeof(data.description) !="undefined" && typeof(data.name) != "undefined" && data.description !="" && data.name != ""){
		contentMedia='<div class="extracted_content col-xs-8 padding-20"><h4><a href="'+mediaUrl+'" target="_blank" class="lastUrl text-dark">'+data.name+'</a></h4><p>'+data.description+'</p>'+countThumbail+'</div>';
		inputToSave+="<input type='hidden' class='description' value='"+data.description+"'/>"; 
		inputToSave+="<input type='hidden' class='name' value='"+data.name+"'/>";
	}
	else{
		contentMedia="";
	}
	inputToSave+="<input type='hidden' class='url' value='"+mediaUrl+"'/>";
	inputToSave+="<input type='hidden' class='type' value='url_content'/>"; 
	content="";
	if(action == "save")
		content += '<a href="javascript:;" class="removeMediaUrl"><i class="fa fa-times"></i></a>';
    content += '<div class="extracted_url padding-10">'+ inc_image +contentMedia+'</div>'+inputToSave;
    return content;
}

function myContactLabel (type,id) { 
	if(typeof myContacts != "undefined" && myContacts[type]){
		$.each( myContacts[type], function( key,val ){
			if( id == val["_id"]["$id"] ){
				return val;
			}
		});
	}
	return null;
}


function shadowOnHeader() {
	var y = $(".my-main-container").scrollTop(); 
    if (y > 0) {  $('.main-top-menu').addClass('shadow'); }
    else { $('.main-top-menu').removeClass('shadow'); }
}

/* ************************************
Keyboard Shortcuts
*************************************** */
var keycodeObj = {"backspace":8,"tab":9,"enter":13,"shift":16,"ctrl":17,"alt":18,"pause/break":19,"capslock":20,"escape":27,"pageup":33,"pagedown":34,"end":35,
"home":36,"left":37,"up":38,"right":39,"down":40,"insert":45,"delete":46,"0":48,"1":49,"2":50,"3":51,"4":52,"5":53,"6":54,"7":55,"8":56,"9":57,
"a":65,"b":66,"c":67,"d":68,"e":69,"f":70,"g":71,"h":72,"i":73,"j":74,"k":75,"l":76,"m":77,"n":78,"o":79,"p":80,"q":81,"r":82,"s":83,"t":84,"u":85,"v":86,"w":87,
"x":88,"y":89,"z":90,"left window key":91,"right window key":92,"select key":93,"numpad 0":96,"numpad 1":97,"numpad 2":98,"numpad 3":99,"numpad 4":100,"numpad 5":101,
"numpad 6":102,"numpad 7":103,"numpad 8":104,"numpad 9":105,"multiply":106,"add":107,"subtract":109,"decimal point":110,"divide":111,"f1":112,"f2":113,"f3":114,
"f4":115,"f5":116,"f6":117,"f7":118,"f8":119,"f9":120,"f10":121,"f11":122,"f12":123,"num lock":144,"scroll lock":145,"semi-colon":186,"equal sign":187,
"comma":188,"dash":189,"period":190,"forward slash":191,"grave accent":192,"open bracket":219,"back slash":220,"close braket":221,"single quote":222};		

var keyMap = {
	"112" : function(){ $(".menu-name-profil").trigger('click') },//f1
	"113" : function(){ if(userId)loadByHash('#person.detail.id.'+userId); else alert("login first"); },//f2
	"114" : function(){ showMap(true); },//f3
	"115" : function(){ mylog.clear();mylog.warn("repair society") },//f4
	"117" : function(){ mylog.clear();loadByHash(location.hash) },//f6
};
var keyMapCombo = {
	"69" : function(){elementLib.openForm('event')}, //e
	"79" : function(){elementLib.openForm('organization')},//o
	"80" : function(){elementLib.openForm('project')},//p
	"73" : function(){elementLib.openForm('person')},//i
	"65" : function(){elementLib.openForm('action')},//a
	"86" : function(){elementLib.openForm('entry')}//v
};
var keyMapCtrlCombo = {
	"83" : function(){$(".menu-name-profil").trigger('click')},//s save an element > open dashboard
	"80" : function(){showMap(true)},//p switch view 
	"70" : function(){elementLib.openForm('person')},//f open finder
};

function checkKeycode(e) {
	e.preventDefault();
	var keycode;
	if (window.event) {keycode = window.event.keyCode;e=event;}
	else if (e){ keycode = e.which;}
	//mylog.log("keycode: ",keycode);
	if(e.ctrlKey && e.altKey && keyMapCombo[keycode] ){
		mylog.warn("keyMapCombo",keycode);//shiftKey ctrlKey altKey
		keyMapCombo[keycode]();
	}
	if(e.ctrlKey && keyMapCtrlCombo[keycode] ){
		mylog.warn("keyMapCtrlCombo",keycode);//shiftKey ctrlKey altKey
		keyMapCombo[keycode]();
	}
	else if( keyMap[keycode] ){
		mylog.warn("keyMap",keycode);
		keyMap[keycode]();
	}
}

function autoCompleteInviteSearch(search){
	if (search.length < 3) { return }
	tabObject = [];

	var data = { 
		"search" : search,
		"searchMode" : "personOnly"
	};
	
	
	ajaxPost("", moduleId+'/search/searchmemberautocomplete', data,
		function (data){
			mylog.log(data);
			var str = "<li class='li-dropdown-scope'><a href='javascript:newInvitation()'>Pas trouvé ? Lancer une invitation à rejoindre votre réseau !</li>";
			var compt = 0;
			var city, postalCode = "";
			if(data["citoyens"].length > 0){
				$.each(data["citoyens"], function(k, v) { 
					city = "";
					mylog.log(v);
					postalCode = "";
					var htmlIco ="<i class='fa fa-user fa-2x'></i>"
					if(v.id != userId) {
						tabObject.push(v);
		 				if(v.profilImageUrl != ""){
		 					var htmlIco= "<img width='50' height='50' alt='image' class='img-circle' src='"+baseUrl+v.profilImageUrl+"'/>"
		 				}
		 				if (v.address != null) {
		 					city = v.address.addressLocality;
		 					postalCode = v.address.postalCode;
		 				}
		  				str += 	"<li class='li-dropdown-scope'>" +
		  						"<a href='javascript:setInviteInput("+compt+")'>"+htmlIco+" "+v.name ;
	
		  				if(typeof postalCode != "undefined")
		  					str += "<br/>"+postalCode+" "+city;
		  					//str += "<span class='city-search'> "+postalCode+" "+city+"</span>" ;
		  				str += "</a></li>";
	
		  				compt++;
	  				}
				});
			}
			
			$("#newInvite #dropdown_searchInvite").html(str);
			$("#newInvite #dropdown_searchInvite").css({"display" : "inline" });
		}
	);	
}

function communecterUser(){
	mylog.warn("communecterUser");
	if(typeof contextData == "undefined" || contextData == null || contextData.id != userId){
		contextData = {
			id : userId,
			type : "citoyens"
		};
	}
	$.unblockUI();
	updateLocalityEntities();
}

function updateLocalityEntities(addressesIndex, addressesLocality){
	mylog.warn("updateLocalityEntities");
	$("#ajax-modal").modal("hide");
	showMap(true);
	if(typeof initUpdateLocality != "undefined"){
		var address = contextData.address ;
		var geo = contextData.geo ;
		if(addressesLocality && addressesIndex){
			address = addressesLocality.address ;
			geo = addressesLocality.geo ;
		}else if(addressesIndex) {
			address = null ;
			geo = null ;
		}
		mylog.log(address, geo, contextData.type, addressesIndex);
		initUpdateLocality(address, geo, contextData.type, addressesIndex); 
	}
}

function cityKeyPart(unikey, part){
	var s = unikey.indexOf("_");
	var e = unikey.indexOf("-");
	var len = unikey.length;
	if(e < 0) e = len;
	if(part == "insee") return unikey.substr(s+1, e - s-1);
	if(part == "cp" && unikey.indexOf("-") < 0) return "";
	if(part == "cp") return unikey.substr(e+1, len);
	if(part == "country") return unikey.substr(e+1, len);
}

//*********************************************************************************
// Utility for events date
//*********************************************************************************
function manageTimestampOnDate() {
	$.each($(".date2format"), function(k, v) { 
		var dates = "";
		var dateFormat = "DD-MM-YYYY HH:mm";
		if ($(this).data("allday") == true) {
			dateFormat = "DD-MM-YYYY";
		}
		dates = moment($(this).data("startdate")).local().format(dateFormat);
		dates += "</br>"+moment($(this).data("enddate")).local().format(dateFormat);
		$(this).html(dates);
	})
}

//Display event start and end date depending on allDay params
//Used on popup and right list on map
function displayStartAndEndDate(event) {
	var content = "";
	//si on a bien les dates
	if("undefined" != typeof event['startDate'] && "undefined" != typeof event['endDate']){
		//var start = dateToStr(data['startDate'], "fr", true);
		//var end = dateToStr(data['endDate'], "fr", true);
		
		var startDateMoment = moment(event['startDate']).local();
		var endDateMoment = moment(event['endDate']).local();

		var startDate = startDateMoment.format("DD-MM-YYYY");
		var endDate = endDateMoment.format("DD-MM-YYYY");

		var hour1 = "Toute la journée";
		var hour2 = "Toute la journée";
		if(event["allDay"] == false || event["allDay"] == null) { 	
			hour1 = startDateMoment.format("HH:mm");
			hour2 = endDateMoment.format("HH:mm");
		}
		//si la date de debut == la date de fin
		if( startDate == endDate) {
			content += "<div class='info_item startDate_item_map_list double'><i class='fa fa-caret-right'></i> Le " + startDate;
			
			if(event["allDay"] == true) { 		
				content += "</br><i class='fa fa-caret-right'></i> " + hour1;
			} else {
				content += "</br><i class='fa fa-caret-right'></i> " + hour1 + " - " + hour2;
			}
			content += "</div>";
		} else {
			content += "<div class='info_item startDate_item_map_list double'><i class='fa fa-caret-right'></i> Du " + 
								startDate + " - " + hour1 +
							"</div>" +
				   		  	"<div class='info_item startDate_item_map_list double'><i class='fa fa-caret-right'></i> Au " + 
				   		  		endDate +  " - " + hour2 +
				   		  	"</div></br>";
		}
	}
	return content;
};

/* *********************************
			ELEMENTS
********************************** */

var elementLib = {
	formatData : function (formData, collection,ctrl) { 
		mylog.warn("formatData");
		formData.collection = collection;
		formData.key = ctrl;
		
		if(elementLocation){
			//formData.multiscopes = elementLocation;
			formData.address = centerLocation.address;
			formData.geo = centerLocation.geo;
			formData.geoPosition = centerLocation.geoPosition;
			if( elementLocations.length ){
				$.each( elementLocations,function (i,v) { 
					if( notNull(v) && notNull(v.center) )
						elementLocations.splice(i, 1);
				});
				formData.addresses = elementLocations;
			}
		}
		
		formData.medias = [];
		$(".resultGetUrl").each(function(){
			if($(this).html() != ""){
				mediaObject=new Object;	
				if($(this).find(".type").val()=="url_content"){
					mediaObject.type=$(this).find(".type").val();
					if($(this).find(".name").length)
						mediaObject.name=$(this).find(".name").val();
					if($(this).find(".description").length)
						mediaObject.description=$(this).find(".description").val();
					mediaObject.content=new Object;
					mediaObject.content.type=$(this).find(".media_type").val(),
					mediaObject.content.url=$(this).find(".url").val(),
					mediaObject.content.image=$(this).find(".img_link").val();
					if($(this).find(".size_img").length)
						mediaObject.content.imageSize=$(this).find(".size_img").val();
					if($("#form-news #results .video_link_value").length)
						mediaObject.content.videoLink=$(this).find(".video_link_value").val();
				}
				else{
					mediaObject.type=$(this).find(".type").val(),
					mediaObject.countImages=$(this).find(".count_images").val(),
					mediaObject.images=[];
					$(".imagesNews").each(function(){
						mediaObject.images.push($(this).val());	
					});
				}
				formData.medias.push(mediaObject);
			}
		});
		if( typeof formData.source != "undefined" && formData.source != "" ){
			formData.source = { insertOrign : "network",
								keys : [ 
									formData.source
								],
								key : formData.source
							}
		}
		
		if( typeof formData.tags != "undefined" && formData.tags != "" )
			formData.tags = formData.tags.split(",");

		// Add collections and genres of notragora in tags
		if( typeof formData.collections != "undefined" && formData.collections != "" ){
			collectionsTagsSave=formData.collections.split(",");
			if(!formData.tags)formData.tags = [];
			$.each(collectionsTagsSave, function(i, e) {
				formData.tags.push(e);
			});
			delete formData['collections'];
		}

		if( typeof formData.genres != "undefined" && formData.genres != "" ){
			genresTagsSave=formData.genres.split(",");
			if(!formData.tags)formData.tags = [];
			$.each(genresTagsSave, function(i, e) {
				formData.tags.push(e);
			});
			delete formData['genres'];
		}

		if(typeof formData.isUpdate == "undefined" || !formData.isUpdate)
			removeEmptyAttr(formData);
		else
			delete formData["isUpdate"];

		mylog.dir(formData);
		return formData;
	},

	saveElement : function  ( formId,collection,ctrl,saveUrl,afterSave ) 
	{ 
		mylog.warn("saveElement",formId,collection);
		formData = $(formId).serializeFormJSON();
		mylog.log("before",formData);
		formData = elementLib.formatData(formData,collection,ctrl);
		formData.medias = [];
		$(".resultGetUrl").each(function(){
			if($(this).html() != ""){
				mediaObject=new Object;	
				if($(this).find(".type").val()=="url_content"){
					mediaObject.type=$(this).find(".type").val();
					if($(this).find(".name").length)
						mediaObject.name=$(this).find(".name").val();
					if($(this).find(".description").length)
						mediaObject.description=$(this).find(".description").val();
					mediaObject.content=new Object;
					mediaObject.content.type=$(this).find(".media_type").val(),
					mediaObject.content.url=$(this).find(".url").val(),
					mediaObject.content.image=$(this).find(".img_link").val();
					if($(this).find(".size_img").length)
						mediaObject.content.imageSize=$(this).find(".size_img").val();
					if($(this).find(".video_link_value").length)
						mediaObject.content.videoLink=$(this).find(".video_link_value").val();
				}
				else{
					mediaObject.type=$(this).find(".type").val(),
					mediaObject.countImages=$(this).find(".count_images").val(),
					mediaObject.images=[];
					$(".imagesNews").each(function(){
						mediaObject.images.push($(this).val());	
					});
				}
				formData.medias.push(mediaObject);
			}
		});
		mylog.log("beforeAjax",formData);
		$.ajax( {
	    	type: "POST",
	    	url: (saveUrl) ? saveUrl : baseUrl+"/"+moduleId+"/element/save",
	    	data: formData,
	    	dataType: "json",
	    	success: function(data){
	    		mylog.warn("saveElement ajax result");
	    		mylog.dir(data);
				if(data.result == false){
	                toastr.error(data.msg);
	                //reset save btn 
	                $("#btn-submit-form").html('Valider <i class="fa fa-arrow-circle-right"></i>').prop("disabled",false).one(function() { 
						$( settings.formId ).submit();	        	
			        });
	           	}
	            else {
	            	if(typeof data.msg != "undefined") 
	            		toastr.success(data.msg);
	            	else{
	            		if(typeof data.resultGoods != "undefined" && typeof data.resultGoods.msg != "undefined")
	            			toastr.success(data.resultGoods.msg);
	            		if(typeof data.resultErrors != "undefined" && typeof data.resultErrors.msg != "undefined")
	            			toastr.error(data.resultErrors.msg);
	            	}

	            	if(data.map && $.inArray(collection, ["events","organizations","projects","citoyens"] ) !== -1)
			        	addFloopEntity(data.id, collection, data.map);

	            	if (typeof afterSave == "function") 
	            		afterSave(data);
	            	else{
						elementLib.closeForm();
		                if(data.url)
		                	loadByHash( data.url );
		                else if(data.id)
			        		loadByHash( '#'+ctrl+'.detail.id.'+data.id );
					}
	            }
	    	}
	    });
	},
	closeForm : function() {
		$('#ajax-modal').modal("hide");
	    //clear the unecessary DOM 
	    $("#ajaxFormModal").html(''); 
	},
	editElement : function (type,id)
	{
		mylog.warn("--------------- editElement "+type+" ---------------------",id);
		//get ajax of the elemetn content
		$.ajax({
	        type: "GET",
	        url: baseUrl+"/"+moduleId+"/element/get/type/"+type+"/id/"+id,
	        dataType : "json"
	    })
	    .done(function (data) {
	        if ( data && data.result ) {
	        	//toastr.info(type+" found");
	        	
				//onLoad fill inputs
				//will be sued in the dynform  as update 
				data.map.id = data.map["_id"]["$id"];
				delete data.map["_id"];
				mylog.dir(data);
				console.log(data);
				if( notNull(globalTheme) && globalTheme=="notragora"){
					if(type=="poi"){
						if(typeof data.map["tags"] != "undefined" && data.map["tags"].length > 0){
					  		$.each(data.map["tags"], function(i,e){
						  		if(jQuery.inArray( e, collectionsType ) >= 0){
							   		 data.map["collections"]=[];
							   		 data.map["collections"].push(e);
							   		 var i = data.map["tags"].indexOf(e);
									if(i != -1) {
										data.map["tags"].splice(i, 1);
									}
								}
								if(jQuery.inArray( e, genresType ) >= 0){
							   		 data.map["genres"]=[];
							   		 data.map["genres"].push(e);
							   		 var i = data.map["tags"].indexOf(e);
									if(i != -1) {
										data.map["tags"].splice(i, 1);
									}
								}

					  		});
			  			}
		  			}
				}
				elementLib.openForm(type,null, data.map);
	        } else {
	           toastr.error("something went wrong!! please try again.");
	        }
	    });
	},
	getDynFormObj : function(type, callback,afterLoad, data ){
		if(typeof type == "object"){
			specs = type;
			if( notNull(specs.col) ) uploadObj.type = specs.col;
    		callback(specs, afterLoad, data);
		}else if( notNull(typeObj[type]) ){
			specs = typeObj[type];
			if( notNull(specs.col) ) uploadObj.type = specs.col;
    		callback(specs, afterLoad, data);
		}else {
			lazyLoad( baseUrl+'/plugins/'+type+'_dynform.js', 
				null,
				function() { 
				  	alert(dynForm);
				  	typeObj[type] = dynForm;
					specs = typeObj[type];
					if( notNull(specs.col) ) uploadObj.type = specs.col;
    				callback(specs, afterLoad, data);
			 });
		}
	},
	openForm : function  (type, afterLoad,data) { 
	    //mylog.clear();
	    $.unblockUI();
	    mylog.warn("--------------- Open Form "+type+" ---------------------",data);
	    mylog.dir(data);
	    //global variables clean up
	    elementLocation = null;
	    elementLocations = [];
	    centerLocation = null;
	    updateLocality = false;

	    if(userId)
		{
			formType = type;
			elementLib.getDynFormObj(type, function() { 
				elementLib.starBuild(specs,afterLoad,data);
			},afterLoad, data);
		} else {
			toastr.error("Vous devez être connecté pour afficher les formulaires de création");
			showPanel('box-login');
		}
	},
	starBuild : function  (specs, afterLoad, data) {
		mylog.dir(specs);
		$("#ajax-modal").removeClass("bgEvent bgOrga bgProject bgPerson bgDDA").addClass(specs.bgClass);
		$("#ajax-modal-modal-title").html("<i class='fa fa-refresh fa-spin'></i> Chargement en cours. Merci de patienter.");
		$(".modal-header").removeClass("bg-purple bg-green bg-orange bg-yellow bg-lightblue ").addClass(specs.titleClass);
	  	$("#ajax-modal-modal-body").html( "<div class='row bg-white'>"+
	  										"<div class='col-sm-10 col-sm-offset-1'>"+
							              	"<div class='space20'></div>"+
							              	//"<h1 id='proposerloiFormLabel' >Faire une proposition</h1>"+
							              	"<form id='ajaxFormModal' enctype='multipart/form-data'></form>"+
							              	"</div>"+
							              "</div>");
	  	$('.modal-footer').hide();
	  	$('#ajax-modal').modal("show");
	  	afterLoad = ( notNull(afterLoad) ) ? afterLoad : null;
	  	data = ( notNull(data) ) ? data : {}; 
	  	elementLib.buildDynForm(specs, afterLoad, data);
	},
	buildDynForm : function (elementObj, afterLoad,data) { 
		mylog.warn("--------------- buildDynForm", elementObj, afterLoad,data);
		if(userId)
		{
			var form = $.dynForm({
			      formId : "#ajax-modal-modal-body #ajaxFormModal",
			      formObj : elementObj.dynForm,
			      formValues : data,
			      beforeBuild : function  () {
			      	if( typeof elementObj.dynForm.jsonSchema.beforeBuild == "function" )
				        	elementObj.dynForm.jsonSchema.beforeBuild();
			      },
			      onLoad : function  () {

			        $("#ajax-modal-modal-title").html("<i class='fa fa-"+elementObj.dynForm.jsonSchema.icon+"'></i> "+elementObj.dynForm.jsonSchema.title);
			        $("#ajax-modal-modal-body").append("<div class='space20'></div>");
			        //alert(afterLoad+"|"+typeof elementObj.dynForm.jsonSchema.onLoads[afterLoad]);

			        if( notNull(afterLoad) && elementObj.dynForm.jsonSchema.onLoads )
			        {
				        if( typeof elementObj.dynForm.jsonSchema.onLoads[afterLoad] == "function" )
				        	elementObj.dynForm.jsonSchema.onLoads[afterLoad](data);
				        //incase we need a second global post process
				        if( typeof elementObj.dynForm.jsonSchema.onLoads.onload == "function" )
				        	elementObj.dynForm.jsonSchema.onLoads.onload();
				        //incase we need a second global post process
				        if( typeof elementObj.dynForm.jsonSchema.onLoads.onload == "function" )
				        	elementObj.dynForm.jsonSchema.onLoads.onload();
				    }
			        bindLBHLinks();
			      },
			      onSave : function(){

			      	if( typeof elementObj.dynForm.jsonSchema.beforeSave == "function")
			        	elementObj.dynForm.jsonSchema.beforeSave();

			        var afterSave = ( typeof elementObj.dynForm.jsonSchema.afterSave == "function") ? elementObj.dynForm.jsonSchema.afterSave : null;

			        if( elementObj.save )
			        	elementObj.save("#ajaxFormModal");
			        else if(elementObj.saveUrl)
			        	elementLib.saveElement("#ajaxFormModal",elementObj.col,elementObj.ctrl,elementObj.saveUrl,afterSave);
			        else
			        	elementLib.saveElement("#ajaxFormModal",elementObj.col,elementObj.ctrl,null,afterSave);
			        return false;
			    }
			});
			mylog.dir(form);
		} else {
			toastr.error("Vous devez être connecté pour afficher les formulaires de création");
			showPanel('box-login');
		}
	},

	//generate Id for upload feature of this element 
	setMongoId : function(type) { 
		uploadObj.type = type;
		if( !$("#ajaxFormModal #id").val() )
		{
			getAjax( null , baseUrl+"/api/tool/get/what/mongoId" , function(data){
				uploadObj.id = data.id;
				$("#ajaxFormModal #id").val(data.id)
			});
		}
	},
	editDynForm : function(title, icon, properties, fct, data, saveUrl, onLoads, beforeSave, afterSave) {
		mylog.warn("---------------------- editDynForm ------------------");
		var form = {
			dynForm:{
				jsonSchema : {
					title : title,
					icon : icon,
					properties : properties
				}
			}
		};

		if(typeof saveUrl != "undefined" )
			form.saveUrl = saveUrl;

		if(typeof onLoads != "undefined" )
			form.dynForm.jsonSchema.onLoads = onLoads;

		if(typeof beforeSave != "undefined" )
			form.dynForm.jsonSchema.beforeSave = beforeSave;

		if(typeof afterSave != "undefined" )
			form.dynForm.jsonSchema.afterSave = afterSave;

		mylog.dir(form);

		elementLib.openForm(form, fct, data);
	}
};


var typeObjLib = {
	name : {
    	placeholder : "Nom",
        inputType : "text",
        rules : { required : true }
    },
    nameOrga : {
    	placeholder : "Nom",
        inputType : "text",
        rules : { required : true },
        init : function(){
        	$("#ajaxFormModal #name ").off().on("blur",function(){
        		if($("#ajaxFormModal #name ").val().length > 3 )
            		globalSearch($(this).val(),["organizations"]);
        	});
        }
    },
    nameEvent : {
    	placeholder : "Nom",
    	labelText:"Nom",
        inputType : "text",
        rules : { required : true },
        init : function(){
        	$("#ajaxFormModal #name ").off().on("blur",function(){
        		if($("#ajaxFormModal #name ").val().length > 3 )
        			globalSearch($(this).val(),["events"]);
        	});
        }
    },
    nameProject : {
    	placeholder : "Nom",
        inputType : "text",
        rules : {
            required : true
        },
        init : function(){
        	$("#ajaxFormModal #name ").off().on("blur",function(){
        		if($("#ajaxFormModal #name ").val().length > 3 )
        			globalSearch($(this).val(),["projects"]);
        	});
        }
    },
    namePerson : {
    	placeholder : "Nom",
    	labelText:"Nom",
        inputType : "text",
        init : function(){
        	$("#ajaxFormModal #name ").off().on("blur",function(){
        		if($("#ajaxFormModal #name ").val().length > 3 )
        			globalSearch($(this).val(),["persons"],true);
        	});
        }
    },
    nameOrganiser : {
    	placeholder : "Nom",
        inputType : "text",
        rules : {
            required : true
        },
        init : function(){
        	$("#ajaxFormModal #name ").off().on("blur",function(){
        		if($("#ajaxFormModal #name ").val().length > 3 )
        			globalSearch($(this).val(),["projects", "events", "organizations"]);
        	});
        }
    },
    username : {
    	placeholder : "username",
        inputType : "text",
        rules : { required : true },
        init : function(){
        	$("#ajaxFormModal #username ").off().on("blur",function(){
        		if($("#ajaxFormModal #username ").val().length > 2 ){
            		var res = isUniqueUsername($(this).val());
            		$("#btn-submit-form").html('Valider <i class="fa fa-arrow-circle-right"></i>').prop("disabled",false);
            		var msg = "Username existe déjà";
            		var color = " text-red"
            		if(res){
            			msg = "Username est bon";
            			color = " text-green"
            		}
            		
            		$("#listSameName").html("<div class='col-sm-12 light-border"+color+"'> <i class='fa fa-eye'></i> "+msg+" : </div>");
            	}
            });
        }
    },
    similarLink : {
        inputType : "custom",
        html:"<div id='similarLink'><div id='listSameName'></div></div>",
    },
    typeOrga :{
    	inputType : "select",
    	placeholder : "Type d'organisation",
    	rules : { required : true },
    	options : organizationTypes
    },
    typeEvent :{
    	inputType : "select",
    	placeholder : "Type d\'évènement",
    	options : eventTypes,
    	rules : { required : true }
    },
   	avancementProject :{
    	inputType : "select",
    	placeholder : "Avancement du projet",
    	options : avancementProject
    },
    imageAddPhoto : {
    	inputType : "uploader",
    	showUploadBtn : true,
    	init : function() { 
    		setTimeout( function()
    		{
        		$('#trigger-upload').click(function() {
		        	$('.fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
		        	loadByHash(location.hash);
        			$('#ajax-modal').modal("hide");
		        });
        	},500);
    	}
    },
    image :function(str) { 
    	url = (str) ? str : location.hash;
    	return {
	    	inputType : "uploader",
	    	label : "Images de profil et album", 
	    	afterUploadComplete : function(){
		    	elementLib.closeForm();
	            loadByHash( url );	
		    	}
    	}
    },
    descriptionOptionnel : {
        inputType : "textarea",
		placeholder : "Décrire c'est partager",
		init : function(){
        	$(".descriptionOptionneltextarea").css("display","none");
        }
    },
    description : {
        inputType : "textarea",
		placeholder : "Décrire c'est partager"
    },
    tags : {
		inputType : "tags",
		placeholder : "Ajouter des tags",
		values : tagsList
	},
	location : {
       inputType : "location"
    },
    email : {
		placeholder : "Ajouter un e-mail",
		inputType : "text"
	},
    emailOptionnel : {
		placeholder : "Email du responsable",
		inputType : "text",
		init : function(){
			$(".emailtext").css("display","none");
		}
	},
	url : {
        inputType :"text",
        "custom" : "<div class='resultGetUrl resultGetUrl0 col-sm-12'></div>",
        placeholder : "Site web"
    },
    urlOptionnel : {
        inputType :"text",
        "custom" : "<div class='resultGetUrl resultGetUrl0 col-sm-12'></div>",
        placeholder : "url, lien, adresse web",
        init:function(){
            getMediaFromUrlContent("#url", ".resultGetUrl0",0);
            $(".urltext").css("display","none");
        }
    },
    urls : {
    	placeholder : "url",
        inputType : "array",
        value : [],
        init:function(){
            getMediaFromUrlContent(".addmultifield0", ".resultGetUrl0",0);	
        }
    },
    urlsOptionnel : {
        inputType : "array",
        placeholder : "url, informations supplémentaires, actions à faire, etc",
        value : [],
        init:function(){
            getMediaFromUrlContent(".addmultifield0", ".resultGetUrl0",0);
        	$(".urlsarray").css("display","none");	
        }
    },
    allDay : {
    	inputType : "checkbox",
    	init : function(){
        	$("#ajaxFormModal #allDay").off().on("switchChange.bootstrapSwitch",function (e, data) {
        		mylog.log("toto",$("#ajaxFormModal #allDay").val());
        	})
        },
    	"switch" : {
    		"onText" : "Oui",
    		"offText" : "Non",
    		"labelText":"Toute la journée",
    		"onChange" : function(){
    			var allDay = $("#ajaxFormModal #allDay").is(':checked');
    			var startDate = "";
    			var endDate = "";
    			$("#ajaxFormModal #allDay").val($("#ajaxFormModal #allDay").is(':checked'));
    			if (allDay) {
    				$(".dateTimeInput").addClass("dateInput");
    				$(".dateTimeInput").removeClass("dateTimeInput");
    				$('.dateInput').datetimepicker('destroy');
    				$(".dateInput").datetimepicker({ 
				        autoclose: true,
				        lang: "fr",
				        format: "d/m/Y",
				        timepicker:false
				    });
				    startDate = moment($('#ajaxFormModal #startDate').val(), "DD/MM/YYYY HH:mm").format("DD/MM/YYYY");
				    endDate = moment($('#ajaxFormModal #endDate').val(), "DD/MM/YYYY HH:mm").format("DD/MM/YYYY");
    			} else {
    				$(".dateInput").addClass("dateTimeInput");
    				$(".dateInput").removeClass("dateInput");
    				$('.dateTimeInput').datetimepicker('destroy');
    				$(".dateTimeInput").datetimepicker({ 
	       				weekStart: 1,
						step: 15,
						lang: 'fr',
						format: 'd/m/Y H:i'
				    });
				    
    				startDate = moment($('#ajaxFormModal #startDate').val(), "DD/MM/YYYY").format("DD/MM/YYYY HH:mm");
					endDate = moment($('#ajaxFormModal #endDate').val(), "DD/MM/YYYY").format("DD/MM/YYYY HH:mm");
    			}
			    if (startDate != "Invalid date") $('#ajaxFormModal #startDate').val(startDate);
				if (endDate != "Invalid date") $('#ajaxFormModal #endDate').val(endDate);
    		}
    	}
    },
    startDateInput : {
        inputType : "datetime",
        placeholder: "Date de début",
        rules : { 
        	required : true,
        	duringDates: ["#startDateParent","#endDateParent","La date de début"]
    	}
    },
    endDateInput : {
        inputType : "datetime",
        placeholder: "Date de fin",
        rules : { 
        	required : true,
        	greaterThan: ["#ajaxFormModal #startDate","la date de début"],
        	duringDates: ["#startDateParent","#endDateParent","La date de fin"]
	    }
    },
    telegram : {
        inputType :"text",
        placeholder : "Votre Speudo Telegram"
    },
    skype : {
        inputType :"text",
        "custom" : "<div class='resultGetUrl resultGetUrl0 col-sm-12'></div>",
        placeholder : "Lien vers Skype"
    },
    facebook : {
        inputType :"text",
        "custom" : "<div class='resultGetUrl resultGetUrl0 col-sm-12'></div>",
        placeholder : "Lien vers Facebook"
    },
    github : {
        inputType :"text",
        "custom" : "<div class='resultGetUrl resultGetUrl0 col-sm-12'></div>",
        placeholder : "Lien vers Git Hub"
    },
    googleplus : {
        inputType :"text",
        "custom" : "<div class='resultGetUrl resultGetUrl0 col-sm-12'></div>",
        placeholder : "Lien vers Google Plus"
    },
    twitter : {
        inputType :"text",
        "custom" : "<div class='resultGetUrl resultGetUrl0 col-sm-12'></div>",
        placeholder : "Lien vers Twitter"
    },
    birthDate : {
        inputType : "date",
        placeholder: "Date d'anniversaire'"
    },
    phone :{
      	inputType : "text",
      	placeholder : "Saisir les numéros de téléphone séparer par une virgule"
    },
    mobile :{
      	inputType : "text",
      	placeholder : "Saisir les numéros de portable séparer par une virgule"
    },
    fax :{
      	inputType : "text",
      	placeholder : "Saisir les numéros de fax séparer par une virgule"
    },
    hidden :{
      	inputType : "hidden"
    },
    inviteSearch : {
    	inputType : "searchInvite",
       	init : function(){
        	$("#ajaxFormModal #inviteSearch ").keyup(function(e){
			    var search = $('#inviteSearch').val();
			    if(search.length>2){
			    	clearTimeout(timeout);
					timeout = setTimeout('autoCompleteInviteSearch("'+encodeURI(search)+'")', 500); 
				}else{
				 	$("#newInvite #dropdown_searchInvite").css({"display" : "none" });	
				}	
			});
        }
    },
    invitedUserEmail : {
    	placeholder : "Email",
        inputType : "text",
        rules : {
            required : true
        },
        init:function(){
        	$(".invitedUserEmailtext").css("display","none");	 
        }
    },
    poiTypes :{
    	inputType : "select",
    	placeholder : "Type du point d'intérêt",
    	options : poiTypes
    },
    role :{
    	inputType : "select",
    	placeholder : "Quel est votre rôle dans cette organisation ?",
    	rules : { required : true },
    	//value : "admin",
    	options : {
    		admin : trad.administrator,
			member : trad.member,
			creator : trad.justCitizen
    	}
    },
    hiddenArray : {
       inputType : "hidden",
        value : []
    },
    hiddenTrue : {
       inputType : "hidden",
        value : true
    },
    dateEnd :{
    	inputType : "date",
    	placeholder : "Fin de la période de vote",
    	rules : { 
    		required : true,
    		greaterThanNow : ["DD/MM/YYYY"]
    	}
    }
};

var typeObj = {
	"themes":{ 
		dynForm : {
		    jsonSchema : {
			    title : "Theme Switcher ?",
			    icon : "question-cirecle-o",
			    noSubmitBtns : true,
			    properties : {
			    	custom :{
		            	inputType : "custom",
		            	html : function() { 
		            		return "<div class='menuSmallMenu'>"+js_templates.loop( [ 
			            		{ label : "ph dori", classes:"bg-dark", icon:"fa-bullseye", action : "javascript:window.location.href = moduleId+'?theme=ph-dori'"},
			            		{ label : "notragora", classes:"bg-grey", icon:"fa-video-camera ", action : "javascript:window.location.href = moduleId+'?theme=notragora'"},
			            		{ label : "C02", classes:"bg-red", icon:"fa-search", action : "javascript:window.location.href = moduleId+'?theme=CO2'"},
			            		{ label : "network", classes:"bg-orange", icon:"fa-bars", action : "javascript:window.location.href = moduleId+'?theme=network'"},
			            		
		            		], "col_Link_Label_Count", { classes : "bg-red kickerBtn", parentClass : "col-xs-12 col-sm-4 "} )+"</div>";
		            	}
		            }
			    }
			}
		}
	},
	"addElement":{ 
		dynForm : {
		    jsonSchema : {
			    title : "Ajouter un élément ?",
			    icon : "question-cirecle-o",
			    noSubmitBtns : true,
			    properties : {
			    	custom :{
		            	inputType : "custom",
		            	html : function() { 
		            		return "<div class='menuSmallMenu'>"+js_templates.loop( [ 
			            		{ label : "event", classes:"bg-"+typeObj["event"].color, icon:"fa-"+typeObj["event"].icon, action : "javascript:elementLib.openForm('event')"},
			            		{ label : "organization", classes:"bg-"+typeObj["organization"].color, icon:"fa-"+typeObj["organization"].icon, action : "javascript:elementLib.openForm('organization')"},
			            		{ label : "project", classes:"bg-"+typeObj["project"].color, icon:"fa-"+typeObj["project"].icon, action : "javascript:elementLib.openForm('project')"},
			            		{ label : "poi", classes:"bg-"+typeObj["poi"].color, icon:"fa-"+typeObj["poi"].icon, action : "javascript:elementLib.openForm('poi')"},
			            		{ label : "entry", classes:"bg-"+typeObj["entry"].color, icon:"fa-"+typeObj["entry"].icon, action : "javascript:elementLib.openForm('entry')"},
			            		{ label : "action", classes:"bg-"+typeObj["action"].color, icon:"fa-"+typeObj["action"].icon, action : "javascript:elementLib.openForm('action')"},
			            		{ label : "classified", classes:"bg-"+typeObj["classified"].color, icon:"fa-"+typeObj["classified"].icon, action : "javascript:elementLib.openForm('classified')"},
			            		{ label : "Documentation", classes:"bg-grey lbh", icon:"fa-book", action : "#default.view.page.index.dir.docs"},
			            		{ label : "Signaler un bug", classes:"bg-grey lbh", icon:"fa-bug", action : "#news.index.type.pixels"},
		            		], "col_Link_Label_Count", { classes : "bg-red kickerBtn", parentClass : "col-xs-12 col-sm-4 "} )+"</div>";
		            	}
		            }
			    }
			}
		}
	},
	"person" : {
		col : "citoyens" , 
		ctrl : "person",
		titleClass : "bg-yellow",
		bgClass : "bgPerson",
		color:"yellow",
		icon:"user",
		lbh : "#person.invite",
		dynForm : {
		    jsonSchema : {
			    title : "Inviter quelqu'un",
			    icon : "user",
			    type : "object",
			    properties : {
			    	info : {
		                inputType : "custom",
		                html:"<p><i class='fa fa-info-circle'></i> Si vous voulez inviter quelqu'un à rejoindre Communecter ...</p>",
		            },
		            inviteSearch : typeObjLib.inviteSearch,
			        /*invitedUserName : typeObjLib.invitedUserName,
			        invitedUserEmail : typeObjLib.invitedUserEmail,*/
			        "preferences[publicFields]" : {
		               inputType : "hidden",
		                value : []
		            },
		            "preferences[privateFields]" : {
		               inputType : "hidden",
		                value : []
		            },
		            "preferences[isOpenData]" : {
		               inputType : "hidden",
		                value : false
		            },
			    }
			}
		}},
	"persons" : {col:"citoyens" , ctrl:"person"},
	"people" : {col:"citoyens" , ctrl:"person",color:"yellow"},
	"poi":{ 
		col:"poi",
		ctrl:"poi",
		color:"azure",
		icon:"info-circle",

		dynForm : {
		    jsonSchema : {
			    title : "Formulaire Point d'interet",
			    icon : "map-marker",
			    type : "object",
			    onLoads : {
			    	//pour creer un subevnt depuis un event existant
			    	subPoi : function(){
			    		if(contextData.type && contextData.id )
			    		{
		    				$('#ajaxFormModal #parentId').val(contextData.id);
			    			$("#ajaxFormModal #parentType").val( contextData.type ); 
			    		}
			    	}
			    },
			    beforeSave : function(){
			    	
			    	if( typeof $("#ajaxFormModal #description").code === 'function' )  
			    		$("#ajaxFormModal #description").val( $("#ajaxFormModal #description").code() );
			    	if($('#ajaxFormModal #parentId').val() == "" && $('#ajaxFormModal #parentType').val() ){
				    	$('#ajaxFormModal #parentId').val( userId );
				    	$("#ajaxFormModal #parentType").val( "citoyens" ); 
				    }
			    },
			    beforeBuild : function(){
			    	elementLib.setMongoId('poi');
			    },
				afterSave : function(){
					if( $('.fine-uploader-manual-trigger').fineUploader('getUploads').length > 0 )
				    	$('.fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
				    else {
				    	elementLib.closeForm();	
				    	loadByHash( location.hash );
				    }
			    },
			    properties : {
			    	info : {
		                inputType : "custom",
		                html:"<p><i class='fa fa-info-circle'></i> Un Point d'interet est un élément assez libre qui peut etre géolocalisé ou pas, qui peut etre rataché à une organisation, un projet ou un évènement.</p>",
		            },
		            type : typeObjLib.poiTypes,
			        name : typeObjLib.name,
			        //image : typeObjLib.image,
		            description : typeObjLib.description,
		            location : typeObjLib.location,
		            tags :typeObjLib.tags,
		            formshowers : {
		                inputType : "custom",
		                html: "<a class='btn btn-default text-dark w100p' href='javascript:;' onclick='$(\".urlsarray\").slideToggle()'><i class='fa fa-plus'></i> options (urls)</a>",
		            },
		            urls : typeObjLib.urlsOptionnel,
		            parentId : typeObjLib.hidden,
		            parentType : typeObjLib.hidden,
			    }
			}
		}},
	"citoyen" : {col:"citoyens" , ctrl:"person"},
	"citoyens" : {col:"citoyens" , ctrl:"person",color:"yellow",icon:"user"},
	"siteurl":{ 
		col:"siteurl",
		ctrl:"siteurl",
		dynForm : {
		    jsonSchema : {
			    title : "Point of interest Form",
			    icon : "map-marker",
			    type : "object",
			    onLoads : {
			    	//pour creer un subevnt depuis un event existant
			    	subPoi : function(){
			    		if(contextData.type && contextData.id ){
		    				$('#ajaxFormModal #parentId').val(contextData.id);
			    			$("#ajaxFormModal #parentType").val( contextData.type ); 
			    		}
			    	}
			    },
			    properties : {
			    	info : {
		                inputType : "custom",
		                html:"<p><i class='fa fa-info-circle'></i> Une url.</p>",
		            },
		            urls : typeObjLib.urls,
		            type : typeObjLib.poiTypes,
			        name :  typeObjLib.name,
		            description : typeObjLib.descriptionOptionnel ,
		            location : typeObjLib.location,
		            tags : typeObjLib.tags,
		            parentId :typeObjLib.hidden,
		            parentType : typeObjLib.hidden,
			    }
			}
		}},
	"organization" : { 
		col:"organizations", 
		ctrl:"organization", 
		icon : "group",
		titleClass : "bg-green",
		color:"green",
		bgClass : "bgOrga",
		dynForm : {
		    jsonSchema : {
			    title : trad.addOrganization,
			    icon : "group",
			    type : "object",
			    beforeBuild : function(){
			    	elementLib.setMongoId('organizations');
			    },
			    beforeSave : function(){
			    	if (typeof $("#ajaxFormModal #description").code === 'function' ) 
			    		$("#ajaxFormModal #description").val( $("#ajaxFormModal #description").code() );
			    },
			    afterSave : function(){
					if( $('.fine-uploader-manual-trigger').fineUploader('getUploads').length > 0 )
				    	$('.fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
				    else {
				    	elementLib.closeForm();
				    	loadByHash( location.hash );	
				    }
			    },
			    properties : {
			    	info : {
		                inputType : "custom",
		                html:"<p><i class='fa fa-info-circle'></i> Si vous voulez créer une nouvelle organisation de façon à le rendre plus visible : c'est le bon endroit !!<br>Vous pouvez ainsi organiser l'équipe projet, planifier les tâches, échanger, prendre des décisions ...</p>",
		            },
			        name : typeObjLib.nameOrga,
			        similarLink : typeObjLib.similarLink,
			        type : typeObjLib.typeOrga,
		            role : typeObjLib.role,
		            tags : typeObjLib.tags,
		            location : typeObjLib.location,
			        //image : typeObjLib.image( "#organization.detail.id."+uploadObj.id ),
		            formshowers : {
		                inputType : "custom",
		                html:
						"<a class='btn btn-default text-dark w100p' href='javascript:;' onclick='$(\".emailtext,.descriptiontextarea,.urltext\").slideToggle();activateMarkdown(\"#ajaxFormModal #description\");'><i class='fa fa-plus'></i> options (email, desc, urls, telephone)</a>",
		            },
		            email : typeObjLib.emailOptionnel,
			        description : typeObjLib.description,
		            url : typeObjLib.url,
			        /*telephone : {
			        	placeholder : "Téléphne",
			            inputType : "text",
			            init : function(){
			            	$(".telephonetext").css("display","none");
			            }
			        },*/
		            "preferences[publicFields]" : typeObjLib.hiddenArray,
		            "preferences[privateFields]" : typeObjLib.hiddenArray,
		            "preferences[isOpenData]" : typeObjLib.hiddenTrue,
		            "preferences[isOpenEdition]" : typeObjLib.hiddenTrue
			    }
			}
		}
		/*form : {
			url : "/"+moduleId+"/organization/addorganizationform",
			title : "Ajouter une Organisation"
		}*/	},
	"organizations" : {col:"organizations",ctrl:"organization",color:"green",icon:"users"},
	"event" : {
		col:"events",
		ctrl:"event",
		icon : "calendar",
		titleClass : "bg-orange",
		color:"orange",
		bgClass : "bgEvent",
		dynForm : {
		    jsonSchema : {
			    title : trad.addEvent,
			    icon : "calendar",
			    type : "object",
			    onLoads : {
			    	//pour creer un subevnt depuis un event existant
			    	"subEvent" : function(){
			    		//alert(contextData.type);
			    		if(contextData.type == "events"){
			    			$("#ajaxFormModal #parentId").removeClass('hidden');
			    		
		    				if( $('#ajaxFormModal #parentId > optgroup > option[value="'+contextData.id+'"]').length == 0 )
			    				$('#ajaxFormModal #parentId > optgroup[label="events"]').prepend('<option value="'+contextData.id+'" selected>Fait parti de : '+contextData.name+'</option>');
			    			else if ( contextData && contextData.id ){
				    			$("#ajaxFormModal #parentId").val( contextData.id );
			    			}
			    			
			    			if( contextData && contextData.type )
			    				$("#ajaxFormModal #parentType").val( contextData.type ); 

			    			if(contextData.startDate && contextData.endDate ){
			    				$("#ajaxFormModal").after("<input type='hidden' id='startDateParent' value='"+contextData.startDate+"'/>"+
			    										  "<input type='hidden' id='endDateParent' value='"+contextData.endDate+"'/>");
			    				$("#ajaxFormModal #startDate").after("<span id='parentstartDate'><i class='fa fa-warning'></i> date début du parent : "+moment( contextData.startDate).format('DD/MM/YYYY HH:mm')+"</span>");
			    				$("#ajaxFormModal #endDate").after("<span id='parentendDate'><i class='fa fa-warning'></i> date de fin du parent : "+moment( contextData.endDate).format('DD/MM/YYYY HH:mm')+"</span>");
			    			}
			    			//alert($("#ajaxFormModal #parentId").val() +" | "+$("#ajaxFormModal #parentType").val());
			    		}
			    		else {
				    		if( $('#ajaxFormModal #organizerId > optgroup > option[value="'+contextData.id+'"]').length == 0 )
			    				$('#ajaxFormModal #organizerId').prepend('<option data-type="'+typeObj[contextData.type].ctrl+'" value="'+contextData.id+'" selected>Organisé par : '+contextData.name+'</option>');
			    			else if( contextData && contextData.id )
				    			$("#ajaxFormModal #organizerId").val( contextData.id );
			    			if( contextData && contextData.type )
			    				$("#ajaxFormModal #organizerType").val( contextData.type);
			    			//alert($("#ajaxFormModal #organizerId").val() +" | "+$("#ajaxFormModal #organizerType").val());
			    		}
			    	}
			    },
			    beforeBuild : function(){
			    	elementLib.setMongoId('events');
			    },
			    afterSave : function(){
					if( $('.fine-uploader-manual-trigger').fineUploader('getUploads').length > 0 )
				    	$('.fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
				    else {
				    	elementLib.closeForm();
				    	loadByHash( location.hash );	
				    }
			    },
			    beforeSave : function(){
			    	//alert("onBeforeSave");
			    	
			    	if( !$("#ajaxFormModal #allDay").val())
			    		$("#ajaxFormModal #allDay").val(false);
			    	if( typeof $("#ajaxFormModal #description").code === 'function' )
			    		$("#ajaxFormModal #description").val( $("#ajaxFormModal #description").code() );
			    	//mylog.log($("#ajaxFormModal #startDate").val(),moment( $("#ajaxFormModal #startDate").val()).format('YYYY/MM/DD HH:mm'));
			    	
			    	//Transform datetime before sending
			    	var allDay = $("#ajaxFormModal #allDay").is(':checked');
			    	var dateformat = "DD/MM/YYYY";
			    	if (! allDay) 
			    		var dateformat = "DD/MM/YYYY HH:mm"
			    	$("#ajaxFormModal #startDate").val( moment( $("#ajaxFormModal #startDate").val(), dateformat).format());
					$("#ajaxFormModal #endDate").val( moment( $("#ajaxFormModal #endDate").val(), dateformat).format());
					//mylog.log($("#ajaxFormModal #startDate").val());
			    },
			    properties : {
			    	info : {
		                inputType : "custom",
		                html:"<p><i class='fa fa-info-circle'></i> Si vous voulez créer un nouvel évènement de façon à le rendre plus visible : c'est le bon endroit !!<br>Vous pouvez inviter des participants, planifier des sous évènements, publier des actus lors de l'évènement...</p>",
		            },
		            name : typeObjLib.nameEvent,
			        similarLink : typeObjLib.similarLink,
			        organizerId :{
			        	rules : { required : true },
		            	inputType : "select",
		            	placeholder : "Qui organise ?",
		            	rules : { required : true },
		            	options : firstOptions(),
		            	"groupOptions" : myAdminList( ["organizations","projects"] ),
			            init : function(){
			            	$("#ajaxFormModal #organizerId").off().on("change",function(){
			            		
			            		organizerId = $(this).val();
			            		if(organizerId == "dontKnow" )
			            			organizerType = "dontKnow";
			            		else if( $('#organizerId').find(':selected').data('type') && typeObj[$('#organizerId').find(':selected').data('type')] )
			            			organizerType = typeObj[$('#organizerId').find(':selected').data('type')].col;
			            		else
			            			organizerType = typeObj["person"].col;

			            		mylog.warn( "organizer",organizerId,organizerType );
			            		$("#ajaxFormModal #organizerType ").val( organizerType );
			            	});
			            }
		            },
			        organizerType : typeObjLib.hidden,
			        parentId :{
		            	inputType : "select",
		            	"class" : "hidden",
		            	placeholder : "Fait parti d'un évènement ?",
		            	options : {
		            		"":"Pas de Parent"
		            	},
		            	"groupOptions" : myAdminList( ["events"] ),
		            	init : function(){
			            	$("#ajaxFormModal #parentId ").off().on("change",function(){

			            		parentId = $(this).val();
			            		startDateParent = "2000/01/01 00:00";
			            		endDateParent = "2100/01/01 00:00";
			            		if( parentId != "" ){
			            			//Search in the current context
			            			if (typeof contextData != "undefined") {
			            				if (contextData.type == "events" && contextData.id == parentId) {
			            					mylog.warn("event found in contextData : ",contextData.startDate+"|"+contextData.endDate);
				            				startDateParent = contextData.startDate;
				            				endDateParent = contextData.endDate
			            				}
			            			}
			            			//Search in my contacts list
			            			if(typeof myContacts != "undefined") {
				            			$.each(myContacts.events,function (i,evObj) { 
				            				if( evObj["_id"]["$id"] == parentId){
				            					mylog.warn("event found in my contact list: ",evObj.startDate+"|"+evObj.endDate);
				            					startDateParent = evObj.startDate;
				            					endDateParent = evObj.endDate
					    					}
				            			});
				            		}
				            		$("#startDateParent").val(startDateParent);
				            		$("#endDateParent").val(endDateParent);
				            		$("#parentstartDate").html("<i class='fa fa-warning'></i> Date de début de l'événement parent : "+moment( startDateParent ).format('DD/MM/YYYY HH:mm'));
					    			$("#parentendDate").html("<i class='fa fa-warning'></i> Date de fin de l'événement parent : "+moment( endDateParent ).format('DD/MM/YYYY HH:mm'));
			            		}
			            	});
			            }
		            },
		            parentType : typeObjLib.hidden,
			        type : typeObjLib.typeEvent,
			        //image : typeObjLib.image( "#event.detail.id."+uploadObj.id ),
		            allDay : typeObjLib.allDay,
		            startDateInput : typeObjLib.startDateInput,
		            endDateInput : typeObjLib.endDateInput,
		            location : typeObjLib.location,
		            tags : typeObjLib.tags,
		            
		            /*public : {
		            	inputType : "hidden",
		            	"switch" : {
		            		"onText" : "Privé",
		            		"offText" : "Public",
		            		"labelText":"Type"
		            	}
		            },*/
		            formshowers : {
		                inputType : "custom",
		                html:"<a class='btn btn-default  text-dark w100p' href='javascript:;' onclick='$(\".descriptionwysiwyg,.urltext\").slideToggle();activateSummernote(\"#ajaxFormModal #description\");'><i class='fa fa-plus'></i> options (desc, urls)</a>",
		            },
			        description : typeObjLib.descriptionOptionnel,
		            url : typeObjLib.urlOptionnel,
		            "preferences[publicFields]" : typeObjLib.hiddenArray,
		            "preferences[privateFields]" : typeObjLib.hiddenArray,
		            "preferences[isOpenData]" :  typeObjLib.hiddenTrue,
		            "preferences[isOpenEdition]" :  typeObjLib.hiddenTrue,
		            "startDate" :  typeObjLib.hidden,
		            "endDate" :  typeObjLib.hidden
			    }
			}
		}
		/*form : {
			url:"/"+moduleId+"/event/eventsv",
			title : "Ajouter un évènement"
		}*/	},
	"events" : {col:"events",ctrl:"event",icon : "calendar",color:"orange"},
	"project" : {
		col:"projects",
		ctrl:"project",
		icon : "lightbulb-o",
		color : "purple",
		titleClass : "bg-purple",
		bgClass : "bgProject",
		dynForm : {
		    jsonSchema : {
			    title : trad.addProject,
			    icon : "lightbulb-o",
			    type : "object",
			    onLoads : {
			    	//pour creer un subevnt depuis un event existant
			    	"sub" : function(){
			    			$("#ajaxFormModal #parentId").val( contextData.id );
			    		 	$("#ajaxFormModal #parentType").val( contextData.type ); 
			    		 	$("#ajax-modal-modal-title").html($("#ajax-modal-modal-title").html()+" sur "+contextData.name );
			    	}
			    },
			    beforeBuild : function(){
			    	elementLib.setMongoId('projects');
			    },
			    afterSave : function(){
					if( $('.fine-uploader-manual-trigger').fineUploader('getUploads').length > 0 )
				    	$('.fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
				    else {
				    	elementLib.closeForm();
				    	loadByHash( location.hash );	
				    }
			    },
			    beforeSave : function(){
			    	if( typeof $("#ajaxFormModal #description").code === 'function' ) 
			    		$("#ajaxFormModal #description").val( $("#ajaxFormModal #description").code() );
			    },
			    properties : {
			    	info : {
		                inputType : "custom",
		                html:"<p><i class='fa fa-info-circle'></i> Si vous voulez créer un nouveau projet de façon à le rendre plus visible : c'est le bon endroit !!<br>Vous pouvez ainsi organiser l'équipe projet, planifier les tâches, échanger, prendre des décisions ...</p>",
		            },
			        name : typeObjLib.nameProject,
		            parentType : typeObjLib.hidden,
		            //image : typeObjLib.image("#project.detail.id."+uploadObj.id),
		            location : typeObjLib.location,
		            tags :typeObjLib.tags,
		            formshowers : {
		                inputType : "custom",
		                html:"<a class='btn btn-default  text-dark w100p' href='javascript:;' onclick='$(\".descriptionwysiwyg,.urltext\").slideToggle();activateSummernote(\"#ajaxFormModal #description\");'><i class='fa fa-plus'></i> options (desc, urls)</a>",
		            },
			        description : typeObjLib.descriptionOptionnel,
		            url : typeObjLib.urlOptionnel,
		            "preferences[publicFields]" : typeObjLib.hiddenArray,
		            "preferences[privateFields]" :typeObjLib.hiddenArray,
		            "preferences[isOpenData]" : typeObjLib.hiddenTrue,
		            "preferences[isOpenEdition]" : typeObjLib.hiddenTrue
			    }
			}
		}
	},
	"projects" : {col:"projects",ctrl:"project",color:"purple",icon:"lightbulb-o"},
	"city" : {col:"cities",ctrl:"city"},
	"cities" : {
		col:"cities",
		ctrl:"city", 
		titleClass : "bg-red", 
		icon : "university",
		color:"red",
		dynForm : {
			jsonSchema : {
				title : "Modifier une ville",
				icon : "university",
				/*onLoads : {
		    	//pour creer un subevnt depuis un event existant
			    	"sub" : function(){
			    		$("#ajaxFormModal #room").val( contextData.id );
		    		 	$("#ajax-modal-modal-title").html($("#ajax-modal-modal-title").html()+" sur "+contextData.name );
			    	}
			    },*/
				properties : {
					info : {
						"inputType" : "custom",
						"html":"<p><i class='fa fa-info-circle'></i> Modifier une ville</p>",
					},
					id :typeObjLib.hidden,
					insee :{
						"inputType" : "hidden",
						"rules" : { "required" : true }
					},
					name : typeObjLib.name,
					country :{
						"inputType" : "hidden",
						"rules" : { "required" : true }
					},
					dep :{
						"inputType" : "text",
						"placeholder" : "Numéro du département"
					},
					depName :{
						"inputType" : "text",
						"placeholder" : "Nom du département"
					},
					region :{
						"inputType" : "text",
						"placeholder" : "Numéro de la région"
					},
					regionName :{
						"inputType" : "text",
						"placeholder" : "Nom de la région"
					},
					"latitude" : {
						"inputType" : "text",
						"placeholder" : "Nom de la région"
					},
					"longitude" : {
						"inputType" : "text",
						"placeholder" : "Nom de la région"
					},
					postalcode : {
						inputType : "postalcode"
					},
					osmid :{
						"inputType" : "text",
						"placeholder" : "OSM id"
					},
					wikidata :{
						"inputType" : "text",
						"placeholder" : "wikidata"
					}
				}
			}
		}
	},
	"entry" : {
		col:"surveys",
		ctrl:"survey",
		titleClass : "bg-lightblue",
		bgClass : "bgDDA",
		icon : "gavel",
		color : "azure",
		saveUrl : baseUrl+"/" + moduleId + "/survey/saveSession",
		dynForm : {
		    jsonSchema : {
			    title : "Ajouter une proposition",
			    icon : "gavel",
			    type : "object",
			    onLoads : {
			    	//pour creer un subevnt depuis un event existant
			    	"sub" : function(){
		    			$("#ajaxFormModal #survey").val( contextData.id );
		    		 	$("#ajax-modal-modal-title").html($("#ajax-modal-modal-title").html()+" sur "+contextData.name );
			    	}
			    },
			    beforeSave : function(){
			    	
			    	if( typeof $("#ajaxFormModal #message").code === 'function' )  
			    		$("#ajaxFormModal #message").val( $("#ajaxFormModal #message").code() );
			    },
			    properties : {
			    	info : {
		                inputType : "custom",
		                html:"<p><i class='fa fa-info-circle'></i> Une proposition sert à discuter et demander l'avis d'une communauté sur une idée ou une question donnée</p>",
		            },
			        id : typeObjLib.hidden,
		            survey :{
		            	inputType : "select",
		            	placeholder : "Choisir une thématique ?",
		            	init : function(){
		            		if( userId )
		            		{
		            			/*filling the seclect*/
			            		if(notNull(window.myVotesList)){
			            			html = buildSelectGroupOptions( window.myVotesList);
			            			$("#survey").append(html); 
			            		} else {
			            			getAjax( null , baseUrl+"/" + moduleId + "/rooms/index/type/citoyens/id/"+userId+"/view/data/fields/votes" , function(data){
			            			    window.myVotesList = {};
			            			    $.each( data.votes , function( k,v ) 
			            			    { 
			            			    	parentName = "";
				            			    if(!window.myVotesList[ v.parentType]){
				            			    	var label = ( v.parentType == "cities" && cpCommunexion && v.parentId.indexOf(cpCommunexion) ) ? cityNameCommunexion : v.parentType;
				            			    	window.myVotesList[ v.parentType] = {"label":label};
				            			    	window.myVotesList[ v.parentType].options = {}
				            			    } /*else{
				            			    	//if(notNull(myContactsById[v.parentType]) && notNull(myContactsById[v.parentType][v['_id']['$id']]))
				            			    	//parentName = myContactsById[v.parentType][v['_id']['$id']].name;
				            			    }*/
			            			    	window.myVotesList[ v.parentType].options[v['_id']['$id'] ] = v.name+parentName; 
			            			    }); 
			            			    //run through myContacts to fill parent names 
			            			    mylog.dir(window.myVotesList);
			            			    
			            			    html = buildSelectGroupOptions(window.myVotesList);
										$("#survey").append(html);
										if(contextData && contextData.id)
											$("#ajaxFormModal #survey").val( contextData.id );
								    } );
			            		}
			            		/*$("#survey").change(function() { 
			            			mylog.dir( $(this).val().split("_"));
			            		});*/

		            		}
		            	},
		            	custom : "<br/><span class='text-small'>Une thématique est un espace de décision lié à une ville, une organisation ou un projet <br/>Vous pouvez créer des espaces coopératifs sur votre commune, organisation et projet</span>"
		            },
		            name : typeObjLib.name,
		            message : typeObjLib.description,
		            dateEnd : typeObjLib.dateEnd,
		            tags : typeObjLib.tags,
		            formshowers : {
		                inputType : "custom",
		                html:"<a class='btn btn-default  text-dark w100p' href='javascript:;' onclick='$(\".urlsarray\").slideToggle()'><i class='fa fa-plus'></i> options ( urls)</a>",
		            },
		            urls : typeObjLib.urls,
		            email:{
		            	inputType : "hidden",
		            	value : (userId!=null && userConnected!=null) ? userConnected.email : ""
		            },
		            organizer:{
		            	inputType : "hidden",
		            	value : "currentUser"
		            },
		            type : {
		            	inputType : "hidden",
		            	value : "entry"
		            }
			    }
			}
		} },
	"vote" : {col:"actionRooms",ctrl:"survey"},
	"survey" : {col:"actionRooms",ctrl:"survey",color:"lightblue2",icon:"cog"},
	"action" : {
		col:"actions",
		ctrl:"room",
		titleClass : "bg-lightblue",
		bgClass : "bgDDA",
		icon : "cogs",
		color : "lightblue2",
		saveUrl : baseUrl+"/" + moduleId + "/rooms/saveaction",
		dynForm : {
		    jsonSchema : {
			    title : "Ajouter une action",
			    icon : "gavel",
			    type : "object",
			    onLoads : {
			    	//pour creer un subevnt depuis un event existant
			    	"sub" : function(){
			    		$("#ajaxFormModal #room").val( contextData.id );
		    		 	$("#ajax-modal-modal-title").html($("#ajax-modal-modal-title").html()+" sur "+contextData.name );
			    	}
			    },
			    beforeSave : function(){
			    	if( typeof $("#ajaxFormModal #message").code === 'function' ) 
			    		$("#ajaxFormModal #message").val( $("#ajaxFormModal #message").code() );
			    },
			    properties : {
			    	info : {
		                inputType : "custom",
		                html:"<p><i class='fa fa-info-circle'></i> Une Action permet de faire avancer votre projet ou le fonctionnement de votre association</p>",
		            },
			        id :{
		              inputType : "hidden",
		              value : ""
		            },
		            room :{
		            	inputType : "select",
		            	placeholder : "Choisir une thématique ?",
		            	init : function(){
		            		if( userId )
		            		{
		            			/*filling the seclect*/
			            		if(notNull(window.myActionsList)){
			            			html = buildSelectGroupOptions( window.myActionsList);
			            			$("#room").append(html); 
			            		} else {
			            			getAjax( null , baseUrl+"/" + moduleId + "/rooms/index/type/citoyens/id/"+userId+"/view/data/fields/actions" , function(data){
			            			    window.myActionsList = {};
			            			    $.each( data.actions , function( k,v ) 
			            			    { mylog.log(v.parentType,v.parentId);
			            			    	if(v.parentType){
					            			    if( !window.myActionsList[ v.parentType] ){
													var label = ( v.parentType == "cities" && cpCommunexion && v.parentId.indexOf(cpCommunexion) ) ? cityNameCommunexion : "Thématique des " + trad[v.parentType];
					            			    	window.myActionsList[ v.parentType] = {"label":label};
					            			    	window.myActionsList[ v.parentType].options = {};
					            			    }
				            			    	window.myActionsList[v.parentType].options[v['_id']['$id'] ] = v.name; 
				            			    }
			            			    }); 
			            			    mylog.dir(window.myActionsList);
			            			    html = buildSelectGroupOptions(window.myActionsList);
										$("#room").append(html);
										if(contextData && contextData.id)
											$("#ajaxFormModal #room").val( contextData.id );
								    } );
			            		}
		            		}
		            	},
		            	custom : "<br/><span class='text-small'>Choisir l'espace où s'ajoutera votre action parmi vos organisations et projets<br/>Vous pouvez créer des espaces coopératifs sur votre commune, organisation et projet  </span>"
		            },
		            name : typeObjLib.name,
		            message : typeObjLib.description,
		            startDate :{
		              inputType : "date",
		              placeholder : "Date de début"
		            },
		            dateEnd :{
		              inputType : "date",
		              placeholder : "Date de fin"
		            },

		         	tags : typeObjLib.tags,
		            formshowers : {
		                inputType : "custom",
		                html:"<a class='btn btn-default  text-dark w100p' href='javascript:;' onclick='$(\".urlsarray\").slideToggle()'><i class='fa fa-plus'></i> options (urls)</a>",
		            },
		            urls : typeObjLib.urls,
		            email:{
		            	inputType : "hidden",
		            	value : (userId!=null && userConnected != null) ? userConnected.email : ""
		            },
		            organizer:{
		            	inputType : "hidden",
		            	value : "currentUser"
		            },
		            "type" : {
		            	inputType : "hidden",
		            	value : "action"
		            },
		            parentId :{
		            	inputType : "hidden",
		            	value : userId	
		            },
		            parentType : {
			            inputType : "hidden",
			            value : "citoyens"
			        },
			    }
			}
		} },
	"actions" : {col:"actions",color:"azure",ctrl:"room",icon:"cog"},
	"rooms" : {col:"actions",ctrl:"room",color:"azure",icon:"gavel"},
	"discuss" : {col:"actionRooms",ctrl:"room"}
	/*"contactPoint" : {
		col : "contact" , 
		ctrl : "person",
		titleClass : "bg-blue",
		bgClass : "bgPerson",
		color:"blue",
		icon:"user",
		saveUrl : baseUrl+"/" + moduleId + "/element/saveContact",
		dynForm : {
		    jsonSchema : {
			    title : "Ajouter un contact",
			    icon : "user",
			    type : "object",
			    onLoads : {
			    	//pour creer un contact depuis un element existant
			    	"contact" : function(){
			    		if( contextData && contextData.id )
	    					$("#ajaxFormModal #parentId").val( contextData.id );
		    			if( contextData && contextData.type )
		    				$("#ajaxFormModal #parentType").val( contextData.type ); 
					}
			    },
			    afterSave : function(){
			    	elementLib.closeForm();	
			    	loadByHash(location.hash);
			    },
			    properties : {
			    	info : {
		                inputType : "custom",
		                html:"<p><i class='fa fa-info-circle'></i> Si vous voulez ajouter un nouveau contact de façon à faciliter les échanges</p>",
		            },
		            name : typeObjLib.namePerson,
			        similarLink : typeObjLib.similarLink,
			        email : typeObjLib.email,
			        role :{
		              inputType : "text",
		              placeholder : "Role du contact"
		            },
			        phone :{
		              inputType : "text",
		              placeholder : "téléphone du contact"
		            },
		            idContact : typeObjLib.hidden,
		            parentId :typeObjLib.hidden,
		            parentType : typeObjLib.hidden,
			        index : typeObjLib.hidden
			    }
			}
		}},
	"classified":{ 
		col:"classified",
		ctrl:"classified",
		color:"azure",
		icon:"bullhorn",

		dynForm : {
		    jsonSchema : {
			    title : "Publier une annonce",
			    icon : "bullhorn",
			    type : "object",	    
			    onLoads : {
			    	//pour creer un subevnt depuis un event existant
			    	subPoi : function(){
			    		if(contextData.type && contextData.id ){
		    				$('#ajaxFormModal #parentId').val(contextData.id);
			    			$("#ajaxFormModal #parentType").val( contextData.type ); 
			    		}
			    		
			    	}
			    },
			    beforeSave : function(){
			    	var tagAndTypes = $("#ajaxFormModal #tags").val();
			    	if( $("#ajaxFormModal #type").val() )
			    		tagAndTypes += ","+$("#ajaxFormModal #type").val();
			    	if( $("#ajaxFormModal #subtype").val() )
			    		tagAndTypes += ","+$("#ajaxFormModal #subtype").val();
			    	$("#ajaxFormModal #tags").val( tagAndTypes );
			    	
			    	if( typeof $("#ajaxFormModal #description").code === 'function' )  
			    		$("#ajaxFormModal #description").val( $("#ajaxFormModal #description").code() );
			    	if($('#ajaxFormModal #parentId').val() == "" && $('#ajaxFormModal #parentType').val() ){
				    	$('#ajaxFormModal #parentId').val(userId);
				    	$("#ajaxFormModal #parentType").val( "citoyens" ); 
				    }
			    },
			    properties : {
			    	info : {
		                inputType : "custom",
		                html:"",//<p><i class='fa fa-info-circle'></i> Une Annonce est un élément assez libre qui peut etre géolocalisé ou pas, qui peut etre rataché à tous les éléments.</p>",
		            },
			        name : typeObjLib.name,
		            description : typeObjLib.description,
		            location : typeObjLib.location,
		            typeBtn :{
		                label : "Type d'annonce",
			            inputType : "tagList",
		                placeholder : "Type d'annonce",
		                list : classifiedTypes,
		                init : function(){
			            	$(".typeBtn").off().on("click",function()
			            	{
			            		$(".typeBtn").removeClass("active btn-dark-blue text-white");
			            		$( "."+$(this).data('tag')+"Btn" ).toggleClass("active btn-dark-blue text-white");
			            		$("#ajaxFormModal #type").val( ( $(this).hasClass('active') ) ? $(this).data('tag') : "" );

			            		$("#ajaxFormModal #subtype").val("");
			            		fieldHTML = "";
			            		$.each(classifiedSubTypes[ $(this).data('tag') ].subType, function(k,v) { 
			            			fieldHTML += '<a class="btn btn-link tagListEl subtypeBtn '+k+'Btn " data-tag="'+k+'" href="javascript:;">'+v+'</a>';
			            		});
			            		$(".subtypeSection").html(fieldHTML);

			            		$(".subtypeBtn").off().on("click",function()
				            	{
				            		$( "."+$(this).data('tag')+"Btn" ).toggleClass("btn-link text-white").toggleClass("active  btn-dark-blue text-white");
				            		$("#ajaxFormModal #subtype").val( ( $(this).hasClass('active') ) ? $(this).data('tag') : "" );
								});
			            	});
			            }
		            },
		            type : typeObjLib.hidden,
		            subtypeSection : {
		                inputType : "custom",
		                html:"<div class='subtypeSection'></div>",
		            },
		            subtype : typeObjLib.hidden,
		            formshowers : {
		                inputType : "custom",
		                html: "<a class='btn btn-default text-dark w100p' href='javascript:;' onclick='$(\".urlsarray\").slideToggle()'><i class='fa fa-plus'></i> options (urls)</a>",
		            },
		            urls : typeObjLib.urls,
		            parentId : typeObjLib.hidden,
		            parentType : typeObjLib.hidden,
			    }
			}
		}},
	"url" : {
		col : "url" , 
		ctrl : "url",
		titleClass : "bg-blue",
		bgClass : "bgPerson",
		color:"blue",
		icon:"user",
		saveUrl : baseUrl+"/" + moduleId + "/element/saveurl",
		dynForm : {
		    jsonSchema : {
			    title : "Ajouter une url",
			    icon : "user",
			    type : "object",
			    onLoads : {
			    	//pour creer un contact depuis un element existant
			    	"parentUrl" : function(){
			    		if( contextData && contextData.id )
	    					$("#ajaxFormModal #parentId").val( contextData.id );
		    			if( contextData && contextData.type )
		    				$("#ajaxFormModal #parentType").val( contextData.type ); 
					}
			    },
			    afterSave : function(){
			    	loadByHash(location.hash);
			    },
			    properties : {
			    	info : {
		                inputType : "custom",
		                html:"<p><i class='fa fa-info-circle'></i> Si vous voulez ajouter un nouveau contact de façon a facilité les échanges</p>",
		            },
		            titre : {
			        	placeholder : "Titre de l'URL",
			        	labelText:"Nom",
			            inputType : "text",
		            	rules : { required : true },
			        },
			        url :{
		              	inputType : "text",
		              	placeholder : "URL du lien",
		            	rules : { required : true },
		            },
		            type :{
		            	inputType : "select",
		            	placeholder : "Type de l'URL",
		            	options : urlTypes,
		            	rules : { required : true },
		            },
		            parentId :{
		            	inputType : "hidden",
		            	rules : { required : true },
		            },
		            parentType : {
			            inputType : "hidden",
		            	rules : { required : true },
			        }
			    }
			}
		}},*/
};

function activateMarkdown(elem) { 
	mylog.log("activateMarkdown", elem);

	markdownParams = {
			savable:false,
			iconlibrary:'fa',
			onPreview: function(e) {
				var previewContent = "";
			    mylog.log(e.isDirty());
			    if (e.isDirty()) {
			    	var converter = new showdown.Converter(),
			    		text      = e.getContent(),
			    		previewContent      = converter.makeHtml(text);
			    } else {
			    	previewContent = "Default content";
			    }
			    return previewContent;
		  	},
		  	onSave: function(e) {
		  		mylog.log(e);
		  	},
		}

	if( !$('script[src="'+baseUrl+'/plugins/bootstrap-markdown/js/bootstrap-markdown.js"]').length ){
		mylog.log("activateMarkdown if");

		$("<link/>", {
		   rel: "stylesheet",
		   type: "text/css",
		   href: baseUrl+"/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css"
		}).appendTo("head");
		$.getScript( baseUrl+"/plugins/showdown/showdown.min.js", function( data, textStatus, jqxhr ) {

			$.getScript( baseUrl+"/plugins/bootstrap-markdown/js/bootstrap-markdown.js", function( data, textStatus, jqxhr ) {
				mylog.log("elem", elem);
				$(elem).markdown(markdownParams);
			});


		});
	} else {
		mylog.log("activateMarkdown else");
		$(elem).markdown(markdownParams);
	}
};

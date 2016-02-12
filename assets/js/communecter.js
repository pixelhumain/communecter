//In this javascript file you can find a bunk of functional functions
//Calling Actions in ajax. Can be used easily on views
function connectPerson(connectUserId, callback) 
{
	console.log("connect Person");
	$.ajax({
		type: "POST",
		url: baseUrl+"/"+moduleId+'/person/connect',
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


function disconnectPerson(idToDisconnect, typeToDisconnect, nameToDisconnect, callback) 
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
}

function disconnectTo(parentType,parentId,childId,childType,connectType){
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
					removeFloopEntity(data.parentId, data.parentType);
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

function connectTo(parentType, parentId, childId, childType, connectType, parentName, actionAdmin) {
	$(".becomeAdminBtn").removeClass("fa-user-plus").addClass("fa-spinner fa-spin");
	//e.preventDefault();
	var formData = {
		"childId" : childId,
		"childType" : childType, 
		"parentType" : parentType,
		"parentId" : parentId,
		"connectType" : connectType,
	};
	if(actionAdmin=="true"){
		formData.adminAction=true;
	}
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
var urlParams = {
	"#person.directory" : {title:"PERSON DIRECTORY ", icon : "share-alt"},
	"#organization.directory" : {title:"ORGANIZATION MEMBERS ", icon : "users"},
	"#project.directory" : {title:"PROJECT CONTRIBUTORS ", icon : "users"},
	"#city.directory" : {title:"CITY DIRECTORY ", icon : "bookmark fa-rotate-270"},
	"#city.opendata" : {title:'STATISTICS ', icon : 'line-chart' },
    "#person.detail" : {title:'PERSON DETAIL ', icon : 'user' },
    "#event.detail" : {title:'EVENT DETAIL ', icon : 'calendar' },
    "#project.detail" : {title:'PROJECT DETAIL ', icon : 'lightbulb-o' },
    "#organization.detail" : {title:'ORGANIZATION DETAIL ', icon : 'users' },
    "#city.detail" : {title:'CITY ', icon : 'university' },
    "#survey.entry.id" : {title:'VOTE LOCAL ', icon : 'legal'},
    "#rooms" : {title:'ACTION ROOMS ', icon : 'cubes'},
    "#admin.importdata" : {title:'IMPORT DATA ', icon : 'download'},
    "#admin.index" : {title:'IMPORT DATA ', icon : 'download'},
    "#admin.directory" : {title:'IMPORT DATA ', icon : 'download'},
    "#search.directory" : {title:'COMMUNECTED DIRECTORY', icon : 'connectdevelop',"urlExtraParam":"&isSearchDesign"},
    "#search.news" : {title:'COMMUNECTED NEWS ', icon : 'rss' },
    "#search.agenda" : {title:'COMMUNECTED AGENDA ', icon : 'calendar'},
	"#search.home" : {title:'COMMUNECTED AGENDA ', icon : 'home'},
	"#search.login" : {title:'COMMUNECTED AGENDA ', icon : 'calendar'},
    "#vitrine" : {title:'COMMUNECTED AGENDA ', icon : 'calendar'}
};
function replaceAndShow(hash,params){
	res = false;
	$.each( urlParams, function(urlIndex,urlObj)
	{
		console.log("replaceAndShow ",urlIndex);
		if( hash.indexOf(urlIndex) >= 0 )
		{
			extraParams = (urlParams[urlIndex].urlExtraParam) ? urlParams[urlIndex].urlExtraParam : "";
			showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params+extraParams, urlParams[urlIndex].title,urlParams[urlIndex].icon );
			res = true;
			return false;
		}
	});
	return res;
}
function loadByHash( hash , back) { 
    console.log("loadByHash",hash);

    params = ( hash.indexOf("?") < 0 ) ? '?tpl=directory2&isNotSV=1' : "";

    //
    if( replaceAndShow(hash,params) )
    	console.warn("loadByHash replaceAndShow",hash);
   
    else if( hash.indexOf("#panel") >= 0 ){
        if(hash.substr(7) == "box-add")
            title = 'ADD SOMETHING TO MY NETWORK';
        else
            title = "WELCOM MUNECT HEY !!!";
        showPanel(hash.substr(7),null,title);
    }
        
    else if( hash.indexOf("#organization.addorganizationform") >= 0 )
        showAjaxPanel( '/organization/addorganizationform?isNotSV=1', 'ADD AN ORGANIZATION','users' );
    else if( hash.indexOf("#person.invitesv") >= 0 )
        showAjaxPanel( '/person/invitesv?isNotSV=1', 'INVITE SOMEONE','share-alt' );
    else if( hash.indexOf("#person.invitecontact") >= 0 )
        showAjaxPanel( '/person/invitecontact?isNotSV=1', 'INVITE SOMEONE','share-alt' );
    else if( hash.indexOf("#event.eventsv") >= 0 )
        showAjaxPanel( '/event/eventsv?isNotSV=1', 'ADD AN EVENT','calendar' );
    else if( hash.indexOf("#project.projectsv") >= 0 )    
        showAjaxPanel( '/project/projectsv/id/'+userId+'/type/citoyen?isNotSV=1', 'ADD A PROJECT','lightbulb-o' );
    else if( hash.indexOf("#project.addcontributorsv") >= 0 )    
        showAjaxPanel( '/project/projectsv/id/'+userId+'/type/citoyen?isNotSV=1', 'ADD A PROJECT','lightbulb-o' );

    else if( hash.indexOf("#rooms.index.type") >= 0 ){
        hashT = hash.split(".");
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'ACTIONS in this '+typesLabels[hashT[3]],'rss' );
    } else if ( hash.indexOf("#survey.entry.id") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'VOTE LOCAL ','legal' );
    }  else if ( hash.indexOf("#rooms") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'ACTION ROOMS ','cubes' );
    }   

    else if ( hash.indexOf("#admin.importdata") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'IMPORT DATA ','upload' );
    }  
    else if ( hash.indexOf("#admin.index") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'INDEX ','download' );
    } 
    else if ( hash.indexOf("#admin.directory") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'DIRECTORY ','user' );
    }
    else if ( hash.indexOf("#admin.openagenda") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'OPENAGENDA','calendar' );
    }


    else if( hash.indexOf("#news.index.type") >= 0 ){
        hashT = hash.split(".");
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'KESS KISS PASS in this '+typesLabels[hashT[3]],'rss' );
    } else if(userId != "")
        showAjaxPanel( '/news?isSearchDesign=1', 'KESS KISS PASS ','rss' );
    else
        showPanel('box-communecter',null,"WELCOM MUNECT HEY !!!",null);

    location.hash = hash;
    if( !back )
      history.pushState( { "hash" :hash} , null, hash );
    console.warn("pushState",hash);

}

function showDefinition( id ){
	$(".hover-menu").trigger("mouseenter");
	$(".infoVersion").css("display" , "inline");
	toggle( "."+id , ".explain" );
}


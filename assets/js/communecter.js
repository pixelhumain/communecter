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


function declareMeAsAdmin(parentId, parentType, personId, parentName, callback, actionFromAdmin=null) 
{
	if(actionFromAdmin){
		
	}else{
	$(".becomeAdminBtn").removeClass("fa-user-plus").addClass("fa-spinner fa-spin");	
		//boxContent =  	
	}
	bootbox.confirm("You are going to ask to become an admin of the "+parentType+" <span class='text-red'>"+parentName+"</span>. Please confirm ?",
		function(result) {
			$.ajax({
				type: "POST",
				url: baseUrl+"/"+moduleId+'/link/declaremeadmin',
				dataType : "json",
				data : {
					parentId : parentId, 
					parentType : parentType,
					userId : personId,
					adminAction : false
				}
			})
			.done(function (data) {
				//$.unblockUI();
				if (data &&  data.result) {
					toastr.success(data.msg);
					addFloopEntity(parentId, "organizations", data.parent);
					loadByHash(location.hash);
					//if (typeof callback == "function") callback(organizationId, personId, organizationName);
				} else {
					$(".becomeAdminBtn").removeClass("fa-spinner fa-spin").addClass("fa-user-plus");
					toastr.error('Something Went Wrong ! ' + data.msg);
				}
				
			});
		}
	)
}



function loadByHash( hash , back) { 
    console.log("loadByHash",hash);

    params = ( hash.indexOf("?") < 0 ) ? '?tpl=directory2&isNotSV=1' : "";
    if( hash.indexOf("#person.directory") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'PERSON DIRECTORY ','share-alt' );
    else if( hash.indexOf("#organization.directory") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'ORGANIZATION MEMBERS ','users' );
    else if( hash.indexOf("#project.directory") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'PROJECT CONTRIBUTORS ','users' );
    else if( hash.indexOf("#panel") >= 0 ){
        if(hash.substr(7) == "box-add")
            title = 'ADD SOMETHING TO MY NETWORK';
        else
            title = "WELCOM MUNECT HEY !!!";
        showPanel(hash.substr(7),null,title);
    }
    
    else if( hash.indexOf("#person.detail") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'PERSON DETAIL ','user' );
    else if( hash.indexOf("#event.detail") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'EVENT DETAIL ','calendar' );
    else if( hash.indexOf("#project.detail") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'PROJECT DETAIL ','lightbulb-o' );
    else if( hash.indexOf("#organization.detail") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'ORGANIZATION DETAIL ','users' );
    else if( hash.indexOf("#city.detail") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'CITY ','university' );
    
    else if( hash.indexOf("#organization.addorganizationform") >= 0 )
        showAjaxPanel( '/organization/addorganizationform?isNotSV=1', 'ADD AN ORGANIZATION','users' );
    else if( hash.indexOf("#person.invitesv") >= 0 )
        showAjaxPanel( '/person/invitesv?isNotSV=1', 'INVITE SOMEONE','share-alt' );
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
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'IMPORT DATA ','download' );
    }   

    else if( hash.indexOf("#news.index.type") >= 0 ){
        hashT = hash.split(".");
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'KESS KISS PASS in this '+typesLabels[hashT[3]],'rss' );
    } else if(userId != "")
        showAjaxPanel( '/news?isNotSV=1', 'KESS KISS PASS ','rss' );
    else
        showPanel('box-communecter',null,"WELCOM MUNECT HEY !!!",null);

    location.hash = hash;
    if( !back )
      history.pushState( { "hash" :hash} , null, hash );
    console.warn("pushState",hash);

}


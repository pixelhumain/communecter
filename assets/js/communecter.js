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

function declareMeAsAdmin(parentId, parentType, personId, parentName, callback) {
	$(".becomeAdminBtn").removeClass("fa-user-plus").addClass("fa-spinner fa-spin");	
	bootbox.confirm(trad["askadmin"+parentType]+" <span class='text-red'>"+parentName+"</span>. "+trad.confirm+" ?", 
		function(result) {
			if(result){
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
						toastr.error('Something Went Wrong ! ' + data.msg);
					}
					
				});
			}
			else{
				$(".becomeAdminBtn").removeClass("fa-spinner fa-spin").addClass("fa-user-plus");
			}
		}
	)
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
	if(connectType!="admin"){
		bootbox.dialog({
                title: "Are you sure to join the "+parentType+" as "+connectType+" ?",
                message: '<div class="row">  ' +
                    '<div class="col-md-12"> ' +
                    '<form class="form-horizontal"> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="name">Ajouter un rôle</label> ' +
                    '<div class="col-md-4"> ' +
                    '<input id="role" name="role" type="text" placeholder="Your Role" class="form-control input-md"> ' +
                    '</div>'+
                    '</div> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-4 control-label" for="awesomeness">Are you admin?</label> ' +
                    '<div class="col-md-4"> <div class="radio"> <label for="awesomeness-0"> ' +
                    '<input type="radio" name="awesomeness" id="awesomeness-0" value="admin"> ' +
                    'Yes </label> ' +
                    '</div><div class="radio"> <label for="awesomeness-1"> ' +
                    '<input type="radio" name="awesomeness" id="awesomeness-1" value="'+connectType+'" checked="checked"> No </label> ' +
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
								url: baseUrl+"/"+moduleId+"/link/connectmeas",
								data: formData,
								dataType: "json",
								success: function(data) {
									if(data.result){
										//console.log("saveMembre");
										addFloopEntity(data.parent["_id"]["$id"], data.parentType, data.parent);
										//$("#linkBtns").html('<a href="javascript:;" class="removeMemberBtn tooltips " data-name="'+data.parent.name+'"'+ 
										//					'data-memberof-id="'+contextData["_id"]["$id"]+'" data-member-type="<?php echo Person::COLLECTION ?>" data-member-id="<?php echo Yii::app()->session["userId"] ?>" data-placement="left" '+
										//					'data-original-title="<?php echo Yii::t('organization','Remove from my Organizations') ?>" >'+
										//					'<i class=" disconnectBtnIcon fa fa-unlink"></i><?php echo Yii::t('organization','NOT A MEMBER') ?></a>');
										//bindFicheInfoBtn();
										//if (data.notification && data.notification=="toBeValidated")
										toastr.success(data.msg);	
										//else
										//	toastr.success("<?php echo Yii::t('organization','You are now a member of the organization : ') ?>"+contextData.name);
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
		bootbox.confirm("Are you sure to join the "+parentType+" as "+connectType+" ?", 
		function(result) {
			if (!result) {
				$(".connectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
				return;
			}
			console.log(formData);
			$.ajax({
				type: "POST",
				url: baseUrl+"/"+moduleId+"/link/connectmeas",
				data: formData,
				dataType: "json",
				success: function(data) {
					if(data.result){
						//console.log("saveMembre");
						addFloopEntity(data.parent["_id"]["$id"], data.parentType, data.parent);
						//$("#linkBtns").html('<a href="javascript:;" class="removeMemberBtn tooltips " data-name="'+data.parent.name+'"'+ 
						//					'data-memberof-id="'+contextData["_id"]["$id"]+'" data-member-type="<?php echo Person::COLLECTION ?>" data-member-id="<?php echo Yii::app()->session["userId"] ?>" data-placement="left" '+
						//					'data-original-title="<?php echo Yii::t('organization','Remove from my Organizations') ?>" >'+
						//					'<i class=" disconnectBtnIcon fa fa-unlink"></i><?php echo Yii::t('organization','NOT A MEMBER') ?></a>');
						//bindFicheInfoBtn();
						//if (data.notification && data.notification=="toBeValidated")
							toastr.success(data.msg);	
						//else
						//	toastr.success("<?php echo Yii::t('organization','You are now a member of the organization : ') ?>"+contextData.name);
							loadByHash(location.hash);
					}
					else
						toastr.error(data.msg);
				},
			});  
		});             
	}
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
	else if( hash.indexOf("#city.directory") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'CITY DIRECTORY ','bookmark fa-rotate-270' );
    else if( hash.indexOf("#panel") >= 0 ){
        if(hash.substr(7) == "box-add")
            title = 'ADD SOMETHING TO MY NETWORK';
        else
            title = "WELCOM MUNECT HEY !!!";
        showPanel(hash.substr(7),null,title);
    }
    else if( hash.indexOf("#city.opendata") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'STATISTICS ','line-chart' );
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
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'IMPORT DATA ','download' );
    }  
    else if ( hash.indexOf("#admin.index") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'IMPORT DATA ','download' );
    } 
    else if ( hash.indexOf("#admin.directory") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'IMPORT DATA ','download' );
    }

    else if ( hash.indexOf("#search.directory") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?isNotSV=1', 'COMMUNECTED DIRECTORY', 'connectdevelop' );
    }   
    else if ( hash.indexOf("#search.news") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'COMMUNECTED NEWS ','rss' );
    }   
    else if ( hash.indexOf("#search.agenda") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'COMMUNECTED AGENDA ','calendar' );
    }   
	else if ( hash.indexOf("#search.home") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'COMMUNECTED AGENDA ','home' );
    }   
	else if ( hash.indexOf("#search.login") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'COMMUNECTED AGENDA ','calendar' );
    }   
    else if ( hash.indexOf("#vitrine") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'COMMUNECTED AGENDA ','calendar' );
    }   

    else if( hash.indexOf("#news.index.type") >= 0 ){
        hashT = hash.split(".");
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'KESS KISS PASS in this '+typesLabels[hashT[3]],'rss' );
    } else if(userId != "")
        showAjaxPanel( '/news?isNotSV=1', 'KESS KISS PASS ','rss' );
    else
        showPanel('box-communecter',null,"WELCOM MUNECT HEY !!!",null);

    location.hash = hash;
    /*if( !back )
      history.pushState( { "hash" :hash} , null, hash );*/
    console.warn("pushState",hash);

}


dynForm = {
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
};
dynForm = {
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
};
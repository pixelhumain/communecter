dynForm = {
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
};
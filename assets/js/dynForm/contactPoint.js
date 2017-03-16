dynForm = {
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
};
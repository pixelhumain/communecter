dynForm = {
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
	        image : typeObjLib.image(),
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
};
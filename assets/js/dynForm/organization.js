dynForm = {
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
	        image : typeObjLib.image( "#organization.detail.id."+uploadObj.id ),
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
};
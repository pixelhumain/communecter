dynForm = {
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
		            image : typeObjLib.image("#project.detail.id."+uploadObj.id),
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
		};
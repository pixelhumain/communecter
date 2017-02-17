dynForm = {
    jsonSchema : {
	    title : trad.addEvent,
	    icon : "calendar",
	    type : "object",
	    onLoads : {
	    	//pour creer un subevnt depuis un event existant
	    	"subEvent" : function(){
	    		//alert(contextData.type);
	    		if(contextData.type == "events"){
	    			$("#ajaxFormModal #parentId").removeClass('hidden');
	    		
    				if( $('#ajaxFormModal #parentId > optgroup > option[value="'+contextData.id+'"]').length == 0 )
	    				$('#ajaxFormModal #parentId > optgroup[label="events"]').prepend('<option value="'+contextData.id+'" selected>Fait parti de : '+contextData.name+'</option>');
	    			else if ( contextData && contextData.id ){
		    			$("#ajaxFormModal #parentId").val( contextData.id );
	    			}
	    			
	    			if( contextData && contextData.type )
	    				$("#ajaxFormModal #parentType").val( contextData.type ); 

	    			if(contextData.startDate && contextData.endDate ){
	    				$("#ajaxFormModal").after("<input type='hidden' id='startDateParent' value='"+contextData.startDate+"'/>"+
	    										  "<input type='hidden' id='endDateParent' value='"+contextData.endDate+"'/>");
	    				$("#ajaxFormModal #startDate").after("<span id='parentstartDate'><i class='fa fa-warning'></i> date début du parent : "+moment( contextData.startDate).format('DD/MM/YYYY HH:mm')+"</span>");
	    				$("#ajaxFormModal #endDate").after("<span id='parentendDate'><i class='fa fa-warning'></i> date de fin du parent : "+moment( contextData.endDate).format('DD/MM/YYYY HH:mm')+"</span>");
	    			}
	    			//alert($("#ajaxFormModal #parentId").val() +" | "+$("#ajaxFormModal #parentType").val());
	    		}
	    		else {
		    		if( $('#ajaxFormModal #organizerId > optgroup > option[value="'+contextData.id+'"]').length == 0 )
	    				$('#ajaxFormModal #organizerId').prepend('<option data-type="'+typeObj[contextData.type].ctrl+'" value="'+contextData.id+'" selected>Organisé par : '+contextData.name+'</option>');
	    			else if( contextData && contextData.id )
		    			$("#ajaxFormModal #organizerId").val( contextData.id );
	    			if( contextData && contextData.type )
	    				$("#ajaxFormModal #organizerType").val( contextData.type);
	    			//alert($("#ajaxFormModal #organizerId").val() +" | "+$("#ajaxFormModal #organizerType").val());
	    		}
	    	}
	    },
	    beforeBuild : function(){
	    	elementLib.setMongoId('events');
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
	    	//alert("onBeforeSave");
	    	
	    	if( !$("#ajaxFormModal #allDay").val())
	    		$("#ajaxFormModal #allDay").val(false);
	    	if( typeof $("#ajaxFormModal #description").code === 'function' )
	    		$("#ajaxFormModal #description").val( $("#ajaxFormModal #description").code() );
	    	//mylog.log($("#ajaxFormModal #startDate").val(),moment( $("#ajaxFormModal #startDate").val()).format('YYYY/MM/DD HH:mm'));
	    	
	    	//Transform datetime before sending
	    	var allDay = $("#ajaxFormModal #allDay").is(':checked');
	    	var dateformat = "DD/MM/YYYY";
	    	if (! allDay) 
	    		var dateformat = "DD/MM/YYYY HH:mm"
	    	$("#ajaxFormModal #startDate").val( moment( $("#ajaxFormModal #startDate").val(), dateformat).format());
			$("#ajaxFormModal #endDate").val( moment( $("#ajaxFormModal #endDate").val(), dateformat).format());
			//mylog.log($("#ajaxFormModal #startDate").val());
	    },
	    properties : {
	    	info : {
                inputType : "custom",
                html:"<p><i class='fa fa-info-circle'></i> Si vous voulez créer un nouvel évènement de façon à le rendre plus visible : c'est le bon endroit !!<br>Vous pouvez inviter des participants, planifier des sous évènements, publier des actus lors de l'évènement...</p>",
            },
            name : typeObjLib.nameEvent,
	        similarLink : typeObjLib.similarLink,
	        organizerId :{
	        	rules : { required : true },
            	inputType : "select",
            	placeholder : "Qui organise ?",
            	rules : { required : true },
            	options : firstOptions(),
            	"groupOptions" : myAdminList( ["organizations","projects"] ),
	            init : function(){
	            	$("#ajaxFormModal #organizerId").off().on("change",function(){
	            		
	            		organizerId = $(this).val();
	            		if(organizerId == "dontKnow" )
	            			organizerType = "dontKnow";
	            		else if( $('#organizerId').find(':selected').data('type') && typeObj[$('#organizerId').find(':selected').data('type')] )
	            			organizerType = typeObj[$('#organizerId').find(':selected').data('type')].col;
	            		else
	            			organizerType = typeObj["person"].col;

	            		mylog.warn( "organizer",organizerId,organizerType );
	            		$("#ajaxFormModal #organizerType ").val( organizerType );
	            	});
	            }
            },
	        organizerType : typeObjLib.hidden,
	        parentId :{
            	inputType : "select",
            	"class" : "hidden",
            	placeholder : "Fait parti d'un évènement ?",
            	options : {
            		"":"Pas de Parent"
            	},
            	"groupOptions" : myAdminList( ["events"] ),
            	init : function(){
	            	$("#ajaxFormModal #parentId ").off().on("change",function(){

	            		parentId = $(this).val();
	            		startDateParent = "2000/01/01 00:00";
	            		endDateParent = "2100/01/01 00:00";
	            		if( parentId != "" ){
	            			//Search in the current context
	            			if (typeof contextData != "undefined") {
	            				if (contextData.type == "events" && contextData.id == parentId) {
	            					mylog.warn("event found in contextData : ",contextData.startDate+"|"+contextData.endDate);
		            				startDateParent = contextData.startDate;
		            				endDateParent = contextData.endDate
	            				}
	            			}
	            			//Search in my contacts list
	            			if(typeof myContacts != "undefined") {
		            			$.each(myContacts.events,function (i,evObj) { 
		            				if( evObj["_id"]["$id"] == parentId){
		            					mylog.warn("event found in my contact list: ",evObj.startDate+"|"+evObj.endDate);
		            					startDateParent = evObj.startDate;
		            					endDateParent = evObj.endDate
			    					}
		            			});
		            		}
		            		$("#startDateParent").val(startDateParent);
		            		$("#endDateParent").val(endDateParent);
		            		$("#parentstartDate").html("<i class='fa fa-warning'></i> Date de début de l'événement parent : "+moment( startDateParent ).format('DD/MM/YYYY HH:mm'));
			    			$("#parentendDate").html("<i class='fa fa-warning'></i> Date de fin de l'événement parent : "+moment( endDateParent ).format('DD/MM/YYYY HH:mm'));
	            		}
	            	});
	            }
            },
            parentType : typeObjLib.hidden,
	        type : typeObjLib.typeEvent,
	        image : typeObjLib.image( "#event.detail.id."+uploadObj.id ),
            allDay : typeObjLib.allDay,
            startDateInput : typeObjLib.startDateInput,
            endDateInput : typeObjLib.endDateInput,
            location : typeObjLib.location,
            tags : typeObjLib.tags,
            
            /*public : {
            	inputType : "hidden",
            	"switch" : {
            		"onText" : "Privé",
            		"offText" : "Public",
            		"labelText":"Type"
            	}
            },*/
            formshowers : {
                inputType : "custom",
                html:"<a class='btn btn-default  text-dark w100p' href='javascript:;' onclick='$(\".descriptionwysiwyg,.urltext\").slideToggle();activateSummernote(\"#ajaxFormModal #description\");'><i class='fa fa-plus'></i> options (desc, urls)</a>",
            },
	        description : typeObjLib.descriptionOptionnel,
            url : typeObjLib.urlOptionnel,
            "preferences[publicFields]" : typeObjLib.hiddenArray,
            "preferences[privateFields]" : typeObjLib.hiddenArray,
            "preferences[isOpenData]" :  typeObjLib.hiddenTrue,
            "preferences[isOpenEdition]" :  typeObjLib.hiddenTrue,
            "startDate" :  typeObjLib.hidden,
            "endDate" :  typeObjLib.hidden
	    }
	}
};
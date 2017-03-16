dynForm = {
	jsonSchema : {
		title : "Modifier une ville",
		icon : "university",
		/*onLoads : {
    	//pour creer un subevnt depuis un event existant
	    	"sub" : function(){
	    		$("#ajaxFormModal #room").val( contextData.id );
    		 	$("#ajax-modal-modal-title").html($("#ajax-modal-modal-title").html()+" sur "+contextData.name );
	    	}
	    },*/
		properties : {
			info : {
				"inputType" : "custom",
				"html":"<p><i class='fa fa-info-circle'></i> Modifier une ville</p>",
			},
			id :typeObjLib.hidden,
			insee :{
				"inputType" : "hidden",
				"rules" : { "required" : true }
			},
			name : typeObjLib.name,
			country :{
				"inputType" : "hidden",
				"rules" : { "required" : true }
			},
			dep :{
				"inputType" : "text",
				"placeholder" : "Numéro du département"
			},
			depName :{
				"inputType" : "text",
				"placeholder" : "Nom du département"
			},
			region :{
				"inputType" : "text",
				"placeholder" : "Numéro de la région"
			},
			regionName :{
				"inputType" : "text",
				"placeholder" : "Nom de la région"
			},
			"latitude" : {
				"inputType" : "text",
				"placeholder" : "Nom de la région"
			},
			"longitude" : {
				"inputType" : "text",
				"placeholder" : "Nom de la région"
			},
			postalcode : {
				inputType : "postalcode"
			},
			osmid :{
				"inputType" : "text",
				"placeholder" : "OSM id"
			},
			wikidata :{
				"inputType" : "text",
				"placeholder" : "wikidata"
			}
		}
	}
}
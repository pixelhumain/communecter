function bindAboutPodElement() {
		$("#editGeoPosition").click(function(){
			Sig.startModifyGeoposition(contextData.id, contextType, contextData);
			showMap(true);
		});
		
		$("#editElementDetail").on("click", function(){
				switchModeElement();
		});		

		$("#changePasswordBtn").click(function () {
			mylog.log("changePasswordbuttton");
			loadByHash('#person.changepassword.id.'+userId+'.mode.initSV', false);
		});

		$("#downloadProfil").click(function () {
			$.ajax({
				url: baseUrl + "/communecter/data/get/type/citoyens/id/"+contextData.id ,
				type: 'POST',
				dataType: 'json',
				async:false,
				crossDomain:true,
				complete: function () {},
				success: function (obj){
					mylog.log("obj", obj);
					$("<a/>", {
					    "download": "profil.json",
					    "href" : "data:application/json," + encodeURIComponent(JSON.stringify(obj))
					  }).appendTo("body")
					  .click(function() {
					    $(this).remove()
					  })[0].click() ;
				},
				error: function (error) {
					
				}
			});
		});

	    $(".confidentialitySettings").click(function(){
	    	param = new Object;
	    	param.type = $(this).attr("type");
	    	param.value = $(this).attr("value");
	    	param.typeEntity = contextType;
	    	param.idEntity = contextData.id;
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+"/element/updatesettings",
		        data: param,
		       	dataType: "json",
		    	success: function(data){
			    	toastr.success(data.msg);
			    }
			});
		});

		$("#editConfidentialityBtn").on("click", function(){
	    	mylog.log("confidentiality", seePreferences);
	    	$("#modal-confidentiality").modal("show");
	    	if(seePreferences=="true"){
	    		param = new Object;
		    	param.name = "seePreferences";
		    	param.value = false;
		    	param.pk = contextData.id;
				$.ajax({
			        type: "POST",
			        url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
			        data: param,
			       	dataType: "json",
			    	success: function(data){
				    	//toastr.success(data.msg);
				    	if(data.result){
							$("#divSeePreferencesHeader").addClass("hidden");
							$('#editConfidentialityBtn').removeClass("btn-red");
				    	}
				    }
				});
	    	}
	    	
	    });

		$(".panel-btn-confidentiality .btn").click(function(){
			var type = $(this).attr("type");
			var value = $(this).attr("value");
			$(".btn-group-"+type + " .btn").removeClass("active");
			$(this).addClass("active");
		});


	}

	function switchModeElement() {
		mylog.log("-------------"+mode);
		if(mode == "view"){
			mode = "update";
			$(".editProfilLbl").html(" Enregistrer les changements");
			$("#editElementDetail").addClass("btn-red");
			if(!emptyAddress)
				$(".cobtn,.whycobtn,.cobtnHeader,.whycobtnHeader").addClass("hidden");
		}else{
			mode ="view";
			$(".editProfilLbl").html(" Éditer");
			$("#editElementDetail").removeClass("btn-red");
			if(emptyAddress)
				$(".cobtn,.whycobtn,.cobtnHeader,.whycobtnHeader").removeClass("hidden");

		}
		manageModeContextElement();
		changeHiddenIconeElement(false);
		manageDivEditElement();
	}

	function manageModeContextElement() {
		mylog.log("-----------------manageModeContextElement----------------------", mode);
		listXeditablesContext = [	'#birthDate', '#description', '#shortDescription', '#fax', '#fixe', '#mobile', 
							'#tags', '#facebookAccount', '#twitterAccount',
							'#gpplusAccount', '#gitHubAccount', '#skypeAccount', '#telegramAccount', 
							'#avancement', '#allDay', '#startDate', '#endDate', '#type'];
		if (mode == "view") {
			$('.editable-context').editable('toggleDisabled');
			$.each(listXeditablesContext, function(i,value) {
				$(value).editable('toggleDisabled');
			});
			$("#btn-update-geopos").addClass("hidden");
			$("#btn-remove-geopos").addClass("hidden");
			$("#btn-add-geopos").addClass("hidden");
			$("#btn-update-organizer").addClass("hidden");
			$("#btn-add-organizer").addClass("hidden");
			if(!emptyAddress)
				$("#btn-view-map").removeClass("hidden");
		} else if (mode == "update") {
			// Add a pk to make the update process available on X-Editable
			$('.editable-context').editable('option', 'pk', contextData.id);
			$('.editable-context').editable('toggleDisabled');
			$.each(listXeditablesContext, function(i,value) {
				//add primary key to the x-editable field
				$(value).editable('option', 'pk', contextData.id);
				$(value).editable('toggleDisabled');
			})
			$("#btn-update-geopos").removeClass("hidden");
			$("#btn-remove-geopos").removeClass("hidden");
			$("#btn-add-geopos").removeClass("hidden");
			$("#btn-view-map").addClass("hidden");
			$("#btn-update-organizer").removeClass("hidden");
			$("#btn-add-organizer").removeClass("hidden");
		}
	}

	function manageDivEditElement() {
		mylog.log("-----------------manageDivEditElement----------------------", mode);
		listXeditablesDiv = [ '#divName', '#divShortDescription' , '#divTags', "#divAvancement"];
		if(contextType != "citoyens")
			listXeditablesDiv.push('#divInformation');
		
		if (mode == "view") {
			$.each(listXeditablesDiv, function(i,value) {
				$(value).hide();
			});
		} else if (mode == "update") {
			$.each(listXeditablesDiv, function(i,value) {
				$(value).show();
			})
		}
	}

	function manageSocialNetwork(iconObject, value) {
		//mylog.log("-----------------manageSocialNetwork----------------------");
		tabId2Icon = {"facebookAccount" : "fa-facebook", "twitterAccount" : "fa-twitter", 
				"gpplusAccount" : "fa-google-plus", "gitHubAccount" : "fa-github", 
				"skypeAccount" : "fa-skype", "telegramAccount" : "fa-send"}

		var fa = tabId2Icon[iconObject.attr("id")];
		iconObject.empty();
		if (value != "") {
			
			//else{
			if(iconObject.attr("id") != "telegramAccount"){
				iconObject.tooltip({title: value, placement: "bottom"});
				iconObject.html('<i class="fa '+fa+' fa-blue"></i>');
			}
		} 

		if(iconObject.attr("id") == "telegramAccount"){
			iconObject.tooltip({title: value, placement: "left"});
			/*var chaineTelegram = "";
			if(speudoTelegram.length > 0)
				chaineTelegram = " : "+speudoTelegram;*/
			if(speudoTelegram != "")
				iconObject.html('<i class="fa '+fa+' text-white"></i> '+speudoTelegram);
			else
				iconObject.html('<i class="fa '+fa+' text-white"></i> Telegram');


		}

		mylog.log(iconObject);
	}

	function changeHiddenIconeElement(init) { 
		mylog.log("-----------------changeHiddenIconeElement----------------------", mode);
		//
		listIcones = [	'.fa_name', ".fa_birthDate", ".fa_email", ".fa_telephone_mobile",
						".fa_telephone",".fa_telephone_fax",".fa_url" , ".fa-file-text-o",
						".fa_streetAddress", ".fa_postalCode", ".fa_addressCountry",".addresses"];

		listXeditablesId = ['#username','#birthDate',"#email", "#mobile", 
							"#fixe", "#fax","#url", "#licence",
							"#detailStreetAddress" , "#detailCity" , "#detailCountry"];
		if (init == true) {
			$.each(listIcones, function(i,value) {
				mylog.log(listXeditablesId[i], $(listXeditablesId[i]).text().length, $(listXeditablesId[i]).text()) ;
				if($(listXeditablesId[i]).text().length != 0){
					//mylog.log(listXeditables[i], " : ", value);
					$(value).removeClass("hidden");	
				}
					 
			});
		}
		else if (mode == "view") {
			$.each(listIcones, function(i,value) {

				if($(listXeditablesId[i]).text().length == 0)
					$(value).addClass("hidden");
			});
		} else if (mode == "update") {
			$.each(listIcones, function(i,value) {
				$(value).removeClass("hidden"); 
			});
		}
	}

	function activateEditableContext() {
		$.fn.editable.defaults.mode = 'popup';
		$.fn.editable.defaults.container='body';
		$('.editable-context').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
			title : $(this).data("title"),
			onblur: 'submit',
			/*success: function(response, newValue) {
				mylog.log(response, newValue);
				if(! response.result) return response.msg; //msg will be shown in editable form
    		},*/
    		success : function(data) {
    			mylog.log("hello", data);
				if(data.result) {
					toastr.success(data.msg);
					loadActivity=true;

					if(typeof data.name != "undefined" && $('#nameHeader').length ){
						$('#nameHeader').html(data.name);
					}	
				}
				else 
					return data.msg;
			}

		});

		$('.socialIcon').editable({
			display: function(value) {
				manageSocialNetwork($(this), value);
			},
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
			mode: 'popup',
			success : function(data) {
				mylog.log("herehehre", data);
				//mylog.log(data.telegramAccount, typeof data.telegramAccount);
				if(typeof data.telegramAccount != "undefined" && data.telegramAccount.length > 0){
					speudoTelegram = data.telegramAccount.trim();
					$('#telegramAccount').attr('href', 'https://web.telegram.org/#/im?p=@'+speudoTelegram);
					$('#telegramAccount').html('<i class="fa telegramAccount text-white"></i>'+speudoTelegram);
					
				}
				if(typeof data.facebookAccount != "undefined" && data.facebookAccount.length > 0){
					pseudoFacebook = data.facebookAccount.trim();
					$('#facebookAccount').attr('href', pseudoFacebook);
				}
				if(typeof data.twitterAccount != "undefined" && data.twitterAccount.length > 0){
					pseudoTwitter = data.TwitterAccount.trim();
					$('#twitterAccount').attr('href', pseudoTwitter);
				}
				if(typeof data.gitHubAccount != "undefined" && data.gitHubAccount.length > 0){
					pseudoGithub = data.gitHubAccount.trim();
					$('#gitHubAccount').attr('href', pseudoGithub);
				}
				if(typeof data.skypeAccount != "undefined" && data.skypeAccount.length > 0){
					pseudoSkype = data.skypeAccount.trim();
					$('#skypeAccount').attr('href', pseudoSkype);
				}
				if(typeof data.gpplusAccount != "undefined" && data.gpplusAccount.length > 0){
					pseudoGpplus = data.gpplusAccount.trim();
					$('#gpplusAccount').attr('href', pseudoGpplus);
				}

			}
		}); 


		//Type Organization
		 $('#type').editable({
		 	url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
		 	value: contextType,
		 	placement: 'bottom',
		 	source: function() {
		 		return types;
		 	},
		 	success : function(data) {
				if(data.result) {
					toastr.success(data.msg);
					loadActivity=true;
					if(typeof data.type != "undefined" && $('#typeHeader').length ){
						$('#typeHeader').html(data.type);
					}
				}
				else 
					return data.msg;
			}
		 });

		$('#birthDate').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
			mode: 'popup',
			placement: "right",
			format: 'yyyy-mm-dd',   
	    	viewformat: 'dd/mm/yyyy',
	    	datepicker: {
	            weekStart: 1,
	        },
	        showbuttons: true
		});

		/*$('#tags').editable({
	        url: baseUrl+"/"+moduleId+"/element/updatefield", //this url will not be used for creating new user, it is only for update
	        mode : 'popup',
	        value: 
	        select2: {
	            tags: 
	            tokenSeparators: [","],
	            width: 200,
	            dropdownCssClass: 'select2-hidden'
	        }
	    });*/

		//Select2 tags
		$('#tags').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
		 	mode: 'popup',
		 	value: returnttags(),
		 	select2: {
		 		tags: tags,
		 		tokenSeparators: [","],
		 		width: 200,
		 		dropdownCssClass: 'select2-hidden'
		 	},
		 	success : function(data) {
		 		mylog.log("TAGS", data);
				if(data.result) {
					toastr.success(data.msg);
					loadActivity=true;
					var str = "";
					if($('#divTagsHeader').length ){
						
						$.each(data.tags, function (key, tag){
							str +=	'<div class="tag label label-danger pull-right" data-val="'+tag+'">'+
										'<i class="fa fa-tag"></i>'+tag+
									'</div>';
							addTagToMultitag(tag);
						});
						
					}
					$('#divTagsHeader').html(str);	
				}
				else 
					return data.msg;
			}
		});


		$('#mobile').editable({
	        url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
	        mode : 'popup',
	        value: mobile,
	    	success : function(data) {
				if(data.result)
					toastr.success(data.msg);
				else 
					toastr.error(data.msg);
			}
	    });

	    $('#fax').editable({
	        url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
	        mode : 'popup',
	        value: fax,
	    	success : function(data) {
				if(data.result)
					toastr.success(data.msg);
				else 
					toastr.error(data.msg);
			}
	    }); 

		$('#fixe').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
			mode: 'popup',
			value: fixe,
			success : function(data) {
				if(data.result)
					toastr.success(data.msg);
				else 
					toastr.error(data.msg);
			}
		});

		

		$('#category').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
			mode: 'popup',
			value: category,
			source: function() {
				var result = new Array();
				var categorySource = null;

				mylog.log("contextData.type",contextData.type);
				if (contextData.type == TYPE_NGO) categorySource = NGOCategoriesList;
				if (contextData.type == TYPE_BUSINESS) categorySource = localBusinessCategoriesList;
				
				if(categorySource != null)
				$.each(categorySource, function(i,value) {
					result.push({"value" : value, "text" : value}) ;
				});
				return result;
			},
			success : function(data) {
				if(data.result) {
					toastr.success(data.msg);
					loadActivity=true;	
				}
				else 
					return data.msg;
			}
		});

		$('#avancement').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,  
			source: function() {
				//idea => concept => Started => development => testing => mature
				avancement=["idea","concept","started","development","testing","mature"];
				return avancement;
			},
			success : function(data) {
				if(data.result) {
					toastr.success(data.msg);
					loadActivity=true;	
					if(data.avancement=="idea")
						val=5;
					else if(data.avancement=="concept")
						val=20;
					else if (data.avancement== "started")
						val=40;
					else if (data.avancement == "development")
						val=60;
					else if(data.avancement == "testing")
						val=80;
					else
						val=100;
					$('#progressStyle').val(val);
					$('#labelProgressStyle').html(data.avancement);
				}
				else 
					return data.msg;
		    }
		});

		$('#shortDescription').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
			placement: 'bottom', //MODIFIED
			wysihtml5: {
				color: false,
				html: false,
				video: false,
				image: false,
				table : false
			},
			container: 'body',
			validate: function(value) {
			    mylog.log(value);
			    if($.trim(value).length > 140) {
			        return 'La description courte ne doit pas dépasser 140 caractères.';
			    }
			},
			success : function(data) {
				if(data.result) {
					toastr.success(data.msg);
					loadActivity=true;

					if(typeof data.shortDescription != "undefined" && $('#shortDescriptionHeader').length ){
						$('#shortDescriptionHeader').html(data.shortDescription);
					}
				}
				else 
					return data.msg;
			}
		});


		$('#description').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,  
			value: description,
			placement: 'top',
			wysihtml5: {
				html: true,
				video: false,
				image: false
			},
			container: 'body',
			success : function(data) {
				if(data.result) {
					toastr.success(data.msg);
					loadActivity=true;	
				}
				else 
					return data.msg;
			}
		});
		
		$('#allDay').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,  
			mode: "popup",
			value: allDay,
			source:[{value: "true", text: "Oui"}, {value: "false", text: "Non"}],
			success : function(data, newValue) {
		        if(data.result) {
		        	manageAllDayElement(newValue);
		        	toastr.success(data.msg);
					loadActivity=true;	
		        }
		        else
		        	return data.msg;  
		    }
		});
	   
		//Validation Rules
		//Mandotory field
		$('.required').editable('option', 'validate', function(v) {
			var intRegex = /^\d+$/;
			if (!v)
				return 'Field is required !';
		});
	
		
	} 
	function manageAllDayElement(isAllDay) {
		mylog.warn("Manage all day event ", isAllDay);

		$('#startDate').editable('destroy');
		$('#endDate').editable('destroy');
		if (isAllDay == "true") {
			mylog.log("init Xedit with dd/mm/yyyy");
			$('#startDate').editable({
				url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,  
				pk: contextData.id,
				type: "date",
				mode: "popup",
				placement: "bottom",
				format: 'yyyy-mm-dd',
				viewformat: 'dd/mm/yyyy',
				datepicker: {
					weekStart: 1
				},
				success : function(data) {
					if(data.result) {
						toastr.success(data.msg);
						loadActivity=true;
						updateCalendar();
					}else 
						return data.msg;
			    }
			});

			$('#endDate').editable({
				url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,  
				pk: contextData.id,
				type: "date",
				mode: "popup",
				placement: "bottom",
				format: 'yyyy-mm-dd',   
	        	viewformat: 'dd/mm/yyyy',
	        	datepicker: {
	                weekStart: 1
	           },
	           success : function(data) {
			        if(data.result) {
			        	toastr.success(data.msg);
						loadActivity=true;
						updateCalendar();	
			        }else 
						return data.msg;
			    }
	        });

			formatDate = "YYYY-MM-DD";
		} else {
			mylog.log("init Xedit with dd/mm/yyyy hh:ii");
			$('#startDate').editable({
				url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
				pk: contextData.id,
				type: "datetime",
				mode: "popup",
				placement: "bottom",
				format: 'yyyy-mm-dd hh:ii',
				viewformat: 'dd/mm/yyyy hh:ii',
				datetimepicker: {
					weekStart: 1,
					minuteStep: 30,
					language: 'fr'
				   },
				success : function(data) {
					if(data.result) {
						toastr.success(data.msg);
						loadActivity=true;
						updateCalendar();
					}else 
						return data.msg;
			    }
			});

			$('#endDate').editable({
				url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
				pk: contextData.id,
				mode: "popup",
				type: "datetime",
				placement: "bottom",
				format: 'yyyy-mm-dd hh:ii',
	        	viewformat: 'dd/mm/yyyy hh:ii',
	        	datetimepicker: {
	                weekStart: 1,
	                minuteStep: 30,
	                language: 'fr'
	           },
	           success : function(data) {
			        if(data.result) {
			        	toastr.success(data.msg);
						loadActivity=true;
						updateCalendar();
						
			        }else 
						return data.msg;
			    }
	        });

			formatDate = "YYYY-MM-DD HH:mm";
		}
		if(startDate != "")
			$('#startDate').editable('setValue', moment(startDate, "YYYY-MM-DD HH:mm").format(formatDate), true);
		if(endDate != "")
			$('#endDate').editable('setValue', moment(endDate, "YYYY-MM-DD HH:mm").format(formatDate), true);
	}

	function updateCalendar() {
		if(contextData.type == EVENT_COLLECTION){
			getAjax(".calendar",baseUrl+"/"+moduleId+"/event/calendarview/id/"+contextData.id +"/pod/1?date=1",null,"html");
		}
	}

	function returnttags() {
		mylog.log("------------- returnttags -------------------");
		//var tags = <?php echo (isset($element["tags"])) ? json_encode(implode(",", $element["tags"])) : "''"; ?>;
		//var tags = <?php echo (isset($element["tags"])) ? json_encode( $element["tags"]) : "''"; ?>;

		return tags2 ;
	}

	function returntel() {
		var tel = "";
		$(".tel").each(function(){
			
			if($(this).text().trim() != "")
	        {
	        	if(tel != "")
	        		tel += ", ";

	        	tel += $(this).text().trim();
	        }	
	        	
	    });

	    mylog.log(tel);
		return tel ;
	}
	//modification de la position geographique	

	function findGeoPosByAddress(){
		//si la streetAdress n'est pas renseignée
		if($("#streetAddress").html() == $("#streetAddress").attr("data-emptytext")){
			//on récupère la valeur du code insee s'il existe
			var insee = ($("#entity-insee-value").attr("insee-val") != "") ? 
						 $("#entity-insee-value").attr("insee-val") : "";
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee);
		//si on a une streetAddress
		}else{
			var request = "";

			//recuperation des données de l'addresse
			var street 			= ($("#streetAddress").html()  != $("#streetAddress").attr("data-emptytext"))  ? $("#streetAddress").html() : "";
			var address 		= ($("#address").html() 	   != $("#address").attr("data-emptytext")) 	   ? $("#address").html() : "";
			var addressCountry 	= ($("#addressCountry").html() != $("#addressCountry").attr("data-emptytext")) ? $("#addressCountry").html() : "";
			
			//construction de la requete
			request = addToRequest(request, street);
			request = addToRequest(request, address);
			request = addToRequest(request, addressCountry);

			request = transformNominatimUrl(request);
			request = "?q=" + request;
			mylog.log(request);
			findGeoposByNominatim(request);
		}
	
	}

	//quand la recherche nominatim a fonctionné
	function callbackNominatimSuccess(obj){
		mylog.log("callbackNominatimSuccess");
		//si nominatim a trouvé un/des resultats
		if (obj.length > 0) {
			//on utilise les coordonnées du premier resultat
			var coords = L.latLng(obj[0].lat, obj[0].lon);
			//et on affiche le marker sur la carte à cette position
			mylog.log("showGeoposFound coords", coords);
			mylog.dir("showGeoposFound obj", obj);

			//si la donné n'est pas geolocalisé
			//on lui rajoute les coordonées trouvés
			//if(typeof contextData["geo"] == "undefined")
			contextData["geo"] = { "latitude" : obj[0].lat, "longitude" : obj[0].lon };

			showGeoposFound(coords, contextData.id, "organizations", contextData);
		}
		//si nominatim n'a pas trouvé de résultat
		else {
			//on récupère la valeur du code insee s'il existe
			var insee = ($("#entity-insee-value").attr("insee-val") != "") ? 
						 $("#entity-insee-value").attr("insee-val") : "";
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee);
		}
	}

	//quand la recherche par code insee a fonctionné
	function callbackFindByInseeSuccess(obj){
		mylog.log("callbackFindByInseeSuccess");
		//si on a bien un résultat
		if (typeof obj != "undefined" && obj != "") {
			//récupère les coordonnées
			var coords = Sig.getCoordinates(obj, "markerSingle");
			//si on a une geoShape on l'affiche
			if(typeof obj.geoShape != "undefined") Sig.showPolygon(obj.geoShape);
			
			contextData["geo"] = { "latitude" : obj.geo.latitude, "longitude" : obj.geo.longitude };
			//on affiche le marker sur la carte
			showGeoposFound(coords, contextData.id, "organizations", contextData);
		}
		else {
			mylog.log("Erreur getlatlngbyinsee vide");
		}
	}


	//en cas d'erreur nominatim
	function callbackNominatimError(error){
		mylog.log("callbackNominatimError", error);
	}

	//quand la recherche par code insee n'a pas fonctionné
	function callbackFindByInseeError(){
		mylog.log("erreur getlatlngbyinsee", error);
	}

	function removeAddresses (index){

		bootbox.confirm({
			message: trad["suredeletelocality"]+"<span class='text-red'></span>",
			buttons: {
				confirm: {
					label: trad["yes"],
					className: 'btn-success'
				},
				cancel: {
					label: trad["no"],
					className: 'btn-danger'
				}
			},
			callback: function (result) {
				if (!result) {
					return;
				} else {
					var addresses = { addressesIndex : index };
					var param = new Object;
					param.name = "addresses";
					param.value = addresses;
					param.pk = contextData.id;
					$.ajax({
				        type: "POST",
				        url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
				        data: param,
				       	dataType: "json",
				    	success: function(data){
					    	if(data.result){
								toastr.success(data.msg);
								loadByHash("#"+contextData.controller+".detail.id."+contextData.id);
					    	}
					    }
					});
				}
			}
		});		
	}

	function updateOrganizer() {
		bootbox.confirm({
			message: 
				trad["udpateorganizer"]+
				buildSelect("organizerId", "organizerId", 
							{"inputType" : "select", "options" : firstOptions(), 
							"groupOptions":myAdminList( ["organizations","projects"] )}, ""),
			buttons: {
				confirm: {
					label: trad["udpateorganizer"],
					className: 'btn-success'
				},
				cancel: {
					label: trad["cancel"],
					className: 'btn-danger'
				}
			},
			
			callback: function (result) {
				if (!result) {
					return;
				} else {
					var organizer = { "organizerId" : organizerId, "organizerType" : organizerType };

					var param = new Object;
					param.name = "organizer";
					param.value = organizer;
					param.pk = contextData.id;
					$.ajax({
				        type: "POST",
				        url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
				        data: param,
				       	dataType: "json",
				    	success: function(data){
					    	if(data.result){
								toastr.success(data.msg);
								loadByHash("#"+contextData.controller+".detail.id."+contextData.id);
					    	} else {
					    		toastr.error(data.msg);
					    	}
					    }
					});
				}
			}
		}).init(function(){
        	console.log("init de la bootbox !");
        	$("#organizerId").off().on("change",function(){
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
        })
	}
	
	function buildSelect(id, field, fieldObj,formValues) {
		var fieldClass = (fieldObj.class) ? fieldObj.class : '';
		var placeholder = (fieldObj.placeholder) ? fieldObj.placeholder+required : '';
		var fieldHTML = "";
		if ( fieldObj.inputType == "select" || fieldObj.inputType == "selectMultiple" ) 
        {
       		var multiple = (fieldObj.inputType == "selectMultiple") ? 'multiple="multiple"' : '';
       		mylog.log("build field "+field+">>>>>> select selectMultiple");
       		var isSelect2 = (fieldObj.isSelect2) ? "select2Input" : "";
       		fieldHTML += '<select class="'+isSelect2+' '+fieldClass+'" '+multiple+' name="'+field+'" id="'+field+'" style="width: 100%;height:30px;" data-placeholder="'+placeholder+'">';
			if(placeholder)
				fieldHTML += '<option class="text-red" style="font-weight:bold" disabled selected>'+placeholder+'</option>';
			else
				fieldHTML += '<option></option>';

			var selected = "";
			
			//initialize values
			if(fieldObj.options)
				fieldHTML += buildSelectOptions(fieldObj.options, fieldObj.value);
			
			if( fieldObj.groupOptions ){
				fieldHTML += buildSelectGroupOptions(fieldObj.groupOptions, fieldObj.value);
			} 
			fieldHTML += '</select>';
        }
        return fieldHTML;
	}
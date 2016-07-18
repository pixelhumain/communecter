<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/datepicker/css/datepicker.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' , CClientScript::POS_END);

//Data helper
$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);

?>
<script src='https://www.google.com/recaptcha/api.js'></script>

<div class="row">
	<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
		<div class="logo">
			<img height="30" src="<?php echo $this->module->assetsUrl?>/images/COMMUNECTION.png"/>
		</div>
		
		<!-- start: JOIN BOX -->
		<div class="box-join panel-white padding-20">
			<img height="80" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logo.png"/>
			<span class="text-extra-large text-bold">Invitation to join the network of <?php echo $parentOrganization['name'] ?></span> 
			<br>
			Your organization has been invited by <?php echo $parentOrganization['name'] ?>
			<br>Please fill out this simple form bellow
			<p>
				Enter your personal details below:
			</p>
			<form id="form-join"></form>
			<!-- end: COPYRIGHT -->
		</div>
		<!-- end: JOIN BOX -->
	</div>
</div>

<script type="text/javascript">

var formDefinition = {
	    "jsonSchema" : {
	        "title" : "Todyn Form",
	        "type" : "object",
	        "properties" : {
	        	"parentOrganization" : {
	                "inputType" : "hidden",
	                "value" : "<?php echo $_GET['id'] ?>",
	            },
	        	"separator1":{
	        		"title":"Organization"
	        	},
	            "organizationName" : {
	                "inputType" : "text",
	                "icon" : "fa fa-group",
	                "placeholder" : "Name of your Organization",
	                "rules" : {
						"required" : true
					}
	            },
	            "description" :{
	            	"inputType" : "textarea",
	            	"placeholder" : "Describe your Organization"
	            },
	            "type" :{
	            	"inputType" : "select",
	            	"placeholder" : "Select the type of your organization",
	            	"rules" : {
						"required" : true
					},
	            	"options" : {
	            		<?php
						foreach ($types as $key=>$value) {
							echo "\"".$key."\" : \"".$value."\",";
						}
						?>
	            	}
	            },
	            "theme" :{
	            	"inputType" : "selectMultiple",
	            	"placeholder" : "Thematique",
	            	"tags" : "true",
	            	"options" : {
	            		<?php
						foreach ($tags as $tag) {
							echo json_encode($tag)." : ".json_encode($tag).",";
						}
						?>
	            	}
	            },
	            "typeIntervention" :{
	            	"inputType" : "selectMultiple",
	            	"placeholder" : "Select the type of intervention",
	            	"rules" : {
						"required" : true
					},
	            	"options" : {
	            		<?php
						foreach ($listTypeIntervention as $typeIntervention) {
							echo json_encode($typeIntervention)." : ".json_encode($typeIntervention).",";
						}
						?>
	            	}
	            },
	            "public" :{
	            	"inputType" : "selectMultiple",
	            	"placeholder" : "Select the public of your activities",
	            	"rules" : {
						"required" : true
					},
	            	"options" : {
	            		<?php
						foreach ($listPublic as $public) {
							echo json_encode($public)." : ".json_encode($public).",";
						}
						?>
	            	}
	            },
	            "postalCode" : {
	                "inputType" : "text",
	                "icon" : "fa fa-map-marker",
	                "placeholder":"Postal Code",
	                "rules" : {
						"required" : true,
						"rangelength" : [5, 5],
						"validPostalCode" : true
					}
	            },
	            "city" : {
	            	"inputType" : "select",
					"rules" : {
						"required" : true,
						"minlength" : 1
					},
					"options" : {"" : ""}
				},
	            "organizationCountry" : {
	                "inputType" : "hidden",
	                "value" : "Reunion",
	            },
	            "organizationEmail" : {
	                "inputType" : "text",
	                "icon" : "fa fa-envelope",
	                "placeholder":"Organization Email",
	                "rules" : {
						"required" : true,
						"email" : true
					}
	            },
	            "separator2":{
	        		"title":"Person"
	        	},
	            "personName" : {
	                "inputType" : "text",
	                "icon" : "fa fa-user",
	                "placeholder":"Your Name",
	                "rules" : {
						"required" : true
					}
	            },
	            "personEmail" : {
	                "inputType" : "text",
	                "icon" : "fa fa-envelope",
	                "placeholder":"Your Email",
	                "rules" : {
						"required" : true,
						"email" : true
					}
	            },
	           	"personPostalCode" : {
	                "inputType" : "text",
	                "icon" : "fa fa-map-marker",
	                "placeholder":"Postal Code",
	                "rules" : {
						"required" : true,
						"rangelength" : [5, 5],
						"validPostalCode" : true
					}
	            },
	            "personCity" : {
	            	"inputType" : "select",
					"rules" : {
						"required" : true,
						"minlength" : 1
					},
					"options" : {"" : ""}
				},
	            "password1" : {
	                "inputType" : "text",
	                "icon" : "fa fa-map-marker",
	                "placeholder":"Password",
	                "rules" : {
						"required" : true,
						"minlength" : 8
					}
	            },
	            "password2" : {
	                "inputType" : "text",
	                "icon" : "fa fa-map-marker",
	                "placeholder":"Password again",
	                "rules" : {
						"required" : true,
						"minlength" : 8,
						"equalTo" : "#password1"
					}
	            },
	            "captcha" : {
	                "inputType" : "recaptcha",
	                "key":"6LdiygUTAAAAAKZxZ0c9-G43Xqp9ZiedhWswto1s"
	            }
	        }
	    },
	};

var organizationInitData = {
	"parentOrganization" : "<?php echo $_GET['id'] ?>",
	/*"organizationName": "Libertalia",
	"description": "Le rugby sur la plage : c'est trop bon",
	"type": "Association",
	"tagsOrganization" : "Rugby",
	"postalCode": "97426",
	"organizationEmail": "toto@toto.fr",
	"personName": "Sylvain Barbot",
	"personEmail": "sylvain@gmail.com",
	"personPostalCode": "97426",*/
	//"password": "password"
};

var dataBindOrganization = {
	"#parentOrganization": "parentOrganization",
	"#organizationName" : "organizationName",
	"#description" : "description",
	"#type" : "type",
	"#typeIntervention" : "typeIntervention",
	"#public" : "public",
	"#theme" : "tagsOrganization",
	"#postalCode" : "postalCode",
	"#city" : "city",
	"#organizationEmail" : "organizationEmail" , 
    "#organizationCountry" : "organizationCountry",
    "#personName" : "personName",
    "#personEmail" : "personEmail",
    "#personPostalCode" : "personPostalCode",
    "#personCity" : "personCity",
    "#password1" : "password",
    "#password2" : "password",
    "#g-recaptcha-response" : "g-recaptcha-response",
};

jQuery(document).ready(function() {
	<?php $contextMap = array("types"=>$types, "parentOrganization"=>$parentOrganization, "tags"=>$tags); ?>

 	var contextMap = <?php echo json_encode($contextMap)?>;
 	console.log(contextMap);
	addCustomValidators();
	$('.box-join').show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
		$(this).removeClass("animated flipInX");
	});
	var form = $.dynForm({
		formId : "#form-join",
		formObj : formDefinition,
		onLoad : function  () {
			/*
			here you can load anythnig into your form fields 
			it is called after creation
			*/
			$.each(dataBindOrganization,function(field,path){
				if(field != ""){
					var val = jsonHelper.getValueByPath( organizationInitData, path );
					if(val){
						$(field).val(val);
						console.log("field key",field);
					}
				}
			});
			
		},
		onSave : function(){

			$.blockUI({
				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
	            '<blockquote>'+
	              "<p>Notre technologie a dépassé notre humanité.</p>"+
	              '<cite title="Einstein">Einstein</cite>'+
	            '</blockquote> '
			});

			console.log("saving Organization!!");
			var params = {};
			$.each(dataBindOrganization,function(field,path){
				console.log("save key ",field,path);
				if(field != "" )
				{
					if( $(field) && $(field).val() && $(field).val() != "" )
					{
						value = $(field).val();
						jsonHelper.setValueByPath( params, path, value );
					} 
				}
				else {
					console.log("save Error",field);
					alert("Erreur là");
				}
				
			});
			console.dir(params);
	    	$.ajax({
	    	  type: "POST",
	    	  url: baseUrl+"/<?php echo $this->module->id?>/organization/addNewOrganizationAsMember",
	    	  data: params,
	    	  dataType: "json"
	    	})
	    	.done(function(data){
	    		if(data.result) {
	    			console.log("Resultat", data);
	    			toastr.info(data.msg);
	    			$.unblockUI();
	    			$("#form-join").html("<a href='"+baseUrl+"/<?php echo $this->module->id?>/organization/dashboardMember/id/<?php echo $_GET['id'] ?>'>Back to <?php echo $parentOrganization['name']?></a>");
	    		} else {
	    			manageAjaxError(data);
	    		}
	    	})
			.fail(function(data) {
				manageAjaxError(data);
			})
		}
	});
	$(".cityselect").hide();
	$(".personCityselect").hide();
	bindPostalCodeAction("#postalCode", "#city", ".cityselect");
	bindPostalCodeAction("#personPostalCode", "#personCity", ".personCityselect");
	console.dir(form);
});

function manageAjaxError(data) {
	$.unblockUI();
	var recaptchaframe = $('.g-recaptcha iframe');
	var recaptchaSoure = recaptchaframe[0].src;
	recaptchaframe[0].src = '';
	setInterval(function () { recaptchaframe[0].src = recaptchaSoure; }, 500);
	$('.errorHandler').html(data.msg);
	$('.errorHandler').show();
	toastr.error('please check for Errors!');
}

function runShowCity(searchValue, idSelect, classDiv) {
	$(idSelect).empty();
	var citiesByPostalCode = getCitiesByPostalCode(searchValue);
	var oneValue = "";
	console.table(citiesByPostalCode);
	$.each(citiesByPostalCode,function(i, value) {
    	$(idSelect).append('<option value=' + value.value + '>' + value.text + '</option>');
    	oneValue = value.value;
	});

	if (citiesByPostalCode.length == 1) {
		$(idSelect).select2('val', oneValue);
	}

	if (citiesByPostalCode.length > 0) {
		$(classDiv).slideDown("medium");
    } else {
		$(classDiv).slideUp("medium");
	}
}

function bindPostalCodeAction(postalCodeId, idSelect, classDiv) {
	searchCity(postalCodeId, idSelect, classDiv);
	$(postalCodeId).keyup(function(e){
		searchCity(postalCodeId, idSelect, classDiv);
	});
	$(postalCodeId).change(function(e){
		searchCity(postalCodeId, idSelect, classDiv);
	});
}

function searchCity(postalCodeId, idSelect, classDiv) {
	var searchValue = $(postalCodeId).val();
	var timeout;
	if(searchValue.length == 5) {
		$(idSelect).empty();
		clearTimeout(timeout);
		timeout = setTimeout($("#iconeChargement").css("visibility", "visible"), 100);
		clearTimeout(timeout);
		timeout = setTimeout('runShowCity("'+searchValue+'","'+idSelect+'","'+classDiv+'")', 100); 
	} else {
		$(classDiv).slideUp("medium");
		$(idSelect).select2('val', "");
		$(idSelect).empty();
	}
}

</script>
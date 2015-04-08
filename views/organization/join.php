<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/datepicker/css/datepicker.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' , CClientScript::POS_END);
?>
<div class="row">
	<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
		<div class="logo">
			<img height="30" src="<?php echo $this->module->assetsUrl?>/images/COMMUNECTION.png"/>
		</div>
		
		<!-- start: JOIN BOX -->
		<div class="box-join panel-white padding-20">
			<img height="80" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logo.png"/>
			<span class="text-extra-large text-bold">Inivtation to join the network of <?php echo $parentOrganization['name'] ?></span> 
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
<style type="text/css">
	label.error{color:red; font-size:10px;}
</style>
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
						foreach ($tags as $tags) {
							echo "\"".$tags."\" : \"".$tags."\",";
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
						"rangelength" : [5, 5]
					}
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
						"rangelength" : [5, 5]
					}
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
	        }
	    },
	};

var organizationInitData = {
/*	"parentOrganization" : "<?php echo $_GET['id'] ?>",
	"organizationName": "Libertalia",
	"description": "Le rugby sur la plage : c'est trop bon",
	"type": "Association",
	"tagsOrganization" : "Rugby",
	"postalCode": "97426",
	"organizationEmail": "toto@toto.fr",
	"personName": "Sylvain Barbot",
	"personEmail": "sylvain@gmail.com",
	"personPostalCode": "97426",
	"password": "password",*/
};

var dataBindOrganization = {
	"#parentOrganization": "parentOrganization",
	"#organizationName" : "organizationName",
	"#description" : "description",
	"#type" : "type",
	"#theme" : "tagsOrganization",
	"#postalCode" : "postalCode",
	"#organizationEmail" : "organizationEmail" , 
    "#organizationCountry" : "organizationCountry",
    "#personName" : "personName",
    "#personEmail" : "personEmail",
    "#personPostalCode" : "personPostalCode",
    "#password1" : "password",
    "#password2" : "password"
};

jQuery(document).ready(function() {
	<?php $contextMap = array("types"=>$types, "parentOrganization"=>$parentOrganization, "tags"=>$tags); ?>

 	var contextMap = <?php echo json_encode($contextMap)?>;
 	console.log(contextMap);

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
			$.unblockUI();
	    	$.ajax({
	    	  type: "POST",
	    	  url: baseUrl+"/<?php echo $this->module->id?>/organization/addNewOrganizationAsMember",
	    	  data: params,
	    	  dataType: "json"
	    	}).done(function(data){
	    		if(data.result) {
	    			console.log("Resultat", data);
	    			toastr.info(data.msg);
	    		} else {
	    			$.unblockUI();
					$('.errorHandler').html(data.msg);
					$('.errorHandler').show();
	    		}
	    	});
		}
	});
	console.dir(form);
});

</script>
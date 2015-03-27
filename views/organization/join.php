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
			<span class="text-extra-large text-bold"><?php echo $organization['name'] ?></span> 
			<br>
			Invited your Organization as member 
			please fill out this simple Form
			<br> invited by <?php echo $organization['email'] ?>
			<h3>Join organization</h3>
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
	        	"separator1":{
	        		"title":"Organization"
	        	},
	        	"parentOrganisation" : {
	                "inputType" : "text",
	                "value" : "<?php echo $_GET['id'] ?>",
	                "icon" : "fa fa-user",
	                "placeholder":"Your Name"
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
	            	"placeholder" : "Describe your Organization",
	            	"options" : {
	            		"NGO":"NGO",
                    	"LocalBusiness":"Local Businesse",
                    	"Groups":"Group"
	            	}
	            },
	            "postalCode" : {
	                "inputType" : "text",
	                "icon" : "fa fa-map-marker",
	                "placeholder":"Postal Code",
	                "rules" : {
						"required" : true
					}
	            },
	            "organizationEmail" : {
	                "inputType" : "text",
	                "icon" : "fa fa-envelope",
	                "placeholder":"Organization Email"
	            },
	            "separator2":{
	        		"title":"Person"
	        	},
	            "personName" : {
	                "inputType" : "text",
	                "icon" : "fa fa-user",
	                "placeholder":"Your Name"
	            },
	            "personEmail" : {
	                "inputType" : "text",
	                "icon" : "fa fa-envelope",
	                "placeholder":"Your Email"
	            },
	            "isOrgaAdmin" : {
	                "inputType" : "checkbox",
	                "placeholder" : "I am the main contact of this organization",
	                "class":"grey"
	            }
	        }
	    },
	    "collection" : "todos",
	    "key" : "todoForm",
	    //"savePath":moduleId+""
	};
var organizationInitData = {
	"organizationEmail" : "toto@gogo.com",
	"organizationName":"PING PONG",
	"address": {
		"postalCode":"97400"
	}
};
var dataBindOrganization = {
	   "parentOrganisation": {"value":"<?php echo $_GET['id'] ?>"},
	   "#organizationEmail" : "organizationEmail" , 
       "#organizationName" : "organizationName",
       "#postalCode" : "address.postalCode",
       "#organizationCountry" : {"value":"Réunion"},
       "#type" : "type",
       "#description" : "description",
       "#personName" : "personName",
       "#personEmail" : "personEmail"
};

jQuery(document).ready(function() {
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
					console.log("field key",field);
					if(field != "")
						$(field).val(jsonHelper.getValueByPath( organizationInitData, path ));
				});
			
		},
		onSave : function(){
			console.log("saving Organization!!");
			var organization = {};
			$.each(dataBindOrganization,function(field,path){
				console.log("save key ",field,path);
				if(field != "" )
				{
					if( $(field) && $(field).val() && $(field).val() != "" )
					{
						value = $(field).val();
						jsonHelper.setValueByPath( organization, path, value );
					} 
				}
				else
					console.log("save Error",field);
			});
			console.dir(organization);
			$.unblockUI();
			return false;
			/*var params = { 
			   "parentOrganisation":"<?php echo $_GET['id'] ?>",
			   "organizationEmail" : $("#organizationEmail").val() , 
               "organizationName" : $("#organizationName").val(),
               "postalCode" : $("#postalCode").val(),
               "organizationCountry" : "Réunion",
               "type" : $("#type").val(),
               "description" : $("#description").val(),
               "personName" : $("#personName").val(),
               "personEmail" : $("#personEmail").val()
            };
		      
	    	$.ajax({
	    	  type: "POST",
	    	  url: baseUrl+"/<?php echo $this->module->id?>/organization/saveNewAddMember",
	    	  data: params,
	    	  dataType: "json"
	    	}).done(function(data){
	    		if(data.result)
	        		window.location.reload();
	    		else 
	    		{
	    			$.unblockUI();
					$('.errorHandler').html(data.msg);
					$('.errorHandler').show();
	    		}
	    	});*/
		}
	});
	console.dir(form);
});

</script>
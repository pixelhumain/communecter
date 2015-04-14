<script type="text/javascript">

var formDefinition = {
    "jsonSchema" : {
        "title" : "About Pod Form",
        "type" : "object",
        "properties" : {
            "title" :{
            	"inputType" : "text",
            	"placeholder" : "Title"
            },
            "description" :{
            	"inputType" : "wysiwyg",
            	"placeholder" : "Describe your Organization"
            },
            "tags" :{
	            	"inputType" : "tags",
	            	"placeholder" : "Tags",
	            	"values" : [
	            		"Sport",
                    	"Agricutlture",
                    	"Culture",
                    	"Urbanisme",
	            	]
	            },
        }
    },
    "collection" : "organization",
    "key" : "ajaxForm",
};

var dataBind = {
   "#description" : "description",
   "#title" : "title",
   "#tags" : "tags"
};

jQuery(document).ready(function() {
	
	$(".new-note").off().on("click",function() { 
		$("#ajaxSV").html("<div class='col-sm-8 col-sm-offset-2'>"+
							"<div class='space20'></div>"+
							"<h1>Edit About Information</h1>"+
							"<form id='ajaxForm'></form>"+
						  "</div>");
		$.subview({
			content : "#ajaxSV",
			onShow : function() 
			{
				console.log("build Form about");
				var form = $.dynForm({
					formId : "#ajaxForm",
					formObj : formDefinition,
					onLoad : function  () {
						/*
						here you can load anythnig into your form fields 
						it is called after creation
						*/
						$.each(dataBind,function(field,fieldObj){
							if(field != ""){
								var val = fieldObj.value;
								if(val) {
									$(field).val(val);
									console.log("field key",field);
								}
							}
						});
						
					},
					onSave : function(){
						console.log("saving Organization!!");
						var params = {};
						$.each(dataBind,function(field,fieldObj){
							console.log("save key ",field,fieldObj.saveTo);
							if(field != "" )
							{
								if( $(field) && $(field).val() && $(field).val() != "" )
								{
									value = $(field).val();
									jsonHelper.setValueByPath( params, fieldObj.saveTo, value );
									
									//update the databind with the new value (in case of second onload)
									jsonHelper.setValueByPath( dataBind, field+".value", value );

									$(fieldObj.updateElement).html($(field).val());
								} 
							}
							else
								console.log("save Error",field);
						});
						params.id = '<?php echo Yii::app()->session['userId']; ?>';
						$.ajax({
				    	  type: "POST",
				    	  url: baseUrl+"/<?php echo $this->module->id?>/news/save",
				    	  data: params,
				    	  dataType: "json"
				    	}).done( function(data){
				    		if(data.result){
								console.dir(data);
								$.unblockUI();
								$("#ajaxSV").html('');
								$.hideSubview();
								toastr.success('Saved successfully!');
				    		}
				    		else 
				    		{
				    			$.unblockUI();
								toastr.error('Something went wrong!');
				    		}
				    	} );
						
						return false;
					}
				});
				console.dir(form);
			},
			onHide : function() {
				$("#ajaxSV").html('');
				$.hideSubview();
			},
			onSave: function() {
				$("#ajaxForm").submit();
			}
		});
	});
});

</script>

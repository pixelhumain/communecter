
<script type="text/javascript">

var formDefinition = {
    "jsonSchema" : {
        "title" : "News Form",
        "type" : "object",
        "properties" : {
        	"id" :{
            	"inputType" : "hidden",
            	"value" : "<?php echo (isset($_GET['id'])) ? $_GET['id'] : '' ?>"
            },
            "type" :{
            	"inputType" : "hidden",
            	"value" : "<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>"
            },
            "name" :{
            	"inputType" : "text",
            	"placeholder" : "Title",
            	"rules" : {
						"required" : true
					}
            },
            "date" :{
            	"inputType" : "date",
            	"placeholder" : "When was this or will it be",
            },
            "text" :{
            	"inputType" : "textarea",
            	"placeholder" : "Describe your Organization",
            	"rules" : {
						"required" : true
					}
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
	        /*"latitude" :{
            	"inputType" : "hidden",
            	"value" : "<?php echo (isset($_GET['lat'])) ? $_GET['lat'] : '' ?>"
            },
            "longitude" :{
            	"inputType" : "hidden",
            	"value" : "<?php echo (isset($_GET['lon'])) ? $_GET['lon'] : '' ?>"
            },*/
        }
    },
    "collection" : "organization",
    "key" : "ajaxForm",
};

var dataBind = {
   "#text" : "text",
   "#name" : "name",
   "#tags" : "tags",
   "#id" : "typeId",
   "#type" : "type",
   "#date" : "date",
  /* "#latitude" : "from.latitude",
   "#longitude" : "from.longitude"*/
};

jQuery(document).ready(function() {
	
	$(".new-news").off().on("click",function() { 
		$("#ajaxSV").html("<div class='col-sm-8 col-sm-offset-2'>"+
							"<div class='space20'></div>"+
							"<h1>Share a thought, an idea, </h1>"+
							"<form id='ajaxForm'></form>"+
						  "</div>");
		$.subview({
			content : "#ajaxSV",
			onShow : function() 
			{
				var form = $.dynForm({
					formId : "#ajaxForm",
					formObj : formDefinition,
					onLoad : function  () {
						/*console.log("on show subview",);
						here you can load anythnig into your form fields 
						it is called after creation
						*/
						/*$.each( dataBind, function(field,fieldObj){
							if(field != ""){
								var val = fieldObj.value;
								if(val) {
									$(field).val(val);
									console.log("field key",field);
								}
							}
						});*/
						
					},
					onSave : function(){
						console.log("saving Organization!!");
						var params = {};
						$.each(dataBind,function(field,dest){
							console.log("dataBind 1 ",field,$(field).val());
							if(field != "" )
							{
								console.log("dataBind 2",field);
								value = "";
								if(dest == "tags"){
									value = $(field).val().split(",");
								} else if( $(field) && $(field).val() && $(field).val() != "" )
									value = $(field).val();

								if( value != "" )
								{
									console.log("dataBind 3 ",field,dest,value);
									jsonHelper.setValueByPath( params, dest, value );
								} 
							}
							else
								console.log("save Error",field);
						});
						params.id = '<?php echo Yii::app()->session['userId']; ?>';
						console.dir(params);
						$.ajax({
				    	  type: "POST",
				    	  url: baseUrl+"/<?php echo $this->module->id?>/news/save",
				    	  data: params,
				    	  dataType: "json"
				    	}).done( function(data){
				    		if(data.result)
				    		{
				    			if( 'undefined' != typeof updateNews && typeof updateNews == "function" )
		                    		updateNews(data.object);
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

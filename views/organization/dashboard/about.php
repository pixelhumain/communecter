<div class="panel panel-white">
  <div class="panel-heading border-light">
    <h4 class="panel-title">QUI SOMMES NOUS ? </h4>
    <div class="panel-tools">
      <div class="dropdown">
        <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
          <i class="fa fa-cog"></i>
        </a>
        <ul class="dropdown-menu dropdown-light pull-right" role="menu">
          <li>
            <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
          </li>
          
          <li>
            <a class="panel-refresh" href="#">
              <i class="fa fa-refresh"></i> <span>Refresh</span>
            </a>
          </li>
		  <?php if( Authorisation::isOrganizationAdmin(Yii::app()->session['userId'], $organization["_id"]) ){ ?>
          <li>
            <a href="#ajaxSV" id="aboutConfig">
              <i class="fa fa-wrench"></i> <span>Configurations</span>
            </a>
          </li>
          <?php } ?>
          <li>
            <a class="panel-expand" href="#">
              <i class="fa fa-expand"></i> <span>Fullscreen</span>
            </a>
          </li>
        </ul>
      </div>
      <a class="btn btn-xs btn-link panel-close" href="#">
        <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="panel-body no-padding center orgaDescription">
    <div class="row">
    	<div class="col-md-12">
    	<?php 
			$this->renderPartial('../pod/fileupload', array("itemId" => (string)$organization["_id"],
															  "type" => Organization::COLLECTION,
															  "contentId" =>Document::IMG_BANNIERE,
															  "show" => "true",
															  "editMode" => Authorisation::isOrganizationAdmin(Yii::app()->session['userId'], $organization["_id"]))); ?>
 		</div>   
    </div>	
  </div>
</div>

<script type="text/javascript">

var formDefinition = {
    "jsonSchema" : {
        "title" : "About Pod Form",
        "type" : "object",
        "properties" : {
            "description" :{
            	"inputType" : "textarea",
            	"placeholder" : "Describe your Organization"
            }
        }
    },
    "collection" : "organization",
    "key" : "ajaxForm",
    //"savePath":moduleId+""
};

var dataBind = {
	"#description": {
		"value" : <?php if(isset($organization["description"])) echo json_encode($organization["description"]); else echo "''"; ?>,
		"saveTo": "description",
		"updateElement" : ".orgaDescription"
	},
};

jQuery(document).ready(function() {
	
	$("#aboutConfig").off().on("click",function() { 
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
						params.id = '<?php echo (string)$organization["_id"] ?>';
						$.ajax({
				    	  type: "POST",
				    	  url: baseUrl+"/<?php echo $this->module->id?>/organization/updateField",
				    	  data: params,
				    	  dataType: "json"
				    	}).done( function(data){
				    		if(data.result){
								console.dir(data);
								$.unblockUI();
								$("#ajaxSV").html('');
								//$.hideSubview();
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
				//$.hideSubview();
			},
			onSave: function() {
				$("#ajaxForm").submit();
			}
		});
	});
});

</script>
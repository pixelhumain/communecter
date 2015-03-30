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
		  <?php if( in_array( Yii::app()->session['userId'] , $organization["canEdit"]) ){ ?>
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
    <?php echo $organization["description"] ?>
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
var aboutInitData = {
	"description" : '<?php echo $organization["description"] ?>'
};
var aboutDataBind = {
	"#description": "description"
};
var aboutDataBindFrontEnd = {
	"#description": ".orgaDescription"
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
						$.each(aboutInitData,function(field,path){
							if(field != ""){
								var val = jsonHelper.getValueByPath( aboutInitData, path );
								if(val){
									$(field).val(val);
									console.log("field key",field);
								}
							}
						});
						
					},
					onSave : function(){
						console.log("saving Organization!!");
						var data = {};
						$.each(aboutDataBind,function(field,path){
							console.log("save key ",field,path);
							if(field != "" )
							{
								if( $(field) && $(field).val() && $(field).val() != "" )
								{
									value = $(field).val();
									jsonHelper.setValueByPath( data, path, value );
								} 
							}
							else
								console.log("save Error",field);
						});
						$.ajax({
				    	  type: "POST",
				    	  url: baseUrl+"/<?php echo $this->module->id?>/organization/saveNewAddMember",
				    	  data: params,
				    	  dataType: "json"
				    	}).done(function(data){
				    		if(data.result){
				    			$.each(aboutDataBindFrontEnd,function(field,endpoint){
									if(field != "" )
									{
										if( $(field) && $(field).val() && $(field).val() != "" )
										{
											$(endpoint).html($(field).val());
										} 
									}
									else
										console.log("save Error",field);
								});
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
				    	});
						
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
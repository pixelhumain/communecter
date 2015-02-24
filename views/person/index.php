<?php
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.pulsate/jquery.pulsate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/pages-user-profile.js' , CClientScript::POS_END);
?>
<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-sm-12">
		<div class="tabbable">
			<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
				<li class="active">
					<a data-toggle="tab" href="#panel_overview">
						Overview
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#panel_edit_account">
						Edit Account
					</a>
				</li>
				
				<li>
					<a data-toggle="tab" href="#panel_organisations">
						Organizations
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#panel_events">
						Events
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#panel_projects">
						Projects
					</a>
				</li>

				
			</ul>
			<div class="tab-content">
				<?php 
					$this->renderPartial('overview',array( "person" => $person));
					$this->renderPartial('editAccount',array( "person" => $person));
					$this->renderPartial('organization',array( "person" => $person));
					$this->renderPartial('events',array( "person" => $person));
					$this->renderPartial('projects',array( "person" => $person));
				?>
			</div>
		</div>
<div class="row">
	<div class="col-md-12 padding-20">
		<a href="javascript:;" onclick="openSubView('Add an Organisation', '/communecter/organization/form',null)" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-plus"></i> Add an Organization</a>
		<a href="javascript:;" onclick="openSubView('Invite Someone', '/communecter/person/invite',null)" class="btn btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-plus"></i> Invite Someone</a>
	</div>	
</div>
	</div>
</div>

<!-- end: PAGE CONTENT-->
<script>
jQuery(document).ready(function() {

	$('#tags').select2({ tags: <?php echo $tags ?> });
	$('#tags').select2({ tags: <?php echo $tags ?> });
	PagesUserProfile.init();

});

$(".delBtn").on("click",function(){
	id = $(this).data("id");

	bootbox.confirm("Are you sure you want to delete "+$(this).data("name")+" organization ?", function(result) {
		if(result)
		{
			testitpost(null , baseUrl+"/"+moduleId+"/organization/delete",{"id":id},
				function(data,id){
					if(data.result){
						toastr.success("delete successfull ");
						$('organisation'+$(this).data("id")).remove();
						var tr = $(this).closest('tr');
				        tr.css("background-color","#FF3700");
				        tr.fadeOut(400, function(){
				            tr.remove();
				        });
				        return false;
					}
					else 
						toastr.error(data.msg);
				});
		}
	});
});

$("#personForm").submit( function(event){	
	event.preventDefault();
	//console.log($("#personForm"));
	//formData = $("#personForm").serializeFormJSON();
	//console.dir(formData);
	$.ajax({
	  type: "POST",
	  url: baseUrl+"/"+moduleId+"/api/saveUser",
	  data: $("#personForm").serialize(),
	  dataType: "json",
	  success: function(data){
	  		if(data.result)
	  			toastr.success(data.msg);
	  		else
	  			toastr.error(data.msg);
	  },
	  dataType: "json"
	});
});
</script>
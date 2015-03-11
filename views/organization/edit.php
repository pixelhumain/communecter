<?php
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.pulsate/jquery.pulsate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/pages-user-profile.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/autosize/jquery.autosize.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/autosize/jquery.autosize.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/nvd3/lib/d3.v3.js' , CClientScript::POS_END);
//Select2 css and JS
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datepicker/css/datepicker.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' , CClientScript::POS_END);
//Select2 css and JS
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.min.js' , CClientScript::POS_END);
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
						Edit Organization
					</a>
				</li>
				
				<li>
					<a data-toggle="tab" href="#panel_members">
						Members
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#panel_followers">
						Followers 
					</a>
				</li>
				
			</ul>
			<div class="tab-content">
				<?php 
					$this->renderPartial('overview',array("organization" => $organization));
					$this->renderPartial('editOrganization',array("organization" => $organization,'types'=>$types,'tags'=>$tags));
					$this->renderPartial('members',array("organization" => $organization, "members" => $members));
					$this->renderPartial('followers',array("organization" => $organization, "followers" => $followers));
				?>
			</div>
		</div>
		
	</div>
</div>
<!-- end: PAGE CONTENT-->

<script type="text/javascript">


	jQuery(document).ready(function() {

		//very strange BUg this only works when declaring it twice, no idea and no time to loose
		$('#tagsOrganization').select2({ tags: <?php echo $tags?> });
		$('#tagsOrganization').select2({ tags: <?php echo $tags?> });

		$( '#creationDate' ).datepicker({
            dateFormat: 'dd/mm/yyyy',
            autoclose: true,
        })
		
		Main.init();
		SVExamples.init();
		PagesUserProfile.init();
	});

	$("#organizationForm").submit( function(event){	
		//console.log($("#personForm").serialize());
		event.preventDefault();
		$.ajax({
	    	  type: "POST",
	    	  url: baseUrl+"/<?php echo $this->module->id?>/organization/save",
	    	  data: $("#organizationForm").serialize(),
	    	  success: function(data){
	    			if(!data.result)
                        toastr.error(data.msg);
                    else    
                        toastr.success(data.msg);
	    			//window.location.href = baseUrl+"/<?php echo $this->module->id?>/person?tabId=panel_organisations";
	    	  },
	    	  dataType: "json"
	    	});
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
	$(".editBtn").on("click",function(){
		id = $(this).data("id");
		openSubView('Invite someone', "/"+moduleId+"/organization/form/id/"+id,null);
	});

	<?php $mapOrganization = array("organization"=>$organization,
							"members"=>$members,
							"followers"=>$followers); 
	?>
 	var mapOrganization = <?php echo json_encode($mapOrganization)?>;
 	debugMap.push(mapOrganization);
</script>
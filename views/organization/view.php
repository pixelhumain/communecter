<?php
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.pulsate/jquery.pulsate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/pages-user-profile.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/autosize/jquery.autosize.min.js' , CClientScript::POS_END);

//Select2 css and JS
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datepicker/css/datepicker.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' , CClientScript::POS_END);
//Select2 css and JS
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.css');
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
					<a data-toggle="tab" href="#panel_organizations">
						Linked Organizations
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#panel_members">
						Members
					</a>
				</li>
				
			</ul>
			<div class="tab-content">
				<?php 
					$this->renderPartial('overview',array("organization" => $organization));
					$this->renderPartial('editOrganization',array("organization" => $organization,'types'=>$types,'tags'=>$tags));
					$this->renderPartial('linkedOrganizations',array("organization" => $organization));
					$this->renderPartial('members',array("organization" => $organization));
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
</script>
<?php 
/******
Documents à supprimer -- n'a plus lieu d'exister !! a confirmer
***********/
?>
<style type="text/css">	
	.organizationLine{cursor:pointer;}
</style>


<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title  text-green"><i class="fa fa-group fa-2x"></i> Organisations</h4>
	</div>
	<div class="panel-tools">
		<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
		<a href="javascript:;" onclick="openSubView('Add an Organisation', '/'+moduleId+'/organization/addorganizationform',null)" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Add an Organization"><i class="fa fa-plus"></i></a>
		<?php } ?>
	</div>
	<div class="panel-body no-padding">
		<div class="panel-scroll height-230 ps-container">	
			<table class="table table-striped table-hover" id="organizations">
				<tbody>
					<?php 
					$memberId = Yii::app()->session["userId"];
					$memberType = Person::COLLECTION;
					if(isset($organizations)) { 
					foreach ($organizations as $e) { ?>
						<tr id="<?php echo Organization::COLLECTION.(string)$e["_id"];?>">
							<td class="center organizationLine" style="padding-left: 18px;">
								<?php $url = '#organization.detail.id.'.$e["_id"];?>
								<a href="javascript:;" onclick="loadByHash('<?php echo $url?>')">
									<?php if ($e && isset($e["imagePath"])){ ?>
										<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>">
									<?php } else { ?>
										<i class="fa fa-group fa-2x text-green"></i>
									<?php } ?>
								</a>
							</td>
							<td >							
								<a href="javascript:;" onclick="loadByHash('<?php echo $url?>')">
									<?php if(isset($e["name"]))echo $e["name"]?>
								</a>
							</td>
							<td><?php if(isset($e["type"]))echo $e["type"]?></td>
							<td class="center">
								<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
									<a href="javascript:;" class="removeMemberBtn btn btn-xs btn-grey tooltips visible-lg" data-name="<?php echo $e["name"]?>" data-memberof-id="<?php echo $e["_id"]?>" data-member-type="<?php echo $memberType ?>" data-member-id="<?php echo $memberId ?>" data-placement="left" data-original-title="Remove from my Organizations" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
								<?php }; ?>
							</td>
						</tr>
					<?php
						};}
					?>
				</tbody>
			</table>
			<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>
			<?php 
				if (isset($organizations) && count($organizations) == 0) {
			?>
				<div id="infoPodOrga" class="padding-10">
					<blockquote> 
						Create or Connect 
						<br>an Organization, NGO,  
						<br>Local Business, Informal Group. 
						<br>Build links in your network, 
						<br>to create a connected local directory 
					</blockquote>
				</div>
			<?php 
				};
			?>
		</div>
	</div>
</div>

<script type="text/javascript">

	jQuery(document).ready(function() {
		bindBtnRemoveMember();
	});

	function bindBtnRemoveMember() {

		$(".removeMemberBtn").off().on("click",function () {
			$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
			
			var idMemberOf = $(this).data("memberof-id");
			var idMember = $(this).data("member-id");
			var typeMember = $(this).data("member-type");
			bootbox.confirm("Are you sure you want to delete <span class='text-grey'>"+$(this).data("name")+"</span> connection ?", 
				function(result) {
					if (!result) {
					$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
					return;
				}

				console.log(idMember);
				$.ajax({
					type: "POST",
					url: baseUrl+"/"+moduleId+"/link/removemember/memberId/"+idMember+"/memberType/"+typeMember+"/memberOfId/"+idMemberOf+"/memberOfType/<?php echo Organization::COLLECTION ?>",
					dataType: "json",
					success: function(data){
						if ( data && data.result ) {               
							toastr.info("LINK DIVORCED SUCCESFULLY!!");
							$("#organizations"+idMemberOf).remove();
							if ($("#organizations tr").length == 0) {
								$("#info").show();
							}
						} else {
						   toastr.info("something went wrong!! please try again.");
						}
					}
				});
			});

			$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
		});
	}

	function updateMyOrganization(nOrganization, organizationId) {
		if('undefined' != typeof contextMap){
			contextMap["organizations"].push(nOrganization);
		}
		var viewBtn = '<a href="'+baseUrl+'/'+moduleId+'/organization/dashboard/id/'+organizationId+'">';
		var unlinkBtn = '<a href="javascript:;" class="removeMemberBtn btn btn-xs btn-grey tooltips" data-name="'+nOrganization.name+'"data-memberof-id="'+organizationId+'" data-member-type="<?php echo Person::COLLECTION ?>" data-member-id="<?php echo Yii::app()->session["userId"]?>" data-placement="left" data-original-title="Remove from my Organizations" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>';
		var organizationLine  = 
		'<tr id="<?php echo Organization::COLLECTION ?>'+organizationId+'">'+
					'<td class="center">'+viewBtn+'<i class="fa fa-group fa-2x  text-green"></i></a></td>'+
					'<td>'+viewBtn+nOrganization.name+'</a></td>'+
					'<td>'+nOrganization.type+'</td>'+
					'<td class="center">'+
					unlinkBtn+
					"</td>"+
				"</tr>";
		$("#organizations").prepend(organizationLine);
		$('.tooltips').tooltip();
		$('#infoPodOrga').hide();
		bindBtnRemoveMember();
	}
</script>
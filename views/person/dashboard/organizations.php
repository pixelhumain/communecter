<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-group fa-2x text-green"></i> Mes organisations</h4>
	</div>
	<div class="panel-tools">
		<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
		<a href="javascript:;" onclick="openSubView('Add an Organisation', '/'+moduleId+'/organization/form',null)" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Add an Organization"><i class="fa fa-plus"></i></a>
		<?php } ?>
	</div>
	<div class="panel-body no-padding">
		<div class="panel-scroll height-230 ps-container">
			<table class="table table-striped table-hover" id="organizations">
				<tbody>
					<?php if(isset($organizations)){foreach ($organizations as $e) { ?>
						<tr id="<?php echo Organization::COLLECTION.(string)$e["_id"];?>">
							<td class="center">
							<?php if ($e && isset($e["imagePath"])){ ?>
								<img width="50" height="50" alt="image" class="img-circle" src="<?php echo $e["imagePath"]; ?>">
							<?php } else { ?>
								<i class="fa fa-group fa-2x"></i>
							<?php } ?>
							</td>
							<td><?php if(isset($e["name"]))echo $e["name"]?></td>
							<td><?php if(isset($e["type"]))echo $e["type"]?></td>
							<td class="center">
							<div class="visible-md visible-lg hidden-sm hidden-xs">
								<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/dashboard/id/'.$e["_id"]);?>" class="btn btn-xs btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
								<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
								<a href="javascript:;" class="disconnectBtn btn btn-xs btn-red tooltips " data-type="<?php echo Organization::COLLECTION ?>" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove from my Organizations" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
								<?php }; ?>
							</div>
							</td>
						</tr>
					<?php }} else { ?>
					<h1>AUCUNE ORGANISATIONS</h1>
					<?php }; ?>
				</tbody>
			</table>
		<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
	</div>
</div>

<script type="text/javascript">
	var temp;
	function updateMyOrganization(nOrganization, organizationId) {
	    temp = nOrganization;
	    console.log("updateMyOrganization func");
	    var organizationLine  = 
	    '<tr id="organization'+organizationId+'">'+
	                '<td class="center"><i class="fa fa-group fa-2x"></i></td>'+
	                '<td>'+nOrganization.name+'</td>'+
	                '<td>'+nOrganization.type+'</td>'+
	                '<td class="center">'+
	                '<div class="visible-md visible-lg hidden-sm hidden-xs">'+
	                    '<a href="'+baseUrl+'/'+moduleId+'/organization/dashboard/id/'+organizationId+'" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a> '+
						'<a href="javascript:;" class="disconnectBtn btn btn-xs btn-red tooltips " data-type="organization" data-id="'+organizationId+'" data-name="'+nOrganization.name+'" data-placement="top" data-original-title="Remove from my Organizations" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a> '+
	                '</div>'+
	                "</td>"+
	            "</tr>";
	    $("#organizations").prepend(organizationLine);
	}

</script>

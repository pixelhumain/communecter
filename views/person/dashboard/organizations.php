
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-group fa-2x text-green"></i> Mes organisations</h4>
	</div>
	<div class="panel-tools">
		<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
		<a href="javascript:;" onclick="openSubView('Add an Organisation', '/communecter/organization/form',null)" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-plus"></i> Add an Organization</a>
		<?php } ?>

		<div class="dropdown">
			<a class="btn btn-xs dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
				<i class="fa fa-cog"></i>
			</a>
			<ul role="menu" class="dropdown-menu dropdown-light pull-right">
				<li>
					<a href="#" class="panel-collapse collapses"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
				</li>
				<li>
					<a href="#" class="panel-refresh">
						<i class="fa fa-refresh"></i> <span>Refresh</span>
					</a>
				</li>
				<li>
					<a data-toggle="modal" href="#panel-config" class="panel-config">
						<i class="fa fa-wrench"></i> <span>Configurations</span>
					</a>
				</li>
				<li>
					<a href="#" class="panel-expand">
						<i class="fa fa-expand"></i> <span>Fullscreen</span>
					</a>
				</li>
			</ul>
		</div>
		<a href="#" class="btn btn-xs btn-link panel-close">
			<i class="fa fa-times"></i>
		</a>
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
							<!--<td><?php //if(isset($e["tags"]))echo implode(", ", $e["tags"])?></td>-->
							<td><?php if(isset($e["linkType"]))echo $e["linkType"]?></td>
							<td class="center">
							<div class="visible-md visible-lg hidden-sm hidden-xs">
								<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/dashboard/id/'.$e["_id"]);?>" class="btn btn-xs btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
								<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
								<a href="javascript:;" class="disconnectBtn btn btn-xs btn-red tooltips " data-linkType="<?php if(isset($e["linkType"]))echo $e["linkType"]?>"  data-type="<?php echo Organization::COLLECTION ?>" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove Knows relation" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
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
	function updateMyOrganization(nOrganization, organizationId) {
	    console.log("updateMyOrganization func");
	    var organizationLine  = 
	    '<tr id="organization'+organizationId+'">'+
	                '<td><i class="fa fa-group fa-2x"></i></td>'+
	                '<td>'+nOrganization.name+'</td>'+
	                '<td>'+nOrganization.type+'</td>'+
	                '<td class="center">'+
	                '<div class="visible-md visible-lg hidden-sm hidden-xs">'+
	                    '<a href="'+baseUrl+'/'+moduleId+'/organization/dashboard/id/'+organizationId+'" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a> '+
						'<a href="javascript:;" class="disconnectBtn btn btn-xs btn-red tooltips " data-linkType="'+nOrganization.linkType+'" data-type="organization" data-id="'+organizationId+'" data-name="'+nOrganization.name+'" data-placement="top" data-original-title="Remove Knows relation" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a> '+
	                '</div>'+
	                "</td>"+
	            "</tr>";
	    $(".organizations").prepend(organizationLine);
	}

</script>

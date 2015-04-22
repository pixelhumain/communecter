<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-smile-o fa-2x text-yellow"></i> Mon entourage</h4>
	</div>
	<div class="panel-tools">
		<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
			<a href="javascript:;" onclick="openSubView('Invite Someone', '/communecter/person/invite',null)" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Invite Someone"><i class="fa fa-plus"></i></a>
		<?php } ?>
	</div>
	<div class="panel-body no-padding">
		<?php if(isset($people)  && count($people)>0){ ?>
		<div class="panel-scroll height-230 ps-container">
			<table class="table table-striped table-hover" id="people">
				<tbody>
					<?php foreach ($people as $e) { ?>
						<tr id="<?php echo PHType::TYPE_CITOYEN.(string)$e["_id"];?>">
							<td class="center">
								<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/dashboard/id/'.$e["_id"]);?>" class="text-dark">
								<?php if ($e && isset($e["imagePath"])){ ?>
									<img width="50" height="50" alt="image" class="img-circle" src="<?php echo $e["imagePath"]; ?>">
								<?php } else { ?>
									<i class="fa fa-smile-o fa-2x"></i>
								<?php } ?>
								</a>
							</td>
							<td>
								<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/dashboard/id/'.$e["_id"]);?>" class="text-dark">
								<?php if(isset($e["name"]))echo $e["name"]?>
								</a>
							</td>
							<td><?php if(isset($e["tags"]))echo implode(", ", $e["tags"])?></td>
							<td><?php if(isset($e["linkType"]))echo $e["linkType"]?></td>
							<td class="center">
							<div class="visible-md visible-lg hidden-sm hidden-xs">
								<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
								<a href="javascript:;" class="disconnectBtn btn btn-xs btn-red tooltips " data-linkType="<?php if(isset($e["linkType"]))echo $e["linkType"]?>"  data-type="<?php echo PHType::TYPE_CITOYEN ?>" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove Knows relation" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
								<?php }; ?>
							</div>
							</td>
						</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
		<?php } else{ ?>
			<div class ="center" >
				<p> Invite People create links, communicate, interact to build better cities, better Organizations, stronger actions. People are the heart of </p>
			</div>
		<?php } ?>
	</div>
</div>

<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-lightbulb-o fa-2x text-blue"></i> Mes projets</h4>
	</div>
	<div class="panel-tools">
		<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
			<a href="#newProject"  class="new-event btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add a project" alt="Add an project"><i class="fa fa-plus"></i></a>
		<?php } ?>
	</div>
	<div class="panel-body no-padding">
		<?php if(isset($projects) && count($projects)>0){ ?>
			<div class="panel-scroll height-230 ps-container">			
			<table class="table table-striped table-hover" id="projects">
				<tbody>
					<?php
					
					foreach ($projects as $e) 
					{
					?>
					<tr id="project<?php echo (string)$e["_id"];?>">
						<td class="center">
							<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/project/dashboard/id/'.$e["_id"]);?>" class="text-dark">
							<?php if ($e && isset($e["imagePath"])){ ?>
								<img width="50" height="50" alt="image" class="img-circle" src="<?php echo $e["imagePath"]; ?>">
							<?php } else { ?>
								<i class="fa fa-lightbulb-o fa-2x"></i>
							<?php } ?>
						</a>
						</td>
						<td>
							<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/project/dashboard/id/'.$e["_id"]);?>" class="text-dark">
								<?php if(isset($e["name"]))echo $e["name"]?>
							</a>
						</td>
						<td><?php if(isset($e["url"]))echo $e["url"]?></td>
						<td class="center">
						<div class="visible-md visible-lg hidden-sm hidden-xs">
							<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
							<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/project/edit/id/'.$e["_id"]);?>" class="btn btn-xs btn-light-blue tooltips " data-placement="top" data-original-title="Edit"><i class="fa fa-pencil-square-o"></i></a>
							<a href="#" class="btn btn-xs btn-red tooltips delBtn" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
							<?php }; ?>
						</div>
						</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
		<?php } else{ ?>
			<div class ="center" >
				<p> Create or Contribute to Local <br> or distant projects </p>
			</div>
		<?php } ?>
	</div>
</div>
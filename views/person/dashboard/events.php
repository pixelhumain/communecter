<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-calendar fa-2x text-red"></i> Mes evenements</h4>
	</div>
	<div class="panel-tools">
		<?php if((isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"])  || (isset($organizationId) && isset(Yii::app()->session["userId"]) && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $organizationId))) { ?>
		<a href="#newEvent" class="new-event btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add an Event" alt="Add an Event"><i class="fa fa-plus"></i> Add an Event</a>
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
			<table class="table table-striped table-hover" id="events">
				<tbody>
					<?php
					if(isset($events)){
					foreach ($events as $e) 
					{
					?>
					<tr id="event<?php echo (string)$e["_id"];?>">
						<td class="center">
						<?php if ($e && isset($e["imagePath"])){ ?>
							<img width="50" height="50" alt="image" class="img-circle" src="<?php echo $e["imagePath"]; ?>">
						<?php } else { ?>
							<i class="fa fa-calendar fa-2x"></i>
						<?php } ?>
						<td><?php if(isset($e["name"]))echo $e["name"]?></td>
						<td><?php if(isset($e["type"]))echo $e["type"]?></td>
						<td class="center">
						<div class="visible-md visible-lg hidden-sm hidden-xs">
							<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/event/dashboard/id/'.$e["_id"]);?>" class="btn btn-xs btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
							<?php if(isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"] ) { ?>
							<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/event/edit/id/'.$e["_id"]);?>" class="btn btn-xs btn-light-blue tooltips " data-placement="top" data-original-title="Edit"><i class="fa fa-pencil-square-o"></i></a>
							<a href="#" class="btn btn-xs btn-red tooltips delBtn" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
							<?php }; ?>
						</div>
						</td>
					</tr>
					<?php
					}}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
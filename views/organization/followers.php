<div id="panel_followers" class="tab-pane fade">

	<h1>Followers of the Organization</h1>
	<p>Followers are organizations or persons knowing you but not a member</p>

	<table class="table table-striped table-bordered table-hover" id="organizations">
		<thead>
			<tr>
				<th>Name</th>
				<th class="hidden-xs">Type</th>
				<th class="hidden-xs center">Tags</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(isset($followers)) {
			foreach ($followers as $follower) 
			{
			?>
			<tr id="follower<?php echo (string)$follower["_id"];?>">
				<td><?php if(isset($follower["name"]))echo $follower["name"]?></td>
				<td><?php if(isset($follower["type"]))echo $follower["type"]?></td>
				<td><?php if(isset($follower["tags"]))echo implode(",", $follower["tags"])?></td>
				<td class="center">
				<div class="visible-md visible-lg hidden-sm hidden-xs">
					<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.$follower["publicURL"]);?>" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
				</div>
				</td>
			</tr>
			<?php
				}
			}
			?>
		</tbody>
	</table>
</div>	
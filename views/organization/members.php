<div id="panel_members" class="tab-pane fade">
	<table class="table table-striped table-bordered table-hover" id="members">
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
			if(isset($organization["subOrganizations"])){
			foreach ($organization["subOrganizations"] as $e) 
			{
			?>
			<tr id="organisation<?php echo (string)$e["_id"];?>">
				<td><?php if(isset($e["name"]))echo $e["name"]?></td>
				<td><?php if(isset($e["type"]))echo $e["type"]?></td>
				<td><?php if(isset($e["tags"]))echo implode(",", $e["tags"])?></td>
				<td class="center">
				<div class="visible-md visible-lg hidden-sm hidden-xs">
					<a href="#" class="btn btn-light-blue tooltips editBtn" data-id="<?php echo (string)$e["_id"];?>" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
					<a href="#" class="btn btn-red tooltips delBtn" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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
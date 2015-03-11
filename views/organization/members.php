<div id="panel_members" class="tab-pane fade">

	<div class="col-md-12 padding-20 pull-right">
		<a href="#addMembers" class="addMembersBtn btn btn-xs btn-light-blue tooltips pull-right" data-placement="top" data-original-title="Connect People or Organizations that are part of your Organization"><i class="fa fa-plus"></i> Connect Members</a>
	</div>

	<h1>List of Members</h1>
    <p>An Organization can have People or Organization as members</p>
    
    <table class="table table-striped table-bordered table-hover" id="members">
		<thead>
			<tr>
				<th>Name</th>
				<th class="hidden-xs">Type</th>
				<th class="hidden-xs center">Email</th>
				<th>To be Activated</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(isset($members)) {
			foreach ($members as $member) 
			{
				if (isset($member["publicURL"])) $publicURL = $member["publicURL"];
			?>
			<tr id="member<?php echo (string)$member["_id"];?>">
				<td><?php if(isset($member["name"]))echo $member["name"]?></td>
				<td><?php if(isset($member["type"]))echo $member["type"]?></td>
				<td><?php if(isset($member["email"]))echo $member["email"]?></td>
				<td class="center">
				<div class="visible-md visible-lg hidden-sm hidden-xs">
					<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/public/id/'.$member["_id"]);?>" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
					<a href="#" class="btn btn-red tooltips delBtn" data-id="<?php echo (string)$member["_id"];?>" data-name="<?php echo (string)$member["name"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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

<?php
$this->renderPartial('addMembers', array( "organization" => $organization ));
?>

<script type="text/javascript">
	
jQuery(document).ready(function() {
	
	$(".addMembersBtn").off().on("click",function () {
        
		subViewContent = $(this).attr('href');
	    $.subview({
	        content : subViewContent,
	        onShow : function() {
	        	binAddMembersEvents ();
	        },
	        onHide : function() {
	          $.hideSubview();
	          
	        }
	    });
	});


});
</script>
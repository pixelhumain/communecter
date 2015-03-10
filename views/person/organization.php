<div id="panel_organisations" class="tab-pane fade">
	<div class="row">
		<div class="col-md-12 padding-20 ">
			<a href="javascript:;" onclick="openSubView('Add an Organisation', '/communecter/organization/form',null)" class="btn btn-xs btn-light-blue tooltips pull-right" data-placement="top" data-original-title="Edit"><i class="fa fa-plus"></i> Add an Organization</a>
			
		</div>	
	</div>
	Organisations I follow or I'm am member of.<br/>
	<table class="table table-striped table-bordered table-hover" id="organizations">
		<thead>
			<tr>
				<th>Name</th>
				<th class="hidden-xs">Type</th>
				<th class="hidden-xs center">Tags</th>
				<th class="hidden-xs center">Link Type</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(isset($organizations)){
			foreach ($organizations as $e) 
			{
			?>
			<tr id="organisation<?php echo (string)$e["_id"];?>">
				<td><?php if(isset($e["name"]))echo $e["name"]?></td>
				<td><?php if(isset($e["type"]))echo $e["type"]?></td>
				<td><?php if(isset($e["tags"]))echo implode(", ", $e["tags"])?></td>
				<td><?php if(isset($e["linkType"]))echo $e["linkType"]?></td>
				<td class="center">
				<div class="visible-md visible-lg hidden-sm hidden-xs">
					<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/public/id/'.$e["_id"]);?>" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
					<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/edit/id/'.$e["_id"]);?>" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="Edit"><i class="fa fa-pencil-square-o"></i></a>
					<a href="#" class="btn btn-red tooltips delBtn" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
				</div>
				</td>
			</tr>
			<?php
			}}
			?>
		</tbody>
	</table>
</div>

<!-- end: PAGE CONTENT-->
<script>
jQuery(document).ready(function() {

	$(".delBtn").on("click",function(){
		id = $(this).data("id");

		bootbox.confirm("Are you sure you want to delete "+$(this).data("name")+" organization ?", function(result) {
			if(result)
			{
				testitpost(null , baseUrl+"/"+moduleId+"/organization/delete",{"id":id},
					function(data,id){
						if(data.result){
							toastr.success("delete successfull ");
							$('#organisation'+$(this).data("id")).remove();
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

});

</script>
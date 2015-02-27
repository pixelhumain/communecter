<div id="panel_people" class="tab-pane fade">
	
	
		<div class="row">
			<div class="col-md-12 padding-20 ">
				<?php 
				if( !Admin::checkInitData( PHType::TYPE_CITOYEN, "personNetworkingAll" ) ){ ?>
					<a href="<?php echo Yii::app()->createUrl("/communecter/person/InitDataPeopleAll") ?>" class="btn btn-xs btn-red  pull-right" ><i class="fa fa-plus"></i> InitData : Dummy People into your Network</a>
				<?php } else { ?>
					<a href="<?php echo Yii::app()->createUrl("/communecter/person/clearInitDataPeopleAll") ?>" class="btn btn-xs btn-red  pull-right" ><i class="fa fa-plus"></i> Remove Dummy People into your Network</a>
				<?php } ?>
			</div>	
		</div>
	
	People I follow or I know 
	<table class="table table-striped table-bordered table-hover" id="people">
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
			if(!empty($people))
			{
				foreach ($people as $e) 
				{
				?>
				<tr id="people<?php echo (string)$e["_id"];?>">
					<td><?php if(isset($e["name"]))echo $e["name"]?></td>
					<td><?php if(isset($e["type"]))echo $e["type"]?></td>
					<td><?php if(isset($e["tags"]))echo implode(",", $e["tags"])?></td>
					<td class="center">
						<div class="visible-md visible-lg hidden-sm hidden-xs">
							<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/view/id/'.$e["_id"]);?>" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
							<a href="#" class="btn btn-red tooltips delBtnKnows" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
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

	$(".delBtnKnows").on("click",function(){
		id = $(this).data("id");

		bootbox.confirm("Are you sure you want to delete "+$(this).data("name")+" connection ?", function(result) {
			if(result)
			{
				testitpost(null , baseUrl+"/"+moduleId+"/person/deleteKnows",{"id":id},
					function(data,id){
						if(data.result){
							toastr.success("delete successfull ");
							$('#people'+$(this).data("id")).remove();
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
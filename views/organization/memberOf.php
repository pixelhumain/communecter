<div id="panel_member_of" class="tab-pane fade">

	<div class="col-md-12 padding-20 pull-right">
		<a href="#joinOrganization"
				class="btn btn-xs btn-light-blue tooltips pull-right joinOrganizationBtn" 
				data-placement="top" data-original-title="Become a member of an organization"><i class="fa fa-plus"></i> Join an organization</a>
	</div>

	<h1>Member of</h1>
	<p>List organizations you are member of</p>

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
			if(isset($memberOf)) {
			foreach ($memberOf as $aMemberOf) 
			{
			?>
			<tr id="memberOf<?php echo (string)$aMemberOf["_id"];?>">
				<td><?php if(isset($aMemberOf["name"]))echo $aMemberOf["name"]?></td>
				<td><?php if(isset($aMemberOf["type"]))echo $aMemberOf["type"]?></td>
				<td><?php if(isset($aMemberOf["tags"]))echo implode(",", $aMemberOf["tags"])?></td>
				<td class="center">
				<div class="visible-md visible-lg hidden-sm hidden-xs">
					<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.$aMemberOf["publicURL"]);?>" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
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
	$this->renderPartial('joinOrganization', array("organization" => $organization)); 
?>
<script type="text/javascript">
	
jQuery(document).ready(function() {
	$(".joinOrganizationBtn").off().on("click",function () {
        
		subViewContent = $(this).attr('href');
	    $.subview({
	        content : subViewContent,
	        onShow : function() {

	        },
	        onHide : function() {
	          $.hideSubview();
	        }
	    });
	});
});
</script>

<div class="row">
	<div class="col-md-12 no-padding">
		<div class="col-lg-4 col-md-12">
			<?php 
				$this->renderPartial('dashboard/informations',array("need"=> $need));
			 ?>
		</div>
		<div class="col-lg-4 col-md-12">
			<?php 
				$this->renderPartial('dashboard/description',array("id"=> $need["_id"], "description"=> $description));
			 ?>
		</div>
		<div class="col-lg-4 col-md-12">
			<?php 
				$this->renderPartial('dashboard/helpers',array(
											"id"=> $need["_id"],
											"quantity"=>$need["quantity"],
											"name"=>$need["name"], 
											"helpers"=>$helpers,
											"parentType" => $parentType, 
											"parentId" => $parentId
									));
			 ?>
		</div>
	</div>
	<div class="col-md-12" id="commentNeed">
	</div>
</div>

<script>
jQuery(document).ready(function() {
	getAjax("#commentNeed",baseUrl+"/"+moduleId+"/comment/index/type/<?php echo $need["parentType"];?>/id/<?php echo $need["parentId"];?>",null,"html");
});
</script>

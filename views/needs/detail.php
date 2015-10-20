<?php 
if( isset($_GET["isNotSV"])) 
$this->renderPartial('../default/panels/toolbar'); 
?>
<div class="row">
	<div class=" col-md-12">
		<div class="col-md-12">
			<div class="panel panel-white col-md-8">
				<?php 
				$this->renderPartial('dashboard/ficheInfo', array( "need" => $need, 
																	"helpers" => $helpers, 
																	"description" => $description,
																	"isAdmin"=> $isAdmin																	));
				?>
			</div>
			

		</div>	
		<div class="col-md-4">
			<?php 
				$this->renderPartial('dashboard/helpers',array("id"=> $need["_id"],"quantity"=>$need["quantity"],"name"=>$need["name"], "helpers"=>$helpers));
			 ?>
		</div>
	</div>
	<div class="col-md-12" id="commentNeed">
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
		getAjax("#commentNeed",baseUrl+"/"+moduleId+"/comment/index/type/<?php echo $_GET["type"];?>/id/<?php echo $_GET["id"];?>",null,"html");
	});
</script>
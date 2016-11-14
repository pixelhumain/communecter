<?php 
if(!@$_GET["renderPartial"])
	$this->renderPartial('../pod/headerEntity', array("entity"=>$parent, "type" => $parentType, "openEdition" => $openEdition, "edit" => $edit, "firstView" => "need".(string)$need["_id"]));  
?>

<div class="row" id="need<?php echo (string)$need["_id"] ?>">
	<div class=" col-md-12">
		<div class="col-md-12">
			<div class="panel no-padding col-md-8">
				<?php 
				$this->renderPartial('dashboard/ficheInfo', 
							array( 	"need" => $need, 
									"parent" => $parent,
									"parentType" => $parentType,														
									"parentId" => $parentId,
									"helpers" => $helpers, 
									"description" => $description,
									"imagesD" => $images, 
									"isAdmin"=> $isAdmin														
									));
				?>
			</div>
			

		</div>	
		<div class="col-md-4">
			<?php 
				$this->renderPartial('dashboard/helpers',
						array(	"id"=> $need["_id"],
								"quantity"=>$need["quantity"],
								"name"=>$need["name"],
								"helpers"=>$helpers,
								"isAdmin"=> $isAdmin
						));
			 ?>
		</div>
	</div>
	<div class="col-md-12" id="commentNeed<?php echo (string)$need["_id"] ?>">
	</div>
</div>
<?php if(!isset($_GET["renderPartial"])){ ?>
</div>
<?php } ?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		setTitle("<?php echo $need["name"] ?>","cubes");
		getAjax("#commentNeed<?php echo (string)$need["_id"] ?>",baseUrl+"/"+moduleId+"/comment/index/type/<?php echo Need::COLLECTION ?>/id/<?php echo (string)$need["_id"];?>",null,"html");
		$(".fa-comments").removeClass("fa-2x");
	});
</script>
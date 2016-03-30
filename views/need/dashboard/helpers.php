<style>
.grayscale{
	filter: grayscale(0.7) blur(1px);
	-webkit-filter: grayscale(0.7) blur(1px);
	-moz-filter: grayscale(0.7) blur(1px);
	-o-filter: grayscale(0.7) blur(1px);
	-ms-filter: grayscale(0.7) blur(1px);
}
.refuseBtn{
	color: red;
    left: 10px;
}
.validateBtn{
	color: green;
    right: 10px;

}
.confirmBtn{
	display:none;
	font-size: 25px;
    width: 25px;
    position: absolute;
    bottom: 0px;
    background-color: white;
    z-index: 10;
    border-radius: 25px;
}
</style>
<div class="panel panel-white">
		<div class="panel-heading border-light text-white bg-yellow">
			<h4 class="panel-title"><i class="fa fa-users"></i> <?php echo Yii::t("need","HELPERS",null,Yii::app()->controller->module->id); ?></h4>
				<?php 
					$needId = $id;
				?>
		</div>
		<div class="panel-body no-padding">
			<div class="tabbable no-margin no-padding">				
				<div class="tab-content partition-white">
					<?php
					$nbValidate=0; 
					$nbToConfirm=0;
					if(!empty($helpers)){
						$i=0;
						foreach ($helpers as $id => $val){
							if($val["isValidated"] == 1){ ?>
								<div class="col-md-3 col-xs-4 center padding-10 helperBox">
									<a href="javascript:;" onclick="loadByHash('#person.detail.id.<?php echo (string)$val["_id"] ?>')" title="validated">
									<?php if(isset($val["imagePath"])) { ?>
										<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$val['imagePath']) ?>">
								<?php } else{ 
									echo "<i class=\"fa fa-smile-o fa-2x\"></i>";
								} ?>
									</a>
								</div>
							<?php 
								$nbValidate++;	
							}
							else{ ?>
								<div class="col-md-3 col-xs-4 center padding-10 helperBoxToValidate helperBox<?php echo (string)$val["_id"] ?>">
									<a href="javascript:;" class="refuseHelp">
										<i class="fa fa-times-circle refuseBtn confirmBtn"></i>
									</a>
									<a href="javascript:;" onclick="loadByHash('#person.detail.id.<?php echo (string)$val["_id"] ?>')" title="wait for validation">
									<?php if(isset($val["imagePath"])) { ?>
									<img width="50" height="50" alt="image" class="img-circle grayscale" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$val['imagePath']) ?>">
									<?php } else{ 
												echo "<i class=\"fa fa-smile-o fa-2x\"></i>";
											} ?>
									</a>
									<a href="javascript:;" class="acceptHelp" data-id="<?php echo (string)$val["_id"]; ?>" data-name="<?php echo $val["name"]; ?>">
										<i class="fa fa-check-circle validateBtn confirmBtn"></i>
									</a>
								</div>
								
							<?php 
								$nbToConfirm++;
							}
							$i++;
						}
						if($i != $quantity){
							for ($i;$i<$quantity;$i++){ ?>
								<div class="col-md-3 col-xs-4 center padding-10 helperBoxEmpty">
									<div class="img-circle" style="height: 50px;width: 50px;border: 3px solid gray;margin:auto;">
										<p style="line-height: 45px; font-size: 25px;"> ? </p>
									</div>
								</div>
							<?php }
						}
					}
					else{
						for ($i=0; $i<$quantity;$i++){ ?>
						<div class="col-md-3 col-xs-4 center padding-10 helperBoxEmpty">
							<div class="img-circle" style="height: 50px;width: 50px;border: 3px solid gray;margin:auto;">
	    	<p style="line-height: 45px; font-size: 25px;"> ? </p>
							</div>
						</div>
					<?php }
						} ?>

					<div class="col-md-3 col-xs-4 center padding-10">
						<strong class="nbValidated" style="font-size:25px;color:#27b3e2;"><?php echo $nbValidate; ?></strong> / <strong><?php echo $quantity;?></strong> <?php echo Yii::t("need","HELPER",null,Yii::app()->controller->module->id); if ($quantity > 1) echo "S" ?>
					</div>
					<?php if($quantity==($nbToConfirm+$nbValidate)){ ?>
						<div class="col-md-12 center"> 
							<p style="font-variant: small-caps;font-size: 15px;font-style: italic;"> <?php echo Yii::t("need","Need has enough helpers !!",null,Yii::app()->controller->module->id); ?> </p>
						</div>
					<?php }else{ ?>
						<div class="col-md-12 center"> 
							<p style="font-variant: small-caps;font-size: 15px;font-style: italic;"> <?php echo Yii::t("need","Contribute to the project ansering  to this need !!",null,Yii::app()->controller->module->id); ?> </p>
						</div>
						<div class="col-md-12 center padding-10"> 
							<a href="javascript:;" class="new-proposal btn btn-info"></i> <?php echo Yii::t("need","Involve me",null,Yii::app()->controller->module->id); ?> </a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
var admin= <?php if(isset($isAdmin) && !empty($isAdmin)) echo $isAdmin; else echo 0 ?>;
var needId= "<?php echo $needId; ?>";
var quantity = <?php echo $nbValidate ?>;

jQuery(document).ready(function(){
	if (admin==1){
		$(".helperBoxToValidate").mouseenter(function(){
			if($(this).find(".confirmBtn").length){
				$(this).find(".confirmBtn").fadeIn();
				acceptHelp();
			}
		}).mouseleave(function(){
			if($(this).find(".confirmBtn").length){
				$(this).find(".confirmBtn").fadeOut();
			}			
		});
	}
	helpProposal();
});
function helpProposal(){
$(".new-proposal").off().on("click",function () {
	        //$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
	        bootbox.confirm("<?php echo Yii::t("common","Are you sure you want to help for this need")?> <span class='text-red'><?php echo $name; ?></span>?", 
			function(result) {
					if (result) {
						$.ajax({
					        type: "POST",
					        url: baseUrl+"/"+moduleId+"/need/addhelpervalidation/needId/"+needId+"/booleanState/0/",
					       	dataType: "json",
				        	success: function(data){
					        	console.log(data);
					        	if ( data && data.result ) {               
						       	 	toastr.info(data.msg);
						       	 	addAttentConfirmBox(data.helper, 0);
						        } else {
						           toastr.info(data.msg);
						          // $(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
						        }
						    }
						});
					}
				}
			)
		});
}
function acceptHelp(){
$(".acceptHelp").off().on("click",function () {
	var idHelper = $(this).data("id");
	        //$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
	        bootbox.confirm("<?php echo Yii::t("common","Are you sure to confirm the help from")?> <span class='text-red'>"+$(this).data("name")+"</span>?", 
			function(result) {
					if (result) {
						$.ajax({
					        type: "POST",
					        url: baseUrl+"/"+moduleId+"/need/addhelpervalidation/needId/"+needId+"/helperId/"+idHelper+"/booleanState/1/",
					       	dataType: "json",
				        	success: function(data){
					        	console.log(data);
					        	if ( data && data.result ) {               
						       	 	toastr.info(data.msg);
						       	 	addAttentConfirmBox(data.helper,1);
						        } else {
						           toastr.info(data.msg);
						          // $(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
						        }
						    }
						});
					}
				}
			)
		});
}
function addAttentConfirmBox(helper, bool){
	if(bool == 0){
		console.log(helper);
		divHelper = '<div class="col-md-3 col-xs-4 center padding-10 helperBox'+helper._id["$id"]+'">'+
						'<a href="javascript:;" onclick="loadByHash(\'#person.detail.id.'+helper._id["$id"]+'\')" title="wait for validation">';
						if(typeof(helper.imagePath) != "undefined") { 
							divHelper += '<img width="50" height="50" alt="image" class="img-circle grayscale" src="'+baseUrl+'/'+moduleId+'/document/resized/50x50'+helper.imagePath+'">';
						}else{ 
							divHelper += '<i class=\"fa fa-smile-o fa-2x\"></i>';
							} 
		divHelper+='</a></div>';
		$(".helperBoxEmpty:first").replaceWith(divHelper);
	}
	else {
		divHelper='<div class="col-md-3 col-xs-4 center padding-10 helperBox">'+
						'<a href="javascript:;" onclick="loadByHash(\'#person.detail.id.'+helper._id["$id"]+'\')" title="validated">';
						if(typeof(helper.imagePath) != "undefined") { 
							divHelper += '<img width="50" height="50" alt="image" class="img-circle" src="'+baseUrl+'/'+moduleId+'/document/resized/50x50'+helper.imagePath+'">';
						}else{ 
							divHelper += '<i class=\"fa fa-smile-o fa-2x\"></i>';
							} 
		divHelper+='</a></div>';
		$(".helperBox"+helper._id["$id"]+"").replaceWith(divHelper);
		plusUnPlusUn=quantity+1;
		$(".nbValidated").fadeOut("slow",function() {
			$(this).text(plusUnPlusUn).fadeIn("slow");
		});
	}
	
}
</script>
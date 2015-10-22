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
		<div class="panel-heading border-light">
			<h4 class="panel-title"><i class="fa fa-users fa-2x text-green"></i> <?php echo Yii::t("need","HELPERS",null,Yii::app()->controller->module->id); ?></h4>
			<div class="panel-tools">
				<?php $admin = false;
					if(isset(Yii::app()->session["userId"]) && isset($_GET["id"]))
						$admin = Authorisation::canEditItem(Yii::app()->session["userId"], $_GET["type"], (string)$_GET["id"]);
					if($admin){
     				?>	
					<?php } ?>
				<div class="dropdown">
					<a class="btn btn-xs dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
						<i class="fa fa-cog"></i>
					</a>
					<ul role="menu" class="dropdown-menu dropdown-light pull-right">
						<li>
							<a href="#" class="panel-collapse collapses"><i class="fa fa-angle-up"></i> 								<span>Collapse</span> </a>
						</li>
						<li>
							<a href="#" class="panel-refresh">
								<i class="fa fa-refresh"></i> <span>Refresh</span>
							</a>
						</li>
						<li>
							<a data-toggle="modal" href="#panel-config" class="panel-config">
								<i class="fa fa-wrench"></i> <span>Configurations</span>
							</a>
						</li>
						<li>
							<a href="#" class="panel-expand">
								<i class="fa fa-expand"></i> <span>Fullscreen</span>
							</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn btn-xs btn-link panel-close">
					<i class="fa fa-times"></i>
				</a>
			</div>
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
									<a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard/id/".(string)$val["_id"])?>" title="validated">
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
									<a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard/id/".(string)$val["_id"])?>" title="wait for validation">
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
						<strong class="nbValidated" style="font-size:25px;color:#27b3e2;"><?php echo $nbValidate; ?></strong> / <strong><?php echo $quantity;?></strong> <?php echo Yii::t("need","HELPERS",null,Yii::app()->controller->module->id); ?>
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
var admin= <?php if(isset($admin) && !empty($admin))	echo $admin; else echo 0 ?>;
var needId= "<?php echo $_GET["idNeed"]; ?>";
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
	        bootbox.confirm("Are you sure you want to help for this need <span class='text-red'><?php echo $name; ?></span>?", 
			function(result) {
					if (result) {
						$.ajax({
					        type: "POST",
					        url: baseUrl+"/"+moduleId+"/needs/addhelpervalidation/needId/"+needId+"/booleanState/0/",
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
	        bootbox.confirm("Are you sure you want the help from <span class='text-red'>"+$(this).data("name")+"</span>?", 
			function(result) {
					if (result) {
						$.ajax({
					        type: "POST",
					        url: baseUrl+"/"+moduleId+"/needs/addhelpervalidation/needId/"+needId+"/helperId/"+idHelper+"/booleanState/1/",
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
						'<a href="'+baseUrl+'/'+moduleId+'/person/dashboard/id/'+helper._id["$id"]+'" title="wait for validation">';
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
						'<a href="'+baseUrl+'/'+moduleId+'/person/dashboard/id/'+helper._id["$id"]+'" title="validated">';
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
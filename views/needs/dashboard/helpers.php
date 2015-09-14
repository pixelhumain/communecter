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
			<h4 class="panel-title"><i class="fa fa-users fa-2x text-green"></i> HELPERS</h4>
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
				<!--<ul id="myTab" class="nav nav-tabs">
					<li class="active">
						<a href="#users_tab_attending" data-toggle="tab">
							<span><i class="fa fa-child"></i>
							Helpers
							</span>
						</a>
					</li>
				</ul>-->
				
				<div class="tab-content partition-white">
					<?php
					$nbValidate=0; 
					if(!empty($helpers)){
						$i=0;
						foreach ($helpers as $id => $val){
							if($val["isValidated"] == 1){ ?>
								<div class="col-md-3 col-xs-4 center padding-10 helperBox">
								<?php if(isset($val["imagePath"])) { ?>
									<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$val['imagePath']) ?>">
								<?php } else{ 
									echo "<i class=\"fa fa-smile-o fa-2x\"></i>";
								} ?>
								</div>
							<?php 
								$nbValidate++;	
							}
							else{ ?>
								<div class="col-md-3 col-xs-4 center padding-10 helperBox">
									<a href="javascript:;" class="refuseHelp">
										<i class="fa fa-times-circle refuseBtn confirmBtn"></i>
									</a>
									<a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard/id/".(string)$val["_id"])?>">
									<?php if(isset($val["imagePath"])) { ?>
									<img width="50" height="50" alt="image" class="img-circle grayscale" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$val['imagePath']) ?>">
									<?php } else{ 
												echo "<i class=\"fa fa-smile-o fa-2x\"></i>";
											} ?>
									<a href="javascript:;" class="acceptHelp" data-id="<?php echo (string)$val["_id"]; ?>" data-name="<?php echo $val["name"]; ?>">
										<i class="fa fa-check-circle validateBtn confirmBtn"></i>
									</a>
								</div>
								
							<?php }
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
						<strong style="font-size:25px;color:#27b3e2;"><?php echo $nbValidate; ?></strong> / <strong><?php echo $quantity;?></strong> HELPERS
					</div>
					<div class="col-md-12 center"> 
						<p style="font-variant: small-caps;font-size: 15px;font-style: italic;"> Contribuez au projet en répondant à ce besoin !! </p>
					</div>
					<div class="col-md-12 center padding-10"> 
						<a href="javascript:;" class="new-proposal btn btn-info"></i> Se proposer </a>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
admin= <?php echo $admin; ?>;
needId= "<?php echo $id; ?>";
jQuery(document).ready(function(){
	if (admin==1){
		$(".helperBox").mouseenter(function(){
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
						alert(result);
						$.ajax({
					        type: "POST",
					        url: baseUrl+"/"+moduleId+"/needs/addhelpervalidation/needId/"+needId+"/booleanState/0/",
					       	dataType: "json",
				        	success: function(data){
					        	console.log(data);
					        	if ( data && data.result ) {               
						       	 	toastr.info("HELP SUCCESFULLY ADD!! WAIT fOR VALIDATION");
						       	 	//addAttentConfirmBox();
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
	        bootbox.confirm("Are you sure you want the help help <span class='text-red'>"+$(this).data("name")+"</span>?", 
			function(result) {
					if (result) {
						alert(idHelper);
						$.ajax({
					        type: "POST",
					        url: baseUrl+"/"+moduleId+"/needs/addhelpervalidation/needId/"+needId+"/helperId/"+idHelper+"/booleanState/1/",
					       	dataType: "json",
				        	success: function(data){
					        	console.log(data);
					        	if ( data && data.result ) {               
						       	 	toastr.info("HELP IS VALIDATED");
						       	 	//addAttentConfirmBox();
						        } else {
						           toastr.info("something went wrong!! please try again.");
						          // $(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
						        }
						    }
						});
					}
				}
			)
		});
}
</script>
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
					<?php //for ($i=0; $i<$quantity;$i++){ ?>
						<div class="col-md-3 col-xs-4 center padding-10 helperBox">
							<img width="50" height="50" alt="image" class="img-circle" src="/pixelhumain/ph/communecter/document/resized/50x50/upload/communecter/citoyens/555a124b126e9a6f6600000d/famillesuricate4.jpg">
						</div>
						<div class="col-md-3 col-xs-4 center padding-10 helperBox">
							<a href="#" class="refuseHelp">
								<i class="fa fa-times-circle refuseBtn confirmBtn"></i>
							</a>
							<img width="50" height="50" alt="image" class="img-circle grayscale" src="/pixelhumain/ph/communecter/document/resized/50x50/upload/communecter/citoyens/555a124b126e9a6f6600000d/famillesuricate4.jpg">
							<a href="#" class="acceptHelp">
								<i class="fa fa-check-circle validateBtn confirmBtn"></i>
							</a>
						</div>
						<div class="col-md-3 col-xs-4 center padding-10 helperBox">
							<!--<img width="50" height="50" alt="image" class="img-circle grayscale" src="/pixelhumain/ph/communecter/document/resized/50x50/upload/communecter/citoyens/555a124b126e9a6f6600000d/famillesuricate4.jpg">-->
							<div class="img-circle" style="height: 50px;width: 50px;border: 3px solid gray;margin:auto;">
	    	<p style="line-height: 45px; font-size: 25px;"> ? </p>
							</div>

						</div>
					<?php // } ?>
					<div class="col-md-3 col-xs-4 center padding-10">
						<strong style="font-size:25px;color:#27b3e2;">1</strong> / <strong>3</strong> HELPERS
					</div>
					<div class="col-md-12 center"> 
						<p style="font-variant: small-caps;font-size: 15px;font-style: italic;"> Contribuez au projet en répondant à ce besoin !! </p>
					</div>
					<div class="col-md-12 center padding-10"> 
						<a class="new-proposal btn btn-info" href="#newProposal"></i> Se proposer </a>
					</div>
					<?php if (isset($helpers)){ ?>
					<div class="tab-pane padding-bottom-5 active" id="users_tab_attending">
						<div class="panel-scroll height-230 ps-container">
							<table class="table table-striped table-hover">
								<tbody id="tContributor">
									<?php
										foreach ($contributors as $member) { ?>
									<tr id="contributor<?php echo $member["_id"]; ?>">
										<td class="center">
										<?php if($member && isset($member["imagePath"])) { ?>
											<img width="50" height="50"  alt="image" class="img-circle" src="<?php echo $member["imagePath"]; ?>"></td>
										<?php } else{ 
												if ($member["type"]=="citoyen"){?>
													<i class="fa fa-smile-o fa-2x"></i></td>
												<?php }else{ ?>
													<i class="fa fa-group fa-2x"></i></td>
										<?php	} 
											} ?>
										<td><span class="text-small block text-light"><?php if ($member && isset($member["position"])) echo $member["position"]; ?></span><span class="text-large"><?php echo $member["name"]; ?></span><a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard/id/".$member['_id'])?>" class="btn"><i class="fa fa-chevron-circle-right"></i></a></td>
										<?php if ( $admin ){ ?>
											<td>
												<a href="javascript:;" class="disconnectBtnContributor btn btn-xs btn-red tooltips " data-placement="left"  data-type="<?php if ($member["type"]=="citoyen") echo PHType::TYPE_CITOYEN; else echo  Organization::COLLECTION; ?>" data-id="<?php echo $member['_id'];?>" data-name="<?php echo $member["name"]; ?>" data-placement="top" data-original-title="Remove this organization" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
											</td>
										<?php } ?>
									</tr>
									<?php } 
																			?>
								</tbody>
							</table>
						<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: -14px; width: 504px; display: none;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 17px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 11px; height: 152px;"></div></div></div>
					</div>
					<?php } else{ ?>
					<!--<div id="infoPodOrga" class="padding-10">
						<blockquote> 
							Create needs
							<br>Materials  
							<br>Knowledge
							<br>Skills
							<br>to call ressources that you need
						</blockquote>
					</div>-->		
					<?php	} ?>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
admin= <?php echo $admin; ?>;
jQuery(document).ready(function(){
	if (admin==1){
		$(".helperBox").mouseenter(function(){
			if($(this).find(".confirmBtn").length){
				$(this).find(".confirmBtn").fadeIn();
			}
		}).mouseleave(function(){
			if($(this).find(".confirmBtn").length){
				$(this).find(".confirmBtn").fadeOut();
			}			
		});
	}
});
</script>
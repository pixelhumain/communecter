
	<div class="panel panel-white">
		<div class="panel-heading border-light">
			<h4 class="panel-title"><i class="fa fa-users fa-2x text-green"></i> Participants</h4>
			<div class="panel-tools">
				<div class="dropdown">
					<a class="btn btn-xs dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
						<i class="fa fa-cog"></i>
					</a>
					<ul role="menu" class="dropdown-menu dropdown-light pull-right">
						<li>
							<a href="#" class="panel-collapse collapses"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
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
			<div class="tabbable no-margin no-padding partition-dark">
				<ul id="myTab" class="nav nav-tabs">
					<li class="active">
						<a href="#users_tab_attending" data-toggle="tab">
							<span><i class="fa fa-child"></i>
							Attending
							</span>
						</a>
					</li>
				</ul>
				<div class="tab-content partition-white">
					<div class="tab-pane padding-bottom-5 active" id="users_tab_attending">
						<div class="panel-scroll height-230 ps-container">
							<table class="table table-striped table-hover">
								<tbody>
									<?php foreach ($attending as $member) { ?>
									<tr>
										<td class="center">
										<?php if($member && isset($member["imagePath"])) { ?>
											<img width="50" height="50"  alt="image" class="img-circle" src="<?php echo $member["imagePath"]; ?>"></td>
										<?php } else{ ?>
											<i class="fa fa-smile-o fa-2x"></i></td>
										<?php } ?>
										<td><span class="text-small block text-light"><?php if ($member && isset($member["position"])) echo $member["position"]; ?></span><span class="text-large"><?php echo $member["name"]; ?></span><a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard/id/".$member['_id'])?>" class="btn"><i class="fa fa-chevron-circle-right"></i></a></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: -14px; width: 504px; display: none;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 17px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 11px; height: 152px;"></div></div></div>
					</div>
				</div>
			</div>
		</div>
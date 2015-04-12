	
	
<div class="panel panel-white">
		<div class="panel-heading border-light">
			<h4 class="panel-title">About me</h4>
		</div>
		<div class="panel-tools">
			<a href="#" class="panel-collapse collapses" id="followBtn"><i class="fa fa-heart text-pink"></i> <span>Follow me</span> </a>
			
			<a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i> <span>Editer</span></a>
			<a href="#" class="btn btn-xs btn-link panel-close">
				<i class="fa fa-times"></i>
			</a>
		</div>
		<div class="panel-body no-padding">
			<div class="user-left">
				<h4><?php //echo Yii::app()->session["user"]["name"]?></h4>
				<!---->
				<table class="table table-condensed table-hover" >
					<thead>
						<tr>
							<th colspan="3">Information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>DummyData</td>
							<td>
								<?php 
								if( !Admin::checkInitData( PHType::TYPE_CITOYEN, "personNetworkingAll" ) ){ ?>
									<a href="<?php echo Yii::app()->createUrl("/communecter/person/InitDataPeopleAll") ?>" class="btn btn-xs btn-red  pull-right" ><i class="fa fa-plus"></i> InitData : Dummy People</a>
								<?php } else { ?>
									<a href="<?php echo Yii::app()->createUrl("/communecter/person/clearInitDataPeopleAll") ?>" class="btn btn-xs btn-red  pull-right" ><i class="fa fa-plus"></i> Remove Dummy People</a>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td>url</td>
							<td><a href="#"><?php if(isset($person["url"]))echo $person["url"];?></a></td>
						</tr>
						<tr>
							<td>email</td>
							<td><a href=""><?php echo Yii::app()->session["userEmail"];?></a></td>
						</tr>
						<tr>
							<td>phone</td>
							<td><?php if(isset($person["phoneNumber"]))echo $person["phoneNumber"];?></td>
						</tr>
						<tr>
							<td>skype</td>
							<td><?php if(isset($person["skype"]))echo $person["skype"];?></td>
						</tr>
					</tbody>
				</table>
				<hr>
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th colspan="3">General information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Position</td>
							<td>UI Designer</td>
						</tr>
						<tr>
							<td>Position</td>
							<td>Senior Marketing Manager</td>
						</tr>
						<tr>
							<td>Supervisor</td>
							<td>
							<a href="#">
								<?php if(isset($person["supervisor"]))echo $person["supervisor"];?>
							</a></td>
						</tr>
					</tbody>
				</table>
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th colspan="3">Additional information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Birth</td>
							<td><?php if(isset($person["birth"]))echo $person["birth"];?></td>
							
						</tr>
						<tr>
							<td>Tags</td>
							<td><?php if(isset($person["tags"]))echo implode(",", $person["tags"]);?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-4 col-md-12">
	<div class="panel panel-white">
		<div class="panel-heading border-light">
			<h4 class="panel-title">Annuaire</h4>
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
						<a href="#users_tab_person" data-toggle="tab">
							<span><i class="fa fa-child"></i>
							Knows
							</span>
						</a>
					</li>
					<li class="">
						<a href="#users_tab_organisation" data-toggle="tab">
							<span><i class="fa fa-group"></i>
							MemberOf
							</span>
						</a>
					</li>
				</ul>
				<div class="tab-content partition-white">
					<div class="tab-pane padding-bottom-5 active" id="users_tab_person">
						<div class="panel-scroll height-230 ps-container">
							<table class="table table-striped table-hover">
								<tbody>
									<?php foreach ($people as $member) { ?>
									<tr>
										<td class="center"><img width="50" height="50"  alt="image" class="img-circle" src="<?php if ($member && isset($member["imagePath"])) echo $member["imagePath"]; else echo Yii::app()->theme->baseUrl.'/assets/images/avatar-1-xl.jpg'; ?>"></td>
										<td><span class="text-small block text-light"><?php if ($member && isset($member["position"])) echo $member["position"]; ?></span><span class="text-large"><?php echo $member["name"]; ?></span><a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard/id/".$member['_id'])?>" class="btn"><i class="fa fa-chevron-circle-right"></i></a></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: -14px; width: 504px; display: none;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 17px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 11px; height: 152px;"></div></div></div>
					</div>
					<div class="tab-pane padding-bottom-5" id="users_tab_organisation">
						<div class="panel-scroll height-230 ps-container">
							<table class="table table-striped table-hover">
								<tbody>
									<?php if(isset($organizations)){foreach ($organizations as $member) { ?>
									<tr>
										<td class="center"><img width="50" height="50" alt="image" class="img-circle" src="<?php if ($member && isset($member["imagePath"])) echo $member["imagePath"]; else echo Yii::app()->theme->baseUrl.'/assets/images/avatar-1-xl.jpg'; ?>"></td>
										<td><span class="text-small block text-light"><?php if ($member && isset($member["type"])) echo $member["type"]; ?></span><span class="text-large"><?php echo $member["name"]; ?></span><a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/organization/dashboard/id/".$member['_id'])?>" class="btn"><i class="fa fa-chevron-circle-right"></i></a></td>
									</tr>
									<?php }}?>
								</tbody>
							</table>
						<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
					</div>
				</div>
			</div>
		</div>
	</div>
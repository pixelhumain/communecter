<style>	
.nav-tabs.nav-justified > li > a {
    border-bottom: 0px;
}
</style>
			<?php 
				$me = Person::getById(Yii::app()->session["userId"]);
				if(isset($me['profilThumbImageUrl']) && $me['profilThumbImageUrl'] != "")
			      $urlPhotoProfil = Yii::app()->getRequest()->getBaseUrl(true).$me['profilThumbImageUrl'];
			    else
			      $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
			?>

 			<!-- Nav tabs -->
			<ul class="nav nav-tabs nav-justified nav-menu-rooms" role="tablist">
			  <li class="active"><a href="#discussions" role="tab" data-toggle="tab"><i class="fa fa-comments"></i> <?php echo Yii::t("rooms", "Discuss", null, Yii::app()->controller->module->id); ?> <span class="label label-default"><?php echo (isset($discussions)) ? count($discussions)  : 0?> </span></a></li>
			  <li><a href="#votes" role="tab" data-toggle="tab"><i class="fa fa-archive"></i> <?php echo Yii::t("rooms", "Decide", null, Yii::app()->controller->module->id); ?> <span class="label label-default"><?php echo (isset($votes)) ? count($votes) : 0?></span> </a></li>
			  <li><a href="#actions" role="tab" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo Yii::t("rooms", "Act", null, Yii::app()->controller->module->id); ?> <span class="label label-default"><?php echo (isset($actions)) ? count($actions) : 0?></span> </a></li>
			  <li><a href="#history" role="tab" data-toggle="tab"><!-- <i class="fa fa-user"></i>  -->
			  <img src="<?php //echo Yii::t("rooms", "My Activity", null, Yii::app()->controller->module->id); 
			  			echo $urlPhotoProfil;?>"
			  		id="img-profil-tab"> 
			  <span class="label label-default"><?php echo (isset($history)) ? count($history) : 0?></span> </a></li>
			  <!-- <li><a href="#settings" role="tab" data-toggle="tab">Settings</a></li> -->
			</ul>

			<!-- Tab panes -->
			<div class="tab-content " id="ddaIndexContainer">
			  <div class="tab-pane active col-lg-12 col-md-12" id="discussions">
	  			<table class="table table-striped table-bordered table-hover directoryTable ">
					<thead class="">
						<tr>
							<th><i class="fa fa-caret-down"></i> <?php echo Yii::t("rooms", "Espaces de discussions", null, $moduleId); ?></th>
							<th class="hidden"><?php echo Yii::t("rooms", "Type", null, $moduleId); ?></th>
							<th class="hidden"><i class="fa fa-file-text"></i> <?php echo Yii::t("rooms", "Entries", null, $moduleId); ?></th>
							<th class="hidden"><i class="fa fa-group"></i> <?php echo Yii::t("rooms", "Participants", null, $moduleId); ?></th>
							<?php if( $_GET["type"] == Person::COLLECTION ){?>
								<th class=""><i class="fa fa-link"></i> <?php echo Yii::t("rooms", "Element", null, $moduleId); ?></th>
							<?php } ?>
							<th class="hidden-xs"><i class="fa fa-clock-o"></i> <?php echo Yii::t("rooms", "Created", null, $moduleId); ?></th>
						</tr>
					</thead>
					<tbody class="directoryLines">
						<?php 
						$memberId = Yii::app()->session["userId"];
						$memberType = Person::COLLECTION;
						
						$parentLinkList = array();
						/* **************************************
						*	rooms
						***************************************** */
						if(isset($discussions)) 
						{ 
							foreach ($discussions as $e) 
							{ ?>
								<tr class="tr-room" id="<?php echo ActionRoom::COLLECTION.(string)$e["_id"];?>">
									<?php 
										$type = "comment.index.type.actionRooms";
										$icon = "comments";
										if( $e["type"] == ActionRoom::TYPE_FRAMAPAD ){
											$type = "rooms.external";
											$icon = "file-text-o";
										}
										//$link = Yii::app()->createUrl('/'.$this->module->id.'/'.$type.'/id/'.$e["_id"])
										$link = "loadByHash('#".$type.".id.".$e["_id"]."')";
										$link = 'href="javascript:;" onclick="'.$link.'"';
										$iconColor = ( @$e["status"] == ActionRoom::STATE_ARCHIVED ) ? "text-red" : "text-dark";
										?>
									<td class="center organizationLine hidden">
										<i class="fa fa-<?php echo @$icon ?> fa-2x"></i> <?php //if(isset($e["type"]))echo $e["type"]?> 
									</td>
									<td><i class="fa <?php echo @$iconColor ?> fa-<?php echo @$icon ?> fa-2x" style="width:25px;text-align:center;"></i> <a class="entryname" <?php echo $link;?> ><?php if(isset($e["name"]))echo $e["name"]?></a></td>
									<td class="hidden"><i class="fa fa-file-text"></i> <?php echo PHDB::count(Survey::COLLECTION,array('survey'=>(string)$e["_id"])) ?> <?php //echo Yii::t("rooms", "propositions", null, $moduleId); ?></td>
									<td class="hidden"><i class="fa fa-users"></i> //<?php echo PHDB::count(Survey::COLLECTION,array('survey'=>(string)$e["_id"])) ?> <?php //echo Yii::t("rooms", "propositions", null, $moduleId); ?></td>
									
									<?php if( $_GET["type"] == Person::COLLECTION ){?>
										<td class=""> <?php 
											if( !@$parentLinkList[ @$e["parentType"]."_".@$e["parentId"] ] ) 
												@$parentLinkList[ @$e["parentType"]."_".@$e["parentId"] ] = "<a href='javascript:;' onclick='loadByHash(\"#rooms.index.type.".@$e["parentType"].".id.".@$e["parentId"]."\")'>".@$e['name']."</a>";
											echo @$parentLinkList[ @$e["parentType"]."_".@$e["parentId"] ]; ?>
										</td>
									<?php } ?>
									<td><?php if(isset($e["created"]))echo date("d/m/y",$e["created"])?></td>
								</tr>
							<?php
						}}
						?>
						
					</tbody>
				</table>
			  </div>
			  <div class="tab-pane" id="votes">
			  	<table class="table table-striped table-bordered table-hover  directoryTable ">
					<thead class="">
						<tr>
							<th><i class="fa fa-caret-down"></i> <?php echo Yii::t("rooms", "Espaces de décisions", null, $moduleId); ?></th>
							<th class="hidden"><?php echo Yii::t("rooms", "Type", null, $moduleId); ?></th>
							<th class=""><i class="fa fa-file-text"></i> <?php echo Yii::t("rooms", "Entries", null, $moduleId); ?></th>
							<th class="hidden"><i class="fa fa-group"></i> <?php //echo Yii::t("rooms", "Participants", null, $moduleId); ?></th>
							
							<?php if( $_GET["type"] == Person::COLLECTION ){?>
								<th class=""><i class="fa fa-link"></i> <?php echo Yii::t("rooms", "Element", null, $moduleId); ?></th>
							<?php } ?>
							<th class="hidden-xs"><i class="fa fa-clock-o"></i> <?php echo Yii::t("rooms", "Created", null, $moduleId); ?></th>
						</tr>
					</thead>
					<tbody class="directoryLines">
						<?php 
						/* **************************************
						*	rooms
						***************************************** */
						if(isset($votes)) 
						{ 
							foreach ($votes as $e) 
							{  ?>
							<tr class="tr-room" id="<?php echo ActionRoom::COLLECTION.(string)$e["_id"];?>">
								<?php 
									$type = "survey.entries";
									$icon = "archive";
									
									//$link = Yii::app()->createUrl('/'.$this->module->id.'/'.$type.'/id/'.$e["_id"])
									$link = "loadByHash('#".$type.".id.".$e["_id"]."')";
									$link = 'href="javascript:;" onclick="'.$link.'"';
									$iconColor = ( @$e["status"] == ActionRoom::STATE_ARCHIVED ) ? "text-red" : "text-dark";
								?>
								<td class="center organizationLine hidden">
									<i class="fa  fa-<?php echo @$icon ?> fa-2x"></i> <?php //if(isset($e["type"]))echo $e["type"]?> 
								</td>
								<td><i class="fa <?php echo $iconColor ?> fa-<?php echo @$icon ?> fa-2x" style="width:25px;text-align:center;"></i> <a class="entryname" <?php echo $link;?> ><?php if(isset($e["name"]))echo $e["name"]?>xxxx</a></td>
								<td class=""><i class="fa fa-file-text"></i> <?php echo PHDB::count(Survey::COLLECTION,array('survey'=>(string)$e["_id"])) ?> <?php //echo Yii::t("rooms", "propositions", null, $moduleId); ?></td>
								
								<td class="hidden"><i class="fa fa-users"></i> //<?php //echo PHDB::count(Survey::COLLECTION,array('survey'=>(string)$e["_id"])) ?> <?php //echo Yii::t("rooms", "propositions", null, $moduleId); ?></td>
								
								<?php if( $_GET["type"] == Person::COLLECTION ){?>
									<td class=""> <?php 
										if( !@$parentLinkList[ @$e["parentType"]."_".@$e["parentId"] ] ) 
											@$parentLinkList[ @$e["parentType"]."_".@$e["parentId"] ] = "<a href='javascript:;' onclick='loadByHash(\"#rooms.index.type.".@$e["parentType"].".id.".@$e["parentId"]."\")'>".@$e['name']."</a>";
										echo @$parentLinkList[ @$e["parentType"]."_".@$e["parentId"] ]; ?>
									</td>
								<?php } ?>
								<td><?php if(isset($e["created"]))echo date("d/m/y",$e["created"])?></td>
							</tr>
						<?php
						}}
						?>
						
					</tbody>
				</table>	
			  </div>
			  <div class="tab-pane" id="actions">
			  	<table class="table table-striped table-bordered table-hover  directoryTable ">
					<thead class="">
						<tr>
							<th><i class="fa fa-caret-down"></i> <?php echo Yii::t("rooms", "Action Lists", null, $moduleId); ?></th>
							<th class="hidden"><?php echo Yii::t("rooms", "Type", null, $moduleId); ?></th>
							<th class=""><i class="fa fa-file-text"></i> <?php echo Yii::t("rooms", "Actions", null, $moduleId); ?></th>
							<th class="hidden"><i class="fa fa-group"></i> <?php //echo Yii::t("rooms", "Participants", null, $moduleId); ?></th>
							
							<?php if( $_GET["type"] == Person::COLLECTION ){?>
								<th class=""><i class="fa fa-link"></i> <?php echo Yii::t("rooms", "Element", null, $moduleId); ?></th>
							<?php } ?>
							<th class="hidden-xs"><i class="fa fa-clock-o"></i> <?php echo Yii::t("rooms", "Created", null, $moduleId); ?></th>
						</tr>
					</thead>
					<tbody class="directoryLines">
						<?php 
						/* **************************************
						*	rooms
						***************************************** */
						if(isset($actions)) 
						{ 
							foreach ($actions as $e) 
							{  ?>
							<tr class="tr-room" id="<?php echo ActionRoom::COLLECTION.(string)$e["_id"];?>">
								<?php 
									$type = "rooms.actions";
									$icon = "cogs";
									$iconColor = ( @$e["status"] == ActionRoom::STATE_ARCHIVED ) ? "text-red" : "text-dark";
									
									$link = "loadByHash('#".$type.".id.".$e["_id"]."')";
									$link = 'href="javascript:;" onclick="'.$link.'"';
									?>
								<td class="center organizationLine hidden">
									<i class="fa fa-<?php echo @$icon ?> fa-2x"></i> 
								</td>
								<td><i class="fa <?php echo $iconColor ?> fa-<?php echo @$icon ?> " style="width:25px;text-align:center;"></i> <a class="entryname" <?php echo $link;?> ><?php if(isset($e["name"]))echo $e["name"]?></a></td>
								<td class=""><i class="fa fa-bars"></i> <?php echo PHDB::count(ActionRoom::COLLECTION_ACTIONS,array('room'=>(string)$e["_id"])) ?> <?php //echo Yii::t("rooms", "propositions", null, $moduleId); ?></td>
								<td class="hidden"><i class="fa fa-users"></i> //<?php //echo PHDB::count(Survey::COLLECTION,array('survey'=>(string)$e["_id"])) ?> <?php //echo Yii::t("rooms", "propositions", null, $moduleId); ?></td>
								
								<?php if( $_GET["type"] == Person::COLLECTION ){?>
									<td class=""> <?php 
										if( !@$parentLinkList[ @$e["parentType"]."_".@$e["parentId"] ] ) 
											@$parentLinkList[ @$e["parentType"]."_".@$e["parentId"] ] = "<a href='javascript:;' onclick='loadByHash(\"#rooms.index.type.".@$e["parentType"].".id.".@$e["parentId"]."\")'>".@$e['name']."</a>";
										echo @$parentLinkList[ @$e["parentType"]."_".@$e["parentId"] ]; ?>
									</td>
								<?php } ?>
								<td><?php if(isset($e["created"]))echo date("d/m/y",$e["created"])?></td>
							</tr>
						<?php
						}}
						?>
						
					</tbody>
				</table>	
			  </div>
			  
			  <div class="tab-pane col-lg-12 col-md-12" id="history">
			  	<?php if(count(@$history)){ ?>
						<div class="actionsTable infoTables" style="padding-top:7px;">	
							<!-- <h1 class="homestead text-orange" style="text-align: right;"><?php echo Yii::t("rooms", "All your Actions", null, $moduleId); ?> <i class="fa  fa-chevron-circle-down"></i></h1> -->
							<table class="table table-striped table-bordered table-hover directoryTable  ">
								<thead>
									<tr>
										<th class="hidden"><?php echo Yii::t("rooms", "Titre", null, $moduleId); ?></th>
										<th><i class="fa fa-caret-down"></i> <?php echo Yii::t("rooms", "Propositions", null, $moduleId); ?></th>
										<th class=""><i class="fa fa-group"></i> <?php echo Yii::t("rooms", "Participants", null, $moduleId); ?></th>
										<th class="hidden"><i class="fa fa-clock-o"></i> <?php echo Yii::t("rooms", "Start Date", null, $moduleId); ?></th>
										<th class="hidden-xs"><i class="fa fa-clock-o"></i> <?php echo Yii::t("rooms", "End Date", null, $moduleId); ?></th>
										<th class="hidden"><?php echo Yii::t("rooms", "Action", null, $moduleId); ?></th>
									</tr>
								</thead>
								<tbody class="directoryLines">
									<?php
									/* **************************************
									*	rooms
									***************************************** */
									if(isset($history) && $history != null && !empty($history)) 
									{ 
										foreach ($history as $e) 
										{ 
										if(isset($e["_id"]) && isset($e["name"])){ ?>

										<tr id="<?php echo ActionRoom::COLLECTION.(string)$e["_id"];?>">
											<td class="center organizationLine hidden">
												<?php 
												$type = "survey.entry";
												$icon = "bookmark";
												$link = Yii::app()->createUrl('/'.$this->module->id.'/'.$type.'/id/'.$e["_id"]);
												$link = "loadByHash('#".$type.".id.".$e["_id"]."')";
												$link = 'href="javascript:;" onclick="'.$link.'"';
												?>
												<a <?php echo $link;?>>
													<?php if ($e && isset($e["imagePath"])){ ?>
														<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>"> <?php if(isset($e["type"]))echo $e["type"]?>
													<?php } else { ?>
														<i class="fa fa-<?php echo $icon ?> fa-2x"></i> <?php if(isset($e["type"]))echo $e["type"]?> 
													<?php } ?>
												</a>
											</td>
											<?php 
												if(isset($e["action"]))
												{
													$type = "";
													$choice = "";
													foreach ( $e["action"] as $key => $value) 
													{
														$type = $key;
														$choice = $value;
													}
												}

												if( $choice == Action::ACTION_COMMENT )
													$icon = "comment";
												else if( $choice == Action::ACTION_VOTE_UP )
													$icon = "thumbs-up";
												else if( $choice == Action::ACTION_VOTE_DOWN )
													$icon = "thumbs-down";
												else if( $choice == Action::ACTION_VOTE_ABSTAIN )
													$icon = "circle";
												else if( $choice == Action::ACTION_VOTE_UNCLEAR )
													$icon = "pencil";
												else if( $choice == Action::ACTION_VOTE_MOREINFO )
													$icon = "question-circle ";
												 ?>
												
											<td ><a class="entryname_vote" <?php echo $link;?>><i class="fa fa-<?php echo $icon ?> text-dark"></i> <?php if(isset($e["name"]))echo $e["name"]?></a></td>
											<?php 
											$participantCount = 0;
											if(isset( $e[Action::ACTION_VOTE_UP] ))
												$participantCount += count($e[Action::ACTION_VOTE_UP]);
											if(isset( $e[Action::ACTION_VOTE_DOWN] ))
												$participantCount += count($e[Action::ACTION_VOTE_DOWN]);
											if(isset( $e[Action::ACTION_VOTE_ABSTAIN] ))
												$participantCount += count($e[Action::ACTION_VOTE_ABSTAIN]);
											if(isset( $e[Action::ACTION_VOTE_UNCLEAR] ))
												$participantCount += count($e[Action::ACTION_VOTE_UNCLEAR]);
											if(isset( $e[Action::ACTION_VOTE_MOREINFO] ))
												$participantCount += count($e[Action::ACTION_VOTE_MOREINFO]);
											?>
											<td class=""><?php echo $participantCount ?></td>
											<td class="hidden"><?php if(isset($e["created"]))echo date("d/m/y",$e["created"])?></td>
											<td><?php if(isset($e["dateEnd"]))echo date("d/m/y",$e["dateEnd"]) ?></td>
											<td class="center hidden">
												<?php 
												if(isset($e["action"]))
												{
													$type = "";
													$choice = "";
													foreach ( $e["action"] as $key => $value) 
													{
														$type = $key;
														$choice = $value;
													}
												}

												 ?>
												<?php //echo $type ?> <i class="fa fa-<?php echo $icon ?> text-green"></i> 

											</td>
										</tr>
									<?php
										}};
									}

									?>

								</tbody>
							</table>
						</div>
					<?php } ?>
			  </div>
			</div>
			<div id="endOfRoom"></div>
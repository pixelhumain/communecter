<div class="panel panel-white">
		<div class="panel-heading border-light">
			<h4 class="panel-title"><i class="fa fa-users fa-2x text-green"></i> <?php echo Yii::t("event","Attendees",null,Yii::app()->controller->module->id); ?></h4>
		</div>
		<div class="panel-tools">
			<?php //if( Authorisation::isEventAdmin((string)$event['_id'], @Yii::app()->session["userId"])) { ?>
				<a href="#newAttendees" class="new-attendees btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" data-id="<?php echo  (string)$event["_id"] ?>" title="Add attendees" alt="Add attendees"><i class="fa fa-plus"></i> </a>
			<?php //} ?>
		</div>
		<?php if (isset($isDetailView)){ ?>
			<?php foreach ($attending as $member) { 
			?>
				<a href="javascript:;" onclick="loadByHash( '#person.detail.id.<?php echo $member['_id']?>')" title="<?php echo $member["name"];?>" class="btn block text-left">
				<?php if($member && isset($member["imagePath"])) { ?>
					<img width="30" height="30"  alt="image" class="" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/30x30'.$member['imagePath']) ?>"></td>
				<?php } else{ ?>
					<i class="fa fa-user fa-2x"></i>					
				<?php } ?>
					<?php if(isset($member["name"])) echo $member["name"]; ?>
					<?php if(isset($member["address"]["postalCode"])) echo ", <small>".$member["address"]["postalCode"]."</span>"; ?>
				</a>					
			<?php } ?>
		<?php }
		else { ?>
		<div class="panel-body no-padding">
			<div class="tabbable no-margin no-padding partition-dark">
				<ul id="myTab" class="nav nav-tabs">
					<li class="active">
						<a href="#users_tab_attending" data-toggle="tab">
							<span><i class="fa fa-child"></i>
							<?php echo Yii::t("event","Attending",null,Yii::app()->controller->module->id); ?>
							</span>
						</a>
					</li>
				</ul>
				<div class="tab-content partition-white">
					<div class="tab-pane padding-bottom-5 active" id="users_tab_attending">
						<table class="table table-striped table-hover">
							<tbody id="attendeeTable">
								<?php foreach ($attending as $member) { ?>
								<tr id="attendee<?php echo $member["_id"] ?>">
									<td class="center">
									<?php if($member && isset($member["imagePath"])) { ?>
										<img width="50" height="50"  alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$member["imagePath"]) ?>">
									<?php } else{ ?>
										<i class="fa fa-user fa-2x"></i> 
									<?php } ?>
										<?php if(isset($member["name"])) echo $member["name"]; ?>
									</td>
									
									<td>
										<span class="text-large"><?php echo $member["name"]; ?></span><a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard/id/".$member['_id'])?>" class="btn block text-left"><i class="fa fa-chevron-circle-right"></i></a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<div class="panel-scroll height-230 ps-container">
							<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: -14px; width: 504px; display: none;">
								<div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
							</div>
							<div class="ps-scrollbar-y-rail" style="top: 17px; right: 3px; height: 230px; display: inherit;">
								<div class="ps-scrollbar-y" style="top: 11px; height: 152px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
		$(".new-attendees").off().on("click", function() {
			showAjaxPanel( '/event/addattendeesv?eventId='+$(this).data("id"), 'ADD ATTENDEE','users' )
		});
	});
</script>
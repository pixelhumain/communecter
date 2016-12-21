<?php

$cssAnsScriptFilesTheme = array(

'/plugins/perfect-scrollbar/src/perfect-scrollbar.css'
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->request->baseUrl);
?>
<div class="panel panel-white">
	<div class="panel-heading border-light bg-orange">
		<h4 class="panel-title"><i class="fa fa-calendar"></i> <?php echo Yii::t("event","Events",null,Yii::app()->controller->module->id); ?></h4>
	</div>
	<div class="panel-tools">
		<?php if(( @$authorised || @$openEdition) && !isset($noAddLink) && isset(Yii::app()->session["userId"]) ) { ?>
			<a class="tooltips btn btn-xs btn-light-blue " data-placement="top" data-toggle="tooltip" data-original-title="<?php echo Yii::t("event","Add new event",null,Yii::app()->controller->module->id) ?>" href="javascript:;" onclick="openForm ( 'event','subEvent' )">
	    		<i class="fa fa-plus"></i> <?php echo Yii::t("common","Add") ?>
	    	</a>
	    	<a id="showHideOldEvent" class="tooltips btn btn-xs btn-light-blue" href="javascript:;" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo Yii::t("event","Display/Hide old events",null,Yii::app()->controller->module->id) ?>" onclick="toogleOldEvent()">
	    		<i class="fa fa-history"></i> <?php echo Yii::t("event","Old events",null,Yii::app()->controller->module->id) ?>
	    	</a>
		<?php } ?>
	</div>
	
	<div class="panel-body no-padding">
		<div class="panel-scroll height-230 ps-container">
				<?php
						
					$nbOldEvents = 0;
					$nbEventVisible = 0;
					if(isset($events) && count($events)>0 ) { ?>
					<table class="table table-striped table-hover" id="events">
						<tbody>
					<?php	
						foreach ($events as $e) {					
							if (empty($e["endDate"]) || (!empty($e["endDate"]) && isset($e["endDate"]->sec) && $e["endDate"]->sec > time())) {
								$eventStyle = "";
								$eventClass = "";
								$nbEventVisible++;
							} else {
								$eventStyle = "display:none;";
								$eventClass = "oldEvent";
								$nbOldEvents++;
							}

						?>
						<tr class="<?php echo $eventClass ?>" style="<?php echo $eventStyle ?>" id="<?php echo Event::COLLECTION.(string)$e["_id"];?>">
							<td class="center hidden-sm hidden-xs" style="padding-left: 18px; ">
								<?php  

								//$url = '#element.detail.type.'.Event::COLLECTION.'.id.'.$e["_id"]; 

								$url = '#event.detail.id.'.$e["_id"];

								if(@$organiserImgs && @$e["links"]["organizer"]){

									$id = array_keys($e["links"]["organizer"])[0];
									$o = Element::getInfos( @$e["links"]["organizer"][$id]['type'], $id);
									if ( $o["type"]==Person::COLLECTION ){
										$icon='<img height="35" width="35" class="tooltips" data-placement="right" src="'.$this->module->assetsUrl.'/images/news/profile_default_l.png" data-placement="right" data-original-title="'.$o['name'].'">';
										$refIcon="fa-user";
										$redirect="person";
									}
									else{
										$icon="<div class='thumbnail-profil'><i class='fa fa-2x fa-group tooltips ' data-placement='right' data-original-title='".$o['name']."'></i></div>";
										$redirect="organization";
										$refIcon="fa-group";
									}
									?>
									<a href="#<?php echo $redirect; ?>.detail.id.<?php echo (string)$o['id'];?>" class="lbh" title="<?php echo $o['name'] ?>" class="btn no-padding ">

									<?php if(@$o["profilThumbImageUrl"]) {
										// Utiliser profilThumbImageUrl && createUrl(/.$profilThumbUrl.)
										 ?>
										<img width="50" height="50"  alt="image" class="tooltips" data-placement='right' src="<?php echo Yii::app()->createUrl('/'.$o['profilThumbImageUrl']) ?>" data-placement="top" data-original-title="<?php echo $o['name'] ?>">
									<?php }else{ 
										echo $icon;
									} ?>
									</a>
								<?php } 
								else 
								{ ?>
								<a href="<?php echo $url?>" class="lbh text-dark">
								<?php if (@$o["profilThumbImageUrl"]){ ?>
									<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$o["profilThumbImageUrl"]) ?>">
								<?php } else { ?>
									<i class="fa fa-calendar fa-2x text-orange"></i>
								<?php } ?>
								</a>
								<?php } ?>
							</td>
							<td>
								<a href="<?php echo $url?>" class="lbh text-dark">
									<?php 
									if(@$e["name"]) echo $e["name"];
									if(@$e["links"]["subEvents"]) echo "(".count($e["links"]["subEvents"]).")";
									$startDate = (@$e["startDate"]) ? date(DateTime::ISO8601,(isset($e["startDate"]->sec))  ? $e["startDate"]->sec : strtotime($e["startDate"]) ) : "";
			        				$endDate = (@$e["endDate"]) ? date(DateTime::ISO8601,(isset($e["endDate"]->sec))  ? $e["endDate"]->sec : strtotime($e["endDate"]) ) : "";
			        				$dates = $startDate."<br/>".$endDate;
									?>
									<br/><span class="text-extra-small date2format" data-startDate="<?php echo $startDate;?>" data-endDate="<?php echo $endDate;?>"></span>
								</a>
							</td>
							<td><?php if(isset($e["type"])) echo Yii::t("event",$e["type"],null,Yii::app()->controller->module->id);?></td>
							<?php /*?>
							<td class="center">
								<div class="visible-lg">
									<?php if(isset(Yii::app()->session["userId"]) && Authorisation::isEventAdmin((string)$e["_id"], Yii::app()->session["userId"])) { ?>
									<a href="javascript:;" class="disconnectBtn btn btn-xs btn-grey tooltips  hidden-sm hidden-xs" data-type="<?php echo PHType::TYPE_EVENTS ?>" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="left" data-original-title="<?php echo Yii::t("event","Unlink event",null,Yii::app()->controller->module->id) ?>" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
									<?php }; ?>
								</div>
							</td>
							*/?>
						</tr>
						<?php
						}
					}
					if(isset($events) && count($events)>0 ) { ?>
						</tbody>
					</table>
					<?php } ?>
		<?php if( $nbEventVisible == 0 && $nbOldEvents== 0) { ?>
			<div id="infoEventPod" class="padding-10" >
				<blockquote> 
					<?php 
						if($contextType==Event::CONTROLLER)
							$explain="Create sub-events to show the event's program.<br/>And Organize the event's sequence";
						else
							$explain="Publiez les événements que vous organisez";
						echo Yii::t("event",$explain); 
					?>
				</blockquote>
			</div>
		<?php } ?>
		<?php if(isset($events) && count($events) > 0 && count($events)==$nbOldEvents ) {?>
			<div id="infoLastButNotNew" class="padding-10">
				<blockquote>
					<?php echo Yii::t("event","Create your next events <br>To show your next meet-up<br>And where people can go",null,Yii::app()->controller->module->id) ?>
				</blockquote>
			</div>
		<?php } ?>

		</div>
	</div>
</div>

<script type="text/javascript">
	var nbOldEvents = <?php echo (String) @$nbOldEvents;?>;
	jQuery(document).ready(function() {	 
		if (nbOldEvents == 0) $("#showHideOldEvent").hide();
		manageTimestampOnDate();

		var itemId = '<?php echo @$contextId;?>';
		$('.init-event').off().on("click", function(){
			$("#ajaxSV").html("<div class='cblock'><div class='centered'><i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading</div></div>");
			$.subview({
				content : "#ajaxSV",
				onShow : function() {
					var url = "";
					url = baseUrl+"/"+moduleId+"/event/eventsv/id/"+itemId+"/type/<?php echo @$contextType ?>";
					getAjax("#ajaxSV", url, function(){bindEventSubViewEvents(); $(".new-event").trigger("click");}, "html");
				},
				onSave : function() {
					$('.form-event').submit();
				},
				onHide : function() {
					//$.hideSubview();
				}
			});
			
		})
	})

	function toogleOldEvent() {
		$(".oldEvent").toggle("slow");
		$("#infoLastButNotNew").toggle("slow");
	}

</script>
<?php

$cssAnsScriptFilesTheme = array(

'/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css'
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
?>
<div class="panel panel-white">
	<div class="panel-heading border-light bg-orange">
		<h4 class="panel-title"><i class="fa fa-calendar"></i> <?php echo Yii::t("event","EVENTS",null,Yii::app()->controller->module->id); ?></h4>
	</div>
	<div class="panel-tools">
		<?php if( @$authorised ) { ?>
			<a class="tooltips btn btn-xs btn-light-blue" href="javascript:;" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo Yii::t("event","Add new event",null,Yii::app()->controller->module->id) ?>" onclick="loadByHash('#event.eventsv.contextId.<?php echo $contextId ?>.contextType.<?php echo $contextType ?>')">
	    		
	    		<i class="fa fa-plus"></i> <?php echo Yii::t("event","Add new event",null,Yii::app()->controller->module->id) ?>
	    	</a>
		
		<?php
		 } ?>
	</div>
	
	<div class="panel-body no-padding">
		<div class="panel-scroll height-230 ps-container">
			<table class="table table-striped table-hover" id="events">
				<tbody>
					<?php
					if(isset($events) && count($events)>0 ){ 
					foreach ($events as $e) 
					{
					?>
					<tr id="<?php echo Event::COLLECTION.(string)$e["_id"];?>">
						<td class="center" style="padding-left: 18px;">
							<?php  $url = '#event.detail.id.'.$e["_id"]; ?>
							<a href="javascript:;" onclick="loadByHash('<?php echo $url?>')" class="text-dark">
							<?php if ($e && isset($e["imagePath"])){ ?>
								<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>">
							<?php } else { ?>
								<i class="fa fa-calendar fa-2x text-orange"></i>
							<?php } ?>
						</td>
						<td>
							<a href="javascript:;" onclick="loadByHash('<?php echo $url?>')" class="text-dark">
								<?php if(isset($e["name"]))echo $e["name"]?>
							</a>
						</td>
						<td><?php if(isset($e["type"])) echo $list[$e["type"]];?></td>
						<td class="center">
							<div class="visible-lg">
								<?php if(isset(Yii::app()->session["userId"]) && Authorisation::isEventAdmin((string)$e["_id"], Yii::app()->session["userId"])) { ?>
								<a href="javascript:;" class="disconnectBtn btn btn-xs btn-grey tooltips  hidden-sm hidden-xs" data-type="<?php echo PHType::TYPE_EVENTS ?>" data-id="<?php echo (string)$e["_id"];?>" data-name="<?php echo (string)$e["name"];?>" data-placement="left" data-original-title="Unlink event" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
								<?php }; ?>
							</div>
						</td>
					</tr>
					<?php
						};}
					?>
				</tbody>
			</table>
			<?php if(isset($events) && count($events)>0 ){ ?>
			<div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 11px; height: 200px;"></div></div>
			<?php } ?>
		<?php if(isset($events) && count($events) == 0 ) { ?>
			<div id="infoEventPod" class="padding-10" >
				<blockquote> 
					<?php echo Yii::t("event","Create and Attend<br/>Local Events<br/>To build up local activity<br/>To help local culture<br/>To create movement",null,Yii::app()->controller->module->id); ?>
				</blockquote>
			</div>
		<?php } ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	jQuery(document).ready(function() {	 

		var itemId = '<?php echo $contextId;?>';
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

	function updateMyEvents(nEvent) {
		if('undefined' != typeof contextMap){
			contextMap["events"].push(nEvent);
		}
		var image = "<i class='fa fa-calendar fa-2x'></i>";
		if('undefined' != typeof(nEvent["imagePath"]))
			image = "<img src='"+nEvent["imagePath"]+"' width='50' height='50' alt='image' class='img-circle'/>";
		var htmlEvent = "<tr id='"+nEvent['_id']['$id']+"'>" +
							"<td class='center'>" +
								"<a href='"+baseUrl+"/"+moduleId+"/event/dashboard/id/"+nEvent['_id']['$id']+"' class='text-dark'>" +
								 	image +
								 "</a>" +
							"</td>" +
							"<td>" +
								"<a href='"+baseUrl+"/"+moduleId+"/event/dashboard/id/"+nEvent['_id']['$id']+"' class='text-dark'>" + 
									nEvent["name"] +
								"</a>" +
							"</td>" +
							"<td>" +
								nEvent["type"] +
							"</td>" +
							"<td class='center'>" +
								"<div class='visible-md visible-lg hidden-sm hidden-xs'>" +
									"<a href='#'' class='btn btn-xs btn-grey tooltips delBtn' data-id='"+nEvent['_id']['$id']+"'' data-name='"+nEvent["name"]+"'' data-placement='left' data-original-title='Remove'><i class='fa fa-times fa fa-white'></i></a>"+
								"</div>" +
							"</td>" +
						"</tr>";
		$("#events").append(htmlEvent);
		$('.tooltips').tooltip();
		$('#infoEventPod').hide();
	}
</script>
<?php

$cssAnsScriptFilesTheme = array(

'/plugins/perfect-scrollbar/src/perfect-scrollbar.css'
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->request->baseUrl);
?>
<div class="panel panel-white">
	<div class="panel-heading border-light bg-blue">
		<h4 class="panel-title"><i class="fa fa-calendar"></i> <?php echo Yii::t("common","Urls",null,Yii::app()->controller->module->id); ?></h4>
	</div>
	<div class="panel-tools">
		<?php if(( @$authorised || @$openEdition) && !isset($noAddLink) && isset(Yii::app()->session["userId"]) ) { ?>
			<a class="tooltips btn btn-xs btn-light-blue " data-placement="top" data-toggle="tooltip" data-original-title="<?php echo Yii::t("common","Add",null,Yii::app()->controller->module->id) ?>" href="javascript:;" onclick="elementLib.openForm ( 'url','parentUrl')">
	    		<i class="fa fa-plus"></i> <?php echo Yii::t("common","Add") ?>
	    	</a>
		<?php } ?>
	</div>
	
	<div class="panel-body no-padding">
		<div class="panel-scroll height-230 ps-container">
				<?php
					if(isset($urls) && count($urls)>0 ) { ?>
					<table class="table table-striped table-hover" id="urls">
						<tbody>
					<?php	
						foreach ($urls as $keyUrl => $url) {						
					?>
						<tr class="" style="" id="<?php echo $keyUrl;?>">
							<td>
								<a href="<?php echo $url["url"];?>" target="_blank" class="text-dark">
									<span class="text-dark">
										<?php echo $url["titre"]; ?>
										<br/><span class="text-extra-small"><?php echo @$url["type"];?></span>
									</span>
								</a>
							</td>
							<td class="col-xs-3">
								<?php $json = json_encode($url); ?>
								<a class="tooltips btn btn-xs btn-light-blue " data-placement="top" data-toggle="tooltip" data-original-title="<?php echo Yii::t("common","Update",null,Yii::app()->controller->module->id) ?>" href="javascript:;" onclick='updateUrl("<?php echo $keyUrl; ?>");'>
						    		<i class="fa fa-pencil"></i>
						    	</a>
						    	<a class="tooltips btn btn-xs btn-light-blue " data-placement="top" data-toggle="tooltip" data-original-title="<?php echo Yii::t("common","Remove",null,Yii::app()->controller->module->id) ?>" href="javascript:;" onclick='removeUrl("<?php echo $keyUrl; ?>")'>
						    		<i class="fa fa-trash"></i>
						    	</a>
								
							</td>
						</tr>
						<?php
						}
					}
					if(isset($urls) && count($urls)>0 ) { ?>
						</tbody>
					</table>
					<?php } ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	var urls = <?php echo json_encode($urls);?>;
	jQuery(document).ready(function() {

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

	function updateUrl(ind) {
		var url = urls[ind] ;
		elementLib.openForm( 'url','parentUrl', url);
	}

	function removeUrl(ind) {
		param = new Object;
    	param.name = "urls";
    	param.value = {index : ind};
    	param.pk = contextData.id;
		param.type = contextData.type;
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
	        data: param,
	       	dataType: "json",
	    	success: function(data){
	    		mylog.log("data", data);
		    	if(data.result){
					toastr.success(data.msg);
					loadByHash("#"+contextData.controller+".detail.id."+contextData.id);
		    	}
		    }
		});
	}

</script>
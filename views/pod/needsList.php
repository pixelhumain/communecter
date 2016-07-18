<?php

$cssAnsScriptFilesTheme = array(

'/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css'
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
?>

<div class="panel panel-white">
	<div class="panel-heading border-light bg-dark">
		<h4 class="panel-title text-left"><i class="fa fa-cubes"></i> <?php echo Yii::t("need","NEEDS",null,Yii::app()->controller->module->id); ?></h4>
	</div>
	<?php if($isAdmin) { ?>
		<div class="panel-tools">
    		<a class="tooltips btn btn-xs btn-light-blue" href="javascript:;" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo Yii::t("needs","Add need to find energies to help you",null,Yii::app()->controller->module->id) ?>ok" onclick="loadByHash('#need.addneedsv.id.<?php echo $parentId ?>.type.<?php echo $parentType ?>')">
	    		
	    		<i class="fa fa-plus"></i> Ajouter un besoin
	    	</a>
		</div>
	<?php } ?>
	<div class="panel-body no-padding">
		<div class="panel-scroll height-230 ps-container">
			<table class="table table-striped table-hover <?php if (empty($needs)) echo " hide"; ?>">
				<tbody>
					<?php
					if (isset($needs) && !empty($needs)){
						foreach ($needs as $data){ 
							if(!empty($data["name"])){
							if ($data["type"]=="materials")
								$icon="fa-bullhorn";
							else 
								$icon="fa-gears"; ?>
							<tr>
								<td class="center">
									<i class="fa <?php echo $icon; ?> fa-2 text-blue"></i> 
								</td>
								<td class="text-left">
									<span class="text-large"><?php echo $data["name"]; ?></span>
									<a href="javascript:;" onclick="loadByHash('#need.detail.id.<?php echo $data["_id"] ?>')" class="btn"><i class="fa fa-chevron-circle-right"></i></a>
								</td>
							</tr>
				<?php } } } ?>
						</tbody>
			</table>
			<?php if(isset($needs) && !empty($needs)){ ?>
				<div class="ps-scrollbar-y-rail" style="top: 17px; right: 3px; height: 230px; display: inherit;">
					<div class="ps-scrollbar-y" style="top: 11px; height: 200px;"></div>
				</div>
			<?php } ?>
			<?php if (empty($needs)){ ?>
				<div id="infoPodOrga" class="padding-10 info-no-need">
					<blockquote> 
						<?php echo Yii::t("need","Create needs<br/>Materials<br/>Knowledge<br/>Skills<br/>To call ressources that you need",null,Yii::app()->controller->module->id); ?>
					</blockquote>
				</div>
			<?php } ?>
		</div>
	</div>	
</div>

<script>
jQuery(document).ready(function() {
	
});
function updateNeed(data){
		if($(".table-need").hasClass("hide")==true){
			$(".table-need").removeClass("hide");
			$(".info-no-need").addClass("hide");
		}
		dataNeed=data["newNeed"];
		if (dataNeed.type=="materials")
			iconNeed="fa-bullhorn";
		else
			iconNeed="fa-gears";
		trNeed = '<tr id="need">'+
					'<td class="organizationLine">'+
						'<i class="fa '+iconNeed+' fa-2x text-blue"></i>'+dataNeed.type+
					'</td>'+
					'<td ><a href="#showNeed" class="showNeed">'+dataNeed.name+'</a></td>'+
					'<td>'+	
						dataNeed.quantity+
					'</td>'+
					'<td>'+
						dataNeed.benefits+
					'</td>'+
					'<td>'+
						'<a href="'+data.url+'" class="btn showNeed"><i class="fa fa-chevron-circle-right"></i></a>'+
					'</td>'+
				'</tr>';
		$(".tableNeedLines").append(trNeed);
}    
        
</script>

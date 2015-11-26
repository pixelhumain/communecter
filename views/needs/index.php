<?php

$cssAnsScriptFilesTheme = array(

'/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css'
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
?>

<div class="panel panel-white">
	<div class="panel-heading border-light bg-dark">

		<h4 class="panel-title text-left"><i class="fa fa-cubes"></i> <?php echo Yii::t("need","NEEDS",null,Yii::app()->controller->module->id); ?></h4>
		<?php if($isAdmin) { ?>
			<div class="panel-tools">
	    		<a class="tooltips btn btn-xs btn-light-blue" href="javascript:;" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo Yii::t("needs","Add need to find energies to help you",null,Yii::app()->controller->module->id) ?>ok" onclick="showAjaxPanel('/needs/addneedsv/id/<?php echo $_GET["id"] ?>/type/<?php echo $_GET["type"] ?>/parentName/<?php echo $parentName ?>?isNotSV=1', 'ADD NEED','cubes' )">
		    		<i class="fa fa-plus"></i> Ajouter un besoin
		    	</a>
			</div>
		<?php } ?>
	</div>
	<div class="panel-body no-padding <?php if (!@$_GET["isDetailView"]) echo 'panel-body'; ?>">
		<div class="panel-scroll height-230 ps-container">
			<table class="table table-striped table-hover <?php if (!@$_GET["isDetailView"]) echo "table-bordered table-need directoryTable"; if (empty($needs)) echo " hide"; ?>">
				<?php if(!@$_GET["isDetailView"]){ ?>
				<?php } else { ?>
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
									<a href="#" onclick="openMainPanelFromPanel('/needs/detail/idNeed/<?php echo $data["_id"] ?>/type/<?php echo $data["parentType"] ?>/id/<?php echo $data["parentId"] ?>', ' Need : <?php echo $data["name"]?>','fa-cubes', '<?php echo $data["_id"] ?>')" class="btn"><i class="fa fa-chevron-circle-right"></i></a>
								</td>
							</tr>
				<?php } } } } ?>
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
<?php
if (!@$_GET["isDetailView"])
   $this->renderPartial('addNeedSV', array( ));
 ?>

<script>
jQuery(document).ready(function() {
	$(".showNeed").click(function(){
		//getAjax(".showNeed",baseUrl+"/"+moduleId+"/needs/dashboard/type/<?php echo Project::COLLECTION ?>/id/<?php echo $_GET["id"]?>",null,"html");
	});
	resetDirectoryTable() ;
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
function resetDirectoryTable() 
{ 
	console.log("resetDirectoryTable");
	<?php if(!@$_GET["isDetailView"]){ ?>
	if( !$('.directoryTable').hasClass("dataTable") )
	{
		directoryTable = $('.directoryTable').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "Show _MENU_ Rows",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[1, 'asc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] ],
			"iDisplayLength" : 10,
			"destroy": true
		});
	} 
	else 
	{
		if( $(".directoryLines").children('tr').length > 0 )
		{
			directoryTable.dataTable().fnDestroy();
			directoryTable.dataTable().fnDraw();
		} else {
			console.log(" directoryTable fnClearTable");
			directoryTable.dataTable().fnClearTable();
		}
	}
	<?php } ?>
}
        
</script>

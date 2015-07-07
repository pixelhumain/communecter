<?php 
//Chargement du fichier en ligne
$cssAnsScriptFilesModule = array(
	'/assets/plugins/timesheet.js/dist/timesheet.js',
	'/assets/plugins/timesheet.js/dist/timesheet.css',
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);//$this->module->assetsUrl);
?>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><span><i class="fa fa-tasks fa-2x text-blue"></i> PROJECT TASKS</span></h4>
		<div class="panel-tools">
			<div class="dropdown">
				<?php if ($admin) { ?>
				<a href="#editProjectTimesheet" id="" class="edit-timesheet btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="" alt="" data-original-title="Editer la timeline"><i class="fa fa-pencil"></i>
				</a>
				<?php } ?>
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
		<div id="timesheet"></div>
	</div>
</div>
<?php
   $this->renderPartial('addTimesheetSV', array("itemId" => $itemId, "tasks"=>$tasks));
?>

<script type="text/javascript">
var task=<?php echo json_encode($tasks); ?>;
console.log(task);
jQuery(document).ready(function() {
	timesheet=new Timesheet('timesheet',2014, 2025, [<?php foreach ($tasks as $data){
		echo "['".$data["startDate"]."','".$data["endDate"]."','".$data["name"]."','".$data["color"]."'],";
	} ?>
	]);
	//console.log(timesheet);
	//timesheet.data.push({start:'01/2008',end:'05/20012',label:'Test push',type:'lorem'});
	//timesheet.prototype.timesheet('timesheet',2002, 2013, [['01/2008', '05/20012', 'Test push', 'lorem']]);
$monthTab=['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
	$('.date').each(function(){
		startEndDate=$(this).html();
		startEndArray=startEndDate.split('-');
		if (startEndArray.length==2){
			dateStart=writeMonth(startEndArray[0]);
			dateEnd=writeMonth(startEndArray[1]);	
			$(this).replaceWith(dateStart+"-"+dateEnd);
		}
		else
			$(this).replaceWith(writeMonth(startEndDate));
	});
});
function writeMonth(date){
	dateTab=date.split('/');
	if (dateTab.length == 2){
		dateMonth=parseInt(dateTab[0]);
		dateYear=dateTab[1];
		date=$monthTab[dateMonth-1]+" "+dateYear;
	}
	else {
		date=date;
	}
	return date;
}
</script>

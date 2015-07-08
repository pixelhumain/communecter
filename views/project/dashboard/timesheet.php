<?php 
//Chargement du fichier en ligne
$cssAnsScriptFilesModule = array(
	//'/assets/plugins/timesheet.js/dist/timesheet.js',
	//'/assets/plugins/timesheet.js/dist/timesheet.css',
	'/assets/css/timesheet.css/timesheet.css',
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
//$cs = Yii::app()->getClientScript();
//$cs->registerCssFile(Yii::app()->baseUrl. '/protected/extensions/timesheetphp/sources/css/timesheet.css');
//$this->module->assetsUrl);
//echo Yii::app()->baseUrl. 'protected/extensions/timesheetphp/sou';
//Yii::import('recaptcha.ReCaptcha', true);
//require_once(Yii::app()->theme->baseUrl.'/assets/plugins/timesheetphp/sources/timesheet.php');
//'assets.plugins.timesheet.php.sources.class.timesheet', true);;
 Yii::import('ext.timesheetphp.sources.timesheet', true); 
?>
<style>
	.lightgray{
		background-color: #e2e2e2;
	}
</style>
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
	<div class="panel-body no-padding partition-dark">
		<ul id="timesheetTab" class="nav nav-tabs">
			<li class="active">
				<a href="#users_tab_attending" data-toggle="tab">
					<span>
						Yearly
					</span>
				</a>
			</li>
			<li class="zoomTimesheet hide">
				<a href="#users_tab_attending" data-toggle="tab">
					<span>
					</span>
				</a>
			</li>
		</ul>
		<?php
		//***** GENERATE TIMESHEET MODULE *****//
		// firstYear & endYear represent the beginning and the end of project => $alpha
		//$alpha = array('Janv', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Dec');
		$alpha =[];
		$data=[];
		$firstYear="";
		$endYear="";
		$nbYear=0;
		foreach ($tasks as $val){
			//if ($val["startDate"])
			if (!empty($firstYear) && $firstYear > date('Y',strtotime($val["startDate"])))
				$firstYear = date('Y',strtotime($val["startDate"]));
			else
				$firstYear = date('Y',strtotime($val["startDate"]));
			if ($endYear < date('Y',strtotime($val["endDate"])))
				$endYear = date('Y',strtotime($val["endDate"]));
			$array= array(array('color'=> $val["color"],'start' => $val["startDate"],'end' => $val["endDate"]));
			$data[$val["name"]]=$array ;
		}
		/**MAKE THE SCALE OF TIMESHEET**/
		for ($date = $firstYear; $date <= $endYear; $date++) {
			array_push($alpha,$date);
			$nbYear++;
		}
	//print_r($data);
	/*$data = array(
       		 'Prun' => array(
                    array('color'=> 'sit','start' => '2010-01-15','end' => '2011-02-20'),
                    ),
			'Orange' => array(
                    array('color'=> 'sit','start' => '2012-02-01','end' => '2013-06-30'),
                    ),
			'Kiwi' => array(
                    array('color'=> 'default','start' => '08-30','end' => '10-20'),
                    ),
                    'jack' => array(
                    array('color'=> 'lorem','start' => '02-01','end' => '06-30'),
                    ),
			'start' => array(
                    array('color'=> 'dolor','start' => '08-12','end' => '09-10'),
                    ),
        );*/
		
		$args = array(
        	'id' => 'year',            /* CSS #ID of the timesheet */
			'theme' =>'white',           /* Theme white (or null for dark) */
			'alpha_first' => $firstYear,          /* The number of the first month is one (Janv) */
			'omega_base' => 12,          /* 31 days in 1 month (for simplify) */
			/*'line' => date('m-d'), */      /* Today in format 'm-d' */
			/*'line_text' => "Aujourd'hui",  */  /* Text to display for the line */
			'format'=> array(
							"segment_des" => 'du %s au %s',
							"timesheet_format" => 'Y-m-d',
							"date_format" => 'd M Y',
				)
        );

$fruits = new timesheet($alpha, $args, $data );
	$fruits->display();?>

	</div>
</div>
<?php
   $this->renderPartial('addTimesheetSV', array("itemId" => $itemId, "tasks"=>$tasks));
?>

<script type="text/javascript">
//var task=<?php echo json_encode($tasks); ?>;
//console.log(task);
jQuery(document).ready(function() {
	$('.scale .hoverScale').mouseover(function(){
		$(this).find("section").addClass("lightgray");
	}).mouseout(function(){
		$(this).find("section").removeClass("lightgray");
	});
	toggleMonthYear();		/*timesheet=new Timesheet('timesheet',2014, 2025, [<?php foreach ($tasks as $data){
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
	});*/
});
function toggleMonthYear(){
	$('.scale section div').click(function(){
		year=$(this).html();
		$("#year").slideUp();
		active=$("#timesheetTab").find(".active");
		active.find("span").html("Back");
		active.removeClass("active").addClass("backYearly");
		$("#timesheetTab").find(".zoomTimesheet").removeClass("hide");
		$("#timesheetTab").find(".zoomTimesheet").addClass("active").find("a span").html(year);
		$('.backYearly').click(function(){
			$("#year").slideDown();
			$(this).removeClass("backYearly").addClass("active").find("span").html("Yearly");
			$("#timesheetTab").find(".zoomTimesheet").removeClass("active").addClass("hide");
		});
	});
}
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

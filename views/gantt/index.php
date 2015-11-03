<?php 
//Chargement du fichier en ligne
$cssAnsScriptFilesModule = array(
	'/assets/css/timesheet.css/timesheet.css',
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
Yii::import('ext.timesheetphp.sources.timesheet', true); 
if(isset($_GET["isDetailView"]))
	$isDetailView=$_GET["isDetailView"];
?>

<style>
	.lightgray{
		background-color: rgba(0, 0, 0, 0.15);
	}
	<?php if (isset($isDetailView)){?>
	.hoverScale div{
		font-size:small;
	}
	<?php } ?>
</style>
<div class="parentTimeline">
<div class="<?php if (!isset($isDetailView)){ ?>panel<?php } ?> panel-white">
	<div class="panel-heading border-light" <?php if (isset($isDetailView)){ ?> style="background-color:#E6E6E6;border-radius:inherit;" <?php } ?>>
		<h4 class="panel-title"><span><i class="fa fa-tasks fa-2x text-blue"></i> <?php echo Yii::t("gantt","PROJECT TIMELINE",null,Yii::app()->controller->module->id) ?></span></h4>
		<div class="panel-tools">
			<?php if ($edit) {
				if (@$isDetailView){
				$tasksSerialize = base64_encode(serialize($tasks));
				$tasksSerialize = str_replace('"','/"',$tasksSerialize);
				$urlArray = '&tasks={'.$tasksSerialize.'}';
			} ?> 
			<a href="#editTimesheet" id="" class="edit-timesheet btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="<?php echo Yii::t("gantt","Edit timeline",null,Yii::app()->controller->module->id) ?>" alt="" <?php if (isset($isDetailView)){ ?> onclick="showAjaxPanel('/gantt/addtimesheetsv/id/<?php echo $_GET["id"] ?>/type/<?php echo $_GET["type"] ?>?isNotSV=1<?php echo $urlArray ?>', 'EDIT TIMELINE','tasks' )" <?php } ?>>
				<i class="fa fa-pencil"></i>
			</a>
			<?php } ?>
			<a href="#" class="btn btn-xs btn-link panel-close">
				<i class="fa fa-times"></i>
			</a>
		</div>
	</div>
	<?php if(isset($tasks) && !empty($tasks)){ ?>
	<div class="panel-body no-padding partition-dark">
		<ul id="timesheetTab" class="nav nav-tabs no-margin">
			
			<?php if($period == "yearly"){ ?>
			<li class="active">
				<a href="#users_tab_attending" data-toggle="tab">
					<span>
						<?php echo Yii::t("gantt","Yearly",null,Yii::app()->controller->module->id) ?>
					</span>
				</a>
			</li>
			<?php } else {  ?>
			<li class="back">
				<a href="#users_tab_attending" data-toggle="tab">
					<span>
						<?php echo Yii::t("common","Back") ?>
					</span>
				</a>
			</li>
			<li class="active">
				<a href="#users_tab_attending" data-toggle="tab">
					<span>
						<?php echo $period; ?>
					</span>
				</a>
			</li>
			<?php } ?>
		</ul>
		<?php
		//***** GENERATE TIMESHEET MODULE *****//
		$alpha =array();
		$data=array();
		$firstYear="";
		$endYear="";
		$nbYear=0;
		foreach ($tasks as $val){
			if ($period == "yearly"){
				if (!empty($firstYear)){
					if ($firstYear > date('Y',strtotime($val["startDate"])))
						$firstYear = date('Y',strtotime($val["startDate"]));
				}else{
					$firstYear = date('Y',strtotime($val["startDate"]));
				}
				if ($endYear < date('Y',strtotime($val["endDate"])))
					$endYear = date('Y',strtotime($val["endDate"]));
			}
			if($period != "yearly"){
				$startDate=date("m-d",strtotime($val["startDate"]));
				$endDate=date("m-d",strtotime($val["endDate"]));
				$array = array(array('color'=> $val["color"],'start' => $val["startDate"],'end' => $val["endDate"],'key'=>$val["key"]));
			}else
				$array = array(array('color'=> $val["color"],'start' => $val["startDate"],'end' => $val["endDate"],'key'=>$val["key"]));
			$data[$val["name"]]=$array ;
		}
		/**MAKE THE SCALE OF TIMESHEET**/
		if ($period == "yearly"){
			for ($date = $firstYear; $date <= $endYear;$date++) {
				array_push($alpha,$date);
				$nbYear++;
			}	
			$alpha_first=$firstYear;
			$omega_base=12;
			$date_format='d M Y';
			$timesheet_format='Y-m-d';
		}
		else{
			$alpha = array('Janv', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Dec');	
			$alpha_first=1;
			$omega_base=31;
			$date_format='d M';
			$timesheet_format='m-d';
		}
		$args = array(
        	'id' => 'year',            /* CSS #ID of the timesheet */
			'theme' =>'white',           /* Theme white (or null for dark) */
			'alpha_first' => $alpha_first,          /* The number of the first month is one (Janv) */
			'omega_base' => $omega_base,          /* 31 days in 1 month (for simplify) */
			/*'line' => date('m-d'), */      /* Today in format 'm-d' */
			/*'line_text' => "Aujourd'hui",  */  /* Text to display for the line */
			'format'=> array(
							"segment_des" => 'du %s au %s',
							"timesheet_format" => $timesheet_format,
							"date_format" => $date_format,
				)
        );
		$timeline = new timesheet($alpha, $args, $data);
		$timeline -> display();?>
	</div>
	<?php } else {?>

		<div id="infoPodOrga" class="padding-10">
			<blockquote> 
				<?php echo Yii::t("gantt","Create Gantt<br/>Tasks<br/>Deadlines<br/>Priorities<br/>To think, develop, build and shows next steps of the project to everyone",null,Yii::app()->controller->module->id) ?></blockquote>
		</div>
	<?php } ?>
</div>
</div>
<?php
	if (!isset($isDetailView))
		$this->renderPartial('addTimesheetSV', array("tasks"=>$tasks));
?>

<script type="text/javascript">
var booleanYearMonth= "<?php echo $period; ?>";
var edit = "<?php echo $edit; ?>";
jQuery(document).ready(function() {
	if (booleanYearMonth == "yearly"){
		$('.scale section').mouseover(function(){
			$(this).addClass("lightgray");
		}).mouseout(function(){
			$(this).removeClass("lightgray");
		});
		$('.scale section div').click(function(){
			$("#year").fadeOut("slow");	
			year=$(this).html();
			getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo $_GET["type"];?>/id/<?php echo $_GET["id"];?>/year/"+year+"/isAdmin/"+edit+"<?php if (isset($isDetailView)) echo "/isDetailView/1"; ?>",null,"html");
		});
	}
	
	$("#year").fadeIn("slow");
		
	$(".back").click(function(){
		$("#year").fadeOut("slow");	
		getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo $_GET["type"];?>/id/<?php echo $_GET["id"];?>/isAdmin/"+edit+"<?php if (isset($isDetailView)) echo "/isDetailView/1"; ?>",null,"html");
	});
	
});
</script>
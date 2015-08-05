<?php 
//Chargement du fichier en ligne
$cssAnsScriptFilesModule = array(
	'/assets/css/timesheet.css/timesheet.css',
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
Yii::import('ext.timesheetphp.sources.timesheet', true); 
?>
<style>
	.lightgray{
		background-color: rgba(0, 0, 0, 0.15);
	}
</style>
<div class="parentTimeline">
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><span><i class="fa fa-tasks fa-2x text-blue"></i> PROJECT TASKS</span></h4>
		<div class="panel-tools">
			<div class="dropdown">
				<?php //if ($admin) { ?>
				<a href="#editTimesheet" id="" class="edit-timesheet btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="" alt="" data-original-title="Editer la timeline"><i class="fa fa-pencil"></i>
				</a>
				<?php //} 
				?>
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
	<?php if(isset($tasks) && !empty($tasks)){ ?>
	<div class="panel-body no-padding partition-dark">
		<ul id="timesheetTab" class="nav nav-tabs">
			
			<?php if($period == "yearly"){ ?>
			<li class="active">
				<a href="#users_tab_attending" data-toggle="tab">
					<span>
						Yearly
					</span>
				</a>
			</li>
			<?php } else {  ?>
			<li class="back">
				<a href="#users_tab_attending" data-toggle="tab">
					<span>
						Back
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
		$alpha =[];
		$data=[];
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
				$array = array(array('color'=> $val["color"],'start' => $val["startDate"],'end' => $val["endDate"]));
			}else
				$array = array(array('color'=> $val["color"],'start' => $val["startDate"],'end' => $val["endDate"]));
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
		$timeline = new timesheet($alpha, $args, $data );
		$timeline -> display();?>
		
	</div>
	<?php } else {?>

		<div id="infoPodOrga" class="padding-10">
					<blockquote> 
					Create Gantt
						<br>Tasks 
						<br>Deadlines
						<br>Follows
						<br>To think, develop, build and shows next steps of the project to everyone
			</blockquote>
		</div>

	<?php } ?>
</div>
</div>
<?php
  $this->renderPartial('addTimesheetSV', array("tasks"=>$tasks));
?>

<script type="text/javascript">
jQuery(document).ready(function() {
	$('.scale section').mouseover(function(){
		$(this).addClass("lightgray");
	}).mouseout(function(){
		$(this).removeClass("lightgray");
	});
	//toggleMonthYear();	
	$("#year").fadeIn("slow");	
	$(".back").click(function(){
		$("#year").fadeOut("slow");	
		getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo $_GET["type"];?>/id/<?php echo $_GET["id"];?>",null,"html");
	});
	$('.scale section div').click(function(){
		$("#year").fadeOut("slow");	
		year=$(this).html();
		getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo $_GET["type"];?>/id/<?php echo $_GET["id"];?>/year/"+year+"",null,"html");
		});
});
</script>
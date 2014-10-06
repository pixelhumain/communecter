<?php 
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/pages-calendar.js' , CClientScript::POS_END);
?>

	<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-sm-12">
		<!-- start: FULL CALENDAR PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading">
				<i class="fa fa-calendar"></i>
				Full Calendar
				<div class="panel-tools">
					<div class="dropdown">
						<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
							<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu dropdown-light pull-right" role="menu">
							<li>
								<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
							</li>
							<li>
								<a class="panel-refresh" href="#">
									<i class="fa fa-refresh"></i> <span>Refresh</span>
								</a>
							</li>
							<li>
								<a class="panel-config" href="#panel-config" data-toggle="modal">
									<i class="fa fa-wrench"></i> <span>Configurations</span>
								</a>
							</li>
							<li>
								<a class="panel-expand" href="#">
									<i class="fa fa-expand"></i> <span>Fullscreen</span>
								</a>
							</li>
						</ul>
					</div>
					<a class="btn btn-xs btn-link panel-close" href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
			</div>
			<div class="panel-body">
				<div class="col-sm-12 space20">
					<a href="#newFullEvent" class="btn btn-green add-event"><i class="fa fa-plus"></i> Add New Event</a>
				</div>
				<div class="col-sm-9">
					<div id='full-calendar'></div>
				</div>
				<div class="col-sm-3">
					<h4 class="space20">Draggable categories</h4>
					<div id="event-categories">
						<div class="event-category event-generic" data-class="event-generic">
							Generic
						</div>
						<div class="event-category event-home" data-class="event-home">
							Home
						</div>
						<div class="event-category event-overtime" data-class="event-overtime">
							Overtime
						</div>
						<div class="event-category event-job" data-class="event-job">
							Job
						</div>
						<div class="event-category event-offsite" data-class="event-offsite">
							Off-site work
						</div>
						<div class="event-category event-todo" data-class="event-todo">
							To Do
						</div>
						<div class="event-category event-cancelled" data-class="event-cancelled">
							Cancelled
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" class="grey" id="drop-remove" />
								Remove after drop
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end: FULL CALENDAR PANEL -->
	</div>
</div>
<!-- end: PAGE CONTENT-->

<script>
	jQuery(document).ready(function() {
		
		Calendar.init();
	});
</script>
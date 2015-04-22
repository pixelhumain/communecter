	<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.pulsate/jquery.pulsate.min.js' , CClientScript::POS_END);
<?php
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.pulsate/jquery.pulsate.min.js' , CClientScript::POS_END);
?>
<style type="text/css">
	.panel-tools{
		filter: alpha(opacity=1);
		-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=1)";
		-moz-opacity: 1;
		-khtml-opacity: 1;
		opacity: 1;
	}

</style>
<div class="col-sm-8 col-xs-12">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
	    		<?php $this->renderPartial('../pod/ficheInfo',array( "context" => (isset($organization)) ? $organization : null )); ?>
	    		<?php $this->renderPartial('../pod/ficheInfo',array( "context" => (isset($organization)) ? $organization : null, "tags" => $tags)); ?>
	    	</div>
	    	<div class="col-sm-12 col-xs-12 documentPod">
	    		<div class="panel panel-white pulsate">
					<div class="panel-heading border-light ">
						<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Documents Section</h4>
						<div class="space5"></div>
					</div>
				</div>
	    		
	    	</div>
	    	<?php 
		    	if(isset($organization) && isset(Yii::app()->session["userId"]) && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], (String) $organization["_id"])) {

		    ?>
			<div class="col-sm-12 col-xs-12">
	    		<?php $this->renderPartial('dashboard/network',array( "organization" => $organization,"members"=>$members)); ?>
	    	</div>
	    	<?php }; ?>
	    	
	    	<div class="col-sm-12 col-xs-12 jobPod">
	    		<div class="panel panel-white pulsate">
					<div class="panel-heading border-light ">
						<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Jobs Section</h4>
						<div class="space5"></div>
					</div>
				</div>
	    		
	    	</div>
	    </div>
	 </div>

	 <div class="col-sm-4 col-xs-12">
	 	<div class="row">
	 		<div class="col-sm-12 col-xs-12">
	 			<?php $this->renderPartial('../pod/photoVideo',array( "context" => (isset($organization)) ? $organization : null )); ?>
	 		</div>
	 		<div class="col-sm-12 col-xs-12">
	 			<?php $this->renderPartial('../pod/sliderAgenda', array("events" => $events, "organizationId" => (isset($organization)) ? (String) $organization["_id"] : null )); ?>
	 		</div>

	 		<div class="col-sm-12 col-xs-12">
	 			<?php //$this->renderPartial('../pod/news', array("events" => $events, "organizationId" => (isset($organization)) ? (String) $organization["_id"] : null )); ?>
	 		</div>


	 	</div>
	 </div>
</div>


<!-- end: PAGE CONTENT-->
<script>
	var contextMap = { "desc" : [ "organization", "events " ] };
	contextMap = <?php echo json_encode($organization) ?>;
	contextMap.events = <?php echo json_encode($events) ?>;

	
	jQuery(document).ready(function() {

		$('.pulsate').pulsate({
            color: '#2A3945', // set the color of the pulse
            reach: 10, // how far the pulse goes in px
            speed: 1000, // how long one pulse takes in ms
            pause: 200, // how long the pause between pulses is in ms
            glow: false, // if the glow should be shown too
            repeat: 10, // will repeat forever if true, if given a number will repeat for that many times
            onHover: false // if true only pulsate if user hovers over the element
        });

		initDashboardAgenda();
		$(".flexslider").flexslider();

		getAjax(".documentPod",baseUrl+"/"+moduleId+"/organization/documents/id/<?php echo $_GET["id"]?>",null,"html");
		getAjax(".jobPod",baseUrl+"/"+moduleId+"/job/list",null,"html");
		
	});

	function compareDate(d, f){
		var res = false;
		console.log(d, f, d<= f)
		if(d <= f){
			res= true;
		}
		return res;
	}

	function getStringPeriodValue(d, f){
		var mapMonth = {"01":"JANV.", "02": "FEVR.", "03":"MARS", "04":"AVRIL", "05":"MARS", "06":"JUIN", "07":"JUIL.", "08":"AOUT", "09":"SEPT.", "10":"OCTO.", "11":"NOVE.", "12":"DECE."};
		var strPeriod = "";
		var dTab = [];
		var fTab = [];
		var dHour = d.split(" ")[1];
		var dDay = d.split(" ")[0].split("/");
		
		for(var i=0; i<dDay.length; i++){
			dTab.push(dDay[i]);
		}

		var fHour = f.split(" ")[1];
		var fDay = f.split(" ")[0].split("/");
		for(var i=0; i<fDay.length; i++){
			fTab.push(fDay[i]);
		}
		
		if(dTab[2] == fTab[2]){
			if(dTab[1] == fTab[1]){
				if(dTab[0]== fTab[0]){
					strPeriod += parseInt(fTab[0])+" "+mapMonth[fTab[1]]+" "+fTab[2]+" de "+dHour+" à "+fHour;
				}else{
					strPeriod += parseInt(dTab[0])+" au "+ parseInt(fTab[0])+" "+mapMonth[fTab[1]]+" "+fTab[2];
				}
			}else{
				strPeriod += parseInt(dTab[0])+" "+mapMonth[dTab[1]]+" au "+ parseInt(fTab[0])+" "+mapMonth[fTab[1]]+" "+fTab[2];
			}
		}else{
			strPeriod += parseInt(dTab[0])+" "+mapMonth[dTab[1]]+" "+dTab[2]+" au "+ parseInt(fTab[0])+" "+mapMonth[fTab[1]]+" "+fTab[2];
		}
		return strPeriod;
	}


	/*function showCalendarDashBoard(data) {

	console.info("addTasks2Calendar",data);//,taskCalendar);
	
	calendar = [];
	if(data){
		$.each(data,function(eventId,eventObj)
		{
			eventCal = buildCalObj(eventObj);
			if(eventCal)
				calendar.push( eventCal );
		});
	}

	dateToShow = new Date();
	$('.mini-calendar').fullCalendar({
		header : {
			left : 'prev,next today',
			center : 'title',
			right : 'month,agendaWeek,agendaDay'
		},
		year : dateToShow.getFullYear(),
		month : dateToShow.getMonth(),
		date : dateToShow.getDate(),
		editable : true,
		events : calendar,
		eventClick : function(calEvent, jsEvent, view) {
			//show event in subview
			dateToShow = calEvent.start;
			$.subview({
				content : "#readEvent",
				startFrom : "right",
				onShow : function() {
					readEvent(calEvent._id);
				}
			});
		}
	});
	dateToShow = new Date();
};
//destroy fullCalendar
function destroyCalendarDashBoard() {
	$('#mini-calendar').fullCalendar('destroy');
};*/
</script>
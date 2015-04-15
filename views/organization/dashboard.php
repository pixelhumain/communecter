<?php //var_dump($organization); die();?>


	<div class="col-sm-8 col-xs-12">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
	    		<?php $this->renderPartial('../pod/ficheInfo',array( "context" => (isset($organization)) ? $organization : null )); ?>
	    	</div>
	    	<div class="col-sm-12 col-xs-12">
	    		<div class="panel panel-white">
					<div class="panel-heading border-light">
						<h4 class="panel-title"> Ressources</h4>
					</div>
					<div class="panel-body no-padding">
						<div class="panel-scroll height-230 ps-container">
							<table class="table table-striped table-hover" id="organizations">
								<tbody>
								</tbody>
							</table>
						</div>
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
	 			<?php $this->renderPartial('../pod/sliderAgenda', array("events" => $events, "organizationId" => (isset($organization)) ? new MongoId($organization["_id"]) : null )); ?>
	 		</div>

	 		<div class="col-sm-12 col-xs-12">
	 			
	 		</div>
	 	</div>
	 </div>
</div>


<!-- end: PAGE CONTENT-->
<script>
	var contextMap = <?php echo json_encode($organization) ?>;
	contextMap.events = <?php echo json_encode($events) ?>;

	
	jQuery(document).ready(function() {
		initDashboardAgenda();
		$(".flexslider").flexslider();
	});

	function initDashboardAgenda(){
		var n = 1;
		var today = new Date();
		console.log(contextMap.events);
		$.each(contextMap.events, function(k, v){
			console.log(k, v);
			var period = getStringPeriodValue(v.startDate, v.endDate);
			var date = new Date(v.endDate.split("/")[2].split(" ")[0], parseInt(v.endDate.split("/")[1])-1, v.endDate.split("/")[0]);
			if(n<4 && compareDate(today, date)){
				var htmlRes = "<img src=\""+v.imagePath+"\"></img>";
				htmlRes +="<div class='row'><div class=\"col-xs-5\" ><h2>"+period+"</h2></div>";
				htmlRes += "<div class=\"col-xs-7\" ><h1>"+v.name+"</h1><div id='infoEventLink'><a href='"+baseUrl + "/" + moduleId + "/event/public/id/"+v["_id"]["$id"]+"''>En savoir+ <i class='fa fa-angle-right'></i> </a></div></div>";
				$("#slideEv"+n).html(htmlRes);
				n++;
			}
		})
			//showCalendarDashBoard(data);
	}

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
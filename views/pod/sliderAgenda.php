<style type="text/css">
	.flexslider{
		margin : 0px 0px 0px;
	}
	#sliderAgenda .flex-control-nav{
		opacity: 0;
	}
</style>
	<div id="sliderAgenda">
    <div class="panel panel-white">
      <div class="panel-heading border-light">
        <h4 class="panel-title slidesAgendaTitle"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Shared Calendar</h4>
        <?php if((isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"])  || (isset($organizationId) && isset(Yii::app()->session["userId"]) && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $organizationId))) { ?>
	        <ul class="panel-heading-tabs border-light">
	        	<li>
	        		<a href="#newEvent" class="new-event btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add an Event" alt="Add an Event"><i class="fa fa-plus"></i></a>
	        	</li>
		        <li class="panel-tools">
		        </li>
		    </ul>
	    <?php } ?>
      </div>
       <div class="panel-body no-padding center">
		  <div class="flexslider">
			<ul class="slides" id="slidesAgenda">
				
			</ul>
		  </div>
		</div>
      <!--<div class="panel-footer "  >
        <a href="">En savoir+ <i class="fa fa-angle-right"></i> </a>
      </div>-->
    </div>
    </div>

 <script type="text/javascript">

 var events = <?php echo json_encode($events) ?>;
 jQuery(document).ready(function() {
		initDashboardAgenda();
		$(".flexslider").flexslider();
	});

	function initDashboardAgenda(){
		var n = 1;
		var today = new Date();
		$.each(events, function(k, v){
			var period = getStringPeriodValue(v.startDate, v.endDate);
			var date = new Date(v.endDate.split("/")[2].split(" ")[0], parseInt(v.endDate.split("/")[1])-1, v.endDate.split("/")[0]);
			if(n<4 && compareDate(today, date)){
				if (typeof(v.imagePath)=="undefined"){
					v.imagePath = "http://placehold.it/350x180";
				}
				var htmlRes = "<li><div>"+
								"<img src='"+v.imagePath+"'></img>";
				htmlRes +="<div class='row'>"+
							"<div class='col-xs-5' >"+
								"<h2>"+period+"</h2></div>";
				htmlRes += "<div class='col-xs-7' >"+
								"<h1>"+v.name+"</h1>"+
								"<div id='infoEventLink'>"+
									"<a href='"+baseUrl + "/" + moduleId + "/event/dashboard/id/"+v["_id"]["$id"]+"''>En savoir+ <i class='fa fa-angle-right'></i> </a>"+
								"</div></div></div></li>";
				$("#slidesAgenda").append(htmlRes);
				n++;
			}
		})
		$(".slidesAgendaTitle").html("Shared Calendar");
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

 </script>
<?php
/*$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/weather-icons/css/weather-icons.min.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js' , CClientScript::POS_END);
*/
?>
<!-- start: PAGE CONTENT -->

<style>
.flexslider .slides {
    height: 250px;
}
.flexslider img {
    height: 250px;
}

.flex-control-nav{
	display: none;
}

.divLeftEv{
	height: 100px;
	text-align: center;
}

</style>
<div class="row">

  <div class="col-sm-7 col-xs-12">
    <?php 
    $this->renderPartial('dashboard/about',array( "organization" => $organization));
    ?>
  </div>

  <div class="col-sm-5 col-xs-12">
    <div class="panel panel-white">
      <div class="panel-heading border-light">
        <h4 class="panel-title">AGENDA PARTAGEE </h4>
      </div>
       <div class="panel-body no-padding center">
		  <div class="flexslider">
			<ul class="slides">
				<li>
					<div id="slideEv1"></div>
				</li>
				<li>
					<div id="slideEv2"></div>
				</li>
				<li>
					<div id="slideEv3"></div>
				</li>
			</ul>
		  </div>
		</div>
      <div class="panel-footer "  >
        <a href="">En savoir+ <i class="fa fa-angle-right"></i> </a>
      </div>
    </div>
  </div>

</div>

<div class="row">

  <div class="col-sm-7 col-xs-12">
    <div class="panel panel-white">
      <div class="panel-heading border-light">
        <h4 class="panel-title">ANNUAIRE DU RESEAU </h4>
      </div>
      <div class="panel-body no-padding center">
        <img class="img-responsive center-block"style="height:250px" src="http://placehold.it/350x150"/>
      </div>
      <div class="panel-footer center"   >
        <a href="">TROUVER PAR THEME</a>
      </div>
    </div>
  </div>

  <div class="col-sm-5 col-xs-12">
    <div class="panel panel-white">
      <div class="panel-heading border-light">
        <h4 class="panel-title">UNE ASSO AU HASARD </h4>
      </div>
      <div class="panel-body no-padding"  >
        <div class="row">
          <div class="col-xs-6">
            <img class="img-responsive center-block" style="height:250px" src="http://placehold.it/350x180"/>
          </div>
          <div class="col-xs-6">
            <div class="row center">
              ASSOCIATION 1
            </div>
            <div class="row" >
              <img class="img-circle pull-left" src="http://placehold.it/50x50"/>
            </div>
            <hr>
            <div class="row">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde iste voluptates magni, doloribus officia aperiam provident nihil repudiandae perspiciatis in expedita cumque et, qui perferendis ex facilis eveniet quae laudantium.
            </div>
            
          </div>  
        </div>
        
      </div>
      <div class="panel-footer "  >
        <a href="">En savoir+ <i class="fa fa-angle-right"></i> </a>
      </div>
    </div>
  </div>

</div>

<div class="row">

  <div class="col-sm-10 col-xs-12">
    <div class="panel panel-white">
      <div class="panel-heading border-light">
        <h4 class="panel-title">LETTRE D'INFORMATION </h4>
      </div>
      <div class="panel-body no-padding ">
          <img class="pull-left" class="img-responsive center-block" style="height:120px" src="http://placehold.it/100x120"/>
          <div class="padding-10">
            ASSOCIATION ACTU
            <br/>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus, earum, debitis. Consectetur inventore quaerat aperiam nihil minima, vitae laudantium, ut animi illum blanditiis cum earum, fugiat nisi ipsam dolore possimus.
            <br/>
            <a href="" class="btn btn-success">DERNIER N°</a> <a href="" class="btn btn-success">JE M'INSCRIS</a>
          </div>
      </div>
    </div>
  </div>

  <div class="col-sm-2 col-xs-12">
    <div class="panel panel-blue">
      <div class="panel-heading border-light center">
          <i class="fa fa-check-circle fa-3x"></i>
      </div>
      <div class="panel-body no-padding center" style="max-height:120px" >
        <h4 class="text-bold">J'ADHERE </h4>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
      </div>
    </div>
  </div>

</div>
<!-- end: PAGE CONTENT-->
<script>
	jQuery(document).ready(function() {
		initDashboard();
		$(".flexslider").flexslider();
	});

	function initDashboard(){
		var mapOrganization = <?php echo json_encode($organization) ?>;
		$.ajax({
			type: "POST",
			url: baseUrl+"/"+moduleId+'/organization/getCalendar/id/'+mapOrganization["_id"]["$id"],
			dataType : "json",
		})
		.done(function (data) 
		{
			console.log(data);
			var n = 1;
			var today = new Date();
			$.each(data, function(k, v){
				var date = new Date(v.endDate.split("/")[2].split(" ")[0], parseInt(v.endDate.split("/")[1])-1, v.endDate.split("/")[0]);
				if(n<4 && compareDate(today, date)){
					var htmlRes = "<img src=\""+v.imagePath+"\"></img>";
					htmlRes +="<div class=\"divLeftEv\" style=\"float:left\"><h2>"+v.startDate+"</h2></div>";
					htmlRes += "<div class=\"divLeftEv\" style=\"float:right\"><h1>"+v.name+"</h1></div>";
					$("#slideEv"+n).html(htmlRes);
					n++;
				}
			})
			//showCalendarDashBoard(data);
		})
	}

	function compareDate(d, f){
		var res = false;
		console.log(d, f, d<= f)
		if(d <= f){
			res= true;
		}
		return res;
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
<?php

  $cssAnsScriptFilesModule = array(
	
    //Full calendar
    '/assets/plugins/moment/min/moment.min.js',
    '/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css',
    '/assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js',
    '/assets/plugins/fullcalendar/fullcalendar/lang/fr.js'
    );

  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);

?>

<style>
#showCalendar { display: block; float: none; }
#calendar{width:100%;  }
#lastEvent{ width:100%;    padding: 0px;    clear: none;  }
.lastEventPadding{    width: 100%;  }
.imgEvent{    width: 100%;    height: 200px;  }
.imgEvent img{  	width: 100%;  	height: 100%;  }
.imgEvent i{ 	margin-bottom: auto; 	margin-top: auto; }
#dropBtn{    display: none;  }
#orgaDrop a, #orgaDrop ul{    width: 100%;  }
.panel-transparent {    background: none;  }
.fc-event-inner{  	padding-left: 5px;  	border-radius : 5px;  }
.fc-event .fc-event-title::before, .event-category::before{  	color: white;  }
.fc-grid th{  	text-align: center;  	color: black;  }
#sectionNextEvent{  	clear:none;  }
.fc-popover .fc-content{  	color:#ccc;  }
.fc-content{  	cursor: pointer;  }
.fc button{	height: 3em;}
</style>



<!-- *** SHOW CALENDAR *** -->
<div id="showCalendar" class="col-md-12">
  <div class="row">

    <?php if(isset($canEdit) && $canEdit){ ?>
      <div class="panel-tools">
       <a href="#newEvent" class="init-event btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add an Event" alt="<?php echo Yii::t("sliderAgenda","Add an event",null,Yii::app()->controller->module->id) ?>"><i class="fa fa-plus"></i></a>     
      </div>
    <?php } ?>
	   <div class="panel panel-white">
    	<div class="panel-body boder-light">
    		<div id="calendar"></div>
    	</div>
    </div>
  </div>	
</div>
      


<script type="text/javascript">
  
  var templateColor = ["#93be3d", "#eb4124", "#0073b0", "#ed553b", "#df01a5", "#b45f04", "#2e2e2e"];
  var events = <?php echo json_encode($events) ?>;
  var dateToShow, calendar, $eventDetail, eventClass, eventCategory;
  var widgetNotes = $('#notes .e-slider'), sliderNotes = $('#readNote .e-slider'), $note;
  var oTable, contributors;
  var subViewElement, subViewContent, subViewIndex;
  var tabOrganiser = [];

  jQuery(document).ready(function() {
      showCalendar();
      initLastsEvents();

      $(window).on('resize', function(){
  			$('#calendar').fullCalendar('destroy');
  			showCalendar();
  			initLastsEvents();
  		});
      $(".fc-button").on("click", function(e){
      	setCategoryColor(tabOrganiser);
     	})
      
  })

//creates fullCalendar
function buildCalObj(eventObj)
{
  //console.log("addTasks2CAlendar","task",taskId,eventObj);
  //entries for the calendar
  var taskCal = null;
  var prioClass = 'event-job';
  switch( eventObj.priority ){
    case "urgent" : prioClass = 'event-todo'; break;
    case "high" : prioClass = 'event-offsite'; break;
    case "normal" : prioClass = ''; break;
    case "low" : prioClass = 'event-generic'; break;
    default : prioClass = 'event-job'; 
  }
  if(eventObj.startDate && eventObj.startDate != "")
  {
    //console.log("eventObj", eventObj, eventObj.startDate);
    var sd = eventObj.startDate.split(" ")[0];
    var sh = eventObj.startDate.split(" ")[1];
    var sdv = sd.split("-");
    var shv = sh.split(":");
    var startDate = new Date(sdv[0],parseInt(sdv[1])-1,sdv[2], shv[0], shv[1]);
    var endDate = null;
    if(eventObj.endDate && eventObj.endDate != "" )
    {
      var ed = eventObj.endDate.split(" ")[0];
      var eh = eventObj.endDate.split(" ")[1];
      var edv = ed.split("-");
      var ehv = eh.split(":");
      endDate = new Date(edv[0],parseInt(edv[1])-1,edv[2], ehv[0], ehv[1]);
     }
     //console.log("taskCalObj",eventObj['_id']['$id']);
    var organiser = "";
    

    if("undefined" != typeof eventObj["links"] && "undefined" != typeof eventObj.links["organizer"]){
      $.each(eventObj.links["organizer"], function(k, v){
      	if($.inArray(k, tabOrganiser)==-1){
      		tabOrganiser.push(k);
      	}
        organiser = k;
      })
      
    }

    var organizerName = eventObj.name;
    if(eventObj.organizer != ""){
    	organizerName = eventObj.organizer +" : "+ eventObj.name;
    }

    console.log(organiser);
    taskCal = {
      "title" : organizerName,
      "id" : eventObj['_id']['$id'],
      "content" : (eventObj.description && eventObj.description != "" ) ? new Date(eventObj.description) : "",
      "start" : startDate,
      "end" : ( endDate ) ? endDate : startDate,
      "startDate" : eventObj.startDate,
      "endDate" : eventObj.endDate,
      "className": organiser,
      "category": organiser,
      "allDay" : false,
    }
    //console.log(taskCal);
  }
  return taskCal;
}

function showCalendar() {

  console.info("addTasks2Calendar",events);//,taskCalendar);
  
  calendar = [];
  if(events){
    $.each(events,function(eventId,eventObj)
    {
      eventCal = buildCalObj(eventObj);
      if(eventCal)
        calendar.push( eventCal );
    });
  }
 
  dateToShow = new Date();
  $('#calendar').fullCalendar({
    header : {
		left : 'prev,next',
		center : 'title',
		right : 'today, month, agendaWeek, agendaDay'
    },
    lang : 'fr',
    year : dateToShow.getFullYear(),
    month : dateToShow.getMonth(),
    date : dateToShow.getDate(),
    editable : false,
    events : calendar,
    eventLimit: true,


    eventClick : function(calEvent, jsEvent, view) {
      //show event in subview
      dateToShow = calEvent.start;
      document.location.href = baseUrl+"/"+moduleId+"/event/dashboard/id/"+calEvent._id;
    }
  });

  setCategoryColor(tabOrganiser);
  dateToShow = new Date();
};

  function getLastsEvent(events){
    var today = new Date();
    var eventsSelected = [];
    $.each(events, function(k,v){
      console.log("current event : ", v);
      
      var date = null;
      if("undefined" != typeof v.endDate && v.endDate.split("-")[2]){
        var endSplit = v.endDate.split("-");
        date = new Date( endSplit[0], parseInt(endSplit[1])-1, endSplit[2].split(" ")[0]);
      }
      if(today<=date)
      {
        var startSplit = v.startDate.split("-");
        var date = new Date(startSplit[0], parseInt(startSplit[1])-1, startSplit[2].split(" ")[0]);
        if(eventsSelected.length>=3){
          for(var i = 0; i<eventsSelected.length;i++){
            console.log("for", eventsSelected);
            var date2 = new Date(eventsSelected[i].startDate.split("-")[0], parseInt(eventsSelected[i].startDate.split("-")[1])-1, eventsSelected[i].startDate.split("-")[2].split(" ")[0]);
            //console.log(date, date2);
            if(date2>=date){
              eventsSelected.splice(i, 0, v);
              eventsSelected.pop();
              i=eventsSelected.length;
            }
          }
        }else if(eventsSelected.length<1){
          eventsSelected.push(v);
        }else if(eventsSelected.length==1){
          var date2 = new Date(eventsSelected[0].startDate.split("-")[0], parseInt(eventsSelected[0].startDate.split("-")[1])-1, eventsSelected[0].startDate.split("-")[2].split(" ")[0]);
          if(date2>date){
            eventsSelected.splice(0,0, v);
          }else{
            eventsSelected.push(v);
          }
        }else if(eventsSelected.length==2){
          
          var date2 = new Date(eventsSelected[0].startDate.split("-")[0], parseInt(eventsSelected[0].startDate.split("-")[1])-1, eventsSelected[0].startDate.split("-")[2].split(" ")[0]);
          var date3 = new Date(eventsSelected[1].startDate.split("-")[0], parseInt(eventsSelected[1].startDate.split("-")[1])-1, eventsSelected[1].startDate.split("-")[2].split(" ")[0]);
          if(date2>date){
            eventsSelected.splice(0,0, v);
          }else if(date3>date){
            eventsSelected.splice(1,0,v);
          }else{
            eventsSelected.push(v);
          }
        }
      }
    })
    return eventsSelected;
  }

  function initLastsEvents(){
    var DEFAULT_IMAGE_EVENT = "";
    if("undefined" != typeof events ){
      console.log("OK initLastsEvents");
      var tabEvents = getLastsEvent(events);
      console.dir(tabEvents);
      var htmlRes = "";

      for(var i=0; i<tabEvents.length; i++ ){
        var currentEvent = tabEvents[i];
        var imageUrl = "";
        var period = getStringPeriodValue(currentEvent.startDate, currentEvent.endDate);

        if ("undefined" == typeof currentEvent.imageUrl || currentEvent.imageUrl == "") {
          imageUrl = "";
          baliseImg = '<div class="center"></br><i class="fa fa-calendar fa-5x text-blue" ></i></div>';
        } else {
          imageUrl = baseUrl+currentEvent.imageUrl;
          baliseImg = '<img src="'+imageUrl+'"></img>';
        }
        htmlRes +='<div class="col-md-4">'+
        			'<div class="panel panel-white lastEventPadding">'+
	                    '<div class="panel-body no-padding center">'+
		                      	'<div class="imgEvent">'+baliseImg+'</div>'+
		                  	'<div class="nextEventInfo"><h3>'+period+'</h3><br>'+currentEvent.name+'</div>'+
		                '</div>'+
	                	'<div class="partition">'+
							'<a class="btn btn-green btn-block radius-bottomRightLeft" href="'+baseUrl+"/"+moduleId+"/event/dashboard/id/"+currentEvent["_id"]["$id"]+'">'+
								'En savoir + >'+
							'</a>'+
						'</div>'+
					'</div>'+
				'</div>'

      }
    }else{
      htlmRes = "<h1>Aucun evenement à venir</h1>";
    }
    $("#lastEvent").html(htmlRes);
  }
  
  function getStringPeriodValue(d, f){
    var mapMonth = {"01":"JANV.", "02": "FEVR.", "03":"MARS", "04":"AVRIL", "05":"MAI", "06":"JUIN", "07":"JUIL.", "08":"AOUT", "09":"SEPT.", "10":"OCTO.", "11":"NOVE.", "12":"DECE."};
    var strPeriod = "";
    var dTab = [];
    var fTab = [];
    var dHour = d.split(" ")[1];
    var dDay = d.split(" ")[0].split("-");
    
    for(var i=0; i<dDay.length; i++){
      dTab.push(dDay[i]);
    }

    var fHour = f.split(" ")[1];
    var fDay = f.split(" ")[0].split("-");
    for(var i=0; i<fDay.length; i++){
      fTab.push(fDay[i]);
    }
    
    if(dTab[0] == fTab[0]){
      if(dTab[1] == fTab[1]){
        if(dTab[2]== fTab[2]){
          strPeriod += parseInt(fTab[2])+" "+mapMonth[fTab[1]]+" "+fTab[0]+"<br><h4> de "+dHour+" à "+fHour+"</h4>";
        }else{
          strPeriod += parseInt(dTab[2])+" au "+ parseInt(fTab[2])+" "+mapMonth[fTab[1]]+" "+fTab[0];
        }
      }else{
        strPeriod += parseInt(dTab[2])+" "+mapMonth[dTab[1]]+" au "+ parseInt(fTab[2])+" "+mapMonth[fTab[1]]+" "+fTab[0];
      }
    }else{
      strPeriod += parseInt(dTab[2])+" "+mapMonth[dTab[1]]+" "+dTab[0]+" au "+ parseInt(fTab[2])+" "+mapMonth[fTab[1]]+" "+fTab[0];
    }
    return strPeriod;
  }


	function setCategoryColor(tab){
		$(".fc-content").css("color", "white");
	  	$(".fc-content").css("background-color", "black");
	  	for(var i =0; i<tab.length; i++){
	  		$("."+tab[i]+" .fc-content").css("color", "white");
	  		$("."+tab[i]+" .fc-content").css("background-color", templateColor[i]);

	  	}
	}

	function getRandomColor() {
	    var letters = '0123456789ABCDEF'.split('');
	    var color = '#';
	    for (var i = 0; i < 6; i++ ) {
	        color += letters[Math.floor(Math.random() * 16)];
	    }
	    return color;
	}
</script>
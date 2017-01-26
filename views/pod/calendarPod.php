<?php

  $cssAnsScriptFilesModule = array(
	
    //Full calendar
    '/plugins/fullcalendar/fullcalendar/fullcalendar.css',
    '/plugins/fullcalendar/fullcalendar/fullcalendar.min.js',
    '/plugins/fullcalendar/fullcalendar/locale/fr.js'
    );

  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule,Yii::app()->request->baseUrl);

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
.fc-popover .fc-content{  	color:white;   }
.fc-content{  	cursor: pointer;  }
.fc button{	height: 3em;}
.fc-event, #event-categories .event-category {
    background: #ccc none repeat scroll 0 0 !important;
    border: 1px solid #e8e9ec !important;
    color: #000 !important;
    }
</style>


<!-- *** SHOW CALENDAR *** -->
<div id="showCalendar" class="col-md-12">
  <div class="row">

    <?php 
    if(isset($canEdit) && $canEdit){ 
      
      ?>
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

      $(window).on('resize', function(){
  			$('#calendar').fullCalendar('destroy');
  			showCalendar();
  		});
      $(".fc-button").on("click", function(e){
      	setCategoryColor(tabOrganiser);
     	})
      
  })

//creates fullCalendar
function buildCalObj(eventObj) {
  //entries for the calendar
  var taskCal = null;

  if(eventObj.startDate && eventObj.startDate != "") {
    var startDate = moment(eventObj.startDate).local();
    var endDate = null;
    if(eventObj.endDate && eventObj.endDate != "" ) {
      endDate = moment(eventObj.endDate).local();
    }
    mylog.log("Start Date = "+startDate+" // End Date = "+endDate);
    
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

    mylog.log(organiser);
    taskCal = {
      "title" : organizerName,
      "id" : eventObj['_id']['$id'],
      "content" : (eventObj.description && eventObj.description != "" ) ? eventObj.description : "",
      "start" : startDate.format(),
      "end" : ( endDate ) ? endDate.format() : startDate.format(),
      "startDate" : eventObj.startDate,
      "endDate" : eventObj.endDate,
      "className": organiser,
      "category": organiser
    }
    if(eventObj.allDay )
      taskCal.allDay = eventObj.allDay;
    mylog.log(taskCal);
  }
  return taskCal;
}

function showCalendar() {

  mylog.info("addTasks2Calendar",events);//,taskCalendar);
  
  calendar = [];
  if(events){
    $.each(events,function(eventId,eventObj)
    {
      eventCal = buildCalObj(eventObj);
      if(eventCal)
        calendar.push( eventCal );
    });
  }
  mylog.log(calendar);
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
    timezone : 'local',
    //allDaySlot : false,
    <?php if(@$defaultDate){?>
      defaultDate: '<?php echo $defaultDate?>',
    <?php 
    }
    if(@$defaultView){?>
      defaultView: '<?php echo $defaultView?>',
    <?php } ?>

    eventClick : function(calEvent, jsEvent, view) {
      //show event in subview
      dateToShow = calEvent.start;
      loadByHash("#event.detail.id."+calEvent._id);
    }
  });

  setCategoryColor(tabOrganiser);
  dateToShow = new Date();
};

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
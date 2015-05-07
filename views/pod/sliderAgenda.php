<style type="text/css">
	#sliderAgenda .flexslider{
		margin : 0px 0px 0px;
		height: 220px;
	}
	#sliderAgenda .flex-control-nav{
		opacity: 0;
	}

	.banniereSlider{
		position: relative;
	}
	.addImgButton{
		position: absolute;
		right: 0;
    	top: 0;
    }
    #agendaNewPicture{
    	display: none;
    	height: 260px;
    }
    #infoSlider{
    	padding-top: 50px;
    	position: relative;
    }
</style>
	<div id="sliderAgenda">
    <div class="panel panel-white">
      <div class="panel-heading border-light">
        <h4 class="panel-title slidesAgendaTitle"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Shared Calendar</h4>
     </div>
     <div class="panel-tools">
        <?php if((isset($itemId) && isset(Yii::app()->session["userId"]) && $itemId == Yii::app()->session["userId"])  || (isset($itemId) && isset(Yii::app()->session["userId"]) && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $itemId))) { ?>
		   <a href="#newEvent" class="new-event btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add an Event" alt="Add an Event"><i class="fa fa-plus"></i></a>
	    <?php } ?>
      </div>
       <div class="panel-body no-padding center">

		  	<div class="flexslider" id="flexsliderAgenda">
				<ul class="slides" id="slidesAgenda">
				
				</ul>
		  	</div>
		  	<div id="agendaNewPicture">
			  	<div class="agendaNewPicture" >
			  		
			  	</div>
			  	<div class="row center">
					<a href="#" class="btn btn-light-blue validateSliderAgenda">Terminer </a>
				</div>
			</div>
		</div>
    </div>
    </div>

 <script type="text/javascript">
var events = <?php echo json_encode($events) ?>;
var contentId = "<?php echo Document::IMG_PROFIL; ?>";
 jQuery(document).ready(function() {	 	
		initDashboardAgenda();
		$(".flexslider").flexslider();

		$(".validateSliderAgenda").off().on("click", function() {
			clearFileUploadAgenda();
		})

		$('.addImgButton').off().on("click", function(){
			
			$("#flexsliderAgenda").flexslider("clear");
			getAjax(".agendaNewPicture",baseUrl+"/"+moduleId+"/pod/fileupload/itemId/"+$(this).data("id")+"/type/<?php echo Event::COLLECTION; ?>/resize/true/edit/true/contentId/"+contentId,null,"html");
			$("#flexsliderAgenda").css("display", "none");
			$("#agendaNewPicture").css("display", "block");
			
		})
	});

	function initDashboardAgenda(){
		var n = 1;
		var today = new Date();
		var notEmptySlide = false;
		var width =  parseInt($("#sliderAgenda .panel-body").css("width"));
		var height = width*45/100;
		if(Object.keys(events).length>0){
			$.each(events, function(k, v){
				if('undefined' != typeof v.startDate && 'undefined' != typeof v.endDate){
					console.log("evenAgenda", v.imagePath);
					var period = getStringPeriodValue(v.startDate, v.endDate);
					var date = new Date(v.endDate.split("/")[2].split(" ")[0], parseInt(v.endDate.split("/")[1])-1, v.endDate.split("/")[0]);
					if(n<4 && compareDate(today, date)){
						notEmptySlide = true;
						var imageUrl = "<i class='fa fa-calendar fa-5x text-red'></i><br> No picture for this event";
						if ('undefined' != typeof v.imagePath){
							imageUrl = "<img src='"+baseUrl + "/" + moduleId +"/document/resized/"+width+"x"+height+v.imagePath+"'></img>";
						}
						var htmlRes = "<li><div class='center'>"+
												"<div class='banniereSlider'>"+
													imageUrl+
													'<span class="btn btn-azure btn-file btn-sm addImgButton" data-id="'+k+'" ><i class="fa fa-plus"></i></span>';
												"</div>"
						htmlRes +="<div class='row' id='infoSlider'>"+
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
				}
			})	
		}
		if(!notEmptySlide){
			var htmlRes = 	"<li>"+
								"<div class='center'>"+
									" <i class='fa fa-calendar fa-5x text-red'></i>"+
									" <br> No upcoming events" +
									" <br> Click on <i class='fa fa-plus'></i> to add a new event"+
								"</div>"+
							"</li>";
			$("#slidesAgenda").append(htmlRes);
		}

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

	function updateSliderAgenda(nEvent){
		console.log("nEvent", nEvent);
		events[nEvent["_id"]["id"]] = nEvent;
		$('#flexsliderAgenda').removeData("flexslider")
		$('#flexsliderAgenda').empty();
		$('#flexsliderAgenda').append('<ul class="slides" id="slidesAgenda">');
		initDashboardAgenda();
		$(".flexslider").flexslider();
	}

	function updateSliderImage(id, imagePath){
		events[id]["imagePath"] = imagePath;
		$('#flexsliderAgenda').removeData("flexslider")
		$('#flexsliderAgenda').empty();
		$('#flexsliderAgenda').append('<ul class="slides" id="slidesAgenda">');
		initDashboardAgenda();
		$(".flexslider").flexslider();
	}


	function clearFileUploadAgenda(){
		$("#agendaNewPicture").css("display", "none");
		$("#flexsliderAgenda").css("display", "block");
		initDashboardAgenda();
	}
 </script>
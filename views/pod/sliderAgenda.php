<style type="text/css">
	#sliderAgenda .flexslider{
		margin : 0px 0px 0px;
	}
	#sliderAgenda .flex-control-nav{
		opacity: 0;
	}
	#sliderAgenda{
		min-height: 230px;
		max-height: 350px;
		overflow: none;
	}
	.banniereSlider{
		position: relative;
		overflow: hidden;
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

    .banniereSlider img, .banniereSlider .defaultImage {
	  left: 0;
	  position: absolute;
	  vertical-align: middle;
	  width: 100%;

	}

</style>


<div id="sliderAgenda">
    <div class="panel panel-white">

    	<div class="panel-heading border-light">
        	<h4 class="panel-title slidesAgendaTitle text-center"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> <?php echo Yii::t("sliderAgenda","Loading Shared Calendar Section",null,Yii::app()->controller->module->id) ?>/h4>
     	</div>
	
     	<div class="panel-tools">

	        <?php if(isset($canEdit) && $canEdit){ ?>
			   <a href="#newEvent" class="init-event btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add an Event" alt="<?php echo Yii::t("sliderAgenda","Add an event",null,Yii::app()->controller->module->id) ?>"><i class="fa fa-plus"></i></a>
		    <?php } ?>
      	</div>

       	<div class="panel-body panel-portfolio radius-bottomRightLeft no-padding">

       		<!-- Slider -->
		  	<div class="flexslider" id="flexsliderAgenda">
				<ul class="slides" id="slidesAgenda"></ul>	
		  	</div>

		  	<!--FileUploader -->
		  	<!--<div id="agendaNewPicture">
			  	<div class="agendaNewPicture" ></div>
			  	<div class="row center">
					<a href="#" class="btn btn-light-blue validateSliderAgenda">Terminer </a>
				</div>
			</div> -->

		</div>
    </div>
</div>

<script type="text/javascript">

	/* PHP Variable
		events : list of the context users events
		contentID : type of the picture
	*/

	var canEditAgenda = "<?php if(isset($canEdit)){ echo $canEdit;}else{ echo false;} ?>";
	var editAgenda = "<?php if(isset($canEdit)) echo $canEdit; else echo false; ?>"
	var eventTest = <?php echo (isset($eventTest)) ? json_encode($eventTest) : "{}" ?>;
	var controllerId = "<?php echo Yii::app()->controller->id; ?>"

	var eventsAgenda = <?php echo (isset($eventsAgenda)) ? json_encode($eventsAgenda) : "{}" ?>;
	var tabSlide = [];
 	jQuery(document).ready(function() {	 
 		initSlides();
		initDashboardAgenda(tabSlide);	

		$('.init-event').off().on("click", function(){
			$.subview({
				content : "#ajaxSV",
				onShow : function() {
					var url = "";
					if("undefined" != typeof organization){
						url = baseUrl+"/"+moduleId+"/event/eventsv/id/<?php echo $_GET["id"]?>/type/<?php echo Organization::COLLECTION ?>";
					}else{
						url = baseUrl+"/"+moduleId+"/event/eventsv/id/<?php echo $_GET["id"]?>/type/<?php echo Person::COLLECTION ?>";
					}
					getAjax("#ajaxSV", url, function(){bindEventSubViewEvents(); $(".new-event").trigger("click");}, "html");
				},
				onSave : function() {
					$('.form-event').submit();
				},
				onHide : function() {
					//$.hideSubview();
				}
			});
		})
	});


 	function bindBtnSliderAgenda(){
 		// Close fileupload div anc clear slider
		$(".validateSliderAgenda").off().on("click", function() {
			clearFileUploadAgenda();
		})

		$(".owl-prev").off().on("click", function(){
			$('#flexsliderAgenda').flexslider("prev");
		})

		$(".owl-next").off().on("click", function(){
			$('#flexsliderAgenda').flexslider("next");
		})			

		$(window).on('resize', function(){
			resizeSliderAgenda();
		});
 	}

 	function initSlides(){
 		var today = new Date();

		// if false init slider with empty message
		var emptySlide = true;

		// dynamic width and height for the slides images
		
		$.each(eventsAgenda, function(k, v){
			emptySlide = false;
			var endDate = v.endDate;
			var startDate = v.startDate;
			console.log(startDate,endDate);
			if('undefined' != typeof startDate && 'undefined' != typeof endDate){	
				console.log("evenAgenda", v.imageUrl);
				console.log("date", startDate, endDate);
				var period = formatPeriodValue(startDate, endDate);
				var date = new Date(endDate.split("-")[2].split(" ")[0], parseInt(endDate.split("-")[1])-1, endDate.split("-")[0]);
				notEmptySlide = true;
				var imageUrl = "<div class='defaultImage' ></br><i class='fa fa-calendar fa-5x text-red'></i><br> <?php echo Yii::t('sliderAgenda','No picture for this event',null,Yii::app()->controller->module->id) ?> </div>";
				if ('undefined' != typeof v.imageUrl && v.imageUrl != ""){
					imageUrl =  "<img src='"+baseUrl +"/" + moduleId +"/document/resized/750x338"+ v.imageUrl+"'></img>";
				}
				var htmlRes = "<li>"+
									"<div class='center' >"+
										"<div class='banniereSlider col-md-12'>"+
											imageUrl+
										"</div>"+
									"</div>"+
									"<div class='center' >"+
										"<div class=' globLeftPartWhiteBlockAgendaPartage'>"+
											"<span class='jourAgenda' class='text-right'>"+period[0]+"</span><br/>"+
											"<span class='moisAgenda' class='text-right'>"+period[1]+"</span>"+
										"</div><br>"+
										"<div class='radius-bottomLeftRight_Mobile pull-bottom globRightPartWhiteBlockAgendaPartage'>"+
											"<div class='globTitlePostAgenda'>"+
												"<span class='titlePostAgenda font_Helvetica'>"+v.name+"</span>"+
											"</div>"+
											"<a class='identButton btn btn-green btn-block text-left radius-bottomRight addItalic' href='"+baseUrl + "/" + moduleId + "/event/dashboard/id/"+v["_id"]["$id"]+"'>"+
												"En savoir + <i class='fa fa-chevron-right'></i>"
											"</a>"+
										"</div>"+
									"</div>"+
								"</li>";
									
				tabSlide.push(htmlRes);
			}
		})	
		
		if(emptySlide){
			var message ="<br><?php echo Yii::t('sliderAgenda','No upcoming events',null,Yii::app()->controller->module->id) ?>"
			if(canEditAgenda)
				message+= "<br><?php echo Yii::t('fileUpload','Click on',null,Yii::app()->controller->module->id) ?> <i class='fa fa-plus'></i> <?php echo Yii::t('sliderAgenda','to add a new event',null,Yii::app()->controller->module->id) ?>";
			var htmlRes = 	"<li>"+
								"<div class='banniereSlider center' >"+
									" </br><i class='fa fa-calendar fa-5x text-red'></i>"+message+
								"</div>"+
							"</li>";
			tabSlide.push(htmlRes);
			//$("#slidesAgenda").append(htmlRes);
		}
 	}
 	/*
 		Init the flexSlider with the next events or with default empty message
 	*/

	function initDashboardAgenda(tab){
		
		var width =  parseInt($("#sliderAgenda .panel-body").css("width"));
		var height = parseInt($("#sliderAgenda").css("min-height"))*80/100;

		for(var i=0; i<tab.length; i++){
			$("#slidesAgenda").append(tab[i]);
		}
		// reload Slider
		$("#flexsliderAgenda").flexslider({
			animationLoop: true,
			animation : "slide",
			slideshow: true,
		});

		$(".slidesAgendaTitle").html("<?php echo Yii::t('sliderAgenda','SHARED CALENDAR',null,Yii::app()->controller->module->id) ?>");
		$(".banniereSlider").css("height", height);
		$(".defaultImage").css("height", height);
		
		bindBtnSliderAgenda();
		//showCalendarDashBoard(data);
	}

	//Return true if the date d < date f
	function compareDate(d, f){
		var res = false;
		console.log(d, f, d<= f)
		if(d <= f){
			res= true;
		}
		return res;
	}

	//convert a period to a string
	function formatPeriodValue(d, f){
		console.log("getStringPeriodValue : ",d,f);
		var mapMonth = {"01":"JANV.", "02": "FEVR.", "03":"MARS", "04":"AVRIL", "05":"MAI", "06":"JUIN", "07":"JUIL.", "08":"AOUT", "09":"SEPT.", "10":"OCTO.", "11":"NOVE.", "12":"DECE."};
		var strPeriod = [];
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
					strPeriod[0] = parseInt(fTab[2])+" "+mapMonth[fTab[1]]+" "+fTab[1];
					strPeriod[1] = " de "+dHour+" à "+fHour;
				}else{
					strPeriod[0] = parseInt(dTab[2])+" au "+ parseInt(fTab[2]);
					strPeriod[1] = mapMonth[fTab[1]]+" "+fTab[0];
				}
			}else{
				strPeriod[0] = parseInt(dTab[2])+" "+mapMonth[dTab[1]];
				strPeriod[1] = " au "+ parseInt(fTab[2])+" "+mapMonth[fTab[1]]+" "+fTab[0];
			}
		}else{
			strPeriod[0] = parseInt(dTab[2])+" "+mapMonth[dTab[1]]+" "+dTab[0]+" au ";
			strPeriod[1] = parseInt(fTab[2])+" "+mapMonth[fTab[1]]+" "+fTab[2];
		}
//		console.table(strPeriod);
		return strPeriod;
	}

	
	function resizeSliderAgenda(){
		$('#flexsliderAgenda').removeData("flexslider")
		$('#flexsliderAgenda').empty();
		$('#flexsliderAgenda').append('<ul class="slides" id="slidesAgenda">');
		/*$('#flexsliderAgenda').append('<div class="navigator padding-0" id="globWhiteBlockAgendaPartage">'+
      										'<a href="javascript:;" class="circle-50 partition-grey owl-prev"><i class="fa fa-chevron-left text-extra-large"></i></a>'+
                    						'<a href="javascript:;" class="circle-50 partition-grey owl-next"><i class="fa fa-chevron-right text-extra-large"></i></a>'+
            						'</div>');
        */
		initDashboardAgenda(tabSlide);
	}

 </script>
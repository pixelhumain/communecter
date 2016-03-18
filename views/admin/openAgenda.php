<div class="panel panel-white">
	<div>
		<div class="panel-heading text-center border-light">
			<h3 class="panel-title text-red"><i class="fa fa-calendar"></i> OpenAgenda</h3>
		</div>
		<div class="panel-body">
			<div class="col-sm-12 col-xs-12">
				<a href="#" class="btn btn-primary" id="collectOpenAgenda"> Récupérer les évenements de OpenAgenda </a>
			</div>
		</div>
	</div>


	<div id="divCheckEvents">
		<div class="panel-heading border-light">
			<h4 class="panel-title">Vérification avant l'import</h4>
		</div>
		<div class="panel-body">
			<div class="col-xs-12 col-sm-4">
				<div class="panel-scroll row-fluid height-300">
					<input type="hidden" id="jsonEventsAdd" name="jsonEventsAdd" />
					<h3 class="panel-title text-green text-center"><i class="fa fa-plus"></i> <?php echo Yii::t("common", "ADD"); ?> : <span id="nbAdd" ></span></h3>
					<br/>
					<table id="EventsAdd" class="table table-striped table-hover">

					</table>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="panel-scroll row-fluid height-300">
					<input type="hidden" id="jsonEventsUpdate" name="jsonEventsUpdate" value=""/>
					<h3 class="panel-title text-orange text-center"><i class="fa fa-pencil"></i> <?php echo Yii::t("common", "UPDATE"); ?> : <span id="nbUpdate" ></span></h3>
					<br/>
					<table id="EventsUpdate" class="table table-striped table-hover">

					</table>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="panel-scroll row-fluid height-300">
					<input type="hidden" id="jsonEventsDelete" name="jsonEventsDelete" value=""/>
					<h3 class="panel-title text-red text-center"><i class="fa fa-minus"></i> <?php echo Yii::t("common", "DELETE"); ?> : <span id="nbDelete" ></span></h3>
					<br/>
					<table id="EventsDelete" class="table table-striped table-hover">

					</table>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 text-center">
				<a href="#" class="btn btn-primary col-sm-2" id="importOpenAgenda"> <?php echo Yii::t("common", "IMPORT"); ?></a>
			</div>
			
		</div>
	</div>
</div>

<script type="text/javascript">

//$(".moduleLabel").html("<i class='fa fa-cog'></i> Espace administrateur : Import de données");

jQuery(document).ready(function() {
	$("#divCheckEvents").hide();
	bindEvents();
});


function bindEvents(){
	$("#collectOpenAgenda").off().on('click', function(e){
		rand = Math.floor((Math.random() * 8) + 1);
		$.blockUI({message : '<div class="title-processing homestead"><i class="fa fa-spinner fa-spin"></i> Processing... </div>'
				+'<a class="thumb-info" href="'+proverbs[rand]+'" data-title="Proverbs, Culture, Art, Thoughts"  data-lightbox="all">'
				+ '<img src="'+proverbs[rand]+'" style="border:0px solid #666; border-radius:3px;"/></a><br/><br/>'
				});

		var dateToday  = "<?php echo date('d').'/'.date('m').'/'.date('Y') ;?>";
		var date50  = "<?php echo date('d').'/'.date('m').'/'.(date('Y')+50) ;?>";
		var page = 1 ;
		var url = "";

		//https://api.openagenda.com/v1/events?lang=fr&key=6e08b4156e0860265c61e59f440ffb0e&when=18/03/2016-18/03/2066&limit=0

		url = "//api.openagenda.com/v1/events?lang=fr&key=6e08b4156e0860265c61e59f440ffb0e&when="+dateToday+"-"+date50+"&limit=0";
		
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'jsonp',
			json: "callback",
			async:false,
			success: function (obj){
				var x = obj.total;
				var y = 100;
				var d = 0
				if(x%y > 0) 
					d = 1 ;
					s = Number((x / y).toFixed(0)) ;
				var z =  d + s;

				var finish = {};
				finish["arrayAdd"]  = [];
				finish["arrayUpdate"]  = [];
				finish["arrayDelete"]  = [];

				finish["ligneAdd"]  = "";
				finish["ligneUpdate"]  = "" ;
				finish["ligneDelete"]  = "" ;
				
				check(z, 1, dateToday, date50, finish);
				console.log("res", res);

			},
			error: function (error) {
				console.log('error', error);
			}
		});
		
	});


	$("#importOpenAgenda").off().on('click', function(e){
		rand = Math.floor((Math.random() * 8) + 1);
		$.blockUI({message : '<div class="title-processing homestead"><i class="fa fa-spinner fa-spin"></i> Processing... </div>'
				+'<a class="thumb-info" href="'+proverbs[rand]+'" data-title="Proverbs, Culture, Art, Thoughts"  data-lightbox="all">'
				+ '<img src="'+proverbs[rand]+'" style="border:0px solid #666; border-radius:3px;"/></a><br/><br/>'
				});
		$.ajax({
			url: baseUrl+'/communecter/admin/importeventsopenagendaindb/',
			type: 'POST',
			dataType: 'json',
			data : {
				jsonEventsAdd : $("#jsonEventsAdd").val(),
				jsonEventsUpdate : $("#jsonEventsUpdate").val(),
				jsonEventsDelete : $("#jsonEventsDelete").val(),
			},
			success: function (data){
				console.log('success', data);
				$.unblockUI();
				toastr.success(data.result.length + " events ont été ajoutés et/ou modifier");
			},
			error: function (error) {
				console.log('error', error);
			}
		});
	});

}



function checkEventsOpenAgendaInDB(data){
	var arrayAdd = [] ;
	var arrayUpdate = [] ;
	var arrayDelete = [] ;
	var arrayEvents = {} ;
	
	$.ajax({
		url: baseUrl+'/communecter/admin/checkventsopenagendaindb/',
		type: 'POST',
		dataType: 'json',
		data : {
			events : data
		},
		async:false,
		complete: function () {},
		success: function (result){
			console.log('result', result);
			console.log('Add', result.Add.length);
			console.log('Update', result.Update.length);
			console.log('Delete', result.Delete.length);
			arrayEvents["Add"] = result.Add;
			arrayEvents["Update"] = result.Update;
			arrayEvents["Delete"] = result.Delete;
		},
		error: function (error) {
			console.log('error', error);
		}
	});
	
	
 	return arrayEvents ;
}

function check (nbpage, page, dateToday, date50, finish){
	
	var url = "//api.openagenda.com/v1/events?lang=fr&key=6e08b4156e0860265c61e59f440ffb0e&when="+dateToday+"-"+date50+"&limit=1000&page="+page ;
	console.log('url', url);
	
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'jsonp',
		async:false,
		success: function (obj){
			console.log('success', obj);
			
			var allEvents = checkEventsOpenAgendaInDB(obj);
			$.each(allEvents, function( stateEvent, arrayEvents ) {
				var nbEvents = 0;
				$.each(arrayEvents, function( keyEvent, Event ) {
					//console.log(stateEvent, keyEvent, Event);
					nbEvents++;
					if(stateEvent == "Add"){
						finish["arrayAdd"].push(Event);
						finish["ligneAdd"] += "<tr><td>"+Event.title.fr+"</td></tr>" ;
					}	
					else if(stateEvent == "Update"){
						finish["arrayUpdate"].push(Event);
						finish["ligneUpdate"] += "<tr><td>"+Event.title.fr+"</td></tr>" ;
					}
					else if(stateEvent == "Delete"){
						finish["arrayDelete"].push(Event);
						finish["ligneDelete"] += "<tr><td>"+Event.title.fr+"</td></tr>" ;
					}
				
				});
			});

			/*finish["arrayAdd"]  = arrayAdd.concat(finish["arrayAdd"]);
			finish["arrayUpdate"]  = arrayUpdate.concat(finish["arrayUpdate"]);
			finish["arrayDelete"]  = arrayDelete.concat(finish["arrayDelete"]);

			finish["ligneAdd"]  = ligneAdd + finish["ligneAdd"];
			finish["ligneUpdate"]  = ligneUpdate + finish["ligneUpdate"] ;
			finish["ligneDelete"]  = ligneDelete + finish["ligneDelete"] ;*/

			if(nbpage > page){
				page++;
				check(nbpage, page, dateToday, date50, finish);
			}else{
				callbackF(finish);
			}
		},
		error: function (error) {
			console.log('error', error);
		}
	});
	


	
}


function callbackF(finish){

	$("#nbAdd").html(finish["arrayAdd"].length + " Event(s)");
	$("#EventsAdd").html(finish["ligneAdd"]);
	$("#jsonEventsAdd").val(JSON.stringify(finish["arrayAdd"]));

	$("#nbUpdate").html(finish["arrayUpdate"].length + " Event(s)");
	$("#EventsUpdate").html(finish["ligneUpdate"]);
	$("#jsonEventsUpdate").val(JSON.stringify(finish["arrayUpdate"]));

	$("#nbDelete").html(finish["arrayDelete"].length + " Event(s)");
	$("#EventsDelete").html(finish["ligneDelete"]);
	$("#jsonEventsDelete").val(JSON.stringify(finish["arrayDelete"]));

	$("#divCheckEvents").fadeIn("slow", function() {});
	$.unblockUI();
	console.log('---------FINISH---------------', finish);
}


</script>

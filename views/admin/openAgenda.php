<div class="panel panel-white">
	<div>
		<div class="panel-heading text-center border-light">
			<h3 class="panel-title text-red"><i class="fa fa-calendar"></i> OpenAgenda</h3>
		</div>
		<div class="panel-body">
			<div class="col-xs-12">
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
			</br></br>
			<div class="col-xs-12 col-sm-12 text-center">
				<table id="tableRes" class="table table-striped table-bordered table-hover">
		    		<thead>
			    		<tr>
			    			<th class="col-sm-5">Entité</th>
			    			<th class="col-sm-5">Result</th>
			    		</tr>
		    		</thead>
			    	<tbody class="directoryLines" id="bodyResult">
				    	
					</tbody>
				</table>
			</div>
		</div>
	</div>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	setTitle("Espace administrateur : Open Agenda","cog");
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
		var url = "https://api.openagenda.com/v1/events?lang=fr&key=6e08b4156e0860265c61e59f440ffb0e&when=18/03/2016-18/03/2066&limit=0";

		mylog.log("url", url);
		$.ajax({
			url: baseUrl+'/communecter/admin/getdatabyurl/',
			type: 'POST',
			dataType: 'json', 
			data:{ url : url },
			async : false,
			success: function (obj){
				mylog.log('success', obj.data, obj.total);
				var object = jQuery.parseJSON(obj.data);
				var x = object.total;
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
				mylog.log("res", res);


				
			},
			error: function (error) {
				mylog.log('error', error);
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
				jsonEventsUpdate : $("#jsonEventsUpdate").val()
			},
			success: function (data){
				mylog.log('success', data);
				var ligne = "" ;
				if(typeof data.result != "undefined"){
					toastr.success(data.result.length + " events ont été ajoutés et/ou modifier");
					$.each(data.result, function( key, events ){
						ligne += "<tr><td>"+events.name+"</td><td>"+events.msg+"</td></tr>" ;
					});
				}
				else{
					toastr.success("Aucun evenement n'a été ajouté et/ou modifier");
				}

				if(typeof data.error != "undefined"){
					$.each(data.error, function( key, events ){
						ligne += "<tr><td>"+events.name.fr+"</td><td>"+events.msg+"</td></tr>" ;
					});
				}

				$("#bodyResult").html(ligne);

				$.unblockUI();
					
			},
			error: function (error) {
				mylog.log('error', error);
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
			mylog.log('result', result);
			mylog.log('Add', result.Add.length);
			mylog.log('Update', result.Update.length);
			mylog.log('Delete', result.Delete.length);
			arrayEvents["Add"] = result.Add;
			arrayEvents["Update"] = result.Update;
			arrayEvents["Delete"] = result.Delete;
		},
		error: function (error) {
			mylog.log('error', error);
		}
	});
	
	
 	return arrayEvents ;
}

function check (nbpage, page, dateToday, date50, finish){
	
	var url = "https://api.openagenda.com/v1/events?lang=fr&key=6e08b4156e0860265c61e59f440ffb0e&when="+dateToday+"-"+date50+"&limit=1000&page="+page ;
	mylog.log('url', url);
	
	$.ajax({
		url: baseUrl+'/communecter/admin/getdatabyurl/',
		type: 'POST',
		dataType: 'json', 
		data:{ url : url },
		async : false,
		success: function (object){
			mylog.log('success', object);
			var obj = jQuery.parseJSON(object.data);
			mylog.log('obj', obj);
			var allEvents = checkEventsOpenAgendaInDB(obj);
			$.each(allEvents, function( stateEvent, arrayEvents ) {
				var nbEvents = 0;
				$.each(arrayEvents, function( keyEvent, Event ) {
					//mylog.log(stateEvent, keyEvent, Event);
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

			if(nbpage > page){
				page++;
				check(nbpage, page, dateToday, date50, finish);
			}else{
				callbackF(finish);
			}
		},
		error: function (error) {
			mylog.log('error', error);
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
	mylog.log('---------FINISH---------------', finish);
}


</script>

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
		$.ajax({
			url: "//api.openagenda.com/v1/events?uids[]=39616433&uids[]=76959109&uids[]=26938900&key=36528cb9cc14c9c3920000fd0d5890f8",
			type: 'POST',
			dataType: 'jsonp',
			json: "callback",
			crossDomain:true,
			complete: function () {},
			success: function (obj){
				console.log('success', obj);

				var allEvents = checkEventsOpenAgendaInDB(obj);
				$.each(allEvents, function( stateEvent, arrayEvents ) {
					var ligne = "";
					var nbEvents = 0;

					$.each(arrayEvents, function( keyEvent, Event ) {
						console.log(stateEvent, keyEvent, Event);
						nbEvents++;
						ligne += "<tr><td>"+Event.title.fr+"</td></tr>" ;
					});

					if(stateEvent == "Add"){
						$("#nbAdd").html(nbEvents + " Event(s)");
						$("#EventsAdd").html(ligne);
						$("#jsonEventsAdd").val(JSON.stringify(allEvents.Add));
					}	
					else if(stateEvent == "Update"){
						$("#nbUpdate").html(nbEvents + " Event(s)");
						$("#EventsUpdate").html(ligne);
						$("#jsonEventsUpdate").val(JSON.stringify(allEvents.Update));
					}
					else if(stateEvent == "Delete"){
						$("#nbDelete").html(nbEvents + " Event(s)");
						$("#EventsDelete").html(ligne);
						$("#jsonEventsDelete").val(JSON.stringify(allEvents.Delete));
					}

					
				});
				$("#divCheckEvents").fadeIn("slow", function() {});

			},
			error: function (error) {
				console.log('error', error);
			}
		});
	});


	$("#importOpenAgenda").off().on('click', function(e){
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
	$.each(data.data, function( key, val ) {
		//console.log(data.data.location);
		$.ajax({
			url: baseUrl+'/communecter/admin/checkventsopenagendaindb/',
			type: 'POST',
			dataType: 'json',
			data : {
				OpenAgendaID : val.uid,
				modified : val.updatedAt,
				location : val.locations
			},
			async:false,
			complete: function () {},
			success: function (result){
				console.log('success', result);
				if(result.state == "Add")
					arrayAdd.push(val);
				else if(result.state == "Update")
					arrayUpdate.push(val);
				else if(result.state == "Delete")
					arrayDelete.push(val);
			},
			error: function (error) {
				console.log('error', error);
			}
		});
	});
	arrayEvents["Add"] = arrayAdd;
	arrayEvents["Update"] = arrayUpdate;
	arrayEvents["Delete"] = arrayDelete;
	console.log("arrayAdd", arrayAdd);
 	return arrayEvents ;
}



</script>

<?php
	$cs = Yii::app()->getClientScript();
	if(!Yii::app()->request->isAjaxRequest)
	{
	  	$cssAnsScriptFilesModule = array(
	  		'/assets/plugins/nvd3/nv.d3.js',
	  		);
	  	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
  	}
	//$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.js' , CClientScript::POS_END);
	//$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-select/bootstrap-select.min.js' , CClientScript::POS_END);
?>
<style>
	.chart{
		height: 400px;
	}
	.chart svg{
		width: 100%;
		height: 100%;
	}
</style>
<?php
	if(isset($_GET['typeData']))
		$typeData = $_GET['typeData'];
	else
		$typeData = "population";
?>
<?php //$this->renderPartial('filterMenu.php', array("userId" => (string)$person["_id"])); ?>
<div class='panel panel-white' id="<?php echo $name_id; ?>_panel">
	<div class="panel-heading border-light">
		
		<span id="<?php echo $name_id; ?>_titleGraph" class="text-large titlePod"> Statistique Population </span>
		<ul class="panel-heading-tabs border-light ulline">
			<li>
				<label class = "label_dropdown">Département : <?php echo $nbCitiesDepartement; ?> communes </label>
			</li>
			<li>
				<label class = "label_dropdown">Région : <?php echo $nbCitiesRegion; ?> communes </label>
			</li>
			<li>
				<label class = "label_dropdown" for="typeGraph">Voir : </label>
				<div class="btn-group">
					<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
						<span id="label-type"> Population </span><span class="caret"></span>
					</a>
					<ul role="menu" class="dropdown-menu" id="typeGraph">
						<!--<li>
							<a  class="btn-drop typeBtn" data-name="population">Population</a>
						</li>
						<li>
							<a  class="btn-drop typeBtn" data-name="entreprise">Entreprise</a>
						</li>-->
						<?php
							$where = array("insee"=>$_GET['insee']);
     						$fields = array();
     						$option = City::getWhereData($where, $fields);
     						$chaine = "" ;
     						foreach ($option as $key => $value) 
     						{
     							foreach ($value as $k => $v) 
     							{
     								if($k != "_id" && $k != "insee")
	     							$chaine = $chaine.'<li>
										<a  class="btn-drop typeBtn" data-name="'.$k.'">'.$k.'</a>
									</li>';	
	     						}

     						}
     						echo $chaine ;
						?>
						
					</ul>
				</div>
			</li>
			<li>
				<label class = "label_dropdown" for="label-option">Option : </label>
				<div class="btn-group">
					<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
						<span id="label-option"> Total </span><span class="caret"></span>
					</a>

					<ul role="menu" class="dropdown-menu pull-right" id="filterGraph">
						<?php
							$where = array("insee"=>$_GET['insee'], $typeData => array( '$exists' => 1 ));
     						$fields = array($typeData);
     						$option = City::getWhereData($where, $fields);
     						$chaine = "" ;
     						foreach ($option as $key => $value) 
     						{
     							foreach ($value as $k => $v) 
     							{
	     							if($k == $typeData)
	     							{
	     								if(isset($optionData))
	     								{
	     									$chaine = CityOpenData::listOptionWithOptionChecked($v, $chaine, $name_id, $optionData);
	     								}	
	     								else
	     									$chaine = CityOpenData::listOption($v, $chaine, true, $name_id);
	     							}	
	     						}
     						}
     						echo $chaine ;
						?>

					</ul>
				</div>
			</li>			
		</ul>
	</div>
	<div class="panel-heading border-light divline">
		<ul  class="panel-heading-tabs border-light ulline">
			<li>
				<label class = "label_dropdown" for="typeGraph">Type graph : </label>
				<div class="btn-group">
					<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
						<span id="label-graph">
							<?php
								if(isset($_GET['typeGraph']))
									echo $_GET['typeGraph'] ;
								else
									echo "Multi-Bar";
							?>
						</span><span class="caret"></span>
					</a>
					<ul role="menu" class="dropdown-menu" id="typeGraph" >
						<li>
							<a class="btn-drop graphBtn" data-name="multibart">Multi-Bar</a>
						</li>
						<li>
							<a  class="btn-drop graphBtn" data-name="piechart">PieChart</a>
						</li>
					</ul>
				</div>
			</li>
			<li>
				<label class = "label_dropdown" for="zoneGraph">Filtrer par : </label>
				<div class="btn-group">
					<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
						<span id="label-zone"> <?php
								if(isset($_GET['type']))
									echo $_GET['type'] ;
								else
									echo "Commune";
							?> </span><span class="caret"></span>
					</a>
					<ul role="menu" class="dropdown-menu pull-right" id="zoneGraph" >
						<li>
							<a class="btn-drop locBtn" data-name="commune" >Commune</a>
						</li>
						<li>
							<a  class="btn-drop locBtn" data-name="departement">Departement</a>
						</li>
						<li>
							<a  class="btn-drop locBtn" data-name="region">Region</a>
						</li>
					</ul>
				</div>
			</li>
			<li id="filtreByCommune">
				<div class="btn-group">
					<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
						<span id="label-cities"> Aucune communes sélectionnés </span><span class="caret"></span>
					</a>
					<ul role="menu" class="dropdown-menu pull-right" id="filterCities">
					</ul>
				</div>
			</li>
		</ul>
	</div>

	<div class='panel-body panel-white'>
		<div id="<?php echo $name_id; ?>_chart" class="chart">
			<svg ></svg>
		</div>
	</div>
	<div class="space20"></div>	
</div>


<script type="text/javascript">
	
	

	jQuery(document).ready(function() {
		var insee = "<?php echo $_GET['insee']; ?>";
		var res ="";
		var map = <?php echo json_encode($cityData) ?>;
		var name_id ='<?php echo $name_id ; ?>';
		
		var typeData ='<?php if(isset($_GET["typeData"])) echo $_GET["typeData"]; else echo "population"; ?>';
		var typeGraph ='<?php if(isset($_GET["typeGraph"])) echo $_GET["typeGraph"] ; else echo "multibar"; ?>';
		var typeZone ='<?php if(isset($_GET["type"])) echo $_GET["type"] ; else echo "commune"; ?>';
		//var optionData ='<?php if(isset($_GET["option"])) echo $_GET["option"]; else echo "undefined"; ?>';
		//alert('<?php if(isset($inseeCities)) json_encode($inseeCities) ; else json_encode(array()); ?>');
		var citiesChecked ='<?php if(isset($inseeCities)) echo json_encode($inseeCities) ; else echo json_encode(array()); ?>';
		var optionChecked = getValueChekbox(name_id);
		var optionCheckedCities = getValueChekboxCities(insee, name_id);

		modifyListCities(insee, typeData, typeZone, name_id, typeGraph, optionCheckedCities, citiesChecked, optionChecked)
		
		bindBtnAction(insee, typeData, typeZone, optionChecked, name_id, typeGraph, optionCheckedCities);
		sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph, optionCheckedCities);

		if(typeZone == "commune")
			$("#<?php echo $name_id ; ?>_panel #filtreByCommune").hide();
		//$("#<?php echo $name_id ; ?>_panel #listCommune").select2();
		//$("#<?php echo $name_id ; ?>_panel #listCommune").selectpicker();
	});

function bindBtnAction(insee, typeData, typeZone, optionChecked, name_id, typeGraph, optionCheckedCities)
{
	console.warn("----------------- bindBtnAction -----------------");
	//console.log(name_id + "_panel : ", insee, typeData, typeZone, optionChecked);
	$("#"+name_id+"_panel .locBtn" ).off().on("click", function() {
		console.warn("----------------- locBtn -----------------");
		$("#label-zone").text($(this).text());
		typeZone = $(this).data("name");
		
		if(typeZone != "commune")
		{
			modifyListCities(insee, typeData, typeZone, name_id, typeGraph, optionCheckedCities, [], optionChecked)
		}
		else
			$("#<?php echo $name_id ; ?>_panel #filtreByCommune").hide();

		sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph, optionCheckedCities);

	});


	$("#"+name_id+"_panel .graphBtn" ).off().on("click", function() {
		
		$("#label-graph").text($(this).text());
		typeGraph = $(this).data("name");
		sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph, optionCheckedCities);
		
	});

	$("#"+name_id+"_panel .typeBtn").off().on("click", function(){
		
		typeData = $(this).data("name");
		
		$("#<?php echo $name_id ; ?>_panel #label-type").text($(this).text());
		modifyListOption(insee, typeData, typeZone, name_id, optionCheckedCities);
		/*var urlToSend = baseUrl+"/"+moduleId+"/city/getoptiondata/insee/"+insee+"/typeData/"+typeData;
		$.ajax({
			type: "POST",
			url: urlToSend,
			dataType: "json",
			success: function(data){
				console.log("typeBtn", data);
				modifyListOption(insee, typeData, typeZone, name_id);

			}
		});*/

		
	});


	$("#"+name_id+"_panel .optionBtn").off().on("click", function(){
		
		optionChecked = getValueChekbox(name_id);
		if(optionChecked.length == 1)
			$("#<?php echo $name_id ; ?>_panel #label-option").text($(this).text());
		else
			$("#<?php echo $name_id ; ?>_panel #label-option").text(optionChecked.length + " éléments séléctionnés");
		//optionData = $(this).data("name");
		sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph, optionCheckedCities);
		
	});


	$("#"+name_id+"_panel .optionCities").off().on("click", function(){
		console.warn("----------------- optionCities -----------------");
		optionCheckedCities = getValueChekboxCities(insee, name_id);
		console.log("optionCheckedCities", optionCheckedCities);
		if(optionCheckedCities == null)
		{
			$("#<?php echo $name_id ; ?>_panel #label-cities").text("Aucunes communes séléctionnés");
		}	
		else
		{
			$("#<?php echo $name_id ; ?>_panel #label-cities").text((optionCheckedCities.length - 1) + " communes séléctionnés");
		}	
		sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph, optionCheckedCities);
		
	});

}


function modifyListOption(insee, typeData, typeZone, name_id, typeGraph, optionCheckedCities){
	console.warn("----------------- modifyListOption -----------------");
	var urlToSend = baseUrl+"/"+moduleId+"/city/getlistoption/";
	$.ajax({
		type: "POST",
		url: urlToSend,
		data:{insee: insee, typeData: typeData, name_id: name_id},
		dataType: "json",
		success: function(data){
			//console.info("modifyListOptionSuccess", data);
			$("#filterGraph").html(data);
			optionChecked = getValueChekbox(name_id);
			bindBtnAction(insee, typeData, typeZone, optionChecked, name_id, typeGraph, optionCheckedCities);
			sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph, optionCheckedCities);
		}
	});
}


function modifyListCities(insee, typeData, typeZone, name_id, typeGraph, optionCheckedCities, citiesChecked, optionChecked){
	console.warn("----------------- modifyListCities -----------------");
	console.log("citiesChecked", citiesChecked);
	$("#<?php echo $name_id ; ?>_panel #filtreByCommune").show();
	var urlToSend = baseUrl+"/"+moduleId+"/city/getlistcities/insee/"+insee+"/zone/"+typeZone;
	$.ajax({
		type: "POST",
		url: urlToSend,
		dataType: "json",
		success: function(data){
			console.log("data", data);
			if(data.result == true)
			{
				console.log(data);
				var chaine = "";
				$.each(data.cities, function(keyCities,valuesCities){
					if(citiesChecked.indexOf(valuesCities['insee']) == -1)
						chaine = chaine + '<li><a class="btn-drop optionCities" data-name="'+valuesCities['insee']+'"><input type="checkbox" id="'+name_id+valuesCities['insee']+'" name="'+name_id+'optionCheckboxCities" value="'+valuesCities['insee']+'"/><label for="'+name_id+valuesCities['insee']+'" >'+valuesCities['name']+'</label></a></li>';
					else
						chaine = chaine + '<li><a class="btn-drop optionCities" data-name="'+valuesCities['insee']+'"><input type="checkbox" id="'+name_id+valuesCities['insee']+'" name="'+name_id+'optionCheckboxCities" value="'+valuesCities['insee']+'" checked/><label for="'+name_id+valuesCities['insee']+'" >'+valuesCities['name']+'</label></a></li>';
				});
				$("#<?php echo $name_id ; ?>_panel #label-cities").text("Aucunes communes séléctionnés");
				$("#<?php echo $name_id ; ?>_panel #filterCities").html(chaine);
				optionCheckedCities = getValueChekboxCities(insee, name_id);
				console.log(optionCheckedCities);
				bindBtnAction(insee, typeData, typeZone, optionChecked, name_id, typeGraph, optionCheckedCities);
				sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph, optionCheckedCities);
			}

		}
	});
}

function getValueChekbox(name_id){
	//console.warn("----------------- getValueChekbox -----------------");
	var optionChecked = [];
	$('input:checked[name='+name_id+'optionCheckbox]').each(function() {
	  optionChecked.push($(this).val());
	});

	if(optionChecked.length == 1)
		$("#<?php echo $name_id ; ?>_panel #label-option").text(optionChecked.length + " éléments séléctionnés");
	return optionChecked ;
}


function getValueChekboxCities(insee, name_id){
	console.warn("----------------- getValueChekbox -----------------");
	var optionCheckedCities = [];
	$('input:checked[name='+name_id+'optionCheckboxCities]').each(function() {
	  optionCheckedCities.push($(this).val());
	});

	if(optionCheckedCities.length == 0)
		optionCheckedCities = null ;
	else
		optionCheckedCities.push(insee);
	
	return optionCheckedCities ;
}

function getMultiBarChart(map, typeData, optionChecked, name_id){
	//console.warn("----------------- getMultiBarChart -----------------");
	//console.log(name_id + "_panel : ", map, typeData, optionChecked);
	//console.log("optionChecked 3 : ",  optionChecked);
	var mapData = buildDataSetMulti(map, typeData,  optionChecked, name_id);
	//console.log(mapData);
	nv.addGraph(function() {
	    var chart = nv.models.multiBarChart()
	    	.stacked(false)
	    	.showControls(false)
	      	.transitionDuration(350)
	      	.reduceXTicks(false)   //If 'false', every single x-axis tick label will be rendered.
	      	.rotateLabels(0)      //Angle to rotate x-axis labels.
	     	.showControls(true)   //Allow user to switch between 'Grouped' and 'Stacked' mode.
	      	.groupSpacing(0.1)
	      	.showYAxis(true) 
          	.showXAxis(true)
          	.margin({
				bottom : 100,
			})
          	.tooltip(function(key, x, y, e, graph) {
          		//console.log("e", e);
			    return '<h3>' + key + '</h3>' +
			           '<p>' +  y + ' on ' + x + '</p>';
			});


	    chart.xAxis
		    .rotateLabels(-45)
		    .tickFormat(function (d) {
		        return  d;
		    });

		
		d3.selectAll("#"+name_id+"_chart svg > *").remove();
		d3.select('#'+name_id+'_chart svg')
		    .datum(mapData)
		    .call(chart);

		nv.utils.windowResize(chart.update);
		
		return chart;
	});
}

function buildDataSetMulti(map, typeData, optionChecked, name_id){
	//console.warn("----------------- buildDataSetMulti -----------------");
	console.log(name_id + "_panel : ", map, typeData, optionChecked);
	var mapData= [];
	var tabYear = [];
	
	$.each(optionChecked, function(keyInd,valuesOptionChecked){
		
		var valInfo ;
		valuesMap=[];
		$.each(map, function(nameCommune,valuesCommune){
			
			$.each(valuesCommune, function(codeInsee,valuesInsee){

				$.each(valuesInsee, function(keyInfo,valuesInfo){
					console.log("valuesInfo", valuesInfo);
					valInfo = valuesInfo ;
					if(typeData == keyInfo)
					{
						var val = {};
						val["x"] = nameCommune;
						val["y"] = jsonHelper.getValueByPath(valuesInfo, add_element_mapping(valuesOptionChecked, "value"));
						console.log("val : ", val);
						valuesMap.push(val);
					}
				});
			});
		});
		var itemMap = {
							"key": jsonHelper.getValueByPath(valInfo, add_element_mapping(valuesOptionChecked, "label")), 
							"values": valuesMap
						};
		mapData.push(itemMap);
		
		console.log("mapData", mapData);
	});
	//console.log("mapData FIN", mapData);
	return mapData;
}

function getPieChart(map, typeData, optionChecked, name_id){
	//console.warn("----------------- getPieChart -----------------");
	//console.log(name_id + "_panel : ", map, typeData, optionChecked);
	var mapData = buildDataSetPie(map, typeData,  optionChecked, name_id);
	
	nv.addGraph(function() {
	  var chart = nv.models.pieChart()
	      .x(function(d) { return d.label })
	      .y(function(d) { return d.value })
	      .showLabels(true)     //Display pie labels
	      .labelThreshold(.05)  //Configure the minimum slice size for labels to show up
	      .labelType("percent") //Configure what type of data to show in the label. Can be "key", "value" or "percent"
	      .donut(true)          //Turn on Donut mode. Makes pie chart look tasty!
	      .donutRatio(0.35)     //Configure how big you want the donut hole size to be.
	      ;
	    d3.selectAll("#"+name_id+"_chart svg > *").remove();
		d3.select('#'+name_id+'_chart svg')
	        .datum(mapData)
	        .transition().duration(350)
	        .call(chart);

	  return chart;
	});
}


function buildDataSetPie(map, typeData, optionChecked, name_id){
	//console.warn("----------------- buildDataSetPie -----------------");
	//console.log(name_id + "_panel : ", map, typeData, optionChecked);
	//console.log("map",map);
	//console.log("str",str);
	var mapData= [];
	$.each(optionChecked, function(keyInd,valuesOptionChecked){
		//console.log("optionChecked", valuesOptionChecked);
		$.each(map, function(nameCommune,valuesCommune){
			$.each(valuesCommune, function(codeInsee,valuesInsee){
				$.each(valuesInsee, function(keyInfo,valuesInfo){
					console.log("valuesInfo", valuesInfo);
					if(typeData == keyInfo)
					{
						var val = {};
						val["label"] = nameCommune + " : " + jsonHelper.getValueByPath(valuesInfo, add_element_mapping(valuesOptionChecked, "label"));
						val["value"] = jsonHelper.getValueByPath(valuesInfo, add_element_mapping(valuesOptionChecked, "value"));
						//console.log("val : ", val);
						mapData.push(val);
					}
				});
			});
		});
		//console.log("mapData", mapData);
	});
	return mapData;
}

function sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph, optionCheckedCities)
{
	//console.warn("----------------- sendData -----------------");
	console.log(name_id + "_panel : ", insee, typeData, typeZone, optionChecked,optionCheckedCities);
	var urlToSend = baseUrl+"/"+moduleId+"/city/getcitydata/insee/"+insee+"/typeData/"+typeData;
	
	if("undefined" != typeZone){
		urlToSend += "/typeZone/"+ typeZone;
	}
	
	//console.log("optionChecked 1 : ",  optionChecked);
	$.ajax({
		type: "POST",
		url: urlToSend,
		data:{optionData: optionChecked, optionCities: optionCheckedCities},
		dataType: "json",
		success: function(data){
			console.info("sendDataSuccess", data);
			if(typeGraph == "piechart")
				getPieChart(data, typeData, optionChecked, name_id);
			else
				getMultiBarChart(data, typeData, optionChecked, name_id);
		}
	});
		
}	


function add_element_mapping(valuesOptionChecked, addElement)
{
	
	var arr = valuesOptionChecked.substring(1).split(".");
	arr.push(addElement);
	var la = arr.toString();
	while(la.search(",") != -1)
	{la = la.replace(",", ".");}
	return la;
}
</script>
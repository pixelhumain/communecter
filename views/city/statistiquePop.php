<?php
	$cs = Yii::app()->getClientScript();
	if(!Yii::app()->request->isAjaxRequest)
	{
	  	$cssAnsScriptFilesModule = array(
	  		'/assets/plugins/nvd3/nv.d3.js',
	  		);
	  	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
  	}
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.js' , CClientScript::POS_END);
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
							<a class="btn-drop locBtn">Commune</a>
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
				<div class="btn-group col-xs-4">
					<select id="listCommune" class="js-example-basic-multiple" multiple="multiple">  	
					</select>
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
		
		
		var optionChecked = getValueChekbox(name_id);
		
		bindBtnAction(insee, typeData, typeZone, optionChecked, name_id, typeGraph);
		sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph);
		$("#<?php echo $name_id ; ?>_panel #filtreByCommune").hide();
		$("#<?php echo $name_id ; ?>_panel #listCommune").select2();
	});

function bindBtnAction(insee, typeData, typeZone, optionChecked, name_id, typeGraph)
{
	console.warn("----------------- bindBtnAction -----------------");
	//console.log(name_id + "_panel : ", insee, typeData, typeZone, optionChecked);
	$("#"+name_id+"_panel .locBtn" ).off().on("click", function() {
		
		$("#label-zone").text($(this).text());
		typeZone = $(this).data("name");

		if(typeZone != "commune")
			$("#<?php echo $name_id ; ?>_panel #filtreByCommune").show();
		else
			$("#<?php echo $name_id ; ?>_panel #filtreByCommune").hide();

		sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph);


	});


	$("#"+name_id+"_panel .graphBtn" ).off().on("click", function() {
		
		$("#label-graph").text($(this).text());
		typeGraph = $(this).data("name");
		sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph);
		
	});

	$("#"+name_id+"_panel .typeBtn").off().on("click", function(){
		
		typeData = $(this).data("name");
		
		$("#<?php echo $name_id ; ?>_panel #label-type").text($(this).text());
		modifyListOption(insee, typeData, typeZone, name_id);
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
		sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph);
		
	});


	$("#"+name_id+"_panel #listCommune").click(function(){
		mapData = buildDataSet(map, $(this).data("name"));
			//console.log(mapData);
			d3.select("#<?php echo $name_id ; ?>_panel #chart svg")
			    .datum(mapData)
			    .call(chart);
			chart.update();
			bindBtnAction(insee, typeData, typeZone, optionChecked, name_id, typeGraph);
	});

	$("#"+name_id+"_panel #listCommune" ).off().on("click", function() {
		
		var cities = [];
		var i = 0 ;
		$("#<?php echo $name_id ; ?>_panel #listCommune option:selected").each(function() 
		{
			cities[i] = $(this).val();
			i++;
		});

		if(i > 0)
		{
			var urlToSend = baseUrl+"/"+moduleId+"/city/getcitiesdata/insee/"+insee+"/typeData/"+typeData;
			if("undefined" != typeZone){
				urlToSend += "/type/"+ typeZone;
			}
			
			$.ajax({
				type: "POST",
				url: urlToSend,
				data : {cities : cities},
				dataType: "json",
				success: function(data){
					console.log("data", data);
					if(typeGraph == "piechart")
						getPieChart(data, typeData, optionChecked, name_id);
					else
						getMultiBarChart(data, typeData, optionChecked, name_id);
					
				}
			});

		}
		else
		{
			var urlToSend = baseUrl+"/"+moduleId+"/city/getcitydata/insee/"+insee+"/typeData/"+typeData;
			if("undefined" != typeZone){
				urlToSend += "/type/"+ typeZone;
			}
			$.ajax({
				type: "POST",
				url: urlToSend,
				dataType: "json",
				success: function(data){
					console.log("data", data);
					if(typeGraph == "piechart")
						getPieChart(data, typeData, optionChecked, name_id);
					else
						getMultiBarChart(data, typeData, optionChecked, name_id);
				}
			});
		}
		

		
	});

}


function modifyListOption(insee, typeData, typeZone, name_id, typeGraph){
	console.warn("----------------- modifyListOption -----------------");
	var urlToSend = baseUrl+"/"+moduleId+"/city/getlistoption/";
	$.ajax({
		type: "POST",
		url: urlToSend,
		data:{insee: insee, typeData: typeData, name_id: name_id},
		dataType: "json",
		success: function(data){
			console.info("modifyListOptionSuccess", data);
			$("#filterGraph").html(data);
			optionChecked = getValueChekbox(name_id);
			console.log("yoyooooooooptionChecked", optionChecked);
			bindBtnAction(insee, typeData, typeZone, optionChecked, name_id, typeGraph);
			sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph);
		}
	});
}

function getValueChekbox(name_id){
	console.warn("----------------- getValueChekbox -----------------");
	var optionChecked = [];
	$('input:checked[name='+name_id+'optionCheckbox]').each(function() {
	  optionChecked.push($(this).val());
	});

	if(optionChecked.length == 1)
		$("#<?php echo $name_id ; ?>_panel #label-option").text(optionChecked.length + " éléments séléctionnés");
	return optionChecked ;
}

function getMultiBarChart(map, typeData, optionChecked, name_id){
	console.warn("----------------- getMultiBarChart -----------------");
	console.log(name_id + "_panel : ", map, typeData, optionChecked);
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
	console.warn("----------------- buildDataSetMulti -----------------");
	console.log(name_id + "_panel : ", map, typeData, optionChecked);
	var mapData= [];
	var tabYear = [];
	
	$.each(optionChecked, function(keyInd,valuesOptionChecked){
		//console.log("optionChecked", valuesOptionChecked);
		valuesMap=[];
		$.each(map, function(nameCommune,valuesCommune){
			$.each(valuesCommune, function(codeInsee,valuesInsee){
				$.each(valuesInsee, function(keyInfo,valuesInfo){
					//console.log("valuesInfo", valuesInfo);
					if(typeData == keyInfo)
					{
						var val = {};
						val["x"] = nameCommune;
						val["y"] = jsonHelper.getValueByPath(valuesInfo, valuesOptionChecked.substring(1));
						//console.log("val : ", val);
						valuesMap.push(val);
					}
				});
			});
		});

		var itemMap = {"key": valuesOptionChecked.substring(1), "values": valuesMap};
		mapData.push(itemMap);
		//console.log("mapData", mapData);
	});
	//console.log("mapData FIN", mapData);
	return mapData;
}

function getPieChart(map, typeData, optionChecked, name_id){
	console.warn("----------------- getPieChart -----------------");
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
	console.warn("----------------- buildDataSetPie -----------------");
	//console.log(name_id + "_panel : ", map, typeData, optionChecked);
	//console.log("map",map);
	//console.log("str",str);
	var mapData= [];
	$.each(optionChecked, function(keyInd,valuesOptionChecked){
		//console.log("optionChecked", valuesOptionChecked);
		$.each(map, function(nameCommune,valuesCommune){
			$.each(valuesCommune, function(codeInsee,valuesInsee){
				$.each(valuesInsee, function(keyInfo,valuesInfo){
					//console.log("valuesInfo", valuesInfo);
					if(typeData == keyInfo)
					{
						var val = {};
						val["label"] = nameCommune + " : " + valuesOptionChecked.substring(1);
						val["value"] = jsonHelper.getValueByPath(valuesInfo, valuesOptionChecked.substring(1));
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

function sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph)
{
	console.warn("----------------- sendData -----------------");
	//console.log(name_id + "_panel : ", insee, typeData, typeZone, optionChecked);
	var urlToSend = baseUrl+"/"+moduleId+"/city/getcitydata/insee/"+insee+"/typeData/"+typeData;
	
	if("undefined" != typeZone){
		urlToSend += "/typeZone/"+ typeZone;
	}
	
	//console.log("optionChecked 1 : ",  optionChecked);
	$.ajax({
		type: "POST",
		url: urlToSend,
		data:{optionData: optionChecked},
		dataType: "json",
		success: function(data){
			console.info("sendDataSuccess", typeData, optionChecked, name_id);
			if(typeGraph == "piechart")
				getPieChart(data, typeData, optionChecked, name_id);
			else
				getMultiBarChart(data, typeData, optionChecked, name_id);
		}
	});
		
}	
</script>
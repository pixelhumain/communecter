<?php

  $cssAnsScriptFilesModule = array(
	
    '/assets/plugins/nvd3/nv.d3.js',
    );

  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);

?>
<style>
	#chart{
		width: 100%;
	}
	#chart svg{
		width: 100%;
		height: 300px;
	}
</style>
<div class='panel panel-white'>
	<div class="panel-heading border-light">
		<span class="text-large"> Statistique Population </span>
		<ul  class="panel-heading-tabs border-light">
			<li>
				<label class = "label_dropdown" for="typeGraph">Voir : </label>
				<div class="btn-group">
					<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
						<span id="label-Pop"> Population </span><span class="caret"></span>
					</a>
					<ul role="menu" class="dropdown-menu" id="typeGraph">
						<li>
							<a href="#" class="btn-drop typeBtn" data-name="population">Population</a>
						</li>
						<li>
							<a href="#" class="btn-drop typeBtn" data-name="homme/femme">Homme/Femme</a>
						</li>
						<li>
							<a href="#" class="btn-drop typeBtn" data-name="hommes">Hommes</a>
						</li>
						<li>
							<a href="#" class="btn-drop typeBtn" data-name="femmes">Femmes</a>
						</li>
					</ul>
				</div>
			</li>
			<li>
				<label class = "label_dropdown" for="typeGraph">Filtrer par : </label>
				<div class="btn-group">
					<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
						<span id="label-City"> Zone </span><span class="caret"></span>
					</a>
					<ul role="menu" class="dropdown-menu" id="localite">
						<li>
							<a href="#" class="btn-drop locBtn">Commune</a>
						</li>
						<li>
							<a href="#" class="btn-drop locBtn" data-name="departement">Departement</a>
						</li>
						<li>
							<a href="#" class="btn-drop locBtn" data-name="region">Region</a>
						</li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
	<div class='panel-body panel-white no-padding'>
		<div id="chart">
			<svg ></svg>
		</div>
	</div>
</div>
<script type="text/javascript">
	var map = <?php echo json_encode($cityData) ?>;
	var insee = "<?php echo $_GET['insee']; ?>";
	var res = "";

	valuesTest = [{ "label" : "P11_POP" ,"value" : 4500 }, { "label" : "P06_POP" ,"value" : 2500 }];

	var mapValue2 = [{"key": "<?php echo $title; ?>","values": [ ]}];

	valuesTest = [{ "label" : "P21_POP" ,"value" : 7500 }, { "label" : "P06_POP" ,"value" : 3500 }];

	mapValue2[0]["values"]=valuesTest;
	jQuery(document).ready(function() {
		
		getMultiBarChart(map);
		bindBtnAction();
	})

	function buildDataGraph(){
		$("svg").empty();
		nv.addGraph(function() {
			chart = nv.models.discreteBarChart()
			    .x(function(d) { return d.label })   
			    .y(function(d) { return d.value })
			    .staggerLabels(true)   
			    .tooltips(true)        
			    .showValues(true)     
			    .transitionDuration(350)


			chart.yAxis
				.tickFormat(d3.format(',.0f'))

			d3.select('#chart svg')
			    .datum(mapData)
			    .call(chart);

			nv.utils.windowResize(chart.update);
			
			return chart;
		})
	}


	function bindBtnAction(){

		$(".typeBtn").click(function(){
			mapData = buildDataSet(map, $(this).data("name"));
				//console.log(mapData);
				d3.select('#chart svg')
				    .datum(mapData)
				    .call(chart);
				chart.update();
				bindBtnAction();
		})

		$( ".locBtn" ).off().on("click", function() {
			var urlToSend = baseUrl+"/"+moduleId+"/city/getcitydata/insee/"+insee;
			if("undefined" != $(this).data("name")){
				urlToSend += "/type/"+ $(this).data("name");
			}
			var localite = $(this).data("name");
			$.ajax({
				type: "POST",
				url: urlToSend,
				dataType: "json",
				success: function(data){
					console.log("data", data);
					getMultiBarChart(data);
		
				}
			})
		})

	}

	function buildDataSet(map, str){
		var mapData= [{"key": "<?php echo $title; ?>","values": [ ]}]
		var obj = getMapObject(map, str);
		//console.log("obj", obj);
		if(obj != ""){
			$.each(obj, function(k, v){
				var val = {};
				val["label"] = k;
				val["value"] = v["total"];
				//console.log('val', val);
				mapData[0].values.push(val);
			})
		}
		return mapData;
	}

	function buildDataSetMulti(map, str){
		var mapData= [];
		
		$.each(map, function(key,values){
			var itemMap = {"key":key,"values": [ ]};
			console.log("-------------------newValue--------------------", values)
			var obj = getMapObject(values, str);
			//console.log("v", values,  "obj", obj);
			if(obj != ""){
				
				$.each(obj, function(k, v){
					var val = {};
					val["x"] = k;
					val["y"] = parseInt(v["total"]);
					//console.log('val', val);
					itemMap.values.push(val);
					
				})
				mapData.push(itemMap);
			}
		})
		//console.log("mapData1", mapData);
		return mapData;
	}

	function getMultiBarChart(map){
		var mapData = buildDataSetMulti(map, "population");
		console.log(mapData);
		nv.addGraph(function() {
		    var chart = nv.models.multiBarChart()
		      .transitionDuration(350)
		      .reduceXTicks(true)   //If 'false', every single x-axis tick label will be rendered.
		      .rotateLabels(0)      //Angle to rotate x-axis labels.
		      .showControls(true)   //Allow user to switch between 'Grouped' and 'Stacked' mode.
		      .groupSpacing(0.1)    //Distance between each group of bars.
		    ;

			d3.selectAll("svg > *").remove();
			d3.select('#chart svg')
			    .datum(mapData)
			    .call(chart);

			nv.utils.windowResize(chart.update);
			
			return chart;
		})
	}

	function getMapObject(map, str){
		
		$.each(map, function(k, v){
			console.log(k, v, str);
			if(k!=str){
				//console.log(typeof(v))
				if("object" == typeof(v)){
					res= getMapObject(v, str);
				}
			}else{
				//console.log(v);
				res= v;
			}
		})
		//console.log("resultat", res);
		return res;
	}
</script>
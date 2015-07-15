<?php
	$cs = Yii::app()->getClientScript();
  	$cssAnsScriptFilesModule = array(
  		'/assets/plugins/nvd3/nv.d3.js',
  		);
  	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);

	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.js' , CClientScript::POS_END);
?>
<style>
	#chart{
		height: 400px;
	}
	#chart svg{
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
<div class='panel panel-white' id="<?php echo $typeData; ?>_panel">
	<div class="panel-heading border-light">
		
		<span id="<?php echo $typeData; ?>_titleGraph" class="text-large"> Statistique Population </span>
		<ul  class="panel-heading-tabs border-light ulline">
			<li>
				<label class = "label_dropdown" for="typeGraph">Département : <?php echo $nbCitiesDepartement; ?> communes </label>
			</li>
			<li>
				<label class = "label_dropdown" for="typeGraph">Région : <?php echo $nbCitiesRegion; ?> communes </label>
			</li>
			<li>
				<label class = "label_dropdown" for="typeGraph">Voir : </label>
				<div class="btn-group">
					<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
						<span id="label-type"> Population </span><span class="caret"></span>
					</a>
					<ul role="menu" class="dropdown-menu" id="typeGraph">
						<li>
							<a  class="btn-drop typeBtn" data-name="population">Population</a>
						</li>
						<li>
							<a  class="btn-drop typeBtn" data-name="entreprise">Entreprise</a>
						</li>
						
					</ul>
				</div>
			</li>
			<li>
				<label class = "label_dropdown" for="filterGraph">Option : </label>
				<div class="btn-group">
					<a class="btn btn-transparent-grey dropdown-toggle" data-toggle="dropdown"  aria-expanded="true">
						<span id="label-Pop"> Total </span><span class="caret"></span>
					</a>
					<ul role="menu" class="dropdown-menu" id="filterGraph">		
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
						<span id="label-graph">Multi-Bar</span><span class="caret"></span>
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
						<span id="label-zone"> Commune </span><span class="caret"></span>
					</a>
					<ul role="menu" class="dropdown-menu" id="zoneGraph" >
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
		<div id="chart">
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
		var typeOfItem ='<?php if(isset($_GET["typeData"])) echo $_GET["typeData"]; else echo "population"; ?>';
		createBtnOption(map);
		if($("#"+typeOfItem+"_panel #label-graph").text() == "PieChart")
			getPieChart(map);
		else
			getMultiBarChart(map);
		//getMultiBarChart(map);
		bindBtnAction();
		$("#"+typeOfItem+"_panel #filtreByCommune").hide();
		$("#"+typeOfItem+"_panel #listCommune").select2();


		function buildDataGraph(){
			console.warn("----------------- buildDataGraph -----------------");
			$("svg").empty();
			nv.addGraph(function() {
				chart = nv.models.discreteBarChart()
				    .x(function(d) { return d.label })   
				    .y(function(d) { return d.value })
				    .staggerLabels(true)   
				    .tooltips(function (key, x, y, e, graph){
				    	return '<p><strong>' + key + '</strong></p>' +
				    	 '<p>' + y + ' ' + x + '</p>';
				    })        
				    .showValues(true)     
				    .transitionDuration(350)


				d3.select('#chart svg')
				    .datum(mapData)
				    .call(chart);

				nv.utils.windowResize(chart.update);
				
				return chart;
			})
		}


		function bindBtnAction(){
			console.warn("----------------- bindBtnAction -----------------");
			
			$("#"+typeOfItem+"_panel .typeBtn").click(function(){
				mapData = buildDataSet(map, $(this).data("name"));
					//console.log(mapData);
					d3.select('#chart svg')
					    .datum(mapData)
					    .call(chart);
					chart.update();
					bindBtnAction();
			});


			$( "#"+typeOfItem+"_panel .locBtn" ).off().on("click", function() {
				$.blockUI({
				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
		  	            '<blockquote>'+
		  	              "<p>Rien n'est plus proche du vrai que le faux</p>"+
		  	              '<cite title="Einstein">Einstein</cite>'+
		  	            '</blockquote> '
				});
				$("#label-zone").text($(this).text());
				var urlToSend = baseUrl+"/"+moduleId+"/city/getcitydata/insee/"+insee+"/typeData/"+typeOfItem;
				if("undefined" != $(this).data("name")){
					urlToSend += "/type/"+ $(this).data("name");
				}
				var zoneGraph = $(this).data("name");
				$.ajax({
					type: "POST",
					url: urlToSend,
					dataType: "json",
					success: function(data){
						console.log("data", data);
						if($("#"+typeOfItem+"_panel #label-graph").text() == "PieChart")
							getPieChart(data);
						else
							getMultiBarChart(data);
						$("#"+typeOfItem+"_panel #filtreByCommune").show();
						$("#"+typeOfItem+"_panel#listCommune").html('');
						var ind = 1 ;
						$.each(data, function( index, value )
						{
							$.each(value, function( keyInsee, info)
							{
								codeInsee = keyInsee;
							});
							$("#"+typeOfItem+"_panel #listCommune").append('<option class="btn-drop comBtn" value="'+ codeInsee +'">' + index + '</option>');
						});

						
						$.unblockUI();
					}
				});
			});


			$("#"+typeOfItem+"_panel .graphBtn" ).off().on("click", function() {
				
				$("#"+typeOfItem+"_panel #label-graph").text($(this).text());
				//typeOfItem = $("#label-type").text();
				var urlToSend = baseUrl+"/"+moduleId+"/city/getcitydata/insee/"+insee+"/typeData/"+typeOfItem;
				/*if("undefined" != $("#label-zone").text()){
					urlToSend += "/type/"+ $(this).text();
				}*/
				
				$.ajax({
					type: "POST",
					url: urlToSend,
					dataType: "json",
					success: function(data){
						console.log("data", data);
						if($("#"+typeOfItem+"_panel #label-graph").text() == "PieChart")
							getPieChart(data);
						else
							getMultiBarChart(data);
						$("#"+typeOfItem+"_panel #filtreByCommune").show();
						$("#"+typeOfItem+"_panel #listCommune").html('');
						var ind = 1 ;
						$.each(data, function( index, value )
						{
							$.each(value, function( keyInsee, info)
							{
								codeInsee = keyInsee;
							});
							$("#"+typeOfItem+"_panel #listCommune").append('<option class="btn-drop comBtn" value="'+ codeInsee +'">' + index + '</option>');
						});

						
						$.unblockUI();
					}
				});
			});

			$("#"+typeOfItem+"_panel.typeBtn").off().on("click", function(){
				$("#label-zone").text("Zone");
				//typeOfItem = $("this").data("name");
				typeOfItem = $("this").text();
				alert(typeOfItem);
				$("#"+typeOfItem+"_panel #label-type").text($(this).text());
				var urlToSend = baseUrl+"/"+moduleId+"/city/getcitydata/insee/"+insee+"/typeData/"+typeOfItem;
				$.ajax({
					type: "POST",
					url: urlToSend,
					dataType: "json",
					success: function(data){
						console.log("data", data);
						if($("#"+typeOfItem+"_panel #label-graph").text() == "PieChart")
							getPieChart(data);
						else
							getMultiBarChart(data);
					}
				});		
			});
			$("#"+typeOfItem+"_panel #label-zone").text("Zone");

			$("#"+typeOfItem+"_panel #listCommune").click(function(){
				mapData = buildDataSet(map, $(this).data("name"));
					//console.log(mapData);
					d3.select("#"+typeOfItem+"_panel #chart svg")
					    .datum(mapData)
					    .call(chart);
					chart.update();
					bindBtnAction();
			});

			$("#"+typeOfItem+"_panel #listCommune" ).off().on("click", function() {
				
				var cities = [];
				var i = 0 ;
				$("#"+typeOfItem+"_panel #listCommune option:selected").each(function() 
				{
					cities[i] = $(this).val();
					i++;
				});

				if(i > 0)
				{
					//typeOfItem = $(this).data("name");
					var urlToSend = baseUrl+"/"+moduleId+"/city/getcitiesdata/insee/"+insee+"/typeData/"+typeOfItem;
					if("undefined" != $("#"+typeOfItem+"_panel label-zone").data("name")){
						urlToSend += "/type/"+ $("#"+typeOfItem+"_panel label-zone").data("name");
					}

					var zoneGraph = $(this).data("name");
					$.ajax({
						type: "POST",
						url: urlToSend,
						data : {cities : cities},
						dataType: "json",
						success: function(data){
							console.log("data", data);
							if($("#"+typeOfItem+"_panel #label-graph").text() == "PieChart")
								getPieChart(data);
							else
								getMultiBarChart(data);
							
						}
					});

				}
				else
				{
					//typeOfItem = $(this).data("name");
					var urlToSend = baseUrl+"/"+moduleId+"/city/getcitydata/insee/"+insee+"/typeData/"+typeOfItem;
					if("undefined" != $("#"+typeOfItem+"_panel label-zone").data("name")){
						urlToSend += "/type/"+ $("#"+typeOfItem+"_panel label-zone").data("name");
					}
					$.ajax({
						type: "POST",
						url: urlToSend,
						dataType: "json",
						success: function(data){
							console.log("data", data);
							if($("#"+typeOfItem+"_panel #label-graph").text() == "PieChart")
								getPieChart(data);
							else
								getMultiBarChart(data);
						}
					});
				}
				

				
			});

		}

		function buildDataSet(map, str){
			console.warn("----------------- buildDataSet -----------------",map, str);
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
				});
			}
			return mapData;
		}

		function buildDataSetMulti(map, str){
			console.warn("----------------- buildDataSetMulti -----------------",map, str);
			var mapData= [];
			var tabYear = [];
			$.each(map, function(key,values){
				/*var itemMap = {"key":key,"values": [ ]};
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
				}*/
				var obj = getMapObject(values, str);
				console.log("obj", obj, key, values);
				if(obj != ""){
					$.each(obj, function(k, v){
						//console.log("kv", k, v);
						if($.inArray(k, tabYear) == -1){
							tabYear.push(k);
							var itemMap = {"key": k, "values": []};
							mapData.push(itemMap);
						}
						var val = {};
						val["x"] = key;
						val["y"] = parseInt(v["total"]);
						console.log('val', val);
						$.each(mapData, function(cle, valeur){
							//console.log(cle, valeur);
							if(valeur.key == k && valeur.values.length<30){ //limitation a 20 entrer pour le moment
								valeur.values.push(val);
							}
						});
					});
				}
			})
			console.log("mapData1", mapData);
			return mapData;
		}

		function getMultiBarChart(map){
			console.warn("----------------- getMultiBarChart -----------------",map);
			var mapData = buildDataSetMulti(map, typeOfItem);
			console.log(mapData);
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


				d3.selectAll("#"+typeOfItem+"_panel svg > *").remove();
				d3.select('#'+typeOfItem+'_panel #chart svg')
				    .datum(mapData)
				    .call(chart);

				nv.utils.windowResize(chart.update);
				
				return chart;
			});
		}


		function getPieChart(map){
			
			var mapData = buildDataSetPie(map, typeOfItem);
			/*console.log(mapData);
			nv.addGraph(function() {
			  var chart = nv.models.pieChart()
			      .x(function(d) { return d.label })
			      .y(function(d) { return d.value })
			      .showLabels(true);

			    d3.selectAll("svg > *").remove();
			    d3.select('#chart svg')
				    .datum(mapData)
				    .call(chart);

			  return chart;
			});*/

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
			    d3.selectAll("#"+typeOfItem+"_panel svg > *").remove();
				d3.select('#'+typeOfItem+'_panel #chart svg')
			        .datum(mapData)
			        .transition().duration(350)
			        .call(chart);

			  return chart;
			});
		}


		function buildDataSetPie(map, str){
			console.warn("----------------- buildDataSetMulti -----------------",map, str);
			//console.log("map",map);
			//console.log("str",str);
			var mapData= [];
			var tabYear = [];
			$.each(map, function(key,values){
				var obj = getMapObject(values, str);
				//console.log("obj", obj, key, values);
				if(obj != ""){
					$.each(obj, function(k, v)
					{
						//console.log('k', k);
						var val = {};
						val["label"] = key+k;
						val["value"] = v["total"];
						//console.log('val', val);
						if(mapData.length < 30)
							mapData.push(val);
						
					});
				}
			});
			//console.log("mapData1", mapData);
			//console.log("JSON", JSON.stringify(mapData));
			
			return mapData;
		}

		function getMapObject(map, str){
			console.warn("----------------- getMapObject -----------------",map, str);
			var notOk = true;
			var res = "";
			$.each(map, function(k, v){
				console.log(k, v, str);
				if(k!=str){
					while(k!= str && "object" == typeof v && notOk){
						$.each(v , function(key, val){
							k= key;
							v = val;
							console.log("ici", key, str, val);
							if(key == str){
								console.log("ici", key, str, val);
								res = val;
								console.log("res", res);
								notOk = false;
							}
						});
					}
				}else{
					console.log("Result---------------", v);
					res= v;
				}
			});
			console.log("resultat", res);
			return res;
		}

		function createBtnOption(map){

		}
	})

	
</script>
<?php
	/*$cs = Yii::app()->getClientScript();
	// if(!Yii::app()->request->isAjaxRequest)
	// {
	  	$cssAnsScriptFilesModule = array(
	  		'/plugins/nvd3/nv.d3.js'
	  	);
	  	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->request->baseUrl);*/
$cs = Yii::app()->getClientScript();
$cssAnsScriptFilesModule = array(
		'/plugins/d3/d3.js',
		'/plugins/nvd3/nv.d3.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule,Yii::app()->request->baseUrl);
?>
<style>
	.chart{
		height: 400px;
	}
	.chart svg{
		width: 90%;
		height: 90%;
	}
</style>
<div id="<?php echo $name_id; ?>_chart" class="chart">
	<h4 id="title"></h4>
	<svg ></svg>
</div>


<script type="text/javascript">

	jQuery(document).ready(function() {
		var insee = "<?php echo $_GET['insee']; ?>";
		var map = <?php echo $cityData ?>;
		var name_id ='<?php echo $name_id ; ?>';
		var typeData ='<?php if(isset($typeData)) echo $typeData; else echo "population"; ?>';
		var typeGraph ='<?php if(isset($typeGraph)) echo $typeGraph ; else echo "multibar"; ?>';
		var typeZone ='<?php if(isset($typeZone)) echo $typeZone ; else echo "commune"; ?>';
		var optionChecked = jQuery.parseJSON('<?php echo $optionData ;?>');

		var title = '<?php if(isset($title)) echo $title ; else echo "";?>';

		//var optionChecked = optionData;

		/*mylog.log("insee", insee);
		mylog.log("map", map);
		mylog.log("name_id", name_id);
		mylog.log("typeData", typeData);
		mylog.log("typeGraph", typeGraph);
		mylog.log("typeZone", typeZone);
		mylog.log("optionChecked", optionChecked);*/
		if(title != "")
			$("#title").html(title);
		
		if(typeGraph == "piechart")
			getPieChart(map, typeData, optionChecked, name_id);
		else
			getMultiBarChart(map, typeData, optionChecked, name_id);

		//sendData(insee, typeData, typeZone, optionChecked, name_id, typeGraph, optionCheckedCities);

	
	});



function getMultiBarChart(map, typeData, optionChecked, name_id){
	mylog.warn("----------------- getMultiBarChart -----------------");
	//mylog.log(name_id + "_panel : ", map, typeData, optionChecked);
	//mylog.log("optionChecked 3 : ",  optionChecked);
	var mapData = buildDataSetMulti(map, typeData,  optionChecked, name_id);
	//mylog.log(mapData);
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
          		//mylog.log("e", e);
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
	//mylog.warn("----------------- buildDataSetMulti -----------------");
	//mylog.log(name_id + "_panel : ", map, typeData, optionChecked);
	var mapData = [];
	var tabYear = [];
	
	$.each(optionChecked, function(keyInd,valuesOptionChecked){
		//mylog.log("test", valuesOptionChecked);
		var valInfo ;
		valuesMap=[];
		$.each(map, function(nameCommune,valuesCommune){
			//mylog.log("test2", valuesCommune);
			$.each(valuesCommune, function(codeInsee,valuesInsee){
				//mylog.log("test2", valuesInsee);
				$.each(valuesInsee, function(keyInfo,valuesInfo){
					//mylog.log("valuesInfo", valuesInfo);
					valInfo = valuesInfo ;
					if(typeData == keyInfo)
					{
						var val = {};
						val["x"] = nameCommune;
						val["y"] = jsonHelper.getValueByPath(valuesInfo, add_element_mapping(valuesOptionChecked, "value"));
						//mylog.log("val : ", val);
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
		
		//mylog.log("mapData", mapData);
	});
	//mylog.log("mapData FIN", mapData);
	return mapData;
}

function getPieChart(map, typeData, optionChecked, name_id){
	//mylog.warn("----------------- getPieChart -----------------");
	//mylog.log(name_id + "_panel : ", map, typeData, optionChecked);
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
	//mylog.warn("----------------- buildDataSetPie -----------------");
	//mylog.log(name_id + "_panel : ", map, typeData, optionChecked);
	//mylog.log("map",map);
	//mylog.log("str",str);
	var mapData= [];
	$.each(optionChecked, function(keyInd,valuesOptionChecked){
		//mylog.log("optionChecked", valuesOptionChecked);
		$.each(map, function(nameCommune,valuesCommune){
			$.each(valuesCommune, function(codeInsee,valuesInsee){
				$.each(valuesInsee, function(keyInfo,valuesInfo){
					//mylog.log("valuesInfo", valuesInfo);
					if(typeData == keyInfo)
					{
						var val = {};
						val["label"] = nameCommune + " : " + jsonHelper.getValueByPath(valuesInfo, add_element_mapping(valuesOptionChecked, "label"));
						val["value"] = jsonHelper.getValueByPath(valuesInfo, add_element_mapping(valuesOptionChecked, "value"));
						//mylog.log("val : ", val);
						mapData.push(val);
					}
				});
			});
		});
		//mylog.log("mapData", mapData);
	});
	return mapData;
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
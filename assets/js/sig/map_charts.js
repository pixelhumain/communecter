
/**
***		CHARTS
***/

SigLoader.getSigCharts = function (Sig){

	Sig.markersLayer = ""; 
	Sig.chartsList = new Array();

	//Permet de pré-charger une Chart
	Sig.addChart = function(thisData){

		var name = thisData["name"];
		var name_txt = thisData["name_text"];
		var FeatureCollection = thisData["chart"];
		var chartOptions =  thisData["chartOptions"];

		console.log(">>>> BEFORE ADD CHART <<<<< "+name);
		console.dir(FeatureCollection);
		console.dir(chartOptions);
		
		this.chartsList[name] = new Array();
		this.chartsList[name]["FeatureCollection"] = FeatureCollection;
		this.chartsList[name]["chartOptions"] = chartOptions;

		var thisSig = this;
		//var btn = '<button type="button" class="btn btn-map" name="' + name + '" id="btn-chart-'+ name +'"><i class="fa fa-bar-chart-o"></i> '+ name +'</button>';
		

		var btn = '<div class="element-right-list">' +
		    				'<button  name="' + name + '" id="btn-chart-'+ name +'" class="item_map_list">'
		    					+ "<div class='left-col'>"
		    					+ 	"<div class='thumbnail-profil'></div>"						
		    					+ 	"<div class='ico-type-account'><i class='fa fa-bar-chart-o'></i></div>"
		    					+ "</div>"
								+ "<div class='right-col'>"
								+ 	"<div class='info_item pseudo_item_map_list'>" + name_txt + "</div>"
								+ "</div>"
								+ "<div class='separation'></div>"
							+"</button>"
					+ "</div>";

		//$("#btn-group-charts-map").append(btn);
		$(this.cssModuleName + " #liste_map_element").append(btn);
		
		$("#btn-chart-"+ name).click(function(){ console.log("click on btn chart");
			var name = $(this).attr("name");
			thisSig.loadChart(name);
		});
	}
	//***
	// Permet d'afficher les éléments d'une 
	/*	>>>>>>>>>>>>>> LOAD CHART <<<<<<<<<<<<<<< */
	Sig.loadChart = function (name){
		if(this.initParameters.useChartsMarkers != true) return;

		var FeatureCollection = this.chartsList[name]["FeatureCollection"];
		var chartOptions 	  = this.chartsList[name]["chartOptions"];

		console.log(">>>> LOAD CHART <<<<<");
		console.dir(FeatureCollection);
		console.dir(chartOptions);
		
		//réinitialise le groupLayer
		if(this.markersLayer != ""){
			this.map.removeLayer(this.markersLayer);
			this.markersLayer = "";
		}
		
		var thisSig = this;
		
		function getToolTip(feature, value, options, chartOptions){//unity, color){
		console.log(">>> tooltip chartOptions : "); console.dir(chartOptions);

		var tooltip = ""; //"<div class='twh-tooltip-value' style='color:" + options.color + ";'> " +  value + " " + options.unity + "</div>";
		$.each(chartOptions, function(i, element)  { console.log("element"); console.warn(element);
			tooltip +=
			"<div class='twh-tooltip-element'>" + 
				"<span class='label label-info' style='font-size:25px; background-color:" + element.fillColor + " !important;'>" + 
					element.title + " " + 
					feature[i] 	+ " " + 
					element.unity + 
				"</span>" +
			"</div>";
            	
		});
		return tooltip;
		//"<div class='twh-tooltip-element'><span class='label label-info' 	style='font-size:25px;'><i class='fa fa-umbrella'></i> " 	+ feature.précipitations 	+ " mm</span></div>" +
                //"";
		}

		
		 //$.getJSON(url, function(data) { //pour charger des données json depuis un fichier)
        var   geojsonLayer = L.geoJson(FeatureCollection, {
                pointToLayer: function (feature, latlng) {

                    var completeChartOption = new Array();
					var data = new Array();
					$.each(chartOptions.options, function(i, options)  {
						//construit le format valide des options à partir des options données en param
						completeChartOption[i] = { 
							fillColor: options.fillColor,
				            minValue: options.minValue,
				            maxValue: options.maxValue,
				            maxHeight: chartOptions.maxHeight,
				            displayText: function (value) { 
				                return 	getToolTip(feature, value, options, chartOptions.options);
				            }
						};
						//construit le format valide pour les valeurs des données
						data[i] = feature[i];
					});
					
					//compile les options correctement
					var options = {
                        data: data,
                        chartOptions: completeChartOption,
                        weight: 1,
                        opacity: 1,
                        fill:false,
                        radius:chartOptions.radius,
                        rotation:0.0,
                        iconSize: new L.Point(300, 0)
                    }

                    var chartMaker = thisSig.getChartMarker(chartOptions.type, latlng, options, chartOptions.options);
                    return chartMaker;
                }
            });
            
            this.markersLayer = new L.MarkerClusterGroup({"maxClusterRadius" : 100});
			this.markersLayer.addLayer(geojsonLayer); 
			this.map.addLayer(this.markersLayer);
			this.map.fitBounds(this.markersLayer.getBounds(), { 'maxZoom' : 14 });
			console.warn(">>>> CHART LOADED <<<<<")
		
	};

	Sig.getChartMarker = function (chartType, latlng, options){ //alert(chartType);
        if(chartType == "BarChartMarker")  			  	return new L.BarChartMarker(latlng, options);
        if(chartType == "RadialBarChartMarker")  		return new L.RadialBarChartMarker(latlng, options);
        if(chartType == "PieChartMarker")  			  	return new L.PieChartMarker(latlng, options);    
        if(chartType == "CoxcombChartMarker")  		  	return new L.CoxcombChartMarker(latlng, options);
        if(chartType == "StackedRegularPolygonMarker")  return new L.StackedRegularPolygonMarker(latlng, options);
        if(chartType == "RadialMeterMarker")  		  	return new L.RadialMeterMarker(latlng, options);
    };

	return Sig;
};

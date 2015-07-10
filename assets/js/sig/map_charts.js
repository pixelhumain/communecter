
/**
***		CHARTS
***/

SigLoader.getSigCharts = function (Sig){

	Sig.currentResultResearch = "";
	Sig.nbMaxTentative = 4;
	Sig.fullTextResearch = true;

	//***
	//
	/*	>>>>>>>>>>>>>> MAP <<<<<<<<<<<<<<< */
	Sig.loadCharts = function (FeatureCollection, chartOptions){
		if(this.initParameters.useChartsMarkers != true) return;

		function getToolTip(feature, value, unity, color){
		return	"<div class='twh-tooltip-value' style='color:" + color + ";'> " +  value + " " + unity + "</div>" + 
            	"<div class='twh-tooltip-element'><span class='label label-warning' style='font-size:25px;'><i class='fa fa-sun-o'></i> " 		+ feature.ensoleillement 	+ "%</span></div>" + 
            	"<div class='twh-tooltip-element'><span class='label label-info' 	style='font-size:25px;'><i class='fa fa-umbrella'></i> " 	+ feature.précipitations 	+ " mm</span></div>" +
                "";
		}
	
		 //$.getJSON(url, function(data) { //pour charger des données json depuis un fichier)
            var   geojsonLayer = L.geoJson(FeatureCollection, {
                    pointToLayer: function (feature, latlng) {
                       var options = {
                            data: {
                                'ensoleillement': feature.ensoleillement, 
                                'précipitations': feature.précipitations,
                            },
                            chartOptions: {
                                'ensoleillement': {
                                    fillColor: '#F0AD4E',
                                    minValue: 0,
                                    maxValue: 100,
                                    maxHeight: chartOptions.maxHeight,
                                    displayText: function (value) { 
                                        return 	getToolTip(feature, value, "%", '#F0AD4E');
                                     }
                                },
                                'précipitations': {
                                    fillColor: '#5BC0DE',
                                    minValue: 0,
                                    maxValue: 400,
                                    maxHeight: chartOptions.maxHeight,
                                    displayText: function (value) {
                                        return 	getToolTip(feature, value, "mm", '#5BC0DE');
                                    }
                                },
                            },
                            weight: 1,
                            opacity: 1,
                            fill:false,
                            radius:chartOptions.radius,
                            rotation:0.0,
                            iconSize: new L.Point(250, 270)
                        }
                        return Sig.getChartMarker(chartOptions.type, latlng, options);
                    }
                });
                
                var markersLayer = new L.MarkerClusterGroup({"maxClusterRadius" : 100});
				markersLayer.addLayer(geojsonLayer); 
				this.map.addLayer(markersLayer);
	};


	return Sig;
};

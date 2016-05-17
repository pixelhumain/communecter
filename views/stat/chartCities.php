<?php
    $cs = Yii::app()->getClientScript();

    Menu::statistics();
    $this->renderPartial('../default/panels/toolbar'); 
?>

<?php
	$cs = Yii::app()->getClientScript();
	// if(!Yii::app()->request->isAjaxRequest)
	// {
	  	$cssAnsScriptFilesModule = array(
	  		'/assets/plugins/d3/d3.v3.min.js',
        '/assets/plugins/d3/c3.min.js',
        '/assets/plugins/d3/c3.min.css',
	  	);
	  	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
  	// }

?>
<script>
    //Title
    $(".moduleLabel").html("<i class='fa fa-cog'></i> Espace administrateur : Statistiques");

</script>

<!-- ***** CITOYENS ***** -->
<h4>Evolution du nombre de communecté</h4>
<div id="chartCitoyens"></div>
<script>

var chartCitoyens = c3.generate({
    bindto: '#chartCitoyens',
    data: {
        x : 'x',
        xFormat: '%d/%m/%Y',
        columns: [],
        type: 'line',
        names: {'citoyens' : 'Citoyens'}
    },
    axis: {
        x: {
            type: 'timeseries', // this needed to load string x value
            tick: {
                format: '%d/%m/%Y'
            }
        }
    }
});

chartCitoyens.load({
  url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/citoyens/chart/cities/insee/59350",
  mimeType: 'json'
});

</script>

<!-- ORGANIZATIONS -->
<h4>Organisations</h4>
<div id="chartOrganizatons"></div>
<script>

var chartOrganizatons = c3.generate({
    bindto: '#chartOrganizatons',
    data: {
        columns: [
            ['data1', 30],
            ['data2', 120],
        ],
        type : 'pie',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    }
});

// chartOrganizatons.load({
//   url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/organizations/chart/cities/insee/59350",
//   mimeType: 'json'
// });

</script>
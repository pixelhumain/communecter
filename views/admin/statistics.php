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
	  		'/plugins/d3/d3.v3.min.js',
        '/plugins/d3/c3.min.js',
        '/plugins/d3/c3.min.css',
	  	);
	  	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->request->baseUrl);
  	// }

?>
<script type="text/javascript">
    //Title
    setTitle("Espace administrateur : Statistiques","cog");

</script>
<!-- ***** CITOYENS ***** -->
<h4>Evolution du nombre de communecté</h4>
<div id="chartCitoyens"></div>
<script type="text/javascript">

var chartCitoyens = c3.generate({
    bindto: '#chartCitoyens',
    data: {
        x : 'x',
        xFormat: '%d/%m/%Y',
        columns: [],
        type: 'line'
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
  url: baseUrl+"/"+moduleId+"/stat/getstatjson/citoyens/global",
  mimeType: 'json'
});

</script>

<!-- CREATIONS -->
<h4>Evolution du nombre d'organisations, d'événements et de projets</h4>
<div id="chartCreations"></div>
<script type="text/javascript">

var chartCreations = c3.generate({
    bindto: '#chartCreations',
    data: {
        x : 'x',
        xFormat: '%d/%m/%Y',
        columns: [],
        type: 'bar',
        hide: ['citoyens'],
        groups: [
            ['events','projects','organizations', 'citoyens']
        ]
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

chartCreations.load({
  url: baseUrl+"/"+moduleId+"/stat/getstatjson/global/all",
  mimeType: 'json'
});

chartCreations.legend.hide('citoyens');


</script>


<!--<h4>Evolution du nombre de communecté</h4>
<div id="chartAll"></div>
<script type="text/javascript" >

var chartAll = c3.generate({
    bindto: '#chartAll',
    data: {
        x : 'x',
        xFormat: '%d/%m/%Y',
        columns: [],
        type: 'line'
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

setTimeout(function () {
    chartAll.load({
      url: baseUrl+"/"+moduleId+"/stat/getstatjson/global/all",
      mimeType: 'json'
    });
}, 1000);

</script>-->





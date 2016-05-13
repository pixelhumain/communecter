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
<div id="chartCitoyens"></div>
<script>

var chartCitoyens = c3.generate({
    bindto: '#chartCitoyens',
    data: {
        x : 'x',
        columns: [],
        type: 'line'
    },
    axis: {
        x: {
            type: 'category' // this needed to load string x value
        }
    }
});

setTimeout(function () {
    chartCitoyens.load({
      url: baseUrl+"/"+moduleId+"/stat/getstatjson/citoyens/global",
      mimeType: 'json'
    });
}, 1000);

</script>

<div id="chartOrganizations"></div>
<script>

var chartOrganizations = c3.generate({
    bindto: '#chartOrganizations',
    data: {
        x : 'x',
        columns: [],
        type: 'bar',
        groups: [
            ['GovernmentOrganization','Group','LocalBusiness','NGO']
        ]
    },
    axis: {
        x: {
            type: 'category' // this needed to load string x value
        }
    }
});

setTimeout(function () {
    chartOrganizations.load({
      url: baseUrl+"/"+moduleId+"/stat/getstatjson/organizations/global",
      mimeType: 'json'
    });
}, 1000);

</script>

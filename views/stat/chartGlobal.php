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
  url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/citoyens/chart/global",
  mimeType: 'json'
});

</script>

<!-- ORGANIZATIONS -->
<h4>Evolution du nombre d'organisations</h4>
<div id="chartOrganizatons"></div>
<script>

var chartOrganizatons = c3.generate({
    bindto: '#chartOrganizatons',
    data: {
        x : 'x',
        xFormat: '%d/%m/%Y',
        columns: [],
        type: 'bar',
        groups: [
            <?php echo json_encode(array_keys($groups['organisationTypes'])); ?>
        ],
        names:  <?php echo json_encode($groups['organisationTypes']); ?>
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

chartOrganizatons.load({
  url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/organizations/chart/global",
  mimeType: 'json'
});

</script>

<!-- EVENTS -->
<h4>Evolution du nombre d'événements</h4>
<div id="chartEvents"></div>
<script>

var chartEvents = c3.generate({
    bindto: '#chartEvents',
    data: {
        x : 'x',
        xFormat: '%d/%m/%Y',
        columns: [],
        type: 'bar',
        groups: [
            <?php echo json_encode(array_keys($groups['eventTypes'])); ?>
        ],
        names:  <?php echo json_encode($groups['eventTypes']); ?>
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

chartEvents.load({
  url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/events/chart/global",
  mimeType: 'json'
});

</script>

<!-- PROJECTS -->
<h4>Evolution du nombre de projets</h4>
<div id="chartProjects"></div>
<script>

var chartProjects = c3.generate({
    bindto: '#chartProjects',
    data: {
        x : 'x',
        xFormat: '%d/%m/%Y',
        columns: [],
        type: 'line',
        groups: [
            []
        ],
        names: {'projects' : 'Projets'}
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

chartProjects.load({
  url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/projects/chart/global",
  mimeType: 'json'
});

</script>




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
	  	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule,Yii::app()->request->baseUrl);
  	// }

?>

<!-- ***** CITOYENS ***** -->
<h4>Evolution du nombre de communecté</h4>
<div id="chartCitoyens"></div>
<script type="text/javascript" >

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



</script>

<!-- LINKS -->
<h4>Evolution du nombre de liens entre entités</h4>
<div id="chartLinks"></div>
<script type="text/javascript" >

var chartLinks = c3.generate({
    bindto: '#chartLinks',
    data: {
        x : 'x',
        xFormat: '%d/%m/%Y',
        columns: [],
        type: 'bar',
        groups: [
            <?php echo json_encode(array_keys($groups['linkTypes'])); ?>
        ],
        names:  <?php echo json_encode($groups['linkTypes']); ?>
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



</script>

<!-- ORGANIZATIONS -->
<h4>Evolution du nombre d'organisations</h4>
<div id="chartOrganizations"></div>
<script type="text/javascript" >

var chartOrganizations = c3.generate({
    bindto: '#chartOrganizations',
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



</script>

<!-- EVENTS -->
<h4>Evolution du nombre d'événements</h4>
<div id="chartEvents"></div>
<script type="text/javascript" >

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


</script>

<!-- PROJECTS -->
<h4>Evolution du nombre de projets</h4>
<div id="chartProjects"></div>
<script type="text/javascript" >

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


</script>

<!-- ACTIONSROOMS -->
<h4>Evolution du nombre de salles de vote</h4>
<div id="chartActionRooms"></div>
<script type="text/javascript" >

var chartActionRooms = c3.generate({
    bindto: '#chartActionRooms',
    data: {
        x : 'x',
        xFormat: '%d/%m/%Y',
        columns: [],
        type: 'bar',
        groups: [
            <?php echo json_encode(array_keys($groups['listRoomTypes'])); ?>
        ],
        names:  <?php echo json_encode($groups['listRoomTypes']); ?>
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
</script>

<!-- MODULES -->
<h4>Evolution du nombre de modules par organisation</h4>
<div id="chartModulesOrga"></div>
<script type="text/javascript" >

var chartModulesOrga = c3.generate({
    bindto: '#chartModulesOrga',
    data: {
        x : 'x',
        xFormat: '%d/%m/%Y',
        columns: [],
        type: 'bar',
        groups: [
            <?php echo json_encode(array_keys($groups['moduleTypes'])); ?>
        ],
        names:  <?php echo json_encode($groups['moduleTypes']); ?>
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


</script>

<!-- ***** SALLE DE VOTE ***** -->
<h4>Evolution du nombre de salle de vote</h4>
<div id="chartSurveys"></div>
<script type="text/javascript" >

var chartSurveys = c3.generate({
    bindto: '#chartSurveys',
    data: {
        x : 'x',
        xFormat: '%d/%m/%Y',
        columns: [],
        type: 'line',
        names: {'survey' : 'Salle de vote'}
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


</script>

<script type="text/javascript" >
    //Title
    jQuery(document).ready(function() {
        setTitle("Espace administrateur : Statistiques","cog");
        chartCitoyens.load({
          url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/citoyens/chart/global",
          mimeType: 'json'
        });

        chartLinks.load({
          url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/links/chart/global",
          mimeType: 'json'
        });

        chartOrganizations.load({
          url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/organizations/chart/global",
          mimeType: 'json'
        });


        chartEvents.load({
          url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/events/chart/global",
          mimeType: 'json'
        });

        chartProjects.load({
          url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/projects/chart/global",
          mimeType: 'json'
        });


        chartActionRooms.load({
          url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/actionRooms/chart/global",
          mimeType: 'json'
        });


        chartModulesOrga.load({
          url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/modules/chart/global",
          mimeType: 'json'
        });


        chartSurveys.load({
          url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/survey/chart/global",
          mimeType: 'json'
        });

    });

</script>
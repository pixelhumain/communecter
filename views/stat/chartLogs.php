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
<h4>Evolution du nombre de log</h4>
<div id="chartLogs"></div>
<script type="text/javascript" >

var chartLogs = c3.generate({
    bindto: '#chartLogs',
    data: {
        x : 'x',
        xFormat: '%d/%m/%Y',
        columns: [],
        type: 'line',
        names: {'logs' : 'Logs'}
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

<?php foreach ($actionsLog as $key => $value) { ?>
    <?php $actionWellNamed = str_replace("/", "_", $key)  ; ?> 

    <h4>Evolution des logs pour <?php echo $key;?> </h4>
    <div id="chart_<?php echo $actionWellNamed; ?>"></div>
    <script type="text/javascript" >

    var chart_<?php echo $actionWellNamed; ?> = c3.generate({
        bindto: '#chart_<?php echo $actionWellNamed; ?>',
        data: {
            x : 'x',
            xFormat: '%d/%m/%Y',
            columns: [],
            type: 'line',
            <?php if($value['waitForResult']) { ?>
                groups: [
                    <?php echo json_encode(array_keys($groups['resultTypes'])); ?>
                ],
                names:  <?php echo json_encode($groups['resultTypes']); ?>
            <?php } else { ?>
                names: {'logs' : 'Logs'}
            <?php } ?>
            
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


    chart_<?php echo $actionWellNamed; ?>.load({
      url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/logs/chart/action/action/<?php echo $actionWellNamed; ?>",
      mimeType: 'json'
    });
    </script>
   
<?php } ?>



<script type="text/javascript" >
    //Title
    jQuery(document).ready(function() {
        
        setTitle("Espace administrateur : Statistiques","cog");
        chartLogs.load({
          url: baseUrl+"/"+moduleId+"/stat/getstatjson/sector/logs/chart/global",
          mimeType: 'json'
        });

    });

</script>
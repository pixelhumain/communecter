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


<div class='panel panel-white' id="panel" style="margin-top: 42px;">
    <div class="panel-heading border-light">
        
        <span id="titleGraph" class="text-large titlePod"> Statistique zone géographique </span>
        <ul role="menu" class="dropdown-menu pull-right" id="filterGraph">
            <?php foreach ($dep as $num => $name) {?>
                <li>
                    <a class="btn-drop optionBtn" data-name="region_name">
                        <input type="checkbox" id="num" name="name" value="value"/>
                        <label for="name" ><?php echo $name; ?></label>
                    </a>
                </li>
            <?php } ?>
           
        </ul>
    </div>
</div>

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

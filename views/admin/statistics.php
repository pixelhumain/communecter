<div class='ct-chart-users'></div>
<div class='ct-chart-organizations'></div>
<?php
	$cs = Yii::app()->getClientScript();
	// if(!Yii::app()->request->isAjaxRequest)
	// {
	  	$cssAnsScriptFilesModule = array(
	  		'/assets/plugins/chartist/chartist.min.css',
	  		'/assets/plugins/chartist/chartist.min.js'
	  	);
	  	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
  	// }

?>




<script>

/* Add a basic data series with six labels and values */
var dataUsers = {
  labels: <?php echo json_encode($citoyens['citoyensAbs']); ?>,
  series: [
    {
      data: <?php echo json_encode($citoyens['citoyensOrd']); ?>
    }
  ]
};

var dataOrganizations = {
  series: [5, 3, 4]
};


/* Initialize the chart with the above settings */
new Chartist.Line('.ct-chart-users', dataUsers, {
  fullWidth: true,
  chartPadding: {
    right: 40
  }
});

new Chartist.Pie('.ct-chart-organizations', dataOrganizations, {
  labelInterpolationFnc: function(value) {
    return Math.round(value / dataOrganizations.series.reduce(sum) * 100) + '%';
  }
});


var sum = function(a, b) { return a + b };
</script>
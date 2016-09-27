<?php 
$cssAnsScriptFilesModule = array(
	'/plugins/Chart.js/Chart.min.js'
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");
?>

<style>
#myChart {
	padding: 10px 10px 10px 10px;
}

</style>

<div class="panel panel-white">

	<div class="panel-heading border-light bg-dark">
		<h4 class="panel-title"><span><i class="fa fa-puzzle-piece"></i> <?php echo Yii::t("project","Chart",null,Yii::app()->controller->module->id) ?></span></h4>	
	</div>
	<div class="panel-tools">			
		<?php if ($admin || $openEdition){	?>
		<a id="" class="edit-chart btn btn-xs btn-light-blue tooltips" 
			data-toggle="tooltip" data-placement="top" title="" alt="" data-original-title="<?php echo Yii::t("project","Edit properties",null,Yii::app()->controller->module->id) ?>" onclick="showElementPad('addchart')">
			<i class="fa fa-pencil"></i> Editer la charte 
		</a>
		<?php } ?>
	</div>
	<?php if(isset($properties) && !empty($properties)){ ?>
		<div id="infoPodChart" class="padding-10 hide">
			<blockquote> 
				<?php echo Yii::t("project","Create Chart<br/>Opening<br/>Values<br/>Governance<br/>To explain the aim and draw project conduct",null,Yii::app()->controller->module->id) ?>
			</blockquote>
		</div>
		<div class="panel-body no-padding">
			<canvas id="myChart" width="" height=""></canvas>
		</div>
	<?php } else { ?>
		<div id="infoPodChart" class="padding-10">
			<blockquote> 
				<?php echo Yii::t("project","Create Chart<br/>Opening<br/>Values<br/>Governance<br/>To explain the aim and draw project conduct",null,Yii::app()->controller->module->id) ?>
			</blockquote>
		</div>
		<div class="panel-body no-padding contentChart hide">
		</div>
	<?php } ?>
</div>

<script type="text/javascript">
var properties=<?php echo json_encode($properties); ?> ;
console.log(properties);
var countProperties=numAttrs(properties);
jQuery(document).ready(function() {
	if (countProperties > 0){
		setTimeout(function(){chartInit(properties)}, 0);
	}
});

function updateChart(data, nbProperties){
	newCount=0;
	if (countProperties==0){
		if(nbProperties!=0){
			$("#infoPodChart").addClass("hide");
			$(".contentChart").removeClass("hide");
			chartInit(data);
			countProperties=nbProperties;
		}		
	}
	else{
		for (var i=0; i < countProperties; i++ ){
			myNewChart.removeData();
		}
		if(nbProperties==0){
			alert("00");
			$("#infoPodChart").removeClass("hide");
			$(".contentChart").addClass("hide");
			$("#myChart").attr("width","0");
			$("#myChart").attr("height","0");
			
		}
		else {
			chartInit(data);
		}
		countProperties=nbProperties;
	}
}

function chartInit(dataProperties){
	console.log(dataProperties);
	var labelProperties=[];
	var valueProperties=[];
	for (var label in dataProperties){
		labelProperties.push(label);
		valueProperties.push(dataProperties[label]);
	}
	console.log(labelProperties);
	console.log(valueProperties);
	
	var data = {
	    labels : labelProperties,
	    datasets: [
	        {
	            label: "My First dataset",
	            fillColor: "rgba(220,220,220,0.2)",
	            strokeColor: "rgba(220,220,220,1)",
	            pointColor: "rgba(220,220,220,1)",
	            pointStrokeColor: "#fff",
	            pointHighlightFill: "#fff",
	            pointDot : false,
	            pointHighlightStroke: "rgba(220,220,220,1)",
				data : valueProperties
	        },
	    ]
	};
	
	var options;
	var ctx = $("#myChart").get(0).getContext("2d");
	
	// This will get the first returned node in the jQuery collection.
	myNewChart = new Chart(ctx).Radar(data, options);
	console.log(myNewChart);
}

function numAttrs(obj) {
  var count = 0;
  for(var key in obj) {
    if (obj.hasOwnProperty(key)) {
      ++count;
    }
  }
  return count;
}
</script>
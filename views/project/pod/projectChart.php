<?php 
$cssAnsScriptFilesModule = array(
	'/plugins/Chart.js/Chart.min.js'
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->request->baseUrl);

$tabCommons = array(	"0" => "Ne souhaite pas",
	                    "20" => "Pas applicable",
	                    "40" => "Souhait mais pas démarré",
						"60" => "Démarré",
						"80" => "En progression",
						"100" => "Réalisé"
					);

?>

<style>
#myChart {
	padding: 10px 10px 10px 10px;
}

</style>

<?php if(!isset($chartAlone)) { ?>
<div class="panel panel-white">

	<div class="panel-heading border-light bg-dark">
		<h4 class="panel-title"><span><i class="fa fa-puzzle-piece"></i> <?php echo Yii::t("project","Chart",null,Yii::app()->controller->module->id) ?></span></h4>	
	</div>
	<div class="panel-tools">			
		<?php if (($admin || $openEdition) && @Yii::app()->session["userId"]){	?>
		<a id="" class="edit-chart btn btn-xs btn-light-blue tooltips" 
			data-toggle="tooltip" data-placement="top" title="" alt="" data-original-title="<?php echo Yii::t("project","Edit properties",null,Yii::app()->controller->module->id) ?>" onclick="showElementPad('addchart')">
			<i class="fa fa-pencil"></i> Editer la charte 
		</a>
		<?php } ?>
	</div>
		<div id="infoPodChart" class="padding-10 <?php if(!empty($properties)) echo "hide" ?>">
			<blockquote> 
				<?php echo Yii::t("project","Create Chart<br/>Opening<br/>Values<br/>Governance<br/>To explain the aim and draw project conduct",null,Yii::app()->controller->module->id) ?>
			</blockquote>
		</div>
		<div class="panel-body no-padding contentChart <?php if(empty($properties)) echo "hide" ?>">
			<canvas id="myChart" width="" height=""></canvas>
			<div class="col-md-12 col-sm-12 col-xs-12">
			<?php
				$inc=0; 
				foreach($properties as $key => $value){ ?>
				
				<?php 
					if(gettype ($value) == "array"){
					//if($value["value"] || !empty($value["description"])){ ?>
				<div class="col-md-12 col-sm-12 col-xs-12 no-padding descriptionLabel description<?php echo $key ?> <?php if ($inc > 0) echo 'hide'; ?>">
					<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
					<h2 class="text-large text-dark text-bold light-text timeline_title no-margin pull-left">
						<?php echo ucfirst($key) ?>
					</h2>
					</div><br/>
					<div class="col-md-12 col-sm-12 col-xs-12 no-padding"><span class="text-red light-text timeline_title pull-left"><?php echo $tabCommons[$value["value"]]; ?></span></div><br/>
					<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
					<span><?php echo $value["description"]; ?></span></div>
				</div> 
			<?php 
					$inc++;
					//}
					 }
				} ?>
			</div>
		</div>
	<!--	<div id="infoPodChart" class="padding-10">
			<blockquote> 
				<?php echo Yii::t("project","Create Chart<br/>Opening<br/>Values<br/>Governance<br/>To explain the aim and draw project conduct",null,Yii::app()->controller->module->id) ?>
			</blockquote>
		</div>
		<div class="panel-body no-padding contentChart hide">
			<canvas id="myChart" width="" height=""></canvas>
		</div>-->
</div>
<?php }else if($chartAlone == true){ ?>
	<canvas id="myChart" width="" height=""></canvas>
<?php } ?>

<script type="text/javascript">
var properties=<?php echo json_encode($properties); ?> ;
mylog.log(properties);
var countProperties=numAttrs(properties);
jQuery(document).ready(function() {
	Chart.defaults.global = {
			// Boolean - Whether to animate the chart
			animation: true,
		    // Number - Number of animation steps
		    animationSteps: 60,
		    // String - Animation easing effect
		    animationEasing: "easeOutQuart",
		    // Boolean - If we should show the scale at all
		    showScale: true,
		    // Boolean - If we want to override with a hard coded scale
		    scaleOverride: false,
		    // ** Required if scaleOverride is true **
		    // Number - The number of steps in a hard coded scale
		    scaleSteps: null,
		    // Number - The value jump in the hard coded scale
		    scaleStepWidth: null,
		    // Number - The scale starting value
		    scaleStartValue: null,
		    // String - Colour of the scale line
		    scaleLineColor: "rgba(0,0,0,.3)",
		    // Number - Pixel width of the scale line
		    scaleLineWidth: 1,
		    // Boolean - Whether to show labels on the scale
		    scaleShowLabels: true,
		    // Interpolated JS string - can access value
		    scaleLabel: "<%=value%>",
		    // Boolean - Whether the scale should stick to integers, not floats even if drawing space is there
		    scaleIntegersOnly: true,
		    // Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
		    scaleBeginAtZero: false,
		    // String - Scale label font declaration for the scale label
		    scaleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
		    // Number - Scale label font size in pixels
		    scaleFontSize: 18,
		    // String - Scale label font weight style
		    scaleFontStyle: "normal",
		    // String - Scale label font colour
		    scaleFontColor: "#666",
		    // Boolean - whether or not the chart should be responsive and resize when the browser does.
		    responsive: true,
		    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		    maintainAspectRatio: true,
		    // Boolean - Determines whether to draw tooltips on the canvas or not
		    showTooltips: true,
		    // Function - Determines whether to execute the customTooltips function instead of drawing the built in tooltips (See [Advanced - External Tooltips](#advanced-usage-custom-tooltips))
		    customTooltips: false,
		    // Array - Array of string names to attach tooltip events
		    tooltipEvents: ["mousemove", "touchstart", "touchmove"],
		    // String - Tooltip background colour
		    tooltipFillColor: "rgba(0,0,0,0.8)",
		    // String - Tooltip label font declaration for the scale label
		    tooltipFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
		    // Number - Tooltip label font size in pixels
		    tooltipFontSize: 14,
		    // String - Tooltip font weight style
		    tooltipFontStyle: "normal",
		    // String - Tooltip label font colour
		    tooltipFontColor: "#fff",
		    // String - Tooltip title font declaration for the scale label
		    tooltipTitleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
		    // Number - Tooltip title font size in pixels
		    tooltipTitleFontSize: 14,
		    // String - Tooltip title font weight style
		    tooltipTitleFontStyle: "bold",
		    // String - Tooltip title font colour
		    tooltipTitleFontColor: "#fff",
		    // Number - pixel width of padding around tooltip text
		    tooltipYPadding: 6,
		    // Number - pixel width of padding around tooltip text
		    tooltipXPadding: 6,
		    // Number - Size of the caret on the tooltip
		    tooltipCaretSize: 8,
		    // Number - Pixel radius of the tooltip border
		    tooltipCornerRadius: 6,
		    // Number - Pixel offset from point x to tooltip edge
		    tooltipXOffset: 10,
		    // String - Template string for single tooltips
		    tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		    // String - Template string for multiple tooltips
		    multiTooltipTemplate: "<%= value %>",
		    // Function - Will fire on animation progression.
		    onAnimationProgress: function(){},
		    // Function - Will fire on animation completion.
		    onAnimationComplete: function(){}
		}
	if (countProperties > 0){
		//setTimeout(function(){
		if(typeof chartToLoad == "undefined"){
			chartInit(properties);
		}
		//}, 0);
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
			$("#infoPodChart").removeClass("hide");
			$(".contentChart").addClass("hide");
			//$("#myChart").attr("width","0");
			//$("#myChart").attr("height","0");
			
		}
		else {
			chartInit(data);
		}
		countProperties=nbProperties;
	}
}

function chartInit(dataProperties){
	mylog.log(dataProperties);
	var labelProperties=[];
	var valueProperties=[];
	for (var label in dataProperties){
		labelProperties.push(label);
		valueProperties.push(dataProperties[label]["value"]);
	}
	
	console.log(labelProperties);
	console.log(valueProperties);
	Chart.defaults.global = {
		// Boolean - Whether to animate the chart
		animation: true,
	    // Number - Number of animation steps
	    animationSteps: 60,
	    // String - Animation easing effect
	    animationEasing: "easeOutQuart",
	    // Boolean - If we should show the scale at all
	    showScale: true,
	    // Boolean - If we want to override with a hard coded scale
	    scaleOverride: false,
	    // ** Required if scaleOverride is true **
	    // Number - The number of steps in a hard coded scale
	    scaleSteps: null,
	    // Number - The value jump in the hard coded scale
	    scaleStepWidth: null,
	    // Number - The scale starting value
	    scaleStartValue: null,
	    // String - Colour of the scale line
	    scaleLineColor: "rgba(0,0,0,.1)",
	    // Number - Pixel width of the scale line
	    scaleLineWidth: 1,
	    // Boolean - Whether to show labels on the scale
	    scaleShowLabels: true,
	    // Interpolated JS string - can access value
	    scaleLabel: "<%=value%>",
	    // Boolean - Whether the scale should stick to integers, not floats even if drawing space is there
	    scaleIntegersOnly: true,
	    // Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
	    scaleBeginAtZero: false,
	    // String - Scale label font declaration for the scale label
	    scaleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
	    // Number - Scale label font size in pixels
	    scaleFontSize: 18,
	    // String - Scale label font weight style
	    scaleFontStyle: "normal",
	    // String - Scale label font colour
	    scaleFontColor: "#666",
	    // Boolean - whether or not the chart should be responsive and resize when the browser does.
	    responsive: true,
	    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
	    maintainAspectRatio: true,
	    // Boolean - Determines whether to draw tooltips on the canvas or not
	    showTooltips: true,
	    // Function - Determines whether to execute the customTooltips function instead of drawing the built in tooltips (See [Advanced - External Tooltips](#advanced-usage-custom-tooltips))
	    customTooltips: false,
	    // Array - Array of string names to attach tooltip events
	    tooltipEvents: ["mousemove", "touchstart", "touchmove"],
	    // String - Tooltip background colour
	    tooltipFillColor: "rgba(0,0,0,0.8)",
	    // String - Tooltip label font declaration for the scale label
	    tooltipFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
	    // Number - Tooltip label font size in pixels
	    tooltipFontSize: 14,
	    // String - Tooltip font weight style
	    tooltipFontStyle: "normal",
	    // String - Tooltip label font colour
	    tooltipFontColor: "#fff",
	    // String - Tooltip title font declaration for the scale label
	    tooltipTitleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
	    // Number - Tooltip title font size in pixels
	    tooltipTitleFontSize: 14,
	    // String - Tooltip title font weight style
	    tooltipTitleFontStyle: "bold",
	    // String - Tooltip title font colour
	    tooltipTitleFontColor: "#fff",
	    // Number - pixel width of padding around tooltip text
	    tooltipYPadding: 6,
	    // Number - pixel width of padding around tooltip text
	    tooltipXPadding: 6,
	    // Number - Size of the caret on the tooltip
	    tooltipCaretSize: 8,
	    // Number - Pixel radius of the tooltip border
	    tooltipCornerRadius: 6,
	    // Number - Pixel offset from point x to tooltip edge
	    tooltipXOffset: 10,
	    // String - Template string for single tooltips
	    tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
	    // String - Template string for multiple tooltips
	    multiTooltipTemplate: "<%= value %>",
	    // Function - Will fire on animation progression.
	    onAnimationProgress: function(){},
	    // Function - Will fire on animation completion.
	    onAnimationComplete: function(){}
}
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
document.getElementById("myChart").onclick = function(evt){
    var activePoints = myNewChart.getPointsAtEvent(evt);
    /* this is where we check if event has keys which means is not empty space */       
    if(Object.keys(activePoints).length > 0)
    {
        var label = activePoints[0]["label"];
        var value = activePoints[0]["value"];
        $(".descriptionLabel").addClass("hide");
        $(".description"+label).removeClass("hide");
        //var url = "http://example.com/?label=" + label + "&value=" + value
        /* process your url ... */
    }
};
	///////////// LAST ON DEVELOPMENT //////////////
	/*var data = {
=======
	mylog.log(labelProperties);
	mylog.log(valueProperties);
	
	var data = {
>>>>>>> origin/master
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
	console.log(myNewChart);*/

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
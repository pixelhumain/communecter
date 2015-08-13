<div id="container2" style="min-width: 350px; height: 350px; margin: 0 auto"></div>
<script type="text/javascript">

var getColor = {
    'Pou': '#93C22C',
    'Con': '#db254e',
    'Abs': 'white', 
    'Pac': 'yellow', 
    'Plu': '#789289'
};
function setUpGraph(){
	log("setUpGraph");
	$('#container2').highcharts({
	    chart: {
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false
	    },
	    title: {
	        text: "Votes sur <?php echo htmlentities($name)?> "
	    },
	    tooltip: {
	      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	    },
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
	            cursor: 'pointer',
	            dataLabels: {
	                enabled: true,
	                color: '#000000',
	                connectorColor: '#000000',
	                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
	            }
	        }
	    },
	    series: [{
	        type: 'pie',
	        name: 'Vote',
	        data: [
	        	{ name: 'Vote Pour',y: <?php echo $voteUpCount?>, color: getColor['Pou'] },
	        	{ name: 'Vote Contre',y: <?php echo $voteDownCount?>, color: getColor['Con'] },
	        	{ name: 'Abstention',y: <?php echo $voteAbstainCount?>, color: getColor['Abs'] },
	        	{ name: 'Pas Clair',y: <?php echo $voteUnclearCount?>, color: getColor['Pac'] },
	        	{ name: "Plus d'infos",y: <?php echo $voteMoreInfoCount?>, color: getColor['Plu'] }
	        ]
	    }]
	});
};
</script>
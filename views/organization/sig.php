<!-- start: PAGE CONTENT -->

<style>
.flexslider .slides {
    height: 250px;
}
.flexslider img {
    height: 250px;
}

.flex-control-nav{
	display: none;
}

.divLeftEv{
	height: 100px;
	text-align: center;
}
#infoEventLink{
	width: 100%;
	background-color: #98bf0c;
	text-align: left;
}
#infoEventLink a{
	color:white;
}

#infoEventLink a:hover{
	color:black;
}
</style>


<!-- end: PAGE CONTENT-->
<script>
	var contextMap = {// "desc" 	: ["organization", "event"],
					   "organization" 	: <?php echo json_encode($organization) ?>,
					   "event" 			: <?php echo json_encode($events) ?>
					 };
</script>


<div class="row">

  <div class="col-xs-12">
  <?php
    /* **************** paramètres de la map *******************/
	$sigParams = array(
    "sigKey" => "OrgaSig",
    //"mapTileLayer" => 'http://toolserver.org/tiles/hikebike/{z}/{x}/{y}.png',
    "mapTileLayer" 	  => 'http://{s}.tile.thunderforest.com/landscape/{z}/{x}/{y}.png',//http://{s}.tile.thunderforest.com/landscape/{z}/{x}/{y}.png', //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png'
    "mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'
    "mapHeight" => 450,
    "mapTop" => 50,
    "useFullScreen" => false,
    "usePanel" => true,
    "useRightList" => true,
    "useExternalRightList" => false,
    "useZoomButton" => true,
    "useHomeButton" => false,
    "useHelpCoordinates" => false,
    "useResearchTools" => true,
    "firstView"		  => array(  "coordinates" => array(-21.261220997023237, 55.5029296875),
                               "zoom"		     => 9),
			);
		/* ******************************************************/
    $this->renderPartial('../organization/dashboard/networkMap',array( "organization" => $organization, "sigParams" => $sigParams));
    ?>
  </div>
</div>

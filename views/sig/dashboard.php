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
<div class="row">

  <div class="col-xs-12">
    <?php 
    $this->renderPartial('../organization/dashboard/networkMap',array( "organization" => $organization));
    ?>
  </div>
</div>
<div class="row">
  	<div class="col-sm-5 col-xs-12">
	    <?php $this->renderPartial('../pod/sliderAgenda', array("events" => $events)); ?>
	</div>
	<div class="col-sm-5 col-xs-12">
	    <?php $this->renderPartial('../pod/randomOrganization',array( "randomOrganization" => (isset($randomOrganization)) ? $randomOrganization : null )); ?>
	</div>
  </div>
</div>

<!-- end: PAGE CONTENT-->
<script>
	var contextMap = { "desc" : [ "organization", "events " ] };
	contextMap.organization = <?php echo json_encode($organization) ?>;
	contextMap.events = <?php echo json_encode($events) ?>;
</script>


<?php 
		$moduleName = "sigModule".$sigParams['sigKey'];
		$mapHeight = $sigParams["mapHeight"];
		$mapTop 	= $sigParams["mapTop"];
?>

<style>

	.<?php echo $moduleName; ?> 
	.mapCanvas{
		height:<?php echo $mapHeight; ?>px;
		width:75%;
	}
	
	.<?php echo $moduleName; ?> 
	.panel_map{
		position:absolute !important;
		height:<?php echo $mapHeight; ?>px; 
		padding-right:10px;
		top:<?php echo $mapTop; ?>px;
	}
	
	.<?php echo $moduleName; ?> 
	#right_tool_map{
		height:<?php echo $mapHeight; ?>px;		
		top:<?php echo $mapTop; ?>px;
	}
	
	.<?php echo $moduleName; ?> 
	#lbl-chk-scope{
		background-color:white;
	}
	
	.<?php echo $moduleName; ?> 
	#liste_map_element{
		background-color:white;
		height:<?php echo $mapHeight-100; ?>px;
	}
	
	.<?php echo $moduleName; ?> 
	.btn-group-map{
		position:absolute !important;
		right:25%;
		left:auto;
		top:<?php echo $mapTop+10; ?>px;
	}
	
	/* XS */
	@media screen and (max-width: 768px) {
		
		.<?php echo $moduleName; ?> 
		.mapCanvas{
			width:100%; 
		}
		
		.<?php echo $moduleName; ?> 
		.btn-group-map{
			right:0% !important;
		}
	}
	
</style>
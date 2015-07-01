

<?php
		$moduleName  = "sigModule".$sigParams['sigKey'];

		$mapHeight   = ( isset( $sigParams["mapHeight"]))   ? $sigParams["mapHeight"]   : 400;
		$mapColor    = ( isset( $sigParams["mapColor"]))    ? $sigParams["mapColor"]    : '';
		$mapTop 	 = ( isset( $sigParams["mapTop"] ))     ? $sigParams["mapTop"]      	: 0;

		$mapBtnBgColor       = ( isset( $sigParams["mapBtnBgColor"])) 			? $sigParams["mapBtnBgColor"] 			: '#E6D414';
		$mapBtnColor 	     = ( isset( $sigParams["mapBtnColor"]))   			? $sigParams["mapBtnColor"]   			: '#213042';
		$mapBtnBgColor_hover = ( isset( $sigParams["mapBtnBgColor_hover"]))   	? $sigParams["mapBtnBgColor_hover"]   	: '#5896AB';

		$panelTop = 20;
?>
<style>

	<?php   $mapWidth = "100%";
			if($sigParams['useRightList']) $mapWidth = "75%";
	?>

	.<?php echo $moduleName; ?>
	.mapCanvas{
		height:<?php echo $mapHeight; ?>px;
		width:<?php echo $mapWidth ?> !important;
		background-color:<?php echo $mapColor; ?>;
	}

	.<?php echo $moduleName; ?>
	.btn-open-panel_map{
		position:absolute !important;
		top:<?php echo $panelTop; ?>px;
		left:<?php echo $panelTop; ?>px;
	}

	.<?php echo $moduleName; ?>
	.panel_map{
		position:absolute !important;
		height:<?php echo $mapHeight; ?>px;
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

	<?php   $right = "0px";
			if($sigParams['useRightList']) $right = "25%";
	?>
	.<?php echo $moduleName; ?>
	.btn-group-map{
		position:absolute !important;
		right:<?php echo $right; ?>;
		left:auto;
		top:<?php echo $mapTop+10; ?>px;
	}

	.<?php echo $moduleName; ?>
	.btn-map{
		background-color:<?php echo $mapBtnBgColor." !important"; ?>; /*#E6D414*/
		color:<?php echo $mapBtnColor." !important"; ?>; /*#213042 */
	}
	.btn-map:hover{
		background-color:<?php echo $mapBtnBgColor_hover." !important"; ?>; /*#E6D414#5896AB !important;*/
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

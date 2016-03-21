

<?php
		$moduleName  = "sigModule".$sigParams['sigKey'];

		$mapHeight   = ( isset( $sigParams["mapHeight"]))   ? $sigParams["mapHeight"]   : 400;
		$mapColor    = ( isset( $sigParams["mapColor"]))    ? $sigParams["mapColor"]    : '';
		$mapTop 	 = ( isset( $sigParams["mapTop"] ))     ? $sigParams["mapTop"]      	: 0;

		$mapBtnBgColor       = ( isset( $sigParams["mapBtnBgColor"])) 			? $sigParams["mapBtnBgColor"] 			: '#2A3945';
		$mapBtnColor 	     = ( isset( $sigParams["mapBtnColor"]))   			? $sigParams["mapBtnColor"]   			: '#fff';
		$mapBtnBgColor_hover = ( isset( $sigParams["mapBtnBgColor_hover"]))   	? $sigParams["mapBtnBgColor_hover"]   	: '#5896AB';

		$panelTop = 20;
?>
<style>

	<?php   $mapWidth = "100%";
			//if($sigParams['useRightList']) $mapWidth = "75%";
	?>

	.<?php echo $moduleName; ?>
	.mapCanvas{
		height:<?php echo $mapHeight; ?>px;
		width:<?php echo $mapWidth ?> !important;
		/*background-color:<?php echo $mapColor; ?>;*/
		/*background:url("<?php echo $this->module->assetsUrl; ?>/images/fabric_plaid.png") repeat;*/
	}

	.<?php echo $moduleName; ?>
	.btn-open-panel_map{
		position:absolute !important;
		top:<?php echo $panelTop; ?>px;
		left:<?php echo $panelTop; ?>px;
	}

	.<?php echo $moduleName; ?>
	.panel_map{
		max-width:300px !important;
		width:300px !important;
		background:#7093A7;
		border-radius: 0px;
		/*position:absolute !important;*/
		/*height:<?php echo $mapHeight; ?>px;*/
		/*top:<?php echo $mapTop; ?>px;*/
	}

	.<?php echo $moduleName; ?>
	#right_tool_map{
		height:<?php echo (int)$mapHeight - 60; ?>px;
		top:<?php echo (int)$mapTop + 30; ?>px;
	}

	.<?php echo $moduleName; ?>
	#lbl-chk-scope{
		/*background-color:white;*/
	}

	.<?php echo $moduleName; ?>
	#liste_map_element{
		background-color:white;
		height:<?php echo $mapHeight-100; ?>px;
	}

	<?php   $right = "0px";
			if($sigParams['useRightList']) $right = "30%";
	?>
	.<?php echo $moduleName; ?>
	.btn-group-map{
		position:absolute !important;
		/*right:<?php echo $right; ?>;*/
		left:20px;
		top:<?php echo $mapTop+30; ?>px;
	}
	
	.<?php echo $moduleName; ?>
	.btn-map{
		background-color:<?php echo $mapBtnBgColor." !important"; ?>; /*#E6D414*/
		color:<?php echo $mapBtnColor." !important"; ?>; /*#213042 */
	}
	.<?php echo $moduleName; ?>
	.btn-map:hover{
		background-color:<?php echo $mapBtnBgColor_hover." !important"; ?>; /*#E6D414#5896AB !important;*/
	}

	.<?php echo $moduleName; ?> 
	.btn-group-charts	{
		top:<?php echo $mapTop + 70; ?>px;px;
		right:<?php echo $right ?> !important;
		position:absolute;
		margin-right: 10px;
	}
	.<?php echo $moduleName; ?> 
	.btn-group-charts .btn-map	{
		background-color:rgba(255, 255, 255, 0.72) !important;
		font-size:13px !important;
		max-width:200px;
		text-align: left;
	}
	.<?php echo $moduleName; ?>
	.btn-group-charts .btn-map:hover{
		background-color:#FFF !important; /*#E6D414#5896AB !important;*/
	}

	.<?php echo $moduleName; ?>
	.leaflet-tile-container{

	}

	.<?php echo $moduleName; ?>
	#modalItemNotLocated .modal-body .btn-more{
		display: none !important;
	}

	.<?php echo $moduleName; ?>
	.bg-main-menu{
		background-color: rgba(26, 33, 38, 0.68);
		position: fixed;
		top: 0px;
		left: 0px;
		width: 16.5%;
		height: 100%;
		-moz-box-shadow: 0px 0px 5px -2px rgba(153, 153, 153, 0.73);
	    -webkit-box-shadow: 0px 0px 5px -2px rgba(153, 153, 153, 0.73);
	    -o-box-shadow: 0px 0px 5px -2px rgba(153, 153, 153, 0.73);
	    box-shadow: 0px 0px 5px -2px rgba(153, 153, 153, 0.73);
	    filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=5);
	}


	.<?php echo $moduleName; ?>
	#mapLegende{
		-moz-box-shadow: 0px 0px 5px -2px rgba(153, 153, 153, 0.73);
		-webkit-box-shadow: 0px 0px 5px -2px rgba(153, 153, 153, 0.73);
		-o-box-shadow: 0px 0px 5px -2px rgba(153, 153, 153, 0.73);
		box-shadow: 0px 0px 5px -2px rgba(153, 153, 153, 0.73);
		filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=5);
		display: none;
		position: fixed;
		top: 70px;
		left: 19%;
		width: 30%;
		min-width: 200px;
		max-height: 100px;
		background-color: rgba(26, 33, 38, 0.93);
		border-radius: 4px;
		color: white;
		padding: 14px;
		font-size: 12px;
		font-weight: 300;
		min-height: 45px;
		overflow: hidden;
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

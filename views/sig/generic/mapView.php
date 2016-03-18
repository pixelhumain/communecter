<?php
	//securise tous les paramètres utilisés dans mapView.php
	$elements = array('usePanel', 		'useRightList',  'useResearchTools', 	'useZoomButton',
					  'useHomeButton', 	'useFullScreen', 'useHelpCoordinates', 	'useChartsMarkers');

	foreach($elements as $element){
		$sigParams[$element] = isset($sigParams[$element]) ? $sigParams[$element] : false;
	}
	
?>
<div class="sigModule<?php echo $sigParams['sigKey']; ?>">
	<div class="mapCanvas" id="mapCanvas<?php echo $sigParams['sigKey']; ?>">
		<!-- <center><img class="world_pix" style="margin-top:50px;" src="<?php echo $this->module->assetsUrl; ?>/images/shattered.png"></center> -->
    </div>

	<div class="bg-main-menu bgpixeltree_sig hidden-xs"></div>

	

	<?php if($sigParams['useRightList']){ ?>
		<div id="right_tool_map" class="hidden-xs hidden-sm">

			<!-- 	HEADER -->
			<div class="right_tool_map_header">
				<?php if($sigParams['usePanel']){ ?>
				<div class="btn-group btn-group-lg dropdown  pull-right" id="btn-tags">
					<button type="button" class="btn btn-map dropdown-toggle" id="btn-panel" data-toggle="dropdown">
						<i class="fa fa-tags"></i>
					</button>
					<ul class="dropdown-menu panel_map pull-right" id="panel_map" role="menu" aria-labelledby="panel_map">
					    <h3 class="title_panel_map"><i class="fa fa-angle-down"></i> Filtrer les résultats par tags</h3>
						<button class='item_panel_map' id='item_panel_map_all'>
							<i class='fa fa-star'></i> Tous
						</button>
					</ul>
				</div>	
			<?php } ?>
			<?php if($sigParams['useFilterType']){ ?>
				<div class="btn-group btn-group-lg dropdown  pull-right" id="btn-filter">
					<button type="button" class="btn btn-map dropdown-toggle" id="btn-filters" data-toggle="dropdown">
						<i class="fa fa-filter"></i>
					</button>
					<ul class="dropdown-menu panel_map" id="panel_filter" role="menu" aria-labelledby="panel_filter">
					    <h3 class="title_panel_map"><i class="fa fa-angle-down"></i> Filtrer les résultats par types</h3>
						<button class='item_panel_map' id='item_panel_filter_all'>
							<i class='fa fa-star'></i> Tous
						</button>
					</ul>
				</div>
			<?php } ?>	
			<span class="right_tool_map_header_title">Résultats</span>
				<span class="right_tool_map_header_info">935 / 1034</span>
				
			</div>
			
			<!-- 	PSEUDO SEARCH -->
			<div id="map_pseudo_filters">

				<input class="form-control date-range active" type="text" id="input_name_filter" placeholder="filtrer par nom ...">
				
			</div>
			<!-- 	PSEUDO SEARCH -->

			<!-- 	LIST ELEMENT -->
			<div id="liste_map_element">
			</div>

			<label id="lbl-chk-scope">
				<nav>
				  <ul class="pagination pagination-sm" id="pagination"></ul>
				</nav>
			</label>

			<!-- <label id="lbl-chk-scope" class="hidden">
				<input style="" value="" style="margin-left:0px;" type="checkbox" id="chk-scope"> Filtrer dans la zone visible
			</label> -->

		</div>
		<div id="modalItemNotLocated" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title text-dark"><i class="fa fa-map-marker"></i></i> Cette donnée n'est pas géolocalisée</h4>
			      </div>
			      <div class="modal-body"></div>
			      <div class="modal-footer">
			        <button type="button" id="btn-open-details" class="btn btn-default btn-sm btn-success" data-dismiss="modal"><i class="fa fa-plus"></i> Afficher les détails</button>
			      	<button type="button" class="btn btn-default btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fermer</button>
			      </div>
			    </div>

			  </div>
			</div>
	<?php } ?>


		<div class="btn-group btn-group-lg btn-group-map input-search-place">
		<?php if($sigParams['useResearchTools']){ ?>
			<input type="text" class="pull-left input-search-place-in-map txt-find-place" id="txt-find-place" placeholder="rechercher un lieu" style="margin-top:2px;">
			<button type="button" class="btn btn-map pull-right" id="btn-find-more"><i class="fa fa-ellipsis-h"></i></button>
				
			<div class="" class="pull-right">
			  	<div class="hidden" id="full-research">
					<input type="text" class="input-search-place-in-map input-2s" 				 id="txt-num-place" 	placeholder="n°" 		style="margin-top:2px;">
					<input type="text" class="input-search-place-in-map input-2s" 				 id="txt-street-place" 	placeholder="rue" 		style="margin-top:2px;"><br/>
					<input type="text" class="input-search-place-in-map input-3s txt-find-place" id="txt-city-place" 	placeholder="ville">
					<input type="text" class="input-search-place-in-map input-3s txt-find-place" id="txt-cp-place" 		placeholder="code postal"><br/>
					<input type="text" class="input-search-place-in-map input-4s txt-find-place" id="txt-state-place" 	placeholder="pays"><br/>
	            </div>
	            <div class="dropdown pull-left" id="dropdown-find-place">
	                 <a href="#" id="btn-dropdown-find-place" data-toggle="dropdown" class="dropdown-toggle"></a>
	                 <ul id="list-dropdown-find-place" class="dropdown-menu" style=" width:100%;" role="menu" aria-labelledby="dropdown-find-place">
	                 	<li style="width:100%;"><a href="#" class="btn-find-place"><i class="fa fa-magic"></i> lancer la recherche ...</a></li>
	                 </ul>
	            </div>
	        </div>
		<?php } ?>
			<i class="fa fa-refresh fa-spin fa-2x" id="ico_reload"></i>
		</div>
	
		<?php if($sigParams['useChartsMarkers']){ ?>
			<div class="btn-group-vertical btn-group-lg btn-group-charts" id="btn-group-charts-map">
			
			</div>
		<?php } ?>

		<div class="btn-group-map tools-btn">
		
			

			<?php if($sigParams['useSatelliteTiles']){ ?>
				<div class="btn-group btn-group-lg">
					<button type="button" class="btn btn-map" id="btn-satellite"><i class="fa fa-magic"></i></button>
				</div>
			<?php } ?>	
			<?php if($sigParams['useZoomButton']){ ?>
				<div class="btn-group btn-group-lg">		
					<button type="button" class="btn btn-map " id="btn-zoom-out"><i class="fa fa-search-minus"></i></button>
					<button type="button" class="btn btn-map" id="btn-zoom-in"><i class="fa fa-search-plus"></i></button>
				</div>
			<?php } ?>
			<?php if($sigParams['useHomeButton']){ ?>
				<div class="btn-group btn-group-lg">
					<button type="button" class="btn btn-map" id="btn-home"><i class="fa fa-bullseye"></i></button>
				</div>
			<?php } ?>	
			
			
		</div>

		<div id="mapLegende" class="text-azure">Legende</div>

	<?php if($sigParams['useFullScreen']){ ?>
		<!--<div class="btn-group btn-group-lg btn-group-map btn-full-screen">
			<button type="button" class="btn btn-map " id="btn-full-screen"><i class="fa fa-expand"></i></button>
		</div>-->
	<?php } ?>

    <?php if($sigParams['useHelpCoordinates']){ ?>
		<div id="help-coordinates">0,000</div>
	<?php } ?>
</div>

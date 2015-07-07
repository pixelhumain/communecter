
<div class="sigModule<?php echo $sigParams['sigKey']; ?>">
	<div class="mapCanvas" id="mapCanvas<?php echo $sigParams['sigKey']; ?>">
		<center><img class="world_pix" style="margin-top:50px;" src="<?php echo $this->module->assetsUrl; ?>/images/world_pixelized.png"></center>
    </div>

	<?php if($sigParams['usePanel']){ ?>
		<div class="panel_map">
			<?php if(isset($sigParams['titlePanel'])) { ?>
			<h3 id="title_panel"><i class="fa fa-angle-down"></i> <?php echo $sigParams['titlePanel']; ?></h3>
			<?php } ?>
			<button class='item_panel_map' id='item_panel_map_all'>
				<i class='fa fa-star'></i> Tous
			</button>
		</div>
	<?php } ?>

	<?php if($sigParams['useRightList']){ ?>
		<div id="right_tool_map" class="hidden-xs">

			<!-- 	PSEUDO SEARCH -->
			<div id="map_pseudo_filters">

				<div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-search"></i> </span>
						<input class="form-control date-range active" type="text" id="input_name_filter" placeholder="recherche par nom">
				</div>
			</div>
			<!-- 	PSEUDO SEARCH -->

			<!-- 	LIST ELEMENT -->
			<div id="liste_map_element">
			</div>

			<label id="lbl-chk-scope">
				<input style="" value="" style="margin-left:0px;" type="checkbox" id="chk-scope"> Filtrer dans la zone visible
			</label>
		</div>
	<?php } ?>


	<?php if($sigParams['useResearchTools']){ ?>
		<div class="btn-group btn-group-lg btn-group-map input-search-place">
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
		</div>
	<?php } ?>
	
		<div class="btn-group btn-group-lg btn-group-map">
		
			<button type="button" class="btn btn-map-separator"></button>
			<?php if($sigParams['useHomeButton']){ ?>
				<button type="button" class="btn btn-map" id="btn-home"><i class="fa fa-home"></i></button>
				<button type="button" class="btn btn-map-separator"></button>
			<?php } ?>
			<?php if($sigParams['useZoomButton']){ ?>
				<button type="button" class="btn btn-map " id="btn-zoom-out"><i class="fa fa-search-minus"></i></button>
				<button type="button" class="btn btn-map" id="btn-zoom-in"><i class="fa fa-search-plus"></i></button>
			<?php } ?>
				<br/>
			
		</div>

	<?php if($sigParams['useFullScreen']){ ?>
		<!--<div class="btn-group btn-group-lg btn-group-map btn-full-screen">
			<button type="button" class="btn btn-map " id="btn-full-screen"><i class="fa fa-expand"></i></button>
		</div>-->
	<?php } ?>

	<div class="btn-group btn-group-lg btn-group-map" style="left:390px">
		<i class="fa fa-refresh fa-spin fa-2x" id="ico_reload"></i>
	</div>

    <?php if($sigParams['useHelpCoordinates']){ ?>
		<div id="help-coordinates">0,000</div>
	<?php } ?>
</div>

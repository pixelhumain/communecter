<?php 
		//chargement de toutes les librairies css et js indispensable pour la carto 
    	$this->renderPartial('mapLibs');
		
		$mapHeight = 450;
?>

<style>
	.mapCanvas{
		height:<?php echo $mapHeight; ?>px;
		width:75%;
	}
	.panel_map{
		position:absolute !important;
		height:<?php echo $mapHeight; ?>px; 
		padding-right:10px;
	}
	#right_tool_map{
		height:<?php echo $mapHeight; ?>px;
	}
	#lbl-chk-scope{
		background-color:white;
	}
	#liste_map_element{
		background-color:white;
		height:<?php echo $mapHeight-100; ?>px;
	}
	.btn-group-map{
		position:absolute !important;
		right:25%;
		left:auto;
		top:60px;
	}
	
	/* XS */
	@media screen and (max-width: 768px) {
		.mapCanvas{
			width:100%; 
		}
		.btn-group-map{
			right:0% !important;
		}
	}
	
</style>

<div class="panel panel-white">
  <div class="panel-heading border-light">
    <h4 class="panel-title">Annuaire Cartographique</h4>
    <div class="panel-tools"
      <a class="btn btn-xs btn-link panel-close" href="#">
        <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="panel-body no-padding">
    
			        	<div class="mapCanvas" id="mapCanvasSV">
			        		<center><img style="margin-top:50px;" src="<?php echo $this->module->assetsUrl; ?>/images/world_pixelized.png"></center>
			            </div>
			        	
			        	<div class="panel_map">
			        		<p class="item_panel_map hidden-xs">
			        		</p>
			        		<?php /*
			        				$where = array(	'name'  => "asso1" );
									$assos = PHDB::find(PHType::TYPE_GROUPS, $where);
									
									foreach($assos as $asso){
										foreach($asso["tags_rangement"] as $tag)
										echo '<a href="javascript:changeFilter(\''.$tag["name"].'\')">'.
			        							'<p class="item_panel_map" id="item_panel_map_'.$tag["name"].'">'.
			        							'<i class="fa fa-'.$tag["ico"].' fa-'.$tag["color"].'"></i><span class="filter_name hidden-xs"> '.$tag["name"].'</span>
			        							</p>
			        						  </a>';			        						  
									}
							 
							 */
			        		?>

			        		<!--<button type="button" class="btn btn-default hidden-xs" id="btn-init-data"><i class="fa fa-database"></i>Initialiser les données</button>-->
			        		
			        	</div>
			        	
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
						
			        	<div class="btn-group btn-group-lg btn-group-map">
			        		<button type="button" class="btn btn-map " id="btn-zoom-out-dashOrga"><i class="fa fa-search-minus"></i></button>
			        		<button type="button" class="btn btn-map" id="btn-zoom-in-dashOrga"><i class="fa fa-search-plus"></i></button>
			        	</div>
			        	<div class="btn-group btn-group-lg btn-group-map" style="left:390px">
			        		<i class="fa fa-refresh fa-spin fa-2x" id="ico_reload"></i>
			        	</div>
  </div>
</div>
<div id="help-coordinates">0,000</div>
<script type="text/javascript">
	
	//##
	//##	INIT DATA	##
	//##	
	function initData(){ return;
		var params = new Array();
		$.ajax({
			url:baseUrl+'/communecter/sig/InitDataNetworkMapping',
			data:params,
			type:"POST",
			dataType:"json",
			success:function(data) { 	
				toastr.success(data);
			}
		});
	}
	
	//##
	//##	MAP	##
	//##
		
	var Sig;
	
	//liste de tous les filtres du panel
	//var allTagFilter = new Array("projectLeader", "pixelActif", "commune", "association", "entreprise", "citoyen", "parnerPH", "artiste");		
	
	
	
	var mapDashOrga;
	var assetPath = "<?php echo $this->module->assetsUrl; ?>";
	
	
	
	jQuery(document).ready(function()
	{ 	
		//alert("dump : " + JSON.stringify(contextMap.members));
		Sig = SigLoader.getSig();
		
		//gère la liste des tags à ne pas clusteriser pour cette carte
		Sig.notClusteredTag = new Array("commune", "association", "projectLeader");		
	
		//alert("SIG : " + Sig.toString());
		//return;
		$( "#btn-init-data" ).click(function (){ initDataNetworkMapping(); });

		$( "#input_name_filter" ).keyup(function (){ Sig.checkListElementMap(mapDashOrga); });

		$("#mapCanvas").html("");
		$("#mapCanvas").css({"background-color": "#456074"});

		$("#chk-scope" ).click(function (){ Sig.checkListElementMap(mapDashOrga); });	

		//$( window ).resize(function() { resizeMap(); });
		
		$("#ico_reload").css({"display":"none"});	
		//charge la carte
		mapDashOrga = Sig.loadMap("mapCanvasSV");
		
		mapDashOrga.setView([-21.13318, 55.5314], 9);
		var elementsMap = new Array();

		$( "#btn-zoom-in-dashOrga" )	.click(function (){ mapDashOrga.zoomIn(); });
		$( "#btn-zoom-out-dashOrga" )	.click(function (){ mapDashOrga.zoomOut(); });

		//alert("members : " + JSON.stringify(contextMap.members));
		mapDashOrga.on('dragend', function(e) {
			//Sig.showMapElements(mapDashOrga, contextMap.members.citoyens);
		});
	
		mapDashOrga.on('zoomend', function(e) {
				//showMapElements(mapDashOrga, elementsMap);
		}); 
		
		//récupérer la position du centre de la carte, et la valeur du zoom	
		//pour établir la liste des Places de l'animation (animationPlan)
		mapDashOrga.on('click', function(e) {
				var pos = e.latlng;
				//alert(mapDashOrga.getCenter() + " - " + mapDashOrga.getZoom());
				$("#help-coordinates").html('lat lng : ' + pos.lat + ", " + pos.lng);
		}); 

		//lorsque la carte bouge, on vérifie la liste de droite,
		//pour n'afficher que les éléments qui sont visible sur la carte dans le nouveau bound
		mapDashOrga.on('moveend', function(e) {
			Sig.checkListElementMap(mapDashOrga);
		}); 
		
		//resizeMap();
		Sig.showMapElements(mapDashOrga, contextMap.members.citoyens);//, elementsMap);

		$("#ico_reload").css({"display":"none"});	
				
	});
</script>
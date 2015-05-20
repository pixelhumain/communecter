
<!-- start: PAGE CONTENT -->


<div class="row font_caviar_dreamsregular">
                
                
<div class="col-lg-12 col-md-12">

    <div class="col-lg-12 col-md-12 no-padding panel panel-white">
    
	    <div class="col-lg-8 col-md-12 no-padding addBorder">

	        <div class="no-padding" id="globProchEvent">

	            <div class="panel-heading litle-border-color-red">
	                <h4 class="panel-title text-left">GÉOLOCALISATION</h4>
	            </div>

	            <div id="globZoneGeographique">

	                <h4>Choisissez ici les zones géographiques concernées par votre projet :</h4>

	                <div id="navZoneGeo">

	                    <div class="col-lg-3 col-md-12">
	                        <a href="javascript:;" class="zoneGeoSelected"><i class="fa fa-dot-circle-o"></i> Toutes les zones</a>
	                    </div>

	                    <div class="col-lg-2 col-md-12">
	                        <a href="javascript:;"><i class="fa fa-circle-o"></i> Nord</a>
	                    </div>

	                    <div class="col-lg-2 col-md-12">
	                        <a href="javascript:;"><i class="fa fa-circle-o"></i> Sud</a>
	                    </div>

	                    <div class="col-lg-2 col-md-12">
	                        <a href="javascript:;"><i class="fa fa-circle-o"></i> Est</a>
	                    </div>

	                    <div class="col-lg-2 col-md-12">
	                        <a href="javascript:;"><i class="fa fa-circle-o"></i> Ouest</a>
	                    </div>

	                </div>

	            </div>

	            <div class="item">
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

				
				  
			    <?php 
			    	/* **************** paramètres de la map *******************/
					$sigParams = array(
						"sigKey" => "DashOrga",
						//"mapTileLayer" => 'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png',
						"mapHeight" => 450,
						"mapTop" => 50,
						"useFullScreen" => false,
						"usePanel" => true,
						"useRightList" => true,
						"useZoomButton" => true,
						"useHomeButton" => true,
						"useHelpCoordinates" => false,
						"firstView"			 => array(  "coordinates" => array(-21.13318, 55.5314),
														"zoom"		  => 9),
						);
					/* ******************************************************/
			    	$this->renderPartial('../organization/dashboard/networkMap',array(  "organization" => $organization,
				    																		"sigParams" => $sigParams ));
				    ?>
	            </div>

	            <div class="panel no_radius" id="globNbStructure">

	                <div class="col-sm-8 hidden-xs">
	                    <h4 class="panel-title text-left">LES STRUCTURES : aperçu des <span id="dynaNbrStructure">16</span> trouvées</h4>
	                </div>

	                <div class="col-sm-4 col-xs-12">
	                    <div class="toolbar-tools pull-right">
	                        <a href="javascript:void(0)" class="circleNumberButton circleNumberButtonSelected" >1</a>
	                        <a href="javascript:void(0)" class="circleNumberButton" >2</a>
	                        <a href="javascript:void(0)" class="circleNumberButton" >3</a>
	                    </div>
	                </div>

	            </div>

	            <div class="col-lg-6 col-md-12 addFatPadding">

	                <div class="globAsso">
	                    <h4>AGENDA PARTAGÉ<br/> <small>Tous les événement du réseau</small></h4>
	                </div>

	                <div class="globAsso">
	                    <h4>AGENDA PARTAGÉ<br/> <small>Tous les événement du réseau</small></h4>
	                </div>

	                <div class="globAsso">
	                    <h4>AGENDA PARTAGÉ<br/> <small>Tous les événement du réseau</small></h4>
	                </div>

	            </div>

	            <div class="col-lg-6 col-md-12 addFatPadding">

	                <div class="globAsso">
	                    <h4>AGENDA PARTAGÉ<br/> <small>Tous les événement du réseau</small></h4>
	                </div>

	                <div class="globAsso">
	                    <h4>AGENDA PARTAGÉ<br/> <small>Tous les événement du réseau</small></h4>
	                </div>

	                <div class="globAsso">
	                    <h4>AGENDA PARTAGÉ<br/> <small>Tous les événement du réseau</small></h4>
	                </div>

	            </div>

	        </div>
	    </div>

	    <div class="col-lg-4 col-md-12 no-padding radius-topRight">

	        <ul class="main-navigation-menu_second font_Helvetica radius-topRight" >

	            <li class="open">
	                <a href="javascript:void(0)"> <span class="title font_caviar_dreamsregular"> THÈMES </span><i class="icon-arrow"></i> </a>
	                <ul class="sub-menu tagFilterPanel">
	                    <div id="phraseChooseTheme">Choisissez ici les thèmes qui vous intéressent :</div>
	                    <li>
	                        <a href="javascript:;"><span id="selectedNavItem"><i class="fa fa-dot-circle-o"></i> Tous les thèmes</a></span>
	                    </li>
	                    <li>
	                        <a href="javascript:;"><span class="NavItemNoSelected"><i class="fa fa-circle-o"></i> Agriculture</a></span>
	                    </li>
	                    <li>
	                        <a href="javascript:;"><span class="NavItemNoSelected"><i class="fa fa-circle-o"></i> Alimentaire</a></span>
	                    </li>
	                    <li>
	                        <a href="javascript:;"><span class="NavItemNoSelected"><i class="fa fa-circle-o"></i> Astronomie</a></span>
	                    </li>
	                    <li>
	                        <a href="javascript:;"><span class="NavItemNoSelected"><i class="fa fa-circle-o"></i> Biodiversité</a></span>
	                    </li>
	                </ul>
	            </li>

	            <li class="">
	                <a href="javascript:void(0)"> <span class="title font_caviar_dreamsregular"> PUBLICS </span><i class="icon-arrow"></i> </a>
	                <ul class="sub-menu">
	                    <div id="phraseChooseTheme">Choisissez ici le public qui vous intéressent :</div>
	                    <li>
	                        <a href="javascript:;"><span id="selectedNavItem"><i class="fa fa-dot-circle-o"></i> Tous les thèmes</a></span>
	                    </li>
	                    <li>
	                        <a href="javascript:;"><span class="NavItemNoSelected"><i class="fa fa-circle-o"></i> Agriculture</a></span>
	                    </li>
	                    <li>
	                        <a href="javascript:;"><span class="NavItemNoSelected"><i class="fa fa-circle-o"></i> Alimentaire</a></span>
	                    </li>
	                    <li>
	                        <a href="javascript:;"><span class="NavItemNoSelected"><i class="fa fa-circle-o"></i> Astronomie</a></span>
	                    </li>
	                    <li>
	                        <a href="javascript:;"><span class="NavItemNoSelected"><i class="fa fa-circle-o"></i> Biodiversité</a></span>
	                    </li>
	                </ul>
	            </li>

	            <li class="">
	                <a href="javascript:void(0)"> <span class="title font_caviar_dreamsregular"> TYPE D'INTERVENTION </span><i class="icon-arrow"></i> </a>
	                <ul class="sub-menu">
	                    <div id="phraseChooseTheme">Choisissez ici le type d'intervention qui vous intéressent :</div>
	                    <li>
	                        <a href="javascript:;"><span id="selectedNavItem"><i class="fa fa-dot-circle-o"></i> Tous les thèmes</a></span>
	                    </li>
	                    <li>
	                        <a href="javascript:;"><span class="NavItemNoSelected"><i class="fa fa-circle-o"></i> Agriculture</a></span>
	                    </li>
	                    <li>
	                        <a href="javascript:;"><span class="NavItemNoSelected"><i class="fa fa-circle-o"></i> Alimentaire</a></span>
	                    </li>
	                    <li>
	                        <a href="javascript:;"><span class="NavItemNoSelected"><i class="fa fa-circle-o"></i> Astronomie</a></span>
	                    </li>
	                    <li>
	                        <a href="javascript:;"><span class="NavItemNoSelected"><i class="fa fa-circle-o"></i> Biodiversité</a></span>
	                    </li>
	                </ul>
	            </li>
	            <div class="modal-header font_caviar_dreamsregular">
	                <button class="btn btn-red btn-block text-center">
	                    VOIR TOUTES LES RÉPONSES
	                </button>
	            </div>
	        </ul>
		 </div>
	</div>

</div>
</div>
  

<!-- start: PAGE CONTENT -->


<div class="row">
  	<div class="col-sm-5 col-xs-12">
	    <?php $this->renderPartial('../pod/sliderAgenda', array("events" => $events)); ?>
	</div>
	<div class="col-sm-5 col-xs-12">
	    <?php $this->renderPartial('../pod/randomOrganization',array( "randomOrganization" => (isset($randomOrganization)) ? $randomOrganization : null )); ?>
	</div>
  </div>
</div>

    

<?php 
	if(!$alone){
		Menu::simplyOrganization($organization);
		$this->renderPartial('../default/panels/toolbar'); 
	}
?>

<div class="col-xs-12 infoPanel dataPanel">
		<div class="row">
			<div class="col-sm-12 col-xs-12 col-md-12">
	    		<?php 
	    			$params = array(
	    				"organization" => $organization,
						"tags" => $tags, 
						"images" => $images,
						"plaquette" => $plaquette,
						"organizationTypes" => $organizationTypes,
						"countries" => $countries,
						"typeIntervention" => $typeIntervention,
						"NGOCategories" => $NGOCategories,
						"localBusinessCategories" => $localBusinessCategories,
	    				"contextMap" => $contextMap,
	    				"publics" => $public,
	    				"contentKeyBase" => $contentKeyBase
	    			);
	    			//print_r($params);
	    			$this->renderPartial('../pod/simplyFicheInfo',$params); 
	    		?>
	    	</div>
	    </div>
	 </div>
</div>
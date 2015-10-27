<?php 
Menu::organization($organization);
$this->renderPartial('../default/panels/toolbar'); 
?>
<div class="col-xs-12 infoPanel dataPanel">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
	    		<?php 
	    			$params = array(
	    				"organization" => $organization,
						"tags" => $tags, 
						"images" => $images,
						"plaquette" => $plaquette,
						"organizationTypes" => $organizationTypes,
						"countries" => $countries,
						"typeIntervention" => $typeIntervention,
	    				"publics" => $public,
	    				"contentKeyBase" => $contentKeyBase
	    			);
	    			$this->renderPartial('../pod/ficheInfo',$params); 
	    		?>
	    	</div>
	    </div>
	 </div>
</div>


<!-- end: PAGE CONTENT-->
<script>
	jQuery(document).ready(function() {
		$(".moduleLabel").html("<i class='fa fa-users'></i> ORGANIZATION : <?php echo $organization["name"] ?>  <a href='javascript:showMap()' id='btn-center-city'><i class='fa fa-map-marker'></i></a>");
		if($(".tooltips").length) {
     		$('.tooltips').tooltip();
   		}
	});

</script>
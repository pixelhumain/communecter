<div class="col-xs-12">
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
		if($(".tooltips").length) {
     		$('.tooltips').tooltip();
   		}
	});

</script>
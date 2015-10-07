<?php 
//if( isset($_GET["isNotSV"])) 
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
		if($(".tooltips").length) {
     		$('.tooltips').tooltip();
   		}
	});

</script>
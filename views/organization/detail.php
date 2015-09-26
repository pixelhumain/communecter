<a href="#" onclick="gotToPrevNav()" class="pull-left"><i class="fa fa-arrow-circle-left fa-2x"> </i></a>
<?php /* <div class="pull-left center text-bold text-extra-large box-ajaxTitle" style="width:90%">TIT TIT TITIT ITI TIT IT TI TI </div>  */?>
<div class="pull-right center box-ajaxTools" style="width:90%">
	<?php 
		if(isset($this->toolbarMBZ)){
			foreach ($this->toolbarMBZ as $value) {
				if( stripos( $value, "</li>" ) != "")
					echo $value;
				else
					echo $value;
			}
		} ?>
</div>
<a href="#" onclick="$('.box-ajax').hide()" class="pull-right text-red btn-close-panel"><i class="fa fa-times "> </i></a>
<div class="space20"></div>
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
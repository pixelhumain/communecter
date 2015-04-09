<div class="row">
	<div class="col-sm-8 col-xs-12">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
	    		<?php $this->renderPartial('../pod/ficheInfo',array( "context" => (isset($organization)) ? $organization : null )); ?>
	    	</div>
	    	<div class="col-sm-12 col-xs-12">
	    		<div class="panel panel-white">
					<div class="panel-heading border-light">
						<h4 class="panel-title"> Ressources</h4>
					</div>
					<div class="panel-body no-padding">
						<div class="panel-scroll height-230 ps-container">
							<table class="table table-striped table-hover" id="organizations">
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
	    	</div>
	    </div>
	 </div>
	 <div class="col-sm-4 col-xs-12">
	 	<div class="row">
	 		<div class="col-sm-12 col-xs-12">
	 			<?php $this->renderPartial('../pod/photoVideo',array( "context" => (isset($organization)) ? $organization : null )); ?>
	 		</div>
	 		<div class="col-sm-12 col-xs-12">
	 			<?php $this->renderPartial('../pod/sliderAgenda', array("events" => $events)); ?>
	 		</div>

	 		<div class="col-sm-12 col-xs-12">
	 			
	 		</div>
	 	</div>
	 </div>
</div>

<div class="col-xs-12 infoPanel dataPanel">
		<div class="row">
			<div class="col-sm-12 col-xs-12 col-md-8">
	    		

	    		<div class="col-md-12 col-sm-12 col-xs-12 no-padding pull-left">
					<div class="row padding-15">
						<hr>
						<a href='javascript:loadByHash("#rooms.index.type.organizations.id.<?php //echo (String) $organization["_id"]; ?>")'>
				        	<h1 class="text-azure text-left homestead no-margin">
				        		<i class='fa fa-angle-down'></i> <i class='fa fa-connectdevelop'></i> Espace coopératif <i class='fa fa-sign-in'></i> <span class="text-small helvetica">(activité récente)</span>
				        	</h1>
				        </a>
				    </div>
					<?php 
						$list = ActionRoom::getAllRoomsActivityByTypeId(Person::COLLECTION, Yii::app()->session['userId']);	
						$this->renderPartial('../pod/activityList2',array(    
		   					//"parent" => $organization, 
		                    "parentId" => Yii::app()->session['userId'], 
		                    "parentType" => Person::COLLECTION, 
		                    "title" => "Activité Coop",
                        	"list" => @$list, 
		                    "renderPartial" => true
		                    ));
					?>	
				</div>
	    	</div>

	    	
	    	<div class="col-md-4 no-padding">
		    	<div class="col-md-12 col-xs-12">
					
		    	</div>
			</div>

	    </div>
	 </div>
</div>

<!-- end: PAGE CONTENT-->
<script>
jQuery(document).ready(function() {
	setTitle("Live'n'Direct","<i class='fa fa-heartbeat '></i>");
});
	
</script>
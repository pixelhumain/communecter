<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"> Photos/Videos</h4>
	</div>
	<div class="panel-body border-light">
		<div class="row center">
			<?php $this->renderPartial('../pod/fileupload', array("itemId" => (string)$context["_id"],
																  "type" => Organization::COLLECTION,
																  "contentKey" => Organization::COLLECTION.".dashboard.photoVideo",
																  "contentId" =>"photoVideo",
																  "editMode" => Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], (String) $context["_id"]))); ?>
			 <a href="#">Lien Video</a>
		</div>
		<div class="row">
			<div class="center">
				<div class="flexslider" id="flexslider2">
					<ul class="slides" id="slidesPhoto">
						<li>
							<img src="http://placehold.it/350x180" style="height:250px" class="img-responsive center-block"/>
						</li>
					</ul>
			  	</div>
			 </div>
			 <a href="#">Voir la gallerie Photo</a>
		</div>
	</div>
</div>
<script type="text/javascript">
 	jQuery(document).ready(function() {
		$("#flexslider2").flexslider();
	});
</script>
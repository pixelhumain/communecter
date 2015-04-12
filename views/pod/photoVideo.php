<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"> Photos/Videos</h4>
	</div>
	<div class="panel-body border-light">
		<div class="row">
			<div class="center">
				<img src="http://placehold.it/350x180" style="height:250px" class="img-responsive center-block"/>
			</div>
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
<div class="panel panel-white">
	<div class="panel-heading border-light"></div>
	<div class="panel-tools">
		<div class="dropdown">
			<a class="btn btn-xs dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
				<i class="fa fa-cog"></i>
			</a>
			<ul role="menu" class="dropdown-menu dropdown-light pull-right">
				<li>
					<a href="#" class="panel-collapse collapses"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
				</li>
				<li>
					<a href="#" class="panel-refresh">
						<i class="fa fa-refresh"></i> <span>Refresh</span>
					</a>
				</li>
				<li>
					<a data-toggle="modal" href="#panel-config" class="panel-config">
						<i class="fa fa-wrench"></i> <span>Configurations</span>
					</a>
				</li>
				<li>
					<a href="#" class="panel-expand">
						<i class="fa fa-expand"></i> <span>Fullscreen</span>
					</a>
				</li>
			</ul>
		</div>
		<a href="#" class="btn btn-xs btn-link panel-close">
			<i class="fa fa-times"></i>
		</a>
	</div>
	<div class="panel-body">
		<div class="center">
			<div class="flexslider" id="flexslider2">
				<ul class="slides" id="slides2">
					
				</ul>
			  </div>
			
		</div>

		</hr>

		<div class="row">
			<a href="#galleryPhoto" class="gallery-photo btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Show gallery" alt="Show gallery"><i class="fa fa-camera"></i> Show gallery</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	var person = <?php echo json_encode($person) ?>;
	var id = person["_id"]["$id"];
	 jQuery(document).ready(function() {
		initDashboardPhoto();
		$("#flexslider2").flexslider();
	});
	

	function initDashboardPhoto(){
		$.ajax({
			url: baseUrl+"/"+moduleId+"/api/getUserImages/type/person/id/"+id,
			type: "POST",
			contentType: false,
			cache: false, 
			processData: false,
			success: function(data){
		  		if(data) {
		  			console.log(data);
		  			for(var i=0; i<data.length; i++){
						var htmlSlide = "<li><img src='"+data[i]+"' /></li>";
						$("#slides2").append(htmlSlide);
					}
					$("#flexslider2").flexslider();
				}
		  		else
		  			toastr.error(data.msg);
		  },
		});
		
	}
</script>
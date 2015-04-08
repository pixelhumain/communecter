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
			</hr>

			<div class="social-icons block">
				<ul>
					<li data-placement="top" data-original-title="Twitter" class="social-twitter tooltips">
						<a href="http://<?php if(isset($person["socialNetwork"]["twitterAccount"]) && $person["socialNetwork"]["twitterAccount"]!="")echo $person["socialNetwork"]["twitterAccount"]; else echo "http://www.twitter.com";?>" target="_blank">
							Twitter
						</a>
					</li>
					<li data-placement="top" data-original-title="Facebook" class="social-facebook tooltips">
						<a href="http://<?php if(isset($person["socialNetwork"]["facebookAccount"]) && $person["socialNetwork"]["facebookAccount"]!="")echo $person["socialNetwork"]["facebookAccount"]; else echo "http://www.facebook.com";?>" target="_blank">
							Facebook
						</a>
					</li>
					<li data-placement="top" data-original-title="Google" class="social-google tooltips">
						<a href="http://<?php if(isset($person["socialNetwork"]["gplusAccount"]) && $person["socialNetwork"]["gplusAccount"]!="")echo $person["socialNetwork"]["gplusAccount"]; else echo "http://www.google.com";?>" target="_blank">
							Google+
						</a>
					</li>
					<li data-placement="top" data-original-title="LinkedIn" class="social-linkedin tooltips">
						<a href="http://<?php if(isset($person["socialNetwork"]["linkedInAccount"]) && $person["socialNetwork"]["linkedInAccount"]!="")echo $person["socialNetwork"]["linkedInAccount"]; else echo "http://www.linkedin.com";?>" target="_blank">
							LinkedIn
						</a>
					</li>
					<li data-placement="top" data-original-title="Github" class="social-github tooltips">
						<a href="http://<?php if(isset($person["socialNetwork"]["gitHubAccount"]) && $person["socialNetwork"]["gitHubAccount"]!="")echo $person["socialNetwork"]["gitHubAccount"]; else echo "#";?>" target="_blank">
							Github
						</a>
					</li>
				</ul>
			</div>
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
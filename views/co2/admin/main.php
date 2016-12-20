<h1 class="letter-"><i class="fa fa-grav letter-red"></i> Bonjour <span class="letter-red">Super Admin</span></h1>
<h5 class="letter-">Quelle partie du site souhaitez-vous administrer ?</h5>

<div class="col-md-4">
	<button class="btn btn-default btn-lg font-blackoutM letter-red col-md-12 padding-10 btn-superadmin" data-action="web"><i class="fa fa-search letter-red"></i><br>WEB</button>
</div>
<div class="col-md-4">
	<button class="btn btn-default btn-lg font-blackoutM letter-red col-md-12 padding-10 btn-superadmin" data-action=""><i class="fa fa-newspaper-o letter-red"></i><br>ACTU</button>
</div>
<div class="col-md-4">
	<button class="btn btn-default btn-lg font-blackoutM letter-red col-md-12 padding-10 btn-superadmin" data-action=""><i class="fa fa-comments letter-red"></i><br>FREEDOM</button>
</div>


<script type="text/javascript">

	jQuery(document).ready(function() {
		$(".btn-superadmin").click(function(){
			var action = $(this).data("action");
				getAjax('#central-container' ,baseUrl+'/'+moduleId+"/co2/superadmin/action/"+action,function(){ 
					
			},"html");
		});
	});

</script>
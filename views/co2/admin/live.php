<h1 class="letter-"><i class="fa fa-grav letter-red"></i> Bonjour <span class="letter-red">Super Admin</span></h1>
<h5 class="letter-">
	<button class="btn btn-sm btn-superadmin" data-action="live" data-idres="#central-container"><i class="fa fa-refresh"></i> </button>
	Section : <i class="fa fa-search letter-red"></i> 
	<span class="font-blackoutM letter-red">live</span>
</h5>

<br>
<hr>
<br>

<button class="btn btn-success" id="btn-init-stream"><i class="fa fa-refresh"></i> Actualiser le fil d'actu</button>


<script type="text/javascript">

jQuery(document).ready(function() {
    
    $(".btn-superadmin").off().click(function(){
		var action = $(this).data("action");
		var idres = $(this).data("idres");
		$(idres).html("<i class='fa fa-refresh fa-spin'></i>");
		getAjax(idres ,baseUrl+'/'+moduleId+"/co2/superadmin/action/"+action,function(data){ //alert("yeh");
			$(idres).html(data);
		},"html");
	});

    //btn to load media data for first time (if no media found)
	$("#btn-init-stream").click(function(){
		initStream();
	});

});

function initStream(){
	processingBlockUi();
	//toastr.info("Initialisation du LIVE en cours, merci de patienter quelques secondes.");
	$.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+"/co2/mediacrawler",
        success:
            function(html) {
                toastr.success("Chargement terminé.");
                $.unblockUI();
            },
        error:function(xhr, status, error){
            toastr.error("Une erreur s'est produite pendant le chargement du LIVE");
        },
        statusCode:{
                404: function(){
                	loadingData = false;
                    //toastr.success("404 : Impossible de trouver le script d'initialisation du LIVE");
            }
        }
    });
}
</script>
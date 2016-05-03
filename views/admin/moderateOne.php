<style>
	.buttonBar{
		width:95%;
		text-align: center;
		padding-bottom: 20px;
	}

	.buttonBar button{
		min-width: 250px;
		font-size: 18px;
	}
</style>
<div id="panelOne" class="panel panel-white">
	<div class="toModerateContent"></div>

	<div class="buttonBar">
		<button class="btn btn-success declareAsAuthorizeBtn" data-id="5726de593780ea9d058b4572" data-type="city" data-value="false">Valide
		</button>
		<button class="btn btn-danger declareAsAbuseBtn" data-id="5726de593780ea9d058b4572" data-type="city" data-value="true">C'est un abus
		</button>
	</div>
</div>

<script>
	var newsId = "";
	function loadNewsToModerate(idNews){
		var urlToSend = baseUrl+'/'+moduleId+"/news/detail/id/"+idNews;
		console.log(urlToSend);
		getAjax('.toModerateContent',urlToSend,function(handleResponse){
				
			$("#panelOne").show();
			$(".timeline_element").css("min-width","95%"); 
			$(".timeline_element").css("pointer-events","none");
			$(".timeline_element").css("cursor","default");
			$("div.timeline").css("min-height", 0);
			$(".dropdown").hide();
			$(".newsAddComment").hide();

		},"html");
	}

	function setNextNewsId(){
		console.log("setNextNewsId");
        var urlToSend = baseUrl+"/"+moduleId+"/news/moderate/";
        
        var params = {};
        params.subAction = "getNextIdToModerate";
		$.ajax({
	        type: "POST",
	        url: urlToSend,
	        data:params,
	        dataType : "json",
	        success:function (data){
		       console.log(data);
		       if(data.result == true){
		       		newsId = data.newsId;
		       		loadNewsToModerate(newsId);
		       		$(".declareAsAbuseBtn, .declareAsAuthorizeBtn").data('id',newsId);
		       }
		       else{
		       		$('#panelOne').html("<center><h3>Aucune news à modérer</h3></center>");
		       		$('#panelOne').show();
		       }
		    }
	    });
	}

	jQuery(document).ready(function() {
		$("#panelOne").hide();
		
		//We load the moderation
		setNextNewsId();

		$(".declareAsAbuseBtn, .declareAsAuthorizeBtn").off().on("click",function () 
		{
			console.log("declareAsAbuseBtn / declareAsAuthorizeBtn click");
			console.log("isAnAbuse",$(this).data("value"));
	        var btnClick = $(this);
	        var id = $(this).data("id");
	        var urlToSend = baseUrl+"/"+moduleId+"/news/moderate/";
	        
	        var params = {};
	        params.subAction = "saveModerate";
	        params.id = id;
	        params.isAnAbuse = $(this).data("value");
	       
			$.ajax({
		        type: "POST",
		        url: urlToSend,
		        data:params,
		        dataType : "json",
		        success:function (data){
			        if( data && data.result ) {
			        	toastr.info(data.msg);
			        	setNextNewsId();
			        } else {
			           toastr.info("Erreur");
			        }
			    }
		    });
		});

	});

</script>
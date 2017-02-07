<?php 

	HtmlHelper::registerCssAndScriptsFiles( array(	'/css/timeline2.css',
													'/js/comments.js',
											) , Yii::app()->theme->baseUrl. '/assets');

	    
	$cssAnsScriptFilesModule = array(
		'/js/news/autosize.js',
		'/js/news/newsHtml.js',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath , 
                                "page" => "media") ); 
?>


<div class="col-md-12 col-sm-12 col-xs-12 bg-white no-padding">

	<!-- <div class="col-md-12 col-sm-12 col-xs-12 no-padding row-radio" style="background-color: #f8f8f8;">
		<?php //$this->renderPartial($layoutPath.'radioplayer', array( "layoutPath"=>$layoutPath ) ); ?>  
	</div> -->

	<div class="col-md-12 col-sm-12 inline page-header text-center margin-top-20">
	    <h3 id="timeline"><i class="fa fa-newspaper-o"></i><br>L'Actu locale en direct<br><i class="fa fa-angle-down"></i></h3>
	    <?php //if(!@$medias || sizeOf($medias) <= 0){ ?>
	    	<!-- <div class="initStream">
		    	<button class="btn btn-success" id="btn-init-stream">Actualiser le fil d'actu</button></br>
		    	<span>lancer le processus d'import de données</span>
	    	</div> -->
	    <?php //} ?>
	</div>

	<div class="col-md-2 col-sm-1 hidden-xs no-padding">
	</div>


	<div class="col-md-8 col-sm-10 no-padding">
	
	<ul class="timeline inline-block" id="timeline-live">
		<?php  
			if(@$medias && sizeOf($medias) > 0)
			$this->renderPartial('liveStream', array("medias"=>$medias)); 
		?>
	</ul>
	</div>


</div>



<?php $this->renderPartial($layoutPath.'footer', array("subdomain"=>"media")); ?>

<script type="text/javascript" >
var loadingData = false;
var scrollEnd = false;

var currentIndexMin = 0;
var currentIndexMax = 10;

var indexStep = currentIndexMax;

//var medias = <?php //echo json_encode($medias); ?>;

var idSession = "<?php echo Yii::app()->session["userId"] ?>";

//permet d'ajouter des commentaires sur n'importe quel data (collection)
var parentTypeComment = "media";

jQuery(document).ready(function() {
    initKInterface();

    //init loading in scroll
    $(window).off().bind("scroll",function(){ 
	    if(!loadingData && !scrollEnd){
	          var heightWindow = $("html").height() - $("body").height();
	          if( $(this).scrollTop() >= heightWindow - 400){
	            loadStream(currentIndexMin+indexStep, currentIndexMax+indexStep);
	          }
	    }
	});

    //btn to load media data for first time (if no media found)
	$("#btn-init-stream").click(function(){
		initStream();
	});

	//initCommentsTools(medias);

});


function loadStream(indexMin, indexMax){ console.log("load stream media");
	loadingData = true;
	currentIndexMin = indexMin;
	currentIndexMax = indexMax;

	$.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+"/co2/media",
        data: { indexMin: indexMin, 
        		indexMax:indexMax, 
        		renderPartial:true 
        	},
        success:
            function(html) {
                $("#timeline-live").append(html);
                loadingData = false;
            },
        error:function(xhr, status, error){
            loadingData = false;
            $("#timeline-live").html("erreur");
        },
        statusCode:{
                404: function(){
                	loadingData = false;
                    $("#timeline-live").html("not found");
            }
        }
    });
}


//lance le chargement des commentaires pour une publication
function showMediaComments(id){
		if(!$("#commentContent"+id).hasClass("hidden")){
			$(".commentContent").html("");
			$(".commentContent").removeClass("hidden");		
			
			$('#commentContent'+id).html('<div class="text-dark margin-bottom-10"><i class="fa fa-spin fa-refresh"></i> Chargement des commentaires ...</div>');
			getAjax('#commentContent'+id ,baseUrl+'/'+moduleId+"/comment/index/type/media/id/"+id,function(){ 
				
			},"html");
		}else{
			$("#commentContent"+id).removeClass("hidden");		
			mylog.log("scroll TO : ", $('#newsFeed'+id).position().top);
			
		}
}

/* COMMENTS vvv */



/* COMMENTS ^^^ */
</script>
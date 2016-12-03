<?php 

	HtmlHelper::registerCssAndScriptsFiles( array('/vendor/jPlayer-2.9.2/dist/skin/blue.monday/css/jplayer.blue.monday.min.css',
												  '/vendor/jPlayer-2.9.2/dist/jplayer/jquery.jplayer.min.js',
                								  '/css/timeline2.css',
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
                                "subdomain"=>$subdomain,
                                "mainTitle"=>$mainTitle,
                                "placeholderMainSearch"=>$placeholderMainSearch) ); 
?>

<style>
	.timeline-body > p, .timeline-body > ul{
		padding:0px;
		font-size:14px;
	}	
	.carousel-inner > .item > a > img, .carousel-inner > .item > img, .img-responsive, .thumbnail a > img, .thumbnail > img{
		display:inline;
	}
	.timeline-footer{
		min-height:40px;
	}

	.timeline-heading h5{
		padding: 10px 10px !important;
	}

	/*.timeline-footer a{
		color:#4285f4;
	}*/
	/*.timeline-footer a.newsVoteUp .text-dark{
		color:#34a853 !important;
	}
	.timeline-footer a.newsVoteDown .text-dark{
		color:#FFA200 !important;
	}
	.timeline-footer a.newsReportAbuse .text-dark{
		color:#ea4335 !important;
	}*/


	.srcMedia{
		text-align:right;
	}
	.timeline-inverted .srcMedia{
		text-align:left;
	}

	.link-read-media{
		float: left;
	}
	.timeline-inverted .link-read-media{
		float: right;
	}
	.srcMedia small.ilyaL{
		display: inline;
	}
	.srcMedia small.ilyaR{
		display: none;
	}
	.timeline-inverted .srcMedia small.ilyaL{
		display: none;
	}
	.timeline-inverted .srcMedia small.ilyaR{
		display: inline;
	}

	.ctnr-txtarea{
		left:40px!important;
	}
	.newsAddComment{
		margin-right:15px;
		font-weight:700;
	}

	#reasonComment{
		margin-top:15px;
	}
</style>

<div class="col-md-12 col-sm-12 col-xs-12 bg-white no-padding">

	<div class="col-md-12 col-sm-12 col-xs-12 no-padding row-radio" style="background-color: #f8f8f8;">
		<?php $this->renderPartial($layoutPath.'radioplayer', array( "layoutPath"=>$layoutPath ) ); ?>  
	</div>

	<div class="col-md-12 col-sm-12 page-header text-center margin-top-50">
	    <h3 id="timeline"><i class="fa fa-newspaper-o"></i><br>L'Actu locale en direct<br><i class="fa fa-angle-down"></i></h3>
	    <?php if(!@$medias || sizeOf($medias) <= 0){ ?>
	    	<div class="initStream">
		    	<button class="btn btn-success" id="btn-init-stream">Initialiser le fil d'actu</button></br>
		    	<span>lancer le processus d'import de données</span>
	    	</div>
	    <?php } ?>
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



<?php $this->renderPartial($layoutPath.'footer'); ?>

<script>
var loadingData = false;
var scrollEnd = false;

var currentIndexMin = 0;
var currentIndexMax = 10;

var indexStep = currentIndexMax;

var medias = <?php echo json_encode($medias); ?>;

var idSession = "<?php echo Yii::app()->session["userId"] ?>";

//permet d'ajouter des commentaires sur n'importe quel data (collection)
var parentTypeComment = "media";

jQuery(document).ready(function() {
    initKInterface();

    //init loading in scroll
    $(window).bind("scroll",function(){ 
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

	initCommentsTools();

});

function initCommentsTools(){
	//ajoute la barre de commentaire & vote up down signalement sur tous les medias
	$.each(medias, function(key, media){
		media.target = "media";
		
		var commentCount = 0;
		idMedia=media._id['$id'];
		if ("undefined" != typeof media.commentCount) 
			commentCount = media.commentCount;
		
		idSession = typeof idSession != "undefined" ? idSession : false;

		var lblCommentCount = '';
		if(commentCount == 0 && idSession) lblCommentCount = "<i class='fa fa-comment'></i>  Commenter";
		if(commentCount == 1) lblCommentCount = "<i class='fa fa-comment'></i> <span class='nbNewsComment'>" + commentCount + "</span> commentaire";
		if(commentCount > 1) lblCommentCount = "<i class='fa fa-comment'></i> <span class='nbNewsComment'>" + commentCount + "</span> commentaires";
		if(commentCount == 0 && !idSession) lblCommentCount = "0 <i class='fa fa-comment'></i> ";

		lblCommentCount = '<a href="javascript:" class="newsAddComment letter-blue" data-media-id="'+idMedia+'">' + lblCommentCount + '</a>';

		var voteTools = voteCheckAction(media._id['$id'], media);

		voteTools = lblCommentCount + voteTools;

		$("#footer-media-"+media._id['$id']).html(voteTools);
	});

	$(".newsAddComment").click(function(){
		var id = $(this).data("media-id");
		showMediaComments(id);
	});
}

function loadStream(indexMin, indexMax){
	loadingData = true;
	currentIndexMin = indexMin;
	currentIndexMax = indexMax;

	$.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+"/k/live",
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

function initStream(){
	processingBlockUi();
	toastr.info("Initialisation du LIVE en cours, merci de patienter quelques secondes.");
	$.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+"/k/mediacrawler",
        success:
            function(html) {
                toastr.success("Initialisation terminée.");
                toastr.success("Chargement du LIVE");
                $("#initStream").hide();
                KScrollTo("#timeline-live");
                loadStream(0, indexStep);
                $.unblockUI();
            },
        error:function(xhr, status, error){
            toastr.error("Une erreur s'est produite pendant l'initialisation du LIVE");
        },
        statusCode:{
                404: function(){
                	loadingData = false;
                    toastr.success("404 : Impossible de trouver le script d'initialisation du LIVE");
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
<?php 

    $timezone = 'Pacific/Noumea';
		$pair = false;
		foreach($medias as $key => $media){ 
			$class = $pair ? "timeline-inverted" : "";
			$pair = !$pair;

   
	?>

      <li class="<?php echo $class; ?>">
        <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record" rel="tooltip"></i></a></div>
        <div class="timeline-panel">
          <div class="timeline-heading text-center">
            
               	<h5 class="text-left srcMedia">
              		<small class="ilyaL"><i class="fa fa-clock-o"></i> <?php echo Translate::pastTime($media["date"], "date", $timezone); ?></small>
                  <img src="<?php echo Yii::app()->theme->baseUrl."/assets/img/medias/".$media["srcMedia"]; ?>.png" height=40>
              	  <small class="ilyaR"><i class="fa fa-clock-o"></i> <?php echo Translate::pastTime($media["date"], "date", $timezone); ?></small>
                  <a href="<?php echo $media["href"]; ?>" target="_blank" class="link-read-media margin-top-10 hidden-xs"><i class="fa fa-angle-right"></i> Lire</a>
                </h5>
              

              
          	  <?php if(@$media["img"]){ ?>
              	<a class="block bg-black" target="_blank" href="<?php echo $media["href"]; ?>">
          			<img class="img-responsive" src="<?php echo $media["img"]; ?>" />
              	</a>
              <?php } ?>

              <?php if(@$media["contentType"] == "youtube"){ ?>
              	<iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $media["idYoutube"]; ?>" frameborder="0" allowfullscreen></iframe>
              <?php } ?>


            
          </div>
          <div class="timeline-body padding-10">
            <h4><a target="_blank" href="<?php echo $media["href"]; ?>"><?php echo $media["title"]; ?></a></h4>
            <p><?php echo $media["content"]; ?></p>
            
          </div>
          
          <div class="timeline-footer pull-left col-md-12 padding-top-5">
              <!-- <a class="btn-comment-media" data-media-id="<?php echo $media["_id"]; ?>"><i class="fa fa-comment"></i> Commenter</a> -->
              <!-- <a><i class="glyphicon glyphicon-thumbs-up"></i></a>
              <a><i class="glyphicon glyphicon-share"></i></a> -->
              <div class="col-md-12 pull-left padding-5" id="footer-media-<?php echo $media["_id"]; ?>"></div>
              <div class="col-md-12 no-padding pull-left margin-top-10" id="commentContent<?php echo $media["_id"]; ?>"></div>
          </div>
        </div>
      </li>

<?php } ?>

<script type="text/javascript" >
var medias = <?php echo json_encode($medias); ?>;

jQuery(document).ready(function() {
  initCommentsTools(medias);
});


function initCommentsTools(thisMedias){
  //ajoute la barre de commentaire & vote up down signalement sur tous les medias
  $.each(thisMedias, function(key, media){
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



</script>
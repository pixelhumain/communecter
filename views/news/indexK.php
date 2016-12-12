<?php 
    
    $cssAnsScriptFilesModule = array(
      '/js/news/autosize.js',
      '/js/news/newsHtml.js',
    );
    HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

    $timezone = 'Pacific/Noumea';
		$pair = false;

    $imgDefault = $this->module->assetsUrl.'/images/news/profile_default_l.png';

   // var_dump($news);exit;
		foreach($news as $key => $media){ 
			$class = $pair ? "timeline-inverted" : "";
			$pair = !$pair;

      $thumbAuthor =  @$media['author']['profilThumbImageUrl'] ? 
                      Yii::app()->createUrl('/'.@$media['author']['profilThumbImageUrl']) 
                      : $imgDefault;

      $srcMainImg = "";              
      if(@$media["media"]["images"])
        $srcMainImg = Yii::app()->createUrl("upload/".
                                            Yii::app()->controller->module->id."/".
                                            $media["media"]["images"][0]["folder"].'/'.
                                            $media["media"]["images"][0]["name"]);


      if(@$media["imageBackground"])
        $srcMainImg = Yii::app()->createUrl($media["imageBackground"]);
	?>

<style>
  .timeline-heading h5{
    height: 55px;
  }
</style>
  
      <li class="<?php echo $class; ?>">
        <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record" rel="tooltip"></i></a></div>
        <div class="timeline-panel">
          <div class="timeline-heading text-center">
            

               	<h5 class="text-left srcMedia">
              		<small class="ilyaL">
  
                    <img class="pull-right img-circle" src="<?php echo @$thumbAuthor; ?>" height=40>
                    <div class="pull-right padding-5">
                      <a href=""><?php echo @$media["author"]["name"]; ?></a><br>
                      <span class="margin-top-5">
                      <?php if($media["type"]=="news") { ?>
                        <i class="fa fa-pencil-square"></i> a publié un message
                      <?php } ?>
                      <?php if($media["type"]=="activityStream") { ?>
                        <?php $iconColor = Element::getColorIcon($media["object"]["objectType"]) ? 
                                           Element::getColorIcon($media["object"]["objectType"]) : ""; ?>
                        <i class="fa fa-plus-circle"></i> a créé un 
                        <span class="text-<?php echo @$iconColor; ?>">
                          <?php echo Yii::t("common", @$media["object"]["objectType"]); ?>
                        </span>
                      <?php } ?>
                      </span>
                    </div>

                  </small>

              	  <small class="ilyaR">
  
                    <img class="pull-left img-circle" src="<?php echo @$thumbAuthor; ?>" height=40>
                    <div class="pull-left padding-5">
                      <a href=""><?php echo @$media["author"]["name"]; ?></a><br>
                      <span class="margin-top-5">
                      <?php if($media["type"]=="news") { ?>
                        <i class="fa fa-pencil-square"></i> a publié un message
                      <?php } ?>
                      <?php if($media["type"]=="activityStream") { ?>
                        <?php $iconColor = Element::getColorIcon($media["object"]["objectType"]) ? 
                                           Element::getColorIcon($media["object"]["objectType"]) : ""; ?>
                        <i class="fa fa-plus-circle"></i> a créé un 
                        <span class="text-<?php echo @$iconColor; ?>">
                          <?php echo Yii::t("common", @$media["object"]["objectType"]); ?>
                        </span>
                      <?php } ?>
                      </span>
                    </div>
                    
                  </small>

                  <a href="<?php echo @$media["href"]; ?>" target="_blank" class="link-read-media margin-top-10 hidden-xs img-circle">
                    <small>
                      <i class="fa fa-clock-o"></i> 
                      <?php echo Translate::pastTime(date($media["date"]->sec), "timestamp", $timezone); ?>
                    </small>
                  </a>
                </h5>
              
              <div class="timeline-body padding-10 col-md-12 text-left">
                <!-- <h4><a target="_blank" href="<?php echo @$media["href"]; ?>"><?php echo @$media["title"]; ?></a></h4> -->
                <?php if($media["type"]=="activityStream") { ?>
                  <?php $faIcon = Element::getFaIcon($media["object"]["objectType"]) ? 
                                  Element::getFaIcon($media["object"]["objectType"]) : ""; ?>
                  <h4 class="no-padding">
                    <a target="_blank" 
                       href="#k.page.type.<?php echo @$media["object"]["objectType"]; ?>.id.<?php echo @$media["object"]["id"]; ?>">
                       <i class="fa fa-<?php echo $faIcon; ?>"></i> <?php echo @$media["name"]; ?>
                    </a>
                  </h4>
                  <?php if(@$media["startDate"]) { ?>
                    <?php echo date($media["startDate"]->sec); ?>
                  <?php } ?>
                <?php } ?>
                <p><?php echo $media["text"]; ?></p>
                
              </div>

              <?php if(@$srcMainImg != ""){ ?>
                <a class="inline-block bg-black" target="_blank" href="<?php echo @$media["href"]; ?>">
                <img class="img-responsive" src="<?php echo $srcMainImg; ?>" />
                </a>
              <?php } ?>


              <?php if(@$media["contentType"] == "youtube"){ ?>
              	<iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $media["idYoutube"]; ?>" frameborder="0" allowfullscreen></iframe>
              <?php } ?>


            
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

<script>
var news = <?php echo json_encode($news); ?>;
console.log("NEWS", news);
jQuery(document).ready(function() {
  initCommentsTools(news);
});


function initCommentsTools(thisMedias){
  //ajoute la barre de commentaire & vote up down signalement sur tous les medias
  $.each(thisMedias, function(key, media){
    media.target = "news";
    
    var commentCount = 0;
    idMedia=media._id['$id']; console.log("idMedia",idMedia);
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


//lance le chargement des commentaires pour une publication
function showMediaComments(id){
    if(!$("#commentContent"+id).hasClass("hidden")){
      $(".commentContent").html("");
      $(".commentContent").removeClass("hidden");   
      
      $('#commentContent'+id).html('<div class="text-dark margin-bottom-10"><i class="fa fa-spin fa-refresh"></i> Chargement des commentaires ...</div>');
      getAjax('#commentContent'+id ,baseUrl+'/'+moduleId+"/comment/index/type/news/id/"+id,function(){ 
        
      },"html");
    }else{
      $("#commentContent"+id).removeClass("hidden");    
      mylog.log("scroll TO : ", $('#newsFeed'+id).position().top);
      
    }
}

/* COMMENTS vvv */
</script>
<?php 
$cssAnsScriptFilesModule = array(
	'/js/news/autosize.js',
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

function multiple10($nb, $total){ //error_log("multiple1000 : " . $nb. "  - ".$total);
	for($i=0;$i<$total;$i+=10){ 
		if($i==$nb) error_log( "multiple10 : " . $i);
		if($i==$nb) return true;
	}
	return false;
}

?>	

<style>
	.textarea-new-comment{
		max-width: 100%;
		min-width: 100%;
		vertical-align: top;
		font-size:13px;
	}
	.textarea-new-comment:focus {
		outline-style: solid;
		outline-width: 1px;
		outline-color: grey;
	}
	.footer-comments{
		margin-right: -10px;
		margin-left: -10px;
		margin-top: -5px;
		padding: 10px;
		background-color: rgba(231, 231, 231, 0.62);
	}
	.content-comment{
		max-width:85%;
	}
	.answerCommentContainer {
	    margin-left: 45px;
	    margin-top: 5px;
	}

	
	.ctnr-txtarea{
		position: absolute;right:10px; left:50px;
	}

	.answerCommentContainer .ctnr-txtarea{
		left:40px;
	}


</style>

<div class="footer-comments row">

	<?php //image profil user connected + input new comment
		$profilThumbImageUrlUser = ""; 

		if(isset(Yii::app()->session["userId"])){
		$me = Person::getMinimalUserById(Yii::app()->session["userId"]);
		$profilThumbImageUrlUser = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl); 
	?>
		<img src="<?php echo $profilThumbImageUrlUser; ?>" class="img-responsive pull-left" 
			 style="margin-right:6px;height:32px; border-radius:3px;">

		<div id="container-txtarea-<?php echo $idComment; ?>">
		<div style="" class="ctnr-txtarea">
			<textarea rows="1" style="height:1em;" class="form-control textarea-new-comment" 
					  id="textarea-new-comment<?php echo $idComment; ?>" placeholder="Votre commentaire..."></textarea>
		</div>
		</div>
	<?php } ?>

	<div id="comments-list-<?php echo $idComment; ?>">


		<?php 
			$assetsUrl = $this->module->assetsUrl;
			function showCommentTree($comments, $assetsUrl, $idComment, $canComment, $level){
				$count = 0;
				$hidden = 0;
				$hiddenClass = "";
				$nbTotalComments = sizeOf($comments);

				if($nbTotalComments == 0 && $level == 1) { echo "Aucun commentaire"; }
				if($nbTotalComments == 0) return;
				//if($nbTotalComments == 0 && $level == 2) echo "Aucune commentaire";

		 		
				foreach ($comments as $key => $comment) { 
			 		$count++; 
					$profilThumbImageUrl = Element::getImgProfil($comment["author"], "profilThumbImageUrl", $assetsUrl); 
					if($hidden > 0) $hiddenClass = "hidden hidden-".$hidden;
		?>
					<div class="col-md-12 col-sm-12 col-xs-12 no-padding margin-top-5 item-comment <?php echo $hiddenClass; ?>">

						<img src="<?php echo $profilThumbImageUrl; ?>" class="img-responsive pull-left" 
							 style="margin-right:10px;height:32px; border-radius:3px;">
					
						<span class="pull-left content-comment">						
							<span class="text-black">
								<span class="text-dark"><strong><?php echo $comment["author"]["name"]; ?></strong></span> 
								<span class="text-comment"><?php echo $comment["text"]; ?></span>
							</span><br>
							<span>
							<?php if(isset(Yii::app()->session["userId"])){ ?>
								<a class="" href="javascript:likeComment('<?php  echo $comment["_id"]; ?>')">J'aime</a> 
								<?php if(@$canComment){ ?>
									<a class="" href="javascript:answerComment('<?php echo $idComment; ?>', '<?php echo $comment["_id"]; ?>')">Répondre</a> 
								<?php } ?>
								<?php if(@$comment["author"]["id"] == Yii::app()->session["userId"]){ ?>
									<a class="" href="javascript:deleteComment('<?php echo $comment["_id"]; ?>')">Supprimer</a> 
									<a class="" href="javascript:modifyComment('<?php echo $comment["_id"]; ?>')">Modifier</a>
								<?php } ?>
							<?php } ?>
							</span>
						</span>
						<div id="comments-list-<?php echo $comment["_id"]; ?>" class="pull-left col-md-<?php echo 11-$level; ?> no-padding answerCommentContainer">
							<?php if(sizeOf($comment["replies"]) > 0) //recursive for answer (replies)
									showCommentTree($comment["replies"], $assetsUrl, $comment["_id"], $canComment, $level++);  ?>
						</div>
					</div>
		<?php 		if(multiple10($count, $nbTotalComments)){ $hidden = $count; ?>
		<?php			$hiddenClass = ($hidden > 10) ? "hidden hidden-".($hidden-10) : ""; ?>
						<div class="pull-left margin-top-5 <?php echo $hiddenClass; ?> link-show-more-<?php echo ($hidden-10); ?>">
							<a class="" href="javascript:" onclick="showMoreComments('<?php echo $idComment; ?>', <?php echo $hidden; ?>);">
								<i class="fa fa-angle-down"></i> Voir plus de commentaires
							</a>
						</div>
		<?php 		} //if (multiple10 ?>

		

		<?php 	} //$.each ?>
		<?php 	if($hidden > 0){ ?>
					<div class="pull-right margin-top-5">
						<a class="" href="javascript:" onclick="hideComments('<?php echo $idComment; ?>');">
							<i class="fa fa-angle-up"></i> Masquer
						</a>
					</div>
		<?php 	} ?>
		<?php	}//function()
		?>


		<?php showCommentTree($comments, $assetsUrl, $idComment, $canComment, 1); ?>
					
		
	</div><!-- id="comments-list-<?php echo $idComment; ?>" -->

</div><!-- class="footer-comments" -->


<script>
	var contextType = "<?php echo $contextType; ?>";
	var idComment = "<?php echo $idComment; ?>";
	var comments = <?php echo json_encode($comments); ?>;
	
	var context = <?php echo json_encode($context)?>;

	console.log("context");
	console.dir(context);
	console.log("comments");
	console.dir(comments);
	jQuery(document).ready(function() {

		var idTextArea = '#textarea-new-comment<?php echo $idComment; ?>';
		bindEventTextArea(idTextArea, idComment, false, "");

		console.log(".comments-list-<?php echo $idComment; ?> .text-comment");
		$("#comments-list-<?php echo $idComment; ?> .text-comment").each(function(){
			linked = linkify($(this).html());
			$(this).html(linked);
		});
	});

	function bindEventTextArea(idTextArea, idComment, isAnswer, parentCommentId){

		var idUx = (parentCommentId == "") ? idComment : parentCommentId;
		
		$(idTextArea).css('height', "34px");
		$("#container-txtarea-"+idUx).css('height', "34px");
		autosize($(idTextArea));

		$(idTextArea).on('keyup ', function(e){
			if(e.which == 13 && $(idTextArea).val() != "" && $(idTextArea).val() != " ") {
	            //submit form via ajax, this is not JS but server side scripting so not showing here
	            saveComment($(idTextArea).val(), parentCommentId);
	            $(idTextArea).val("");
	            $(idTextArea).css('height', "34px");
        	}
        	var heightTxtArea = $(idTextArea).css("height");
        	$("#container-txtarea-"+idUx).css('height', heightTxtArea);
		});

		$(idTextArea).bind ("input propertychange", function(e){
			var heightTxtArea = $(idTextArea).css("height");
        	$("#container-txtarea-"+idUx).css('height', heightTxtArea);
		});
	}

	function showOneComment(textComment, idComment, isAnswer, idNewComment){
		textComment = linkify(textComment);
		var html = '<div class="col-md-12 col-sm-12 col-xs-12 no-padding margin-top-5 item-comment">'+

						'<img src="<?php echo @$profilThumbImageUrlUser; ?>" class="img-responsive pull-left" '+
						'	 style="margin-right:10px;height:32px; border-radius:3px;">'+
					
						'<span class="pull-left content-comment">'+						
						'	<span class="text-black">'+
						'		<span class="text-dark"><strong><?php echo @$me["name"]; ?></strong></span> '+
						'		<span class="text-comment">'	+ textComment + "</span>" +
						'	</span><br>'+
							'<span class="">' + 
								<?php if(isset(Yii::app()->session["userId"])){ ?>
							'		<a class="" href=\'javascript:likeComment(\"'+idNewComment+'\")\'>J\'aime</a> '+
									<?php if(@$canComment){ ?>
							'			<a class="" href=\'javascript:answerComment(\"<?php echo $idComment; ?>\", \"'+idNewComment+'\")\'>Répondre</a> '+
									<?php } ?>
							'			<a class="" href=\'javascript:deleteComment(\"'+idNewComment+'\")\'>Supprimer</a> '+
							'			<a class="" href=\'javascript:modifyComment(\"'+idNewComment+'\")\'>Modifier</a>'+
								<?php } ?>
							'</span>'+
						'</span>'+	
						'<div id="comments-list-'+idNewComment+'" class="pull-left col-md-9 no-padding answerCommentContainer"></div>' +
							
					'</div>';

		if(!isAnswer){
			$("#comments-list-<?php echo $idComment; ?>").prepend(html);
		}else{
			$('#container-txtarea-'+idComment).after(html);
		}
	}

	function showMoreComments(id, hiddenCount){ console.log("showMoreComments", id, hiddenCount);
		$(".hidden-"+hiddenCount).removeClass("hidden");
		$(".link-show-more-" + (hiddenCount-10)).addClass("hidden");
	}
	function hideComments(id){ console.log("#comments-list-"+id + " .item-comment")
		//$("#comments-list-"+id + " .item-comment").addClass("hidden");
		$("#commentContent"+id).html("");
	}

	function saveComment(textComment, parentCommentId){
		textComment = $.trim(textComment);
		if(!notEmpty(parentCommentId)) parentCommentId = "";
		$.ajax({
			url: baseUrl+'/'+moduleId+"/comment/save/",
			data: {
				parentCommentId: parentCommentId,
				content : textComment,
				contextId : context["_id"]["$id"],
				contextType : contextType
			},
			type: 'post',
			global: false,
			dataType: 'json',
			success: 
				function(data) {
					if(!data.result){
						toastr.error(data.msg);
					}
					else { 
						toastr.success(data.msg);
						console.log(data);
						$('.nbComments').html((parseInt($('.nbComments').html()) || 0) + 1);
						if (data.newComment.contextType=="news"){
							$(".newsAddComment[data-id='"+data.newComment.contextId+"']").children().children(".nbNewsComment").text(parseInt($('.nbComments').html()) || 0);
						}
						//switchComment(commentId, data.newComment, parentCommentId);
						latestComments = data.time;

						var isAnswer = parentCommentId!="";
						showOneComment(textComment, parentCommentId, isAnswer, data.id.$id);
	            
					}
				},
			error: 
				function(data) {
					toastr.error('<?php echo Yii::t("comment","Error calling the serveur : contact your administrator.") ?>');
				}
		});
		
	}

	function likeComment(idComment){
		
	}
	function answerComment(idComment, parentCommentId){ console.log("answerComment");
		//si l'input existe déjà on sort
		if($('#container-txtarea-'+parentCommentId).length > 0) return;

		var html = '<div id="container-txtarea-'+parentCommentId+'" class="">' +

						'<img src="<?php echo @$profilThumbImageUrlUser; ?>" class="img-responsive pull-left" '+
						'	 style="margin-right:10px;height:32px; border-radius:3px;">'+
					
						'<div class="ctnr-txtarea">' +
							'<textarea rows="1" style="height:1em;" class="form-control textarea-new-comment" ' +
									    'id="textarea-new-comment'+parentCommentId+'" placeholder="Votre réponse..."></textarea>' +
						'</div>' +
					'</div>';

		$("#comments-list-"+parentCommentId).prepend(html);

		bindEventTextArea('#textarea-new-comment'+parentCommentId, idComment, true, parentCommentId);

		//$('#comments-list-'+idComment).html('<div class="text-dark margin-bottom-10"><i class="fa fa-spin fa-refresh"></i> Chargement des commentaires ...</div>');
		//getAjax('#comments-list-'+idComment ,baseUrl+'/'+moduleId+"/comment/index/type/news/id/"+idComment,function(){ 
		//},"html");
	}
	function validateAnswerComment(idComment){
		
	}
	function deleteComment(idComment){
		
	}
	function modifyComment(idComment){
		
	}

	function linkify(inputText) {
	    var replacedText, replacePattern1, replacePattern2, replacePattern3;

	    //URLs starting with http://, https://, or ftp://
	    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
	    replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank" class="text-azure">$1</a>');

	    //URLs starting with "www." (without // before it, or it'd re-link the ones done above).
	    replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
	    replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank" class="text-azure">$2</a>');

	    //Change email addresses to mailto:: links.
	    //replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
	    //replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

	    return replacedText;
	}

</script>
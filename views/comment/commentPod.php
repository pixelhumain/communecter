<?php

$cssAnsScriptFiles = array(
	"/assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js",
	'/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
	'/assets/plugins/jquery-shorten/jquery.shorten.1.0.js',
	'/assets/plugins/moment/min/moment.min.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles);

?>	

<style>
.tree .comment .avatar {
    clear: left;
    float: left;
    margin: 0 10px 5px 0;
}

.commenter-location, .comment-time {
    font-size: 0.95rem;
    font-weight: 300;
    line-height: 0.8125rem;
}

</style>
<!-- start: PAGE CONTENT -->
<div id="commentHistory">
	<!-- start: TIMELINE PANEL -->
	<div class="panel panel-white">
		<div class="panel-heading border-light">
			<h4 class="panel-title"><i class="fa fa-comments fa-2x text-blue"></i><?php echo ' '.$nbComment; ?> Comments</h4>
			<div class="controls">
				<button class="btn commentOption <?php echo Comment::COMMENT_ON_TREE ?>"><?php echo $options[Comment::COMMENT_ON_TREE] ? 'Can Reply' : 'No Reply' ?></button>
				<button class="btn commentOption <?php echo Comment::COMMENT_ANONYMOUS ?>"><?php echo $options[Comment::COMMENT_ANONYMOUS] ? 'Anonymous' : 'Nominatly' ?></button>
				<button class="btn commentOption <?php echo Comment::ONE_COMMENT_ONLY ?>"><?php echo $options[Comment::ONE_COMMENT_ONLY] ? 'Only one comment' : 'No limit comment' ?></button>
			</div>
		</div>
		<div class="panel-body panel-white">
			<div class='row'>
				<div class='saySomething padding-5'>
					<input type="text" style="width:100%" value="Say Something"/>
				</div>
				<div class="commentTable">
				</div>
			</div>
		</div>
	</div>
	<!-- end: TIMELINE PANEL -->
</div>
<style type="text/css">

</style>
<!-- end: PAGE CONTENT-->
<script type="text/javascript">
var context = <?php echo json_encode($context)?>;
var contextType = <?php echo json_encode($contextType)?>;
var comments = <?php echo json_encode($comments); ?>;
var currentUser = <?php echo json_encode(Yii::app()->session["user"])?>;
var options = <?php echo json_encode($options)?>;
var canUserComment = <?php echo json_encode($canComment)?>;
var commentIdOnTop;

jQuery(document).ready(function() {
	buildTimeLine();
	bindEvent();
});

function buildTimeLine() {
	$(".commentsTL").html('<div class="spine"></div>');
	
	countEntries = 0;
	$('.commentTable').append(buildComments(comments, 0));
}

function addEmptyCommentOnTop() {
	var newCommentLine = buildNewCommentLine("");	
	//create a new reply line on the root
	var ulRoot = $('.tree');
	ulRoot.prepend(newCommentLine);
	$(".newComment").focus();
}

function buildComments(commentsLevel, level) {
	if (level == 0) {
		var commentsHTML = '<ul class="tree list-unstyled padding-5">';
	} else {
		var commentsHTML = '<ul class="level list-unstyled" style="padding-left: 15px">';	
	}

	$.each( commentsLevel , function(key,commentObj) {
		if(commentObj.text && commentObj.created) {
			var date = new Date( parseInt(commentObj.created)*1000 );
			var commentsTLLine = buildLineHTML(commentObj);
			
			commentsHTML += commentsTLLine;
			
			if (commentObj.replies.length != 0) {
				nextLevel = level + 1;
				var commentsTLLineDown = buildComments(commentObj.replies, nextLevel);
				commentsHTML += commentsTLLineDown;
			} else {
				commentsHTML += "</li>";
			}
		}
	});
	commentsHTML += "</ul>";
	return commentsHTML;
}

function buildLineHTML(commentObj) {
	console.log(commentObj);
	var id = commentObj["_id"]["$id"];
	var date = moment(commentObj.created * 1000);
	var dateStr = date.fromNow();
	
	var iconStr = getProfilImageUrl(commentObj.author.profilImageUrl);
	var objectLink = (commentObj.object) ? ' <a '+url+'>'+iconStr+'</a>' : iconStr;

	var color = "white";
	var icon = "fa-user";
	
	var name = commentObj.author.name;
	var city = commentObj.author.address.addressLocality;
	var text = commentObj.text;
	var tags = "";
	if( "undefined" != typeof commentObj.tags && commentObj.tags) {
		$.each( commentObj.tags , function(i,tag){
			tags += "<span class='label label-inverse'>"+tag+"</span> ";
		});
		tags = '<div class="pull-right"><i class="fa fa-tags"></i> '+tags+'</div>';
	}
	
	var personName = "Unknown";
	//var dateString = date.toLocaleString();
	var commentsTLLine;

	commentsTLLine = '<hr style="border-width: 2px;"">'+
					'<li id="comment'+id+'" class="comment">'+
						'<div class="">'+
							//tags+
							objectLink+
							'<div class="commentline_title">'+
								'<span class="text-bold light-text no-margin">'+name+'</span>'+
								'<span class="commenter-location padding-5">'+city+'</span>'+
								'<span class="comment-time"><i class="fa fa-clock-o"></i> '+dateStr+'</span>'+
							'</div>'+
							text+	
							'<div class="space10"></div>'+
							"<div class='bar_tools_post'>";
	
	if (options.tree == true) {
		commentsTLLine = commentsTLLine + "<a href='javascript:;' class='commentReply' data-id='"+commentObj._id['$id']+"'><span class='label label-info'><i class='fa fa-reply'></i></span></a> "
	};

	var voteUpCount = parseInt(commentObj.voteUpCount) || 0;
	var voteDownCount = parseInt(commentObj.voteDownCount) || 0;
	var reportAbuseCount = parseInt(commentObj.reportAbuseCount) || 0;
	
	commentsTLLine = commentsTLLine + 
					"<a href='javascript:;' class='commentVoteUp' data-count='"+voteUpCount+"' data-id='"+commentObj._id['$id']+"'><span class='label label-green'>"+voteUpCount+" <i class='fa fa-thumbs-up'></i></span></a> "+
					"<a href='javascript:;' class='commentVoteDown' data-count='"+voteDownCount+"' data-id='"+commentObj._id['$id']+"'><span class='label label-orange'>"+voteDownCount+" <i class='fa fa-thumbs-down'></i></span></a> "+
					"<a href='javascript:;' class='commentReportAbuse' data-count='"+reportAbuseCount+"' data-id='"+commentObj._id['$id']+"'><span class='label label-red'>"+reportAbuseCount+" <i class='fa fa-flag'></i></span></a> "+
					"</div>"+
				'</div>';

	return commentsTLLine;
}


function bindEvent(){
	var separator, anchor;
	$('.commentline-scrubber').scrollToFixed({
		marginTop: $('header').outerHeight() + 100
	}).find("a").on("click", function(e){			
		anchor = $(this).data("separator");
		$("body").scrollTo(anchor, 300);
		e.preventDefault();
	});
	
	/*$(".date_separator").appear().on('appear', function(event, $all_appeared_elements) {
		separator = '#' + $(this).attr("id");
		$('.commentline-scrubber').find("li").removeClass("selected").find("a[href = '" + separator + "']").parent().addClass("selected");
	}).on('disappear', function(event, $all_disappeared_elements) {   				
		separator = $(this).attr("id");
		$('.commentline-scrubber').find("a").find("a[href = '" + separator + "']").parent().removeClass("selected");
	});*/

	//New comment actions
	$('.saySomething').off().on("focusin",function(){
		var backUrl = window.location.href.replace(window.location.origin, "");
		console.log(backUrl);
		if (checkLoggued(backUrl)) {
			$('.saySomething').hide();
			addEmptyCommentOnTop();
			bindEvent();
		}
	});
	$('.validateComment').off().on("click",function(){
		validateComment($(this).data("id"), $(this).data("parentid"));
	});
	$('.cancelComment').off().on("click",function(){
		cancelComment($(this).data("id"));
	});

	$('#waypoint').on("appear", function(event, $all_appeared_elements) {
		alert("vlan je suis sur le waypoint");
	});

	//Comment action button
	$('.commentReply').off().on("click",function(){
		replyComment($(this).data("id"));
	});
	$('.commentVoteUp').off().on("click",function(){
		actionOnComment($(this),'<?php echo Action::ACTION_VOTE_UP ?>');
	});
	$('.commentVoteDown').off().on("click",function(){
		actionOnComment($(this),'<?php echo Action::ACTION_VOTE_DOWN ?>');
	});
	$('.commentReportAbuse').off().on("click",function(){
		actionOnComment($(this),'<?php echo Action::ACTION_REPORT_ABUSE ?>');
	});
}

function actionOnComment(comment, action) {
	$.ajax({
		url: baseUrl+'/'+moduleId+"/action/addaction/",
		data: {
			id: comment.data("id"),
			collection : '<?php echo Comment::COLLECTION?>',
			action : action
		},
		type: 'post',
		global: false,
		async: false,
		dataType: 'json',
		success: 
			function(data) {
    			if(!data.result){
                    toastr.error(data.msg);
               	}
                else { 
                    if (data.userAllreadyDidAction) {
                    	toastr.info("You already vote on this comment.");
                    } else {
	                    toastr.success(data.msg);
	                    count = parseInt(comment.data("count"));
						comment.data( "count" , count+1 );
						icon = comment.children(".label").children(".fa").attr("class");
						comment.children(".label").html(comment.data("count")+" <i class='"+icon+"'></i>");
					}
                }
            },
        error: 
        	function(data) {
        		toastr.error("Error calling the serveur : contact your administrator.");
        	}
		});
}

function replyComment(parentCommentId) {
	
	var commentsTLLine = buildNewCommentLine(parentCommentId);

	//add a new line under the comment
	var ulChildren = $('#comment'+parentCommentId).children('ul');
	console.log(ulChildren);
	
	if (ulChildren.length == 0) {
		console.log("pas de children");
		//add new ul entry
		commentsTLLine = '<ul class="level list-unstyled" style="padding-left: 15px">'+commentsTLLine+'</ul>';
		ulChildren = $('#comment'+parentCommentId);
		ulChildren.append(commentsTLLine);
	} else {
		ulChildren.prepend(commentsTLLine);	
	}
	bindEvent();
	$(".newComment").focus();
}

function buildNewCommentLine(parentCommentId) {
	var id = 'newcomment'+Math.floor((Math.random() * 100) + 1);
	
	var iconStr = getProfilImageUrl(currentUser.profilImageUrl);
	var objectLink = iconStr;

	var color = "white";
	var icon = "fa-user";
	
	var name = currentUser.name;
	var city = "";
	var text = '<textarea class="newComment" rows="2" style="width: 100%"></textarea>';
	
	if (canUserComment == true) {
		commentsTLLine = 
					'<li id="'+id+'" class="comment">'+
						'<hr style="border-width: 2px;"">'+
						'<div class="" >'+
							//tags+
							objectLink+
							'<div class="commentline_title">'+
								'<span class="text-bold light-text no-margin">'+name+'</span>'+
								'<span class="commenter-location padding-5">'+city+'</span>'+
							'</div>'+
						'<div class="space10"></div>'+
						text+	
						'<div class="space10"></div>'+
						"<div class='bar_tools_post'>"+
						"<a href='javascript:;' class='validateComment' data-id='"+id+"' data-parentid='"+parentCommentId+"'><span class='label label-info'>Submit</span></a> "+
						"<a href='javascript:;' class='cancelComment' data-id='"+id+"' data-parentid='"+parentCommentId+"'><span class='label label-info'>Cancel</span></a> "+
						"</div>"+
					'</div></li>';
	} else {
		commentsTLLine = 
					'<li id="'+id+'"><div class="partition-'+color+'">'+
						'You can not comment more on this discussion'+
					'</div></li>';
	}
	return commentsTLLine;
}

function cancelComment(commentId) {
	var parentId = $("#"+commentId).children().children(".bar_tools_post").children(".cancelComment").data("parentid");
	console.log('Remove comment '+commentId, parentId);
	if (parentId == "") {
		$('.saySomething').show();
	} 
	$('#'+commentId).remove();
}

function validateComment(commentId, parentCommentId) {
	
	$.ajax({
		url: baseUrl+'/'+moduleId+"/comment/save/",
		data: {
			parentCommentId: parentCommentId,
			content : $('#'+commentId+' .newComment').val(),
			contextId : context["_id"]["$id"],
			contextType : contextType
		},
		type: 'post',
		global: false,
		async: false,
		dataType: 'json',
		success: 
			function(data) {
				if(!data.result){
					toastr.error(data.msg);
				}
				else { 
					toastr.success(data.msg);
					switchComment(commentId, data.newComment, parentCommentId);
				}
			},
		error: 
			function(data) {
				toastr.error("Error calling the serveur : contact your administrator.");
			}
	});

	//return newCommentId;
}

//Switch from Edditing comment to view comment
function switchComment(tempCommentId, comment, parentCommentId) {
	$('#'+tempCommentId).remove();
	var commentsTLLine = buildLineHTML(comment);
	// When it's a root comment
	if (parentCommentId == "" || "undefined" == typeof parentCommentId) {
		var ulChildren = $('.tree');
		ulChildren.prepend(commentsTLLine);
		$('#comment'+comment["_id"]["$id"]).addClass('animated bounceIn');
		addEmptyCommentOnTop();
	} else {
		var ulChildren = $('#comment'+parentCommentId).children('ul');
		ulChildren.prepend(commentsTLLine);
		$('#comment'+comment["_id"]["$id"]).addClass('animated bounceIn');
	}
	
	bindEvent();
}

function getProfilImageUrl(imageURL) {
	var iconStr = '<div class="avatar">';
	
	if ("undefined" != typeof imageURL && imageURL != "") {
		iconStr += '<img width="50" height="50" alt="image" class="img-circle"'+ 
						'src="'+baseUrl+'/'+moduleId+'/document/resized/50x50'+
						 imageURL+'">';
	} else {
		iconStr += '<i class="fa fa-user_circled fa-2x fa-border"></i>';
	}

	iconStr += "</div>";
	
	return iconStr;
}
</script>

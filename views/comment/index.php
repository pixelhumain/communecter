<?php 
//$this->renderPartial('commentsSV');
?>
<?php

if(Yii::app()->request->isAjaxRequest){
	echo CHtml::scriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js');
	echo CHtml::scriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js');
}else{
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' , CClientScript::POS_END);
}
?>	
	<!-- start: PAGE CONTENT -->
<div id="commentHistory">
	<div class="space20"></div>
	<div class="col-md-12">
		<!-- start: TIMELINE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading border-light">
				<h4 class="panel-title">Comments - <?php echo $contextType.' - '.@$context["name"]?></h4>
				<ul class="panel-heading-tabs border-light">
		        	<li>
		        		<a class="new-comment btn btn-info" href="#new-comment">Add <i class="fa fa-plus"></i></a>
		        	</li>
			        <li class="panel-tools">
			          <div class="dropdown">
			            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
			              <i class="fa fa-cog"></i>
			            </a>
			            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
			              <li>
			                <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
			              </li>
			              <li>
			                <a class="panel-expand" href="#">
			                  <i class="fa fa-expand"></i> <span>Fullscreen</span>
			                </a>
			              </li>
			              </ul>
		          	  </div>
			        </li>
		        </ul>
			</div>
			<div class="panel-body panel-white">
				<ul class="commentline-scrubber inner-element commentsTLmonthsList"></ul>
				<div class='row'>
					<div id="commentline">
						<div class="commentline commentsTL col-md-6">
												
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end: TIMELINE PANEL -->
	</div>
</div>
<style type="text/css">

</style>
<!-- end: PAGE CONTENT-->
<script type="text/javascript">
var context = <?php echo json_encode($context)?>;
var contextType = <?php echo json_encode($contextType)?>;
var comments = <?php echo json_encode($comments); ?>;
var currentUser = <?php echo json_encode(Yii::app()->session["user"])?>;

jQuery(document).ready(function() 
{
	buildTimeLine();
	addEmptyCommentOnTop();
	bindEvent();
});

function buildTimeLine()
{
	$(".commentsTL").html('<div class="spine"></div>');
	
	countEntries = 0;
	
	$('.commentsTL').append(buildComments(comments, 0));
	$('.commentsTL').append()
	
	/*if($('.commentsTL').children('li').length == 0)
		$(".commentsTL").html("<div class='center text-extra-large'>Sorry, no comments available</div>");
	*/
}

function addEmptyCommentOnTop() {
	var newCommentLine = buildNewCommentLine("");
	
	//create a new reply line on the root
	var ulRoot = $('.tree');
	ulRoot.prepend(newCommentLine);	
}

function buildComments(commentsLevel, level) {
	console.log(level);
	if (level == 0) {
		var commentsHTML = '<ul class="tree">';
	} else {
		var commentsHTML = '<ul class="level">';	
	}

	$.each( commentsLevel , function(key,commentObj)
	{
		if(commentObj.text && commentObj.created)
		{
			var date = new Date( parseInt(commentObj.created)*1000 );
			var commentsTLLine = buildLineHTML(commentObj);
			
			commentsHTML += commentsTLLine;
			
			console.log(commentObj.replies, commentObj.replies.length);
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

function buildLineHTML(commentObj)
{
	var id = commentObj["_id"]["$id"];
	var date = moment(commentObj.created * 1000);
	var dateStr = date.format('D MMM YYYY hh:mm');
	console.log("date",commentObj.created, dateStr);
	
	var iconStr = getProfilImageUrl(commentObj.author.profilImageUrl);
	var objectLink = (commentObj.object) ? ' <a '+url+'>'+iconStr+'</a>' : iconStr;

	var color = "white";
	var icon = "fa-user";
	
	var title = commentObj.author.name;
	var text = commentObj.text;
	var tags = "";
	if( "undefined" != typeof commentObj.tags && commentObj.tags)
	{
		$.each( commentObj.tags , function(i,tag){
			tags += "<span class='label label-inverse'>"+tag+"</span> ";
		});
		tags = '<div class="pull-right"><i class="fa fa-tags"></i> '+tags+'</div>';
	}
	
	var personName = "Unknown";
	//var dateString = date.toLocaleString();
	var commentsTLLine;

	commentsTLLine = '<li id="comment'+id+'"><div class="commentline_element partition-'+color+'">'+
					tags+
					'<div class="commentline_title">'+
						objectLink+
						'<span class="text-large text-bold light-text no-margin padding-5">'+title+'</span>'+
					'</div>'+
					'<div class="space10"></div>'+
					text+	
					'<div class="space10"></div>'+
					
					'<hr><div class="pull-right"><i class="fa fa-clock-o"></i> '+dateStr+'</div>'+
					"<div class='bar_tools_post'>"+
					"<a href='javascript:;' class='commentReply' data-id='"+commentObj._id['$id']+"'><span class='label label-info'><i class='fa fa-reply'></i></span></a> "+
					"<a href='javascript:;' class='commentVoteUp' data-count='10' data-id='"+commentObj._id['$id']+"'><span class='label label-green'>10 <i class='fa fa-thumbs-up'></i></span></a> "+
					"<a href='javascript:;' class='commentVoteDown' data-count='10' data-id='"+commentObj._id['$id']+"'><span class='label label-orange'>10 <i class='fa fa-thumbs-down'></i></span></a> "+
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
	$(".date_separator").appear().on('appear', function(event, $all_appeared_elements) {
		separator = '#' + $(this).attr("id");
		$('.commentline-scrubber').find("li").removeClass("selected").find("a[href = '" + separator + "']").parent().addClass("selected");
	}).on('disappear', function(event, $all_disappeared_elements) {   				
		separator = $(this).attr("id");
		$('.commentline-scrubber').find("a").find("a[href = '" + separator + "']").parent().removeClass("selected");
	});
	$('.commentReply').off().on("click",function(){
		replyComment($(this).data("id"));
	});
	$('.commentVoteUp').off().on("click",function(){
		toastr.info('TODO : VOTE UP this news Entry');
		console.log("newsVoteUp",$(this).data("id"));
		count = parseInt($(this).data("count"));
		$(this).data( "count" , count+1 );
		$(this).children(".label").html($(this).data("count")+" <i class='fa fa-thumbs-up'></i>");
	});
	$('.commentVoteDown').off().on("click",function(){
		toastr.info('TODO : VOTE DOWN this news Entry');
		console.log("newsVoteDown",$(this).data("id"));
		count = parseInt($(this).data("count"));
		$(this).data( "count" , count+1 );
		$(this).children(".label").html($(this).data("count")+" <i class='fa fa-thumbs-down'></i>");
	});

	$('.validateComment').off().on("click",function(){
		validateComment($(this).data("id"), $(this).data("parentid"));
	});
	$('.cancelComment').off().on("click",function(){
		cancelComment($(this).data("id"));
	});
}

function replyComment(parentCommentId) {
	toastr.info('Reply to comment '+parentCommentId);
	
	var commentsTLLine = buildNewCommentLine(parentCommentId);

	//add a new line under the comment
	var ulChildren = $('#comment'+parentCommentId).children('ul');
	console.log(ulChildren);
	
	if (ulChildren.length == 0) {
		console.log("pas de children");
		//add new ul entry
		commentsTLLine = '<ul class="level">'+commentsTLLine+'</ul>';
		ulChildren = $('#comment'+parentCommentId);
		ulChildren.append(commentsTLLine);
	} else {
		ulChildren.prepend(commentsTLLine);	
	}
	bindEvent();
}

function buildNewCommentLine(parentCommentId) {
	var id = 'newcomment'+Math.floor((Math.random() * 100) + 1);
	var date = moment();
	var dateStr = date.format('D MMM YYYY hh:mm');//day + ' ' + month + ' ' + year + ' ' + hour + ':' + min;
	console.log("date", dateStr);
	
	var iconStr = getProfilImageUrl(currentUser.profilImageUrl);
	var objectLink = iconStr;

	var color = "white";
	var icon = "fa-user";
	
	var title = currentUser.name;
	var text = '<textarea class="newComment" rows="2" style="width: 100%"></textarea>';
	var tags = "";
	commentsTLLine = 
				'<li id="'+id+'"><div class="commentline_element partition-'+color+'">'+
					tags+
					'<div class="commentline_title">'+
						objectLink+
						'<span class="text-large text-bold light-text no-margin padding-5">'+title+'</span>'+
					'</div>'+
					'<div class="space10"></div>'+
					text+	
					'<div class="space10"></div>'+
					
					'<hr><div class="pull-right"><i class="fa fa-clock-o"></i> '+dateStr+'</div>'+
					"<div class='bar_tools_post'>"+
					"<a href='javascript:;' class='validateComment' data-id='"+id+"' data-parentid='"+parentCommentId+"'><span class='label label-info'>Reply</span></a> "+
					"<a href='javascript:;' class='cancelComment' data-id='"+id+"'><span class='label label-info'>Cancel</span></a> "+
					"</div>"+
				'</div></li>';
	return commentsTLLine;
}

function cancelComment(commentId) {
	console.log('Remove comment '+commentId);
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
	console.log(comment, parentCommentId);
	$('#'+tempCommentId).remove();
	var commentsTLLine = buildLineHTML(comment);
	// When it's a root comment
	if (parentCommentId == "" || "undefined" == typeof parentCommentId) {
		var ulChildren = $('.tree');
		ulChildren.prepend(commentsTLLine);
		addEmptyCommentOnTop();
	} else {
		var ulChildren = $('#comment'+parentCommentId).children('ul');
		ulChildren.prepend(commentsTLLine);
	}
	
	console.log(ulChildren);
	
	bindEvent();
}

function getProfilImageUrl(imageURL) {
	var iconStr = '<i class=" fa fa-user_circled fa-2x pull-left fa-border"></i>';
	if ("undefined" != typeof imageURL) {
		iconStr = '<img width="50" height="50" alt="image" class="img-circle"'+ 
						'src="'+baseUrl+'/'+moduleId+'/document/resized/50x50'+
						 imageURL+'">';
	}
	return iconStr;
}
</script>

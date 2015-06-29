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
				<h4 class="panel-title">Discuss - <?php echo $parentType.' - '.$parentName?></h4>
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
				<div id="commentline">
					<div class="commentline commentsTL">
											
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
var discuss = <?php echo json_encode($discuss)?>;
var comments = <?php echo json_encode($discuss["comments"])?>;
var months = ["<?php echo Yii::t('common','january') ?>", "<?php echo Yii::t('common','febuary') ?>", "<?php echo Yii::t('common','march') ?>", "<?php echo Yii::t('common','april') ?>", "<?php echo Yii::t('common','may') ?>", "<?php echo Yii::t('common','june') ?>", "<?php echo Yii::t('common','july') ?>", "<?php echo Yii::t('common','august') ?>", "<?php echo Yii::t('common','september') ?>", "<?php echo Yii::t('common','october') ?>", "<?php echo Yii::t('common','november') ?>", "<?php echo Yii::t('common','december') ?>"];
var currentUser = <?php echo json_encode(Yii::app()->session["user"])?>;

jQuery(document).ready(function() 
{
	buildTimeLine();
});

function buildTimeLine()
{
	$(".commentsTL").html('<div class="spine"></div>');
	$(".commentsTLmonthsList").html('');
	console.log("buildTimeLine",Object.keys(comments).length);
	
	currentMonth = null;
	countEntries = 0;
	
	$('.commentsTL').append(buildComments(comments, 0));
	//if(!countEntries)
	//	$(".commentsTL").html("<div class='center text-extra-large'>Sorry, no comments available</div>");
	bindEvent();
}

function buildComments(commentsLevel, level) {
	console.log(level);
	if (level == 0) {
		var commentsHTML = '<ul class="tree">';
	} else {
		var commentsHTML = '<ul class="level">';	
	}
	
	$.each( commentsLevel , function(key,commentsObj)
	{
		if(commentsObj.text && commentsObj.created)
		{
			var date = new Date( parseInt(commentsObj.created)*1000 );
			var commentsTLLine = buildLineHTML(commentsObj);
			
			commentsHTML += commentsTLLine;
			
			console.log(commentsObj.replies, commentsObj.replies.length);
			if (commentsObj.replies.length != 0) {
				nextLevel = level + 1;
				var commentsTLLineDown = buildComments(commentsObj.replies, nextLevel);
				commentsHTML += commentsTLLineDown;
			} else {
				commentsHTML += "</li>";
			}
		}
	});
	commentsHTML += "</ul>";
	return commentsHTML;
}

function buildLineHTML(commentsObj)
{
	var id = commentsObj["_id"]["$id"];
	var date = moment(commentsObj.created * 1000);
	var dateStr = date.format('D MMM YYYY hh:mm');
	console.log("date",commentsObj.created, dateStr);
	/*if( currentMonth != date.getMonth() )
	{
		currentMonth = date.getMonth();
		linkHTML =  '<li class="">'+
						'<a href="#month'+date.getMonth()+date.getFullYear()+'" data-separator="#month'+date.getMonth()+date.getFullYear()+'">'+months[date.getMonth()]+' '+date.getFullYear()+'</a>'+
					'</li>';
		$(".commentsTLmonthsList").append(linkHTML);

		titleHTML = '<div class="date_separator" id="month'+date.getMonth()+date.getFullYear()+'" data-appear-top-offset="-400">'+
						'<span>'+months[date.getMonth()]+' '+date.getFullYear()+'</span>'+
					'</div>'+
					'<ul class="columns commentsTL'+date.getMonth()+'"></ul>';
		$(".commentsTL").append(titleHTML);
	}*/
	/*var url = baseUrl+'/'+moduleId+'/rpee/projects/perimeterid/';
	url = 'href="javascript:;" onclick="'+url+'"';	
	var objectDetail = (commentsObj.object && commentsObj.object.displayName) ? '<div>Name : '+commentsObj.object.displayName+'</div>'	 : "";
	*/
	
	iconStr = '<i class=" fa fa-user_circled fa-2x pull-left fa-border"></i>';
	var objectLink = (commentsObj.object) ? ' <a '+url+'>'+iconStr+'</a>' : iconStr;

	var color = "white";
	var icon = "fa-user";
	
	var title = commentsObj.author.name;
	var text = commentsObj.text;
	var tags = "";
	if( "undefined" != typeof commentsObj.tags && commentsObj.tags)
	{
		$.each( commentsObj.tags , function(i,tag){
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
					"<a href='javascript:;' class='commentReply' data-id='"+commentsObj._id['$id']+"'><span class='label label-info'><i class='fa fa-reply'></i></span></a> "+
					"<a href='javascript:;' class='commentVoteUp' data-count='10' data-id='"+commentsObj._id['$id']+"'><span class='label label-green'>10 <i class='fa fa-thumbs-up'></i></span></a> "+
					"<a href='javascript:;' class='commentVoteDown' data-count='10' data-id='"+commentsObj._id['$id']+"'><span class='label label-orange'>10 <i class='fa fa-thumbs-down'></i></span></a> "+
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
}

function replyComment(parentCommentId) {
	toastr.info('Reply to comment '+parentCommentId);
	
	var id = 'newcomment';
	var date = moment();
	var dateStr = date.format('D MMM YYYY hh:mm');//day + ' ' + month + ' ' + year + ' ' + hour + ':' + min;
	console.log("date", dateStr);
	
	iconStr = '<i class=" fa fa-user_circled fa-2x pull-left fa-border"></i>';
	var objectLink = iconStr;

	var color = "white";
	var icon = "fa-user";
	
	var title = currentUser.name;
	var text = '<textarea id="newComment" rows="2" style="width: 100%"></textarea>';
	var tags = "";
	commentsTLLine = 
				'<li id="comment'+id+'"><div class="commentline_element partition-'+color+'">'+
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
					"<a href='javascript:;' class='validateComment' data-parentid='"+parentCommentId+"'><span class='label label-info'>Reply</span></a> "+
					"</div>"+
				'</div></li>';

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

	$('.validateComment').off().on("click",function(){
		validateComment($(this).data("parentid"));
	});
}

function validateComment(parentCommentId) {
	$.mockjax({
       url : baseUrl+'/'+moduleId+"/discuss/addComment/",
       dataType : 'json',
       responseTime : 2000,
       responseText : {
         result : true,
         msg: 'Bravo votre commentaire a été mocké',
         newComment : {
				"_id" : {'$id' : "558cfe5d2339f285060041aa"},
				"text" : $('#newComment').val(),
			    "author" : {"name" : currentUser.name},
			    "created" : new Date(),
			    "tags" : {}
         	}
       	}
    });

	$.ajax({
		url: baseUrl+'/'+moduleId+"/discuss/addComment/",
		data: {
			parentCommentId: parentCommentId,
			content : $('#newComment').val()
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
                    switchComment(data.newComment, parentCommentId);
                }
            }
	});

	//return newCommentId;
}

//Switch from Edditing comment view to view comment
function switchComment(comment, parentCommentId) {
	console.log(comment, parentCommentId);
	$('#commentnewcomment').remove();
	var commentsTLLine = buildLineHTML(comment);
	var ulChildren = $('#comment'+parentCommentId).children('ul');
	console.log(ulChildren);
	ulChildren.prepend(commentsTLLine);
	bindEvent();
}
</script>

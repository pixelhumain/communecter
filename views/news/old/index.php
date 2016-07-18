<?php 
$this->renderPartial('newsSV');

$cssAnsScriptFilesModule = array(
	'/plugins/ScrollToFixed/jquery-scrolltofixed-min.js',
	'/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
	'/plugins/jquery.appear/jquery.appear.js'
);

HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");
?>	
	<!-- start: PAGE CONTENT -->
<?php 

	if( isset($type) && $type == Organization::COLLECTION && isset($organization))
		Menu::organization( $organization );
	$this->renderPartial('../default/panels/toolbar'); 


	$this->renderPartial('../sig/generic/mapLibs');

?>

<div id="formCreateNewsTemp">
	<div class='col-sm-8 col-sm-offset-2'>
		<div class='space20'></div>
		<h2 class='radius-10 padding-10 partition-blue text-bold'>Share a thought, an idea </h2>
		<form id='ajaxForm'></form>
	 </div>
</div>
			

<div id="newsHistory">
	<div class="space20"></div>
	<div class="col-md-12">

		<!-- start: TIMELINE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading border-light">
				<h4 class="panel-title">News</h4>
				<ul class="panel-heading-tabs border-light">
		        	<!-- <li>
		        		<a class="new-news btn btn-info" href="#new-News" data-notsubview="1">Add <i class="fa fa-plus"></i></a>
		        	</li> -->
		        	<?php /* ?>
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
			        <?php */?>
		        </ul>
			</div>
			<div class="panel-body panel-white">

				<ul class="timeline-scrubber inner-element newsTLmonthsList"></ul>
				<div id="timeline">
					<div class="timeline newsTL">
											
					</div>
				</div>
			</div>
		</div>
		<!-- end: TIMELINE PANEL -->
	</div>
</div>
<style type="text/css">
div.timeline .columns > li:nth-child(2n+2) {margin-top: 10px;}
.timeline_element {padding: 10px;}


<?php 
		foreach($news as $key => $oneNews){
			$news[$key]["typeSig"] = "news";	
		}
?>

</style>
<!-- end: PAGE CONTENT-->
<script type="text/javascript">
var news = <?php echo json_encode($news)?>;
//var authorNews = <?php //echo json_encode($authorNews)?>;
var months = ["<?php echo Yii::t('common','january') ?>", "<?php echo Yii::t('common','febuary') ?>", "<?php echo Yii::t('common','march') ?>", "<?php echo Yii::t('common','april') ?>", "<?php echo Yii::t('common','may') ?>", "<?php echo Yii::t('common','june') ?>", "<?php echo Yii::t('common','july') ?>", "<?php echo Yii::t('common','august') ?>", "<?php echo Yii::t('common','september') ?>", "<?php echo Yii::t('common','october') ?>", "<?php echo Yii::t('common','november') ?>", "<?php echo Yii::t('common','december') ?>"];
var contextMap = {
	"tags" : [],
	"scopes" : {
		codeInsee : [],
		codePostal : [], 
		region :[]
	},
};


jQuery(document).ready(function() 
{
	buildTimeLine();
	
	Sig.restartMap();
	Sig.showMapElements(Sig.map, news);

	buildDynForm();
});

function buildTimeLine ()
{
	$(".newsTL").html('<div class="spine"></div>');
	$(".newsTLmonthsList").html('');
	console.log("buildTimeLine",Object.keys(news).length);
	
	var formCreateNews = $("#formCreateNewsTemp").html();
	$("#formCreateNewsTemp").html("");		

	currentMonth = null;
	countEntries = 0;
	$.each( news , function(key,newsObj)
	{
		if(newsObj.text && (newsObj.created || newsObj.created) && newsObj.name)
		{
			//console.dir(newsObj);
			var date = new Date( parseInt(newsObj.created)*1000 );
			//if(newsObj.date != null) 
			//	date = new Date( parseInt(newsObj.date)*1000 ) ;
			//console.dir(newsObj);
			var newsTLLine = buildLineHTML(newsObj);
			if(countEntries == 0)
			$(".newsTL"+date.getMonth()).append(
				"<li class='newsFeed'><div class='timeline_element partition-white'>" + formCreateNews + "</div></li>");
			$(".newsTL"+date.getMonth()).append(newsTLLine);
			countEntries++;
		}
	});
	if(!countEntries)
		$(".newsTL").html("<div class='center text-extra-large'>Sorry, no news available</div>");
	bindEvent();
}

var currentMonth = null;
function buildLineHTML(newsObj)
{
	var date = new Date( parseInt(newsObj.created)*1000 );
	//if(newsObj.date != null) {
	//	date = new Date( parseInt(newsObj.date)*1000 ) ;
	//}
	var year = date.getFullYear();
	var month = months[date.getMonth()];
	var day = (date.getDate() < 10) ?  "0"+date.getDate() : date.getDate();
	var hour = (date.getHours() < 10) ?  "0"+date.getHours() : date.getHours();
	var min = (date.getMinutes() < 10) ?  "0"+date.getMinutes() : date.getMinutes();
	var dateStr = day + ' ' + month + ' ' + year + ' ' + hour + ':' + min;
	//console.log("date",dateStr);
	if( currentMonth != date.getMonth() )
	{
		currentMonth = date.getMonth();
		linkHTML =  '<li class="">'+
						'<a href="#month'+date.getMonth()+date.getFullYear()+'" data-separator="#month'+date.getMonth()+date.getFullYear()+'">'+months[date.getMonth()]+' '+date.getFullYear()+'</a>'+
					'</li>';
		$(".newsTLmonthsList").append(linkHTML);

		titleHTML = '<div class="date_separator" id="month'+date.getMonth()+date.getFullYear()+'" data-appear-top-offset="-400">'+
						'<span>'+months[date.getMonth()]+' '+date.getFullYear()+'</span>'+
					'</div>'+
					'<ul class="columns newsTL'+date.getMonth()+'"></ul>';
		$(".newsTL").append(titleHTML);
	}

	var color = "white";
	var icon = "fa-user";
	var url = baseUrl+'/'+moduleId+'/rpee/projects/perimeterid/';
	
	if(typeof newsObj.author.type == "undefined") {
		newsObj.author.type = "people";
		colorIcon="yellow";
	}
	//if (newsObj.type=="projects"){
	//	newsObj.
	//}
	newsObj.icon = "fa-" + Sig.getIcoByType({type : newsObj.author.type});
	var colorIcon = Sig.getIcoColorByType({type : newsObj.author.type});
	
	var flag = '<div class="ico-type-account"><i class="fa '+newsObj.icon+' fa-'+colorIcon+'"></i></div>';
	var iconStr = "";
	url = 'href="javascript:;" onclick="'+url+'"';	
	if(typeof(newsObj.icon) != "undefined"){
		var imgProfilPath =  "<?php echo $this->module->assetsUrl.'/images/news/profile_default_l.png';?>";
		if(typeof newsObj.author.profilImageUrl !== "undefined" && newsObj.author.profilImageUrl != "") imgProfilPath = "<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'); ?>" + newsObj.author.profilImageUrl;
		iconStr = "<div class='thumbnail-profil'><img height=50 width=50 src='" + imgProfilPath + "'></div>" + flag ; 
	} else {
		var imgProfilPath =  "<?php echo $this->module->assetsUrl.'/images/news/profile_default_l.png';?>";
		iconStr = "<div class='thumbnail-profil'><img height=50 width=50 src='" + imgProfilPath + "'></div>" + flag ; 
	}

	title = newsObj.name,
	text = newsObj.text,
	tags = "", 
	scopes = "",
	tagsClass = "",
	scopeClass = "";
	
	if( "object" == typeof newsObj.tags && newsObj.tags )
	{
		$.each( newsObj.tags , function(i,tag){
			tagsClass += tag+" ";
			tags += "<span class='label tag_item_map_list'>#"+tag+"</span> ";
			if( $.inArray(tag, contextMap.tags )  == -1)
				contextMap.tags.push(tag);
		});
		tags = '<div class="pull-left"><i class="fa fa-tags text-red"></i> '+tags+'</div>';
	}

	if( newsObj.address )
	{
		if( newsObj.address.codeInsee )
		{
			scopes += "<span class='label label-danger'>codeInsee : "+newsObj.address.codeInsee+"</span> ";
			scopeClass += newsObj.address.codeInsee+" ";
			if( $.inArray(newsObj.address.codeInsee, contextMap.scopes.codeInsee )  == -1)
				contextMap.scopes.codeInsee.push(newsObj.address.codeInsee);
		}
		if( newsObj.address.codePostal )
		{
			scopes += "<span class='label label-danger'>codePostal : "+newsObj.address.codePostal+"</span> ";
			scopeClass += newsObj.address.codePostal+" ";
			if( $.inArray(newsObj.address.codePostal, contextMap.scopes.codePostal )  == -1)
				contextMap.scopes.codePostal.push(newsObj.address.codePostal);
		}
		if( newsObj.address.region )
		{
			scopes += "<span class='label label-danger'>"+newsObj.address.region+"</span> ";
			scopeClass += newsObj.address.region+" ";
			if( $.inArray(newsObj.address.region, contextMap.scopes.region )  == -1)
				contextMap.scopes.region.push(newsObj.address.region);
		}
		scopes = '<div class="pull-right"><i class="fa fa-circle-o"></i> '+scopes+'</div>';
	}
	var objectDetail = (newsObj.object && newsObj.object.displayName) ? '<div>Name : '+newsObj.object.displayName+'</div>'	 : "";
	var objectLink = (newsObj.object) ? ' <a '+url+'>'+iconStr+'</a>' : iconStr;
	
	var personName = newsObj.author.name;
	//var dateString = date.toLocaleString();
	var commentCount = 0;
	if ("undefined" != typeof newsObj.commentCount) 
		commentCount = newsObj.commentCount;
	
	newsTLLine = '<li class="newsFeed '+tagsClass+' '+scopeClass+' "><div class="timeline_element partition-'+color+'">'+
					tags+
					scopes+
					'<div class="space1"></div>'+ 
					'<div class="timeline_shared_picture"  style="background-image:url(<?php echo $this->module->assetsUrl.'/images/default_shared.jpg';?>);"><img src="<?php echo $this->module->assetsUrl.'/images/default_shared.jpg';?>"></div>'+
					'<div class="timeline_author_block">'+
						objectLink+
						'<span class="light-text timeline_author padding-5 margin-top-5 text-dark text-bold">'+personName+'</span>'+
						'<div class="timeline_date"><i class="fa fa-clock-o"></i> '+dateStr+'</div>' +
					
					'</div>'+
					'<div class="space5"></div>'+
					'<div class="timeline_title">'+
						'<span class="text-large text-bold light-text timeline_title no-margin padding-5">'+title+
						'</span>'+

					'</div>'+
					'<div class="space5"></div>'+
					'<span class="timeline_text">'+ text + '</span>' +	
					'<div class="space10"></div>'+
					
					'<hr>'+
					"<div class='bar_tools_post pull-left'>"+
					"<a href='javascript:;' class='newsAddComment' data-count='"+commentCount+"' data-id='"+newsObj._id['$id']+"'><span class='label text-dark'>"+commentCount+" <i class='fa fa-comment'></i></span></a> "+
					"<a href='javascript:;' class='newsVoteUp' data-count='10' data-id='"+newsObj._id['$id']+"'><span class='label text-dark'>10 <i class='fa fa-thumbs-up'></i></span></a> "+
					"<a href='javascript:;' class='newsVoteDown' data-count='10' data-id='"+newsObj._id['$id']+"'><span class='label text-dark'>10 <i class='fa fa-thumbs-down'></i></span></a> "+
					"<a href='javascript:;' class='newsShare' data-count='10' data-id='"+newsObj._id['$id']+"'><span class='label text-dark'>10 <i class='fa fa-share-alt'></i></span></a> "+
					//"<span class='label label-info'>10 <i class='fa fa-eye'></i></span>"+
					"</div>"+
				'</div></li>';

	return newsTLLine;
}


function bindEvent(){
	var separator, anchor;
	$('.timeline-scrubber').scrollToFixed({
		marginTop: $('header').outerHeight() + 100
	}).find("a").on("click", function(e){			
		anchor = $(this).data("separator");
		$("body").scrollTo(anchor, 300);
		e.preventDefault();
	});
	$(".date_separator").appear().on('appear', function(event, $all_appeared_elements) {
		separator = '#' + $(this).attr("id");
		$('.timeline-scrubber').find("li").removeClass("selected").find("a[href = '" + separator + "']").parent().addClass("selected");
	}).on('disappear', function(event, $all_disappeared_elements) {   				
		separator = $(this).attr("id");
		$('.timeline-scrubber').find("a").find("a[href = '" + separator + "']").parent().removeClass("selected");
	});
	$('.newsAddComment').off().on("click",function(){
		window.location.href = baseUrl+"/<?php echo $this->module->id?>/comment/index/type/news/id/"+$(this).data("id");
		/*toastr.info('TODO : COMMENT this news Entry');
		console.log("newsAddComment",$(this).data("id"));
		count = parseInt($(this).data("count"));
		$(this).data( "count" , count+1 );
		$(this).children(".label").html($(this).data("count")+" <i class='fa fa-comment'></i>");*/
	});
	$('.newsVoteUp').off().on("click",function(){
		toastr.info('TODO : VOTE UP this news Entry');
		console.log("newsVoteUp",$(this).data("id"));
		count = parseInt($(this).data("count"));
		$(this).data( "count" , count+1 );
		$(this).children(".label").html($(this).data("count")+" <i class='fa fa-thumbs-up'></i>");
	});
	$('.newsVoteDown').off().on("click",function(){
		toastr.info('TODO : VOTE DOWN this news Entry');
		console.log("newsVoteDown",$(this).data("id"));
		count = parseInt($(this).data("count"));
		$(this).data( "count" , count+1 );
		$(this).children(".label").html($(this).data("count")+" <i class='fa fa-thumbs-down'></i>");
	});
	$('.newsShare').off().on("click",function(){
		toastr.info('TODO : SHARE this news Entry');
		console.log("newsShare",$(this).data("id"));
		count = parseInt($(this).data("count"));
		$(this).data( "count" , count+1 );
		$(this).children(".label").html($(this).data("count")+" <i class='fa fa-share-alt'></i>");
	});
}

function updateNews(newsObj)
{
	var date = new Date( parseInt(newsObj.created)*1000 );
	if(newsObj.date) {
		d = newsObj.date.split("/");
		month = parseInt(d[1])-1;
		date = new Date( d[2], month,d[0] ) ;
	}
	var newsTLLine = buildLineHTML(newsObj);
	$(".newsTL"+date.getMonth()).prepend(newsTLLine);
}


function applyTagFilter(str)
{
	$(".newsFeed").fadeOut();
	if(!str){
		if($(".btn-tag.active").length){
			str = "";
			sep = "";
			$.each( $(".btn-tag.active") , function() { 
				str += sep+"."+$(this).data("id");
				sep = ",";
			});
		} else
			str = ".newsFeed";
	} 
	console.log("applyTagFilter",str);
	$(str).fadeIn();
	return $(".newsFeed").length;
}

function applyScopeFilter(str)
{
	$(".newsFeed").fadeOut();
	if(!str){
		if($(".btn-context-scope.active").length){
			str = "";
			sep = "";
			$.each( $(".btn-context-scope.active") , function() { 
				str += sep+"."+$(this).data("val");
				sep = ",";
			});
		} else
			str = ".newsFeed";
	} 
	console.log("applyScopeFilter",str);
	$(str).fadeIn();
	return $(".newsFeed").length;
}

function loadFormCreateNews(){

}

</script>

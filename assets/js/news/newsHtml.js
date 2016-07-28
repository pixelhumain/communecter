var contextMap = {
	"tags" : [],
	"scopes" : {
		codeInsee : [],
		codePostal : [], 
		region :[],
		addressLocality : []
	},
};
var tagsFilterListHTML = "";
var scopesFilterListHTML = "";
var mode = "view";

function buildLineHTML(newsObj,idSession,update)
{
	addForm=false;
	if(typeof(contextParentType) == "undefined")
		contextParentType="citoyens";
	newsTLLine = "";
	// ManageMenu to the user de signaler un abus, de modifier ou supprimer ces news
	manageMenu = "";
	
	manageMenu='<div class="btn dropdown pull-right no-padding" style="padding-left:10px !important;">'+
		'<a class="dropdown-toggle" type="button" data-toggle="dropdown" style="color:#8b91a0;">'+
			'<i class="fa fa-cog"></i>  <i class="fa fa-angle-down"></i>'+
		'</a>'+
		'<ul class="dropdown-menu">';

	var reportLink = "";
	if ("undefined" != typeof newsObj.reportAbuse) {
		if ("undefined" == typeof newsObj.reportAbuse[idSession]){
			reportLink = '<li><a href="javascript:;" class="newsReport" onclick="newsReportAbuse(this,\''+newsObj._id.$id+'\')" data-id="'+newsObj._id.$id+'"><small><i class="fa fa-flag"></i> '+trad['reportanabuse']+'</small></a></li>';
		}
	}
	else{
		reportLink = '<li><a href="javascript:;" class="newsReport" onclick="newsReportAbuse(this,\''+newsObj._id.$id+'\')" data-id="'+newsObj._id.$id+'"><small><i class="fa fa-flag"></i> '+trad['reportanabuse']+'</small></a></li>';
	}
	
	if (newsObj.author.id==idSession || canManageNews == true){
			manageMenu	+=		'<li><a href="javascript:;" class="deleteNews" onclick="deleteNews(\''+newsObj._id.$id+'\', $(this))" data-id="'+newsObj._id.$id+'"><small><i class="fa fa-times"></i> '+trad['delete']+'</small></a></li>';
		if (newsObj.type != "activityStream" && newsObj.author.id==idSession){
			manageMenu	+= '<li><a href="javascript:" class="modifyNews" onclick="modifyNews(\''+newsObj._id.$id+'\')" data-id="'+newsObj._id.$id+'"><small><i class="fa fa-pencil"></i> '+trad['updatepublication']+'</small></a></li>';
		}
	}	
	manageMenu +=	reportLink+'</ul>'+
		'</div>';
	
	if(typeof(newsObj.created) == "object")
		var date = new Date( parseInt(newsObj.created.sec)*1000 );
	else
		var date = new Date( parseInt(newsObj.created)*1000 );

	var year = date.getFullYear();
	var month = months[date.getMonth()];
	var day = (date.getDate() < 10) ?  "0"+date.getDate() : date.getDate();
	var hour = (date.getHours() < 10) ?  "0"+date.getHours() : date.getHours();
	var min = (date.getMinutes() < 10) ?  "0"+date.getMinutes() : date.getMinutes();
	var dateStr = day + ' ' + month + ' ' + year + ' ' + hour + ':' + min;
	if(typeof(newsObj.scope)!="undefined" && typeof(newsObj.scope.type)!="undefined"){
		scopeTooltip=trad["visible"+newsObj.scope.type];
		if(newsObj.scope.type=="public"){
			scopeIcon="globe";
		} 
		else if (newsObj.scope.type=="restricted"){
			scopeIcon="connectdevelop";
		}else{
			scopeIcon="lock";
		}
		dateStr += " • <i class='fa fa-"+scopeIcon+" tooltips' data-toggle='tooltip' data-placement='bottom' data-original-title='"+scopeTooltip+"'></i>";
	}
	// if month of the current news is different than currentMonth
	// Added new month link to the right sidebar and a new date separator in the timeline
	// Check if inject the new's form
	if(typeof(currentMonth) != "undefined" && currentMonth != date.getMonth() && update != true)
	{
		form="";
		// Append for at the beginning after the construction of the timeline
		//alert(canPostNews);
		if (currentMonth == null  && canPostNews == true){
		//	alert();
			form = "<div class='newsFeed'>"+
						"<div id='newFeedForm"+"' class='timeline_element partition-white no-padding' style='min-width:85%;'></div>"+
					"</div>";
			addForm=true;

		}
		currentMonth = date.getMonth();
		// Add item to the left filter by month YY
		linkHTML =  '<li class="">'+
						'<a href="javascript:;" class="linkMonth" onclick="smoothScroll(\'#month'+date.getMonth()+date.getFullYear()+'\');">'+months[date.getMonth()]+' '+date.getFullYear()+'</a>'+
					'</li>';
		// Add date separator by month YY
		$(".newsTLmonthsList").append(linkHTML);
		newsTLLine += '<div class="date_separator" id="'+'month'+date.getMonth()+date.getFullYear()+'" data-appear-top-offset="-400">'+
						'<span>'+months[date.getMonth()]+' '+date.getFullYear()+'</span>'+
					'</div>'+form;
		
		$(".spine").css("bottom","0px");
	}
	else{
		$(".spine").css("bottom","30px");
	}
	var color = "white";
	var icon = "fa-user";
	///// Url link to object
	urlAction=buildHtmlUrlAndActionObject(newsObj);
	var imageBackground = "";
	if(typeof newsObj.author != "undefined"){
		if(typeof newsObj.author.type == "undefined") {
			newsObj.author.type = "citoyens";
		}
	}
	
	///// Image Backgound
	if(typeof(newsObj.imageBackground) != "undefined" && newsObj.imageBackground){
		imagePath = baseUrl+'/'+newsObj.imageBackground;
		imageBackground = '<a '+url+'>'+
							'<div class="timeline_shared_picture"  style="">'+
							//background-image:url('+imagePath+');
								'<img src="'+imagePath+'">'+
							'</div>'+
						'</a>';
	}
	console.log(newsObj);
	//END Image Background
	iconStr=builHtmlAuthorImageObject(newsObj);
	if(newsObj.type == "activityStream" && typeof(newsObj.target) != "undefined"){
		if(newsObj.target.type=="projects")
			var iconBlank="fa-lightbulb-o";
		else if (newsObj.target.type=="organizations")
			var iconBlank="fa-group";
	}
	// END IMAGE AND FLAG POST BY HOSTED BY //
	media="";
	title="";
	text="";
	actionTitle="";
	if (newsObj.type != "activityStream"){
		if("undefined" != typeof newsObj.name){
			title='<a href="javascript:" id="newsTitle'+newsObj._id.$id+'" data-type="text" data-pk="'+newsObj._id.$id+'" class="editable-news editable editable-click newsTitle"><span class="text-large text-bold light-text timeline_title no-margin" style="color:#719FAB;">'+newsObj.name+"</span></a><br/>";
		}
		textHtml="";
		if(newsObj.text.length > 0){
			if(typeof(view) != "undefined" && view == "detail")
				textNews=newsObj.text;
			else
				textNews=checkAndCutLongString(newsObj.text,500,newsObj._id.$id);
			//Check if @mentions return text with link
			if(typeof(newsObj.mentions) != "undefined"){
				actionTitle = "";//getMentionLabel(newsObj)+'<div class="space5"></div><hr/>';
				textNews = addMentionInText(textNews,newsObj.mentions);
			}
			textHtml='<span class="timeline_text no-padding" >'+textNews+'</span>';
		}
		text='<a href="javascript:" id="newsContent'+newsObj._id.$id+'" data-type="textarea" data-pk="'+newsObj._id.$id+'" data-emptytext="Vide" class="editable-news editable-pre-wrapped ditable editable-click newsContent" >'+textHtml+'</a>';
		if("undefined" != typeof newsObj.media){
			if(typeof(newsObj.media.type)=="undefined" || newsObj.media.type=="url_content"){
				if("object" != typeof newsObj.media)
					media="<div class='results'>"+newsObj.media+"</div>";
				else{
					media="<div class='results'>"+getMediaHtml(newsObj.media,"show",newsObj._id.$id)+"</div>";
					//// Fonction générant l'html
				} 
			} else if (newsObj.media.type=="gallery_images"){
				media=getMediaImages(newsObj.media,newsObj._id.$id,newsObj.author.id,newsObj.target.name);
			}
				
		}
	}
	else{
		if(newsObj.object.objectType=="events" || newsObj.object.objectType=="needs"){
			if(newsObj.startDate && newsObj.endDate){
				if(typeof(newsObj.startDate) == "object")
					var startDate = new Date( parseInt(newsObj.startDate.sec)*1000 );
				else
					var startDate = new Date( parseInt(newsObj.startDate)*1000 );
				var startMonth = months[startDate.getMonth()];
				var startDay = (startDate.getDate() < 10) ?  "0"+startDate.getDate() : startDate.getDate();
				if(typeof(newsObj.endDate) == "object")
					var endDate = new Date( parseInt(newsObj.endDate.sec)*1000 );
				else
					var endDate = new Date( parseInt(newsObj.endDate)*1000 );
				var endMonth = months[endDate.getMonth()];
				var endDay = (endDate.getDate() < 10) ?  "0"+endDate.getDate() : endDate.getDate();
			}
			if (newsObj.object.objectType=="needs")
				objectLocality=newsObj.target.address.addressLocality;
			else 
				objectLocality=newsObj.scope.address.addressLocality;
 
			//var hour = (startDate.getHours() < 10) ?  "0"+startDate.getHours() : startDate.getHours();
			//var min = (startDate.getMinutes() < 10) ?  "0"+startDate.getMinutes() : startDate.getMinutes();
			//var dateStr = day + ' ' + month + ' ' + year + ' ' + hour + ':' + min;
			title = '<a '+urlAction.url+' class="col-md-12 col-sm-12 col-xs-12 no-padding">';
			if (typeof(startDay)!="undefined"){
				title += '<div class="col-md-3 col-sm-3 col-xs-3 no-padding center">'+
							'<span class="text-large text-red text-bold light-text timeline_title no-margin">'+startDay+'</span><br/><span class="text-dark light-text timeline_title no-margin">'+startMonth+'</span>'+
						'</div>';
			}
			title += 	'<div class="col-md-9  col-sm-9 col-xs-9 no-padding">'+
							'<span class="text-large text-dark light-text timeline_title no-margin">'+newsObj.name+'</span><br/>';
			if (typeof(startDay)!= "undefined" && typeof(endDay) != "undefined"){	
			title += 		'<span style="color: #8b91a0 !important;"><i class="fa fa-calendar"></i> '+startDay+' '+startMonth+' • '+endDay+' '+endMonth+' • ';
			}
			title += 		'<i class="fa fa-map-marker"></i> '+objectLocality+'</span>'+
						'</div>'+
					'</a>';
		} else{
			title = '<a '+urlAction.url+' class="col-md-12 col-sm-12 col-xs-12 no-padding"><span class="text-large text-dark light-text timeline_title no-margin">'+newsObj.name+'</span></a>';
		}
		if("undefined" != typeof newsObj.text && newsObj.text != ""){
			title += "</br><div class='col-md-12 col-sm-12 col-xs-12 no-padding'>";
			textNews=checkAndCutLongString(newsObj.text,150,newsObj._id.$id);
			text = '<span class="timeline_text no-padding">'+textNews+'</span></div>';
		}
	}
	tags = "", 
	scopes = "",
	tagsClass = "",
	scopeClass = "";
	if( "object" == typeof newsObj.tags && newsObj.tags )
	{
		$.each( newsObj.tags , function(i,tag){
			tagsClass += tag+" ";
			tags += "<span class='label tag_item_map_list'>#"+tag+"</span> ";
			if( $.inArray(tag, contextMap.tags)  == -1 && tag != undefined && tag != "undefined" && tag != "" ){
				contextMap.tags.push(tag);
				tagsFilterListHTML += ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red" data-filter=".'+tag+'"><span class="text-red text-xss">#'+tag+'</span></a>';
			}
		});
		tags = '<div class="pull-left"><i class="fa fa-tags text-red"></i> '+tags+'</div>';
	}

	var author = typeof newsObj.author != "undefined" ? newsObj.author : null;
	if(((author != null && typeof author.address != "undefined") || newsObj.type == "activityStream") && newsObj.scope.type != "restricted" && newsObj.scope.type != "private")
	{
		postalCode = "";
		city = "";
		if(newsObj.type != "activityStream"){
			if(newsObj.target.type=="citoyens"){
				if(typeof(newsObj.scope.cities[0].postalCode) != "undefined")
					postalCode=newsObj.scope.cities[0].postalCode;
				if(typeof(newsObj.scope.cities[0].addressLocality) != "undefined")
					city=newsObj.scope.cities[0].addressLocality;			
			}
			else if(typeof(newsObj.target) != 'undefined' && typeof(newsObj.target.address) != 'undefined'){
				postalCode=newsObj.target.address.postalCode;
				city=newsObj.target.address.addressLocality;			
			}
		}else{
			if (typeof(newsObj.scope.address) != "undefined" && newsObj.scope != null && newsObj.scope.address != null) {
				postalCode=newsObj.scope.address.postalCode;
				city=newsObj.scope.address.addressLocality;		
			}
		}
		
		if( typeof postalCode != "undefined" && postalCode!="")
		{
			scopes += "<span class='label label-danger'>"+postalCode+"</span> ";
			scopeClass += postalCode+" ";
			if( $.inArray(postalCode, contextMap.scopes.codePostal )  == -1){
				contextMap.scopes.codePostal.push(postalCode);
			}
		}
		if( typeof city != "undefined" && city != "")
		{
			scopes += "<span class='label label-danger'>"+city+"</span> ";
			scopeClass += city+" ";
			if( $.inArray(city, contextMap.scopes.addressLocality )  == -1){
				cityFilter=city.replace(/\s/g, "");
				console.log(city);
				contextMap.scopes.addressLocality.push(cityFilter);
				scopesFilterListHTML += ' <a href="javascript:" class="filter btn btn-xs btn-default text-red" data-filter=".'+postalCode+'"><span class="text-red text-xss">'+city+'</span></a>';
			}
		}
		scopes = '<div class="pull-right"><i class="fa fa-circle-o"></i> '+scopes+'</div>';
	}
	var objectDetail = (newsObj.object && newsObj.object.displayName) ? '<div>Name : '+newsObj.object.displayName+'</div>'	 : "";
	var objectLink = (newsObj.object) ? ' <a '+urlAction.url+'>'+iconStr+'</a>' : iconStr;
	// HOST NAME AND REDIRECT URL
	if (newsObj.type=="activityStream" && typeof(newsObj.target) != "undefined" && newsObj.target.id != newsObj.author.id){
		redirectTypeUrl=newsObj.target.type.substring(0,newsObj.target.type.length-1);
		if (newsObj.target.type=="citoyens")
			redirectTypeUrl="person";
		if (newsObj.target.name.length > 25)
			nameAuthor = newsObj.target.name.substr(0,25)+"...";
		else
			nameAuthor = newsObj.target.name;
		urlTarget = 'href="javascript:;" onclick="loadByHash(\'#'+redirectTypeUrl+'.detail.id.'+newsObj.target.id+'\')"';
		var personName = "<a "+urlTarget+" style='color:#3C5665;'>"+nameAuthor+"</a> "+urlAction.titleAction;
	}
	else {
		if(typeof newsObj.author.id != "undefined")
			authorId=newsObj.author.id;
		else
			authorId=newsObj.author._id.$id;
			urlTarget = 'href="javascript:" onclick="loadByHash(\'#person.detail.id.'+authorId+'\')"';
		if (newsObj.author.name.length > 25)
			nameAuthor = newsObj.author.name.substr(0,25)+"...";
		else
			nameAuthor = newsObj.author.name;
		var personName = "<a "+urlTarget+" style='color:#3C5665;'>"+nameAuthor+"</a> "+urlAction.titleAction;
	}
	// END HOST NAME AND REDIRECT URL
	// Created By Or invited by
	/*if(typeof(newsObj.verb) != "undefined" && newsObj.target.id != newsObj.author.id){
		urlAuthor = 'href="javascript:" onclick="openMainPanelFromPanel(\'/person/detail/id/'+newsObj.author.id+'\', \'person : '+newsObj.author.name+'\',\'fa-user\', \''+newsObj.author.id+'\')"';
		authorLine=newsObj.verb+" by <a "+urlAuthor+">"+newsObj.author.name+"</a> "+urlAction.titleAction;
	}
	else 
		authorLine="";*/
	//END OF CREATED BY OR INVITED BY
	var commentCount = 0;
	idVote=newsObj._id['$id'];
	if ("undefined" != typeof newsObj.commentCount) 
		commentCount = newsObj.commentCount;
	vote=voteCheckAction(idVote,newsObj);

	newsTLLine += '<div class="newsFeed '+''+tagsClass+' '+scopeClass+' '+newsObj.type+' ">'+
					'<div class="timeline_element partition-'+color+'">'+
						actionTitle+
						tags+
						manageMenu+
						scopes+
						'<div class="space1"></div>'+ 
						imageBackground+
						'<div class="timeline_author_block">'+
							objectLink+
							'<span class="light-text timeline_author text-bold">'+personName+'</span>'+
							'<div class="timeline_date"><i class="fa fa-clock-o"></i> '+dateStr+'</div>' +					
						'</div>'+
						'<div class="space5"></div>'+
						'<hr/>' + 
						//'<a '+urlAction.url+'>'+
							'<div class="space5"></div>'+
							'<div>'+title + text + "</div>"+media +
						//'</a>'+
						'<div class="space5"></div>';
						 if(idSession){ 
	newsTLLine +=		'<hr>'+
						"<div class='bar_tools_post'>"+
							"<a href='javascript:;' class='newsAddComment' data-count='"+commentCount+"' onclick='showComments(\""+idVote+"\")' data-id='"+idVote+"' data-type='"+newsObj.target.type+"'><span class='label text-dark'><span class='nbNewsComment'>"+commentCount+"</span> <i class='fa fa-comment'></i></span></a> "+
							vote+
						"</div>";
						}
	newsTLLine +=	'</div>'+
				'</div>';
	if(update==true)
		return newsTLLine;
	else{
		// Check offset of last element
		var offsetLastNews = $(".newsFeed").last().position();
		// Append news in timeline
		$(".newsTL").append(newsTLLine);
		if(addForm==true){
			$("#newFeedForm").append($("#formCreateNewsTemp"));
			$("#formCreateNewsTemp").css("display", "inline");
		}
		// Bug on timeline style increment due to the two part
		// Still have few news at the same level (but tempory fixed
		// Check the offset of last .newsFeed and compare
		if(typeof(offsetLastNews) != "undefined"){
			dateLimit=
			minusOff=offsetLastNews.top-10;
			maxOff=offsetLastNews.top+10;
		}
		if(typeof(offsetLastNews) == "undefined" || (minusOff < $(".newsFeed").last().position().top && $(".newsFeed").last().position().top < maxOff)){
			$(".newsFeed").last().css("margin-top","20px");
		}
	}
}

function buildHtmlUrlAndActionObject(obj){
	if(typeof(obj.target) != "undefined" && typeof(obj.target.type) != "undefined")
		redirectTypeUrl=obj.target.type.substring(0,obj.target.type.length-1);
	else 
		redirectTypeUrl="news";

	if(obj.type=="news"){
		url = '';
		// Check media content is gallery image
		if(typeof(obj.media) != "undefined" && typeof(obj.media.type) != "undefined" && obj.media.type=="gallery_images"){
			titleAction = "a ajouté "+obj.media.countImages+" photos";
		}
		else
			titleAction="";
		if((obj.target.type != contextParentType || obj.target.id != obj.author.id) && contextParentId != obj.target.id && (contextParentType !="city" || obj.target.type != "citoyens")){
			if(obj.target.type == "organizations"){
				color="green";
			}else if (obj.target.type == "projects"){
				color="purple";
			}else if (obj.target.type == "citoyens"){
				color="azure";
			}
			else{
				color="orange";
			}
			if(obj.target.type=="pixels"){
				color="black";
				redirectUrl="pixels";
				namePostOn = "Bugs et idées";
			}else{
				if (obj.target.name.length > 25)
					namePostOn = obj.target.name.substr(0,25)+"...";
				else
					namePostOn = obj.target.name;
			}
			titleAction += ' <i class="fa fa-caret-right"></i> <a href="javascript:;" onclick="loadByHash(\'#news.index.type.'+redirectTypeUrl+'s.id.'+obj.target.id+'\')"><span class="text-'+color+'">'+namePostOn+"</span></a>";
		} else {
			if(typeof(obj.text) != "undefined" && obj.text.length == 0 && obj.media.length)
				titleAction += "a partagé un lien";
			else 
				titleAction += "";
		}
	}
	else{
		if(obj.object.objectType =="citoyens"){
			redirectTypeUrl="person";
			id=obj.object.id;
			urlParent="";
		} 
		else if(obj.object.objectType =="organizations"){
			redirectTypeUrl="organization";
			id=obj.object.id;
			urlParent="";
			titleAction = "a créé une organisation";
		} 
		else if(obj.object.objectType =="events"){
			redirectTypeUrl="event";
			id=obj.object.id;
			urlParent="";
			titleAction = "a posté un évènement";
		} 
		else if(obj.object.objectType =="projects"){
			redirectTypeUrl="project";
			id=obj.object.id;
			urlParent="";
			titleAction = "a créé un projet";
		}
		else if(obj.object.objectType =="needs"){
			redirectTypeUrl="need";
			id=obj.object.id;
			urlParent="";
			titleAction = "a créé un besoin";
		}

		url = 'href="javascript:;" onclick="loadByHash(\'#'+redirectTypeUrl+'.detail.id.'+id+'\')"';
	}
	object=new Object;
	object.url= url,
	object.titleAction= titleAction;
	return object; 
}
function builHtmlAuthorImageObject(obj){
	if(typeof(obj.icon) != "undefined"){
		icon = "fa-" + Sig.getIcoByType({type : obj.type});
		var colorIcon = Sig.getIcoColorByType({type : obj.object.objectType});
		if (icon == "fa-circle")
			icon = obj.icon;
	}else{ 
		icon = "fa-rss";
		colorIcon="blue";
	}
	var flag = '<div class="ico-type-account"><i class="fa '+icon+' fa-'+colorIcon+'"></i></div>';	
	// IMAGE AND FLAG POST BY - TARGET IF PROJECT AND EVENT - AUTHOR IF ORGA
	if(obj.type == "activityStream" && typeof(obj.target) != "undefined" && obj.target.type != "citoyens"){
		if(obj.target.type=="projects")
			var iconBlank="fa-lightbulb-o";
		else if (obj.target.type=="organizations")
			var iconBlank="fa-group";
		if(typeof obj.target.profilThumbImageUrl !== "undefined" && obj.target.profilThumbImageUrl != ""){ 
			imgProfilPath = obj.target.profilThumbImageUrl;
		var iconStr = "<div class='thumbnail-profil'><img height=50 width=50 src='" +baseUrl+ imgProfilPath + "'></div>" + flag ; 
		}else {
			var iconStr = "<div class='thumbnail-profil text-center text-white' style='overflow:hidden;text-shadow: 2px 2px grey;'><i class='fa "+iconBlank+"' style='font-size:50px;'></i></div>"+flag;
		}
	}else{
			var imgProfilPath =  assetPath+"/images/news/profile_default_l.png";
			if((contextParentType == "projects" || contextParentType == "organizations") && typeof(obj.verb) != "undefined"){
				if(typeof obj.target.profilThumbImageUrl != "undefined" && obj.target.profilThumbImageUrl != ""){ 
					imgProfilPath = obj.target.profilThumbImageUrl;
					var iconStr = "<div class='thumbnail-profil'><img height=50 width=50 src='" + baseUrl + imgProfilPath + "'></div>" + flag ; 
				}else {
					if(obj.object.objectType=="organizations")
						var iconStr = "<div class='thumbnail-profil text-center' style='overflow:hidden;'><i class='fa fa-group' style='font-size:50px;'></i></div>"+flag;
					else
						var iconStr = "<div class='thumbnail-profil'><img height=50 width=50 src='" + imgProfilPath + "'></div>" + flag ; 

				}
			}
			else{	
				if(typeof obj.author.profilThumbImageUrl !== "undefined" && obj.author.profilThumbImageUrl != ""){
					imgProfilPath = baseUrl + obj.author.profilThumbImageUrl;
				}
				var iconStr = "<div class='thumbnail-profil'><img height=50 width=50 src='"+ imgProfilPath + "'></div>" + flag ;	 
			}
	}
	return iconStr;
}
function actionOnNews(news,action,method,reason, comment) {
	type="news";
	params=new Object,
	params.id=news.data("id"),
	params.collection=type,
	params.action=action;
	if(reason != ""){
		params.reason=reason;
	}
	if(comment != ""){
		params.comment=comment;
	}
	if(method){
		params.unset=method;
	}
	console.log(params);
	$.ajax({
		url: baseUrl+'/'+moduleId+"/action/addaction/",
		data: params,
		type: 'post',
		global: false,
		dataType: 'json',
		success: 
			function(data) {
    			if(!data.result){
                    toastr.error(data.msg);
               	}
                else { 
                    if (data.userAllreadyDidAction) {
                    	toastr.info(data.msg);
                    } else {
						count = parseInt(news.data("count"));
						if(action=="reportAbuse"){
							toastr.success(trad["thanktosignalabuse"]);

							//to hide menu
							$(".newsReport[data-id="+params.id+"]").hide();
						}
						else{
		                    if(count < count+data.inc)
		                    	toastr.success(trad["voteaddedsuccess"]);
		                    else
								toastr.success(trad["voteremovedsuccess"]);	 
						}                   
						news.data( "count" , count+data.inc );
						icon = news.children(".label").children(".fa").attr("class");
						news.children(".label").html(news.data("count")+" <i class='"+icon+"'></i>");
					}
                }
            },
        error: 
        	function(data) {
        		toastr.error("Error calling the serveur : contact your administrator.");
        	}
	});
}

function voteCheckAction(idVote, newsObj) {
	var voteUpCount = reportAbuseCount = voteDownCount = 0;
	textUp="text-dark";
	textDown="text-dark";
	textReportAbuse="text-dark";

	if ("undefined" != typeof newsObj.voteUp && "undefined" != typeof newsObj.voteUpCount && newsObj.voteUpCount > 0){ 
		voteUpCount = newsObj.voteUpCount;
		if ("undefined" != typeof newsObj.voteUp[idSession]){
			textUp= "text-green";
			$(".newsVoteDown[data-id="+idVote+"]").off();
		}
	}

	if ("undefined" != typeof newsObj.voteDown && "undefined" != typeof newsObj.voteDownCount && newsObj.voteDownCount > 0) {
		voteDownCount = newsObj.voteDownCount;
		if ("undefined" != typeof newsObj.voteDown[idSession]){
			textDown= "text-orange";
			$(".newsVoteUp[data-id="+idVote+"]").off();
		}
	}

	if ("undefined" != typeof newsObj.reportAbuse && "undefined" != typeof newsObj.reportAbuseCount && newsObj.reportAbuseCount > 0) {
		reportAbuseCount = newsObj.reportAbuseCount;
		if ("undefined" != typeof newsObj.reportAbuse[idSession]){
			textReportAbuse= "text-red";
			$(".newsReportAbuse[data-id="+idVote+"]").off();
		}
	}
	voteHtml = "<a href='javascript:;' class='newsVoteUp' onclick='newsVoteUp(this, \""+idVote+"\")' data-count='"+voteUpCount+"' data-id='"+idVote+"' data-type='"+newsObj.target.type+"'><span class='label "+textUp+"'>"+voteUpCount+" <i class='fa fa-thumbs-up'></i></span></a> "+
			"<a href='javascript:;' class='newsVoteDown' onclick='newsVoteDown(this, \""+idVote+"\")' data-count='"+voteDownCount+"' data-id='"+idVote+"' data-type='"+newsObj.target.type+"'><span class='label "+textDown+"'>"+voteDownCount+" <i class='fa fa-thumbs-down'></i></span></a>"+
			"<a href='javascript:;' class='newsReportAbuse' onclick='newsReportAbuse(this, \""+idVote+"\")' data-count='"+reportAbuseCount+"' data-id='"+idVote+"' data-type='"+newsObj.target.type+"'><span class='label "+textReportAbuse+"'>"+reportAbuseCount+" <i class='fa fa-flag'></i></span></a>";
	return voteHtml;
}

function manageModeContext(id) {
	listXeditables = ['#newsContent'+id, '#newsTitle'+id];
	if (mode == "view") {
		//$('.editable-project').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			$(value).editable('toggleDisabled');
		});
		//$("#btn-update-geopos").removeClass("hidden");
	} else if (mode == "update") {
		// Add a pk to make the update process available on X-Editable
		$('.editable-news').editable('option', 'pk', id);
		$.each(listXeditables, function(i,value) {
			$(value).editable('option', 'pk', id);
			$(value).editable('toggleDisabled');
		});
	}
}

function initXEditable() {
	$.fn.editable.defaults.mode = 'inline';
	$('.editable-news').editable({
    	url: baseUrl+"/"+moduleId+"/news/updatefield", //this url will not be used for creating new job, it is only for update
    	textarea: {
			html: true,
			video: true,
			image: true
		},
    	showbuttons: 'bottom',
    	success : function(data) {
	        if(data.result) {
	        	toastr.success(data.msg);
				console.log(data);
	        }
	        else{
	        	toastr.error(data.msg);  
	        }
	    }
	});
    //make jobTitle required
	$('.newsTitle').editable('option', 'validate', function(v) {
    	if(!v) return 'Required field!';
	});

	$('.newsContent').editable({
		url: baseUrl+"/"+moduleId+"/news/updatefield", 
		showbuttons: 'bottom',
		wysihtml5: {
			html: true,
			video: true,
			image: true
		},
		success : function(data) {
	        if(data.result) 
	        	toastr.success(data.msg);
	        else
	        	toastr.error(data.msg);  
	    },
	});
}
function checkAndCutLongString(text,limitLength,idNews){
	if(text.length > limitLength){
		text=text.substring(0,limitLength);
		if(limitLength==500){
			text += "<span class='removeReadNews'> ...<br><a href='javascript:;' onclick='blankNews(\""+idNews+"\")'>Lire la suite</a></span>";
		}else{
			text += " ..."
		}
	}
	return text;
}
function showComments(id){
	$.blockUI({
			message : '<div class="commentContent"><h2 class="homestead text-dark" style="padding:40px;"><i class="fa fa-spin fa-refresh"></i> Chargement des commentaires ...</h2></div>', 
			onOverlayClick: $.unblockUI,
			css: {"text-align": "left", "cursor":"default"}
		});
		getAjax('.commentContent',baseUrl+'/'+moduleId+"/comment/index/type/news/id/"+id,function(){ 
		},"html");
}
function newsVoteUp($this, id){
	if($(".newsVoteDown[data-id='"+id+"']").children(".label").hasClass("text-orange"))
			toastr.info(trad["removeopinionbefore"]);
	else{	
		//toastr.info('This vote has been well registred');
		if($($this).children(".label").hasClass("text-green")){
			method = true;
		}
		else{
			method = false;
		}
		actionOnNews($($this),'voteUp',method);
		disableOtherNewsAction($($this), '.newsVoteUp', method);
		count = parseInt($($this).data("count"));
		$($this).children(".label").html($($this).data("count")+" <i class='fa fa-thumbs-up'></i>");
	}
}
function newsVoteDown($this, id){
	if($(".newsVoteUp[data-id='"+$($this).data("id")+"']").children(".label").hasClass("text-green"))
			toastr.info(trad["removeopinionbefore"]);
	else{	
	//toastr.info('This vote has been well registred');
		if($($this).children(".label").hasClass("text-orange")){
			method = true;
		}
		else{
			method = false;
		}
		actionOnNews($($this),'voteDown',method);
		disableOtherNewsAction($($this), '.newsVoteDown', method);
		$($this).children(".label").html($($this).data("count")+" <i class='fa fa-thumbs-down'></i>");
	}
}
function newsReportAbuse($this, id){
	
	//toastr.info('This vote has been well registred');
	if($($this).children(".label").hasClass("text-red")){
		method = true;
	}
	else{
		method = false;
	}
	reportNewsAbuse($($this),'reportAbuse',method);
	
	
	//disableOtherAction($($this), '.commentReportAbuse', method);
	$($this).children(".label").html($($this).data("count")+" <i class='fa fa-flag'></i>");
}

function reportNewsAbuse($this,action, method) {
	// console.log(contextId);
	if (method){
		toastr.info(trad["alreadyreportedabuse"]+" !");
	}
	else{
		var message = "<div id='reason' class='radio'>"+
			"<label><input type='radio' name='reason' value='Propos malveillants' checked>Propos malveillants</label><br>"+
			"<label><input type='radio' name='reason' value='Incitation et glorification des conduites agressives'>Incitation et glorification des conduites agressives</label><br>"+
			"<label><input type='radio' name='reason' value='Affichage de contenu gore et trash'>Affichage de contenu gore et trash</label><br>"+
			"<label><input type='radio' name='reason' value='Contenu pornographique'>Contenu pornographique</label><br>"+
		  	"<label><input type='radio' name='reason' value='Liens fallacieux ou frauduleux'>Liens fallacieux ou frauduleux</label><br>"+
		  	"<label><input type='radio' name='reason' value='Mention de source erronée'>Mention de source erronée</label><br>"+
		  	"<label><input type='radio' name='reason' value='Violations des droits auteur'>Violations des droits d\'auteur</label><br>"+
		  	"<input type='text' class='form-control' id='reasonComment' placeholder='Laisser un commentaire...'/><br>"+
			"</div>";
		var boxNews = bootbox.dialog({
		  message: message,
		  title: trad["askreasonreportabuse"],
		  buttons: {
		  	annuler: {
		      label: "Annuler",
		      className: "btn-default",
		      callback: function() {
		        console.log("Annuler");
		      }
		    },
		    danger: {
		      label: "Déclarer cet abus",
		      className: "btn-primary",
		      callback: function() {
		      	// var reason = $('#reason').val();
		      	var reason = $("#reason input[type='radio']:checked").val();
		      	var reasonComment = $("#reasonComment").val();
		      	actionOnNews($($this),action,method, reason, reasonComment);
		      	$this.children(".label").removeClass("text-dark").addClass("text-red");
		      }
		    },
		  }
		});
		boxNews.on("shown.bs.modal", function() {
			$.unblockUI();
		});
	}
}

function disableOtherNewsAction($this,action,method){
	if(method){
		if (action == ".newsVoteUp")
			$this.children(".label").removeClass("text-green").addClass("text-dark");
		if (action == ".newsVoteDown")
			$this.children(".label").removeClass("text-orange").addClass("text-dark");
		//if (action == ".commentReportAbuse")
		//	$this.children(".label").removeClass("text-red").addClass("text-dark");
	}
	else{
		if (action == ".newsVoteUp")
			$this.children(".label").removeClass("text-dark").addClass("text-green");
		if (action == ".newsVoteDown")
			$this.children(".label").removeClass("text-dark").addClass("text-orange");
		//if (action == ".commentReportAbuse")
		//	$this.children(".label").removeClass("text-dark").addClass("text-red");
	}
}
function blankNews(id){
/*	$.blockUI({
			message : '<div class="newsContent"><h2 class="homestead text-dark" style="padding:40px;"><i class="fa fa-spin fa-refresh"></i> Chargement de l\'actualité ...</h2></div>', 
			onOverlayClick: $.unblockUI,
			css: {"text-align": "left", "cursor":"default"}
		});
		getAjax('.newsContent',baseUrl+'/'+moduleId+"/news/detail/id/"+id,function(){ 
		},"html");*/
	window.open(baseUrl+'/#news.detail.id.'+id,'_blank');
}
function getMentionLabel(news){
	countMentions = news.mentions.length;
	target="";
	mentionMe=false;
	$.each(news.mentions, function( index, value ){
		if(value.id == idSession){
			target = news.author.name+" vous a cité dans sa publication";
			mentionMe=true;
		}
		if(value.id == contextParentId && value.id != idSession){
			target = news.author.name+" a mentionné "+value.name+" dans son post";
			
		}	
		if(typeof(parent.links.memberOf) != "undefined" && typeof(parent.links.memberOf[value["id"]]) != "undefined"){
			if(mentionMe)
				target = news.author.name+" vous a mentionné avec "+value.name+" dans son post";
			else
				target = news.author.name+" a mentionné "+value.name+" dans son post";	
		}
	});
	return target;
}
function addMentionInText(textNews,mentions){
	$.each(mentions, function( index, value ){
   		array = textNews.split(value.value);
   		console.log(array);
   		if(value.type == "organizations")
   			controler = "organization";
   		else
   			controler = "person"; 
   		textNews=array[0]+
   					"<span onclick='loadByHash(\"#"+controler+".detail.id."+value.id+"\")' onmouseover='$(this).addClass(\"text-blue\");this.style.cursor=\"pointer\";' onmouseout='$(this).removeClass(\"text-blue\");' style='color: #719FAB;'>"+
   						value.name+
   					"</span>"+
   				array[1];
   					
	});
	return textNews;
}
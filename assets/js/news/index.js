
/*
* function loadStream() loads news for timeline: 5 news are download foreach call
* @param string contextParentType indicates type of wall news
* @param string contextParentId indicates the precise parent id 
* @param strotime dateLimite indicates the date to load news
*/
var loadStream = function(indexMin, indexMax){
	loadingData = true;
    indexStep = 5;
    if(typeof indexMin == "undefined") indexMin = 0;
    if(typeof indexMax == "undefined") indexMax = indexStep;

    currentIndexMin = indexMin;
    currentIndexMax = indexMax;
    if(indexMin == 0 && indexMax == indexStep) {
      totalData = 0;
      mapElements = new Array(); 
    }
    else{ if(scrollEnd) return; }
    if(viewer != "")
    	simpleUserData="/viewer/"+viewer;
    else
    	simpleUserData="";
    filter = new Object;
    filter.parent=parent;
    if (typeof(locality) != "undefined")
	    filter.locality=locality;
    if (typeof(searchBy) != "undefined")
	    filter.searchBy=searchBy;
	if (typeof(searchType) != "undefined")
	    filter.searchType=searchType;

	if (typeof(tagSearch) != "undefined")
	    filter.tagSearch=tagSearch;
    if(typeof(dateLimit)!="undefined"){
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/news/index/type/"+contextParentType+"/id/"+contextParentId+"/date/"+dateLimit+simpleUserData,
	       	dataType: "json",
	       	data: filter,
	    	success: function(data){
		    	console.log("LOAD NEWS BY AJAX");
		    	console.log(data.news);
		    	if(data){
					buildTimeLine (data.news, indexMin, indexMax);
					if(typeof(data.limitDate.created) == "object")
						dateLimit=data.limitDate.created.sec;
					else
						dateLimit=data.limitDate.created;
				}
				loadingData = false;
			},
			error: function(){
				loadingData = false;
			}
		});
	}
}

var tagsFilterListHTML = "";
var scopesFilterListHTML = "";
function buildTimeLine (news, indexMin, indexMax)
{
	if (dateLimit==0){
		$(".newsTL").html('<div class="spine"></div>');
	}
	//insertion du formulaire CreateNews dans le stream
	var formCreateNews = $("#formCreateNewsTemp");
	//currentMonth = null;
	var countEntries = 0;
	$.each(news, function(i, v) { if(v.length!=0){ countEntries++; } });
	
	totalEntries += countEntries;
	
	str = "";
	//console.log(news);
	$.each( news , function(key,newsObj)
	{
		if(newsObj.created)
		{
			if(typeof(newsObj.created) == "object")
				var date = new Date( parseInt(newsObj.created.sec)*1000 );
			else
				var date = new Date( parseInt(newsObj.created)*1000 );
			var d = new Date();
			if(typeof(newsObj.target)!="undefined" && typeof(newsObj.target.type)!="undefined")
				buildLineHTML(newsObj, idSession);
		}
	});
	
	//if(canPostNews==true){
	//	$("#newFeedForm").append(formCreateNews);
	//	$("#formCreateNewsTemp").css("display", "inline");
	//}
	/*offsetLastNews="";
	$i=0;
	$( ".newsFeed:gt(-6)" ).each(function(){
		if($i!=0){
			if(typeof(offsetLastNews)!="undefined" && typeof(offsetLastNews.top)!="undefined")
			console.log(offsetLastNews.top+" // VS // "+$(this).offset().top);
			if($(this).offset().top == offsetLastNews.top){
				$(this).css("margin-top","20px");
			}
		}
		offsetLastNews=$(this).offset();
		//alert();
	})*/
	$.each( news , function(key,o){
		initXEditable();
		manageModeContext(key);
	});
	//offset=$('.newsTL'+' .newsFeed:last').offset(); 
	if( tagsFilterListHTML != "" )
		$("#tagFilters").html(tagsFilterListHTML);
	if( scopesFilterListHTML != "" )
		$("#scopeFilters").html(scopesFilterListHTML);

	if(!countEntries || countEntries < indexStep){
		if( dateLimit == 0 && countEntries == 0){
			var date = new Date(); 
			form ="";
			if(canPostNews==true){
				form = "<div class='newsFeed'>"+
						"<div id='newFeedForm"+"' class='timeline_element partition-white no-padding' style='min-width:85%;'></div>"+
					"</div>";
				msg = "Aucune activité.<br/>Soyez le premier à publier ici";
			}
			else{
				msg = "Aucune activité.<br/>Participez à l'activité de ce fil d'actualité<br/>En devenant membre ou contributeur";
			}
			newsTLLine = '<div class="date_separator" id="'+'month'+date.getMonth()+date.getFullYear()+'" data-appear-top-offset="-400">'+
						'<span>'+months[date.getMonth()]+' '+date.getFullYear()+'</span>'+
					'</div>'+form+"<div class='col-md-5 col-sm-5 col-xs-12 text-extra-large emptyNews"+"'><i class='fa fa-ban'></i> "+msg+".</div>";
		
			$(".spine").css("bottom","0px");
			$(".tagFilter, .scopeFilter").hide();
			
			$(".newsTL").append(newsTLLine);
			if(canPostNews==true){
				$("#newFeedForm").append(formCreateNews);
				$("#formCreateNewsTemp").css("display", "inline");
			}
		}
		else {
			if($("#backToTop").length <= 0){
				//$('.first')
				titleHTML = '<div class="date_separator" id="backToTop" data-appear-top-offset="-400" style="height:150px;">'+
						'<a href="javascript:;" onclick="smoothScroll(\'0px\');" title="retour en haut de page">'+
							'<span style="height:inherit;" class="homestead"><i class="fa fa-ban"></i> ' + trad["nomorenews"] + '<br/><i class="fa fa-arrow-circle-o-up fa-2x"></i> </span>'+
						'</a>'+
					'</div>';
					$(".newsTL").append(titleHTML);
					$(".spine").css('bottom',"0px");
			}
		}
			$(".stream-processing").hide();
	}
	
	bindEvent();
	//Unblock message when click to change type stream
	if (dateLimit==0)
		setTimeout(function(){$.unblockUI()},1);
}


function bindEvent(){
	var separator, anchor;
	$("#get_url").elastic();
	
	$(".scopeShare").click(function() {
		console.log(this);
		replaceText=$(this).find("h4").html();
		$("#btn-toogle-dropdown-scope").html(replaceText+' <i class="fa fa-caret-down" style="font-size:inherit;"></i>');
		scopeChange=$(this).data("value");
		$("input[name='scope']").val(scopeChange);
	});

	$(".date_separator").appear().on('appear', function(event, $all_appeared_elements) {
		separator = '#' + $(this).attr("id");
		$('.timeline-scrubber').find("li").removeClass("selected").find("a[href = '" + separator + "']").parent().addClass("selected");
	}).on('disappear', function(event, $all_disappeared_elements) {   				
		separator = $(this).attr("id");
		$('.timeline-scrubber').find("a").find("a[href = '" + separator + "']").parent().removeClass("selected");
	});
	$('.newsShare').off().on("click",function(){
		toastr.info('TODO : SHARE this news Entry');
		console.log("newsShare",$(this).data("id"));
		count = parseInt($(this).data("count"));
		$(this).data( "count" , count+1 );
		$(this).children(".label").html($(this).data("count")+" <i class='fa fa-share-alt'></i>");
	});

	$('.filter').off().on("click",function(){
	 	if($(this).data("filter") == ".news" || $(this).data("filter")==".activityStream"){
		 	htmlMessage = '<div class="title-processing homestead"><i class="fa fa-circle-o-notch fa-spin"></i></div>';
		 	htmlMessage +=	'<a class="thumb-info" href="'+proverbs[rand]+'" data-title="Proverbs, Culture, Art, Thoughts"  data-lightbox="all">'+
			 		'<img src="'+proverbs[rand]+'" style="border:0px solid #666; border-radius:3px;"/></a><br/><br/>';
			
			console.log(newsReferror);
			if(dateLimit==0){
				$.blockUI({message : htmlMessage});
				loadStream();
			}
			
			if ($("#backToTop"+streamType).length > 0 || $(".emptyNews"+streamType).length > 0){
				if($("#backToTop"+streamType).length > 0){
					$(".tagFilter, .scopeFilter").show();
				}
				else{
					$(".tagFilter, .scopeFilter").hide();
				}
				$(".stream-processing").hide();	
			}
			else{
				$(".stream-processing").show();	
			}
		}
		else{
			console.warn("filter",$(this).data("filter"));
			filter = $(this).data("filter");
			$(".newsFeed").hide();
			$(filter).show();
		}
	});

	$(".form-create-news-container #name").focus(function(){
		showFormBlock(true);	
	});
	
	$(".videoSignal").click(function(){
		videoLink = $(this).find(".videoLink").val();
		iframe='<div class="embed-responsive embed-responsive-16by9">'+
			'<iframe src="'+videoLink+'" width="100%" height="" class="embed-responsive-item"></iframe></div>';
		$(this).parent().next().before(iframe);
		$(this).parent().remove();
	});
}

function smoothScroll(scroolTo){
	$(".my-main-container").scrollTo(scroolTo,500,{over:-0.6});
}

function modifyNews(id){
	switchModeEdit(id);
}
function deleteNews(id, $this){
	//var $this=$(this);
	bootbox.confirm(trad["suretodeletenews"], 
		function(result) {
			if (result) {
				if ($(".deleteImageIdName"+id).length){
					$(".deleteImageIdName"+id).each(function(){
						deleteInfo=$(this).val().split("|");
						deleteImage(deleteInfo[0],deleteInfo[1],true);
						
					});
				}
				if ($("#deleteImageCommunevent"+id).length){
						imageId=$("#deleteImageCommunevent"+id).val();
						deleteImage(imageId,"",true,true);
				}

				$.ajax({
			        type: "POST",
			        url: baseUrl+"/"+moduleId+"/news/delete/id/"+id,
					dataType: "json",
					//data: {"newsId": idNews},
		        	success: function(data){
			        	if (data) {               
							toastr.success(trad["successdeletenews"] + "!!");
							liParent=$this.parents().eq(4);
							if (typeof(offset) != "undefined")
								offset.top = offset.top-liParent.height();
				        	liParent.fadeOut();
				        	
						} else {
				            toastr.error(trad["somethingwrong"] + " " + trad["tryagain"]);
				        }
				    }
				});
			}
		}
	)
}

function switchModeEdit(idNews){
	//alert(mode);
	if(mode == "view"){
		mode = "update";
		manageModeContext(idNews);
	} else {
		mode ="view";
		manageModeContext(idNews);
	}
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
    	emptytext: 'Empty',
    	textarea: {
			html: true,
			video: true,
			image: true
		},
    	showbuttons: 'bottom',
    	success : function(data) {
	        if(data.result) {
	        	toastr.success(data.msg);

	        	//$('.editable-news').editable('toggleDisabled');
				switchModeEdit(data.id);
				console.log(data);
				console.log("ici");
				//$("a[data-id='"+data.id+"']").trigger('click');
	        }
	        else{
	        	toastr.error(data.msg);  
	        }
	    }
	});
   
	$('.newsContent').editable({
		url: baseUrl+"/"+moduleId+"/news/updatefield", 
		emptytext: 'Vide',
		showbuttons: 'bottom',
		wysihtml5: {
			html: true,
			video: true,
			image: true
		},
		width:100,
		showbuttons: 'bottom',
		success : function(data) {
	        if(data.result) {
		       // $('.newsContent').editable('toggleDisabled');
		       	switchModeEdit(data.id);
	        	toastr.success(data.msg);
	        	console.log(data);
	        	}
	        else
	        	toastr.error(data.msg);  
	    },
	});


}

function updateNews(newsObj)
{
	var date = new Date( parseInt(newsObj.created.sec)*1000 );
	if(newsObj.date.sec && newsObj.date.sec != newsObj.created.sec) {
		date = new Date( parseInt(newsObj.date.sec)*1000 );
	}
	var newsTLLine = buildLineHTML(newsObj,idSession,true);
	$(".emptyNews").remove();
	$("#newFeedForm").parent().after(newsTLLine).fadeIn();
	$("#newFeedForm").parent().next().css("margin-top","20px");
	manageModeContext(newsObj._id.$id);
	$("#form-news #get_url").val("");
	$('textarea.mention').mentionsInput('reset');
	$("#form-news #results").html("").hide();
	$("#form-news #tags").select2('val', "");
	showFormBlock(false);
	$('.tooltips').tooltip();
	bindEvent();
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

function toggleFilters(what){
 	if( !$(what).is(":visible") )
 		$('.optionFilter').hide();
 	$(what).slideToggle();
 }
/*
* Save news and url generate
*
*
*
*
*
*/
function showFormBlock(bool){
	if(bool){
		$(".form-create-news-container #text").show("fast");
		//$(".form-create-news-container .tagstags").show("fast");
		$(".form-create-news-container .datedate").show("fast");
		//$(".form-create-news-container .form-actions").show("fast");
		$(".form-create-news-container .publiccheckbox").show("fast");
		//if($("input#public").prop('checked') != true)
		//$(".form-create-news-container .scopescope").show("fast");	
	}else{
		$(".form-create-news-container #text").hide();
		//$(".form-create-news-container .tagstags").hide();
		$(".form-create-news-container .datedate").hide();
		//$(".form-create-news-container .form-actions").hide();
		//$(".form-create-news-container .scopescope").hide();
		$(".form-create-news-container .publiccheckbox").hide();
	}
}

function getUrlContent(){
    //user clicks previous thumbail
    $("body").on("click","#thumb_prev", function(e){        
        if(img_arr_pos>0) 
        {
            img_arr_pos--; //thmubnail array position decrement
            
            //replace with new thumbnail
            $("#extracted_thumb").html('<img src="'+extracted_images[img_arr_pos]+'" width="100" height="100">'+selectThumb);
            
            //replace thmubnail position text
            $("#total_imgs").html((img_arr_pos) +' of '+ total_images);
        }
    });
    
    //user clicks next thumbail
    $("body").on("click","#thumb_next", function(e){        
        if(img_arr_pos<total_images)
        {
            img_arr_pos++; //thmubnail array position increment
            
            //replace with new thumbnail
            $("#extracted_thumb").html('<img src="'+extracted_images[img_arr_pos]+'" width="100" height="100">'+selectThumb);
            
            //replace thmubnail position text
            $("#total_imgs").html((img_arr_pos) +' of '+ total_images);
        }
    });
    var getUrl  = $('#get_url'); //url to extract from text field
    getUrl.keyup(function() { //user types url in text field        
        //url to match in the text field
        var match_url = /\b(https?):\/\/([\-A-Z0-9. \-]+)(\/[\-A-Z0-9+&@#\/%=~_|!:,.;\-]*)?(\?[A-Z0-9+&@#\/%=~_|!:,.;\-]*)?/i;
        //continue if matched url is found in text field
//        if(!$(".lastUrl").attr("href") || $(".lastUrl").attr("href"))
        if (match_url.test(getUrl.val())) {
	        if(lastUrl != getUrl.val().match(match_url)[0]){
	        	var extracted_url = getUrl.val().match(match_url)[0]; //extracted first url from text filed
                $("#results").hide();
                $("#loading_indicator").show(); //show loading indicator image
                //ajax request to be sent to extract-process.php
                //alert(extracted_url);
                lastUrl=extracted_url;
                $.ajax({
					url: baseUrl+'/'+moduleId+"/news/extractprocess",
					data: {
					'url': extracted_url},
					type: 'post',
					dataType: 'json',
					success: function(data){        
		                console.log(data); 
	                    content = getMediaHtml(data,"save");
	                    //load results in the element
	                    $("#results").html(content); //append received data into the element
	                    $("#results").slideDown(); //show results with slide down effect
	                    $("#loading_indicator").hide(); //hide loading indicator image
                	},
					error : function(){
						$.unblockUI();
						//toastr.error(trad["wrongwithurl"] + " !");
						//content to be loaded in #results element
						var content = '<h4><a href="'+extracted_url+'" target="_blank" class="lastUrl">'+extracted_url+'</a></h4>';
	                    //load results in the element
	                    $("#results").html(content); //append received data into the element
	                    $("#results").slideDown(); //show results with slide down effect
	                    $("#loading_indicator").hide(); //hide loading indicator image
						$("#loading_indicator").hide();
					}	
                });
			}
        }
    }); /*.keydown(function( event ) {
		if ( event.which == 192 ) {
			peopleReference=true;
  		}
  		if(peopleReference == true){
	  		allValue=getUrl.val();
	  		search=allValue.split("@").pop();
	  		var data = {"search" : search,"searchMode":"personOnly"};
	  		$.ajax({
				type: "POST",
		        url: baseUrl+"/"+moduleId+"/search/searchmemberautocomplete",
		        data: data,
		        dataType: "json",
		        success: function(data){
		        	if(!data){
		        		toastr.error(data.content);
		        	}else{
		        		
						str = "";
						console.log(data);
						if(data.citoyens.length != 0){
							$("#dropdown_search").show();
				 			$.each(data, function(key, value) {
				 				
				 				$.each(value, function(i, v){
				 					var imageSearch = '<i class="fa fa-user fa-2x"></i>';
				 					var logoSearch = "";
				 					console.log(v);
				 					if("undefined" != typeof v.profilThumbImageUrl && v.profilThumbImageUrl!=""){
				 						var imageSearch = '<img alt="image" class="" src="'+baseUrl+v.profilThumbImageUrl+'" style="height:25px;padding-right:5px;"/>'
				 					}
				  					str += '<li class="li-dropdown-scope"><a href="javascript:setReferenceInNews(\''+v.id+'\',\''+v.name+'\',\''+v.email+'\',\''+key+'\')">'+imageSearch+' '+v.name +'</a></li>';
				  				});
				  			}); 
				  			$("#dropdown_search").html(str);
				  		} else{
					  		$("#dropdown_search").hide();
		        		peopleReference=false;

				  		}
		  			}
				}	
			})*/
	  		/*getUrl.select2({
				  ajax: {
				    url: "https://api.github.com/search/repositories",
				    dataType: 'json',
				    delay: 250,
				    data: search
				    },
				    processResults: function (data, params) {
				      // parse the results into the format expected by Select2
				      // since we are using custom formatting functions we do not need to
				      // alter the remote JSON data, except to indicate that infinite
				      // scrolling can be used
				      params.page = params.page || 1;
				
				      return {
				        results: data.items,
				        pagination: {
				          more: (params.page * 30) < data.total_count
				        }
				      };
				    },
				    cache: true
				  },
				  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
				  minimumInputLength: 1,
				  templateResult: formatRepo, // omitted for brevity, see the source of this page
				  templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
				});*/
  		//}
  	//});
}
function getMediaHtml(data,action,idNews){
	if(typeof(data.images)!="undefined"){
		extracted_images = data.images;
		total_images = parseInt(data.images.length);
		img_arr_pos=1;
    }
    inputToSave="";
    if(typeof(data.content) !="undefined" && typeof(data.content.imageSize) != "undefined"){
        if (data.content.videoLink){
            extractClass="extracted_thumb";
            width="100";
            height="100";

            aVideo='<a href="#" class="videoSignal text-white center"><i class="fa fa-3x fa-play-circle-o"></i><input type="hidden" class="videoLink" value="'+data.content.videoLink+'"/></a>';
            inputToSave+="<input type='hidden' class='video_link_value' value='"+data.content.videoLink+"'/>"+
            "<input type='hidden' class='media_type' value='video_link' />";   
		}
        else{
            aVideo="";
            endAVideo="";
            if(data.content.imageSize =="large"){
                extractClass="extracted_thumb_large";
                width="100%";
                height="";
            }
            else{
                extractClass="extracted_thumb";
                width="100";
                height="100";
            }
            inputToSave+="<input type='hidden' class='media_type' value='img_link' />";
		}
		inputToSave+="<input type='hidden' class='size_img' value='"+data.content.imageSize+"'/>"
    }
    if (typeof(data.content) !="undefined" && typeof(data.content.image)!="undefined"){
        inc_image = '<div class="'+extractClass+'" id="extracted_thumb">'+aVideo;
        if(data.content.type=="img_link"){
	        if(typeof(data.content.imageId) != "undefined"){
		       inc_image += "<input type='hidden' id='deleteImageCommunevent"+idNews+"' value='"+data.content.imageId+"'/>";
		       titleImg = "De l&apos;application communevent"; 
		    }else
		    	titleImg = "Image partagée"; 
	        inc_image += "<a class='thumb-info' href='"+data.content.image+"' data-title='"+titleImg+"'  data-lightbox='allimgcontent'>";
	    }
        inc_image +='<img src="'+data.content.image+'" width="'+width+'" height="'+height+'">';
        if(data.content.type=="img_link")
        	inc_image += '</a>';
        inc_image += '</div>';
        countThumbail="";
        inputToSave+="<input type='hidden' class='img_link' value='"+data.content.image+"'/>";
    }
    else {
        if(typeof(total_images)!="undefined" && total_images > 0){
            if(total_images > 1){
                selectThumb='<div class="thumb_sel"><span class="prev_thumb" id="thumb_prev">&nbsp;</span><span class="next_thumb" id="thumb_next">&nbsp;</span> </div>';
                countThumbail='<span class="small_text" id="total_imgs">'+img_arr_pos+' of '+total_images+'</span><span class="small_text">&nbsp;&nbsp;Choose a Thumbnail</span>';
            }
            else{
                selectThumb="";
                countThumbail="";
            }
            inc_image = '<div class="'+extractClass+'" id="extracted_thumb">'+aVideo+'<img src="'+data.images[0]+'" width="'+width+'" height="'+height+'">'+selectThumb+'</div>';
      		inputToSave+="<input type='hidden' class='img_link' value='"+data.images[0]+"'/>";      
        }else{
            inc_image ='';
            countThumbail='';
        }
    }
    
    //content to be loaded in #results element
	if(data.content==null)
		data.content="";
	if(typeof(data.url)!="undefined")
		mediaUrl=data.url;
	else if (typeof(data.content.url) !="undefined")
		mediaUrl=data.content.url;
	else
		mediaUrl="";
	if(typeof(data.description) !="undefined" && typeof(data.name) != "undefined" && data.description !="" && data.name != ""){
		contentMedia='<div class="extracted_content padding-5"><h4><a href="'+mediaUrl+'" target="_blank" class="lastUrl text-dark">'+data.name+'</a></h4><p>'+data.description+'</p>'+countThumbail+'</div>';
		inputToSave+="<input type='hidden' class='description' value='"+data.description+"'/>"; 
		inputToSave+="<input type='hidden' class='name' value='"+data.name+"'/>";
	}
	else{
		contentMedia="";
	}
	inputToSave+="<input type='hidden' class='url' value='"+mediaUrl+"'/>";
	inputToSave+="<input type='hidden' class='type' value='url_content'/>"; 
	    
    content = '<div class="extracted_url">'+ inc_image +contentMedia+'</div>'+inputToSave;
    return content;
}
function saveNews(){
	$('textarea.mention').mentionsInput('getMentions', function(data) {
      mentionsInput=data;
    });
	var formNews = $('#form-news');
	var errorHandler2 = $('.errorHandler', formNews);
	var successHandler2 = $('.successHandler', formNews);

	var validation = {
		submitHandler : function(form) {
			showPanel("box-login");
		}
	};

	if(userId != null){
		validation = {
			errorElement : "span", // contain the error msg in a span tag
			errorClass : 'help-block',
			errorPlacement : function(error, element) {// render error placement for each input type
				if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
					error.insertAfter($(element).closest('.form-group').children('div').children().last());
				} else if (element.parent().hasClass("input-icon")) {
					error.insertAfter($(element).parent());
				} else {
					error.insertAfter(element);
					// for other inputs, just perform default behavior
				}
			},
			ignore : "",
			rules : {
				goSaveNews : {
					required:{
						depends: function() {
							if($(".noGoSaveNews").length){
								return true;
							}
							else{
								return false;
							}
						}	
					}
				},
				getUrl : {
					required:{
						depends: function() {
							if($("#results").html() !=""){
								return false							
							}else{
								return true;	
							}
						}	
					}
				},
			},
			messages : {
				getUrl : "* Please write something",
				goSaveNews: "* Image is still loading"

			},
			submitHandler : function(form) {
				$("#btn-submit-form i").removeClass("fa-arrow-circle-right").addClass("fa-circle-o-notch fa-spin");
				successHandler2.show();
				errorHandler2.hide();
				newNews = new Object;
				if($("#form-news #results").html() != ""){
					newNews.media=new Object;	
					if($("#form-news #results .type").val()=="url_content"){
						newNews.media.type=$("#form-news #results .type").val();
						if($("#form-news #results .name").length)
							newNews.media.name=$("#form-news #results .name").val();
						if($("#form-news #results .description").length)
							newNews.media.description=$("#form-news #results .description").val();
						newNews.media.content=new Object;
						newNews.media.content.type=$("#form-news #results .media_type").val(),
						newNews.media.content.url=$("#form-news #results .url").val(),
						newNews.media.content.image=$("#form-news #results .img_link").val();
						if($("#form-news #results .size_img").length)
							newNews.media.content.imageSize=$("#form-news #results .size_img").val();
						if($("#form-news #results .video_link_value").length)
							newNews.media.content.videoLink=$("#form-news #results .video_link_value").val();
					}
					else{
						newNews.media.type=$("#form-news #results .type").val(),
						newNews.media.countImages=$("#form-news #results .count_images").val(),
						newNews.media.images=[];
						$(".imagesNews").each(function(){
							newNews.media.images.push($(this).val());	
						});
					}
				}

				if ($("#tags").val() != ""){
					newNews.tags = $("#form-news #tags").val().split(",");	
				}
				newNews.parentId = $("#form-news #parentId").val(),
				newNews.parentType = $("#form-news #parentType").val(),
				newNews.scope = $("input[name='scope']").val(),
				newNews.text = $("#form-news #get_url").val();
				console.log("contextParentType", contextParentType);
				if($("input[name='cityInsee']").length && contextParentType == "city")
					newNews.codeInsee = $("input[name='cityInsee']").val();
				if($("input[name='cityPostalCode']").length && contextParentType == "city")
					newNews.postalCode = $("input[name='cityPostalCode']").val();
				if (mentionsInput.length != 0){
					newNews.mentions=mentionsInput;
				}
				console.log(newNews);
				$.ajax({
			        type: "POST",
			        url: baseUrl+"/"+moduleId+"/news/save",
			        dataType: "json",
			        data: newNews,
					type: "POST",
			    })
			    .done(function (data) {
		    		if(data.result)
		    		{
		    			//if the news is post in a different month than last news and current month
		    			if(data.object.date.sec) {
		    				var monthSection = new Date( parseInt(data.object.date.sec)*1000 );
		    				
		    				//if we need a month space to insert the news
		    				if ( !$( "#"+'month'+monthSection.getMonth()+''+monthSection.getFullYear()).length ) {
								loadByHash(location.hash);
		    				}
						}
						
						if( 'undefined' != typeof updateNews && typeof updateNews == "function" ){
							updateNews(data.object);
						}
						$("#get_url").height(100);
						$.unblockUI();
						toastr.success(trad["successsavenews"]);
		    		}
		    		else 
		    		{
		    			$.unblockUI();
						toastr.error(data.msg);
		    		}
		    		$("#btn-submit-form i").removeClass("fa-circle-o-notch fa-spin").addClass("fa-arrow-circle-right");
					return false;
			    }).fail(function(){
				   toastr.error("Something went wrong, contact your admin"); 
				   $("#btn-submit-form i").removeClass("fa-circle-o-notch fa-spin").addClass("fa-arrow-circle-right");
			    });
			}
		};
	}

	formNews.submit(function(e) { e.preventDefault }).validate(validation);
}

function showAllNews(){
	$(".newsFeed").show();
	$('.optionFilter').hide();
}
function initFormImages(){
	$("#photoAddNews").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url : baseUrl+"/"+moduleId+"/document/"+uploadUrl+"dir/"+moduleId+"/folder/"+contextParentType+"/ownerId/"+contextParentId+"/input/newsImage",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false, 
			processData: false,
			dataType: "json",
			success: function(data){
				if(debug)console.log(data);
		  		if(data.success){
		  			imageName = data.name;
					var doc = { 
						"id":contextParentId,
						"type":contextParentType,
						"folder":contextParentType+"/"+contextParentId+"/album",
						"moduleId":moduleId,
						"name" : data.name , 
						"date" : new Date() , 
						"size" : data.size ,
						"doctype" : docType,
						"contentKey" : contentKey
					};
					console.log(doc);
					path = "/"+data.dir+data.name;
					$.ajax({
					  	type: "POST",
					  	url: baseUrl+"/"+moduleId+"/document/save",
					  	data: doc,
				      	dataType: "json"
					}).done( function(data){
				        if(data.result){
						    toastr.success(data.msg);
						    //setTimeout(function(){
						    $(".imagesNews").last().val(data.id.$id);
						    $(".imagesNews").last().attr("name","");
						    $(".newImageAlbum").last().find("img").removeClass("grayscale");
						    $(".newImageAlbum").last().find("i").remove();
						    $(".newImageAlbum").last().append("<a href='javascript:;' onclick='deleteImage(\""+data.id.$id+"\",\""+data.name+"\")'><i class='fa fa-times fa-x padding-5 text-white removeImage' id='deleteImg"+data.id.$id+"'></i></a>");
						    //},200);
				
						} else{
							toastr.error(data.msg);
							if($("#results img").length>1)
						  		$(".newImageAlbum").last().remove();
						  	else{
						  		$("#results").empty();
						  		$("#results").hide();
						  	}
						}
						$("#addImage").off();
					});
		  		}
		  		else{
			  		if($("#results img").length>1)
				  		$(".newImageAlbum").last().remove();
				  	else{
				  		$("#results").empty();
				  		$("#results").hide();
				  	}
				  	$("#addImage").off();
		  			toastr.error(data.msg);
		  		}
			},
		});
	}));
}
function addMoreSpace(){
	bootbox.dialog({
	message: "You have attempt the limit of 20Mo of images for this "+contextParentType+"<br/>Please choose one of those  two solutions beyond:<br/>Delete images in the <a href='javascript:;' onclick='bootbox.hideAll();loadByHash(\"#gallery.index.id."+contextParentId+".type."+contextParentType+"\")'>photo gallery</a> <br/><br/>OR<br/><br/> Subscribe 12€ to the NGO Open Atlas which takes in charge communecter.org on <a href='https://www.helloasso.com/associations/open-atlas' target='_blank'>helloAsso</a> for 20Mo more. <br/><br/>Effectively, stocking images represents a cost for us and donate to the NGO will demonstrate your contribution the project and to the common we built together",
  title: "Limit of <color class='red'>20 Mo</color> overhead"
  });
}
function showMyImage(fileInput) {
	if($(".noGoSaveNews").length){
		toastr.info("Wait the end of image loading");
	}
	else if (fileInput.files[0].size > 2097152){
		toastr.info("Please reduce your image before to 2Mo");
	}
	else {
		countImg=$("#results img").length;
		idImg=countImg+1;
		htmlImg="";
		var files = fileInput.files;
		if(countImg==0){
			htmlImg = "<input type='hidden' class='type' value='gallery_images'/>";
			htmlImg += "<input type='hidden' class='count_images' value='"+idImg+"'/>";
			htmlImg += "<input type='hidden' class='algoNbImg' value='"+idImg+"'/>";
			nbId=idImg;
			$("#results").show();
		}
		else{
			nbId=$(".algoNbImg").val();
			nbId++;
			$(".count_images").val(idImg);
			$(".algoNbImg").val(nbId);
		}
		htmlImg+="<div class='newImageAlbum'><i class='fa fa-spin fa-circle-o-notch fa-3x text-green spinner-add-image noGoSaveNews'></i><img src='' id='thumbail"+nbId+"' class='grayscale' style='width:75px; height:75px;'/>"+
		       	"<input type='hidden' class='imagesNews' name='goSaveNews' value=''/></div>";
		$("#results").append(htmlImg);
	    for (var i = 0; i < files.length; i++) {           
	        var file = files[i];
	        var imageType = /image.*/;     
	        if (!file.type.match(imageType)) {
	            continue;
	        }           
	        var img=document.getElementById("thumbail"+nbId);            
	        img.file = file;    
	        var reader = new FileReader();
	        reader.onload = (function(aImg) { 
	            return function(e) { 
	                aImg.src = e.target.result; 
	            }; 
	        })(img);
	        reader.readAsDataURL(file);
	    }  
		$("#photoAddNews").submit();	  
	}
}
	
function getMediaImages(o,newsId,authorId,targetName){
	countImages=o.images.length;
	html="";
	if(canManageNews==1 || authorId==idSession){
		for(var i in o.images){
			html+="<input type='hidden' class='deleteImageIdName"+newsId+"' value='"+o.images[i]._id.$id+"|"+o.images[i].name+"'/>";
		}
	}
	if(countImages==1){
		path=baseUrl+"/"+uploadUrl+moduleId+"/"+o.images[0].folder+"/"+o.images[0].name;
		html+="<div class='col-md-12'><a class='thumb-info' href='"+path+"' data-title='album de "+targetName+"'  data-lightbox='all"+newsId+"'><img src='"+path+"' class='img-responsive' style='max-height:200px;'></a></div>";
	}
	else if(countImages==2){
		for(var i in o.images){
			path=baseUrl+"/"+uploadUrl+moduleId+"/"+o.images[i].folder+"/"+o.images[i].name;
			html+="<div class='col-md-6 padding-5'><a class='thumb-info' href='"+path+"' data-title='abum de "+targetName+"'  data-lightbox='all"+newsId+"'><img src='"+path+"' class='img-responsive' style='max-height:200px;'></a></div>";
		}
	}
	else if(countImages==3){
		for(var i in o.images){
			path=baseUrl+"/"+uploadUrl+moduleId+"/"+o.images[i].folder+"/"+o.images[i].name;
			if(i==0){
			html+="<div class='col-md-12 padding-5' style='position:relative;height:200px;overflow:hidden;'><a class='thumb-info' href='"+path+"' data-title='abum de "+targetName+"'  data-lightbox='all"+newsId+"'><img src='"+path+"' class='img-responsive' style='position:absolute;min-height:100%;min-width:100%;'></a></div>";
			}else{
			html+="<div class='col-md-6 padding-5' style='position:relative; height:120px;overflow:hidden;'><a class='thumb-info' href='"+path+"' data-title='abum de "+targetName+"'  data-lightbox='all"+newsId+"'><img src='"+path+"' class='img-responsive' style='position:absolute;min-height:100%;min-width:100%;'></a></div>";	
			}
		}
	}
	else if(countImages==4){
		for(var i in o.images){
			path=baseUrl+"/"+uploadUrl+moduleId+"/"+o.images[i].folder+"/"+o.images[i].name;
			html+="<div class='col-md-6 padding-5' style='position:relative;height:120px;overflow:hidden;'><a class='thumb-info' href='"+path+"' data-title='abum de "+targetName+"'  data-lightbox='all"+newsId+"'><img src='"+path+"' class='img-responsive' style='position:absolute;min-height:100%;min-width:100%;height:auto;'></a></div>";
		}
	}
	else if(countImages>=5){
		for(var i in o.images){
			path=baseUrl+"/"+uploadUrl+moduleId+"/"+o.images[i].folder+"/"+o.images[i].name;
			if(i==0)
				html+="<div class='col-md-8 no-padding'><div class='col-md-12 padding-5' style='position:relative;height:120px;overflow:hidden;'><a class='thumb-info' href='"+path+"' data-title='abum de "+targetName+"'  data-lightbox='all"+newsId+"'><img src='"+path+"' class='img-responsive' style='position:absolute;min-height:100%;min-width:100%;'></a></div>";
			else if(i==1){
				html+="<div class='col-md-12 padding-5' style='position:relative;height:120px;overflow:hidden;'><a class='thumb-info' href='"+path+"' data-title='abum de "+targetName+"'  data-lightbox='all"+newsId+"'><img src='"+path+"' class='img-responsive' style='position:absolute;min-height:100%;min-width:100%;'></a></div></div>";
			}
			else if(i<5){
				html+="<div class='col-md-4 padding-5' style='position:relative;height:80px;overflow:hidden;'><a class='thumb-info' href='"+path+"' data-title='abum de "+targetName+"'  data-lightbox='all"+newsId+"'><img src='"+path+"' class='img-responsive' style='position:absolute;min-height:100%;min-width:100%;'></a>";
				if(i==4 && countImages > 5){
					diff=countImages-5;
					html+="<div style='position: absolute;width: 100%;height: 100%;background-color: rgba(0,0,0,0.4);color: white;text-align: center;line-height: 75px;font-size: 30px;'><span>+ "+diff+"</span></div>";
				}
				html+="</div>";
			} else{
				html+="<a class='thumb-info' href='"+path+"' data-title='abum de "+targetName+"'  data-lightbox='all"+newsId+"'></a>";	
			}
		}
	}
	console.log(html);
	return html;
}
function deleteImage(id,name,hideMsg,communevent){
	if(communevent==true)
		path="communevent";
	else
		path="album";
	$.ajax({
			url : baseUrl+"/"+moduleId+"/document/delete/dir/"+moduleId+"/type/"+contextParentType+"/parentId/"+contextParentId,			
			type: "POST",
			data: {"name": name, "parentId": contextParentId, "parentType": contextParentType, "path" : path, "docId" : id},
			dataType: "json",
			success: function(data){
				if(data.result){
					if(hideMsg!=true){
						countImg=$("#results img").length;
						$("#deleteImg"+data.id).parents().eq(1).remove();
						idImg=countImg-1;
						if(idImg==0){
							$("#results").empty().hide();
						}
						else{
							$(".count_images").val(idImg);
						}
							toastr.success(data.msg);
					}
				}
				else{
					toastr.error(data.msg);
				}
			}
	});
}



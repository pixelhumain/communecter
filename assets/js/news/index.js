
/*
* function loadStream() loads news for timeline: 5 news are download foreach call
* @param string contextParentType indicates type of wall news
* @param string contextParentId indicates the precise parent id 
* @param strotime dateLimite indicates the date to load news
*/
var loadStream = function(indexMin, indexMax){
	loadingData = true;
    indexStep = 15;//5;
    if(typeof indexMin == "undefined") indexMin = 0;
    if(typeof indexMax == "undefined") indexMax = indexStep;

    currentIndexMin = indexMin;
    currentIndexMax = indexMax;
    if(indexMin == 0 && indexMax == indexStep) {
      totalData = 0;
      mapElements = new Array(); 
    }
    else{ if(scrollEnd) return; }
        if(typeof viewer != "")
    	simpleUserData="/viewer/"+viewer;
    else
    	simpleUserData="";
	$.ajax({
        type: "POST",
        url: baseUrl+"/"+moduleId+"/news/index/type/"+contextParentType+"/id/"+contextParentId+"/date/"+dateLimit+simpleUserData+"?isFirst=1",
       	dataType: "json",
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

var tagsFilterListHTML = "";
var scopesFilterListHTML = "";
function buildTimeLine (news, indexMin, indexMax)
{
	if (dateLimit==0){
		$(".newsTL").html('<div class="spine"></div>');
		if (streamType=="activity"){
			btnFilterSpecific='<li><a id="btnCitoyens" href="javascript:;"  class="filter yellow" data-filter=".citoyens" style="color:#F3D116;border-left: 5px solid #F3D116"><i class="fa fa-user"></i> Citoyens</a></li>'+
				'<li><a id="btnOrganization" href="javascript:;"  class="filter green" data-filter=".organizations" style="color:#93C020;border-left: 5px solid #93C020"><i class="fa fa-users"></i> Organizations</a></li>'+
				'<a id="btnEvent" href="javascript:;"  class="filter orange" data-filter=".events" style="color:#F9B21A;border-left: 5px solid #F9B21A"><i class="fa fa-calendar"></i> Events</a>'+
				'<a id="btnProject" href="javascript:;"  class="filter purple" data-filter=".projects" style="color:#8C5AA1;border-left: 5px solid #8C5AA1"><i class="fa fa-lightbulb-o"></i> Projects</a><li><br/></li>';
			$(".newsTLmonthsList"+streamType).html(btnFilterSpecific);
		}
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
			
			str += buildLineHTML(newsObj, idSession);
		}
	});
	$(".newsTL").append(str);
	if(canPostNews==true){
		$("#newFeedForm").append(formCreateNews);
		$("#formCreateNewsTemp").css("display", "inline");
	}
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
					'</div>'+form+"<div class='col-md-5 text-extra-large emptyNews"+"'><i class='fa fa-ban'></i> "+msg+".</div>";
		
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

function updateNews(newsObj)
{
	var date = new Date( parseInt(newsObj.created.sec)*1000 );
	if(newsObj.date.sec && newsObj.date.sec != newsObj.created.sec) {
		date = new Date( parseInt(newsObj.date.sec)*1000 );
	}
	var newsTLLine = buildLineHTML(newsObj,idSession,true);
	$(".emptyNews").remove();
	$("#newFeedForm").parent().after(newsTLLine).fadeIn();
	manageModeContext(newsObj._id.$id);
	$("#form-news #get_url").val("");
	$("#form-news #results").html("").hide();
	$("#form-news #tags").select2('val', "");
	showFormBlock(false);
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
        if (match_url.test(getUrl.val())) {
	        if(!$(".lastUrl").attr("href") || $(".lastUrl").attr("href") != getUrl.val().match(match_url)[0]){
	        	var extracted_url = getUrl.val().match(match_url)[0]; //extracted first url from text filed
                $("#results").hide();
                $("#loading_indicator").show(); //show loading indicator image
                //ajax request to be sent to extract-process.php
                //alert(extracted_url);
                $.ajax({
					url: baseUrl+'/'+moduleId+"/news/extractprocess",
					data: {
					'url': extracted_url},
					type: 'post',
					dataType: 'json',
					success: function(data){        
	                console.log(data); 
                    extracted_images = data.images;
                    total_images = parseInt(data.images.length);
                    //img_arr_pos = total_images;
                    img_arr_pos=1;
                    if(data.size){
	                    if (data.video){
		                		extractClass="extracted_thumb";
			                    width="100";
			                    height="100";
			                    aVideo='<a href="#" class="videoSignal text-white center"><i class="fa fa-2x fa-play-circle-o"></i><input type="hidden" class="videoLink" value="'+data.video+'"/></a>';
						}
		                else{
			                aVideo="";
			                endAVideo="";
		                    if(data.size[0] > 350 ){
			                    extractClass="extracted_thumb_large";
			                    width="100%";
			                    height="";
		                    }
		                    else{
			                    extractClass="extracted_thumb";
			                    width="100";
			                    height="100";
		                    }
						}
                    }
                    if (data.imageMedia!=""){
	                    inc_image = '<div class="'+extractClass+'" id="extracted_thumb">'+aVideo+'<img src="'+data.imageMedia+'" width="'+width+'" height="'+height+'"></div>';
	                    countThumbail="";
                    }
                    else {
	                    if(total_images > 0){
		                    if(total_images > 1){
			                    selectThumb='<div class="thumb_sel"><span class="prev_thumb" id="thumb_prev">&nbsp;</span><span class="next_thumb" id="thumb_next">&nbsp;</span> </div>';
			                    countThumbail='<span class="small_text" id="total_imgs">'+img_arr_pos+' of '+total_images+'</span><span class="small_text">&nbsp;&nbsp;Choose a Thumbnail</span>';
		                    }
		                    else{
			                    selectThumb="";
			                    countThumbail="";
		                    }
	                        inc_image = '<div class="'+extractClass+'" id="extracted_thumb">'+aVideo+'<img src="'+data.images[0]+'" width="'+width+'" height="'+height+'">'+selectThumb+'</div>';
	                        
	                    }else{
	                        inc_image ='';
		                    countThumbail='';
	                    }
                    }
                    
                    //content to be loaded in #results element
					if(data.content==null)
						data.content="";
                    var content = '<div class="extracted_url">'+ inc_image +'<div class="extracted_content"><h4><a href="'+extracted_url+'" target="_blank" class="lastUrl">'+data.title+'</a></h4><p>'+data.content+'</p>'+countThumbail+'</div></div>';
                    //load results in the element
                    $("#results").html(content); //append received data into the element
                    $("#results").slideDown(); //show results with slide down effect
                    $("#loading_indicator").hide(); //hide loading indicator image
                	},
					error : function(){
						$.unblockUI();
						toastr.error(trad["wrongwithurl"] + " !");
						$("#loading_indicator").hide();
					}	
                });
			}
        }
    });
}
function saveNews(){
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
				getUrl : {
					required:{
						depends: function() {
							if($("#results").html() !="")
								return false;
							else
								return true;
							}
					}
				},
			},
			messages : {
				getUrl : "* Please write something"

			},
			submitHandler : function(form) {
				$("#btn-submit-form i").removeClass("fa-arrow-circle-right").addClass("fa-circle-o-notch fa-spin");
				successHandler2.show();
				errorHandler2.hide();
				newNews = new Object;
				if($("#form-news #results").html() != ""){
					newNews.mediaContent=$("#form-news #results").html();	
				}
				if ($("#tags").val() != ""){
					newNews.tags = $("#form-news #tags").val().split(",");	
				}
				newNews.typeId = $("#form-news #parentId").val(),
				newNews.type = $("#form-news #parentType").val(),
				newNews.scope = $("input[name='scope']").val(),
				newNews.text = $("#form-news #get_url").val();
				console.log("contextParentType", contextParentType);
				if($("input[name='cityInsee']").length && contextParentType == "city")
					newNews.codeInsee = $("input[name='cityInsee']").val();
				if($("input[name='cityPostalCode']").length && contextParentType == "city")
					newNews.postalCode = $("input[name='cityPostalCode']").val();

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
								loadByHash('#default.news');
		    				}
						}
						
						if( 'undefined' != typeof updateNews && typeof updateNews == "function" )updateNews(data.object);
						$.unblockUI();
						//$.hideSubview();
						toastr.success(trad["successsavenews"]);
		    		}
		    		else 
		    		{
		    			$.unblockUI();
						toastr.error(data.msg);
		    		}
		    		$("#btn-submit-form i").removeClass("fa-circle-o-notch fa-spin").addClass("fa-arrow-circle-right");
					return false;
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

	





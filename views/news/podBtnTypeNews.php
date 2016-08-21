<div class="col-md-12 col-sm-12 col-xs-12 center" 
	 style="margin-top: 10px; margin-bottom: 10px; margin-left: 0px;padding: 0px 10px;"  
	 id="list_type_news">
		  
  <div class="btn-group btn-group-sm inline-block" id="menu-type-news">
    <button class="btn btn-default btn-type-news tooltips text-dark active" 
    		data-toggle="tooltip" data-placement="top" title="Messages" data-type="news">
      <i class="fa fa-check-circle-o search_news hidden"></i> <i class="fa fa-rss"></i> 
      <span class="hidden-xs hidden-sm hidden-md">Message</span>
    </button>
    <button class="btn btn-default btn-type-news tooltips text-dark" 
    		data-toggle="tooltip" data-placement="top" title="Idée" data-type="idea">
      <i class="fa fa-circle-o search_organizations hidden"></i> <i class="fa fa-info-circle"></i> 
      <span class="hidden-xs hidden-sm hidden-md">Idée</span>
    </button>
    <button class="btn btn-default btn-type-news tooltips text-dark" 
    		data-toggle="tooltip" data-placement="top" title="Question" data-type="question">
      <i class="fa fa-circle-o search_projects hidden"></i> <i class="fa fa-question-circle"></i> 
      <span class="hidden-xs hidden-sm hidden-md">Question</span>
    </button>
    <button class="btn btn-default btn-type-news tooltips text-dark" 
    		data-toggle="tooltip" data-placement="top" title="Annonce" data-type="announce">
      <i class="fa fa-circle-o search_events hidden"></i> <i class="fa fa-ticket"></i> 
      <span class="hidden-xs hidden-sm hidden-md">Annonce</span>
    </button>
    <button class="btn btn-default btn-type-news tooltips text-dark" 
    		data-toggle="tooltip" data-placement="top" title="Information" data-type="information">
      <i class="fa fa-circle-o search_needs hidden"></i> <i class="fa fa-newspaper-o"></i> 
      <span class="hidden-xs hidden-sm hidden-md">Information</span>
    </button>
  </div>

</div>

<script type="text/javascript">

jQuery(document).ready(function() 
{
	initSelectTypeNews();
});

function initSelectTypeNews(){

	var msgTypesNews = { 
		"news" 			: "<i class='fa fa-file-text-o'></i> Rédiger votre message",
		"idea" 			: "<i class='fa fa-info-circle'></i> Partager, expliquer, détailler votre idée",
		"question" 		: "<i class='fa fa-question-circle'></i> Poser votre question",
		"announce" 		: "<i class='fa fa-ticket'></i> Rédiger votre annonce, dans ses moindre détails",
		"information" 	: "<i class='fa fa-newspaper-o'></i> Partager votre information"
	};

	$(".btn-type-news").click(function(e){
	    var type = $(this).data("type");
	    
	    $(".btn-type-news").removeClass("active");
	    $(this).addClass("active");
	    
	    $("input[name='type']").val(type);

	    var msg = typeof msgTypesNews[type] != "undefined" ? msgTypesNews[type] : "";
	    msg+='<button class="btn pull-right" onclick="hideNewLiveFeedForm()" style="margin-top: -10px;margin-right: -10px;">'+
	    		'<i class="fa fa-times"></i>'+
	    	 '</button>';
	    $(".header-form-create-news").html("<i class='fa fa-angle-down'></i> "+msg);

	    //showFormBlock(true);
	    $("#newLiveFeedForm").show(200);
	    showFormBlock(true);
  	});
}

</script>
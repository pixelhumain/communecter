
<?php  HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/multi_tags_scopes.css')); ?>

<span data-tpl="default.menu.multi_tag_scope">
<?php 
$this->renderPartial('../default/menu/multi_tag', array("me"=>$me)); 
$this->renderPartial('../default/menu/multi_scope', array("me"=>$me));
?>

<?php  if( isset( Yii::app()->session['userId']) ){ ?>
<button class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
      data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
  <i class="fa fa-bell hidden-xs"></i>
  <span class="notifications-count topbar-badge badge badge-success animated bounceIn">
  	<?php count($this->notifications); ?>
  </span>
</button>
<?php } ?>

</span>

<script>
jQuery(document).ready(function() {
	
	showEmptyMsg();

});

function showTagsScopesMin(htmlId){

	/************** TAGS **************/
	var iconSelectTag = "<i class='fa fa-circle-o'></i>";
	var tagSelected = false;
	$.each(myMultiTags, function(key, value){
		if(value.active){
		 	iconSelectTag = "<i class='fa fa-check-circle-o'></i>";
		 	tagSelected = true;
		}
	});
	var html =  "<button class='btn text-dark btn-sm pull-left' id='toogle-tags-selected' onclick='javascript:selectAllTags();'>"+
				iconSelectTag + "</button> "+
				"<span class='col-md-11 col-sm-11 col-xs-11 inline'>"+
					"<span class='' id='lbl-my-tags'>"+
						"<i class='fa fa-tag'></i> Rechercher par tags <i class='fa fa-angle-right'></i> "+
					"</span><br class='visible-in-form'>";
	
	var numberOfTags = 0;
	$.each(myMultiTags, function(key, value){
		numberOfTags++;
		var disabled = value.active == false ? "disabled" : "";
		html += 	"<span data-toggle='dropdown' data-target='dropdown-multi-tag' "+
						"class='text-red "+disabled+" item-tag-checker' data-tag-value='"+ key + "'>" + 
						"#" + key + 
					"</span> ";
	});
	
	if (numberOfTags == 0) {
		html += '<span id="helpMultiTags" class="toggle-tag-dropdown" style="padding-left:0px">'+
					'<a href="javascript:"> Ajouter des filtres mot clés ?</a>'+
				'</span>';
	}

	html += 	"</span>";


	/************** SCOPES **************/
	var iconSelectScope = "<i class='fa fa-circle-o'></i>";
	var scopeSelected = false;

	$.each(myMultiScopes, function(key, value){
		 if(value.active){
		 	iconSelectScope = "<i class='fa fa-check-circle-o'></i>";
		 	scopeSelected = true;
		 }
	});
	html += "<div class='list-select-scopes'>";
	html += 	"<hr style='margin-top:10px;margin-bottom:10px;float:left;width:100%'>";
	html +=  	"<button class='btn text-dark btn-sm pull-left' id='toogle-scopes-selected' onclick='javascript:selectAllScopes();'>"+
					iconSelectScope + 
				"</button> ";
	html += 	"<span class='col-md-11 col-sm-11 col-xs-11 inline'>"+
					"<span class='' id='lbl-my-scopes'>"+
						"<i class='fa fa-tag'></i> Rechercher par lieux <i class='fa fa-angle-right'></i> "+
					"</span><br class='visible-in-form'>";
	
	var numberOfScope = 0;
	$.each(myMultiScopes, function(key, value){
		numberOfScope++;
		var disabled = value.active == false ? "disabled" : "";
		if(typeof value.name == "undefined") value.name = key;
		html += 	"<span data-toggle='dropdown' data-target='dropdown-multi-scope' "+
						"class='text-red "+disabled+" item-scope-checker' data-scope-value='"+ key + "'>" + 
						"<i class='fa fa-bullseye'></i> " + value.name + 
					"</span> ";
	});
	if (numberOfScope == 0) {
		html += 	'<span id="helpMultiScope" class="toggle-scope-dropdown" style="padding-left:0px">'+
						'<a href="javascript:"> Ajouter des filtres géographiques ?</a>'+
					'</span>';
	}
	html += 	"</span>";
	html += "</div>";
	$(htmlId).html(html);
	multiTagScopeLbl();

	$(".item-scope-checker").off().click(function(){ toogleScopeMultiscope( $(this).data("scope-value")) });
	$(".item-tag-checker").off().click(function(){ toogleTagMultitag( $(this).data("tag-value")) });
	
	$(".toggle-tag-dropdown").click(function(){ //console.log("toogle");
		if(!$("#dropdown-content-multi-tag").hasClass('open'))
		setTimeout(function(){ $("#dropdown-content-multi-tag").addClass('open'); }, 300);
		$("#dropdown-content-multi-tag").addClass('open');
	});
	$(".toggle-scope-dropdown").click(function(){ //console.log("toogle");
		if(!$("#dropdown-content-multi-scope").hasClass('open'))
		setTimeout(function(){ $("#dropdown-content-multi-scope").addClass('open'); }, 300);
	});
	
	if(scopeSelected){ $(".btnShowAllScope").hide(); $(".btnHideAllScope").show(); } 
	else 			 { $(".btnShowAllScope").show(); $(".btnHideAllScope").hide(); }

	if(tagSelected)  { $(".btnShowAllTag").hide(); $(".btnHideAllTag").show(); } 
	else 			 { $(".btnShowAllTag").show(); $(".btnHideAllTag").hide(); }

}

var currentTypeSearchSend = "search";
function multiTagScopeLbl(type){
	if(!notEmpty(type)) type = currentTypeSearchSend;
	if(type=="search"){
		$("#lbl-my-scopes").html("Rechercher par lieux <i class='fa fa-angle-right'></i> ");
		$("#lbl-my-tags").html("Rechercher par tags <i class='fa fa-angle-right'></i> ");
		$("br.visible-in-form").hide();
	}else if(type=="send"){
		$("#lbl-my-scopes").html("<i class='fa fa-angle-down'></i> Sélectionnez les lieux de destination");
		$("#lbl-my-tags").html("<i class='fa fa-angle-down'></i> Sélectionner des tags<span class='hidden-xs'> pour définir le contenu de votre message</span>");
		$("br.visible-in-form").show();
	}
	currentTypeSearchSend = type;
}

function showEmptyMsg(){
	var c=0; $.each(myMultiScopes, function(key, value){ c++; });
	if(c==0) $("#dropdown-multi-scope .visible-empty").show(); else $("#dropdown-multi-scope .visible-empty").hide();

	c=0; $.each(myMultiTags, function(key, value){ c++; });
	if(c==0) $("#dropdown-multi-tag .visible-empty").show(); else $("#dropdown-multi-tag .visible-empty").hide();
	
}


function slidupScopetagsMin(show){ //console.log("slidupScopetagsMin", show);
	if($("#list_filters").hasClass("hidden")){
	    $("#list_filters").removeClass("hidden");
	    $("#btn-slidup-scopetags").html("<i class='fa fa-minus'></i>");
	}
	else{
	    $("#list_filters").addClass("hidden"); //console.log("hidden slidupScopetagsMin", show);
	    $("#btn-slidup-scopetags").html("<i class='fa fa-plus'></i>");
	}

	if(show==true){
	    $("#list_filters").removeClass("hidden"); //console.log("removeClass hidden slidupScopetagsMin", show);
	    $("#btn-slidup-scopetags").html("<i class='fa fa-minus'></i>");
	}
	else if(show==false){
	    $("#list_filters").addClass("hidden");
	    $("#btn-slidup-scopetags").html("<i class='fa fa-plus'></i>");
	}
}


</script>
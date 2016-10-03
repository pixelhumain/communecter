
<?php  HtmlHelper::registerCssAndScriptsFiles(array('/css/menus/multi_tags_scopes.css'), $this->module->assetsUrl); ?>

<span data-tpl="default.menu.multi_tag_scope">
<?php 
$this->renderPartial('../default/menu/multi_tag', array("me"=>$me)); 
$this->renderPartial('../default/menu/multi_scope', array("me"=>$me));
?>

<?php  if( isset( Yii::app()->session['userId']) ){ ?>
<button class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
      data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
  <i class="fa fa-bell hidden-xs"></i>
  <span class="notifications-count topbar-badge badge badge-success animated bounceIn"><?php count($this->notifications); ?></span>
</button>
<?php } ?>

</span>

<script>
jQuery(document).ready(function() {
	
	showEmptyMsg();
	// permet de selectionner sa zone de communection
	/*$(".item-scope-name").click(function() { 
		$(".communectScope > span.item-scope-name ").html( $(".communectScope ").data("scope-value") );
		$(".communectScope").removeClass("communectScope").removeClass("bg-azure").addClass("bg-red");

		$(this).prepend('<i class="fa fa-home"></i> ').parent().removeClass("bg-red").addClass("bg-azure").addClass("communectScope");
		toastr.info("Vous etes commuencter à "+$(this).html());
	})*/

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
	var html =  "<button class='btn text-dark btn-sm' id='toogle-tags-selected' onclick='javascript:selectAllTags();'>"+
				iconSelectTag + "</button> ";
	
	var numberOfTags = 0;
	$.each(myMultiTags, function(key, value){
		numberOfTags++;
		var disabled = value.active == false ? "disabled" : "";
		html += "<span data-toggle='dropdown' data-target='dropdown-multi-tag' "+
					"class='text-red "+disabled+" item-tag-checker' data-tag-value='"+ key + "'>" + 
					"#" + key + 
				"</span> ";
	});

	if (numberOfTags == 0) {
		html += '<span id="helpMultiTags" class="toggle-tag-dropdown" style="padding-left:10px"><a href="javascript:"> Ajouter des filtres mot clés ?</a></span>';
	}

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
	html += 	"<hr style='margin-top:5px;margin-bottom:5px;'>";
	html +=  	"<button class='btn text-dark btn-sm' id='toogle-scopes-selected' onclick='javascript:selectAllScopes();'>"+
				iconSelectScope + "</button> ";
	var numberOfScope = 0;
	$.each(myMultiScopes, function(key, value){
		numberOfScope++;
		var disabled = value.active == false ? "disabled" : "";
		if(typeof value.name == "undefined") value.name = key;
		html += "<span data-toggle='dropdown' data-target='dropdown-multi-scope' "+
					"class='text-red "+disabled+" item-scope-checker' data-scope-value='"+ key + "'>" + 
					"<i class='fa fa-bullseye'></i> " + value.name + 
				"</span> ";
	});
	if (numberOfScope == 0) {
		html += '<span id="helpMultiScope" class="toggle-scope-dropdown" style="padding-left:10px"><a href="javascript:"> Ajouter des filtres géographiques ?</a></span>';
	}
	html += "</div>";
	$(htmlId).html(html);

	$(".item-scope-checker").off().click(function(){ toogleScopeMultiscope( $(this).data("scope-value")) });
	$(".item-tag-checker").off().click(function(){ toogleTagMultitag( $(this).data("tag-value")) });
	
	$(".toggle-tag-dropdown").click(function(){ console.log("toogle");
		if(!$("#dropdown-content-multi-tag").hasClass('open'))
		setTimeout(function(){ $("#dropdown-content-multi-tag").addClass('open'); }, 300);
		$("#dropdown-content-multi-tag").addClass('open');
	});
	$(".toggle-scope-dropdown").click(function(){ console.log("toogle");
		if(!$("#dropdown-content-multi-scope").hasClass('open'))
		setTimeout(function(){ $("#dropdown-content-multi-scope").addClass('open'); }, 300);
	});
	
	if(scopeSelected){ $(".btnShowAllScope").hide(); $(".btnHideAllScope").show(); } 
	else 			 { $(".btnShowAllScope").show(); $(".btnHideAllScope").hide(); }

	if(tagSelected)  { $(".btnShowAllTag").hide(); $(".btnHideAllTag").show(); } 
	else 			 { $(".btnShowAllTag").show(); $(".btnHideAllTag").hide(); }

	//bindRefreshBtns();
	
	//$(".list_tags_scopes").removeClass("tagOnly");
}


function showEmptyMsg(){
	var c=0; $.each(myMultiScopes, function(key, value){ c++; });
	if(c==0) $("#dropdown-multi-scope .visible-empty").show(); else $("#dropdown-multi-scope .visible-empty").hide();

	c=0; $.each(myMultiTags, function(key, value){ c++; });
	if(c==0) $("#dropdown-multi-tag .visible-empty").show(); else $("#dropdown-multi-tag .visible-empty").hide();
	
}


function slidupScopetagsMin(show){ console.log("slidupScopetagsMin", show);
	if($("#list_filters").hasClass("hidden")){
	    $("#list_filters").removeClass("hidden");
	    $("#btn-slidup-scopetags").html("<i class='fa fa-minus'></i>");
	}
	else{
	    $("#list_filters").addClass("hidden"); console.log("hidden slidupScopetagsMin", show);
	    $("#btn-slidup-scopetags").html("<i class='fa fa-plus'></i>");
	}

	if(show==true){
	    $("#list_filters").removeClass("hidden"); console.log("removeClass hidden slidupScopetagsMin", show);
	    $("#btn-slidup-scopetags").html("<i class='fa fa-minus'></i>");
	}
	else if(show==false){
	    $("#list_filters").addClass("hidden");
	    $("#btn-slidup-scopetags").html("<i class='fa fa-plus'></i>");
	}
}


/*function openCommonModal(hash){ console.log("search for modal key :", hash);
	var urls = {
		"organization.addorganizationform": { 
			what: { 
				title: 	"Créer une organisation",
				icon: 	"users",
				desc: 	""
			},
			//url:"organization/addorganizationform",
			id: ""
		},
		"project.projectsv": { 
			what: { 
				title: 	"Créer un projet",
				icon: 	"lightbulb-o",
				desc: 	""
			},
			//url:"project/projectsv",
			id: ""
		},
	};

	if(typeof urls[hash] != "undefined"){ console.log("modal key found");
		var slashHash = hash.replace( /\./g,"/" );
		var url = "/" + moduleId + "/" + slashHash; //urls[hash]["url"];
		getModal(urls[hash]["what"], url); //, urls[hash]["id"])
	}else{
		console.log("modal key not found");
	}
}*/
</script>
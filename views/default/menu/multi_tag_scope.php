

<style type="text/css">

	.dropdown.open #dropdown-multi-tag,
	.dropdown.open #dropdown-multi-scope{
		display: inline !important;
	}

	#dropdown-multi-tag, 
	#dropdown-multi-scope{
		position: fixed!important;
		top: 46px!important;
		right: 0px!important;
		left:unset!important;

	    z-index: 1000;
	    display: none;
	    float: left;
	    padding: 5px 0;
	    margin: 2px 0 0;
	    font-size: 14px;
	    text-align: left;
	    list-style: none;
	    background-color: #fff;
	    -webkit-background-clip: padding-box;
	    background-clip: padding-box;
	    border: 1px solid #ccc;
	    border: 1px solid rgba(0,0,0,.15);
	    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
	    box-shadow: 0 6px 12px rgba(0,0,0,.175);

	    width: 570px;
		min-width: 570px;
		max-width: 570px;
		margin-top: 4px;
		border-radius: 0px 0px 4px 4px;

		overflow-y: auto;
		bottom: 0px;
	}
	
	
	#dropdown-multi-tag input.form-control,
	#dropdown-multi-scope input.form-control {
	    text-align: left;
	    border-radius: 0px !important;
	    padding: 5px;
	    height: 34px !important;
	}

	#dropdown-multi-tag .item-tag-input,
	#dropdown-multi-scope .item-scope-input{
		padding:6px;
		border-radius:20px;
		display: inline-block;
		margin-right: 3px;
		margin-top: 3px;
	}
	#dropdown-multi-tag .item-tag-input .item-tag-checker:hover,
	#dropdown-multi-tag .item-tag-input .item-tag-deleter:hover,
	#dropdown-multi-scope .item-scope-input .item-scope-checker:hover,
	#dropdown-multi-scope .item-scope-input .item-scope-deleter:hover{
		color:#ffa9a9;
	}

	#dropdown-multi-tag .item-tag-input .item-tag-name,
	#dropdown-multi-scope .item-scope-input .item-scope-name{
	    padding-left: 5px;
	    padding-right: 5px;
	}

	#dropdown-multi-tag .item-tag-input a,
	#dropdown-multi-scope .item-scope-input a{
	    color:white;
	}

	#btn-modal-multi-scope, #btn-modal-multi-tag{
		border-radius: 30px;
		border: 0px none;
		padding: 8px;
		width: 35px;
		height: 35px;
		margin-top: 0px;
		font-size: 15px;
		margin-right: 2px;
		background-color: white;
	}
	#btn-modal-multi-scope:hover, #btn-modal-multi-tag:hover{
		background-color: #ddd;
	}

	#btn-modal-multi-tag{
		margin-left:10px;
	}
	#btn-modal-multi-scope{
		margin-right:15px;
	}

	#dropdown-multi-scope .input-group-addon, 
	#dropdown-multi-tag .input-group-addon{
		background-color: rgba(192, 192, 192, 0.42) !important;
	    border-radius: 4px 0px 0px 4px !important;
	    color: #555 !important;
	    height: 34px;
	    border: 1px solid rgba(128, 128, 128, 0) !important;
	}

	#dropdown-multi-scope .item-scope-input.bg-red.disabled,
	#dropdown-multi-tag .item-tag-input.bg-red.disabled{
		background-color:#DBBCC1 !important;
	}

	.item-scope-checker,
	.item-tag-checker{
		cursor:pointer;
		font-weight: 600 !important;
	}

	.list_tags_scopes span.text-red.disabled,
	#list_tags_scopes span.text-red.disabled,
	#scopeListContainer span.text-red.disabled{
	    color:#DBBCC1 !important;
	    font-weight:300 !important;
	}

	#dropdown-multi-scope-found{
		max-height:250px;
		overflow: auto;
	}

	.tagOnly .list-select-scopes{
		display: none;
	}
	.visible-empty{
		display: none;
	}
	.visible-empty blockquote{
		font-size:15px;
	}
	@media screen and (max-width: 767px) {
		#dropdown-multi-tag .modal-dialog,
		#dropdown-multi-scope .modal-dialog{
			width: 100% !important;
			min-width: 100% !important;
			max-width: 100% !important;	
		}
		#dropdown-multi-tag, 
		#dropdown-multi-scope{
			left: 0px;
			right: 0px;
			position: fixed;
			min-width: 100% !important;
			width: 100% !important;
			max-width: 100% !important;
			max-height: 85%;
			min-height: 85%;
		}
		#btn-modal-multi-tag{
			margin-left:0px;
		}
		#btn-modal-multi-scope{
			margin-right:5px;
		}
		.item-scope-input{
			cursor: pointer;
		}
	}
</style>

<span data-tpl="default.menu.multi_tag_scope">
<?php 
$this->renderPartial('../default/menu/multi_tag', array("me"=>$me)); 
$this->renderPartial('../default/menu/multi_scope', array("me"=>$me));
?>

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
		html += '<span id="helpMultiTags" class="toggle-tag-dropdown" style="padding-left:10px"><a> Ajouter des filtres mot clés ?</a></span>';
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
		html += '<span id="helpMultiScope" class="toggle-scope-dropdown" style="padding-left:10px"><a> Ajouter des filtres géographiques ?</a></span>';
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


function saveMultiTag(){
	//mylog.log("saveMultiTag() try"); mylog.log(myMultiTags); 
	hideSearchResults();
	if(userId != null && userId != ""){
		if(!notEmpty(myMultiTags)) myMultiTags = {};
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/person/updatemultitag",
	        data: {multitags : myMultiTags},
	       	dataType: "json",
	    	success: function(data){
	    		mylog.log("saveMultiTag() success");
		    },
			error: function(error){
				mylog.log("Une erreur est survenue pendant l'enregistrement des tags");
			}
		});
	}else{
		
	}
	showCountTag();
	rebuildSearchTagInput();
    saveCookieMultitags();
}

function saveCookieMultitags(){ //mylog.log("saveCookieMultitags", myMultiTags);
	$.cookie('multitags',   	JSON.stringify(myMultiTags),  	{ expires: 365, path: "/" });

}

function loadMultiTags(){
	$.each(myMultiTags, function(key, value){ //mylog.log("each myMultiTags", myMultiTags);
		showTagInMultitag(key);
	});
	showCountTag();
	saveCookieMultitags();
}

function showCountTag(){
	var count = 0;
	//mylog.log("myMultiTags"); mylog.log(myMultiTags);
	$.each(myMultiTags, function(key, value){ //mylog.log("each myMultiTags");
		if(value.active==true) count++;
	}); //onsole.log("TAG COUNT : ", count);
	$(".tags-count").html(count);
	showTagsScopesMin(".list_tags_scopes");
	showEmptyMsg();
}
function tagExists(tagValue){
	return typeof myMultiTags[tagValue] != "undefined";
}
function selectAllTags(select){
	if(typeof select == "undefined"){ select = true;
		$.each(myMultiTags, function(key, value){
			 if(value.active) select = false;
		});
	}
	$.each(myMultiTags, function(key, value){
		 toogleTagMultitag(key, select);
	});
	saveMultiTag();
}
function showTagInMultitag(tagValue){ //mylog.log("showTagInMultitag()", tagValue);
	var html = "";
	if(tagExists(tagValue)){
		var faActive = myMultiTags[tagValue].active == true ? "check-circle" : "circle-o";
		var classDisable = myMultiTags[tagValue].active == false ? "disabled" : "";
		html = 
		'<span class="item-tag-input bg-red '+classDisable+'" data-tag-value="'+tagValue+'">' +
				'<a  href="javascript:" class="item-tag-checker tooltips"' +
					'data-toggle="tooltip" data-placement="bottom" ' +
					'title="Activer/Désactiver" data-tag-value="'+tagValue+'">' +
					'<i class="fa fa-'+faActive+'"></i>' +
				'</a>' +
				'<span class="item-tag-name">#'+tagValue+'</span>' +
				'<a href="javascript:" class="item-tag-deleter tooltips"' +
					'data-toggle="tooltip" data-placement="bottom" ' +
					'title="Supprimer" data-tag-value="'+tagValue+'">' +
					'<i class="fa fa-times"></i>' +
			'</a>' +
		'</span>';
		$("#multi-tag-list").append(html);
		$(".tooltips").tooltip();
		$(".item-tag-checker").off().click(function(){ toogleTagMultitag( $(this).data("tag-value")) });
		$(".item-tag-deleter").off().click(function(){ deleteTagInMultitag( $(this).data("tag-value")); });
		//showMsgInfoMultiTag("Le tag a bien été ajouté", "success");
	}else{
		html = "";
		//showMsgInfoMultiTag("showTagInMultitag error : ce tag n'existe pas - " + tagValue, "danger");
	}
	
	
}


function addTagToMultitag(tagValue){  
	if(tagValue == "") return;
	if(tagValue.indexOf("#") == 0) tagValue = tagValue.substr(1, tagValue.length);
	if(!tagExists(tagValue)){
		//mylog.log("adding", tagValue);
		myMultiTags[tagValue] = { active: true };
		//mylog.log("adding : myMultiTags :", myMultiTags);
		showTagInMultitag(tagValue);
		saveMultiTag();
		$("#input-add-multi-tag").val("");
		$("[data-tag-value='"+tagValue+"'].item-tag-suggest").hide();
		return true;
	}else{
		showMsgInfoMultiTag("Ce tag est déjà dans votre liste", "info");
		return false;
	}
}

function deleteTagInMultitag(tagValue){ //mylog.log("deleteTagInMultitag(tagValue)", tagValue);
	if(tagExists(tagValue)){
		delete myMultiTags[tagValue];
		$("[data-tag-value='"+tagValue+"'].item-tag-input ").remove();
		$("[data-tag-value='"+tagValue+"'].item-tag-suggest").show();
		saveMultiTag();
		//showMsgInfoMultiTag("Le tag a bien été supprimé", "success");
	}
	//mylog.dir(myMultiTags);
}

function toogleTagMultitag(tagValue, selected){ //mylog.log("toogleTagMultitag(tagValue)", tagValue);
	if(tagExists(tagValue)){
		myMultiTags[tagValue].active = !myMultiTags[tagValue].active;
		
		if(typeof selected != "undefined") 
			myMultiTags[tagValue].active = selected;
		
		saveMultiTag();

		if(myMultiTags[tagValue].active){
			$("[data-tag-value='"+tagValue+"'].item-tag-checker i.fa").removeClass("fa-circle-o");
			$("[data-tag-value='"+tagValue+"'].item-tag-checker i.fa").addClass("fa-check-circle");
			$("[data-tag-value='"+tagValue+"'].item-tag-input").removeClass("disabled");
		}else{
			$("[data-tag-value='"+tagValue+"'].item-tag-checker i.fa").addClass("fa-circle-o");
			$("[data-tag-value='"+tagValue+"'].item-tag-checker i.fa").removeClass("fa-check-circle");
			$("[data-tag-value='"+tagValue+"'].item-tag-input").addClass("disabled");
		}
		
		//rebuildSearchTagInput();

	}else{
		//showMsgInfoMultiTag("Ce tag n'existe pas", "danger");
	}
}

function getMultiTagList(){ return myMultiTags; }

var timerMsgMultitag;
function showMsgInfoMultiTag(msg, type){
	if(type == "success") msg = "<i class='fa fa-check'></i> " + msg;
	if(type == "danger") msg = "<i class='fa fa-times'></i> " + msg;
	if(type == "info") msg = "<i class='fa fa-info-circle'></i> " + msg;
	
	var id = "#lbl-info-select-multi-tag";
	$(id).html(msg);
	if(type == "success") $(id).addClass("label-success"); else $(id).removeClass("label-success");
	if(type == "danger") $(id).addClass("label-danger"); else $(id).removeClass("label-danger");
	if(type == "info") $(id).addClass("label-info"); else $(id).removeClass("label-info");

	$(id).off().hide();
	$(id).show(200);

	if(typeof timerMsgMultitag != "undefined") clearTimeout(timerMsgMultitag);
	timerMsgMultitag = setTimeout(function(){ $(id).off().hide(500)}, 3000);
}

function rebuildSearchTagInput()
{
	searchTags = "";
	$.each(myMultiTags, function(key, value){
		if(value.active)
			searchTags += (searchTags == "") ? key :   ","+key;
	});
	//mylog.log("searchTags",searchTags);
	if( $("#searchTags") )
		$("#searchTags").val(searchTags);

	//if( typeof searchCallback == "function" )
	//	searchCallback();
}


function showTagsMin(htmlId){
	var html =  ""; //'<a href="javascript" onclick="javascript:selectAllTags(true)">' +
			        //'<i class="fa fa-cogs"></i>' +
			//    '</button> ';
	
	$.each(myMultiTags, function(key, value){
		var disabled = value.active == false ? "disabled" : "";
		html += "<span data-toggle='dropdown' data-target='dropdown-multi-tag' "+
					"class='text-red "+disabled+" item-tag-checker' data-tag-value='"+ key + "'>" + 
					"#" + key + 
				"</span> ";
	});
	html += "<hr style='margin-top:5px;margin-bottom:5px;'>";
	
	$(htmlId).html(html);

	$(".item-tag-checker").off().click(function(){ toogleTagMultitag( $(this).data("tag-value")) });
	
	$(".toggle-tag-dropdown").click(function(){ //mylog.log("toogle");
		if(!$("#dropdown-content-multi-tag").hasClass('open'))
		setTimeout(function(){ $("#dropdown-content-multi-tag").addClass('open'); }, 300);
		$("#dropdown-content-multi-tag").addClass('open');
		//else
		//$("#dropdown-content-multi-tag").removeClass('open');
	});
}

function loadTagSuggestion(tagsSuggest){
	$.each(tagsSuggest, function(key, value){ //mylog.log("each tagsSuggest");
		showTagSuggestion(key, value);
	});
}
function showTagSuggestion(tagValue, tagSpec){ //mylog.log("showTagSuggestion()", tagValue);
	var html = "";
	if(!tagExists(tagValue)){
		var faActive = tagSpec.active == true ? "check-circle" : "circle-o";
		var classDisable = tagSpec.active == false ? "disabled" : "";
		html = 
		'<span class="item-tag-suggest bg-red '+classDisable+'" data-tag-value="'+tagValue+'">' +
				'<a  href="javascript:" class="item-tag-adder tooltips"' +
					'data-toggle="tooltip" data-placement="bottom" ' +
					'title="Ajouter à mes favoris" data-tag-value="'+tagValue+'">' +
					'<i class="fa fa-plus-circle"></i>' +
				'</a>' +
				'<span class="item-tag-name">#'+tagValue+'</span>' +
		'</span>';
		$("#multi-tag-suggestion").append(html);
		$(".tooltips").tooltip();
		$(".item-tag-suggest").off().click(function(){ addTagToMultitag( $(this).data("tag-value")) });
		//showMsgInfoMultiTag("Le tag a bien été ajouté", "success");
	}else{
		html = "";
		//showMsgInfoMultiTag("showTagInMultitag error : ce tag n'existe pas - " + tagValue, "danger");
	}
	
	
}
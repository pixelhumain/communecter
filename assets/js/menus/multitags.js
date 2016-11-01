

function saveMultiTag(){
	//console.log("saveMultiTag() try"); console.log(myMultiTags); 
	hideSearchResults();
	if(userId != null && userId != ""){
		if(!notEmpty(myMultiTags)) myMultiTags = {};
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/person/updatemultitag",
	        data: {multitags : myMultiTags},
	       	dataType: "json",
	    	success: function(data){
	    		console.log("saveMultiTag() success");
		    },
			error: function(error){
				console.log("Une erreur est survenue pendant l'enregistrement des tags");
			}
		});
	}else{
		
	}
	showCountTag();
	rebuildSearchTagInput();
    saveCookieMultitags();
}

function saveCookieMultitags(){ //console.log("saveCookieMultitags", myMultiTags);
	$.cookie('multitags',   	JSON.stringify(myMultiTags),  	{ expires: 365, path: "/" });

}

function loadMultiTags(){
	$.each(myMultiTags, function(key, value){ //console.log("each myMultiTags");
		showTagInMultitag(key);
	});
	showCountTag();
	saveCookieMultitags();
}

function showCountTag(){
	var count = 0;
	//console.log("myMultiTags"); console.log(myMultiTags);
	$.each(myMultiTags, function(key, value){ //console.log("each myMultiTags");
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
function showTagInMultitag(tagValue){ //console.log("showTagInMultitag()", tagValue);
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
		//console.log("adding", tagValue);
		myMultiTags[tagValue] = { active: true };
		//console.log("adding : myMultiTags :", myMultiTags);
		showTagInMultitag(tagValue);
		saveMultiTag();
		$("#input-add-multi-tag").val("");
		return true;
	}else{
		showMsgInfoMultiTag("Ce tag est déjà dans votre liste", "info");
		return false;
	}
}

function deleteTagInMultitag(tagValue){ //console.log("deleteTagInMultitag(tagValue)", tagValue);
	if(tagExists(tagValue)){
		delete myMultiTags[tagValue];
		$("[data-tag-value='"+tagValue+"']").remove();
		saveMultiTag();
		//showMsgInfoMultiTag("Le tag a bien été supprimé", "success");
	}
	//console.dir(myMultiTags);
}

function toogleTagMultitag(tagValue, selected){ //console.log("toogleTagMultitag(tagValue)", tagValue);
	if(tagExists(tagValue)){
		myMultiTags[tagValue].active = !myMultiTags[tagValue].active;
		
		if(typeof selected != "undefined") 
			myMultiTags[tagValue].active = selected;
		
		saveMultiTag();

		if(myMultiTags[tagValue].active){
			$("[data-tag-value='"+tagValue+"'] .item-tag-checker i.fa").removeClass("fa-circle-o");
			$("[data-tag-value='"+tagValue+"'] .item-tag-checker i.fa").addClass("fa-check-circle");
			$("[data-tag-value='"+tagValue+"'].item-tag-input").removeClass("disabled");
		}else{
			$("[data-tag-value='"+tagValue+"'] .item-tag-checker i.fa").addClass("fa-circle-o");
			$("[data-tag-value='"+tagValue+"'] .item-tag-checker i.fa").removeClass("fa-check-circle");
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
	//console.log("searchTags",searchTags);
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
	
	$(".toggle-tag-dropdown").click(function(){ //console.log("toogle");
		if(!$("#dropdown-content-multi-tag").hasClass('open'))
		setTimeout(function(){ $("#dropdown-content-multi-tag").addClass('open'); }, 300);
		$("#dropdown-content-multi-tag").addClass('open');
		//else
		//$("#dropdown-content-multi-tag").removeClass('open');
	});
}

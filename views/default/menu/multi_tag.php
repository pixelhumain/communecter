

<style type="text/css">

.tags-count{
	right: 0px;
    position: absolute;
    top: 4px;
}	

</style>


<div class="dropdown pull-left" id="dropdown-content-multi-tag">

  <button class="pull-left"  data-toggle="dropdown"  id="btn-modal-multi-tag"
	data-toggle="tooltip" data-placement="right" 
	title="Mes tags favoris">
	<i class="fa fa-tag" style=""></i>
	<span class="tags-count topbar-badge badge animated bounceIn bg-red">0</span>
  </button>
  <ul class="dropdown-menu" id="dropdown-multi-tag">
      <div class="panel-body text-dark padding-bottom-10">
      		<div class="col-md-12 no-padding">
	      		<div class="col-md-12">
	      			<h3 class="no-margin" style="margin-top: 13px ! important;">
	      				<i class="fa fa-angle-down"></i> <i class="fa fa-tag"></i> Mes <strong>#tags</strong> favoris
	      			</h3>
	      			<hr style="margin-top: 10px; margin-bottom: 10px;">
	      			<div class="col-md-9 no-padding">
		      			<div class="input-group margin-bottom-10">
					      <span class="input-group-btn">
					        <div class="input-group-addon" type="button">
					        	<i class="fa fa-plus"></i> <i class="fa fa-tag"></i>
					        </div>
					      </span>
					      <input id="input-add-multi-tag" type="text" class="form-control" placeholder="Ajouter un tag ...">
					      <span class="input-group-btn">
					        <button class="btn btn-success btn-add-tag" type="button"><i class="fa fa-check"></i></button>
					      </span>
					    </div>
				    </div>
				    <div class="col-md-3">
	      				<button class="btn btn-default" onclick="javascript:selectAllTags(true)">
		      			<i class="fa fa-check-circle"></i>
			      		</button>
			      		<button class="btn btn-default" onclick="javascript:selectAllTags(false)">
			      			<i class="fa fa-circle-o"></i>
			      		</button>
	      			</div>
	      		</div>
	      		<div id="multi-tag-list" class="col-md-12 margin-top-15"></div>
	      		<div class="col-md-12">
		      		<hr style="margin-top: 10px; margin-bottom: 10px;">
		      		<div class="label label-info label-sm block text-left" id="lbl-info-select-multi-tag"></div>
		      		<input id="searchTags" type="hidden" />
	      		</div>	      			
      		</div>    		
      	</div>
   </ul>
</div>

<?php 
	if(isset(Yii::app()->session['userId']))
	$me = Person::getById(Yii::app()->session['userId']); 
?>
<script type="text/javascript"> 

var myMultiTags = <?php echo isset($me) && isset($me["multitags"]) ? json_encode($me["multitags"]) : "{}"; ?>;
var searchTags = "";
//console.log("init myMultiTags");
//console.dir(myMultiTags);

jQuery(document).ready(function() {
	$('ul.dropdown-menu').click(function(){ return false });

	$(".btn-add-tag").click(function(){ console.log("btn-add-tag click()");
		addTagToMultitag($("#input-add-multi-tag").val())
	});

	$('#input-add-multi-tag').filter_input({regex:'[a-zA-Z0-9_]'}); 

	loadMultiTags();
	rebuildSearchTagInput();
});


function saveMultiTag(){ //console.log("saveMultiTag() try"); console.dir(myMultiTags);
	$.ajax({
        type: "POST",
        url: baseUrl+"/"+moduleId+"/person/updatemultitag",
        data: {multitags : myMultiTags},
       	dataType: "json",
    	success: function(data){
    		showCountTag();
    		rebuildSearchTagInput();
	    	//console.log("saveMultiTag() success");
	    },
		error: function(error){
			console.log("Une erreur est survenue pendant l'enregistrement des tags");
		}
	});
}


function loadMultiTags(){
	$.each(myMultiTags, function(key, value){
		showTagInMultitag(key);
	});
	showCountTag();
}

function showCountTag(){
	var count = 0;
	$.each(myMultiTags, function(key, value){
		if(value.active==true) count++;
	}); console.log("TAG COUNT : ", count);
	$(".tags-count").html(count);
	showTagsScopesMin("#list_tags_scopes");
}
function tagExists(tagValue){
	return typeof myMultiTags[tagValue] != "undefined";
}
function selectAllTags(select){
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
	if(!tagExists(tagValue)){
		//console.log("adding", tagValue);
		myMultiTags[tagValue] = { active: true };
		showTagInMultitag(tagValue);
		saveMultiTag();
		$("#input-add-multi-tag").val("");
	}else{
		showMsgInfoMultiTag("Ce tag est déjà dans votre liste", "info");
	}
}

function deleteTagInMultitag(tagValue){ //console.log("deleteTagInMultitag(tagValue)", tagValue);
	if(tagExists(tagValue)){
		delete myMultiTags[tagValue];
		$("[data-tag-value="+tagValue+"]").remove();
		saveMultiTag();
		//showMsgInfoMultiTag("Le tag a bien été supprimé", "success");
	}
	//console.dir(myMultiTags);
}

function toogleTagMultitag(tagValue, selected){ //console.log("toogleTagMultitag(tagValue)", tagValue);
	if(tagExists(tagValue)){
		myMultiTags[tagValue].active = !myMultiTags[tagValue].active;
		
		if(typeof selected == "undefined") saveMultiTag();
		else myMultiTags[tagValue].active = selected;
		
		if(myMultiTags[tagValue].active){
			$("[data-tag-value="+tagValue+"] .item-tag-checker i.fa").removeClass("fa-circle-o");
			$("[data-tag-value="+tagValue+"] .item-tag-checker i.fa").addClass("fa-check-circle");
			$("[data-tag-value="+tagValue+"].item-tag-input").removeClass("disabled");
		}else{
			$("[data-tag-value="+tagValue+"] .item-tag-checker i.fa").addClass("fa-circle-o");
			$("[data-tag-value="+tagValue+"] .item-tag-checker i.fa").removeClass("fa-check-circle");
			$("[data-tag-value="+tagValue+"].item-tag-input").addClass("disabled");
		}
		rebuildSearchTagInput();

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
	console.log("searchTags",searchTags);
	if( $("#searchTags") )
		$("#searchTags").val(searchTags);

	if( typeof searchCallback == "function" )
		searchCallback();
}
</script>
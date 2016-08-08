

<style type="text/css">



</style>


<div class="dropdown pull-left">
  <button class="pull-left tooltips"  data-toggle="dropdown"  id="btn-modal-multi-tag"
	data-toggle="tooltip" data-placement="bottom" 
	title="Mes tags favoris">
	<i class="fa fa-tag" style=""></i>
  </button>
  <ul class="dropdown-menu" id="dropdown-multi-tag">
      <div class="panel-body text-dark padding-bottom-10">
      		<div class="col-md-12 no-padding">
	      		<div class="col-md-12">
	      			<h3 class="no-margin" style="margin-top: 13px ! important;">
	      				<i class="fa fa-angle-down"></i> <i class="fa fa-tag"></i> Mes <strong>#tags</strong> favoris
	      			</h3>
	      			<hr style="margin-top: 10px; margin-bottom: 10px;">
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
				    <div class="label label-info label-sm block text-left" id="lbl-info-select-multi-tag"></div>
	      		</div>
	      		<div id="multi-tag-list" class="col-md-12 margin-top-15"></div>
      		</div>
      		
      	</div>
   </ul>
</div>


<script type="text/javascript"> 

var myMultiTags = new Array();

jQuery(document).ready(function() {
	$('ul.dropdown-menu').click(function(){ return false });

	$(".btn-add-tag").click(function(){ console.log("btn-add-tag click()");
		addTagToMultitag($("#input-add-multi-tag").val())
	});

	$('#input-add-multi-tag').filter_input({regex:'[a-zA-Z0-9_]'}); 

	loadMultiTags();
});

function loadMultiTags(){
	$.each(myMultiTags, function(key, value){
		showTagInMultitag(key);
	});
}

function showTagInMultitag(tagValue){ console.log("showTagInMultitag()", tagValue);
	var html = "";
	if(myMultiTags.indexOf(tagValue) < 0){
		var tag = myMultiTags[tagValue];
		html = 
		'<span class="item-tag-input bg-red" data-tag-value="'+tagValue+'">' +
				'<a  href="javascript:" class="item-tag-checker tooltips"' +
					'data-toggle="tooltip" data-placement="bottom" ' +
					'title="Activer/Désactiver" data-tag-value="'+tagValue+'">' +
					'<i class="fa fa-check-circle"></i>' +
				'</a>' +
				'<span class="item-tag-name">#'+tagValue+'</span>' +
				'<a href="javascript:" class="item-tag-deleter tooltips"' +
					'data-toggle="tooltip" data-placement="bottom" ' +
					'title="Supprimer" data-tag-value="'+tagValue+'">' +
					'<i class="fa fa-times"></i>' +
			'</a>' +
		'</span>';
	}else{
		html = "";
		showMsgInfoMultiTag("showTagInMultitag error : ce tag n'existe pas - " + tagValue, "error");
	}
	
	$("#multi-tag-list").append(html);
	$(".tooltips").tooltip();
	showMsgInfoMultiTag("Le tag a bien été ajouté", "success");
	$(".item-tag-checker").off().click(function(){ toogleTagMultitag( $(this).data("tag-value")) });
	$(".item-tag-deleter").off().click(function(){ deleteTagInMultitag( $(this).data("tag-value")); });
}


function addTagToMultitag(tagValue){  
	if(tagValue == "") return;
	if(typeof myMultiTags[tagValue] == "undefined"){
		console.log("adding", tagValue);
		myMultiTags[tagValue] = { active: true };
		showTagInMultitag(tagValue);
		$("#input-add-multi-tag").val("");
	}else{
		showMsgInfoMultiTag("Ce tag est déjà dans votre liste", "info");
	}
}

function deleteTagInMultitag(tagValue){ //console.log("deleteTagInMultitag(tagValue)", tagValue);
	if(typeof myMultiTags[tagValue] != "undefined"){
		delete myMultiTags[tagValue];
		$("[data-tag-value="+tagValue+"]").remove();
		showMsgInfoMultiTag("Le tag a bien été supprimé", "success");
	}
	console.dir(myMultiTags);
}

function toogleTagMultitag(tagValue){ //console.log("toogleTagMultitag(tagValue)", tagValue);
	if(typeof myMultiTags[tagValue] != "undefined"){
		myMultiTags[tagValue].active = !myMultiTags[tagValue].active;
		
		if(myMultiTags[tagValue].active){
			$("[data-tag-value="+tagValue+"] .item-tag-checker i.fa").removeClass("fa-circle-o");
			$("[data-tag-value="+tagValue+"] .item-tag-checker i.fa").addClass("fa-ckeck-circle");
		}else{
			$("[data-tag-value="+tagValue+"] .item-tag-checker i.fa").addClass("fa-circle-o");
			$("[data-tag-value="+tagValue+"] .item-tag-checker i.fa").removeClass("fa-ckeck-circle");
		}
	}else{
		showMsgInfoMultiTag("Ce tag n'existe pas", "danger");
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
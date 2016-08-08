

<style type="text/css">

	.dropdown.open #dropdown-multi-tag{
		display: inline !important;
	}

	#dropdown-multi-tag, 
	#dropdown-multi-scope{
		position: absolute;
	    top: -5px;
		left: -5px;
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

	    width: 500px;
		min-width: 500px;
		max-width: 500px;
		margin-top: 4px;
		border-radius: 0px 0px 4px 4px;
	}

	#dropdown-multi-tag input.form-control {
	    text-align: left;
	    border-radius: 0px !important;
	    padding: 5px;
	    height: 34px !important;
	}

	#dropdown-multi-tag .item-tag-input{
		padding:6px;
		border-radius:20px;
		display: inline-block;
		margin-right: 3px;
		margin-top: 3px;
	}
	#dropdown-multi-tag .item-tag-input .item-tag-checker:hover,
	#dropdown-multi-tag .item-tag-input .item-tag-deleter:hover{
		color:#ffa9a9;
	}

	#dropdown-multi-tag .item-tag-input .item-tag-name{
	    padding-left: 5px;
	    padding-right: 5px;
	}

	#dropdown-multi-tag .item-tag-input a{
	    color:white;
	}

	#btn-modal-multi-scope, #btn-modal-multi-tag{
		/*border-radius: 30px;
		border: 0px none;
		padding: 10px;
		width: 40px;
		height: 40px;
		margin-top: 5px;
		font-size: 15px;
		margin-right:8px;*/
		border-radius: 30px;
		border: 0px none;
		padding: 5px;
		width: 35px;
		height: 35px;
		margin-top: 8px;
		font-size: 15px;
		margin-right: 2px;
		background-color: white;
	}

	#dropdown-multi-scope .input-group-addon, 
	#dropdown-multi-tag .input-group-addon{
		background-color: rgba(192, 192, 192, 0.42) !important;
	    border-radius: 4px 0px 0px 4px !important;
	    color: #555 !important;
	    height: 34px;
	    border: 1px solid rgba(128, 128, 128, 0) !important;
	}



	@media screen and (max-width: 767px) {
		#dropdown-multi-tag .modal-dialog,
		#dropdown-multi-scope .modal-dialog{
			width: 100% !important;
			min-width: 100% !important;
			max-width: 100% !important;	
		}
	}
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


<div class="dropdown pull-left">
	<button class="pull-left tooltips"  data-toggle="dropdown"  id="btn-modal-multi-scope"
		data-toggle="tooltip" data-placement="bottom" 
		title="Mes lieux favoris">
		<i class="fa fa-bullseye" style=""></i>
	</button>
	<ul class="dropdown-menu" id="dropdown-multi-scope">
	    <li>
	      <div class="panel-body text-dark">
	 	  </div>
	 	</li>
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
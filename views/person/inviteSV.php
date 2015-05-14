<style>

#newInvite{
	display: none;
}
#newInvite .dropdown-menu{
	width: 100%;
}
#step2, #step3{
	display:none;
}

</style>
<div id="newInvite">
	<div class="col-md-6 col-md-offset-3">  
       	<div class="panel panel-white">
        	<div class="panel-heading border-light">
				<h1>Invite Someone</h1>
			    <p>  local or that might be interested by the platform</p>
			</div>
		<div class="panel-body">
			<form class="form-invite" autocomplete="off">
				<input class="invite-parentId hide"  id="inviteParentId" name="inviteParentId" type="text"/>
				<input class="invite-id hide" id = "inviteId" name="inviteId" type="text"/>
				<div class="row" id="step1">
					<div class="col-md-1">	
		           		<i class="fa fa-search fa-2x"></i> 
		           	</div>
					<div class="col-md-10">
						<div class="form-group">
							<input class="invite-search form-control" placeholder="Search Here" autocomplete = "off" id="inviteSearch" name="inviteSearch" value="">
				        		<ul class="dropdown-menu" id="dropdown_searchInvite" style="">
									<li class="li-dropdown-scope">-</li>
								</ul>
							</input>
						</div>
					</div>
				</div>
				<div class="row" id="step2">
		
					<div class="form-group" id="ficheUser">
						<div class="col-md-5">
							<?php $this->renderPartial('../pod/fileupload', array("itemId" => "",
																	  "type" => "",
																	  "contentId" =>"invitePhoto",
																	  "editMode" => false)); ?>
						</div>
						<div class="col-md-7">
							<a href="javascript:;" class="connectBtn btn btn-lg btn-light-blue tooltips " data-placement="top" data-original-title="I know this person" ><i class=" connectBtnIcon fa fa-link "></i>  I know this person</a>
							<hr>
							Nom : <p id="ficheName" name="ficheName"></p><br>
							Date de naissance : <p id="birth" name="birth" ></p><br>
							Tags : <p id="tags" name="tags" ></p><br>
						</div>
					</div>
				</div>
				<div class="row" id="step3">
					<div class="row">
						<div class="col-md-1 col-md-offset-1" id="iconUser">	
				           	<i class="fa fa-user fa-2x"></i>
				       	</div>
				       	<div class="col-md-9">
							<input class="invite-name form-control" placeholder="Name" id="inviteName" name="inviteName" value="" />
						</div>
					</div>
					<div class="row">
						<div class="col-md-1 col-md-offset-1">	
			           		<i class="fa fa-envelope-o fa-2x"></i>
			           	</div>
	    	        	<div class="col-md-9">
							<input class="invite-email form-control" placeholder="Email" id="inviteEmail" name="inviteEmail" value="" />
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-md-offset-1">
							<div class="form-group">
					    	    <button class="btn btn-primary" id="btnInviteNew" >Inviter</button>
					    	</div>
					    </div>
				    </div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
var userId = "<?php echo Yii::app()->session["userId"]; ?>";
jQuery(document).ready(function() {
 	bindinviteSubViewinvites();
 	runinviteFormValidation();
 	//disable submit in enter
	 $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });
	 
 	$('#inviteSearch').keyup(function(e){
	    var search = $('#inviteSearch').val();
	    if(search.length>2){
	    	clearTimeout(timeout)
			timeout = setTimeout('autoCompleteInviteSearch("'+search+'")', 500); 
		 }else{
		 	$("#newInvite #dropdown_searchInvite").css({"display" : "none" });	
		 }	
	});
	$('#inviteSearch').focusout(function(e){
		//$(".new-invite #dropdown_city").css({"display" : "none" });
	});

	$('#btnInviteNew').on("click", function(){
		$('.form-invite').submit();
	});
});

function bindinviteSubViewinvites() {
		
	$(".new-invite").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		$.subview({
			content : subViewContent,
			onShow : function() {
				editinvite();
			},
			onHide : function() {
				hideEditinvite();
			},
			onSave: function() {
				hideEditinvite();
			}
		});
	});

	$(".close-subview-button").off().on("click", function(e) {
		$(".close-subviews").trigger("click");
		e.prinviteDefault();
	});
};

var dateToShow, calendar, $inviteDetail, inviteClass, inviteCategory;
var oTable, contributors;
var subViewElement, subViewContent, subViewIndex;
var timeout;
var tabObject = [];

//validate new invite form
function runinviteFormValidation(el) {
var forminvite = $('.form-invite');
var errorHandler2 = $('.errorHandler', forminvite);
var successHandler2 = $('.successHandler', forminvite);

forminvite.validate({
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
		inviteName : {
			minlength : 2,
			required : true
		}
	},
	messages : {
		inviteName : "* Please specify your first name",
		inviteSearch : "* Please specify your email"
	},
	invalidHandler : function(invite, validator) {//display error alert on form submit
		successHandler2.hide();
		errorHandler2.show();
	},
	highlight : function(element) {
		$(element).closest('.help-block').removeClass('valid');
		// display OK icon
		$(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
		// add the Bootstrap error class to the control group
	},
	unhighlight : function(element) {// revert the change done by hightlight
		$(element).closest('.form-group').removeClass('has-error');
		// set error class to the control group
	},
	success : function(label, element) {
		label.addClass('help-block valid');
		// mark the current input as valid and display OK icon
		$(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
	},
	submitHandler : function(form) {
		successHandler2.show();
		errorHandler2.hide();
		newinvite = new Object;
		newinvite.parentId = $(".form-invite .invite-parentId").val(),
		newinvite.id = $(".form-invite .invite-id").val(),
		newinvite.name = $("#inviteName").val(), 
		newinvite.email = $("#inviteEmail").val(),
		$.blockUI({
			message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
            '<blockquote>'+
              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
              '<cite title="Hegel">Hegel</cite>'+
            '</blockquote> '
		});

		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+'/person/invitation',
	        dataType : "json",
	        data:newinvite,
			type:"POST",
	    })
	    .done(function (data) 
	    {
	    	$.unblockUI();
	        if (data &&  data.result) {               
	        	toastr.success('invite Created success');
	        	$.hideSubview();
	        	//console.log("updateinvite");
	        	//if(updateinvite != undefined && typeof updateinvite == "function"){
	        		//updateinvite( newinvite, data.id );
	        	//}	
	        } else {
	           toastr.error('Something Went Wrong');
	        }
	    });
	}
});
};

// on hide invite's form destroy summernote and bootstrapSwitch plugins
function hideEditinvite() {
	clearEditEvent();
	$.hideSubview();
	//$('.form-invite .summernote').destroy();
	//$(".form-invite .all-day").bootstrapSwitch('destroy');
};
// enables the edit form 
function editinvite(el) {
	$(".close-new-invite").off().on("click", function() {
		$(".back-subviews").trigger("click");
	});
	$(".form-invite .help-block").remove();
	$(".form-invite .form-group").removeClass("has-error").removeClass("has-success");
	

	if ( 'undefined' == typeof el) {
		$(".form-invite .invite-parentId").val("<?php echo Yii::app()->session['userId']; ?>");
		$(".form-invite .invite-id").val("");
		$(".form-invite .invite-name").val("");
		$(".form-invite .invite-search").val("");
	} else {
		$("#newInvite #dropdown_searchInvite").html("");
  		$("#newInvite #dropdown_searchInvite").css({"display" : "none" });
	}
};

// read invite
function readinvite(el) 
{
	$(".edit-invite").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		$.subview({
			content : subViewContent,
			onShow : function() {
				editinvite(el);
			},
			onHide : function() {
				hideEditinvite();
			},
			onSave : function(){
				hideEditinvite();
			}
		});
	});

};
	
function autoCompleteInviteSearch(email){
		var data = { "search" : email};
		ajaxPost("", '<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/'.$this->module->id?>/search/searchmemberautocomplete', data,
		function (data){
			var str = "<li class='li-dropdown-scope'><a href='javascript:newInvitation()'>Aucun résultat satisfaisant? Cliquez ici</li>";
			var compt = 0;

 			$.each(data["citoyens"], function(k, v) { 
 				console.log(k, v);
 				var htmlIco ="<i class='fa fa-user fa-2x'></i>"
 				if(v._id["$id"]!= userId){
 					tabObject.push(v);
	 				if('undefined' != typeof v.imagePath){
	 					var htmlIco= "<img width='50' height='50' alt='image' class='img-circle' src='"+v.imagePath+"'/>"
	 				}
	  				str += "<li class='li-dropdown-scope'><a href='javascript:setInviteInput("+compt+")'>"+htmlIco+" "+v.name + "</a></li>";
	  				compt++;
	  			}
  			}); 
  			$("#newInvite #dropdown_searchInvite").html(str);
  			$("#newInvite #dropdown_searchInvite").css({"display" : "inline" });
		});	
	}

function setInviteInput(num){
	var array = tabObject[num];
	$('#newInvite #inviteName').val(array["name"]);
	$('#newInvite #inviteId').val(array["_id"]["$id"]);
	$("#newInvite #step1").css({"display" : "none"});
	$("#newInvite #dropdown_searchInvite").css({"display" : "none" });	
	$("#newInvite #step2").css({"display" : "block"});
	$("#newInvite #ficheName").text(array["name"]);
	$("#newInvite #birth").text(array["birth"]);
	var tags = array["tags"];
	var tagsStr = "";
	for(var i= 0; i<tags.length; i++){
		tagsStr +=tags[i]+ " ";
	}
	$("#newInvite #tags").text(tagsStr);
	$("#invitePhoto_imgPreview").empty();
	$("#invitePhoto_imgPreview").html("<img src='"+array["imagePath"]+"' />");
}
function newInvitation(){
	$("#newInvite #step1").css({"display" : "none"});
	$("#newInvite #step3").css({"display" : "block"});
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if(emailReg.test( $("#newInvite #inviteSearch").val() )){
		$('#newInvite #inviteEmail').val( $("#newInvite #inviteSearch").val());
	}else{
		$("#newInvite #inviteName").val($("#newInvite #inviteSearch").val());
	}
}

function clearEditEvent(){
	$("#newInvite #step1").css({"display" : "block"});
	$("#newInvite #dropdown_searchInvite").css({"display" : "none" });	
	$("#newInvite #step2").css({"display" : "none"});
	$("#newInvite #step3").css({"display" : "none"});
}
	
</script>
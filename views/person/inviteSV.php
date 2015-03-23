<style>

#newInvite{
	display: none;
}

</style>
<div id="newInvite">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h1>Invite Someone</h1>
	    <p>  local or that might be interested by the platform</p>
		<form class="form-invite" autocomplete="off">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input class="invite-id hide"  id="sponsorPA" name="sponsorPA" type="text">
						<input class="invite-name form-control" name="inviteName" type="text" placeholder="name">
						<input class="invite-email form-control" placeholder="Email" autocomplete = "off" id="inviteEmail" name="inviteEmail" value="">
			        		<ul class="dropdown-menu" id="dropdown_email" style="">
								<li class="li-dropdown-scope">-</li>
							</ul>
						</input>
					</div>
				</div>
			<div class="pull-right">
				<div class="btn-group">
					<a href="#" class="btn btn-info close-subview-button">
						Close
					</a>
				</div>
				<div class="btn-group">
					<button class="btn btn-info save-new-invite" type="submit">
						Save
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
 	bindinviteSubViewinvites();
 	runinviteFormValidation();
 	$('#inviteEmail').keyup(function(e){
	    var email = $('#inviteEmail').val();
	    clearTimeout(timeout);
	    timeout = setTimeout('autoCompleteEmail("'+email+'")', 500);		
	});
	$('#inviteEmail').focusout(function(e){
		//$(".new-invite #dropdown_city").css({"display" : "none" });
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
		},
		inviteEmail : {
			minlength: 3,
			required : true
		}
	},
	messages : {
		inviteName : "* Please specify your first name",
		inviteEmail : "* Please specify your email"
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
		newinvite.sponsorPA = $(".form-invite .invite-id").val(),
		newinvite.name = $(".form-invite .invite-name ").val(), 
		newinvite.email = $(".form-invite .invite-email ").val(),
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
	

	if ( typeof el == "undefined") {
		$(".form-invite .invite-id").val("<?php echo Yii::app()->session['userId']; ?>");
		$(".form-invite .invite-name").val("");
		$(".form-invite .invite-email").val("");
	} else {
		
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
	
function autoCompleteEmail(email){
		var data = { "email" : email};
		testitpost("", '<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/'.$this->module->id?>/person/RecueilinfoEmailAutoComplete', data,
		function (data){
			var str = ""; var limit=0;
 			$.each(data, function() { limit++;
 				if(limit < 9) 
  				str += "<li class='li-dropdown-scope'><a href='javascript:setEmailInput(\""+ this.email +"\")'>" + this.email + "</li>";
  			}); 
  			if(str == "") str = "<li class='li-dropdown-scope'>Aucun résultat</li>";
  			$("#newInvite #dropdown_email").html(str);
  			$("#newInvite #dropdown_email").css({"display" : "inline" });
		});	
	}

function setEmailInput(email){
	$('#inviteEmail').val(email);
	$("#dropdown_email").css({"display" : "none" });	
}
	
</script>
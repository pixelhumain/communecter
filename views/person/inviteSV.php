<style>

#newInvite{
	<?php if( @$isNotSV ){ ?>
	display: none;
	<?php } ?>
}
#newInvite .dropdown-menu{
	width: 100%;
}
#step2, #step3{
	display:none;
}

.margin-bottom-10 {
	margin-bottom: 10px;
}

.city-search {
    font-size: 0.95rem;
    font-weight: 300;
    line-height: 0.8125rem;
}
</style>

<?php if( @$isNotSV ){ ?>
<a class="text-red pull-right" href="#" onclick="showPanel('box-login')"><i class="fa fa-times"></i></a>
<?php } ?>
<div id="newInvite">
	<?php 
	$size = ( !@$isNotSV ) ? "col-md-6 col-md-offset-3" : "col-md-12 height-230"
	?>
	<div class="<?php echo $size ?>" >  
       	<div class="panel panel-white">
       		
        	<div class="panel-heading border-light">
        		<?php if( !@$isNotSV ){ ?>
					<h1>Connect people to your network</h1>
				<?php } ?>	
			    <p> 
			    Find people you know by name or email.
			    </p>
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
						<div class="col-md-5 text-center">
							<div class='photoInvited text-center'>
							</div>
							<a class='pending btn btn-xs btn-red tooltips' data-toggle="tooltip" data-placement="bottom" title="This user has been already invited but has not connected yet.">Pending User</a>
						</div>
						<div class="col-md-7">
							<a href="javascript:;" class="connectBtn btn btn-lg btn-light-blue tooltips " data-placement="top" data-original-title="Follow this person" ><i class=" connectBtnIcon fa fa-link "></i>  Follow this person</a>
							<a href="javascript:;" class="disconnectBtn btn btn-lg btn-light-blue tooltips " data-placement="top" data-original-title="Unfollow this person" ><i class=" disconnectBtnIcon fa fa-unlink "></i>  Unfollow this person</a>
							<hr>
							<h2 id="ficheName" name="ficheName"></h2>
							<span id="email" name="email" ></span><br><br>
							<span id="address" name="address" ></span><br><br>
							<span id="tags" name="tags" ></span><br>
						</div>
					</div>
	               	<div class ="row">
		               	<div class="col-md-10  col-md-offset-1">	
							<a href="javascript:backToSearch()"><i class="fa fa-search"></i> Search</a>
						</div>
					</div>
				</div>
				<div class="row" id="step3">
					<div class="row margin-bottom-10">
						<div class="col-md-1 col-md-offset-1" id="iconUser">	
				           	<i class="fa fa-user fa-2x"></i>
				       	</div>
				       	<div class="col-md-9">
							<input class="invite-name form-control" placeholder="Name" id="inviteName" name="inviteName" value="" />
						</div>
					</div>
					<div class="row margin-bottom-10">
						<div class="col-md-1 col-md-offset-1">	
			           		<i class="fa fa-envelope-o fa-2x"></i>
			           	</div>
	    	        	<div class="col-md-9">
							<input class="invite-email form-control" placeholder="Email" id="inviteEmail" name="inviteEmail" value="" />
						</div>
					</div>
					<div class="row margin-bottom-10">
						<div class="col-md-1 col-md-offset-1">	
			           		<i class="fa fa-align-justify fa-2x"></i>
			           	</div>
	    	        	<div class="col-md-9">
							<textarea class="invite-text form-control" id="inviteText" name="inviteText" rows="4" />
						</div>
					</div>
					<div class="row margin-bottom-10">
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
var currentUser = <?php echo json_encode($currentUser) ?>;
var tags;

var subViewElement, subViewContent;
var timeout;
var tabObject = [];

jQuery(document).ready(function() {
 	initSubView();
 	bindInviteSubViewInvites();
 	runinviteFormValidation();
});

function bindInviteSubViewInvites() {	

	$(".connectBtn").off().on("click", function() {
		connectPerson();
	});
	$(".disconnectBtn").off().on("click", function() {
		disconnectPerson();
	});

	$('#inviteSearch').keyup(function(e){
	    var search = $('#inviteSearch').val();
	    if(search.length>2){
	    	clearTimeout(timeout);
			timeout = setTimeout('autoCompleteInviteSearch("'+encodeURI(search)+'")', 500); 
		 }else{
		 	$("#newInvite #dropdown_searchInvite").css({"display" : "none" });	
		 }	
	});
};

function connectPerson() {
	console.log("connect Person");
	$.ajax({
		type: "POST",
		url: baseUrl+"/"+moduleId+'/person/connect',
		dataType : "json",
		data : {
			connectUserId : $('#newInvite #inviteId').val(),
		}
	})
	.done(function (data) {
		$.unblockUI();
		if (data &&  data.result) {
			var name = $("#newInvite #ficheName").text();
			toastr.success('You are now following '+name);
			$.hideSubview();
			if(updateInvite != undefined && typeof updateInvite == "function"){
				updateInvite(data.invitedUser);
			}	
		} else {
			$.unblockUI();
			toastr.error('Something Went Wrong !');
		}
	});
}

function disconnectPerson() {
	var idToDisconnect = $('#newInvite #inviteId').val();
	var typeToDisconnect = "<?php echo Person::COLLECTION ?>";
	var nameToDisconnect = $("#newInvite #ficheName").text();

	bootbox.confirm("Are you sure you want to delete <span class='text-red'>"+nameToDisconnect+"</span> connection ?", 
		function(result) {
			if (!result) {
				return;
			}
			var urlToSend = baseUrl+"/"+moduleId+"/person/disconnect/id/"+idToDisconnect+"/type/"+typeToDisconnect+"/ownerLink/knows";
			$.ajax({
				type: "POST",
				url: urlToSend,
				dataType: "json",
				success: function(data){
					if ( data && data.result ) {               
						toastr.info("You are not following this person anymore.");
						$("#citoyens"+idToDisconnect).remove();
						if ($("#people tr").length == 0) {
							$("#info").show();
						}
					} else {
						toastr.error(data.msg);
					}
				},
				error: function(data) {
					toastr.error("Something went really bad !");
				}
			});
		}
	);
}

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
				required : true
			}
		},
		messages : {
			inviteName : "* Please specify a name",
			inviteSearch : "* Please specify a email"
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
			console.log("submit handler");
			successHandler2.show();
			errorHandler2.hide();
			var parentId = $(".form-invite .invite-parentId").val();
			var invitedUserName = $("#inviteName").val();
			var invitedUserEmail = $("#inviteEmail").val();
			$.blockUI({
				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
	            '<blockquote>'+
	              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
	              '<cite title="Hegel">Hegel</cite>'+
	            '</blockquote> '
			});

			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+'/person/connect',
		        dataType : "json",
		        data: {
		        	parentId : parentId,
		        	invitedUserName : invitedUserName,
		        	invitedUserEmail : invitedUserEmail
		        },
				type:"POST",
		    })
		    .done(function (data) {
		    	$.unblockUI();
		        if (data &&  data.result) {               
		        	toastr.success('The invitation has been sent with success !');
		        	$.hideSubview();
		        	if(updateInvite != undefined && typeof updateInvite == "function"){
		        		updateInvite(data.invitedUser, true);
		        	}	
		        } else {
		        	$.unblockUI();
					toastr.error(data.msg);
		        }
		    });
		}
	});
};

// init subview
function initSubView() {
	$(".form-invite .invite-parentId").val("<?php echo Yii::app()->session['userId']; ?>");
	$(".form-invite .invite-id").val("");
	$(".form-invite .invite-name").val("");
	$(".form-invite .invite-search").val("");
};


function autoCompleteInviteSearch(search){
	tabObject = [];
	var data = { 
		"search" : search,
		"searchMode" : "personOnly"
	};
	
	ajaxPost("", '<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/'.$this->module->id?>/search/searchmemberautocomplete', data,
		function (data){
			var str = "<li class='li-dropdown-scope'><a href='javascript:newInvitation()'>Pas trouvé ? Lancer une invitation à rejoindre votre réseau !</li>";
			var compt = 0;
			var city, postalCode = "";
			$.each(data["citoyens"], function(k, v) { 
				city = "";
				postalCode = "";
				var htmlIco ="<i class='fa fa-user fa-2x'></i>"
				if(v._id["$id"]!= userId) {
					tabObject.push(v);
	 				if(v.profilImageUrl != ""){
	 					var htmlIco= "<img width='50' height='50' alt='image' class='img-circle' src='"+baseUrl+v.profilImageUrl+"'/>"
	 				}
	 				if (v.address != null) {
	 					city = v.address.addressLocality;
	 					postalCode = v.address.postalCode;
	 				}
	  				str += 	"<li class='li-dropdown-scope'>" +
	  						"<a href='javascript:setInviteInput("+compt+")'>"+htmlIco+" "+v.name + 
	  						"<span class='city-search'> "+postalCode+" "+city+"</span>"+"</a>"+
	  						"</li>";
	  				compt++;
  				}
			}); 
			$("#newInvite #dropdown_searchInvite").html(str);
			$("#newInvite #dropdown_searchInvite").css({"display" : "inline" });
		}
	);	
}

function setInviteInput(num){
	var person = tabObject[num];
	var personId = person["_id"]["$id"];
	console.log(person, personId);

	$('#newInvite #inviteName').val(person["name"]);
	$('#newInvite #inviteId').val(personId);
	$("#newInvite #ficheName").text(person["name"]);
	
	if (person.address != null) {
		//Address : CP + Locality
		$("#newInvite #address").text(person.address.postalCode+" "+person.address.addressLocality);
	}
	
	if (person.email != null) {
		//Email
		$("#newInvite #email").text(person.email);
	}
	//Tags
	var tagsStr = "";
	if( "object" == typeof person.tags && person.tags ) {
		$.each( person.tags , function(i,tag){
			tagsStr += "<span class='label label-inverse'>"+tag+"</span> ";
		});
	} else {
		tagsStr += "<span class='label label-inverse'>No Tag</span> ";
	}
	$("#newInvite #tags").html('<div class="pull-left"><i class="fa fa-tags"></i> '+tagsStr+'</div>');
	$(".photoInvited").empty();
	if (person["profilImageUrl"] != "") {
		$(".photoInvited").html("<img class='img-responsive' src='"+baseUrl+person["profilImageUrl"]+"' />");
	} else {
		$(".photoInvited").html("<span><i class='fa fa-user_circled' style='font-size: 10em;'></i></span>");
	}

	//Pending
	if (person.pending == true) {
		$(".pending").show();
	} else {
		$(".pending").hide();
	}

	//Already in the network of the current user
	if (currentUser.links != null && currentUser.links.knows != null && currentUser.links.knows[personId] != null) {
		$('.disconnectBtn').show();
		$('.connectBtn').hide();
	} else {
		$('.disconnectBtn').hide();
		$('.connectBtn').show();
	}

	//Show / Hide steps
	$("#newInvite #step1").css({"display" : "none"});
	$("#newInvite #dropdown_searchInvite").css({"display" : "none" });	
	$("#newInvite #step2").css({"display" : "block"});
}

function newInvitation(){
	$("#newInvite #step1").css({"display" : "none"});
	$("#newInvite #step3").css({"display" : "block"});
	
	$('#newInvite #inviteId').val("");
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if(emailReg.test( $("#newInvite #inviteSearch").val() )){
		$('#newInvite #inviteEmail').val( $("#newInvite #inviteSearch").val());
	}else{
		$("#newInvite #inviteName").val($("#newInvite #inviteSearch").val());
	}

	$("#inviteText").val("Bonjour ! \nViens me rejoindre sur ce site ! \nUn email, un code postal et tu es communecter ! \ Tu peux voir tout ce qu'il se passe dans ta commune et agir pour le bien commun ! \n");
}

function backToSearch(){
	$("#newInvite #step1").css({"display" : "block"});
	$("#newInvite #dropdown_searchInvite").css({"display" : "none" });	
	$("#newInvite #step2").css({"display" : "none"});
	$("#newInvite #step3").css({"display" : "none"});

	autoCompleteInviteSearch($('#inviteSearch').val());
}


</script>
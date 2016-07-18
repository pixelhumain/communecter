<?php 
$cssAnsScriptFilesTheme = array(
	//autosize
	'/assets/plugins/autosize/jquery.autosize.min.js',
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
?>

<div id="changePassword" >
	<!-- start: PAGE CONTENT -->
	<div class="noteWrap col-md-6 col-md-offset-3">
	    <!-- <div class="panel panel-white"> -->
        	<!-- <div class="panel-heading border-light"> -->
				<h1 class="text-red" style="font-size:20px;"><i class="fa fa-key"></i> Changer votre mot de passe</h1>
			<!-- </div> -->
		<!-- </div> -->
		<div class="panel-body">
			<form id="passwordForm" role="form">
				<div class="row">
					<div class="col-md-12">
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
						</div>
						<div class="successHandler alert alert-success no-display">
							<i class="fa fa-ok"></i> Your form validation is successful!
						</div>
					</div>
					<div>
						<div class="col-md-12 col-xs-12">
							<div class="form-group">
								<label class="control-label">
									Ancien mot de passe <span class="symbol required"></span>
								</label>
								<input id="oldPassword" class="form-control" name="oldPassword" type="password"/>
							</div>

							<div class="form-group">
								<label class="control-label">
									Nouveau mot de passe <span class="symbol required"></span>
								</label>
								<input id="newPassword" class="form-control" name="newPassword" type="password" />
							</div>

							<div class="form-group">
								<label class="control-label">
									Répétez le nouveau mot de passe <span class="symbol required"></span>
								</label>
								<input id="newPassword2" class="form-control" name="newPassword2" type="password" />
							</div>
						<div>
						<div class="row">
							<div class="col-md-12">
								<div>
									<span class="symbol required"></span><?php echo Yii::t("common","Required Fields",null,Yii::app()->controller->module->id) ?>
									<hr>
								</div>
							</div>
						</div>
						<button class="btn btn-success" id="btnChangePassword"><i class="fa fa-save"></i> <?php echo Yii::t("common","Change password",null,Yii::app()->controller->module->id) ?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

var formValidator = function() {
	addCustomValidators();
	var form = $('#passwordForm');
	var errorHandler = $('.errorHandler');
	form.validate({
		rules : {
			oldPassword : {
				required : true
			},
			newPassword : {
				required : true,
				minlength : 8
			},
			newPassword2 : {
				required : true,
				minlength : 8,
  				equalTo : "#newPassword"
			}
		},
		submitHandler : function(form) {
			$.blockUI({
				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
	            '<blockquote>'+
	              "<p>C'est le devoir de chaque homme de rendre au monde au moins autant qu'il en a reçu..</p>"+
	              '<cite title="Einstein">Einstein</cite>'+
	            '</blockquote> '
			});

	        $.ajax({
		    	  type: "POST",
		    	  dataType: "json",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/person/changepassword",
		    	  data: {
					"mode" : "changePassword",
	            	"id" : userId, 
		    	  	"oldPassword" : $('#oldPassword').val(),
		    	  	"newPassword" : $('#newPassword').val()
		    	  },
		    	  success: function(data){
		    			if(!data.result){
	                        toastr.error(data.msg);
	                   	}
	                    else { 
	                        toastr.success(data.msg);
							loadByHash("#person.detail.id."+userId);
	                    }
		    	  },
		    	  error: function(data) {
						toastr.error("Something went really bad : contact your admin." + data.msg);
		    	  },
		    	  
		    });
	       	return false; // required to block normal submit since you used ajax
		},
		invalidHandler : function(event, validator) {//display error alert on form submit
			errorHandler.show();
		}
	});
}

jQuery(document).ready(function() {
	$(".moduleLabel").html("<i class='fa fa-lock'></i> <?php echo Yii::t("common","Change password") ?>");
	$("#changePassword").show();
	formValidator();
});

function changePassword() {
	console.log("change Password !");
	$('#passwordForm').submit();
}





</script>	


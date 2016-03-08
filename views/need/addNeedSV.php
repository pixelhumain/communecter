<?php
$cssAnsScriptFilesTheme = array(
	'/assets/plugins/ion.rangeSlider/js/ion.rangeSlider.min.js',
	'/assets/plugins/ion.rangeSlider/css/ion.rangeSlider.css',
	'/assets/plugins/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css',
	'/assets/plugins/ion.rangeSlider/css/normalize.min.css',
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);


	$cssAnsScriptFilesModule = array(
		'/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
		'/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js' , 
		'/plugins/moment/min/moment.min.js' , 
		'/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css',
		'/plugins/bootstrap-daterangepicker/daterangepicker.js' , 
		'/plugins/autosize/jquery.autosize.min.js'
	);
	HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");
?>
<style>

.li-dropdown-scope{
	padding: 8px 3px;
}
#iconeChargement{
	visibility: hidden;
}

#formNewNeed{
	display: none;
}
.explainLimit{
	color:#1fbba6;
	font-style: italic;
	display:inline-block;
	margin-left: 2%;
	margin-top: 4px;
}
.rangeRemunaration{
	display:none;
	margin-top:4px;
}

#newNeed{
		float: left;
		padding: 10px;
		background-color: rgba(242, 242, 242, 0.9);
		width: 100%;
		-moz-box-shadow: 1px 1px 5px 3px #cfcfcf;
		-webkit-box-shadow: 1px 1px 5px 3px #cfcfcf;
		-o-box-shadow: 1px 1px 5px 3px #cfcfcf;
		box-shadow: 1px 1px 5px 3px #cfcfcf;
		filter:progid:DXImageTransform.Microsoft.Shadow(color=#cfcfcf, Direction=134, Strength=5);
	}

#newNeed input, #newNeed button.dropdown-toogle, #newNeed textarea{
	border: 1px solid #CCC !important;
}
#newNeed .select2-input{
	border:none !important;
}

#newNeed .bootstrap-switch-primary{
	background-color: #00BDCC !important;
}
#newNeed .control-label{
	font-weight: 300;
	font-size: 16px;
	/*color:#00BDCC !important;*/
}

</style>
<?php 
	if(@$project)
		Menu::project($project);
	else 
		Menu::organization($organization);
	$this->renderPartial('../default/panels/toolbar'); 
?>
<div id="newNeed">
		<h2 class='radius-10 padding-10 text-azure text-bold'><i class="fa fa-plus"></i> <?php echo Yii::t("need","Add a need",null,Yii::app()->controller->module->id) ?></h2>
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-white">
			<div class="panel-heading border-light">
				<p><?php echo Yii::t("need","Task will show what's next in the project",null,Yii::app()->controller->module->id) ?></p>
			</div>
			<div class="panel-body">
				<form class="form-need" autocomplete="off">
					<input  class="parent-id"  id="parentId" name="parentId" type="hidden" value='<?php echo $_GET["id"]; ?>'>
					<input  class="parent-type"  id="parentType" name="parentType" type="hidden" value='<?php echo $_GET["type"]; ?>'>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group"  id="addNeedSection">
								<div class='row center'>
									<h2 class="text-azure"><i class="fa fa-angle-down"></i> <?php echo Yii::t("need","What do you need ?",null,Yii::app()->controller->module->id) ?></h2>
									<input type="hidden" id="needType"/>
				            		<div class="btn-group ">
										<a id="btnServices" href="javascript:;" onclick="switchTypeNeed('services')" class="btn btn-azure">
											<i class="fa fa-circle-thin"></i> <?php echo Yii::t("need","Services",null,Yii::app()->controller->module->id) ?>
										</a>
										<a id="btnCompetences" href="javascript:;" onclick="switchTypeNeed('competences')" class="btn btn-azure">
											<i class="fa fa-circle-thin"></i> <?php echo Yii::t("need","Competences",null,Yii::app()->controller->module->id) ?>
										</a>
										<a id="btnMaterials" href="javascript:;" onclick="switchTypeNeed('materials')" class="btn btn-azure">
											<i class="fa fa-circle-thin"></i> <?php echo Yii::t("need","Materials",null,Yii::app()->controller->module->id) ?>
										</a>
									</div>
					            </div><br>
				                <div id="formNewNeed" class='text-center'>
					    	        <div class="col-md-12 form-group">
					    	        	<label class="control-label text-dark col-md-12">
					    	        		<i class="fa fa-angle-down"></i> 
											<?php echo Yii::t("need","Name of need",null,Yii::app()->controller->module->id) ?><span class="symbol required"></span>
										</label>
							           	<div class="row col-md-12 no-padding">
					    	        		<input class="need-name form-control text-center" placeholder="<?php echo Yii::t("need","Name of need",null,Yii::app()->controller->module->id) ?> ..." id="needName" name="needName" value=""/>
										</div>		    	        
					    	        </div>
					    	        <div class="col-md-4 form-group">
										<label class="control-label text-dark">
					    	        		<i class="fa fa-angle-down"></i> 
											Quantité <span class="symbol required"></span>
										</label></br>
										<input type="number" class="need-quantity" name="need-quantity" value="1">
									</div>

									<div class="col-md-4 form-group duration">
								    	<label class="control-label text-dark">
					    	        		<i class="fa fa-angle-down"></i> 
											Durée limitée? 
										</label>
										<div class="col-md-12 no-padding">
											<input class="hide" id="needIsPonctual" name="needIsPonctual" value="ponctuel"></input>
											<input type="checkbox" data-on-text="<?php echo Yii::t("common","YES") ?>" data-off-text="<?php echo Yii::t("common","NO") ?>" name="my-checkbox" checked></input>
										</div>
										</br><p class="explainLimit">Besoin ponctuel</p>
									</div>

									<div class="col-md-4 form-group remunarate">
								    	<label class="control-label text-dark">
					    	        		<i class="fa fa-angle-down"></i> 
											Rémunération
										</label>
										<div class="col-md-12 no-padding">
											<input class="hide" id="needIsRemunerate" name="needIsRemunerate" value="volontaire"></input>
											<input type="checkbox" data-on-text="<?php echo Yii::t("common","YES") ?>" data-off-text="<?php echo Yii::t("common","NO") ?>" name="benefits-checkbox"></input>
										</div>
										<div class="col-md-12 rangeRemunaration">
											<input type="text" id="range_remunerate" name="rangeBenefits" value="" />
										</div>
										</br><p class="explainLimit">Volontaire</p>
										
									</div>

					               	
									<div class='col-md-12 form-group rangeDatePonctual'>
										<label class="control-label text-dark">
					    	        		<i class="fa fa-angle-down"></i> 
											Durée du besoin <span class="symbol required"></span>
										</label>
										<div class="all-day-range">
											<div class="">
												<div class="">
													<div class="">
														<span class="input-icon">
															<input type="text" class="need-range-date form-control text-center" name="" placeholder="Range date"/>
															<i class="fa fa-calendar"></i> </span>
													</div>
												</div>
											</div>
										</div>
										<div class="hide">
											<input type="text" class="need-start-date" value="" name="needStartDate"/>
											<input type="text" class="need-end-date" value="" name="needEndDate"/>
										</div>
									</div>

									
									<div class="">
										<div class="row center">
							    	        <button class="btn btn-success" style="min-width:40%;"><i class="fa fa-check"></i> Enregistrer</button>
							    	    </div>
							    	</div>
						    	</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var parentId = $(".form-need #parentId").val();
	var parentType = $(".form-need #parentType").val();
	if (parentType=="projects"){
		typeRedirect="project";
		iconRedirect="fa-lightbulb-o";
	}
	jQuery(document).ready(function() {
		 $(".moduleLabel").html("<i class='fa fa-cubes'></i> <span id='main-title-menu'>Ajouter un besoin</span>");
	 	bindSubViewNeed();
	 	runNeedFormValidation();
	});
	
	function bindSubViewNeed() {	
		$(".new-need").off().on("click", function() {
			subViewElement = $(this);
			//$(".form-contributor .contributor-id").val($(this).data("id"));
			subViewContent = subViewElement.attr('href');
			$.subview({
				content : subViewContent,
				onShow : function() {
					editNeed();
				},
				onHide : function() {
					hideEditNeed();
				},
				onSave: function() {
					hideEditNeed();
				}
			});
		});
		$(".close-subview-button").off().on("click", function(e) {
			$(".close-subviews").trigger("click");
			e.prinviteDefault();
		});
	};

	var subViewElement, subViewContent, subViewIndex;
	var timeout;

	function runNeedFormValidation(el) {
		var formNeed = $('.form-need');
		var errorHandler2 = $('.errorHandler', formNeed);
		var successHandler2 = $('.successHandler', formNeed);
		
	    $("#range_remunerate").ionRangeSlider({
		   type: "double",
		   min: 0,
		   max: 1000,
		   from: 200,
		   to: 300,
		   grid: true
		});
		// INITIALISATION OF DATEPICKER
		$(".need-start-date").val(moment());
		$(".need-end-date").val(moment().add('days', 1));
		$('.need-range-date').val(moment().format('DD/MM/YYYY') + ' - ' + moment().add('days', 1).format('DD/MM/YYYY'))
				.daterangepicker({  
					startDate: moment(),
					endDate: moment().add('days', 1),
					format: 'DD/MM/YYYY'
				},
				function(start, end, label) {
	    			$(".need-start-date").val(start);
					$(".need-end-date").val(end);
				}
			);
	
		$('.need-range-date').on('apply.daterangepicker', function(ev, picker) {
			$(".need-start-date").val(picker.startDate);
			$(".need-end-date").val(picker.endDate);
		});
	
		var startDate = moment($("need-start-date").val());
		var endDate = moment($("need-end-date").val());
	
		$('.need-range-date').data('daterangepicker').setStartDate(startDate);
		$('.need-range-date').data('daterangepicker').setEndDate(endDate);
		// INITIALIZATION OF SWITCH
		$("[name='my-checkbox'],[name='benefits-checkbox']").bootstrapSwitch();
		$("[name='my-checkbox']").on("switchChange.bootstrapSwitch", function (event, state) {
			console.log("state = "+state );
			if (state == true) {
				$("#newNeed #needIsPonctual").val("Ponctuel");
				$("#newNeed .rangeDatePonctual").slideDown();
				$("#newNeed .duration .explainLimit").fadeIn().text("Besoin ponctuel");
			} else {
				$("#newNeed #needIsPonctual").val("Permanent");
				$("#newNeed .rangeDatePonctual").slideUp();
				$("#newNeed .duration .explainLimit").fadeIn().text("Besoin permanent");
			}
		});
		$("[name='benefits-checkbox']").on("switchChange.bootstrapSwitch", function (event, state) {
			console.log("state = "+state );
			if (state == true) {
				$("#newNeed #needIsRemunerate").val("Rémunéré");
				$("#newNeed .rangeRemunaration").slideDown();
				$("#newNeed .remunarate .explainLimit").fadeIn().text("Indiquer une échelle");
			} else {
				$("#newNeed #needIsRemunerate").val("Volontaire");
				$("#newNeed .rangeRemunaration").slideUp();
				$("#newNeed .remunarate .explainLimit").fadeIn().text("Volontaire");
			}
		});

		formNeed.validate({
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
				needName : {
					minlength : 2,
					required : true
				}			
			},
			messages : {
				needName : "* Please specify a name for your need"
			},
			invalidHandler : function(contributor, validator) {//display error alert on form submit
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
				id=$("#projectID").val();
				newNeed = new Object;
				newNeed.parentId = parentId,
				newNeed.parentType = parentType,
				newNeed.type = $(".form-need #needType").val();
				newNeed.name = $(".form-need .need-name").val(), 
				newNeed.quantity = $('.form-need .need-quantity').val(), 
				newNeed.needIsPonctual=$('.form-need #needIsPonctual').val(), 
				newNeed.needIsRemunerate = $(".form-need #needIsRemunerate").val();
				if ($('.form-need #needIsPonctual').val()=="ponctuel"){
					newNeed.startDate = moment($(".need-start-date").val()).format('YYYY-MM-DD'),
					newNeed.endDate = moment($(".need-end-date").val()).format('YYYY-MM-DD');
				}
				$.blockUI({
					message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
		            '<blockquote>'+
		              '<p>Quand le pouvoir de l\'amour l\'emportera sur l\'amour du pouvoir, le monde connaîtra la paix.</p>'+
		              '<cite title="Hegel">Jimy Hendrix</cite>'+
		            '</blockquote> '
				});
				console.log(newNeed);
				//if ($(".form-contributor .contributor-id").val() !== "") {
					el = $(".form-contributor .contributor-id").val();
					//mockjax simulates an ajax call
					$.mockjax({
						url : '/contributor/edit/webservice',
						dataType : 'json',
						responseTime : 1000,
						responseText : {
							say : 'ok'
						}
					});
								
					$.ajax({
				        type: "POST",
				        url: baseUrl+"/"+moduleId+'/need/saveneed',
				        dataType : "json",
				        data:newNeed,
						type:"POST",
				    })
				    .done(function (data) 
				    {
				    	$.unblockUI();
				        if (data &&  data.result) {  
					        console.log(data);           
				        	toastr.success('Need added successfuly');
				        	loadByHash("#need.detail.id."+data.idNeed.$id);				        		
				        } else {
				           toastr.error('Something Went Wrong');
				        }
				    });

				//}
			}
		});
	};
	function setMemberInputAddNeed(id, name, email, type, organizationType){
		/*$("#iconeChargement").css("visibility", "hidden")
		$("#newNeed #contributorSearch").val(name);
		$("#newNeed #contributorName").val(name);
		$("#newNeed #contributorId").val(id);
		$('#newNeed #contributorEmail').val(email);
		$('#newNeed #contributorEmail').attr("disabled", 'disabled');
		$("#newNeed #contributorName").attr("disabled", 'disabled');

		if(type=="citoyens"){
			$("#newNeed #btnCitoyen").trigger("click");
			$("#newNeed #btnOrganization").addClass("disabled");
		}else{
			$("#newNeed #btnOrganization").trigger("click");
			$("#newNeed #btnCitoyen").addClass("disabled");
			$('#newNeed #organizationType').val(organizationType);
			$('#newNeed #organizationType').attr("disabled", 'disabled');
		}
		$("#newNeed #dropdown_search").css({"display" : "none" });
		$("#newNeed #addContributorSection").css("display", "block");
		$("#newNeed #searchMemberSection").css("display", "none");*/

	}
	function openNewNeedForm(){
		$("#newNeed #addNeedection").css("display", "block");
		$("#newNeed #formNewNeed").css("display", "none");
		$("#newNeed .need-name").val("");
		$("#newNeed .need-quantity").val("1");
		$("#newNeed .need-start-date").val(moment());
		$("#newNeed .need-end-date").val(moment().add('days', 1));
		$("#newNeed .btn-group a").removeClass("btn-dark-azure").addClass("btn-azure");
		$("[name='my-checkbox']").bootstrapSwitch('state', true);
		$("[name='benefits-checkbox']").bootstrapSwitch('state', false);
	}
		
	function switchTypeNeed(str){
		$("#newNeed #formNewNeed").css("display", "block");
		if(str=="services" || str=="competences"){ 
			if(str=="competences"){
				$("#newNeed #btnCompetences").removeClass("btn-azure");
				$("#newNeed #btnCompetences").addClass("btn-dark-azure");
				$("#newNeed #btnServices, #newNeed #btnMaterials").removeClass("btn-dark-azure");
				$("#newNeed #btnServices, #newNeed #btnMaterials").addClass("btn-azure");
				showCheckIconTypeNeed("btnCompetences");
			}
			else{
				$("#newNeed #btnServices").removeClass("btn-azure");
				$("#newNeed #btnServices").addClass("btn-dark-azure");
				$("#newNeed #btnCompetences, #newNeed #btnMaterials").removeClass("btn-dark-azure");
				$("#newNeed #btnCompetences, #newNeed #btnMaterials").addClass("btn-azure");
				showCheckIconTypeNeed("btnServices");
			}
		}else{
			$("#newNeed #btnMaterials").removeClass("btn-azure");
			$("#newNeed #btnMaterials").addClass("btn-dark-azure");
			$("#newNeed #btnServices, #newNeed #btnCompetences").removeClass("btn-dark-azure");
			$("#newNeed #btnServices, #newNeed #btnCompetences").addClass("btn-azure");
			showCheckIconTypeNeed("btnMaterials");
		}
		$("#newNeed #needType").val(str);
	}

	function showCheckIconTypeNeed(id){
		$("#newNeed .btn-group i").removeClass("fa-check-circle-o");
		$("#newNeed .btn-group i").addClass("fa-circle-thin");
		$("#newNeed #"+id+" i").removeClass("fa-circle-thin");
		$("#newNeed #"+id+" i").addClass("fa-check-circle-o");
	}


	// on hide contributor's form destroy summernote and bootstrapSwitch plugins
	function hideEditNeed() {
			openMainPanelFromPanel( '/'+typeRedirect+'/detail/id/'+parentId, typeRedirect+' : <?php if (@$_GET["parentName"]) echo addslashes($_GET["parentName"]) ?>',iconRedirect, parentId );
	};
	// enables the edit form 
	function editNeed(el) {
		$(".close-new-need").off().on("click", function() {
			$(".back-subviews").trigger("click");
		});
		$(".form-need .help-block").remove();
		$(".form-need .form-group").removeClass("has-error").removeClass("has-success");
	};
</script>
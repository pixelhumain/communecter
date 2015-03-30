<?php
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.pulsate/jquery.pulsate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/pages-user-profile.js' , CClientScript::POS_END);
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/dropzone/downloads/css/teeo.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/dropzone/downloads/dropzone.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/nvd3/lib/d3.v3.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/nvd3/lib/d3.tip.v0.6.3.js' , CClientScript::POS_END);
?>
<!-- start: PAGE CONTENT -->

<div class="row" >
	<div class="col-sm-12">
		<div class="tabbable">
			<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
				<li class="active">
					<a data-toggle="tab" href="#panel_overview">
						Overview
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#panel_edit_account">
						Edit Account
					</a>
				</li>
				
				<li>
					<a data-toggle="tab" href="#panel_people">
						People
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#panel_organisations">
						Organizations
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#panel_events">
						Events
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#panel_projects">
						Projects
					</a>
				</li>

				
			</ul>
			<div class="tab-content">
				<?php 
					$this->renderPartial('overview',array( "person" => $person));
					$this->renderPartial('editAccount',array( "person" => $person,"tags" => $tags));
					$this->renderPartial('people',array( "person" => $person,"people" => $people));
					$this->renderPartial('organization',array( "person" => $person, "organizations"=>$organizations));
					$this->renderPartial('events',array( "person" => $person,"events" => $events));
					$this->renderPartial('projects',array( "person" => $person,"projects" => $projects));
				?>
			</div>
		</div>

	</div>
</div>
<script type="text/javascript">
<?php $contextMap = array("person"=>$person,
						"people"=>$people, 
						"organizations"=>$organizations,
						"events"=>$events,
						"projects"=>$projects
						); ?>
var contextMap = <?php echo json_encode($contextMap)?>;
debugMap.push(contextMap);
var type = "person";
var contextTags = [];
$.each(contextMap, function(k, v){
	if(k==type){
		for(var n=0; n<v.tags.length; n++){
			if($.inArray(v.tags[n], contextTags)==-1)
				contextTags.push(v.tags[n]);
		}
	}else{
		$.each(v, function(i, j){
			if(typeof(j["tags"])!="undefined"){
				for(var n=0; n<j["tags"].length; n++){
					if($.inArray(j["tags"][n], contextTags)==-1)
						contextTags.push(j["tags"][n]);
				}
			}
		})
	}
});

jQuery(document).ready(function() {
	pageLoad();
	initDataTable();
	//THis is a global relation disconnect feature
	$(".disconnectBtn").off().on("click",function () {
        id = $(this).data("id");
        type = $(this).data("type");
        linkType = $(this).data("linkType");
        bootbox.confirm("Are you sure you want to delete <span class='text-red'>"+$(this).data("name")+"</span> connection ?", function(result) {
			if(result)
			{
				//console.log( '#people'+id, $('#people'+id ) );
				actionType = (linkType == "memberOf" ) ? "removememberof" : "disconnect" ; 
		        $(this).children("i").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
				$.ajax({
			        type: "POST",
			        url: baseUrl+"/"+moduleId+"/person/"+actionType+"/id/"+id+"/type/"+type,
			        dataType : "json"
			    })
			    .done(function (data) 
			    {
			        if ( data && data.result ) 
			        {               
			        	toastr.info("I don't know this guy any longer!!");
			        	$('#'+type+id ).css("background-color","#FF3700").fadeOut(400, function(){
				            $('#'+type+id ).remove();
				        });
			        } 
			        else 
			        {
			           toastr.info("something went wrong!! please try again.");
			           $(this).children("i").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
			        }
			    });
			}
		});
	});

});

	function pageLoad() {
		
		hash = window.location.hash;
		hash && $('ul.nav a[href="' + hash + '"]').tab('show')

		$('.nav-tabs a').click(function (e) {
		    $(this).tab('show');
		    window.location.hash = this.hash;
		});
		$("#slidingbar").css("display", "none");
	}

	var initDataTable = function() {
		oTableOrganization = $('#organizations').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "Show _MENU_ Rows",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[1, 'asc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"iDisplayLength" : 10,
		});


		oTableEvent = $('#events').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "Show _MENU_ Rows",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[1, 'asc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"iDisplayLength" : 10,
		});

		oTablePeople= $('#people').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "Show _MENU_ Rows",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[1, 'asc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"iDisplayLength" : 10,
		});

		oTableProject = $('#projects').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "Show _MENU_ Rows",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[1, 'asc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"iDisplayLength" : 10,
		});
	};
</script>


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

<div class="row">
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
<?php $mapPerson = array("person"=>$person,
                      "people"=>$people, 
                      "organizations"=>$organizations
                      ); ?>
var mapPerson = <?php echo json_encode($mapPerson)?>;
</script>


<?php 
	echo Yii::getPathOfAlias($this->id.'.assets');
	//valeur correspondant 
$cssAnsScriptFilesTheme = array(
	'/assets/plugins/jquery-sortable-lists/stylesheets/github-dark.css',
	'/assets/plugins/jquery-sortable-lists/jquery-sortable-lists.min.js',
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
?>
<style>
	#sortableLists li { /*background-color:#ddf;*/ padding-left:20px;list-style: none; }
	.sortableListsOpener{display: inline-block;
				float: left;
				width: 20px;
				height: 15px;
				margin-left: -35px;
				margin-right: 5px;
				background-position: center center;}
</style>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><span><i class="fa fa-info fa-2x text-blue"></i> Charte du projet</span></h4>
		<div class="panel-tools">
			<div class="dropdown">
				<a class="btn btn-xs dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
					<i class="fa fa-cog"></i>
				</a>
				<ul role="menu" class="dropdown-menu dropdown-light pull-right">
					<li>
						<a href="#" class="panel-collapse collapses"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
					</li>
					<li>
						<a href="#" class="panel-refresh">
							<i class="fa fa-refresh"></i> <span>Refresh</span>
						</a>
					</li>
					<li>
						<a data-toggle="modal" href="#panel-config" class="panel-config">
							<i class="fa fa-wrench"></i> <span>Configurations</span>
						</a>
					</li>
					<li>
						<a href="#" class="panel-expand">
							<i class="fa fa-expand"></i> <span>Fullscreen</span>
						</a>
					</li>
				</ul>
			</div>
			<a href="#" class="btn btn-xs btn-link panel-close">
				<i class="fa fa-times"></i>
			</a>
		</div>
	</div>
	<div class="panel-body no-padding">
		<div id="sortableLists">
			<ul>
			   <li class="sortableListsOpen">
			      <div>Whatever you want here</div>
			      <ul>
			         <li><div>Nested list item</div></li>
			         <li><div>Another item</div></li>
			      </ul>
			   </li>
			    <li class="sortableListsOpen">
			      <div>Whatever you want here</div>
			      <ul>
			         <li><div>Nested list item</div></li>
			         <li><div>Another item</div></li>
			      </ul>
			   </li>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function() {
	var options = {
		//placeholderClass: 'placeholderClass',
		// or like a jQuery css object
		placeholderCss: {'background-color':'yellow'},
		// Like a css class name. Class will be removed after drop.
		//currElClass: 'currElemClass',
		// or like a jQuery css object. Note that css object settings can't be removed
		currElCss: {'background-color':'green', 'color':'#fff'},
		//hintClass: 'hintClass',
		// or like a jQuery css object
		hintCss: {'background-color':'green', 'border':'1px dashed white'},
		listSelector: 'ul',
		//hintWrapperClass: 'hintClass',
		// or like a jQuery css object
		//hintWrapperCss: {'background-color':'green', 'border':'1px dashed white'},
		insertZone: 50,
		opener: {
			active: true,
			close: baseUrl+'/themes/ph-dori/assets/plugins/jquery-sortable-lists/imgs/Remove2.png',
			open: baseUrl+'/themes/ph-dori/assets/plugins/jquery-sortable-lists/imgs/Add2.png',
			/*css: {
				'display': 'inline-block', // Default value
				'float': 'left', // Default value
				'width': '18px',
				'height': '18px',
				'margin-left': '-35px',
				'margin-right': '5px',
				'background-position': 'center center', // Default value
		//		'background-repeat': 'no-repeat' // Default value
			},*/
			// or like a class. Note that class can not rewrite default values. To rewrite defaults you have to do it through css object.
			class: 'sortableListsOpener'
		}
	}
	$('#sortableLists').sortableLists( options );
	
		
});
</script>
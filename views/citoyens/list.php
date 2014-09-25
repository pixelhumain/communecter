
<?php
/** @var CClientScript $cs */
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/pixelsactifs.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/main.pixelsactifs.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.mixitup.min.js' , CClientScript::POS_END);

/* @var $this SiteController */
$this->pageTitle=Yii::app()->name.", début d'un réseau citoyen";
?>
<div class="container">
<?php 
//$this->renderPartial('modalInvitePA');
$pa = Yii::app()->mongodb->citoyens;
$ct = $pa->find();
?>
    <!-- BEGIN DEMO WRAPPER -->
    <div class="wrapper wf">
    	<!-- BEGIN CONTROLS -->
    	<h1 class="ib">Listes des Pixels Actifs (<?php echo $ct->count();?> inscrits)</h1>
    	
    	<div class="clear"></div>
    	
    	<nav class="controls just">
    		<div class="group" id="Sorts">
    			<div class="button active" id="ToList"><i></i>List View</div>
    			<div class="button" id="ToGrid"><i></i>Grid View</div>
    		</div>
    		<div class="group" id="Filters">
    			
    			<div class="drop_down wf">
    				<span class="anim150">Type</span>
    				<ul class="anim250">
    					<li class="active" data-filter="all" data-dimension="nature">Tout</li>
    					<li data-filter="activeOnProject" data-dimension="nature">participe</li>
    					<?php
        				$cursor = Yii::app()->mongodb->jobTypes->findOne( array(), array('list'));
        				foreach ($cursor['list'] as $a)
        				    echo '<li data-filter="'.$a.'" data-dimension="nature">'.$a.'</li>';
        				 ?>
    				</ul>
    			</div>
    			
    		</div>
    	</nav>
    	
    	<!-- END CONTROLS -->
    	
    	<!-- BEGIN PARKS -->
    	
    	<ul id="Parks" class="just">
    		
    		<!-- "TABLE" HEADER CONTAINING SORT BUTTONS (HIDDEN IN GRID MODE)-->
    		
    		<div class="list_header">
    			<div class="meta name active desc" id="SortByName">
    				Contact &nbsp;
    				<span class="sort anim150 asc active" data-sort="data-name" data-order="desc"></span>
    				<span class="sort anim150 desc" data-sort="data-name" data-order="asc"></span>	
    			</div>
    			<div class="meta positions">Participe</div>
    			<div class="meta region">Nom</div>
    			<div class="meta rec">CP</div>
    		</div>
    		
    		<!-- FAIL ELEMENT -->
    		
    		<div class="fail_element anim250">Aucune réponse ne correspond a vos critères.</div>
    		
    		<!-- BEGIN LIST OF PARKS (MANY OF THESE ELEMENTS ARE VISIBLE ONLY IN LIST MODE)-->
    		<?php foreach ($ct as $_pa){?>
    		<li class="mix <?php if(isset($_pa['cp']))echo $_pa['cp']?> <?php if(isset($_pa['activeOnProject']))echo "activeOnProject"?> <?php if(isset($_pa['positions']))echo implode(" ", $_pa['positions']);?>" data-name="if(isset($_pa['name']))<?php if(isset($_pa['name']))echo $_pa['name']; ?>" >
    			<div class="meta name">
    				<div class="titles">
    					<h2><?php if(isset($_pa['email']))echo $_pa['email']?></h2>
    				</div>
    			</div>
    			<div class="meta positions">
    				<div >
    			    <?php if(isset($_pa['positions']))echo implode(" ", $_pa['positions']);?>
    				</div>
    			</div>
    			<div class="meta email">
    				<div class="titles">
    					<h2><?php if(isset($_pa['name']))echo $_pa['name']; else echo 'anonyme';?></h2>
    				</div>
    			</div>
    			<div class="meta cp">
    				<div >
    					<p><em><?php if(isset($_pa['cp']))echo $_pa['cp']?></em></p>
    				</div>
    			</div>
    		</li>
    		<?php } ?>
    		
    		
    		<!-- END LIST OF PARKS -->
    		
    	</ul>
    
    </div>
    
    <!-- END DEMO WRAPPER -->
    
</div>
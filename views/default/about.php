<div class="row page_content_wrap">

	<span class="page_navigation_bg col-md-3 hidden-xs hidden-sm "></span>

	<!-- start: PAGE MENU -->
	<div class="col-md-3 ">

		<nav class="page_navigation">

			<h1 class="page_navigation-title">Filtres d'affichage :</h1>

			<ul class="main-navigation-menu">
				<?php 
 
		          foreach( $this->sidebar2 as $item )
		          {
		              echo "<li class='title'>".$item["label"]."</li>";
		              if( isset($item["children"]) )
		                  echo "<li>".buildChildren2($item["children"])."</li>";
		          }

		          function buildLi2( $item )
		          {
		            $modal = (isset($item["isModal"])) ? 'role="button" data-toggle="modal"' : "";
		            $onclick = (isset($item["onclick"])) ? 'onclick="'.$item["onclick"].'"' 
		                                                 : ( (isset($item["key"]) && false) ? 'onclick="scrollTo(\'#block'.$item["key"].'\')"' 
		                                                                            : "" );
		            $href = (isset($item["href"])) ? (stripos($item["href"], "http") === false) ? Yii::app()->createUrl($item["href"]) : $item["href"] : "#";
		            $class = (isset($item["class"])) ? 'class="'.$item["class"].'"' : "";
		            $icon = (isset($item["iconClass"])) ? '<i class="'.$item["iconClass"].'"></i>' : '';
		            $isActive = ( isset( Menu::$sectionMenu[ $item["key"] ] ) && in_array( Yii::app()->controller->action->id, Menu::$sectionMenu[ $item["key"] ] ) ) ? true : false;
		            
		            $active = ( $isActive || (isset($item["active"]) && $item["active"] ) ) ? "open active" : "";
		            echo '<li><a href="'.$href.'" '.$modal.' '.$class.' '.$onclick.' >'.$item["label"].'</a></li>';
		            //This menu can have 2 levels
		          }

		          function buildChildren2( $children )
		          {
		            foreach( $children as $item )
		            {
		                if(isset($item["key"]))
		                  buildLi2($item);
		                if( isset($item["children"]) )
		                  buildChildren2($item["children"]);
		            }
		          }
		          ?>
			</ul>

		</nav>

	</div>
	<!-- end: PAGE MENU -->
	<div class="col-md-9">
		<section class="page_content">
			<img src="<?php echo $this->module->assetsUrl?>/images/about.jpg">
			<br/><br/>
		</section>
	</div>
</div>
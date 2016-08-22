<style>
	.dropdownDocIndex {
	    margin-top: 16px;
	    margin-left: 13px;
	}
    .dropdownDocIndex .active > a, .active > a > i.text-red{
        background-color:#E33551 !important;
        color:white !important; 
    }
    .dropdownDocIndex li > a{
        font-size: 20px;
    }


</style>
<div class="dropdown dropdownDocIndex pull-left">
  <button class="dropdown-toggle menu-name-profil text-dark" data-toggle="dropdown">
  Chapitres <span class="caret"></span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right">
    <li class="<?php if($icon=="cubes") echo "active"; ?>">
    	<a href="#default.view.page.elements.dir.docs" class="lbh text-red" id="btn-menu-dropdown-my-profil">
    		<i class="fa fa-cubes text-red"></i> les 4 éléments
    	</a>
    </li>
    <li class="hidden <?php if($icon=="cogs") echo "active"; ?>">
    	<a href="#default.view.page.pourquoi.dir.docs" class="lbh text-red" id="btn-menu-dropdown-my-profil">
    		<i class="fa fa-cogs text-red"></i> Pour quoi faire ?
    	</a>
    </li>
    <li class="hidden <?php if($icon=="question-circle") echo "active"; ?>">
    	<a href="#default.view.page.comprendre.dir.docs" class="lbh text-red" id="btn-menu-dropdown-my-profil">
    		<i class="fa fa-question-circle text-red"></i> Comprendre
    	</a>
    </li>
    <li class="<?php if($icon=="cube") echo "active"; ?>">
        <a href="#default.view.page.modules.dir.docs" class="lbh text-red" id="btn-menu-dropdown-my-profil">
            <i class="fa fa-cube text-red"></i> Modules
        </a>
    </li>
    <li class="<?php if($icon=="tv") echo "active"; ?>">
    	<a href="#default.view.page.presentation.dir.docs" class="lbh text-red" id="btn-menu-dropdown-my-profil">
    		<i class="fa fa-tv text-red"></i> Présentation
    	</a>
    </li>
    <li class="<?php if($icon=="bullhorn") echo "active"; ?>">
        <a href="#default.view.page.communication.dir.docs" class="lbh text-red" id="btn-menu-dropdown-my-profil">
            <i class="fa fa-bullhorn text-red"></i> Communication
        </a>
    </li>
    <li class="hidden <?php if($icon=="book") echo "active"; ?>">
        <a href="#default.view.page.histoire.dir.docs" class="lbh text-red" id="btn-menu-dropdown-my-profil">
            <i class="fa fa-book text-red"></i> L'histoire
        </a>
    </li>
    <li class="<?php if($icon=="tachometer") echo "active"; ?>">
        <a href="#default.view.page.rd.dir.docs" class="lbh text-red" id="btn-menu-dropdown-my-profil">
            <i class="fa fa-tachometer text-red"></i> R&D
        </a>
    </li>
  </ul>
</div>
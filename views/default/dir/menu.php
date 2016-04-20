<style>
.bg-main-menu{
  margin-top: 50px;
}

</style>
<div  class="col-md-12" id="dropdown_params">
  <!-- <center><button id="reset" class="btn btn-default">Initialiser filtre</button></center>--> 
  <!-- <label id='countResult' class='text-dark'></label> -->
  <!-- FILTER TEXT -->
  <input id="searchBarText" type="text" placeholder="Que recherchez-vous ?" class="form-control">
  
  <div class="panel-group">
    <div class="panel panel-default">
      <?php 
      if(isset($params['filter']['linksTag']) && is_array($params['filter']['linksTag'])){
        foreach($params['filter']['linksTag'] as $category => $listTag){ ?>
            <!-- Title category -->
          <div class="panel-heading" style="background-color: <?php echo $listTag['background-color']; ?>">
            <h4 class="panel-title" onclick="manageCollapse('<?php echo $listTag['tagParent']; ?>', 'false')">
              <input type="checkbox" class="checkbox categoryFilter" value="<?php echo $listTag['tagParent']; ?>" style="vertical-align: bottom;
    display: inline-block"/>
              <a data-toggle="collapse" href="#<?php echo $listTag['tagParent']; ?>" style="color:#719FAB">
                <?php echo $category; ?>
                <i class="fa fa-chevron-down" aria-hidden="true" id="fa_<?php echo $listTag['tagParent']; ?>"></i>
              </a>
            </h4>
          </div>
          <div id="list_<?php echo $listTag['tagParent']; ?>" class="panel-collapse collapse">
            <ul class="list-group">
               <!-- Tags -->
              <?php foreach($listTag['tags'] as $tag){?>
                <li class="list-group-item"><input type="checkbox" class="checkbox tagFilter" value="<?php echo $tag; ?>" data-parent="<?php echo $listTag['tagParent']; ?>"/><?php echo $tag; ?></li>
              <?php } ?>
            </ul>
          </div>
        <?php }
      } 
      ?>
      <div class="panel-heading">
        <h4 class="panel-title">
          <center><a href="https://docs.google.com/forms/d/1HzoRFzt4iK2REVAI0_wRDHkKnU0sRWZD8W5PfGj0dC0/viewform?embedded=true#start=embed" target="_blank" ><i class="fa fa-plus fa-2x"></i>Ajouter un projet</a></center>
        </h4>
      </div>
      <div class="panel-heading">
         <h4 class="panel-title">
          <center><a id="reset" ><i class="fa fa-refresh"></i>Réinitialiser</a></center>
        </h4>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  
  
  function manageCollapse(div, forcer){
    if(forcer == true){
      $("#list_"+div).show();
    }else{
      $("#list_"+div).toggle();
    }
    if($("#list_"+div).is(":visible")){
      $("#fa_"+div).removeClass('fa-chevron-down');
      $("#fa_"+div).addClass('fa-chevron-up');
    }
    else{
      $("#fa_"+div).addClass('fa-chevron-down');
      $("#fa_"+div).removeClass('fa-chevron-up');
    }
  }

</script>
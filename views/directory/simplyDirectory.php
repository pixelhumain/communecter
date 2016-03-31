<script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/2.1.11/jquery.mixitup.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<style type="text/css">

body{padding-top:70px;}

.container{
  width:99%;
  /*background-color: white;*/
}

.simply-button{
    padding-top: 10px;
    padding-bottom: 10px;
    color: #666;
    background-color: #ccc;
    border: 1px solid #666;
}

.navbar{
  background-color: #CCC;
}

button, .button {
  -webkit-appearance: none;
  -moz-appearance: none;
  border-radius: 0;
  border-style: solid;
  border-width: 0;
  cursor: pointer;
  font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
  font-weight: normal;
  line-height: normal;
  margin: 0 0 1.25rem;
  position: relative;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  padding: 1rem 2rem 1.0625rem 2rem;
  font-size: 1rem;
  background-color: #008CBA;
  border-color: #007095;
  color: #FFFFFF;
  transition: background-color 300ms ease-out;
}

.panel-filter{
  border-right:2px solid grey;
}


/**** LIST-GROUP OR GRID GROOUP ****/

.item
{
  border:1px solid grey;
  color:black;
}

.item.list-group-item
{
    float: none;
    width: 100%;
    background-color: #fff;
    margin-bottom: 10px;
}
.item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
{
    background: #428bca;
}

.item.list-group-item .list-group-image
{
    margin-right: 10px;
}
.item.list-group-item .thumbnail
{
    margin-bottom: 0px;
}
.item.list-group-item .caption
{
    padding: 9px 9px 0px 9px;
}
.item.list-group-item:nth-of-type(odd)
{
    background: #eeeeee;
}

.item.list-group-item:before, .item.list-group-item:after
{
    display: table;
    content: " ";
}

.item.list-group-item img
{
    float: left;
}
.item.list-group-item:after
{
    clear: both;
}
.list-group-item-text
{
    margin: 0 0 11px;
}


/***** FILTER *****/

 
/**
 * Form & Checkbox Styles
 */


.checkbox{
  display: block;
  position: relative;
  cursor: pointer;
  margin-bottom: 8px;
}

.checkbox input[type="checkbox"]{
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  cursor: pointer;
  margin: 0;
  opacity: 0;
  z-index: 1;
}

.checkbox label{
  display: inline-block;
  vertical-align: top;
  text-align: left;
  padding-left: 1.5em;
}

.checkbox label:before,
.checkbox label:after{
  content: '';
  display: block;
  position: absolute;
}

.checkbox label:before{
  left: 0;
  top: 0;
  width: 18px;
  height: 18px;
  margin-right: 10px;
  background: #ddd;
  border-radius: 3px;
}

.checkbox label:after{
  content: '';
  position: absolute;
  top: 4px;
  left: 4px;
  width: 10px;
  height: 10px;
  border-radius: 2px;
  background: #68b8c4;
  opacity: 0;
  pointer-events: none;
}

.checkbox input:checked ~ label:after{
  opacity: 1;
}

.checkbox input:focus ~ label:before{
  background: #eee;
}

/**
 * Container/Target Styles
 */

.container{
  padding: 2%;
  min-height: 400px;
  text-align: justify;
  position: relative;
}

.container .mix,
.container .gap{
  display: inline-block;
}

.container .mix{
  display: none;
}

.container .mix.sm{
  width: 50px;
  height: 50px;
}

/**
 * Fail message styles
 */

.container .fail-message{
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  text-align: center;
  opacity: 0;
  pointer-events: none;
  
  -webkit-transition: 150ms;
  -moz-transition: 150ms;
  transition: 150ms;
}

.container .fail-message:before{
  content: '';
  display: inline-block;
  vertical-align: middle;
  height: 100%;
}

.container .fail-message span{
  display: inline-block;
  vertical-align: middle;
  font-size: 20px;
  font-weight: 700;
}

.container.fail .fail-message{
  opacity: 1;
  pointer-events: auto;
}


</style>

<?php 

/*
$this->renderPartial('../default/panels/toolbar',array("toolbarStyle"=>"width:50px")); */
$contextName = "";
$contextIcon = "bookmark fa-rotate-270";
$contextTitle = "";
$parentId="";
$parentType="";
$manage="";


$countPeople = 0; $countOrga = 0; $countProject = 0; $countEvent = 0; $countFollowers = 0; $followsProject = 0; $followsPeople = 0 ; $followsOrga = 0;


$events = array();
$organizations = Organization::getWhere(array());
$people = Person::getWhere(array( "roles"=> array('$exists'=>1)));
$projects = array();

$memberId = Yii::app()->session["userId"];
$memberType = Person::COLLECTION;
$tags = array();
$tagsHTMLFull = "";
$collections = $scopesHTMLFull = array();
$scopes = array(
  "codeInsee"=>array(),
  "postalCode"=>array(),
  "region"=>array(),
  "addressLocality"=>array(),
);
$content = "";

/* ************ ORGANIZATIONS ********************** */
if(isset($organizations)) {
  $collections[Organization::COLLECTION] = '<i class="fa '.Organization::ICON.'"></i> Organisation';
  foreach ($organizations as $e) {
      $content .= buildDirectoryLine($e, Organization::COLLECTION, Organization::CONTROLLER, Organization::ICON, $this->module->id,$tags,$scopes,$tagsgsHTMLFull,$scopesHTMLFull,$manage);
  };
}

/* ********** PEOPLE ****************** */
if(isset($people)){ 
  $collections[Person::COLLECTION] = '<i class="fa '.Person::ICON.'"></i> Citoyen';
  foreach ($people as $e) {
    $content .= buildDirectoryLine($e, Person::COLLECTION, Person::CONTROLLER, Person::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull,$manage,$parentType,$parentId);
  }
}

/* ************ EVENTS ************************ */
if(isset($events))foreach ($events as $e) { 
  $collections[Event::COLLECTION] = '<i class="fa '.Event::ICON.'"></i> Evénement';
  $content .= buildDirectoryLine($e, Event::COLLECTION, Event::CONTROLLER, Event::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull,$manage=null);
}


/* ************ PROJECTS **************** */
if( count($projects) ){ 
  $collections[Project::COLLECTION] = '<i class="fa '.Project::ICON.'"></i> Projet';
  foreach ($projects as $e){ 
    $content .= buildDirectoryLine($e, Project::COLLECTION, Project::CONTROLLER, Project::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull,$manage=null);
  }
}
$tags = array_iunique($tags);
?>
</script> 

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Annuaire communecter</a>
    </div>
    <div class="navbar-collapse collapse" id="searchbar">
     
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="btn btn-default btn-sm simply-button dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-search-plus fa-2x"></i>
          </a>
          <ul class="dropdown-menu">
            <li>
              <form class="controls" class="filters">
                <!-- We can add an unlimited number of "filter groups" using the following format: -->
                <fieldset class="filter-group checkboxes">
                  <h4>Type</h4>
                  <?php foreach ($collections as $key => $value) {
                    echo '<div class="checkbox">
                      <input type="checkbox" value=".'.$key.'"/>
                      <label>'.$value.'</label>
                    </div>';
                  }?>
                </fieldset>
                <fieldset class="filter-group checkboxes">
                  <h4>Tag</h4>
                  <?php foreach ($tags as $key => $value) {
                    echo '<div class="checkbox">
                      <input type="checkbox" value=".'.$value.'"/>
                      <label>'.$value.'</label>
                    </div>';
                  }?>
                </fieldset>
              </form>
            </li>
          </ul>
        </li>
        <li>
          <a href="#" id="grid" class="btn btn-default btn-sm simply-button">
            <i class="fa fa-th-large fa-2x"></i>
          </a>
        </li>
        <li>
          <a href="#" id="list" class="btn btn-default btn-sm simply-button">
            <i class="fa fa-align-justify fa-2x"></i>
          </a>
        </li>
        <li>
          <a href="#" class="btn btn-default btn-sm simply-button">
            <i class="fa fa-map-marker fa-2x"></i>
          </a>
        </li>
      </ul>
     
     <form class="navbar-form filters" role="recherche">
        <div class="form-group" style="display:inline;">
          <div class="input-group filter-group search" style="display:table;">
            <span class="input-group-addon" style="width:1% ;"><span class="glyphicon glyphicon-search"></span></span>
            <input class="form-control" id="search" class="form-control" placeholder="Nom, prénom, ville, code postal, tag, description ..." autocomplete="off" autofocus="autofocus" type="text">
          </div>
        </div>
      </form>

    </div><!--/.nav-collapse -->
</nav>





  <div class="row">
    <div class="col-md-3 text-left panel-filter">
      <form class="controls" id="Filters">
        <!-- We can add an unlimited number of "filter groups" using the following format: -->
        <fieldset class="filter-group checkboxes">
          <h4>Type</h4>
          <?php foreach ($collections as $key => $value) {
            echo '<div class="checkbox">
              <input type="checkbox" value=".'.$key.'"/>
              <label>'.$value.'</label>
            </div>';
          }?>
        </fieldset>
        <fieldset class="filter-group checkboxes">
          <h4>Tag</h4>
          <?php foreach ($tags as $key => $value) {
            echo '<div class="checkbox">
              <input type="checkbox" value=".'.strtolower(preg_replace("/[^A-Za-z0-9]/", "", $value)).'"/>
              <label>'.$value.'</label>
            </div>';
          }?>
        </fieldset>
        <?php foreach ($scopesHTMLFull as $key => $value) { ?>
          <fieldset class="filter-group checkboxes">
            <h4><?php echo $key?></h4>
            <?php foreach ($value as $filter => $link) {
              echo '<div class="checkbox">
                <input type="checkbox" value=".'.$filter.'"/>
                <label>'.$filter.'</label>
              </div>';
            }?>
          </fieldset>
        <?php } ?>

      </form>
    </div>
    <div class="col-md-9">
      <section class="module list" >
          <div id="container" class="container" class="row list-groug">

            <!-- NO RESULT -->
            <div class="fail-message"><span>Aucun contact trouvé</span></div>
            <?php echo $content ?>

        </div>

        <footer>
            <div class="status-msg"></div>
        </footer>

      </section>
    </div>
  </div>
</div><!-- /.container-fluid -->



<script type="text/javascript">
  
$(document).ready(function() {


  /***** CHANGE THE VIEW GRID OR LIST *****/
  $('#grid').hide();
  $('#list').click(function(event){
    event.preventDefault();
    $('#container .item').addClass('list-group-item');
    $('#grid').show();
    $('#list').hide();
  });
  $('#grid').click(function(event){
    event.preventDefault();
    $('#container .item').removeClass('list-group-item');
    $('#container .item').addClass('grid-group-item');
    $('#list').show();
    $('#grid').hide();
  });


  /*** EXTEND FUNCTION FOR CASE SENSITIVE ***/
    $.expr[":"].contains = $.expr.createPseudo(function (arg) {
        return function (elem) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });

  /***** FILTER MIXITUP *****/
  // To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "multiFilter".
  var multiFilter = {
    
    // Declare any variables we will need as properties of the object
    
    $filterGroups: null,
    $filterUi: null,
    $reset: null,
    groups: [],
    outputArray: [],
    outputString: '',
    
    // The "init" method will run on document ready and cache any jQuery objects we will need.
    
    init: function(){
      var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.
      
      self.$filterUi = $('.filters');
      self.$filterGroups = $('.filter-group');
      self.$reset = $('#Reset');
      self.$container = $('#container');
      
      self.$filterGroups.each(function(){
        self.groups.push({
          $inputs: $(this).find('input'),
          active: [],
          tracker: false
        });
      });
      
      self.bindHandlers();
    },
    
    // The "bindHandlers" method will listen for whenever a form value changes. 
    bindHandlers: function(){
      var self = this,
          typingDelay = 300,
          typingTimeout = -1,
          resetTimer = function() {
            clearTimeout(typingTimeout);
            
            typingTimeout = setTimeout(function() {
              self.parseFilters();
            }, typingDelay);
          };
      
      self.$filterGroups
        .filter('.checkboxes')
        .on('change', function() {
          self.parseFilters();
        });
      
      self.$filterGroups
        .filter('.search')
        .on('keyup change', resetTimer);
      
      self.$reset.on('click', function(e){
        e.preventDefault();
        self.$filterUi[0].reset();
        self.$filterUi.find('input[type="text"]').val('');
        self.parseFilters();
      });
    },
    
    // The parseFilters method checks which filters are active in each group:
    parseFilters: function(){
      var self = this;
   
      // loop through each filter group and add active filters to arrays
      
      for(var i = 0, group; group = self.groups[i]; i++){
        group.active = []; // reset arrays
        group.$inputs.each(function(){
          var searchTerm = '',
              $input = $(this),
              minimumLength = 2;
          
          if ($input.is(':checked')) {
            group.active.push(this.value);
          }
          
          if ($input.is('[type="text"]') && this.value.length >= minimumLength) {
            searchTerm = this.value
              .trim()
              .toLowerCase()
              .replace(' ', '-');
            
            group.active[0] = '[class*="' + searchTerm + '"]'; 

            //To add content search
            group.active[1] = ".item:contains('"+$( "#search" ).val()+"')"; 
          }
        });
        group.active.length && (group.tracker = 0);
      }
      
      self.concatenate();
    },
    
    // The "concatenate" method will crawl through each group, concatenating filters as desired:
    concatenate: function(){
      var self = this,
        cache = '',
        crawled = false,
        checkTrackers = function(){
          var done = 0;
          
          for(var i = 0, group; group = self.groups[i]; i++){
            (group.tracker === false) && done++;
          }

          return (done < self.groups.length);
        },
        crawl = function(){
          for(var i = 0, group; group = self.groups[i]; i++){
            group.active[group.tracker] && (cache += group.active[group.tracker]);

            if(i === self.groups.length - 1){
              self.outputArray.push(cache);
              cache = '';
              updateTrackers();
            }
          }
        },
        updateTrackers = function(){
          for(var i = self.groups.length - 1; i > -1; i--){
            var group = self.groups[i];

            if(group.active[group.tracker + 1]){
              group.tracker++; 
              break;
            } else if(i > 0){
              group.tracker && (group.tracker = 0);
            } else {
              crawled = true;
            }
          }
        };
      
      self.outputArray = []; // reset output array

      do{
        crawl();
      }
      while(!crawled && checkTrackers());

      self.outputString = self.outputArray.join();
      
      // If the output string is empty, show all rather than none:
      
      !self.outputString.length && (self.outputString = 'all'); 
      
      console.log(self.outputString); 
      
      // ^ we can check the console here to take a look at the filter string that is produced
      
      // Send the output string to MixItUp via the 'filter' method:
      
      if(self.$container.mixItUp('isLoaded')){
        self.$container.mixItUp('filter', self.outputString);
      }
    }
  };

  // On document ready, initialise our code.
  $(function(){
        
    // Initialize multiFilter code
    multiFilter.init();
        
    // Instantiate MixItUp    
    $('#container').mixItUp({
      controls: {
        enable: false // we won't be needing these
      },
      animation: {
        easing: 'cubic-bezier(0.86, 0, 0.07, 1)',
        queueLimit: 3,
        duration: 600
      }
    });    
  });
});

</script>


<?php


function buildDirectoryLine( $e, $collection, $type, $icon, $moduleId, &$tags, &$scopes, &$tagsHTMLFull,&$scopesHTMLFull,$manage,$parentType=null,$parentId=null)
          {
            if((!isset( $e['_id'] ) && !isset($e["id"]) )|| !isset( $e["name"]) || $e["name"] == "" )
              return;
            $actions = "";
            if(@$e['_id'])
              $id = $e["_id"];
            else
              $id = $e["id"];

            /* **************************************
            * TYPE + ICON
            ***************************************** */
            $img = '';
            //'<i class="fa '.$icon.' fa-3x"></i> ';
            // if ($e && !empty($e["profilThumbImageUrl"])){ 
            //   $img = '<img class="thumbnail-profil" width="50" height="50" alt="image" src="'.Yii::app()->createUrl('/'.$e['profilThumbImageUrl']).'">';
            // }else{
            //   if(!empty($e["profilImageUrl"]))
            //     $img = '<img class="thumbnail-profil" width="50" height="50" alt="image" src="'.Yii::app()->createUrl('/communecter/document/resized/50x50'.$e['profilImageUrl']).'">';
            //   else
            //   $img = "<div class='thumbnail-profil'></div>";
            // }
            

            /* **************************************
            * TAGS
            ***************************************** */
            $tagsHTML = $tagsClasses = "";
            if(isset($e["tags"])){
              foreach ($e["tags"] as $key => $value) {
                
                /* TAGS FILTER CLASSES */
                $tagsClasses .= ' '.strtolower(preg_replace("/[^A-Za-z0-9]/", "", $value)) ;

                /* TAGS DISPLAY */
                $tagsHTML .= ' <a href="javascript:;" class="filter" data-filter=".'.strtolower(preg_replace("/[^A-Za-z0-9]/", "", $value)).'"><span class="text-red text-xss">#'.$value.'</span></a>';

                /* TAGS FILTER GLOBAL */
                if( $tags != "" && !in_array($value, $tags) ) {
                  array_push($tags, $value);
                  $tagsHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.strtolower(preg_replace("/[^A-Za-z0-9]/", "", $value)).'"><span>#'.$value.'</span></a>';
                }
              }
            }

            /* **************************************
            * SCOPES FILTER
            ***************************************** */
            $scopesClasses = "";
            if( isset($e["address"]) && isset( $e["address"]['codeInsee']) )
              $scopesClasses .= ' '.$e["address"]['codeInsee'];
            if( isset($e["address"]) && isset( $e["address"]['postalCode']) )
              $scopesClasses .= ' '.$e["address"]['postalCode'];
            if( isset($e["address"]) && isset( $e["address"]['region']) )
              $scopesClasses .= ' '.$e["address"]['region'];
            if( isset($e["address"]) && isset( $e["address"]['addressLocality']) ){
              $locality = str_replace( " ", "", $e["address"]['addressLocality']);
              $scopesClasses .= ' '.$locality;
            }

            $name = ( isset($e["name"]) ) ? $e["name"] : "" ;
            $url = "loadByHash('#".$type.".detail.id.".$id."')";
            $url = 'href="javascript:;" onclick="'.$url.'"';  
            $entryType = ( isset($e["type"])) ? $e["type"] : "";
            
            $panelHTML = '<div class="item col-lg-3 col-md-4 col-sm-6 col-xs-6 mix '.$collection.'Line '.$collection.' '.$scopesClasses.' '.$tagsClasses.' '.$entryType.'" data-cat="1">';
           
            /* **************************************
            * SCOPES
            ***************************************** */
            $strHTML = '<a '.$url.' class="thumb-info item_map_list_panel" data-id="'.$id.'"  >'.$name.@$e['shortDescription'].'</a>';
            $scopeHTML = "";
            // if( isset($e["address"]) && isset( $e["address"]['codeInsee'])){
            //   //$scopeHTML .= ' <a href="#" class="filter" data-filter=".'.$e["address"]['codeInsee'].'"><span class="label address text-dark text-xss">'.$e["address"]['codeInsee'].'</span></a>';
            //   if( !in_array($e["address"]['codeInsee'], $scopes['codeInsee']) ) {
            //     array_push($scopes['codeInsee'], $e["address"]['codeInsee'] );
            //     $scopesHTMLFull['codeInsee'][$e["address"]['codeInsee']] =' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$e["address"]['codeInsee'].'"><span>insee '.$e["address"]['codeInsee'].'</span></a>';
            //     // $scopesHTMLFull[$e["address"]['codeInsee']] .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$e["address"]['codeInsee'].'"><span>insee '.$e["address"]['codeInsee'].'</span></a>';
            //   }
            // }
            if( isset($e["address"]) && isset( $e["address"]['postalCode'])){
              $scopeHTML .= ' <a href="javascript:;" class="filter" data-filter=".'.$e["address"]['postalCode'].'"><span class="label address text-dark text-xss">'.$e["address"]['postalCode'].'</span></a>';
              if( !in_array($e["address"]['postalCode'], $scopes['postalCode']) ) {
                $insee = isset($e["address"]['codeInsee']) ? $e["address"]['codeInsee'] : $e["address"]['postalCode'];
                array_push($scopes['postalCode'], $e["address"]['postalCode'] );
                $scopesHTMLFull['Code postal'][$e["address"]['postalCode']] = ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$insee.'"><span>cp '.$e["address"]['postalCode'].'</span></a>';
                // $scopesHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$insee.'"><span>cp '.$e["address"]['postalCode'].'</span></a>';
              }
            }
            if( isset($e["address"]) && isset( $e["address"]['region']) ){
              $scopeHTML .= ' <a href="javascript:;" class="filter" data-filter=".'.$e["address"]['region'].'" ><span class="label address text-dark text-xss">'.$e["address"]['region'].'</span></a>';
              if( !in_array($e["address"]['region'], $scopes['region']) ) {
                array_push($scopes['region'], $e["address"]['region'] );
                $scopesHTMLFull['Ville'][$e["address"]['region']] = ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$e["address"]['region'].'"><span>region '.$e["address"]['region'].'</span></a>';
                // $scopesHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$e["address"]['region'].'"><span>region '.$e["address"]['region'].'</span></a>';
              }
            }
            if( isset($e["address"]) && isset( $e["address"]['addressLocality'])){
              if ($e["address"]['addressLocality']=="Unknown")
                $adresseLocality="Adresse non renseignée";
              else
                $adresseLocality=$e["address"]['addressLocality'];
              $scopeHTML .= ' <a href="javascript:;" class="filter" data-filter=".'.str_replace( " ", "", $e["address"]['addressLocality']).'" ><span class="label address text-dark text-xss">'.$adresseLocality.'</span></a>';
              if( !in_array($e["address"]['addressLocality'], $scopes['addressLocality']) ) {
                array_push($scopes['addressLocality'], $e["address"]['addressLocality'] );
                // $scopesHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.str_replace( " ", "", $e["address"]['addressLocality']).'"><span>Locality  '.$e["address"]['addressLocality'].'</span></a>';
                 $scopesHTMLFull['Ville'][$e["address"]['addressLocality']] = ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.str_replace( " ", "", $e["address"]['addressLocality']).'"><span>Locality  '.$e["address"]['addressLocality'].'</span></a>';
              }
            }

            $strHTML .= '<div class="tools tools-bottom">'.$tagsHTML."<br/>".$scopeHTML.'</div>';
            $featuresHTML = "";
            if( $scopeHTML != "" ){
              $strHTML .= '<div class=" scopes'.$id.$type.' features">'.$scopeHTML.'</div>';
            }
            $strHTML .= '</div>';
            if( isset( $e["tags"]) ){
              $strHTML .= '<div class="hide tags'.$id.$type.' features tagblock">'.$tagsHTML.'</div>';
            }

           
            $color = "";
            if($icon == "fa-users") $color = "green";
            if($icon == "fa-user") $color = "yellow";
            if($icon == "fa-calendar") $color = "orange";
            if($icon == "fa-lightbulb-o") $color = "purple";

            $flag = '<div class="ico-type-account"><i class="fa '.$icon.' fa-'.$color.'"></i>';
            $flag.="</div>";
            return $panelHTML.'<div>'.$img.$flag.@$strHTML.'</div>';
          }


          function array_iunique($array) { 
            $lowered = array_map('strtolower', $array); 
            return array_intersect_key($array, array_unique($lowered)); 
        } 
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.2/isotope.pkgd.min.js"></script>
<style type="text/css">
  
.container{

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

.glyphicon { margin-right:5px; }

.thumbnail
{
    margin-bottom: 20px;
    padding: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
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

</style>

  
<!-- <link rel="stylesheet" type="text/css" href="http://frontend.apps.patapouf.org/css/app.css"> -->

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
  /* **************************************
  *  ORGANIZATIONS
  ***************************************** */
  $organizations = Organization::getWhere(array());

  /* **************************************
  *  PEOPLE
  ***************************************** */
  //$people = Person::getWhere(array( "roles.tobeactivated"=> array('$exists'=>1)));
  $people = Person::getWhere(array( "roles"=> array('$exists'=>1)));

  /* **************************************
  *  PROJECTS
  ***************************************** */
  $projects = array();

foreach ($people as $key => $onePeople) { if(isset($onePeople["name"])) $countPeople++;}
foreach ($organizations as $key => $orga) { if(isset($orga["name"])) $countOrga++;  }
foreach ($projects as $key => $project) { if(isset($project["name"])) $countProject++;  }
foreach ($events as $key => $event) { if(isset($event["name"])) $countEvent++;  }
if (isset($followers)){
  foreach ($followers as $key => $follower) { if(isset($follower["name"])) $countFollowers++;}
}
if (isset($follows)){
  if(isset($follows[Person::COLLECTION])){ 
    foreach ($follows[Person::COLLECTION] as $e) {
      $followsPeople++;
      $countPeople++;
    }
  }
  if(isset($follows[Organization::COLLECTION])){ 
    foreach ($follows[Organization::COLLECTION] as $e) {
      $followsOrga++;
      $countOrga++;
    }
  }
  if(isset($follows[Project::COLLECTION])){ 
    foreach ($follows[Project::COLLECTION] as $e) {
      $followsProject++;
      $countProject++;
    }
  }

}
?>
</script>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Annuaire Communecter</a>
    </div>
 
      <ul class="nav navbar-nav navbar-right">
        <li>
          <form class="navbar-form navbar-left" role="recherche">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Recherche...">
            </div>
           <!--  <button type="submit" class="btn btn-default btn-sm simply-button">
              <i class="fa fa-search fa-2x"></i>
            </button> -->
          </form>
        </li>
         <li>
          <a href="#" id="search" class="btn btn-default btn-sm simply-button quicksearch">
            <i class="fa fa-search-plus fa-2x"></i>
          </a>
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
    </div><!-- /.navbar-collapse -->

    <div class="row">
      <div class="small-12 columns">
        <section class="module list" >
          <header>
            
            
          </header>

          <div class="main-content">
            <div class="container">
              <div id="results" class="row list-group">
                <?php for($i=0;$i<10;$i++){ ?>
                  <div class="item  col-xs-4 col-lg-4">
                      <div class="thumbnail">
                          <img class="group list-group-image" src="http://placehold.it/400x250/000/fff" alt="" />
                          <div class="caption">
                              <h4 class="group inner list-group-item-heading">
                                  Product title</h4>
                              <p class="group inner list-group-item-text">
                                  Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                  sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                              <div class="row">
                                  <div class="col-xs-12 col-md-6">
                                      <p class="lead">
                                          $21.000</p>
                                  </div>
                                  <div class="col-xs-12 col-md-6">
                                      <a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

          <footer>
              <div class="status-msg"></div>
          </footer>

        </section>
      </div>
    </div>

  </div><!-- /.container-fluid -->
</nav>



<script type="text/javascript">
  
$(document).ready(function() {

    //Change the view
    $('#list').click(function(event){
      event.preventDefault();
      $('#results .item').addClass('list-group-item');
    });
    $('#grid').click(function(event){
      event.preventDefault();
      $('#results .item').removeClass('list-group-item');
      $('#results .item').addClass('grid-group-item');
    });

      // use value of search field to filter
      var $quicksearch = $('.quicksearch').keyup( debounce( function() {
        qsRegex = new RegExp( $quicksearch.val(), 'gi' );
        $grid.isotope();
      }, 200 ) );
  }


});

</script>



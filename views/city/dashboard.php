<?php
/*$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/weather-icons/css/weather-icons.min.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js' , CClientScript::POS_END);
*/
?>
<!-- start: PAGE CONTENT -->
<div class="row">

  <div class="col-md-12">
     <?php $this->renderPartial('geoStatistic', array("organizations" => $organizations, 
                                                      "events" => $events, 
                                                      "projects" => $projects, 
                                                      "city" => $city
                                                      )); ?>
  </div>

  <div class="col-sm-4 col-xs-12">
    <div class="panel panel-white">
      <div class="panel-heading border-light">
        <h4 class="panel-title">LOCAL ACTORS </h4>
		    <div class="panel-tools">
        	<a href="<?php echo Yii::app()->createUrl("/".$this->module->id.'/city/directory/insee/'.$insee);?>" class="btn btn-xs btn-light-blue" title="Show Directory" alt=""><i class="fa fa-globe"></i> Show Directory </a>
        </div>
      </div>
      <div class="panel-body no-padding center">

        <ul class="list-group">
          <li class="list-group-item">
            <span class="badge  badge-danger">400</span><span class="badge"> / </span><span class="badge">20</span>
            ASSOCIATIONS
          </li>
          <li class="list-group-item">
            <span class="badge badge-danger">800</span><span class="badge"> / </span><span class="badge">10</span>
            ENTREPRISES
          </li>
          <li class="list-group-item">
            <span class="badge">10</span>
            GROUPES
          </li>
          <li class="list-group-item">
            <span class="badge badge-danger">40</span><span class="badge"> / </span><span class="badge">5</span>
            COLLECTIVITÉ
          </li>
          <li class="list-group-item">
            <span class="badge badge-danger">35000</span><span class="badge"> / </span><span class="badge">500</span>
            LOCAL CONNECTED CITIZENS
          </li>
          <li class="list-group-item">
            <span class="badge">50</span>
            LOCAL EVENTS
          </li>
          <li class="list-group-item">
            <span class="badge">20</span>
            LOCAL PROJECTS
          </li>
        </ul>
       
      </div>
    </div>
  </div>

  <div class="col-sm-4 col-xs-12 shareAgendaPod">
		<div class="panel panel-white pulsate">
		<div class="panel-heading border-light ">
			<h4 class="panel-title"> <i class='fa fa-cog fa-spinn fa-2x icon-big text-center'></i> Loading Shared Agenda Section</h4>
			<div class="space5"></div>
		</div>
	</div>
  </div>

<div class="col-sm-4 col-xs-12 votingPod">
    <div class="panel panel-white pulsate">
    <div class="panel-heading border-light ">
      <h4 class="panel-title"> <i class='fa fa-cog fa-spinn fa-2x icon-big text-center'></i> Loading Voting Section</h4>
      <div class="space5"></div>
    </div>
  </div>
  </div>
</div>

<div class="row">

	<div class="col-sm-7 col-xs-12">
		<?php $this->renderPartial('../pod/sliderPhoto', array("userId" => (string)$person["_id"])); ?>
	</div>

    <div class="col-sm-5 col-xs-12">
        <?php $this->renderPartial('../pod/randomOrganization',array( "randomOrganization" => (isset($randomOrganization)) ? $randomOrganization : null )); ?>
    </div>

</div>

<div class="row">
	 <div class="col-sm-12 col-xs-12 statisticPop">
		 <div class="panel panel-white pulsate">
			<div class="panel-heading border-light ">
				<h4 class="panel-title"> <i class='fa fa-cog fa-spinn fa-2x icon-big text-center'></i> Loading Shared Agenda Section</h4>
				<div class="space5"></div>
			</div>
		 </div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4  col-xs-12">
		<?php $this->renderPartial('../person/dashboard/organizations',array( "organizations" => $organizations, "userId" => new MongoId($person["_id"]))); ?>
	</div>
	<div class="col-sm-4 col-xs-12">
		<?php $this->renderPartial('../pod/eventsList', array( "events" => $events, "userId" => (string)$person["_id"])); ?>
	</div>
	<div class="col-sm-4 col-xs-12">
		<?php $this->renderPartial('../pod/projectsList', array( "projects" => $projects)); ?>
	</div>
</div>

<div class="row">

  <div class="col-sm-4 col-xs-12">
    <div class="panel panel-blue">
        <div class="panel-heading">
          <h4 class="panel-title">ASK, DISCUSS, EXCHANGE</h4>
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
                <a href="#" class="panel-refresh"> <i class="fa fa-refresh"></i> <span>Refresh</span> </a>
              </li>
              <li>
                <a data-toggle="modal" href="#panel-config" class="panel-config"> <i class="fa fa-wrench"></i> <span>Configurations</span></a>
              </li>
              <li>
                <a href="#" class="panel-expand"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
              </li>                   
            </ul>
            </div>
            <a href="#" class="btn btn-xs btn-link panel-close"> <i class="fa fa-times"></i> </a>
          </div>
        </div>
        <div class="panel-body">
          <p class="space20">
            Abstract object styles for building various types of components (like blog comments, Tweets, etc) that feature a left or right aligned image alongside textual content.
          </p>
          <ul class="media-list">
            <li class="media">
              <a class="pull-left" href="#">
                <img data-src="holder.js/32x32" class="media-object" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+" alt="32x32" style="width: 64px; height: 64px;">
              </a>
              <div class="media-body">
                <h4 class="media-heading">Media heading</h4>
                <p>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                </p>
                <!-- Nested media object -->
                <div class="media">
                  <a class="pull-left" href="#">
                    <img data-src="holder.js/32x32" class="media-object" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+" alt="32x32" style="width: 64px; height: 64px;">
                  </a>
                  <div class="media-body">
                    <h4 class="media-heading">Nested media heading</h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                    <!-- Nested media object -->
                    <div class="media">
                      <a class="pull-left" href="#">
                        <img data-src="holder.js/32x32" class="media-object" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+" alt="32x32" style="width: 64px; height: 64px;">
                      </a>
                      <div class="media-body">
                        <h4 class="media-heading">Nested media heading</h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Nested media object -->
                <div class="media">
                  <a class="pull-left" href="#">
                    <img data-src="holder.js/32x32" class="media-object" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+" alt="32x32" style="width: 64px; height: 64px;">
                  </a>
                  <div class="media-body">
                    <h4 class="media-heading">Nested media heading</h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                  </div>
                </div>
              </div>
            </li>
            <li class="media">
              <a class="pull-right" href="#">
                <img data-src="holder.js/32x32" class="media-object" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+" alt="32x32" style="width: 64px; height: 64px;">
              </a>
              <div class="media-body">
                <h4 class="media-heading">Media heading</h4>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
              </div>
            </li>
          </ul>
        </div>
      </div>
  </div>

  <div class="col-sm-4 col-xs-12">
    <div class="panel panel-blue">
      <div class="panel-heading border-light">
        <h4 class="panel-title">COVOITURAGE  </h4>
      </div>
      <div class="panel-body no-padding center">
        <img class="img-responsive center-block"style="height:250px" src="http://placehold.it/350x150"/>
      </div>
    </div>
  </div>

  <div class="col-sm-4 col-xs-12">
    <div class="panel panel-blue">
      <div class="panel-heading border-light">
        <h4 class="panel-title">PETITES ANNONCES </h4>
      </div>
      <div class="panel-body no-padding center"  >
        <div class="col-sm-12 col-md-6">
          <div class="thumbnail">
            <img alt="100%x200" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOTciIGhlaWdodD0iMjAwIj48cmVjdCB3aWR0aD0iMTk3IiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijk4LjUiIHk9IjEwMCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxM3B4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE5N3gyMDA8L3RleHQ+PC9zdmc+" data-src="holder.js/100%x200" style="height: 200px; width: 100%; display: block;">
            <div class="caption">
              <h3>Thumbnail label</h3>
              <p>
                Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
              </p>
              <p>
                <a class="btn btn-default" href="#">
                  Button
                </a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-6">
          <div class="thumbnail">
            <img alt="100%x150" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOTciIGhlaWdodD0iMjAwIj48cmVjdCB3aWR0aD0iMTk3IiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijk4LjUiIHk9IjEwMCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxM3B4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE5N3gyMDA8L3RleHQ+PC9zdmc+" data-src="holder.js/100%x200" style="height: 200px; width: 100%; display: block;">
            <div class="caption">
              <h3>Thumbnail label</h3>
              <p>
                Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
              </p>
              <p>
                <a class="btn btn-default" href="#">
                  Button
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer "  >
        <a href="">En savoir+ <i class="fa fa-angle-right"></i> </a>
      </div>
    </div>
  </div>

</div>

<div class="row">

  <div class="col-sm-4 col-xs-12">
    <div class="panel panel-blue">
      <div class="panel-heading border-light">
        <h4 class="panel-title">PARTICPATE </h4>
      </div>
      <div class="panel-body no-padding center">
        <img class="img-responsive center-block"style="height:250px" src="http://placehold.it/350x150"/>
      </div>
    </div>
  </div>

  <div class="col-sm-4 col-xs-12">
    <div class="panel panel-blue">
      <div class="panel-heading border-light">
        <h4 class="panel-title">SURVEYS  </h4>
      </div>
      <div class="panel-body no-padding center">
        <img class="img-responsive center-block"style="height:250px" src="http://placehold.it/350x150"/>
      </div>
    </div>
  </div>

  <div class="col-sm-4 col-xs-12">
    <div class="panel panel-blue">
      <div class="panel-heading border-light">
        <h4 class="panel-title">OPENDATA </h4>
      </div>
      <div class="panel-body no-padding center"  >
        <img class="img-responsive center-block" style="height:250px" src="http://placehold.it/350x150"/>
      </div>
      <div class="panel-footer "  >
        <a href="">En savoir+ <i class="fa fa-angle-right"></i> </a>
      </div>
    </div>
  </div>

</div>

<div class="row">

  <div class="col-sm-10 col-xs-12">
    <div class="panel panel-blue">
      <div class="panel-heading border-light">
        <h4 class="panel-title">LOCAL NEWSLETTER </h4>
      </div>
      <div class="panel-body no-padding ">
          <img class="pull-left" class="img-responsive center-block" style="height:120px" src="http://placehold.it/100x120"/>
          <div class="padding-10">
            ASSOCIATION ACTU
            <br/>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus, earum, debitis. Consectetur inventore quaerat aperiam nihil minima, vitae laudantium, ut animi illum blanditiis cum earum, fugiat nisi ipsam dolore possimus.
            <br/>
            <a href="" class="btn btn-success">DERNIER N°</a> <a href="" class="btn btn-success">JE M'INSCRIS</a>
          </div>
      </div>
    </div>
  </div>

  <div class="col-sm-2 col-xs-12">
    <div class="panel panel-blue">
      <div class="panel-heading border-light center">
          <i class="fa fa-check-circle fa-3x"></i>
      </div>
      <div class="panel-body no-padding center" style="max-height:120px" >
        <button class="btn btn-green text-bold">COMMUNECT ME </button>
        <button class="btn btn-yellow text-bold">JUST FOLLOW </button>

      </div>
    </div>
  </div>

</div>
<!-- end: PAGE CONTENT-->
<script>

var contextMap = {};
contextMap = <?php echo json_encode($person) ?>;
var images = <?php echo json_encode($images) ?>;
var contentKeyBase = "<?php echo $contentKeyBase ?>";
var events = <?php echo json_encode($events) ?>;


jQuery(document).ready(function() {
	bindBtnFollow();

	$('.pulsate').pulsate({
            color: '#2A3945', // set the color of the pulse
            reach: 10, // how far the pulse goes in px
            speed: 1000, // how long one pulse takes in ms
            pause: 200, // how long the pause between pulses is in ms
            glow: false, // if the glow should be shown too
            repeat: 10, // will repeat forever if true, if given a number will repeat for that many times
            onHover: false // if true only pulsate if user hovers over the element
        });
		
		getAjax(".shareAgendaPod", baseUrl+"/"+moduleId+"/pod/slideragenda/id/<?php echo $_GET["insee"]?>/type/<?php echo City::COLLECTION ?>", function(){
			//initAddEventBtn ();
		}, "html");
    getAjax(".votingPod", baseUrl+"/"+moduleId+"/survey/index/type/<?php echo City::COLLECTION ?>/id/<?php echo $_GET["insee"]?>?tpl=indexPod", function(){
      //initAddEventBtn ();
    }, "html");

		getAjax(".photoVideoPod", baseUrl+"/"+moduleId+"/pod/photovideo/insee/<?php echo $_GET["insee"]?>/type/<?php echo City::COLLECTION ?>", function(){bindPhotoSubview();}, "html");

		getAjax(".statisticPop", baseUrl+"/"+moduleId+"/city/statisticpopulation/insee/<?php echo $_GET["insee"]?>", function(){bindBtnAction();}, "html")
		
});


function bindBtnFollow(){

  $(".disconnectBtn").off().on("click",function () {
        
    $(this).empty();
    $(this).html('<i class=" disconnectBtnIcon fa fa-spinnner fa-spinn"></i>');
    var btnClick = $(this);
    var idToDisconnect = $(this).data("id");
    var typeToDisconnect = $(this).data("type");
    bootbox.confirm("Are you sure you want to delete <span class='text-red'>"+$(this).data("name")+"</span> connection ?",
      function(result) {
          if (!result) {
            btnClick.empty();
                btnClick.html('<i class=" disconnectBtnIcon fa fa-unlink"></i>');
            return;
          }
          $.ajax({
                type: "POST",
                url: baseUrl+"/"+moduleId+"/person/disconnect/id/"+idToDisconnect+"/type/"+typeToDisconnect,
                dataType : "json"
            })
            .done(function (data) 
            {
                if ( data && data.result ) {               
                  toastr.info("LINK DIVORCED SUCCESFULLY!!");
                  $("#"+typeToDisconnect+idToDisconnect).remove();
                } else {
                   toastr.info("something went wrong!! please try again.");
                   btnClick.empty();
                   btnClick.html('<i class=" disconnectBtnIcon fa fa-unlink"></i>');
                }
            });
      });
  });

  $(".connectBtn").off().on("click",function () {
    $(".connectBtnIcon").removeClass("fa-link").addClass("fa-spinnner fa-spinn");
    var idConnect = "<?php echo (string)$person['_id'] ?>";
    if('undefined' != typeof $("#inviteId") && $("#inviteId").val()!= ""){
      idConnect = $("#inviteId").val();
    }

    $.ajax({
          type: "POST",
          url: baseUrl+"/"+moduleId+"/person/follows/id/"+idConnect+"/type/<?php echo PHType::TYPE_CITOYEN ?>",
          dataType : "json"
      })
      .done(function (data)
      {
          if ( data && data.result ) {               
            toastr.info("REALTION APPLIED SUCCESFULLY!! ");
            $(".connectBtn").fadeOut();
            $("#btnTools").empty();
            $("#btnTools").html('<a href="javascript:;" class="disconnectBtn btn btn-red tooltips pull-right btn-xs" data-placement="top" data-original-title="Remove this person as a relation" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>');
            bindBtnFollow();
          } else {
             toastr.info("something went wrong!! please try again.");
             $(".connectBtnIcon").removeClass("fa-spinnner fa-spinn").addClass("fa-link");
          }
      });
        
  });
}

	
</script>
<style>
  
  .btn-add-to-directory{
    font-size: 14px;
    margin-right: 0px;
    border-radius: 6px;
    color: #666;
    border: 1px solid rgba(188, 185, 185, 0.69);
    margin-left: 3px;
    float: left;
    padding: 1px;
    width: 24px;
    margin-top: 15px;
  }
  .searchEntity{
    padding: 10px 0 10px 0 !important;
    margin: 0px !important;
    border-top: solid rgba(128, 128, 128, 0.2) 1px;
    margin-left: 0% !important;
    width: 100%;
  }
  .searchEntity:hover{
    background-color: rgba(211, 211, 211, 0.2);
  }

  #grid_around{
    margin:0 -15px 0 -15px;
  }

</style>


<h3 class="text-dark text-left">
  <i class="fa fa-crosshairs"></i> Retrouvez les éléments <b>les plus actifs autour de vous</b>, dans un rayon de 
  <select class="inline text-red" id="stepSearch" style="padding: 6px;font-size:17px;">
    <option value="2000" <?php echo $radius=="2000"?"selected":"";?>>2</option>
    <option value="5000" <?php echo $radius=="5000"?"selected":"";?>>5</option>
    <option value="10000" <?php echo $radius=="10000"?"selected":"";?>>10</option>
    <option value="25000" <?php echo $radius=="25000"?"selected":"";?>>25</option>
    <option value="50000" <?php echo $radius=="50000"?"selected":"";?>>50</option>
  </select> km
  <button class="btn btn-success" style="margin-left:20px;" onclick="javascript:showMap(true)">
    <i class="fa fa-map-marker"></i> Afficher sur la carte
  </button>
</h3>

<?php if(sizeOf($all)==0){ ?>
  <h3 class="text-red">
    <i class="fa fa-ban"></i> Aucun élément n'a été trouvé.
    <br><small><b>Élargissez la zone de recherche pour plus de résultat</b></small>
  </h3>
  <button class="btn bg-dark" id="reloadAuto"><i class="fa fa-binoculars"></i> Recherche automatique</button>
<?php }else{ ?>
  <h3 class="text-dark">
    <b>
      <i class="fa fa-angle-down"></i> 
      <?php echo sizeOf($all); ?> élément<?php echo sizeOf($all)>1?"s":""; ?> trouvé<?php echo sizeOf($all)>1?"s":""; ?>
    </b>
  </h3>
<?php } ?>

<div id="grid_around"></div>


<script>

var mapElements = new Array();
var elementsMap = <?php echo json_encode($all) ?>;
var personCOLLECTION = "<?php echo Person::COLLECTION ?>";

var radius = "<?php echo $radius; ?>";
var idElement = "<?php echo $id ?>";
var typeElement = "<?php echo $type ?>";

jQuery(document).ready(function() {
	
	setTitle("Autour de moi",
			 "<i class='fa fa-crosshairs'></i>", 
			 "Autour de moi");

	//showMap(true);
	Sig.showMyPosition();
	Sig.showMapElements(Sig.map, elementsMap);
  if(notEmpty(elementsMap)) showGridResult(elementsMap);
  initBtnLink();

  $("#stepSearch").change(function(){
    radius = $(this).val();
    loadByHash("#element.aroundme.type."+typeElement+".id."+idElement+".radius."+radius+".manual.true");
  });
  $("#reloadAuto").click(function(){
    radius = $("#stepSearch").val();
    loadByHash("#element.aroundme.type."+typeElement+".id."+idElement+".radius."+radius);
  });
	//console.dir(elementsMap);
});


function showGridResult(data){
  var str = "";
	$.each(data, function(i, o) {
      var typeIco = i;
      var ico = mapIconTop["default"];
      var color = mapColorIconTop["default"];

      mapElements.push(o);

		  typeIco = typeof o.typeSig != "undefined" ? o.typeSig : null;
      ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
      color = ("undefined" != typeof mapColorIconTop[typeIco]) ? mapColorIconTop[typeIco] : mapColorIconTop["default"];
      
      var htmlIco ="<i class='fa "+ ico +" fa-2x bg-"+color+"'></i>";
     	if("undefined" != typeof o.profilThumbImageUrl && o.profilThumbImageUrl != ""){
        htmlIco= "<img width='80' height='80' alt='' class='img-circle bg-"+color+"' src='"+baseUrl+o.profilThumbImageUrl+"'/>"
      }

      city="";

      var postalCode = o.cp
      if (o.address != null) {
        city = o.address.addressLocality;
        postalCode = o.cp ? o.cp : o.address.postalCode ? o.address.postalCode : "";
      }
      
      //console.dir(o);
      var id = getObjectId(o);
      var insee = o.insee ? o.insee : ""; console.log(typeIco);
      type = typeObj[typeIco].col;
      // var url = "javascript:"; // baseUrl+'/'+moduleId+ "/default/simple#" + type + ".detail.id." + id;
      //type += "s";
      var url = '#news.index.type.'+type+'.id.' + id;
      if(type == "citoyens") url += '.viewer.' + userId;
      if(type == "cities") url = "#city.detail.insee."+o.insee+".postalCode."+o.cp;

      //if(type=="citoyen") type = "person";
     
      var onclick = 'loadByHash("' + url + '");';

      var onclickCp = "";
      var target = " target='_blank'";
      var dataId = "";
      if(type == "city"){
      	url = "javascript:"; //#main-col-search";
      	onclick = 'setScopeValue($(this))'; //"'+o.name.replace("'", "\'")+'");';
      	onclickCp = 'setScopeValue($(this));';
      	target = "";
        dataId = o.name; //.replace("'", "\'");
      }

      var tags = "";
      if(typeof o.tags != "undefined" && o.tags != null){
				$.each(o.tags, function(key, value){
					if(value != "")
          tags +=   "<a href='javascript:' class='badge bg-white text-red btn-tag tag' data-tag-value='"+value+"'>#" + value + "</a> ";
        });
      }

      var name = typeof o.name != "undefined" ? o.name : "";
      var postalCode = (typeof o.address != "undefined" &&
      				  typeof o.address.postalCode != "undefined") ? o.address.postalCode : "";
      
      if(postalCode == "") postalCode = typeof o.cp != "undefined" ? o.cp : "";
      var cityName = (typeof o.address != "undefined" &&
      				typeof o.address.addressLocality != "undefined") ? o.address.addressLocality : "";
      
      var fullLocality = postalCode + " " + cityName;

      var description = (typeof o.shortDescription != "undefined" &&
      					o.shortDescription != null) ? o.shortDescription : "";
      if(description == "") description = (typeof o.description != "undefined" &&
      									 o.description != null) ? o.description : "";

      /*var startDate = (typeof o.startDate != "undefined") ? "Du "+dateToStr(o.startDate, "fr", true, true) : null;
      var endDate   = (typeof o.endDate   != "undefined") ? "Au "+dateToStr(o.endDate, "fr", true, true)   : null;
      */
      var startDate = notEmpty(o.startDate) ? dateToStr(o.startDate, "fr", true, true) : null;
      var endDate   = notEmpty(o.endDate) ? dateToStr(o.endDate, "fr", true, true)   : null;
      if(endDate == null) endDate = notEmpty(o.dateEnd) ? dateToStr(o.dateEnd, "fr", true, true)   : null;
      
      
      //template principal
      str += "<div class='col-md-12 searchEntity no-padding'>";

        
        if(userId != null){
            isFollowed=false;
            str += "<div class='col-md-1 col-sm-1 col-xs-1' style='max-width:40px;'>";
            if(typeof o.isFollowed != "undefined" ) isFollowed=true;
            if(type!="cities" && id != userId && userId != null && userId != ""){
              tip = (type == "events") ? "Participer" : 'Suivre';
              str += "<a href='javascript:;' class='btn btn-default btn-sm btn-add-to-directory bg-white tooltips followBtn'" + 
                    'data-toggle="tooltip" data-placement="left" data-original-title="'+tip+'"'+
                    " data-ownerlink='follow' data-id='"+id+"' data-type='"+type+"' data-name='"+name+"' data-isFollowed='"+isFollowed+"'>"+
                        "<i class='fa fa-chain'></i>"+ //fa-bookmark fa-rotate-270
                      "</a>";
            }
            str += '</div>';
          }

        
        str += "<div class='col-md-2 col-sm-2 col-xs-3 entityCenter no-padding'>";

        str += "<a href='"+url+"' class='lbh'>" + htmlIco + "</a>";
        str += "</div>";
         target = "";

         

          
        str += "<div class='col-md-8 col-sm-9 col-xs-6 entityRight no-padding'>";
        	
          str += "<a href='"+url+"' "+target+" class='entityName text-dark lbh'>" + name + "</a>";
          
          if(fullLocality != "" && fullLocality != " ")
        	str += "<a href='"+url+"' "+target+ ' data-id="' + dataId + '"' + "  class='entityLocality lbh'><i class='fa fa-home'></i> " + fullLocality + "</a>";
        	if(startDate != null)
        	str += "<div class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + startDate + "</div>";
        	if(endDate != null)
        	str += "<div  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + endDate + "</div>";
        	if(description != "")
        	str += "<div class='entityDescription'>" + description + "</div>";
        //str += "</div>";

        //str += "<div class='col-md-8 col-sm-10 entityRight no-padding'>";
          
          str += tags;
  
        str += "</div>";

        
        					
      str += "</div>";
  }); //end each

	$("#grid_around").html(str);
}



function initBtnLink(){
  $('.tooltips').tooltip();
  //parcours tous les boutons link pour vérifier si l'entité est déjà dans mon répertoire
  $.each($(".followBtn"), function(index, value){
    var id = $(value).attr("data-id");
    var type = $(value).attr("data-type");
    console.log("error type :", type);
    if(type == "person") type = "people";
    else type = typeObj[type].col;
    //console.log("#floopItem-"+type+"-"+id);
    if($("#floopItem-"+type+"-"+id).length){
      //console.log("I FOLLOW THIS");
      if(type=="people"){
        $(value).html("<i class='fa fa-unlink text-green'></i>");
        $(value).attr("data-original-title", "Ne plus suivre cette personne");
        $(value).attr("data-ownerlink","unfollow");
      }
      else{
        $(value).html("<i class='fa fa-user-plus text-green'></i>");
        
        if(type == "organizations")
          $(value).attr("data-original-title", "Vous êtes membre de cette organization");
        else if(type == "projects")
          $(value).attr("data-original-title", "Vous êtes contributeur de ce projet");
        
        //(value).attr("onclick", "");
        $(value).removeClass("followBtn");
      }
    }
    if($(value).attr("data-isFollowed")=="true"){

      $(value).html("<i class='fa fa-unlink text-green'></i>");
      $(value).attr("data-original-title", (type == "events") ? "Ne plus participer" : "Ne plus suivre" );
      $(value).attr("data-ownerlink","unfollow");
      $(value).addClass("followBtn");
    }
  });

  //on click sur les boutons link
  $(".followBtn").click(function(){
    formData = new Object();
    formData.parentId = $(this).attr("data-id");
    formData.childId = userId;
    formData.childType = personCOLLECTION;
    var type = $(this).attr("data-type");
    var name = $(this).attr("data-name");
    var id = $(this).attr("data-id");
    //traduction du type pour le floopDrawer
    var typeOrigine = typeObj[type].col;
    if(typeOrigine == "persons"){ typeOrigine = personCOLLECTION;}
    formData.parentType = typeOrigine;
    if(type == "person") type = "people";
    else type = typeObj[type].col;

  var thiselement = this;
  $(this).html("<i class='fa fa-spin fa-circle-o-notch text-azure'></i>");
  //console.log(formData);
  var linkType = (type == "events") ? "connect" : "follow";
  if ($(this).attr("data-ownerlink")=="follow"){
    $.ajax({
      type: "POST",
      url: baseUrl+"/"+moduleId+"/link/"+linkType,
      data: formData,
      dataType: "json",
      success: function(data) {
        if(data.result){
          toastr.success(data.msg); 
          $(thiselement).html("<i class='fa fa-unlink text-green'></i>");
          $(thiselement).attr("data-ownerlink","unfollow");
          $(thiselement).attr("data-original-title", (type == "events") ? "Ne plus participer" : "Ne plus suivre");
          addFloopEntity(id, type, data.parentEntity);
        }
        else
          toastr.error(data.msg);
      },
    });
  } else if ($(this).attr("data-ownerlink")=="unfollow"){
    formData.connectType =  "followers";
    //console.log(formData);
    $.ajax({
      type: "POST",
      url: baseUrl+"/"+moduleId+"/link/disconnect",
      data : formData,
      dataType: "json",
      success: function(data){
        if ( data && data.result ) {
          $(thiselement).html("<i class='fa fa-chain'></i>");
          $(thiselement).attr("data-ownerlink","follow");
          $(thiselement).attr("data-original-title", (type == "events") ? "Participer" : "Suivre");
          removeFloopEntity(data.parentId, type);
          toastr.success(trad["You are not following"]+data.parentEntity.name);
        } else {
           toastr.error("You leave succesfully");
        }
      }
    });
  }
  });
  //on click sur les boutons link
  $(".btn-tag").click(function(){
    setSearchValue($(this).html());
  });
}


</script>
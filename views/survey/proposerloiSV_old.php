<div class="modal fade" id="proposerloiForm" tabindex="-1" role="dialog" aria-labelledby="proposerloiFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="proposerloiFormLabel" >Faites une proposition </h3>
      </div>
      <div class="modal-body">
      	<p> Vous pouvez proposer toute initiative relevant de la compétence de votre 
          député ou pour laquelle vous souhaiteriez un vote de vos concitoyens. </p>
        <br/>
        <form id="saveEntryForm" action="">
        
          Titre de la proposition<br/>
          <input type="text" name="nameaddEntry" id="nameaddEntry" width=200 maxlength=100 value="" placeholder="100 caract. max." />
          <br/><br/>
          
          Texte de la proposition<br/>
          <textarea id="message" style="width:100%;height:30px;vertical-align: middle" onkeyup="AutoGrowTextArea(this);$('#message1').val($('#message').val())"></textarea>
          <br/><br/>

          Urls de réferences (taper entrée pour en ajouter a volonté)
          <div class="inputs"> 
          <div><input type="text" name="urls[]" class="addmultifield" value="" placeholder="http://exemple.com"/></div> 
          </div>
          <a href="javascript:;" id="add"><i class=" fa fa-plus-circle" style="font-size: 1.5em"></i></a> | <a href="javascript:;" id="remove"><i class=" fa fa-minus-circle" style="font-size: 1.5em"></i></a>  | <a href="javascript:;" id="reset"><i class=" fa fa-recycle"  style="font-size: 1.5em"></i></a>  
        </form>
        <div style="clear:both"></div>
      </div>
       <div class="modal-footer">
          
          <a class="btn btn-warning " href="javascript:;" onclick="$('#saveEntryForm').submit();return false;"  >Proposer</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <br/>
          Les propositions sont modérées avant publication sur le site afin d'éviter tous propos contraires à la loi ou susceptible de troubler l'ordre public.
          <br/>
          Nous nous réservons donc la possibilité de modifier, reformuler, compléter, différer ou ne pas publier tout ou partie d'une proposition. Dans cette éventualité, nous pouvons être amener à vous contacter par mail.
          <br/>
          Selon le nombre de propositions reçues, le délai de mise en ligne peut être variable. En cas d'urgence, merci le signaler des le début de votre proposition.
          <br/>
          Votre proposition sera publiée par l'administrateur du site vote.partipirate.pm. Ni votre adresse email ni votre nom n'apparaitront sur le site public.
          <br/>
          Vous pouvez aussi nous faire part de toute remarque constructive, nous permettant d'améliorer ce site à votre service"
          <br/>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() 
{
  
  

    $("#saveEntryForm").submit( function(event){
      //log($(this).serialize());
      event.preventDefault();
      one = getRandomInt(0,10);
      two = getRandomInt(0,10);
      if( prompt("combien font "+one+"+"+two+" ?") == one+two ){
        $("#proposerloiForm").modal('hide');
        //toggleSpinner();
        var hashtagList = getHashTagList( $("#message").val() );
        log(hashtagList.hashtags);
        //log(hashtagList.people);

        params = { "survey" : "<?php echo (string)$survey['_id']?>", 
                   "email" : "<?php echo Yii::app()->session['userEmail']?>" , 
                   "name" : $("#nameaddEntry").val() , 
                   "tags" : hashtagList.hashtags ,
                   "message":$("#message").val(),
                   "cp" : "<?php echo $survey['cp']?>" , 
                   "type" : "entry",
                   "urls" : getUrls(),
                   "app":"<?php echo $this->module->id?>"
                };
       console.dir(params);
       $.ajax({
          type: "POST",
          url: '<?php echo Yii::app()->createUrl($this->module->id."/api/saveSession")?>',
          data: params,
          success: function(data){
            if(data.result){
                window.location.reload();
            }
            else {
                  $("#flashInfo .modal-body").html(data.msg);
                  $("#flashInfo").modal('show');
            }
            //toggleSpinner();
          },
          dataType: "json"
        });
    } else 
      alert("mauvaise réponse, etes vous humain ?");
    });
  
    $('#add').click( function(){ addfield() } );
    function addfield() {
        $('<div><input type="text" class="addmultifield" name="urls[]" value="" /></div>').fadeIn('slow').appendTo('.inputs');
        $('.addmultifield:last').focus();
        initMultiFileds();
    }
    $('#remove').click(function() {
    if($('.addmultifield').length > 1) {
        $('.addmultifield:last').remove();
    }
    });
 
    $('#reset').click(function() {
    while($('.addmultifield').length > 1) {
        $('.addmultifield:last').remove();
    }
    });
 
    // here's our click function for when the forms submitted
    function getUrls(){
        var urls = [];
        $.each($('.addmultifield'), function() {
            urls.push( $(this).val() );
        });
        return urls;
    };

    function initMultiFileds(){
      $('.addmultifield').keydown(function(event) {
          if ( event.keyCode == 13)
            addfield();
      });
    }
    initMultiFileds();
});

function getRandomInt (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function getHashTagList(mystr){
  var strT = mystr.split(" ");
  hashtags = "";
  people = "";
  $.each(strT,function(i,v){
    if(v.indexOf("#")==0 && v != "#"){
      //log(v);
      if(hashtags != "" )
        hashtags += ",";
      hashtags += v.substring(1,v.length);
    }
    if(v.indexOf("@")==0 && v != "@"){
      //log(v);
      if(people != "" )
        people += ",";
      people += v.substring(1,v.length);
    }
  });
  log(hashtags)
  log(people);

  return {"hashtags":hashtags,"people":people};
}

</script>
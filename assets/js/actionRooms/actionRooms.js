function actionRoomDelete(id, $this, parentId){
  bootbox.confirm(trad["suretodeletediscuss"], 
    function(result) {
      if (result) {
        $.ajax({
              type: "POST",
              url: baseUrl+"/"+moduleId+"/rooms/deleteroom/id/"+id,
          dataType: "json",
              success: function(data){
                if (data.result) {               
                  toastr.success(data.msg);
                  showRoom('all', parentId);
                } else {
                  toastr.error(data.msg);
                }
            }
        });
      }
    }
  )
}

//TODO SBAR : mutualize with newsReportAbuse
function actionRoomReportAbuse(id, $this) {
    var message = "<div id='reason' class='radio'>"+
      "<label><input type='radio' name='reason' value='Propos malveillants' checked>Propos malveillants</label><br>"+
      "<label><input type='radio' name='reason' value='Incitation et glorification des conduites agressives'>Incitation et glorification des conduites agressives</label><br>"+
      "<label><input type='radio' name='reason' value='Affichage de contenu gore et trash'>Affichage de contenu gore et trash</label><br>"+
      "<label><input type='radio' name='reason' value='Contenu pornographique'>Contenu pornographique</label><br>"+
        "<label><input type='radio' name='reason' value='Liens fallacieux ou frauduleux'>Liens fallacieux ou frauduleux</label><br>"+
        "<label><input type='radio' name='reason' value='Mention de source erronée'>Mention de source erronée</label><br>"+
        "<label><input type='radio' name='reason' value='Violations des droits auteur'>Violations des droits d\'auteur</label><br>"+
        "<input type='text' class='form-control' id='reasonComment' placeholder='Laisser un commentaire...'/><br>"+
      "</div>";
    var boxNews = bootbox.dialog({
      message: message,
      title: trad["askreasonreportabuse"],
      buttons: {
        annuler: {
          label: "Annuler",
          className: "btn-default",
          callback: function() {
            mylog.log("Annuler");
          }
        },
        danger: {
          label: "Déclarer cet abus",
          className: "btn-primary",
          callback: function() {
            // var reason = $('#reason').val();
            var reason = $("#reason input[type='radio']:checked").val();
            var reasonComment = $("#reasonComment").val();
            //actionOnNews($($this),action,method, reason, reasonComment);
            toastr.info("This feature is comming soon !");
            //$($this).children(".label").removeClass("text-dark").addClass("text-red");
          }
        },
      }
    });
    boxNews.on("shown.bs.modal", function() {
      $.unblockUI();
    });
}
<?php 
    HtmlHelper::registerCssAndScriptsFiles( 
        array(  '/css/referencement.css',) , 
        Yii::app()->theme->baseUrl. '/assets');
?>

<div class="portfolio-modal modal fade" id="modalEditUrl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-md-6 text-left">
                    <h3 class="letter-red"><i class="fa fa-cog"></i> Editer une URL</h3>
                    <hr>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="lbl-url">
                                <i class="fa fa-circle"></i> URL
                            </label>
                            <input type="text" class="form-control" placeholder="id" id="form-idurl"><br>
                            
                            <input type="text" class="form-control" placeholder="exemple : http://kgougle.nc" id="form-url"><br>
                            <h5 class="letter-green pull-left" id="status-ref"></h5>                    
                            <!-- <button class="btn btn-success pull-right btn-scroll" data-targetid="#formRef" id="btn-start-ref-url">
                                <i class="fa fa-binoculars"></i> Lancer la recherche d'information
                            </button> -->
                        </div>
                    </div>
                    <div class="col-md-12" id="refResult">
                        <label id="lbl-title">
                            <i class="fa fa-circle"></i> Nom de la page
                            <small class="pull-right text-light">
                                <code>&lttitle&gt&lt/title&gt</code>
                            </small>
                        </label>
                        <input type="text" class="form-control" placeholder="Nom de la page" id="form-title"><br>

                        <label id="lbl-description">
                            <i class="fa fa-circle"></i> Description
                            <small class="pull-right text-light">
                                <code>&ltmeta name="description"&gt</code>
                            </small>
                        </label>
                        <textarea class="form-control" placeholder="Description" id="form-description"></textarea><br>

                        <div class="col-md-12 no-padding">
                            <label id="lbl-keywords">
                                <i class="fa fa-circle"></i> Mots clés                      
                                <small class="pull-right text-light">
                                    <code>&ltmeta name="keywords"&gt</code>
                                </small><br>
                                <!-- <small class="text-light">
                                    <i class="fa fa-info-circle"></i> Les mots clés servent à optimiser les résultats de recherche, choisissez les avec soins<br>
                                    <i class="fa fa-signal fa-flip-horizontal"></i> Par ordre d'importance (1 > 2 > 3 > 4)</small><br><br> -->
                            </label>
                        </div>
                        <div class="col-md-3 padding-5">
                            <input type="text" class="form-control" placeholder="expression 1" id="form-keywords1"><br>
                        </div>
                        <div class="col-md-3 padding-5">
                            <input type="text" class="form-control" placeholder="expression 2" id="form-keywords2"><br>
                        </div>
                        <div class="col-md-3 padding-5">
                            <input type="text" class="form-control" placeholder="expression 3" id="form-keywords3"><br>
                        </div>
                        <div class="col-md-3 padding-5">
                            <input type="text" class="form-control" placeholder="expression 4" id="form-keywords4"><br>
                        </div>
                        <div class="col-md-12 padding-5">  
                             <label id="lbl-description">
                                <i class="fa fa-circle"></i> Status
                            </label>
                            <select class="form-control" id="form-status">
                                <option name="status" value="locked">locked</option>
                                <option name="status" value="uncomplet">uncomplet</option>
                                <option name="status" value="validated">validated</option>
                                <option name="status" value="active">active</option>
                            </select>
                            <hr>
                        </div>
                        
                        <div class="row">  
                            <button class="btn btn-danger pull-left" id="btn-conf-delete" data-target="#modalDeleteUrl" data-toggle="modal" >
                                <i class="fa fa-trash"></i> Supprimer
                            </button>
                            <button class="btn btn-success pull-right" id="btn-save-maj-metadata" ><i class="fa fa-save"></i> Enregistrer</button> 
                            <button class="btn btn-default pull-right margin-right-5" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button> 
                        </div>

                    </div>
                </div>
                <div class="col-md-6" id="mainCategoriesEdit">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="portfolio-modal modal fade" id="modalDeleteUrl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-left margin-top-70">
                    <h3 class="letter-red"><i class="fa fa-cog"></i> Souhaitez-vous vraiment supprimer cette URL ?</h3>
                    <h4 id="urlDeleteName"></h4>

                    <div class="row margin-top-70">  
                        <button class="btn btn-danger pull-left" id="btn-delete-url" ><i class="fa fa-trash"></i> Oui, supprimer</button>
                        <button class="btn btn-default pull-right margin-right-5" data-dismiss="modal"><i class="fa fa-times"></i> Non, annuler</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

jQuery(document).ready(function() {
    $("#btn-save-maj-metadata").click(function(){
        sendReferencement();
    });

    $("#btn-conf-delete").click(function(){
        var url = $("#form-url").val();
        $("#urlDeleteName").html(url);
    });

    $("#btn-delete-url").click(function(){
        var url = $("#form-url").val();
        $.ajax({
            type: "POST",
            url: baseUrl+"/"+moduleId+"/co2/superadmin/action/deleteUrl",
            data: { "url" : url },
            dataType: "json",
            success: function(data){
                toastr.success("L'url a bien été supprimé");
                //else toastr.error("Une erreur est survenue pendant le référencement");
                console.log("delete url success");
            },
            error: function(data){
                toastr.error("Une erreur est survenue pendant l'envoi de votre demande", data);
                console.log("save referencement error");
            }
        });
    });

    

    buildListCategoriesForm();
});

function sendReferencement(){
    console.log("start referencement");

    var id = $("#form-idurl").val();
    
    var url = $("#form-url").val();
    var title = $("#form-title").val();
    var description = $("#form-description").val();

    var keywords1 = $("#form-keywords1").val();
    var keywords2 = $("#form-keywords2").val();
    var keywords3 = $("#form-keywords3").val();
    var keywords4 = $("#form-keywords4").val();

    var keywords = new Array();

    if(notEmpty(keywords1)) keywords.push(keywords1);
    if(notEmpty(keywords2)) keywords.push(keywords2);
    if(notEmpty(keywords3)) keywords.push(keywords3);
    if(notEmpty(keywords4)) keywords.push(keywords4);
    
    var status = $("#form-status").val();

    var urlObj = {
            url : url,
            title: title, 
            description: description,
            tags: keywords,
            categories : categoriesSelected,
            status: status
    };

    console.log("UPDATE THIS URL DATA ?", urlObj, id);
   
    $.ajax({
        type: "POST",
        url: baseUrl+"/"+moduleId+"/co2/superadmin/action/updateurlmetadata",
        data: { "id" : id,
                "values" : urlObj },
        dataType: "json",
        success: function(data){
            //if(data.valid == true) 
            toastr.success("Votre demande a bien été enregistrée");

            $("#form-idurl").val("");
            $("#form-url").val("");
            $("#form-title").val("");
            $("#form-description").val("");

            $("#form-keywords1").val("");
            $("#form-keywords2").val("");
            $("#form-keywords3").val("");
            $("#form-keywords4").val("");
            //else toastr.error("Une erreur est survenue pendant le référencement");
            console.log("save referencement success");

            $("#modalEditUrl").modal("hide");
        },
        error: function(data){
            toastr.error("Une erreur est survenue pendant l'envoi de votre demande", data);
            console.log("save referencement error");
        }
    });
}


var categoriesSelected = new Array();
function buildListCategoriesForm(){
    console.log("mainCategoriesEdit", mainCategories);

    var html = "";

    $.each(mainCategories, function(name, params){
        var classe="";
        if(params.color == "green") classe="search-eco";

        html    += '<section id="portfolio" class="'+classe+'">'+
                        '<div class="">'+
                            '<div class="row">'+
                                '<div class="col-lg-12 text-center">'+
                                    '<h4 class="letter-'+params.color+'">'+
                                        name+
                                    '</h4>'+
                                    '<hr>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row text-'+params.color+'">';

        $.each(params.items, function(keyC, val){
            //console.log(keyC, val);
            html +=             '<div class="col-md-3 col-sm-4 col-xs-6 portfolio-item cat-'+val.name+'">'+
                                    '<button class="portfolio-link btn-select-category" data-value="'+val.name+'">'+
                                        '<div class="caption">'+
                                            '<div class="caption-content">'+
                                            '</div>'+
                                        '</div>'+
                                        '<i class="fa fa-'+val.faIcon+' fa-2x"></i>'+
                                        '<h3>'+val.name+'</h3>'+
                                    '</button>'+
                                '</div>'
        });

        html +=             '</div>' + 
                        '</div>' + 
                    '</section>';

    });

    $("#modalEditUrl #mainCategoriesEdit").html(html);

    $("#modalEditUrl .btn-select-category").click(function(){ console.log("click cat");
        var val = $(this).data("value");
        
        if(categoriesSelected.indexOf(val) < 0){
            categoriesSelected.push(val);
            $(this).parent().addClass("selected");
        }
        else{
            categoriesSelected.splice(categoriesSelected.indexOf(val), 1);
            $(this).parent().removeClass("selected");
        }

        // if(categoriesSelected.length > 0){
        //  $("#send-ref, #refLocalisation").removeClass("hidden");
        //  $("#info-select-cat").addClass("hidden");
        // }else{
        //  $("#send-ref, #refLocalisation").addClass("hidden");
        //  $("#info-select-cat").removeClass("hidden");
        // }
        //console.log("categoriesSelected");
        //console.dir(categoriesSelected);
    });
}


</script>

<h3 id="titleWebSearch">
	<i class="fa fa-angle-down"></i> <?php echo sizeof($siteurls); ?> Résultat(s) 
	<?php echo @$category ? "<br><small class=''><i class='fa fa-cube'></i> ".@$category."</small>" : ""; ?>
</h3>

<style>
	.siteurl_title{
		font-size:17px!important;
	}
	.siteurl_hostname{
		font-size:14px!important;
	}
	.siteurl_desc{
		font-size:13px!important;
		color:#606060;
	}
</style>

<div class="col-md-8 margin-bottom-15" style="">
<?php  foreach ($siteurls as $key => $siteurl) { ?>
	<div class="col-md-12 margin-bottom-15">
		<a class="siteurl_title letter-blue" target="_blank" href="<?php echo $siteurl["url"]; ?>">
			<?php echo $siteurl["title"]; ?>
		</a><br>
		<span class="siteurl_hostname letter-green"><?php echo $siteurl["url"]; ?></span><br>
		<span class="siteurl_desc letter-grey"><?php echo $siteurl["description"]; ?></span><br>
		
		<span class="siteurl_desc letter-grey">
			<b><?php  foreach ($siteurl["categories"] as $key => $category) { ?>
			<?php echo $category; ?> | 
			<?php } ?>
			</b> 
			<b>
				<?php  foreach ($siteurl["tags"] as $key => $tag) { ?>
					<?php echo $tag; ?> 
				<?php } ?>
			</b>
		</span>
	</div>
<?php } ?>
</div>

<script>
var siteurls = <?php echo json_encode($siteurls); ?>

jQuery(document).ready(function() {
   Sig.showMapElements(Sig.map, siteurls);

   $(".siteurl_title").click(function(){
   		var url = $(this).attr("href");
   		incNbClick(url);
   });

});

function incNbClick(url){
	console.log("incrémentation nbClick essai");
	$.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+"/siteurl/incnbclick/",
        data: { url : url },
        dataType: "json",
        success:
            function(data) {
            console.log("incrémentation nbClick ok", data);
                // $("#searchResults").html(html);
                // $("#sectionSearchResults").removeClass("hidden");
                // KScrollTo("#sectionSearchResults");
            },
        error:function(xhr, status, error){
            console.log("erreur lors de l'incrémentation nbClick");
            //$("#searchResults").html("erreur");
        },
        statusCode:{
                404: function(){
                    console.log("404 erreur lors de l'incrémentation nbClick");
            }
        }
    });
}
</script>
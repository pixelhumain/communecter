<div id="panel_members" class="tab-pane fade">

	<div class="col-md-12 padding-20 pull-right">
		<a href="#addMembers" class="addMembersBtn btn btn-xs btn-light-blue tooltips pull-right" data-placement="top" data-original-title="Connect People or Organizations that are part of your Organization"><i class="fa fa-plus"></i> Connect Members</a>
	</div>

	<h1>List of Members</h1>
    <p>An Organization can have People or Organization as members</p>
    
    <table class="table table-striped table-bordered table-hover" id="members">
		<thead>
			<tr>
				<th>Name</th>
				<th class="hidden-xs">Type</th>
				<th class="hidden-xs center">Tags</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(isset($members)) {
			foreach ($members as $member) 
			{
				if ( isset( $member["_id"] ) ) 
				{
					if (isset($member["publicURL"])) $publicURL = $member["publicURL"];
			?>
			<tr id="member<?php echo (string)$member["_id"];?>">
				<td><?php if(isset($member["name"]))echo $member["name"]?></td>
				<td><?php if(isset($member["type"]))echo $member["type"]?></td>
				<td><?php if(isset($member["tags"]))echo implode(",", $member["tags"])?></td>
				<td class="center">
				<div class="visible-md visible-lg hidden-sm hidden-xs">
					<?php if(isset($organization["canEditMembers"])) 
					{ ?>
						<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/edit/id/'.(string)$member["_id"]."/parentOrganisation/".(string)$organization["_id"]);?>" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-pencil"></i></a>
					<?php 
					} ?>
					<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.$member["publicURL"]);?>" class="btn btn-light-blue tooltips " data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
					<a href="#" class="btn btn-red tooltips delBtn" data-id="<?php echo (string)$member["_id"];?>" data-name="<?php echo (string)$member["name"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
				</div>
				</td>
			</tr>
			<?php
					}
				}
			}
			?>
		</tbody>
	</table>
</div>

<?php
$this->renderPartial('addMembers', array( "organization" => $organization ));
?>

<script type="text/javascript">
	
jQuery(document).ready(function() {
	
	$(".addMembersBtn").off().on("click",function () {
        
		subViewContent = $(this).attr('href');
	    $.subview({
	        content : subViewContent,
	        onShow : function() {
	        	bindAddMembersEvents();
	        },
	        onHide : function() {
	          $.hideSubview();
	          
	        }
	    });
	});


});

function bindAddMembersEvents () {  
	/*$("#addMemberForm").off().on("submit",function(event){
    	event.preventDefault();
    	alert($("#addMemberForm").serialize());
    	$.ajax({
            type: "POST",
            url: baseUrl+"/communecter/organization/savemember",
            data: $("#addMemberForm").serialize(),
            dataType: "json",
            success: function(data){
        	   toastr.success("member added successfully ");
               strHTML = "<tr><td>"+$("#memberType").val()+"</td><td>"+$("#memberName").val()+"</td><td>"+$("#memberEmail").val()+"</td><td><span class='label label-info'>added</span></td> <tr>";
                $(".newMembersAdded").append(strHTML);
                if($(".newMembersAddedTable").hasClass("hide"))
                    $(".newMembersAddedTable").removeClass('hide').addClass('animated bounceIn');
                $("#memberType").val("");
                $("#memberName").val("");
                $("#memberEmail").val("");
               
            },
            error:function (xhr, ajaxOptions, thrownError){
              toastr.error( thrownError );
            } 
    	});
    });*/
    $("#memberBatchImport").submit( function(event){
        event.preventDefault();
    });
}
</script>
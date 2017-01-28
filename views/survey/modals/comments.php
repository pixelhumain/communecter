
<div class="modal fade" id="commentsForm" tabindex="-1" role="dialog" aria-labelledby="commentsFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="commentsFormLabel" >Commentaire :</h3>
      </div>
      <div class="modal-body">
      	<p> Use #HashTags in text and @tags for people
        These will be automatically converted</p>
        <div>Comment1, + VoteUp & Down</div>
        <div>Comment2, + VoteUp & Down</div>
        <div>Comment3, + VoteUp & Down</div>
        <div>Comment4, + VoteUp & Down</div>
        title 
        <br/>
        <input type="text" name="nameaddEntry" id="nameaddEntry" value="test1" />
        <br/><br/>
        message
        <textarea id="message" style="width:100%;height:30px;vertical-align: middle" onkeyup="AutoGrowTextArea(this);$('#message1').val($('#message').val())"></textarea>
        <div style="clear:both"></div>
      </div>
       <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
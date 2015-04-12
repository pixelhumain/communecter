<!-- *** NEW NOTE *** -->
<div id="newNote">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h3>Add new note</h3>
		<form class="form-note">
			<div class="form-group">
				<input class="note-title form-control" name="noteTitle" type="text" placeholder="Note Title...">
			</div>
			<div class="form-group">
				<textarea id="noteEditor" name="noteEditor" class="hide"></textarea>
				<textarea class="summernote" placeholder="Write note here..."></textarea>
			</div>
			<div class="pull-right">
				<div class="btn-group">
					<a href="#" class="btn btn-info close-subview-button">
						Close
					</a>
				</div>
				<div class="btn-group">
					<button class="btn btn-info save-note" type="submit">
						Save
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- *** READ NOTE *** -->
<div id="readNote">
	<div class="barTopSubview">
		<a href="#newNote" class="new-note button-sv"><i class="fa fa-plus"></i> Add new note</a>
	</div>
	<div class="noteWrap col-md-8 col-md-offset-2">
		<div class="panel panel-note">
			<div class="e-slider owl-carousel owl-theme">
				<div class="item">
					<div class="panel-heading">
						<h3>This is a Note</h3>
					</div>
					<div class="panel-body">
						<div class="note-short-content">
							Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...
						</div>
						<div class="note-content">
							Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.
							Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat.
							Quis aute iure reprehenderit in <strong>voluptate velit</strong> esse cillum dolore eu fugiat nulla pariatur.
							<br>
							Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
							<br>
							Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci v'elit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.
							<br>
							Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut <strong>aliquid ex ea commodi consequatur?</strong>
							<br>
							Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?
							<br>
							At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.
							<br>
							Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae.
							<br>
							Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
						</div>
						<div class="note-options pull-right">
							<a href="#readNote" class="read-note"><i class="fa fa-chevron-circle-right"></i> Read</a><a href="#" class="delete-note"><i class="fa fa-times"></i> Delete</a>
						</div>
					</div>
					<div class="panel-footer">
						<div class="avatar-note"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-2-small.jpg" alt="">
						</div>
						<span class="author-note">Nicole Bell</span>
						<time class="timestamp" title="2014-02-18T00:00:00-05:00">
							2014-02-18T00:00:00-05:00
						</time>
					</div>
				</div>
				<div class="item">
					<div class="panel-heading">
						<h3>This is the second Note</h3>
					</div>
					<div class="panel-body">
						<div class="note-short-content">
							Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Nemo enim ipsam voluptatem, quia voluptas sit...
						</div>
						<div class="note-content">
							Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
							<br>
							Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci v'elit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.
							<br>
							Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut <strong>aliquid ex ea commodi consequatur?</strong>
							<br>
							Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?
							<br>
							Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae.
							<br>
							Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
						</div>
						<div class="note-options pull-right">
							<a href="#" class="read-note"><i class="fa fa-chevron-circle-right"></i> Read</a><a href="#" class="delete-note"><i class="fa fa-times"></i> Delete</a>
						</div>
					</div>
					<div class="panel-footer">
						<div class="avatar-note"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-3-small.jpg" alt="">
						</div>
						<span class="author-note">Steven Thompson</span>
						<time class="timestamp" title="2014-02-18T00:00:00-05:00">
							2014-02-18T00:00:00-05:00
						</time>
					</div>
				</div>
				<div class="item">
					<div class="panel-heading">
						<h3>This is yet another Note</h3>
					</div>
					<div class="panel-body">
						<div class="note-short-content">
							At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores...
						</div>
						<div class="note-content">
							At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.
							<br>
							Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
							<br>
							Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci v'elit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.
							<br>
							Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut <strong>aliquid ex ea commodi consequatur?</strong>
						</div>
						<div class="note-options pull-right">
							<a href="#" class="read-note"><i class="fa fa-chevron-circle-right"></i> Read</a><a href="#" class="delete-note"><i class="fa fa-times"></i> Delete</a>
						</div>
					</div>
					<div class="panel-footer">
						<div class="avatar-note"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-4-small.jpg" alt="">
						</div>
						<span class="author-note">Ella Patterson</span>
						<time class="timestamp" title="2014-02-18T00:00:00-05:00">
							2014-02-18T00:00:00-05:00
						</time>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
 	bindNoteSubViewEvents();
 	readNote();
	runNoteFormValidation();
});

function bindNoteSubViewEvents() {
	
	$(".new-note").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		$.subview({
			content : subViewContent,
			onShow : function() {
				editNote();
			},
			onClose : function() {
				checkNote();
			},
			onHide : function() {
				hideNote();
			}
		});
	});
	$(".read-all-notes").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		$.subview({
			content : subViewContent,
			startFrom : "right",
			onShow : function() {
				readNote();
			}
		});
	});
	$(".read-note").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		subViewIndex = subViewElement.closest(".e-slider").data("owlCarousel").currentItem;
		$.subview({
			content : subViewContent,
			startFrom : "right",
			onShow : function() {
				readNote(subViewIndex);
			}
		});
	});
	
	$(".close-subview-button").off().on("click", function(e) {
		$(".close-subviews").trigger("click");
		e.preventDefault();
	});
};

var widgetNotes = $('#notes .e-slider'), sliderNotes = $('#readNote .e-slider'), $note;
var oTable;
var subViewElement, subViewContent, subViewIndex;

function editNote() 
{
	$(".delete-note").off().on("click", function(e) {
			subViewElement = $(this);
			
			subViewIndex = subViewElement.closest(".e-slider").data("owlCarousel").currentItem;
		
		bootbox.confirm("Are you sure you want to delete this note?", function(result) {
			if (result) {
				if (widgetNotes.length){
					widgetNotes.data('owlCarousel').removeItem(subViewIndex);
					widgetNotes.data('owlCarousel').jumpTo(0);
				}				
				sliderNotes.data('owlCarousel').removeItem(subViewIndex);				
				sliderNotes.data('owlCarousel').jumpTo(0);
			};
		});
	}); 
	$note = $(".form-note .summernote");
	$note.summernote({

		oninit: function() {
			if ($note.code() == "" || $note.code().replace(/(<([^>]+)>)/ig, "") == "") {
				$note.code($note.attr("placeholder"));
			}
		}, onfocus: function(e) {
			if ($note.code() == $note.attr("placeholder")) {
				$note.code("");
			}
		}, onblur: function(e) {
			if ($note.code() == "" || $note.code().replace(/(<([^>]+)>)/ig, "") == "") {
				$note.code($note.attr("placeholder"));
			}
		}, onkeyup: function(e) {
			$("span[for='noteEditor']").remove();
		},


		toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		]
		});
}

// read note
function readNote(el) 
{
	var noteIndex;
	if ( typeof el == "undefined" || el < 0) {
		noteIndex = 0;
	} else {
		noteIndex = el;
	}
	//$("#readNote .e-slider").data('owlCarousel').jumpTo(noteIndex);
};
	
function checkNote() 
{
	//alert(el.closest("li").index());
	$note = $('.form-note .summernote');

	if ($('.form-note .note-title').val() !== "" || $note.code() !== $note.attr("placeholder")) {
		bootbox.confirm("You did not save note, are you sure to cancel?", function(result) {

			if (result) {

				$('.form-note .note-title').val("");
				$note.code($note.attr("placeholder"));
				$.hideSubview();
			}

		});

	} else {
		$(".form-note .help-block").remove();
		$(".form-note .form-group").removeClass("has-error").removeClass("has-success");
		$.hideSubview();
	}

}

function hideNote() 
{
	$('.form-note .summernote').destroy();
}

function cloneNote(el, noteToSave) 
{

		var _clone_note = el.find(".item:first").clone(true);
		
		_clone_note.children(".panel-heading").find("h3").text(noteToSave.title).end().parent().children(".panel-body").find(".note-short-content").html(noteToSave.shortContent).end().find(".note-content").html(noteToSave.content).end().parent().children(".panel-footer").find("img").attr("src", noteToSave.avatar).end().find(".author-note").text(noteToSave.author).end().find("time").attr("title", moment(noteToSave.date)).text(moment(noteToSave.date).startOf('second').fromNow());
		
		return (_clone_note);
}

function runNoteFormValidation() 
{
	var formNote = $('.form-note');
	var errorHandler1 = $('.errorHandler', formNote);
	var successHandler1 = $('.successHandler', formNote);
	$.validator.addMethod("getEditorValue", function() {
		$("#noteEditor").val($('.form-note .summernote').code());
		if ($("#noteEditor").val() != "" && $("#noteEditor").val() != "<br>" && $("#noteEditor").val() != $('.form-note .summernote').attr("placeholder")) {
			$('#noteEditor').val('');
			return true;
		} else {
			return false;
		}
	}, '* This field is required.');
	formNote.validate({
		errorElement : "span", // contain the error msg in a span tag
		errorClass : 'help-block',
		errorPlacement : function(error, element) {// render error placement for each input type
			if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
				error.insertBefore($(element).closest('.form-group').children('div').children().last());
			} else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
				error.insertBefore($(element).closest('.form-group').children('div'));
			} else {
				error.insertBefore(element);
				// for other inputs, just perform default behavior
			}
		},
		ignore : "",
		rules : {
			noteTitle : {
				minlength : 2,
				required : true
			},
			noteEditor : "getEditorValue"
		},
		messages : {
			noteTitle : "* Please specify your first name"
		},
		invalidHandler : function(event, validator) {//display error alert on form submit
			successHandler1.hide();
			errorHandler1.show();
		},
		highlight : function(element) {
			$(element).closest('.help-block').removeClass('valid');
			// display OK icon
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
			// add the Bootstrap error class to the control group
		},
		unhighlight : function(element) {// revert the change done by hightlight
			$(element).closest('.form-group').removeClass('has-error');
			// set error class to the control group
		},
		success : function(label, element) {
			label.addClass('help-block valid');
			// mark the current input as valid and display OK icon
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
		},
		submitHandler : function(form) {
			successHandler1.show();
			errorHandler1.hide();
			$.blockUI({
				message : '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
			});
			var noteToSave = new Object;
			noteToSave.title = $('.form-note .note-title').val(), noteToSave.shortContent = jQuery.truncate($note.code(), {
				length : 200
			}), noteToSave.content = $note.code(), noteToSave.author = "Peter Clark", noteToSave.avatar = "assets/images/avatar-1-small.jpg", noteToSave.date = new Date();
			$.mockjax({
				url : '/note/new/webservice',
				dataType : 'json',
				responseTime : 1000,
				responseText : {
					say : 'ok'
				}
			});

			$.ajax({
				url : '/note/new/webservice',
				dataType : 'json',
				success : function(json) {
					$.unblockUI();
					if (json.say == "ok") {
						sliderNotes.data('owlCarousel').addItem(cloneNote($("#readNote"), noteToSave), 0);
						if(widgetNotes.length) {
							widgetNotes.data('owlCarousel').addItem(cloneNote($("#notes"), noteToSave), 0);
						}
						$('.form-note .note-title').val("");
						$note.code($note.attr("placeholder"));
						$.hideSubview();
						//widgetNotes.data('owlCarousel').flexAnimate(0);
						toastr.success(noteToSave.author + ' added a new note!');
					}
				}
			});
		}
	});
}


	
</script>
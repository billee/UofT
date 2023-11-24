<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="commentModalLabel">Comment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="previous-comment"></div>
            <textarea class="modal-comment" rows="10" cols="50" placeholder="Enter your comment here..."></textarea>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: red; color: white;">Close</button>
            <button type="button" class="btn btn-primary save-comment-changes-modal" style="background-color: green; color: white;"  data-url="{{route('comment.save')}}">Save changes</button>
            <input type="hidden" id="app-id" name="app-id" value="">
        </div>
      </div>
    </div>
  </div>


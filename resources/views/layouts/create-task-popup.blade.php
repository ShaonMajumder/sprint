<div class="modal fade" id="createTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('new_task')}}" method="post" id="newtaskform">
          @csrf

          <div class="form-group">
            <label for="recipient-name1" class="col-form-label">Title:</label>
            <input type="text" class="form-control" id="recipient-name1"  name="title">
          </div>
          <div class="form-group">
            <label for="message-text2" class="col-form-label">Description:</label>
            <textarea class="form-control" id="message-text2" name="description"></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name2" class="col-form-label">URL:</label>
            <input type="text" class="form-control" id="recipient-name2"  name="url">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" onclick="addtask();" class="btn btn-primary">Create</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('new_category') }}" method="post" id="newCategoryForm">
            @csrf
  
            <div class="form-group">
              <label for="title" class="col-form-label">Title:</label>
              <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
              <label for="class" class="col-form-label">Class</label>
              <input type="text" class="form-control" id="class" name="class">
            </div>
            <div class="form-group">
              <label for="icon" class="col-form-label">icon</label>
              <input type="text" class="form-control" id="icon" name="icon">
            </div>
            <div class="form-group">
              <label for="color" class="col-form-label">Color</label>
              <input type="color" class="form-control" id="color" name="color">
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="btnNewCategoryForm">Create</button>
        </div>
      </div>
    </div>
  </div>
  
  <script>
  </script>
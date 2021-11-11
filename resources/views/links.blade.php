@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="table-responsive">
      <table id="table" class="table table-striped table-bordered table-hover mb-5">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">URL</th>
            </tr>
        </thead>
        <tbody id="tablecontents" >
            @foreach($links as $data)
            <tr class="rowRef" data-id="{{ $data->id }}" >
                <td>{{ $data->title }}</td>
                <td>{{ $data->category }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->url }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
      
    </div>
  </div>
      
</div>



<script>
$(document).ready(function () {

  $("#table").dataTable({
    "order": []
  });

  $( "#tablecontents" ).sortable({
    items: "tr",
    cursor: 'move',
    opacity: 0.6,
    update: function() {
        updatePosition();
    }
  });

function updatePosition() {

  var order = [];
  $('tr.rowRef').each(function(index,element) {
    order.push({
      id: $(this).attr('data-id'),
      sort_id: index+1
    });
  });

  $.ajax({
    type: "POST", 
    dataType: "json", 
    url: "{{ url('links/sortabledatatable') }}",
    data: {
      order:order,
      _token: '{{csrf_token()}}'
    },
    success: function(response) {
        if (response.status == "success") {
          console.log(response);
        } else {
          console.log(response);
        }
    }
  });

}

});
</script>
    
@endsection

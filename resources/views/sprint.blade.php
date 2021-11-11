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
          
            @foreach($tasks as $data)
            <tr class="rowRef" data-id="{{ $data->id }}" >
             
                <td>{{ $data->title }}</td>
                <td>{{ $data->category }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->url }}</td>
            </tr>
            @endforeach
        </tbody>

        <tbody id="tablecontents-done" >
          <tr>
            
              <td colspan="8" class="done" >  <span style="color:white;">Done</span>  </td>
              
          </tr>
            @foreach($tasks as $data)
            <tr class="rowRef" data-id="{{ $data->id }}" >
             
                <td> <i class="fas fa-check"></i> {{ $data->title }}</td>
                <td>{{ $data->category }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->url }}</td>
            </tr>
            @endforeach
        </tbody>

        <tbody id="tablecontents-bug" >
          <tr>
            <td colspan="8" class="bug"> <span style="color:white;">Bug</span> </td>
          </tr>
            @foreach($tasks as $data)
            <tr class="rowRef" data-id="{{ $data->id }}" >
                <td> <i class="fas fa-times"></i>  {{ $data->title }}</td>
                <td>{{ $data->category }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->url }}</td>
            </tr>
            @endforeach
        </tbody>

        <tbody id="tablecontents-qa" >
          <tr>
            <td colspan="8" class="qa background">QA</td>
          </tr>
          @foreach($tasks as $data)
          <tr class="rowRef" data-id="{{ $data->id }}" >
              <td> <i class="fab fa-searchengin text-info"></i> {{ $data->title }}</td>
              <td>{{ $data->category }}</td>
              <td>{{ $data->description }}</td>
              <td>{{ $data->url }}</td>
          </tr>
          @endforeach
      </tbody>

        <tbody id="tablecontents-progress" >
            <tr>
              <td colspan="8" class="in-progress background"> <span style="color:white;"> Progress </span> </td>
            </tr>
            @foreach($tasks as $data)
            <tr class="rowRef" data-id="{{ $data->id }}" >
                <td> <i class="fas fa-wrench text-warning"></i> {{ $data->title }}</td>
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
    url: "{{ url('sprint/sortabledatatable') }}",
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

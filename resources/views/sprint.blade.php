@extends('layouts.app')
@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="table-responsive">
      <table id="table" class="table table-striped table-bordered table-hover mb-5">
        <thead>
            <tr>
              <th scope="col">Icon</th>
              <th scope="col">Title</th>
              <th scope="col">Description</th>
              <th scope="col">URL</th>
            </tr>
        </thead>
        <tbody class="tablecontents" category="open" dropped-into-category="open">
          @foreach($tasks as $data)
            @if($data->category == "open") 
              <tr class="rowRef" category="open" data-id="{{ $data->id }}" >
                <td class="icon"></td>
                <td>{{ $data->title }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->url }}</td>
              </tr>
            @endif
            
          @endforeach
            
        </tbody>

        <tbody id="tablecontents-done" class="tablecontents" dropped-into-category="done">
          <tr>
            
              <td colspan="8" class="done status" >  <span style="color:white;">Done</span>  </td>
              
          </tr>
            @foreach($tasks as $data)
              @if ($data->category == "done" )
                <tr class="rowRef" category="done" data-id="{{ $data->id }}" >
                    <td class="icon"><i class="fas fa-check"></i></td>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ $data->url }}</td>
                </tr>
              @endif
            @endforeach
        </tbody>

        <tbody id="tablecontents-bug" class="tablecontents" dropped-into-category="bug">
          <tr>
            <td colspan="8" class="bug status"> <span style="color:white;">Bug</span> </td>
          </tr>
            @foreach($tasks as $data)
              @if ($data->category == "bug" )
                <tr class="rowRef" category="bug" data-id="{{ $data->id }}" >
                  <td class="icon"> <i class="fas fa-times"></i> </td>
                  <td>{{ $data->title }}</td>
                  <td>{{ $data->description }}</td>
                  <td>{{ $data->url }}</td>
                </tr>
              @endif
            @endforeach
        </tbody>

        <tbody id="tablecontents-qa" class="tablecontents" dropped-into-category="qa">
          <tr>
            <td colspan="8" class="qa background status">QA</td>
          </tr>
          @foreach($tasks as $data)
            @if ($data->category == "qa" )
              <tr class="rowRef" category="qa" data-id="{{ $data->id }}" >
                <td class="icon"><i class="fab fa-searchengin text-info"></i></td>
                  <td>{{ $data->title }}</td>
                  <td>{{ $data->description }}</td>
                  <td>{{ $data->url }}</td>
              </tr>
            @endif
          @endforeach
      </tbody>

        <tbody id="tablecontents-progress" class="tablecontents" dropped-into-category="progress">
            <tr>
              <td colspan="8" class="in-progress background status"> <span style="color:white;"> Progress </span> </td>
            </tr>
            @foreach($tasks as $data)
              @if ($data->category == "progress" )
                <tr class="rowRef" category="progress" data-id="{{ $data->id }}" >
                  <td class="icon"><i class="fas fa-wrench text-warning"></i></td>
                  <td>{{ $data->title }}</td>
                  <td>{{ $data->description }}</td>
                  <td>{{ $data->url }}</td>
                </tr>
              @endif
            @endforeach
        </tbody>
      </table>
      
    </div>
  </div>
      
</div>



<script>
$(document).ready(function () {

  function updateIcons(){
    $('.rowRef[category="open"] .icon').html('<i class="fas fa-folder-open"></i>');
    $('.rowRef[category="done"] .icon').html('<i class="fas fa-check"></i>');
    $('.rowRef[category="bug"] .icon').html('<i class="fas fa-times"></i>');
    $('.rowRef[category="qa"] .icon').html('<i class="fab fa-searchengin text-info"></i>');
    $('.rowRef[category="progress"] .icon').html('<i class="fas fa-wrench text-warning"></i>');
  }

  updateIcons();

  var droppedInto;

  $("#table").dataTable({
    "order": []
  });

  $( ".tablecontents" ).sortable({
    items: "tr",
    cursor: 'move',
    opacity: 0.6,
    update: function() {
      updatePosition();
    }
  });


  function droppedAfter(){
    
    if(event.target.tagName == 'TD' && event.target.closest('tr').className.includes('rowRef')){
        
      var data_id = event.target.closest('tr').getAttribute('data-id');
      var fromCategory = event.target.closest('tbody').getAttribute('dropped-into-category');

      if(data_id == 'undefined'){
        console.log('undefined data_id');
      }
      console.log( 'From Category-' + fromCategory + ', Droped Into-' + droppedInto + ', data-id-' +data_id);
        
      if( fromCategory != droppedInto && ( data_id !== null && droppedInto !== null ) ){
        
        var keepHtml = $('.rowRef[data-id="'+ data_id +'"]').html();
        $('.rowRef[data-id="'+ data_id +'"]').remove();
        $('<tr class="rowRef" category="'+droppedInto+'" data-id="'+data_id+'">'+
            keepHtml+
          '</tr>').appendTo('#table .tablecontents[dropped-into-category="'+ droppedInto +'"]');
        updateIcons();
        updatePosition();
        data_id = null;
        droppedInto = null;
      }
        
    }
  }

  $( ".tablecontents" ).droppable({
    drop: function( event, ui ) {
      droppedInto = this.getAttribute('dropped-into-category');
      console.log("Dropped Into " + droppedInto);
      droppedAfter();
      //updatePosition();
      //populateTable();
    }
  });

  function updatePosition(){
    var order = [];
    $('tr.rowRef').each(function(index,element) {
      if(element.getAttribute('data-id') != null){
        order.push({
          id: element.getAttribute('data-id'),
          category: element.getAttribute('category'),
          sort_id: index+1
        });
      }
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

  function populateTable(){
    $.getJSON("{{ url('sprint/populate') }}", function (data) {
      json_obj = data;

      data.forEach((item) => {
      // if ($("#mydiv").length){  }
        if( item.category ==  "open" ) {
          $('<tr class="rowRef" data-id="'+item.id+'" category="open">'+
            '<td> <i class="fas fa-check"></i>  '+item.title+'</td>'+
            '<td>'+item.description+'</td>'+
            '<td>'+item.url+'</td>'+
          '</tr>').appendTo("#table #"+item.category);

        }else if( item.category ==  "done" ) {
          $('<tr class="rowRef" data-id="'+item.id+'" category="done">'+
            '<td> <i class="fas fa-check"></i>  '+item.title+'</td>'+
            '<td>'+item.description+'</td>'+
            '<td>'+item.url+'</td>'+
          '</tr>').appendTo("#table #"+item.category);

        }else if( item.category ==  "bug" ) {
          $('<tr class="rowRef" data-id="'+item.id+'" category="bug">'+
            '<td> <i class="fas fa-times"></i> '+item.title+'</td>'+
            '<td>'+item.category+'</td>'+
            '<td>'+item.description+'</td>'+
            '<td>'+item.url+'</td>'+
          '</tr>').appendTo("#table #"+item.category);

        }else if( item.category ==  "qa" ) {
          $('<tr class="rowRef" data-id="'+item.id+'" category="qa">'+
            '<td> <i class="fab fa-searchengin text-info"></i> '+item.title+'</td>'+
            '<td>'+item.category+'</td>'+
            '<td>'+item.description+'</td>'+
            '<td>'+item.url+'</td>'+
          '</tr>').appendTo("#table #"+item.category);

        }else if( item.category ==  "progress" ) {
          $('<tr class="rowRef" data-id="'+item.id+'" category="progress">'+
            '<td> <i class="fas fa-wrench text-warning"></i> '+item.title+'</td>'+
            '<td>'+item.category+'</td>'+
            '<td>'+item.description+'</td>'+
            '<td>'+item.url+'</td>'+
          '</tr>').appendTo("#table #"+item.category);

        }

      });
    });
  }



});
</script>
    
@endsection

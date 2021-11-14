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
        <tbody class="tablecontents">
          @foreach($tasks as $data)
            @if($data->category != "tablecontents-done" && $data->category != "tablecontents-bug" && $data->category != "tablecontents-qa" && $data->category != "tablecontents-progress") 
              <tr class="rowRef" data-id="{{ $data->id }}" >
                  <td>{{ $data->title }}</td>
                  <td>{{ $data->category }}</td>
                  <td>{{ $data->description }}</td>
                  <td>{{ $data->url }}</td>
              </tr>
            @endif
            
          @endforeach
            
        </tbody>

        <tbody id="tablecontents-done" class="tablecontents">
          <tr>
            
              <td colspan="8" class="done status" >  <span style="color:white;">Done</span>  </td>
              
          </tr>
            @foreach($tasks as $data)
              @if ($data->category == "tablecontents-done" )
                <tr class="rowRef" data-id="{{ $data->id }}" >
                    <td> <i class="fas fa-check"></i> {{ $data->title }}</td>
                    <td>{{ $data->category }}</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ $data->url }}</td>
                </tr>
              @endif
            @endforeach
        </tbody>

        <tbody id="tablecontents-bug" class="tablecontents">
          <tr>
            <td colspan="8" class="bug status"> <span style="color:white;">Bug</span> </td>
          </tr>
            @foreach($tasks as $data)
              @if ($data->category == "tablecontents-bug" )
                <tr class="rowRef" data-id="{{ $data->id }}" >
                    <td> <i class="fas fa-times"></i>  {{ $data->title }}</td>
                    <td>{{ $data->category }}</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ $data->url }}</td>
                </tr>
              @endif
            @endforeach
        </tbody>

        <tbody id="tablecontents-qa" class="tablecontents">
          <tr>
            <td colspan="8" class="qa background status">QA</td>
          </tr>
          @foreach($tasks as $data)
            @if ($data->category == "tablecontents-qa" )
              <tr class="rowRef" data-id="{{ $data->id }}" >
                  <td> <i class="fab fa-searchengin text-info"></i> {{ $data->title }}</td>
                  <td>{{ $data->category }}</td>
                  <td>{{ $data->description }}</td>
                  <td>{{ $data->url }}</td>
              </tr>
            @endif
          @endforeach
      </tbody>

        <tbody id="tablecontents-progress" class="tablecontents">
            <tr>
              <td colspan="8" class="in-progress background status"> <span style="color:white;"> Progress </span> </td>
            </tr>
            @foreach($tasks as $data)
              @if ($data->category == "tablecontents-progress" )
                <tr class="rowRef" data-id="{{ $data->id }}" >
                  <td> <i class="fas fa-wrench text-warning"></i> {{ $data->title }}</td>
                  <td>{{ $data->category }}</td>
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

  var droppedInto;

  $("#table").dataTable({
    "order": []
  });

  $( ".tablecontents" ).sortable({
    items: "tr",
    cursor: 'move',
    opacity: 0.6,
    update: function() {
      var a = $(this).parent();
      
      
      
        
        
        if(event.target.tagName == 'TD' && event.target.closest('tr').className.includes('rowRef')){
          
          var data_id = event.target.closest('tr').getAttribute('data-id');
          var fromCategory = this.id;
          
          if( fromCategory != droppedInto && data_id !== null && droppedInto !== null ){
            $('.rowRef[data-id="'+ data_id +'"]').remove();


            $.ajax({
              type: "POST", 
              dataType: "json", 
              url: "{{ url('sprint/categoryUpdate') }}",
              data: {
                id: data_id,
                category: droppedInto,
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

            data_id = null;
            droppedInto = null;
            
            
          }
          
        }
      

      
        updatePosition();


        
        $.getJSON("{{ url('sprint/populate') }}", function (data) {
            json_obj = data;
            //alert(JSON.stringify(data));
            $("#table #tablecontents-bug .rowRef").remove();
            $("#table #tablecontents-qa .rowRef").remove();
            $("#table #tablecontents-progress .rowRef").remove();
            $("#table #tablecontents-done .rowRef").remove();

            data.forEach((item) => {


            


              if( item.category ==  "tablecontents-done" ) {

                  
                $('<tr class="rowRef" data-id="'+item.id+'">'+
                  '<td> <i class="fas fa-check"></i>  '+item.title+'</td>'+
                  '<td>'+item.category+'</td>'+
                  '<td>'+item.description+'</td>'+
                  '<td>'+item.url+'</td>'+
                '</tr>').appendTo("#table #"+item.category);

              }else if( item.category ==  "tablecontents-bug" ) {
                $('<tr class="rowRef" data-id="'+item.id+'">'+
                  '<td> <i class="fas fa-times"></i> '+item.title+'</td>'+
                  '<td>'+item.category+'</td>'+
                  '<td>'+item.description+'</td>'+
                  '<td>'+item.url+'</td>'+
                '</tr>').appendTo("#table #"+item.category);

              }else if( item.category ==  "tablecontents-qa" ) {
                $('<tr class="rowRef" data-id="'+item.id+'">'+
                  '<td> <i class="fab fa-searchengin text-info"></i> '+item.title+'</td>'+
                  '<td>'+item.category+'</td>'+
                  '<td>'+item.description+'</td>'+
                  '<td>'+item.url+'</td>'+
                '</tr>').appendTo("#table #"+item.category);

              }else if( item.category ==  "tablecontents-progress" ) {
                $('<tr class="rowRef" data-id="'+item.id+'">'+
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

  $( ".tablecontents" ).droppable({
      drop: function( event, ui ) {
       
       droppedInto = this.id;
      }
    });

function updatePosition() {

  var order = [];
  $('tr.rowRef').each(function(index,element) {
    
    //if(this.parentNode.id != ''){
      order.push({
        id: $(this).attr('data-id'),
        sort_id: index+1
      });
    //}

    
    
  });

  // /alert(order);

 

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
